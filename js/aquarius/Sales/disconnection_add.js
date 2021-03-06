(function($){
	$('#disconnectiontype').click(function(){
		if($(this).val()=='1'){
			$('#finishdate').removeClass('inp_disconnection');
			$('#startdate').removeClass('inp_disconnection');
			$('#startdatecontainer').hide();
			$('#finishdatecontainer').hide();
		}
		if($(this).val()=='2'){
			$('#finishdate').addClass('inp_disconnection');
			$('#startdate').addClass('inp_disconnection');
			$('#startdatecontainer').show();
			$('#finishdatecontainer').show();
			$("#startdate").addClass("mandatory");
			$("#finishdate").addClass("mandatory");
		}
		if($(this).val()=='3'){
			$('#finishdate').removeClass('inp_disconnection');
			$('#startdate').removeClass('inp_disconnection');
			$('#startdatecontainer').hide();
			$('#finishdatecontainer').hide();
			$('#jangkawaktu').hide();
			$("#startdate").removeClass("mandatory");
			$("#finishdate").removeClass("mandatory");
		}
	});
	$(".disconnection_save").click(function(){
			$('.inp_disconnection').makekeyvalparam();
			if(checkMandatory()){
				finishDate = $("#finishdate").getdate()
				.addhour($("#finishdate")
				.stairUp({level:2})
				.find('.dttime[parent="finishdate"]')
				.filter(':first'))
				.addminute($("#finishdate")
				.stairUp({level:2})
				.find('.dttime[grandparent="finishdate"]')
				.filter(':first')).attr("datetime")+":00";
				$.ajax({
					url:'/disconnections/save/',
					type:'post',
					data:{
						disconnectiontype:$('#disconnectiontype').val(),
						client_id:$('#client_id').val(),
						period:$('#period').val(),
						reason:$('#reason').val(),
						fee:0,
						startdate:getmysqldate($('#startdate').val()),
						finishdate:getmysqldate($('#finishdate').val()),
						executiondate:getmysqldate($('#executiondate').val()),
						executed:'0',
						status:'0',
						createuser:$('#createuser').val()  
					},
					dataType:'text'
				}).done(function(data){
					console.log('Data',data)
					$.ajax({
						url:'/clients/update',
						data:{id:$("#client_id").val(),"active":"0"},
						type:"post"
					})
					.done(function(){
						console.log("clients updated");
						$(this).showModal({
							message:"Data tersimpan",
							nextUrl:'/disconnections',
						});
					})
					.fail(function(err){
						console.log("Tidak dapat mengupdate table client",err);
					});
				}).fail(function(err){
					console.log("Tidak dapat mengisi table disconnection",err);
					alert("Tidak dapat menyimpan ...");
				});
			}else{
				$(this).showModal({
					message:"Tanggal harus diisi"
				});
			}
	});
	switch($("#disconnectiontype selected").text()){
		case "Temporer":
			$("#startdate").addClass("mandatory");
			$("#finishdate").addClass("mandatory");
		break;
		case "Permanen":
			$("#startdate").removeClass("mandatory");
			$("#finishdate").removeClass("mandatory");
		break;
	}
}(jQuery));
checkMandatory = function(){
	var out = true;
	$('.mandatory').each(function(){
		if(!$(this).val()){
			out = false;
		}
	});
	return out;
}
isEmpty = function(el){
	return !$.trim(el.html())
}
getmysqldate = userdate=>{
	let tmp = userdate.split("/")
	return tmp[2]+'-'+tmp[1]+'-'+tmp[0]
}
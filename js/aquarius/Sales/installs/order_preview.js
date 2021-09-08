(function($){
	$(".btnAddVas").click(function(){
		$("#btnvasupdate").hide();
		$("#btnvassave").show();
		$("#dAddVAS").modal();
	});
	$("#btnvassave").click(function(){
		$.ajax({
			url:'/install_requests/savevas',
			data:{client_id:$("#client_id").val(),vas_id:$("#vas").val()},
			type:'post',
		})
		.done(function(res){
			console.log("Success",res);
			row = '<tr trid='+res+'>';
			row+= '<td class="info">';
			row+= '<a class="fancybox" rel="group" >'+$("#vas :selected").text()+'</a> ';
			row+= '<span></span> ';
			row+= '<span></span>';
			row+= '</td>';
			row+= '<td><a ><span class="icon-pencil vasedit"></span></a> <a><span class="icon-remove vasremove"></span></a></td>';
			row+= '</tr>';
			$('.tclientvases tbody').prepend(row);
			$("#totalvas").html($(".tclientvases").rowcount());
		})
		.fail(function(err){
			console.log("Error",err);
		});
	});
	$("#btnvasupdate").click(function(){
		console.log("TROD",$(".tclientvases tbody tr.selected").attr("trid"));
		$.ajax({
			url:'/install_requests/updatevas/'+$("#client_id").val()+'/'+$(".tclientvases tbody tr.selected").attr("trid")+'/'+$("#vas").val(),
		})
		.done(function(res){
			console.log("Res",res);
			$(".tclientvases tbody tr.selected .vasname").html($("#vas :selected").text());
		})
		.fail(function(err){
			console.log("Err",err);
		});
	});
	$(".tclientvases").on("click",".vasedit",function(){
		tr = $(this).stairUp({level:3});
		$(".tclientvases tbody tr").removeClass('selected');
		tr.addClass('selected');
		thisid = tr.attr('trid');
		console.log("VAS ID",thisid);
		console.log("Client ID",$("#client_id").val());
		$.ajax({
			url:'/install_requests/getvas',
			data:{client_id:$("#client_id").val(),vas_id:thisid},
			type:'post',
			dataType:'json'
		})
		.done(function(res){
			console.log("Res",res);
			$("#totalvas").html($(".tclientvases").rowcount());
			$("#vas").val(res.name);
			console.log("Name",res.name);
			$("#vas option").each(function(){
				console.log('VAL',$(this).html());
				if($(this).html()===res.name){
					$(this).attr('selected','selected');
				}
			});
			$("#btnvasupdate").show();
			$("#btnvassave").hide();
			$("#dAddVAS").modal();
		})
		.fail(function(err){
			console.log("Error remove",err);
		});
	});
	$(".tclientvases").on("click",".vasremove",function(){
		tr = $(this).stairUp({level:3});
		thisid = tr.attr('trid');
		console.log("ID",thisid);
		$.ajax({
			url:'/install_requests/removevas',
			data:{id:thisid},
			type:'post'
		})
		.done(function(res){
			console.log("Success remove",res);
			tr.remove();
			$("#totalvas").html($(".tclientvases").rowcount());
		})
		.fail(function(err){
			console.log("Error remove",err);
		});
	});
	$(".btnclose").click(function(){
		$(this).stairUp({level:2}).modal("hide");
	});
	function savesite(install_request_id){
		$.ajax({
			url:'/install_sites/save',
			data:JSON.parse('{"install_request_id":"'+install_request_id+'",'+$('.installsite').attr('keyval')+'}'),
			type:'post',
			async:false
		}).done(function(siteid){
			var createuser = $('#createuser').val(), 
			clientname = $('#client_name').val(),
			url = '/install_requests/install_edit/'+install_request_id;
			$.ajax({
				url:'/install_requests/saveinstallsitedescription/',
				data:{id:siteid,description:$('#description').val()},
				type:'post'
			})

			$.ajax({
				url:'/clients/update',
				data:{
					id:$("#client_id").val(),
					clientcategory:$('#clientcategory').val()
				},
				type:'post'
			})
			.done(function(res){
				console.log("Sukses Update Client",res);
				window.location.href = '/install_requests/index/all';
			})
			.fail(function(err){
				console.log("Error Update Client",err);
			});
			//callback(createuser,clientname,url);
		}).fail(function(){
			alert('Tidak dapat menyimpan site instalasi, silakan hubungi Developer');
		});			
	}
	checkTrial = function(){
		switch($('#withtrial').val()){
			case '0':
			$('#dtrialrange').hide();
			break;
			case '1':
			$('#dtrialrange').show();
			break;
			default:
			$('#dtrialrange').hide();
			break;
		}		
	}
	checkTrial();
	$('#withtrial').change(function(){
		console.log('WITH TRIA VALUE',$(this).val());
		checkTrial();
	});
	$("#testAmountOfVAS").click(function(){
		console.log("Amountof VAS",$("#totalvas").html());
		console.log("AMOUNT OF VASES",$(".tclientvases").rowcount());
	});
	$('#preview_save').click(function(){
		if($("#totalvas").html()=="0"){
			alert("VAS harus diisi");
		}else{
		$('.installrequest').makekeyvalparam();
		$('.installsite').makekeyvalparam();
		console.log("Amountof VAS",$("#totalvas").html());
		console.log('KEYVAL OF INSTALL REQUEST',$('.installrequest').attr('keyval'));
		if($('#withtrial').val()!=='2'){
			if($(this).checkEmpty({className:"emptycheck"})){
				$.ajax({
					url:'/install_requests/save',
					data:JSON.parse('{"withtrial":"'+$('#withtrial').val()+'","trialdistance":'+$('#trialrange').val()+','+$('.installrequest').attr('keyval')+'}'),
					type:'post',
					async:false
				}).done(function(install_request_id){
					savesite(install_request_id);
					console.log('install_requests save did');
					var createuser = $('#createuser').val(), 
					clientname = $('#client_name').val(),
					url = '/install_requests/install_edit/'+install_request_id;
						$('#preview_save').attr('disabled','disabled');

						$.ajax({
							url:'/install_requests/saveinstalldescription/',
							data:{id:install_request_id,description:$('#description').val()},
							type:'post'
						})
						.done(function(res){
							console.log('save descriptionres',res)
						})
						.fail(function(err){
							console.log("Err",err);
						});
						
				}).fail(function(){
					alert('Tidak dapat menyimpan site requests, silakan hubungi Developer');
				});
			}else{
				alert("Pastikan semua Field Terisi");
			}
		}else{
			alert('Konfirmasi Trial Harus terisi');
		}
	}
	});
	$('.myeditor').cleditor({width:'300',height:'160px',controls:"bold italic underline | color highlight removeformat | bullets numbering"});
}(jQuery))

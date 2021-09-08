$(document).ready(function(){
	$(".btnAddVas").click(function(){
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
			row+= '<td><a><span class="icon-pencil"></span></a> <a ><span class="icon-remove vasremove"></span></a></td>';
			row+= '</tr>';
			$('.tclientvases tbody').prepend(row);
			$("#totalvas").html($(".tclientvases").rowcount());
		})
		.fail(function(err){
			console.log("Error",err);
		});
	});
	$(".tclientvases tbody").on('click','.vasremove',function(){
		tr = $(this).stairUp({level:3});
		thisid = tr.attr('trid');
		console.log("ID",thisid);
		$.ajax({
			url:'/install_requests/removevas',
			data:{
				id:thisid,
				toremove:'1'
			},
			type:'post'
		})
		.done(function(res){
			console.log("Success remove",res);
			tr.find('.removeattr').html('Pengajuan Hapus (Sales) Belum dilaksanakan');
			$("#totalvas").html($(".tclientvases").rowcount());
		})
		.fail(function(err){
			console.log("Error remove",err);
		});
	});
	$(".btnclose").click(function(){
		$(this).stairUp({level:2}).modal("hide");
	});

	$("#btnaddsite").click(function(){
		$('#dAddInstallSite').modal("show");
	});
	$(".closemodal").click(function(){
		$(this).stairUp({level:6}).modal("hide");
	});
	$(".toggleinstallsite").click(function(){

		if($('#popupinstallsite').is(':visible')){
			$('#popupinstallsite').fadeOut(200);
		}else{
			$('#popupinstallsite').fadeIn(300);
		}
	});
	$('.install_save').click(function(){
		clientstatus = $(this).attr('status');
		installstatus = $(this).attr('status');
		$(".installrequest").makekeyvalparam();
		console.log("installrequest",$(".installrequest").attr("keyval"));
		$.ajax({
			url:'/install_requests/update',
			data:JSON.parse('{"id":'+$("#install_request_id").val()+',"status":"'+installstatus+'",'+$('.installrequest').attr('keyval')+'}'),
			type:'post',
			async:false
		}).done(function(data){
			console.log("DATA UPDATE install_requests",data);
			$.post('/clients/update',{id:$('#client_id').val(),status:clientstatus,active:'1',clientcategory:$('#clientcategory').val()})
			.fail(function(err){
				console.log('Update status client tidak berhasil',err);
			}).done(function(res){
				console.log("Update client success",res);
			});
		}).fail(function(err){
			console.log('tidak bisa update install request',err);
		});
		$('.installsite').makekeyvalparam();
			$.ajax({
				url:'/install_sites/update',
				data:JSON.parse('{"id":"'+$('#install_id').val()+'","status":"'+installstatus+'",'+$(".installsite").attr("keyval")+'}'),
				type:'post',
				async:false
			}).done(function(data){
				switch(installstatus){
					case '5':
						$('#installstatus').text('Sudah selesai');
					break;
					case '3':
						$('#installstatus').text('Belum selesai');
					break;
				}
				$('#dModal').modal().hideafter(1000);
			}).fail(function(){
				alert('tidak bisa update install site');
			});

	});

	$("#print_pdf").click(function(){
/*		var pdf = jsPDF('p','in','letter'),
		margin = 0.5;
		pdf.setDrawColor(0,255,0).setLineWidth(1/72).line(margin,margin,margin,11-margin).line(8.5 - margin, margin, 8.5-margin, 11-margin);
		//var string = pdf.output('x');
		//$('iframe').attr('src',string);
		alert("cetak PDF");
		*/

		window.location.href = thisdomain+"reports/install";


	});

	$("#saveinstallsite").click(function(){
		$.post(thisdomain+'adm/installsiteadd',{install_request_id:$('#install_id').val(),address:$('#site_address').val(),city:$('#site_city').val(),pic:$('#site_pic_name').val(),pic_position:$('#site_pic_position').val(),phone_area:$('#site_phone_area').val(),phone:$('#site_phone').val(),pic_email:$('#site_email').val(),description:$('#site_description').val()}).done(function(data){
			$("#site").appendsite(data);
		}).fail(function(){
			alert('Tidak dapat menambah site instalasi, hubungi Developer');
		});

	});

	$(".removesite").click(function(){
		$.post(thisdomain+'adm/install_removesite',{id:$(this).attr('site_id')});
	});
$('.myeditor').cleditor({width:'300',height:'160px',controls:"bold italic underline | color highlight removeformat | bullets numbering"});
});
changeformat = function(mydate){
	out = mydate.split("/");
	return out[2]+'-'+out[1]+'-'+out[0];
}
$.fn.appendsite = function(data){
			$(this).append('<tr><td>'+$("#site_address").val()+' - '+$("#site_city").val()+'</td><td class="info"><a class="fancybox" rel="group" href="'+thisdomain+'img/aquarius/example_full.jpg">'+$("#site_pic_name").val()+'</a> <span>'+$("#site_phone_area").val()+' - '+$("#site_phone").val()+'</span> <span>'+$("#pic_email").val()+'</span></td><td>'+$("#site_pic_position").val()+'</td><td><a href="'+thisdomain+'adm/install_site/'+data+'"><span class="icon-pencil"></span></a><a><span class="icon-trash pointer link_navRemSurveySite"></span></a></td></tr>');
	}

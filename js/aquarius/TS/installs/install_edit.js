(function($){
	$(".installSave").click(function(){
		$(".installrequest").makekeyvalparam();
		var installstatus = $(this).attr("installstatus"),statustext;
		switch(installstatus){
			case "0":
			statustext="belum selesai";
			break;
			case "1":
			statustext="sudah selesai";
			break;
		}
		console.log("installstatus",installstatus);
		console.log("installrequest",$(".installrequest").attr('keyval'));
		$.ajax({
			url:"/install_requests/update",
			data:JSON.parse('{'+$(".installrequest").attr("keyval")+',"status":"'+installstatus+'"}'),
			type:"post",
			async:false
		}).done(function(){
			$(".iim").makekeyvalparam();
			$.ajax({
				url:"/install_sites/update",
				data:JSON.parse('{'+$(".iim").attr("keyval")+',"id":"'+$("#install_site_id").val()+'","status":"'+installstatus+'"}'),
				type:"post",
				async:false
			}).done(function(){
				console.log('update install_site sukses');
				$.ajax({
					url:"/clients/update",
					data:{"id":$("#workplace").attr("client_id"),"status":installstatus,"active":installstatus},
					type:"post",
					async:false
				}).done(function(){
					console.log('update client sukses');
					$.ajax({
						url:"/client_sites/update",
						data:{id:$("#client_site_id").val(),active:installstatus},
						type:"post",
						async:false
					}).done(function(){
						console.log('update client_site sukses');
						$('#installstatus').html(statustext);
						var createuser = $('#createuser').val(), 
							clientname = $("#client_id").val(),
							url = 'https://database.padinet.com/install_requests/install_edit/'+$("#install_request_id").val(),
							reporturl = 'https://database.padinet.com/install_requests/showreport2/'+$("#install_request_id").val();
						sendinstallresult(createuser,clientname,statustext,url,reporturl);
						window.location.href = '/install_requests';
					}).fail(function(){
						console.log('update client_site failed');
					});
				}).fail(function(){
					console.log('update client failed');
				});
			}).fail(function(){
				console.log('update install_site failed');
			});
		}).fail(function(){
			console.log('update install_request failed');
		});
	});
	$(".closemodal").click(function(){
		thisobj = $(this)
		for(var i=0;i<7;i++){
			if($(thisobj).hasClass("modal")){
				$(thisobj).modal("hide");
			}else{
				thisobj = thisobj.parent();
			}
		}
	});
	setVasImplemented = function(vasid,implemented){
		$.ajax({
			url:'/install_requests/updatevasimplemented',
			data:{
				client_id:$("#workplace").attr("client_id"),
				vas_id:vasid,
				implemented:implemented
			},
			type:'post'
		})
		.done(function(res){
			console.log("Res",res);
		})
		.fail(function(err){
			console.log("Err",err);
		});

	}
	$(".vas").change(function(){
		vasid = $(this).attr("vasid");
		console.log("Client ID",$("#workplace").attr("client_id"));
		console.log("Vas ID",vasid);
		if($(this).is(":checked")){
			console.log('Changed',$(this).attr("vasname"));
			setVasImplemented(vasid,'1');
		}else{
			setVasImplemented(vasid,"0");
		}
	})
	$(".removevas").click(function(){
		console.log("Remove VAS clicked");
		$.ajax({
			url:'/install_requests/removevas',
			data:{
				id:$(this).stairUp({level:2}).attr("trid"),
				toremove:'2',	
			},
			type:'post'
		})
		.done(function(res){
			console.log("Success remove VAS",res);
		})
		.fail(function(err){
			console.log("Error remove VAS",err);
		});
	});
	$("#btnvassave").click(function(){
		console.log("saave vas");
		$.ajax({
			url:'/install_requests/savevas',
			data:{client_id:$("#workplace").attr("client_id"),vas_id:$("#vas").val()},
			type:'post',
		})
		.done(function(res){
			console.log("Success",res);
			
			row = '<tr trid='+res+'>';
			row+= '<td class="info">';
			row+= '<a class="fancybox" rel="group" >'+$("#vas :selected").text()+'</a> ';
			row+= '<span class="removeattr"></span> ';
				
			row+= '</td>';
			row+= '<td><span class="implementattr">Belum dilaksanakan</span></td>';
			row+= '<td>';
			row+= '<div class="btn-group">';
			row+= '<button data-toggle="dropdown" class="btn dropdown-toggle" >';
			row+= 'Action <span class="caret"></span>';
			row+= '</button>';
			row+= '<ul class="dropdown-menu pull-right">';
			row+= '<li class="btn_edit pointer">';
			row+= '<a class="groupedit">Edit</a>';
			row+= '</li>';
			row+= '<li class="divider"></li>';
			row+= '<li class="pointer">';
			
			row+= '</li>';
			row+= '</ul>';
			row+= '</div>';
			row+= '</td>';
			row+= '</tr>';
			$('.tclientvases tbody').prepend(row);
			$("#totalvas").html($(".tclientvases").rowcount());
		})
		.fail(function(err){
			console.log("Error",err);
		});
	});
	$(".btnclose").click(function(){
		$(this).stairUp({level:2}).modal("hide");
	});
}(jQuery))

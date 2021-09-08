(function($){
	console.log("js invoked");
	mytable = $('#tClient').dataTable({
		"aLengthMenu":[[5,10,30,-1],[5,10,30,'Semua']],
		"bPaginate":true,
		"bFilter":true
//		"aoColumnDefs":[{"bSearchable":true,"bVisible":false,"aTargets":[4]}]
	});
	$("#btnaddclient").click(function(){
		$("#btnsaveclient").show();
		$("#btnupdateclient").hide();
		$("#addClientDialog").modal();
	});
	$("#btnsaveclient").click(function(){
		$(".inp_client").makekeyvalparam();
		console.log($(".inp_client").attr("keyval"));
		console.log("sale_id",$("#sale_id").val());
		$.ajax({
			url:thisdomain+"clients/save",
			data:JSON.parse('{"dataorigin":"0","user_id":"'+$("#sale_id").val()+'",'+$(".inp_client").attr("keyval")+',"status":"1"}'),
			type:"post",
			success:function(data){
				console.log("sukses add data",data);
				var tr = '<tr myid='+data+'>';
                    tr+= '<td>'+$('#clientname').val()+'</td>';
                    tr+= '<td>'+$('#sale_id :selected').text()+'</td>';
                    tr+= '<td>'+$('#address').val()+'</td>';
                    tr+= '<td></td>';
                    tr+= '<td>'+$('#phone_area').val()+'</td>';
                    tr+= '<td>';
					tr+= '<div class="btn-group">';
					tr+= '<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  >Aksi <span class="caret"></span></button>';
					tr+= '<ul class="dropdown-menu pull-right">';
					tr+= '<li class="btneditclient"><a href="#">Edit</a></li>';
					tr+= '<li class="btnviewsites" ><a href="#">Lihat Cabang</a></li>';
					tr+= '<li class="divider survey_save"></li>';
					tr+= '<li class="btnsurvey"><a href="#">Survey</a></li>';
					tr+= '</ul>';
					tr+= '</div>';
                    tr+= '</td>';
                    tr+= '</tr>';
				$("#tClient tbody").prepend(tr);
				$("#addClientDialog").modal("hide");
			},
			error:function(err){
				console.log("error",err);
			}
		});
	});
	$('#tClient').on('click','tbody tr .btneditpic',function(){
		var tr = $(this).stairUp({level:4}),
			client_id = tr.attr('myid');
			$('#tClient tbody tr').removeClass('selected');
			tr.addClass('selected');
			$.ajax({
				url:thisdomain+'pics/getbyclientid',
				data:JSON.parse('{"client_id":'+client_id+'}'),
				type:'post',
				dataType:'json',
				success:function(data){
					$('.clearinit').val('');
					$.each(data.x,function(x,y){
						$('#name'+y.rolenum).val(y.name);
						$('#telp_hp'+y.rolenum).val(y.telp_hp);
						$('#email'+y.rolenum).val(y.email);
						$.each(y,function(a,b){
							console.log(a,b);
						});
					});
					$("#addPICModalLabel").html($("#tClient tbody tr.selected td.clientname").html());
					$("#editAllPICDialog").modal();
				},
				error:function(err){
					console.log('err',err);
				}
			});
	});
	$("#tClient").on("click","tbody tr .btnsetnonactive",function(){
		var tr = $(this).stairUp({level:4}),myid = tr.attr('myid');
		clientname = tr.find('.clientname').text();
        obj = {
            'question':'Are you sure to inactive the '+clientname+' ?',
        };
		showConfirmationModal(obj,function(){
            $("#question").html(obj.question);
            $("#confirmModal").modal();
        },function(){
			$.ajax({
				url:'/clients/update',
				data:{id:myid,active:'0'},
				type:'post',
				success:function(){
					tr.remove();
					console.log('success update');
				},
				error:function(err){
					console.log('err',err);
				}
			});
		})


	});
	$("#btnsaveallpic").click(function(){
		console.log("save all pic is invoked");
		for(var c=1;c<7;c++){
			$(".inp_pic"+c).makekeyvalparam();
			$.ajax({
				url:thisdomain+'pics/saveupdate',
				data:JSON.parse('{"client_id":"'+$('#tClient tr.selected').attr('myid')+'",'+$(".inp_pic"+c).attr("keyval")+'}'),
				type:'post',
				success:function(data){
					console.log('success',data);
				},
				error:function(err){
					console.log('error',err);
				}
			});
		}
	});
	$(".closemodal").click(function(){
		$(this).stairUp({level:3}).modal('hide');
		$("#editAllPICDialog").modal("hide");
	});
	$('#tClient').on('click','tbody tr .btneditclient',function(){
		id=$(this).stairUp({level:4}).attr('myid');
		window.location.href = thisdomain+'clients/edit/'+id;
	});
	$('.btnremoveclient').click(function(){
		alert('Removeclient');
	});
	$('.btnsurvey').click(function(){
		myid = $(this).stairUp({level:4}).attr('myid');
		window.location.href = thisdomain+'survey_requests/add/'+myid;
	});
	$('.btninstallation').click(function(){
		myid = $(this).stairUp({level:4}).attr('myid');
		window.location.href = thisdomain+'install_requests/edit/'+myid;
	});
	$('.btnupgrade').click(function(){
		myid = $(this).stairUp({level:4}).attr('myid');
		window.location.href = thisdomain+'altergrades/add/'+myid;
	});
	$('.btndisconnection').click(function(){
		myid = $(this).stairUp({level:4}).attr('myid');
		window.location.href = thisdomain+'disconnections/add/'+myid;
	});
	$('.btntroubleshoot').click(function(){
		window.location.href = thisdomain+'troubleshoots/add_lookup';
	});
	$("#tClient").on("click",".btnviewsites",function(){
		window.location.href = thisdomain+"client_sites/index/"+$(this).stairUp({level:4}).attr('myid');
	});
	$('.clientStatus').click(function(){
		$('.clientStatus').removeClass('selected');
		$(this).addClass('selected');
		$(this).parent().hide();
		$(this).parent().removeClass('active');
		mytable.fnDraw();
	});
	$('#nonactiveclient').click(function(){
		mytable.fnDraw();
	});
	$('#activeclient').click(function(){
		mytable.fnDraw();
	});
	$('#exclient').click(function(){
		mytable.fnDraw();
	});
	$('#all').click(function(){
		mytable.fnDraw();
	});
    clearSelected = function(rows,callback){
        rows.each(function(){
            $(this).removeClass('selected');
        });
        callback();
	}
	showConfirmationModal = function(obj,callback,yesEvent){
		callback(obj);
		$('#confirmYes').click(yesEvent)
    }
	$('#tClient').on('click','.remover',function(){
		console.log('remover invokde');
		tr = $(this).stairUp({level:4});
        clearSelected($('#tClient tbody tr'),function(){
            tr.addClass('selected');
        });
        clientid = tr.attr('myid');
        clientname = tr.find('.clientname').text();
        obj = {
            'question':'Are you sure to remove client  '+clientname+' ?',
        };
        showConfirmationModal(obj,function(){
            $("#question").html(obj.question);
            $("#confirmModal").modal();
        },function(){
			$.ajax({
				url:'/clients/backupbeforedelete/'+$('#tClient tr.selected').attr('myid')
			})
			.done(function(){
				$.ajax({
					url:'/clients/remove/'+$('#tClient tr.selected').attr('myid')
				})
				.done(function(res){
					console.log('succss remove',res);
					$('#tClient tr.selected').remove();
				})
			})
	
		})
	})
	$('#tClient').on('click','.btneditalias',function(){
		console.log('remover invokde');
		tr = $(this).stairUp({level:4});
        clearSelected($('#tClient tbody tr'),function(){
            tr.addClass('selected');
        });
		clientid = tr.attr('myid');
		$('#myChangeClientAliasModalLabel').html('Edit Nama/Alias ('+tr.find('.clientname').text()+')');
		$('#name').val(tr.find('.clientname').text());
		$('#alias').val(tr.find('.clientalias').text());
		
        $("#changeclientaliasmodal").modal();
	})
	$('#tClient').on('click','.btneditcategory',function(){
		console.log('edit category invoked');
		tr = $(this).stairUp({level:4});
        clearSelected($('#tClient tbody tr'),function(){
            tr.addClass('selected');
        });
		clientid = tr.attr('myid');
		$('#clientcategory option').each(function(){
			if($(this).text()==$('#tClient tr.selected').find('.clientcategory').text()){
				$(this).attr('selected','selected');
			}
		})
		$('#myChangeCategoryModalLabel').html('Edit Kategori ('+tr.find('.clientname').text()+')');
		$('#alias').val(tr.find('.clientalias').text());
		
        $("#changecategorymodal").modal();
	})
	$('#tClient').on('click','.btneditam',function(){
		tr = $(this).stairUp({level:4});
        clearSelected($('#tClient tbody tr'),function(){
            tr.addClass('selected');
        });
		clientid = tr.attr('myid');
		$('#am option').each(function(){
			if($(this).text()==$('#tClient tr.selected').find('.am').text()){
				$(this).attr('selected','selected');
			}
		})
		console.log('edit AM invoked',tr.find('.clientname').text());
		$('#myChangeAMModalLabel').html('Edit AM ('+tr.find('.clientname').text()+')');
		$('#alias').val(tr.find('.clientalias').text());
		
        $("#changeammodal").modal();
	})
	$('#changeclientaliasmodal').click(function(){
		$.ajax({
			url:'/clients/changenamealias/',
			data:{
				name:$('#name').val(),
				alias:$('#alias').val(),
				id:$('#tClient tr.selected').attr('myid')
			},
			type:'post'
		})
		.done(function(res){
			console.log('Success changeclientalias',res)
			$('#tClient tr.selected').find('.clientname').html($('#name').val());
			$('#tClient tr.selected').find('.clientalias').html($('#alias').val());
		})
		.fail(function(err){console.log('Err changeclientalias',err)});
	});
	$('#btnsavecategory').click(function(){
		console.log('client_id',$('#tClient tr.selected').attr('myid'));
		console.log('clientcategory',$('#clientcategory').val());
		$.ajax({
			url:'/clients/updateclientcategory/'+$('#tClient tr.selected').attr('myid')+'/'+$('#clientcategory').val(),
		})
		.done(function(res){
			console.log('savecategory',res);
			$('#tClient tr.selected').find('.clientcategory').html($('#clientcategory :selected').text());
		})
		.fail(function(err){
			console.log('Err',err);
		});
	});
	$('#btnsaveam').click(function(){
		console.log('client_id',$('#tClient tr.selected').attr('myid'));
		console.log('clientcategory',$('#clientcategory').val());
		$.ajax({
			url:'/clients/updateclientam/'+$('#tClient tr.selected').attr('myid')+'/'+$('#am').val(),
		})
		.done(function(res){
			console.log('saveam',res);
			$('#tClient tr.selected').find('.am').html($('#am :selected').text());
		})
		.fail(function(err){
			console.log('Err',err);
		});
	});
	$('#tClient').on('click','.btnmergeassite',function(){
		tr = $(this).stairUp({level:4});
        clearSelected($('#tClient tbody tr'),function(){
            tr.addClass('selected');
        });
		clientid = tr.attr('myid');
		clientname = tr.find('.clientname').text();
		$('#myMergeAsSiteModalLabel').html('Merge as Site ('+tr.find('.clientname').text()+')');
		
        $("#mergeassitemodal").modal();
	})
	$('#btnmergesite').click(function(){
        obj = {
            'question':'Are you sure to convert client  '+clientname+' as site of '+$('#parentid :selected').text()+' ?',
        };
        showConfirmationModal(obj,function(){
            $("#question").html(obj.question);
            $("#confirmModal").modal();
        },doConvertClient)

	});
	doConvertClient = function(){
		console.log('Convert Client Invoked');
		$.ajax({
			url:'/clients/makesite',
			data:{
				client_id:$('#parentid').val(),
				address:tr.find('.address').text(),
				sale_id:tr.attr('sale_id')
			},
			dataType:'json',
			type:'post'
		})
		.done(function(res){
			console.log('Sukses convert to client_site',res);
			$.ajax({
				url:'/clients/backupbeforedelete/'+clientid,
			})
			.done(function(res){
				console.log('Success backup client_site',res);
				$.ajax({
					url:'/clients/remove/'+clientid
				})
				.done(function(res){
					console.log('Success remove Client',res);
					tr.remove();
				})
				.fail(function(err){
					console.log('Error remove client',err);
				})
			})
			.fail(function(err){
				console.log('Error backup client_site',err);
			})
		})
		.fail(function(err){
			console.log('Error convert to client_site',err);
		})

	}
}(jQuery));

$.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex){
	var status = $('.selected').attr('status');
	//n=str.search(status);
	/*if(aData[4]==status){
		return true;
	}*/
	if(aData[4].search(status)>=0){
		return true;
	}
});

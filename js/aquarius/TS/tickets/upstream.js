myeditor = $('.myeditor').cleditor({width:'300',height:'100',controls:"bold italic underline | color highlight removeformat | bullets numbering"});

$('#btnaddupstream').click(function(){
	$("#btnupdateupstream_").hide();
	$("#btnsaveupstream").show();
	$("#upstream").val("");
	$("#ucomplaint").val("");
	$("#ureporter").val("");
	$("#ureporterphone").val("");
	$("#selectedClient tbody tr").remove();
	$('#dAddUpstream').modal();
});
$('#btnLookUp').click(function(){
	$('#dClientLookup').modal();
});
$('#clientLookup').dataTable({
	"bLengthChange":false
});
showDChildPic = function(obj,callback){
	$('#btnsaveupstream').attr("disabled","disabled");
	$("#picsitename").html("PIC untuk site "+obj.clientname);
	$("#childsite").val(obj.childsite);
	$("#childsiteaddress").val(obj.childsiteaddress);
	$("#childpic").val(obj.childpic);
	$("#childpicphone").val(obj.childpicphone);
	$('#dChildPic').modal({backdrop:'static'});
	console.log('Parody');
	callback();
}
$('#clientLookup').on('click','tbody tr',function(){
	var that = $(this);
	console.log('HTML',$(this).html());
	console.log('TRID',$(this).attr('trid'));
	$('#clientLookup tbody tr').removeClass('selected');
	that.addClass('selected');
	//$('#selectedClient tbody').append('<tr trid="'+that.attr('trid')+'" siteid="'+that.attr('siteid')+'" class="newClient"><td class="sname">'+$(this).find('.cName').html()+'</td><td class="saddress">'+$(this).find('.cAddress').html()+'</td><td class="removeClient">Hapus</td></tr>');
	//$('#dClientLookup').modal('hide');
	showDChildPic({
		clientname:that.find('.cName').html(),
		childsite:that.find('.cName').html(),
		childsiteaddress:that.find('.cAddress').html(),
		childpic:'',
		childpicphone:'',
		siteid:that.attr('siteid')
	},function(){
/*		$('#selectedClient tbody').append('<tr trid="'+that.attr('trid')+'" siteid="'+that.attr('siteid')+'" class="newClient"><td class="sname">'+that.find('.cName').html()+'</td><td class="saddress">'+that.find('.cAddress').html()+'</td><td class="removeClient">Hapus</td></tr>');*/
		$('#dClientLookup').modal('hide');
	});
});
$("#btnsavepic").click(function(){
	console.log("childpicphone",$("#childpicphone").val());
	console.log("childpic",$("#childpic").val());
	str = '<tr trid="'+$('#clientLookup tbody tr.selected').attr("trid")+'" siteid="'+$('#clientLookup tbody tr.selected').attr("siteid")+'" class="newClient">';
	str+='<td class="sname">'+$('#childsite').val()+'</td>';
	str+='<td class="saddress">'+$('#childsiteaddress').val()+'</td>';
	str+='<td class="spic">'+$('#childpic').val()+'</td>';
	str+='<td class="spicphone">'+$('#childpicphone').val()+'</td>';
	str+='<td class="removeClient">Hapus</td>';
	str+='</tr>';
	$('#selectedClient tbody').append(str);
	$('#btnsaveupstream').attr("disabled",false);
});
$('#selectedClient').on('click','tbody tr td.removeClient',function(){
	$(this).stairUp({level:1}).remove();
});
var suggests = {xl:"xl",is:"indosat",ip:"Iconplus",ni:"napinfo",la:"lintasarta",th:"tellon"};
$.ajax({
	url:thisdomain+"datacenters/get",
	dataType:"json"
}).done(function(datacenter){
	$.each(datacenter,function(x,y){
		//console.log("DATACENTER",x,y);
	});
});
$('#upstreamtype').change(function(){
	switch($(this).val()){
		case "backbone":
			$("#dudescription").show();
			console.log("BACKBONE SELECTED");
			$.ajax({
				url:thisdomain+"backbones/get",
				dataType:"json"
			}).done(function(backbone){
				$('#upstream').autocomp({
					data:backbone
				});			
			});
		break;
		case "bts":
			$("#dudescription").hide();
			console.log("BTS SELECTED");
			$.ajax({
				url:thisdomain+"pbtses/get",
				dataType:"json"
			}).done(function(bts){
				$('#upstream').autocomp({
					data:bts
				});			
			});
		break;
		case "datacenter":
			$("#dudescription").hide();
			console.log("DATACENTER SELECTED");
			$.ajax({
				url:thisdomain+"datacenters/get",
				dataType:"json"
			}).done(function(datacenter){
				$('#upstream').autocomp({
					data:datacenter
				});			
			});
		break;
		case "ptp":
			$("#dudescription").hide();
			console.log("PTP SELECTED");
			$.ajax({
				url:thisdomain+"ptps/gets",
				dataType:"json"
			}).done(function(ptp){
				$('#upstream').autocomp({
					data:ptp
				});			
			});
		break;
		case "core":
			$("#dudescription").show();
			console.log("CORE SELECTED");
			$.ajax({
				url:thisdomain+"cores/gets",
				dataType:"json"
			}).done(function(core){
				$('#upstream').autocomp({
					data:core
				});			
			});
		break;
		case "ap":
			$("#dudescription").show();
				console.log("AP SELECTED");
				$.ajax({
					url:"/paps/getplus",
					dataType:"json"
				}).done(function(ap){
					console.log("AP",ap)
					$('#upstream').autocomp({
						data:ap
					});			
				})
				.fail(function(err){
					console.log('Err',err);
				});
		break;
	}
});
switch($('.upstreamtype').val()){
	case "backbone":
		$("#dudescription").show();
			console.log("BACKBONE SELECTED");
			$.ajax({
				url:"/backbones/get",
				dataType:"json"
			}).done(function(backbone){
				$('#upstream').autocomp({
					data:backbone
				});			
			});
	break;
	case "bts":
		$("#dudescription").hide();
			console.log("BTS SELECTED");
			$.ajax({
				url:"/btses/get",
				dataType:"json"
			}).done(function(bts){
				$('#upstream').autocomp({
					data:bts
				});			
			});
	break;
	case "datacenter":
		$("#dudescription").hide();
			console.log("DATACENTER SELECTED");
			$.ajax({
				url:"/datacenters/get",
				dataType:"json"
			}).done(function(datacenter){
				$('#upstream').autocomp({
					data:datacenter
				});			
			});
	break;
	case "ptp":
		$("#dudescription").hide();
			console.log("PTP SELECTED");
			$.ajax({
				url:"/ptps/gets",
				dataType:"json"
			}).done(function(ptp){
				$('#upstream').autocomp({
					data:ptp
				});			
			});
	break;
	case "core":
		$("#dudescription").show();
			console.log("CORE SELECTED");
			$.ajax({
				url:"/cores/gets",
				dataType:"json"
			}).done(function(core){
				$('#upstream').autocomp({
					data:core
				});			
			});
	break;
	case "ap":
		$("#dudescription").show();
			console.log("AP SELECTED");
			$.ajax({
				url:"/paps/getplus",
				dataType:"json"
			}).done(function(ap){
				console.log(ap);
				$('#upstream').autocomp({
					data:ap
				});			
			})
			.fail(function(err){
				console.log("Error get ap",err)
			});
	break;
}
parentValidate = function(callback){
	let out = {result:true,message:[]};
	if($("#upstream").val().trim()===""){
		out.result = false;
		out.message.push('Client Name not selected');
	}
	if($("#ucomplaint").val().trim()===""){
		out.result = false;
		out.message.push("Komplain not filled");
	}
	if($("#ureporter").val().trim()===""){
		out.result = false;
		out.message.push("Reporter not filled");
	}
	callback(out)
}
$('#btnsaveupstream').click(function(){
	var dataproperty = {
				clientname:$("#upstream").val().trim(),
				requesttype:$("#upstreamtype :selected").text(),
				complaint:$("#ucomplaint").val(),
				reporter:$("#ureporter").val(),
				//ticketstart:$("#ticketstart").formatDate({inputFormat:"dd/MM/YYYY",outputFormat:"YYYY-MM-dd"}),
				reporterphone:$("#ureporterphone").val(),
			};
			switch($("#upstreamtype :selected").text().toLowerCase()){
				case "backbone":
					dataproperty.backbone_id=$("#upstream").attr("key");
					dataproperty.description=$("#udescription").val();
				break;
				case "bts":
					dataproperty.btstower_id=$("#upstream").attr("key");
				break;
				case "datacenter":
					dataproperty.datacenter_id=$("#upstream").attr("key");
				break;
				case "ptp":
				console.log("PTP KEY",$("#upstream").attr("key"));
					dataproperty.ptp_id=$("#upstream").attr("key");
				break;
				case "core":
				console.log("CORE KEY",$("#upstream").attr("key"));
					dataproperty.core_id=$("#upstream").attr("key");
					dataproperty.description=$("#udescription").val();
				break;
				case "ap":
				console.log("APS KEY",$("#upstream").attr("key"));
					dataproperty.ap_id=$("#upstream").attr("key");
					dataproperty.description=$("#udescription").text();
				break;
				default:
					console.log("x",$("#upstreamtype :selected").text());
				break;
			}
			parentValidate(function(validate){
				if(validate.result){
					console.log('Validate description',validate.message);
					$.ajax({
						url:thisdomain+'tickets/saves',
						data:dataproperty,
						type:'post'
					})
					.done(function(res){
						console.log("RESULT",res);
						var immediateFU = false;
								/*start test followup ticket*/
								switch($("#upstreamtype :selected").text().toLowerCase()){
									case "backbone":
										immediateFU = false;
									break;
									case "core":
										immediateFU = false;
									break;
									default:
										immediateFU = false;
									break;
								}
								if(immediateFU){
									$.post(thisdomain + 'ticket_followups/add', {
										ticket_id: res,
										result: '0',
										followUpDate: $(this).currentTime({format:"YYYY-MM-dd HH:mm:ss"}),//getdate('sql','00:00:00'),
										picname: $("#ureporter").val(),
										description: $("#udescription").val(),
										confirmationresult: '-',
										position: '-',
										picphone: $("#ureporterphone").val(),
										username: $('#createuser').val()
									}).done(function (data) {
										console.log("TEST FOLLOUWYP TICKET",data);
	
									}).fail(function () {
										console.log('Tidak bisa mengupdate Follow Up, silakan hubungi Developer');
									});						
								}
							/*end test followup ticket*/
						
						
						$("#selectedClient tbody tr").each(function(){
							var that = $(this);
							console.log("NAME",that.find(".sname").html());
							console.log("CLIENTID",that.attr("trid"));
							console.log("that.find(.spic).html()",that.find(".spic").html())
							$.ajax({
								url:thisdomain+'tickets/saves',
								data:{
									"clientname":that.find(".sname").html()+"("+$("#upstreamtype :selected").text()+"-"+$("#upstream").val()+")",
									"client_id":that.attr("trid"),
									"client_site_id":that.attr("siteid"),
									"parentid":res,
									"requesttype":"pelanggan",
									"reporter":that.find(".spic").html(),
									"reporterphone":that.find(".spicphone").html(),
									"description":dataproperty.description
								},
								type:'post'
							})
							.done(function(resu){
								console.log("RESU",resu);
								//updateRecordRow();
							})
							.fail(function(err){
								console.log("fail to save upstream children",err);
							});
						});
						updateRecordRow();
					})
					.fail(function(err){
						console.log("Fail save upstream parent__",err);
					});
				}else{
						let warnings = '';
						$.each(validate.message,function(index,message){
							console.log("Message",message);
							warnings += message; 
						})
	
						

						confirmation({
						btn1value:'OK',btn2value:false,
						button1function:function(){
							console.log("OK bro");
						},
						button2function:function(){
							console.log("No Bro");
						},
						modalTitle:'Warning:'+validate.message.map(function(message,index){return message}),
						confirmationLabel:'Data Belum Lengkap'
					});
					console.log('Validate message',validate.message);
				}
			})
});
$('#btnupdateupstream_').click(function(){
	console.log("DESCRIPTION",$("#udescription").val());
	var parentid = $("#tbl_ticket tbody tr.selected").attr("thisid");
	console.log("COMPLAINT",$("#complaint").val());
	console.log("REPORTER",$("#reporter").val());
	console.log("REPORTERPHONE",$("#reporterphone").val());
	


	


	$("#selectedClient tbody tr.newClient").each(function(){
		var that = $(this);
		console.log("NAME",that.find(".sname").html());
		console.log("CLIENTID",that.attr("trid"));
		console.log("siteID",that.attr("siteid"));
		$.ajax({
			url:thisdomain+'tickets/saves',
			data:{
				"clientname":that.find(".sname").html()+"("+$("#upstreamtype :selected").text()+"-"+$("#upstream").val()+")",
				"client_id":that.attr("trid"),
				"client_site_id":that.attr("siteid"),
				"parentid":parentid,
				"requesttype":"pelanggan",
				"reporter":"pelanggan komplain",
			},
			type:'post'
		})
		.fail(function(){
			console.log("fail to save upstream children");
		})
		.done(function(ticketid){
			updateRecordRow();
		});
	});
//	updateRecordRow();




/*
		$.ajax({
			url:'/tickets/parentupdate',
			data:{
				id:parentid,
//				status:$("#eUpstreamStatus").val(),
				status:"0",
				clientname:$("#upstream").val(),
				requesttype:$("#upstreamtype :selected").text(),
				complaint:$("#ucomplaint").val(),
				reporter:$("#ureporter").val(),
				reporterphone:$("#ureporterphone").val(),
				//downtimestart:"0000-00-00 00:00:00",
				//downtimeend:"0000-00-00 00:00:00",
				description:$("#udescription").val()
			},
			type:'post'
		})
		.done(function(res){
			console.log("RESULT",res);
			$("#selectedClient tbody tr.newClient").each(function(){
				var that = $(this);
				console.log("NAME",that.find(".sname").html());
				console.log("CLIENTID",that.attr("trid"));
				console.log("siteID",that.attr("siteid"));
				$.ajax({
					url:thisdomain+'tickets/saves',
					data:{
						"clientname":that.find(".sname").html()+"("+$("#upstreamtype :selected").text()+"-"+$("#upstream").val()+")",
						"client_id":that.attr("trid"),
						"client_site_id":that.attr("siteid"),
						"parentid":parentid,
						"requesttype":"pelanggan",
						"reporter":"pelanggan komplain",
//						"downtimestart":"0000-00-00 00:00:00",
//						"downtimeend":"0000-00-00 00:00:00"
					},
					type:'post'
				})
				.fail(function(){
					console.log("fail to save upstream children");
				})
				.done(function(ticketid){
					//updateRecordRow();
				});
			});
			updateRecordRow();
		})
		.fail(function(){
			console.log("Fail save upstream parent__");
		});

		*/
});

/*
 * WRITTEN BY PUJI W PRAYITNO
 * 062015
 * mailto : puji@padi.net.id
 * */
$(".ticketdatepicker").datepicker({dateFormat:'yy-mm-dd'});
$.fn.modal.Constructor.prototype.enforceFocus = function () {};
$.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
		var iMin = document.getElementById('min').value;
		var iMax = document.getElementById('max').value;
		var iDatestart = aData[4];
			if(iMin==""&&iMax==""){
			return true;
		}else if(iMin<=iDatestart&&iDatestart<=iMax){
			return true;
		}else{
			return false;
		}
	}
);
getduration = function(_start,_end){
	if(!_end){
		return _start;
	}else{
		_diff = _end - _start;
		seconds = parseInt(_diff/1000);
		minutes = parseInt(seconds / 60);
		hours = parseInt(minutes / 60);
		days = parseInt(hours / 24);
		hari = parseInt(_diff/(1000*60*60*24));
		sisahari = parseInt(_diff % (1000*60*60*24));
		sisamenit = parseInt(minutes % 60);
		sisadetik = parseInt(seconds % 60);
		sisajam = parseInt(hours % 24);
		//console.log("sisajam+sisadetik "+sisajam+':'+sisadetik);
		return days + " hari,"+ sisajam + " jam,"+ sisamenit + " menit," + sisadetik + " detik";
	}
}
getduration2 = function(obj,callback){
	if(!obj.end){
		return _start;
	}else{
		_diff = obj.end - obj.start;
		seconds = parseInt(_diff/1000);
		minutes = parseInt(seconds / 60);
		hours = parseInt(minutes / 60);
		days = parseInt(hours / 24);
		hari = parseInt(_diff/(1000*60*60*24));
		sisahari = parseInt(_diff % (1000*60*60*24));
		sisamenit = parseInt(minutes % 60);
		sisadetik = parseInt(seconds % 60);
		sisajam = parseInt(hours % 24);
		//console.log("sisajam+sisadetik "+sisajam+':'+sisadetik);
		callback({
			dayval:days,
			str:days + " hari,"+ sisajam + " jam,"+ sisamenit + " menit," + sisadetik + " detik"
		});
	}
}

getdayduration = function(_start,_end){
	if(!_end){
		return _start;
	}else{
		_diff = _end - _start;
		seconds = parseInt(_diff/1000);
		minutes = parseInt(seconds / 60);
		hours = parseInt(minutes / 60);
		days = parseInt(hours / 24);
		hari = parseInt(_diff/(1000*60*60*24));
		//console.log("days ",days);
		return days;	
}
}
var tTicket = $("#tbl_ticket").dataTable({
	"aaSorting":[[0,'desc']],
	"sDom": '<"toolbar">lBfrtip',
	"aoColumnDefs":[
		{"bVisible":false,"aTargets":[2]},
		{"bVisible":false,"aTargets":[4]},
		{"bVisible":false,"aTargets":[9]},
		{"bVisible":false,"aTargets":[10]},
		{"bVisible":false,"aTargets":[11]},	],

	"sPaginationType": "full_numbers","bPaginate":true
}),allowToCloseTicket = false;
buttons = '<div class="btn-group">';
buttons+= '<button class="btn" id="showalltickets">All</button>';
buttons+= '<button class="btn" id="showopentickets">Open</button>';
buttons+= '<button class="btn" id="showclosedtickets">Closed</button>';
buttons+= '</div>';
$("div.toolbar").html(buttons);
$("#showalltickets").click(function(){
	console.log("Show All Tickets clicked");
	//window.location.href = '/tickets?isopen=all';
	tTicket.fnFilter("");
})




$('#btnDateFilterTrig').click(function(){
	console.log('Min',$('#min').val());
	console.log('Max',$('#max').val());
	tTicket.fnDraw();
	$('#dDateFilter').modal('hide');
});
$('#btnDateFilterReset').click(function(){
	$('.ticketdatepicker').val('');
	tTicket.fnDraw();
	$('#dDateFilter').modal('hide');
});


$("#showopentickets").click(function(){
	console.log("Show Open Tickets clicked");
	//window.location.href = '/tickets?isopen=yes';
	tTicket.fnFilter("open");
})
$("#showclosedtickets").click(function(){
	console.log("Show Closed Tickets clicked");
	//window.location.href = '/tickets?isopen=no';
	tTicket.fnFilter("closed");
})
$("#btnchoosebranch").click(function(){
	console.log("Pilih cabang");
	$("#dChooseBranch").modal();
});
$(".togglebranch").click(function(){
	checked = !checked;
});
$('.hist_description').click(function(){
	console.log('DESCRUOTUOO',this.attr('ticket_id'));
});
$('.btnhelp').click(function(){
	if($('#bcExp').is(":visible")){
		$('#bcExp').fadeOut(200);
	}else{
		$('#bcExp').fadeIn(200);
	}
});
$('#btnshowdatefilter').click(function(){
	$("#dDateFilter").modal();
});

/*$.ajax({
	url:'/tickets/get_obj_by_id/'+urlsegment(4),
	dataType:'json'
}).done(function(tckt){
	tTicket.fnFilter(tckt.kdticket);
});*/
$('#btnCleanFilter').click(function(){
	$(".ticketdatepicker").val("");
	tTicket.fnFilter("");
});
checkOkReq = function(){
	var notok = false;
	$('.okreq').each(function(){
		if((!this.value.length) || ($('#fuDescription').val().length === 0)){
			notok = true;
		}
		if((!this.value.length) || ($('#followUpPIC').val().length === 0)){
			notok = true;
		}
		if((!this.value.length) || ($('#picPosition').val().length === 0)){
			notok = true;
		}
		if($('#solusi').val().length === 4){
			notok = true;
		}
		if($('#followUpDate').val().length === 0){
			notok = true;
		}
		if($('#cause').val() === '0'){
			notok = true;
		}
	});
	if (notok){
		return false;
	}else{
		return true;
	}
}
$('#causecategory').change(function(){
	console.log("changed category",$(this).val());
	if(parseInt($(this).val())===0){
		console.log('PRESST');
		$('#cause').empty();
		$('#cause').append('<option>Pilihlah</option>')
		$('#dothercouse').hide();
	}else{
		console.log('YYYYYYYYYYY');
	$.ajax({
		url:'/tickets/getticketcausecategory/'+$(this).val(),
		type:'POST',
		dataType:'json'
	})
	.done(function(data){
		console.log(data)
		$('#cause').empty();
		opt = '';
		$.each(data,function(x,y){
			opt+='<option value="'+y.id+'">'+y.name+'</option>';
		});
		$(opt).appendTo($('#cause'));

	})
	.fail(function(err){
		console.log(err)
	})
}})
$('#cause').change(function(){
	switch($('#cause :selected').text()){
		case 'Lainnya':
			$('#dothercouse').show();
			$('#othercause').addClass('inp_ticket');
			$('#cause').removeClass('inp_ticket');
		break;
		default:
			$('#dothercouse').hide();
			$('#othercause').removeClass('inp_ticket');
			$('#cause').addClass('inp_ticket');
		break;
	}
});
checkBelumOkReq = function(){
	var notbelumok = false;
	$('.okreq').each(function(){
		if($('#fuDescription').val().length === 4){
			notbelumok = true;
		}
		if($('#followUpDate').val().length === 0){
			notbelumok = true;
		}
		if($('#cause').val() === 0){
			notbelumok = true;
		}
	});
	if (notbelumok){
		return false;
	}else{
		return true;
	}
}
checkBelumBisaDihubungiReq = function(){
	var not_oke = false;
	$('.okreq').each(function(){
		this.focus();
	});
	if($('#picPosition').val().length===0){
		console.log('pic position belum diisi');
		not_oke = true;
	}
	if($('#followUpPIC').val().length===0){
		console.log('followup pic belum diisi');
		not_oke = true;
	}
	if($('#fuDescription').val().length === 0){
		console.log('fuDescription belum diisi');
		not_oke = true;
	}
	if(($('#fuDescription').val().length === 4) && ($('#fuDescription').val() === '<br>')){
		console.log('fuDescription belum diisi');
		not_oke = true;
	}
	if($('#solusi').val().length === 0){
		console.log('solusi a belum diisi');
		not_oke = true;
	}
	if(($('#solusi').val().length === 4) && ($('#solusi').val() === '<br>')){
		console.log('solusi b belum diisi');
		not_oke = true;
	}
	if($('#followUpDate').val().length === 0){
		console.log('followupdate belum diisi');
		not_oke = true;
	}
	if($('#cause').val() === '0'){
		console.log('cause is pilihlah',$(this).attr('id'));
		not_oke = true;
	}
	if (not_oke){
		console.log('false');
		return false;
	}else{
		console.log('true');
		return true;
	}
}

cleanInput = function(){
	setTimeout(function(){
		//$('#followUpPIC').val("");
		//$('#picPosition').val("");
		$('#picPhone').val("");
		$('#fuDescription').attr("value","").blur();
		$('#confirmationresult').val("").blur();
		$('#solusi').val("").blur();
		$('#datepicker').val("");
		//$('#followUpDate').val("");
		$('#futs').val("");
		$('#fute').val("");
		$('#followUpHour').val("00");
		$('#futsh').val("00");
		$('#futsm').val("00");
		$('#futeh').val("00");
		$('#futem').val("00");
		$('#followUpMinute').val("00");
		$('#dFollowUp').find('#fuDescription').val('');
		$('#othercouse').val("");
		$('#causecategory').val(0);
		$('#causecategory').change();
		var d = new Date(),out = '',year = d.getFullYear(), month = d.getMonth()+1, date = d.getDate();
		$('#followUpDate').val(date+'/'+month+'/'+year);
		console.log('fuDescription',$('#fuDescription').val());
		console.log('fuDescription',$('#fuDescription').val());
		console.log('solusi',$('#solusi').val());
		console.log('confirmationresult',$('#confirmationresult').val());
	},0);
}
$("#btnaddticket").click(function(){
	$('#complain option').each(function(x,y){
		if(x===0){
			$(this).prop('selected','selected');
		}
	});
	$('#autocomplete-pelanggan').val('');
	$('#autocomplete-backbone').val('');
	$('#autocomplete-bts').val('');
	$('#autocomplete-datacenter').val('');
	$('#reporter').val("");
	$('#reporterphone').empty();
	$('#client_id').empty();
	$('#csites').empty();
	$("#dAddTicket").modal();
});
$('#btnHistory').click(function(){
	var mytr = $('#tbl_ticket').find('tbody tr.selected'),
		clientname = mytr.find('td.clientname').text(),
		id = mytr.attr('thisid'),
		kdticket = mytr.find('td.kdticket').text();
	showFollowupHistory(clientname,id,kdticket);
});
$('#btn_saveupstream').click(function(){
		$('#upstreamtable tbody tr').each(function(){
			console.log($(this).attr('thisid'));
		});	
});
$("#btnsaveticket").click(function () {
	$(".inp_ticket").makekeyvalparam();
	console.log('inp_ticket',$(".inp_ticket").attr('keyval'));
	$.ajax({
		url: '/tickets/save',
		data: JSON.parse('{' + $(".inp_ticket").attr("keyval") + ',"clientname":"' + $("#client_id :selected").text() + '","downtimestart":"0000-00-00 00:00:00","downtimeend":"0000-00-00 00:00:00"}'),
		type: 'post',
		async: false
	}).fail(function (err) {
		console.log('Tidak dapat menyimpan data, silakan hubungi mas Developer',err);
	}).done(function (data) {
		$.ajax({
			url: '/tickets/get_obj_by_id/' + data,
			type: 'get',
			async: false,
			dataType: 'json',
		}).done(function (newticket) {
			ticketMailTemplate({
				url:'/tickets',
				data:data,
				clientname:$("#client_id :selected").text(),
				createuser:$('#createuser').val()
			},function(bodytext){
				sendmail(tsmail,"Pemberitahuan ticket baru",bodytext,developermail);
			});
			updateRecordRow();
			$('#dAddTicket').modal('hide');
		});
	});
});
sendmail = function(recipient,subject,bodycontent,copycarbon){
	$.ajax({
		url:"/adm/sendnotificationmail",
		data:{
			"recipient":recipient,
			"subject":subject,
			"body":bodycontent,
			"cc":copycarbon
		},
		type:"post",
		async:false
	}).done(function(res){
		return true;
	}).fail(function(err){
		console.log('gagal',err);
		return false;
	});	
}
$('#request_type').change(function(){
				var _this = $(this);
				myref = _this.find("option:selected").text();
				console.log(_this.val());
			});
$("#requesttype").change(function(){
	populateAllCombos($(this));
});
$('#tbl_ticket').on('click','tr .btndowntime',function(){
	$('#dDowntime').modal();
})
$('#tbl_ticket').on('click', 'tr .btnfollowup', function () {
	$("#tbl_ticket").find("tbody tr").removeClass("selected");
	$(this).stairUp({level: 4}).addClass("selected");
	var id = $('#tbl_ticket tbody tr.selected').attr('thisid');
	var kdticket = $('#tbl_ticket tbody tr.selected td:first').html();
	var clientname = $('#tbl_ticket tbody tr.selected td.clientname').html();
	$('#btnCloseTicket').attr('myid', id);
	$('#btnCloseTicket').prop('disabled', true);
	$('#btnProgress').prop('disabled', true);
	$('#followUpModalLabel').text("Follow Up : " + clientname + ' (' + kdticket + ')');
	//cleanInput();
	console.log('Complete URL','/tickets/get_obj_by_id/'+$("#tbl_ticket tbody tr.selected").attr("thisid"));
	$.ajax({
		url:'/tickets/get_obj_by_id/'+$("#tbl_ticket tbody tr.selected").attr("thisid"),
		type:'get',
		dataType:'json'
	}).done(function(data){
		var causereguler=false;
		console.log('DATA',data);
		console.log('CAUSE',data.cause);
		$('#followUpModalLabel').text("Follow Up : " + data.clientname + ' (' + data.kdticket + ')');
		$('#cause option').each(function(opt){
			//console.log('TEXT',$(this).text(),$(this).val());
			if($(this).text()===data.cause){
				causereguler=true;
			}
		});
		if(causereguler===true){
			$('#cause').addClass('inp_ticket');
			$('#cause').show();
			$('#dothercouse').hide();
			$('#othercause').removeClass('inp_ticket');
			$('#cause').select_text({"compared":data.cause,"casesensitif":false});
		}else{
			$('#cause').removeClass('inp_ticket');
			$('#cause').val('18');
			$('#dothercouse').show();
			$('#othercause').addClass('inp_ticket');
			$('#othercause').val(data.cause);
		}
		if(data.downtimestart==""){
			data.downtimestart = "1900-01-01 00:00:00";
		}
		if(data.downtimeend==""){
			data.downtimeend = "1900-01-01 00:00:00";
		}
		$('#reporter').html(data.reporter);
		$('#reporterphone').html(data.reporterphone);
		$("#followUpPIC").val(data.reporter);
		$("#picPosition").val(data.reporterphone);
		/*var startdate = data.downtimestart.split(" ");
		daydate = startdate[0].split("-");
		$('#reporter').html(data.reporter);
		$('#reporterphone').html(data.reporterphone);
		$("#futs").val(daydate[2]+"/"+daydate[1]+"/"+daydate[0]);
		daytime = startdate[1].split(":");
		$("#futsh option").each(function(){
			if($(this).val()===daytime[0]){
				$(this).attr("selected","selected");
			}
		});
		$("#futsm option").each(function(){
			if($(this).val()===daytime[1]){
				$(this).attr("selected","selected");
			}
		});
		var enddate = data.downtimeend.split(" ");
		daydate = enddate[0].split("-");
		$("#fute").val(daydate[2]+"/"+daydate[1]+"/"+daydate[0]);
		daytime = startdate[1].split(":");
		$("#futse option").each(function(){
			if($(this).val()===daytime[0]){
				$(this).attr("selected","selected");
			}
		});
		$("#futse option").each(function(){
			if($(this).val()===daytime[1]){
				$(this).attr("selected","selected");
			}
		});*/
		$('#ticketcontent').html(data.complaint);
		if(data.is_ok==='yes'){
			allowToCloseTicket = true;
		}else{
			allowToCloseTicket = false;
		}
		$('#cause').val(0);
		$('#causecategory').val(0);
		var d = new Date(),out = '',year = d.getFullYear(), month = d.getMonth()+1, date = d.getDate();
		$('#followUpDate').val(date+'/'+month+'/'+year);
		
		$('#dFollowUp').modal();
	}).fail(function(err){
		console.log('Tidak dapat retrieve ticketjson',err);
	});
});
$('#dFollowUp').on('show.bs.modal',function(){
	console.log('Follow up moda Invoked');
	cleanInput();
})
getCurdate = function(callback){
	const d = new Date();
	callback(d.getFullYear()+'-'+(1*d.getMonth()+1)+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds());
}
$('#btnCloseTicket').click(function () {
	//if(!checkOkReq()){
	if(!validate()){
		alert('Data belum lengkap');
		$('#btnCloseTicket').prop('disabled', true);
	}else{
		var cause='';
		if($('#cause :selected').text()==='Lainnya'){
			cause = $('#othercause').val();
			cause_id = '0';
		}else{
			cause = $('#cause :selected').text();
			cause_id = $('#cause').val();
		}
		console.log('SOLUTION CONTENT',$('#solusi').val());



		fudate = $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime');
		//dts = $('#futs').getdate().addhour($('#futsh')).addminute($('#futsm')).attr('datetime');
		//dte = $('#fute').getdate().addhour($('#futeh')).addminute($('#futem')).attr('datetime');


		dr = $('#tbl_ticket tbody tr.selected').attr('ticketstart')


	//	dr = $(this).attr("ticketstart");
		dttime = dr;
		dttimesplit = dttime.split(" ");
		dt = dttimesplit[0].split("/");
		year = dt[2];
		month = dt[1]-1;
		day = dt[0];
		tm = dttimesplit[1].split(":");
		hour = tm[0];
		minute = tm[1];
		second = tm[2];
		_start = new Date(year,month,day,hour,minute,second);
		_end = new Date();

		getCurdate(function(curdate){
			getduration2({start:_start,end:_end},function(_duration){
				//console.log('Duration got',_duration);
				$.ajax({
					url: '/tickets/update',
					data:{
						id:$('#tbl_ticket tbody tr.selected').attr('thisid'),
						cause:cause,cause_id:cause_id,status:'1',mailsent:'2',solution:$('#solusi').val(),
						downtimestart:'0000-00-00 00:00:00',
						downtimeend:'0000-00-00 00:00:00',
						duration:_duration.dayval,ticketend:curdate
					},
					type: 'post',
					async: false
				})
				.done(function (data) {
					$('#tbl_ticket tbody tr td.kdticket .status').html('Closed');
					$.post('/ticket_followups/add', {
						ticket_id: $('#tbl_ticket tbody tr.selected').attr('thisid'),
						result: '1',
						cause_id:cause_id,
						followUpDate: $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime'),
						picname: $('#followUpPIC').val(),
						description: $('#fuDescription').val(),
						position: $('#picPosition').val(),
						picphone: $('#picPhone').val(),
						username: $('#createuser').val(),
						confirmationresult: $('#confirmationresult').val(),
						conclusion:$('#solusi').val()
					}).done(function (fu) {
						console.log("Follow Up disimpan dengan status CLOSE");
						$("#tbl_ticket tbody tr.selected .btnfollowup").remove();
						$("#tbl_ticket tbody tr.selected .ticketaction").attr('disabled','disabled');
						$("#tbl_ticket tbody tr.selected").removeClass('ticketOpen');
						$("#tbl_ticket tbody tr.selected").addClass('ticketClosed');
						/*start test update upstream client*/
						$.ajax({
							url:'/tickets/closeUpstreamClients/'+$('#tbl_ticket tbody tr.selected').attr('thisid')
							//dataType:"json"
						})
						.done(function(res){
							console.log("UDAH KE UPDATE OY",res);
							//set the presentation layer
							$.ajax({
								url:'/tickets/getUpstreamClients/'+$('#tbl_ticket tbody tr.selected').attr('thisid'),
								dataType:"json"
							})
							.done(function(res){
								for(var i=0;i<res.length;i++){
									$("#tbl_ticket tbody tr[thisid="+res[i].id+"]").removeClass("ticketOpen");
									$("#tbl_ticket tbody tr[thisid="+res[i].id+"]").addClass("ticketClosed");
									$("#tbl_ticket tbody tr[thisid="+res[i].id+"] .ticketaction").attr("disabled","disabled");
									console.log("CLIENT OF UPSTREAM",res[i].clientname);
								}
								$.ajax({
									url:'/tickets/updatechildren/'+$('#tbl_ticket tbody tr.selected').attr('thisid'),
									type:'get'
								}).done(function(res){
									console.log('Success updatechildren',res);
									updateAffectedFUChildren({ticket_id:$('#tbl_ticket tbody tr.selected').attr('thisid'),cause_id:cause_id},function(){
										$('#dFollowUp').modal('hide');
									});
								})
								.fail(function(err){
									console.log('Error updatechildren',err);
								})
								;
							})
							.fail(function(err){
								console.log("ERR",err);
							});
						})
						.fail(function(err){
							console.log("ERR",err);
						});
						
						/*end test update upstream client*/
						cleanInput();
					}).fail(function(err) {
						console.log('Tidak bisa mengupdate Follow Up, silakan hubungi Developer',err);
					});
				}).fail(function(err) {
					console.log('Tidak bisa mengupdate Ticket, silakan hubungi Developer',err);
				});
		
			})
	
		})
	}
});
$('#btnOK').click(function () {
	//if(!checkOkReq()){
	if(!validate()){
		alert('Data belum lengkap');
		$('#btnCloseTicket').prop('disabled', true);
	}else{
		if(allowToCloseTicket){
			$('#btnCloseTicket').prop('disabled', false);
			$('#btnProgress').prop('disabled', true);
		}else{
			$(this).showModal({
				element:'dWarn',
				title : 'Konfirmasi',
				titleElement : 'myModalLabel',
				labelElement : 'modalMessage',
				labelAlignment:'center',
				message : 'Ticket tidak dapat diclose karena masih ada troubleshoot yang belum solve',
				expire : 3000,
				nextUrl : 'null'				
			});			
		}
	}
});
$('#btnNotOK').click(function () {
	//if(!checkBelumOkReq()){
	if(!validate()){
		alert('Data belum lengkap');
		$('#btnProgress').prop('disabled', true);
	}else{
		$('#btnCloseTicket').prop('disabled', true);
		$('#btnProgress').prop('disabled', false);
	}
});
getChildren = function(obj,callback){
	$.ajax({
		url:'/tickets/getchildren',
		data:{id:obj.ticket_id},
		type:'post',
		dataType:'json'
	})
	.done(function(children){
		console.log('Children',children);
		callback(children);
	})
	.fail(function(err){
		console.log('Error got children',err);
		callback([]);
	})
}
updateAffectedChildren = function(obj){
	console.log("OBJ retrieved",obj);
	getChildren(obj,function(children){
		$.each(children,function(x,y){
			$.ajax({
				url: '/tickets/updatebyfollowup',
				data:{
					id:y.id,
					cause:obj.cause,cause_id:obj.cause_id,status:'0',
					solution:obj.solution,downtimestart:'0000-00-00 00:00:00',downtimeend:'0000-00-00 00:00:00',
					mailsent:'0'
				},
				type: 'post',
				async: false
			}).fail(function (err) {
				console.log('Tidak dapat menyimpan data, silakan hubungi Developer A',err);
			}).done(function (data) {
				//cleanInput();
				console.log("data",data);
			});	
		})
	});
}
updateAffectedFUChildren = function(obj,callback){
	getChildren(obj,function(children){
		$.each(children,function(x,y){
			console.log('child ...',x,y);
			$.ajax({
				data:{
					ticket_id: y.id,
					result: '0',
					followUpDate: $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime'),
					picname: $('#followUpPIC').val(),
					description: $('#fuDescription').val(),
					confirmationresult: $('#confirmationresult').val(),
					position: $('#picPosition').val(),
					picphone: $('#picPhone').val(),
					username: $('#createuser').val(),
					conclusion:$('#solusi').val(),
					cause_id:obj.cause_id
				},
				type:'post',
				url:'/ticket_followups/add'
			})
			.done(function(data){
				console.log('success update affected children',data);
				callback()
			})
			.fail(function(err){
				console.log('success update affected children',err);
			});		
		})
	})
}
$('#btnProgress').click(function () {
	if(!validate()){
		alert('data harus lengkap');
	}else{
		fudate = $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime');
		//dts = $('#futs').getdate().addhour($('#futsh')).addminute($('#futsm')).attr('datetime');
		//dte = $('#fute').getdate().addhour($('#futeh')).addminute($('#futem')).attr('datetime');
		//alert("solution"+$("#solusi").val());
			var cause='';
			if($('#cause :selected').text()==='Lainnya'){
				cause = $('#othercause').val();
				cause_id = '0';
			}else{
				cause = $('#cause :selected').text();
				cause_id = $('#cause').val();
			}
		$.post('/ticket_followups/add', {
			ticket_id: $('#tbl_ticket tbody tr.selected').attr('thisid'),
			result: '0',
			followUpDate: $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime'),
			picname: $('#followUpPIC').val(),
			description: $('#fuDescription').val(),
			confirmationresult: $('#confirmationresult').val(),
			position: $('#picPosition').val(),
			picphone: $('#picPhone').val(),
			username: $('#createuser').val(),
			conclusion:$('#solusi').val(),
			cause_id:$('#cause').val()
		}).done(function (data) {



			$.ajax({
				url: '/tickets/updatebyfollowup',
				data:{
					id:$('#tbl_ticket tbody tr.selected').attr('thisid'),
					cause:cause,cause_id:cause_id,
					status:'0',solution:$('#solusi').val(),downtimestart:'0000-00-00 00:00:00',downtimeend:'0000-00-00 00:00:00',mailsent:'0'
				},
				type: 'post',
				async: false
			}).fail(function (err) {
				console.log('Tidak dapat menyimpan data, silakan hubungi Developer A',err);
			}).done(function (data) {
				/*updateAffectedChildren({
					ticket_id:$('#tbl_ticket tbody tr.selected').attr('thisid'),
					cause:cause,
					cause_id:cause_id,
					status:'0',
					solution:$('#solusi').val(),
					downtimestart:'0000-00-00 00:00:00',downtimeend:'0000-00-00 00:00:00',
					mailsent:'0'
				});*/
				$.ajax({
					url:'/tickets/updatechildren/'+$('#tbl_ticket tbody tr.selected').attr('thisid'),
					type:'get'
				}).done(function(res){console.log('Success updatechildren',res)})
				.fail(function(err){console.log('Error updatechildren',err);});

				console.log("data",data);
			});

			updateAffectedFUChildren({ticket_id:$('#tbl_ticket tbody tr.selected').attr('thisid'),cause_id:cause_id},function(){
				$(".inp_futicket").makekeyvalparam();
				$(".inp_futicket_").getdate();
				console.log("id",$("#tbl_ticket tbody tr.selected").attr("thisid"));
				//console.log("DTS",dts,"DTE",dte);
				//console.log("INP_FUTICKET",$(".inp_futicket").attr("keyval"));
					console.log("Follow Up disimpan dengan status PROGRESS");
	
			})
		}).fail(function () {
			console.log('Tidak bisa mengupdate Follow Up, silakan hubungi Developer');
		});
		$('#dFollowUp').modal('hide');
	}
});
$('#btnReset').click(function(){
	cleanInput();
});
$('#btnCouldNotBeContacted').click(function(){
	//if(!checkBelumBisaDihubungiReq()){
		if(!validate()){
		alert('Data harus lengkap');
	}else{
		fudate = $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime');
		var cause='';
		if($('#cause :selected').text()==='Lainnya'){
			cause = $('#othercause').val();
		}else{
			cause = $('#cause :selected').text();
		}
		$.post('/ticket_followups/add', {
			ticket_id: $('#tbl_ticket tbody tr.selected').attr('thisid'),
			result: '3',
			followUpDate: $('#followUpDate').getdate().addhour($('#followUpHour')).addminute($('#followUpMinute')).attr('datetime'),
			picname: $('#followUpPIC').val(),
			description: $('#fuDescription').val(),
			position: $('#picPosition').val(),
			picphone: $('#picPhone').val(),
			username: $('#createuser').val(),
			conclusion:$('#solusi').val()
		}).done(function (data) {
		$(".inp_futicket").makekeyvalparam();
		console.log("id",$("#tbl_ticket tbody tr.selected").attr("thisid"));
		console.log("INP_FUTICKET",$(".inp_futicket").attr("keyval"));
			$.ajax({
				url: '/tickets/update',
				data: JSON.parse('{' + $(".inp_futicket").attr("keyval") + ',"id":"'+$("#tbl_ticket tbody tr.selected").attr("thisid")+'","cause":"'+cause+'"}'),
				type: 'post',
				async: false
			}).fail(function (err) {
				console.log('Tidak dapat menyimpan data, silakan hubungi Developer B',err);
			}).done(function (data) {
				cleanInput();
				console.log("data",data);
			});
			console.log("Follow Up disimpan dengan status PROGRESS");
		}).fail(function () {
			console.log('Tidak bisa mengupdate Follow Up, silakan hubungi Developer');
		});
		$('#dFollowUp').modal('hide');
	}
});
$('#dFollowUp').on('hidden.bs.modal',function(){
	//cleanInput();
});
show_description = function(ticket_id){
	$.ajax({
		url:'/tickets/getinfo/'+ticket_id,
		type:'get',
		dataType:'json'
	}).done(function(ticketinfo){
		console.log("TicketInfo",ticketinfo);
		$('#complaintcontent').html(ticketinfo.result[0].complaint);
		$('#causecontent').html(ticketinfo.result[0].maincause);
		$('#descriptioncontent').html(ticketinfo.result[0].description);
		$('#solutioncontent').html(ticketinfo.result[0].conclusion);
		$('#downtime').html(ticketinfo.result[0].downtime);
		$('#confirmationresultcontent').html(ticketinfo.result[0].confirmationresult);
		$('#mainrootcause').html(ticketinfo.result[0].maincause);
		$('#subrootcause').html(ticketinfo.result[0].subcause);
		$('#dDescription').modal();																							
	});
}
show_fu_description = function(id){
	$.ajax({
		url:'/tickets/getfuinfo/'+id,
		type:'get',
		dataType:'json'
	})
	.done(function(ticketinfo){
		console.log("TicketInfo",ticketinfo);
		$('#complaintcontent').html(ticketinfo[0].complaint);
		$('#causecontent').html(ticketinfo[0].maincause);
		$('#descriptioncontent').html(ticketinfo[0].description);
		$('#solutioncontent').html(ticketinfo[0].conclusion);
		$('#confirmationresultcontent').html(ticketinfo[0].confirmationresult);
		$('#mainrootcause').html(ticketinfo[0].maincause);
		$('#subrootcause').html(ticketinfo[0].subcause);
		$('#dDescription').modal();																							
	})
	.fail(function(err){
		console.log('Err showfudesc',err);
	});
}
showFollowupHistory = function(clientname,id,kdticket){
	$('#myHistoryModalLabel').text('Histori Follow Up : [Nama : ' + clientname + ' Kode Ticket : ' + kdticket + '] ');
		$.ajax({
			url:'/tickets/getTicketComplaint/'+id,
			type:'get',			
		})
		.done(function(cmp){
			$('#complaint').html('KELUHAN : '+cmp);
			console.log('complaint',id,cmp);
			oHistory = $('#tblHistory').dataTable({
				"bProcessing": true,
				"sAjaxSource": "/tickets/ajaxHistory/" + id,
				"aoColumns": [
					{"mData": "followUpDate"},
					{"mData": "picname"},
					{"mData": "position"},
					{"mData": "picphone"},
					{"mData": "status"},
					{"mData": "username"},
					//{ "sWidth": "95px", "sClass": "hist_description" ,"fieldName":"description"}
					{"mData": "description"}
				],
				"bSort": true, "bFilter": false, "bInfo": false, "bPaginate": false, "bDestroy": true
			});
			oHistory.fnSort([[0,'desc']]);
			$('#dFollowUpHistory').modal();

		});	
}
$('.tickettable').on('click', 'tr .clientname', function () {
	var clientname = $(this).text(),
		id = $(this).parent().attr('thisid'),
		kdticket = $(this).prev().text();
	showFollowupHistory(clientname,id,kdticket);
});
$("#btnrekap").click(function(){
	window.location.href = "/tickets/rekap";
});
getjsdate = function(dttime){
	if(!dttime){
		return false;
	}else{
		dttimesplit = dttime.split(" ");
		dt = dttimesplit[0].split("/");
		year = dt[2];
		month = dt[1]-1;
		day = dt[0];
		tm = dttimesplit[1].split(":");
		hour = tm[0];
		minute = tm[1];
		second = tm[2];
		return new Date(year,month,day,hour,minute,second);	
	}
}
setdura = function(){
	if(tTicket.fnSettings().aoData.length===0){
		//console.log('Tidak ada data');
	}else{
	$("#tbl_ticket tbody tr").each(function(){
		tr = $(this);
		dr = $(this).attr("ticketstart");
		drend = $(this).attr("ticketend");
		id = $(this).attr("thisid");
		if(!drend){
//			console.log(id,"Drend undefined");
		}else{
			dttime = dr;
			dttimesplit = dttime.split(" ");
			dt = dttimesplit[0].split("/");
			year = dt[2];
			month = dt[1]-1;
			day = dt[0];
			tm = dttimesplit[1].split(":");
			hour = tm[0];
			minute = tm[1];
			second = tm[2];
			_start = new Date(year,month,day,hour,minute,second);
			status = $(this).hasClass("ticketOpen_")?"ticketOpen":"ticketClosed";
			showalert= $(this).hasClass("showalert")?true:false;
			switch(status){
				case "ticketOpen":
					_end = new Date();
				break;
				case "ticketClosed":
					_end = getjsdate(drend);
				break;
			}
			dura = getduration2({start:_start,end:_end},function(x){
				if(status==="ticketOpen"){
					//console.log("DAYS",id,status,_start,_end,days);
				}
				tr.find("[fieldName='duration']").html(x.str);
				tr.find("[fieldName='escalation']").html(x.dayval);
			});
		}
	});
}}
getTroubleshootsbyTicket = function(obj,callback){
	$.ajax({
		url:'/tickets/gettroubleshootsbyticket',
		data:{ticket_id:obj.id},
		type:'post',
		dataType:'json'
	})
	.done(function(troubleshoots){
		//console.log('getTroubleshoot success',troubleshoots);
		callback(troubleshoots);
	})
	.fail(function(err){
		console.log('getTroubleshoot Failed',err);
	});
}
checkhasVisited = function(tr){
	//console.log("TRID",tr.attr('thisid'));
	getTroubleshootsbyTicket({id:tr.attr('thisid')},function(troubleshoots){
		//gettroubleshootsbyticket
		tr.find('.ticketulaction .setHasVisited').remove();
		tr.find('.troubleshootslist').empty();
		troubleshoots.forEach(function(troubleshoot){
			tr.find('.ticketulaction').append('<li class="pointer setHasVisited" id='+troubleshoot.id+'><a title="Klik untuk menandai sudah dikunjungi">Troubleshoot '+troubleshoot.request_date2+'</a></li>');
			tr.find('.troubleshootslist').append('<li class="pointer setHasVisited"><a>jadwal troubleshoot '+troubleshoot.request_date1+'</a>'+troubleshoot.hasvisitedlabel+'</li>');
		});
	})	
		
}
removeHasVisited = function(callback){
	$("#tbl_ticket tbody tr.textred").each(function(){
		tr = $(this);
		//tr.find('.ticketulaction .setHasVisited').remove();
		callback(tr);
	});
}
setInterval(function(){ 
	setdura();
	removeHasVisited(function(tr){
		checkhasVisited(tr);
	});
	//checkhasVisited();
}, 3000);
getRow = function(val, callback){
	return callback(val);
}
setLocation = function(val, callback){
	if(val){
		callback(val.location);
	}
}
populateAllCombos = function(elem){
	requesttype = elem.find("option:selected").text();
	$('#client_id').change();

	$.ajax({
		url:'/tickets/getClient/'+requesttype,
		dataType:'json'
	}).done(function(data){
		$('#client_id').html('');
		$.each(data,function(col,row){
			$('#client_id').append('<option value='+row.id+'>'+row.name+'</option>');
		});
		$('#client_id').change();
	}).fail(function(){
		console.log('error retrieve data',requesttype);
	});
}
$('#client_id').change(function(){
	console.log("cLIENTID CHANGED");
	var thisval = $(this).val(),
	requesttype = $('#requesttype').find("option:selected").text();
	if(requesttype==='pelanggan'){
		$("#client_site_div").show();
		$("#client_site_textbox_div").hide();
		$("#client_site_id").addClass("inp_ticket");
		$('#client_site_id').populateCombo({
			keyvalpaired: true,
			url: '/clients/get_combo_data_sites/' + thisval
		});
		$('#client_site_id').change();
	}else{
		$("#client_site_div").hide();
		$("#client_site_textbox_div").show();
		$("#client_site_id").removeClass("inp_ticket");
		$("#location").addClass("inp_ticket");
		$.ajax({
			url:'/tickets/getClient/'+requesttype,
			dataType:'json'
		}).done(function(data){
			thisrow = getRow(thisval,function(x){
				setLocation(data[x],function(dt){
					$('#location').val(dt);
				})
			});
		}).fail(function(){
			console.log("Tidak dapat retrieve data");
		});
	}
});
$('#client_site_id').change(function(){
	$('#location').val($('#client_site_id').find(' :selected').text());
});
updateRecordRow = function(){
	var maxid = tTicket.getDataTableMaxAttr({idAttr: "thisid"});
	console.log('maxid',maxid);
	/*$.ajax({
		url: '/tickets/getRecordOver/' + maxid,
		type: "get",
		dataType: "json"
	}).done(function (data) {
		console.log('data',data);
		$.each(data,pret(a,b));
	}).fail(function () {
		console.log("Tidak dapat memeriksa Record baru, silakan hubungi Developer");
	});*/
}


pret = function (a, b) {
	console.log("CLIENTNAME",b["clientname"]);
	console.log("b",b);
	switch(b["status"]){
		case "0":
		status = "Open";
		break;
		case "1":
		status = "Closed";
		break;
	}
	var upstr = "";
	if(b["requesttype"]==="pelanggan"){
		upstr = "";
	}else{
		upstr = "<li class='editUpstream'><a href='#'>Edit Upstream</a></li>";
	}
	newRow = tTicket.fnAddData([b["kdticket"], b["clientname"], b["services"],status,0, b["category"],b.reporter,b.reporterphone, b.createuser,'<div class="btn-group"><button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button><ul class="dropdown-menu pull-right">'+upstr+'<li class="btntroubleshoot"><a href="#">Troubleshoot</a></li><li class="btnfollowup pointer"><a>Follow Up Ticket</a></li></ul></div>']);
	var row = tTicket.fnGetNodes(newRow);
	//$(row).attr('thisid', maxid + 1);
	$(row).attr('thisid', b["id"]);
	$(row).addClass('ticketOpen');
	$(row).attr('ticketstart', humandatetime());
	$(row).attr('ticketend', humandatetime());
	if(b["parentid"].length){
		$(row).addClass('ticketMassal');
	}
	if(b["requesttype"]!=="pelanggan"){
		$(row).addClass('ticketMassal');
	}
	
		var nTr = tTicket.fnSettings().aoData[newRow[0]].nTr;
		var nTds = $('td', nTr);
		nTds.eq(1).addClass('clientname');
		nTds.eq(1).addClass('pointer');
		//nTds.eq(3).addClass('updatable');
		//nTds.eq(3).attr('fieldName','status');
		//nTds.eq(4).addClass('updatable');
		nTds.eq(3).attr('fieldName', 'duration');
}



confirmationresult = $('.myeditor').cleditor({
	width:'300',
	height:'100',
	controls:"bold italic underline | color highlight removeformat | bullets numbering",
	keyup:function(){
		console.log('hoho');
	}
});
solusi = $('.myeditor').cleditor({width:'300',height:'100',controls:"bold italic underline | color highlight removeformat | bullets numbering"});

$("#tbl_ticket").on("click","tr .editUpstream",function () {
	var selected = $(this).stairUp({level:4}),
		selectedId = selected.attr("thisid");
		$("#tbl_ticket tbody tr").removeClass("selected");
		selected.addClass("selected");
		$("#addUpstreamTitle").html(selected.find(".kdticket").html());
		$.ajax({
			url:"/tickets/pGetJson/"+selectedId,
			dataType:"json"
		})
		.done(function(ticket){
			console.log("TICKETREPORTER:",ticket.obj[0].description);
			console.log("TICKETREPORTERPHONE",ticket.obj[0]["reporterphone"]);
			$("#upstream").val(ticket.obj[0].clientname);
			$("#ucomplaint").val(ticket.obj[0].complaint);
			$("#ureporter").val(ticket.obj[0].reporter);
			$("#udescription").val(ticket.obj[0].description).blur();
			$("#ureporterphone").val(ticket.obj[0]["reporterphone"]);
			$.ajax({
				url:'/tickets/getUpstreamClients/'+selectedId,
				dataType:"json"
			})
			.done(function(res){
				$('#selectedClient tbody tr').remove();
				for(var i=0;i<res.length;i++){
					console.log("RES CLIENT NAME",res[i].clientname,res[i].id);
					$('#selectedClient tbody').append('<tr trid="'+res[i].id+'"><td>'+res[i].clientname+'</td><td>'+res[i].address+'</td><td class="removeExistingClient">Hapus</td></tr>');
				}
			})
			.fail(function(err){
				console.log("ERR",err);
			});
			
		});
	$("#btnupdateupstream").show();
	$("#btnsaveupstream").hide();
	$("#dAddUpstream").modal();
});
$('#selectedClient').on('click','tbody tr td.removeExistingClient',function(){
	thisid = $(this).stairUp({level:1}).attr("trid");
	$(this).stairUp({level:1}).remove();
	$.ajax({
		url:'/tickets/remove/',
		data:{id:thisid},
		type:"post"
	})
	.done(function(res){
		console.log("RES TO REMOVE",res);
		tRow = $("#tbl_ticket tbody").find(" tr[thisid="+thisid+"]");
		tRow.addClass("kikikikik");
		removeRow(tRow,function(row){
			position = tTicket.fnGetPosition(row[0])
			console.log("POSITION",position);
			tTicket.fnDeleteRow(position);
			console.log("CLASSNAME",row.className);
		});
	})
	.fail(function(err){
		console.log("ERR",err);
	});
});
removeRow = function(row,callback){
	tRow.addClass("kikikikik");
	callback(tRow);
}
$("#tbl_ticket").on("click","tr .btnviewtroubleshoot",function () {
	var tr = $(this).stairUp({level:4});
	$('#tb_ticket tr').removeClass('selected');
	tr.addClass('selected');
	$.ajax({
		url:'/tickets/getTroubleshootSolutionsz/'+tr.attr('thisid'),
		type:'get',
		dataType:'json'
	}).done(function(trdata){
		var teks = 'Tiket ini memiliki' + trdata.rw.length + ' dari '+ trdata.rowcount +' Troubleshoot<br />';
		$.each(trdata.rw,function(x,y){
			teks+=y.activities + '<br />';
		});
		console.log('test show tambahan solusi');
		$('#trInfoModalLabel').html('Info Kode Ticket '+tr.find('td.kdticket').html());
		$('#trInfoMessage').html(teks);
		$('#dTroubleshootInfo').modal();		
	}).fail(function(){
		console.log('Tidak dapat retrieve troubleshoot');
	});
});
$('.closemodal').click(function(){
	$(this).stairUp({level:4}).modal('hide');
});

$('#addUpstreamClient').click(function(){
	console.log('add upstream client clicked');
	$('#dClientLookup').modal();
});
$("#total_router").click(function(){
	tTicket.fnDeleteRow(0);
	
	console.log("total_router clicked");
});
$("#tbl_ticket").on("click",".kdticket",function(){
	var that = this;
	console.log("THIS",this);
	console.log("$(THIS)",$(this));
})
$("#tbl_ticket").on("click",".btnstartdowntime",function(){
	console.log("btnstartdowntime clicked");
	thisid= $(this).stairUp({level:4}).attr('thisid');
	$.ajax({
		url:'/tickets/update',
		data:{id:thisid,status:'0',downtimestart:sqldatetime()},
		type:"post"
	})
	.done(function(res){
		console.log("Res",res);
	})
	.fail(function(err){
		console.log("Err",err);
	});
})
$("#tbl_ticket").on("click",".btnenddowntime",function(){
	console.log("btnenddowntime clicked");
	thisid= $(this).stairUp({level:4}).attr('thisid');
	$.ajax({
		url:'/tickets/update',
		data:{id:thisid,status:'0',downtimeend:sqldatetime()},
		type:"post"
	})
	.done(function(res){
		console.log("Res",res);
	})
	.fail(function(err){
		console.log("Err",err);
	});
})
$("#paditest").click(function(){
	$("#futs").getdate();
	console.log("delete this trian funtion please",$("#futs").attr("datetime"));	
	//dts = $('#futs').getdate().addhour($('#futsh')).addminute($('#futsm')).attr('datetime');
	//dte = $('#fute').getdate().addhour($('#futeh')).addminute($('#futem')).attr('datetime');

	//console.log("DTS",dts);
	//console.log("DTE",dte);
})
$(".mynumber").mask("99")
$("#filterclientcategory").change(function(x){
	val = $(this).val();
	console.log("filtercategory change",val);
	tTicket.fnFilter(val,2);
});
$("#sfiltereskalasi").change(function(x){
	val = $(this).val();
	console.log("filtereskalasi change",val);
	tTicket.fnFilter(val,10);
});
$('#sfilterbranch').change(function(){
	val = $(this).val();
	console.log("Filter branch change",val)
	tTicket.fnFilter(val,11)
})

$("#btnAddService").on("click",function(){
	console.log("Hjaarrrrr");
	$("#dService").modal();
})
$("#btnSaveDowntime").on("click",function(){
	start = $('#dttrs').val();

	alert($('#dttrs').val());
	console.log('Downtimestart',$('#dttrs').val());
	console.log('Downtimeend',$('#dttre').val());
	/*$.ajax({
		url:'/tickets/savedowntime',
		data:{}
	})*/
});
$("#btnAddDowntime").on("click",function(){
	$("#dAddDowntime").modal();
})
makeMySQLDate = function(input,callback){
	tmp = input.split("/");
	callback(tmp[2]+"-"+tmp[1]+"-"+tmp[0]);
}
$('#tbl_ticket').on('click','.setHasVisited',function(){
	tr = $(this).stairUp({level:4});
	id = $(this).attr('id');
	console.log('ID',id);
	$.ajax({
		url:'/tickets/sethasvisit',
		data:{
			id:id
		},
		type:'post',
		dataType:'json'
	})
	.done(function(res){
		console.log('Sudah di visit',res);
		//tr.find('.clientname .hasVisited').html('Has Visited');
	})
	.fail(function(err){
		console.log('Error set sudah divisit',err);
	});
})

$(".toselectAll").on("click", function () {
	$(this).select();
});
savefees = function(fb_id,callback){
	$(".othertext_").each(function(){
		that = $(this);
		$('.autonum').autoNumeric('init');
		oname = that.find('.othername').html();
		odpp = that.find('.fee').autoNumeric('get');
		oppn = that.find('.ppn').autoNumeric('get');
		oclient_id = $("#client_id").val();
		$.ajax({
			url:'/fbfees/saveupdate',
			data:{
				client_id:oclient_id,
				fb_id:fb_id,
				dpp:odpp,
				ppn:oppn,
				name:oname,
				createuser:$('#createuser').val()},
			type:'post',
			async:false
		}).done(function(data){
			console.log('sukses update/insert fbfee device, id:',data);
		}).fail(function(err){
			console.log('gagal update/insert fbfee device',err);
		});
	});
	callback();
}
checkdocument = function(document,nofb,callback){
	obj = [];
	document.each(function(){
		that = $(this);
		name = that.stairUp({level:5}).find('.info ._document').html();
		tmp = {};
		if(that.prop("checked")){
			tmp['nofb'] = nofb;
			tmp['document'] = name;
			tmp['createuser'] = 'puji';
			obj.push(tmp);
		}
	});
	callback(obj);
}
$(".check_document").click(function(){
	fake = false;
	if(fake){
		fb_id= 'xyz';
		savedocuments($('.checkdocument'),fb_id,function(){});
	}
});
$(".btnAddVas").click(function(){
	console.log("Add VAS invoked");
	$("#dAddVAS").modal();
});
$("#btnvassave").click(function(){
	str = '<tr class="vas">';
	str+= '<td class="info">';
	str+= '	<a class="fancybox vasname" rel="group" vasid='+$('#vas').val()+'>'+$('#vas :selected').text()+'</a> ';
	str+= '	<span></span> ';
	str+= '	<span></span>';
	str+= '</td>';
	str+= '<td>';
	str+= '	<a ><span class="icon-pencil"></span></a>';
	str+= '	<a ><span class="icon-remove vasremove"></span></a>';
	str+= '</td>';
	str+= '</tr>';
	$(".tclientvases tbody").append(str);
	update_rowcount($("#totalvas"),$(".tclientvases tbody tr"));
});
$(".tclientvases").on("click",".vasremove",function(){
	console.log("VasRemove invoked");
	that = $(this);
	that.stairUp({level:3}).remove();
	update_rowcount($("#totalvas"),$(".tclientvases tbody tr"));
});
redirectme = function(){
	window.location.href = '/subscribeforms';
}
$("#monthlyfee").change(function(){
	ppn = parseInt($("#monthlyfee").autoNumeric('get'))*0.1;
	console.log("Monthly PPN",parseInt($("#monthlyfee").autoNumeric('get')),ppn);
	$("#monthlyppn").val(ppn);
});
$("#setupfee").change(function(){
	ppn = parseInt($("#setupfee").autoNumeric('get'))*0.1;
	console.log("Setup PPN",parseInt($("#setupfee").autoNumeric('get')),ppn);
	$("#setupppn").val(ppn);
});
checkbusinessfield = function(){
	if($('#businesstype').val()==='4'){
		$('#otherbusinesstype').show();
	}else{
		$('#otherbusinesstype').hide();
	}
}
$('.btnclose').click(function(){
	$(this).stairUp({
		level:2
	}).modal('hide');
});
$('.btn_addservice').click(function(){
	$("#servicecategories").val(0);
	$("#upstring").val(0);
	$("#dnstring").val(0);
	$("#upm").val(0);
	$("#upk").val(0);
	$("#dnm").val(0);
	$("#dnk").val(0);
	$(".hiddendiv").hide();
	$(".hiddendiv input").val("0");
	$("#servicedescription").val("");
	$('#dAddService').modal();
});
$('.chooseupm').choosevaluem({
	modal:$('#dServiceDetailMega'),
	affected:$("#upm"),
	updown:"up"
});
$('.chooseupk').choosevaluem({
	modal:$('#dServiceDetailKilo'),
	affected:$("#upk"),
	updown:"up"
});
$('.choosednm').choosevaluem({
	modal:$('#dServiceDetailMega'),
	affected:$("#dnm"),
	updown:"down"
});
$('.choosednk').choosevaluem({
	modal:$('#dServiceDetailKilo'),
	affected:$('#dnk'),
	updown:"down"
});
$(".selectonfocus").focus(function(){
	$(this).select();
})
$('#btnservicesave').click(function(){
	var upstring = '',dnstring = '';
	switch($("#servicecategories :selected").text()){
		case "Enterprise":
			upstring = "UP "+$("#upstring").val();
			dnstring = "DOWN "+$("#dnstring").val();
		break;
		case "Business":
			upstring = "Up to "+$("#BW").val();
			dnstring = "";
		break;
		case "Colocation":
			upstring = ""+$("#space").val();
			if($("#BW").val()=="0"){
				dnstring = "UP "+$("#upstring").val()+",DOWN "+$("#dnstring").val();
			}else{
				dnstring = ""+$("#BW").val();
			}
		break;
		case "IIX (IIX)":
			upstring = "UP "+$("#upstring").val();
			dnstring = "DOWN "+$("#dnstring").val();
		break;
		case "Local Loop":
			upstring = "UP "+$("#upstring").val();
			dnstring = "";
		break;
		case "Symetrical Broadband Internet (SBI)":
			upstring = "Up to "+$("#BW").val();
			dnstring = "";
		break;
		case "Padi Cluster":
			upstring = ""+$("#BW").val();
			dnstring = "";
		break;
		case "Padi SOHO":
			upstring = ""+$("#soho :selected").text();
			dnstring = "";
		break;
	}
	str = '<tr thisid="x">';
	str+= '<td class="servicecategory">'+$('#servicecategories :selected').text()+'</td>';
	str+= '<td class="info" upk="'+$('#upk').val()+'" upm="'+$('#upm').val()+'" dnk="'+$('#dnk').val()+'" dnm="'+$('#dnm').val()+'" upstring="'+$("#upstring").val()+'" dnstring="'+$("#dnstring").val()+'" space="'+$('#space').val()+'" bandwidth="'+$('#BW').val()+'" sname=""><a>'+$('#servicedescription').val()+'</a>';
	str+= ' <span>'+upstring+'</span> <span>'+dnstring+'</span>';
	str+= '</td>';
	str+= '<td>';
	str+= '	<div class="btn-group">';
	str+= '		<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  > Aksi <span class="caret"></span></button>';
	str+= '		<ul class="dropdown-menu pull-right">';
	str+= '			<li class="edit_service"><a>Edit</a></li>';
	str+= '			<li class="divider"></li>';
	str+= '			<li class="remove_service"><a>Hapus</a></li>';
	str+= '		</ul>';
	str+= '	</div>';
	str+= '</td>';
	str+= '</tr>';
	$('#tservice tbody').prepend(str);
	$('#total_service').html($('#tservice tbody tr').length);
})
$('#btnAddOtherFee').click(function(){
	$('#dAddOtherFee').modal();	
});
$('.closemodal').click(function(){
	$(this).stairUp({level:4}).modal('hide');
});
//checkbusinessfield();
$('.autonum').autoNumeric('init');
$('#setuptotal').autoNumeric('init');
$('#monthlytotal').autoNumeric('init');
$('#devicetotal').autoNumeric('init');
function changefeeval(fee,ppn,total){
	setuptotal = 0;
	setuptotal += parseInt($('#'+fee).autoNumeric('get'));
	setuptotal += parseInt($('#'+ppn).autoNumeric('get'));
	$('#'+total).html(setuptotal);
	$('#'+total).autoNumeric('update');	
}
$('.setup').mouseup(function(){
	changefeeval('setupfee','setupppn','setuptotal');
});
$('.setup').keyup(function(){
	changefeeval('setupfee','setupppn','setuptotal');
});
$('.monthly').mouseup(function(){
	changefeeval('monthlyfee','monthlyppn','monthlytotal');
});
$('.monthly').keyup(function(){
	changefeeval('monthlyfee','monthlyppn','monthlytotal');
});
$('.device').mouseup(function(){
	changefeeval('devicefee','deviceppn','devicetotal');
});
$('.device').keyup(function(){
	changefeeval('devicefee','deviceppn','devicetotal');
});
$('.other').mouseup(function(){
	changefeeval('otherfee','otherppn','othertotal');
});
$('.other').keyup(function(){
	changefeeval('otherfee','otherppn','othertotal');
});
$("#btn_preview").click(function(){
	window.location.href = "/subscribeforms/showreport/"+$("#client_id").val();
});
$('#othersave').click(function(){
	var othertext = '';
	othertext += '<div class="row-form clearfix othertext_">';
	othertext += '	<div class="span3"><b><span class="othername">'+$('#othername').val()+'</span></b></div>';
	othertext += '	<div class="span3"><input type="text" value='+$('#otherfee').val()+' class="autonum fee" /></div>';
	othertext += '	<div class="span3"><input type="text" value='+$('#otherppn').val()+' class="autonum ppn" /></div>';
	othertext += '	<div class="span3" id="othertotal">';
	othertext += 		$('#othertotal').html();
	othertext += '		<button class="btn btn-mini btnremovefee" type="button">Hapus</button>';
	othertext += '	</div>';
	othertext += '</div>';
	$('#fees').append(othertext);
	$('.btnremovefee').click(function(){
		$(this).stairUp({level:2}).remove();
	});
});
datepickernotvalid = function(){
	invalid = false;
	$(".datepicker").each(function(){
		that = $(this);
		if(that.val()===""){
			console.log("VAL",that.html());
			invalid = true;
		}
	});
	return false;
	return invalid;
}
$('#btn_save').click(function(){
	if(datepickernotvalid()){
		alert("Tanggal harus diisi");
	}else if($('#status').val()==='-'){
		alert('Status FB harus diisi');
	}else{
		savefb(savepic_);
	}
});
$('#businesstype').change(function(){
	//checkbusinessfield();
});
$.ajax({
	url:'/subscribeforms/getpics/'+$('#client_id').val(),
	type:'post',
	dataType:'json'
}).done(function(data){
	console.log('data',data);
	$('#nofb').html(data['nofb']);
	$('#siup').val(data['siup']);
	$('#npwp').val(data['npwp']);
	$('#clientname').val(data['name']);
	$('#businesstype').find('option').each(function(){
		if($(this).text()===data['businesstype']){
			$(this).attr('selected','selected');
		}
	});
	$('#clientaddress').val(data['address']);
	$('#clientphone').val(data['phone']);
	$('#clientfax').val(data['fax']);
	$('#subscriber_id').val(data['subscriber']['id']);
	$('#subscribername').val(data['subscriber']['name']);
	$('#subscriberposition').val(data['subscriber']['position']);
	$('#subscriberid').val(data['subscriber']['idnum']);
	$('#subscriberphone').val(data['subscriber']['phone']);
	$('#subscriberhp').val(data['subscriber']['hp']);
	$('#subscriberemail').val(data['subscriber']['email']);
	$('#resp_id').val(data['resp']['id']);
	$('#respname').val(data['resp']['name']);
	$('#respposition').val(data['resp']['position']);
	$('#respid').val(data['resp']['idnum']);
	$('#respphone').val(data['resp']['phone']);
	$('#resphp').val(data['resp']['hp']);
	$('#respemail').val(data['resp']['email']);
	$('#adm_id').val(data['adm']['id']);
	$('#admname').val(data['adm']['name']);
	$('#admphone').val(data['adm']['phone']);
	$('#admhp').val(data['adm']['hp']);
	$('#admemail').val(data['adm']['email']);
	$('#technician_id').val(data['teknis']['id']);
	$('#technicianname').val(data['teknis']['name']);
	$('#technicianphone').val(data['teknis']['phone']);
	$('#technicianhp').val(data['teknis']['hp']);
	$('#technicianemail').val(data['teknis']['email']);
	$('#billing_id').val(data['billing']['id']);
	$('#billingname').val(data['billing']['name']);
	$('#billingphone').val(data['billing']['phone']);
	$('#billinghp').val(data['billing']['hp']);
	$('#billingemail').val(data['billing']['email']);
	$('#support_id').val(data['support']['id']);
	$('#supportname').val(data['support']['name']);
	$('#supportphone').val(data['support']['phone']);
	$('#supporthp').val(data['support']['hp']);
	$('#supportemail').val(data['support']['email']);
	$('#activationdate').val(data['activationdate']);
	$('#period1').val(data['period1']);
	$('#period2').val(data['period2']);
	changefeeval('setupfee','setupppn','setuptotal');
	changefeeval('monthlyfee','monthlyppn','monthlytotal');
	changefeeval('devicefee','deviceppn','devicetotal');
}).fail(function(err){
	console.log('Tidak dapat retrieve',err);
});
setBusinessValues = function(){
	out = "0";
	switch ($("#business :selected").text()){
		case "2 Mbps":
		out = "2";
		break;
		case "4 Mbps":
		out = "4";
		break;
		case "6 Mbps":
		out = "6";
		break;
		case "8 Mbps":
		out = "8";
		break;
	}
	$("#upm").val(out);
	$("#upk").val("0");
	$("#dnm").val("0");
	$("#dnk").val("0");
}
setSBIValues = function(){
	out = "0";
	switch($("#smartvalue :selected").text()){
		case "3 Mbps":
		out = "3";
		break;
		case "5 Mbps":
		out = "5";
		break;
		case "8 Mbps":
		out = "8";
		break;
		case "10 Mbps":
		out = "10";
		break;
	}
	$("#upm").val(out);
	$("#upk").val("0");
	$("#dnm").val("0");
	$("#dnk").val("0");
}
setPCValues = function(){
	out = "0";
	switch($("#smartvalue :selected").text()){
		case "Up to 5":
		out = "5";
		break;
		case "Up to 7":
		out = "5";
		break;
		case "Up to 10":
		out = "10";
		break;
	}
	$("#upm").val(out);
	$("#upk").val("0");
	$("#dnm").val("0");
	$("#dnk").val("0");
}
resetValues = function(){
	$("#upm").val("0");
	$("#upk").val("0");
	$("#dnm").val("0");
	$("#dnk").val("0");
	$("#upstring").val("0");
	$("#dnstring").val("0");
	$("#BW").val("0");
	$("#space").val("0");
}
setBW = function(element){
	console.log(element,$('#'+element+' :selected').text());
	var BW = "";
	if($("#"+element+" :selected").text().toLowerCase()!=="custom"){
		BW = $("#"+element+" :selected").text();
	}
	$("#BW").val(BW);
}
setSpace = function(){
	space = $("#colospaces :selected").text();
	$("#space").val(space);
}
showeditservice = function(category){
	$(".hiddendiv").hide();
    console.log("change product",category);
	resetValues();
    switch(category){
		case "Enterprise":
            $("#denterprise").show();
        break;
        case "IIX (IIX)":
            $("#diix").show();
        break;
		case "Local Loop":
            $("#dlocalloop").show();
        break;
		case "Business":
			setBusinessValues();
			setBW('business');
            $("#dbusiness").show();
        break;
        case "Smart Value":
			$("#dsmartvalue").show();
        break;
		case "Colocation":
			$("#colobw").val(0);
			setBW('colobw');
			setSpace();
			$("#dcolocation").show();
		break;
		case "Symetrical Broadband Internet (SBI)":
			setBW('smartvalue');
			$("#dsmartvalue").show();
		break;
		case "Padi Cluster":
			setBW('pc');
			$("#dpadicluster").show();
		break;
		case "Padi SOHO":
			setBW('soho');
			$("#dsoho").show();
		break;
	}
}
category = $("#servicecategories :selected").text();
	showeditservice(category);
$("#colobw").change(function(){
	$("#dcustomcolo").hide();
	if($("#colobw :selected").text()==="Up to 1 Mb"){
		$("#dcustomcolo").hide();
		$("#upstring").val("1 Mb");
		setBW('colobw');
	}else{
		$("#BW").val("0");
		$("#dcustomcolo").show();
	}
});
$("#smartvalue").change(function(){
	setBW("smartvalue")
});
$("#soho").change(function(){
	setBW("soho");
})
$("#servicecategories").change(function(){
	category = $("#servicecategories :selected").text();
	showeditservice(category);
})
$('.myeditor').cleditor({
	width:'300',
	height:'160px',
	controls:"bold italic underline | color highlight removeformat | bullets numbering"
});
$("#teststring").click(function(){
	$("#dsmartvalue").show();
})
$('.draggable').draggable({
	revert:true
});
$('.droppable').droppable({
	drop:function(event,ui){
		that = $(this);		
		ui.draggable.find(".picelement").each(function(){
			dst = $(this);
			dstel = $(this).attr('elname');
			if(that.find("[elname="+dstel+"]")){
				console.log('ketemu',that.find("[elname="+dstel+"]").attr('id'),that.find("[elname="+dstel+"]").val(),dst.val());
				that.find("[elname="+dstel+"]").val(dst.val());
			}
		})
		$(this).find('.picelement').each(function(){
			//console.log('DEST Element',$(this).attr('id'),$(this).val());
		});
	},
});

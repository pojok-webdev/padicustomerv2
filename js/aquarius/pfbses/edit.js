$(".toselectAll").on("click", function () {
	$(this).select();
});
setBW = function(element){
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
			console.log("Hehe");
            $("#edenterprise").show();
        break;
        case "IIX (IIX)":
            $("#ediix").show();
        break;
		case "Local Loop":
            $("#edlocalloop").show();
        break;
		case "Business":
			setBusinessValues();
			setBW('ebusiness');
            $("#edbusiness").show();
        break;
        case "Smart Value":
			$("#edsmartvalue").show();
        break;
		case "Colocation":
			setBW('ecolobw');
			setSpace();
			$("#edcolocation").show();
		break;
		case "Symetrical Broadband Internet (SBI)":
			console.log("Smart Values clicked");
			setBW('esmartvalue');
			$("#edsmartvalue").show();
		break;
		case "Padi Cluster":
			setBW('epc');
			$("#edpadicluster").show();
		break;
	}

}
$("#editservicecategories").change(function(){
	category = $("#editservicecategories :selected").text();
	showeditservice(category);
});
populateService = function(service_id){
	console.log('service_id',service_id);
	$.ajax({
		url:'/pfbses/getservice',
		data:{service_id:service_id},
		type:'post',
		dataType:'json'
	})
	.done(function(res){
		$("#editservicecategories").val(res.category);
		showeditservice(res.category);
		$(".bandwidth option").each(function(){
			optitem = $(this);
			if(res.bandwidth===optitem.html()){
				optitem.attr("selected","selected");
			}
		});
		$(".upm").val(res.upm);
		$(".upk").val(res.upk);
		$(".dnm").val(res.dnm);
		$(".dnk").val(res.dnk);
		$("#editupm").val(res.upm);
		$("#editupk").val(res.upk);
		$("#editdnm").val(res.dnm);
		$("#editdnk").val(res.dnk);
		$("#editupm").val(res.upm);
		$("#editdnstring").val(res.dnstr);
		$("#editupstring").val(res.upstr);
		$("#eservicedescription").val(res.name);
		$("#espace").val(res.space);
		$("#eBW").val(res.bandwidth);
	})
	.fail(function(err){
		console.log("Error getservice",err);
	});
}
$("#btnserviceupdate").click(function(){
	thisid = $("#tservice tbody tr.selected").attr('thisid');
	$.ajax({
		url:'/pfbses/updateservice',
		data:{
			id:thisid,
			fb_id:$('#no_fb').html(),
			category:$('#editservicecategories :selected').text(),
			upm:$('#editupm').val(),
			upk:$('#editupk').val(),
			upstr:$('#editupstring').val(),
			dnm:$('#editdnm').val(),
			dnk:$('#editdnk').val(),
			dnstr:$('#editdnstring').val(),
			name:$('#eservicedescription').val(),
			space:$("#espace").val(),
			bandwidth:$("#eBW").val(),
			createuser:'puji'
		},
		type:'post',
	})
	.done(function(res){
		console.log("Sukses Update service",res);
	})
	.fail(function(err){
		console.log("Error Update service",err);
	});
});
$('.checkdocument').click(function(){
	documentname = $(this).stairUp({level:5}).find('._document').html();
	if($(this).attr('checked')){
		$.ajax({
			url:'/pfbses/checkdocument',
			data:{nofb:$('#no_fb').html(),documentname:documentname},
			type:'post'
		})
		.done(function(res){
			console.log('Success checkdocument',res);
		})
		.fail(function(err){
			console.log('Error checkdocument',err);
		});
	}else{
		$.ajax({
			url:'/pfbses/uncheckdocument',
			data:{nofb:$('#no_fb').html(),documentname:documentname},
			type:'post'
		})
		.done(function(res){
			console.log('Success uncheckdocument',res);
		})
		.fail(function(err){
			console.log('Error uncheckdocument',err);
		});
	}
});
checkcomplete = function(){
	str = "YANG BELUM TERISI: <p><p>";
	c = 1;
	$('.mandatory').each(function(obj,val){
		that = $(this);
		if(!that.val()){
			console.log(that.attr("humanName")+" kosong");
			str+=c+'. '+that.attr("humanName")+" <p>";
			c++;
		}else{
			console.log('obj val',$(this).attr('id'),$(this).val());
		}
	})
	if(str.length>0){
		$('#lblWarning').html(str);
		$('#emptyMandatoryWarn').modal();
	}
}
$(".hiddendiv").hide();
$('.btn_addservice').click(function(){
	console.log('add service clicked');
	$("#servicecategories").val("0");
	$(".hiddendiv").hide();
	$(".chooseupm").val("00");
	$(".chooseupk").val("00");
	$(".choosednm").val("00");
	$(".choosednk").val("00");
	$("#upstring").val("00");
	$("#dnstring").val("00");
	$("#upm").val("00");
	$("#upk").val("00");
	$("#dnm").val("00");
	$("#dnk").val("00");
	$("#space").val("0");
	$("#BW").val("0");

	$('#dAddService').modal();
});
humanReadabelValue = function(){
	str = "";
	if($("#upm").val()!=="0"){
		str += "Upload : " + $("#upm").val() + " Mbps ";
	}
	if($("#upk").val()!=="0"){
		str += ", " + $("#upk").val() + " Kbps ";
	}
	if($("#dnm").val()!=="0"){
		str += " Download : " + $("#dnm").val() + " Mbps ";
	}
	if($("#dnk").val()!=="0"){
		str += ", " + $("#dnk").val() + " Kbps ";
	}
	return str;
}

$('#btnservicesave').click(function(){
	console.log('fb service saved',$('#servicecategories').val(),$('#servicedescription').val());
	if($("#servicecategories").val()==="0"){
		alert("Kategori harus dipilih");
	}else{
		$.ajax({
			url:'/pfbses/saveservice',
			data:{
				fb_id:$('#no_fb').html(),
				category:$('#servicecategories :selected').text(),
				upm:$('#upm').val(),
				upk:$('#upk').val(),
				upstr:$('#upstring').val(),
				dnm:$('#dnm').val(),
				dnk:$('#dnk').val(),
				dnstr:$('#dnstring').val(),
				name:$('#servicedescription').val(),
				space:$("#space").val(),
				bandwidth:$("#BW").val(),
				createuser:'puji'
			},
			type:'post',
		})
		.done(function(res){
			console.log('Succes save fbservice',res);

			str = '<tr thisid="'+res+'">';
			str+= '<td class="servicecategory">'+$('#servicecategories :selected').text()+'</td>';
			str+= '<td class="info"><a>'+$('#servicedescription').val()+'</a>';
//			str+= ' <span>Upload '+$('#upstring').val()+'</span>';
//			str+= ' <span>Download '+$('#dnstring').val()+'</span>';
			switch($('#servicecategories :selected').text()){
				case 'Enterprise':
				str+= ' <span>UP '+$('#upstring').val()+'</span>';
				str+= ' <span>DOWN '+$('#dnstring').val()+'</span>';
				break;
				case 'Business':
				str+= ' <span>Up to '+$('#BW').val()+'</span>';
				str+= ' <span></span>';
				break;
				case 'Local Loop':
				str+= ' <span>'+$('#upstring').val()+'</span>';
				str+= ' <span></span>';
				break;
				case 'Symetrical Broadband Internet (SBI)':
				str+= ' <span>Up to '+$('#BW').val()+'</span>';
				str+= ' <span></span>';
				break;
				case 'Padi Cluster':
				str+= ' <span>'+$('#BW').val()+'</span>';
				str+= ' <span></span>';
				break;
				case 'Colocation':
				str+= ' <span>'+$('#space').val()+'</span>';
				switch($("#BW").val()){
					case "0":
					str+= ' <span>UP '+$('#upstring').val()+', DOWN '+$('#dnstring').val()+'</span>';
					break;
					default:
					str+="Up to 1 Mbps";
					break;
				}
				break;
				case 'oryza':
				str+= ' <span>'+$('#BW').val()+'</span>';
				str+= ' <span></span>';
				break;
				case 'IIX (IIX)':
				str+= ' <span>UP '+$('#upstring').val()+'</span>';
				str+= ' <span>DOWN '+$('#dnstring').val()+'</span>';
				break;
				case 'Padi SOHO':
				str+= ' <span>'+$('#soho :selected').text()+'</span>';
				str+= ' <span></span>';
				break;
			}

			str+= '</td>';
			str+= '<td>';
			str+= '	<div class="btn-group">';
			str+= '		<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  >';
			str+= ' 	Aksi <span class="caret"></span>';
			str+= '		</button>';
			str+= '		<ul class="dropdown-menu pull-right">';
			//str+= '			<li class="edit_service"><a>Edit</a></li>';
			//str+= '			<li class="divider"></li>';
			str+= '			<li class="remove_service"><a>Hapus</a></li>';
			str+= '		</ul>';
			str+= '	</div>';
			str+= '</td>';
			str+= '</tr>';
			$('#tservice tbody').append(str);
			$('#total_service').html($('#tservice tbody tr').length);
		})
		.fail(function(err){
			console.log('Error save fbservice',err);
		});
	}
});
$('.edit_service').click(function(){
	$("#tservice tbody tr").removeClass("selected");
	$(this).stairUp({level:4}).addClass("selected");
	service_id = $(this).stairUp({level:4}).attr('thisid');
	populateService(service_id)
	//$("#editservicecategories").change();
	
	$("#dEditService").modal();
});
$('#tservice tbody').on('click','.remove_service',function(){
	that = $(this);
	$('#tservice tbody tr').removeClass('selected');
	tr = that.stairUp({level:4});
	tr.addClass('selected');
	thisid = tr.attr('thisid');
	console.log('Thisid',thisid);
	$.ajax({
		url:'/pfbses/removeservice',
		data:{
			id:thisid
		},
		type:'post'
	})
	.done(function(res){
		console.log('Res',res);
		tr.remove();
		$('#total_service').html($('#tservice tbody tr').length);
	})
	.fail(function(err){
		console.log('Err',err);
	});
});
$('.subservice').click(function(){
	$('#dServiceDetailKilo').modal();
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
changeproduct = function(){
	$(".hiddendiv").hide();	
    console.log("change product",$("#servicecategories :selected").text());
	resetValues();
    switch($("#servicecategories :selected").text()){
		case "Enterprise":
			console.log("Hehe");
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
			setBW('colobw');
			setSpace();
			$("#colobw option").each(function(){
				if($(this).html()==="Up to 1 Mb"){
					$(this).attr("selected","selected");
					$("#upstring").val("1 Mb");
				}
			});
			$("#dcolocation").show();
		break;
		case "Symetrical Broadband Internet (SBI)":
			console.log("Smart Values clicked");
			setBW('smartvalue');
			$("#dsmartvalue").show();
		break;
		case "Padi Cluster":
			setBW('pc');
			$("#dpadicluster").show();
		break;
		case 'oryza':
			$('#BW').val("Up to 5 Mbps");
		break;
		case "Padi SOHO":
			setBW('soho');
			$("#dsoho").show();
		break;
	}
}
changeproduct();
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
$("#business").change(function(){
	setBusinessValues();
});
$("#soho").change(function(){
	console.log("Sho changed",$("#soho :selected").text());
	$("#editupstring").val($("#soho :selected").text());
});
$("#smartvalue").change(function(){
	setSBIValues();
});
$("#upk").bind("input",function(){
	out = "";
	switch ($(this).val()) {
		case '128':
		out = '0.125';
		break;
		case '256':
		out = '0.25';
		break;
		case '384':
		out = '0.375';
		break;
		case '512':
		out = '0.5';
		break;
		case '640':
		out = '0.625';
		break;
		case '768':
		out = '0.750';
		break;
		case '896':
		out = '0.875';
		break;
	}
	$("#upstring").val(0+$("#upm").val()+out);
});
$("#pc").change(function(){
	setBW('pc');
});
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
$("#business").change(function(){
	setBW('business');
});
$("#smartvalue").change(function(){
	setBW("smartvalue")
});
$("#colospaces").change(function(){
	setSpace();
});
$('#servicecategories').change(function(){
	console.log('service category clicked');
	console.log($('#servicecategories :selected').text());
	changeproduct();
});
$('#checkcomplete').click(function(){
	checkcomplete();
});
$('.btnclose').click(function(){
	$(this).stairUp({
		level:2
	}).modal('hide');
});
$("#monthlyfee").change(function(){
	console.log($("#monthlyfee").val());
	mycontent = $("#monthlyfee").val();
	str = (mycontent.replace(',','')).replace('.','');
	//ppn = 0.1*str;
	ppn = parseInt($("#monthlyfee").autoNumeric('get'))*0.1;
	$("#monthlyppn").val(ppn);
});
$("#setupfee").change(function(){
	ppn = parseInt($("#setupfee").autoNumeric('get'))*0.1;
	console.log("Setup PPN",parseInt($("#setupfee").autoNumeric('get')),ppn);
	$("#setupppn").val(ppn);
});
/*checkbusinessfield = function(){
	if($('#businesstype').val()==='4'){
		$('#otherbusinesstype').show();
	}else{
		$('#otherbusinesstype').hide();
	}
}*/
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
	//window.location.href = "/subscribeforms/showreport/"+$("#client_id").val();
	window.location.href = "/pfbses/showreport/"+$("#nofb").val();
});
removeme = function(){
	console.log("Should be remove this row");
	$(this).stairUp({level:2}).remove();

}
$('#othersave').click(function(){
	$.ajax({
		url:'/subscribeforms/savefee',
		data:{
			"nofb":$("#nofb").val(),
			"name":$("#othername").val(),
			"dpp":$("#otherfee").autoNumeric('get'),
			"ppn":$("#otherppn").autoNumeric('get'),
			"client_id":$("#client_id").val(),
			"createuser":$("#createuser").val()
		},
		type:'post'
	}).done(function(fbfee_id){
		console.log('fbfee_id',fbfee_id);
	}).fail(function(err){
		console.log('tidak dapat menyimpan fee',err);
	});
	var othertext = '';
	othertext += '<div class="row-form clearfix" feename="'+$('#othername').val()+'">';
	othertext += '<div class="span3"><b>'+$('#othername').val()+'</b></div>';
	othertext += '<div class="span3"><input type="text" value='+$('#otherfee').val()+' class="autonum" /></div>';
	othertext += '<div class="span3"><input type="text" value='+$('#otherppn').val()+' class="autonum" /></div>';
	othertext += '<div class="span3" id="othertotal">';
	othertext += $('#othertotal').html();
	othertext += '<button class="btn btn-mini btnremovefee" onclick="removeme()" type="button">Hapus</button>';
	othertext += '</div>';
	othertext += '</div>';
	$('#fees').append(othertext);
	$('#fees').on('click',".btnremovefee",function(){
		console.log("Should be remove this row");
		myrow = $(this).stairUp({level:2});
		$.ajax({
			url:'/subscribeforms/removefee',
			data:{
				nofb:nofb,
				name:myrow.attr('feename')
			},
			type:'post'
		})
		.done(function(data){
			myrow.remove();
			console.log("Done remove fee");
		})
		.fail(function(err){
			console.log("Cannot remove fee",err);
		});
	});
});
function savepic(fb_id){
	$('.inp_subscriber').makekeyvalparam();
	console.log('fb_id',fb_id);
	console.log('subscruber keyval',$('.inp_subscriber').attr('keyval'));
	$.ajax({
		url:'/fbpics/saveupdate',
		data:JSON.parse('{"fb_id":"'+fb_id+'","position":"PEMOHON",'+$('.inp_subscriber').attr('keyval')+'}'),
		type:'post'
	}).done(function(result){
		console.log(result);
		$('.inp_resp').makekeyvalparam();
		$.ajax({
			url:'/fbpics/saveupdate',
			data:JSON.parse('{"fb_id":"'+fb_id+'","position":"PENANGGUNGJAWAB",'+$('.inp_resp').attr('keyval')+'}'),
			type:'post'
		}).done(function(result){
			console.log(result);
			$('.inp_teknis').makekeyvalparam();
			$.ajax({
				url:'/fbpics/saveupdate',
				data:JSON.parse('{"fb_id":"'+fb_id+'","position":"TEKNIS",'+$('.inp_teknis').attr('keyval')+'}'),
				type:'post'
			}).done(function(result){
				console.log(result);
				$('.inp_adm').makekeyvalparam();
				$.ajax({
					url:'/fbpics/saveupdate',
					data:JSON.parse('{"fb_id":"'+fb_id+'","position":"ADMINISTRASI",'+$('.inp_adm').attr('keyval')+'}'),
					type:'post'
				}).done(function(result){
					console.log(result);
					$('.inp_billing').makekeyvalparam();
					$.ajax({
						url:'/fbpics/saveupdate',
						data:JSON.parse('{"fb_id":"'+fb_id+'","position":"BILLING",'+$('.inp_billing').attr('keyval')+'}'),
						type:'post'
					}).done(function(result){
						console.log(result);
						$('.inp_support').makekeyvalparam();
						$.ajax({
							url:'/fbpics/saveupdate',
							data:JSON.parse('{"fb_id":"'+fb_id+'","position":"SUPPORT",'+$('.inp_support').attr('keyval')+'}'),
							type:'post'
						}).done(function(result){
							console.log(result);
							$.ajax({
								url:'/fbfees/saveupdate',
								data:{client_id:$('#client_id').val(),dpp:$('#setupfee').autoNumeric('get'),ppn:$('#setupppn').autoNumeric('get'),name:"setup",nofb:$('#nofb').val(),createuser:$('#createuser').val()},
								type:'post'
							}).done(function(data){
								console.log('sukses update/insert fbfee setup',data);
								console.log('NOFB',$("#nofb"));
								$.ajax({
									url:'/fbfees/saveupdate',
									data:{client_id:$('#client_id').val(),dpp:$('#monthlyfee').autoNumeric('get'),ppn:$('#monthlyppn').autoNumeric('get'),name:"monthly",nofb:$('#nofb').val(),createuser:$('#createuser').val()},
									type:'post'
								}).done(function(data){
									console.log('sukses update/insert fbfee monthly',data);
									$.ajax({
										url:'/fbfees/saveupdate',
										data:{client_id:$('#client_id').val(),dpp:$('#devicefee').autoNumeric('get'),ppn:$('#deviceppn').autoNumeric('get'),name:"device",nofb:$('#nofb').val(),createuser:$('#createuser').val()},
										type:'post'
									}).done(function(data){
										console.log('sukses update/insert fbfee device',data);
										$("#dConfirmasi").modal();
										//window.location.href = '/subscribeforms';
									}).fail(function(err){
										console.log('gagal update/insert fbfee device',err);
									});	
								}).fail(function(err){
									console.log('gagal update/insert fbfee monthly',err);
								});
							}).fail(function(err){
								console.log('gagal update/insert fbfee setup',err);
							});
						}).fail(function(err){
							console.log('Tidak dapat menyimpan pic inp_support',err);
						});	
	
					}).fail(function(err){
						console.log('Tidak dapat menyimpan pic inp_billing',err);
					});	
				}).fail(function(err){
					console.log('Tidak dapat menyimpan pic inp_adm',err);
				});	
			}).fail(function(err){
				console.log('Tidak dapat menyimpan pic inp_teknis',err);
			});	
				
		}).fail(function(err){
			console.log('Tidak dapat menyimpan pic inp_resp',err);
		});			
	}).fail(function(err){
		console.log('Tidak dapat menyimpan pic inp_subscriber',err);
	});
}
function savefb(callback){
	$('.inp_fb').makekeyvalparamreversequote();
	console.log("inp_fb",$(".inp_fb").attr("keyval"));
	$.ajax({
		url:'/fbs/saveupdate/',
		type:'post',
		data:JSON.parse('{'+$('.inp_fb').attr('keyval')+'}'),
		async:false
	}).done(function(data){
		console.log("Berhasil saveupdate",data);
		$.ajax({
			url:'/clients/update',
			data:{
				"id":$('#client_id').val(),
				"name":$('#clientnameori').val(),
				"clientcategory":$("#category_id").val(),
				"business_field":$('#businesstype :selected').text(),
				"phone":$('#clientphone').val(),
				"fax":$('#clientfax').val()},
			type:'post',
			async:false
		}).fail(function(err){
			console.log("Tidak dapat mengupdate tbl Client",err);
		}).done(function(dtclient){
			console.log('clientcategory sent',$("#category_id").val());
			console.log("Berhasil update clients",dtclient);
			$.ajax({
				url:'/client_sites/update',
				type:'post',
				data:{
					"id":$('#client_site_id').val(),
					"address":$('#clientaddress').val(),
					"phone":$('#clientphone').val(),
					"fax":$('#clientfax').val()
				},
				async:false
			}).done(function(dtsite){
				$.ajax({
					url:'/subscribeforms/setfbcomplete',
					data:{"id":$('#client_site_id').val()},
					type:'post'
				}).done(function(cs_id){
					$.ajax({
						url:'/fbs/updatefbdescription/',
						data:{
							nofb:data,
							description:$('#description').val(),
						},
						type:'post'
					})
					.done(function(res){
						console.log('success update FB description',res);
					})
					.fail(function(err){
						console.log('Failed save description',err);
					});
					console.log('set complete success',cs_id);
				});				
				/*end of set client complete*/
				callback(data);
			}).fail(function(errclientsite){
				console.log('Tidak dapat mengupdate tbl clientsite',errclientsite);
			});
			console.log("Berhasil mengupdate tbl Client",dtclient);
		});
		console.log('sukses',data);
		//window.location.href = '/subscribeforms';
	}).fail(function(err){
		console.log('Tidak dapat menyimpan / mengupdate fbs',err);
	});
}
$('#btn_save').click(function(){
	if($("#businesstype :selected").text()==="Pilihlah"){
		alert("Tipe Bisnis harus dipilih");
	}else{
		savefb(savepic);
	}
});
$('#businesstype').change(function(){
	checkbusinessfield();
});
$('#othersave').click(function(){
	
});
$.ajax({
	url:'/subscribeforms/getpics/'+$('#nofb').val(),
	type:'post',
	dataType:'json'
}).done(function(data){
	$('#nofb').html(data['nofb']);
	$('#siup').val(data['siup']);
	$('#npwp').val(data['npwp']);
	$('#clientname').val(data['name']);
	$('#businesstype').find('option').each(function(){
		if($(this).text()===data['businesstype']){
			$(this).attr('selected','selected');
		}
	});
	console.log('SERVICE --',data['service'])
	$('#services').val(data['service']);
	$('#clientaddress').val(data['address']);
	$('#clientphone').val(data['phone']);
	$('#clientfax').val(data['fax']);
	$('#subscriber_id').val(data['subscriber']['id']);
	$('#subscribername').val(data['subscriber']['name']);
	$('#subscriberposition').val(data['subscriber']['position']);
	$('#subscriberid').val(data['subscriber']['ktp']);
	$('#subscriberphone').val(data['subscriber']['phone']);
	$('#subscriberhp').val(data['subscriber']['hp']);
	$('#subscriberemail').val(data['subscriber']['email']);
	$('#resp_id').val(data['resp']['id']);
	$('#respname').val(data['resp']['name']);
	$('#respposition').val(data['resp']['position']);
	$('#respid').val(data['resp']['ktp']);
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
	console.log('thisdomain',thisdomain);
});
$.ajax({
	url:'/fbfees/getfees/'+nofb,
	type:'post',
	data:{client_id:$('#client_id').val(),feetype:'other',nofb:nofb},
	dataType:'json'
}).done(function(data){
	$.each(data,function(name,val){
		switch(name){
			case 'setup':
				$('#setupfee').val(val.dpp);
				$('#setupppn').val(val.ppn);
			break;
			case 'monthly':
				$('#monthlyfee').val(val.dpp);
				$('#monthlyppn').val(val.ppn);
			break;
			case 'device':
				$('#devicefee').val(val.dpp);
				$('#deviceppn').val(val.ppn);
			break;
			default:
				var othertext = '',
					setuptotal = 0;
				setuptotal += parseInt(val.dpp);
				setuptotal += parseInt(val.ppn);
	
				othertext += '<div class="row-form clearfix" feename="'+name+'">';
				othertext += '<div class="span3"><b>'+name+'</b></div>';
				othertext += '<div class="span3"><input type="text" value='+val.dpp+' class="autonum" /></div>';
				othertext += '<div class="span3"><input type="text" value='+val.ppn+' class="autonum" /></div>';
				othertext += '<div class="span3" id="othertotal">';
				othertext += '<span class="autonum">'+setuptotal+'</span>';
				othertext += '<button class="btn btn-mini btnremovefee" type="button">Hapus</button>';
				othertext += '</div>';
				othertext += '</div>';
				$('#fees').append(othertext);
				$('#fees').on('click',".btnremovefee",function(){
					console.log("Should be remove this row");
					myrow = $(this).stairUp({level:2});
					$.ajax({
						url:'/subscribeforms/removefee',
						data:{
							nofb:nofb,
							name:myrow.attr('feename')
						},
						type:'post'
					})
					.done(function(data){
						myrow.remove();
						console.log("Done remove fee");
					})
					.fail(function(err){
						console.log("Cannot remove fee",err);
					});
				});
			
				$('.autonum').autoNumeric('init');
			break;
		}
				$('.autonum').autoNumeric('update');	
	});
	console.log('data fb fees',data)
})
.fail(function(err){
	console.log("FAIL GET FEES,",err);
});
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
			//console.log('PIC Element',$(this).attr('id'),$(this).val());
		})
		$(this).find('.picelement').each(function(){
			//console.log('DEST Element',$(this).attr('id'),$(this).val());
		});
	},
});
//$('#clue-dragdrop').modal();
$('.myeditor')
.cleditor({width:'300',height:'160px',controls:"bold italic underline | color highlight removeformat | bullets numbering"});
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
		row+= '<td><a ><span class="icon-pencil"></span></a> <a><span class="icon-remove vasremove"></span></a></td>';
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
$("#ConfirmasiClose").click(function(){
	window.location.href = "/pfbses/index/"+$("#client_id").val();
});

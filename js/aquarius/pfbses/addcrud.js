$("#fbConfirmasiClose").click(function(){
	window.location.href = "/pfbses/index/"+$("#client_id").val();
});
function savepic_(nofb){
	$('.inp_subscriber').makekeyvalparam();
	$('.inp_resp').makekeyvalparam();
	$('.inp_teknis').makekeyvalparam();
	$('.inp_adm').makekeyvalparam();
	$('.inp_billing').makekeyvalparam();
	$('.inp_support').makekeyvalparam();
	txt = '{';
	txt+= '"obj":{';
	txt+= '"subscriber":{'+$('.inp_subscriber').attr('keyval')+',"createuser":"'+$('#createuser').val()+'"},';
	txt+= '"resp":{'+$('.inp_resp').attr('keyval')+',"createuser":"'+$('#createuser').val()+'"},';
	txt+= '"teknis":{'+$('.inp_teknis').attr('keyval')+',"createuser":"'+$('#createuser').val()+'"},';
	txt+= '"adm":{'+$('.inp_adm').attr('keyval')+',"createuser":"'+$('#createuser').val()+'"},';
	txt+= '"billing":{'+$('.inp_billing').attr('keyval')+',"createuser":"'+$('#createuser').val()+'"},';
    txt+= '"support":{'+$('.inp_support').attr('keyval')+',"createuser":"'+$('#createuser').val()+'"}';
	txt+= '}}';
	$.ajax({
		url:'/fbpics/saveupdate_',
		data:JSON.parse(txt),
		type:'post'
	})
	.done(function(res){
		console.log('RES',res);
		savefees_(nofb);
	})
	.fail(function(err){
		console.log('ERR',err);
	});
}
saveotherfees_ = function(nofb){
    saveotherfees(nofb,function(tmp){
		$.ajax({
			url:'/fbfees/saveupdateother_',
			data:{"data":tmp},
			type:'post'
		})
		.done(function(res){
			console.log('Other RES',res);
			$("#dFBConfirmasi").modal();
		})
		.fail(function(err){
			console.log('ERR',err);
		});
	
	})
}
saveotherfees = function(nofb,callback){
    txt = "";
    tmp = [];
	$(".othertext_").each(function(){
        that = $(this);
        $('.autonum').autoNumeric('init');
        obj = {};
		oname = that.find('.othername').html();
		odpp = that.find('.fee').autoNumeric('get');
		oppn = that.find('.ppn').autoNumeric('get');
		oclient_id = $("#client_id").val();

        obj.name = oname;
        obj.dpp = odpp;
        obj.ppn = oppn;
        obj.nofb = nofb;
        obj.client_id = oclient_id;
        tmp.push(obj);
    });
    callback(tmp);
}
function savefees_(nofb){
	txt = '{"data":{"setup":{';
	txt+= '	"client_id":"'+$('#client_id').val()+'",';
	txt+= '	"dpp":'+$('#setupfee').autoNumeric('get')+',';
	txt+= '	"ppn":'+$('#setupppn').autoNumeric('get')+',';
	txt+= '	"name":"setup","createuser":"'+$('#createuser').val()+'",';
	txt+= '	"nofb":"'+nofb+'"';
	txt+= '},';
	txt+= '"monthly":{';
	txt+= '	"client_id":"'+$('#client_id').val()+'",';
	txt+= '	"dpp":'+$('#monthlyfee').autoNumeric('get')+',';
	txt+= '	"ppn":'+$('#monthlyppn').autoNumeric('get')+',';
	txt+= '	"name":"monthly",';
	txt+= '	"createuser":"'+$('#createuser').val()+'",';
	txt+= '	"nofb":"'+nofb+'"';
	txt+= '},';
	txt+= '"device":{';
	txt+= '	"client_id":"'+$('#client_id').val()+'",';
	txt+= '	"dpp":'+$('#devicefee').autoNumeric('get')+',';
	txt+= '	"ppn":'+$('#deviceppn').autoNumeric('get')+',';
	txt+= '	"name":"device",';
	txt+= '	"nofb":"'+nofb+'",';
	txt+= '	"createuser":"'+$('#createuser').val()+'"';
	txt+= '}}}';
	console.log('TZT',txt);
	$.ajax({
		url:'/fbfees/saveupdate_',
		data:JSON.parse(txt),
		type:'post'
	})
	.done(function(res){
        console.log('Fee RES',res);
		saveservices(nofb,savedocuments($('.checkdocument'),nofb));
	})
	.fail(function(err){
		console.log('ERR',err);
	});
}
savefb = function(callback){
	if($("#activationdate").val()===""){
		$("#activationdate").removeClass("inp_fb");
	}else{
		$("#activationdate").addClass("inp_fb");
	}
	if($("#period1").val()===""){
		$("#period1").removeClass("inp_fb");
	}else{
		$("#period1").addClass("inp_fb");
	}
	if($("#period2").val()===""){
		$("#period2").removeClass("inp_fb");
	}else{
		$("#period2").addClass("inp_fb");
	}
	$('.inp_fb').makekeyvalparam();
	console.log("Keys",$(".inp_fb").attr("keyval"))
	$.ajax({
		url:'/fbs/saveupdate/',
		type:'post',
		data:JSON.parse('{'+$('.inp_fb').attr('keyval')+'}'),
		async:false
	}).done(function(data){
		console.log("Berhasil saveupdate FB",data);
		$.ajax({
			url:'/clients/update',
			data:{
				"id":$('#client_id').val(),
				"name":$('#clientnameori').val().replace("'","''"),
				"business_field":$('#businesstype :selected').text(),
				"phone":$('#clientphone').val(),
				"fax":$('#clientfax').val(),
				"category_id":$("#category_id").val()
			},
			type:'post',
			async:false
		}).fail(function(err){
			console.log("Tidak dapat mengupdate tbl Client",err);
		}).done(function(dtclient){
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
                    console.log('set complete success',cs_id);
                    callback(data);
				});				
			}).fail(function(){
				console.log('Tidak dapat mengupdate tbl clientsite');
			});
			console.log("Berhasil mengupdate tbl Client",dtclient);
		});
		console.log('sukses',data);
	}).fail(function(err){
		console.log('Tidak dapat menyimpan / mengupdate fbs',err);
	});
}
saveservices = function(fb_id,callback){
	console.log("SAVE SERVICES FB ID",fb_id);
	$('#tservice tbody tr').each(function(){
		that = $(this);
		servicecategory = that.find('.servicecategory').html();
		info = that.find('.info a').html();
		upk = that.find(".info").attr("upk");
		upm = that.find(".info").attr("upm");
		dnk = that.find(".info").attr("dnk");
		dnm = that.find(".info").attr("dnm");
		upstring = that.find(".info").attr("upstring");
		dnstring = that.find(".info").attr("dnstring");
		space = that.find("td.info").attr("space");
		bandwidth = that.find("td.info").attr("bandwidth");
		$.ajax({
			url:'/pfbses/saveservice',
			data:{
				fb_id:fb_id,
				category:servicecategory,
				upm:upm,
				upk:upk,
				upstr:upstring,
				dnm:dnm,
				dnk:dnk,
				dnstr:dnstring,
				name:info,
				space:space,
				bandwidth:bandwidth,
				createuser:'puji'
			},
			type:'post',
			async: false
		})
		.done(function(res){
			console.log('Success Save Services',res);
            callback;
		})
		.fail(function(err){
			console.log('Err Save Services',err);
		})
	});
}
savedocuments = function(documents,nofb){
	checkdocument(documents,nofb,function(_data){
		$.ajax({
			url:'/pfbses/documentsaveupdate',
			data:{'data':_data},
			type:'post',
		})
		.done(function(res){
			console.log('Documents Res',res);
			savevas_(nofb);
		})
		.fail(function(err){
			console.log('Err',err);
		})
	});
}
savevas_ = function(nofb){
	savevas($(".tclientvases tbody tr"),$("#client_id").val(),function(_data){
        if($(".tclientvases tbody tr").length>0){
            $.each(_data,function(x,y){
                console.log('_data',x,y);
            })
            $.ajax({
                url:'/pfbses/savevas',
                data:{
                    'data':_data
                },
                type:'post'
            })
            .done(function(res){
                console.log('VAS Res',res);
                
            })
            .fail(function(err){
                console.log('Err',err);
            });
        }
        saveotherfees_(nofb);
	});
}
savevas = function(vas,clientid,callback){
	obj = [];
	vas.each(function(){
		that = $(this);
		name = that.find('.vasname').html();
		vasid = that.find('.vasname').attr('vasid');
		console.log('Name',name);
		tmp = {};
		tmp['clientid'] = clientid;
		tmp['document'] = name;
		tmp['vasid'] = vasid;
		tmp['createuser'] = 'puji';
		obj.push(tmp);
	});
	callback(obj);
}

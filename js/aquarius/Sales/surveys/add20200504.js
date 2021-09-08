(function($){
    if($("#resume").length > 0){
        editor = $("#resume").cleditor({width:"100%", height:"100%"})[0].focus();
    }
    checkClientCategory = function(){
        if($('#clientcategory').val()=='0'){
            alert("Kategori Klien harus diisi");
            return false;
        }else{
            return true;
        }
    }
    checkMandatory = function(){
        return checkClientCategory();
    }
    saverequest = function(obj,callback){
        console.log("Save Request Invoked",obj)
        $.ajax({
            url:'/surveys/save',
            data:obj,
            type:'post',
        })
        .done(function(res){
            console.log('Save Survey result',res);
            callback(res);
        })
        .fail(function(err){
            console.log('Save Survey failed',err);
            callback(err);
        });
}
    saveclientsite = function(obj,callback){
        $.ajax({
            url:'/client_sites/save',
            data:obj,
            type:'post',
        })
        .done(function(res){
            console.log("Success save CLient_sites",res);
            callback(res);
        })
        .fail(function(err){
            console.log("Error save CLient_sites",err);
            callback(err);
        });    
    }
    savesurveysite = function(obj,callback){
        $.ajax({
            url:'/survey_sites/save',
            data:obj,
            type:'post',
            dataType:'json'
        })
        .done(function(res){
            console.log("Success save Survey_sites",res);
            callback(res);
        })
        .fail(function(err){
            console.log("Error save Survey_sites",err);
            callback(err);
        });
    }
    getMysqlDate = function(datepicker,hour,minute,callback){
        let x = datepicker.split("/");
        callback(x[2]+'-'+x[1]+'-'+x[0]+' '+hour+':'+minute);
    }
    callSaveSurveySite = function(obj){
        savesurveysite({
            survey_request_id:obj.survey_request_id,
            client_site_id:obj.client_site_id,
            survey_date:obj.survey_date,
            client_id:$('#clientid').val(),
            service_id:$('#service_id').val(),
            sale_id:$('#sale_id').val(),
            branch_id__:$('#branch_id').val(),
            address:$('#site_address').val(),
            city:$('#site_city').val(),
            install_area:$('#install_area').val(),
            pic_name:$('#site_pic').val(),
            pic_phone:$('#pic_phone').val(),
            pic_email:$('#site_pic_email').val(),
            pic_position:$('#site_pic_position').val(),
            createuser:$('#createuser').val(),
            description:$('#resume').val()
        },function(res){
            console.log(res);
            $("#dModal").modal();
            $("#survey_save").attr("disabled",true);
        })
    }
    callSaveClientSite = function(obj){
        saveclientsite({
            survey_request_id:obj.survey_request_id,
            client_id:$('#clientid').val(),
            service_id:$('#service_id').val(),
            sale_id:$('#sale_id').val(),
            branch_id__:$('#branch_id').val(),
            address:$('#site_address').val(),
            city:$('#site_city').val(),
            install_area:$('#install_area').val(),
            pic_name:$('#site_pic').val(),
            pic_phone:$('#pic_phone').val(),
            pic_email:$('#site_pic_email').val(),
            pic_position:$('#site_pic_position').val(),
            createuser:$('#createuser').val()
        },function(client_site_id){
            callSaveSurveySite({survey_request_id:obj.survey_request_id,client_site_id:client_site_id,survey_date:obj.survey_date,description:$('#resume').val()})
        })
    }
    callSaveRequest = function(surveydate){
        saverequest({
            client_id:$('#clientid').val(),
            branch_id:$('#branch_id').val(),
            service_id:$('#service_id').val(),
            survey_date:surveydate,
            pic_name:$('#site_pic').val(),
            pic_phone:$('#pic_phone').val(),
            pic_email:$('#site_pic_email').val(),
            pic_position:$('#site_pic_position').val(),
            address:$('#address').val(),
            city:$('#site_city').val(),
            install_area:$('#install_area').val(),
            has_ladder:$('#has_ladder').val(),
            description:$('#resume').val()
        },function(requestid){
            callSaveClientSite({survey_request_id:requestid,survey_date:surveydate,description:$('#resume').val()});
        })
    }
    $('#survey_save').click(function () {
        if(checkMandatory()){
            getMysqlDate($('#survey_date').val(),$('#filterhour1').val(),$('#filterminute1').val(),function(surveydate){
                callSaveRequest(surveydate);
            })
        }
    });
    $("#dModal").on("hidden.bs.modal",function(e){
        window.location.href = "/surveys"
    })
}(jQuery));

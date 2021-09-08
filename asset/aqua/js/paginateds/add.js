(function($){
    $('#btnSave').click(function(){
        $.ajax({
            url:'/paginateds/save',
            data:{
                parentid:$('#parentid').val(),
                reporter:$('#reporter').val(),
                reporterphone:$('#reporterphone').val(),
                ticketstart:$('#ticketstart').val(),
                complain:$('#complain').val(),
                description:$('#description').val(),
                client_id:$('#clientid').val(),
                client_site_id:$('#client_site_id').val(),
                clientname:$('#client_id').val(),
                requesttype:'pelanggan'
            },
            type:'post',
            dataType:'json'
        })
        .done(function(res){
            console.log(res);
            window.location.href = '/paginateds/'
        })
        .fail(function(err){
            console.log('Error save',err);
        })
    })
    $('#client_id').on('change',function(){
        console.log($(this).val());
    })
    $("#client_id").keyup(function(){
        console.log('Client Name sent',$(this).val());
        $.ajax({
            type: "POST",
            url: "/paginateds/clients",
            data:{'name':$(this).val()},
            beforeSend: function(){
                $("#client_id").css("background","#FFF url(/asset/images/LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                console.log("Data received",data);
                $("#dugaanpelanggan").show();
                $("#dugaanpelanggan").html(data);
                $("#client_id").css("background","#FFF");
            }
        })
        .fail(function(err){
            console.log("Failed ajax",err);
        });
    });
    $("#client_id").on("focus",function(){
        $(this).select();
    })
    $.fn.populate = function(options){
        var settings = $.extend({
            url:'/'
        },options);
        _this = $(this);
        _this.empty();
        $.ajax({
            url:'/'+settings.url,
            type:'get'
        })
        .done(function(res){
            console.log('Result of site populate',settings.url,res)
            _this.append(res);
        })
        .fail(function(err){
            console.log("Error",err)
        });
        return this;
    }
}(jQuery))
function selectClient(client_id,val) {
    $("#client_id").val(val);
    $("#dugaanpelanggan").hide();
    $("#clientid").val(client_id);
    populateClientSites(client_id);
}
function populateClientSites(client_id){
    $("#client_site_id").empty();
    $("#client_site_id").populate({
        url:'/teknis-tickets/paginateds/getclientsites/'+client_id,
    })
}
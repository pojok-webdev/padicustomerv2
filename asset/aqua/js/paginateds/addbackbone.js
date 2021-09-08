getTableRownums = function(callback){
    callback(1+$('#tClient tbody tr').length);
}
$('#btnAssociateClientBackbone').click(function(){
    console.log("Add Client Backbone Assciation invoked");
    console.log('Client Site Id',$('#client_site_id').val());
    console.log('Client Id',$('#clientid').val());
    getTableRownums(function(rownum){
        tr = '<tr clientid='+$('#clientid').val()+' client_site_id='+$('#client_site_id').val()+'>';
        tr+= '<td class="rownum">'+rownum+'</td>';
        tr+= '<td class="info">';
        tr+= '<span class="client">'+$('#client_id').val()+'</span> ';
        tr+= '<span class="client_site">'+$('#client_site_id').text()+'</span>';
        tr+= '</td>';
        tr+= '<td>';
        tr+= '<span class="client_id">'+$('#clientid').val()+'</span>';
        tr+= '<span class="client_site_id">'+$('#client_site_id').val()+'</span>';
        tr+= '</td>';
        tr+= '<td>';
        tr+= '<a type="btn" class="removeRow">Hapus</a>';
            tr+= '</td>';
        tr+= '</tr>';
        $("#tClient tbody").append(tr);
        $('#clientamount').html(rownum);
    })
})
$('#tClient').on('click','.removeRow',function(){
    removeRow($(this),function(x){
        $('#clientamount').html(x);
    })
})
removeRow = function(row,callback){
    row.stairUp({level:2}).remove();
    x = 0;
    $('#tClient tbody tr').each(function(){
        $(this).find('.rownum').html(++x);
    });
    callback(x);
}
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
    $.ajax({
        url:'/'+settings.url,
        type:'get'
    })
    .done(function(res){
        console.log('Result',settings.url,res)
        _this.append(res);
    })
    .fail(function(err){
        console.log("Error",err)
    });
    return this;
}
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
$('#saveBackbone').click(function(){
    $.ajax({
        url:'/backbones/save',
        data:{
            'backbone_id':$('#backboneid').val(),
            'clientname':$('#backboneid :selected').text(),
            'reporter':$('#reporter').val(),
            'reporterphone':$('#reporterphone').val(),
            'ticketstart':$('#ticketstart').val(),
            'complaint':$('#complain').val(),
            'description':$('#description').val(),
            'requesttype':'backbone'
        },
        type:'post',
        dataType:'json'
    })
    .done(function(parent){
       insertClients(parent.id);
       console.log("Success ssave backbone",parent.id);
    })
    .fail(function(err){
        console.log("Error ssave backbone",err);
    });
});
insertClients = function(parentid){
    $('#tClient tbody tr').each(function(){
        console.log('Client Name',$(this).find('.client').text());
        console.log('Client ID',$(this).attr('clientid'));
        console.log('Client Site ID',$(this).attr('client_site_id'));
        $.ajax({
            url:'/backbones/clientsave',
            data:{
                'parentid':parentid,
                'client_id':$(this).attr('clientid'),
                'client_site_id':$(this).attr('client_site_id'),
                'clientname':$(this).find('.client').text(),
                'reporter':$('#reporter').val(),
                'reporterphone':$('#reporterphone').val(),
                'ticketstart':$('#ticketstart').val(),
                'complaint':$('#complain').val(),
                'description':$('#description').val(),
                'requesttype':'pelanggan'
            },
            type:'post',
            dataType:'json'
        })
        .done(function(res){
            console.log("Success saveBackboneClient",res);
        })
        .fail(function(err){
            console.log("Failed saveBackboneClient",err);
        });
    ;
    })
}
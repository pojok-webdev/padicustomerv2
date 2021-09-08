$('.btn_addvsd').click(function(){
  console.log('vsd invoked');
});
upload = function(obj,callback){
    obj.append('install_id','1');
    obj.append('file',file_data);
    callback(obj);
}
loadfiles = function(siteid,callback){
    $.ajax({
        url:'/install_requests/getvsds/'+siteid,
        type:'get',
        dataType:'json'
    })
    .done(function(res){
        console.log('Hasil VSDS',res);
        callback(res);
    })
    .fail(function(err){
        console.log('Err',err);
    });
}
loadfiles(944,function(files){
    console.log('Files',files);
});
async function saveFile(){
    $('.vsds tbody').empty();
    $('body').css('cursor','progress');
    file_data = $('#sortpicture').prop('files')[0];
    form_data = new FormData();
    form_data.append('file',file_data,$('#install_site_id').val());
        $.ajax({
            url:'/pinstalls/do_upload',
            enctype: 'multipart/form-data',
            type:'post',
            contentType:false,
            processData:false,
            data:form_data,
        })
        .done(function(data){
            console.log('success',data);
            loadfiles($('#install_site_id').val(),function(files){
                populateFiles(files,function(){
                    $('body').css('cursor','default');
                    console.log('Files uploaded',files);
                });
            });
        })
        .fail(function(err){
            console.log('error',err);
        });    
}
populateFiles = function(vsds,callback){
    vsds.forEach(function(vsd){
        tr = '<tr trid="'+vsd+'">';
        tr+= '<td class="info">';
        tr+= '<a href="/install_requests/download/'+vsd+'">';
        tr+= '  File: '+vsd+'';
        tr+= '</a>';
        tr+= '</td>';
        tr+= '</tr>';
        $('.vsds tbody').append(tr);    
    })
    callback();
}
$('#fileupload').click(function(){
    $("#sortpicture").click();
})
loadvsds = function(){
    $.ajax({
        url:'/pinstalls/getfiles/'+$('#install_site_id').val(),
        dataType:'json'
    })
    .done(function(res){
        console.log('Res',res);
    })
    .fail(function(err){
        console.log('Err',err);
    });
}
document.getElementById('sortpicture').addEventListener("change",saveFile,false);
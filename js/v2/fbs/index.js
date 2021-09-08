$("#tFbs").dataTable();
$("#tFbs").on("click",".btncancelfb",function(){
    _this = $(this);
    mynofb = $(this).stairUp({level:5}).find(".nofb").html();
    $.ajax({
        url:'/pfbses/update/',
        data:{nofb:mynofb,status:'2'},
        type:"post"
    })
    .done(function(data){
        _this.stairUp({level:5}).find(".status").html("Canceled");
        console.log("fb updated",data);
    })
    .fail(function(err){
        console.log("error update fb",err);
    });
})
$("#tFbs").on("click",".btnsetvalidfb",function(){
    _this = $(this);
    mynofb = $(this).stairUp({level:5}).find(".nofb").html();
    $.ajax({
        url:'/pfbses/update/',
        data:{nofb:mynofb,status:'1'},
        type:"post"
    })
    .done(function(data){
        _this.stairUp({level:5}).find(".status").html("Valid");
        console.log("fb updated",data);
    })
    .fail(function(err){
        console.log("error update fb",err);
    });
})
$("#tFbs").on("click",".btnsetignorefb",function(){
    _this = $(this);
    mynofb = $(this).stairUp({level:5}).find(".nofb").html();
    $.ajax({
        url:'/pfbses/update/',
        data:{nofb:mynofb,status:'0'},
        type:"post"
    })
    .done(function(data){
        _this.stairUp({level:5}).find(".status").html("Ignore");
        console.log("fb updated",data);
    })
    .fail(function(err){
        console.log("error update fb",err);
    });
})
showConfirmModal = function(obj,yesEvent){
    $('#question').html(obj.question)
    $('#myModalLabel').html(obj.modalLabel)
    $('#confirmModal').modal();
    $('#confirmYes').click(yesEvent);
}
$('#tFbs').on('click','.btnRemove',function(){
    console.log('Remove FB invoked');
    _this = $(this);
    mynofb = $(this).stairUp({level:5}).find(".nofb").html();
    tr = $(this).stairUp({level:5});
    showConfirmModal({
        question:'Yakin mau menghapus FB.. '+mynofb+' ?',
        modalLabel: 'Konfirmasi Penghapusan FB'
    },function(){
        $.ajax({
            url:'/pfbses/backupfb/'+mynofb
        })
        .done(function(res){
            console.log(res);
            $.ajax({
                url:'/pfbses/removefb/'+mynofb
            })
            .done(function(res){
                console.log(res);
                tr.remove();
            })
            .fail(function(err){
                console.log('Err',err);
            });
    
        })
        .fail(function(err){
            console.log('Err',err);
        });
    })
})
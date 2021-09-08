$('#btnaddserver').on("click",function(){
    $("#dAddServer").modal();
})
$("#btnsaveservertrouble").on("click",function(){
    $.ajax({
        url:'/tickets/saveServerTicket',
        data:{
            name:$('#servername').val(),
            ipaddress:$('#ipaddress').val(),
            start:$('#start').val(),
            end:$('#end').val(),
            description:$('#serverdescription').val(),
            createuser:$('#servername').val()
        },
        type:'post'
    })
    .done(function(data){
        console.log("Success save Server Ticket",data);
    })
    .fail(function(err){
        console.log("Failed save Server Ticket",err);
    });
    $("#stopServerTiicket").mask('99/99/9999');
    $("#startServerTiicket").mask('99/99/9999-99:99');    
})
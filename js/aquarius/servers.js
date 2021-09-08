console.log("_createuser",getUserName());
$("#addserver").on("click",function(){
    console.log("Add Server invoked");
    $("#update_server").hide();
    $("#save_server").show();
    $("#server_name").val("");
    $("#ipaddress").val("");
    $("#description").val("");
    $("#dAddServer").modal();
});
$("#save_server").on("click",function(){
    $.ajax({
        url:'/pservers/save',
        data:{
            name:$('#server_name').val(),
            ipaddr:$('#ipaddress').val(),
            description:$('#description').val(),
            createuser:getUserName()
        },
        type:'post'
    })
    .done(function(data){
        newRow = "<tr thisid="+data+">";
        newRow+= "<td class='serverid'>"+data+"</td>";
        newRow+= "<td class='servername'>"+$('#server_name').val()+"</td>";
        newRow+= "<td class='ipaddr'>"+$('#ipaddress').val()+"</td>";
        newRow+= "<td class='description'>"+$('#description').val()+"</td>";
        newRow+= "<td>";
        newRow+= "    <div class='btn-group'>";
        newRow+= "        <button data-toggle='dropdown' class='btn btn-small dropdown-toggle' >";
        newRow+= "        Aksi ";
        newRow+= "        <span class='caret'></span>";
        newRow+= "        </button>";
        newRow+= "        <ul class='dropdown-menu pull-right'>";
        newRow+= "            <li class='edit_server'><a href='#'>Edit Server</a></li>";
        newRow+= "            <li class='remove_server' ><a>Hapus Server</a></li>";
        newRow+= "        </ul>";
        newRow+= "    </div>";
        newRow+= "</td>";
        newRow+= "</tr>";
        $("#tServer tbody").prepend(newRow);
    })
    .fail(function(err){
        console.log("Save Server failed",err);
    });
})
$("#tServer").on("click","li.remove_server",function(){
    serverid = $(this).stairUp({level:4}).attr('thisid');
    $("#tServer tbody tr").removeClass("selected");
    $(this).stairUp({level:4}).addClass('selected');
    $("#modal_server_id").html(serverid)
    $("#dremoveconfirmation").modal();
})
$("#tServer").on("click","li.edit_server",function(){
    serverid = $(this).stairUp({level:4}).attr('thisid');
    $("#tServer tbody tr").removeClass("selected");
    $(this).stairUp({level:4}).addClass('selected');
    $.ajax({
        url:'/pservers/getbyid/'+serverid,
        type:'get',
        dataType:'json'
    })
    .done(function(data){
        console.log("Data retrieved",data);
        $("#server_name").val(data.name);
        $("#ipaddress").val(data.ipaddr);
        $("#description").val(data.description);
        $("#modal_server_id").html(serverid);
        $("#update_server").show();
        $("#save_server").hide();
        $("#dAddServer").modal();
    })
    .fail(function(err){});
})
$(".closemodal").on("click",function(){
    $(this).stairUp({level:3}).modal("hide");
})
$("#agree_server_remove").on("click",function(){
    selected = $("#tServer tbody tr.selected");
    serverid = selected.attr("thisid");
    $.ajax({
        url:'/pservers/remove/'+serverid,
        type:'get'
    })
    .done(data=>{
        selected.remove();
    })
    .fail(err=>{
        console.log("Failed remove data",err)
    });
})
$("#update_server").on("click",function(){
    selected = $("#tServer tbody tr.selected");
    serverid = selected.attr("thisid");
    $.ajax({
        url:'/pservers/update',
        data:{
            id:serverid,
            name:$("#server_name").val(),
            ipaddr:$("#ipaddress").val(),
            description:$("#description").val()
        },
        type:'post'
    })
    .done(function(data){
        console.log("Success update server",data);
        selected.find(".server_name").html($("#server_name").val());
        selected.find(".ipaddr").html($("#ipaddress").val());
        selected.find(".description").html($("#description").val());
    })
    .fail(function(err){
        console.log("Failed update server",err);
    });
})
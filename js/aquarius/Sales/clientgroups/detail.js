$(function(jQuery){
    var easyoptions = {
        url:'/pclients/getclients3',
        getValue: "name",
        list: {
            match: {
                enabled: true
            },
            onClickEvent:function(){},
            onSelectItemEvent: function() {
                var code = $("#clientname").getSelectedItemData().id,
                name = $("#clientname").getSelectedItemData().name;
                $("#clientname").attr("key",code);
                console.log("Code",code);
            }
        }
    };        
    $("#clientname").easyAutocomplete(easyoptions);
    $(".closemodal").click(function(){
        $(this).stairUp({level:3}).modal('hide');
    });
    $("#clientname").click(function(){
        $(this).select();
    });
    $("#penambahangroup").click(function(){
        $("#groupModalLabel").html("Penambahan Pelanggan");
        $("#savegroup").show();
        $("#updategroup").hide();
        $("#saveclient").show();
        $("#updateclient").hide();
      //  $("#dAddClient").modal();
    });
    $("#tClientGroups").on("click",".removeClient",function(){
        id = $(this).stairUp({level:5}).attr("thisid");
        console.log("ID",id);
        $("#tClientGroups tbody tr").removeClass("selected");
        $(this).stairUp({level:5}).addClass("selected");
        $.ajax({
            url:'/pclientgroups/removeclient/'+clientgroup_id+'/'+id,
            type:"get"
        })
        .done(function(res){
            console.log("Res",res);
            $("#tClientGroups tbody tr.selected").remove();
        })
        .fail(function(err){
            console.log("Err",err);
        });
    })
    $("#savegroup").click(function(){
        $.ajax({
            url:'/pclientgroups/save',
            data:{
                name:$('#groupname').val(),
            },
            type:'post'
        })
        .done(function(res){
            console.log("Res",res);
        })
        .fail(function(err){
            console.log("Err",err);
        });
    });
    $("#btnsaveclient").click(function(){
        console.log("ClientName KEY",$("#clientname").attr("key"));
        $.ajax({
            url:'/pclientgroups/saveclient',
            data:{
                "clientgroup_id":clientgroup_id,
                "client_id":$("#clientname").attr("key")
            },
            type:"post"
        })
        .done(function(res){
            console.log("Save Client Result",res);
            $.ajax({
                url:'/pclients/getclientbyid/'+$("#clientname").attr("key"),
                dataType:'json'
            })
            .done(function(res){
                detail = "<tr thisid='<?php echo $obj->id;?>'>";
                detail+= "<td class='groupname'>"+$("#clientname").val()+"</td>";
                detail+= "<td class='address'>"+res.address+"</td>";
                detail+= "<td>";
                detail+= "<div class='btn-group'>";
                detail+= "<button data-toggle='dropdown' class='btn dropdown-toggle' >Action <span class='caret'></span></button>";
                detail+= "<ul class='dropdown-menu pull-left'>";
                detail+= "<li class='btn_edit pointer'>";
                detail+= "<a class='groupedit'>Edit</a>";
                detail+= "</li>";
                detail+= "<li class='divider'></li>";
                detail+= "<li class='btnReport pointer'>";
                detail+= "<a class='addClient'>Penambahan Pelanggan</a>";
                detail+= "</li>";
                detail+= "</ul>";
                detail+= "</div>";
                detail+= "</td>";
                detail+= "</tr>";


                detail = "<tr thisid='<?php echo $obj->clientid;?>'>";
				detail+= "<td class='groupname'>"+$("#clientname").val()+"</td>";
				detail+= "<td title='"+res.services+"' class='tt'>"+res.services+"</td>";
				detail+= "<td>"+res.am+"</td>";
				detail+= "<td>"+res.address+"</td>";
				detail+= "<td title='"+res.pic+"' class='tt'>"+res.pic+"</td>";
				detail+= "<td>"+res.dpp+"</td>";
				detail+= "<td>";
				detail+= "<div class='btn-group'>";
				detail+= "<button data-toggle='dropdown' class='btn dropdown-toggle' >Action <span class='caret'></span></button>";
				detail+= "<ul class='dropdown-menu pull-right'>";
				detail+= "	<li class='btnReport pointer'>";
				detail+= "		<a class='removeClient'>Hapus</a>";
				detail+= "	</li>";
				detail+= "</ul>";
				detail+= "</div>";
				detail+= "</td>";
                detail+= "</tr>";
                $("#tClientGroups tbody").append(detail);    
            })
            .fail(function(err){
                console.log("Err",err);
            });
        })
        .fail(function(err){
            console.log("Err",err);
        });
    });
    $("#tClientGroups").on("click",".groupedit",function(){
        $("#tClientGroups tbody tr").removeClass("selected");
        $("#savegroup").hide();
        $("#updategroup").show();
        $("#groupModalLabel").html("Edit Pelanggan");
        id = $(this).stairUp({level:5}).attr('thisid');
        $(this).stairUp({level:5}).addClass("selected");
        $.ajax({
            url:'/pclientgroups/get/'+id,
            type:'get',
            dataType:'json'
        })
        .done(function(res){
            console.log("Res",res);
            $("#groupname").val(res.name);
            $("#description").val(res.description);
        })
        .fail(function(err){
            console.log("Err",err);
        });
        $("#dAddGroup").modal();
    });
    $("#updategroup").click(function(){
        console.log("Description",$('#description').val());
        $.ajax({
            url:'/pclientgroups/update',
            data:{
                id:$("#tClientGroups tbody tr.selected").attr("thisid"),
                name:$('#groupname').val(),
                description:$('#description').val()
            },
            type:'post',
        })
        .done(function(res){
            console.log("Res",res);
            $("#tClientGroups tbody tr.selected .groupname").html($("#groupname").val());
            $("#tClientGroups tbody tr.selected .description").html($("#description").val());
        })
        .fail(function(err){
            console.log("Err",err);
        })
    });
    $("#tClientGroups").on("click",".viewDetail",function(){
        id = $(this).stairUp({level:5}).attr("thisid");
        window.location.href = '/pclientgroups/viewdetail/'+id;
    });
})
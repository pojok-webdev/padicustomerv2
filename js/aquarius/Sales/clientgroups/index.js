$(function(jQuery){
    $(".closemodal").click(function(){
        $(this).stairUp({level:3}).modal('hide');
    });
    $("#penambahangroup").click(function(){
        $("#groupModalLabel").html("Penambahan Grup");
        $("#savegroup").show();
        $("#updategroup").hide();
        $("#dAddGroup").modal();
    });
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
    $("#tClientGroups").on("click",".addClient",function(){
        $("#tClientGroups tbody tr").removeClass("selected");
        /*$.ajax({
            url:'/pclients/getclients',
            datatype:'json'
        })
        .done(function(res){
            console.log("Res",res);
            obj = JSON.parse(res);
            $('#clientname').autocomp({
                data:obj,
            });            
        })
        .fail(function(err){
            console.log("Err",err);
        });*/
        var options = {
            url: "/assets/jquery/easyautocomplete/sample.json",
            getValue: "name",
            list: {
                match: {
                    enabled: true
                },
                onClickEvent:function(){},
                onSelectItemEvent: function() {
                    var code = $("#clientname").getSelectedItemData().code,
                    name = $("#clientname").getSelectedItemData().name;
                    //$("#index-holder").val(name).trigger("change");
                    console.log("Code",code);
                }
            }
        };
        $("#clientname").easyAutocomplete(options);

        $(this).stairUp({level:5}).addClass("selected");
        $("#dAddClient").modal();
    });
    $("#saveclient").click(function(){
        console.log("ClientName KEY",$("#clientname").attr("key"));
        $.ajax({
            url:'/pclientgroups/saveclient',
            data:{
                "clientgroup_id":$("#tClientGroups tbody tr.selected").attr("thisid"),
                "client_id":$("#clientname").attr("key")
            },
            type:"post"
        })
        .done(function(res){
            console.log("Res",res);
        })
        .fail(function(err){
            console.log("Err",err);
        });
    });
    $("#tClientGroups").on("click",".groupedit",function(){
        $("#tClientGroups tbody tr").removeClass("selected");
        $("#savegroup").hide();
        $("#updategroup").show();
        $("#groupModalLabel").html("Edit Grup");
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
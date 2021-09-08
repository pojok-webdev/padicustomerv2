$('#tTroubleshoot').on('click','.btnAddFu',function(){
    console.log('fu_Modal invoked');
    tr = $(this).stairUp({level:5});
    $('#tTroubleshoot tbody tr').removeClass('selected');
    tr.addClass('selected');
    id = tr.attr('myid');
    clientname = tr.find('.clientname').html();
    $('#FUModalLabel').html(clientname);
    $('#fu_Modal').modal();
})
$('#btnUpload').click(function(){
    $('#uploadPicture').click();
});
$('#uploadPicture').change(function(evt){
    $('body').css('cursor','progress');
    //console.log($('#uploadPicture').prop('files')[0]);
    var fileReader = new FileReader();
    fileReader.onload = function(){
        resizeImage2(fileReader.result,200, function(result){
            console.log('resizeImage2 invokd');
            tr = '<tr>';
            tr+= '<td>';
            tr+= '<img src="'+result+'" alt="" class="img1">';
            tr+= '</td>';
            tr+= '<td>';
            tr+= '<button class="btn btn-danger btnRemoveImage pointer">Remove</button>';
            tr+= '</td>';
            tr+= '</tr>';
            $('#addfuimages tbody').append(tr);
            $('body').css('cursor','default');
        });
    }
    fileReader.readAsDataURL(evt.target.files[0]);
});
function loadImage1(evt){
    var input = evt.target;
    var filereader = new FileReader();
    filereader.onload = function(){
        resizeImage(filereader.result, function(result){
            $("#output").attr("src",result);
            $("#addImage").val(result);
        })
    }
    filereader.readAsDataURL(input.files[0]);
}
$('#addfuimages').on('click','.btnRemoveImage',function(){
    $(this).stairUp({level:2}).remove();
})
$('.cleditor').cleditor(
    {
        width:'400px',
        height:'160px',
        controls:"bold italic underline | color highlight removeformat | bullets numbering"
    }
);
$("#btnSaveFu").click(function(){
    $('body').css('cursor','progress');
    console.log('Save Fu invoked');
    $.ajax({
        url:'/troubleshoots/savefu',
        data:{
            activities:$('#fuactivities').val(),
            troubleshoot_id:$('#tTroubleshoot tbody tr.selected').attr('myid'),
            user_id:1
        },
        type:'post'
    })
    .done(function(id){
        console.log('Success save fu',id);
        var _dt = new Date();
        saveImages(id,function(){
            tr = '<tr myid='+id+'>';
            tr+= '<td>'+_dt.getFullYear()+'-'+_dt.getMonth()+'-'+_dt.getDay()+' '+'</td>';
            tr+= '<td>'+$('#fuactivities').val()+'</td>';
            tr+= '<td>'+'Admin'+'</td>';
            tr+= '<td>';
            tr+= '<div class="btn-group">';
            tr+= '<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>';
            tr+= '<ul class="dropdown-menu">';
            tr+= '<li class="showImages pointer"><a>Show Images</a></li>';
            tr+= '<li class="divider"></li>';
            tr+= '<li class="removeFu pointer"><a>Remove</a></li>';
            tr+= '</ul>';
            tr+= '</div>';
            tr+= '</td>';
            tr+= '</tr>';
            $('#fus tbody').append(tr);
        });
        $('body').css('cursor','default');
    })
    .fail(function(id){
        console.log('Failed save fu',id);
        $('body').css('cursor','default');
    });
});
saveImages = function(troubleshoot_fu_id,callback){
    $('body').css('cursor','progress');
    console.log("Close Image DIalog Invoked");
    $('#addfuimages tbody tr').each(function(){
        console.log('src',$(this).find('.img1').attr('src'));
        $.ajax({
            url:'/troubleshoots/savefuimage',
            data:
            {
                img:$(this).find('.img1').attr('src'),
                troubleshoot_fu_id:troubleshoot_fu_id,
                user_id:1
            },
            type:'post'
        })
        .done(function(res){
            $('body').css('cursor','default');
            console.log('Success save images',res);
            callback();
        })
        .fail(function(res){
            console.log('Failed save images',res);
            $('body').css('cursor','default');
        });
    })
}
$("#btnClose").click(function(){
    saveImages();
});
$("#tTroubleshoot tbody tr").on('click','.btnShowFu',function(){
    $('body').css('cursor','progress');
    tr = $(this).stairUp({level:5});
    $('#tTroubleshoot tbody tr').removeClass('selected');
    tr.addClass('selected');
    id = tr.attr('myid');
    $.ajax({
        url:'/troubleshoots/getfus/'+id,
        type:'get',
        dataType:'json'
    })
    .done(function(res){
        console.log('res',res);
        $('#fus tbody').empty();
        $.each(res,function(x,y){
            tr = '<tr myid='+y.id+'>';
            tr+= '<td>'+y.createdate+'</td>';
            tr+= '<td>'+y.activities+'</td>';
            tr+= '<td>'+y.username+'</td>';
            tr+= '<td>';
            tr+= '<div class="btn-group">';
            tr+= '<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>';
            tr+= '<ul class="dropdown-menu">';
            tr+= '<li class="showImages pointer"><a>Show Images</a></li>';
            tr+= '<li class="divider"></li>';
            tr+= '<li class="removeFu pointer"><a>Remove</a></li>';
            tr+= '</ul>';
            tr+= '</div>';
            tr+= '</td>';
            tr+= '</tr>';
            $('#fus tbody').append(tr);
            $('body').css('cursor','default');
        })
    })
    .fail(function(err){
        console.log('res',err);
        $('body').css('cursor','default');
    });
    clientname = tr.find('.clientname').html();
    $('#FUsModalLabel').html(clientname);
    $('#fusModal').modal();
})
$("#btnAddFu").click(function(){
    $('#addfuimages tbody').empty();
    $('#fu_Modal').modal();
});
showImages = function(id){
    console.log("ID",id);
}
$('#fus tbody').on('click','.removeFu',function(click){
    $('body').css('cursor','progress');
    tr = $(this).stairUp({level:4});
    id = tr.attr('myid');
    name = $('#tTroubleshoot tbody tr.selected').find('.clientname').html();
    console.log("ID",id);
    console.log("Name",name);
    $.ajax({
        url:'/troubleshoots/removefu/'+id,
    })
    .done(function(res){
        console.log('Res',res);
        $('body').css('cursor','default');
        tr.remove();
    })
    .fail(function(err){
        console.log('Err',err);
        $('body').css('cursor','default');
    });
});
$('#fuimages').on('click','.removeImage',function(){
    console.log('removeImage invoked');
    $('body').css('cursor','progress');
    tr = $(this).stairUp({level:2});
    id = tr.attr('myid');
    console.log('ID',id);
    $.ajax({
        url:'/troubleshoots/removefuimage/'+id,
    })
    .done(function(res){
        console.log('Res',res);
        tr.remove();
        $('body').css('cursor','default');
    })
    .fail(function(err){
        console.log('Err',err);
        $('body').css('cursor','default');
    })
})
$('#fus tbody').on('click','.showImages',function(click){
    $('body').css('cursor','progress');
    id = $(this).stairUp({level:4}).attr('myid');
    name = $('#tTroubleshoot tbody tr.selected').find('.clientname').html();
    console.log("ID",id);
    console.log("Name",name);
    $.ajax({
        url:'/troubleshoots/getfuimages/'+id,
        dataType:'json'
    })
    .done(function(res){
        console.log('Success',res);
        $('#fuimages tbody').empty();
        res.forEach(function(x){
            tr = '<tr myid='+x.id+'>';
            tr+= '<td><img src="'+x.img+'"></td>';
            tr+= '<td><button class="removeImage pointer">Remove Image</button></td>';
            tr+= '</tr>';
            console.log(x);
            $('#fuimages tbody').append(tr);
            $('body').css('cursor','default');
        });
        $('#FUImagesModalLabel').html(name);
        $('#fuImagesModal').modal();
    })
    .fail(function(err){
        console.log('Failed',err);
        $('body').css('cursor','default');
    });
})

(function($){
    $.ajax({
        url:'/tickets/getbyid/'+$('#ticket_id').val(),
        dataType:'json'
    })
    .done(function(res){
        console.log('getbyid',res);
        $('.clientname').html(res.res[0].clientname);
    })
    .fail(function(err){
        console.log('getbyid Err',err);
    })
    getDate = function(param,callback){
        date = param.split(' ');
        dt = date[0].split('/');
        callback(dt[2]+'-'+dt[1]+'-'+dt[0]+' '+date[1]);
    }
    getTimeDiff = function(par1,par2,callback){
        getDate(par1,function(res1){
            dt1 = new Date(res1);
            getDate(par2,function(res2){
                dt2 = new Date(res2);
                console.log(dt1);
                console.log(dt2);
                callback({
                    'dayraw':((dt2 - dt1)/(1000*60*60*24)),
                    'day':Math.floor((dt2 - dt1)/(1000*60*60*24)),
                    'hour':Math.floor(((dt2 - dt1)%(1000*60*60*24))/(1000*60*60)),
                    'minute':Math.floor((((dt2 - dt1)%(1000*60*60*24))%(1000*60*60))/(1000*60))
                });
            })
        })
    }
    $('#checkDiff').click(function(){
        getTimeDiff($('#downtimestart').val(),$('#downtimeend').val(),function(res){
            console.log('Check Diff',res);
        });
    })
    $('#btnSave').click(function(){
        $.ajax({
            url:'/downtimes/save',
            data:{
                ticket_id:$('#ticket_id').val(),
                downtimeend:$('#downtimeend').val(),
                downtimestart:$('#downtimestart').val(),
            },
            type:'post'
        })
        .done(function(downtimeid){
            getTimeDiff($('#downtimestart').val(),$('#downtimeend').val(),function(res){
                console.log('Check Diff',res);
                console.log('Res save downtime',res);
                tr = '<tr id='+downtimeid+'>';
                tr+= '<td class="number"></td>';
                tr+= '<td class="info">';
                tr+= '<span>Start: '+$('#downtimestart').val()+'</span> ';
                tr+= '<span>End: '+$('#downtimeend').val()+'</span>';
                tr+= '</td>';
                tr+= '<td>'+res.day+' Hari,'+res.hour+' jam,'+res.minute+' menit</td>';
                tr+= '<td>';
                tr+= '<a type="btn" class="btnRemoveDowntime">Hapus</a>';
                tr+= '</td>';
                tr+= '</tr>';
                $('#tDowntime tbody').append(tr);
                });

        })
        .fail(function(err){
            console.log('Err save downtime',err);
        })
    })
    reNumbering = function(){
        c = 0;
        $('#tDowntime tbody tr').each(function(){
            $(this).find('.number').html(++c);
        });
    }
    removeRow = function(tr,callback){
        tr.remove();
        callback();
    }
    $('#tDowntime').on('click','.btnRemoveDowntime',function(){
        tr = $(this).stairUp({level:2});
        trid = $(this).stairUp({level:2}).attr('id');
        console.log('remove invoked');
        $.ajax({
            url:'/downtimes/remove/'+trid
        })
        .done(function(res){
            removeRow(tr,function(){
                reNumbering();
            })
        })
        .fail(function(err){})
    })
}(jQuery))

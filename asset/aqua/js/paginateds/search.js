$("#searchbar").keyup(function(){
    console.log("keyp",$(this).val());
})
$("#searchbutton").click(function(){
    clearTable();
    loadSearchData(1*$('#pageid').val()*$('#pageamount').val(),1*$('#pageamount').val(),function(str){
        $('#tTicket tbody').append(str);
    })

$('#tTicket_paginate').hide();

})
$('#clearsearchbutton').click(function(){
    $('#searchbar').val("");
    $("#pageamount").change();
    $('#tTicket_paginate').show();
});
getfilter = function(callback){
    callback({category:$('.categoryclass:checked').map(function(){
        console.log('category:',$(this).val());
        return $(this).val();
    }).get(),year:$('.yearclass:checked').map(function(){
        return $(this).val()
    }).get()});
}
clear_interval = function(callback){
    clearInterval(intervalId);
    callback(1);
    //callback(setInterval(function(){ setdura(); }, 3000))
}
$("#test").click(function(){
    getfilter(function(res){
        console.log("invoked",JSON.stringify(res));
    })

    clearTable();
    loadSearchData(1*$('#pageid').val()*$('#pageamount').val(),1*$('#pageamount').val(),function(str){
        $('#tTicket tbody').append(str);
        clear_interval(function(_intervalId){
            console.log("Hey intervalId",_intervalId);
            
            //intervalId = setInterval(function(){ setdura(); }, 3000);

            intervalId = setTimeout(function gto(){
                setdura();
                setTimeout(gto,3000);
            },3000);
        });
        
    })

$('#tTicket_paginate').hide();

});
loadSearchData = function(segment,offset,callback){
    getfilter(function(filter){
        $.ajax({
            url:'/paginateds/search',
            data:{
                searchvalue:$('#searchbar').val(),year:filter.year,category:filter.category
            },
            dataType:'json',
            type:'post'
        })
        .done(function(res){
            console.log("Res",res.sql);
            $.each(res.res,function(a,b){
                str = '<tr thisid='+b.id+' class="'+b.statuslabel+' '+b.requesttype+'" dayamount=0 parentid='+b.parentid+'>';
                str+= '<td class="action">';
                str+= '<div class="btn-group">';
                str+= '<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>';
                str+= '<ul class="dropdown-menu">';
                str+= '<li><a href="/followups/create/'+b.id+'" target="_blank">Follow Up</a></li>';
                str+= '<li><a href="/troubleshoots/add/'+b.id+'">Troubleshoot</a></li>';
                str+= '<li><a href="/downtimes/add/'+b.id+'" target="_blank">Add Down Time</a></li>';
                str+= '<li><a href="/followups/history/'+b.id+'" target="blank"><span class="history">History</span></a></li>';
                str+= '<li class="divider"></li>';
                str+= '<li class="removeTicket warning"><a>Remove</a></li>';
                str+= '</ul>';
                str+= '</div>';
                str+= '</td>';
                str+= '<td class="kdticket">';
                str+= b.kdticket;
                str+= '</td>';
                str+= '<td>';
                str+= b.name;
                str+= '</td>';
                str+= '<td class="requesttype">';
                str+= b.requesttype + '<span class="childrenamount"></span>';
                str+= '</td>';
                str+= '<td class="status">';
                str+= b.statuslabel;
                str+= '</td>';
                str+= '<td>';
                str+= b.mainrootcause;
                str+= '<br >';
                str+= b.subrootcause;
                str+= '</td>';
                str+= '<td class="ticketstart">';
                str+= b.ticketstart;
                str+= '</td>';
                str+= '<td class="ticketend">';
                str+= b.ticketend;
                str+= '</td>';
                str+= '<td class="dura">';
                str+= 'Wait ...';
                str+= '</td>';
                str+= '</tr>';
                callback(str)
            })
        })
        .fail(function(err){
            console.log("Err",err);
        });
    
    });
}
$("#btnSearchKdTicket").click(function(){
    console.log("Teest");
    $.ajax({
        url:'/paginateds/searchByKdTicket/'+$("#kdticket").val(),
        type:'get',
        dataType:'json'
    })
    .done(function(data){
        console.log('Success',data);
    })
    .fail(function(err){
        console.log('Failed',err);
    });
});
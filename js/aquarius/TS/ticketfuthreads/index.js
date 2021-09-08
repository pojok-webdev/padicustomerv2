(function($){
    //$('#modalTicketFilter').modal();
    console.log('Username',username);
    getDateRange = function(callback){
        dt1 = $('#date1').val().split('/');
        dt2 = $('#date2').val().split('/');
        callback({date1:dt1[2]+'-'+dt1[1]+'-'+dt1[0],date2:dt2[2]+'-'+dt2[1]+'-'+dt2[0]})
    }
    getVariables = function(obj,callback){
        console.log("GetVariables obj",obj)
        switch(obj.filter){
            case 'kdticket':
                callback({
                    url:'/ticketfuthreads/kdticketsearch/',
                    data:{kdticket:$('#kdticket').val()}
                })
            break;
            case 'clientname':
                callback({
                    url:'/ticketfuthreads/clientnamesearch/',
                    data:{clientname:$('#clientname').val()}
                })
            break;
            case 'daterange':
                getDateRange(daterange=>{
                    callback({
                        url:'ticketfuthreads/daterangesearch/'+daterange.date1+'/'+daterange.date2,
                        data:{date1:daterange.date1,date2:daterange.date2}
                    })
                })
            break;
        }
    }
    reloadTickets = function(tickets){
        console.log('tickets retrieved',tickets)
        $('#tickets').empty();    
        tickets.forEach(function(ticket){
            str = '<div class="item clearfix ticket" ticketid="'+ticket.id+'">';
            str+='<div class="image">';
            str+='<span class="ticketid">'+ticket.id+'</span>';
            str+='</div>';
            str+='<div class="info">';
            str+='<a href="#" class="name">'+ticket.clientname+' ('+ticket.fucnt+')</a>';
            str+='<p>'+ticket.dt+'.</p>';
            str+='<span>'+ticket.kdticket+'</span>';
            str+='</div>';
            str+='</div>';
            $('#tickets').append(str);
        });
    }
    showTickets = function(obj){
        console.log("showTikets",obj);
        getVariables(obj,function(vars){
            console.log("Obj URL",vars);
            $.ajax({
                url:vars.url,
                type:'post',
                data:vars.data,
                dataType:'json'
            })
            .done(function(res){
                console.log('Success search ticket',res);
                reloadTickets(res);
            })
            .fail(function(err){
                console.log('Failed search ticket',err);
            });
        })
    }
    showFus = function(fus){
        $('.fus').empty();
        fus.forEach(function(fu){
            if(username==fu.username){
                itemClass="itemOut";
            }else{
                itemClass="itemIn";
            }
            str = '<div class="'+itemClass+'">';
            str+= '         <a href="#" class="image"><img src="'+fu.pic+'" class="img-polaroid" width="52px" height="52px" alt="'+fu.username+'"/></a>';
            str+= '         <div class="text">';
            str+= '             <div class="info clearfix">';
            str+= '                 <span class="name">'+fu.description+'</span>';
            str+= '                 <span class="date">'

            str+= '<div class="btn-group">';
            str+= '<button data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Action <span class="caret"></span></button>';
            str+= '<ul class="dropdown-menu">';
            str+= '<li><a href="#"><span class="icon-info-sign"></span> Detail</a></li>';
            str+= '<li class="modalTicketEdit"><a><span class="icon-pencil"></span> Edit</a></li>';
            str+= '<li class="divider"></li>';
            str+= '<li><a href="#"><span class="icon-trash"></span> Remove</a></li>';
            str+= '</ul>';
            str+= '</div>';
            
            str+= '</span>';
            str+= '             </div>  ';
            str+= '<span>'+fu.conclusion+'</span>';



            str+= '         </div>';





            str+= '     </div>';
            $('.fus').prepend(str);
        });
    }
    getfus = function(clientid){
        $.ajax({
            url:'/ticketfuthreads/getfus/'+clientid,
            dataType:'json'
        })
        .done(function(res){
            console.log('getfus res',res)
            $('#fusamount').html('('+res.length+')');
            showFus(res);
        })
        .fail(function(err){
            console.log('Getfus err',err)
        })
    }
    $('#searchTicket').click(function(){
        console.log('Affeceted Element',affectedElement)
        switch(affectedElement){
            case 'divkdticket':
                showTickets({filter:'kdticket'});
            break;
            case 'divclientname':
                showTickets({filter:'clientname'});
            break;
            case 'divdaterange':
                showTickets({filter:'daterange'});
            break;
        }
    });
    $('#tickets').on('click','.item.ticket',function(){
        clientid = $(this).attr('ticketid');
        console.log('Client-ID',clientid);
        console.log('Clientid',$(this).find('.ticketid').html());
        getfus(clientid);
    })
    $(".realmaskdate").mask("99/99/9999");
    setInterval(() => {
        $('#buttonSearch').fadeIn(500);
        $('#buttonSearch').fadeOut(500);
    }, 500);
    $.fn.blinkMe = function(options){
        var settings = $.extend({
            timeLength:500,
            blink:true
        },options);
        out=$(this);
        if(settings.blink){
            out.x = setInterval(()=>{
                out.fadeIn(settings.timeLength);
                out.fadeOut(settings.timeLength);
            });
        }else{
            console.log('blink left');
            clearInterval(out.x);
        }
        return out;
    }
    $('#buttonPlus').blinkMe();
    $('#buttonPlus').click(function(){
        $(this).blinkMe({blink:false})
    })
    $('.fus').on('click','.modalTicketEdit',function(){
        $('#modalTicketEdit').modal();
    })
}(jQuery))

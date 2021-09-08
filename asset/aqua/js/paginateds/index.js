(function($){
    _lastpage = 0;
    initScripts = function(){
        $('.conditionalButton').prop('disabled',true);
    }
    initScripts();
    clearTable = function(){
        $("#tTicket tbody").empty();
    }
    loadTicketData = function(obj,callback){
        $.ajax({
            url:'/rpt/getsolvedreport',
            data:obj,
            type:'post',
            dataType:'json'
        })
        .done(function(res){
            console.log("Res",res);
            $('#ticketamount').html('('+res.length+')')
            $.each(res,function(a,b){
                console.log("Beb",b);
                str = '<tr thisid='+b.id+' class="'+b.statuslabel+' '+b.requesttype+'" dayamount=0 parentid='+b.parentid+'>';
                str+= '<td class="kdticket">';
                str+= b.kdticket;
                str+= '</td>';
                str+= '<td>';
                str+= b.clientname;
                str+= '</td>';
                str+= '<td class="requesttype">';
                str+= b.requesttype + '<span class="childrenamount"></span>';
                str+= '</td>';
                str+= '<td class="status">';
                str+= b.ticketStatus;
                str+= '</td>';
                str+= '<td>';
                str+= b.cause;
                str+= '<br >';
                str+= b.subrootcause;
                str+= '</td>';
                str+= '<td class="ticketstart">';
                str+= b.ticketstart;
                str+= '</td>';
                str+= '<td class="ticketend">';
                str+= b.ticketend;
                str+= '</td>';
                str+= '</tr>';    
                callback(str)
            })
        })
        .fail(function(err){
            console.log("Err",err);
        });
    }
    showConfirmationModal = function(obj,callback){
        callback(obj);
    }
    clearSelected = function(rows,callback){
        rows.each(function(){
            console.log('Row : ',rows.html());
            $(this).removeClass('selected');
        });
        callback();
    }
    $( ".datepicker" ).datepicker({
        dateFormat:"yy-mm-dd"
    });
    if($('#hastroubleshoot').prop('checked')){
        hastroubleshoot = 'and  hastroubleshoot>0 '
    }else{
        hastroubleshoot = 'and  hastroubleshoot=0 '
    }

    loadTicketData({
        causeid:$('.categoryclass:checked').map(function(){
            return $(this).val()
        }).get().join(),
        branches:$('.branchFilter:checked').map(function(){
            return $(this).val()
        }).get().join(),
        timerange:$('#categoryfilter').val(),
        rorder:'asc',orderfield:'id',
        uridt1:$('#period1').val(),uridt2:$('#period2').val(),
        userbranches:'"1","2","3","4"',
        segment:0,offset:$('#pageamount').val(),
        hastroubleshoot:hastroubleshoot
    },function(str){
        $('#tTicket tbody').append(str);
    })
    loadNextPage = function(pageid,nextpage){
        loadPagination(nextpage,function(result){
            $("#paginationbuttons").append(result);
        });
        $("#pageid").text(nextpage);
        clearTable();
        loadTicketData(pageid*$('#pageamount').val(),$('#pageamount').val(),function(str){
            $('#tTicket tbody').append(str);
        })
    }
    $('#btnFirst').click(function(){
        loadNextPage(0,1);
    });
    $('#btnLast').click(function(){
        console.log("lastpage",$(this).attr('lastpage'));
        lastpage = $(this).attr('lastpage');
        loadNextPage(lastpage-1,lastpage)
    });
    $("#tTicket_next").on("click",function(){
        let pageid = $("#pageid").text();
        let nextpage = 1*pageid+1;
        loadNextPage(pageid,nextpage);
    })
    $("#tTicket_previous").on("click",function(){
        let pageid = $("#pageid").text();
        console.log("PaageID",pageid);
        if(1*pageid>1){
            let prevpage = 1*pageid-1;
            loadNextPage(prevpage-1,prevpage);
        }
    })
    createPages = function(activePage){
        out = '';
        if(activePage<3){
            for(x=1;x<6;x++){
                if(1*x===1*activePage){
                    out+='<span class="btn btn-warning pagebutton">'+x+'</span>';
                }else{
                    out+='<span class="btn pagebutton">'+x+'</span>';
                }            
            }
        }else if((activePage>=3)&&(activePage<_lastpage-2)){
            for(x=1*activePage-2;x<=1*activePage+2;x++){
                if(1*x===1*activePage){
                    out+='<span class="btn btn-warning pagebutton">'+x+'</span>';
                }else{
                    out+='<span class="btn pagebutton">'+x+'</span>';
                }            
            }
        }else if(activePage>=_lastpage-2){
            console.log("Last page invoked");
            for(x=1*_lastpage-5;x<=1*_lastpage;x++){
                if(1*x===1*activePage){
                    out+='<span class="btn btn-warning pagebutton">'+x+'</span>';
                }else{
                    out+='<span class="btn pagebutton">'+x+'</span>';
                }
            }
        }
        return out;
    }
    loadPagination = function(pageid,callback){
        $("#paginationbuttons").empty();
        callback(createPages(pageid));
    }
    loadPagination(1,function(result){
        $("#paginationbuttons").append(result);
    });
    $(".paging_two_button").on("click",".pagebutton",function(){
        pageid = $(this).text();
        loadNextPage(1*pageid-1,pageid);
    })
    populatePageOptions = function(lastpage){
        for(x=1;x<=lastpage;x++){
            $("#pageoption").append('<option value='+x+'>'+x+'</option>');
        }
    }
    $("#pageoption").change(function(){
        pageid = $(this).val();
        loadNextPage(1*pageid-1,pageid);
    });
    $("#pageamount").change(function(){
        clearTable();
        loadTicketData(1*$('#pageid').val()*$('#pageamount').val(),1*$('#pageamount').val(),function(str){
            $('#tTicket tbody').append(str);
        })
    });
    initDataAmount = function(callback){
        $.ajax({
            url:'/rpt/getsolvedreportamount',
            dataType:'json'
        })
        .done(function(res){
            callback(res)
        })
        .fail(function(err){
            console.log('get Amount failed',err);
        })
    }
    getNewTicketAmount = function(before,after,callback){
        callback(1*before-1*after);
    }
    $('#newTicket').click(function(){
        $('#newTicket').html('');
        document.title = 'List of Tickets';
        clearTable();
        loadTicketData(0,$('#pageamount').val(),function(str){
            $('#tTicket tbody').append(str);
        })
        loadPagination(1,function(result){
            $("#paginationbuttons").append(result);
        });
    
    });
    $("#search").on("click",function(){
        $("#dFilter").modal();
        $(".search-toggler").hide();
    })
    $(".yearclass").on("click",function(){
        console.log("yearclass",$(this).val());
    })
    $(".filter").on("click",function(){
        console.log("filter",$(this).val());
        that = $(this);
        if(that.prop('checked')){
            console.log('',that.val());
        }
    })
    checkboxtoggle = function(member,check){
        member.attr('checked',check);
    }
    $("#searchByKdticket").click(function(){
        $('#fModal').modal();
    });
    $('#btnSaveCauses').click(function(){
        $('#tTicket tbody').empty();
        console.log($('.categoryclass:checked').map(function(){
            return $(this).val()
        }).get());
        if($('#hastroubleshoot').prop('checked')){
            hastroubleshoot = 'and  hastroubleshoot>0 '
        }else{
            hastroubleshoot = 'and  hastroubleshoot=0 '
        }

        loadTicketData({
            causeid:$('.categoryclass:checked').map(function(){
                return $(this).val()
            }).get().join(),
            branches:$('.branchFilter:checked').map(function(){
                return $(this).val()
            }).get().join(),
            timerange:$('#categoryfilter').val(),
            rorder:'asc',orderfield:'id',
            uridt1:$('#period1').val(),uridt2:$('#period2').val(),
            userbranches:'"1","2","3","4"',
            segment:0,offset:$('#pageamount').val(),
            hastroubleshoot:hastroubleshoot
        },function(str){
            $('#tTicket tbody').append(str);
            $('#dFilter').modal('hide');
            $('#closeModal').click();
        })
    });
    $('.catparent').click(function(){
        $('.catmember'+$(this).val()).prop('checked',$(this).prop('checked'));
    });
    $('#commonFilter').click(function(){
        $('#mFilterCategory').modal();
    });
    $('#searchByFilter').click(function(){
        console.log('BranchFiter',$('.branchFilter:checked').map(function(){
            return $(this).val()
        }).get().join());
        $('#tTicket tbody').empty();
        if($('#hastroubleshoot').prop('checked')){
            hastroubleshoot = 'and  hastroubleshoot>0 '
        }else{
            hastroubleshoot = 'and  hastroubleshoot=0 '
        }
        loadTicketData({
            causeid:$('.categoryclass:checked').map(function(){
                return $(this).val()
            }).get().join(),
            branches:$('.branchFilter:checked').map(function(){
                return $(this).val()
            }).get().join(),
            timerange:$('#categoryfilter').val(),
            rorder:'asc',orderfield:'id',
            uridt1:$('#period1').val(),uridt2:$('#period2').val(),
            userbranches:'"1","2","3","4"',
            segment:0,offset:$('#pageamount').val(),
            hastroubleshoot:hastroubleshoot
        },function(str){
            $('#tTicket tbody').append(str);
            $('#dFilter').modal('hide');
        })
    });
}(jQuery))

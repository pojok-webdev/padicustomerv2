<div id="modalTicketFilter" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Filter Ticket</h3>
    </div>        
    <div class="row-fluid">
        <div class="block-fluid">
        <div class="row-form clearfix">
            <div class="span3">Filter Options</div>
                <div class="span9">                                
                    <div class="btn-group" data-toggle="buttons-radio">
                        <button type="button" class="btn optionfilter" affectedelement="divkdticket">KdTicket</button>
                        <button type="button" class="btn optionfilter" affectedelement="divclientname">ClientName</button>
                        <button type="button" class="btn optionfilter" affectedelement="divdaterange">DateRange</button>
                    </div>
                </div>
            </div>                                            
            <div class="row-form clearfix divfiltername" id="divkdticket">
                <div class="span3">KdTicket:</div>
                <div class="span9"><input type="text" value="" id="kdticket"  class="filterinput"/></div>
            </div>            
            <div class="row-form clearfix divfiltername" id="divclientname">
                <div class="span3">Client Name:</div>
                <div class="span9"><input type="text" value="" id="clientname" class="filterinput" /></div>                    
            </div>
            <div class="row-form clearfix divfiltername" id="divdaterange">
                <div class="span3">Date Range:</div>
                <div class="span4"><input type="text" id='date1' class="realmaskdate filterinput"/></div>
                <div class="span1"></div>
                <div class="span4"><input type="text" id='date2' class="realmaskdate filterinput"/></div>
            </div>                                                
        </div>
    </div>                    
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id="searchTicket">Search Ticket</button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
    </div>
</div>    
<script>
    $('.optionfilter').on('click',function(){
        $('.divfiltername input').prop('disabled',true);
        $('.divfiltername input').val('');
        $('.divfiltername').css('background-color','#ffffff');
        affectedElement = $(this).attr('affectedelement');
        console.log('Affected Element',affectedElement);
        $('#'+affectedElement).css('background-color','red');
        $('#'+affectedElement +' input').prop('disabled',false);
    })
    $(".filterinput").focus(function(){
        $(this).select();
        $(this).stairUp({level:2}).css('background-color','red');
        affectedElement = $(this).stairUp({level:2}).attr('id');
    });
    $('.filterinput').blur(function(){
        $(this).stairUp({level:2}).css('background-color','#ffffff');
    })
</script>
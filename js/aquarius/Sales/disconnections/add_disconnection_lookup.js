if($("#tDisconnection").length > 0)
{
   $("#tDisconnection").dataTable({"iDisplayLength": 7, "aLengthMenu": [5,10,25,50,100,150,200], "sPaginationType": "full_numbers", "aoColumns": [ { "bSortable": true }, null, null, null, null]});
   $("#tDisconnectionx").dataTable({"iDisplayLength": 5, "sPaginationType": "full_numbers","bLengthChange": false,"bFilter": false,"bInfo": false,"bPaginate": true, "aoColumns": [ { "bSortable": false }, null, null, null, null]});
}
$("#tDisconnection").on('click','.dodisconnect',function(){
   window.location.href = '/disconnections/add/'+$(this).attr('client_id');
});
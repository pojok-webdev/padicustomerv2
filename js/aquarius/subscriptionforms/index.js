/*
 * WRITTEN by PUJI W PRAYITNO
 * 2015
 * mailto:puji@padi.net.id
 * */
$('#tSubscription').dataTable({
	"aoColumnDefs":[
		{"bVisible":false,"aTargets":[5]},
	]
});
$('#tSubscription').on('click','.btn_edit',function(){
	var id = $(this).stairUp({level:4}).attr('trid');
	window.location = '/subscribeforms/edit/'+id;
});
$('#tSubscription').on('click','.btn_print',function(){
	var id = $(this).stairUp({level:4}).attr('trid');
	window.location = '/subscribeforms/showreport/'+id;
});


# padi-customer

## datatable

### Penambahan Custom Control pada dataTable
cara 1a
var tTicket = $("#tbl_ticket").dataTable({
	"aaSorting":[[0,'desc']],
	 'fnDrawCallback': function (oSettings) {
		$('#tbl_ticket_length').append('<button class="btn btn-primary">Open</button>');
	 }
}),allowToCloseTicket = false;

cara 1b
var tTicket = $("#tbl_ticket").dataTable({
	"aaSorting":[[0,'desc']],
	 'fnDrawCallback': function (oSettings) {
		$('.dataTables_filter').each(function () {
			$(this).append('<button class="btn btn-default mr-xs pull-right" type="button">Button</button>');
		});
	 }
}),allowToCloseTicket = false;

cara 2
var tTicket = $("#tbl_ticket").dataTable({
	"aaSorting":[[0,'desc']],
	"sDom": '<"H"Tfr>t',
	"oTableTools": {
		aButtons: [
		{
			sExtends: 'text',
			sButtonText: 'export',
			"sFieldSeperator": ";",
			"sFieldBoundary": '"',
			"mColumns": "visible",
			fnClick: function (button, conf) {
			var content = this.fnGetTableData(conf);
			saveTextAs(content, 'datatable.csv');
		}
		}
		]
	}
}),allowToCloseTicket = false;
$("div.toolbar").html('<span style="margin-left: 1em;"><img src="images/b_export_xls.gif" title="{t}Export to CSV{/t}" /></span>');

cara 3 
var tTicket = $("#tbl_ticket").dataTable({
	"aaSorting":[[0,'desc']],
	//"sDom": '<"toolbar">frtip'
	"sDom": '<"H" <"toolbar">fr>t'
}),allowToCloseTicket = false;
$("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');


cara 4 
var tTicket = $("#tbl_ticket").dataTable({
	"aaSorting":[[0,'desc']],
	"sDom": '<"toolbar">frtip'
}),allowToCloseTicket = false;
$("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
# padicustomerv2

$(document).ready(function(){
	var tInstall = $("#tInstall").dataTable({
		"bPaginate":true,
		"aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
		"iDisplayLength": 5,
		"bSort":true,
		"aaSorting":[[1,"desc"]],
	});
	var nNodes = tInstall.fnGetNodes();
	$(nNodes).find(".tohuman").sql2idformat();
	$(nNodes).find(".tohumandate").formatiddate();
	$(nNodes).find(".tohumanhourminute").formatidtime();
	$('#permintaanmainstalasi').click(function(){
		window.location.href = thisdomain+'install_requests/add_lookup';
	});
});

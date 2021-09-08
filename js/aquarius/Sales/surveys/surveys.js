$(document).ready(function () {
	console.log("Sales survey log");
	var dtSurvey = $("#tSurveys").dataTable({
		"aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
		"iDisplayLength": 5,
		"aoColumns": [
			{"sWidth": "95px", "sClass": "updatable", "fieldName": "kdticket"},
			null,
			null,
			{"sWidth": "95px", "sClass": "updatable", "fieldName": "ticketend"},
			{"sWidth": "95px", "sClass": "updatable", "fieldName": "status"},
			{"sWidth": "95px", "sClass": "updatable", "fieldName": "duration"},
			null,
			null, null
		],
		"aaSorting": [[2, "desc"]]
	});
	var nNodes = dtSurvey.fnGetNodes();
	$(this).fieldUpdater({
		url: "/surveys/feedData",
		cellClass: 'updatable',
		fieldName: 'fieldName',
		idAttr: 'myid',
		enabled: true
	});
	setRows = function(callback){
		var nodes = dtSurvey.fnGetNodes();
		var maxid = null;
		$.each(nodes,function(data){
			var thisid = parseInt($(this).attr("myid"));
			if(maxid==null||(thisid>maxid)){
				maxid = thisid;
			}
		});

		callback(maxid);
	}
	$('#permintaansurvey').click(function () {
		window.location.href = '/preclients/lookup';
	});
	$(nNodes).find(".tohuman").sql2idformat();
	$(nNodes).find(".tohumandate").formatiddate();
	$(nNodes).find(".tohumanhourminute").formatidtime();
	$(".header").click(function () {
		$(".menu").toggleClass("pmenu");
		$(".content").toggleClass("pcontent");
	});
});

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	animationEnabled: true,
	title: {
		text: "Grafik Layanan terhadap Pelanggan",                
		fontColor: "Peru"
	},	
	axisY: {
		tickThickness: 0,
		lineThickness: 0,
		valueFormatString: " ",
		gridThickness: 0                    
	},
	axisX: {
		tickThickness: 0,
		lineThickness: 0,
		labelFontSize: 18,
		labelFontColor: "Peru"				
	},
	data: [{
		indexLabelFontSize: 16,
		toolTipContent: "<span style=\"color:#62C9C3\">{indexLabel}:</span> <span style=\"color:#CD853F\"><strong>{y}</strong></span>",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "red",
		indexLabelFontWeight: 60,
		indexLabelFontFamily: "Verdana",
		color: "#62C9C3",
		type: "bar",
		dataPoints: [
			{ y: 100, label: "100", indexLabel: "Blocking Site" },
			{ y: 25, label: "25", indexLabel: "Port Forwarding" },
			{ y: 33, label: "33", indexLabel: "Additional Public IP" },
			{ y: 36, label: "36", indexLabel: "Firewall-Rules/Allow-IP" },
			{ y: 42, label: "42", indexLabel: "Firewall Protection" },
			{ y: 49, label: "49", indexLabel: "Bandwidth Management" },
			{ y: 50, label: "50", indexLabel: "Backup Lastmile" },
			{ y: 55, label: "55", indexLabel: "Bandwidth on Demand" },
			{ y: 61, label: "61", indexLabel: "Domain Names" },
			{ y: 21, label: "21", indexLabel: "Hosting" },
			{ y: 25, label: "25", indexLabel: "Load Sharing" },
			{ y: 33, label: "33", indexLabel: "Load Balance" },
			{ y: 36, label: "36", indexLabel: "Fail Over" },
			{ y: 42, label: "42", indexLabel: "VPN + IP Routing" },
			{ y: 49, label: "49", indexLabel: "Voip Line" },
			{ y: 50, label: "50", indexLabel: "Hotspot Login" },
			{ y: 55, label: "55", indexLabel: "Zimbra Mail Server Setup" },
			{ y: 61, label: "61", indexLabel: "Proxy Server Setup" },
			{ y: 21, label: "21", indexLabel: "Basic Network Consultation By Phone" },
			{ y: 25, label: "25", indexLabel: "24/7 Call Support" },
			{ y: 33, label: "33", indexLabel: "Whatsapp Support" },
			{ y: 36, label: "36", indexLabel: "Traffic Monitoring" },
			{ y: 42, label: "42", indexLabel: "Weekday Troubleshoot" },
			{ y: 49, label: "49", indexLabel: "Emergency Team For Weekend/Non Office Hours Troubleshoot" },
			{ y: 50, label: "50", indexLabel: "EoS" }

		]
	}]
};

$("#chartContainer").CanvasJSChart(options);
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 800px; width: 100%;"></div>
<script type="text/javascript" src="/js/jquerycanvas/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/jquerycanvas/jquery.canvasjs.min.js"></script>
</body>
</html>
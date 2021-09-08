<html>
	<head>
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="/asset/report/bootstrap-3.3.6.min.css">
		<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->
		<link rel="stylesheet" href="/asset/jqueryui.1.12.0.css">
		<style>
			.rptanchor:hover{
				color: red;
			}
			#rpt thead tr th{
				text-align:center;
				font-family:'Arial'
			}
			#rpt tbody tr td{
				text-align:left;
			}
			.subtable tr td{
				border: 1px black solid;
				font-size: 8px;
			}
		</style>
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>
		<!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
		<script src="/asset/jqueryui.1.12.0.js"></script>
		<script src="/js/padilibs/padi.dateTimes.js"></script>
		<script src="/js/aquarius/links.js"></script>
		<title>Laporan Pelanggan per VAS </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Pelanggan per VAS</h3>
		<h5>
			<a class="rptanchor btn btn-success" href="/rpt">Home</a>
		</h5>
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<thead>
                	<tr>
                    	<th>Blocking Site</th>
                    	<th>Port Forwarding</th>
                    	<th>Additional Public IP</th>
                    	<th>Firewall Rules/Allow IP</th>
                    	<th>Firewall Protection</th>
                    	<th>Bandwidth Management</th>
                    	<th>Backup Last Mile</th>
                    	<th>Bandwidth On Demand</th>
                    	<th>Domain Names</th>
                    	<th>Hosting</th>
                    	<th>Load Sharing</th>
                    	<th>Load Balance</th>
                    	<th>Failover</th>
                    	<th>VPN + IP Routing</th>
                    	<th>Voip Line</th>
                    	<th>Hotspot Login</th>
                    	<th>Zimbra Mail Server Setup</th>
                    	<th>Proxy Server Setup</th>
                    	<th>Basic Network Consultation By Phone</th>
                    	<th>24/7 Call Support</th>
                    	<th>Whatsapp Support</th>
                    	<th>Traffic Monitoring</th>
                    	<th>Weekday Troubleshoot</th>
                    	<th>Emergency Team For Weekend/Non Office Hour Troubleshoot</th>
                    	<th>EoS</th>
                    </tr>
					<tr>
						<th><?php echo $vasclients1['cnt'];?></th>
						<th><?php echo $vasclients2['cnt'];?></th>
						<th><?php echo $vasclients3['cnt'];?></th>
						<th><?php echo $vasclients4['cnt'];?></th>
						<th><?php echo $vasclients5['cnt'];?></th>
						<th><?php echo $vasclients6['cnt'];?></th>
						<th><?php echo $vasclients7['cnt'];?></th>
						<th><?php echo $vasclients8['cnt'];?></th>
						<th><?php echo $vasclients9['cnt'];?></th>
						<th><?php echo $vasclients10['cnt'];?></th>
						<th><?php echo $vasclients11['cnt'];?></th>
						<th><?php echo $vasclients12['cnt'];?></th>
						<th><?php echo $vasclients13['cnt'];?></th>
						<th><?php echo $vasclients14['cnt'];?></th>
						<th><?php echo $vasclients15['cnt'];?></th>
						<th><?php echo $vasclients16['cnt'];?></th>
						<th><?php echo $vasclients17['cnt'];?></th>
						<th><?php echo $vasclients18['cnt'];?></th>
						<th><?php echo $vasclients19['cnt'];?></th>
						<th><?php echo $vasclients20['cnt'];?></th>
						<th><?php echo $vasclients21['cnt'];?></th>
						<th><?php echo $vasclients22['cnt'];?></th>
						<th><?php echo $vasclients23['cnt'];?></th>
						<th><?php echo $vasclients24['cnt'];?></th>
					</tr>
				</thead>
				<tbody>
				
				<tr>
					<td>
						<table class="subtable">
						<?php foreach($vasclients1['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients2['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients3['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients4['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>

					<td>
						<table class="subtable">
						<?php foreach($vasclients5['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients6['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients7['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients8['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>

					<td>
						<table class="subtable">
						<?php foreach($vasclients9['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients10['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients11['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients12['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>

					<td>
						<table class="subtable">
						<?php foreach($vasclients13['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients14['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients15['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients16['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>

					<td>
						<table class="subtable">
						<?php foreach($vasclients17['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients18['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients19['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients20['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>

					<td>
						<table class="subtable">
						<?php foreach($vasclients21['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients22['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients23['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
					<td>
						<table class="subtable">
						<?php foreach($vasclients24['res'] as $dt){?>
							<tr><td><?php echo humanize($dt->name)?></td></tr>
						<?php }?>
						</table>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		</div>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type="text/javascript">
			(function($){
			}(jQuery))
		</script>
	</body>
</html>





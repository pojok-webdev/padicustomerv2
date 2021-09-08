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
			.monthselector:hover{
				cursor:pointer;
			}
			.strsemua:hover{
				cursor:pointer;
			}
			.dropdown-submenu {
				position: relative;
			}
			.pointer{
				cursor:pointer;
			}
			.pointer:hover{
				color:red;
			}
			.dropdown-submenu .dropdown-menu {
				top: 0;
				left: 100%;
				margin-top: -1px;
			}
			#rpt thead tr th{
				text-align:center;
			}
			#rpt tbody tr td{
				text-align:center;
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
				</thead>
				<tbody>
				<?php foreach($vasclients as $dt){?>
				<tr>
				<td><?php echo $dt->bcnt;?></td>
				<td><?php echo $dt->ccnt;?></td>
				<td><?php echo $dt->dcnt;?></td>
				<td><?php echo $dt->ecnt;?></td>
				<td><?php echo $dt->fcnt;?></td>
				<td><?php echo $dt->gcnt;?></td>
				<td><?php echo $dt->hcnt;?></td>
				<td><?php echo $dt->icnt;?></td>
				<td><?php echo $dt->jcnt;?></td>
				<td><?php echo $dt->kcnt;?></td>


				<td><?php echo $dt->lcnt;?></td>
				<td><?php echo $dt->mcnt;?></td>
				<td><?php echo $dt->ncnt;?></td>
				<td><?php echo $dt->ocnt;?></td>
				<td><?php echo $dt->pcnt;?></td>
				<td><?php echo $dt->qcnt;?></td>
				<td><?php echo $dt->rcnt;?></td>
				<td><?php echo $dt->scnt;?></td>
				<td><?php echo $dt->tcnt;?></td>
				<td><?php echo $dt->ucnt;?></td>

				<td><?php echo $dt->vcnt;?></td>
				<td><?php echo $dt->wcnt;?></td>
				<td><?php echo $dt->xcnt;?></td>
				<td><?php echo $dt->ycnt;?></td>
				<td><?php echo $dt->zcnt;?></td>

				</tr>
                <tr>
					<td>
						<?php echo humanize($dt->b);?>
					</td>
					<td>
						<?php echo humanize($dt->c);?>
					</td>
					<td>
						<?php echo humanize($dt->d);?>
					</td>
					<td>
						<?php echo humanize($dt->e);?>
					</td>
					<td>
						<?php echo humanize($dt->f);?>
					</td>
					<td>
						<?php echo humanize($dt->g);?>
					</td>
					<td>
						<?php echo humanize($dt->h);?>
					</td>
					<td>
						<?php echo humanize($dt->i);?>
					</td>
					<td>
						<?php echo humanize($dt->j);?>
					</td>
					<td>
						<?php echo humanize($dt->k);?>
					</td>
					<td>
						<?php echo humanize($dt->l);?>
					</td>
					<td>
						<?php echo humanize($dt->m);?>
					</td>
					<td>
						<?php echo humanize($dt->n);?>
					</td>
					<td>
						<?php echo humanize($dt->o);?>
					</td>
					<td>
						<?php echo humanize($dt->p);?>
					</td>
					<td>
						<?php echo humanize($dt->q);?>
					</td>
					<td>
						<?php echo humanize($dt->r);?>
					</td>
					<td>
						<?php echo humanize($dt->s);?>
					</td>
					<td>
						<?php echo humanize($dt->t);?>
					</td>
					<td>
						<?php echo humanize($dt->u);?>
					</td>
					<td>
						<?php echo humanize($dt->v);?>
					</td>
					<td>
						<?php echo humanize($dt->w);?>
					</td>
					<td>
						<?php echo humanize($dt->x);?>
					</td>
					<td>
						<?php echo humanize($dt->y);?>
					</td>
					<td>
						<?php echo humanize($dt->z);?>
					</td>
				</tr>
				<?php }?>
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





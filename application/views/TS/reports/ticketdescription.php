<html>
	<head>
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/report/bootstrap-3.3.6.min.css">
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>		
		<title>Keterangan Ticket </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
			<h3>Keterangan Ticket No : <strong><?php echo $kdticket;?></strong></h3>
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<tbody>
					<tr>
						<th>Komplain</th>
						<td>
							<?php echo $ticket->complaint;?>
						</td>
					</tr>
					<tr>
						<td>
							Waktu komplain
						</td>
						<td>
							<?php echo $ticket->ticketstart;?>
						</td>
					</tr>
					<tr>
						<td>
							Pelanggan
						</td>
						<td>
							<?php echo $ticket->clientname;?>
						</td>
					</tr>
					<tr>
						<td>
							Kategori
						</td>
						<td>
							<?php echo $ticket->cause;?>
						</td>
					</tr>
					<tr>
						<td>
							Solusi
						</td>
						<td>
							<?php echo $ticket->solution;?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>
		<script type="text/javascript">
			(function($){
				$(".survey").mouseover(function(){
					var dt = $(this).attr("dt");
					$(".surveydetail."+dt).css("color","red");
					console.log($(this).attr("dt"));
				});
				$(".survey").mouseout(function(){
					var dt = $(this).attr("dt");
					$(".surveydetail."+dt).css("color","black");
					console.log($(this).attr("dt"));
				});
				$(".installation").mouseover(function(){
					var dt = $(this).attr("dt");
					$(".installdetail."+dt).css("color","red");
					console.log($(this).attr("dt"));
				});
				$(".installation").mouseout(function(){
					var dt = $(this).attr("dt");
					$(".installdetail."+dt).css("color","black");
					console.log($(this).attr("dt"));
				});
				$(".troubleshoot").mouseover(function(){
					var dt = $(this).attr("dt");
					$(".troubleshootdetail."+dt).css("color","red");
					console.log($(this).attr("dt"));
				});
				$(".troubleshoot").mouseout(function(){
					var dt = $(this).attr("dt");
					$(".troubleshootdetail."+dt).css("color","black");
					console.log($(this).attr("dt"));
				});
			}(jQuery))
		</script>

	</body>
</html>

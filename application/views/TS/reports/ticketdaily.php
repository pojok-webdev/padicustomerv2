<html>
	<head>
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="/asset/report/bootstrap-3.3.6.min.css">
		<link href="/css/aquarius/stylesheets.css" rel="stylesheet" type="text/css" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type='text/javascript' src='/js/jquery-1.8.2.min.js'></script>
	    <script type='text/javascript' src='/js/jquery-ui-1.10.4.custom.min.js'></script>
		<title>Laporan Shift TS <?php echo $date;?> </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Harian TS , <?php echo $date;?> (Total : <?php echo $total;?>)</h3>
		<h5>
		<input type="text" class="monthdatepicker" id="reportdate" value ="<?php echo $dateselected;?>">
				<?php
				foreach($arrbranch as $br){
					$ischecked = false;
					$checked = "";
					for($c=0;$c<strlen($userbranches);$c++){
						if(substr($this->uri->segment(6),$c,1)===$br){
							$ischecked = true;
						}
					}
					if($ischecked){
						$checked = "checked='checked'";
					}
					echo '<label class="checkbox-inline suspect-branches"><input type="checkbox" value="'.$br.'" '. $checked .' >';
					echo getbranch($br) . " ";
					echo '</label>';
				}	
				?>
				<button class="btn btn-success" id="btnfilter">Filter</button>			
			<a href="<?php echo base_url()?>rpt" class="btn btn-success">Home</a>
			<a href="<?php echo base_url()?>rpt/excelshiftreport/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->uri->segment(5);?>/<?php echo $this->uri->segment(6);?>" class="btn btn-success">Download Excel</a>
		</h5>
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<tbody>
					<?php $c=0;?>
					<?php foreach($tickets as $ticket){?>
						<?php $c++;?>
					<tr>
						<th rowspan=12 valign="top"><?php echo $c;?>.</th>
						<td>
							Kode Ticket
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo ' <strong> ' . $ticket->kdticket . '</strong>';?>
						</td>
					</tr>
					<tr>
						<td>
							Pelanggan
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->clientname . ' -<strong> ' . $ticket->branch . '</strong>';?>
						</td>
					</tr>
					<tr>
						<td>
							Kategori
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->category;?>
						</td>
					</tr>
					<tr>
						<td>
							Person
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->reporter;?>
						</td>
					</tr>
					<tr>
						<td>
							Pukul
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->ticketstart;?>
						</td>
					</tr>
					<tr>
						<td>
							Keluhan
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->complaint;?>
						</td>
					</tr>
					<tr>
						<td>
							Solusi
						</td>
						<td>
							:
						</td>
						<td>
							<?php foreach(getticketsolution($ticket->id) as $solution){?>
							<?php echo $solution->description;?>
							<?php }?>
						</td>
					</tr>






					<tr>
						<td>
							Main Root Cause
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->maincause;?>
						</td>
					</tr>
					<tr>
						<td>
							Sub Root Cause
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->subcause;?>
						</td>
					</tr>
					<tr>
						<td>
							Hasil Konfirmasi
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->confirmationresult;?>
						</td>
					</tr>
					<tr>
						<td>
							Kesimpulan
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo $ticket->conclusion;?>
						</td>
					</tr>



					<tr>
						<td>
							Status
						</td>
						<td>
							:
						</td>
						<td>
							<?php echo ($ticket->status==="1")?"Selesai":"Belum Selesai";?>
						</td>
					</tr>
					<?php }?>
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
				$("#btnfilter").click(function(){
					branch ='';
					$.each($(".suspect-branches :checked"),function(){
						branch+=$(this).val();
					})					
					if($("#reportdate").val().trim()!==""){
						var dat = $("#reportdate").val(),
							sp = dat.split("/"),
							dt = sp[0], mn = sp[1],yr = sp[2];
						console.log(mn,yr);
						window.location.href = "/rpt/shiftreport/"+dt+"/"+mn+"/"+yr+"/"+branch;
					}
				})
				$(".monthdatepicker").datepicker({dateFormat:'dd/m/yy'});
			}(jQuery))
		</script>
	</body>
</html>

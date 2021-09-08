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
		<title>Laporan Tiket yang terselesaikan </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Tiket berdasarkan Shift</h3>
		<h5>
			<a class="rptanchor btn btn-success" href="/rpt">Home</a>
		</h5>
			<div class="row-fluid">
				<div class="well col-sm-12">
					<div class="col-sm-3">
						<input type="text" class="datepicker" id="startdate" value="<?php echo $uridate1?>" />
					</div>
                    <div class="col-sm-3">
                        <input type="text" class="datepicker" id="enddate" value="<?php echo $uridate2?>" />
                    </div>
				<!--</div>-->

				<?php
				$sbychecked = '';$jktchecked = '';$mlgchecked = '';$blichecked = '';
				for($x=0;$x<strlen($this->uri->segment(5));$x++){
					switch(substr($this->uri->segment(5),$x,1)){
						case '1':
						$sbychecked = "checked='checked'";
						break;
						case '3':
						$mlgchecked = "checked='checked'";
						break;
						case '2':
						$jktchecked = "checked='checked'";
						break;
						case '4':
						$blichecked = "checked='checked'";
						break;
					}
				}
				?>
				<div class="col-sm-3"><button class="btn btn-success" id="btnfilter">Filter</button></div>
				<div>
					<a class="btn btn-success" href="/rpt/complaintpershiftexcel/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>">Cetak Excel</a>
				</div>
				</div>
				<br />
			</div>

			<br />
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<thead>
                <tr>
                    <th rowspan=2>Kegiatan</th>
                    <?php foreach ($period as $dt) {?>
                        <td colspan=3> <?php echo $dt->format('d/m/Y');?></td>
                    <?php }?>
					<th colspan=3>Total</th>
                    </tr>
                    <tr>
                    <?php foreach ($period as $dt) { ?>
                    <td>Shift1</td><td>Shift2</td><td>Shift3</td>
                    <?php }?>
					<th>Shift1</th><th>Shift2</th><th>Shift3</th>
                </tr>
				</thead>
				<tbody>
                <tr>
					<td>Komplain</td>
					<?php 
					$shift1 = 0;$shift2 = 0;$shift3 = 0;
					?>
					<?php foreach ($period as $dt) { ?>
						<?php 
							$shift1+=  $this->pticket->getshiftticketcount('1',$dt);
							$shift2+=  $this->pticket->getshiftticketcount('2',$dt);
							$shift3+=  $this->pticket->getshiftticketcount('3',$dt);
						?>
						<td>
						<?php echo $this->pticket->getshiftticketcount('1',$dt);?>
						</td>
						<td>
						<?php echo $this->pticket->getshiftticketcount('2',$dt);?>
						</td>
						<td>
						<?php echo $this->pticket->getshiftticketcount('3',$dt);?>
						</td>
					<?php }?>
					<th>
					<?php
						echo $shift1;
					?>
					</th>
					<th>
					<?php
						echo $shift2;
					?>
					</th>
					<th>
					<?php
						echo $shift3;
					?>
					</th>
				</tr>
				<tr>
					<td>Follow Up</td>
					<?php 
					$shift1 = 0;$shift2 = 0;$shift3 = 0;
					?>
					<?php foreach ($period as $dt) { ?>
						<?php 
							$shift1+=  $this->pticket->getshiftfucount('1',$dt);
							$shift2+=  $this->pticket->getshiftfucount('2',$dt);
							$shift3+=  $this->pticket->getshiftfucount('3',$dt);
						?>
						<td>
						<?php echo $this->pticket->getshiftfucount('1',$dt);?>
						</td>
						<td>
						<?php echo $this->pticket->getshiftfucount('2',$dt);?>
						</td>
						<td>
						<?php echo $this->pticket->getshiftfucount('3',$dt);?>
						</td>
					<?php }?>
					<th>
					<?php
						echo $shift1;
					?>
					</th>
					<th>
					<?php
						echo $shift2;
					?>
					</th>
					<th>
					<?php
						echo $shift3;
					?>
					</th>
				</tr>
				<tr>
					<td></td>
					<?php foreach ($fakeperiod as $dt) { ?>
						<td>
						<?php echo $this->pticket->getticketopenbykdticket('1',$dt);?>
						</td>
						<td>
						<?php echo $this->pticket->getticketopenbykdticket('2',$dt);?>
						</td>
						<td>
						<?php echo $this->pticket->getticketopenbykdticket('3',$dt);?>
						</td>
					<?php }?>
				</tr>
				</tbody>
			</table>
		</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url();?>js/padilibs/padi.url.js"></script>
		<script type="text/javascript">
			(function($){
				 $(".datepicker").datepicker({dateFormat:'d/m/yy'});
			orderlink = function(orderby,branch){
				branch ='0';
				$.each($(".suspect-branches :checked"),function(){
					branch+=$(this).val();
				})
				$("#dt1").getdate();
				$("#dt2").getdate();
				order = urlsegment(4);
				range = urlsegment(6);
				rorder = (order=='desc')?'asc':'desc';
				console.log('rorder',rorder);
				$("#startdate").getdate();
				$("#enddate").getdate();
				window.location.href = baseurl+"rpt/complaintpershift/"+$("#startdate").attr("datetime")+"/"+$("#enddate").attr("datetime");;
			}
			$("#btnfilter").click(function(){
				orderlink(urlsegment(3),'');
			});
				$(".optage").click(function(){
					$("#startdate").getdate();
					$("#enddate").getdate();
					console.log("startdate",$("#startdate").val());
					branch ='';
					$.each($(".suspect-branches :checked"),function(){
						branch+=$(this).val();
					})
					order = urlsegment(4);
					console.log("urlsegment ",urlsegment(3));
					window.location.href = baseurl+"rpt/solvedreport/"+urlsegment(3)+"/"+order+"/"+branch+"/"+$(this).attr("value")+"/"+$("#startdate").attr("datetime")+"/"+$("#enddate").attr("datetime");
				});

				$("#dateasc").click(function(){
					console.log("pengurutan berdasarkan tanggal asc");
				});
				$("#datedesc").click(function(){
					console.log("pengurutan berdasarkan tanggal desc");
				});
				$("#hunterasc").click(function(){
					console.log("pengurutan berdasarkan hunter asc");
				});
				$("#hunterdesc").click(function(){
					console.log("pengurutan berdasarkan hunter desc");
				});

				$(".optage").click(function(){
					$("#txtage").html($(this).html());
				});
			}(jQuery))
		</script>

	</body>
</html>





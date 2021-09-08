<html>
	<head>
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/report/bootstrap-3.3.6.min.css">
		<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/jqueryui.1.12.0.css">
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
		</style>
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>
		<!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
		<script src="/asset/jqueryui.1.12.0.js"></script>
		<script src="/js/padilibs/padi.dateTimes.js"></script>
		<script src="/js/aquarius/links.js"></script>
		<title>Laporan durasi Tiket </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Durasi Tiket </h3>
		<h5>
			<a class="rptanchor btn btn-success" href="/rpt">Home</a>
		</h5>
			<div class="row-fluid">
				<div class="well col-sm-12">
					<div class="col-sm-3">

					</div>

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
				<!--<div class="well col-sm-6">-->
				<div class="col-sm-6">



				Tahun <?php echo date("Y");?>
				<select name="year" id="year">
					<?php for($x=2018;$x<=date("Y");$x++){ ?>
					<?php if(strval($x)===$year){?>
						<option selected="selected" value="<?php echo $x;?>"><?php echo $x;?></option>
					<?php }else{ ?>
						<option><?php echo $x;?></option>
					<?php }}?>
				</select>
				Bulan
				<select name="month" id="month">
					<?php foreach($months as $x=>$y){ ?>
						<?php if($x==$month){?>
						<option selected="selected" value="<?php echo $x;?>"><?php echo $y;?></option>
					<?php }else{ ?>
					<option value="<?php echo $x;?>"><?php echo $y;?></option>
					<?php }}?>
				</select>
				<button class="btn btn-success" id="filter">Filter</button>

				</div>
				<div class="col-sm-3">
				<a class="btn btn-success" id="btnexcel" href="/rpt/excelmonthlyduration/<?php echo $yearmonth;?>">Excel</a>
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
						<th colspan=2><?php echo "Total: " . $objs['cnt']?></th>
						<th colspan=5></th>
					</tr>
					<tr>
						<th>No</th>
						<th onClick='orderlink("ticketstart","1")' class="pointer">Kd Ticket</th>
						<th onClick='orderlink("ticketend","1")' class="pointer">Pelanggan</th>
						<th onClick='orderlink("brn","1")' class="pointer">Ticket Start</th>
						<th onClick='orderlink("brn","1")' class="pointer">Ticket End</th>
						<th onClick='orderlink("clientname","1")' class="pointer">Hari</th>
						<th onClick='orderlink("duration3","1")' class="pointer">Jam</th>
						<th onClick='orderlink("cause","1")' class="pointer">Menit</th>
					</tr>
				</thead>
				<tbody>
					<?php $c=0;?>
					<?php foreach($objs['res'] as $obj){?>
						<?php $c++;?>
					<tr>
						<th valign="top"><?php echo $c;?>.</th>
						<td><?php echo $obj->kdticket;?></td>
						<td>
							<?php echo $obj->clientname;?>
						</td>
						<td><?php echo $this->common->sql_to_human_datetime($obj->ticketstart);?></td>
						<td><?php echo $this->common->sql_to_human_datetime($obj->ticketend);?></td>
						<td>
							<?php echo $obj->day;?>
						</td>
						<td>
							<?php echo $obj->hour;?>
						</td>
						<td>
							<?php echo $obj->minute;?>
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


				$("#filter").click(function(){
					window.location.href = "/rpt/viewmonthlyduration/"+$("#year").val()+"-"+$("#month").val();
				});
				$(".datepicker").datepicker({dateFormat:'d/m/yy'});
			orderlink = function(orderby,branch){
				branch ='0';
				$.each($(".suspect-branches :checked"),function(){
					branch+=$(this).val();
				})
				$("#startdate").getdate();
				$("#enddate").getdate();
				order = urlsegment(4);
				range = urlsegment(6);
				rorder = (order=='desc')?'asc':'desc';
				console.log('rorder',rorder);
				window.location.href = "/rpt/showOpenTicket/"+orderby+"/"+rorder+"/"+branch+"/"+range+"/"+$("#startdate").attr("datetime")+"/"+$("#enddate").attr("datetime");
			}
			$("#btnfilter").click(function(){
				orderlink(urlsegment(3),'');
			});
				$(".optage").click(function(){
					$("#startdate").getdate();
					$("#enddate").getdate();
					console.log($("#dt1").val());
					branch ='';
					$.each($(".suspect-branches :checked"),function(){
						branch+=$(this).val();
					})
					order = urlsegment(4);
					console.log("urlsegment ",urlsegment(3));
					window.location.href = "/rpt/showOpenTicket/"+urlsegment(3)+"/"+order+"/"+branch+"/"+$(this).attr("value")+"/"+$("#startdate").attr("datetime")+"/"+$("#enddate").attr("datetime");
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

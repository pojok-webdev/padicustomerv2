<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('Dashboard/head');?>
<link rel="stylesheet" href="/asset/jqueryui.1.12.0.css">
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="/">
				<img src="/img/aquarius/logo_gold1.png" alt="PadiNET" />
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="/asset/metronic/assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<?php $this->load->view('Dashboard/notification');?>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<!-- END TODO DROPDOWN -->               
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username">Puji</span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
	<?php $this->load->view('Dashboard/sidebar');?>
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->        
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
						Ticket <small>Dashboard</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="/dashboard">Dashboard</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="/dashboard/bts">Ticket</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="control">
							<input type="checkbox" name="branch" class="branch" <?php echo branchchecked(1,$branches);?> value='1'>Surabaya
							<input type="checkbox" name="branch" class="branch" <?php echo branchchecked(2,$branches);?> value='2'>Jakarta
							<input type="checkbox" name="branch" class="branch" <?php echo branchchecked(3,$branches);?> value='3'>Malang
							<input type="checkbox" name="branch" class="branch" <?php echo branchchecked(4,$branches);?> value='4'>Bali
							<input type="text" class="datepicker dtpicker" id="filterdate" value="<?php echo $filterdate;?>" />
							<button id='branchfilterbutton'>Filter</button>
						</div>

						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box green">
							<div class="portlet-title">
								<div class="caption"><i class="icon-cogs"></i>Ticket PadiNET</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th rowspan=2>NAMA</th>
											<th colspan=2>HARI-H</th>
											<th colspan=2 class="numeric">MINGGU BERJALAN</th>
											<th colspan=2 class="numeric">BULAN BERJALAN</th>
											<th colspan=2 class="numeric">QUARTER BERJALAN</th>
											<th colspan=2 class="numeric">TAHUN BERJALAN</th>
										</tr>
										<tr>
										<th>Open</th><th>Closed</th>
										<th>Open</th><th>Closed</th>
										<th>Open</th><th>Closed</th>
										<th>Open</th><th>Closed</th>
										<th>Open</th><th>Closed</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>FFR</td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/1/<?php echo $trailingbranches;?>"><?php echo $ffrdailyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/1/<?php echo $trailingbranches;?>"><?php echo $ffrdailyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/1/<?php echo $trailingbranches;?>"><?php echo $ffrweeklyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/1/<?php echo $trailingbranches;?>"><?php echo $ffrweeklyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/1/<?php echo $trailingbranches;?>"><?php echo $ffrmonthlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/1/<?php echo $trailingbranches;?>"><?php echo $ffrmonthlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/1/<?php echo $trailingbranches;?>"><?php echo $ffrquarterlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/1/<?php echo $trailingbranches;?>"><?php echo $ffrquarterlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/1/<?php echo $trailingbranches;?>"><?php echo $ffryearlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/1/<?php echo $trailingbranches;?>"><?php echo $ffryearlyticketclosed->cnt;?></a></td>
										</tr>
										<tr>
											<td>Platinum</td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/2/<?php echo $trailingbranches;?>"><?php echo $pltdailyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/2/<?php echo $trailingbranches;?>"><?php echo $pltdailyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/2/<?php echo $trailingbranches;?>"><?php echo $pltweeklyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/2/<?php echo $trailingbranches;?>"><?php echo $pltweeklyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/2/<?php echo $trailingbranches;?>"><?php echo $pltmonthlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/2/<?php echo $trailingbranches;?>"><?php echo $pltmonthlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/2/<?php echo $trailingbranches;?>"><?php echo $pltquarterlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/2/<?php echo $trailingbranches;?>"><?php echo $pltquarterlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/2/<?php echo $trailingbranches;?>"><?php echo $pltyearlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/2/<?php echo $trailingbranches;?>"><?php echo $pltyearlyticketclosed->cnt;?></a></td>
										</tr>
										<tr>
											<td>Gold</td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/3/<?php echo $trailingbranches;?>"><?php echo $glddailyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/3/<?php echo $trailingbranches;?>"><?php echo $glddailyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/3/<?php echo $trailingbranches;?>"><?php echo $gldweeklyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/3/<?php echo $trailingbranches;?>"><?php echo $gldweeklyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/3/<?php echo $trailingbranches;?>"><?php echo $gldmonthlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/3/<?php echo $trailingbranches;?>"><?php echo $gldmonthlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/3/<?php echo $trailingbranches;?>"><?php echo $gldquarterlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/3/<?php echo $trailingbranches;?>"><?php echo $gldquarterlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/3/<?php echo $trailingbranches;?>"><?php echo $gldyearlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/3/<?php echo $trailingbranches;?>"><?php echo $gldyearlyticketclosed->cnt;?></a></td>
										</tr>
										<tr>
											<td>Silver</td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/5/<?php echo $trailingbranches;?>"><?php echo $slvdailyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/5/<?php echo $trailingbranches;?>"><?php echo $slvdailyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/5/<?php echo $trailingbranches;?>"><?php echo $slvweeklyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/5/<?php echo $trailingbranches;?>"><?php echo $slvweeklyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/5/<?php echo $trailingbranches;?>"><?php echo $slvmonthlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/5/<?php echo $trailingbranches;?>"><?php echo $slvmonthlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/5/<?php echo $trailingbranches;?>"><?php echo $slvquarterlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/5/<?php echo $trailingbranches;?>"><?php echo $slvquarterlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/5/<?php echo $trailingbranches;?>"><?php echo $slvyearlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/5/<?php echo $trailingbranches;?>"><?php echo $slvyearlyticketclosed->cnt;?></a></td>										
										</tr>
										<tr>
											<td>Bronze</td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/4/<?php echo $trailingbranches;?>"><?php echo $brndailyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/4/<?php echo $trailingbranches;?>"><?php echo $brndailyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/4/<?php echo $trailingbranches;?>"><?php echo $brnweeklyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/4/<?php echo $trailingbranches;?>"><?php echo $brnweeklyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/4/<?php echo $trailingbranches;?>"><?php echo $brnmonthlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/4/<?php echo $trailingbranches;?>"><?php echo $brnmonthlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/4/<?php echo $trailingbranches;?>"><?php echo $brnquarterlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/4/<?php echo $trailingbranches;?>"><?php echo $brnquarterlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/4/<?php echo $trailingbranches;?>"><?php echo $brnyearlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/4/<?php echo $trailingbranches;?>"><?php echo $brnyearlyticketclosed->cnt;?></a></td>
										</tr>
										<tr>
											<td>Non Kategori</td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/0/<?php echo $trailingbranches;?>"><?php echo $undefineddailyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/d/0/<?php echo $trailingbranches;?>"><?php echo $undefineddailyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/0/<?php echo $trailingbranches;?>"><?php echo $undefinedweeklyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/w/0/<?php echo $trailingbranches;?>"><?php echo $undefinedweeklyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/0/<?php echo $trailingbranches;?>"><?php echo $undefinedmonthlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/m/0/<?php echo $trailingbranches;?>"><?php echo $undefinedmonthlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/0/<?php echo $trailingbranches;?>"><?php echo $undefinedquarterlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/q/0/<?php echo $trailingbranches;?>"><?php echo $undefinedquarterlyticketclosed->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/0/<?php echo $trailingbranches;?>"><?php echo $undefinedyearlyticket->cnt;?></a></td>
											<td class="numeric"><a href="/dashboards/ticketdetails/y/0/<?php echo $trailingbranches;?>"><?php echo $undefinedyearlyticketclosed->cnt;?></a></td>
										</tr>
									</tbody>
									<tfoot>
									<tr>
											<td>Total</td>
											<td class="numeric"><?php echo $ffrdailyticket->cnt+$pltdailyticket->cnt+$glddailyticket->cnt+$brndailyticket->cnt+$slvdailyticket->cnt+$undefineddailyticket->cnt;?></td>
											<td class="numeric"><?php echo $ffrdailyticketclosed->cnt+$pltdailyticketclosed->cnt+$glddailyticketclosed->cnt+$brndailyticketclosed->cnt+$slvdailyticketclosed->cnt+$undefineddailyticketclosed->cnt;?></td>

											<td class="numeric"><?php echo $ffrweeklyticket->cnt+$pltweeklyticket->cnt+$gldweeklyticket->cnt+$brnweeklyticket->cnt+$slvweeklyticket->cnt+$undefinedweeklyticket->cnt;?></td>
											<td class="numeric"><?php echo $ffrweeklyticketclosed->cnt+$pltweeklyticketclosed->cnt+$gldweeklyticketclosed->cnt+$brnweeklyticketclosed->cnt+$slvweeklyticketclosed->cnt+$undefinedweeklyticketclosed->cnt;?></td>
											
											<td class="numeric"><?php echo $ffrmonthlyticket->cnt+$pltmonthlyticket->cnt+$gldmonthlyticket->cnt+$brnmonthlyticket->cnt+$slvmonthlyticket->cnt+$undefinedmonthlyticket->cnt;?></td>
											<td class="numeric"><?php echo $ffrmonthlyticketclosed->cnt+$pltmonthlyticketclosed->cnt+$gldmonthlyticketclosed->cnt+$brnmonthlyticketclosed->cnt+$slvmonthlyticketclosed->cnt+$undefinedmonthlyticketclosed->cnt;?></td>
											
											<td class="numeric"><?php echo $ffrquarterlyticket->cnt+$pltquarterlyticket->cnt+$gldquarterlyticket->cnt+$brnquarterlyticket->cnt+$slvquarterlyticket->cnt+$undefinedquarterlyticket->cnt;?></td>
											<td class="numeric"><?php echo $ffrquarterlyticketclosed->cnt+$pltquarterlyticketclosed->cnt+$gldquarterlyticketclosed->cnt+$brnquarterlyticketclosed->cnt+$slvquarterlyticketclosed->cnt+$undefinedquarterlyticketclosed->cnt;?></td>
											
											<td class="numeric"><?php echo $ffryearlyticket->cnt+$pltyearlyticket->cnt+$gldyearlyticket->cnt+$brnyearlyticket->cnt+$slvyearlyticket->cnt+$undefinedyearlyticket->cnt;?></td>
											<td class="numeric"><?php echo $ffryearlyticketclosed->cnt+$pltyearlyticketclosed->cnt+$gldyearlyticketclosed->cnt+$brnyearlyticketclosed->cnt+$slvyearlyticketclosed->cnt+$undefinedyearlyticketclosed->cnt;?></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2018 &copy; PadiNET Dashboard.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="/asset/metronic/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="/asset/metronic/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="/asset/metronic/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="/asset/metronic/assets/plugins/excanvas.min.js"></script>
	<script src="/asset/metronic/assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="/asset/metronic/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="/asset/metronic/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<script src="/asset/metronic/assets/scripts/app.js"></script>      
	<script>
		jQuery(document).ready(function() {       
		   App.init();
		   getbranches = function(callback){
			   callback($('.branch:checked').map(function(){
				   return $(this).val();
			   }).get().join('-'));
		   }
		   getdate = function(){
			   let arr = $('#filterdate').val().split('/');
			   return(arr[2]+'-'+arr[0]+'-'+arr[1]);
		   }
		   $('#branchfilterbutton').click(function(){
			   getbranches(function(branches){
				   window.location.href = '/dashboards/ticket/'+branches+'/'+getdate();
			   })
		   });
		   $('.dtpicker').datepicker();
		});
	</script>
</body>
<!-- END BODY -->
</html>
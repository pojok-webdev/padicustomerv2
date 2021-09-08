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
				<a class="brand" href="index.html">
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
						<img alt="" src="/asset/metronic/assets/img/avatar1_small.jpg" />
						<span class="username">Puji</span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
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
						Troubleshoot <small>Dashboard</small>
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
							<li><a href="/dashboard/bts">Troubleshoot</a></li>
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
								<div class="caption"><i class="icon-cogs"></i>Troubleshoot PadiNET</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
								<thead class="flip-content">
									<tr>
										<th>NAMA</th>
										<th>HARI-H</th>
										<th class="numeric">MINGGU BERJALAN</th>
										<th class="numeric">BULAN BERJALAN</th>
										<th class="numeric">QUARTER BERJALAN</th>
										<th class="numeric">TAHUN BERJALAN</th>
									</tr>
								</thead>
								<tbody>
										<tr>
											<td>FFR</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/d/1/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $ffrdailytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/w/1/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $ffrweeklytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/m/1/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $ffrmonthlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/q/1/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $ffrquarterlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/y/1/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $ffryearlytroubleshoot->cnt;?>
												</a>
											</td>
										</tr>
										<tr>
											<td>Platinum</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/d/2/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $pltdailytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/w/2/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $pltweeklytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/m/2/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $pltmonthlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/q/2/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
												<?php echo $pltquarterlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/y/2/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $pltyearlytroubleshoot->cnt;?>
												</a>
											</td>
										</tr>
										<tr>
											<td>Gold</td>
											<td class="numeric">
											<a href="/dashboards/troubleshootdetails/d/3/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
											<?php echo $glddailytroubleshoot->cnt;?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/troubleshootdetails/w/3/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
											<?php echo $gldweeklytroubleshoot->cnt;?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/troubleshootdetails/m/3/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
											<?php echo $gldmonthlytroubleshoot->cnt;?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/troubleshootdetails/q/3/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
											<?php echo $gldquarterlytroubleshoot->cnt;?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/troubleshootdetails/y/3/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
											<?php echo $gldyearlytroubleshoot->cnt;?>
											</a>
											</td>
										</tr>
										<tr>
											<td>Silver</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/d/5/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $slvdailytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/w/5/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $slvweeklytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/m/5/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $slvmonthlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/q/5/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $slvquarterlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/y/5/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $slvyearlytroubleshoot->cnt;?>
												</a>
											</td>
										</tr>
										<tr>
											<td>Bronze</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/d/4/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $brndailytroubleshoot->cnt;?>
												</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/w/4/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $brnweeklytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/m/4/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $brnmonthlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/q/4/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $brnquarterlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/y/4/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $brnyearlytroubleshoot->cnt;?>
												</a>
											</td>
										</tr>
										<tr>
											<td>Uncategorized</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/d/0/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $uncategorizeddailytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/w/0/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $uncategorizedweeklytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/m/0/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $uncategorizedmonthlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/q/0/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $uncategorizedquarterlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/troubleshootdetails/y/0/<?php echo $trailingbranches?>/<?php echo $yearfilter?>">
													<?php echo $uncategorizedyearlytroubleshoot->cnt;?>
												</a>
											</td>
										</tr>
									</tbody>
									<tfoot>
									<tr>
											<td>Total</td>
											<td class="numeric">
												<a>
													<?php echo $totaldailytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
											<a>
													<?php echo $totalweeklytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
											<a>
													<?php echo $totalmonthlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
											<a>
													<?php echo $totalquarterlytroubleshoot->cnt;?>
												</a>
											</td>
											<td class="numeric">
											<a>
													<?php echo $totalyearlytroubleshoot->cnt;?>
												</a>
											</td>
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
		   // initiate layout and plugins
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
				   window.location.href = '/dashboards/troubleshoot/'+getdate()+'/'+branches;
			   })
		   });
		   $('.dtpicker').datepicker();
		});
	</script>
</body>
<!-- END BODY -->
</html>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 2.3.2
Version: 1.4
Author: KeenThemes
Website: http://www.keenthemes.com/preview/?theme=metronic
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('Dashboard/head');?>
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
						<img alt="" src="assets/img/avatar1_small.jpg" />
						<span class="username"><?php echo $this->session->userdata("username")?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a></li>
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
	<div class="page-container">
		<?php $this->load->view('Dashboard/sidebar');?>
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default"></li>
									<li class="color-blue" data-style="blue"></li>
									<li class="color-brown" data-style="brown"></li>
									<li class="color-purple" data-style="purple"></li>
									<li class="color-grey" data-style="grey"></li>
									<li class="color-white color-light" data-style="light"></li>
								</ul>
								<label>
									<span>Layout</span>
									<select class="layout-option m-wrap small">
										<option value="fluid" selected>Fluid</option>
										<option value="boxed">Boxed</option>
									</select>
								</label>
								<label>
									<span>Header</span>
									<select class="header-option m-wrap small">
										<option value="fixed" selected>Fixed</option>
										<option value="default">Default</option>
									</select>
								</label>
								<label>
									<span>Sidebar</span>
									<select class="sidebar-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
								<label>
									<span>Footer</span>
									<select class="footer-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
							</div>
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard <small>PadiNET</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
							<li class="pull-right no-text-shadow">
								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div id="dashboard">
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row-fluid">
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat green">
								<div class="visual">
									<i class="icon-bolt"></i>
								</div>
								<div class="details">
									<div class="number">
									<?php echo $totaltickets;?>
									</div>
									<div class="desc">                           
										Total Tiket Open <?php echo $curmonth . ' ' .$curyear;?>
									</div>
								</div>
								<a class="more" href="/tickets">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat red">
								<div class="visual">
									<i class="icon-bolt"></i>
								</div>
								<div class="details">
									<div class="number"><?php echo $totaltroubleshoots;?></div>
									<div class="desc">Total Troubleshoot  <?php echo $curmonth . ' ' .$curyear;?></div>
								</div>
								<a class="more" href="/troubleshoots">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
							<div class="dashboard-stat yellow">
								<div class="visual">
									<i class="icon-bolt"></i>
								</div>
								<div class="details">
									<div class="number"><?php echo $totalsurveys;?></div>
									<div class="desc">Total Survey  <?php echo $curmonth . ' ' .$curyear;?></div>
								</div>
								<a class="more" href="/surveys">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat blue">
								<div class="visual">
									<i class="icon-bolt"></i>
								</div>
								<div class="details">
									<div class="number"><?php echo $totalinstalls;?></div>
									<div class="desc">Total Instalasi  <?php echo $curmonth . ' ' .$curyear;?></div>
								</div>
								<a class="more" href="/install_requests">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
					</div>
					<!-- END DASHBOARD STATS -->
					<div class="clearfix"></div>
					<div class="row-fluid">
						<div class="span6">
							<!-- BEGIN PORTLET-->
							<div class="portlet solid bordered light-grey">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bar-chart"></i>Site Visits</div>
									<div class="tools">
										<div class="btn-group pull-right" data-toggle="buttons-radio">
											<a href="/dashboards/visit_entry" class="btn mini">Entry Visit</a>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div id="site_statistics_loading">
										<img src="assets/img/loading.gif" alt="loading" />
									</div>
									<div id="site_statistics_content" class="hide">
										<div id="site_statistics" class="chart"></div>
									</div>
								</div>
							</div>
							<!-- END PORTLET-->
						</div>
						<div class="span6">
							<!-- BEGIN PORTLET-->
							<div class="portlet solid bordered light-grey">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bar-chart"></i>Quotation</div>
									<div class="tools">
										<div class="btn-group pull-right" data-toggle="buttons-radio">
											<a href="/dashboards/offer_entry" class="btn mini">Entry Quotation</a>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div id="offer_statistics_loading">
										<img src="assets/img/loading.gif" alt="loading" />
									</div>
									<div id="offer_statistics_content" class="hide">
										<div id="offer_statistics" class="chart"></div>
									</div>
								</div>
							</div>
							<!-- END PORTLET-->
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2018 &copy; PadiNET.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<script src="/asset/metronic/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
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
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>  
	<script src="/asset/metronic/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
	<script src="/asset/metronic/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="/asset/metronic/assets/scripts/padi-dashboard.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/scripts/padi-dashboard-index.js" type="text/javascript"></script>
	<script src="/asset/metronic/assets/scripts/tasks.js" type="text/javascript"></script>        
	<!-- END PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   Index.initJQVMAP(); // init index page's custom scripts
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts
		   Index.initChat();
		   Index.initMiniCharts();
		   Index.initIntro();
		   Tasks.initDashboardWidget();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
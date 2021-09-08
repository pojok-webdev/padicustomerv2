<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
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
				<a class="brand" href="#">
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
						<span class="username"><?php echo $this->session->userdata['username'];?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/adm/logout"><i class="icon-key"></i> Log Out</a></li>
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
			<div id="showImage" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p><img id="receiptimage" alt="Receipt"></p>
				</div>
			</div>

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->        
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
						Sales <small>Dashboard</small>
						</h3>
						<?php if($is_admin){?>
							<a class="btn" href="/dashboards/visit_entry">Add Visit</a>
						<?php }?>
						<a class="btn" href="<?php echo $uncountedvisit;?>"><?php echo $uncountedvisitlabel;?></a>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="/dashboards">Dashboard</a>
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="/dashboards/sales">Sales</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">List Reimburse</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->          
				<div class="row-fluid">
					<div class="span12">
						<div class="caption">
							<h1><?php echo $headertext;?></h1>
						</div>

						<table class="table-bordered table-striped table-condensed flip-content" width="100%">
									<thead class="flip-content">
										<tr>
											<th>No</th>
											<th>Waktu</th>
											<th>Pelanggan</th>
											<th>PIC</th>
											<th>Keperluan</th>
											<th>Reimburse</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $c = 1;$total = 0;?>
										<?php foreach($visits as $visit){?>
										<tr>
											<td class=""><?php echo $c;?></td>
											<?php $total+=$visit->nominalreimburse;?>
											<td class="">
												<h5><i class="icon-calendar"></i> <?php echo $visit->visitdate;?></h5>
												<h5><i class="icon-time"></i> Start <?php echo $visit->visitstart;?></h5>
												<h5><i class="icon-time"></i> Finish <?php echo $visit->visitfinish;?></h5>
											</td>
											<td class="">
												<h5>
													<span class="showimage" theimage="<?php echo $visit->receiptimage;?>">
														<b><?php echo $visit->clientname;?></b>
													</span>
												</h5>
												<h5><i class="icon-map-marker"></i> <?php echo $visit->address;?></h5>
												<h6>
												<i class="icon-info-sign"></i> 
												<?php echo $visit->phone;?></h6>
											</td>
											<td class="">
												<h5>
												<i class="icon-user"></i> <?php echo $visit->pic;?>
												</h5>
												<h5><i class="icon-info-sign"></i> <?php echo $visit->hp;?></h5>
											</td>
											<td class=""><?php echo $visit->aim;?></td>
											<td class="numeric">Rp. <?php echo number_format($visit->nominalreimburse);?></td>
											<td>
												<a class="btn" href="/dashboards/visit_edit/<?php echo $visit->id;?>">Edit</a>
											</td>
										</tr>
										<?php $c++;?>
										<?php }?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan=7>Total Kunjungan <?php echo number_format($c-1);?></td>
										</tr>
										<tr>
											<td colspan=7>Total Reimburse Rp. <?php echo number_format($total);?></td>
										</tr>
									</tfoot>
								</table>

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
		   $(".showimage").click(function(){
			   theimage = $(this).attr("theimage");
			   $("#receiptimage").attr("src",theimage);
			   $("#showImage").modal();
		   });
		   App.init();
		});
	</script>
</body>
<!-- END BODY -->
</html>
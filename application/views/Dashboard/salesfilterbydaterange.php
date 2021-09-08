<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('Dashboard/head');?>
<link rel="stylesheet" href="/asset/metronic/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
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
						<span class="username"><?php echo $this->session->userdata['username'];?></span>
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

			<!--puji modal start-->
			<div id="customFilterModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3 id="username">Radio Switch in Modal</h3>
				</div>
				<div class="modal-body">
					<form action="#" class="form-horizontal">
						<div class="control-group">
							<label class="control-label">Visit</label>
							<div class="controls">
								<div class="switch" data-on="info" data-off="success">
									<input type="checkbox" checked class="toggle" id="visitcheckbox"/>
								</div>
								<input type="text" class="date-picker vdate" id="vdate1" value="<?php echo $date1;?>"/>
								<input type="text" class="date-picker vdate" id="vdate2" value="<?php echo $date2;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Penawaran</label>
							<div class="controls">
								<div class="switch" data-on="warning" data-off="danger">
									<input type="checkbox" checked class="toggle" id="offercheckbox"/>
								</div>
								
								
							</div>
						</div>
					</form>
					<div class="modal-footer">
						<div class="control-group">
							<button class="btn">Go</button>
						</div>
					</div>
				</div>
			</div>
			<!--puji modal end -->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
						Sales <small>Dashboard</small>
						<?php if($is_admin){?>
							<a class="btn" href="/dashboards/offer_entry">Add Quotation</a>
							<a class="btn" href="/dashboards/visit_entry">Add Visit</a>
						<?php }?>
						<a class="btn" href="/dashboards/sales">Fixed Filter</a>
						</h3>
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
								<a href="/dashboards/sales/">Sales</a>
								<i class="icon-reorder"></i>
							</li>
							<li>
								<a href="#branch_dashboard">Cabang</a>
								<i class="icon-reorder"></i>
							</li>
							<li>
								<a href="#national_dashboard">Nasional</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box green">
							<div class="portlet-title">
								<div class="controls">
									<i class="icon-cogs"></i>Sales PadiNET ()
									<input type="text" class="date-picker odate" id="odate1" value="<?php echo $date1;?>"/>
									<input type="text" class="date-picker odate" id="odate2" value="<?php echo $date2;?>"/>
									<button class="btn" id="doFiltering">Do Filtering</button>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th rowspan=2></th>
											<th colspan=2>Visit</th>
											<th rowspan=2 class="numeric">Penawaran</th>
										</tr>
										<tr>
											<th>Terhitung</th>
											<th>Tidak Terhitung</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($sales as $am){?>
										<tr>
											<td><?php echo '<span class="username">'.$am->username . '</span> ' . $am->branch?></td>
											<td class="numeric">
											<a href="/dashboards/listvisitsfilterbydaterange/<?php echo $date1;?>/<?php echo $date2;?>/<?php echo $am->id;?>/<?php echo $am->branch_id;?>/1">
											<?php echo $am->visitcount;?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisitsfilterbydaterange/<?php echo $date1;?>/<?php echo $date2;?>/<?php echo $am->id;?>/<?php echo $am->branch_id;?>/0">
											<?php echo $am->visituncount;?>
											</a>
											</td>
											<td class="numeric">
												<a href="/dashboards/listoffersfilterbydaterange/<?php echo $date1;?>/<?php echo $date2;?>/<?php echo $am->id;?>/<?php echo $am->branch_id;?>">
													<?php echo $am->offercount;?>
												</a>
											</td>
										</tr>
									<?php }?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->







				<!-- place for branches-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12" id="branch_dashboard">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						
						<div class="portlet box blue">
							<div class="portlet-title">
								
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
									<tr>
											<th rowspan=2></th>
											<th colspan=2>Visit</th>
											<th rowspan=2 class="numeric">Penawaran</th>
										</tr>
										<tr>
											<th>Terhitung</th>
											<th>Tidak Terhitung</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($branches as $branch){?>
										<tr>
											<td>
											<div class="caption">
											<i class="icon-cogs"></i>
											Cabang PadiNET (<?php echo $branch->name;?>)
											</div>
											</td>
											<td class="numeric">
											<?php echo $branch->visitcnt;?>
											</td>
											<td class="numeric">
											<?php echo $branch->visituncnt;?>
											</td>
											<td class="numeric">
											
											<?php echo $branch->offercnt;?>
											</td>
										</tr>
									<?php }?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- end of place for branches -->













				<!-- place for branches-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box red">
							<div class="portlet-title">
								<div class="caption" id="national_dashboard"><i class="icon-cogs"></i>Nasional PadiNET </div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th rowspan=2></th>
											<th colspan=2>Visit</th>
											<th rowspan=2 class="numeric">Penawaran</th>
										</tr>
										<tr>
											<th>Terhitung</th>
											<th>Tidak Terhitung</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Total</td>
											<td class="numeric"><?php echo $national->visit;?></td>
											<td class="numeric"><?php echo $national->visituncnt;?></td>
											<td class="numeric">
											<?php echo $national->offer;?>
											</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->

				<!-- end of place for branches -->

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
	<script src="/asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/asset/metronic/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
 	<!-- END CORE PLUGINS -->
	<script src="/js/aquarius/radu.js"></script>
	<script src="/asset/metronic/assets/scripts/app.js"></script>
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
			$(".btnCustomFilter").click(function(){
				console.log("customFilterButton clicked");
				$("#customFilterModal").modal();
				username = $(this).stairUp({level:1}).find('.username').html();
				$("#username").html(username);
			});
			$("#vdate1").datepicker({
				autoclose:true,
				format:'yyyy-mm-dd',
				todayBtn:true
			});
			$("#vdate2").datepicker({
				autoclose:true,
				format:'yyyy-mm-dd',
				todayBtn:true
			});
			$("#odate1").datepicker({
				autoclose:true,
				format:'yyyy-mm-dd',
				todayBtn:true
			});
			$("#odate2").datepicker({
				autoclose:true,
				format:'yyyy-mm-dd',
				todayBtn:true
			});
			$("#visitcheckbox").change(function(){
				console.log($(this).val());
				if($(this).is(":checked")){
					console.log("Checked bro");
					$(".vdate").attr("disabled",false);
				}else{
					console.log("not checked bro");
					$(".vdate").val("");
					$(".vdate").attr("disabled",true);
				}
			});
			$("#offercheckbox").change(function(){
				console.log($(this).val());
				if($(this).is(":checked")){
					console.log("Checked bro");
					$(".odate").attr("disabled",false);
				}else{
					console.log("not checked bro");
					$(".odate").val("");
					$(".odate").attr("disabled",true);
				}
			});
			$("#doFiltering").click(function(){
				window.location.href = '/dashboards/salesfilterbydaterange/'+$("#odate1").val()+'/'+$("#odate2").val()
			})
		   App.init();
		});
	</script>
</body>
<!-- END BODY -->
</html>
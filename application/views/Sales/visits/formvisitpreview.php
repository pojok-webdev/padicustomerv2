<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>PadiNET | Visit Form</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="padiNET" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="/asset/metronic/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/style-responsive.preview.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/asset/metronic/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<style>
		.formtitle{
			font-size: 43px;
		}
	</style>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
	<!-- END PLUGINS USED BY X-EDITABLE -->
	<!-- BEGIN X-EDITABLE PLUGIN-->
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
	<!-- END X-EDITABLE PLUGIN-->
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	<style>
	a.editable-click { border-bottom: none; }
	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container_ row-fluid">
		<!-- BEGIN SIDEBAR -->
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<img src="/img/logo-padinet-form-visit.jpg" alt="PadiNET" width="250px">
						<p class="text-center formtitle">VISIT FORM</p>
						<hr>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<table id="user" class="table table-bordered_ table-striped_">
							<tbody>
								<tr>
									<td style="width:15%">Day/Date</td>
									<td>
									<a href="#" id="visitdate" data-type="date" data-viewformat="dd MM yyyy" data-pk="1" data-placement="right" data-original-title="Visit date"><?php echo date("d M Y");?>
									</a>
									</td>
									<td>
									<span class="muted">Time</span>
									<a href="#" id="time1" data-type="combodate" data-viewformat="HH mm" data-format="HH:mm" data-template="HH : mm" data-pk="1" data-placement="right" data-original-title="Time Start"><?php echo date("H : m");?>
									</a>
									<span class="muted">To</span>
									<a href="#" id="time2" data-type="combodate" data-viewformat="HH mm" data-format="HH:mm" data-template="HH : mm" data-pk="1" data-placement="right" data-original-title="Time End"><?php echo date("H : m");?>
									</a>
									</td>
									</tr>
								<tr>
									<td>Company name</td>
									<td colspan="2">
										<a href="#" id="companyname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter Company Name">
											<?php echo $obj->name;?>
										</a>
									</td>
								</tr>
								<tr>
									<td>Address</td>
									<td style="width:50%" colspan="2">
									<a href="#" id="address" data-type="text" data-pk="1" data-original-title="Enter Address">
									<?php echo $obj->address;?>
									</a>
									</td>
								</tr>
								<tr>
									<td>Contact Person</td>
									<td style="width:50%" colspan="2">
									<a href="#" id="contactperson" data-type="text" data-pk="1" data-original-title="Enter Contact Person">
									</a>
									</td>
								</tr>
								<tr>
									<td>Position</td>
									<td colspan="2"><a href="#" id="position" data-type="select" data-pk="1" data-value="5" data-source="/positions" data-original-title="Select position">Admin</a></td>
								</tr>
								<tr>
									<td>Contact Number</td>
									<td style="width:50%" colspan="2">
									<a href="#" id="contactnumber" data-type="text" data-pk="1" data-original-title="Enter Contact Number">
									</a>
									</td>
								</tr>
								<tr>
									<td>Purpose of Visit</td>
									<td style="width:50%" colspan="2">
									<a href="#" id="purposeofvisit" data-type="text" data-pk="1" data-original-title="Enter Purpose of Visit">
									</a>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>Sales</td>
									<td>Customer</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td><?php echo humanize($this->session->userdata("username"));?></td>
									<td><span id="custname"></span></td>
								</tr>
								<tr>
									<td colspan=3>
										<subscript>
											<i>Note: Customer signature and Company stamp required</i>
										</subscript>
									</td>
								</tr>
								<tr>
									<td colspan=3>
										<button id="btnprint" class="btn btn-primary">
											<span class="icon-print"></span>
											Cetak
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="row">
							<div class="6"><span class="center-text">A</span></div>
							<div class="6"><span class="center-text">B</span></div>
						</div>
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
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
	<script type="text/javascript" src="/asset/metronic/assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/moment.min.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/jquery.mockjax.js"></script>
	<!-- END PLUGINS USED BY X-EDITABLE -->
	<!-- BEGIN X-EDITABLE PLUGIN -->
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>   
	<!-- END X-EDITABLE PLUGIN -->
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="/asset/metronic/assets/scripts/app.js"></script>
	<script src="/js/metronics/sales/formvisitpreview.js"></script>
	<script>
		jQuery(document).ready(function() {
		// initiate layout and plugins
		App.init();
		FormEditable.init();
		createuser="<?php echo $this->session->userdata("username");?>"
		});
	</script>
	<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>
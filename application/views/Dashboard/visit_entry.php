<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('Dashboard/head');?>
<link rel="stylesheet" href="/asset/metronic/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
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
				<img src="assets/img/menu-toggler.png" alt="" />
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
	<script src="/js/padilibs/padi.imagelib.js"></script>
	<script>
		function loadImage1(evt){
			var input = evt.target;
			var filereader = new FileReader();
			filereader.onload = function(){
				resizeImage(filereader.result, function(result){
					$("#output").attr("src",result);
					$("#receiptimage").val(result);
				})
			}
			filereader.readAsDataURL(input.files[0]);
		}
	</script>

		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
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
						<h3 class="page-title">
							Visit Entry
							<small>Dashboard</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/">Home</a> 
								<span class="icon-angle-right"></span>
							</li>
							<li>
								<a href="/dashboards">Dashboard</a>
								<span class="icon-angle-right"></span>
							</li>
							<li><a href="#">Visit Entry</a></li>
						</ul>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN SAMPLE FORM PORTLET-->   
						<div class="portlet box blue tabbable">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-reorder"></i>
									<span class="hidden-480">Visit Entry</span>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="tabbable portlet-tabs">
									<ul class="nav nav-tabs">
										<li></li>
										<li></li>
										<li class="active"><a href="#portlet_tab1" data-toggle="tab"> &nbsp</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="portlet_tab1">
											<!-- BEGIN FORM-->
											<form enctype="multipart/form-data" action="<?php echo $action;?>" method="POST" class="form-horizontal">
												<div class="control-group">
													<?php echo $id;?>
													<label class="control-label">Sales</label>
													<div class="controls">
														<select class="small m-wrap" name="sale_id" tabindex="1" id="sale_id">
															<option value="-">Pilihlah</option>
															<?php foreach($sales as $sale){?>
																<option basebranch="<?php echo $sale->basebranch?>" <?php if($obj->sale_id==$sale->id){echo "selected='selected'";}?> value="<?php echo $sale->id;?>">
																<?php echo $sale->username;?>
																</option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Terhitung KPI</label>
													<div class="controls">
														<select class="small m-wrap" id="iscounted" name="iscounted" tabindex="1">
															<option value="-">Pilihlah</option>
															<option <?php if($obj->iscounted=="1"){echo "selected='selected'";}?> value="1">Ya</option>
															<option <?php if($obj->iscounted=="0"){echo "selected='selected'";}?> value="0">Tidak</option>
														</select>
													</div>
												</div>
												<div class="control-group" id="optionalbranch">
													<label class="control-label">Cabang</label>
													<div class="controls">
														<select class="medium m-wrap" tabindex="1" name="branch" id="soptionalbranch">
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Client Name</label>
													<div class="controls">
														<input type="text" placeholder="client name" name="clientname" class="m-wrap small" value="<?php echo $obj->clientname;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Address</label>
													<div class="controls">
														<input type="text" placeholder="address" name="address" class="m-wrap medium" value="<?php echo $obj->address;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Phone</label>
													<div class="controls">
														<input type="text" placeholder="Phone" name="phone" class="m-wrap large" value="<?php echo $obj->phone;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Visit Date</label>
													<div class="controls">
														<div class="input-append date date-picker" data-date="2018-11-11" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
															<input class="hidden" readonly size="16" type="text" value="<?php echo $obj->visitdate;?>" name="visitdate" id="visitdate" placeholder="Waktu mulai" />
															<input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php echo $obj->visitstart;?>" name="visitstart" id="visitstart" placeholder="Waktu mulai" />
															<input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php echo $obj->visitfinish;?>" name="visitfinish" id="visitfinish" placeholder="Waktu selesai" />
														</div>

														<span class="help-inline">Tanggal Kunjungan</span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Contact Person</label>
													<div class="controls">
														<input type="text" placeholder="Contact Person" name="pic" class="m-wrap large" value="<?php echo $obj->pic;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Position</label>
													<div class="controls">
														<input type="text" placeholder="Position" name="position" class="m-wrap large" value="<?php echo $obj->position;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">HP</label>
													<div class="controls">
														<input type="text" placeholder="HP" name="hp" class="m-wrap large" value="<?php echo $obj->hp;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Goal</label>
													<div class="controls">
														<input type="text" placeholder="Keperluan" name="aim" class="m-wrap large" value="<?php echo $obj->aim;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Transport</label>
													<div class="controls">
														<select class="small m-wrap" id="transport" name="transport" tabindex="1">
															<option value="-">Pilihlah</option>
															<option <?php if($obj->transport=="KK"){echo "selected='selected'";}?> value="KK">KK</option>
															<option <?php if($obj->transport=="PMB"){echo "selected='selected'";}?> value="PMB">PMB</option>
															<option <?php if($obj->transport=="PMT"){echo "selected='selected'";}?> value="PMT">PMT</option>
															<option <?php if($obj->transport=="TU"){echo "selected='selected'";}?> value="TU">TU</option>
															<option <?php if($obj->transport=="Ln"){echo "selected='selected'";}?> value="Ln">Lainnya</option>
														</select>
													</div>
												</div>
												<div class="control-group" id="nominalreimburse">
													<label class="control-label">Nominal Reimburse</label>
													<div class="controls">
														<input type="text" placeholder="Nominal Reimburse" id="nominalreimburse" name="nominalreimburse" class="m-wrap large" value="<?php echo $obj->nominalreimburse;?>" />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group" id="tuuploader">
												<label class="control-label">Upload Transportation Receipt</label>
													<div class="controls">
													<img src="" id="output" />
														<input type="file" onchange="loadImage1(event)">
														<input type="hidden" name="receiptimage" id="receiptimage">
													</div>
												</div>
												<div class="form-actions">
													<button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
													<button type="button" class="btn" id="btnCancel">Cancel</button>
												</div>
											</form>
											<!-- END FORM-->  
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END SAMPLE FORM PORTLET-->
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
	<!-- BEGIN CORE PLUGINS -->   <script src="/asset/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="/asset/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="/asset/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="/asset/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/asset/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="/asset/plugins/excanvas.min.js"></script>
	<script src="/asset/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="/asset/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/asset/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="/asset/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="/asset/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<script src="/asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/asset/metronic/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<!-- END CORE PLUGINS -->
	<script src="assets/scripts/app.js"></script>     
	<script>
		jQuery(document).ready(function() {   
		   // initiate layout and plugins
		   $("#visitstart").datetimepicker({
			   autoclose:true,
			   format:'yyyy-mm-dd hh:ii',
			   todayBtn:true
		   });
		   $("#visitfinish").datetimepicker({
			   autoclose:true,
			   format:'yyyy-mm-dd hh:ii',
			   todayBtn:true
		   });
		   $("#btnCancel").click(function(){
			window.history.back();
		   });
		   $("#visitstart").change(function(){
			_val = $(this).val();
			   $("#visitdate").val(_val);
		   })
		   $("#nominalreimburse").val("0");
		   $("#transport").change();
		   $("#tuuploader").hide();
		   $("#nominalreimburse").hide();
		   $("#transport").change(function(){
			   _this = $(this).val();
			   if(_this=="TU"){
				   $("#tuuploader").show();
			   }else{
				$("#tuuploader").hide();
			   }
			   if(_this=='PMT'){
				   $("#nominalreimburse").show();
			   }else{
					$("#nominalreimburse").hide();
			   }
		   })
		   resetBranch = function(){
			$("#optionalbranch option").each(function(){
				console.log("val",$(this).val());
				if($(this).val()=='1'){
					$(this).attr("selected","selected");
				}
			})}
			populateBranches = function(basebranch){
				$("#soptionalbranch").empty();
				out = '';
				console.log("PopulateBranch basebranch",basebranch);
				switch(basebranch){
					case '1':
					out = 'Surabaya';
					break;
					case '2':
					out = 'Jakarta';
					break;
					case '3':
					out = 'Malang';
					break;
					case '4':
					out = 'Bali';
					break;
				}
				console.log('selected by sales',basebranch,out);
				_tmp = '<option value='+basebranch+' selected="selected">'+out+'</option>';
				$("#soptionalbranch").append(_tmp);
			}
			$("#sale_id").change(function(){
				_this = $(this);
				var option = $('#sale_id option:selected').attr('basebranch');
				console.log('x',option);
				populateBranches(option);
				resetBranch();
				$("#optionalbranch").hide();
				sale_id = $(this).val();
				console.log("sale_id",sale_id);
				if(sale_id == 146){
					console.log("sale_id",sale_id)
					_tmp = '<option value=3>Malang</option>';
					$("#soptionalbranch").append(_tmp);
					$("#optionalbranch").show();
				}else{
					console.log("else");
					populateBranches(option);
				}
			});
			$("#sale_id").change();
		   //App.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
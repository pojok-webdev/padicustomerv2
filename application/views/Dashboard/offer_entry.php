<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('Dashboard/head');?>
			<div id="addservice" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Penambahan Layanan</h3>
				</div>
				<div class="modal-body">
					<div class="control-group">
						<label class="control-label">Layanan</label>
						<div class="controls">
							<select id="serviceCategory">
								<option value="">Select</option>
								<option value="broadband">Broadband</option>
								<option value="dedicated">Dedicated</option>
								<option value="datacenter">Datacenter</option>
								<option value="hardware">Hardware</option>
								<option value="jasa">Jasa</option>
								<option value="others">Others</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Sub Layanan</label>
						<div class="controls">
							<select id="serviceSubCategory">
								<option value="">Select</option>
							</select>
						</div>
					</div>
					<div class="control-group" id="divServiceSubCategory2">
						<label class="control-label">Sub Layanan Level 2</label>
						<div class="controls">
							<select id="serviceSubCategory2">
								<option value="">Select</option>
							</select>
						</div>
					</div>
					<div class="control-group" id="divServiceSubCategory3">
						<label class="control-label">Sub Layanan Level 3</label>
						<div class="controls">
							<select id="serviceSubCategory3">
								<option value="">Select</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Layanan</label>
						<div class="controls">
							<input type="text" class="span4" disabled="disabled" name="serviceName" id="serviceName" placeholder="Nama Layanan" class="m-wrap small" />
							<span class="help-inline"></span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Kapasitas</label>
						<div class="controls">
							<input type="text" class="span4" name="capacity" id="capacity" placeholder="Kapasitas (Mbps)" class="m-wrap small" />
							<span class="help-inline"></span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Nominal</label>
						<div class="controls">
							<input type="text" name="servicePrice" id="servicePrice" placeholder="Nominal" class="m-wrap small" />
							<span class="help-inline"></span>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button type="text" name="saveService" class="btn" id="saveService">Simpan</button>
						</div>
					</div>

				</div>
			</div>

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
							<span id="page_title"><?php echo $page_title?></span>
							<small>PadiNET Dashboard</small>
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
							<li><a href="#">Quotation Entry</a></li>
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
									<span class="hidden-480"> Quotation</span>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="tabbable portlet-tabs">
									<ul class="nav nav-tabs">
										<li class="active"><a >&nbsp;</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="portlet_tab1">
											<!-- BEGIN FORM-->
											<form action="<?php echo $action;?>" method="POST" class="form-horizontal">
												<input type="hidden" name="id" value="<?php echo $obj->id;?>">
												<div class="control-group">
													<label class="control-label">Quotation Date</label>
													<div class="controls">
														<div class="input-append date date-picker" data-date="2018-11-11" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
															<input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php echo $obj->offerdate;?>" name="offerdate" id="offerdate" placeholder="Quotation Date" />
														</div>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Client Name</label>
													<div class="controls">
														<input type="text" placeholder="Client Name" value="<?php echo $obj->clientname;?>" name="clientname" class="m-wrap large" />
														<span class="help-inline">Nama Pelanggan</span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Address</label>
													<div class="controls">
														<input type="text" value="<?php echo $obj->address;?>" name="address" placeholder="Address" class="m-wrap large" />
													</div>
													<div class="controls">
														<input type="text" value="<?php echo $obj->city;?>" name="city" placeholder="City" class="m-wrap large" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Email</label>
													<div class="controls">   
														<input class="m-wrap medium" type="email" value="<?php echo $obj->email;?>" name="email" placeholder="Email..."  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">PIC</label>
													<div class="controls">   
														<input class="m-wrap medium" type="text" value="<?php echo $obj->pic;?>" name="pic" placeholder="PIC..." />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Phone</label>
													<div class="controls">   
														<input class="m-wrap medium" type="text" value="<?php echo $obj->phone;?>" name="phone" placeholder="Phone..." />
													</div>
												</div>
												<div class="control-group">
												<div class="controls">
												<div class="portlet-body flip-scroll">
												<div id="btnAddService" class="btn btn-primary">Penambahan Layanan Yang Ditawarkan</div>
														<table class="table-bordered table-striped table-condensed flip-content" id="serviceLists">
															<thead class="flip-content">
																<tr>
																	<th>No</th>
																	<th>Layanan</th>
																	<th>Kapasitas</th>
																	<th class="numeric">Nominal</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>offerservice



															<?php foreach($offerservices as $service){?>
															<tr>
																<td>1</td>
																<td><?php echo $service->servicename;?></td>
																<td><?php echo $service->capacity;?></td>
																<td class='numeric'><?php echo $service->price;?></td>
																<td><span class='btn btn-danger removeService'>Hapus</span></td>
																<input type='hidden' name='serviceName[]'  value='<?php echo $service->servicename;?>'  />
															<input type='hidden' name='capacity[]'  value='<?php echo $service->capacity;?>'  />
															<input type='hidden' name='servicePrice[]' value='<?php echo $service->price;?>' />															
															</tr>
															<?php }?>





															</tbody>
														</table>
													</div>
												</div>
												</div>
												<div class="control-group">
													<label class="control-label">Sales</label>
													<div class="controls">
														<select class="medium m-wrap" tabindex="1" name="sale_id" id="sale_id">
															<?php foreach($sales as $sale){?>
																<option  basebranch="<?php echo $sale->basebranch?>" <?php if($obj->sale_id==$sale->id){echo "selected='selected'";}?> value="<?php echo $sale->id;?>">
																<?php echo $sale->username;?>
																</option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="control-group" id="optionalbranch">
													<label class="control-label">Cabang</label>
													<div class="controls">
														<select class="medium m-wrap" tabindex="1" name="branch" id="soptionalbranch">
															<option <?php if($obj->branch=="1"){echo "selected='selected'";}?> value="1">Surabaya</option>
															<option <?php if($obj->branch=="2"){echo "selected='selected'";}?> value="2">Malang</option>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">U/C</label>
													<div class="controls">
														<select class="medium m-wrap" tabindex="1" name="uc">
															<option value="">Pilihlah</option>
															<option <?php if($obj->uc=="U"){echo "selected='selected'";}?> value="U">Up Selling</option>
															<option <?php if($obj->uc=="C"){echo "selected='selected'";}?> value="C">Cross Selling</option>
															<option <?php if($obj->uc=="N"){echo "selected='selected'";}?> value="N">New</option>
															<option <?php if($obj->uc=="D"){echo "selected='selected'";}?> value="D">Down Grade/Down Selling</option>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Source</label>
													<div class="controls">
														<select class="medium m-wrap" tabindex="1" name="source">
															<option value="">Pilihlah</option>
															<option <?php if($obj->source=="C"){echo "selected='selected'";}?> value="C">Incoming Call</option>
															<option <?php if($obj->source=="E"){echo "selected='selected'";}?> value="E">Incoming Email</option>
															<option <?php if($obj->source=="K"){echo "selected='selected'";}?> value="K">Kanvas/Call Out</option>
															<option <?php if($obj->source=="R"){echo "selected='selected'";}?> value="R">Referensi</option>
															<option <?php if($obj->source=="P"){echo "selected='selected'";}?> value="P">Pameran</option>
															<option <?php if($obj->source=="LC"){echo "selected='selected'";}?> value="LC">Live Chat/Sosmed</option>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Keterangan</label>
													<div class="controls">
														<textarea class="large m-wrap" rows="0" name="description"><?php echo trim($obj->description);?></textarea>
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
	<script src="/js/aquarius/radu.js"></script>
	<script src="/js/aquarius/padilibs/dataTables.js"></script>  
	<!-- END CORE PLUGINS -->
	<script>
		jQuery(document).ready(function() {   
		   // initiate layout and plugins
		   $.fn.setEmpty = function(options){
			   var settings = $.extend({},options)
				$(this).empty();
				$(this).append('<option value="">Select</option>');
		   }
		   $("#offerdate").datepicker({
			   autoclose:true,
			   format:'yyyy-mm-dd',
			   todayBtn:true
		   });
		   $("#offerdate").click(function(){
			   console.log("Offerdate clicked");
		   });
		   $("#offerdatetrigger").click(function(){
			   setTimeout(function(){
				$("#offerdate").trigger("click");
			   });
			   
		   });
		   $("#btnCancel").click(function(){
			window.history.back();
		   });
		   writeRow = function(that){
			rowcount = $("#serviceLists").rowcount()+1;
				trow = "<tr>";
				trow+= "<td class='rowcount'>"+rowcount+"</td>";
				trow+= "<td>"+$("#serviceName").val()+"</td>";
				trow+= "<td>"+$("#capacity").val()+"</td>";
				trow+= "<td class='numeric'>"+$("#servicePrice").val()+"</td>";
				trow+= "<td><span class='btn btn-danger removeService'>Hapus</span></td>";
				trow+= "<input type='hidden' name='serviceName[]'  value='"+$("#serviceName").val()+"'  />";
				trow+= "<input type='hidden' name='capacity[]'  value='"+$("#capacity").val()+"'  />";
				trow+= "<input type='hidden' name='servicePrice[]' value='"+$("#servicePrice").val()+"' />";
				trow+= "</tr>";


			   $("#serviceLists tbody").append(trow);
			   that.stairUp({
				   level:4
			   })
			   .modal("hide");
		   }
			reNumbering = function(){
				c=1;
				console.log("ReNumbering");
				$("#serviceLists tbody tr").each(function(){
					$(this).find('.rowcount').html(c);
					c++;
				})
			}

		   $("#saveService").click(function(){
			   that = $(this)
			   writeRow(that);
			   reNumbering();
		   });
		   $("#serviceLists tbody").on("click","tr .removeService",function(){
				console.log("remove Service clicked ...");
				$(this).stairUp({level:2}).remove();
				reNumbering();
			});
			$("#btnAddService").click(function(){
				$("#serviceName").val("");
				$("#servicePrice").val("");
				$("#serviceCategory").prop('selectedIndex',0);
				$("#serviceCategory").change();
				$("#addservice").modal("show");
			});
			sbroadbrand = '<option value="ibb">In Building Broadband</option>';
			sbroadbrand+= '<option value="cluster">Cluster</option>';
			sbroadbrand+= '<option value="oryza">Oryza</option>';
			sbroadbrand+= '<option value="sbi">SBI</option>';
			sdedicated = '<option id="domestic" value="domestic">Domestic</option>';
			sdedicated+= '<option id="international" value="international">International</option>';
			sdatacenter = '<option value="colocation">Colocation</option>';
			sdatacenter+= '<option value="vps">VPS</option>';
			sdatacenter+= '<option value="hosting">Hosting</option>';
			sdatacenter+= '<option value="domain">Domain</option>';
			sjasa = '<option value="setup dan instalasi">Setup dan Instalasi</option>';
			sjasa+= '<option value="troubleshooting">Troubleshooting</option>';
			sjasa+= '<option value="maintenance dan manage service">Maintenance dan Manage Service</option>';

			sdomestic = '<option id="iix" value="iix">IIX</option>';
			sdomestic+= '<option id="localloop" value="localloop">Local Loop</option>';
			sinternational = '<option id="padimix" value="padimix">Padi Mix</option>';
			sinternational+= '<option id="enterprise" value="enterprise">Enterprise</option>';

			siix = '<option id="fo" value="fo">FO</option>';
			siix+= '<option id="wireless" value="wireless">Wireless</option>';
			siix+= '<option id="fobackupwireless" value="fobackupwireless">FO Backup Wireless</option>';
			siix+= '<option id="fobackupwirelessplus" value="fobackupwirelessplus">FO Backup Wireless Plus</option>';
			slocalloop = '<option id="fo" value="fo">FO</option>';
			slocalloop+= '<option id="wireless" value="wireless">Wireless</option>';
			slocalloop+= '<option id="fobackupwireless" value="fobackupwireless">FO Backup Wireless</option>';
			slocalloop+= '<option id="fobackupwirelessplus" value="fobackupwirelessplus">FO Backup Wireless Plus</option>';

			$("#serviceCategory option[value='select']").prop("selected",true);

			$("#serviceCategory").change(function(){
				scategory = $(this).val()
				$("#serviceSubCategory").setEmpty();
				$("#serviceSubCategory2").setEmpty();
				$("#serviceSubCategory3").setEmpty();
				$("#serviceSubCategory").hide();
				$("#divServiceSubCategory2").hide();
				$("#divServiceSubCategory3").hide();
				switch (scategory){
					case 'broadband':
						$("#serviceSubCategory").empty();
						$("#serviceSubCategory").show();
						$("#serviceSubCategory").append(sbroadbrand);
					break;
					case 'dedicated':
						$("#serviceSubCategory").empty();
						$("#serviceSubCategory").show();
						$("#serviceSubCategory").append(sdedicated);
						$("#serviceSubCategory option[value='domestic']").prop("selected",true);
						$("#serviceSubCategory").change();
						$("#divServiceSubCategory2").show();
					break;
					case 'datacenter':
						$("#serviceSubCategory").empty();
						$("#serviceSubCategory").show();
						$("#serviceSubCategory").append(sdatacenter);
					break;
					case 'hardware':
						$("#serviceSubCategory").hide();
					break;
					case 'jasa':
						$("#serviceSubCategory").empty();
						$("#serviceSubCategory").show();
						$("#serviceSubCategory").append(sjasa);
					break;
					case 'others':
						$("#serviceSubCategory").hide();
					break;
				}
				$("#serviceName").val(scategory+' '+$("#serviceSubCategory").val()+' '+$("#serviceSubCategory2").val()+' '+$("#serviceSubCategory3").val());

			});
			$("#serviceSubCategory").change(function(){
					sscategory = $(this).val();
					console.log("servicesubcategory",sscategory);
					switch(sscategory){
						case 'domestic':
							$("#serviceSubCategory2").empty();
							$("#divServiceSubCategory2").show();
							$("#serviceSubCategory2").append(sdomestic);
						break;
						case 'international':
							$("#serviceSubCategory2").empty();
							$("#divServiceSubCategory2").show();
							$("#serviceSubCategory2").append(sinternational);
						break;
					}
					$("#serviceSubCategory2").change();
					$("#serviceName").val($("#serviceCategory").val()+' '+sscategory+' '+$("#serviceSubCategory2").val()+' '+$("#serviceSubCategory3").val());
				});
				$("#serviceSubCategory2").change(function(){
					ssscategory = $(this).val();
					console.log('this val',$(this).val());
					switch(ssscategory){
						case 'iix':
						console.log("iix invoked");
							$("#serviceSubCategory3").empty();
							$("#divServiceSubCategory3").show();
							$("#serviceSubCategory3").append(siix);
						break;
						case 'localloop':
						console.log("localloop invoked");
							$("#serviceSubCategory3").empty();
							$("#divServiceSubCategory3").show();
							$("#serviceSubCategory3").append(slocalloop);
						break;
					}
					console.log("ssscategory",ssscategory);
					$("#serviceName").val($("#serviceCategory").val()+' '+$("#serviceSubCategory").val()+' '+ssscategory+' '+$("#serviceSubCategory3").val());
				});
				$("#serviceSubCategory3").change(function(){
					_this = $(this);
					$("#serviceName").val($("#serviceCategory").val()+' '+$("#serviceSubCategory").val()+' '+$("#serviceSubCategory2").val()+' '+_this.val());
				})
				/*resetBranch = function(){
				$("#optionalbranch option").each(function(){
					console.log("val",$(this).val());
					if($(this).val()=='1'){
						$(this).attr("selected","selected");
					}
				})}
				$("#sale_id").change(function(){
					resetBranch();
					$("#optionalbranch").hide();
					sale_id = $(this).val();
					console.log("sale_id",sale_id);
					if(sale_id == 146){
						$("#optionalbranch").show();
					}
				});
				$("#sale_id").change();*/
				resetBranch = function(){
			$("#optionalbranch option").each(function(){
				console.log("val",$(this).val());
				if($(this).val()=='1'){
					$(this).attr("selected","selected");
				}
			})}
			populateBranches = function(basebranch){
				$("#soptionalbranch").empty();
				out = 'X';
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
				var option = _this.find('option:selected').attr('basebranch');
				console.log('x',option)
				resetBranch();
				$("#optionalbranch").hide();
				sale_id = $(this).val();
				console.log("sale_id",sale_id);
				populateBranches(option);
				if(sale_id == 146){
					console.log("sale_id",sale_id)
					_tmp = '<option value=3>Malang</option>';
					$("#soptionalbranch").append(_tmp);
					$("#optionalbranch").show();
				}
			});
			$("#sale_id").change();

//		   App.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
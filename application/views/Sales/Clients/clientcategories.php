<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>PadiNET | Kategori Pelanggan</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="padiNET" />
	<style>
	tr td.choosencat{
		background-color:red;
	}
	.setcat{
		cursor: pointer;
	}
	</style>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="/asset/metronic/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="/asset/metronic/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/asset/metronic/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="/asset/metronic/assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="/asset/metronic/assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
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
		<!-- BEGIN SIDEBAR -->
		<?php $this->load->view('metronic/sidebar');?>
		<!-- END SIDEBAR -->
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
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Tool <small>Pelanggan-Kategori</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="/pclients">Pelanggan</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Kategori</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box light-grey">
							<div class="portlet-title">
								<div class="caption"><i class="icon-globe"></i>Tabel Pelanggan - Kategori</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped_ table-bordered_ table-hover_" id="tuncategorized">
									<thead>
										<tr>
											<th width='30%'>Nama</th>
											<th width='10%' class="hidden-480">Unset</th>
											<th width='10%' class="hidden-480">FFR</th>
											<th width='10%' class="hidden-480">Platinum</th>
											<th width='10%' class="hidden-480">Gold</th>
											<th width='10%' >Bronze</th>
											<th width='10%' >Silver</th>
											<th width='10%' >Oryza</th>
										</tr>
									</thead>
									<tbody class="uncategorizedbody">
									<?php foreach($objs as $obj){?>
										<tr class="odd gradeX" trid="<?php echo $obj->id;?>">
											<td><?php echo $obj->name;?></td>
											<td class="setcat <?php echo setclass("0",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='0'>Unset</td>
											<td class="setcat <?php echo setclass("1",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='1'>FFR</td>
											<td class="setcat <?php echo setclass("2",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='2'>Platinum</td>
											<td class="setcat <?php echo setclass("3",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='3'>Gold</td>
											<td class="setcat <?php echo setclass("4",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='4'>Bronze</td>
											<td class="setcat <?php echo setclass("5",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='5'>Silver</td>
											<td class="setcat <?php echo setclass("6",$obj->clientcategory,"choosencat","unchoosencat");?>" cat='6'>Oryza</td>
										</tr>
									<?php }?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
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
			2018 &copy; padiApp.
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
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="/asset/metronic/assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/asset/metronic/assets/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="/asset/metronic/assets/scripts/app.js"></script>
	<script src="/asset/metronic/assets/scripts/table-managed.1.js"></script>     
	<script src="/js/aquarius/radu.js">

	</script>
	<script>
		jQuery(document).ready(function() {       
		   App.init();
		   TableManaged.init();
			$("#tuncategorized tbody").on("click",".setcat",function(){
				trid = $(this).stairUp({level:1}).attr("trid");
				that = $(this);
				$.ajax({
					url:'/pclients/update',
					data:{
						id:trid,
						clientcategory:$(this).attr('cat')
					},
					type:'post',
				})
				.done(function(res){
					console.log("Success setcategory",res);
					that.stairUp({level:1}).find("td").removeClass("choosencat");
					that.addClass("choosencat");
				})
				.fail(function(err){
					console.log("Error setcategory",err);
				});
			})
		});
	</script>
</body>
<!-- END BODY -->
</html>
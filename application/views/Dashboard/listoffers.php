<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<?php $this->load->view('Dashboard/head');?>
	<div id="listservice" class="modal hide">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button"></button>
			<h3>List Layanan <span id="companyname"></span></h3>
		</div>
		<div class="modal-body" id="services">

		</div>
	</div>
	<div id="confirmation" class="modal hide">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button"></button>
			<h3>Konfirmasi <span id="deleteConfirmation"></span></h3>
		</div>
		<div class="modal-body" id="services">
			<h4>Apakah anda yakin hendak menghapus Penawaran dengan Kode </h4>
			<h5><strong><span id="companynametoremove"></span>?</strong></h5>
		</div>
		<div class="modal-footer">
			<button type="button" id="btnRemove">Ya</button>
			<button>Tidak</button>
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
							<a class="btn" href="/dashboards/offer_entry">Add Quotation</a>
						<?php }?>

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
							<li><a href="#">List Penawaran</a></li>
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
								<div class="caption">
									<i class="icon-cogs"></i>
									List Penawaran <?php echo '(' . humanize($username) . ') ' .$category_label;?>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content" id="tableOffers">
									<thead class="flip-content">
										<tr>
											<th>KD PENAWARAN</th>
											<th>NAMA</th>
											<th>ADDRESS</th>
											<th>PIC</th>
											<th>U/C</th>
											<th>Source</th>
											<th>TANGGAL</th>
											<th>AM</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody>
										<?php $c = 1;$total = 0;?>
										<?php foreach($offers as $offer){?>
										<tr offer_id="<?php echo $offer->id;?>">
											<td class="showservices kdoffer" kdoffer="<?php echo $offer->kdoffer;?>">
												<?php echo $offer->kdoffer;?>
											</td>
											<td class="showservices companyname" companyname="<?php echo $offer->clientname;?>">
												<?php echo $offer->clientname;?>
											</td>
											<td class="showservices"><?php echo $offer->address;?></td>
											<td class="showservices"><?php echo $offer->pic;?></td>
											<td class="showservices"><?php echo $offer->uc;?></td>
											<td class="showservices"><?php echo $offer->source;?></td>
											<td class="showservices"><?php echo $offer->offerdate;?></td>
											<td>
											<?php echo $offer->am;?>
											</td>
											<td>
											<?php if(($offer->sale_id==$sale_id)||($is_admin)){?>
											<a class="btn" href="/dashboards/offer_edit/<?php echo $offer->id;?>">Edit</a>
											<?php }else{?>
												<button disabled="disabled">Edit</button>
											<?php }?>
											<?php if($is_admin){?>
												<a class="btn removeOffer" >Hapus</a>
											<?php }?>
											</td>
										</tr>
										<?php $c++;?>
										<?php }?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan=9>TOTAL PENAWARAN: <?php echo number_format($c-1);?></td>
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
	<script src="/js/aquarius/radu.js"></script>
	<script src="/js/aquarius/padilibs/dataTables.js"></script> 	<script>
		jQuery(document).ready(function() {
		   $("#tableOffers tbody tr").on("click",".showservices",function(){
			_this = $(this);
			   offer_id = $(this).stairUp({level:1}).attr("offer_id");
			   companyname = $(this).stairUp({level:1}).find(".companyname").attr("companyname");
				   $("#tableOffers tbody tr").each(function(){
				$(this).removeClass("selected");
			});
			$(this).stairUp({level:1}).addClass("selected");
			   $.ajax({
				   url:'/offers/getservices/'+offer_id,
				   type:'get',
				   dataType:'json'
			   })
			   .done(function(result){
				   console.log("result",result)
				   closebutton = '<div class="control-group">';
				   closebutton+= '<div class="controls">';
				   closebutton+= '<button type="text" name="btnclose" class="btn" id="btnclose">Tutup</button>';
				   closebutton+= '</div>';
				   closebutton+= '</div>';
				   $("#services").empty();
				   $("#companyname").html(companyname);
				   $.each(result,function(x,y){
					   console.log("x,y",x,y.offer_id,y.servicename,y.price);
						row ='<div class="row-fluid">';
						row+='<div class="span6">';
						row+='<h4>'+y.servicename+'</h4>';
						row+='</div>';
						row+='<div class="span6">';
						row+='<h4>'+y.price.toLocaleString()+'</h4>';
						row+='</div>';
						row+='</div>';
					   $("#services").append(row);
				   })
				   $("#services").append(closebutton);
				   $("#btnclose").click(function(){
						console.log("should be closed");
						$(this).stairUp({level:4}).modal("hide");
					});
			   })
			   .fail(function(err){
				   console.log("Error",err)
			   })
			   $("#listservice").modal('show');
		   });
		   $("#tableOffers tbody tr").on("click",".removeOffer",function(){
			   _this = $(this);
			offer_id = $(this).stairUp({level:2}).attr("offer_id");
			kdoffer = $(this).stairUp({level:2}).find(".kdoffer").attr("kdoffer");
			companyname = $(this).stairUp({level:2}).find(".companyname").attr("companyname");
			$("#tableOffers tbody tr").each(function(){
				$(this).removeClass("selected");
			});
			$(this).stairUp({level:2}).addClass("selected");



			$("#companynametoremove").html(kdoffer+' ('+companyname+')')
			$("#confirmation").modal('show');
		   })
		   $("#btnRemove").click(function(){
			   selected = $("#tableOffers tbody tr.selected");
			   id = selected.attr("offer_id");
			   _this = $(this);
			   console.log("Kdoffer",id);
			   $.ajax({
				   url:'/offers/remove/'+id,
				   type:'get',
				   dataType:'text'
			   })
			   .done(function(res){
				   console.log("Res",res);
				   selected.remove();
				   _this.stairUp({level:2}).modal('hide');
			   })
			   .fail(function(err){
				   console.log("Err",err);
			   });
		   });
		   App.init();
		});
	</script>
</body>
<!-- END BODY -->
</html>
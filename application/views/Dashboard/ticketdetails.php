<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<style>
.padihover:hover{
	color: red;
	cursor : pointer;
}
</style>
<?php $this->load->view('Dashboard/head');?>
<?php $this->load->view('Dashboard/ticket_modal');?>

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
					<!--<?php $this->load->view('Dashboard/notification');?>-->
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
						Detail Ticket <small>Dashboard</small>
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
							<li><a href="/dashboards/ticketdetails">Detail Ticket</a></li>
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
								<div class="caption"><i class="icon-cogs"></i>Detail Ticket PadiNET <?php echo '[' . $period . ' ' . $category .']' ?>(<?php echo $objs["tot"]?>)</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th>No</th>
											<th>NAMA</th>
											<th>ALAMAT</th>
										</tr>
									</thead>
									<tbody>
										<?php $c = 0;?>
										<?php foreach($objs["res"] as $obj){?>
										<?php $c+=1;?>
										<tr class="showhistory" id="<?php echo $obj->id;?>">
											<td><?php echo $c;?></td>
											<td class="padihover"><?php echo $obj->clientname;?></td>
											<td>
												<?php echo $obj->address;?>
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
	<script type='text/javascript' src='/js/aquarius/plugins/dataTables/jquery.dataTables.min.js'></script>
	<script type='text/javascript' src='/js/aquarius/radu.js'></script>
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();


		   
		   show_description = function(ticket_id){
			$.ajax({
				url:'/tickets/getDescription/'+ticket_id,
				type:'get',
				fail:function(err){
					console.log('ERR',err);
				}
			})
			.done(function(res){
				$.ajax({
					url:'/tickets/getComplaint/'+ticket_id,
					type:'get',			
				})
				.done(function(cmp){
					console.log('RESULT',res);
					$.ajax({
						url:'/tickets/getSolution/'+ticket_id,
						type:'get',
					}).done(function(sol){
						console.log('SOLUTION',sol);
						$.ajax({
							url:'/tickets/getCause/'+ticket_id,
							type:'get'
						}).done(function(cause){
							$.ajax({
								url:'/tickets/getConfirmationResult/'+ticket_id,
								type:'get'
							})
							.done(function(confirmationresult){
								$.ajax({
									url:"/tickets/getDowntime/"+ticket_id,
									type:'get'
								})
								.done(function(down_time){
									$('#complaintcontent').html(cmp);
									$('#causecontent').html(cause);
									$('#descriptioncontent').html(res);
									$('#solutioncontent').html(sol);
									$('#downtime').html(down_time);
									$('#confirmationresultcontent').html(confirmationresult);
									$('#dDescription').modal();																							
								})
								.fail(function(){});
							})
							.fail(function(err){
								console.log("Error Confirmation Result",err);
							});
						});
					}).fail(function(err){
						console.log('ERROR SOLUTION',err);
					});
				});
			});
		}



		   $('.showhistory').click(function(){
				id = $(this).attr('id');
				console.log('sho history');
				$.ajax({
					url:'/tickets/getTicketComplaint/'+id,
					type:'get',			
				})
				.done(function(cmp){
					$('#complaint').html('KELUHAN : '+cmp);
					console.log('complaint',id,cmp);
					
					oHistory = $('#tblHistory').dataTable({
						"bProcessing": true,
						"sAjaxSource": "/tickets/ajaxHistory/" + id,
						"aoColumns": [
							{"mData": "followUpDate"},
							{"mData": "picname"},
							{"mData": "position"},
							{"mData": "picphone"},
							{"mData": "status"},
							{"mData": "username"},
							{"mData": "description"}
						],
						"bSort": true, "bFilter": false, "bInfo": false, "bPaginate": false, "bDestroy": true
					});
					oHistory.fnSort([[0,'desc']]);
					$('#dFollowUpHistory').modal();

				});	


//			   $('#dFollowUpHistory').modal('show');
		   });
		});
	</script>
</body>
<!-- END BODY -->
</html>
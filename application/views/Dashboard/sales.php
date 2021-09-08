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
								<input type="text" class="date-picker vdate" id="vdate1"/>
								<input type="text" class="date-picker vdate" id="vdate2"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Penawaran</label>
							<div class="controls">
								<div class="switch" data-on="warning" data-off="danger">
									<input type="checkbox" checked class="toggle" id="offercheckbox"/>
								</div>
								<input type="text" class="date-picker odate" id="odate1"/>
								<input type="text" class="date-picker odate" id="odate2"/>
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
						<a class="btn" href="/dashboards/offer_entry">Add Quotation</a>
						<?php if($is_admin){?>
							<a class="btn" href="/dashboards/visit_entry">Add Visit</a>
						<?php }?>
						<a class="btn" href="/dashboards/salesfilterbydaterange">Custom Filter</a>
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
						<?php foreach($sales as $am){?>
						<div class="portlet box green">
							<div class="portlet-title">
								<div class="caption"><i class="icon-cogs"></i>Sales PadiNET (<?php echo '<span class="username">'.$am->username . '</span> ' . $am->branch?>)
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
								
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th></th>
											<th>HARI-H</th>
											<th class="numeric">MINGGU BERJALAN</th>
											<th class="numeric">BULAN BERJALAN</th>
											<th class="numeric">QUARTER BERJALAN</th>
											<th class="numeric">TAHUN BERJALAN<?php echo $am->branch_id;?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>VISIT</td>
											<td class="numeric"><?php echo '<a href="/dashboards/listvisits/d/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'/'.$stringkpifilter.'">'.getdailyvisits("1",date("y-m-d"),$am->id,$am->branch_id,$kpifilter).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listvisits/w/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'/'.$stringkpifilter.'">'.getweeklyvisits("1",date("y-m-d"),$am->id,$am->branch_id,$kpifilter).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listvisits/m/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'/'.$stringkpifilter.'">'.getmonthlyvisits("1",date("y-m-d"),$am->id,$am->branch_id,$kpifilter).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listvisits/q/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'/'.$stringkpifilter.'">'.getquarterlyvisits("1",date("y-m-d"),$am->id,$am->branch_id,$kpifilter).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listvisits/y/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'/'.$stringkpifilter.'">'.getyearlyvisits("1",date("y-m-d"),$am->id,$am->branch_id,$kpifilter).'</a>';?></td>
										</tr>
										<tr>
											<td>PENAWARAN</td>
											<td class="numeric"><?php echo '<a href="/dashboards/listoffers/d/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getdailyoffers("1",date("Y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listoffers/w/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getweeklyoffers("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listoffers/m/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getmonthlyoffers("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listoffers/q/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getquarterlyoffers("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listoffers/y/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getyearlyoffers("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
										</tr>
										<tr>
											<td>CREATE FB BARU</td>
											<td class="numeric"><?php echo '<a href="/dashboards/listfbs/d/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getdailyfbs("1",date("Y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listfbs/w/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getweeklyfbs("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listfbs/m/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getmonthlyfbs("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listfbs/q/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getquarterlyfbs("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
											<td class="numeric"><?php echo '<a href="/dashboards/listfbs/y/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.getyearlyfbs("1",date("y-m-d"),$am->id,$am->branch_id).'</a>';?></td>
										</tr>
										<tr>
											<td>PENJUALAN (Rp.)</td>
											<td class="numeric"><?php echo number_format(getdailynominalsales("1",date("Y-m-d"),$am->id,$am->branch_id));?></td>
											<td class="numeric"><?php echo number_format(getweeklynominalsales("1",date("y-m-d"),$am->id,$am->branch_id));?></td>
											<td class="numeric"><?php echo number_format(getmonthlynominalsales("1",date("y-m-d"),$am->id,$am->branch_id));?></td>
											<td class="numeric"><?php echo number_format(getquarterlynominalsales("1",date("y-m-d"),$am->id,$am->branch_id));?></td>
											<td class="numeric"><?php echo number_format(getyearlynominalsales("1",date("y-m-d"),$am->id,$am->branch_id));?></td>
										</tr>
										<tr>
											<td>REIMBURSE BBM(Rp.)</td>
											<td class="numeric">
											<?php echo  '<a href="/dashboards/listreimburses/d/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.number_format(getdailyreimburses("1",date("Y-m-d"),$am->id,$am->branch_id)).'</a>';?>
											</td>
											<td class="numeric">
											<?php echo  '<a href="/dashboards/listreimburses/w/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.number_format(getweeklyreimburses("1",date("y-m-d"),$am->id,$am->branch_id)).'</a>';?>
											</td>
											<td class="numeric">
											<?php echo  '<a href="/dashboards/listreimburses/m/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.number_format(getmonthlyreimburses("1",date("y-m-d"),$am->id,$am->branch_id)).'</a>';?>
											</td>
											<td class="numeric">
											<?php echo  '<a href="/dashboards/listreimburses/q/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.number_format(getquarterlyreimburses("1",date("y-m-d"),$am->id,$am->branch_id)).'</a>';?>
											</td>
											<td class="numeric">
											<?php echo  '<a href="/dashboards/listreimburses/y/1/'.date("Y-m-d").'/'.$am->id.'/'.$am->branch_id.'">'.number_format(getyearlyreimburses("1",date("y-m-d"),$am->id,$am->branch_id)).'</a>';?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<?php }?>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->







				<!-- place for branches-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12" id="branch_dashboard">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<?php for($c=1;$c<5; $c++){?>
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-cogs"></i>Cabang PadiNET (<?php echo $branch[$c];?>)</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
								</div>
							</div>
							<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
									<thead class="flip-content">
										<tr>
											<th></th>
											<th>HARI-H</th>
											<th class="numeric">MINGGU BERJALAN</th>
											<th class="numeric">BULAN BERJALAN</th>
											<th class="numeric">QUARTER BERJALAN</th>
											<th class="numeric">TAHUN BERJALAN</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>VISIT</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/bd/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getdailybranchvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/bw/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getweeklybranchvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/bm/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getmonthlybranchvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/bq/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getquarterlybranchvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/by/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getyearlybranchvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
										</tr>
										<tr>
											<td>PENAWARAN</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/bd/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getdailybranchoffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/bw/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getweeklybranchoffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/bm/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getmonthlybranchoffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/bq/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getquarterlybranchoffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/by/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getyearlybranchoffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>

										</tr>
										<tr>
											<td>CREATE FB BARU</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/bd/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getdailybranchfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/bw/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getweeklybranchfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/bm/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getmonthlybranchfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/bq/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getquarterlybranchfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/by/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo getyearlybranchfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
										</tr>
										<tr>
											<td>PENJUALAN (Rp.)</td>
											<td class="numeric"><?php echo number_format(getdailybranchnominalsales("1",date("Y-m-d"),$c));?></td>
											<td class="numeric"><?php echo number_format(getweeklybranchnominalsales("1",date("Y-m-d"),$c));?></td>
											<td class="numeric"><?php echo number_format(getmonthlybranchnominalsales("1",date("Y-m-d"),$c));?></td>
											<td class="numeric"><?php echo number_format(getquarterlybranchnominalsales("1",date("Y-m-d"),$c));?></td>
											<td class="numeric"><?php echo number_format(getyearlybranchnominalsales("1",date("Y-m-d"),$c));?></td>
										</tr>
										<tr>
											<td>REIMBURSE BBM(Rp.)</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/bd/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getdailybranchreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/bw/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getweeklybranchreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/bm/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getmonthlybranchreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/bq/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getquarterlybranchreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/by/1/<?php echo date('Y-m-d');?>/<?php echo $c;?>/<?php echo $c;?>/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getyearlybranchreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<?php }?>
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
											<th></th>
											<th>HARI-H</th>
											<th class="numeric">MINGGU BERJALAN</th>
											<th class="numeric">BULAN BERJALAN</th>
											<th class="numeric">QUARTER BERJALAN</th>
											<th class="numeric">TAHUN BERJALAN</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>VISIT</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/nd/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getdailynationalvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/nw/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getweeklynationalvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/nm/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getmonthlynationalvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/nq/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getquarterlynationalvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listvisits/ny/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getyearlynationalvisits("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
										</tr>
										<tr>
											<td>PENAWARAN</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/nd/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getdailynationaloffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/nw/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getweeklynationaloffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/nm/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getmonthlynationaloffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/nq/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getquarterlynationaloffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listoffers/ny/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getyearlynationaloffers("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
										</tr>
										<tr>
											<td>CREATE FB BARU</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/nd/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getdailynationalfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/nw/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getweeklynationalfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/nm/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getmonthlynationalfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/nq/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getquarterlynationalfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listfbs/ny/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo getyearlynationalfbs("1",date("Y-m-d"),$c,$kpifilter);?>
											</a>
											</td>
										</tr>
										<tr>
											<td>PENJUALAN (Rp.)</td>
											<td class="numeric">
											<?php echo number_format(getdailynationalnominalsales("1",date("Y-m-d"),$c));?>
											</td>
											<td class="numeric">
											<?php echo number_format(getweeklynationalnominalsales("1",date("Y-m-d"),$c));?>
											</td>
											<td class="numeric">
											<?php echo number_format(getmonthlynationalnominalsales("1",date("Y-m-d"),$c));?>
											</td>
											<td class="numeric">
											<?php echo number_format(getquarterlynationalnominalsales("1",date("Y-m-d"),$c));?>
											</td>
											<td class="numeric">
											<?php echo number_format(getyearlynationalnominalsales("1",date("Y-m-d"),$c));?>
											</td>
										</tr>
										<tr>
											<td>REIMBURSE BBM(Rp.)</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/nd/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getdailynationalreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/nw/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getweeklynationalreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/nm/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getmonthlynationalreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/nq/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getquarterlynationalreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
											</a>
											</td>
											<td class="numeric">
											<a href="/dashboards/listreimburses/ny/1/<?php echo date('Y-m-d');?>/<?php echo $am->id;?>/1/<?php echo $stringkpifilter;?>">
											<?php echo number_format(getyearlynationalreimburses("1",date("Y-m-d"),$c,$kpifilter));?>
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
		   App.init();
		});
	</script>
</body>
<!-- END BODY -->
</html>
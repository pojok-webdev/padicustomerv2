<html>
	<head>
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="/asset/report/bootstrap-3.3.6.min.css">
		<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->
		<link rel="stylesheet" href="/asset/jqueryui.1.12.0.css">
		<link rel="stylesheet" href="/asset/report/fb.css" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>
		<!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
		<script src="/asset/jqueryui.1.12.0.js"></script>
		<script src="/js/padilibs/padi.dateTimes.js"></script>
		<script src="/js/aquarius/links.js"></script>
		<title>Laporan FB </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Komplain Pelanggan</h3>
		<h5>
			<a class="rptanchor btn btn-success" href="/rpt">Home</a>
		</h5>
			<div class="row-fluid">
				<div class="well col-sm-12">
					<div class="col-sm-3">
						<button class="btn btn-default dropdown-toggle" type="button" id="servicecategory" data-toggle="dropdown">Kategori Usaha
						<span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php foreach($servicecategories as $key=>$val){?>
						  <li role="presentation">
						  	<a role="menuitem" tabindex="-1" href="#" class="optage" value="1">
						  	<?php echo $val;?></a>
						  </li>
						<?php }?>
						</ul>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-default dropdown-toggle" type="button" id="city" data-toggle="dropdown">Kota
						<span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php foreach($cities as $key=>$val){?>
						  <li role="presentation">
						  	<a role="menuitem" tabindex="-1" href="#" class="optage" value="1">
						  	<?php echo $val;?></a>
						  </li>
						<?php }?>
						</ul>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-default dropdown-toggle" type="button" id="businesstype" data-toggle="dropdown">Tipe Bisnis
						<span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php foreach($businesstypes as $key=>$val){?>
						  <li role="presentation">
						  	<a role="menuitem" tabindex="-1" href="#" class="optage" value="1">
						  	<?php echo $val;?></a>
						  </li>
						<?php }?>
						</ul>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-default dropdown-toggle" type="button" id="servicecategories" data-toggle="dropdown">Kategori Layanan
						<span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php foreach($servicecategories as $key=>$val){?>
						  <li role="presentation">
						  	<a role="menuitem" tabindex="-1" href="#" class="optage" value="1">
						  	<?php echo $val;?></a>
						  </li>
						<?php }?>
						</ul>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-default dropdown-toggle" type="button" id="sales" data-toggle="dropdown">Sales
						<span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						<?php foreach($sales as $key=>$val){?>
						  <li role="presentation">
						  	<a role="menuitem" tabindex="-1" href="#" class="optage" value="1">
						  	<?php echo $val;?></a>
						  </li>
						<?php }?>
						</ul>
					</div>
					<div class="col-sm-3">
						<input type="text" class="datepicker" id="startdate" value="<?php echo $curdate?>" />
					</div>
				<!--</div>-->
				<?php
				$sbychecked = '';$jktchecked = '';$mlgchecked = '';$blichecked = '';
				for($x=0;$x<strlen($this->uri->segment(5));$x++){
					switch(substr($this->uri->segment(5),$x,1)){
						case '1':
						$sbychecked = "checked='checked'";
						break;
						case '3':
						$mlgchecked = "checked='checked'";
						break;
						case '2':
						$jktchecked = "checked='checked'";
						break;
						case '4':
						$blichecked = "checked='checked'";
						break;
					}
				}
				?>
				<div class="col-sm-3">
					<label class="checkbox-inline suspect-branches"><input type="checkbox" value="1" <?php echo $sbychecked;?>>Surabaya</label>
					<label class="checkbox-inline suspect-branches"><input type="checkbox" value="2" <?php echo $jktchecked;?>>Jakarta</label>
					<label class="checkbox-inline suspect-branches"><input type="checkbox" value="4" <?php echo $blichecked;?>>Bali</label>
					<label class="checkbox-inline suspect-branches"><input type="checkbox" value="3" <?php echo $mlgchecked;?>>Malang</label>
				</div>
				<div class="col-sm-3"><button class="btn btn-success" id="btnfilter">Filter</button></div>
				</div>
				<br />
			</div>
			<br />
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<thead>
					<tr>
						<th>No</th>
						<?php
						for($d = 1;$d<31;$d++){
							echo '<th>' . $d . '</th>';
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php $c=0;$fbname="";$lastname="";?>
					<?php foreach($fbs as $fb){?>
						<?php $c++;?>
						<?php $fbname = $fb->clientname;?>
						<?php if($fbname===$lastname){?>
						<?php }else{?>
							<tr class="subheader">
							<td colspan=31>
								<span class="subheadertext">
									Nama Pelanggan : <?php echo $fbname;?>
								</span>
							</td>
							</tr>
							<?php }?>
					<tr>
						<th valign="top"><?php echo $c;?>.</th>
						<?php
						for($d = 1;$d<31;$d++){
							$x = day_nth($d);
							echo '<td>' . $fb->$x . '</td>';
						}
						?>
					</tr>
					<?php
					$lastname = $fb->clientname;
					?>
					<?php }?>
				</tbody>
			</table>
		</div>
		</div>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type="text/javascript">
			(function($){
				 $(".datepicker").datepicker({dateFormat:'d/m/yy'});
			orderlink = function(orderby,branch){
				branch ='0';
				$.each($(".suspect-branches :checked"),function(){
					branch+=$(this).val();
				})
				$("#dt1").getdate();
				$("#dt2").getdate();
				order = urlsegment(4);
				range = urlsegment(6);
				rorder = (order=='desc')?'asc':'desc';
				console.log('rorder',rorder);
				$("#startdate").getdate();
				$("#enddate").getdate();
				window.location.href = baseurl+"rpt/fbreport/"+orderby+"/"+rorder+"/"+branch+"/"+range+"/"+$("#startdate").attr("datetime")+"/"+$("#enddate").attr("datetime");;
			}
			$("#btnfilter").click(function(){
				orderlink(urlsegment(3),'');
			});
				$(".optage").click(function(){
					$("#startdate").getdate();
					$("#enddate").getdate();
					console.log("startdate",$("#startdate").val());
					branch ='';
					$.each($(".suspect-branches :checked"),function(){
						branch+=$(this).val();
					})
					order = urlsegment(4);
					console.log("urlsegment ",urlsegment(3));
					window.location.href = baseurl+"rpt/solvedreport/"+urlsegment(3)+"/"+order+"/"+branch+"/"+$(this).attr("value")+"/"+$("#startdate").attr("datetime")+"/"+$("#enddate").attr("datetime");
				});
				$("#dateasc").click(function(){
					console.log("pengurutan berdasarkan tanggal asc");
				});
				$("#datedesc").click(function(){
					console.log("pengurutan berdasarkan tanggal desc");
				});
				$("#hunterasc").click(function(){
					console.log("pengurutan berdasarkan hunter asc");
				});
				$("#hunterdesc").click(function(){
					console.log("pengurutan berdasarkan hunter desc");
				});
				$(".optage").click(function(){
					$("#txtage").html($(this).html());
				});
			}(jQuery))
		</script>
	</body>
</html>

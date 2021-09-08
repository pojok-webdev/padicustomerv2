<html>
	<head>
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="/asset/report/bootstrap-3.3.6.min.css">
		<link href="/css/aquarius/stylesheets.css" rel="stylesheet" type="text/css" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type='text/javascript' src='/js/jquery-1.8.2.min.js'></script>
	    <script type='text/javascript' src='/js/jquery-ui-1.10.4.custom.min.js'></script>
		<link rel="stylesheet" href="/css/rpt/ticketperiodic.css">
		<title>Laporan Shift TS <?php echo $date;?> </title>
	</head>
	<body>
		<div class="containerx">
		<div class="jumbotronx">
			<div id="reportsubject">Laporan Harian TS , <?php echo $date;?> (Total : <?php echo $total;?>)</div>
			<div class='filter'>
				<label for="monthdatepicker">Tanggal</label>
				<input type="text" class="monthdatepicker" id="reportdate1" value ="<?php echo $dateselected1;?>">
				s/d
				<input type="text" class="monthdatepicker" id="reportdate2" value ="<?php echo $dateselected2;?>">
			</div>
			<div class="filter">
				<label for="branches">Cabang</label>
				<?php
				foreach($arrbranch as $br){
					$ischecked = false;
					$checked = "";
					for($c=0;$c<strlen($userbranches);$c++){
						if(substr($this->uri->segment(9),$c,1)===$br){
							$ischecked = true;
						}
					}
					if($ischecked){
						$checked = "checked='checked'";
					}
					echo '<label class="checkbox-inline suspect-branches"><input class="cbranches" type="checkbox" value="'.$br.'" '. $checked .' >';
					echo getbranch($br) . " ";
					echo '</label>';
				}	
				?>
			</div>
			<div class="filter">
				<label for="category">Kategori</label>
				<button class="btnCategory" id="btnprevcategory">Pilih Kategori</button>
			</div>
			<div>
				<button class="btn btn-success" id="btnfilter">Filter</button>
				<a href="/rpt" class="btn btn-success">Home</a>
			</div>
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<tbody>
					<?php $c=0;?>
					<?php foreach($tickets as $ticket){?>
						<?php $c++;?>
					<tr class='clientname'>
						<th rowspan=9 valign="top"><?php echo $c;?>.</th>
						<td class='tdclientname'>
							Pelanggan
						</td>
						<td>
							<?php echo $ticket->clientname;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Kategori
						</td>
						<td>
							<?php echo $ticket->category;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Person
						</td>
						<td>
							<?php echo $ticket->reporter;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Waktu
						</td>
						<td>
							<?php echo $ticket->ticketstart;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Keluhan
						</td>
						<td>
							<?php echo $ticket->complaint;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Main Root Cause
						</td>
						<td>
							<?php echo $ticket->mainrootcause;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Sub Root Cause
						</td>
						<td>
							<?php echo $ticket->subrootcause;?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Solusi
						</td>
						<td>
							<?php foreach(getticketsolution($ticket->id) as $solution){?>
							<?php echo $solution->description;?>
							<?php }?>
						</td>
					</tr>
					<tr>
						<td class="rowname">
							Status
						</td>
						<td>
							<?php echo ($ticket->status==="1")?"Selesai":"Belum Selesai";?>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
		<div id="dprevcategory" title="Pilih Cause Category" style='display:none'>
			<div class="categorylama">
				<span class='categoryheading'>Kategori Lama</span>
				<?php foreach($version0 as $v){?>
				<?php if(in_array($v->id,$arrcausecategories)){$checked='checked="checked"';}else{$checked='';}?>
				<div class="item">
					<input class="version0" type="checkbox" name="version0[]" value="<?php echo $v->id;?>" <?php echo $checked?>>
					<span class="clabel"><?php echo $v->name;?></span>
				</div>
				<?php }?>
				<div class="categoryfooting">
					<input class="choosealllastcategory" type="checkbox" name="" id="">
					<span  class="clabel">Pilih semua</span>
				</div>
			</div>
			<div class="categorybaru">
				<span class='categoryheading'>Kategori Baru</span>
				<?php foreach($version1 as $v){?>
					<?php if(in_array($v->id,$arrcausecategories)){$checked='checked="checked"';}else{$checked='';}?>
					<div class='item'>
						<input class="version0" type="checkbox" name="version0[]" value="<?php echo $v->id;?>" <?php echo $checked?>>
						<span><?php echo $v->name;?></span>
					</div>
				<?php }?>
				<div class="categoryfooting">
					<input class="choosealllastcategory" type="checkbox" name="" id="">
					<span class="clabel">Pilih semua</span>
				</div>
			</div>
		</div>
		</div>
		<script type="text/javascript">
			(function($){
				$(".survey").mouseover(function(){
					var dt = $(this).attr("dt");
					$(".surveydetail."+dt).css("color","red");
					console.log($(this).attr("dt"));
				});
				$(".survey").mouseout(function(){
					var dt = $(this).attr("dt");
					$(".surveydetail."+dt).css("color","black");
					console.log($(this).attr("dt"));
				});
				$(".installation").mouseover(function(){
					var dt = $(this).attr("dt");
					$(".installdetail."+dt).css("color","red");
					console.log($(this).attr("dt"));
				});
				$(".installation").mouseout(function(){
					var dt = $(this).attr("dt");
					$(".installdetail."+dt).css("color","black");
					console.log($(this).attr("dt"));
				});
				$(".troubleshoot").mouseover(function(){
					var dt = $(this).attr("dt");
					$(".troubleshootdetail."+dt).css("color","red");
					console.log($(this).attr("dt"));
				});
				$(".troubleshoot").mouseout(function(){
					var dt = $(this).attr("dt");
					$(".troubleshootdetail."+dt).css("color","black");
					console.log($(this).attr("dt"));
				});
				$("#btnfilter").click(function(){
					if(($('.version0:checked').length == 0)){
						alert('Kategori Harus dipilih');
					}else{
						branch ='';
					$.each($(".suspect-branches :checked"),function(){
						branch+=$(this).val();
					})					
					if($("#reportdate1").val().trim()!==""){
						var dat1 = $("#reportdate1").val(),
							sp1 = dat1.split("/"),
							dt1 = sp1[0], mn1 = sp1[1],yr1 = sp1[2],
							dat2 = $("#reportdate2").val(),
							sp2 = dat2.split("/"),
							dt2 = sp2[0], mn2 = sp2[1],yr2 = sp2[2];

							console.log($('input.cbranches:checked').map(function(){
								return this.value;
							}).get().join(","));
							let version0 = $('input.version0:checked').map( function() {
								return this.value;
							}).get().join("-");
							let version1 = $('input.version1:checked').map( function() {
								return this.value;
							}).get().join("-");
							console.log($('#reportdate1').val())
							console.log($('#reportdate2').val())
							$.ajax({
								url:'/rpt/datagetticketperiodicb',
								data:{
									dt1:dt1,dt2:dt2,mn1:mn1,mn2:mn2,yr1:yr1,yr2:yr2,branch:branch,version0:version0
								},
								type:'post',
								dataType:'json'
							})
							.done(function(res){
								console.log('REZ',res);
							});
						window.location.href = "/rpt/shiftreportperiodic/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+branch+"/"+version0;
					}
					}

				})
				$(".monthdatepicker").datepicker({dateFormat:'dd/m/yy'});
				$('#btnprevcategory').click(function(){
					$('#dprevcategory').dialog({
						beforeClose:function(){
							if(($('.version0:checked').length==0)){
								alert('Kategori harus ada yang dipilih');
								return false;
							}else{
								return true;
							}
						},
						buttons:{
							'OK':function(){
								let _this = $(this);
								checked(function(){
									_this.dialog('close');
								});
							},
							'Tutup':function(){
								let _this = $(this);
								checked(function(){
									_this.dialog('close');
								});
							}
						}

					});
				});
				checked = function(callback){
					console.log('category length',$('.version0:checked').length);
					if(($('.version0:checked').length==0)){
						alert('Kategori harus ada yang dipilih');
					}else{
						callback();
					}
				}
				$('#btnpresentcategory').click(function(){
					$('#dpresentcategory').dialog({
						buttons:{
							'OK':function(){
								let _this = $(this);
								checked(function(){
									_this.dialog('close');
								});
								//console.log($('.version1 :checked').join());
							},
							'Tutup':function(){
								let _this = $(this);
								checked(function(){
									_this.dialog('close');
								});
//								$(this).dialog('close');
							}
						}
					});
				});
				$('.clabel').click(function(){
					$(this).prev().click();
				});
				$('.choosealllastcategory').change(function(){
					_o = $(this);
					$(this).parent().parent().find('input[type="checkbox"]').prop("checked",_o.prop("checked"));
				});
			}(jQuery))
		</script>
	</body>
</html>

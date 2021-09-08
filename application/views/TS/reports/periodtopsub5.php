<html>
	<head>
		<link rel="stylesheet" href="/asset/report/bootstrap-3.3.6.min.css" />
		<link href="/css/aquarius/stylesheets.css" rel="stylesheet" type="text/css" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>		-->
		<!--<script src="/asset/report/bootstrap-3.3.6.min.js"></script>-->
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type='text/javascript' src='/js/jquery-1.8.2.min.js'></script>
	    <script type='text/javascript' src='/js/jquery-ui-1.10.4.custom.min.js'></script>
		<script type='text/javascript' src='/js/aquarius/plugins/charts/excanvas.min.js'></script>    
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.js'></script>    
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.stack.js'></script>    
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.pie.js'></script>
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.resize.js'></script>
		<link rel="stylesheet" href="/css/rpt/bs.css">
		<link rel="stylesheet" href="/css/rpt/periodtopsub5.css">
		<title>Laporan Top 5 Main Root Cause <?php echo $date1.' - '.$date2;?> </title>
	</head>
	<body>
		<div class="containerx">
		<div class="jumbotronz">
		<div class='subject' id='main'>
		Laporan Top 5 Sub Root Cause (<?php echo $mainrootname;?>)
		</div>
		<div class='subject' id='sub'>
		<?php echo $date1 . ' - ' . $date2;?> (<?php echo $total;?>)
		</div>
		<div class='filter'>
			<div id='filterleft'>
				<label class="label" for="mainroot">Main Root Cause</label>
				<?php echo form_dropdown('mainroot',$mainroots,$category_id,'id="mainroot"');?>
			</div>
			<div id='filterright'>
				<label class="label" for="reportdate1">Rentang Tanggal</label>
				<input type="text" class="monthdatepicker" id="reportdate1" value ="<?php echo $dateselected1;?>">
				<input type="text" class="monthdatepicker" id="reportdate2" value ="<?php echo $dateselected2;?>">
			</div>
		</div>

		<div class='filter'>
			<span class='label'>Cabang</span><span> 
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
						echo '<label class="checkbox-inline suspect-branches"><input type="checkbox" value="'.$br.'" '. $checked .' >';
						echo getbranch($br) . " ";
						echo '</label>';
					}
					?><br />		
			</span>
		</div>
		<div class="filter">
			<span class="label">Jumlah yang ditampilkan</span>
			<?php echo form_dropdown("numbertoshow",$numbertoshow,$numtoshow,"id=numbertoshow");?>
		</div>
		<div id='filterbuttons'>
			<button class="button btn-filter" id="btnfilter">Filter</button>
			<a href="/rpt" class="button btn-home">Home</a>		
		</div>
		<div class="row">
			<table id="rpt" class="table">
				<thead>
					<tr>
					<th>No</th><th>Nama</th><th>Jumlah</th>
					</tr>
				</thead>
				<tbody>					
					<?php $c=0;$cnt = 0;?>
					<?php $total = 0;?>
					<?php $tempheader = ''?>
					<?php foreach($tickets as $ticket){?>
						<?php 
							if($ticket->cnt!=$cnt){
								$c++;
							}
							$cnt = $ticket->cnt;
						?>
                        <tr trid="<?php echo $ticket->id;?>">
                            <th><?php echo $c;?>.</th>
                            <td>
                            <span class="causedetail"><?php echo $ticket->name;?></span>
                            </td>
                            <td class='numeric'>
                            <span class="causedetail"><?php echo '<a href="/rpt/getticketsbysubroot/'.$dateselected1.'/'.$dateselected2.'/'.$branches.'/'.$ticket->id.'">'. $ticket->cnt;?></span>
                            </td>
						</tr>
						<?php $total += $ticket->cnt;?>
					<?php }?>
				</tbody>
				<tfoot>
						<tr>
						<td colspan=2></td>
						<td class='numeric'><?php echo $total;?></td>
						</tr>
				</tfoot>
			</table>
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
						window.location.href = "/rpt/periodtopsub5/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+branch+"/"+$('#mainroot').val()+"/"+$("#numbertoshow").val();
					}
				})
				$(".monthdatepicker").datepicker({dateFormat:'dd/m/yy'});
				function selectElementContents(el) {
					var body = document.body, range, sel;
					if (document.createRange && window.getSelection) {
						range = document.createRange();
						sel = window.getSelection();
						sel.removeAllRanges();
						try {
							range.selectNodeContents(el);
							sel.addRange(range);
						} catch (e) {
							range.selectNode(el);
							sel.addRange(range);
						}
					} else if (body.createTextRange) {
						range = body.createTextRange();
						range.moveToElementText(el);
						range.select();
					}
					document.execCommand("Copy");
				}

				function selectTableContents(el) {
					var body = document.body, range, sel;
					if (document.createRange && window.getSelection) {
						range = document.createRange();
						sel = window.getSelection();
						sel.removeAllRanges();
						try {
							range.selectNodeContents(el);
							sel.addRange(range);
						} catch (e) {
							range.selectNode(el);
							sel.addRange(range);
						}
					} else if (body.createTextRange) {
						range = body.createTextRange();
						range.moveToElementText(el);
						range.select();
						range.execCommand("Copy");
					}
				}
				function copytable(el) {
					var urlField = document.getElementById(el)   
					var range = document.createRange()
					range.selectNode(urlField)
					window.getSelection().addRange(range) 
					document.execCommand('copy')
				}
				$("#btnCopy").click(function(){
					copytable('rpt')
				//	selectTableContents(document.getElementById('rpt'));
				});
				$("#btnSpreadsheet").click(function(){
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
					window.location.href = "/rpt/periodtopsub5/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+branch+"/";
					}
				})
			}(jQuery))
		</script>
	</body>
</html>

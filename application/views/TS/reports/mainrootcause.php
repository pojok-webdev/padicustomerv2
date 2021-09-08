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
		<script type='text/javascript' src='/js/aquarius/plugins/charts/excanvas.min.js'></script>    
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.js'></script>    
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.stack.js'></script>    
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.pie.js'></script>
		<script type='text/javascript' src='/js/aquarius/plugins/charts/jquery.flot.resize.js'></script>

		<title>Laporan Shift TS <?php echo $date;?> </title>
	</head>
	<body>
		<div class="container">
		<div class="jumbotron">
		<h3>Laporan Main RootCause TS , <?php echo $date1 . ' - ' . $date2;?> (<?php echo $total;?>)</h3>
		<h5>
		<input type="text" class="monthdatepicker" id="reportdate1" value ="<?php echo $dateselected1;?>">
		<input type="text" class="monthdatepicker" id="reportdate2" value ="<?php echo $dateselected2;?>">
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
				echo '<br />';
				foreach($categories as $cat){
					$ischecked = false;
					$checked = "";
					for($c=0;$c<count($category);$c++){
						if($category[$c]===$cat->id){
							$ischecked = true;
						}
					}
					if($ischecked){
						$checked = "checked='checked'";
					}
					echo '<label class="checkbox-inline suspect-categories"><input type="checkbox" value="'.$cat->id.'" '. $checked .' >';
					echo $cat->name . " ";
					echo '</label>';
				}	
				?><br />
				<button class="btn btn-success" id="btnfilter">Filter</button>			
			<a href="<?php echo base_url()?>rpt" class="btn btn-success">Home</a>
		</h5>
		</div>
		<div class="row">
		<button id="btnCopy">Copy</button><button id="btnSpreadsheet">Download Excel</button>
			<table id="rpt" class="table">
				<thead>
					<tr>
					<th>No</th><th>Kd Ticket</th><th>Nama</th><th>Sub Root Cause</th><th>Follow Up</th>
					</tr>
				</thead>
				<tbody>					
					<?php $c=0;?>
					<?php $tempheader = ''?>
					<?php foreach($tickets as $ticket){?>
						<?php $c++;?>
						<?php if($tempheader != $ticket->mainrootcause){?>
						<tr><th colspan=5><?php echo $ticket->mainrootcause;?></th></tr>
						<?php }?>
						<?php $tempheader = $ticket->mainrootcause ;?>
                        <tr trid="<?php echo $ticket->kdticket;?>">
                            <th><?php echo $c;?>.</th>
                            <td>
                            <span class="causedetail"><?php echo $ticket->kdticket;?></span>
                            </td>
                            <td>
                            <span class="causedetail"><?php echo $ticket->name;?></span>
                            </td>
                            <td>
                            <span class="causedetail"><?php echo $ticket->subrootcause;?></span>
                            </td>
                            <td>
								<table>
								<thead>
								<tr>
								<th>Action</th><th>Kesimpulan</th>
								</tr>
								</thead>
								<tbody>
	                            <?php foreach(getfus($ticket->id) as $fu){?>
								<tr>
								<td><?php echo $fu->description;?></td>
								<td><?php echo $fu->conclusion;?></td>
								</tr>
								<?php }?>
								</tbody>
								</table>
                            </td>
                        </tr>
					<?php }?>
				</tbody>
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
					let category='0';
					$.each($(".suspect-categories :checked"),function(){
						category+='-'+$(this).val();
					})
					if($("#reportdate1").val().trim()!==""){
						var dat1 = $("#reportdate1").val(),
							sp1 = dat1.split("/"),
							dt1 = sp1[0], mn1 = sp1[1],yr1 = sp1[2],
							dat2 = $("#reportdate2").val(),
							sp2 = dat2.split("/"),
							dt2 = sp2[0], mn2 = sp2[1],yr2 = sp2[2];
						window.location.href = "/rpt/mainrootcause/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+branch+"/"+category;
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
					let category='0';
					$.each($(".suspect-categories :checked"),function(){
						category+='-'+$(this).val();
					})
					if($("#reportdate1").val().trim()!==""){
						var dat1 = $("#reportdate1").val(),
							sp1 = dat1.split("/"),
							dt1 = sp1[0], mn1 = sp1[1],yr1 = sp1[2],
							dat2 = $("#reportdate2").val(),
							sp2 = dat2.split("/"),
							dt2 = sp2[0], mn2 = sp2[1],yr2 = sp2[2];
					window.location.href = "/rpt/mainrootcauseexcel/"+dt1+"/"+mn1+"/"+yr1+"/"+dt2+"/"+mn2+"/"+yr2+"/"+branch+"/"+category;
					}
				})
			}(jQuery))
		</script>
	</body>
</html>

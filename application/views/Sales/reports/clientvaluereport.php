<html>
	<?php $this->load->view("Sales/reports/reporthead");?>
	<body>
		<div class="container">
		<div class="jumbotronx">
			
			<div class="row-fluid">
				<div class="col-sm-4">
					<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">Nama</div>
						<div class="span9"><input type="text" class="" id="clientname"/> </div>
					</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">Bidang Usaha</div> 
						<div class="span9"><input type="text" class="" id="business_field"/> </div>
					</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">AM</div>
						<div class="span9"><input type="text" class="" id="am"/></div>
					</div> 
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="col-sm-4">
					<div class="block-fluid without-head">
						<div class="row-form clearfix">
							<div class="span3">Layanan</div>
							<div class="span9"><input type="text" class="" id="service"/>  </div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="block-fluid without-head">
						<div class="row-form clearfix">
							<div class="span4"><span class="monthselector">Tgl Aktivasi</span> </div><div class="span8">
							<input type="text" class="datepicker monthselector" id="activationdate" value="<?php echo $this->common->sql_to_human_date($dt2);?>" > </div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="block-fluid without-head">
						<div class="row-form clearfix">
							<div class="span12"> </div>
						</div>
					</div>
				</div>
			</div>
			<div class="radio">
				<label class="checkbox-inline">
					<input type="checkbox" value="1" class="suspect-branches" >Surabaya
				</label>
				<label class="checkbox-inline">
					<input type="checkbox" value="2" class="suspect-branches" >Jakarta
				</label>
				<label class="checkbox-inline ">
					<input type="checkbox" value="4" class="suspect-branches" >Bali
				</label>
				<label class="checkbox-inline">
					<input type="checkbox" value="3" class="suspect-branches" >Malang
				</label>
			</div>
			<br />
			<span id="amsby">
				<?php
					foreach($users as $am){
					if(in_array($am,$ams)){
						$amchecked = 'checked="checked"';
					}else{
						$amchecked = '';
					}
					echo '<label class="checkbox-inline"><input type="checkbox" class="amchecked" '.$amchecked.' value="'.$am.'">'.humanize(getusernamebyid($am)).'</label>';
				}?>
			</span>
			<a class="rptanchor btn btn-success" href="/rpt">Home</a>
			<button class="btn btn-success" id="btnfilter">Filter</button>
		</div>
		<div id="filterToggler" class="btn btn-primary"> 
			<span class="glyphicon glyphicon-asterisk"></span> Toggle Filter
		</div>
		<h3><?php echo $title;?></h3>
		<div class="row">
			<table id="rpt" class="table">
				<thead>
					<tr>
						<th colspan="2">Total :<span id="total"><?php echo $total;?></span></th>
						<th colspan="4"></th>
					</tr>
					<tr>
						<th rowspan=2>No</th>
						<th rowspan=2 class='pointer'>Pelanggan</th>
						<th colspan=2 class='pointer'>Setup</th>
						<th colspan=2  class='pointer'>Bulanan</th>
					</tr>
					<tr>
						<th onClick='orderlink("address","1")' class='pointer'>DPP</th>
						<th onClick='orderlink("hunter","1")' class='pointer'>+PPn</th>
						<th onClick='orderlink("brn","1")' class='pointer'>DPP</th>
						<th onClick='orderlink("brn","1")' class='pointer'>+Ppn</th>
					</tr>
				</thead>
				<tbody>
					<?php $c=0;?>
					<?php foreach($objs as $obj){?>
						<?php $c++;?>
					<tr>
						<th valign="top"><?php echo $c;?>.</th>
						<td>
							<?php echo $obj->name;?>
						</td>
						<td>
							<?php echo number_format($obj->setupdpp);?>
						</td>
						<td>
							<?php echo number_format($obj->setupppn);?>
						</td>
						<td>
							<?php echo number_format($obj->monthlydpp);?>
						</td>
						<td>
							<?php echo number_format($obj->monthlyppn);?>	
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
		</div>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type="text/javascript">
			(function($){
				doFilterAM = function(){
					console.log("AMLIST DO FILTER CLICKED");
					$.each($(".amlist :checked"),function(){
						console.log("AM",$(this).val());
					})
				};
				orderlink = function(orderby,branch){
					branch ='';
					$.each($(".suspect-branches:checked"),function(){
						branch+=$(this).val();
					})
						am = "";
						amarr = [];
						$.each($(".amchecked:checked"),function(){
							amarr.push($(this).val());
						});
					console.log("Branch",branch);
					$("#dt1").getdate();
					$("#dt2").getdate();
					order = urlsegment(4);
					rorder = (order=='desc')?'asc':'desc';
					console.log('rorder',rorder);
					window.location.href 
					= 
					"/rpt/clientreport/"
					+orderby
					+"/"
					+rorder
					+"/"
					+$("#dt1").attr("datetime")
					+"/"
					+$("#dt2").attr("datetime")
					+"/"
					+branch
					+"/"
					+amarr.join("-");
				}
				$(".datepicker").datepicker({dateFormat:'dd/mm/yy'});
				$("#btnfilter").click(function(){
					$("#dt1").getdate();
					$("#dt2").getdate();
					branch ='';
					allchecked = false;
					$.each($(".suspect-branches:checked"),function(){
						branch+=$(this).val();
						allchecked = true;
					})
					am = "";
					amarr = [];
					$.each($(".amchecked:checked"),function(){
						amarr.push($(this).val());
					});
					order = urlsegment(4);
					$("#rpt tbody tr").remove();
					$.ajax({
						url:'/rpt/clientfeed',
						data:{
							'nama':$('#clientname').val(),
							'usaha':$('#business_field').val(),
							'am':$('#am').val(),
							'layanan':$('#service').val(),
							'branches':branch
							},
						dataType:'json',
						async:true,
						type:'post'
					})
					.done(function(res){
						$("#rpt tbody tr").remove();
						$("#total").html(res["tot"]);
						c = 1;
						$.each(res["res"],function(a,b){
							str = '<tr>';
							str+='<td>'+c+'</td>';
							str+='<td>'+b.business_field+'</td>';
							str+='<td>'+b.name+'</td>';
							str+='<td>'+b.address+'</td>';
							str+='<td>'+b.am+'</td>';
							str+='<td>'+b.branches+'</td>';
							str+='</tr>';
							$("#rpt tbody").append(str);
							c++;
						})
					})
					.fail(function(err){
						console.log("Err",err)
					});
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
				$("#filterToggler").click(function(){
					$(".jumbotronx").slideToggle();
				});
			}(jQuery))
		</script>
	</body>
</html>

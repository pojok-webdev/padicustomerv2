<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" type="text/css" href="/css/teknis.css"/>
	<link rel="stylesheet" type="text/css" href="/js/autocomplete/styles.css"/>
	<link rel="stylesheet" type="text/css" href="/css/aquarius/upstream.css"/>
	<link rel="stylesheet" type="text/css" href="/css/padilibs/autocomplete/cosmetics.css"/>
	<?php $this->load->view('adm/head'); ?>
<style>
.table-sorting{
font-size:small;
}
</style>
    <script type="text/javascript" src="/js/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="/js/padilibs/padi.autocomplete.js"></script>
	<script src="/asset/jquery/datetimepicker/jquery.datetimepicker.js"></script>
	<body>
		<?php $this->load->view("TS/tickets/ticketmodals");?>
		<?php $this->load->view("TS/tickets/addTicket20210723");?>
		<?php $this->load->view("modals")?>
		<?php $this->load->view("TS/tickets/upstream")?>
		<?php $this->load->view("TS/tickets/datefilter")?>
		<?php $this->load->view("TS/tickets/AddServerTicket")?>
		<div class="header">
			<a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="Padinet" title="Padinet"/></a>
			<ul class="header_menu">
				<li class="list_icon"><a href="#">&nbsp;</a></li>
			</ul>
		</div>
		<?php $this->load->view('adm/menu', $path); ?>
		<div class="content">
			<div class="breadLine">
				<ul class="breadcrumb">
					<li><a href="#">App</a> <span class="divider">></span></li>
					<li><a href="#">Tickets</a> <span class="divider">></span></li>
					<li class="active">List</li>
				</ul>
				<?php $this->load->view('adm/buttons'); ?>
			</div>
			<div class="workplace">
				<input type='hidden' name='createuser' value='<?php echo $this->ionuser->username; ?>' id='createuser' class="inp_ticket inp_ticket2"/>
				<input type='hidden' name='user_id' value='<?php echo $this->ionuser->id; ?>' id='user_id' class="inp_ticket inp_ticket2"/>
				<div class="row-fluid">
					<div class="span12">
						<div class="head clearfix">
							<div class="isw-grid"></div>
							<h1>Tickets</h1>
							<span id="filterclientlabel">Client Category</span>
							<select name="filterclientcategory" id="filterclientcategory" class="headcomponent" style="width:90px">
								<option value=" ">All</option>
								<option value="FFR">FFR</option>
								<option value="Platinum">Platinum</option>
								<option value="Gold">Gold</option>
								<option value="Silver">Silver</option>
								<option value="Bronze">Bronze</option>
								<option value="Uncategorized">Uncategorized</option>
							</select>

							<span id="filtereskalasi">Filter Eskalasi</span>
							<select name="filtereskalasi" id="sfiltereskalasi" class="headcomponent" style="width:80px">
								<option value=" ">All</option>
								<option value="Yellow">Yellow (EoS)</option>
								<option value="Pink">Pink (TS)</option>
								<option value="Violet">Violet (NOC)</option>
								<option value="Blue">Blue (BTS)</option>
								<option value="Red">Red (>7 days)</option>
							</select>

							<span id="filterbranch">Cabang</span>
							<select name="filterbranch" id="sfilterbranch" style="width:80px" class="headcomponent">
								<option value=" ">All</option>
								<option value="Surabaya">Surabaya</option>
								<option value="Jakarta">Jakarta</option>
								<option value="Malang">Malang</option>
								<option value="Bali">Bali</option>
							</select>
							<ul class="buttons">
								<li><span class="isw-padiinformation" id="btnshowinformation" title="Informasi"></span></li>
								<li><span class="isw-time" id="btnshowdatefilter" title="Filter Tanggal"></span></li>
								<li><span class="isw-question-mark btnhelp" id="btnhelp" title="Help"></span></li>
								<li><span class="isw-clean btnCleanFilter" id="btnCleanFilter" title="Bersihkan filter table"></span></li>
								<li><span class="isw-documents" id="btnaddserver" title="BUAT TICKET Server"></span></li>
								<li><span class="isw-up" id="btnaddupstream" title="BUAT TICKET UPSTREAM"></span></li>
								<li><span class="isw-plus" id="btnaddticket" title="BUAT TICKET PELANGGAN"></span></li>
							</ul>
							<div id="bcExp" class="popup">
								<div class="head clearfix">
									<div class="arrow"></div>
									<span class="isw-question-mark"></span>
									<span class="name">Keterangan</span>
								</div>
								<div class="body-fluid users">
									<div class="item">
										Baris dg Text berwarna <span class='textred'>merah</span> adalah ticket yang memiliki troubleshoot<br />
										Baris dg Background <span class='textpink'>hijau</span> adalah ticket yang masih open<br />
										Baris dg Background <span class='ticketMassal'>Coklat</span> adalah ticket gangguan massal<br />
										Baris dg Background <span style="background-color:yellow">kuning</span> adalah ticket backbone,bts,lastmilepadinet,localpelanggan,lastmilevendor yang lebih dari 2 hari
										Baris dg Background <span style="background-color:red">merah</span> adalah ticket backbone,bts,lastmilepadinet,localpelanggan,lastmilevendor yang lebih dari 7 hari
									</div>
								</div>
								<div class="footer">
									<button class="btn btn-danger btnhelp" type="button">Tutup</button>
								</div>
							</div>               							
						</div>
						<div class="block-fluid table-sorting clearfix">
							<table cellpadding="0" cellspacing="0" width="100%" class="table tickettable" id='tbl_ticket'>
								<thead>
									<tr>
										<th width="5">Kode</th>
										<th width="20%">Nama</th>
										<th>clientcategory</th>
										<th width="35%">Layanan</th>
										<th class="datestart"></th>
										<th width="15%">Durasi</th>
										<th width="10%">Category</th>
										<th width="5%">Main Root Cause</th>
										<th width="5%">Site</th>
										<th width="5%">VAS</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($objs as $obj) { ?>
										<?php
											$srv = getservices($obj->id);
										?>
										<?php $ticketclass = (is_null($obj->hastroubleshoot))?'textblack':'textred'?>
										<?php
											if($obj->parentid!==null){
												$ticketclass.=" ticketMassal";
											}
											if($obj->requesttype!=="pelanggan"){
												$ticketclass.=" ticketMassal";
											}
										?>
										<?php $ticketaccom = (is_null($obj->trid))?'beres':'blmberes'?>
										<?php $status = ($obj->status == "0") ? 'ticketOpen_' : 'ticketClosed_'; ?>
										<?php $alertflag = ($obj->alertflag == "0") ? 'noalert' : 'showalert'; ?>
										<tr style='background-color:"<?php echo $obj->color;?>"' thisid='<?php echo $obj->id; ?>' class="<?php echo $ticketclass . ' ' .$status . ' ' . $alertflag . ' ' . $obj->color;?>" ticketstart="<?php echo $obj->ticketstart;?>" ticketend="<?php echo $obj->ticketEnd;?>" >
											<td class="kdticket updatable tbl_action editticket" fieldName="kdticket" requestid="<?php echo $obj->id; ?>">
												<b><?php echo $obj->kdticket; ?></b><br>
												<span class="status">
													<?php echo ($obj->status == "0") ? "Open" : "Closed"; ?>
												</span>
												<div class="btn-group">
													<?php if ($obj->status == '0') { 
														$dsbld = '';
													}else{
														$dsbld = 'disabled="disabled"';
													}?>
													<button <?php echo $dsbld;?> data-toggle="dropdown" class="btn dropdown-toggle ticketaction">Action <span class="caret"></span></button>
													<?php if ($obj->status == '0') { ?>
													<ul class="dropdown-menu pull-right ticketulaction">
														<?php
															if($obj->requesttype!=="pelanggan"){
																echo "<li class='editUpstream pointer'><a>Edit Upstream</a></li>";
															}
														?>
														<li class='btntroubleshoot pointer'>
															<a href="/troubleshoots/add/<?php echo $obj->id;?>">Troubleshoot</a>
														</li>
														<li class='btnfollowup pointer'><a>Follow Up Ticket</a></li>
														<li class="btndowntime pointer"><a>Downtime</a></li>
														<?php if($obj->hastroubleshoot>0){?>
														<li class="pointer setHasVisited"><a><span class="hasVisitedLabel">Tandai sdh dikunjungi<span></a></li>
														<?php } ?>
													</ul>
													<?php } ?>
												</div>
												<span>
												Create date: <?php echo $obj->create_date?>
												</span>
											</td>
											<td class='clientname pointer'>
												<?php echo $obj->clientname;?>
												<p class="area">_<?php echo $obj->branch;?>_</p>
												<ul class="troubleshootslist"></ul>
												<span class="hasVisited"></span>
											</td>
											<td>
											<?php echo $obj->clientcategory; ?>
											</td>
											<td>
												<b>Layanan:</b><br>
												<span><?php echo $srv; ?></span>
											</td>
											<td><?php echo $obj->rawticketstart;?></td>
											<td class="updatable" fieldName="duration">
												<?php echo $obj->ticketstart;?>
											</td>
											<td class='<?php echo $status . 'ticket ' . $obj->clientcategory; ?>'><?php echo $obj->clientcategory; ?></td>
											<td><?php echo $obj->mainrootcause; ?></td>
											<td><?php echo $obj->address; ?></td>
											<td><?php echo $obj->vases; ?></td>
											<td><?php echo $obj->color;?></td>
<td><?php echo $obj->branch;?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="dr"><span></span></div>
			</div>
			<?php $this->load->view('TS/tickets/modalResume');?>
			<?php $this->load->view('shared/confirmationModal')?>
			<div id="stickybuttongroup" class="btn-group btn-group-vertical">
				<div id="navigator" class="btn btn-warning" title="Toggle Menu">
					<span id="mynavigatorIcon" class="icon-chevron-left"></span>
				</div>
			</div>
		</div>
		<script src="/asset/aqua/js/navigator.js"></script>
		<script>
		(function($){
			$.fn.dataTableExt.oApi.fnGetColumnData = function ( oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty ) {
				// check that we have a column id
				if ( typeof iColumn == "undefined" ) return new Array();

				// by default we only want unique data
				if ( typeof bUnique == "undefined" ) bUnique = true;

				// by default we do want to only look at filtered data
				if ( typeof bFiltered == "undefined" ) bFiltered = true;

				// by default we do not want to include empty values
				if ( typeof bIgnoreEmpty == "undefined" ) bIgnoreEmpty = true;

				// list of rows which we're going to loop through
				var aiRows;

				// use only filtered rows
				if (bFiltered == true) aiRows = oSettings.aiDisplay;
				// use all rows
				else aiRows = oSettings.aiDisplayMaster; // all row numbers

				// set up data array
				var asResultData = new Array();

				for (var i=0,c=aiRows.length; i<c; i++) {
					iRow = aiRows[i];
					var aData = this.fnGetData(iRow);
					var sValue = aData[iColumn];

					// ignore empty values?
					if (bIgnoreEmpty == true && sValue.length == 0) continue;

					// ignore unique values?
					else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1) continue;

					// else push the value onto the result data array
					else asResultData.push(sValue);
				}
				return asResultData;
			}
			getInfo = function(opt,callback){
				$.ajax({
					url:'/tickets/getrangeinfo/'+$('#min').val()+'/'+$('#max').val()+'/'+opt.status,
					dataType:'json'
				})
				.done(res=>{
					console.log('getinfo res',res);
					callback(res)
				})
				.fail(err=>{
					console.log('getinfo err',err);
				});
			}
			$('#btnshowinformation').click(function(){
				console.log('Information clicked');
				$('#modalResumeLabel').html('Summary Halaman ini');
				$('#closedticketamount').html($('.ticketClosed_ticket').length);
				$('#closedticketfframount').html($('.ticketClosed_ticket.FFR').length);
				$('#closedticketplatinumamount').html($('.ticketClosed_ticket.Platinum').length);
				$('#closedticketgoldamount').html($('.ticketClosed_ticket.Gold').length);
				$('#closedticketbronzeamount').html($('.ticketClosed_ticket.Bronze').length);
				$('#closedticketsilveramount').html($('.ticketClosed_ticket.Silver').length);
				$('#closedticketuncategorizedamount').html($('.ticketClosed_ticket.Uncategorized').length);
				$('#openticketamount').html($('.ticketOpen_ticket').length);
				$('#openticketfframount').html($('.ticketOpen_ticket.FFR').length);
				$('#openticketplatinumamount').html($('.ticketOpen_ticket.Platinum').length);
				$('#openticketgoldamount').html($('.ticketOpen_ticket.Gold').length);
				$('#openticketbronzeamount').html($('.ticketOpen_ticket.Bronze').length);
				$('#openticketsilveramount').html($('.ticketOpen_ticket.Silver').length);
				$('#openticketuncategorizedamount').html($('.ticketOpen_ticket.Uncategorized').length);
				$('#modalResume').modal();
			});
		}(jQuery))
		</script>
		<script type='text/javascript' src='/js/padilibs/padi.dateTimes.js'></script>
		<script type='text/javascript' src='/js/aquarius/TS/tickets/ticketsmailtemplate.js'></script>
		<script type='text/javascript' src='/js/aquarius/TS/tickets/fu.js'></script>
		<script type='text/javascript' src='/js/aquarius/TS/tickets/tickets20210712.js'></script>
		<script type='text/javascript' src='/js/aquarius/TS/tickets/upstream.js'></script>
		<script type='text/javascript' src='/js/aquarius/TS/tickets/server.js'></script>
	</body>
</html>

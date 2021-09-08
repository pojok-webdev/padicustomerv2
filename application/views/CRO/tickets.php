<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" type="text/css" href="/css/teknis.css"/>
	<link rel="stylesheet" type="text/css" href="/js/autocomplete/styles.css"/>
	<link rel="stylesheet" type="text/css" href="/css/aquarius/upstream.css"/>
	<link rel="stylesheet" type="text/css" href="/css/padilibs/autocomplete/cosmetics.css"/>
	<?php $this->load->view('adm/head'); ?>
    <script type="text/javascript" src="/js/autocomplete/jquery.autocomplete.js"></script>    
    <script type="text/javascript" src="/js/padilibs/padi.autocomplete.js"></script>    
	<script type='text/javascript' src='/js/jquery.wysiwyg.js'></script>
	<body>
		<?php $this->load->view("TS/tickets/ticketmodals");?>
		<?php $this->load->view("TS/tickets/addTicket");?>
		<?php $this->load->view("modals")?>
		<?php $this->load->view("TS/tickets/upstream")?>
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
							<h1>Tickets CRO</h1>
							<span id="filterclientlabel">Client Category</span>
							<select name="filterclientcategory" id="filterclientcategory" class="headcomponent">
								<option value=" ">All</option>
								<option value="FFR">FFR</option>
								<option value="Platinum">Platinum</option>
								<option value="Gold">Gold</option>
								<option value="Silver">Silver</option>
								<option value="Bronze">Bronze</option>
							</select>
							<ul class="buttons">
								<li><span class="isw-question-mark btnhelp" id="btnhelp" title="Help"></span></li>
								<li><span class="isw-clean btnCleanFilter" id="btnCleanFilter" title="Bersihkan filter table"></span></li>
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
										<th width="15%">Nama</th>
										<th>Kategori</th>
										<th width="10%">Layanan</th>
										<th width="5%">Status</th>
										<th width="25%">Durasi</th>
										<th width="10%">Category</th>
										<th width="5%">Main Root Cause</th>
										<th width="5%">Site</th>
										<th width="5%">VAS</th>
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
										<?php $status = ($obj->status == "0") ? 'ticketOpen' : 'ticketClosed'; ?>
										<?php $alertflag = ($obj->alertflag == "0") ? 'noalert' : 'showalert'; ?>
										<tr thisid='<?php echo $obj->id; ?>' class="<?php echo $ticketclass . ' ' .$status . ' ' . $alertflag;?>">
											<td class="kdticket updatable" fieldName="kdticket"><?php echo $obj->kdticket; ?></td>
											<td class='clientname pointer'><?php echo $obj->clientname; ?></td>
											<td>
											<?php echo $obj->clientcategory; ?>
											</td>
											<td><span><?php echo $srv; ?></span></td>
											<td class="updatable" fieldName="status"><?php echo ($obj->status == "0") ? "Open" : "Closed"; ?></td>
											<td class="updatable" fieldName="duration"></td>
											<td><?php echo $obj->clientcategory; ?></td>
											<td><?php echo $obj->mainrootcause; ?></td>
											<td><?php echo $obj->address; ?></td>
											<td><?php echo $obj->vases; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="dr"><span></span></div>
			</div>
		</div>
		<script type='text/javascript' src='/js/aquarius/CRO/tickets/tickets.js'></script>
		<script type='text/javascript' src='/js/aquarius/TS/tickets/upstream.js'></script>
	</body>
</html>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<body>
	<?php $this->load->view("Sales/disconnections/modal");?>
    <div class="header">
        <a class="logo" href="index.html"><img src="/img/aquarius/logo.png" alt="PadiApp" title="PadiApp"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <?php $this->load->view('adm/menu');?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">PadiApp</a> <span class="divider">></span></li>
                <li><a href="#">Disconnection</a> <span class="divider">></span></li>
                <li class="active">List</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Disconnection</h1>
                        <ul class="buttons">
                            <li>
                                <a href="#"><span class="isw-settings"></span> </a>
                                <ul class="dd-list">
                                    <li><a href="/disconnections/index/0"><span class="isw-right"></span> Pengajuan</a></li>
                                    <li><a href="/disconnections/index/1"><span class="isw-right"></span> Sudah dilaksanakan</a></li>
                                    <li><a href="/disconnections/index/all"><span class="isw-right"></span> Semua</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/disconnections/add_lookup"><span class="isw-plus"></span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tDisconnections">
                            <thead>
                                <tr>
                                    <th width='15%'>Nama</th>
                                    <th width='7.5%'>AM</th>
                                    <th width="10%">Alamat</th>
                                    <th width="7.5%">Diajukan oleh</th>
                                    <th width="10%">Jenis</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Mulai</th>
                                    <th width="10%">Hingga</th>
                                    <th width="10%">Reaktivasi/Permanen</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($objs as $obj){?>
								<?php
								switch($obj->disconnectiontype){
									case '0':
									$disconnectiontype="Reaktivasi" ;
									$rdate = $obj->reactivationdate;
									break;
									case '1':
									$disconnectiontype="Isolir" ;
									$rdate = "-";
									break;
									case '2':
									$disconnectiontype="Temporer" ;
									$rdate = $obj->finishdate;
									break;
									case '3':
									$disconnectiontype="Permanen" ;
									$rdate = $obj->permanentdate;
									break;
								}
								switch($obj->status){
									case '0':
									$status="Dalam progress";
									break;
									case '1':
									$status="Sudah dilaksanakan";
									break;
									case '2':
									$status="Reactivation";
									break;
									case '3':
									$status="Reactivated";
									break;
								}
								?>
                                <tr myid='<?php echo $obj->client_id;?>'>
                                    <td><?php echo $obj->client->name;?></td>
                                    <td><?php echo $obj->client->user->username;?></td>
                                    <td><?php echo $obj->client->address;?></td>
                                    <td><?php echo $obj->createuser;?></td>
                                    <td class="disconnectiontype updatable" fieldName="disconnectiontype"><?php echo $disconnectiontype;?></td>
                                    <td class="status updatable" fieldName="status"><?php echo $status;?></td>
                                    <td class="dttmcheck"><?php echo $obj->startdate;?></td>
                                    <td class="finishdate  dttmcheck updatable" fieldname="finishdate"><?php echo $obj->finishdate;?></td>
                                    <td class="reactivation dttmcheck updatable" fieldname="reactivationdate"><?php echo $rdate;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle" <?php echo $this->common->grantElement($obj->client->user->id,"decessor")?> >Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<?php
													switch($disconnectiontype){
														case 'Permanen':
														?>
														<li class="btndetaildisconnection" resume="1"><a class="pointer">Detail</a></li>
														<?php
														break;
														case 'Temporer':
														?>
														<li class="btndetailtemporerdisconnection" resume="1"><a class="pointer">Detail</a></li>
														<li class="btnperpanjangandisconnection" resume="1"><a class="pointer">Perpanjangan</a></li>
														<li class="btnreaktifasidisconnection" resume="1"><a class="pointer">Aktifasi Kembali</a></li>
														<li class="btnpermanentdisconnection" resume="1"><a class="pointer">Berhenti Permanen</a></li>
														<?php
														break;
													}
												?>
											</ul>
										</div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div>
        </div>
    </div>
<script type='text/javascript' src='/js/aquarius/Sales/disconnections.js'></script>
</body>
</html>

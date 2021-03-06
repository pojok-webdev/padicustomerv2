<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<body>
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
                <li><a href="/">PadiApp</a> <span class="divider">></span></li>
                <li><a href="/clients">Pelanggan</a> <span class="divider">></span></li>
				<li><a href="#">Cabang Pelanggan</a> <span class="divider">></span></li>
                <li class="active">List</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Cabang Pelanggan <?php echo $clientname;?></h1>
                        <ul class="buttons">
                            <li>
                                <a href="#"><span class="isw-settings"></span> </a>
                                <ul class="dd-list">
                                    <li class="clientStatus" id="nonactiveclient" status="calon"><a><span class="isw-right"></span> Pelanggan belum aktif</a></li>
                                    <li class="clientStatus" id="activeclient" status="aktif"><a><span class="isw-right"></span> Pelanggan aktif</a></li>
                                    <li class="clientStatus" id="exclient" status="mantan"><a><span class="isw-right"></span> Mantan Pelanggan</a></li>
                                    <li class="clientStatus" id="all" status="all"><a><span class="isw-right"></span> Semua</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tClient">
                            <thead>
                                <tr>
                                    <th width='20%'>Nama</th>
                                    <th width='16%'>AM</th>
                                    <th width="20%">Alamat</th>
                                    <th width="20%">PIC</th>
                                    <th width="20%">E-mail/Phone</th>
                                    <th>status</th>
                                    <th width="4%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($objs as $obj){?>
								<?php
									$prestatus = ($obj->client->disconnection->status=="0")?"Pengajuan ":"";
									/*switch($obj->disconnection->disconnectiontype){
										case '3':
										$status = $prestatus . 'Permanen';
										break;
										case '1':
										$status = $prestatus . 'Isolir';
										break;
										case '2':
										$status = $prestatus . 'Temporer';
										break;
										default:
										$status = $prestatus . 'Aktif';
										break;
									}*/
									switch($obj->active){
										case "0":
										$status = "Tidak Aktif";
										break;
										case "1":
										$status = "Aktif";
										break;
									}
									$completetext = ($obj->fbcomplete==='1')?"(complete)":"";
								?>
                                <tr myid='<?php echo $obj->id;?>' clientid='<?php echo $obj->client->id;?>'>
                                    <td><?php echo $obj->client->name.' '.$completetext;?></td>
                                    <td><?php echo $obj->client->user->username;?></td>
                                    <td class="updatable" fieldName="address"><?php echo $obj->address;?></td>
                                    <td><?php echo $obj->pic_name;?></td>
                                    <td><?php echo $obj->pic_phone_area . ',  ' . $obj->pic_phone;?></td>
                                    <td class="updatable" fieldName="status"><?php echo $status;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  <?php echo $this->common->grantElement($obj->client->user->id,"decessor")?> >Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="btneditclient" resume="1"><a href="#">Edit</a></li>
												<li class="btnsurvey" resume="0"><a href="#">Survey</a></li>
												<li class="btninstallation" resume="2"><a href="#">Instalasi</a></li>
												<li class="divider survey_save"></li>
												<li class="btnactivate" resume="3"><a href="#">Aktifkan</a></li>
												<li class="btninactivate" resume="3"><a href="#">Jadikan Non Aktif</a></li>
												<li class="divider survey_save"></li>
												<li class="btnupgrade" resume="3"><a href="#">Upgrade/Downgrade</a></li>
												<li class="btndisconnection" resume="3"><a href="#">Diskoneksi</a></li>
												<li class="btntroubleshoot" resume="3"><a href="#">Troubleshoot</a></li>
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
<script type='text/javascript' src='/js/aquarius/Sales/client_sites.js'></script>
</body>
</html>

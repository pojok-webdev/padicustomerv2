<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head')?>
<script type='text/javascript' src='/js/aquarius/TS/installs/edit.js'></script>
<script src="/js/aquarius/TS/installs/install.padilibs.js"></script>
<body>
	<?php $this->load->view('TS/installs/dialogs');?>
    <div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="PadiApp" title="PadiApp"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
	<?php $this->load->view('adm/menu');?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="/">PadiApp</a> <span class="divider">></span></li>
                <li><a href="/install_requests">Install</a> <span class="divider">></span></li>
                <li class="active">Edit</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace" id="workplace" username = "<?php echo $this->session->userdata['username'];?>" client_id="<?php echo $obj->clientid;?>" install_id="<?php echo $obj->install_request_id;?>" install_site_id="<?php echo $obj->id;?>">
            <input type="hidden" id="install_site_id" name="install_site_id" value="<?php echo $this->uri->segment(3);?>" class="inp_switch inp_router">
            <input type="hidden" id="client_site_id" name="id" value="<?php echo $obj->client_site_id;?>" class="">
            <input type="hidden" id="install_request_id" name="id" value="<?php echo $obj->id;?>" class="installrequest">
            <input type="hidden" id="createuser" name="createuser" value="<?php echo $this->session->userdata["username"];?>" class="iim inp_switch installrequest inp_wireless inp_router">
            <div class="block-fluid without-head">
		<div class="toolbar clearfix">
			<div class="left">
				<span id="installstatus"><?php echo ($obj->status==='1')?'sudah selesai':'belum selesai';?></span>
			</div>
			<div class="right">
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn dropdown-toggle">Simpan <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a class='installSave pointer' value='<?php echo $obj->id;?>' clientstatus='9' installstatus='1'>Selesai</a></li>
						<li><a class='installSave pointer' value='<?php echo $obj->id;?>' clientstatus='5' installstatus='0'>Belum selesai</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="row-form clearfix">
                            <div class="span3">Trial</div>
                            <div class="span9">
                                <?php echo ($obj->withtrial==='1')?'Ya ('.$obj->trialdistance.' hari)':'Tidak';?>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Nama Pelanggan</div>
                            <div class="span9">
                                <?php echo form_input("client_id",$obj->clientname,"id='client_id' readonly");?>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Layanan</div>
                            <div class="span9">
                                <?php echo form_dropdown("service_id",$services,$obj->service_id,"id='service_id'");?>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Nama PIC</div>
                            <div class="span9"><input type="text" name="pic_name" id="pic_name" value="<?php echo $obj->pic_name;?>"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Telepon</div>
                            <div class="span2">
                                <input type="text" name="pic_phone_area" id="pic_phone_area" value="<?php echo $obj->pic_phone_area;?>"/>
                            </div>
                            <div class="span7">
                                <input type="text" name="pic_phone" id="pic_phone" value="<?php echo $obj->pic_phone;?>"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Jabatan PIC</div>
                            <div class="span9"><input type="text" name="pic_position" id="pic_position" value="<?php echo $obj->pic_position;?>"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Email</div>
                            <div class="span9"><input type="text" name="pic_email" id="pic_email" value="<?php echo $obj->pic_email?>"/></div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="row-form clearfix">
                            <div class="span3">Tgl Instalasi</div>
                            <?php
                            $installdate = $this->common->longsql_to_datepart($obj->install_date);
                            ?>
                            <div class="span5">
                                <input type="text" name="install_date" value="<?php echo (!is_null($obj->install_date))?$installdate['day'] . '/' . $installdate['month'] . '/' . $installdate['year']:'';?>" class="datepicker installsite installrequest iim " id='install_date' />
                            </div>
                            <div class="span2">
                                <?php echo form_dropdown('hour',$hours,$installdate['hour'],'id="hour" parent="install_date" class="dttime"');?>
                            </div>
                            <div class="span2">
                                <?php echo form_dropdown('minute',$minutes,$installdate['minute'],'id="minute" grandparent="install_date" class="dttime"');?>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Alamat Instalasi</div>
                            <div class="span9">
                                <input type="text" name="address" value="<?php echo $obj->address;?>" class="installsite  iim " id='install_address' />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Perijinan</div>
                            <div class="span9">
                                <select name='permit' id='permit' type="selectid"  class="installsite">
                                    <option value='1'>Ya</option>
                                    <option value='0'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Keterangan</div>
                            <div class="span9">
                                <textarea name="description" id="description" class="installsite myeditor"><?php echo $obj->description?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                </div>
                            </div>
                            <div class="right">
                                <div class="btn-group">
                                </div>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Alamat Pusat</div>
                            <div class="span9"><input type="text" name="address" id="address" value="<?php echo $obj->client_address;?>"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Kota</div>
                            <div class="span9"><input type="text" name="city" id="city" value="<?php echo $obj->client_city;?>"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <!--<div class="span12">-->
                                <div class="row-form">
                                </div>

                            </div>
                        <!--</div>-->
                    </div>
                </div>







                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>VAS</h4>
                        </div>
                        <div class="toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-warning tip btnAddVas" title="Hide">
                                        <span class="icon-plus icon-white"></span>
                                    </button>
                                    <button type="button" class="btn btn-small btn-danger tip btnAddVas" title="Delete">
                                        <span>Penambahan VAS</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <table cellpadding="0" cellspacing="0" width="100%" class="table tclientvases">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status VAS</th>
                                    <th width="40">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($client_vases as $vas){?>
                                <tr trid="<?php echo $vas->id;?>">
                                    <td class="info">
                                        <a class="fancybox" rel="group" ><?php echo $vas->name;?></a>
                                        <span class="removeattr"><?php echo $vas->toremovestatus;?></span>

                                    </td>
                                    <td><span class="implementattr"><?php echo $vas->implemented;?></span></td>
                                    <td>
                                        <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn dropdown-toggle" >
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li class='btn_edit pointer'>
                                                <a class="groupedit">Edit</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li class='pointer'>
                                                <a class="vasremove"><?php echo $vas->toremovemenu;?></a>
                                            </li>
                                        </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                </div>
                            </div>
                            <div class="right">
                                    <div class="pagination pagination-mini">
                                        <ul>
                                            <li class="disabled"><a>Total</a></li>
                                            <li class="disabled"><a id='totalvas'><?php echo $totalvas;?></a></li>
                                        </ul>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>
</div>

<div class="row-fluid">

	<div class="span6">
			<div class="block-fluid without-head">
					<div class="toolbar clearfix">
							<div class="left">
                            <span>VSD Files </span>
									<div class="btn-group">
									</div>
							</div>
							<div class="right">
									<div class="btn-group">
										<input id="sortpicture" type="file" name="sortpic" style="display:none" accept=".rtf, .vsd"/>
										<button id="fileupload" class="btn btn-small" type="button">Pilih File</button>
                                        <button id="upload" onclick="saveFile()" class="btn btn-small" type="button" style="display:none" >Upload</button>
									</div>
							</div>
					</div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table vsds">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vsds as $vas){?>
                                <tr trid="<?php echo $vas;?>">
                                    <td class="info">
                                        <a href="/install_requests/downloadtopologivsd/<?php echo substr($vas,28,strlen($vas)-28);?>">
                                            File: <?php echo substr($vas,28,strlen($vas)-28);?>
                                        </a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>

                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                </div>
                            </div>
                            <div class="right">
                                    <div class="pagination pagination-mini">
                                        <ul>
                                            <li class="disabled"><a>Total</a></li>
                                            <li class="disabled"><a id='totalvas'><?php echo $totalvas;?></a></li>
                                        </ul>
                                    </div>
                            </div>
                        </div>
			</div>
	</div>


                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="toolbar clearfix">
                            <div class="right">
                                <div class="btn-group">
                                </div>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">PIC</div>
                            <div class="span9">
                                <input type="text" name="pic_name" id="pic" value="<?php echo $obj->pic_name;?>" class="installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Jabatan PIC</div>
                            <div class="span9">
                                <input type="text" name="pic_position" id="pic_position" value="<?php echo $obj->pic_position;?>" class="installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Telepon</div>
                            <div class="span2"><input type="text" name="pic_phone_area" id="phone_area" value="<?php echo $obj->pic_phone_area;?>"/></div>
                            <div class="span7">
                                <input type="text" name="pic_phone" id="phone" value="<?php echo $obj->pic_phone;?>" class="installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Email</div>
                            <div class="span9">
                                <input type="text" name="pic_email" id="pic_email" value="<?php echo $obj->pic_email?>" class="installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Keterangan</div>
                            <div class="span9">
                                <textarea name="description" id="description" class="installsite myeditor" type="textarea"><?php echo $obj->description?>
                            </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Router</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addrouter" title="Tambah Router"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small tip btn_addrouter">Penambahan Router</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images " id="router">
                            <thead>
                                <tr>
                                    <th width="30%">Tipe</th>
                                    <th width="30%">Keterangan</th>
                                    <th width="30%">Lokasi</th>
                                    <th width="10%"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_routers['res'] as $router){?>
                                <tr myid='<?php echo $router->id;?>'>
                                    <td class="edit_router router_type"><?php echo $router->tipe;?></td>
                                    <td class="info"><a><?php echo $router->macboard;?></a> <span><?php echo $router->ip_public;?></span> <span><?php echo $router->ip_private;?></span></td>
                                    <td><?php echo $router->location;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  > Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="edit_router pointer"><a>Edit</a></li>
												<li class="divider"></li>
												<li class="remove_router pointer"><a>Hapus</a></li>
											</ul>
										</div>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								<span id="total_router">Total : <?php echo $install_routers['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>AP Wifi</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addapwifi" title="Tambah APWifi"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addapwifi">Penambahan AP Wifi</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table ap_wifi" id="ap_wifi">
                            <thead>
                                <tr>
                                    <th width="30%">Tipe</th>
                                    <th width="30%">Keterangan</th>
                                    <th width="30%">Lokasi</th>
                                    <th width="10%"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_apwifis['res'] as $wifi){?>
                                <tr thisid="<?php echo $wifi->id;?>">
                                    <td class="apwifi_tipe"><?php echo $wifi->tipe;?></td>
                                    <td class="info"><a>
                                        <?php echo $wifi->macboard;?></a> <span><?php echo $wifi->ip_address;?></span> <span><?php echo $wifi->essid;?></span>
                                    </td>
                                    <td class="apwifi_location"><?php echo $wifi->location;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  > Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="edit_apwifi pointer"><a>Edit</a></li>
												<li class="divider"></li>
												<li class="remove_apwifi pointer"><a>Hapus</a></li>
											</ul>
										</div>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id='total_wifi'><?php echo $install_apwifis['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Gambar Instalasi</h4>
                            <span id="status" ></span>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addinstallimage" title="Tambah Gambar" ><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addinstallimage">Penambahan Gambar Instalasi</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images gambar" id="install_image">
                            <thead>
                                <tr>
                                    <th width="20">Gambar</th>
                                    <th width="20">Nama</th>
                                    <th width="35">Keterangan</th>
                                    <th width="30"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_images['res'] as $image){?>
                                <tr class="rImage" image_id='<?php echo $image->id;?>' >
                                    <td class="image_path"><a class="fancyboxx" rel="group"><img src="<?php echo $image->img;?>" class="img-polaroid" onclick="viewImage(this)" width=50 height=38 /></a>
                                    </td>
                                    <td class="info image_name"><a class="fancybox" rel="group"</a> <span><?php echo $image->path;?></span> <span class="image_title"><?php echo $image->title;?></span></td>
                                    <td class="image_description"><?php echo $image->description;?></td>
                                    <td>
										<a><span class="icon-trash removeinstallimage pointer" ></span></a>
										<a><span class="icon-arrow-up switchup pointer"></span></a>
										<a><span class="icon-arrow-down switchdown pointer"></span></a>
										<a><span class="icon-pencil imageedit pointer"></span></a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_image"><?php echo $install_images['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Material Terpakai</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addmaterial" title="Tambah Material"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addmaterial">Penambahan Material</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table tbl_usedmaterial" id="tbl_usedmaterial">
                            <thead>
                                <tr>
                                    <th width="30%">Tipe</th>
                                    <th width="30%">Nama</th>
                                    <th width="30%">Keterangan</th>
                                    <th width="10%"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_materials['res'] as $material){?>
                                <tr thisid="<?php echo $material->id;?>">
                                    <td class="tipe"><?php echo $material->tipe;?></td>
                                    <td class="info"><a><?php echo $material->name;?></a> </td>
                                    <td class="description"><?php echo $material->description;?></td>
                                    <td>
										<a>
                                        <span class="icon-trash remove_material pointer" material_id="<?php echo $material->id; ?>" >
                                        </span>
                                        </a>
										<a>
                                        <span class="icon-edit edit_material pointer" material_id="<?php echo $material->id; ?>" >
                                        </span>
                                        </a>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id='total_material'><?php echo $install_materials['count'];?></span>
                            </div>
                        </div>
                    </div>
					<div class="block-fluid without-head">
						<div class="toolbar nopadding-toolbar clearfix">
							<h4>Resume</h4>
						</div>
						<div class="toolbar clearfix">
							<div class="left">
								<div class="btn-group">
									<button type="button" class="btn btn-small btn-danger tip svresume" title="Simpan">
										<span class="icon-plus icon-white"></span></button>
									<button type="button" class="btn btn-small svresume">Simpan</button>
								</div>
							</div>
						</div>
						<textarea class='myeditor' id='siteresume'><?php echo $obj->resume;?></textarea>
					</div>
                </div>
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Wireless Boards</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addwirelessradio" title="Add"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addwirelessradio">Penambahan Wireless Boards</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images" id="wirelessradio">
                            <thead>
                                <tr>
                                    <th width="60">Tipe</th>
                                    <th>Keterangan</th>
                                    <th width="80">ESSID</th>
                                    <th width="40"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_wireless_radios['res'] as $wirelessradio){ ?>
                                <tr thisid='<?php echo $wirelessradio->id;?>'>
                                    <td class="tipe_wireless_radio"><?php echo $wirelessradio->tipe;?></td>
                                    <td class="info"><a>Macboard: <?php echo $wirelessradio->macboard;?></a> <span>IP Radio : <?php echo $wirelessradio->ip_radio;?></span> <span><?php echo 'Frek.' . $wirelessradio->freqwency;?></span></td>
                                    <td class="tessid"><?php echo $wirelessradio->essid;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  > Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="edit_wireless_radio"><a>Edit</a></li>
												<li class="divider"></li>
												<li class="remove_wireless_radio"><a>Hapus</a></li>
											</ul>
										</div>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_wireless_radio"><?php echo $install_wireless_radios['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Switch</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addswitch" title="Add"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addswitch">Penambahan Switch</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images" id="tSwitch">
                            <thead>
                                <tr>
                                    <th width="60">Tipe</th>
                                    <th width="40">Keterangan</th>
                                    <th width="10"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_switches['res'] as $switch){ ?>
                                <tr thisid='<?php echo $switch->id;?>'>
                                    <td class="edit_switch"><?php echo $switch->name;?></td>
                                    <td class="info">
										<a>Jml Port: <?php echo $switch->port;?></a>
										<span>Managed : <?php echo ($switch->ismanaged==="1")?"Ya":"Tidak";?></span>
										<?php if($switch->ismanaged==="1"){?>
										<span><?php echo 'User/Password : ' . $switch->user . '/' . $switch->password;?></span>
										<?php }?>
                                    </td>
                                    <td>
										<a><span class="icon-trash pointer remove_switch" ></span></a>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_switch"><?php echo $install_switches['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Mini PCI</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addpccard" title="Add"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addpccard">Penambahan Mini PCI</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images" id="tblpccards">
                            <thead>
                                <tr>
                                    <th width="60">Nama</th>
                                    <th>Mac Address</th>
                                    <th width="40"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_pccards['res'] as $pccard){?>
                                <tr myid='<?php echo $pccard->id;?>'>
                                    <td><?php echo $pccard->name;?></td>
                                    <td class="info"><a>Macboard: <?php echo $pccard->macaddress;?></a> <span></td>
                                    <td>
										<a><span class="icon-trash pointer remove_pccard" pccard_id='<?php echo $pccard->id;?>' ></span></a>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_pccard"><?php echo $install_pccards['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Peralatan Lainnya</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addantenna" title="Add"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addantenna">Penambahan Peralatan Lainnya</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images" id="tblantennas">
                            <thead>
                                <tr>
                                    <th width="60">Tipe</th>
                                    <th>Lokasi</th>
                                    <th width="40"><span class="icon-th-large"></span></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_antennas['res'] as $antenna){?>
                                <tr myid='<?php echo $antenna->id;?>'>
                                    <td class="antenna_name"><?php echo $antenna->name;?></td>
                                    <td class="info"><a>Lokasi: <?php echo $antenna->location;?></a> <span></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  > Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="edit_antenna pointer"><a>Edit</a></li>
												<li class="divider"></li>
												<li class="remove_antenna pointer"><a>Hapus</a></li>
											</ul>
										</div>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_antenna"><?php echo $install_antennas['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Berita Acara, Serah Terima Barang, dan Form Kegiatan</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addba" title="Tambah" id="btn_addba"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addba">Penambahan BA dll</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images tBA" id="ba">
                            <thead>
                                <tr>
                                    <th width="30">File</th>
                                    <th width="60">Tanggal</th>
                                    <th width="60">Nama</th>
                                    <th width="80">Keterangan</th>
                                    <th width="20">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_bas['res'] as $ba){?>
                                <tr myid=<?php echo $ba->id;?>>
                                    <td>
										<a class="fancybox" rel="group" href="/install_requests/bapreview/<?php echo $ba->id;?>">
											<img src="<?php echo $ba->img;?>" class="img-polaroid baimg" width=50 height=38 />
										</a>
									</td>
                                    <td class='bacreatedate'><?php echo $this->common->sql_to_human_datetime($ba->createdate);?></td>
                                    <td class='baname'><?php echo $ba->name;?></td>
                                    <td class='badesc'><?php echo $ba->description;?></td>
                                    <td class="centered">
                                    <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-small dropdown-toggle">Aksi <span class="caret"></span></button>
                                            <ul class="dropdown-menu pull-right">
                                                <li class="pointer"><a class="edit_ba">Edit</a></li>
                                                <li class="divider"></li>
                                                <li class="pointer"><a class="remove_ba">Hapus</a></li>
                                            </ul>
                                    </div>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_ba"><?php echo $install_bas['count'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Petugas</h4>
                        </div>
                        <div class="toolbar clearfix paditablehead">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-danger tip btn_addofficer" title="Tambah" id="btn_addofficer"><span class="icon-plus icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn_addofficer">Penambahan Petugas</button>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images" id="officer">
                            <thead>
                                <tr>
                                    <th width="10%">Gambar</th><th width="80%">Nama</th><th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($install_installers['res'] as $installer){?>
                                <tr thisid="<?php echo $installer->id;?>">
                                    <td class="info">
										<a>
											<img src="<?php echo getfieldbyusername($installer->name,'pic');?>" width=20 height=20  class="img-polaroid" />
										</a>
                                    </td>
                                    <td class="info">
										<a><?php echo strtolower($installer->name);?></a>
                                    </td>
                                    <td>
										<a><span class="icon-trash pointer remove_installer" installer_name='<?php echo $installer->name;?>' ></span></a>
									</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            </div>
                            <div class="right">
								Total : <span id="total_installer"><?php echo $install_bas['count'];?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <script>
    $(".btnAddVas").click(function(){
		$("#dAddVAS").modal();
	});
    </script>
	<script type='text/javascript' src='/js/padilibs/padi.sendmail.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/install_edit.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/officers.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/images.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/ba.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/materials.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/wireless_radio.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/pccards.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/routers.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/apwifis.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/antennas.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/switch.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/resume.js'></script>
	<script type='text/javascript' src='/js/padilibs/padi.imagelib.js'></script>
	<script type='text/javascript' src='/js/aquarius/TS/installs/vsd.js'></script>
</body>
</html>

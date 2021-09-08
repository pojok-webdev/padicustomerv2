<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head')?>
<body>
    <div id="dModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Konfirmasi</h3>
        </div>
        <div class="modal-body">
            <p id="modalMessage">Data telah tersimpan.</p>
        </div>
    </div>
    <div id="dAddVAS" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Konfirmasi</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span12">
                    <div class="block-fluid without-head servicemodal">
                        <div class="row-form clearfix">
                            <div class="span3">Nama</div>
                            <div class="span9">
                                <?php echo form_dropdown("vas",$vases,1,"id='vas' class='inp_fb' type='selectid'");?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
        <div class="modal-footer">
            <button class="btn btnclose" id="btnvassave">Simpan</button>
            <button class="btn btnclose" id="btnvasupdate">Update</button>
            <button class="btn btnclose">Tutup</button>
        </div>
    </div>
    <div class="header" username="<?php echo $this->session->userdata['username'];?>">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="PadiApp" title="PadiApp"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
	<?php $this->load->view('adm/menu');?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">PadiApp</a> <span class="divider">></span></li>
                <li><a href="#">Install</a> <span class="divider">></span></li>
                <li class="active">Preview</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
		</div>
        <div class="workplace" id="workplace">
            <input type="hidden" name="createuser" id="createuser" value="<?php echo $this->session->userdata['username'];?>">
            <input type="hidden" name="client_id" id="client_id" value="<?php echo $obj->client_id;?>">
            <input type="hidden" name="client_site_id" id="client_id" value="<?php echo $obj->survey_site->client_site_id;?>" class="installsite installrequest">
            <input type="hidden" name="survey_request_id" value="<?php echo $obj->id;?>" class="installrequest" />
            <input type="hidden" name="createuser" value="<?php echo $this->ionuser->username;?>" class="installrequest installsite" />
            <div class="block-fluid without-head">
				<div class="toolbar clearfix">
					<div class="left">
						<span id="installstatus">Preview Pengajuan Instalasi</span>
					</div>
					<div class="right">
						<div class="btn-group">
							<button class="btn dropdown-toggle preview_save" id="preview_save">Ajukan Instalasi
							</button>
						</div>
					</div>
				</div>
			</div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="row-form clearfix">
                            <div class="span3">Nama Pelanggan</div>
                            <div class="span9">
								<?php echo form_input("client_id",$obj->client->name,'id="client_name" readonly class="installrequest"');?>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Layanan</div>
                            <div class="span9">
								<?php echo form_dropdown("service_id",$services,$obj->service_id,'id="service_id" class="installsite installrequest" type="selectid"');?>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Nama PIC</div>
                            <div class="span9">
								<input type="text" name="pic_name" id="pic_name" value="<?php echo $obj->pic_name;?>" class="installrequest installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Telepon</div>
                            <div class="span2">
								<input type="text" name="pic_phone_area" id="pic_phone_area" value="<?php echo $obj->pic_phone_area;?>" class="installrequest installsite"/>
							</div>
                            <div class="span7">
								<input type="text" name="pic_phone" id="pic_phone" value="<?php echo $obj->pic_phone;?>" class="installrequest installsite"/>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Jabatan PIC</div>
                            <div class="span9"><input type="text" name="pic_position" id="pic_position" value="<?php echo $obj->pic_position;?>" class="installrequest installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Email</div>
                            <div class="span9">
								<input type="text" name="pic_email" id="pic_email" value="<?php echo $obj->pic_email?>" class="installrequest installsite"/>
							</div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="block-fluid without-head">
                        <div class="row-form clearfix">
                            <div class="span3">Tgl Instalasi</div>
                            <div class="span5">
                                <input type="text" name="install_date" value="" class="datepicker installrequest installsite emptycheck" id='install_date' />
                            </div>
							<div class="span2">
								<?php echo form_dropdown('hour',$hours,"8",'id="hour" parent="install_date" class="dttime" parent="install_date"');?>
							</div>
							<div class="span2">
								<?php echo form_dropdown('minute',$minutes,"00",'id="minute" grandparent="install_date" class="dttime" grandparent="install_date"');?>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Perijinan</div>
                            <div class="span9">
								<select name='permit' id='permit' class="installrequest installsite emptycheck" type="selectid">
									<option value='1'>Ya</option>
									<option value='0'>Tidak</option>
								</select>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Keterangan</div>
                            <div class="span9">
								<textarea name="description" id="description" class="installrequest_ installsite_ myeditor" type="textarea"><?php echo $obj->description?></textarea>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Ada Trial ?</div>
                            <div class="span9">
								<select id="withtrial" name="withtrial" class="installrequest" type="selectid">
									<option value="2">Pilihlah</option>
									<option value="1">Ya</option>
									<option value="0">Tidak</option>
								</select>
							</div>
                        </div>
                        <div class="row-form clearfix" id="dtrialrange">
                            <div class="span3">Lama Trial</div>
                            <div class="span9">
								<select id="trialrange">
									<?php for($c=1;$c<=31;$c++){
									echo '<option value='.$c.'>'.$c.' hari</option>';
									 }?>
								</select>
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
                            <div class="span3">Alamat</div>
                            <div class="span9">
								<input type="text" name="address" id="address" value="<?php echo $obj->address;?>" class="installsite"/>
							</div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Kota</div>
                            <div class="span9">
								<input type="text" name="city" id="city" value="<?php echo $obj->client->city;?>" class="installsite"/>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Kategori</div>
                            <div class="span9">
								<?php echo form_dropdown("category",$categories,$obj->client->clientcategory,"id='clientcategory'");?>
                            </div>
                        </div>
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
                                    <th width="40">Actions</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($client_vases as $vas){?>
                                <tr trid="<?php echo $vas->vas_id;?>">
                                    <td class="info">
                                        <a class="fancybox vasname" rel="group" ><?php echo $vas->name;?></a> 
                                        <span></span> 
                                        <span></span>
                                    </td>
                                    <td>
                                        <a ><span class="icon-pencil vasedit"></span></a>
                                        <a ><span class="icon-remove vasremove"></span></a>
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
        </div>
    </div>
    <iframe frameborder="0" width="500" height="400"></iframe>
    <script type='text/javascript' src='/js/padilibs/padi.sendmail.js'></script>
    <script type='text/javascript' src='/js/aquarius/Sales/installs/order_preview.js'></script>
</body>
</html>

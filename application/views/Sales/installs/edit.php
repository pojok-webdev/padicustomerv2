<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head')?>
<style>
.removeattr{
    color:blue;
}
</style>
<script type='text/javascript' src='/js/aquarius/salesinstall_edit.js'></script>
<body>
    <div id="dModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Konfirmasi</h3>
        </div>
        <div class="modal-body">
            <p>Data telah tersimpan.</p>
        </div>
    </div>
    <div id="dAddVAS" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Penambahan VAS</h3>
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
            <button class="btn btnclose">Tutup</button>
        </div>
    </div>
    <div class="header" username="<?php echo $this->session->userdata['username'];?>">
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
                <li><a href="/install_requests">Install</a> <span class="divider">></span></li>
                <li class="active">Edit</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>            
		</div>
        <div class="workplace" id="workplace" >
            <input type="hidden" id="client_id" name="client_id" value="<?php echo $obj->clientid;?>">
            <input type="hidden" id="install_id" name="install_id" value="<?php echo $obj->install_request_id;?>" class="">
            <input type="hidden" id="install_request_id" name="install_request_id" value="<?php echo $obj->install_request_id;?>" class="">
            <input type="hidden" id="install_site_id" name="install_site_id" value="<?php echo $obj->id;?>">
            <input type="hidden" id="username" name="username" value="<?php echo $this->session->userdata['username'];?>">
            <div class="block-fluid without-head">                        
				<div class="toolbar clearfix">
					<div class="left">
						<span id="installstatus"><?php echo ($obj->status==1)?'Selesai':'Belum selesai';?></span>
					</div>
					<div class="right">
						<div class="btn-group">
							<button class="btn dropdown-toggle install_save" status="5" >Simpan 
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
				<?php echo form_input("client_id",$obj->clientname,"id='client_id' readonly");?>
			</div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Layanan</div>
			<div class="span9">
				<?php echo form_dropdown("service_id",$services,$obj->service_id,"id='service_id' class='installrequest installsite' type='selectid'");?>
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
                            <div class="span9"><input type="text" name="pic_position" id="pic_position" value="<?php echo $obj->pic_position;?>" class="installrequest installsite"/></div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Email</div>
                            <div class="span9"><input type="text" name="pic_email" id="pic_email" value="<?php echo $obj->pic_email?>" class="installrequest installsite"/></div>
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
							<div class="span5"><input type="text" name="install_date" value="<?php echo (!is_null($obj->install_date))?$installdate['day'] . '/' . $installdate['month'] . '/' . $installdate['year']:'';?>" class="datepicker installrequest installsite" id='install_date' />
							</div>
							<div class="span2">
								<?php echo form_dropdown('hour',$hours,$installdate['hour'],'id="hour" parent="install_date" class="dttime" parent="install_date"');?>
							</div>
							<div class="span2">
								<?php echo form_dropdown('minute',$minutes,$installdate['minute'],'id="minute" grandparent="install_date" class="dttime" grandparent="install_date"');?>
							</div>
						</div>
						<div class="row-form clearfix">
							<div class="span3">Alamat Instalasi</div>
							<div class="span9">
								<input type="text" name="address" value="<?php echo $obj->client_site_address;?>" class="installsite  iim " id='install_address' />
							</div>
						</div>
						<div class="row-form clearfix">
							<div class="span3">Perijinan</div>
								<div class="span9">
									<select name='permit' id='permit' class="installrequest installsite" type="selectid">
										<option value='1'>Ya</option>
										<option value='0'>Tidak</option>
									</select>
								</div>
							</div>                        
						<div class="row-form clearfix">
									<div class="span3">Keterangan</div>
									<div class="span9">
										<textarea name="description" id="description" class="installrequest installsite myeditor" type="textarea"><?php echo $obj->description?>
										</textarea>
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
                            <div class="span9"><input type="text" name="address" id="address" value="<?php echo $obj->client_address;?>"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Kota</div>
                            <div class="span9"><input type="text" name="city" id="city" value="<?php echo $obj->client_city;?>"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span3">Kategori</div>
                            <div class="span9">
								<?php echo form_dropdown("category",$categories,$obj->clientcategory,"id='clientcategory'");?>
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
                                    <button type="button" class="btn btn-small btn-warning tip btnAddVas" title="Penambahan VAS">
                                        <span class="icon-plus icon-white"></span>
                                    </button>
                                    <button type="button" class="btn btn-small btn-danger tip btnAddVas" title="Penambahan VAS">
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
        </div>
    </div>   
    <iframe frameborder="0" width="500" height="400"></iframe>
</body>
</html>

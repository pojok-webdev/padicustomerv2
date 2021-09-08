<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<script type='text/javascript' src='/js/aquarius/radu.js'></script>
<script type='text/javascript' src='/js/aquarius/aps.js'></script>
<body>
    <div id="dconfirmation" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <h3 id="myModalLabel"> Konfirmasi</h3>
        </div>
        <div class="modal-body">
			<p><b>Peringatan !</b></p>
            <p>Anda hendak menghapus <span id="modal_ap_name"></span> (id = <span id="modal_ap_id"></span>) dari daftar AP</p>
            <p>Apakah anda yakin ?</p>
            <p></p>
            <p>
		<div class="button-group">
			<button type="button" class="btn btn-small btn-warning tip modalclose" id="modal_ap_remove"><span class="icon-ok"></span> Yakin</button>
			<button type="button" class="btn btn-small btn-warning tip modalclose" id="cancel_install_save"><span class="icon-remove"></span> Tidak</button>
		</div>
	</p>
        </div>
    </div>
    <?php $this->load->view('adm/apsmodal')?>
    <div class="header">
        <a class="logo" href="/"><img src="/img/path/logo.png" alt="padiApp" title="padiApp"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <?php $this->load->view('adm/menu');?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">PadiApp</a> <span class="divider">></span></li>
                <li><a href="#">APs</a> <span class="divider">></span></li>
                <li class="active">List</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace" id="workplace" username="<?php echo $this->session->userdata['username'];?>">
        <input type="hidden" name="username" id="username" value="<?php echo $this->session->userdata['username'];?>" />
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Daftar AP</h1>
                        <ul class="buttons">
                            <li><a href="#" class="isw-plus" id="addap"></a></li>
                        </ul>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table aps" id="tAP">
                            <thead>
                                <tr>
                                    <th width="6%">ID</th>
                                    <th width="31%">Nama</th>
                                    <th width="25%">BTS</th>
                                    <th width="31%">Keterangan</th>
                                    <th width="7%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                    			<?php foreach($objs as $obj){?>
                                <tr thisid="<?php echo $obj->id;?>">
                                    <td class="apid"><?php echo $obj->id;?></td>
                                    <td class="apname"><?php echo $obj->name;?></td>
                                    <td class="aptowername"><?php echo $obj->btstowername;?></td>
                                    <td class="apdescription"><?php echo $obj->description;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle" >Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="editap"><a href="#">Edit AP</a></li>
												<li class="remove_ap" ><a>Hapus AP</a></li>
												<li class="showclients" ><a href="/paps/clients/<?php echo $obj->id;?>">Lihat Pelanggan</a></li>
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
</body>
</html>

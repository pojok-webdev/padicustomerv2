<!DOCTYPE html>
<html lang="en">
<style>
. pointer{
    cursor:pointer;
}
</style>
<?php $this->load->view('adm/head');?>
<?php $this->load->view('shared/confirmmodal');?>
<?php $this->load->view('adm/changeclientaliasmodal');?>
<?php $this->load->view('adm/changeCategoryModal');?>
<?php $this->load->view('adm/clients/changeAM');?>
<?php $this->load->view('adm/clients/mergeAsSite');?>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="PadiNET App" title="PadiNET App"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <?php $this->load->view('adm/menu');?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">PadiApp</a> <span class="divider">></span></li>
                <li><a href="#">Pelanggan</a> <span class="divider">></span></li>
                <li class="active">List</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
		<?php $this->load->view('adm/clients/addModal');?>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Pelanggan</h1>
                        <ul class="buttons">
                            <li>
                                <a href="#"><span class="isw-plus" id="btnaddclient"></span> </a>
                            </li>
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
                                    <th>ID</th>
                                    <th width="19%">Nama</th>
                                    <th>Alias</th>
                                    <th>Kategori</th>
                                    <th width="19%">AM</th>
                                    <th width="19%">Alamat</th>
                                    <th width="19%" class='pic'>PIC</th>
                                    <th width="19%" class='phone'>E-mail/Phone</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($objs as $obj){?>
                                <tr myid='<?php echo $obj->id;?>' sale_id='<?php echo $obj->sale_id;?>'>
                                    <td><?php echo $obj->id;?></td>
                                    <td class="clientname"><?php echo $obj->name;?></td>
                                    <td class="clientalias"><?php echo $obj->alias;?></td>
                                    <td class="clientcategory"><?php echo $obj->clientcategory;?></td>
                                    <td class="am"><?php echo $obj->username;?></td>
                                    <td class='address'><?php echo $obj->address;?></td>
                                    <td><?php //echo $obj->pic->name;?></td>
                                    <td class='phone'><?php echo $obj->phone_area . ',  ' . $obj->phone;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  <?php echo $this->common->grantElement($obj->userid,"everyone")?> >Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="btneditclient"><a href="#">Edit</a></li>
                                                <li class="divider"></li>
												<li class="btneditpic pointer" ><a>Edit PIC (Popup)</a></li>
                                                <li class="btneditalias pointer"><a>Edit Alias</a></li>
                                                <li class="btneditcategory pointer"><a>Edit Category</a></li>
                                                <li class="btneditam pointer"><a>Edit AM</a></li>
                                                <li class="divider"></li>
												<li class="btnmergeassite pointer" ><a>Gabungkan sebagai Site</a></li>
                                                <li class="divider"></li>
												<li class="btnsetnonactive pointer" ><a>Set Non Aktif</a></li>
                                                <li class="divider"></li>
												<li class="btnviewsites pointer" ><a href="#">Lihat Cabang</a></li>
												<li class="divider survey_save"></li>
												<li class="btnsurvey pointer"><a href="#">Survey</a></li>
                                                <li class="divider"></li>
                                                <li class="remover pointer"><a>Delete</a></li>
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
<script type='text/javascript' src='/js/aquarius/adm/clients/clients.js'></script>
</body>
</html>

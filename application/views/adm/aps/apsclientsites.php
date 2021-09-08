<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<script type='text/javascript' src='/js/aquarius/radu.js'></script>
<script type='text/javascript' src='/js/aquarius/aps.js'></script>
<body>
    <?php $this->load->view('adm/aps/apsclientsitesmodal')?>
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
                <li><a href="/">PadiApp</a> <span class="divider">></span></li>
                <li><a href="/main/aps">APs</a> <span class="divider">></span></li>
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
                        <h1>Daftar Pelanggan dalam AP</h1>
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
                                    <th width="25%">Alamat</th>
                                    <th width="7%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                    			<?php foreach($objs as $obj){?>
                                <tr thisid="<?php echo $obj->id;?>">
                                    <td class="apid"><?php echo $obj->id;?></td>
                                    <td class="apname"><?php echo $obj->name;?></td>
                                    <td class="aptowername"><?php echo $obj->address;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle" >Aksi <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li class="remove_client" ><a>Hapus Pelangan</a></li>
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

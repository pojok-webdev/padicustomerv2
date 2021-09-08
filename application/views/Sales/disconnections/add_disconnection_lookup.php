<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<body>
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
                <li><a href="/disconnections">disconnections</a><span class="divider">></span></li>
                <li class="active">Look up</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Pilih Pelanggan untuk Diskoneksi</h1>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tDisconnection">
                            <thead>
                                <tr>
                                    <th width="25%">Name</th>
                                    <th width="20%">AM</th>
                                    <th width="25%">Alamat</th>
                                    <th width="25%">E-mail/Phone</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($objs as $obj){?>
                                <tr>
                                    <td><?php echo $obj->name;?>(<?php echo $obj->id;?>)</td>
                                    <td><?php echo $obj->username;?></td>
                                    <td><?php echo $obj->address;?></td>
                                    <td><?php echo $obj->phone_area . ' - ' . $obj->phone;?></td>
                                    <td>
										<div class="btn-group">
											<button class="btn dodisconnect" client_id='<?php echo $obj->id;?>' <?php echo $this->common->grantElement($obj->userid,"decessor")?> >Ajukan Diskoneksi</button>
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
    <script type='text/javascript' src='/js/aquarius/Sales/disconnections/add_disconnection_lookup.js'></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<style>
	.btnsetam{
		cursor:pointer;
	}
	.btnsetam_{
		cursor:not-allowed;
	}
	.submenuheader{
		background: darkgray;
		color: white;
		cursor: arrow;
	}
	.submenuheader a {
		background: darkgray;
		color: white;
		cursor: arrow;
	}
</style>
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
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-download" id="download-client"></div>
                        <h1>Pelanggan</h1>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tClient">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th width='19%'>Nama</th>
                                    <th width='19%'>Alias</th>
                                    <th width='5%'>AM</th>
                                    <th width='14%'>Category</th>
                                    <th width="19%">Alamat</th>
                                    <th width="19%">PIC</th>
                                    <th width="5%">E-mail/Phone</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($objs as $obj){?>
                                <tr myid='<?php echo $obj->id;?>'>
                                    <td><?php echo $obj->id;?></td>
                                    <td class='name'><?php echo $obj->name;?></td>
                                    <td class='alias'><?php echo $obj->alias;?></td>
                                    <td class='am'><?php echo $obj->billing;?></td>
                                    <td><?php echo $obj->adm;?></td>
                                    <td><?php echo $obj->resp;?></td>
                                    <td><?php echo $obj->teknis;?></td>
                                    <td><?php echo $obj->support;?></td>
                                    <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-small dropdown-toggle" >Aksi <span class="caret"></span></button>
                                            <ul class="dropdown-menu pull-right">
                                                <li class="submenuheader"><a><?php echo $obj->name;?></a></li>
                                                <li class="btneditclient pointer"><a>Edit</a></li>
                                                <li class="btnviewsites pointer" ><a>Lihat Cabang</a></li>
                                                <li class="divider"></li>
                                                <li class="btneditalias pointer"><a>Edit Name & Alias</a></li>
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
<script type='text/javascript' src='/js/aquarius/Sales/clients.js'></script>
<script>
$('#download-client').click(function(){
    window.location.href = '/clients/clientdownload'
});
</script>
</body>
</html>

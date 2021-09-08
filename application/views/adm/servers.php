<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<script type='text/javascript' src='/js/aquarius/radu.js'></script>
<body>
    <?php $this->load->view('adm/servers/removeconfirmation');?>
    <?php $this->load->view('adm/serversmodal')?>
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
                <li><a href="#">Servers</a> <span class="divider">></span></li>
                <li class="active">List </li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace" id="workplace" username="<?php echo $this->session->userdata['username'];?>">
        <input type="hidden" name="username" id="username" value="<?php echo $this->session->userdata['username'];?>" />
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Daftar Server</h1>
                        <ul class="buttons">
                            <li><a href="#" class="isw-plus" id="addserver"></a></li>
                        </ul>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table servers" id="tServer">
                            <thead>
                                <tr>
                                    <th width="6%">ID</th>
                                    <th width="31%">Nama</th>
                                    <th width="25%">IP Addr</th>
                                    <th width="31%">Keterangan</th>
                                    <th width="7%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                    			<?php foreach($objs['res'] as $obj){?>
                                <tr thisid="<?php echo $obj->id;?>">
                                    <td class="serverid"><?php echo $obj->id;?></td>
                                    <td class="server_name"><?php echo $obj->name;?></td>
                                    <td class="ipaddr"><?php echo $obj->ipaddr;?></td>
                                    <td class="description"><?php echo $obj->description;?></td>
                                    <td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-small dropdown-toggle" >
                                            Aksi 
                                            <span class="caret"></span>
                                            </button>
											<ul class="dropdown-menu pull-right">
												<li class="edit_server"><a href="#">Edit Server</a></li>
												<li class="remove_server" ><a>Hapus Server</a></li>
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
    <script type='text/javascript' >
    getUserName = function(){
        return  "<?php echo $this->session->userdata['username'];?>"
    }
    </script>
    <script type='text/javascript' src='/js/aquarius/servers.js'></script>
</body>
</html>

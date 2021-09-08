<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="/css/padilibs/autocomplete/cosmetics.css" />
	<link rel="stylesheet" href="/asset/jquery/easyautocomplete/easy.autocomplete.css" />
	<?php $this->load->view('adm/head');?>
	<script src="/asset/jquery/easyautocomplete/easy.autocomplete.js"></script>
	<script>var clientgroup_id=<?php echo $clientgroup_id;?></script>
    <?php $this->load->view('Sales/clientgroups/detailDialogs');?>
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
			<li><a href="/clientgroups">Grup Pelanggan</a> <span class="divider">></span></li>
			<li class="active">Detail</li>
		</ul>
		<?php $this->load->view('adm/buttons');?>
		</div>
		<div class="workplace">
		<div class="row-fluid">
		<div class="span12">
		<div class="head clearfix">
		<div class="isw-grid"></div>
		<h1>Grup Pelanggan : <?php echo $name;?></h1>
		<?php if($this->session->userdata["role"]==="Sales"){?>
		<ul class="buttons">
			<li><span class="isw-plus" id="penambahangroup" data-toggle="modal" data-target="#dAddClient"></span></li>
		</ul>
		<?php } ?>
		</div>
		<div class="block-fluid table-sorting clearfix">
		<table cellpadding="0" cellspacing="0" width="100%" class="table" id="tClientGroups">
		<thead>
		<tr>
			<th width="90%">Nama</th>
			<th width="10%">Layanan</span></th>
			<th width="90%">AM</th>
			<th width="10%">Alamat</span></th>
			<th width="10%">PIC</span></th>
			<th width="10%">Biaya</span></th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($objs as $obj){?>
			<tr thisid='<?php echo $obj->clientid;?>'>
				<td class="groupname"><?php echo $obj->name;?></td>
				<td title='<?php echo $obj->services;?>' class='tt'><?php echo substr($obj->services,0,20);?></td>
				<td><?php echo $obj->am;?></td>
				<td><?php echo $obj->address;?></td>
				<td title='<?php echo $obj->pic;?>' class='tt'><?php echo substr($obj->pic,0,20);?></td>
				<td><?php echo $obj->dpp;?></td>
				<td>
				<div class="btn-group">
				<button data-toggle="dropdown" class="btn dropdown-toggle" >Action <span class="caret"></span></button>
				<ul class="dropdown-menu pull-right">
					<li class='btnReport pointer'>
						<a class="removeClient">Hapus</a>
					</li>
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
    <script src="/js/aquarius/Sales/clientgroups/detail.js"></script>
</html>

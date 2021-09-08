<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="/css/padilibs/autocomplete/cosmetics.css" />
	<link rel="stylesheet" href="/asset/jquery/easyautocomplete/easy.autocomplete.css" />
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="/asset/jquery/easyautocomplete/easy.autocomplete.js"></script>

	<?php $this->load->view('adm/head');?>
    <script type="text/javascript" src="/js/padilibs/padi.autocomplete.js"></script>
    <?php $this->load->view('Sales/clientgroups/dialogs');?>
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
			<li><a href="/clietgroups">Grup Pelanggan</a> <span class="divider">></span></li>
			<li class="active">List</li>
		</ul>
		<?php $this->load->view('adm/buttons');?>
		</div>
		<div class="workplace">
		<div class="row-fluid">
		<div class="span12">
		<div class="head clearfix">
		<div class="isw-grid"></div>
		<h1>Grup Pelanggan </h1>
		<?php if($this->session->userdata["role"]==="Sales"){?>
		<ul class="buttons">
			<li><span class="isw-plus" id="penambahangroup"></span></li>
		</ul>
		<?php } ?>
		</div>
		<div class="block-fluid table-sorting clearfix">
		<table cellpadding="0" cellspacing="0" width="100%" class="table" id="tClientGroups">
		<thead>
		<tr>
			<th width="45%">Nama</th>
			<th width="45%">Keterangan</th>
			<th width="10%">Aksi</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($objs as $obj){?>
			<tr thisid='<?php echo $obj->id;?>'>
				<td class="groupname"><?php echo $obj->name;?></td>
				<td class="description"><?php echo $obj->description;?></td>
				<td>
				<div class="btn-group">
				<button data-toggle="dropdown" class="btn dropdown-toggle" >Action <span class="caret"></span></button>
				<ul class="dropdown-menu pull-left">
					<li class='btn_edit pointer'>
					<a class="groupedit">Edit</a>
					</li>
					<li class="divider"></li>
					<li class='btnReport pointer'>
					<a class="addClient">Penambahan Pelanggan</a>
					</li>
					<li class='btnReport pointer'>
					<a class="viewDetail">Detail Pelanggan</a>
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
    <script src="/js/aquarius/Sales/clientgroups/index.js"></script>
</html>

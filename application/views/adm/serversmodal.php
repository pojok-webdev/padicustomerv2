<div id="dAddServer" class="modal hidex fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3><span id="penambahanserverlabel">Penambahan Server</span></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">Nama</div>
						<div class="span9"><?php echo form_input('server_name','','id="server_name"');?></div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">IP Address</div>
						<div class="span9"><?php echo form_input('ipaddress','','id="ipaddress"');?></div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Description</div>
						<div class="span9">
							<input type='text' name='description' id='description'>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<button class="btn closemodal" type="button" id='save_server'>Simpan</button>
			<button class="btn closemodal" type="button" id='update_server'>Update</button>
			<button class="btn closemodal" type="button">Tutup</button>
		</div>
	</div>
</div>

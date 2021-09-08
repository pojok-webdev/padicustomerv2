<div id="dAddServer" class="modal hide fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
				<h4 id="addUpstreamTitle">Penambahan Tiket Server</h4>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">						
						<div class="block-fluid without-head">
							<div class="row-form clearfix">
								<div class="span4">Nama Server</div>
								<div class="span8">
									<select id="servername" class="servername">
										<?php foreach($servers['res'] as $server){?>
										<option value="<?php echo $server->id;?>"><?php echo $server->name;?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="row-form clearfix">
								<div class="span3">Date:</div>
								<div class="span9"><input type="text" class="mask_date" id="startServerTiicket"/> 
								<span>Format: mm/dd/YYYY</span></div>
							</div>                         

							<div class="row-form clearfix">
								<div class="span4">End</div>
								<div class="span8">
									<input type="text"  class="mask_date"  id="stopServerTiicket" />
								</div>
							</div>
							<div class="row-form clearfix">
								<div class="span4">Permasalahan</div>
								<div class="span8">
									<input type="text" id="serverproblem">
								</div>
							</div>
							<div class="row-form clearfix" id="dserverdescription">
								<div class="span4">Keterangan</div>
								<div class="span8">
									<textarea type="text" id="serverdescription" class="myeditor"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn closeModal" id="btnsaveservertrouble">Simpan</button>
				<button type="button" data-dismiss="modal" class="btn closeModal" >Tutup</button>
			</div>
		</div>
	</div>
</div>

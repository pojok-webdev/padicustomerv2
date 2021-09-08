<div id="emptyMandatoryWarn" class="modal hide" role="dialog" title="Penambahan Kompetitor">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	</div>
	<div class="modal-body">
		<div>
		<label id="lblWarning"></label>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btnclose">Tutup</button>
	</div>
	<p></p>
</div>
<div id="clue-dragdrop" class="modal hide" role="dialog" title="Penambahan Kompetitor">
	<div class="modal-bodyx">
	<img src="/img/clueDragDrop.png" width="100%"/>
		<button class=" btnclose">Tutup</button>
	</div>
</div>
<div id="dAddService" class="modal hide" role="dialog" title="Penambahan Layanan">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">Kategori Layanan</div>
						<div class="span9">
							<?php echo form_dropdown("servicecategories",$servicecategory,1,"id='servicecategories' class='inp_fb' type='selectid' id='servicecategory'");?>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Custom</div>
						<div class="span9">
							<textarea id='servicedescription'></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btnclose" id="btnservicesave">Simpan</button>
		<button class="btn btnclose">Tutup</button>
	</div>
	<p></p>
</div>

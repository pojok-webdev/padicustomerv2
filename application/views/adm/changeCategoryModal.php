<div id="changecategorymodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myChangeCategoryModalLabel">Perubahan Kategori</h3>
    </div>
    <div class="modal-body">
    <div class='row-fluid'>
					<div class="span12">
						<div class="without-head">
							<div class="row-form clearfix">
								<div class="span4">Nama:</div>
								<div class="span8">
									<?php echo form_dropdown('category',$clientcategories,1,'id="clientcategory"');?>
								</div>
							</div>
						</div>
					</div>
				</div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id="btnsavecategory">Yes</button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
    </div>
</div>

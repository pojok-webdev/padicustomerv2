<div id="dAddProduct" class="modal hide" role="dialog" title="Penambahan Produk">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3>Penambahan Produk</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head servicemodal">
					<div class="row-form clearfix">
						<div class="span3">Nama Produk</div>
						<div class="span9">
							<?php echo form_dropdown("products",$products,1,"id='product_products' type='selectid' id='products'");?>
						</div>
					</div>
					<div class="row-form clearfix pdevice">
						<div class="span3">Perangkat</div>
						<div class="span9">
							<?php echo form_dropdown("devices",$devicecategories,1,"id='product_devicescategory' class='product_detail'");?>
						</div>
					</div>
					<div class="row-form clearfix pvas">
						<div class="span3">VAS</div>
						<div class="span9">
							<?php echo form_dropdown("vascategories",$vascategories,1,"id='product_vasescategory' class='product_detail'");?>
						</div>
					</div>
					<div class="row-form clearfix pservice">
						<div class="span3">Internet</div>
						<div class="span9">
							<?php echo form_dropdown("internetcategories",$internetcategories,1,"id='product_internetcategory' class='product_detail'");?>
						</div>
					</div>
					<div class="row-form clearfix pservice">
						<div class="span3">Internet Detail</div>
						<div class="span9">
							<?php echo form_dropdown("internet",$internets,1,"id='product_internet' class='product_detail'");?>
						</div>
					</div>
					<div class="row-form clearfix pservice">
						<div class="span3">VAS Detail</div>
						<div class="span9">
							<?php echo form_dropdown("vases",$vases,1,"id='product_vases' class='product_detail'");?>
						</div>
					</div>
					<div class="row-form clearfix pdevice">
						<div class="span3">Perangkat Detail</div>
						<div class="span9">
							<?php echo form_dropdown("devices",$devices,1,"id='product_devices' class='product_detail'");?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btnclose" id="product_btnservicesave">Simpan</button>
		<button class="btn btnclose">Tutup</button>
	</div>
	<p></p>
</div>


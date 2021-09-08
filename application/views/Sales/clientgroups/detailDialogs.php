<style type="text/css">
.eac-square input {
  background-image: url("./asset/jquery/easyautocomplete/images/icon_search.png");
  background-repeat: no-repeat;
  background-position: right 10px center;
}
</style>

<div id="dAddClient" class="modal hidex fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="groupModalLabel">Penambahan Pelanggan pada Group</h3>
	</div>
	<div class="modal-body">
	<div class="row-fluid">
		<div class="span12">
			<div class="block-fluid without-head">
				<div class="row-form clearfix_">
					<div class="span3">Nama Pelanggan</div>
					<div class="span9">
						<input type="text" name="clientname" id="clientname" value=""/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<button class="btn closemodal" type="button" id='btnsaveclient'>Simpan</button>
		<button class="btn closemodal" type="button" id='updateclient'>Update</button>
		<button class="btn closemodal" type="button">Tutup</button>
	</div>
	</div>
</div>
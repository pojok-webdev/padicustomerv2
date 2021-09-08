<div id="dFollowUp" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
	<div class='modal-dialog modal-lg'><div class='modal-content'>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="followUpModalLabel">Follow Up</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span6">
				<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">Keluhan:</div>
						<div class="span9" id='ticketcontent'>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Pelapor:</div>
						<div class="span3" id='reporter'></div>
						<div class="span2"></div>
						<div class="span2">Telp:</div>
						<div class="span2" id='reporterphone'>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Tanggal:</div>
						<div class="span5">
							<input type='text' class='datepicker' value="<?php echo date('d/m/Y');?>" id='followUpDate' />
						</div>
						<div class="span2">
						<input type="text" id="followUpHour" class="followUpHour mynumber" />
						</div>
						<div class="span2">
						<input type="text" id="followUpMinute" class="followUpMinute mynumber" />
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Action:</div>
						<div class="span9">
							<textarea id="fuDescription" name="fuDescription" class='wysiwyg'></textarea>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Main - Root Cause</div>
						<div class="span9">
							<?php echo form_dropdown('cause', $ticketcausecategories, 0, 'id="causecategory" type="select"'); ?>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Sub - Root Cause</div>
						<div class="span9">
							<?php echo form_dropdown('cause', $ticketcauses, 0, 'id="cause" class="inp_ticket" type="select"'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="block-fluid without-head">
					<div class="row-form clearfix" id='dothercouse'>
						<div class="span3">Penyebab Lainnya</div>
						<div class="span9">
							<input type='text' id='othercause' name='cause'>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3" id='showtrsolution'>
							Kesimpulan
						</div>
						<div class="span9">
							<textarea id='solusi' class='okreq wysiwyg'></textarea>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">PIC/Jabatan/Telp:</div>
						<div class="span3">
							<input type='text' name='followUpPIC' id='followUpPIC' class='shorttext okreq' />
						</div>
						<div class="span3">
							<input type='text' name='picPosition' id='picPosition' class='shorttext okreq' />
						</div>
						<div class="span3">
							<input type='text' name='picPhone' id='picPhone' class='shorttext okreq' />
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Hasil Konfirmasi:</div>
						<div class="span9">
							<textarea id='confirmationresult' class='okreq_ wysiwyg'></textarea>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span4">Konfirmasi Pelanggan:</div>
						<div class="span8">
							<div class="btn-group" data-toggle="buttons-radio">
								<button type="button" class="btn btn-success" value="1" id="btnOK">OK</button>
								<button type="button" class="btn btn-info" value="0" id="btnNotOK">Belum OK</button>
								<button type="button" class="btn btn-warning" id="btnCouldNotBeContacted">Belum bisa dihubungi</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn" id="btnReset">Reset</button>
		<button type="button" class="btn btnHistory" value="2" id="btnHistory">History</button>
		<button class="btn conditionalButton" data-dismiss="modal" aria-hidden="true" id="btnCloseTicket">Tutup Tiket</button>
		<button class="btn conditionalButton" data-dismiss="modal" aria-hidden="true" id="btnProgress">Progress</button>
	</div>
	</div></div>
</div>

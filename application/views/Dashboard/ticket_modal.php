<div id="ticket_modal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 id="myModalLabel">Radio Switch in Modal</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">Option #1</label>
                <div class="controls">
                    <div class="switch" data-on="info" data-off="success">
                        <input type="checkbox" checked class="toggle"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Option #2</label>
                <div class="controls">
                    <div class="switch" data-on="warning" data-off="danger">
                        <input type="checkbox" checked class="toggle"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Option #3</label>
                <div class="controls">
                    <div class="switch" data-on="success" data-off="warning">
                        <input type="checkbox" checked class="toggle"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="dFollowUpHistory" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myHistoryModalLabel">Histori Follow Up</h3>
	</div>
	<div class="modal-body">
		<div class='row-fluid'>
			<div class="span12">
				<div class="row-fluid">
				<span class="label label-warning" id='complaint'></span>
				</div>
				<div class="block-fluid row-fluid without-head">
					<table cellpadding="0" cellspacing="0" width="100%" class="table images display" id="tblHistory">
						<thead>
							<tr>
								<th width="60">Tanggal</th>
								<th>PIC</th>
								<th>Jabatan</th>
								<th>Telp</th>
								<th>Status</th>
								<th>Petugas</th>
								<th>Keterangan</th>
							</tr>
						</thead>
					</table>

				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCloseTicketx">Tutup</button>
	</div>
</div>
<div id="dDescription" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="descriptionModalLabel">Info</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head">
					<div class="row-form clearfix">
						<div class="span3">Keluhan</div>
						<div class="span9">
							<span id="complaintcontent"></span>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Penyebab</div>
						<div class="span9">
							<span id="causecontent"></span>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Downtime</div>
						<div class="span9">
							<span id="downtime"></span>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Aktifitas</div>
						<div class="span9">
							<span id="descriptioncontent"></span>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Hasil Konfirmasi</div>
						<div class="span9">
							<span id="confirmationresultcontent"></span>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3">Kesimpulan</div>
						<div class="span9">
							<span id="solutioncontent"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCloseTicketx">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div id="dModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Konfirmasi</h3>
    </div>
    <div class="modal-body">
        <p id="modalMessage">Data telah tersimpan.</p>
    </div>
</div>
<div id="dPerpanjangan" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Perpanjangan Diskoneksi</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="block-fluid">
                <div class="row-form clearfix">
                    <input type="hidden" name="id" value="" id="disconnection_id" class="inp_disconnection"/>
                    <div class="span6">Perpanjangan Hingga tanggal:</div>
                    <div class="span6">
                        <?php echo form_input('finishdate','','id="finishdate"  class="inp_disconnection datepicker datepicker3m" type="text"');?>
                    </div>
                    <div class="span2">
                        <?php echo form_dropdown('hour',$hours,'0','id="finishhour"  parent="finishdate" class="dttime"');?>
                    </div>
                    <div class="span2">
                        <?php echo form_dropdown('minute',$minutes,'0','id="finishminute"  grandparent="finishdate" class="dttime"');?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <button class="btn closemodal" type="button">Tutup</button>
            <button class="btn closemodal" type="button" id="btnPerpanjanganSave">Simpan</button>
        </div>
    </div>
</div>
<div id="dReaktivasi" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Reaktivasi</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
        <div class="block-fluid">
        <div class="row-form clearfix">
            <input type="hidden" name="id" value="" class="inp_reactivation disconnection_id"/>
            <div class="span3">Reaktivasi tanggal:</div>
            <div class="span5">
                <?php echo form_input('reactivationdate','','id="reactivationdate"  class="inp_reactivation datepicker" type="text"');?>
            </div>
            <div class="span2">
                <?php echo form_dropdown('hour',$hours,'0','id="day"  parent="reactivationdate" class="dttime"');?>
            </div>
            <div class="span2">
                <?php echo form_dropdown('minute',$minutes,'0','id="minute"  grandparent="reactivationdate" class="dttime"');?>
            </div>
        </div>
        </div>
        </div>
        <div class="footer">
            <button class="btn closemodal" type="button">Tutup</button>
            <button class="btn closemodal" type="button" id="btnReactivationSave">Simpan</button>
        </div>
    </div>
</div>
<div id="dPermanen" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Berhenti Permanen</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
        <div class="block-fluid">
        <div class="row-form clearfix">
            <input type="hidden" name="id" value="" class="inp_permanent disconnection_id"/>
            <div class="span3">Berhenti Permanen tanggal:</div>
            <div class="span5">
                <?php echo form_input('permanentdate','','id="permanentdate"  class="inp_permanent datepicker" type="text"');?>
            </div>
            <div class="span2">
                <?php echo form_dropdown('hour',$hours,'0','id="day"  parent="permanentdate" class="dttime"');?>
            </div>
            <div class="span2">
                <?php echo form_dropdown('minute',$minutes,'0','id="minute"  grandparent="permanentdate" class="dttime"');?>
            </div>
        </div>
        </div>
        </div>
        <div class="footer">
            <button class="btn closemodal" type="button">Tutup</button>
            <button class="btn closemodal" type="button" id="btnPermanentSave">Simpan</button>
        </div>
    </div>
</div>

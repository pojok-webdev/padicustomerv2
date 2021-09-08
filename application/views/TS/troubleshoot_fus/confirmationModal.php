<div id="modalFUConfirmation" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="labelFUConfirmation">Konfirmasi</h3>
    </div>        
    <div class="row-fluid">
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3"></div>
                <div class="span9">
                    <div class="zoom img-zoom-container" id='zoomable'>
                    <h3>Data sudah tersimpan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id='btn1'>OK</button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn2">Kembali ke Troubleshoot</button>
    </div>
</div>
<script>
confirmation = function(opt){
    confirm = document.getElementById('btn1');
    confirm.addEventListener('click',opt.button1function,false);
    redirect = document.getElementById('btn2');
    redirect.addEventListener('click',opt.button2function,false);
    opt.modalForm.modal();
    opt.modalForm.on('hidden.bs.modal', function (e) {
        confirm.removeEventListener('click',opt.button1function,false);
        redirect.removeEventListener('click',opt.button2function,false);
    })

}
</script>
<div id="confirmationModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="confirmationLabel">Konfirmasi</h3>
    </div>        
    <div class="row-fluid">
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3"></div>
                <div class="span9">
                    <div class="zoom img-zoom-container" id='zoomable'>
                    <h3 id='modalTitle'>Data sudah tersimpan</h3>
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
    btn1 = document.getElementById('btn1');
    btn1.addEventListener('click',opt.button1function,false);
    btn1.innerText = opt.btn1value;
    btn2 = document.getElementById('btn2');
    if(!opt.btn2value){
        btn2.style.display = "none";
    }
    btn2.addEventListener('click',opt.button2function,false);
    btn2.innerText = opt.btn2value;
    $('#confirmationModal').modal();
    $('#confirmationModal').on('hidden.bs.modal', function (e) {
        btn1.removeEventListener('click',opt.button1function,false);
        btn2.removeEventListener('click',opt.button2function,false);
    })
    title = document.getElementById('modalTitle');
    title.innerHTML = opt.modalTitle;
    confirmationLabel = document.getElementById('confirmationLabel');
    confirmationLabel.innerHTML = opt.confirmationLabel;
}
</script>
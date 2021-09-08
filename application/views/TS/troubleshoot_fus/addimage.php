<div id="modalAddImage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="labelAddImage">Add FU Image</h3>
    </div>        
    <div class="row-fluid">
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3">Image</div>
                <div class="span9">
                    <div class="zoom img-zoom-container" id='zoomable'><img id="img" width='200'></div>
                </div>
            </div>
            <div class='row-form clearfix'>
                <div class='span3'></div>
                <div class='span9'>
                    <input type="file" name="addimage" id="addimage">
                    <button id='btn_image'>Upload Image</button>
                </div>
            </div>
            <div class='row-form clearfix'>
                <div class="span3">Name</div>
                <div class="span9"><input type='text' id='name'></div>
            </div>
            <div class="row-form clearfix">
                <div class="span3">Description</div>
                <div class="span9"><textarea id='description'></textarea></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id='btnSavePicture'>Save updates</button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
    </div>
</div>
<script>
    $('#btn_image').click(function(){
        $('#addimage').click();
    });
$('#addimage').change(function(evt){
    var fileReader = new FileReader();
    fileReader.onload = function(){
       resizeImage2(fileReader.result,600,function(img){
           console.log('IMG',img);
           $('#img').attr('src',img);
       });
    };
    fileReader.readAsDataURL(evt.target.files[0]);
});
/*$('#btnSavePicture').click(function(){
    console.log('Picture saved',fu_id);
    $.ajax({
        url:'/troubleshootfus/savepicture',
        data:{
            troubleshoot_fu_id:fu_id,
            img:$('#img').attr('src'),
            name:$('#name').val()
        },
        type:'post',
        dataType:'json'
    })
    .done(function(res){
        console.log('Success save picture',res);
        addRow(res.id,function(){
            fillImgTotal($('.images'),function(result){
                $('#imgtotal').html(result);
            })
        });
    })
    .fail(function(err){
        console.log('Failed save picture',err);
    });
});*/

</script>
<div id="fu_Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:1200">
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="FUModalLabel">Follow Up</h3>
    </div>        
    <div class="row-fluid">
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3">Activities:</div>
                <div class="span9"><textarea class="cleditor" id="fuactivities"></textarea></div>
            </div>                                                
        </div>                
        <div class="dr"><span></span></div>
        <div class="block-fluid">
            <div class="row-form clearfix">
            <div class="span3"></div>
            <div class="span9">
                <input type="file" name="uploadPicture" id="uploadPicture">
                <button class="btn btn-primary" id="btnUpload">Upload Gambar</button>
            </div>
            </div>
        </div>
        <div class="bloc-fluid">
            <div class="row-form clearfix tbldiv">
                <table id='addfuimages'>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id="btnSaveFu">
        Save updates
        </button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnClose">Close</button>            
    </div>
</div>    

<div id="mFilterCategory" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel"> Filter</h3>
    </div>
    <div class="modal-body">
        <div class="span12">
            <div class="clearfix">
                <div class="span3">Cabang:</div>
                <div class="span9">
                <input type="checkbox" name="branch" value="1" class="branchFilter" checked="checked"> Surabaya
                <input type="checkbox" name="branch" value="2" class="branchFilter" checked="checked"> Jakarta
                <input type="checkbox" name="branch" value="3" class="branchFilter" checked="checked"> Malang
                <input type="checkbox" name="branch" value="4" class="branchFilter" checked="checked"> Bali
                </div>
            </div>

            
            <div class="clearfix">
                <div class="span3">Rentang Waktu:</div>
                <div class="span9">
                    <select id="categoryfilter">
                        <option value="and q.hari<=2"><=3 Days</option>
                        <option value="and q.hari >=3 and q.hari <= 7 ">3 &gt; & &lt; 7</option>
                        <option value="and q.hari >7">&gt; 7</option>
                    </select>
                </div>
            </div>
            <div class="row clearfix">
                <div class="span3">Period:</div>
                <div class="span9">
                    <input class='datepicker' id='period1' value='<?php echo date('Y-m-d');?>'>
                    <input class='datepicker' id='period2' value='<?php echo date('Y-m-d');?>'>
                </div>
            </div>
            <div class="row clearfix">
                <div class="span3">Has Troubleshoot:</div>
                <div class="span9">
                <input type="checkbox" name="hastroubleshoot" value="1" class="hastroubleshoot" id="hastroubleshoot" checked="checked"> Ya
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id="searchByFilter">Search</button>
        <button class="btn" data-dismiss="modal" id="closeModal" aria-hidden="true">Close</button>            
    </div>

</div>
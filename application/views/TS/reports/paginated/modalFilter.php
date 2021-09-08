<div id="dFilter" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Category Filter </h3>
    </div>
    <div class="modal-body">
        <div class="span12">
            <div class="span6">
            <?php foreach($causecategories as $category){?>
                <div class="clearfix">
                    <h5><?php echo $category->name;?></h5>
                </div>
                <div class="clearfix">
                    <div class="span3">
                        <input type="checkbox" checked="checked" value="<?php echo $category->id;?>" class="filter catparent" /> 
                        <strong>CHECK ALL</strong>
                    </div>

                    <?php foreach(getcausesbycategory($category->id) as $cause){?>
                    <div class="span3">
                        <input type="checkbox" checked="checked" value="<?php echo $cause->id;?>" class="filter categoryclass catmember<?php echo $category->id;?>" /> 
                        <?php echo $cause->name;?>
                    </div>
                    <?php }?>
                </div>
                    <?php }?>
            </div>
    </div>
    </div>
    <div class="modal-footer">
        <button id="btnSaveCauses" class="btn">Search</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('templates/pagepopup/popuphead');?>
<body>
    <?php $this->load->view('templates/header_menu');?>        
    <div class="content">
        <?php $this->load->view('templates/pagepopup/breadline');?>        
        <div class="workplace">            
            <div class="row-fluid">
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-up"></div>
                        <h1>jQuery dialog windows</h1>
                    </div>
                    <div class="block">                                    
                        <button class="btn" type="button" id="popup_1">Default</button>
                        <button class="btn" type="button" id="popup_2">Animation</button>
                        <button class="btn" type="button" id="popup_3">Modal</button>
                        <button class="btn" type="button" id="popup_4">Modal form</button>
                    </div>
                </div>
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-down"></div>
                        <h1>Bootstrap dialog windows</h1>
                    </div>
                    <div class="block">                           
                        <a href="#dModal" role="button" class="btn" data-toggle="modal">Default</a>
                        <a href="#bModal" role="button" class="btn" data-toggle="modal">Actions</a>
                        <a href="#fModal" role="button" class="btn" data-toggle="modal">Modal form</a>
                        <button id="padiButton1" class="btn btn-primary">PadiButton</button>
                    </div>
                </div>                                               
            </div>                         

            <div class="row-fluid">
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-chat"></div>
                        <h1>Bootstrap tooltips</h1>
                    </div>
                    <div class="block">                           
                        <button class="btn tip" type="button" title="Default tooltip">Default .tip</button>
                        <button class="btn tipb" type="button" title="Bottom center tooltip">Bottom .tipb</button>
                        <button class="btn tipl" type="button" title="Left bottom tooltip">Left .tipl</button>
                        <button class="btn tipr" type="button" title="Right tooltip">Right .tipr</button>                        
                    </div>
                </div>                                 
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-chat"></div>
                        <h1>qTip tooltips</h1>
                    </div>
                    <div class="block">                           
                        <button class="btn tt" type="button" title="Default tooltip">Default .tt</button>
                        <button class="btn ttRC" type="button" title="Right center tooltip">Right center .ttRC</button>
                        <button class="btn ttRB" type="button" title="Right bottom tooltip">Right bottom .ttRB</button>
                        <button class="btn ttLT" type="button" title="Left top tooltip">Left top .ttLT</button>
                        <button class="btn ttLC" type="button" title="Left center tooltip">Left center .ttLC</button>
                        <button class="btn ttLB" type="button" title="Left bottom tooltip">Left bottom .ttLB</button>                                                                                                              
                    </div>
                </div>                                  
            </div>                                 
            
        </div>
        
    </div>   
    
    <div class="dialog" id="b_popup_1" style="display: none;" title="Default">
        <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.</p>
    </div>

    <div class="dialog" id="b_popup_2" style="display: none;" title="Animation">
        <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.</p>                
    </div>            

    <div class="dialog" id="b_popup_3" style="display: none;" title="Modal">
        <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.</p>                
    </div>                        

    <div class="dialog" id="b_popup_4" style="display: none;" title="Modal form">                                
        <div class="block">
            <span>First name:</span>
            <p><input type="text" name="fname" value=""/></p>
            <span>Last name:</span>
            <p><input type="text" name="lname" value=""/></p>
            <span>About:</span>
            <p><textarea></textarea></p>
            <div class="dr"><span></span></div>
            <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet.</p>
        </div>
    </div>                                        

    <!-- Bootrstrap default dialog -->
    <div id="dModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Default</h3>
        </div>
        <div class="modal-body">
            <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.</p>
        </div>
    </div>      
    
    <!-- Bootrstrap modal -->
    <div id="bModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal</h3>
        </div>
        <div class="modal-body">
            <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Save updates</button> 
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
        </div>
    </div>
    <!-- Padi modal -->
    <div id="pModal" class="modal  hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="padiModalLabel">Modal</h3>
        </div>
        <div class="modal-body">
            <p>This is Main Modal (Padi Modal).</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Save updates</button> 
            <button id="showOtherModal1" class="btn btn-secondary">Show Other Modal</button>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
        </div>
    </div>
    <div id="child1Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="padiChild1ModalLabel">Modal</h3>
        </div>
        <div class="modal-body">
            <p>This is other Modal (Child Modal).</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Save updates</button> 
            <button id="showOtherModal2" class="btn btn-secondary">Show Other Modal</button>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
        </div>
    </div>

    <!-- Bootrstrap modal form -->
    <div id="fModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal form</h3>
        </div>        
        <div class="row-fluid">
            <div class="block-fluid">
                <div class="row-form clearfix">
                    <div class="span3">First name:</div>
                    <div class="span9"><input type="text" value=""/></div>
                </div>            
                <div class="row-form clearfix">
                    <div class="span3">Last name:</div>
                    <div class="span9"><input type="text" value=""/></div>                    
                </div>                                    
                <div class="row-form clearfix">
                    <div class="span3">About:</div>
                    <div class="span9"><textarea></textarea></div>
                </div>                                                
            </div>                
            <div class="dr"><span></span></div>
            <div class="block">                
                <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet.</p>
            </div>
        </div>                    
        <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Save updates</button> 
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
        </div>
    </div>    
    
    <script>
    (function($){
        $("#padiButton1").on("click",function(){
            $("#pModal").modal();
        });
        $("#showOtherModal1").on("click",function(){
            $("#child1Modal").modal();
        })
    }(jQuery))
    </script>
</body>
</html>

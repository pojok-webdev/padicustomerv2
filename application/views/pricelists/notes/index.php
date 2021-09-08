<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('pricelists/notes/head');?>
<body>
    <div class="header">
        <a class="logo" href="#"><img src="/img/aquarius/logo.png" alt="PadiApp" title="PadiApp"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
    </div>
    <?php $this->load->view('pricelists/notes/menu');?>
    <div class="content">
        <?php $this->load->view('pricelists/notes/breadline');?>        
        <div class="workplace">
            <div class="row-fluid">                
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Notes Layanan PadiNET</h1>
                        <ul class="buttons">
                            <li><a href="/notes/insert/" class="isw-download"></a></li>                                                        
                        </ul>                        
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tNote">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="95%">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>                                
            </div>            
            <div class="dr"><span></span></div>            
        </div>
    </div>
    <script src='/asset/aqua/js/pricelistsnotes/index.js'></script>
</body>
</html>

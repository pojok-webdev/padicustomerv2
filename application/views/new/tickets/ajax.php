<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<style>
.tbl-btns{
    margin: 8px 2px 2px 10px;
    background-color: beige;
}
</style>
<body>    
<div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="PadiNET App" title="PadiNET App"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <?php $this->load->view('adm/menu');?>        
    <div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="#">PadiApp</a> <span class="divider">></span></li>
            <li><a href="#">Tickets</a> <span class="divider">></span></li>
            <li class="active">List</li>
        </ul>
    	<?php $this->load->view('adm/buttons');?>
    </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Tickets</h1>      
                        <ul class="buttons">
                            <li><a href="#" class="isw-download"></a></li>                                                        
                            <li><a href="#" class="isw-attachment"></a></li>
                            <li>
                                <a href="#" class="isw-settings"></a>
                                <ul class="dd-list">
                                    <li><a href="#"><span class="isw-plus"></span> New document</a></li>
                                    <li><a href="#"><span class="isw-edit"></span> Edit</a></li>
                                    <li><a href="#"><span class="isw-delete"></span> Delete</a></li>
                                </ul>
                            </li>
                        </ul>                        
                    </div>
                    <div class="block-fluid">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tblticket">
                            <thead>
                                <tr>                                    
                                    <th width="10%">Kode</th>
                                    <th width="10%">Nama</th>
                                    <th width="15%">Layanan</th>
                                    <th width="10%">Durasi</th>
                                    <th width="10%">Kategori</th>
                                    <th width="15%">Main Root Cause</th>
                                    <th width="15%">Site</th>
                                    <th width="15%">VAS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>                                
            </div>            
        </div>
    </div>   
    <script>
    $("#tblticket").dataTable({
        "bProcessing": true,
        "sAjaxSource": '/ntickets/source'
    })
    </script>
</body>
</html>

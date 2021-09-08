<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("adm/head");?>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="TS Dashboard" title="TS Dashboard"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
    </div>
    <?php $this->load->view('adm/menu');?>        
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a> <span class="divider">></span></li>
                <li class="active">TS</li>
            </ul>
            <?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace">
            <div class="dr"><span></span></div>            
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Sortable table</h1>           
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th width="25%">ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">CS</th>
                                    <th width="25%">Waktu</th>
                                    <th width="25%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($details as $detail){?>
                                <tr>
                                    <td><?php echo $detail->kdticket;?></td>
                                    <td><?php echo $detail->clientname;?></td>
                                    <td><?php echo $detail->createuser;?></td>
                                    <td><?php echo $detail->create_date;?></td>
                                    <td><?php echo $detail->status;?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>            
            </div>            
            <div class="dr"><span></span></div>            
        </div>
    </div>   
</body>
</html>

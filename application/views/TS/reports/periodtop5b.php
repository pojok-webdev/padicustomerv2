<!DOCTYPE html>
<html lang="en">
    <?php
    $this->load->view('adm/head');
    ?>
<body>    
    <div class="header">
        <a class="logo" href="index.html"><img src="img/logo.png" alt="/" title="Report Top5 Sub Root Cause"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
    </div>
    <?php $this->load->view('TS/reports/menu');?>        
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Reports</a> <span class="divider">></span></li>                
                <li><a href="#">Sub Root Cause</a> <span class="divider">></span></li>                
                <li class="active">Top 5</li>
            </ul>
            <?php $this->load->view('TS/reports/buttons');?>
        </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">                    
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Top 5 Sub Root Cause</h1>      
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
                        <table cellpadding="0" cellspacing="0" width="100%" class="table">
                            <thead>
                                <tr>                                    
                                    <th width="25%">ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Jumlah</th>
                                    <th width="25%">Phone</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tickets as $ticket){?>
                                <tr>                                    
                                    <td>101</td>
                                    <td><?php echo $ticket->name;?></td>
                                    <td><?php echo $ticket->cnt;?></td>
                                    <td>+98(765)432-10-98</td>                                    
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>                                
                
            </div>
        </div>
    </div>       
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head')?>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="PadiApp" title="PadiApp"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
	<?php $this->load->view('adm/menu');?>
	    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a> <span class="divider">></span></li>
                <li class="active">Ticket</li>
            </ul>
        </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span4">
                    <div class="wBlock red clearfix">
                        <div class="dSpace">
                            <h3>Total Tickets in Week</h3>
                            <span class="number" id="totaltickets"><?php echo $totalticketsinweek;?></span>
                        </div>
                        <div class="rSpace">
                            <span><span id="ticketopen">Tiket masih terbuka <?php echo $openticketsinweek;?></span></span>
                            <span><span id="ticketclosed">Tiket sudah tertutup <?php echo $closedticketsinweek;?></span></span>
                            <span><span id="ticketwithtroubleshoot">Tiket dg troublehsoot <?php echo $troubleshootticketsinweek;?></span></span>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="wBlock green clearfix">
                        <div class="dSpace">
                            <h3>Ticket Surabaya</h3>
                            <span class="number"><?php echo $totalsbyticketsperbranchinweek;?></span>                    
                        </div>
                        <div class="rSpace">
                            <span><?php echo $totaljktticketsperbranchinweek;?> <b>Jakarta</b></span>
                            <span><?php echo $totalmlgticketsperbranchinweek;?> <b>Malang</b></span>
                            <span><?php echo $totalbliticketsperbranchinweek;?> <b>Bali</b></span>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="wBlock blue clearfix">
                        <div class="dSpace">
                            <h3>Total Ticket in Day</h3>
                            <span class="number" id="totalticketindays"><?php echo $totalticketsinday;?></span>
                        </div>
                        <div class="rSpace">
                            <span><span id="dailyticketopen">Tiket masih terbuka <?php echo $openticketsinday;?></span></span>
                            <span><span id="dailyticketclosed">Tiket sudah ditutup <?php echo $closedticketsinday;?></span></span>
                            <span><span id="dailyticketwithtroubleshoot">Tiket dg troubleshoot <?php echo $troubleshootticketsinday;?></span></span>                                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div> 
            <div class="row-fluid">
                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket AP seminggu</h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($ticketapinweek as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Tanggal</a></td>
                                        <td><span class=""><?php echo $ap->create_date;?></span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                
                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket Backbone seminggu</h1>
                    </div>
                    <div class="block-fluid accordion">
                    <?php foreach($ticketbackboneinweek as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Tanggal</a></td>
                                        <td><span class=""><?php echo $ap->create_date;?></span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>

                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket Upstream seminggu</h1>
                    </div>
                    <div class="block-fluid accordion">
                    <?php foreach($ticketupstreaminweek as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Tanggal</a></td>
                                        <td><span class=""><?php echo $ap->create_date;?></span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div> 
            <div class="row-fluid">
                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket AP sehari</h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($ticketapinday as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket Backbone sehari</h1>
                    </div>
                    <div class="block-fluid accordion">
                    <?php foreach($ticketbackboneinday as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket Upstream sehari</h1>
                    </div>
                    <div class="block-fluid accordion">
                    <?php foreach($ticketupstreaminday as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div>
            <div class="row-fluid">
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Surabaya sehari <?php echo $totalsbyticketsperbranchinday;?></h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($jktticketsperbranchinday as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Jakarta sehari <?php echo $totaljktticketsperbranchinday;?></h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($jktticketsperbranchinday as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Malang sehari <?php echo $totalmlgticketsperbranchinday;?></h1>
                    </div>
                    <div class="block-fluid accordion">
                        <?php foreach($mlgticketsperbranchinday as $ap){?>
                            <h3><?php echo $ap->clientname;?></h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th>Nama</th><th width="40">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">Status</a></td>
                                            <td><span class=""><?php echo $ap->status;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }?>
                    </div>
                </div>                               
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Bali sehari <?php echo $totalbliticketsperbranchinday;?></h1>
                    </div>
                    <div class="block-fluid accordion">
                        <?php foreach($bliticketsperbranchinday as $ap){?>
                            <h3><?php echo $ap->clientname;?></h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th>Nama</th><th width="40">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">Status</a></td>
                                            <td><span class=""><?php echo $ap->status;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div>
            <div class="row-fluid">
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Surabaya seminggu <?php echo $totalsbyticketsperbranchinweek;?></h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($sbyticketsperbranchinweek as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Jakarta seminggu <?php echo $totaljktticketsperbranchinweek;?></h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($jktticketsperbranchinweek as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Malang seminggu <?php echo $totalmlgticketsperbranchinweek;?></h1>
                    </div>
                    <div class="block-fluid accordion">
                        <?php foreach($mlgticketsperbranchinweek as $ap){?>
                            <h3><?php echo $ap->clientname;?></h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th>Nama</th><th width="40">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">Status</a></td>
                                            <td><span class=""><?php echo $ap->status;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span3">
                    <div class="head clearfix">
                        <h1>Komplain Bali seminggu <?php echo $totalbliticketsperbranchinweek;?></h1>
                    </div>
                    <div class="block-fluid accordion">
                        <?php foreach($bliticketsperbranchinweek as $ap){?>
                            <h3><?php echo $ap->clientname;?></h3>
                            <div>
                                <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                    <thead>
                                        <tr>
                                            <th>Nama</th><th width="40">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">Status</a></td>
                                            <td><span class=""><?php echo $ap->status;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div>
            <div class="row fluid">
            <div class="span4">
                    <div class="head clearfix">
                        <h1>Komplain perkategori seminggu</h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($totalcategorybycauses as $ap){?>
                        <h3><?php echo $ap->name . ' ' . $ap->cnt;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($weeklycause[$ap->id] as $obj){?>
                                    <tr>
                                        <td><span class=""><?php echo $obj->clientname;?></span></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span4">
                <div class="head clearfix">
                        <h1>Komplain perkategori seminggu</h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($totalcategorybycauses as $ap){?>
                        <h3><?php echo $ap->name . ' ' . $ap->cnt;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($dailycause[$ap->id] as $obj){?>
                                    <tr>
                                        <td><span class=""><?php echo $obj->clientname;?></span></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="span4">
                    <div class="head clearfix">
                        <h1>Ticket AP seminggu</h1>
                    </div>
                    <div class="block-fluid accordion" id="ticketpercategory">
                        <?php foreach($ticketapinweek as $ap){?>
                        <h3><?php echo $ap->clientname;?></h3>
                        <div>
                            <table cellpadding="0" cellspacing="0" width="100%" class="sOrders">
                                <thead>
                                    <tr>
                                        <th>Nama</th><th width="40">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">Tanggal</a></td>
                                        <td><span class=""><?php echo $ap->create_date;?></span></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Status</a></td>
                                        <td><span class=""><?php echo $ap->status;?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                </div>

            </div>
        </div>
    </div>   
</body>
</html>
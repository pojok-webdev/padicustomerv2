<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('adm/head');?>
    <style>
    div.sticky {
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
    }
    </style>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/asset/aqua/img/logo.png" alt="Tickets FU" title="Tickets FU"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <?php $this->load->view('adm/menu'); ?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="/">Tickets</a> <span class="divider">></span></li>                
                <li class="active">FollowUp </li>
            </ul>
            <?php $this->load->view('adm/buttons'); ?>            
        </div>
        <div class="workplace">
            <div class="row-fluid">
            <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-list"></div>
                        <h1>Tickets</h1>
                        <ul class="buttons">
                            <li>
                                <a href="#modalTicketFilter" role="button" data-toggle="modal" class="isw-zoom" id="buttonSearch"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="block messages" id='tickets'>
                    </div>
                </div>                
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-chats"></div>
                        <h1>FUs</h1>
                        <ul class="buttons">
                            <li>
                                <a href="#" class="isw-plus" id="buttonPlus"></a>
                            </li>
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
                    <div class="block messaging fus">                        
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <div class="sticky">
        Up
    </div>
    <?php $this->load->view('ticketfuthreads/ticketfilter');?>
    <?php $this->load->view('ticketfuthreads/ticketedit');?>
</body>
<script>var username="<?php echo $username;?>"</script>
<script src="/js/aquarius/TS/ticketfuthreads/index.js">
</script>
</html>

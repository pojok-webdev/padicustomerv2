<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('TS/reports/paginated/head');?>
    <link rel="stylesheet" href="/asset/aqua/css/app/paginated/padicustom.css" />
    <link rel="stylesheet" href="/asset/jquery/ui.1.12.1.css">
    <link rel="stylesheet" href="/asset/aqua/css/padifulltable.css">
    <style>
        .checker{
            display:block;
        }
        #dFollowUp{
            width:1000px;
            margin-left: -450px;
            max-height:600px;
            overflow:hidden;
        }
        .modal-body{
            overflow-y:auto;
        }
        .mycontent{
            position:relative;
            padding-top:40px;
        }
    </style>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/asset/aqua/img/logo.png" alt="Ticket" title="Tikets"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <div class="mycontent">
        <div class="workplace">
        <?php $this->load->view('TS/reports/paginated/modalFilterCategory');?>
        <?php $this->load->view('TS/reports/paginated/modalFilter');?>
        <?php $this->load->view('TS/reports/paginated/modalFilterKdticket');?>
        <?php $this->load->view('TS/reports/paginated/modalFUWide');?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Ticket PadiApp <span id='ticketamount'></span></h1>
                        <ul class="buttons">
                            <li title="Filter "><a id="commonFilter" class="isw-documents"></a></li>
                            <li title="Cause Filter"><a class="isw-zoom" id="search"></a></li>
                        </ul>
                    </div>
                    <div class="block-fluid">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tTicket">
                            <thead>
                                <tr>
                                    <th width="8%">Kdticket</th>
                                    <th width="20%">Name</th>
                                    <th width="10%">Type</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Cause</th>
                                    <th width="10%">Start</th>
                                    <th width="10%">End</th>
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
    <?php $this->load->view('shared/confirmmodal');?>
    <script src="/asset/padi.common.js"></script>
    <script src="/asset/aqua/js/paginateds/index.js"></script>
    <script src="/asset/aqua/js/paginateds/search.js"></script>
</body>
</html>

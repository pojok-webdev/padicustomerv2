<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('paginated/head');?>
    <link rel="stylesheet"  href="/asset/aqua/css/autocomplete.css" />
<body>
    <div class="header">
        <a class="logo" href="#"><img src="/asset/aqua/img/logo.png" alt="PadiApp Ticket" title="PadiApp Ticket"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>
    </div>
    <?php $this->load->view('paginated/menu');?>
    <div class="content">
        <input type="hidden" name="requesttype" value="pelanggan" />
        <input type="hidden" name="parentid" id='parentid' value="0" />
        <?php $this->load->view('commons/breadline');?>
        <div class="workplace">            
            <div class="row-fluid">
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-list"></div>
                        <h1>Penambahan Ticket</h1>
                    </div>
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span5">Pelapor:</div>
                            <div class="span7">
                                <input type="text" name="reporter" id="reporter" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span5">Telp:</div>
                            <div class="span7">
                            <input type="text" name="reporterphone" id="reporterphone" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span5">Tanggal:</div>
                            <div class="span7">
                                <input type="text" name="ticketstart" id="ticketstart" class="mask_date" value="<?php echo date('d/m/Y h:i');?>" /> 
                                <span>Example: 31/12/2020 12:15</span>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span5">Complain:</div>
                            <div class="span7">
                            <input type="text" name="complain" id="complain" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span5">Description:</div>
                            <div class="span7">
                                <div class="block-fluid" id="wysiwyg_container">
                                    <textarea id="description" class="wysiwyg" name="description" style="height: 300px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-target"></div>
                        <h1>Penambahan Ticket</h1>
                    </div>
                    <div class="block-fluid">
                        <div class="row-form clearfix dauto">
                            <div class="span5">Nama Pelanggan:</div>
                            <div class="span7">
                                <input type="text" placeholder="Nama Pelanggan..." name="clientname" id="client_id" />
                                <input type="hidden" name="client_id" id="clientid">
                            </div>
                            <div name="dugaanpelanggan" id="dugaanpelanggan" ></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span5">Site:</div>
                            <div class="span7">
                                <select name="client_site_id" id="client_site_id"></select>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span12">
                                <button type="button" class="btn" id="btnSave" name="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/asset/aqua/js/paginateds/add.js"></script>
    <script src="/asset/aqua/js/followups/wysiwygs.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
	<style type="text/css">
		#tTroubleshoot	tbody tr.red td{
			background-color:red;
		}
		#tTroubleshoot	tbody tr.yellow td{
			background-color:yellow;
        }
        .uploader{
            display:block;
        }
        .tbldiv{
            height: 200px;
            overflow-y:scroll;
        }
        #fus{
            width: 100%;
        }
        .pointer:hover{
            cursor:pointer;
        }
	</style>
<?php $this->load->view('adm/head');?>
<script>
$.fn.modal.Constructor.prototype.enforceFocus = function () {
    console.log('this script is aimed to avoid maximum call stack exceed ');
};
</script>
<script src="/js/padilibs/padi.imagelib.js"></script>
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
                <li><a href="/">PadiApp</a> <span class="divider">></span></li>
                <li><a href="/troubleshoots">Troubleshoots</a> <span class="divider">></span></li>
                <li class="active">List</li>
            </ul>
			<?php $this->load->view('adm/buttons');?>
        </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Troubleshoot</h1>
                        <ul class="buttons">
                            <!--<li><a href="#" class="isw-plus" id="permintaantroubleshoot"></a></li>-->
                        </ul>
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tTroubleshoot">
                            <thead>
                                <tr>
                                    <th width="25%">Name</th>
                                    <th width="25%">Tgl Request</th>
                                    <th width="25%">Type</th>
                                    <th width="20%">Alamat</th>
                                    <th>Status</th>
                                    <th>Tgl Troubleshoot</th>
                                    <th>Cabang</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($objs as $obj){
									switch($obj->status){
										case '0':
										$status = 'Progress';
										$color='red';
										break;
										case '1':
										$status = 'Solved';
										$color='white';
										break;
										case '2':
										$status = 'Monitoring';
										$color='yellow';
										break;
										default:
										$status = 'Unknown';
										break;
									}
								?>
                                <tr myid='<?php echo $obj->id;?>' class='<?php echo $color;?>'>
                                    <td>
                                        <span class='clientname'><?php echo $obj->nameofmtype;?></span>
                                        <h5>
                                        <?php echo $obj->kdticket;?>    
                                        </h5>
                                    </td>
                                    <td>
										<?php 
										echo $obj->request_date1;
										?>
                                    </td>
                                    <td><?php echo $obj->troubleshoottype;?></td>
                                    <td><?php echo $obj->clientsiteaddress;?></td>
                                    <td><?php echo $status;?></td>
                                    <td><?php echo $obj->troubleshoot_date;?></td>
                                    <td><?php echo $obj->branch;?></td>
                                    <td>
										<div class="btn-group">
                                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="/troubleshootfus/index/<?php echo $obj->id;?>">Follow Ups</a>
                                            </li>
                                            <li class='btnFU' style='display:none'>
                                                <a class='btnAddFu pointer'>Add Follow UP</a>
                                            </li>
                                            <li class="divider"></li>
											<li class='btnViewReport'>
                                                <a href="/troubleshoots/report/<?php echo $obj->id;?>">View Report</a>
                                            </li>
											<li class='btnedit'>
                                                <a href="/troubleshoots/edit/<?php echo $obj->id;?>">Edit</a>
                                            </li>
											<li class='btnEntryReport'>
                                                <a href="/troubleshoots/entry_report/<?php echo $obj->id;?>">Entry Report</a>
                                            </li>
                                        </ul>
										</div>
                                    </td>
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
    <?php $this->load->view('TS/troubleshoots/fu');?>
    <?php $this->load->view('TS/troubleshoots/fus');?>
    <?php $this->load->view('TS/troubleshoots/fuimages');?>
	<script type='text/javascript' src='/js/aquarius/TS/troubleshoots/troubleshoot.js'></script>
    <script type='text/javascript' src='/js/aquarius/TS/troubleshoots/index.js'></script>
    <script type='text/javascript' src='/js/aquarius/TS/troubleshoots/fu.js'></script>
</body>
</html>

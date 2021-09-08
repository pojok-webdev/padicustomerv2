<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head');?>
<body>
    <?php $this->load->view('shared/header');?>
    <?php $this->load->view('shared/menu');?>
    <div class="content">
        <?php $this->load->view('shared/breadcrumb');?>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Site, VAS, Services</h1>
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
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSite">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th width="25%">Alamat</th>
                                    <th width="25%">VAS</th>
                                    <th width="25%">Layanan</th>
                                    <th width="25%">Keterangan Layanan</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($objs as $obj){?>
                                <tr id="<?php echo $obj->id;?>">
                                    <td class="name"><?php echo $obj->name;?></td>
                                    <td><?php echo $obj->address;?></td>
                                    <td>
                                        <?php echo $obj->vases;?>
                                    </td>
                                    <td><?php echo $obj->services;?></td>
                                    <td><?php echo $obj->servicedesc;?></td>
                                    <td>
                                        <div class="btn-group">                                        
                                            <button data-toggle="dropdown" class="btn dropdown-toggle">
                                                Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="#addVasModal" role="button" class="btn" data-toggle="modal" id="addVas">
                                                        Add VAS
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#dAddService" role="button" class="btn" data-toggle="modal">
                                                        Add Service
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="#">Detail</a></li>
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
    <?php $this->load->view('psites/modals');?>
    <script src='/js/aquarius/pfbses/fblib.padi.js'></script>
    <script src='/js/aquarius/psites/edit.js'></script>
    <script>
    if($("#tSite").length > 0)
         {
            $("#tSite").dataTable({
                "iDisplayLength": 5, 
                "aLengthMenu": [5,10,25,50,100], 
                "sPaginationType": "full_numbers", 
                "aoColumns": [ 
                    { "bSortable": true }, null, null, null, null,null
                ]
            });
         }
         $("#addVas").on("click",function(){
             that = $(this);
             clientname = that.stairUp({level:5}).find(".name").text();
             $("#clientname").html(clientname);
         });
         $("#saveVas").on("click",function(){
             clientid = $("#tSite tr.selected").attr('id');
             vasid = $("#vases").val();
             console.log("vases",$("#vases").val());
             $.ajax({
                 url:'psites/savevas/'+clientid+'/'+vasid
             })
             .done(function(res){
                 console.log(res)
             })
             .fail(function(err){
                 console.log(err)
             });
         });
         $("#saveService").on("click",function(){
             clientid = $("#tSite tr.selected").attr('id');
             serviceid = $("#services").val();
             console.log("services",$("#services").val());
             $.ajax({
                 url:'psites/saveservice/'+clientid+'/'+serviceid
             })
             .done(function(res){
                 console.log(res)
             })
             .fail(function(err){
                 console.log(err)
             });
         });
         $("#tSite").on("click","tr",function(){
            $("#tSite tr").removeClass('selected') ;
            $(this).addClass('selected');
             console.log($(this).attr("id"));
         })
    </script>
</body>
</html>

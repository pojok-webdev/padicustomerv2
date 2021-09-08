<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('TS/troubleshoot_fus/head');?>
<body>
<?php $this->load->view('adm/header');?>
    <?php $this->load->view('shared/menu');?>        
    <div class="content">
    <div class="breadLine">
            <?php $this->load->view('common/breadcrumbwithurl');?>
        </div>        
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Follow Up Troubleshoot : <?php echo $troubleshoot->nameofmtype;?></h1>
                        <ul class="buttons">
                            <li><a href="/troubleshootfus/add/<?php echo $troubleshoot->id;?>" class="isw-plus"></a></li>
                        </ul>                        
                    </div>
                    <div class="block-fluid table-sorting clearfix">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable">
                            <thead>
                                <tr>
                                    <th>Create Date</th>
                                    <th width="25%">FU ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Create User</th>
                                    <th width="25%">Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($fus as $fu){?>
                                <tr id=<?php echo $fu->id;?>>
                                    <td><?php echo $fu->createdate;?></td>
                                    <td><?php echo $fu->id;?></td>
                                    <td><?php echo $fu->activities;?></td>
                                    <td><?php echo $fu->username;?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="/troubleshootfus/fu/<?php echo $fu->id;?>">Edit</a></li>
                                                <li class="divider"></li>
                                                <li><a class='removeFU'>Delete</a></li>
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
</body>
<?php $this->load->view('shared/confirmationModal');?>
<script src="/js/aquarius/radu.js"></script>
<script>
$('#tSortable').on('click','tbody tr .removeFU',function(){
    tr = $(this).stairUp({level:5});
    id = tr.attr('id');
    confirmation({
        button2function:function(){
        },
        btn2value:'Batal',
        button1function:function(){
            $.ajax({
                url:'/troubleshootfus/removefu/'+id,
            })
            .done(function(res){
                tr.remove();
            })
            .fail(function(err){});
        },
        btn1value:'Iya',
        modalTitle:'Betul-betul mau menghapus id '+id+'?',
        confirmationLabel:'Konfirmasi'
    });

})
</script>
</html>

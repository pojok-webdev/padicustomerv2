<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('TS/troubleshoot_fus/head');?>

</head>
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
                        <div class="isw-documents"></div>
                        <h1>Troubleshoot Follow Up</h1>
                        <ul class="buttons">
                            <li><a id='btnSaveUpdateFU' class="isw-ok"></a></li>
                        </ul>                        
                    </div>
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                            <div class="span3">Activities:</div>
                            <div class="span9">
                                <textarea id='activities' name="textarea" placeholder="Activities..."><?php echo $fu->activities;?></textarea>
                            </div>
                        </div>                                                
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div>
            <div class="row-fluid">
                <div class="span12">
                <div class="block-fluid without-head">                        
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>FU images</h4>
                        </div>                         
                        <div class="toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-warning tip btnAddImage" title="Add Image">
                                        <span class="icon-plus icon-white"></span>
                                    </button>
                                    <button type="button" class="btn btn-small btn-danger tip btnAddImage" title="Add Image">
                                        Add Image
                                    </button>
                                </div>                                
                            </div>                        
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="table images">
                            <thead>
                                <tr>
                                    <th width="30">No</th>
                                    <th width="60">Image</th>
                                    <th width="60">Name</th>
                                    <th>Description</th>
                                    <th width="40">Actions</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $c = 1;?>
                                <?php foreach($fus as $fu){?>
                                <tr id=<?php echo $fu->id;?>>
                                    <td class='orderNumber'><?php echo $c++;?></td>
                                    <td>
                                        <a class="fancybox_ padifancybox" rel="group" href="<?php echo $fu->img;?>">
                                        <img src="<?php echo $fu->img;?>" class="img-polaroid imgsrc" width="200" />
                                        </a>
                                    </td>
                                    <td class="info">
                                        <a class="fancybox_ imgname" rel="group" href="<?php echo $fu->img;?>">
                                        <?php echo $fu->name;?>
                                        </a> 
                                        <span></span> <span></span>
                                    </td>
                                    <td class='imgdescription'><?php echo $fu->description;?></td>
                                    <td>
                                    <div class="btn-group">                                        
                                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a class="btnEditPicture">Edit</a></li>
                                            <li class="divider"></li>
                                            <li><a class='removeImg'>Delete</a></li>
                                        </ul>
                                    </div>
                                    </td>                                    
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                            <span id='imgtotal'></span>
                            </div>                            
                            <div class="right">
                                <div class="pagination pagination-mini">
                                    <ul>
                                        <li class="disabled"><a href="#">Prev</a></li>
                                        <li class="disabled"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>                             
                            </div>
                        </div>                    

                    </div>
                </div>                
            </div>
            <div class="dr"><span></span></div>        
        </div>
    </div>
    <script src="/js/aquarius/radu.js"></script>
    <script src="/js/padilibs/padi.common.js"></script>
    <script src="/js/aquarius/TS/troubleshoots/fu.libs.js"></script>
    <script>fu_id='<?php echo $fu_id;?>'</script>
    <script>user_id='<?php echo $this->session->userdata['user_id'];?>'</script>
    <script>troubleshoot_id='<?php echo $troubleshoot_id;?>'</script>
    <?php $this->load->view('TS/troubleshoot_fus/addimage');?>
    <?php $this->load->view('shared/confirmationModal');?>
    <script src="/js/padilibs/padi.imagelib.js"></script>
    <script>
        (function($){
            tslib = new Troubleshootfu({
                savePicture:function(){
                    console.log('Picture Edited');
                    id = $('.images tbody tr.selected').attr('id');
                    $.ajax({
                        url:'/troubleshootfus/updatepicture/',
                        data:{
                            id:id,
                            img:$('#img').attr('src'),
                            name:$('#name').val(),
                            description:$('#description').val(),
                            user_id:user_id
                        },
                        type:'post',
                        dataType:'json'
                    })
                    .done(function(res){
                        console.log(res);
                        $('.images tbody tr.selected').find('.imgsrc').attr('src',$('#img').attr('src'));
                    })
                    .fail(function(err){
                        console.log(err);
                    });
                },
                table:$('.images'),
                tetekbengek:'edit method'
            });
            fucreator = new Troubleshootfu({
                savePicture:function(){
                    console.log('Picture saved',fu_id);
                    $.ajax({
                        url:'/troubleshootfus/savepicture',
                        data:{
                            troubleshoot_fu_id:fu_id,
                            img:$('#img').attr('src'),
                            name:$('#name').val(),
                            description:$('#description').val()
                        },
                        type:'post',
                        dataType:'json'
                    })
                    .done(function(res){
                        console.log('Success saved Your picture',res);
                        fucreator.addRow({id:res.id,table:$('.images tbody')},function(){
                            padicommon.fillImgTotal($('.images'),function(result){
                                $('#imgtotal').html(result);
                            })
                        });
                        fucreator.reOrderNumber({table:$('.images tbody')});
                    })
                    .fail(function(err){
                        console.log('Failed save picture',err);
                    });
                },
                table:$('.images'),
                tetekbengek:'save method'
            });
            $("a.padifancybox").fancybox({
                type:'image',
                width: 1000,
                autoSize:false,
                autoDimensions:false,
                beforeLoad : function() {         
                    this.width  = 1000;
                    this.height = 1000;
                }
            });
            $('.images').on('click','.btnEditPicture',function(){
                tr = $(this).stairUp({level:5});
                $('.images tbody tr').removeClass('selected');
                tr.addClass('selected');
                console.log('edit pic invoked');
                tslib.showAddFuModal({
                    src:tr.find('.imgsrc').attr('src'),
                    name:tr.find('.imgname').text().trim(),
                    description:tr.find('.imgdescription').text().trim()
                });
            });
            $('.btnAddImage').click(function(){
                fucreator.showAddFuModal({
                    src:'',
                    name:'',
                    description:''
                });
            });
            padicommon.fillImgTotal($('.images'),function(result){
                $('#imgtotal').html('Jumlah : '+result);
            })
            $('#btnSaveUpdateFU').click(function(){
                console.log('btnSaveUpdateFU');
                console.log('User_ID',user_id);
                tslib.saveUpdateFUAction({
                    doAction:function(){
                        $.ajax({
                            url:'/troubleshootfus/updatefu',
                            data:{
                                id:fu_id,
                                activities:$('#activities').val(),
                                user_id:user_id
                            },
                            type:'post'
                        })
                        .done(function(sql){
                            console.log('Success updatefu Padi',sql);
                            confirmation({
                                button2function:function(){
                                    window.location.href = '/troubleshootfus/index/'+troubleshoot_id;
                                },
                                btn2value:'Kembali ke Troubleshoot',
                                button1function:function(){},
                                btn1value:'OK',
                                modalTitle:'Data Telah Tersimpan',
                                confirmationLabel:'Konfirmasi'
                            });
                        })
                        .fail(function(err){
                            console.log('Err',err);
                        });
                    }
                });
            });
            $('.images').on('click',' tbody tr .removeImg',function(){
                $('body').css('cursor','progress');
                tr = $(this).stairUp({level:5});
                id = $(this).stairUp({level:5}).attr('id');
                console.log('Id to remove',id);
                removeTr(tr,function(){
                    tr.remove();
                    padicommon.fillImgTotal($('.images'),function(result){
                        $('#imgtotal').html('Jumlah : '+result);
                        $('body').css('cursor','default');
                    })
                    fucreator.reOrderNumber();
                })
            })
            removeTr = function(tr,callback){
                $.ajax({
                    url:'/troubleshootfus/removeimage',
                    data:{
                        id:tr.attr('id'),
                    },
                    type:'post',
                    dataType:'json'
                })
                .done(function(res){
                    console.log('Success remove tr',res);
                    callback();
                })
                .fail(function(err){
                    console.log('Fail remove tr',err);
                });
            }
        }(jQuery))
    </script>
    <input type="file" name="file" id="file" style='display:hidden'>
</body>
</html>

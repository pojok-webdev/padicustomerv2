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
                                <textarea id='activities' name="textarea" placeholder="Activities..."></textarea>
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
    <script>troubleshoot_id = <?php echo $troubleshoot_id;?></script>
    <script>user_id='<?php echo $this->session->userdata['user_id'];?>'</script>
    <script src="/js/padilibs/padi.common.js"></script>
    <script src="/js/aquarius/TS/troubleshoots/fu.libs.js"></script>
    <script src="/js/aquarius/radu.js"></script>
    <?php $this->load->view('TS/troubleshoot_fus/addimage');?>
    <?php $this->load->view('shared/confirmationModal');?>
    <script src="/js/padilibs/padi.imagelib.js"></script>
    <script>
        (function($){
            console.log('User_ID',user_id);
            addModal = new Troubleshootfu({
                savePicture : function(){
                    addModal.addRow({id:0,table:$('.images tbody')},function(){
                        padicommon.fillImgTotal($('.images'),function(result){
                            $('#imgtotal').html(result);
                        })
                    });
                    addModal.reOrderNumber();
                },
                table:$('.images'),
                tetekbengek:'edit method'
            });
            editModal = new Troubleshootfu({
                savePicture : function(){
                    $('.images tbody tr.selected').find('.imgsrc').attr('src',$('#img').attr('src'));
                    addModal.reOrderNumber();
                },
                table:$('.images'),
                tetekbengek:'edit method'
            });
            $('.btnAddImage').click(function(){
                addModal.showAddFuModal({
                    src:'',
                    name:'',
                    description:''
                });
            });
            $('.images').on('click','.btnEditPicture',function(){
                tr = $(this).stairUp({level:5});
                $('.images tbody tr').removeClass('selected');
                tr.addClass('selected');
                console.log('edit pic invoked');
                editModal.showAddFuModal({
                    src:tr.find('.imgsrc').attr('src'),
                    name:tr.find('.imgname').text().trim(),
                    description:tr.find('.imgdescription').text().trim()
                });
            });
            $('.images').on('click',' tbody tr .removeImg',function(){
                $('body').css('cursor','progress');
                tr = $(this).stairUp({level:5});
                id = $(this).stairUp({level:5}).attr('id');
                console.log('Id to remove',id);
                tr.remove();
                padicommon.fillImgTotal($('.images'),function(result){
                    $('#imgtotal').html('Jumlah : '+result);
                    $('body').css('cursor','default');
                })
                editModal.reOrderNumber();
            })
            savePictures = function(fu_id,callback){
                $('.images tbody tr').each(function(){
                    that = $(this);
                    $.ajax({
                        url:'/troubleshootfus/savepicture',
                            data:{
                                troubleshoot_fu_id:fu_id,
                                img:that.find('.imgsrc').attr('src'),
                                name:that.find('.imgname').html(),
                                description:that.find('.imgdescription').val(),
                                user_id:user_id
                            },
                            type:'post',
                            dataType:'json'
                    })
                    .done(function(res){
                        console.log('Succes save picture',res);
                    })
                    .fail(function(err){
                        console.log('Fail save picture',err);
                    });
                });
                callback();
            }
            $('#btnSaveUpdateFU').click(function(){
                console.log('btnSaveUpdateFU');
                addModal.saveUpdateFUAction({
                    doAction:function(){
                        $.ajax({
                            url:'/troubleshootfus/savefu',
                            data:{
                                troubleshoot_id:troubleshoot_id,
                                activities:$('#activities').val(),
                                user_id:user_id
                            },
                            type:'post'
                        })
                        .done(function(fu_id){
                            console.log('Success savefu Padi',fu_id);
                            savePictures(fu_id,function(){
                                confirmation({
                                    button2function:function(){
                                        window.location.href = '/troubleshootfus/index/'+troubleshoot_id;
                                    },
                                    btn2value:'Kembali ke Troubleshoot',
                                    button1function:function(){
                                        window.location.href = '/troubleshootfus/fu/'+fu_id      
                                    },
                                    btn1value:'OK',
                                    modalTitle:'Data Telah Tersimpan',
                                    confirmationLabel:'Konfirmasi'
                                });

                            });
                        })
                        .fail(function(err){
                            console.log('Err',err);
                        });
                    }
                });
            });
        }(jQuery))
    </script>
    <input type="file" name="file" id="file" style='display:hidden'>
</body>
</html>

paditroubleshoot = function(opt){
    return{
        init:function(){
        },
        showAddFuModal : function(img){
            $('#img').attr('src',img.src);
            $('#name').val(img.name);
            $('#description').html(img.description);
            $('#modalAddImage').modal();
            $('#btnSavePicture').click(opt.savePicture);
        },
        addRow : function(opt,callback){
            console.log('AddRow Invoked');
            tr = '<tr id='+opt.id+'>';
                tr+='<td class="orderNumber"></td>';
                tr+='<td>';
                tr+='<a class="fancybox" rel="group" src='+$("#img").attr('src')+'>';
                tr+='<img src='+$("#img").attr('src')+' class="img-polaroid imgsrc"/>';
                tr+='</a>';
                tr+='</td>';
                tr+='<td class="info">';
                tr+='<a class="fancybox imgname" rel="group" href='+$("#img").attr('src')+'>';
                tr+=''+$('#name').val();
                tr+='</a> ';
                tr+='<span>fk-hseosqassr.jpg</span> <span></span>';
                tr+='</td>';
                tr+='<td class="imgdescription">'+$('#description').val()+'</td>';
                tr+='<td>';
                tr+='<div class="btn-group">';
                tr+='<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span>';
                tr+='</button>';
                tr+='<ul class="dropdown-menu pull-right">';
                tr+='<li><a href="#">Edit</a></li>';
                tr+='<li class="divider"></li>';
                tr+='<li><a class="removeImg">Delete</a></li>';
                tr+='</ul>';
                tr+='</div>';
                tr+='</td>';
                tr+='</tr>';
                opt.table.append(tr);
                callback();
        },
        saveUpdateFUAction:function(opt){
            opt.doAction();
        },
        reOrderNumber : function(){
            var c = 0;
            opt.table.find('tr').each(function(){
                $(this).find('.orderNumber').html(c++);
            });
        }
    }
}
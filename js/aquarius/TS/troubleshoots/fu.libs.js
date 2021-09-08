class Troubleshootfu{
    params = {}
    constructor(opt){
        console.log('OPY',opt);
        this.params.tetekbengek = opt.tetekbengek;
        this.params.savePicture = opt.savePicture;
        this.params.table = opt.table;
    }
    showAddFuModal(img){
        var that = this;
        console.log('Show Add Fu Modal Invoked',this.params.tetekbengek);
        $('#img').attr('src',img.src);
        $('#name').val(img.name);
        $('#description').html(img.description);
        var saveButton = document.getElementById('btnSavePicture');
        saveButton.addEventListener('click',this.params.savePicture,false);
        $('#modalAddImage').modal();
        $('#modalAddImage').on('hidden.bs.modal', function (e) {
            saveButton.removeEventListener('click',that.params.savePicture,false);
          })
    }
    addRow(opt,callback){
        console.log('AddRow Invoked');
        var tr = '<tr id='+opt.id+'>';
            tr+='<td class="orderNumber"></td>';
            tr+='<td>';
            tr+='<a class="fancybox" rel="group" href='+$("#img").attr('src')+'>';
            tr+='<img src='+$("#img").attr('src')+' class="img-polaroid imgsrc" width="200"/>';
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
            tr+='<li><a class="btnEditPicture">Edit</a></li>';
            tr+='<li class="divider"></li>';
            tr+='<li><a class="removeImg">Delete</a></li>';
            tr+='</ul>';
            tr+='</div>';
            tr+='</td>';
            tr+='</tr>';
            this.params.table.append(tr);
            callback();
    }
    saveUpdateFUAction(opt){
        opt.doAction();
    }
    reOrderNumber(){
        var c = 0;
        this.params.table.find('tr').each(function(){
            $(this).find('.orderNumber').html(c++);
        });
    }
}
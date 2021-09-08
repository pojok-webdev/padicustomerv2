initBro = _=>{
    repopulateProducts(_=>{
        totalProduct(tot=>{
            $("#totalProduct").html(tot)
        })
    })
}
hideProduct = callback =>{
    $('.product_detail').stairUp({level:2}).hide();
    callback()
}
saveProduct = (obj,callback) =>{
    $.ajax({
        url:'/pfbses/saveproduct',
        data:obj,
        type:'post'
    })
    .done(res=>{
        console.log('Success saveproduct',res)
        callback()
    })
    .fail(err=>{
        console.log('Errro saveproduct',err)
    });
}
removeProduct = (obj,callback) => {
    $.ajax({
        url:'/pfbses/removeproduct',
        data:{id:obj.id},
        type:'post'
    })
    .done(sql=>{
        console.log('Remove sql',sql)
        callback()
    })
    .fail(err=>{
        console.log('Error remove Product',err)
    })
}
totalProduct = callback=>{
    callback($('#tProduct tbody tr').length)
}
repopulateProducts = callback=> {
    $.ajax({
        url:'/pfbses/getproducts',
        data:{nofb:nofb},
        type:'post',
        dataType:'json'
    })
    .done(products=>{
        console.log('products',products)
        $('#tProduct tbody tr').empty();
        products.forEach(product => {
            console.log("Product",product)
            tr ='<tr thisid='+product.id+'>';
            tr+='<td class="servicecategory">'+product.category_id+'</td>';
            tr+='<td class="info">';
            tr+='<a>'+product.product_id+'</a>';
            tr+='<span class="detail_id" detail_id='+'+product.detail_id+'+'>'+product.detail+'</span>';
            tr+='</td>';
            tr+='<td>';
            tr+='<div class="btn-group">';
            tr+='<button data-toggle="dropdown" class="btn btn-small dropdown-toggle"  > Aksi ';
            tr+='<span class="caret"></span>';
            tr+='</button>';
            tr+='<ul class="dropdown-menu pull-right">';
            tr+='<li class="remove_product"><a>Hapus</a></li>';
            tr+='</ul>';
            tr+='</div>';
            tr+='</td>';
            tr+='</tr>';
        $('#tProduct tbody').append(tr)
        callback()
        });
    })
    .fail(err=>{
        console.log('Error repopulate products',err)
    })
}
$('#tProduct').on('click','tbody .remove_product',function(){
    tr = $(this).stairUp({level:4})
    console.log('TR',tr.html())
    tr.remove();
    removeProduct({id:tr.attr('thisid')},_=>{
        totalProduct(tot=>{
            $("#totalProduct").html(tot)
        })    
    })
})
$('.btn_addproduct').click(_=>{
    $('#dAddProduct').modal();
});
$('#product_products').change(function(){
    selectedId = $(this).val()
    console.log("SelectedID",selectedId)
    hideProduct(_=>{
        $('#'+selectedId).stairUp({level:2}).show()
        $('#'+selectedId+'category').stairUp({level:2}).show()
    })
});
$("#dAddProduct").on("show.bs.modal",function(){
    $('#product_products').change();
})
$("#product_btnservicesave").click(function(){
    let product_id = $('#product_products').val()
    switch(product_id){
        case 'product_internet':
            saveProduct({
                nofb:nofb,
                category_id:1,
                product_id:$('#product_internetcategory').val(),
                detail:$('#product_internet :selected').text(),
                detail_id:$('#product_internet').val()
            },_=>{
                repopulateProducts(_=>{
                    totalProduct(tot=>{
                        $("#totalProduct").html(tot)
                    })
                })
            })
        break;
        case 'product_devices':
            saveProduct({
                nofb:nofb,
                category_id:2,
                product_id:$('#product_devicescategory').val(),
                detail:$('#product_devices :selected').text(),
                detail_id:$('#product_devices').val()
            },_=>{
                repopulateProducts(_=>{
                    totalProduct(tot=>{
                        $("#totalProduct").html(tot)
                    })
                })
            })
        break;
        case 'product_vases':
            saveProduct({
                nofb:nofb,
                category_id:3,
                product_id:$('#product_vasescategory').val(),
                detail:$('#product_vases :selected').text(),
                detail_id:$('#product_vases').val(),
            },_=>{
                repopulateProducts(_=>{
                    totalProduct(tot=>{
                        $("#totalProduct").html(tot)
                    })
                })
            })
        break;
    }
});
$("#product_vasescategory").change(function(){});
initBro()

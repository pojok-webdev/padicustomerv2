(function($){
	$("#usedmaterial").html("");
	$.getJSON(thisdomain+'materials/get_name_by_parent/'+$("#materialtype").val(),function(data){
		$.each(data,function(x,y){
			$("#usedmaterial").append('<option value='+y+'>'+y+'</option>');
		});
	});
	$(".btn_addmaterial").click(function(){
		$('.updateusedmaterial').hide();
		$("#dUsedMaterial").modal();
	});
	$("#materialtype").change(function(){
		$("#usedmaterial").fill_material($(this).val());
	});
	$('.saveusedmaterial').click(function(){
		$.ajax({
			url:'/install_materials/add',
			data:{install_site_id:$('#workplace').attr('install_site_id'),
			material_id:$('#usedmaterial :selected').val(),
			tipe:$('#materialtype :selected').text(),
			name:$('#usedmaterial :selected').text(),
			description:$('#usedmaterialdescription').val(),
			createuser:''},
			type:'post'
		})
		.done(function(res){
			$('#tbl_usedmaterial').append('<tr thisid='+res+'><td>'+$('#materialtype :selected').text()+'</td><td class="info"><a>'+$('#usedmaterial :selected').text()+'</a> </td><td>'+$('#usedmaterialdescription').val()+'</td><td><a><span class="icon-trash remove_material pointer" material_id="'+res+'" ></span></a></td></tr>');
			$('#dUsedMaterial').modal('hide');
			update_rowcount($("#total_material"),$("#tbl_usedmaterial tbody tr"));
		})
		.fail(function(err){
			console.log('Tidak dapat menyimpan meterial',err);
			alert('Tidak dapat menyimpan material');
		});
/*		$.post('/install_materials/add',{install_site_id:$('#workplace').attr('install_site_id'),material_id:$('#usedmaterial :selected').val(),tipe:$('#materialtype :selected').text(),name:$('#usedmaterial :selected').text(),description:$('#usedmaterialdescription').val(),createuser:''}).done(function(data){
			$('#tbl_usedmaterial').append('<tr thisid='+data+'><td>'+$('#materialtype :selected').text()+'</td><td class="info"><a>'+$('#usedmaterial :selected').text()+'</a> </td><td>'+$('#usedmaterialdescription').val()+'</td><td><a><span class="icon-trash remove_material pointer" material_id="'+data+'" ></span></a></td></tr>');
			$('#dUsedMaterial').modal('hide');
			update_rowcount($("#total_material"),$("#tbl_usedmaterial tbody tr"));
		}).fail(function(){
			alert('Tidak dapat menyimpan material, silakan hubungi Developer');
		});*/
	});
	$("#tbl_usedmaterial").on("click",".remove_material",function(){
		$("#tbl_usedmaterial tr").removeClass('selected');
		var selected = $(this).stairUp({level:3});
		selected.addClass('selected');
		console.log(selected.attr("thisid"));
		$("#dConfirmation").removeConfirmation({
			removeUrl:thisdomain+"install_materials/delete",
			idElement:selected.attr("thisid"),
			selectedElement:selected,
			totalElement:"total_material",
			tableElement:"tbl_usedmaterial",
		});
	});
	$("#tbl_usedmaterial").on("click",".edit_material",function(){
		$("#tbl_usedmaterial tr").removeClass('selected');
		var selected = $(this).stairUp({level:3});
		selected.addClass('selected');
		$.ajax({
			url:'/install_requests/getinstallmaterial/'+selected.attr('thisid'),
			dataType:'json'
		})
		.done(function(data){
			console.log('success get materials',data);
			$('#materialtype option').each(function(x,y){
				console.log('x',y.value);
				if($(this).text()===data.tipe){
					$(this).attr('selected','selected');
					$("#materialtype").change();
				}
			})
			$('#usedmaterialdescription').val(data.description);
			$('#saveusedmaterial').hide();
			$('#updateusedmaterial').show();
			$("#dUsedMaterial").modal();
		})
		.fail(function(err){
			console.log('Error get materials',err);
		});
	})
	$('#updateusedmaterial').click(function(){
		console.log('USED MATERIAL',$('#usedmaterial').val());
		console.log('SELECTED TR',$('#tbl_usedmaterial tr.selected').attr('thisid'));
		$.ajax({
			url:'/install_requests/updatematerial',
			data:{
				material_id:$('#usedmaterial').val(),
				tipe:$('#materialtype :selected').text(),
				description:$('#usedmaterialdescription').val(),
				name:$('#usedmaterial').text(),
				id:$("#tbl_usedmaterial tr.selected").attr('thisid')
			},
			type:'post'
		})
		.done(function(res){
			console.log('Result',res);
			$('#tbl_usedmaterial tr.selected').find('.tipe').html($('#materialtype :selected').text());
			$('#tbl_usedmaterial tr.selected').find('.info').html($('#usedmaterial').text());
			$('#tbl_usedmaterial tr.selected').find('.description').html($('#usedmaterialdescription').val());
		})
		.fail(function(err){
			console.log('Error',err);
		});
	});
}(jQuery))
$.fn.fill_material = function(materialtype,selected){
	console.log(materialtype);
	console.log(selected);
	$(this).html("");
	thisap = $(this);
	$.getJSON('/materials/get_name_by_parent/'+materialtype,function(data){
		$.each(data,function(x,y){
			if(selected==y){
				console.log("selected"+y);
				thisap.append('<option value='+x+' selected=selected>'+y+'</option>');
			}else{
				console.log("not selected"+y);
				thisap.append('<option value='+x+'>'+y+'</option>');
			}
		});
	});
}

(function($){
	$('.addresume').click(function(){
		$('#resume_name').val('')
		$("#updatesurveyresume").hide();
		$("#savesurveyresume").show();
		$('#dAddResume').modal();
	});
	$('.resume_edit').click(function(){
		$(this).callresumeedit();
	});
	$('#savesurveyresume').click(function(){
		$(".inp_resume").makekeyvalparam();
		$.ajax({
			url:'/surveys/saveresume',
			//data:JSON.parse('{'+$(".inp_resume").attr("keyval")+'}'),
			data:{
				survey_site_id:$('#survey_site_id').val(),
				name:$('#resume').val()
			},
			type:'post',
		}).done(function(data){
			$('#dAddResume').modal('hide');
			$('#tblResume tbody').append('<tr rowid='+data+' class="resumerow"><td class="info"><a class="resume_edit pointer">'+$('#resume').val()+'</a></td><td><a><span class="icon-remove resume_remove"></span></a><a><span class="icon-edit"></span></a></td></tr>');
				$('.resume_remove').bind('click',function(){
					thisrow = $(this).stairUp({level:3});
					$.post(thisdomain+"surveys/dropresume",{id:thisrow.attr('rowid')}).done(function(data){
						thisrow.fadeOut(200).remove();
						update_rowcount($("#total_resume"),$("#tblResume tbody tr"));
						$(this).showModal({
							message:"Resume Sudah dihapus",
							expire:1000
						});
					}).fail(function(data){
						alert('Tidak dapat menghapus Resume, silakan hubungi Developer');
					});
				});
				$('.resume_edit').bind('click',function(){
					$(this).callresumeedit();
				});
				update_rowcount($("#total_resume"),$("#tblResume tbody tr"));
		}).fail(function(err){
			console.log('Fail save saveresume',err);
			alert('Tidak dapat menyimpan Resume, silakan hubungi Developer');
		});
	});
	$('#updatesurveyresume').click(function(){
		myid = $(this).attr('resume_id');
		$('.inp_resume').makekeyvalparam();
		$.post(thisdomain+'survey_resumes/update',JSON.parse('{"id":'+myid+','+$('.inp_resume').attr('keyval')+'}')).done(function(data){
			$(".resumerow.selected").find('.info').html('<a>'+$("#resume").val()+'</a>');
			$('#dAddResume').modal('hide');
		}).fail(function(){
			alert("Tidak dapat mengupdate Resume, silakan menghubungi Developer");
		});
	});
	$('.resume_remove').click(function(){
		var thisrow = $(this).stairUp({level:3});
		$.ajax({
			url:thisdomain+'surveys/dropresume',
			data:{id:thisrow.attr('rowid')},
			type:'post'
		}).done(function(){
			thisrow.fadeOut(200).remove();
			update_rowcount($("#total_resume"),$("#tblResume tbody tr"));
			$(this).showModal({
				message:"Resume Sudah dihapus",
				expire:1000
			});
		}).fail(function(){
			alert("Tidak dapat menghapus Resume, silakan hubungi Developer");
		});
	});
	$.fn.callresumeedit = function(){
		resume_id = $(this).stairUp({level:2}).attr('rowid');
		console.log("rowid",resume_id);
		$('.resumerow').removeClass("selected");
		$(this).stairUp({level:2}).addClass("selected");
		$("#updatesurveyresume").show();
		$("#savesurveyresume").hide();
		$.getJSON('/survey_resumes/get/'+resume_id,function(data){
			console.log('survey_resume',data)
			//$('#resume').cleditor()[0].execCommand('inserthtml',data['name']);
			$editor = $("#resume").cleditor();
			$('#resume').val(data['name']);
			$editor[0].updateFrame();
			$("#updatesurveyresume").attr('resume_id',resume_id);
			$('#dAddResume').modal();
		});
	}
}(jQuery))

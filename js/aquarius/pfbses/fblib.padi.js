function showModal(srcElement,modalElement,callback){
	modalElement.modal();
	callback(modalElement,srcElement);
}
setstring = function(_type="up"){
	var out='';
	switch(_type){
		case "up":
			comparable = $("#upk").val();
		break;
		case "down":
			comparable = $("#dnk").val();
		break;
	}
	switch(comparable){
		case "128":
			out = "125";
		break;
		case "256":
			out = "25";
		break;
		case "384":
			out = "375";
		break;
		case "512":
			out = "5";
		break;
		case "640":
			out = "625";
		break;
		case "768":
			out = "75";
		break;
		case "896":
			out = "875";
		break;
	}
	switch(_type){
		case "up":
			out = $("#upm").val()+"."+out;
			$("#upstring").val(out);
		break;
		case "down":
			out = $("#dnm").val()+"."+out;
			$("#dnstring").val(out);
		break;
	}
	return out;
}
$.fn.choosevaluem = function(opt){
	var that = $(this),
		settings = $.extend({
			modal:$('#dServiceDetailMega'),
			yesButton:".serval",
			affected:"",
			updown:"up"
		},opt);
	return $(this).each(function(){
		sElm = $(this);
		sElm.click(function(){
			showModal($(this),settings.modal,function(mE,sE){
				mE.on('click','.serval',function(){
					sE.val($(this).html().trim());
					settings.affected.val($(this).html().trim());
					mE.hide();
					mE.remove();
					$('.modal-backdrop').remove();
					setstring(settings.updown);
				});
			});
		});
	});
}

function isEmpty( el ){
    return (!$.trim(el.html()))&&(!$.trim(el.val()))
}
validate = function(){
    console.log('cajsecausecategory',$('#causecategory').val());
    console.log('cajse',$('#cause').val());
    console.log('fuDescription',$('#fuDescription').val());
    out = true
    if (isEmpty($('#followUpPIC'))) {
        console.log('PIC tidak boleh kosing');
        out = false;
    }else if (isEmpty($('#picPosition'))) {
        console.log('PIC position tidak boleh kosing');
        out = false;
    }else if (isEmpty($('#picPhone'))) {
        console.log('PIC phone tidak boleh kosing');
        out = false;
    }else if (isEmpty($('#confirmationresult'))) {
        console.log('confirmationresult tidak boleh kosing');
        out = false;
    }else if (isEmpty($('#solusi'))) {
        console.log('solusi tidak boleh kosing');
        out = false;
    }else if (isEmpty($('#fuDescription'))) {
        console.log('fuDescription tidak boleh kosing');
        out = false;
    }else if ($('#causecategory').val()==0) {
        console.log('Main Root Cause should be choosed');
        out = false;
    } else if ($('#cause').val()=='Pilihlah'){
        console.log('Sub Root Cause should be choosen');
        out = false;
        return false;
    }else {
        return true;
    }
}
$('#ticketcontent').click(function(){
    if(validate()){
        console.log('validated');
    }else{
        alert('isian belum lengkap');
    };
})
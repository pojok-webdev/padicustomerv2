function preparePrint(callback){
    document.getElementsByClassName('navigator').setAttribute('display','none');
    callback(winPrint());
}
function printPageArea(){
    console.log("Print Area Invoked");
    var printContent = document.getElementById('printArea');
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
function winPrint(){
    window.print();
}
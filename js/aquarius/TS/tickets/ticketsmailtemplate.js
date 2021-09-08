ticketMailTemplate = function(obj,callback){
    bodytext = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    bodytext += '<html xmlns="http://www.w3.org/1999/xhtml">';
    bodytext += '<head>';
    bodytext += '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    bodytext += '</head>';
    bodytext += '<body yahoo bgcolor="red">';
    bodytext += '<table width="100%" bgcolor="white" border="0" cellpadding="0" cellspacing="0">';
    bodytext += '<tr>';
    bodytext += '<td>';
    bodytext += '<table class="content" align="center" cellpadding="10" cellspacing="0" border="0" width="60%">';
    bodytext += '<thead bgcolor="#FFFF00">';
    bodytext += '<tr>';
    bodytext += '<td>';
    bodytext += '<img src="/img/aquarius/logo.png" alt="PadiApp" title="PadiApp"/>';
    bodytext += '</td>';
    bodytext += '</tr>';
    bodytext += '</thead>';

    bodytext += '<tbody bgcolor="#FFFF66" link="white">';

    bodytext += '<tr bgcolor="#FFFF00" color="white">';
    bodytext += '<td>';
    bodytext += '<font color="black">';
    bodytext += 'Sebuah ticket baru dibuat atas nama <span style="font-family: arial,times, serif; font-size:14pt; font-style:bold">';
    bodytext += '<u>'+ obj.clientname + '</u></span>';
    bodytext += '</font>';
    bodytext += '</td>';
    bodytext += '</tr>';

    bodytext += '<tr bgcolor="#FFFF00" color="white">';
    bodytext += '<td>';
    bodytext += '<font color="black">';
    bodytext += '<u></u>';
    bodytext += '</font>';
    bodytext += '</td>';
    bodytext += '</tr>';

    bodytext += '<tr bgcolor="#FFFF00" color="white">';
    bodytext += '<td >';
    bodytext += '<font color="black">';
    bodytext += 'Aplikasi dapat diakses melalui tautan <u><a href='+ obj.url + '/filter/'+obj.data+'>ini</a></u>';
    bodytext += '</font>';
    bodytext += '</td>';
    bodytext += '</tr>';
    
    bodytext += '<tr bgcolor="#FFFF00" color="white">';
    bodytext += '<td >';
    bodytext += '<font color="black">';
    bodytext += 'TS : '+ obj.createuser + '';
    bodytext += '</font>';
    bodytext += '</td>';
    bodytext += '</tr>';



    bodytext += '</tbody>';
    bodytext += '<tfoot>';

    bodytext += '<tr bgcolor="#CCFFFF">';
    bodytext += '<td align="center">';
    bodytext += '<p style="font-family: arial,times, serif; font-size:11pt; font-style:italic">By PadiApp 2015</p>';
    bodytext += '</td>';
    bodytext += '</tr>';

    bodytext += '</tfoot>';
    bodytext += '</table>';
    bodytext += '</td>';
    bodytext += '</tr>';
    bodytext += '</table>';
    bodytext += '</html>';
    callback(bodytext);
}
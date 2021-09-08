<?php
function getfakepics($amount = 1){
    $src = array(
        array("name"=>"Ali","email"=>"ali@yahoo.com","position"=>"op manager","idnum"=>"SBY54213984854","telp"=>"031-182746","hp"=>"08812121008"),
        array("name"=>"Ahmad","email"=>"ahmad@gmail.com","position"=>"marketing chief","idnum"=>"SBY97605424315","telp"=>"031-665428","hp"=>"08812121436"),
        array("name"=>"Farid","email"=>"farid@yahoo.com","position"=>"it manager","idnum"=>"SBY76864324967","telp"=>"031-112632","hp"=>"08812121775"),
        array("name"=>"Gasim","email"=>"gasim@gmail.com","position"=>"ceo","idnum"=>"SBY7328924538","telp"=>"031-998642","hp"=>"08812121345"),
        array("name"=>"Iman","email"=>"iman@yahoo.com","position"=>"ga manager","idnum"=>"SBY76908524196","telp"=>"031-965361","hp"=>"08812121764"),
        array("name"=>"Hanif","email"=>"hanif@gmail.com","position"=>"purchasing manager","idnum"=>"SBY67439824573","telp"=>"031-870432","hp"=>"08812121345"),
        array("name"=>"Hamid","email"=>"hamid@yahoo.com","position"=>"owner","idnum"=>"SBY35284921","telp"=>"031-837561","hp"=>"08812121087"),
        array("name"=>"Ashim","email"=>"ashim@gmail.com","position"=>"commisioner","idnum"=>"SBY85484762","telp"=>"031-7621309","hp"=>"08812121345"),
        array("name"=>"Nizar","email"=>"nizar@yahoo.com","position"=>"field manager","idnum"=>"SBY87524888","telp"=>"031-665456","hp"=>"08812121987"),
        array("name"=>"Faruq","email"=>"faruq@gmail.com","position"=>"ga manager","idnum"=>"SBY99924531","telp"=>"031-887653","hp"=>"08812121246"),
        array("name"=>"Zubair","email"=>"zubair@yahoo.com","position"=>"it staff","idnum"=>"GRS12574329","telp"=>"031-231568","hp"=>"08812121345"),
        array("name"=>"Iqbal","email"=>"iqbal@gmail.com","position"=>"marketing staff","idnum"=>"MJK12324112","telp"=>"031-887379","hp"=>"08812121779"),
        array("name"=>"Wahsy","email"=>"wahsy@yahoo.com","position"=>"purchasing staff","idnum"=>"JKT12324255","telp"=>"031-245178","hp"=>"08812121231"),
        array("name"=>"Yusuf","email"=>"yusuf@gmail.com","position"=>"head of marketing","idnum"=>"GRS12324989","telp"=>"031-276145","hp"=>"08812121985"),
        array("name"=>"Qais","email"=>"qais@yahoo.com","position"=>"sales manager","idnum"=>"SBY12324221","telp"=>"031-987341","hp"=>"08812121122"),
        array("name"=>"Yahya","email"=>"yahya@gmail.com","position"=>"erp staff","idnum"=>"SBY7787555","telp"=>"031-908765","hp"=>"08812121886"),
    );
    $out = array();
    foreach(array_rand($src,$amount) as $key){
        array_push($out,$src[$key]);
    }
    return $out;
}
function getfakesiup(){
    $src = array( 
        array(
            "siup"=>"1122.548943.123","alamatsiup"=>"Simokerto 223",
            "npwp"=>"31.823.497.8-654.000","alamatnpwp"=>"Simokerto 223",
            "sppkp"=>"776.987865.2323","alamatsppkp"=>"Simokerto 223",
            "alamatpenagihan"=>"Diponegoro 144"
        ),
        array(
            "siup"=>"1122.887954.125","alamatsiup"=>"Rajawali 23",
            "npwp"=>"31.823.496.8-677.000","alamatnpwp"=>"Rajawali 23",
            "sppkp"=>"776.987549.8696","alamatsppkp"=>"Rajawali 23",
            "alamatpenagihan"=>"Mayjen Sungkono 88"
        ),
        array(
            "siup"=>"1122.629054.443","alamatsiup"=>"Kertajaya Indah Timur 2",
            "npwp"=>"31.823.497.8-654.000","alamatnpwp"=>"Kertajaya Indah Timur 2",
            "sppkp"=>"776.987865.2323","alamatsppkp"=>"Kertajaya Indah Timur 2",
            "alamatpenagihan"=>"Bawean 25"
        ),
        array(
            "siup"=>"1122.548943.129","alamatsiup"=>"Klampis 22",
            "npwp"=>"31.823.497.8-654.000","alamatnpwp"=>"Klampis 22",
            "sppkp"=>"776.987865.2323","alamatsppkp"=>"Klampis 1",
            "alamatpenagihan"=>"Wisma Mukti 94"
        ),
    );
    $out = array();
    $key = array_rand($src,1);
    return $src[$key];
}
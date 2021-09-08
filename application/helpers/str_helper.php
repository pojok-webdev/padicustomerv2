<?php
function strtoarray($str){
    $arr = array();
    for($c=0;$c<strlen($str);$c++){
        array_push($arr,substr($str,$c,1));
    }
    return $arr;
}
function joinarray($arr){
    return implode(",",$arr);
}
function strtocommaseparated($str){
    return joinarray(strtoarray($str));
}
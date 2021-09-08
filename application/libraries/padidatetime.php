<?php
class Padidatetime{
    function getmonthsarray($regional="id"){
        return array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
    }
    function getdaysarray($regional="id"){
        return array("Mon"=>"Senin","Tue"=>"Selasa","Wed"=>"Rabu","Thu"=>"Kamis","Fri"=>"Jumat","Sat"=>"Sabtu","Sun"=>"Minggu",);
    }
    function getmonthsarray2($regional="id"){
        return array(
            "01"=>"Januari",
            "02"=>"Februari",
            "03"=>"Maret",
            "04"=>"April",
            "05"=>"Mei",
            "06"=>"Juni",
            "07"=>"Juli",
            "08"=>"Agustus",
            "09"=>"September",
            "10"=>"Oktober",
            "11"=>"Nopember",
            "12"=>"Desember"
        );
    }
}
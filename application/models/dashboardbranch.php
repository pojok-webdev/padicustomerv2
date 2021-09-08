<?php
class Dashboardbranch extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getdailybranchreimburses($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from visits b ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailybranchreimburseslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)='".$date."' ";
        $sql.= "and a.transport = 'PMT' ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getweeklybranchreimburses($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from visits b  ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklybranchreimburseslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and a.transport = 'PMT' ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getmonthlybranchreimburses($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from visits b  ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlybranchreimburseslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.transport = 'PMT' ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getquarterlybranchreimburses($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from visits b  ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlybranchreimburseslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where quarter(date(a.visitdate))=quarter('".$date."') ";
        $sql.= "and a.transport = 'PMT' ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getyearlybranchreimburses($category,$date,$branch_id,$iscounted){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from visits b  ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlybranchreimburseslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.transport = 'PMT' ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }


    function getdailybranchoffers($category,$date,$branch_id){
        $sql = "select count(b.id)cnt from offers b ";
        $sql.= "where date(b.createdate)='".$date."' ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailybranchofferslist($category,$date,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)='".$date."' ";
        $sql.= "and a.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getweeklybranchoffers($category,$date,$branch_id){
        $sql = "select count(b.id)cnt from offers b ";
        $sql.= "where date(b.createdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklybranchofferslist($category,$date,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and a.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getmonthlybranchoffers($category,$date,$branch_id){
        $sql = "select count(b.id)cnt from offers b  ";
        $sql.= "where date(b.createdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlybranchofferslist($category,$date,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getquarterlybranchoffers($category,$date,$branch_id){
        $sql = "select count(b.id)cnt from offers b ";
        $sql.= "where quarter(date(b.createdate))=quarter('".$date."') ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlybranchofferslist($category,$date,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where quarter(date(a.createdate))=quarter('".$date."') ";
        $sql.= "and a.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getyearlybranchoffers($category,$date,$branch_id){
        $sql = "select count(b.id)cnt from offers b ";
        $sql.= "where date(b.createdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlybranchofferslist($category,$date,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }






    function getdailybranchvisits($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(nominalreimburse)tot from visits b ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailybranchvisitslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)='".$date."' ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getweeklybranchvisits($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(nominalreimburse)tot from visits b  ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklybranchvisitslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getmonthlybranchvisits($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(nominalreimburse)tot from visits b  ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlybranchvisitslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getquarterlybranchvisits($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(nominalreimburse)tot from visits b  ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlybranchvisitslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where quarter(date(a.visitdate))=quarter('".$date."') ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getyearlybranchvisits($category,$date,$branch_id,$iscounted){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(nominalreimburse)tot from visits b  ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlybranchvisitslist($category,$date,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }


    function getdailybranchfbs($category,$date,$branch_id){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)='".$date."' ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }


    function getdailybranchfbslist($category,$date,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)='".$date."' ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getweeklybranchfbs($category,$date,$branch_id){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklybranchfbslist($category,$date,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getmonthlybranchfbs($category,$date,$branch_id){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlybranchfbslist($category,$date,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getquarterlybranchfbs($category,$date,$branch_id){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where quarter(date(a.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(a.activationdate) = year('".$date."') ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlybranchfbslist($category,$date,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where quarter(date(a.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(a.activationdate) = year('".$date."') ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getyearlybranchfbs($category,$date,$branch_id){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlybranchfbslist($category,$date,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }




    function getdailybranchnominalsales($category,$date,$branch_id){
        $sql = "select case when sum(c.fee) is null then '0' else sum(c.fee) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name = 'monthly') c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)='".$date."' ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklybranchnominalsales($category,$date,$branch_id){
        $sql = "select case when sum(c.fee) is null then '0' else sum(c.fee) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name = 'monthly') c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlybranchnominalsales($category,$date,$branch_id){
        $sql = "select case when sum(c.fee) is null then '0' else sum(c.fee) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name = 'monthly') c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlybranchnominalsales($category,$date,$branch_id){
        $sql = "select case when sum(c.fee) is null then '0' else sum(c.fee) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name = 'monthly') c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where quarter(date(b.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(b.activationdate) = year('".$date."') ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlybranchnominalsales($category,$date,$branch_id){
        $sql = "select case when sum(c.fee) is null then '0' else sum(c.fee) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name = 'monthly') c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }


    function getdailynationalvisits($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from visits b ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailynationalvisitslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select * from visits b ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getweeklynationalvisits($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from visits b ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklynationalvisitslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select * from visits b ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getmonthlynationalvisits($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from visits b ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlynationalvisitslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select * from visits b ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getquarterlynationalvisits($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from visits b ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlynationalvisitslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select * from visits b ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getyearlynationalvisits($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from visits b ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlynationalvisitslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select * from visits b ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
        
    function getdailynationaloffers($category,$date){
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from offers b ";
        $sql.= "where date(b.createdate)='".$date."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailynationalofferslist($category,$date){
        $sql = "select  a.id,a.kdoffer,a.clientname,a.address,a.sale_id,a.email,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am  from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)='".$date."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getweeklynationaloffers($category,$date){
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from offers b ";
        $sql.= "where date(b.createdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklynationalofferslist($category,$date){
        $sql = "select  a.id,a.kdoffer,a.clientname,a.address,a.sale_id,a.email,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am  from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getmonthlynationaloffers($category,$date){
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from offers b ";
        $sql.= "where date(b.createdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlynationalofferslist($category,$date){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.sale_id,a.email,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getquarterlynationaloffers($category,$date){
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from  offers b ";
        $sql.= "where quarter(date(b.createdate))=quarter('".$date."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlynationalofferslist($category,$date){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from  offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where quarter(date(a.createdate))=quarter('".$date."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getyearlynationaloffers($category,$date){
        $sql = "select case when count(b.id) is null then '0' else count(b.id) end cnt from  offers b ";
        $sql.= "where date(b.createdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlynationalofferslist($category,$date){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.createdate,offerdate,b.username am from  offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.createdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
        
    function getdailynationalfbs($category,$date){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)='".$date."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailynationalfbslist($category,$date){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)='".$date."' ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getweeklynationalfbs($category,$date){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklynationalfbslist($category,$date){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getmonthlynationalfbs($category,$date){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlynationalfbslist($category,$date){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getquarterlynationalfbs($category,$date){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where quarter(date(a.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(a.activationdate) = year('".$date."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlynationalfbslist($category,$date){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where quarter(date(a.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(a.activationdate) = year('".$date."') ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getyearlynationalfbs($category,$date){
        $sql = "select case when count(a.nofb) is null then '0' else count(a.nofb) end cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlynationalfbslist($category,$date){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,d.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') d on d.nofb=a.nofb ";
        $sql.= "left outer join (";
        $sql.= "    select u.id from users u left outer join sales_branches s on s.user_id=u.id where s.user_id is not null) e ";
        $sql.= "    on e.id=b.sale_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
        
    function getdailynationalnominalsales($category,$date){
        $sql = "select case when sum(c.dpp) is null then '0' else sum(c.dpp) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)='".$date."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklynationalnominalsales($category,$date){
        $sql = "select case when sum(c.dpp) is null then '0' else sum(c.dpp) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlynationalnominalsales($category,$date){
        $sql = "select case when sum(c.dpp) is null then '0' else sum(c.dpp) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlynationalnominalsales($category,$date){
        $sql = "select case when sum(c.dpp) is null then '0' else sum(c.dpp) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where quarter(date(b.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(b.activationdate) = year('".$date."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlynationalnominalsales($category,$date){
        $sql = "select case when sum(c.fee) is null then '0' else sum(c.fee) end cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
        
    function getdailynationalreimburses($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailynationalreimburseslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)='".$date."' ";
        $sql.= "and a.transport = 'PMT' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return  $que->result();
    }
    function getweeklynationalreimburses($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklynationalreimburseslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and a.transport = 'PMT' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return  $que->result();
    }
    function getmonthlynationalreimburses($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlynationalreimburseslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.transport = 'PMT' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return  $que->result();
    }
    function getquarterlynationalreimburses($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlynationalreimburseslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where quarter(date(a.visitdate))=quarter('".$date."') ";
        $sql.= "and a.transport = 'PMT' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return  $que->result();
    }
    function getyearlynationalreimburses($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select case when sum(nominalreimburse) is null then '0' else sum(nominalreimburse) end tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlynationalreimburseslist($category,$date,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,";
        $sql.= "case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,nominalreimburse,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,";
        $sql.= "case a.transport ";
        $sql.= "when 'KK' then 'Kendaraan Kantor' ";
        $sql.= "when 'PMT' then 'Motor Pribadi' ";
        $sql.= "when 'PMB' then 'Mobil Pribadi' ";
        $sql.= "when 'TU' then 'Transportasi Umum' end transport,";
        $sql.= "receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.transport = 'PMT' ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $sql.= "order by visitdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }

}
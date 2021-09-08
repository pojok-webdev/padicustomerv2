<?php
class Dashboard extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getbtses(){
        $sql = "select a.id,a.name bts,a.location,b.name branch,count(c.name)apcount, count(d.ap_id)clientcount, ";
        $sql.= "group_concat(distinct f.name) backbones ";
        $sql.= "from btstowers a ";
        $sql.= "left outer join branches b on b.id=a.branch_id ";
        $sql.= "left outer join aps c on c.btstower_id=a.id ";
        $sql.= "left outer join client_sites_aps d on d.ap_id=c.id ";
        $sql.= "left outer join backbones_btses e on e.startpoint=a.id or e.endpoint=a.id ";
        $sql.= "left outer join backbones f on f.id=e.backbone_id ";
        $sql.= "where a.active='1' ";
        $sql.= "group by a.id,a.name,a.location,b.name ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        return array("res"=>$res,"tot"=>$tot);
    }
    function getbtsbackbones($btstower_id){
        $sql = 'select b.name startpoint,c.name endpoint,d.name backbone,a.capacity,a.location,a.backbonetype ';
        $sql.= 'from backbones_btses a left outer join btstowers b on a.startpoint=b.id ';
        $sql.= 'left outer join btstowers c on a.endpoint=c.id ';
        $sql.= 'left outer join backbones d on d.id=a.backbone_id ';
        $sql.= 'where c.id='.$btstower_id.' ';
        $sql.= 'or b.id='.$btstower_id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        return array("res"=>$res,"tot"=>$tot);
    }
    function getdailytickets($category,$date,$status){
        $sql = "select count(b.kdticket)cnt from clients a left outer join tickets b on b.client_id=a.id ";
        $sql.= "where date(create_date)='".$date."' ";
        $sql.= "and b.status = '" . $status . "' ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklytickets($category,$date,$status){
        $sql = "select count(b.kdticket)cnt from clients a left outer join tickets b on b.client_id=a.id ";
        $sql.= "where date(create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and b.status = '" . $status . "' ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlytickets($category,$date,$status){
        $sql = "select count(b.kdticket)cnt from clients a left outer join tickets b on b.client_id=a.id ";
        $sql.= "where date(create_date)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.status = '" . $status . "' ";
        $sql.= "and year(b.create_date)=year('".$date."') ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlytickets($category,$date,$status){
        $sql = "select count(b.kdticket)cnt from clients a left outer join tickets b on b.client_id=a.id ";
        $sql.= "where quarter(date(create_date))=quarter('".$date."') ";
        $sql.= "and b.status = '" . $status . "' ";
        $sql.= "and year(b.create_date)=year('".$date."') ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlytickets($category,$date,$status){
        $sql = "select count(b.kdticket)cnt from clients a left outer join tickets b on b.client_id=a.id ";
        //$sql.= "where date(create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "where year(date(create_date))=year('".$date."') ";
        $sql.= "and b.status = '" . $status . "' ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailysurveys($category,$date){
        $sql = "select count(b.id)cnt from clients a left outer join survey_requests b on b.client_id=a.id ";
        $sql.= "where date(create_date)='".$date."' ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklysurveys($category,$date){
        $sql = "select count(b.id)cnt from clients a left outer join survey_requests b on b.client_id=a.id ";
        $sql.= "where date(create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlysurveys($category,$date){
        $sql = "select count(b.id)cnt from clients a left outer join survey_requests b on b.client_id=a.id ";
        $sql.= "where date(create_date)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and year(b.create_date)=year('".$date."') ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlysurveys($category,$date){
        $sql = "select count(b.id)cnt from clients a left outer join survey_requests b on b.client_id=a.id ";
        //$sql.= "where date(create_date)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "where quarter(date(create_date))=quarter('".$date."') ";
        $sql.= "and year(b.create_date)=year('".$date."') ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlysurveys($category,$date){
        $sql = "select count(b.id)cnt from clients a left outer join survey_requests b on b.client_id=a.id ";
        //$sql.= "where date(create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "where year(date(create_date))=year('".$date."') ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailyinstalls($category,$date){
        $sql = "select count(c.id)cnt from clients a left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join install_requests c on c.client_site_id=b.id ";
        $sql.= "where date(c.create_date)='".$date."' ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklyinstalls($category,$date){
        $sql = "select count(c.id)cnt from clients a left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join install_requests c on c.client_site_id=b.id ";
        $sql.= "where date(c.create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlyinstalls($category,$date){
        $sql = "select count(c.id)cnt from clients a left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join install_requests c on c.client_site_id=b.id ";
        $sql.= "where date(c.create_date)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and year(c.create_date)=year('".$date."') ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlyinstalls($category,$date){
        $sql = "select count(c.id)cnt from clients a left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join install_requests c on c.client_site_id=b.id ";
        $sql.= "where quarter(date(c.create_date)) =quarter('".$date."') ";
        $sql.= "and year(c.create_date)=year('".$date."') ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlyinstalls($category,$date){
        $sql = "select count(c.id)cnt from clients a left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join install_requests c on c.client_site_id=b.id ";
        //$sql.= "where date(c.create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "where year(c.create_date)=year('".$date."') ";
        $sql.= "and a.clientcategory = '".$category."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailytroubleshoots($category,$date){
        $sql = "select count(c.id)cnt from clients a ";
        $sql.= "left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join troubleshoot_requests c on c.client_site_id=b.id ";
        $sql.= "where date(c.create_date)='".$date."' ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklytroubleshoots($category,$date){
        $sql = "select count(c.id)cnt from clients a ";
        $sql.= "left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join troubleshoot_requests c on c.client_site_id=b.id ";
        $sql.= "where date(c.create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlytroubleshoots($category,$date){
        $sql = "select count(c.id)cnt from clients a ";
        $sql.= "left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join troubleshoot_requests c on c.client_site_id=b.id ";
        $sql.= "where date(c.create_date)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and year(c.create_date)=year('".$date."') ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlytroubleshoots($category,$date){
        $sql = "select count(c.id)cnt from clients a ";
        $sql.= "left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join troubleshoot_requests c on c.client_site_id=b.id ";
        $sql.= "where quarter(date(c.create_date))=quarter('".$date."') ";
        $sql.= "and year(c.create_date)=year('".$date."') ";
//        $sql.= "where date(c.create_date)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }
$ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlytroubleshoots($category,$date){
        $sql = "select count(c.id)cnt from clients a ";
        $sql.= "left outer join client_sites b on b.client_id=a.id ";
        $sql.= "left outer join troubleshoot_requests c on c.client_site_id=b.id ";
        //$sql.= "where date(c.create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "where year(date(c.create_date))=year('".$date."') ";
        if($category=='0'){
            $sql.= "and a.clientcategory not in  ('1','2','3','4','5') ";
        }else{
            $sql.= "and a.clientcategory = '".$category."' ";
        }

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getSupervisedSales(){
        $ci = & get_instance();
        $sql = "select a.id spvid,a.username spvname,c.id usrid,c.username usrname from users a ";
        $sql.= "left outer join supervisors_users b on b.supervisor_id=a.id ";
        $sql.= "left outer join users c on c.id=b.user_id ";
        $sql.= "where a.id=".$ci->session->userdata["user_id"] . " ";
        $sql.= "and c.id is not null ";
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getSupervisedArray(){
        $arr = array();
        $ci = & get_instance();
        foreach($this->getSupervisedSales() as $supervised){
            array_push($arr,$supervised->usrid);
        }
        array_push($arr,$ci->session->userdata["user_id"]);
        $out = implode(",",$arr);
        return $out;
    }
    function isadmin(){
        $ci = get_instance();
        $sql = "select group_id from users where id=".$ci->session->userdata['user_id']." and group_id=1 ";
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows>0){
            return true;
        }
        return false;
    }
    function getsalesbranches(){
        $ci = & get_instance();
        $sql = "select a.id,username,basebranch,b.branch_id branch_id,";
        $sql.= "case b.branch_id ";
        $sql.= "when '1' then 'Surabaya' ";
        $sql.= "when '2' then 'Jakarta' ";
        $sql.= "when '3' then 'Malang' ";
        $sql.= "when '4' then 'Bali' end branch ";
        $sql.= "from users a ";
        $sql.= "left outer join sales_branches b on b.user_id=a.id ";
        $sql.= "where b.user_id is not null ";
        $sql.= "and a.active='1' ";
        if($this->isadmin()){
        $sql.= "and  a.id in (".$this->getSupervisedArray().") ";
        }else{
            $sql.= "and a.id=".$ci->session->userdata['user_id']." ";
        }
        $sql.= "order by username ";


        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getsalesbranchesbydaterange($date1,$date2){
        $sql = "select a.id,username,basebranch,b.branch_id branch_id,";
        $sql.= "case b.branch_id ";
        $sql.= "when '1' then 'Surabaya' ";
        $sql.= "when '2' then 'Jakarta' ";
        $sql.= "when '3' then 'Malang' ";
        $sql.= "when '4' then 'Bali' end branch, ";
        $sql.= "case when c.cnt is null then '0' else c.cnt end visitcount, ";
        $sql.= "case when d.cnt is null then '0' else d.cnt end offercount, ";
        $sql.= "case when e.cnt is null then '0' else e.cnt end visituncount ";

        $sql.= "from users a ";
        $sql.= "left outer join sales_branches b on b.user_id=a.id ";
        $sql.= "left outer join (select sale_id,branch,count(id)cnt from visits ";
        $sql.= " where visitdate between '" . $date1 . "' and '" . $date2 . "'  ";
        $sql.= " and iscounted='1' group by sale_id,branch) c ";
        $sql.= " on c.sale_id=b.user_id and c.branch=b.branch_id ";

        $sql.= "left outer join (select sale_id,branch,count(id)cnt from offers where ";
        $sql.= " offerdate between '" . $date1 . "' and '" . $date2 . "' ";
        $sql.= " group by sale_id,branch) d ";
        $sql.= " on d.sale_id=b.user_id and d.branch=b.branch_id ";

        $sql.= "left outer join (select sale_id,branch,count(id)cnt from visits ";
        $sql.= " where visitdate between '" . $date1 . "' and '" . $date2 . "'  ";
        $sql.= " and iscounted='0' group by sale_id,branch) e ";
        $sql.= " on e.sale_id=b.user_id and e.branch=b.branch_id ";



        $sql.= "where b.user_id is not null ";
        $sql.= "and a.active='1' ";
        $sql.= "and  a.id in (".$this->getSupervisedArray().") ";
        $sql.= "";
//        $sql.= "group by a.id,username,basebranch,b.branch_id ";
        $sql.= "order by username asc ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getlistoffersfilterbydate($date1,$date2,$sale_id,$branch_id){
        $sql = "select id,kdoffer,clientname,address,pic,uc,source,offerdate from offers ";
        $sql.= "where sale_id=".$sale_id." and offerdate between '".$date1."' and '".$date2."' ";
        $sql.= "and branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getlistvisitsfilterbydate($date1,$date2,$sale_id,$branch_id,$iscounted){
        $sql = "select id,visitstart,visitfinish,clientname,address,pic,aim,transport,longitude,latitude,visitdate from visits ";
        $sql.= "where sale_id=".$sale_id." and visitdate between '".$date1."' and '".$date2."' ";
        $sql.= "and branch=".$branch_id." ";
        $sql.= "and iscounted = '" . $iscounted . "' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getbranchesbydaterange($date1,$date2){
        $sql = "select a.name,sum(c.visitcnt)visitcnt,sum(d.offercnt)offercnt,sum(e.visitcnt)visituncnt ";
        $sql.= "from branches a left outer join sales_branches b on b.branch_id=a.id ";

        $sql.= "left outer join (select sale_id,branch,count(id)visitcnt from visits ";
        $sql.= "where visitdate between '" . $date1 . "' and '" . $date2 . "' ";        
        $sql.= "and iscounted='1' ";
        $sql.= "group by sale_id,branch) c on c.sale_id=b.user_id and c.branch=b.branch_id ";

        $sql.= "left outer join (select sale_id,branch,count(id)offercnt from offers ";
        $sql.= "where offerdate between '" . $date1 . "' and '" . $date2 . "'  ";
        $sql.= "group by sale_id,branch) d on d.sale_id=b.user_id and d.branch=b.branch_id ";
        $sql.= "and  b.user_id in (".$this->getSupervisedArray().") ";

        $sql.= "left outer join (select sale_id,branch,count(id)visitcnt from visits ";
        $sql.= "where visitdate between '" . $date1 . "' and '" . $date2 . "' ";
        $sql.= "and iscounted='0' ";
        $sql.= "group by sale_id,branch) e on e.sale_id=b.user_id and e.branch=b.branch_id ";

        $sql.= "group by a.name ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getnationalbydaterange($date1,$date2){
        $sql = "select A.cnt visit,B.cnt offer,C.cnt visituncnt from (select 'x' x)Z left outer join ";
        $sql.= "(select 'x' x,count(id) cnt from visits ";
        $sql.= " where visitdate between '".$date1."' and '".$date2."' and iscounted='1' )A ";
        $sql.= " on A.x=Z.x ";
        $sql.= "left outer join ";
        $sql.= "(select 'x' X, count(id)cnt from offers ";
        $sql.= " where offerdate between '".$date1."' and '".$date2."') B ";
        $sql.= " on B.x=Z.x ";
        $sql.= "left outer join ";
        $sql.= "(select 'x' x,count(id) cnt from visits ";
        $sql.= " where visitdate between '".$date1."' and '".$date2."' and iscounted='0' )C ";
        $sql.= " on C.x=Z.x ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getsales(){
        $sql = "select a.id,username,basebranch from users a ";
        $sql.= "left outer join usercategories b on b.user_id=a.id ";
        $sql.= "where b.usercategory_id=1 ";
        $sql.= "and a.active='1' ";
        $sql.= "order by username ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'tot'=>$que->num_rows()
        );
    }
    function getdailyvisits($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        //$sql.= "and a.id in (". $this->getSupervisedArray() .") ";
        $sql.= "and a.id = ". $sale_id ." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailyvisitslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,a.pic,a.hp,a.aim,case a.transport when 'KK' then 'Kendaraan Kantor' when 'PMT' then 'Motor Pribadi' when 'PMB' then 'Mobil Pribadi' when 'TU' then 'Transportasi Umum' end transport,receiptimage,a.createdate ";
        $sql.= "from visits a ";
        $sql.= "where date(a.visitdate)='".$date."' ";
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getweeklyvisits($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklyvisitslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,a.pic,a.hp,a.aim,case a.transport when 'KK' then 'Kendaraan Kantor' when 'PMT' then 'Motor Pribadi' when 'PMB' then 'Mobil Pribadi' when 'TU' then 'Transportasi Umum' end transport,receiptimage,a.createdate from visits a ";
        $sql.= "where date(a.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getmonthlyvisits($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlyvisitslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,a.pic,a.hp,a.aim,case a.transport when 'KK' then 'Kendaraan Kantor' when 'PMT' then 'Motor Pribadi' when 'PMB' then 'Mobil Pribadi' when 'TU' then 'Transportasi Umum' end transport,receiptimage,a.createdate from visits a ";
        $sql.= "where date(a.visitdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getquarterlyvisits($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        $sql.= "and year(visitdate)=year(now()) ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlyvisitslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,a.pic,a.hp,a.aim,case a.transport when 'KK' then 'Kendaraan Kantor' when 'PMT' then 'Motor Pribadi' when 'PMB' then 'Mobil Pribadi' when 'TU' then 'Transportasi Umum' end transport,receiptimage,a.createdate from visits a ";
        $sql.= "where quarter(date(a.visitdate))=quarter('".$date."') ";
        $sql.= "and year(visitdate)=year(now()) ";
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getyearlyvisits($category,$date,$sale_id,$branch_id,$iscounted){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlyvisitslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        print_r($branch_id);
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select a.id,a.clientname,a.address,date_format(a.visitdate,'%d %b %Y')visitdate,case iscounted when '1' then 'Ya' when '0' then 'Tidak' end iscounted ,";
        $sql.= "a.phone,date_format(a.visitstart,'%H:%i')visitstart,date_format(a.visitfinish,'%H:%i')visitfinish,";
        $sql.= "a.pic,a.hp,a.aim,case a.transport when 'KK' then 'Kendaraan Kantor' when 'PMT' then 'Motor Pribadi' when 'PMB' then 'Mobil Pribadi' when 'TU' then 'Transportasi Umum' end transport,receiptimage,a.createdate from visits a ";
        $sql.= "where date(a.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getvisit($id){
        $sql = "select * from visits ";
        $sql.= "where id=".$id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }
        return false;
    }
    function getoffer($id){
        $sql = "select * from offers ";
        $sql.= "where id=".$id." ";
        $sql.= "order by kdoffer ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }
        return false;
    }
    function getofferservices($offer_id){
        $sql = "select * from offer_services ";
        $sql.= "where offer_id=".$offer_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getdailyoffers($category,$date,$sale_id,$branch_id){
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join offers b on b.sale_id=a.id ";
        $sql.= "where date(b.offerdate)='".$date."' ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailyofferslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.offerdate)='".$date."' ";
        $sql.= "and a.sale_id=".$sale_id." ";
        $sql.= "and a.branch=".$branch_id." ";
        $sql.= "order by kdoffer ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getweeklyoffers($category,$date,$sale_id,$branch_id){
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join offers b on b.sale_id=a.id ";
        $sql.= "where date(b.offerdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklyofferslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.offerdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and a.sale_id=".$sale_id." ";
        $sql.= "and a.branch=".$branch_id." ";
        $sql.= "order by kdoffer ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getmonthlyoffers($category,$date,$sale_id,$branch_id){
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join offers b on b.sale_id=a.id ";
        $sql.= "where date(b.offerdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlyofferslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.offerdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.sale_id=".$sale_id." ";
        $sql.= "and a.branch=".$branch_id." ";
        $sql.= "order by kdoffer ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getquarterlyoffers($category,$date,$sale_id,$branch_id){
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join offers b on b.sale_id=a.id ";
        $sql.= "where quarter(date(b.offerdate))=quarter('".$date."') ";
        $sql.= "and year(offerdate)=year(now()) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlyofferslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where quarter(date(a.offerdate))=quarter('".$date."') ";
        $sql.= "and year(offerdate)=year(now()) ";
        $sql.= "and a.sale_id=".$sale_id." ";
        $sql.= "and a.branch=".$branch_id." ";
        $sql.= "order by kdoffer ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getyearlyoffers($category,$date,$sale_id,$branch_id){
        $sql = "select count(b.id)cnt from users a ";
        $sql.= "left outer join offers b on b.sale_id=a.id ";
        $sql.= "where date(b.offerdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlyofferslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.id,a.kdoffer,a.clientname,a.address,a.email,a.sale_id,a.pic,a.uc,a.source,a.offerdate,b.username am from offers a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where date(a.offerdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.sale_id=".$sale_id." ";
        $sql.= "and a.branch=".$branch_id." ";
        $sql.= "order by kdoffer ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }






    function getdailyfbs($category,$date,$sale_id,$branch_id){
        $sql = "select count(a.nofb)cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)='".$date."' ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }


    function getdailyfbslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)='".$date."' ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getweeklyfbs($category,$date,$sale_id,$branch_id){
        $sql = "select count(a.nofb)cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklyfbslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getmonthlyfbs($category,$date,$sale_id,$branch_id){
        $sql = "select count(a.nofb)cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlyfbslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getquarterlyfbs($category,$date,$sale_id,$branch_id){
        $sql = "select count(a.nofb)cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where quarter(date(a.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(a.activationdate) = year('".$date."') ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlyfbslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where quarter(date(a.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(a.activationdate) = year('".$date."') ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getyearlyfbs($category,$date,$sale_id,$branch_id){
        $sql = "select count(a.nofb)cnt from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlyfbslist($category,$date,$sale_id,$branch_id){
        $sql = "select a.nofb,a.name,group_concat(c.name)service,a.activationdate,a.activationdate,c.fee from fbs a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join fbservices c on c.fb_id=a.nofb ";
        $sql.= "left outer join (select nofb,dpp+ppn fee from fbfees where name='monthly') c on c.nofb=a.nofb ";
        $sql.= "where date(a.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and b.sale_id=".$sale_id." ";
        $sql.= "and b.branch_id=".$branch_id." ";
        $sql.= "group by  a.nofb,a.name,a.activationdate,a.activationdate ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }







    function getdailynominalsales($category,$date,$sale_id,$branch_id){
        $sql = "select sum(c.dpp)cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)='".$date."' ";
        $sql.= "and d.user_id=".$sale_id." ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklynominalsales($category,$date,$sale_id,$branch_id){
        $sql = "select sum(c.dpp)cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
        $sql.= "and d.user_id=".$sale_id." ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlynominalsales($category,$date,$sale_id,$branch_id){
        $sql = "select sum(c.dpp)cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and d.user_id=".$sale_id." ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlynominalsales($category,$date,$sale_id,$branch_id){
        $sql = "select sum(c.dpp)cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where quarter(date(b.activationdate))>=quarter('".$date."') ";
        $sql.= "and year(b.activationdate) = year('".$date."') ";
        $sql.= "and d.user_id=".$sale_id." ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlynominalsales($category,$date,$sale_id,$branch_id){
        $sql = "select sum(c.dpp)cnt from ";
        $sql.= "fbs b ";
        $sql.= "left outer join fbfees c on c.nofb=b.nofb ";
        $sql.= "left outer join clients d on d.id=b.client_id ";
        $sql.= "where date(b.activationdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and d.user_id=".$sale_id." ";
        $sql.= "and d.branch_id=".$branch_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }




    function gettotaltroubleshoots(){
        $sql = "select count(id) cnt from troubleshoot_requests ";
        $sql.= "where status='0' ";
        $sql.= "and month(create_date) = month(now()) and year(create_date) = year(now()) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function gettotaltickets(){
        $sql = "select count(id) cnt from tickets ";
        $sql.= "where status='0' ";
        $sql.= "and month(create_date) = month(now()) and year(create_date) = year(now()) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function gettotalsurveys(){
        $sql = "select  count(id) cnt from survey_requests ";
        $sql.= "where month(create_date) = month(now()) and year(create_date)=year(now());";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function gettotalinstalls(){
        $sql = "select  count(id) cnt from install_requests ";
        $sql.= "where month(create_date) = month(now()) and year(create_date)=year(now());";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function getticketdetails($period,$category){
        $date = date("Y-m-d");
        $sql = "select distinct a.id,case a.requesttype ";
        $sql.= "when 'pelanggan' then b.name ";
        $sql.= "when 'backbone' then c.name ";
        $sql.= "when 'Core' then d.name ";
        $sql.= "when 'AP' then e.name ";
        $sql.= "when 'Datacenter' then f.name ";
        $sql.= "when 'PTP' then g.name ";
        $sql.= "when 'bts' then h.name ";
        $sql.= "end clientname,";
        $sql.= "b.address from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join backbones c on c.id=a.backbone_id ";
        $sql.= "left outer join cores d on d.id=a.core_id ";
        $sql.= "left outer join aps e on e.id=a.ap_id ";
        $sql.= "left outer join datacenters f on f.id=a.datacenter_id ";
        $sql.= "left outer join ptps g on g.id=a.ptp_id ";
        $sql.= "left outer join btstowers h on h.id=a.btstower_id ";
        $sql.= "where b.clientcategory = '".$category."' ";
        switch ($period){
        case  'y':
            //$sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
            $sql.= "and year(a.create_date)=year('".$date."')";
            break;
        case 'q':
            $sql.= "and quarter(date(a.create_date))=quarter('".$date."') ";
            break;
        case 'm':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
            break;
        case 'w':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
            break;
        case 'd':
            $sql.= "and date(a.create_date)='".$date."' ";
            break;
        }
        $sql.= "and year(a.create_date)=year('".$date."')";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'tot'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getsurveydetails($period,$category){
        $date = date("Y-m-d");
        $sql = "select distinct a.id, ";
        $sql.= "b.address, b.name clientname from survey_requests a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where b.clientcategory = '".$category."' ";
        switch ($period){
        case  'y':
            //$sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
            $sql.= "and year(a.create_date)=year('".$date."')";
            break;
        case 'q':
            $sql.= "and quarter(date(a.create_date))=quarter('".$date."') ";
            break;
        case 'm':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
            break;
        case 'w':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
            break;
        case 'd':
            $sql.= "and date(a.create_date)='".$date."' ";
            break;
        }
        $sql.= "and year(a.create_date)=year('".$date."')";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'tot'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getsurveystatus($id){
        $sql = "select * from survey_requests ";
        $sql.= "where id = " . $id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }
        return array(
            "resume"=>"0","description"=>""
        );
    }
    function getinstalldetails($period,$category){
        $date = date("Y-m-d");
        $sql = "select distinct a.id, ";
        $sql.= "b.address, c.name clientname from install_requests a ";
        $sql.= "left outer join client_sites b on b.id = a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "where c.clientcategory = '".$category."' ";
        switch ($period){
        case  'y':
            //$sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
            $sql.= "and year(a.create_date)=year('".$date."')";
            break;
        case 'q':
            $sql.= "and quarter(date(a.create_date))=quarter('".$date."') ";
            break;
        case 'm':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
            break;
        case 'w':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
            break;
        case 'd':
            $sql.= "and date(a.create_date)='".$date."' ";
            break;
        }
        $sql.= "and year(a.create_date)=year('".$date."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'tot'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getinstallstatus($id){
        $sql = "select * from install_sites a  ";
        $sql.= "where client_site_id = " . $id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }
        return array(
            "resume"=>"0","description"=>""
        );
    }
    function gettroubleshootstatus($id){
        $sql = "select * from troubleshoot_requests a  ";
        $sql.= "where client_site_id = " . $id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }
        return array(
            "resume"=>"0","description"=>""
        );
    }
    function gettroubleshootdetails($period,$category){
        $date = date("Y-m-d");
        $sql = "select distinct a.id, ";
        $sql.= "b.address, c.name clientname from troubleshoot_requests a ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "where c.clientcategory = '".$category."' ";
        switch ($period){
        case  'y':
            //$sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
            $sql.= "and year(a.create_date)=year('".$date."')";
            break;
        case 'q':
            $sql.= "and quarter(date(a.create_date))=quarter('".$date."') ";
            break;
        case 'm':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofmonth('".$date."') day) ";
            break;
        case 'w':
            $sql.= "and date(a.create_date)>=date_sub('".$date."',interval dayofweek('".$date."') day) ";
            break;
        case 'd':
            $sql.= "and date(a.create_date)='".$date."' ";
            break;
        }
        $sql.= "and year(a.create_date)=year('".$date."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'tot'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function visitstatistics(){
        $sql = "select createuser,count(id)jml from visits where month(createdate)=5 group by createuser;";
    }
    function visitjson(){
        $sql = "select ";
        $sql.= "Sales.username sales,";
        $sql.= "case when Jan.cnt is null then 0 else Jan.cnt end Jan,case when Feb.cnt is null then 0 else Feb.cnt end Feb,";
        $sql.= "case when Mar.cnt is null then 0 else Mar.cnt end Mar,case when Apr.cnt is null then 0 else Apr.cnt end Apr,";
        $sql.= "case when May.cnt is null then 0 else May.cnt end May,case when Jun.cnt is null then 0 else Jun.cnt end Jun,";
        $sql.= "case when Jul.cnt is null then 0 else Jul.cnt end Jul,case when Aug.cnt is null then 0 else Aug.cnt end Aug,";
        $sql.= "case when Sep.cnt is null then 0 else Sep.cnt end Sep,case when Oct.cnt is null then 0 else Oct.cnt end Oct,";
        $sql.= "case when Nov.cnt is null then 0 else Nov.cnt end Nov,case when Dcb.cnt is null then 0 else Dcb.cnt end Dcb ";
        $sql.= "from ";
        $sql.= "( ";
        $sql.= "select id,username from users where group_id=3 and active='1' and status='1' ";
        $sql.= ") Sales ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select sale_id,'Jan' mnt,count(id)cnt ";
        $sql.= "from visits ";
        $sql.= "where ";
        $sql.= "sale_id is not null ";
        $sql.= "and month(createdate)=1 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Jan ";
        $sql.= "on Jan.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Feb' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Feb ";
        $sql.= "on Feb.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Mar' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Mar ";
        $sql.= "on Mar.sale_id=Sales.id  ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Apr' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Apr ";
        $sql.= "on Apr.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'May' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") May ";
        $sql.= "on May.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Jun' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Jun ";
        $sql.= "on Jun.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Jul' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Jul ";
        $sql.= "on Jul.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Aug' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Aug ";
        $sql.= "on Aug.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Sep' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Sep ";
        $sql.= "on Sep.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Oct' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=10 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id ";
        $sql.= ") Oct ";
        $sql.= "on Oct.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Feb' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=11 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id ";
        $sql.= ") Nov on Nov.sale_id=Sales.id ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= "select sale_id,'Dec' mnt,count(id)cnt  ";
        $sql.= "from visits  ";
        $sql.= "where  ";
        $sql.= "sale_id is not null  ";
        $sql.= "and month(createdate)=9 ";
        $sql.= "and year(createdate)=year(now()) ";
        $sql.= "group by sale_id  ";
        $sql.= ") Dcb ";
        $sql.= "on Dcb.sale_id=Sales.id; ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function visitbysales($sale_id){
        $sql = "select 1 mnt,count(id) cnt from visits ";
        $sql.= "where  ";
        $sql.= "sale_id=".$sale_id." ";
        $sql.= "and month(createdate) = 1 ";
        $sql.= "and year(createdate) = year(now())  ";
        for($c=2;$c<=12;$c++){
            $sql.= "union all ";
            $sql.= "select ".$c." mnt,count(id) cnt from visits  ";
            $sql.= "where  ";
            $sql.= "sale_id=".$sale_id." ";
            $sql.= "and month(createdate) = ".$c." ";
            $sql.= "and year(createdate) = year(now())  ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        $arr = array();
        foreach($res as $r){
            array_push($arr,[$r->mnt,$r->cnt]);
        }
        return $arr;
    }
    function offerbysales($sale_id){
        $sql = "select 1 mnt,count(id) cnt from offers ";
        $sql.= "where  ";
        $sql.= "sale_id=".$sale_id." ";
        $sql.= "and month(createdate) = 1 ";
        $sql.= "and year(createdate) = year(now())  ";
        for($c=2;$c<=12;$c++){
            $sql.= "union all ";
            $sql.= "select ".$c." mnt,count(id) cnt from offers  ";
            $sql.= "where  ";
            $sql.= "sale_id=".$sale_id." ";
            $sql.= "and month(createdate) = ".$c." ";
            $sql.= "and year(createdate) = year(now())  ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        $arr = array();
        foreach($res as $r){
            array_push($arr,[$r->mnt,$r->cnt]);
        }
        return $arr;
    }
    function getreimburse(){
        $sql = 'select sale_id,sum(nominalreimburse) from visits group by sale_id ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function getdailyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select sum(nominalreimburse)tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)='".$date."' ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getdailyreimburseslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
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
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getweeklyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select sum(nominalreimburse)tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=subdate('".$date."',weekday('".$date."')) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getweeklyreimburseslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
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
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getmonthlyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select sum(nominalreimburse)tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getmonthlyreimburseslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
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
        $sql.= "where date(a.visitdate)>date_sub('".$date."',interval dayofmonth('".$date."') day) ";
        $sql.= "and a.transport = 'PMT' ";
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getquarterlyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select sum(nominalreimburse)tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where quarter(date(b.visitdate))=quarter('".$date."') ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getquarterlyreimburseslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
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
        $sql.= "and a.sale_id=".$sale_id." ";
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
    function getyearlyreimburses($category,$date,$sale_id,$branch_id,$iscounted){
        $iscounted = "'".implode("','",$iscounted)."'";
        $sql = "select sum(nominalreimburse)tot from users a ";
        $sql.= "left outer join visits b on b.sale_id=a.id ";
        $sql.= "where date(b.visitdate)>=date_sub('".$date."',interval dayofyear('".$date."') day) ";
        $sql.= "and a.id=".$sale_id." ";
        $sql.= "and b.branch=".$branch_id." ";
        if($iscounted!=="''"){
            $sql.= "and iscounted in (".$iscounted.") ";
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getyearlyreimburseslist($category,$date,$sale_id,$branch_id,$iscounted=array('1')){
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
        $sql.= "and a.sale_id=".$sale_id." ";
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
}
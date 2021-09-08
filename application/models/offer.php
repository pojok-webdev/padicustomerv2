<?php
class offer extends CI_Model{
    public $id;
public $branch;
public $telegram_id;
public $clientname;
public $address;
public $phone;
public $longitude;
public $latitude;
public $imei;
public $email;
public $otp;
public $otpconfirmed;
public $visitdate;
public $visitstart;
public $visitfinish;
public $pic;
public $position;
public $hp;
public $aim;
public $transport;
public $receiptimage;
public $iscounted;
public $sale_id;
public $description;
public $offerdate;
public $uc;
public $source;
    function __construct(){
        parent::__construct();
    }
    function save($params){
        $keys = array();$vals = array();
        $params['kdoffer'] = $this->getoffercode($params['sale_id'],$params['branch'],$params['offerdate']);
        foreach($params as $key=>$val){
            if($key!=="serviceName"&&$key!=="servicePrice"&&$key!=="capacity"&&$key!=="id"){
                array_push($keys,$key);
                array_push($vals,$val);
            }
        }
        $sql = "insert into offers ";
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $newid = $ci->db->insert_id();
        $this->saveservices($newid,$params['serviceName'],$params['capacity'],$params['servicePrice']);
        return $newid;
    }
    function update($params){
        $arrs = array();
        foreach($params as $key=>$val){
            if($key!=="serviceName"&&$key!=="servicePrice"&&$key!=="capacity"){
                array_push($arrs,''.$key.'="'.$val.'" ');
            }
        }
        $sql = "update offers ";
        $sql.= "set ";
        $sql.= "".implode(",",$arrs)." ";
        $sql.= "where id=".$params['id']." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $this->removeservices($params['id']);
        $this->saveservices($params['id'],$params['serviceName'],$params['capacity'],$params['servicePrice']);
    }
    function removeservices($offer_id){
        $sql = "delete from offer_services ";
        $sql.= "where offer_id=".$offer_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
    }
    function saveservices($offer_id,$servicename,$capacity,$serviceprice){
        for($c=0;$c<count($servicename);$c++){
            $sql = "insert into offer_services (offer_id,servicename,capacity,price) ";
            $sql.= "values('".$offer_id."','".$servicename[$c]."','".$capacity[$c]."',".$serviceprice[$c].");";
            $ci = & get_instance();
            $ci->db->query($sql);
        }
    }
    function getsales(){
        $sql = "select id,username,email from users ";
        $sql.= "where jobdesc in ('sm-farmer','sm-hunter','am-farmer','am-hunter') ";
        $sql.= "and status = '1' ";
        $sql.= "and active = '1' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getservicesbyofferid($offer_id){
        $sql = "select * from offer_services ";
        $sql.= "where offer_id=".$offer_id."";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getoffercode($sale_id,$branch,$offerdate){
        $year = substr($offerdate,0,4);
        $month = substr($offerdate,5,2);
        $sql = "select concat(date_format('".$offerdate."','%Y%m'),'/PADI/QUOT/',initial,'/',case when b.cnt is null then 1 else b.cnt+1 end ) num ";
        $sql.= "from (select *,1 x from users) a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 1 x,count(id) cnt ";
        $sql.= " from offers ";
        $sql.= " where date_format(offerdate,'%m%Y')='".$month.$year."' ";
        $sql.= " and branch = '".$branch."' ";
        $sql.= " group by x";
        $sql.= ") ";
        $sql.= "b on b.x=a.x ";
        $sql.= " where a.id=".$sale_id.";";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->num;
    }
    function remove($id){
        $sql = "delete from offers where id=".$id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
}
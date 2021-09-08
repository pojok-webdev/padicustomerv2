<?php
class Fb_fee extends CI_Model{
    public $client_id;
    public $nofb;
    public $name;
    public $dpp;
    public $ppn;
    public $createuser;
    function __construct(){
        parent::__construct();
    }
    function remove(){
        $ci = & get_instance();
        $sql = "delete from fbfees ";
        $sql.= "where nofb='".$this->nofb."' ";
        $sql.= "and name='".$this->name."' ";
        $ci->db->query($sql);
    }
    function save(){
        $ci = & get_instance();
        $sql = "insert into fbfees ";
        $sql.= "(client_id,nofb,name,dpp,ppn,createuser) ";
        $sql.= "values ";
        $sql.= "('".$this->client_id."','".$this->nofb."','".$this->name."','".$this->dpp."','".$this->ppn."','".$this->createuser."') ";
        $query = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function getbynofb($nofb){
        $ci = & get_instance();
        $sql = "select a.name,a.dpp,a.ppn,(a.dpp*1.1) total_,(a.dpp+a.ppn) total from fbfees a ";
		$sql.= "where a.nofb='".$nofb."' ";
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
			$obj = $que->result()[0];
			return array("name"=>$obj->name,"dpp"=>$obj->dpp,"ppn"=>$obj->ppn,"total"=>$obj->total);
		}
		return array("name"=>"","dpp"=>"0","ppn"=>"0","total"=>"0");
    }
    function getbyclientsiteid($clientsiteid,$name = null){
        $ci = & get_instance();
        $sql = "select a.name,a.dpp,a.ppn,(a.dpp*1.1) total_,(a.dpp+a.ppn) total from fbfees a ";
		$sql.= "left outer join fbs b on b.nofb=a.nofb ";
		$sql.= "where b.nofb='".$clientsiteid."' ";
		if(!is_null($name)){
			$sql.= "and a.name='".$name."'";
        }
        $que = $ci->db->query($sql);
        //return $que->result();
        if($que->num_rows()>0){
			$obj = $que->result()[0];
			return array("name"=>$obj->name,"dpp"=>$obj->dpp,"ppn"=>$obj->ppn,"total"=>$obj->total);
		}
		return array("name"=>"","dpp"=>"0","ppn"=>"0","total"=>"0");
    }
    function getbyclientid($clientid){
        $ci = & get_instance();
        $sql = "select a.* from fbfees a ";
		$sql.= "where a.client_id='".$clientid."' ";
        $que = $ci->db->query($sql);
        return $que->result();
    }

}
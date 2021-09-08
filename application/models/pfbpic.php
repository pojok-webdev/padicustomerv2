<?php
class Pfbpic extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	function getpic(){
		$params = $this->input->post();
		$sql = "select id,name,prole,phone_area,telp_hp,hp,position,email ";
		$sql.= "from pics where id=".$params["id"];
		$que = $this->db->query($sql);
		$res = $que->result();
		$obj = $res[0];
		return '{"name":"'.$obj->name.'","telp_hp":"'.$obj->telp_hp.'","prole":"'.$obj->prole.'","hp":"'.$obj->hp.'","position":"'.$obj->position.'","email":"'.$obj->email.'"}';
	}
    function saveupdate($params){
		foreach($params['obj'] as $position=>$posattr){
			$sql ="insert into fbpics ";
			$sql.= "(client_id,nofb,name,role,position,idnum,phone,hp,email,createuser) ";
			$sql.= "values ";
			$sql.= "('";
			$sql.= $posattr['client_id']."','";
			$sql.= $posattr['nofb']."','";
			$sql.= $posattr['name']."','";
			$sql.= $posattr['role']."','";
			$sql.= $posattr['position']."','";
			$sql.= $posattr['idnum']."','";
			$sql.= $posattr['phone']."','";
			$sql.= $posattr['hp']."','";
			$sql.= $posattr['email']."','";
			$sql.= $posattr['createuser']."'";
            $sql.= ")";
            $ci = & get_instance();
            $ci->db->query($sql);
        }
        return true;
	}
	function updatepic($params){
		$sql = "update pics set name='".$params["name"]."',";
		$sql.= "telp_hp='".$params["telp_hp"]."',";
		$sql.= "hp='".$params["hp"]."',";
		$sql.= "email='".$params["email"]."',";
		$sql.= "position='".$params["position"]."' ";
		$sql.= "where id='".$params["id"]."'";
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return $sql;
	}
}
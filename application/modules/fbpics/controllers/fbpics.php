<?php
class Fbpics extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function save($params){
		$obj = new Fbpic();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		return 'has been saved!'.$obj->check_last_query();
	}
	function saveupdate_(){
		$params = $this->input->post();
		$this->pfbpic->saveupdate($params);
		echo "sukses";
	}
	function saveupdate(){
		$params = $this->input->post();
		$sql = "insert into fbpics (client_id,nofb,name,role,position,idnum,phone,hp,email,createuser) ";
		$sql.= "values ";
		$sql.= "(";
		$sql.= $params['client_id'].",'";
		$sql.= $params['nofb']."','";
		$sql.= $params['name']."','";
		$sql.= $params['role']."','";
		$sql.= $params['position']."','";
		$sql.= $params['idnum']."','";
		$sql.= $params['phone']."','";
		$sql.= $params['hp']."','";
		$sql.= $params['email']."','";
		$sql.= $params['createuser']."'";
		$sql.= ") ";
		$sql.= "on duplicate key update ";
		$sql.= " role='".$params['role']."',";
		$sql.= "name='".$params['name']."',";
		$sql.= "position='".$params['position']."',";
		$sql.= "idnum='".$params['idnum']."',";
		$sql.= "phone='".$params['phone']."',";
		$sql.= "hp='".$params['hp']."',";
		$sql.= "email='".$params['email']."',";
		$sql.= "createuser='".$params['createuser']."'";
		$this->db->query($sql);
		echo $sql;
	}
	function update($params){
		$obj = new Fbpic();
		$obj->where('id',$params['id'])->update($params);
		return 'has been updated '.$obj->check_last_query();
	}
}

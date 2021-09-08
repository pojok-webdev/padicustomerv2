<?php
class Install_antenna extends DataMapper{
	var $has_one = array("install_site");
	function __construct(){
		parent::__construct();
	}

	function add($params){
		$obj = new Install_antenna();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		return $this->db->insert_id();
	}
	
	function remove($params){
		$obj = new Install_antenna();
		$obj->where('id',$params['id'])->get();
		$obj->delete();
		return $obj->check_last_query();
	}
	function update($params){
		$arr = array();
		foreach($params as $key=>$val){
			array_push($arr,"".$key."='".$val."'");
		}
		$sql = "update install_antennas ";
		$sql.= "set ";
		$sql.= "". implode(',',$arr);
		$sql.= "where id=".$params["id"];
		$ci = & get_instance();
		$ci->db->query($sql);
		return $sql;
	}
}

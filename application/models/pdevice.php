<?php
class Pdevice extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	function get_combo_data($devicetype = null){
        $sql = "select * from devices ";
        $sql.= "where active='1' ";
        if($devicetype!=null){
            $sql.= "and devicetype_id in('".implode("','",$devicetype)."') ";
        }
        $sql.= "order by name asc ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
		$out = array();
        foreach($que->result() as $res){
            $out[$res->id] = $res->name;
        }
		return $out;
	}
	function get_combo_data_device($deviceid,$first_data=''){
        $sql = "select * from devices ";
        $sql.= "where active='1' ";
        if($devicetype!=null){
            $sql.= "and devicetype_id='".$deviceid."' ";
        }
        $sql.= "order by name asc ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
		$out = array();
		if($first_data!=''){
			$out[0] = $first_data;
		}
        foreach($que->result() as $res){
            $out[$res->id] = $res->name;
        }
        return $out;
    }
}
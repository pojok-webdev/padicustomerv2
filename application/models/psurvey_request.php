<?php
class Psurvey_request extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function add($params){
		$sql = "insert into survey_requests ";
		$sql.= "(address,branch_id,client_id,description,has_ladder,install_area,pic_email,pic_name,pic_phone,pic_position,service_id,survey_date)";
		$sql.= 'values ';
		$sql.= "('".$params['address']."','".$params['branch_id']."','".$params['client_id']."','".$params['description']."','".$params['has_ladder']."','".$params['install_area']."','".$params['pic_email']."','".$params['pic_name']."','".$params['pic_phone']."','".$params['pic_position']."','".$params['service_id']."','".$params['survey_date']."')";
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return $this->db->insert_id();
	}
	function updateresume($params){
		$sql = "update survey_requests ";
		$sql.= "set description='".$params['description']."' ";
		$sql.= "where id=".$params['id'];
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return $sql;
	}
}
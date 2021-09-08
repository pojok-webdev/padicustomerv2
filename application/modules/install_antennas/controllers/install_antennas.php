<?php
class Install_antennas extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('install_antenna');
	}
	function getbyid(){
		$params = $this->input->post();
		$obj = new Install_antenna();
		$obj->where('install_site_id',$params['id'])->get();
		$arr = array();
		foreach($this->db->list_fields('install_antennas') as $field){
			array_push($arr,'"'.$field.'":"'.$obj->$field.'"');
		}
		echo '{'.implode(',',$arr).'}';
	}
	function update(){
		$params = $this->input->post();
		echo $this->install_antenna->update($params);
	}
}

<?php
class Fbfees extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function getfees(){
		$params = $this->input->post();
		$id = $this->uri->segment(3);
		$this->load->model('fb_fee');
		$objs = new Fbfee();
		//$objs->getbyclientid($params['client_id']);
		$objs->where('nofb',$params['nofb'])->get();
		$arr = array();
		foreach($objs as $obj){
			array_push($arr, '"'.$obj->name.'":{"dpp":"'.$obj->dpp.'","ppn":"'.$obj->ppn.'"}');
		}
		echo '{'.implode(',',$arr).'}';
	}
	function saveupdate_(){
		$params = $this->input->post();
		$ci = & get_instance();
		foreach($params['data'] as $key=>$val){
			$sql = "insert into fbfees ";
			$sql.= "(client_id,name,nofb,dpp,ppn,createuser) ";
			$sql.= "values ";
			$sql.= "('".$val['client_id']."','".$val['name']."','".$val['nofb']."','".$val['dpp']."','".$val['ppn']."','".$val['createuser']."')";
			$ci->db->query($sql);
		}
		print_r($params);
	}
	function saveupdateother_(){
		$params = $this->input->post();
		$objs = $params['data'];
		if (count($objs)>0){
			print_r($params["data"]);
			foreach($objs as $obj){
				$sql = "insert into fbfees (client_id,nofb,name,dpp,ppn) ";
				$sql.= "values (";
				$sql.= "'".$obj['client_id']."',";
				$sql.= "'".$obj['nofb']."',";
				$sql.= "'".$obj['name']."',";
				$sql.= "'".$obj['dpp']."',";
				$sql.= "'".$obj['ppn']."'";
				$sql.= ") ";
		
				$sql.= "on duplicate key update  ";
				$sql.= "client_id='".$obj['client_id']."',";
				$sql.= "nofb='".$obj['nofb']."',";
				$sql.= "name='".$obj['name']."',";
				$sql.= "dpp='".$obj['dpp']."',";
				$sql.= "ppn='".$obj['ppn']."'";
				$ci = & get_instance();
				$ci->db->query($sql);	
			}
		}
	}
	function saveupdate(){
		$params = $this->input->post();
		$sql = "insert into fbfees (client_id,nofb,name,dpp,ppn) ";
		$sql.= "values (";
		$sql.= "".$params['client_id'].",'";
		$sql.= "".$params['nofb']."','";
		$sql.= "".$params['name']."',";
		$sql.= "".$params['dpp'].",";
		$sql.= "".$params['ppn']."";
		$sql.= ") ";

		$sql.= "on duplicate key update  ";
		$sql.= "client_id=".$params['client_id'].",";
		$sql.= "nofb='".$params['nofb']."',";
		$sql.= "name='".$params['name']."',";
		$sql.= "dpp=".$params['dpp'].",";
		$sql.= "ppn=".$params['ppn']."";
		$this->db->query($sql);
		echo $sql;
	}
	function save($params){
		$obj = new Fbfee();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function update($params){
		$obj = new Fbfee();
		$obj->where('client_id',$params['client_id'])->where('name',$params['name'])->update($params);
		echo $obj->check_last_query();
	}
}

<?php
class Backbones extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function get(){
		$arr = array();
		foreach($this->backbone->get_combo_data() as $key=>$val){
			array_push($arr, '"' . $key . '":"' . $val . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;
	}
	function getBackbone(){
		$id = $this->uri->segment(3);
		$obj = new Backbone();
		$obj->where("id",$id)->get();
		echo '{"id":"'.$id.'","name":"'.$obj->name.'","location":"'.$obj->location.'","branch_id":"'.$obj->branch_id.'"}';
	}
	function getBranches(){
		$id = $this->uri->segment(3);
		$obj = new Backbone();
		$obj->where("id",$id)->get();
		$arr = array();
		foreach($obj->branches as $branch){
			array_push($arr,'"'.$branch->name.'"');
		}
		echo "[" . implode(",",$arr) . "]";
	}
	function remove(){
		$id = $this->uri->segment(3);
		$obj = new Backbone();
		$obj->where("id",$id)->get();
		$obj->delete();
		echo $obj->check_last_query();
	}
}

<?php
class Backbone extends Datamapper{
//	var $has_one = array("branch");
	var $has_many = array("branch");

	function __construct(){
		parent::__construct();
	}
	
	function get_combo_data($first_data=''){
		$out = array();
		if($first_data!=''){
			$out[0] = $first_data;
		}
		$objs = new Backbone();
		$objs->where('active','1')->get();
		foreach ($objs as $obj){
			$out[$obj->id] = $obj->name;
		}
		return $out;
	}

function populate(){
	$objs = new Backbone();
	return $objs->get();
}
}

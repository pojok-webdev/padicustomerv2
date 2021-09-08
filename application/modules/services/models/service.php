<?php
class Service extends DataMapper{
	var $has_many = array('survey_request','install_request','troubleshoot_request','client');
	function __construct(){
		parent::__construct();
	}
	function get_combo_data($iskeyvalpaired=true,$first_row='',$last_row=''){
		$services = new Service();
		$services->get();
		$out = array();
		if($iskeyvalpaired){
			if($first_row!=''){
				$out[0] = $first_row;
			}
			foreach ($services as $service){
				$out[$service->id] = $service->name;
			}
			if($last_row!=''){
				$out[-1] = $last_row;
			}
		}else{
			if($first_row!=''){
				$out[0] = $first_row;
			}
			foreach ($services as $service){
				$out[$service->name] = $service->name;
			}			
			if($last_row!=''){
				$out[-1] = $last_row;
			}
		}
		return $out;
	}
}

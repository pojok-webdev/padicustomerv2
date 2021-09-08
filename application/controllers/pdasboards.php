<?php
class Pdashboards extends CI_Controller{
    function sales(){
		$this->check_login();
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$mydate1 = date_create($ticketstart);
		$mydate2 = date_create($ticketend);
		$myday1 = date_format($mydate1,"D");
		$myday2 = date_format($mydate2,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$data["userbranch"] = implode(",",getuserbranches());
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pticket->getcategoryreportperiodic($ticketstart,$ticketend,$branchselected);
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["total"];
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data["menuFeed"] = "categorycomplainperiodic";
		$this->load->view("graphics/dashboard-sales",$data);
	}
	function plotsrc(){
		$params = $this->input->post();
		$arr = array();
		//$tickets = $this->pticket->getticketbycause($params['ticketstart'],$params['ticketend'],$params['branchselected'],$params["causeid"]);
		$ticketstart = $this->uri->segment(5).'-'.$this->uri->segment(4).'-'.$this->uri->segment(3);
		$ticketend = $this->uri->segment(8).'-'.$this->uri->segment(7).'-'.$this->uri->segment(6);
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";
		$causeid = $this->uri->segment(10);
		$tickets = $this->pticket->getcategoryreportperiodic($ticketstart,$ticketend,$branchselected);
		foreach($tickets["res"] as $ticket){
			array_push($arr,'{"label":"'.$ticket->cause.'","data":'.$ticket->cnt.'}');
		}
		echo '{"data":['.implode(',',$arr).']}';
		//echo '{"data":[{"label":"Router Down","data":30},{"label":"Radio Down","data":10},{"label":"Bandwidth Penuh","data":20},{"label":"Interferensi AP","data":15},{"label":"Radio Problem Fisik","data":25}]}';
	}

}
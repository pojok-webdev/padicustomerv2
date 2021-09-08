<?php
class Rpt extends CI_Controller{
	var $ionuser;
	function __construct(){
		parent::__construct();
		$this->load->helper("user");
		$this->load->helper("report");
		$this->load->library("ZabbixApi");
		$this->load->library("common");
		$this->load->library("padidatetime");
		$this->load->helper("zabbix");
		$this->load->helper("branches");
		$this->load->helper("suspect");
		$this->load->model("rptmodel");
		$this->load->model("pfbs");
		$this->load->model("pticket");
		$this->load->model("prpt");
		$this->load->helper("str");
		if ($this->ion_auth->logged_in()) {
			$this->ionuser = $this->ion_auth->user()->row();
		}
	}
	function clientfeed(){
		$branches = '123';
		$params = $this->input->post();
		$objs = $this->prpt->getclients($params['nama'],$params['usaha'],$params["am"],$params["layanan"],strtocommaseparated($params['branches']));
		$arr = array();
		foreach($objs["res"] as $obj){
			$str = '"'.$obj->id.'":';
			$str.= '{';
			$str.='"name":"'.$obj->name.'",';
			$str.='"business_field":"'.$obj->business_field.'",';
			$str.='"address":"'.$obj->address.'",';
			$str.='"am":"'.$obj->am.'",';
			$str.='"branches":"'.$obj->branches.'",';
			$str.='"services":"'.$obj->cservices.'"';
			$str.='}';
			array_push($arr,$str);
		}
		echo '{"tot":"'.$objs["tot"].'","res":{'.implode(",",$arr).'}}';
	}
	function clientpics(){
		$branches = $this->uri->segment(7);
		$branches = "1234";
		$objs = $this->prpt->getclientpics("","","","",strtocommaseparated($branches));
		$data = array(
			"menuFeed"=>"report",
			"activationdate"=>"1-1-11",
			"dt2"=>"1-1-11",
			"userbranches"=>array(),
			"users"=>array(),
			"suspects"=>array(),
			"total"=>$objs["tot"],
			"objs"=>$objs["res"],
			"title"=>"PIC Pelanggan"
		);
		$this->load->view('Sales/reports/clientpics',$data);
	}
	function clientreport(){
		$branches = $this->uri->segment(7);
		$branches = "1234";
		$objs = $this->prpt->getclients("","","","",strtocommaseparated($branches));
		$data = array(
			"menuFeed"=>"report",
			"activationdate"=>"1-1-11",
			"dt2"=>"1-1-11",
			"userbranches"=>array(),
			"users"=>array(),
			"suspects"=>array(),
			"total"=>$objs["tot"],
			"objs"=>$objs["res"],
			"title"=>"Laporan Pelanggan"
		);
		$this->load->view('Sales/reports/clientreport',$data);
	}
	function clientvaluereport(){
		$branches = $this->uri->segment(7);
		$branches = "1234";
		$objs = $this->prpt->getclientvalues("","","","",strtocommaseparated($branches));
		$data = array(
			"menuFeed"=>"report",
			"activationdate"=>"1-1-11",
			"dt2"=>"1-1-11",
			"userbranches"=>array(),
			"users"=>array(),
			"suspects"=>array(),
			"total"=>$objs["tot"],
			"objs"=>$objs["res"],
			"title"=>"Laporan Nilai Penjualan"
		);
		$this->load->view('Sales/reports/clientvaluereport',$data);		
	}
	function branchvaluereport(){
		$branches = $this->uri->segment(7);
		$branches = "1234";
		$objs = $this->prpt->getbranchvalues("","","","",strtocommaseparated($branches));
		$data = array(
			"menuFeed"=>"report",
			"activationdate"=>"1-1-11",
			"dt2"=>"1-1-11",
			"userbranches"=>array(),
			"users"=>array(),
			"suspects"=>array(),
			"total"=>$objs["tot"],
			"objs"=>$objs["res"],
			"title"=>"Laporan Nilai Penjualan"
		);
		$this->load->view('Sales/reports/branchvaluereport',$data);		
	}
	function pji(){
		$arrbranches = getuserbranches();
		echo implode(",",$arrbranches);
	}
	function downtimereport(){
		$this->check_login();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$dt1 = $this->uri->segment(5) . " 00:00:00";
		$dt2 = $this->uri->segment(6) . " 23:59:59";
		$brns = explode(",",$this->uri->segment(7));
		$arr = array();
		$str = $this->uri->segment(7);
			for($x=0;$x<strlen($str);$x++){
				array_push($arr,substr($str,$x,1));
			}		
		$branches = implode("','",$arr);
		$branches = implode(",",$arr);
		$sql = "select a.id, a.create_date,";
		$sql.= "clientname,date(downtimestart) downtimestart,case downtimeend when '0000-00-00 00:00:00' then '~' else date(downtimeend) end downtimeend,";
		$sql.= "case when downtimestart='0000-00-00 00:00:00' then '~' when downtimeend='0000-00-00 00:00:00' then '~' else datediff(downtimeend,downtimestart) end downtimetotal ";
		$sql.= "from tickets a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join branches_client_sites c on c.client_site_id=b.id ";
		$sql.= "where downtimestart<>'0000-00-00 00:00:00' ";
		$sql.= "and (downtimeend>'$dt2' and downtimestart<='$dt1') ";
		$sql.= "and c.branch_id in ('".$branches."')";
		
		$sql = 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join client_sites c on c.id=b.client_site_id ';
		$sql.= 'left outer join branches_client_sites d on d.client_site_id=c.id ';
		$sql.= 'where d.branch_id in (' . $branches . ')';
		$sql.= 'union all ';
		$sql.= 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join backbones c on c.id=b.backbone_id ';
		$sql.= 'where b.requesttype = "backbone" and c.branch_id_ in ('.$branches.')';
		$sql.= 'union all ';
		$sql.= 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join btstowers c on c.id=b.btstower_id ';
		$sql.= 'where b.requesttype = "bts" and c.branch_id in ('.$branches.')';
		$sql.= 'union all ';
		$sql.= 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join aps c on c.id=b.ap_id ';
		$sql.= 'left outer join btstowers d on d.id=c.btstower_id ';
		$sql.= 'where b.requesttype = "AP" and d.branch_id in ('.$branches.')';
		$sql.= 'union all ';
		$sql.= 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join cores c on c.id=b.core_id ';
		$sql.= 'where b.requesttype = "Core" and c.branch_id in ('.$branches.')';
		$sql.= 'union all ';
		$sql.= 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join datacenters c on c.id=b.datacenter_id ';
		$sql.= 'where b.requesttype = "Datacenter" and c.branch_id in ('.$branches.')';
		$sql.= 'union all ';
		$sql.= 'select b.id,b.create_date,timestampdiff(day,start,end)downtimetotal_, ';
		$sql.= 'CONCAT(FLOOR(HOUR(TIMEDIFF(start,end)) / 24), " hari ",MOD(HOUR(TIMEDIFF(start,end)), 24), " jam ", MINUTE(TIMEDIFF(start,end)), " menit ") downtimetotal,' ;
		$sql.= 'clientname,start downtimestart,end downtimeend  ';
		$sql.= 'from downtimes a ';
		$sql.= 'left outer join tickets b on b.id=a.ticket_id ';
		$sql.= 'left outer join ptps c on c.id=b.ptp_id ';
		$sql.= 'left outer join btstowers d on d.id=c.btstower_id ';
		$sql.= 'where b.requesttype = "PTP" and d.branch_id in ('.$branches.')';

		//echo $sql;
		$rorder = ($order ==='desc')?'asc':'desc';
		$query = $this->db->query($sql);
		$result = $query->result();
		$data["clientname"] = "test";
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["dt1"] = $this->uri->segment(5);
		$data["dt2"] = $this->uri->segment(6);
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["suspects"] = $result;
		$this->load->view("TS/reports/downtime",$data);
	}
	function index(){
		$this->check_login();
		$data["months"] = $this->padidatetime->getmonthsarray("id");
		$data["months2"] = $this->padidatetime->getmonthsarray2("id");
		$usrarr = array();
		$arrbranches = getuserbranches();
		$users = getsubordinates($this->ionuser->id,$usrarr,$arrbranches);
		$struser = implode("-",$users);
		$data['struser'] = $struser;
		$data['users'] = $users;
		$data["userbranches"] = implode("",$arrbranches);
		$data["menuFeed"] = "reportfilter";
		$this->load->view("TS/reports/filter",$data);
	}
	function jabrix(){
		$this->check_login();
		$api = new ZabbixApi('http://202.6.233.15/zabbix/api_jsonrpc.php', 'puji', 'pujicute2016');
		$graphs = $api->serviceget();
		$services = array();
		// print all graph IDs
		foreach($graphs as $graph){
			$id = $graph->name;
			$services[$graph->serviceid] = $graph->name;
		}
		$data["months"] = $this->padidatetime->getmonthsarray("id");
		$data["services"] = $services;
		$data["menuFeed"] = "reportfilter";
		$this->load->view("TS/reports/jabrix",$data);
	}
	function check_login() {
		if (!$this->ion_auth->logged_in()) {
			redirect(base_url() . 'adm/login');
		}
	}
	function monthlycomplaint(){
		$month = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$arrbranches = getuserbranches();
		if($this->uri->total_segments()>5){
			$ordername = $this->uri->segment(6);
		}else{
			$ordername = "clientname";
		}
		if($this->uri->total_segments()>6){
			$ordertype = $this->uri->segment(7);
		}else{
			$ordertype = "asc";
		}



		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(5));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(5),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$obj = $this->prpt->monthlycomplaint($month,$year,$branchselected,$ordername,$ordertype);
		

		$data = array(
			'month'=>$month,
			'objs' => $obj["res"],
			'total'=>$obj["tot"],
			'arrbranch'=> $arrbranches,
			'userbranches'=>implode("",$arrbranches),
			//'userbranches'=>implode("",$arrbranchselected),
		);
		$this->load->view('TS/reports/monthlycomplaint',$data);
	}
	function monthly_installation(){
		$this->check_login();
		$month = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$arr = install_per_month($month,$year);
		echo "installation report for month ".$month." ".$year;
		foreach($arr as $key=>$val){
			echo $key . " - " . $val . "<br />";
		}
	}
	function surveyperday(){
		$this->check_login();
		$res = surveyclientperday("2016-3-22");
		foreach($res as $r){
			echo $r["name"]."<br />";
		}
	}
	function layout(){
		$this->check_login();
		if($this->uri->total_segments()>3){
			$month = $this->uri->segment(3);
			$year = $this->uri->segment(4);
			$monthyear = $this->common->get_month_name($month) . ' - ' . $year;
		}else{
			$month = date("F");
			$year = date("Y");
			$monthyear = date("F - Y");
		}
		$branchselected = $this->uri->segment(5);
		$usrarr = array();
		$amsstr = $this->uri->segment(6);
		$ams = explode("-",$amsstr);
		$arrbranchselected = array();
		for($c=0;$c<strlen($branchselected);$c++){
			array_push($arrbranchselected,substr($branchselected,$c,1));
		}
		$data["monthyear"] = $monthyear;
		$data["userbranch"] = implode(",",getuserbranches());
		$data["arrbranchselected"] = $arrbranchselected;
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$data["month"] = $month;
		$data["year"] = $year;
		$data["branchselected"] = $branchselected;
		$data["day_in_month"] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data["install"] = install_per_month($month,$year,$arrbranchselected);
		$data["survey"] = survey_per_month($month,$year,$arrbranchselected);
		$data["troubleshoot"] = troubleshoot_per_month($month,$year,$arrbranchselected);
		$data["maintenance"] = maintenance_per_month($month,$year,$arrbranchselected);
		$this->load->view("TS/reports/rpt",$data);
	}
	function totalticket(){
		$this->check_login();
		$this->load->helper('ticket');
		$ticketapinweek = $this->pticket->getticketbycategoryinweek(4);
		$ticketbackboneinweek = $this->pticket->getticketbycategoryinweek(1);
		$ticketupstreaminweek = $this->pticket->getticketbycauseidinweek(31);
		$ticketapinday = $this->pticket->getticketbycategoryinday(4);
		$ticketbackboneinday = $this->pticket->getticketbycategoryinday(1);
		$ticketupstreaminday = $this->pticket->getticketbycauseidinday(31);
		$ticketsinday = $this->pticket->getticketsinday();
		$troubleshootticketinday = $this->pticket->gettroubleshootticketinday();
		$ticketsinweek = $this->pticket->getticketsinweek();
		$openticketsinweek = $this->pticket->getfilteredticketsinweek(0);
		$closedticketsinweek = $this->pticket->getfilteredticketsinweek(1);
		$troubleshootticketinweek = $this->pticket->gettroubleshootticketinweek();
		$sbyticketsperbranchinweek = $this->pticket->getticketsperbranchpercategoryinweek(1);
		$jktticketsperbranchinweek = $this->pticket->getticketsperbranchpercategoryinweek(2);
		$mlgticketsperbranchinweek = $this->pticket->getticketsperbranchpercategoryinweek(3);
		$bliticketsperbranchinweek = $this->pticket->getticketsperbranchpercategoryinweek(4);
		$sbyticketsperbranchinday = $this->pticket->getticketsperbranchpercategoryinday(1);
		$jktticketsperbranchinday = $this->pticket->getticketsperbranchpercategoryinday(2);
		$mlgticketsperbranchinday = $this->pticket->getticketsperbranchpercategoryinday(3);
		$bliticketsperbranchinday = $this->pticket->getticketsperbranchpercategoryinday(4);
		$totalcategorybycauses = $this->pticket->gettotalcategorybycauses();
		//$totalbycauses = $this->pticket->gettotalbycauses();
		$weeklycause = array();$dailycause = array();
		for($x=1;$x<10;$x++){
			$temp =  $this->pticket->getweeklycausebycategory($x);
			$weeklycause[$x] = $temp['res'];
		}
		for($x=1;$x<10;$x++){
			$temp =  $this->pticket->getdailycausebycategory($x);
			$dailycause[$x] = $temp['res'];
		}
		
		$data = array(
			'menuFeed'=>'',
			'totalticketsinday'=>$ticketsinday['cnt'],
			'openticketsinday'=>$ticketsinday['cnt'],
			'closedticketsinday'=>$ticketsinday['cnt'],
			'troubleshootticketsinday'=>$troubleshootticketinday['cnt'],
			'totalticketsinweek'=>$ticketsinweek['cnt'],
			'openticketsinweek'=>$openticketsinweek['cnt'],
			'closedticketsinweek'=>$closedticketsinweek['cnt'],
			'troubleshootticketsinweek'=>$troubleshootticketinweek['cnt'],
			'sbyticketsperbranchinweek'=>$sbyticketsperbranchinweek['res'],
			'jktticketsperbranchinweek'=>$jktticketsperbranchinweek['res'],
			'mlgticketsperbranchinweek'=>$mlgticketsperbranchinweek['res'],
			'bliticketsperbranchinweek'=>$bliticketsperbranchinweek['res'],
			'totalsbyticketsperbranchinweek'=>$sbyticketsperbranchinweek['cnt'],
			'totaljktticketsperbranchinweek'=>$jktticketsperbranchinweek['cnt'],
			'totalmlgticketsperbranchinweek'=>$mlgticketsperbranchinweek['cnt'],
			'totalbliticketsperbranchinweek'=>$bliticketsperbranchinweek['cnt'],
			'totalsbyticketsperbranchinday'=>$sbyticketsperbranchinday['cnt'],
			'totaljktticketsperbranchinday'=>$jktticketsperbranchinday['cnt'],
			'totalmlgticketsperbranchinday'=>$mlgticketsperbranchinday['cnt'],
			'totalbliticketsperbranchinday'=>$bliticketsperbranchinday['cnt'],
			'sbyticketsperbranchinday'=>$sbyticketsperbranchinday['res'],
			'jktticketsperbranchinday'=>$jktticketsperbranchinday['res'],
			'mlgticketsperbranchinday'=>$mlgticketsperbranchinday['res'],
			'bliticketsperbranchinday'=>$bliticketsperbranchinday['res'],
			'ticketapinweek'=>$ticketapinweek['res'],
			'ticketbackboneinweek'=>$ticketbackboneinweek['res'],
			'ticketupstreaminweek'=>$ticketupstreaminweek['res'],
			'ticketapinday'=>$ticketapinday['res'],
			'ticketbackboneinday'=>$ticketbackboneinday['res'],
			'ticketupstreaminday'=>$ticketupstreaminday['res'],
			'totalcategorybycauses'=>$totalcategorybycauses['res'],
			'weeklycause'=>$weeklycause,
			'dailycause'=>$dailycause
		);
		$this->load->view("TS/reports/totalticket",$data);
	}
	function farmer(){
		$this->check_login();
		$month = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$branchselected = $this->uri->segment(5);
		$usrarr = array();
		$amsstr = $this->uri->segment(6);
		$ams = explode("-",$amsstr);
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(5));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(5),$c,1));
		}
		$users = getsubordinates($this->ionuser->id,$usrarr,$arrbranchselected);
		$data["userbranch"] = implode(",",getuserbranches());
		$data["arrbranchselected"] = $arrbranchselected;
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$data["month"] = $month;
		$data["year"] = $year;
		$data["branchselected"] = $branchselected;
		$data["day_in_month"] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data["suspect"] = suspect_per_month($month,$year,$arrbranchselected,$ams);
		$data["prospect"] = prospect_per_month($month,$year,$arrbranchselected,$ams);
		$data["install"] = install_per_month($month,$year,$arrbranchselected,$ams);
		$data["survey"] = survey_per_month($month,$year,$arrbranchselected,$ams);
		$data["troubleshoot"] = troubleshoot_per_month($month,$year,$arrbranchselected,$ams);
		$data["users"] = $users;
		$data['ams'] = $ams;
		$data['amsstr'] = $amsstr;
		$this->load->view("Sales/reports/farmer",$data);		
	}
	function excel(){
		$month = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$branchselected = $this->uri->segment(5);
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(5));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(5),$c,1));
		}
		$data["userbranch"] = implode(",",getuserbranches());
		$data["arrbranchselected"] = $arrbranchselected;
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$data["month"] = $month;
		$data["year"] = $year;
		$data["branchselected"] = $branchselected;
		$data["day_in_month"] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data["suspect"] = suspect_per_month($month,$year,$arrbranchselected);
		$data["prospect"] = prospect_per_month($month,$year,$arrbranchselected);

		$data["install"] = install_per_month($month,$year,$arrbranchselected);
		$data["survey"] = survey_per_month($month,$year,$arrbranchselected);
		$data["troubleshoot"] = troubleshoot_per_month($month,$year,$arrbranchselected);
		$this->load->view("TS/reports/excel-monthly",$data);
	}
	function fbreport(){
		$this->load->helper('subscription');
		$fbs=getfbs();
		$data = array(
			'fbs'=>$fbs["res"],
			'servicecategories'=>$this->service->get_combo_data(),
			'cities'=>getcities(),
			'businesstypes'=>$this->pfbs->getbusinesstypes(),
			'servicecategories'=>getservicecategories(),
			'sales'=>getsales(),
			'curdate'=>date("d/m/Y")
		);
		$this->load->view('Sales/reports/fbreport',$data);
	}
	function excelhunter(){
		$month = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$branchselected = $this->uri->segment(5);
		$str = $this->uri->segment(6);
		$ams = explode("-",$str);		
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(5));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(5),$c,1));
		}
		$data["userbranch"] = implode(",",getuserbranches());
		$data["arrbranchselected"] = $arrbranchselected;
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$data["month"] = $month;
		$data["year"] = $year;
		$data["branchselected"] = $branchselected;
		$data["day_in_month"] = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data["suspect"] = suspect_per_month($month,$year,$arrbranchselected,$ams);
		$data["prospect"] = prospect_per_month($month,$year,$arrbranchselected,$ams);

		$data["install"] = install_per_month($month,$year,$arrbranchselected,$ams);
		$data["survey"] = survey_per_month($month,$year,$arrbranchselected,$ams);
		$data["troubleshoot"] = troubleshoot_per_month($month,$year,$arrbranchselected,$ams);
		$this->load->view("TS/reports/excel-monthly-hunter",$data);
	}
	function shiftreport(){
		$this->check_login();
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$mydate = date_create($ticketstart);
		$myday = date_format($mydate,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$data["userbranch"] = implode(",",getuserbranches());
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(6));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(6),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pticket->getshiftreport($ticketstart,$branchselected);
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["total"];
		$data["date"] = $days[$myday]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["dateselected"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$this->load->view("TS/reports/ticketdaily",$data);
	}
	function shiftreportperiodic(){
		$this->check_login();
		$this->load->model('pcause');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$mydate = date_create($ticketstart);
		$myday = date_format($mydate,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$arrbranches = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$arrcausecategories = explode("-",$this->uri->segment(10));
		$causecategories =  implode(",",$arrcausecategories);
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pticket->getshiftreportperiodic($ticketstart,$ticketend,$branchselected,$causecategories);
		$version0 = $this->pcause->getcategoriesbyversion('0');
		$version1 = $this->pcause->getcategoriesbyversion('1');
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$data["userbranch"] = implode(",",getuserbranches());
		$data['arrcausecategories'] = $arrcausecategories;
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["total"];
		$data["date"] = $days[$myday]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data['version0'] = $version0['res'];
		$data['version1'] = $version1['res'];
		$this->load->view("TS/reports/ticketperiodicb",$data);
	}
	function categorypelangganamount(){
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
		$tickets = $this->pticket->getcategorypelangganamount($ticketstart,$ticketend,$branchselected);
		$data["tickets"] = $tickets;
		$data["total"] = 0;
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$this->load->view("TS/reports/categorypelangganamount",$data);
	}
	function categorycomplainreportperiodic(){
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
		$this->load->view("TS/reports/categorycomplainperiodic",$data);
	}
	function categorycomplaingraphicperiodic(){
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
		$this->load->view("graphics/categorycomplainperiodic",$data);
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
	function getticketbycause(){
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
		$tickets = $this->pticket->getticketbycause($ticketstart,$ticketend,$branchselected,$this->uri->segment(10));
		$data["tickets"] = $tickets["res"];
		$data["name"] = $this->pticket->getcausebycauseid($this->uri->segment(10));
		$data["total"] = $tickets["total"];
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$this->load->view("TS/reports/getticketbycause",$data);
	}
	function ticketdescription(){
		$data['kdticket'] = $this->uri->segment(3);
		$objs = $this->pticket->getticketbykdticket($this->uri->segment(3));
		$data['ticket'] = $objs;
		$this->load->view('TS/reports/ticketdescription',$data);
	}
	function solvedreport(){
		$this->check_login();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$brns = explode(",",$this->uri->segment(5));
		$arr = array();
		$str = $this->uri->segment(5);
			for($x=0;$x<strlen($str);$x++){
				array_push($arr,substr($str,$x,1));
			}
		
		$branches = implode(",",$arr);
		$uridt1 = $this->uri->segment(7);
		$uridt2 = $this->uri->segment(8);
		$causeid = ($this->uri->total_segments()>9)?implode(",",explode("-",$this->uri->segment(10))):0;
		$causestring = ($this->uri->total_segments()>9)?$this->uri->segment(10):0;
		$timerange = "";
		$data['timerange'] = 'Cabang belum dipilih';
		switch($this->uri->segment(6)){
			case '1':
				$timerange = "and q.hari<=1";		
				$data['timerange']="x <= 1";
			break;
			case '2':
				$timerange = "and q.hari<=2";
				$data['timerange']="<= 3";		
			break;
			case '3':
				$timerange = "and q.hari <=6";
				$data['timerange']="<= 7";		
			break;
			case '4':
				$timerange = "and q.hari>7";
				$data['timerange']="x > 7";		
			break;
			case '5':
			$timerange = "and q.hari <3";
			$data['timerange'] = "x<3";
			break;
			case '6':
			$timerange = "and q.hari >=3 and q.hari <= 7 ";
			$data['timerange'] = "3 <= x <= 7 ";
			break;
			case '7':
			$timerange = "and q.hari >7";
			$data['timerange'] = "x>7";
			break;
		}
		$rorder = ($order ==='desc')?'asc':'desc';
	$userbranches = '"1","2","3","4"';
	$params = array('causeid'=>$causeid,'branches'=>$branches,'timerange'=>$timerange,'rorder'=>$rorder,'orderfield'=>$orderfield,'uridt1'=>$uridt1,'uridt2'=>$uridt2,'userbranches'=>$userbranches);
	$res = $this->prpt->getsolvedreport($params);
	$data['objs'] = $res['res'];
		$data["clientname"] = "test";
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$objs = $this->prpt->getsolvedreport($params);
		$data["suspects"] = $objs['res'];
		$data["uridate1"] = $this->common->sql_to_human_date($uridt1);
		$data["uridate2"] = $this->common->sql_to_human_date($uridt2);
		$data['cause'] = array(1=>'satau',2=>'duao');
		$data['causestring'] = $causestring;
		$this->load->view("TS/reports/solvedreport2",$data);
	}
	function getsolvedreport(){
		$params = $this->input->post();
		/*$params = array(
			'causeid'=>1,
			'branches'=>'"1","2","3","4"',
			'timerange'=>"and q.hari<=2",
			'rorder'=>'asc',
			'orderfield'=>'id',
			'uridt1'=>'2020-1-1',
			'uridt2'=>'2020-7-1',
			'userbranches'=>'"1","2","3","4"'
		);*/
		$res = $this->prpt->getsolvedreport($params);
		echo json_encode($res['res']);
	}
	function getsolvedreportamount(){
		$params = array(
			'causeid'=>'"1","2","3","4"',
			'branches'=>'"1","2","3","4"',
			'timerange'=>"and q.hari<=2",
			'rorder'=>'asc',
			'orderfield'=>'id',
			'uridt1'=>'2020-1-1',
			'uridt2'=>'2020-7-1',
			'userbranches'=>'"1","2","3","4"'
		);
		$res = $this->prpt->getsolvedreport($params);
		echo json_encode($res['cnt']);
	}
	function solvedreport4(){
		$this->load->model('prpt');
		$this->load->helper('report');
		$categories = $this->prpt->getcausecategories();
		//$causes = $this->prpt->getcauses();
		$data = array(
			'username'=>'padinet','pagetitle'=>'Solved Report',
			'rowAmounts'=>array('1'=>10,'1'=>25,'1'=>50,'1'=>100),
			'causecategories'=>$categories['res']);
		$this->load->view('TS/reports/solvedreport4',$data);
	}
	function suspectreport(){
		$this->check_login();
		$usrarr = array();
		$users = getsubordinates($this->ionuser->id,$usrarr);
		$userbranches = getuserbranches();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$dt1 = $this->uri->segment(5) . " 00:00:00";
		$dt2 = $this->uri->segment(6) . " 23:59:59";
		$brns = explode(",",$this->uri->segment(7));
		$brancharray = array();
		$str = $this->uri->segment(7);
			for($x=0;$x<strlen($str);$x++){
				array_push($brancharray,substr($str,$x,1));
			}		
		$branches = implode(",",$brns);
		$str = $this->uri->segment(8);
		$ams = explode("-",$str);
		$amsstr = implode("','",$ams);
		$sql = "select distinct d.id,d.name,d.address,c.name brn,e.username hunter,d.createdate create_date from ";
		$sql.= " suspects d  ";
		$sql.= "left outer join users e on e.id=d.user_id ";
		$sql.= "left outer join (select * from branches_users where defbranch='1' ) b on b.user_id=e.id ";
		$sql.= "left outer join branches c on c.id=b.branch_id ";
		$sql.= "where d.createdate>='".$dt1."' and d.createdate<='".$dt2."'";
		$sql.= "and c.id in ('".implode("','",$brancharray)."') ";
		$sql.= "and hide='0' ";
		$sql.= "and e.id in ('".$amsstr."') ";
		$sql.= "and e.active='1' ";
		$sql.= "order by ".$orderfield." " . $order;
		$rorder = ($order ==='desc')?'asc':'desc';
		$query = $this->db->query($sql);
		$result = $query->result();
		$data["clientname"] = "test";
		$data['total'] = $query->num_rows();
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["dt1"] = $this->uri->segment(5);
		$data["dt2"] = $this->uri->segment(6);
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["suspects"] = $result;
		$data["ams"] = $ams;
		$data["userbranches"] = $userbranches;
		//$data["users"] = $users;
		$data["users"] = array_intersect($users,getuserbybranch($brancharray));
		$data["branches"] = "'".implode("','",$brancharray)."'";
		
		$this->load->view("Sales/reports/suspectreport",$data);
	}
	function prospectreport(){
		$this->check_login();
		$usrarr = array();
		$users = getsubordinates($this->ionuser->id,$usrarr);
		$userbranches = getuserbranches();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$dt1 = $this->uri->segment(5) . " 00:00:00";
		$dt2 = $this->uri->segment(6) . " 23:59:59";
		$brns = explode(",",$this->uri->segment(7));
		$brancharray = array();
		$str = $this->uri->segment(7);
			for($x=0;$x<strlen($str);$x++){
				array_push($brancharray,substr($str,$x,1));
			}		
		$branches = implode(",",$brns);
		$str = $this->uri->segment(8);
		$ams = explode("-",$str);
		$amsstr = implode("','",$ams);
		$rorder = ($order ==='desc')?'asc':'desc';
		$result = $this->rptmodel->getProspectReport($dt1,$dt2,$brancharray,$amsstr,$order,$orderfield);
		$data["clientname"] = "test";
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["dt1"] = $this->uri->segment(5);
		$data["dt2"] = $this->uri->segment(6);
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["suspects"] = $result['result'];
		$data['total'] = $result['total'];
		$data["ams"] = $ams;
		$data["userbranches"] = $userbranches;
		$data["users"] = array_intersect($users,getuserbybranch($brancharray));
		$data["branches"] = "'".implode("','",$brancharray)."'";
		
		$this->load->view("Sales/reports/prospectreport",$data);
	}
	function surveyreport(){
		$this->check_login();
		$usrarr = array();
		$users = getsubordinates($this->ionuser->id,$usrarr);
		$userbranches = getuserbranches();
		//echo "USER BRANCHES " . implode(",",$userbranches);
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$dt1 = $this->uri->segment(5) . " 00:00:00";
		$dt2 = $this->uri->segment(6) . " 23:59:59";
		$brns = explode(",",$this->uri->segment(7));
		$brancharray = array();
		$str = $this->uri->segment(7);
			for($x=0;$x<strlen($str);$x++){
				array_push($brancharray,substr($str,$x,1));
			}		
		$branches = implode(",",$brancharray);
		$str = $this->uri->segment(8);
		$ams = explode("-",$str);
		$amsstr = implode("','",$ams);
		$rorder = ($order ==='desc')?'asc':'desc';
		$result = $this->rptmodel->getSurveyReport($dt1,$dt2,$branches,$amsstr,$order,$orderfield);
		$data["clientname"] = "test";
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["dt1"] = $this->uri->segment(5);
		$data["dt2"] = $this->uri->segment(6);
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["surveys"] = $result['result'];
		$data["ams"] = $ams;
		$data["userbranches"] = $userbranches;
		$data["users"] = array_intersect($users,getuserbybranch($brancharray));
		$data["branches"] = "'".implode("','",$brancharray)."'";
		$data['total'] = $result['total'];
		$this->load->view("Sales/reports/surveyreport",$data);
	}	
	function installreport(){
		$this->check_login();
		$usrarr = array();
		$users = getsubordinates($this->ionuser->id,$usrarr);
		$userbranches = getuserbranches();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$dt1 = $this->uri->segment(5) . " 00:00:00";
		$dt2 = $this->uri->segment(6) . " 23:59:59";
		$brns = explode(",",$this->uri->segment(7));
		$brancharray = array();
		$str = $this->uri->segment(7);
			for($x=0;$x<strlen($str);$x++){
				array_push($brancharray,substr($str,$x,1));
			}		
		$branches = implode(",",$brancharray);
		$str = $this->uri->segment(8);
		$ams = explode("-",$str);
		$amsstr = implode("','",$ams);
		$rorder = ($order ==='desc')?'asc':'desc';
		$result = $this->rptmodel->getInstallReport($dt1,$dt2,$branches,$amsstr,$orderfield,$order);
		$data["clientname"] = "test";
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["dt1"] = $this->uri->segment(5);
		$data["dt2"] = $this->uri->segment(6);
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["surveys"] = $result['result'];
		$data["ams"] = $ams;
		$data["userbranches"] = $userbranches;
		//$data["users"] = $users;
		$data["users"] = array_intersect($users,getuserbybranch($brancharray));
		$data["branches"] = "'".implode("','",$brancharray)."'";
		$data['total'] = $result['total'];
		$this->load->view("Sales/reports/installreport",$data);
	}	
	function ticketbyname(){
		$this->check_login();
		$client_id = $this->uri->segment(4);
		$ordertype = $this->uri->segment(3);
		$months = $this->padidatetime->getmonthsarray();
		$days = $this->padidatetime->getdaysarray();
		$query = "select a.id,a.kdticket,a.clientname,d.address,a.reporter,";
		$query.= "date_format(ticketstart,'%d %b %Y')ticketdatestart,date_format(ticketstart,'%H:%i:%s')tickettimestart,";
		$query.= "a.complaint,a.status,case a.status when '1' then 'selesai' when '0' then 'belum selesai' end textstatusx, b.description,b.conclusion, ";
		$query.= "case  when c.status is null then case a.status when  '0' then 'belum selesai' when '1' then 'selesai' end  else case c.status when '0'  then 'Progress' when '1' then 'Solved' when '2' then 'Monitoring'  end  end textstatus , ";
		$query.= "case when (a.downtimestart = '0000-00-00 00:00:00' or a.downtimeend = '0000-00-00 00:00:00') then '0' else datediff(downtimeend,downtimestart) end downtimeday,case when (a.downtimestart = '0000-00-00 00:00:00' or a.downtimeend = '0000-00-00 00:00:00') then '0' else date_format(timediff(downtimeend,downtimestart),'%i') end  downtimetime,solution,b.confirmationresult ";
		$query.= "from tickets a left outer join ticket_followups b on b.ticket_id=a.id ";
		$query.= " left outer join troubleshoot_requests c on c.ticket_id=a.id  ";
		$query.= " left outer join client_sites d on d.id=a.client_site_id ";
		$query.= "where a.client_id='$client_id' ";
		$data['extendsegment'] = "";
		$data['dt1'] = "";
		$data['dt2'] = "";
		$data['monthchecked'] = "";
		$data['allchecked'] = 'checked="checked"';
		if($this->uri->total_segments()===6){
			$query.= "and ticketstart>'".getticketdate($this->uri->segment(5)). "' ";
			$query.= "and ticketstart<'".getticketdate($this->uri->segment(6)). "' ";
			$data['extendsegment'] = $this->uri->segment(5).'/'.$this->uri->segment(6);
			$data['dt1'] = $this->common->sql_to_human_date(getticketdate($this->uri->segment(5)));
			$data['dt2'] = $this->common->sql_to_human_date(getticketdate($this->uri->segment(6)));
			$data['monthchecked'] = 'checked="checked"';
			$data['allchecked'] = "";
		};
		$query.="order by d.address asc,ticketstart ".$ordertype."; ";
		$res = $this->db->query($query);
		$tickets = $res->result();
		$data["tickets"] = $tickets;
		$data["client_id"] = $client_id;
		if($this->uri->segment(3)==='asc'){
			$data['order'] = 'desc';
			$data['ordertext'] = 'Urutkan dari yang paling baru';
		}else{
			$data['order'] = 'asc';
			$data['ordertext'] = 'Urutkan dari yang paling lama';
		}
		if($res->num_rows()>0){
			$data["clientname"] = "(".$tickets[0]->clientname.")";
		}else{
			$data["clientname"] = "(0 ticket)";
		}
		$this->load->view("TS/reports/ticketbynametable",$data);
	}
	function ticketbynameexcel(){
		$this->check_login();
		$client_id = $this->uri->segment(4);
		$ordertype = $this->uri->segment(3);
		$months = $this->padidatetime->getmonthsarray();
		$days = $this->padidatetime->getdaysarray();
		$query = "select a.id,a.kdticket,a.clientname,a.reporter,";
		$query.= "date_format(ticketstart,'%d %b %Y')ticketdatestart,date_format(ticketstart,'%H:%i:%s')tickettimestart,";
		$query.= "a.complaint,a.status,case a.status when '1' then 'selesai' when '0' then 'belum selesai' end textstatus, b.description ";
		$query.= "from tickets a left outer join ticket_followups b on b.ticket_id=a.id ";
		$query.= "where client_id='$client_id' order by ticketstart ".$ordertype."; ";
		$query = "select a.id,a.kdticket,a.clientname,a.reporter,";
		$query.= "date_format(ticketstart,'%d %b %Y')ticketdatestart,date_format(ticketstart,'%H:%i:%s')tickettimestart,";
		$query.= "a.complaint,a.status,case a.status when '1' then 'selesai' when '0' then 'belum selesai' end textstatusx, b.description ";
		$query.= ",case  when c.status is null then case a.status when  '0' then 'belum selesai' when '1' then 'selesai' end  else case c.status when '0'  then 'Progress' when '1' then 'Solved' when '2' then 'Monitoring'  end  end textstatus,  ";
		$query.= "case when (a.downtimestart = '0000-00-00 00:00:00' or a.downtimeend = '0000-00-00 00:00:00') then '0' else datediff(downtimeend,downtimestart) end downtimeday,case when (a.downtimestart = '0000-00-00 00:00:00' or a.downtimeend = '0000-00-00 00:00:00') then '0' else date_format(timediff(downtimeend,downtimestart),'%i') end  downtimetime,solution,b.confirmationresult ";
		$query.= "from tickets a left outer join ticket_followups b on b.ticket_id=a.id ";
		$query.= " left outer join troubleshoot_requests c on c.ticket_id=a.id  ";
		$query.= "where client_id='$client_id' ";
		$data['extendsegment'] = "";
		$data['dt1'] = "";
		$data['dt2'] = "";
		$data['monthchecked'] = "";
		$data['allchecked'] = 'checked="checked"';
		if($this->uri->total_segments()===6){
			$query.= "and ticketstart>'".getticketdate($this->uri->segment(5)). "' ";
			$query.= "and ticketstart<'".getticketdate($this->uri->segment(6)). "' ";
			$data['extendsegment'] = $this->uri->segment(5).'/'.$this->uri->segment(6);
			$data['dt1'] = $this->common->sql_to_human_date(getticketdate($this->uri->segment(5)));
			$data['dt2'] = $this->common->sql_to_human_date(getticketdate($this->uri->segment(6)));
			$data['monthchecked'] = 'checked="checked"';
			$data['allchecked'] = "";
		};
		$query.="order by ticketstart ".$ordertype."; ";
		$res = $this->db->query($query);
		$tickets = $res->result();
		$data["tickets"] = $tickets;
		$data["client_id"] = $client_id;
		if($this->uri->segment(3)==='asc'){
			$data['order'] = 'desc';
			$data['ordertext'] = 'Urutkan dari yang paling baru';
		}else{
			$data['order'] = 'asc';
			$data['ordertext'] = 'Urutkan dari yang paling lama';
		}
		//echo "Num Rows ".$res->num_rows();
		if($res->num_rows()>0){
			$data["clientname"] = "(".$tickets[0]->clientname.")";
		}else{
			$data["clientname"] = "(0 ticket)";
		}
		$this->load->view('TS/reports/ticketbynameexcel',$data);
	}
	function unsolvedreport(){
		$this->check_login();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$brns = explode(",",$this->uri->segment(5));
		$arr = array();
		$str = $this->uri->segment(5);
			for($x=0;$x<strlen($str);$x++){
				array_push($arr,substr($str,$x,1));
			}
		$uridt1 = $this->uri->segment(7);
		$uridt2 = $this->uri->segment(8);
		
		$branches = implode(",",$arr);
		switch($this->uri->segment(6)){
			case '1':
				$timerange = "q.hari<=3";		
				$data['timerange']="x <= 3";
			break;
			case '2':
				$timerange = "q.hari>3 and q.hari<=6";
				$data['timerange']="3 < x <= 7";		
			break;
			case '3':
				$timerange = "q.hari>5 and q.hari<=6";
				$data['timerange']="5 < x <= 7";		
			break;
			case '4':
				$timerange = "q.hari>7";
				$data['timerange']="x > 7";		
			break;
		}
		$userbranches = '"1","2","3","4"';
		$sql = "select * from (";
		$sql.= "select a.id,a.kdticket,a.create_date,a.ticketstart,a.ticketend,a.createuser,a.status,a.cause, ";
		$sql.= "case a.status when '0' then 'open' when '1' then 'close' end ticketStatus,";
		$sql.= "case a.status when '0' then '-' when '1' then ticketend end ticket_End,";
		$sql.= "a.clientname,a.reporterphone,a.requesttype,a.parentid,b.id cid,c.id backboneid,";
		$sql.= "d.id btsid,e.id dcid,f.id ptpid,reporter,i.trid,j.hastroubleshoot,";

		$sql.= "case ";
		$sql.= "when b.id is not null then b.brnid ";
		$sql.= "when c.id is not null then c.brnid ";
		$sql.= "when d.id is not null then d.brnid ";
		$sql.= "when e.id is not null then e.brnid ";
		$sql.= "when f.id is not null then f.brnid ";
		$sql.= "when g.id is not null then g.brnid ";
		$sql.= "when h.id is not null then h.brnid ";
		$sql.= "else '-' ";
		$sql.= "end brnid, ";
		
		$sql.= "case ";
		$sql.= "when b.id is not null then b.brn ";
		$sql.= "when c.id is not null then c.brn ";
		$sql.= "when d.id is not null then d.brn ";
		$sql.= "when e.id is not null then e.brn ";
		$sql.= "when f.id is not null then f.brn ";
		$sql.= "when g.id is not null then g.brn ";
		$sql.= "when h.id is not null then h.brn ";
		$sql.= "else '-' ";
		$sql.= "end brn, ";
		
		$sql .= "case ";
		$sql.= "when ticketend is null then datediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then datediff(now(),ticketstart) ";
		$sql.= "else datediff(ticketend,ticketstart) end  hari ,";

		$sql .= "concat(case ";
		$sql.= "when ticketend is null then datediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then datediff(now(),ticketstart) ";
		$sql.= "else datediff(ticketend,ticketstart) end,' hari ',";

		$sql.= "time_format(case ";
		$sql.= "when ticketend is null then timediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then timediff(now(),ticketstart) ";
		$sql.= "else timediff(ticketend,ticketstart) end,'%H') % 24, ";

		$sql.= "time_format(case ";
		$sql.= "when ticketend is null then timediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then timediff(now(),ticketstart) ";
		$sql.= "else timediff(ticketend,ticketstart) end,'  jam %i menit %s detik')) duration3 ";
		
		$sql.= " from (select * from tickets ";
		$sql.= " where ";
		//$sql.= "status='0' and ";
		$sql.= "( ticketstart<'".$uridt1."' and ticketend>'".$uridt2."' )";
		$sql.= ") a ";
		
		$sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from client_sites a left outer join branches_client_sites b on b.client_site_id=a.id left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ) b on b.id=a.client_site_id ";
		
		$sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from backbones a left outer join backbones_branches b on b.backbone_id=a.id left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ) c on c.id=a.backbone_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from btstowers a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) d on d.id=a.btstower_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from datacenters a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) e on e.id=a.datacenter_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from ptps a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) f on f.id=a.ptp_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from cores a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) g on g.id=a.core_id ";
		
		$sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from aps a left outer join btstowers b on b.id=a.btstower_id left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ) h on h.id=a.ap_id ";
		
		$sql.= "left outer join (select id trid,ticket_id from troubleshoot_requests where status='0') i on i.ticket_id=a.id ";
		
		$sql.= "left outer join (select id hastroubleshoot,ticket_id from troubleshoot_requests) j on j.ticket_id=a.id ";
		
		$sql.= "where b.id is not null or c.id is not null or d.id is not null or e.id is not null or f.id is not null or g.id is not null or h.id is not null ";
		
		$sql.= ")q ";
		$sql.= "where ".$timerange." and brnid in (".$branches.") ";
		$rorder = ($order ==='desc')?'asc':'desc';
		$sql.= "order by ".$orderfield." ".$rorder.";";
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		$data["clientname"] = "test";
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["suspects"] = $result;
		$data["uridate1"] = $this->common->sql_to_human_date($uridt1);
		$data["uridate2"] = $this->common->sql_to_human_date($uridt2);
		$this->load->view("TS/reports/unsolvedtickets",$data);
	}	
	function excelshiftreport(){
		$this->check_login();
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$mydate = date_create($ticketstart);
		$myday = date_format($mydate,"D");
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(6));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(6),$c,1));
		}		
		$branchselected = "'".implode("','",$arrbranchselected)."'";	
		$months = $this->padidatetime->getmonthsarray();
		$days = $this->padidatetime->getdaysarray();
		$query = "select a.id,a.kdticket,a.clientname,a.reporter,date_format(ticketstart,'%H:%i:%s')ticketstart,a.complaint,b.description from tickets a left outer join ticket_followups b on b.ticket_id=a.id where date_format(a.ticketstart,'%d/%c/%Y')='$ticketstart'; ";
		$query = "select a.id,a.kdticket,a.clientname,a.reporter,date_format(ticketstart,'%H:%i:%s')ticketstart,a.complaint,status from tickets a  left outer join branches_client_sites b on b.client_site_id=a.client_site_id  where date(a.ticketstart)='$ticketstart'  and b.branch_id in (".$branchselected."); ";
		$res = $this->db->query($query);
		$tickets = $res->result();
		$data["tickets"] = $tickets;




		$tickets = $this->pticket->getshiftreport($ticketstart,$branchselected);
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["total"];

		$data["date"] = $days[$myday]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["datenospace"] = $days[$myday]."-".$this->uri->segment(3)."-".$months[$this->uri->segment(4)-1]."-".$this->uri->segment(5);
		$this->load->view("TS/reports/excel-shiftreport",$data);
	}
	function zabbix(){
		$this->check_login();
		$this->load->view("zabbix/zabbix");
	}
	function zabbix2(){
		$this->check_login();
		$data["menuFeed"] = "zabbix";
		$this->load->view("zabbix/index",$data);
	}
	function zabbixm(){
		$this->check_login();
				
		$api = new ZabbixApi('http://202.6.233.15/zabbix/api_jsonrpc.php', 'puji', 'pujicute2016');
		echo "PadiNET Zabbix sample<br />";
		
			$graphs = $api->serviceget();

		// print all graph IDs
		foreach($graphs as $graph){
			foreach($graph as $key=>$val){
				if($key==="problems"){
					echo "has problem ".count($val)." <br />";
					foreach($val as $k=>$v){
						echo $k." =>".$v."<br />";
					}
				}
				echo $key . " and " . $val . "<br />";
			}
		}
	}
	function sla(){
		$this->check_login();
		$data["menuFeed"] = "zabbix";
		$api = new ZabbixApi('http://202.6.233.15/zabbix/api_jsonrpc.php', 'puji', 'pujicute2016');
		$graphs = $api->serviceGetsla(array("serviceids"=>array("1","2"),"intervals"=>array(
							"from"=>1152452201,
							"to"=>1461645184004 
						)));
		$data["services"] = get_zabbixservices();
		$data["graphs"] = $graphs;
		$this->load->view("zabbix/sla",$data);
	}
	function graph(){
		$this->check_login();
		$data["menuFeed"] = "zabbix";
		$api = new ZabbixApi('http://202.6.233.15/zabbix/api_jsonrpc.php', 'puji', 'pujicute2016');
		$graphs = $api->graphGet(array("serviceids"=>array("1","2"),"intervals"=>array(
							"from"=>1152452201,
							"to"=>1461645184004 
						)));
		$data["services"] = get_zabbixservices();
		$data["graphs"] = $graphs;
		$this->load->view("zabbix/sla",$data);
	}
	function testhelper(){
		$this->check_login();
		echo "test";
		$zabbix = get_zabbixservices();
		foreach($zabbix as $key=>$val){
			echo $key . " and " . $val . "<br />";
		}
	}
	function chart2(){
		$this->check_login();
		$data["graphid"] = $this->uri->segment(3);
		$data["menuFeed"] = "zabbix";
		$data["graphs"] = get_zabbixgraphid();
		$this->load->view("zabbix/chart",$data);
		//http://202.6.233.15/zabbix/chart2.php?graphid=436
	}
	function testTelegram(){
		$this->load->view("telegram");
	}
	function showOpenTicket(){
		$this->check_login();
		$orderfield = $this->uri->segment(3);
		$order = $this->uri->segment(4);
		$brns = explode(",",$this->uri->segment(5));
		$arr = array();
		$str = $this->uri->segment(5);
			for($x=0;$x<strlen($str);$x++){
				array_push($arr,substr($str,$x,1));
			}
		$uridt1 = $this->uri->segment(7);
		$uridt2 = $this->uri->segment(8);
		
		$branches = implode(",",$arr);
		switch($this->uri->segment(6)){
			case '1':
				$timerange = "q.hari<=2";		
				$data['timerange']="x <= 3";
			break;
			case '2':
				$timerange = "q.hari>3 and q.hari<=6";
				$data['timerange']="3 < x <= 7";		
			break;
			case '3':
				$timerange = "q.hari>5 and q.hari<=6";
				$data['timerange']="5 < x <= 7";		
			break;
			case '4':
				$timerange = "q.hari>7";
				$data['timerange']="x > 7";		
			break;
		}
		$userbranches = '"1","2","3","4"';
		$sql = "select * from (";
		$sql.= "select a.id,a.kdticket,a.create_date,a.ticketstart,a.ticketend,a.createuser,a.status,a.cause, ";
		$sql.= "case a.status when '0' then 'open' when '1' then 'close' end ticketStatus,";
		$sql.= "case a.status when '0' then '-' when '1' then ticketend end ticket_End,";
		$sql.= "a.clientname,a.reporterphone,a.requesttype,a.parentid,b.id cid,c.id backboneid,";
		$sql.= "d.id btsid,e.id dcid,f.id ptpid,reporter,i.trid,j.hastroubleshoot,";

		$sql.= "case ";
		$sql.= "when b.id is not null then b.brnid ";
		$sql.= "when c.id is not null then c.brnid ";
		$sql.= "when d.id is not null then d.brnid ";
		$sql.= "when e.id is not null then e.brnid ";
		$sql.= "when f.id is not null then f.brnid ";
		$sql.= "when g.id is not null then g.brnid ";
		$sql.= "when h.id is not null then h.brnid ";
		$sql.= "else '-' ";
		$sql.= "end brnid, ";
		
		$sql.= "case ";
		$sql.= "when b.id is not null then b.brn ";
		$sql.= "when c.id is not null then c.brn ";
		$sql.= "when d.id is not null then d.brn ";
		$sql.= "when e.id is not null then e.brn ";
		$sql.= "when f.id is not null then f.brn ";
		$sql.= "when g.id is not null then g.brn ";
		$sql.= "when h.id is not null then h.brn ";
		$sql.= "else '-' ";
		$sql.= "end brn, ";
		
		$sql .= "case ";
		$sql.= "when ticketend is null then datediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then datediff(now(),ticketstart) ";
		$sql.= "else datediff(ticketend,ticketstart) end  hari ,";

		$sql .= "concat(case ";
		$sql.= "when ticketend is null then datediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then datediff(now(),ticketstart) ";
		$sql.= "else datediff(ticketend,ticketstart) end,' hari ',";

		$sql.= "time_format(case ";
		$sql.= "when ticketend is null then timediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then timediff(now(),ticketstart) ";
		$sql.= "else timediff(ticketend,ticketstart) end,'%H') % 24, ";

		$sql.= "time_format(case ";
		$sql.= "when ticketend is null then timediff(now(),ticketstart) ";
		$sql.= "when ticketend='0000-00-00 00:00:00' then timediff(now(),ticketstart) ";
		$sql.= "else timediff(ticketend,ticketstart) end,'  jam %i menit %s detik')) duration3 ";
		
		$sql.= " from (select * from tickets ";
		$sql.= " where ";
		$sql.= "status='0' ";
		//$sql.= " and ";
		//$sql.= "( ticketstart<'".$uridt1."' and ticketend>'".$uridt2."' )";
		$sql.= ") a ";
		
		$sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from client_sites a left outer join branches_client_sites b on b.client_site_id=a.id left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ) b on b.id=a.client_site_id ";
		
		$sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from backbones a left outer join backbones_branches b on b.backbone_id=a.id left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ) c on c.id=a.backbone_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from btstowers a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) d on d.id=a.btstower_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from datacenters a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) e on e.id=a.datacenter_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from ptps a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) f on f.id=a.ptp_id ";
		
		$sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from cores a left outer join branches b on b.id=a.branch_id where b.id in (".$userbranches.") ) g on g.id=a.core_id ";
		
		$sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from aps a left outer join btstowers b on b.id=a.btstower_id left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ) h on h.id=a.ap_id ";
		
		$sql.= "left outer join (select id trid,ticket_id from troubleshoot_requests where status='0') i on i.ticket_id=a.id ";
		
		$sql.= "left outer join (select id hastroubleshoot,ticket_id from troubleshoot_requests) j on j.ticket_id=a.id ";
		
		$sql.= "where b.id is not null or c.id is not null or d.id is not null or e.id is not null or f.id is not null or g.id is not null or h.id is not null ";
		
		$sql.= ")q ";
		$sql.= "where ".$timerange." and brnid in (".$branches.") ";
		$rorder = ($order ==='desc')?'asc':'desc';
		$sql.= "order by ".$orderfield." ".$rorder.";";
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		$data["clientname"] = "test";
		$data["total"] = $query->num_rows();
		$data["order"] = $rorder;
		$data["monthchecked"] = "2016-1-1";
		$data["orderby"] = $orderfield;
		$data["allchecked"] = true;
		$data["suspects"] = $result;
		$data["uridate1"] = date("Y-m-d");//$this->common->sql_to_human_date($uridt1);
		$data["uridate2"] = date("Y-m-d");//$this->common->sql_to_human_date($uridt2);
		$this->load->view("TS/reports/showOpenTicket",$data);
		
	}
	function complaintsperclient(){
		$this->load->helper('client');
		$this->load->model('branch');
		$businesstypes = getbusinesstypes();
		$branches = $this->branch->get_branches();
		$ticket = new Pticket();
		$data = array(
			'fbs'=>$ticket->getcomplaintsperclient(),
			'servicecategories'=>$this->service->get_combo_data(),
			'cities'=>getbrancharray(),
			'businesstypes'=>$businesstypes['res'],
			'branches'=>$branches['res'],
			'curdate'=>date("d/m/Y"),
		);
		$this->load->view('Sales/reports/complaintsperclient',$data);
	}
	function complaintpershift(){
		$uridt1 = $this->uri->segment(3);
		$uridt2 = $this->uri->segment(4);
		$data["uridate1"] = $this->common->sql_to_human_date($uridt1);
		$data["uridate2"] = $this->common->sql_to_human_date($uridt2);

		$begin = new DateTime($uridt1);
		$end = new DateTime($uridt2);
		
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		$data['period'] = $period;
		$data['fakeperiod'] = array();
		$this->load->view('TS/reports/ticketpershift',$data);
	}
	function complaintpershiftexcel(){
		$uridt1 = $this->uri->segment(3);
		$uridt2 = $this->uri->segment(4);
		$data["uridate1"] = $this->common->sql_to_human_date($uridt1);
		$data["uridate2"] = $this->common->sql_to_human_date($uridt2);

		$begin = new DateTime($uridt1);
		$end = new DateTime($uridt2);
		
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		$data['period'] = $period;
		$data['month'] = 12;
		$data['year'] = '2018';
		$this->load->view('TS/reports/ticketpershift-excel',$data);
	}
	function getvasclients1(){
		$data['vasclients'] = $this->pticket->getvasclients();
		$this->load->view('TS/reports/vasclients',$data);
	}
	function getvasclients2(){
		for($c=1;$c<=24;$c++){
			$data['vasclients'.$c] = $this->pticket->getclientspervas($c);
		}
		$this->load->view('TS/reports/vasclients2',$data);
	}
	function getvasclientbar(){
		$this->load->view('TS/reports/vasclientbar',$data);
	}
	function getvasclients(){
		for($c=1;$c<=25;$c++){
			$data['vasclients'.$c] = $this->pticket->getclientspervas($c);
		}
		$this->load->view('TS/reports/vas_clients',$data);
	}
	function getvasclient(){
		$this->load->model('vas');
		$data['vasname'] = $this->vas->getnamebyid($this->uri->segment(3));
		$data['clients'] = $this->vas->getclients($this->uri->segment(3));
		$this->load->view('TS/reports/vas_client',$data);
	}
	function getbyrootcause(){
		$this->load->model('pcause');
		$data['tickets'] = $this->pcause->getrpt(array('period'=>'2020-01','category_id'=>array(3,8)));
		$this->load->view('TS/reports/getbyrootcause',$data);
	}
	function mainrootcause(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$category = $this->uri->segment(10);
		$category = str_replace('-',',',$category);
		$mydate1 = date_create($ticketstart);
		$mydate2 = date_create($ticketend);
		$myday1 = date_format($mydate1,"D");
		$myday2 = date_format($mydate2,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$data["userbranch"] = implode(",",getuserbranches());
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["category"] = explode(',',$category);
		$data["arrbranch"] = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pcause->getrpt(array('category_id'=>array($category),'ticketstart'=>$ticketstart,'ticketend'=>$ticketend,'branches'=>$arrbranchselected));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$this->load->view('TS/reports/mainrootcause',$data);
	}
	function periodtop5(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$branches = $this->uri->segment(9);
		$numtoshow = $this->uri->segment(10);
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
		$tickets = $this->pcause->gettop5mainrootcauseb(array('ticketstart'=>$ticketstart,'ticketend'=>$ticketend,'branches'=>$arrbranchselected,'numtoshow'=>$numtoshow));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data["mainrootname"] = '';
		$data['mainroots'] = $this->pcause->getmainrootskeyval();
		$data['branches'] = $branches;
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data['numtoshow'] = $numtoshow;
		$data['numbertoshow'] = array('5'=>'5','All'=>'Semua');
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$this->load->view('TS/reports/periodtop5',$data);
	}
	function getticketsbymainroot(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$branches = $this->uri->segment(9);
		$category_id = $this->uri->segment(10);
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
		$tickets = $this->pcause->getticketsbymainroot(array('ticketstart'=>$ticketstart,'ticketend'=>$ticketend,'branches'=>$arrbranchselected,'category_id'=>$category_id));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data['branches']= $branches;
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data['category_id'] = $category_id;
		$data['title'] = 'Laporan Ticket-ticket berdasarkan Main Root Cause TS';
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$this->load->view('TS/reports/getticketsbymainroot',$data);
	}
	function periodtopsub5(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$branches = $this->uri->segment(9);
		$category_id = $this->uri->segment(10);
		$numtoshow = $this->uri->segment(11);
		$mydate1 = date_create($ticketstart);
		$mydate2 = date_create($ticketend);
		$myday1 = date_format($mydate1,"D");
		$myday2 = date_format($mydate2,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$data["userbranch"] = implode(",",getuserbranches());
		$mainroots = $this->pcause->getmainrootskeyval();
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pcause->gettop5subrootcauseb(array('ticketstart'=>$ticketstart,'ticketend'=>$ticketend,'branches'=>$arrbranchselected,'category_id'=>$category_id,'numtoshow'=>$numtoshow));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data['branches'] = $branches;
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data["mainrootname"] = $this->pcause->getmainrootname($category_id);
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$data['mainroots']=$mainroots;
		$data['category_id']=$category_id;
		$data['numtoshow'] = $numtoshow;
		$data['numbertoshow'] = array('5'=>'5','All'=>'Semua');
		$this->load->view('TS/reports/periodtopsub5',$data);
	}
	function top5subrootcause(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$branches = $this->uri->segment(9);
		$category_id = $this->uri->segment(10);
		$mydate1 = date_create($ticketstart);
		$mydate2 = date_create($ticketend);
		$myday1 = date_format($mydate1,"D");
		$myday2 = date_format($mydate2,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$data["userbranch"] = implode(",",getuserbranches());
		$mainroots = $this->pcause->getmainrootskeyval();
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["arrbranch"] = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pcause->gettop5subrootcauseb(
			array(
				'ticketstart'=>$ticketstart,
				'ticketend'=>$ticketend,
				'branches'=>$arrbranchselected,
				'category_id'=>$category_id
			));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data['branches'] = $branches;
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data["mainrootname"] = $this->pcause->getmainrootname($category_id);
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$data['mainroots']=$mainroots;
		$data['category_id']=$category_id;		
		$this->load->view('TS/reports/periodtop5b',$data);
	}
	function getticketsbysubroot(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$branches = $this->uri->segment(9);
		$cause_id = $this->uri->segment(10);
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
		$tickets = $this->pcause->getticketsbysubroot(array('ticketstart'=>$ticketstart,'ticketend'=>$ticketend,'branches'=>$arrbranchselected,'cause_id'=>$cause_id));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data['branches']= $branches;
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$data['cause_id'] = $cause_id;
		$data['title'] = 'Laporan Ticket-ticket berdasarkan Sub Root Cause TS';
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$this->load->view('TS/reports/getticketsbymainroot',$data);
	}

	function mainrootcauseexcel(){
		$this->check_login();
		$this->load->model('pcause');
		$this->load->helper('report');
		$ticketstart = $this->uri->segment(5)."-".$this->uri->segment(4)."-".$this->uri->segment(3);
		$ticketend = $this->uri->segment(8)."-".$this->uri->segment(7)."-".$this->uri->segment(6);
		$category = $this->uri->segment(10);
		$category = str_replace('-',',',$category);
		$mydate1 = date_create($ticketstart);
		$mydate2 = date_create($ticketend);
		$myday1 = date_format($mydate1,"D");
		$myday2 = date_format($mydate2,"D");
		$months = $this->padidatetime->getmonthsarray("id");
		$days = $this->padidatetime->getdaysarray("id");
		$data["userbranch"] = implode(",",getuserbranches());
		$arrbranches = getuserbranches();
		$data["userbranches"] = implode("",$arrbranches);
		$data["category"] = explode(',',$category);
		$data["arrbranch"] = getuserbranches();
		$arrbranchselected = array();
		for($c=0;$c<strlen($this->uri->segment(9));$c++){
			array_push($arrbranchselected,substr($this->uri->segment(9),$c,1));
		}
		$branchselected = "'".implode("','",$arrbranchselected)."'";		
		$tickets = $this->pcause->getrpt(array('category_id'=>array($category),'ticketstart'=>$ticketstart,'ticketend'=>$ticketend,'branches'=>$arrbranchselected));
		$data["tickets"] = $tickets["res"];
		$data["total"] = $tickets["cnt"];
		$data["date1"] = $days[$myday1]." ".$this->uri->segment(3)." ".$months[$this->uri->segment(4)-1]." ".$this->uri->segment(5);
		$data["date2"] = $days[$myday2]." ".$this->uri->segment(6)." ".$months[$this->uri->segment(7)-1]." ".$this->uri->segment(8);
		$data["dateselected1"] = $this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
		$data["dateselected2"] = $this->uri->segment(6)."/".$this->uri->segment(7)."/".$this->uri->segment(8);
		$categories = $this->pcause->getcategories();
		$data['categories'] = $categories['res'];
		$this->load->view('TS/reports/mainrootcauseexcel',$data);
	}
	function datagetticketperiodicb(){
		$params = $this->input->post();
		echo json_encode($params);
	}
	function viewmonthlyduration(){
		$yearmonth = $this->uri->segment(3);
		$splited = explode("-",$yearmonth); 
		$data = array(
			'timerange'=>'',
			'year'=>$splited[0],'month'=>$splited[1],
			'months'=>$this->padidatetime->getmonthsarray2(),
			'yearmonth'=>$yearmonth,
			'objs'=>$this->pticket->getticketmonthly(array('yearmonth'=>$yearmonth))
		);
		$this->load->view('TS/reports/monthlyduration',$data);
	}
	function excelmonthlyduration(){
		$yearmonth = $this->uri->segment(3);
		$data = array(
			'timerange'=>'',
			'objs'=>$this->pticket->getticketmonthly(array('yearmonth'=>$yearmonth)),
			'datenospace'=>$yearmonth,
			'yearmonth'=>$yearmonth
		);
		$this->load->view('TS/reports/monthlydurationexcel',$data);
	}
}

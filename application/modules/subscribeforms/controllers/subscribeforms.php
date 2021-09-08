<?php
class Subscribeforms extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('subscription');
		$this->load->helper('padi');
	}
	function index(){
		padi_checklogin();
		$objs=getclients();
		$fbs = clientswithfb();
		$data = array(
			'objs'=>$objs["res"],
			'total'=>$fbs,
			'menuFeed'=>'subscribeform'
		);
		$this->load->view('Sales/subscribeforms/index',$data);
	}
	function edit(){
		padi_checklogin();
		$id = $this->uri->segment(3);
		$clientsite = $this->pfbs->getclientinfo($id);
		$fb = $this->pfbs->getfb($id);
		$data = array(
			'objs'=>getpics($id),
			'fb'=>$fb,
			'menuFeed'=>'subscribeform',
			'clientsite'=>$clientsite,
			'id'=>$id,
			'username'=>$this->session->userdata['username'],
		);
		$this->load->view('Sales/subscribeforms/edit',$data);
	}
	function iscomplete($fbid){
		$obj = new Fb();
		$obj->where('id',$fbid)->get();
		$iscomplete = true;
		if(trim($obj->name)===''){
			$iscomplete = false;
		}
		if(trim($obj->activationdate)===''){
			$iscomplete = false;
		}
		if(isnull($obj->activationdate)){
			$iscomplete = false;
		}
		if(trim($obj->period1)===''){
			$iscomplete = false;
		}
		if(trim($obj->period2)===''){
			$iscomplete = false;
		}
		if(isnull($obj->period1)){
			$iscomplete = false;
		}
		if(isnull($obj->period2)){
			$iscomplete = false;
		}
		return $iscomplete;
	}
	function removefee(){
		$this->load->model('fb_fee');
		$params = $this->input->post();
		$obj = new Fb_fee();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->remove();
	}
	function savefee(){
		$this->load->model('fb_fee');
		$params = $this->input->post();
		$obj = new Fb_fee();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		
		echo $this->db->insert_id();
	}
	function setfbcomplete(){
		$params = $this->input->post();
		$obj = new Client_site();
		$obj->where('id',$params['id'])->update(array('fbcomplete'=>'1'));
		echo $params['id'];
	}
	function getpics(){
		$this->load->model('fb_fee');
		$clientsiteid = $this->uri->segment(3);
		$fb = $this->pfbs->getfb($clientsiteid);
		$fbfb = $this->pfbs->getfbfb($clientsiteid);
		$clientsite = $this->pfbs->getclientinfo($clientsiteid);
		$fbpic = $this->pfbs->getfbpic($clientsiteid);
		$fbsfees = $this->fb_fee->getbyclientsiteid($clientsiteid,"setup");
		$setup = '"id":"'.$fbsfees['name'].'","name":"BIAYA SETUP","dpp":"Rp. '.number_format($fbsfees['dpp'],0,",",".").',-","ppn":"'.number_format($fbsfees['ppn'],0,",",".").',-","total":"Rp. '.number_format($fbsfees['total'],0,",",".").',-"';

		$fbsfees = $this->fb_fee->getbyclientsiteid($clientsiteid,"monthly");
		$monthlyfee = '"id":"'.$fbsfees['name'].'","name":"BIAYA BERLANGGANAN BULANAN","dpp":"Rp. '.number_format($fbsfees['dpp'],0,",",".").',-","ppn":"'.number_format($fbsfees['ppn'],0,",",".").',-","total":"Rp. '.number_format($fbsfees['total'],0,",",".").',-"';

		$fbsfees = $this->fb_fee->getbyclientsiteid($clientsiteid,"device");
		$device = '"id":"'.$fbsfees['name'].'","name":"BIAYA PERANGKAT","dpp":"Rp. '.number_format($fbsfees['dpp'],0,",",".").',-","ppn":"'.number_format($fbsfees['ppn'],0,",",".").',-","total":"Rp. '.number_format($fbsfees['total'],0,",",".").',-"';

		$fbsfees = $this->fb_fee->getbyclientsiteid($clientsiteid);
		$deposit = '"id":"'.$fbsfees['name'].'","name":"BIAYA LAINNYA","dpp":"Rp. '.number_format($fbsfees['dpp'],0,",",".").',-","ppn":"'.number_format($fbsfees['ppn'],0,",",".").',-","total":"Rp. '.number_format($fbsfees['total'],0,",",".").',-"';
		if($fbfb!=false){
			$nofb = '"nofb":"'.$fbfb->nofb.'"';
			$username = '"username":"'.$fbfb->username.'"';
			$accounttype = '"accounttype":"'.$fbfb->accounttype.'"';
			$billaddress = '"billaddress":"'.$fbfb->billaddress.'"';
			//$description = '"description":"'.$fbfb->description.'"';
			$siup = '"siup":"'.$fbfb->siup.'"';
			$businesstype = '"businesstype":"'.$fbfb->businesstype.'"';
			$otherbusinesstype = '"otherbusinesstype":"'.$fbfb->otherbusinesstype.'"';
			$activationdate = $fbfb->activationdate;
			$service = '"service":"'.$fbfb->services.'"';
			$npwp = '"npwp":"'.$fbfb->npwp.'"';
			$period1 = $fbfb->period1;
			$period2 = $fbfb->period2;
		}else{
			$nofb = '"nofb":"-"';
			$username = '"username":"-';
			$accounttype = '"accounttype":"-';
			$billaddress = '"billaddress":"-';
			//$description = '"description":"-';
			$siup = '"siup":"-"';
			$businesstype = '"-"';
			$otherbusinesstype = '"-"';
			$activationdate = "1900-01-01 00:00:00";
			$service = '"-"';
			$npwp = '"-"';
			$period1 = "1900-01-01 00:00:00";
			$period2 = "1900-01-01 00:00:00";
		}
		if($clientsite!=false){
			$name = '"name":"'.$clientsite->name.'"';
			$address = '"address":"'.$clientsite->address.'"';
			$phone = '"phone":"'.$clientsite->phone.'"';
			$fax = '"fax":"'.$clientsite->fax.'"';	
		}else{
			$name = '"name":"-"';
			$address = '"address":"-"';
			$phone = '"phone":"-"';
			$fax = '"fax":"-"';
	
		}
		$subscriber = '"id":"","name":"","position":"","idnum":"","phone":"","hp":"","email":""';
		$tek = '"id":"","name":"","phone":"","hp":"","email":""';
		$resp = '"id":"","name":"","position":"","idnum":"","phone":"","hp":"","email":""';
		$bill = '"id":"","name":"","phone":"","hp":"","email":""';
		$support = '"id":"","name":"","phone":"","hp":"","email":""';
		$adm = '"id":"","name":"","phone":"","hp":"","email":""';
		foreach($fbpic as $pic){
			switch(strtoupper($pic->role)){
				case 'SUBSCRIBER':
					$subscriber = '"id":"'.$pic->client_id.'","name":"'.$pic->name.'","position":"'.$pic->position.'","ktp":"'.$pic->idnum.'","telp_hp":"'.$pic->telp_hp .'","phone":"'.$pic->phone.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
				case 'TEKNIS':
					$tek = '"id":"'.$pic->client_id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp .'","phone":"'.$pic->phone.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'","idnum":"'.$pic->idnum.'"';
				break;
				case 'RESP':
					$resp = '"id":"'.$pic->client_id.'","name":"'.$pic->name.'","position":"'.$pic->position.'","ktp":"'.$pic->idnum.'","telp_hp":"'.$pic->telp_hp .'","phone":"'.$pic->phone.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'","idnum":"'.$pic->idnum.'"';
				break;
				case 'BILLING':
					$bill = '"id":"'.$pic->client_id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp .'","phone":"'.$pic->phone.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'","idnum":"'.$pic->idnum.'"';
				break;
				case 'SUPPORT':
					$support = '"id":"'.$pic->client_id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp .'","phone":"'.$pic->phone.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'","idnum":"'.$pic->idnum.'"';
				break;
				case 'ADM':
				$adm = '"id":"'.$pic->client_id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp .'","phone":"'.$pic->phone.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'","idnum":"'.$pic->idnum.'"';
				break;
			}
		}
		$str = '{'.$nofb.',';
		$str .= $name.',';
		$str .= $username.',';
		$str .= $businesstype.',';
		$str .= $otherbusinesstype.',';
		$str .= $address.',';
		$str .= $phone.',';
		$str .= $fax.',';
		$str .= $siup.',';
		$str .= $npwp.',';
		$str .= $accounttype.',';
		$str .= $billaddress.',';
		//$str .= $description.',';
		$str .= $service.',';
		$str .= '"subscriber":{'.$subscriber.'},';
		$str .= '"resp":{'.$resp.'},';
		$str .= '"adm":{'.$adm.'},';
		$str .= '"teknis":{'.$tek.'},';
		$str .= '"billing":{'.$bill.'},';
		$str .= '"support":{'.$support.'},';
		$str .= '"activationdate":"'.date ("d/m/Y",strtotime($activationdate)).'",';
		$str .= '"period1":"'.date ("d/m/Y",strtotime($period1)).'",';
		$str .= '"period2":"'.date ("d/m/Y",strtotime($period2)).'",';
		$str .= '"services":"Layanan macan-macan",';
		$str .= '"monthlyfee":{'.$monthlyfee.'},';
		$str .= '"devicefee":{'.$device.'},';
		$str .= '"setupfee":{'.$setup.'},';
		$str .= '"otherfee":{'.$deposit.'},';
		$str .= '"otherbusinesstype":{'.$otherbusinesstype.'},';
		$str .= '"businesstype":{'.$businesstype.'}}';
		echo $str;
	}
	function getfbdescription(){
		$fbfb = $this->pfbs->getfbfb($clientsiteid);
		echo $fbfb->description;
	}
	function getfees(){
		$clientsiteid = $this->uri->segment(3);
		$fb = $this->pfbs->getfb($clientsiteid);
		$clientsite = $this->pfbs->getclientinfo($clientsiteid);
		$fbpic = $this->pfbs->getfbpic($clientsiteid);
		$nofb = '"nofb":"'.$fb->nofb.'"';
		$name = '"name":"'.$clientsite->name.'"';
		$businesstype = '"businesstype":"'.$fb->businesstype.'"';
		$address = '"address":"'.$clientsite->address.'"';
		$phone = '"phone":"'.$clientsite->phone.'"';
		$fax = '"fax":"'.$clientsite->fax.'"';
		$siup = '"siup":"'.$fb->siup.'"';
		$npwp = '"npwp":"'.$fb->npwp.'"';
		$subscriber = '"id":"","name":"","position":"","idnum":"","phone":"","hp":"","email":""';
		$tek = '"id":"","name":"","phone":"","hp":"","email":""';
		$resp = '"id":"","name":"","position":"","idnum":"","phone":"","hp":"","email":""';
		$bill = '"id":"","name":"","phone":"","hp":"","email":""';
		$support = '"id":"","name":"","phone":"","hp":"","email":""';
		$adm = '"id":"","name":"","phone":"","hp":"","email":""';
		foreach($fbpic as $pic){
			switch(strtoupper($pic->prole)){
				case 'PEMOHON':
					$subscriber = '"id":"'.$pic->id.'","name":"'.$pic->name.'","position":"'.$pic->position.'","ktp":"'.$pic->ktp.'","telp_hp":"'.$pic->telp_hp.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
				case 'TEKNIS & INSTALASI':
					$tek = '"id":"'.$pic->id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
				case 'PENANGGUNG JAWAB':
					$resp = '"id":"'.$pic->id.'","name":"'.$pic->name.'","position":"'.$pic->position.'","ktp":"'.$pic->ktp.'","telp_hp":"'.$pic->telp_hp.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
				case 'PENAGIHAN':
					$bill = '"id":"'.$pic->id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
				case 'SUPPORT':
					$support = '"id":"'.$pic->id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
				case 'ADMINISTRASI':
				$adm = '"id":"'.$pic->id.'","name":"'.$pic->name.'","telp_hp":"'.$pic->telp_hp.'","hp":"'.$pic->hp.'","email":"'.$pic->email.'"';
				break;
			}
		}
		echo '{'.$nofb.','.$name.','.$businesstype.','.$address.','.$phone.','.$fax.','.$siup.','.$npwp.',"subscriber":{'.$subscriber.'},"resp":{'.$resp.'},"adm":{'.$adm.'},"teknis":{'.$tek.'},"billing":{'.$bill.'},"support":{'.$support.'},"activationdate":"'.date ("d/m/Y",strtotime($fb->activationdate)).'","period1":"'.date ("d/m/Y",strtotime($fb->period1)).'","period2":"'.date ("d/m/Y",strtotime($fb->period2)).'","services":"Layanan macam-macam"}';
	}
	function showreport(){
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
		$id = $this->uri->segment(3);
		$clientsite = $this->pfbs->getclientsiteinfo($id);
		$fb = $this->pfbs->getfb($id);
		$data = array(
			'id'=>$id,
			'objs'=>getpics($id),
			'fb'=>$fb,
			'menuFeed'=>'subscribeform',
			'clientsite'=>$clientsite
		);
		$this->load->view("Sales/subscribeforms/report",$data);
	}
}

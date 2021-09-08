<?php
class Troubleshoots extends CI_Controller{
	var $data,$ionuser;
	function __construct(){
		parent::__construct();
		if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
		}
		$this->load->helper('ticket');
		$this->load->helper('device');
		$this->load->helper('user');
		$this->load->helper('troubleshoot');
	}
	function bapreview(){
		$id = $this->uri->segment(3);
		$sql = "select id,name,description,troubleshoot_request_id,img from troubleshoot_bas where id = " . $id;
		$query = $this->db->query($sql);
		$result = $query->result();
		$this->data['menuFeed']='troubleshoot';
		$this->data['obj']=$result[0];
		$this->load->view('TS/troubleshoots/gallery',$this->data);
	}
	function check_login(){
		if(!$this->ion_auth->logged_in()){
			redirect('/adm/login');
		}
	}
	function drop_implementer(){
		$params = $this->input->post();
		echo $this->troubleshoot_implementer->remove($params['id']);
	}
	function device_withdrawal(){
		$params = $this->input->post();
		$obj = new Withdrawal();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo "withdrawed ! " . $this->db->insert_id();
	}
	function edit(){
		$this->check_login();
		$troubleshootid = $this->uri->segment(3);
		$obj = new Troubleshoot_request();
		$obj->where('id',$troubleshootid)->get();
		$this->data['menuFeed'] = 'troubleshoot';
		$this->data['obj']=$obj;
		$this->data['clients']=$this->client->get_combo_data();
		$this->data['sender']='troubleshoot_add';
		$this->data['services'] = $this->service->get_combo_data();
		$this->data['routers'] = array();
		$this->data['hours'] = $this->common->gethours();
		$this->data['minutes'] = $this->common->getminutes();

		if(($this->session->userdata["role"]==='TS')||($this->session->userdata["role"]==='EOS')){
			$this->load->view('TS/troubleshoots/edit',$this->data);
		}else{
			redirect('/');
		}
	}
	function entry_report(){
		$this->check_login();
		$this->load->helper('sites');
		$this->data['obj']=get_obj_by_id($this->uri->segment(3));
		$this->data['bas']=get_ba_by_id($this->uri->segment(3));
		$this->data['images']=get_images_by_id($this->uri->segment(3));
		$this->data['officers']=get_officer_by_id($this->uri->segment(3));
		$this->data['tmaterials']=get_materials_by_id($this->uri->segment(3));
		$this->data['services'] = $this->service->get_combo_data();
		$this->data['hours'] = $this->common->gethours();
		$this->data['aps']=$this->pap->get_combo_data();
		$this->data['antennas']=getvalcombodata(array(8,20,4,7,3,6,5));
		$this->data['btstowers']=$this->pbtstower->get_combo_data();
		$this->data['clients']=$this->client->get_combo_data();
		$this->data['devices']=$this->device->get_combo_data();
		$this->data['materials']=$this->material->get_combo_data();
		$this->data['materialtypes']=$this->materialtype->get_combo_data();
		$this->data['pccards']=getvalcombodata(array(2));
		$this->data['boards']=getvalcombodata(array(1));
		$this->data['routers']=getvalcombodata(array(14));
		$this->data['switches']=getvalcombodata(array(15));
		$this->data['routersboards']=getvalcombodata(array(1,14));
		$this->data['apwifis']=getvalcombodata(array(13));
		$this->data['materials'] = $this->materialtype->get_combo_data();
		$this->data['minutes'] = $this->common->getminutes();
		$this->data['ports'] = sitehlp_getports(24);
		$this->data['menuFeed'] = 'troubleshoot';
		if(($this->session->userdata["role"]==='TS')||($this->session->userdata["role"]==='EOS')){
			$this->load->view('TS/troubleshoots/entry_report',$this->data);
		}else{
			redirect('/');
		}
	}
	function view_report(){
		$this->check_login();
		$this->load->helper('sites');
		$this->data['obj']=$this->troubleshoot_request->get_obj_by_id($this->uri->segment(3));
		$this->data['services'] = $this->service->get_combo_data();
		$this->data['hours'] = $this->common->gethours();
		$this->data['aps']=$this->pap->get_combo_data();
		$this->data['antennas']=$this->device->get_combo_data(8);
		$this->data['btstowers']=$this->pbtstower->get_combo_data();
		$this->data['clients']=$this->client->get_combo_data();
		$this->data['devices']=$this->device->get_combo_data();
		$this->data['materials']=$this->material->get_combo_data();
		$this->data['materialtypes']=$this->materialtype->get_combo_data();
		$this->data['pccards']=$this->device->get_combo_data(2);
		$this->data['boards']=$this->device->get_combo_data(1);
		$this->data['routers']=$this->device->get_combo_data(14);
		$this->data['switches']=$this->device->get_combo_data(15);
		$this->data['routersboards']=$this->device->get_combo_data(array(1,14));
		$this->data['apwifis']=$this->device->get_combo_data(13);
		$this->data['materials'] = $this->materialtype->get_combo_data();
		$this->data['minutes'] = $this->common->getminutes();
		$this->data['ports'] = sitehlp_getports(24);
		$this->data['menuFeed'] = 'troubleshoot';
		if($this->session->userdata["role"]==='TS'){
			$this->load->view('TS/troubleshoots/view_report',$this->data);
		}else{
			redirect('/');
		}
	}
	function report(){
		$id = $this->uri->segment(3);
		$objs = new Troubleshoot_request();
		$objs->where('id',$id)->get();
		$officers = array();
		foreach($objs->troubleshoot_officer as $officer){
			array_push($officers,$officer->name);
		}
		$officerstr = implode(',',$officers);
		$stt = "PROGRESS";
		switch($objs->status){
			case "0":
			$stt = "PROGRESS";
			break;
			case "1":
			$stt = "SOLVED";
			break;
			case "2":
			$stt = "MONITORING";
			break;
			default:
			$stt = "PROGRESS";
			break;
		}
		$data = array(
			'objs'=>$objs,
			'complaint'=>$objs->complaint,
			'officers'=>$officerstr,
			'status'=>$stt,
			'troubleshootid'=>$this->uri->segment(3)
		);
		$this->load->view('TS/troubleshoots/troubleshootreport',$data);
	}
	function getdata(){
		$id = $this->uri->segment(3);
//		echo json_encode($this->ptroubleshoot->getdata($id));
		echo $this->ptroubleshoot->getdata($id);
	}
	function getresume(){
		$id = $this->uri->segment(3);
		$sql = "select case when resume is null then '-' else resume end resume from troubleshoot_requests where id=".$id;
		$que = $this->db->query($sql);
		$res = $que->result();
		echo $res[0]->resume;
	}	
	function getactivities(){
		$id = $this->uri->segment(3);
		$sql = "select case when activities is null then '-' else activities end activities from troubleshoot_requests where id=".$id;
		$que = $this->db->query($sql);
		$res = $que->result();
		echo $res[0]->activities;
	}	
	function index(){
		$this->check_login();
		$this->data['menuFeed'] = 'troubleshoot';
		switch($this->session->userdata["role"]){
			case 'Sales':
				$this->load->model("troubleshoot_requests/troubleshoot");
				$this->data['objs'] = $this->troubleshoot->getTroubleshoots();
				$this->load->view('Sales/troubleshoots',$this->data);
			break;
			case 'TS':
				$this->data['objs'] = ts_populate();
				$this->load->view('TS/troubleshoots/index',$this->data);
			break;
			case 'CRO':
				$this->data['objs'] = ts_populate();
				$this->load->view('CRO/troubleshoots/index',$this->data);
			break;
			case 'EOS':
				$this->data['objs'] = ts_populate();
				$this->load->view('TS/troubleshoots/index',$this->data);
			break;
		}
	}
	function reportrouters(){
		$params = $this->input->post();
		$sql = "select id,tipe,macboard,barcode,ip_public,ip_private,user,password,location,barcode,serialno,milikpadinet ";
		$sql.= "from troubleshoot_routers ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];

		$sql = "select a.id,c.tipe,c.macboard,c.ip_public,c.ip_private,c.user,c.password,c.location,c.barcode,";
		$sql.= "c.serialno,c.milikpadinet ";
		$sql.= "from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join site_routers c on c.client_site_id=b.id ";
		$sql.= "where a.id=".$params["troubleshoot_request_id"] ." ";
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","ip_public":"'.$res->ip_public.'","barcode":"'.$res->barcode.'","tipe":"'.$res->tipe.'","ip_private":"'.$res->ip_private.'","user":"'.$res->user.'","password":"'.$res->password.'","location":"'.$res->location.'","barcode":"'.$res->barcode.'","serialno":"'.$res->serialno.'","milikpadinet":"'.$res->milikpadinet.'","macboard":"'.$res->macboard.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}	
	function reportapwifis(){
		$params = $this->input->post();
		$sql = "select id,tipe,macboard,barcode,ip_address,essid,user,password,location,barcode,serialno,security_key, ";
		$sql.= "case status when '0' then 'Hilang' when '1' then 'Baik' when '2' then 'Rusak' end status ";
		$sql.= "from troubleshoot_ap_wifis ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$sql = "select a.id,b.id,c.id,c.tipe,c.macboard,c.ip_address,c.essid,c.security_key,c.user,c.password,c.location ";
		$sql.= "from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on  b.id=a.client_site_id ";
		$sql.= "left outer join site_ap_wifis c on c.client_site_id = b.id ";
		$sql.= "where a.id='".$params["troubleshoot_request_id"]."' ";
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			$str = '{"id":"'.$res->id.'",';
			$str.= '"macboard":"'.$res->macboard.'",';
			$str.= '"tipe":"'.$res->tipe.'",';
			$str.= '"ip_address":"'.$res->ip_address.'",';
			$str.= '"user":"'.$res->user.'",';
			$str.= '"password":"'.$res->password.'",';
			$str.= '"location":"'.$res->location.'",';
			$str.= '"barcode":"",';
			$str.= '"serialno":"",';
			$str.= '"essid":"'.$res->essid.'",';
			$str.= '"status":"",';
			$str.= '"security_key":"'.$res->security_key.'"}';
			array_push($arr,$str);
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}	
	function reportwirelessboards(){
		$params = $this->input->post();
		$sql = "select id,tipe,macboard,barcode,ip_address,essid,user,password,location,barcode,serialno,security_key ";
		$sql.= "from troubleshoot_apwifis ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$sql = "select a.id,b.id,c.id,c.tipe,c.macboard,c.ip_radio,c.essid,c.user,c.password from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join site_wireless_radios c on c.client_site_id=b.id ";
		$sql.= "where a.id='".$params['troubleshoot_request_id']."' ";
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			$str = '{"id":"'.$res->id.'",';
			$str.= '"macboard":"'.$res->macboard.'",';
			$str.= '"tipe":"'.$res->tipe.'",';
			$str.= '"ip_address":"'.$res->ip_radio.'",';
			$str.= '"user":"'.$res->user.'",';
			$str.= '"password":"'.$res->password.'",';
			$str.= '"location":"",';
			$str.= '"barcode":"",';
			$str.= '"serialno":"",';
			$str.= '"security_key":""}';
			array_push($arr,$str);
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}	
	function reportswitches(){
		$params = $this->input->post();
		$sql = "select id,name,mac,barcode,serialno,";
		$sql.= "case status when '0' then 'Hilang' when '1' then 'Baik' when '2' then 'Rusak' end status ";
		$sql.= "from troubleshoot_switches ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$sql = "select a.id,c.name,c.barcode,c.serialno,c.mac,c.description,'baik' status from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join site_switches c on b.id=c.client_site_id ";
		$sql.= "where a.id = " . $params["troubleshoot_request_id"];
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			$str = '{"id":"'.$res->id.'",';
			$str.= '"mac":"'.$res->mac.'",';
			$str.= '"name":"'.$res->name.'",';
			$str.= '"barcode":"'.$res->barcode.'",';
			$str.= '"description":"'.$res->description.'",';
			$str.= '"status":"'.$res->status.'",';
			$str.= '"serialno":"'.$res->serialno.'"}';
			array_push($arr,$str);
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}	
	function reportpccards(){
		$params = $this->input->post();
		$sql = "select id,name,macaddress,barcode,serialno,description, ";
		$sql.= "case status when '0' then 'Hilang' when '1' then 'Baik' when '2' then 'Rusak' end status ";
		$sql.= "from troubleshoot_pccards ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$sql = "select a.id,c.name,c.macaddress,c.barcode,c.serialno,c.description,'baik' status from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join site_pccards c on c.client_site_id=b.id ";
		$sql.= "where a.id = " . $params["troubleshoot_request_id"];
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			$str = '{"id":"'.$res->id.'",';
			$str.= '"name":"'.$res->name.'",';
			$str.= '"status":"'.$res->status.'",';
			$str.= '"macaddress":"'.$res->macaddress.'",';
			$str.= '"barcode":"'.$res->barcode.'",';
			$str.= '"description":"'.$res->description.'",';
			$str.= '"serialno":"'.$res->serialno.'"}';
			array_push($arr,$str);
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}
	function reportdevices(){
		$params = $this->input->post();
		$sql = "select id,tipe,macboard,barcode,ip_address,essid,user,password,location,barcode,serialno,security_key ";
		$sql.= "from troubleshoot_apwifis ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$sql = "select a.id,c.name,c.barcode,c.serialno,'baik' status,devicetype,amount,location,updateuser ";
		$sql.= "from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join site_devices c on c.client_site_id=b.id ";
		$sql.= "where a.id = " . $params["troubleshoot_request_id"];
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			$str = '{"id":"'.$res->id.'",';
				$str.= '"name":"'.$res->name.'",';
				$str.= '"macaddress":"",';
			$str.= '"devicetype":"'.$res->devicetype.'",';
			$str.= '"amount":"'.$res->amount.'",';
			$str.= '"updateuser":"'.$res->updateuser.'",';
			$str.= '"password":"",';
			$str.= '"location":"'.$res->location.'",';
			$str.= '"barcode":"'.$res->barcode.'",';
			$str.= '"serialno":"'.$res->serialno.'",';
			$str.= '"security_key":""}';
			array_push($arr,$str);
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}			
	function reportimages(){
		$params = $this->input->post();
		$sql = "select id,name,description,img from troubleshoot_images ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","name":"'.$res->name.'","description":"'.$res->description.'","img":"'.$res->img.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}
	function reportmaterials(){
		$params = $this->input->post();
		$sql = "select id,tipe,name,description from troubleshoot_materials ";
		$sql.= "where troubleshoot_request_id=".$params["troubleshoot_request_id"];
		$que = $this->db->query($sql);
		$row = $que->result();
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","name":"'.$res->name.'","tipe":"'.$res->tipe.'","description":"'.$res->description.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;		
	}
	function request(){
		$this->data['menuFeed'] = 'troubleshoot';
		$this->data['objs'] = $this->client_site->populate();
		$this->data['return_page']='Sales/troubleshoot_add/';
		$this->load->view('Sales/add_troubleshoot_lookup',$this->data);
	}
	function savefu(){
		$params = $this->input->post();
		echo $this->ptroubleshoot->fusave($params);
	}
	function savefuimage(){
		$params = $this->input->post();
		//echo json_encode($params);
		echo $this->ptroubleshoot->fuimgsave($params);
	}
	function getfus(){
		$id = $this->uri->segment(3);
		echo json_encode($this->ptroubleshoot->getfus($id));
	}
	function getfuimages(){
		$id = $this->uri->segment(3);
		echo json_encode($this->ptroubleshoot->getfuimages($id));
	}
	function removefuimage(){
		$id = $this->uri->segment(3);
		echo json_encode($this->ptroubleshoot->removefuimage($id));
	}
	function saverouter(){
		$params = $this->input->post();
		$obj = new site_router();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function troubleshootadd(){
		$params = $this->input->post();
		echo $this->troubleshoot_request->add($params);
	}
	function troubleshootedit(){
		$params = $this->input->post();
		echo $this->troubleshoot_request->edit($params);
	}
	function add(){
		$this->check_login();
		$ticketid = $this->uri->segment(3);
		$this->data['ticketid'] = $ticketid;
		$this->data['menuFeed'] = 'troubleshoot';
		$this->data['obj']=ticket_getticket($ticketid);
		$this->data['clients']=$this->client->get_combo_data();
		$this->data['sender']='troubleshoot_add';
		$this->data['services'] = $this->service->get_combo_data();
		$this->data['routers'] = array();
		$this->data['hours'] = $this->common->gethours();
		$this->data['minutes'] = $this->common->getminutes();
		$this->load->view('TS/troubleshoots/add',$this->data);
	}
	function removefu(){
		$id = $this->uri->segment(3);
		$this->load->model('ptroubleshoot');
		echo $this->ptroubleshoot->removefu($id);
	}
	function removerouter(){
		$params = array('status'=>'1','ioflag'=>'2');
		$obj = new Troubleshoot_router();
		foreach($params as $key=>$val){
			$obj->key = $val;
		}
		$obj->save();
		echo $params['status'] . ' an ' . $params['ioflag'];
	}
	function save(){
		$params = $this->input->post();
		echo $this->ptroubleshoot->save($params);
		//echo $this->troubleshoot_request->add($params);
	}
	function saveDevice(){
		$params = $this->input->post();
		$className = $params['className'];
		unset ($params['className']);
		$obj = new $className();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function save_material(){
		$params = $this->input->post();
		echo $this->troubleshoot_material->insert($params);
	}
	function save_router(){
		$params = $this->input->post();
		echo $this->troubleshoot_router->insert($params);
	}
	function save_pccard(){
		$params = $this->input->post();
		echo $this->troubleshoot_pccard->insert($params);
	}
	function save_apwifi(){
		$params = $this->input->post();
		echo $this->troubleshoot_apwifi->insert($params);
	}
	function save_implementer(){
		$params = $this->input->post();
		echo $this->troubleshoot_implementer->insert($params);
	}
	function save_switch(){
		$params = $this->input->post();
		echo $this->troubleshoot_switch->insert($params);
	}
	function save_device(){
		$params = $this->input->post();
		echo $this->troubleshoot_device->insert($params);
	}
	function save_image(){
		$params = $this->input->post();
		$obj = new Troubleshoot_image();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function removeimage(){
		$params = $this->input->post();
		$obj = new Troubleshoot_image();
		$obj->where('id',$params['id'])->get();
		$obj->delete();
		echo $obj->check_last_query();
	}
	function update_image(){
		$params = $this->input->post();
		$obj = new Troubleshoot_image();
		$obj->where('id',$params['id'])->update($params);
		echo $obj->check_last_query();
	}
	function troubleshootdeviceadd(){
		$params = $this->input->post();
		echo $this->troubleshootdevice->add($params);
	}
	function troublesiteadd(){
		$params = $this->input->post();
		echo $this->troubleshootsite->add($params);
	}
	function troubleshoot_site(){
		$this->check_login();
		$id = $this->uri->segment(3);
		$path = array(
			'csspath' => '/css/aquarius/',
			'jspath' => '/js/aquarius/',
			'imagepath' => '/img/aquarius/',
			'user'=>$this->user->get_user_by_id($this->user->id)
			);
		$data = array(
			'aps'=>$this->pap->get_combo_data(),
			'obj'=>$this->troubleshootsite->get_obj_by_id($id),
			'btstowers'=>$this->pbtstower->get_combo_data(),
			'clients'=>$this->client->get_combo_data(),
			'devicetypes'=>$this->devicetype->get_combo_data(),
			'devices'=>$this->device->get_combo_data(),
			'path'=>$path,
			'sender'=>'troubleshoot_edit',
		);
		$data = array_merge($data,$this->data);
		$this->load->view('Sales/troubleshoot_site',$data);
	}
	function troubleshootremovesite(){
		$params = $this->input->post();
		echo $this->troubleshootsite->remove($params['id']);
	}
	function result(){
		$uri = $this->uri->segment(3);
		$this->data['obj']=$this->troubleshoot_request->get_obj_by_id($this->uri->segment(3));
		$this->data['services'] = $this->service->get_combo_data();
		$this->load->view('TS/troubleshoots/result',$this->data);
	}
	function getTicketInfo(){
		$params = $this->input->post();
		$obj = new Ticket();
		$obj->where('id',$params['id'])->get();
		echo '{"client_id":"' . $obj->client_id . '","requesttype":"' . $obj->requesttype . '","clientname":"' . $obj->clientname . '"}';
	}
	function getTroubleshootInfo(){
		$params = $this->input->post();
		$obj = new Troubleshoot();
		$obj->where('id',$params['id'])->get();
		echo '{"client_id":"' . $obj->client_id . '","requesttype":"' . $obj->requesttype . '","clientname":"' . $obj->clientname . '"}';
	}
	function update(){
		$params = $this->input->post();
		echo $this->troubleshoot_request->edit($params);
	}
	function used_device(){
		$request_id = $this->uri->segment(3);
		$objs = $this->troubleshoot_router->populate($request_id,'1');
		$this->data['objs'] = $objs;
		$this->data['title'] = 'Perangkat yang terpakai';
		$this->load->view('TS/troubleshoots/used_device',$this->data);
	}
	function withdrawed_device(){
		$request_id = $this->uri->segment(3);
		$objs = $this->troubleshoot_router->populate($request_id,'0');
		$this->data['objs'] = $objs;
		$this->data['title'] = 'Perangkat yang ditarik';
		$this->load->view('TS/troubleshoots/used_device',$this->data);
	}
	function imageedit(){
		$obj = new Troubleshoot_image();
		$obj->where('id',$this->uri->segment(3))->get();
		$data = array(
			'obj'=>$obj,
			'saveurl'=>'/troubleshoot_images/update'
			);
		$this->load->view('imageeditor/index2',$data);
	}
}

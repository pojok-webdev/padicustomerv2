<?php
class Install_requests extends CI_Controller {
	var $setting;
	var $preference;
	var $user_info;
	var $alertcount;
	var $mpath;
	var $data;
	var $ionuser;
	function __construct(){
		parent::__construct();
		$this->common->get_preferences();
		$this->setting = $this->common->get_web_settings();
		$this->lang->load('padi',$this->setting['language']);
		$this->load->helper('user');
		$this->load->helper('install');
		$this->load->model('pclient_vas');
		$this->load->model('pinstall_request');
		if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
		}
	}
	function add_lookup(){
		$this->check_login();
		$arr = array();
		$users = getsubordinates($this->ionuser->id,$arr);
		
		$this->data['objs']=$this->survey_request->install_lookup($users);
		$this->data['return_page']='adm/install_add/';
		$this->data['menuFeed']='install';
		$this->load->view('Sales/installs/add_install_lookup',$this->data);
	}
	function edit(){
		$this->check_login();
		$pi = new Pinstall_request();
		$client = $pi->get_client_by_install_site($this->uri->segment(3));
		$client_id = $client->client_id;
		$getvases = $pi->getvases($client_id);
		$client = new Client();
		$device = new Device();
		$pbtstower = new Pbtstower();
		$service = new Service();
		$material = new Material();
		$materialtype = new Materialtype();
		$user = new User();
		$vas = new Vas();
		$this->data['obj']=$pi->get_obj_by_id($this->uri->segment(3));
		$this->data['clients']=$client->get_combo_data();
		$this->data['officers']=$user->get_user_by_group('TS');
		$this->data['apwifis']=$device->get_combo_data(13);
		$this->data['pccards']=$device->get_combo_data(2);
		$this->data['antennas']=$device->get_combo_data(8);
		$this->data['routers']=$device->get_combo_data(14);
		$this->data['btstowers']=$pbtstower->get_combo_data();
		$this->data['clients']=$client->get_combo_data();
		$this->data['hours'] = $this->common->gethours();
		$this->data['minutes'] = $this->common->getminutes();
		$this->data['devices']=$device->get_combo_data();
		$this->data['materials']=$material->get_combo_data();
		$this->data['materialtypes']=$materialtype->get_combo_data();
		$this->data['services'] = $service->get_combo_data();
		$this->data['totalvas'] = $getvases['total'];
		$this->data['client_vases'] = $getvases['records'];
		$this->data['vases'] = $vas->get_combo_data();
		$this->data['sender']='install_edit';
		$this->data['menuFeed']='install';
		$this->data['categories'] = $this->pclient->getcategories();
		switch ($this->session->userdata["role"]) {
			case "CRO":
					redirect("install_requests/showreport2/".$this->uri->segment(3));
				break;
			default:
				$this->load->view('Sales/installs/edit',$this->data);
			break;
		}
	}
	function feedData(){
		$objs = $this->install_site->populate();
		$rows = array();
		foreach($objs as $obj){
			$vals = array();
			array_push($vals,'"execdate":"'.$this->common->longsqldt_to_human_date($obj->install_date).'"');
			$val = '{"'.$obj->id.'":{' . implode(",",$vals) . '}}';
			array_push($rows,$val);
		}
		echo '['.implode(",",$rows).']';
	}
	function index(){
		$this->check_login();
		$filter = $this->uri->segment(3);
		$this->data['menuFeed']='install';
		switch($filter){
			case '0':
			$this->data['install_status']=' (Belum dilaksanakan)';
			break;
			case '1':
			$this->data['install_status']=' (Sudah dilaksanakan)';
			break;
			case 'all':
			$this->data['install_status']=' (Semua)';
			break;
		}
		switch($this->session->userdata["role"]){
			case "TS":
			$this->data['objs']=ts_get_installsite();
			$this->load->view('TS/installs/index',$this->data);
			break;
			case "Sales":
			$this->data['objs']=sales_get_installsite();
			$this->load->view('Sales/installs/index',$this->data);
			break;
			case "CRO":
			$this->data['objs']=sales_get_installsite();
			$this->load->view('Sales/installs/index',$this->data);
			break;
		}
	}
	function entry_install_request(){
		$this->common->check_authentication();
		$uri 	= $this->uri->uri_to_assoc();
		$survey = (isset($uri['survey_id']))?$this->survey_request->extract_fields($uri['survey_id']):$this->survey_request->extract_fields(null);
		$data 	= array(
			'view_data'		=>'entry_install_request',
			'alertcount'	=>$this->common->check_messages(),
			'clients'		=>$this->pclient->get_combo_data(),
			'services'		=>$this->service->get_combo_data(),
			'install_date'	=>mdate('%d/%m/%Y',now()),
			'hour' 			=> '08',
			'minute' 			=> '00',
			'sites'			=>array(),
			'trial_periode1'=>mdate('%d/%m/%Y',now()),'trial_periode2'=>mdate('%d/%m/%Y',now()),
			'ts_date'		=>(isset($uri['msg_id']) && trim($this->internal_message->get_date($uri['msg_id']))!='-')?
				'<label class="alert">Proposed by TS : ' . $this->internal_message->get_date($uri['msg_id']):''
		);
		switch($uri['type']){
			case 'add':
				$data['survey_id'] 			= $survey['survey_id'];
				$data['id'] 				= '';
				$data['permit'] 			= '0';
				$data['trial_permanent'] 	= FALSE;
				$data['client'] 			= $survey['client_id'];
				$data['service'] 			= $survey['service_id'];
				$data['pic_name'] 			= $survey['pic_name'];
				$data['pic_position'] 		= $survey['pic_position'];
				$data['pic_phone'] 			= $survey['pic_phone'];
				$data['sites'] 				= $this->survey_site->get_survey_sites($survey['survey_id']);
				$data['type'] 				= 'add';
				$data['active'] 			= TRUE;
				break;
			case 'edit':
				$request 					= new Install_request();
				$request->where('id',$uri['id'])->get();
				$datetime = $this->common->longsql_to_datepart($request->install_date);;
				$data['id'] 				= $request->id;
				$data['trial_permanent'] 	= ($request->trial_permanent==0)?FALSE:TRUE;
				$data['survey_id'] 			= $request->survey_request_id;
				$data['client'] 			= $request->client_id;
				$data['install_date'] 		= $this->common->longsql_to_human_date($request->install_date);
				$data['hour'] 				= $datetime['hour'];
				$data['minute'] 			= $datetime['minute'];
				$data['service'] 			= $request->service_id;
				$data['permit'] 			= $request->permit;
				$data['pic_name'] 			= $request->pic_name;
				$data['pic_phone'] 			= $request->pic_phone;
				$data['pic_position'] 		= $request->pic_position;
				$data['sites'] 				= $this->survey_site->get_survey_sites($uri['id']);
				$data['type'] 				= 'edit';
				$data['sites'] 				= $this->survey_site->get_survey_sites($request->survey_request_id);
				break;
		}
		$this->load->view('common/backendindex',$data);
	}
	function entry_install_request_handler(){
		$this->common->check_authentication();
		$params = $this->input->post();
		if(isset($params['save_x'])){
			$active = (isset($params['active']))?'1':'0';
			$install = new Install_request();
			$internalmsg = array(
				'message_type'		=> 'install_request',
				'obj_id'			=> $params['id'],
				'recipient'			=> 0,
				'recipient_group'	=> 3,
				'content'			=> 'edit instalasi',
				'proposed_date1'	=> null,
				'proposed_date2'	=> null,
				'followuplink'		=> 'install_requests/ts_entry_install_request'
			);
			switch ($params['type']){
				case 'add':
					$this->access_log->insert_log('Entry install request (ID : ' . $params['id'] . ')');
					$id = $this->install_request->request_save($params);
					$internalmsg['obj_id'] = $id;
					$this->common->send_internal_message($internalmsg);
					break;
				case 'edit':
					$this->access_log->insert_log('Edit install request (ID : ' . $params['id'] . ')');
					$params['id'] = $params['id'];
					$this->install_request->request_update($params);
					$this->common->send_internal_message($internalmsg);
					break;
			}
		}
		redirect($this->mpath . 'show_install_requests/page');
	}
	function entry_router(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$data = array('view_data'=>'entry_router','install_id'=>$uri['install_id']);
		$this->load->view('common/backendindex',$data);
	}
	function entry_installer(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$data = array(
			'install_id'=>$uri['install_id'],
			'view_data'=>'entry_installer',
			'installers'=>$this->user->get_combo_data_by_group('TS'),'installer'=>0,
		);
		$this->load->view('common/backendindex',$data);
	}
	function check_login(){
		if(!$this->ion_auth->logged_in()){
			redirect(base_url() . 'index.php/adm/login');
		}
	}
	function entry_ap_wifi(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$data = array('install_id'=>$uri['install_id'],
		'view_data'=>'entry_ap_wifi','ap_wifis'=>$this->install_request->get_ap_wifis($uri['install_id']),
		);
		$this->load->view('common/backendindex',$data);
	}
	function entry_image(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$data = array(
			'install_id'=>$uri['install_id'],
			'view_data'=>'entry_install_image',
			'id'=>($uri['type']=='edit')?$uri['id']:'',
			'name'=>(isset($uri['name']))?$uri['name']:'',
			'type'=>$uri['type'],
		);
		switch ($uri['type']){
			case 'edit':
				$image = $this->install_image->get_by_id($uri['id']);
				$data['name'] = (isset($uri['name']))?$uri['name']:$image->name;
				$data['description'] = $image->description;
				break;
			case 'add':
				$data['name'] = '';
				$data['description'] = '';
				break;
		}
		$this->load->view('common/backendindex',$data);
	}
	function entry_file(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$data = array(
			'install_id'=>$uri['install_id'],
			'view_data'=>'entry_install_image',
			'id'=>($uri['type']=='edit')?$uri['id']:'',
			'name'=>(isset($uri['name']))?$uri['name']:'',
			'type'=>$uri['type'],
		);
		switch ($uri['type']){
			case 'edit':
				$image = $this->install_image->get_by_id($uri['id']);
				$data['name'] = (isset($uri['name']))?$uri['name']:$image->name;
				$data['description'] = $image->description;
				break;
			case 'add':
				$data['name'] = '';
				$data['description'] = '';
				break;
		}
		$this->load->view('common/backendindex',$data);
	}
	function getRecordOver(){
		$objs = new Install_request();
		$objs->where("id >",$this->uri->segment(3))->get();
		$rows = array();
		foreach($objs as $obj){
			$vals = array();
			foreach($this->db->list_fields("install_requests") as $field){
				array_push($vals,'"'.$field.'":"'.$obj->$field.'"');
			}
			array_push($vals,'"name":"'.$obj->client_site->client->name.'"');
			array_push($vals,'"installresult":"Belum ada kesimpulan"');
			$val = '{"'.$obj->id.'":{' . implode(",",$vals) . '}}';
			array_push($rows,$val);
		}
		echo '['.implode(",",$rows).']';
	}
	function getvas(){
		$params = $this->input->post();
		$obj = $this->pclient_vas->vasget($params['client_id'],$params['vas_id']);
		echo '{"name":"'.$obj->name.'"}';
	}
	function getTrial(){
		$params = $this->input->post();
		$obj = new Install_request();
		$obj->where('id',$params['id'])->get();
		echo '{"id":"'.$obj->id.'","client_site_id":"'.$obj->client_site_id.'","client":"'.$obj->client_site->client->name.'","startdate":"'.$this->common->sql_to_human_datetime($obj->trial_periode1).'","enddate":"'.$this->common->sql_to_human_datetime($obj->trial_periode2).'","startexecdate":"'.$this->common->sql_to_human_datetime($obj->trial_periode1exec).'","endexecdate":"'.$this->common->sql_to_human_datetime($obj->trial_periode2exec).'"}';
	}	
	function install_edit(){
		$sessdata = array("pending_url"=>"/install_requests/install_edit/".$this->uri->segment(3));
		$this->session->set_userdata($sessdata);
		$this->check_login();
		$vas = new Vas();
		$id = $this->uri->segment(3);
		$port = array();
		for($i=1;$i<25;$i++){
			$port[$i]=$i;
		}
		$pi = new Pinstall_request();
		$obj = $pi->get_obj_by_id($this->uri->segment(3));
		$client = $pi->get_client_by_install_site($this->uri->segment(3));
		$client_id = $client->client_id;
		if(!$client_id){
			echo "Pelanggan tidak ditemukan";
		}else{
			$getvases = $pi->getvases($client_id);
			$this->data['switches']=$this->pdevice->get_combo_data(array(15));
			$this->data['ports']=$port;
			$this->data['hours']=$this->common->gethours();
			$this->data['minutes']=$this->common->getminutes();
			$this->data['aps']=$this->pap->get_combo_data();
			$this->data['antennas']=$this->pdevice->get_combo_data(array(8,20,4,7,3,6,5));
			$this->data['btstowers']=$this->pbtstower->get_combo_data();
			$this->data['devices']=$this->pdevice->get_combo_data();
			$this->data['materials']=$this->material->get_combo_data();
			$this->data['materialtypes']=$this->materialtype->get_combo_data();
			$this->data['pccards']=$this->pdevice->get_combo_data(array(2));
			$this->data['boards']=$this->pdevice->get_combo_data(array(1));
			$this->data['routers']=$this->pdevice->get_combo_data(array(14));
			$this->data['switches']=$this->pdevice->get_combo_data(array(15));
			$this->data['routersboards']=$this->pdevice->get_combo_data(array(1,14));
			$this->data['apwifis']=$this->pdevice->get_combo_data(array(13));
			$this->data['sender']='install_edit';
			$this->data['officers']=$this->user->get_user_by_group('TS');
			$this->data['services']=$this->service->get_combo_data();
			$this->data['branches']=$this->branch->get_combo_data();
			$this->data['obj']=$obj;
			$this->data['clients']=$this->pclient->get_combo_data();
			$this->data['sender']='install_edit';
			$this->data['menuFeed']='install';
			$this->data['install_routers'] = $pi->getrouters($this->uri->segment(3));
			$this->data['install_apwifis'] = $pi->getinstallapwifis($this->uri->segment(3));
			$this->data['install_images'] = $pi->getimages($this->uri->segment(3));
			$this->data['install_materials'] = $pi->getmaterials($this->uri->segment(3));
			$this->data['install_resumes'] = $pi->getresumes($this->uri->segment(3));
			$this->data['install_wireless_radios'] = $pi->getwirelessradios($this->uri->segment(3));
			$this->data['install_switches'] = $pi->getswitches($this->uri->segment(3));
			$this->data['install_pccards'] = $pi->getpccards($this->uri->segment(3));
			$this->data['install_antennas'] = $pi->getantennas($this->uri->segment(3));
			$this->data['install_bas'] = $pi->getbas($this->uri->segment(3));
			$this->data['install_installers'] = $pi->getinstallers($this->uri->segment(3));
			$this->data['vases'] = $vas->get_combo_data();
			$this->data['client_vases'] = $getvases['records'];
			$this->data['totalvas'] = $getvases['total'];
			$this->data['vsds'] = $this->pinstall_request->getvsds($this->uri->segment(3));
			$this->data['categories'] = $this->pclient->getcategories();
			$qii = "select a.id,a.img,a.title,a.path,a.description from install_images a where a.install_site_id=".$id. " ";
			$qii.= "order by roworder asc ";
			$res = $this->db->query($qii);
			$myuser = $this->ion_auth->user()->row();
			$myuser->id;
			switch($this->session->userdata["role"]){
				case "TS":
				$this->load->view('TS/installs/edit',$this->data);
				break;
				case "Sales":
					if($this->common->is_decessor($obj->sale_id,$myuser->id)||($obj->sale_id===$myuser->id)){
						$this->load->view('Sales/installs/edit',$this->data);
					}else{
						echo "Anda harus memiliki privilege untuk dapat mengedit / melihat halaman ini ..";
					}
					break;

				break;
				case "CRO":
					$this->load->view('CRO/installs/edit',$this->data);
				break;
			}
		}
	}
	function getvsds(){
		$id = $this->uri->segment(3);
		$vsds = $this->pinstall_request->getvsds($id);
		//print_r($vsds);
		//echo '<br />';
		$arr = array();
		foreach($vsds as $vsd){
			array_push($arr,substr($vsd,28,strlen($vsd)-28));
		}
		echo json_encode($arr);
	}
	function downloadtopologivsd(){
		$fileparam = $this->uri->segment(3);
		print_r($fileparam);
		$id = substr($this->uri->segment(3),0,strlen($this->uri->segment(3) - 3));
		$client = $this->pinstall_request->get_client_by_install_site($id);
		if($client!=false){
			$name = $client->name;
		}else{
			$name = $id;
		}
		$data = file_get_contents('./padiapp-data/installs/vsd/'.$fileparam);
		force_download('Topologi '.$name.'.vsd',$data,'uuu');
	}
	function preview(){
		$vas = new Vas();
		$this->check_login();
		$pi = new Pinstall_request();
		$client_id = $pi->get_client_by_survey_request($this->uri->segment(3));
		$getvases = $pi->getvases($client_id);
		$this->data['obj']=$this->survey_request->get_obj_by_id($this->uri->segment(3));
		$this->data['clients']=$this->pclient->get_combo_data();
		$this->data['officers']=$this->user->get_user_by_group('TS');
		$this->data['apwifis']=$this->pdevice->get_combo_data(array(13));
		$this->data['pccards']=$this->pdevice->get_combo_data(array(2));
		$this->data['antennas']=$this->pdevice->get_combo_data(array(8));
		$this->data['routers']=$this->pdevice->get_combo_data(array(14));
		$this->data['btstowers']=$this->pbtstower->get_combo_data();
		$this->data['hours'] = $this->common->gethours();
		$this->data['minutes'] = $this->common->getminutes();
		$this->data['devices']=$this->pdevice->get_combo_data();
		$this->data['materials']=$this->material->get_combo_data();
		$this->data['materialtypes']=$this->materialtype->get_combo_data();
		$this->data['services'] = $this->service->get_combo_data();
		$this->data['sender']='install_edit';
		$this->data['menuFeed']='install';
		$this->data['vases'] = $vas->get_combo_data();
		$this->data['client_vases'] = $getvases['records'];
		$this->data['totalvas'] = $getvases['total'];
		$this->data['categories'] = $this->pclient->getcategories();
		$this->load->view('Sales/installs/preview',$this->data);
	}
	function saveinstalldescription(){
		$params = $this->input->post();
		echo $this->pinstall_request->saveinstallsitedescription($params);
	}
	function saveinstallsitedescription(){
		$params = $this->input->post();
		echo $this->pinstall_request->saveinstalldescription($params);
	}
	function removevas(){
		$params = $this->input->post();
		$pr = new Pinstall_request();
		echo $pr->updatevas($params);
	}
	function bapreview(){
		$id = $this->uri->segment(3);
		$sql = "select id,name,description,img,install_site_id from install_bas where id = " . $id;
		$query = $this->db->query($sql);
		$result = $query->result();
		$this->data['menuFeed']='install';
		$this->data['obj']=$result[0];
		$this->load->view('TS/installs/gallery',$this->data);
	}
	function save(){
		$params = $this->input->post();
		$obj = new Install_request();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function savevas(){
		$params = $this->input->post();
		$params["createuser"] = $this->session->userdata("username");
		$this->load->model("pinstall_request");
		$ir = new Pinstall_request();
		echo $ir->savevas($params);
	}
	function show_install_requests(){
		$this->common->check_authentication();
		$install_request = new Install_request();
		$this->common->show_object($install_request, 'install_requests', 'install_requests','client_id');
	}
	function show_ts_install_requests(){
		$this->common->check_authentication();
		$obj = new Install_request();
		$this->common->show_object($obj, 'ts_install_requests','install_requests','client_id');
	}
	function showreport(){
		$this->load->helper('install');
		$install_site_id = $this->uri->segment(3);
		$client = $this->pinstall_request->get_client_by_install_site($install_site_id);
		$operators = $this->pinstall_request->get_operators($install_site_id);
		$routers = $this->pinstall_request->getrouters($install_site_id);
		$pccards = $this->pinstall_request->getpccards($install_site_id);
		$apwifis = $this->pinstall_request->getinstallapwifis($install_site_id);
		$wirelessradios = $this->pinstall_request->getwirelessradios($install_site_id);
		$antennas = $this->pinstall_request->getantennas($install_site_id);
		$imgtj = $this->pinstall_request->getimages($install_site_id,'Topologi Jaringan');
		$imgka = $this->pinstall_request->getimages($install_site_id,'Konfigurasi AP');
		$imgwr = $this->pinstall_request->getimages($install_site_id,'Konfigurasi Wireless Radio');
		$imgdok = $this->pinstall_request->getimages($install_site_id,'Dokumentasi Foto');
		$sr = $this->pinstall_request->getresumes($install_site_id);
		$imgst = $this->pinstall_request->getimages($install_site_id,'Speed Test');
		$materials = $this->pinstall_request->getmaterials($install_site_id);
		$bas = $this->pinstall_request->getbas($install_site_id);
		$oprarr = array();
		foreach($operators as $operator){
			array_push($oprarr,$operator->name);
		}
		$opr = implode(",",$oprarr);
		$client_vases=$this->pinstall_request->getvases($client->client_id);
		$topologivsdfiles = gettopologivsdfiles($install_site_id);
		$data = array(
			'topologivsdfiles'=>$topologivsdfiles,
			'objs'=>$client,
			'opr'=>$opr,'routers'=>$routers["res"],'pccards'=>$pccards["res"],'apwifis'=>$apwifis['res'],
			'wirelessradios'=>$wirelessradios["res"],"antennas"=>$antennas['res'],
			"imgdok"=>$imgdok['res'],"imgtj"=>$imgtj["res"],"imgka"=>$imgka['res'],"imgst"=>$imgst['res'],"sr"=>$sr['res'],
			"client_vases"=>$client_vases["records"],"imgwr"=>$imgwr["res"],'materials'=>$materials['res'],
			'bas'=>$bas['res']
		);
		$this->load->view("Sales/installs/reports/installbyclient",$data);
	}
	function getfiles(){
		$install_site_id = $this->uri->segment(3);
		$out = gettopologivsdfiles($install_site_id);
		echo count($out);
	}
	function showreport2(){
		$installsiteid = $this->uri->segment(3);
		$query = "select c.name,concat(day(a.install_date),'-',month(a.install_date),'-',year(a.install_date)) ins_date,b.address,case a.status when '0' then 'belum selesai' when '1' then 'selesai' else 'belum selesai' end installstatus,a.resume,d.srv,e.xcutor,f.pic,g.tipe iwtipe,g.macboard iwmacboard,g.ip_ap iwip_ap,g.essid iwessid,g.ip_ethernet iwip_ethernet,g.freqwency iwfreqwency,g.polarization iwpolarization,g.signal iwsignal,g.quality iwquality,g.throughput_udp iwthroughput_udp,g.throughput_tcp iwthroughput_tcp,g.user iwuser,g.password iwpassword from install_sites a ";
		$query.= "left outer join client_sites b on b.id=a.client_site_id ";
		$query.= "left outer join clients c on c.id=b.client_id ";
		$query.= "left outer join (select client_site_id,group_concat(name) srv from clientservices group by client_site_id) d on d.client_site_id=b.id ";
		$query.= "left outer join (select install_site_id,group_concat(name)xcutor from install_installers group by install_site_id) e on e.install_site_id=a.id ";
		$query.= "left outer join (select client_id,group_concat(name)pic from pics group by client_id) f on f.client_id=c.id ";
		$query.= "left outer join install_wireless_radios g on a.id=g.install_site_id ";
		$query.= "left outer join install_resumes h on h.install_site_id=a.id ";
		$query.= " where a.id=".$installsiteid;
		$res = $this->db->query($query);
		$obj = $res->result()[0];

		$query = "select a.* from install_resumes a left outer join install_sites b on b.id=a.install_site_id where  b.id=".$installsiteid;
		$res = $this->db->query($query);
		$sr = $res->result();

		$qii = "select a.id,a.img,a.title,a.description from install_images a where a.install_site_id=".$installsiteid. " ";
		$qii.= "order by roworder asc ";
		$res = $this->db->query($qii);
		$ii = $res->result();
		$material = $this->pinstall_request->getmaterials($installsiteid);
		$bas = $this->pinstall_request->getbas($installsiteid);
		$topologivsdfiles = gettopologivsdfiles($installsiteid);
		$data = array(
			'topologivsdfiles'=>$topologivsdfiles,
			'obj'=>$obj,
			'install_images'=>$ii,
			'sr'=>$sr,
			'materials'=>$material['res'],
			'bas'=>$bas['res']
		);
		$this->load->view("reports/installreport",$data);
	}
	function ts_entry_install_request(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$obj = new Install_request();
		$obj->where('id',$uri['id'])->get();
		$datetime = $this->common->longsql_to_datepart($obj->install_date);
		$ts = $this->install_installer->get_ts_aray_by_installer_id($uri['id']);
		$install_date = $obj->install_date;
		$date_part = $this->common->longsql_to_datepart($install_date);
		$data['alertcount'] 	= $this->common->check_messages();
		$data['view_data']	='entry_ts_install_request';
		$data['id'] 			= $obj->id;
		$data['client'] 		= $obj->client->name;
		$data['service'] 		= $obj->service->name;
		$data['install_date'] 	= $date_part['day'] . '/' . $date_part['month'] . '/' . $date_part['year'];
		$data['hour']			= $datetime['hour'];
		$data['minute']			= $datetime['minute'];
		$data['type'] 			= 'edit';
		$data['pic_name'] 		= $obj->pic_name;
		$data['pic_position'] 	= $obj->pic_position;
		$data['pic_phone'] 		= $obj->pic_phone;
		$data['trial_periode'] 	= $obj->trial_periode1 . '-' . $obj->trial_periode2;
		$data['permit'] 		= ($obj->permit=='1')?'Perlu surat ijin':'-';
		$data['tses']			= $this->install_installer->get_tses_by_install_request($uri['id']);
		$data['ts']				= $this->user->get_combo_data_by_group('TS','Pilih TS');
		$data['permanen_trial']	= $obj->trial_permanen;
		$data['wireless_radios'] = $this->install_wireless_radio->get_wireless_radios($uri['id']);
		$data['ap_wifis'] 		= $this->install_request->get_ap_wifis($uri['id']);
		$data['routers'] 		= $this->install_router->get_routers($uri['id']);
		$data['images'] 		= $this->install_image->get_images();
		$data['mrtg'] 			= ($obj->create_mrtg=='1')?TRUE:FALSE;
		$data['whatsup'] 		= ($obj->create_whatsup=='1')?TRUE:FALSE;
		$data['shapper'] 		= ($obj->create_shapper=='1')?TRUE:FALSE;
		$data['ba_aktivasi']	= $this->install_file->get_files_by_ftype($uri['id'],'ba_aktivasi');
		$data['ba_instalasi']	= $this->install_file->get_files_by_ftype($uri['id'],'ba_instalasi');
		$data['serah_terima']	= $this->install_file->get_files_by_ftype($uri['id'],'ba_serah_terima');
		$data['form_kepuasan']	= $this->install_file->get_files_by_ftype($uri['id'],'form_kepuasan');
		$this->load->view('common/backendindex',$data);
	}
	function updatevas(){
		$client_id = $this->uri->segment(3);
		$vas_id = $this->uri->segment(4);
		$vas_id2 = $this->uri->segment(5);
		echo $this->pclient_vas->update($client_id,$vas_id,$vas_id2);
	}
	function updatevasimplemented(){
		$params = $this->input->post();
		echo $this->pclient_vas->updateimplemented($params['client_id'],$params['vas_id'],$params['implemented']);
	}
	function upload_file(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		switch ($uri['type']){
			case 'add':
				$id = 'none';
				$install_id = $uri['install_id'];
				break;
			case 'edit':
				$id = ($uri['id']=='')?'none':$uri['id'];
				$install_id = $uri['install_id'];
				break;

		}
		$data = array(
			'install_id'=>$install_id,
			'id'=>$id,'ftype'=>$uri['ftype'],
			'view_data'=>'upload_file',
			'images'=>get_filenames('./media/installs'),
		);
		$this->load->view('common/backendindex',$data);
	}
	function upload_image(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		switch ($uri['type']){
			case 'add':
				$id = 'none';
				$install_id = $uri['install_id'];
				break;
			case 'edit':
				$id = ($uri['id']=='')?'none':$uri['id'];
				$install_id = $uri['install_id'];
				break;

		}
		$data = array(
			'install_id'=>$install_id,
			'id'=>$id,
			'view_data'=>'upload_image',
			'images'=>get_filenames('./media/installs'),
		);
		$this->load->view('common/backendindex',$data);
	}
	function use_image(){
		$uri = $this->uri->uri_to_assoc();
		$this->install_image->insert_image($uri['install_id'],$uri['image']);
		redirect($this->mpath . 'ts_entry_install_request/id/' . $uri['install_id']);
	}
	function update(){
		$params = $this->input->post();
		echo $this->install_request->edit($params);
	}
	function reportjson(){
		$tmp = array();
		$obj = new Install_site();
		$obj->where('id',1)->get();
		$datapelaksanaan = '"Data Pelaksanaan":{"tgl":{"field":"Tanggal","content":": '.$obj->install_date.'","type":"text"},"pelaksana":{"field":"Pelaksana","content":": '.$obj->install_installer->name.'","type":"text"}}';
		$datapelanggan = '"Data Pelanggan":{"plg":{"field":"Nama","content":": '.$obj->client_site->client->name.'","type":"text"},"addr":{"field":"Alamat","content":": '.$obj->client_site->client->address.'","type":"text"}}';
		$dataperangkat = '"Data Perangkat":{"perangkat":{"field":"Nama Perangkat","content":": Mikrotik RB411L + Grid 27 dbm","type":"text"},"board":{"field":"Mac Board","content":": D4:CA:6D:9D:A8:84","type":"text"},"pccard":{"field":"Mac PC Card","content":": 00:80:48:69:7F:9A","type":"text"},"wlan":{"field":"IP Wlan1","content":": 117.102.226.174/30","type":"text"}}';
		$topologijaringan = '"Topologi Jaringan":{"tj":{"field":"image","content":"http://teknis/reports/images/william-konfig-ap-unifi.jpeg","type":"image","col":"left"},"tx":{"field":"image","content":"http://teknis/reports/images/william-foto1.jpeg","type":"image","col":"right"}}';
		array_push($tmp,$datapelaksanaan);
		array_push($tmp,$datapelanggan);
		array_push($tmp,$dataperangkat);
		array_push($tmp,$topologijaringan);
		$out = implode(",",$tmp);
		echo '{'.$out.'}';
	}
	function saveresume(){
		$params = $this->input->post();
		$obj = new Install_resume();
		$obj->install_site_id = $params['install_site_id'];
		$obj->name = $params['name'];
		$obj->createuser = $this->session->userdata["username"];
		$obj->save();
		echo $this->db->insert_id();
	}
	function svresume(){
		$params = $this->input->post();
		$obj = new Install_site();
		$obj->where('id',$params['install_site_id'])->update(array('resume'=>$params['resume']));
		echo $obj->check_last_query();
	}
	function removeresume(){
		$params = $this->input->post();
		$obj = new Install_resume();
		$obj->where('id',$params['id'])->get();
		$obj->delete();
		echo 'deleted '.$params['id'];
	}
	function teswt(){
		if ($this->common->grantElement("14",$executor='everyone')){
			echo "iso";
		}else{
			echo "gakl iso";
		}
	}
	function xxxx(){
		$this->common->is_decessor(14,14);
	}
	function getinstallmaterial(){
		$id = $this->uri->segment(3);
		$objs = $this->pinstall_request->getmaterial($id);
		echo json_encode($objs['res']);
	}
	function updatematerial(){
		$params = $this->input->post();
		echo $this->pinstall_request->updatematerial($params);
	}
}

<?php
class Clients extends CI_Controller{
	var $setting;
	var $alertcount;
	var $mpath;
	var $db2;
	var $ionuser;
	var $data;
	function __construct(){
		parent::__construct();
		$this->setting = $this->common->get_web_settings();
		$this->mpath = '/clients/';
		$this->lang->load('padi',$this->setting['language']);
		$this->load->helper('user');
		$this->load->helper('client');
		$this->load->helper('padi');
		if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
		}
	}
	function getvas(){
		$this->load->model('pclient');
		echo json_encode($this->pclient->getvas($this->uri->segment(3)));
	}
	function activate(){
		$id = $this->uri->segment(3);
		$query = "select b.id clientid,a.id clientsiteid,b.name,a.address,c.username from client_sites a ";
		$query.= "left outer join clients b on b.id=a.client_id ";
		$query.= "left outer join users c on c.id=b.user_id ";
		$query.= "where a.id = ".$id." ";
		$result = $this->db->query($query);
		$this->data["obj"] = $result->result()[0];
		$this->data["hours"] = get_hours_array();
		$this->data["minutes"] = get_minutes_array();
		$this->data['menuFeed'] = 'client';
		$this->load->view("Sales/Clients/activate",$this->data);
	}
	function check_login(){
		if(!$this->ion_auth->logged_in()){
			redirect('/adm/login');
		}
	}
	function show_clients(){
		$obj = new Client();
		$this->common->show_object($obj, 'clients','clients');
	}
	function disconnect(){
		$this->data['obj'] = $this->client_site->get_obj_by_id($this->uri->segment(3));
		$this->data['speeds'] = $this->speed->get_combo_data();
		$this->data['operators'] = $this->operator->get_combo_data();
		$this->data['hours'] = $this->common->gethours();
		$this->data['minutes'] = $this->common->getminutes();
		$this->data['problems'] = $this->problem->get_combo_data();
		$this->data['durations'] = $this->duration->get_combo_data();
		$this->data['usage_periods'] = $this->usage_period->get_combo_data();
		$this->load->view('Sales/Clients/disconnection',$this->data);
	}
	function edit(){
		$this->check_login();
		$this->load->model('pclient');
		$clients = $this->client->get_obj_by_id($this->uri->segment(3));
		$this->data['business_fields'] = $this->business_field->get_combo_data("Pilihlah");
		$this->data['obj'] = $clients;
		$this->data['fbpics'] = $this->pclient->getfbpics2($this->uri->segment(3));
		$this->data['speeds'] = $this->speed->get_combo_data();
		$this->data['operators'] = $this->operator->get_combo_data();
		$this->data['services'] = $this->service->get_combo_data("Pilihlah");
		$this->data['users'] = $this->user->get_combo_data_by_group("Sales","Pilihlah");
		$this->data['problems'] = $this->problem->get_combo_data();
		$this->data['durations'] = $this->duration->get_combo_data();
		$this->data['usage_periods'] = $this->usage_period->get_combo_data();
		$this->data['menuFeed'] = 'client';
		$this->data['picroles'] = getrolescombodata();
		$this->data['branches'] = $this->branch->get_combo_data();
		$this->data['userbranches'] = getuserbranches();
		$this->data['clientcategories'] = array(
			'0'=>'Pilihlah',
			'1'=>'FFR',
			'2'=>'Platinum',
			'3'=>'Gold',
			'4'=>'Silver',
			'5'=>'Bronze',
		);
		switch($this->session->userdata["role"]){
			case 'Administrator':
				$this->load->view('adm/clients/edit',$this->data);
				break;
			case 'Umum dan Warehouse':
				break;
			case 'Sales':
				$this->load->view('Sales/Clients/edit',$this->data);
				break;
			case 'TS':
				$this->load->view('TS/clients/edit',$this->data);
				break;
			case 'Accounting':
				break;
		}
	}
	function update(){
		$params = $this->input->post();
		$client = new Client();
		echo $client->edit($params);
	}
	function entry_client(){
		$this->common->check_authentication();
		$uri = $this->uri->uri_to_assoc();
		$data = array('view_data'=>'entry_client');
		switch($uri['type']){
			case 'add':
				$data['id'] = '';
				$data['name'] = '';
				$data['address'] = '';
				$data['business_fields'] = $this->business_field->get_combo_data();
				$data['business_field'] = 0;
				$data['cities'] = $this->city->get_combo_data();
				$data['city'] = '';
				$data['phone_area'] = '';
				$data['phone'] = '';
				$data['fax_area'] = '';
				$data['fax'] = '';
				$data['description'] = '';
				$data['type'] = 'add';
				$data['active'] = TRUE;
				break;
			case 'edit':
				$client = new Client();
				$client->where('id',$uri['id'])->get();
				$data['id'] = $client->id;
				$data['name'] = $client->name;
				$data['address'] = $client->address;
				$data['business_fields'] = $this->business_field->get_combo_data();
				$data['business_field'] = $client->business_field_id;
				$data['cities'] = $this->city->get_combo_data();
				$data['city'] = $client->city;
				$data['phone_area'] = $client->phone_area;
				$data['phone'] = $client->phone;
				$data['fax_area'] = $client->fax_area;
				$data['fax'] = $client->fax;
				$data['description'] = $client->description;
				$data['type'] = 'edit';
				$data['active'] = ($client->active=='1')?TRUE:FALSE;
				break;
		}
		$this->load->view('common/backendindex',$data);
	}
	function entry_client_handler(){
		$this->common->check_authentication();
		$params = $this->input->post();
		if(isset($params['save_x'])){
			$active = (isset($params['active']))?'1':'0';
			$client = new Client();
			switch ($params['type']){
				case 'add':
					$this->access_log->insert_log('Entry property type (' . $params['name'] . ')');
					$client->name = $params['name'];
					$client->address = $params['address'];
					$client->city = $params['city'];
					$client->phone_area = $params['phone_area'];
					$client->phone = $params['phone'];
					$client->fax_area = $params['fax_area'];
					$client->fax = $params['fax'];
					$client->description = $params['description'];
					$client->active = $params['active'];
					$client->user_name = $this->session->userdata['username'];
					$client->save();
					break;
				case 'edit':
					$client->where('id',$params['id'])->update(array(
					'name'=>$params['name'],'address'=>$params['address'],'city'=>$params['city'],
					'phone_area'=>$params['phone_area'],'phone'=>$params['phone'],
					'fax'=>$params['fax'],'fax_area'=>$params['fax_area'],
					'description'=>$params['description'],
					'active'=>$params['active']
					));
					break;
			}
		}
		redirect($this->mpath . 'show_clients/page');
	}
	function client_handler(){
		$this->common->check_authentication();
		$params = $this->input->post();
		if(isset($params['btn_cari'])){
			$client_data = array('client_src'=>$params['cari']);
			$this->session->set_userdata($client_data);
			redirect($this->mpath . 'show_client/page');
		}
		if(isset($params['remove_x'])){
			if(isset($params['id'])){
				$data['view_data'] = 'confirmation';
				$items = implode(',',$params['id']);
				$data['action'] = $this->mpath . 'client_execute';
				$data['query'] = 'delete from clients where id in (' . $items . ')';
				$data['message'] = 'Apakah akan menghapus item no ' . $items . ' ?';
				$this->load->view('common/backendindex',$data);
			}
		}
	}
	function client_execute(){
		$this->execute_action('clients', $this->mpath . 'show_clients/page');
	}
	function displaceam(){
		$params = $this->input->post();
		$query = "update clients set sale_id = ". $params['sale_id'] ." where id=". $params['id'];
		$this->db->query($query);
		echo $query;
	}
	function dttblresource(){
		echo '{"aaData":'.json_encode($this->client->populate_array()).'}';
	}
	function get(){
		$arr = array();
		foreach($this->client->get_combo_data() as $key=>$val){
			array_push($arr, '"' . $key . '":"' . $val . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;
	}
	function get_combo_data_address(){
		$arr = array();
		foreach($this->client->get_combo_data_address() as $key=>$val){
			array_push($arr, '"' . $key . '":"' . $val . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;
	}
	function get_combo_data_sites(){
		$arr = array();
		$clientid = $this->uri->segment(3);
		foreach($this->client->get_combo_data_sites($clientid) as $key=>$val){
			array_push($arr, '"' . $key . '":"' . $val . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;
	}
	function get_combo_data(){
		$type = $this->uri->segment(3);
		$arr = array();
		foreach($this->client->get_combo_data('',array(9,1),array($type)) as $key=>$val){
			array_push($arr, '"' . $key . '":"' . $val . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;
	}
	function getservices(){
		$client_id = $this->uri->segment(3);
		$arr = array();
		foreach($this->service->get_combo_data() as $key=>$val){
			array_push($arr, '"' . $key . '":"' . $val . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;

	}
	function get_sites(){
		$params = $this->input->post();
		$rows = $this->pclient->get_sites($params['id']);
		$objs = $rows['res'];
		$str = '';
		$arr = array();
		foreach($objs as $obj){
			array_push($arr,'"'.$obj->id.'":{"alamat":"'.$obj->address.'","pic":"'.$obj->pic_name.'","phone":"'.$obj->pic_phone_area.'-'.$obj->pic_phone.'"}');
		}
		$arrstr = implode(',',$arr);
		echo '{'.$arrstr.'}';
	}
	function get_services(){
		$params = $this->input->post();
		$objs = new Clientservice();
		$objs->where('client_site_id',$params['id'])->get();
		$str = '';
		$arr = array();
		foreach($objs as $obj){
			array_push($arr,'"'.$obj->id.'":{"name":"'.$obj->name.'","activation_date":"'.$obj->client_site->client->activedate.'"}');
		}
		$arrstr = implode(',',$arr);
		echo '{'.$arrstr.'}';
	}
	function getJson(){
		$id = $this->uri->segment(3);
		$obj = new Client();
		$obj->where('id',$id)->get();
		$arr = array();
		foreach($this->db->list_fields('clients') as $field){
			array_push($arr,'"'.$field.'"' . ':' . '"'.$obj->$field.'"');
		}
		$out = implode(",",$arr);
		echo '{' . $out . '}';
    }
    function getJsonAllData(){
		$objs = new Client();
		$objs->get();
		$myobj = array();
		foreach($objs as $obj){
			$arr = array();
			foreach($this->db->list_fields('clients') as $field){
				array_push($arr,'"'.$field.'"' . ':' . '"'.$obj->$field.'"');
			}
			$client = '{'.implode(",",$arr).'}';
			array_push($myobj,$client);
		}
		$out = implode(",",$myobj);
		echo '[' . $out . ']';		
	}
	function testJson(){
		echo '{"data":[["Puji","Programmer",SDA],["Reinhard","Programmer",SBY],["Willis","Programmer",MJK],["Dwi","Sales",MLG],["Amir","Sales",SBY],]}';
	}
	function getclient(){
		$this->load->model("pclient");
		$id = $this->uri->segment(3);
		$client = $this->pclient->getcclientbyid($id);
		$out = implode(',',$client);
		echo '{'.$out.'}';
	}
	function getclientservices(){
		$this->load->model("pclient");
		$id = $this->uri->segment(3);
		$services = $this->pclient->getservicesbyid($id);
		$out = implode(',',$services);
		echo '{'.$out.'}';
	}
	function getpics(){
		$client_id = $this->uri->segment(3);
		$sql = "select name,role,position from fbpics where client_id=".$client_id."";
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		$arr = array();
		foreach($que->result() as $res){
			switch($res->role){
				case "adm":
				$str = '"adm":{"name":"'.$res->name.'","role":"'.$res->role.'","position":"'.$res->position.'"}';
				break;
				case "billing":
				$str = '"billing":{"name":"'.$res->name.'","role":"'.$res->role.'","position":"'.$res->position.'"}';
				break;
				case "resp":
				$str = '"resp":{"name":"'.$res->name.'","role":"'.$res->role.'","position":"'.$res->position.'"}';
				break;
				case "subscriber":
				$str = '"subscriber":{"name":"'.$res->name.'","role":"'.$res->role.'","position":"'.$res->position.'"}';
				break;
				case "support":
				$str = '"support":{"name":"'.$res->name.'","role":"'.$res->role.'","position":"'.$res->position.'"}';
				break;
				case "teknis":
				$str = '"teknis":{"name":"'.$res->name.'","role":"'.$res->role.'","position":"'.$res->position.'"}';
				break;
			}
			array_push($arr,$str);
		} 
		echo '{'.implode(",",$arr).'}';
		$pics = '{';
		$pics.= '"adm":{"name":"haha","role":"adm","position":"Administrasi"},';
		$pics.= '"billing":{"name":"hihi","role":"billing","position":"Manager Accounting"},';
		$pics.= '"resp":{"name":"hoho","role":"resp","position":"Manager Umum"},';
		$pics.= '"subscriber":{"name":"hehe","role":"subscriber","position":"GA"},';
		$pics.= '"support":{"name":"huhu","role":"support","position":"Programmer"},';
		$pics.= '"teknis":{"name":"hiha","role":"teknis","position":"Manager IT"}';
		$pics.= '}';
		//echo $pics;
	}
	function getlocations(){
		$client_id = $this->uri->segment(3);
		$objs = new Client();
		$objs->where('id',$client_id)->get();
		$arr = array();
		foreach($objs->client_site as $obj){
			array_push($arr, '"' . $obj->id . '":"' . $obj->address . '"');
		}
		$out = implode(',',$arr);
		$out = '{' . $out . '}';
		echo $out;
	}
	function getalias(){
		$params = $this->input->post();
		$out = $this->pclient->getclientbyid2($params['id']);
		echo json_encode($out[0]); 
	}
	function savealias(){
		$params = $this->input->post();
		echo json_encode($this->pclient->savealias($params));
	}
	function testtodel(){
		print_r(getclientcombodata());
	}
	function index(){
		$condition = $this->uri->segment(3);
		$this->check_login();
		//$this->data['objs']=$this->client->populate(array('0','1','2','3','4','5','6','7','8','9','-','p'),array('1'));
		$this->data['objs']=populate(array('0','1','2','3','4','5','6','7','8','9','-','p'),array('1'));
		$this->data['sales'] = getsalescombodata();
		$this->data['branches'] = getbranchescombodata();
		$this->data['menuFeed'] = 'client';
		$this->data['clientcategories'] = array("1"=>"FFR","2"=>"Platinum","3"=>"Gold","4"=>"Bronze","5"=>"Silver","0"=>"Uncategorized",);
		switch($this->session->userdata["role"]){
			case 'Administrator':
				$this->data['objs'] = adm_populate();
				$this->data['clients'] = getclientcombodata();
				$this->load->view('adm/clients',$this->data);
				break;
			case 'Umum dan Warehouse':
				$this->load->view('Warehouse/clients/clients',$this->data);
				break;
			case 'Sales':
				switch($condition){
					case "nonactive":
						$this->data['objs'] = sales_populate("0","0","0");
					break;
					case "active":
						$this->data['objs'] = sales_populate("1","0","0");
					break;
					default:
						$this->data['objs'] = sales_populate();
					break;
				}
				$this->load->view('Sales/Clients/clients',$this->data);
				break;
			case 'TS':
				$this->load->view('TS/clients/index',$this->data);
				break;
			case 'Accounting':
				$this->load->view('Accounting/Clients/clients',$this->data);
				break;
			case 'CRO':
				$this->load->view('CRO/Clients/clients',$this->data);
				break;
		}
	}
	function clientdownload(){
		$clientexcel = $this->pclient->getclientexcel();
		$month = $this->uri->segment(3);
        $year = $this->uri->segment(4);
        $data = array(
            'objs'=>$clientexcel['res'],
            'subject'=>'Daftar Pelanggan - AM ',
            'filename'=>'Pelanggan-am'.$month.'-'.$year
        );
        $this->load->view('Sales/Clients/clientexcel',$data);
	}
	function makesite(){
		$params = $this->input->post();
		$this->load->model('pclient_site');
		echo json_encode($this->pclient_site->save2($params));
	}
	function nodeview(){
            $this->check_login();
            $data = array(
                'objs'=>$this->client->populate(),
                'menuFeed'=>'clients'
            );
            $this->load->view('Sales/Clients/clientsnodes',$data);
        }
	function dbClientJson(){
            $obj = new Client();
            $userarray = array();
            foreach($obj->get() as $client){
                array_push($userarray,'{"id":"'.$client->name.'","group":"nodes"}');
                if($client->client_sites->name!=NULL){
                    array_push($userarray,'{"id":"'.$client->name.'_'.$client->client_sites->name.'","group":"edges","source":"'.$client->client_site->name.'","target":"'.$client->name.'"}');
                }
            }
            echo "[" . implode(",",$userarray) . "]";
        }
	function checkComplete($id){
		$obj = new Client();
		$obj->where('id',$id)->get();
		$sign = true;
		$arr = array();
		foreach($this->db->list_fields("clients") as $field){
			if (trim($obj->$field)==="" ||$obj->$field ===null){
				array_push($arr,$field);
				$sign = false;
			}
		}
		if(!$sign){
			return $arr;
		}
		return false;
	}
	function iscomplete(){
		//$params = $this->input->post();
		$id = $this->uri->segment(3);
		$fields = $this->checkComplete($id);
		if(!$fields){
			echo "komplit";
		}else{
			echo "[".implode(",",$fields)."]";
		}
	}
	function list_clients(){
		$objs = $this->pclient->populate();
		$arr = array();
		foreach($objs as $obj){
			array_push($arr,'{"value":"'.$obj->name.'","data":"'.$obj->id.'","nofb":"'.$obj->nofb.'"}');
		}
		echo '{"out":['.implode(",",$arr).']}';
	}
	function testCheckComplete(){
		$id = $this->uri->segment(3);
		$fields = $this->checkComplete($id);
		if(!$fields){
			echo "Komplit";
		}else{
			foreach($fields as $field){
				echo $field . "<br />";
			}
		}
	}
	function save(){
		$params = $this->input->post();
		$obj = new Client();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function checkissupervisor(){
		$spv = $this->uri->segment(3);
		$usr = $this->uri->segment(4);
		if(checkissupervisor($spv, $usr)){
			echo "You re a supervisor !!!<br />";
		}else{
			echo "You have no staff !!!<br />";
		}
	}
	function checkissupervised(){
		$spv = $this->uri->segment(3);
		$usr = $this->uri->segment(4);
		if(checkissupervised($usr, $spv,1)){
			echo "<div style='color:red'>$spv is supervisor of $usr !!!</div><br />";
		}else{
			echo "$spv is not supervisor of $usr !!!<br />";
		}
	}
	function getam(){
		$params = $this->input->post();
		$query = "select * from amhistories where client_id=".$params["client_id"];
		$result = $this->db->query($query);
		$arr = array();
		foreach($result->result() as $res){
			array_push($arr,'{"createdate":"'.$res->createdate.'","username":"'.$res->username.'","description":"'.$res->description.'"}');
		}
		$out = '{"content":['.implode(",",$arr).']}';
		echo $out;
	}
	function getsupervised(){
		$myarr = getuserssupervised($this->uri->segment(3));
		$str = implode(",",$myarr);
		echo $str;
	}
	function saveamhistory(){
		$params = $this->input->post();
		saveamhistory($params);
		echo $this->db->insert_id();
	}
	function backupbeforedelete(){
		$this->load->model('pclient');
		echo $this->pclient->backupbeforedelete($this->uri->segment(3));
	}
	function remove(){
		$this->load->model('pclient');
		$this->pclient->delete($this->uri->segment(3));
	}
	function changenamealias(){
		$params = $this->input->post();
		echo $this->pclient->changenamealias($params);
	}
	function updateclientcategory(){
		$id = $this->uri->segment(3);
		$clientcategoryid = $this->uri->segment(4);
		$this->pclient->updateclientcategory(array('id'=>$id,'clientcategoryid'=>$clientcategoryid));
	}
	function updateclientam(){
		$id = $this->uri->segment(3);
		$sale_id = $this->uri->segment(4);
		$this->pclient->updateclientam(array('id'=>$id,'sale_id'=>$sale_id));
	}
	function uncomplete(){
		$objs = $this->pclient->getuncomplete();
		$data = array(
			'menuFeed'=>'uncomplete',
			'objs'=>$objs['res']
		);
		$this->load->view('TS/clients/uncomplete',$data);
	}
	function pics(){
		$objs = $this->pclient->getfbpics3();
		$data = array(
			'objs'=>$objs,
			'menuFeed'=>'pics',
		);
		$this->load->view('Sales/Clients/clientspic',$data);
	}
	function picsdownload(){
		$objs = $this->pclient->getfbpics3();
		$data = array(
			'objs'=>$objs,
			'menuFeed'=>'pics',
            'subject'=>'Laporan PIC Pelanggan',
            'filename'=>'PIC-Pelanggan'
		);
		$this->load->view('sales-dashboards/excelpicpelanggan',$data);
	}
}

<?php
class Suspects extends CI_Controller {
	var $data;
	var $ionuser;
	function __construct() {
		parent::__construct();
		$user = new User();
		if ($this->ion_auth->logged_in()) {
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $user->get_user_by_id($this->ionuser->id);
			$this->load->helper('user');
			$this->load->helper('suspect');
			$this->load->helper('prospect');
		}
	}
	function save_app() {
		$params = $this->input->post();
		$obj = new Client_application();
		foreach ($params as $key => $val) {
			$obj->$key = $val;
		}
		$obj->save();
		echo $this->db->insert_id();
	}
	function add_client() {
		$params = $this->input->post();
		echo $this->client->add($params);
	}
	function add_pic() {
		$this->check_login();
		$id = $this->uri->segment(3);
		$data = array(
			'businesstypes' => $this->business_field->get_combo_data(),
			'objs' => $this->client->populate(),
			'pics' => $this->pic->get_by_client_id($id),
			'positions' => $this->position->get_combo_data(),
			'menuFeed' => 'suspect'
		);
		$this->load->view('Sales/suspects/pic_add', $data);
	}
	function add_suspect() {
		$this->check_login();
		if ($this->uri->total_segments() == 3) {
			$objs = $this->client->get_obj_by_id($this->uri->segment(3));
			$branch = $objs->branch_id;
			$status = 'edit';
			$client_id = $this->uri->segment(3);
		} else {
			$objs = new Client();//Client::populate();
			$branch = $this->user->get_branchs_by_id($this->ionuser->id);
			$status = 'new';
			$client_id = "";
		}
		$data = array(
			'branches' => $this->branch->get_user_branches($this->ionuser->id),
			'branch' => $branch,
			'client_id' => $client_id,
			'status' => $status,
			'businesstypes' => $this->business_field->get_combo_data(),
			'objs' => $objs,
			'menuFeed' => 'suspect'
		);
		$this->load->view('Sales/suspects/add', $data);
	}
	function check_complete($client_id){
		$sql = "select * from clients where id=".$client_id;
		$query = $this->db->query($sql);
		$result = $query->result();
	}
	function check_login() {
		if (!$this->ion_auth->logged_in()) {
			redirect(base_url() . 'index.php/adm/login');
		}
	}
	function edit_client() {
		$params = $this->input->post();
		echo $this->client->edit($params);
	}
	function edit() {
		$this->check_login();
		$id = $this->uri->segment(3);
		$data = array(
			'applications' => $this->application->get_combo_data(),
			'budgets' => $this->budget->get_combo_data(),
			'businesstypes' => $this->business_field->get_combo_data(),
			'durations' => $this->duration->get_combo_data(),
			'hours' => $this->common->gethours(),
			'minutes' => $this->common->getminutes(),
			'internet_fees' => $this->internet_fee->get_combo_data(),
			'internet_users' => $this->internet_user->get_combo_data(),
			'medias' => $this->media->get_combo_data(),
			//'obj' => Client::get_obj_by_id($id),
			//'pics'=>getsuspectpicbyid($id),
			'pics'=>getsuspectpicbyclientid($id),
			'obj'=>getsuspectbyclientid($id),
			'operators' => $this->operator->get_combo_data(),
			'problems' => $this->problem->get_combo_data(),
			'positions' => $this->position->get_combo_data(),
			'speeds' => $this->speed->get_combo_data(),
			'usage_periods' => $this->usage_period->get_combo_data(),
			'menuFeed' => 'suspect'
		);
		$data['followups'] = getfollowups($id);
		$data['totalfollowups'] = gettotalfollowups($id);
		$data['services'] = $this->service->get_combo_data();
		$this->load->view('Sales/suspects/edit', $data);
	}
	function getApps() {
		$id = $this->uri->segment(3);
		$objs = new Client_application();
		$objs->where('client_id', $id)->get();
		$arr = array();
		foreach ($objs as $obj) {
			array_push($arr, '"' . $obj->id . '":"' . $obj->name . '"');
		}
		echo '{' . implode(",", $arr) . '}';
	}
	function getFields() {
		$id = $this->uri->segment(3);
		echo json_encode($this->pclient->getFields($id));
/*		$objs = new Client();
		$objs->where('id', $id)->get();
		$arr = array();
		$lists = $this->db->list_fields('clients');
		foreach ($lists as $list) {
			array_push($arr, '"' . $list . '":"' . $objs->$list . '"');
		}
		echo '{' . implode(",", $arr) . '}';*/
	}
	function getpic(){
		$params = $this->input->post();
		echo $this->pfbpic->getpic($params);
	}
	function updatepic(){
		$params = $this->input->post();
		echo $this->pfbpic->updatepic($params);
	}
	function get_provider_parameter() {
		$path = array('csspath' => base_url() . 'css/aquarius', 'jspath' => base_url() . 'js/aquarius', 'imagepath' => base_url() . 'img/aquarius');
		return array(
			'applications' => $this->application->get_combo_data(),
			'businesstypes' => $this->business_field->get_combo_data(),
			'csspath' => base_url() . 'css/aquarius/',
			'durations' => $this->duration->get_combo_data(),
			'imagepath' => base_url() . 'img/aquarius/',
			'internet_fees' => $this->internet_fee->get_combo_data(),
			'internet_users' => $this->internet_user->get_combo_data(),
			'jspath' => base_url() . 'js/aquarius/',
			'medias' => $this->media->get_combo_data(),
			'objs' => $this->client->populate(),
			'operators' => $this->operator->get_combo_data(),
			'path' => $path,
			'problems' => $this->problem->get_combo_data(),
			'positions' => $this->position->get_combo_data(),
			'budgets' => $this->budget->get_combo_data(),
			'internet_fees' => $this->internet_fee->get_combo_data(),
			'internet_users' => $this->internet_user->get_combo_data(),
			'speeds' => $this->speed->get_combo_data(),
			'usage_periods' => $this->usage_period->get_combo_data()
		);
	}
	function index() {
		$this->check_login();
		$arr = array();
		$users = getsubordinates($this->ionuser->id,$arr);
		$this->data['objs'] = getsuspects();
		$this->data['menuFeed'] = 'suspect';
		$this->load->view('Sales/suspects/suspects', $this->data);
	}
	function pic_add_x() {
		$params = $this->input->post();
		echo $this->pic->add($params);
	}
	function provider_yg_digunakan() {
		$this->check_login();
		$data = array(
			'applications' => $this->application->get_combo_data(),
			'businesstypes' => $this->business_field->get_combo_data(),
			'durations' => $this->duration->get_combo_data(),
			'internet_fees' => $this->internet_fee->get_combo_data(),
			'internet_users' => $this->internet_user->get_combo_data(),
			'medias' => $this->media->get_combo_data(),
			'objs' => $this->client->get_obj_by_id($this->uri->segment(3)),
			'operators' => $this->operator->get_combo_data(),
			'problems' => $this->problem->get_combo_data(),
			'positions' => $this->position->get_combo_data(),
			'speeds' => $this->speed->get_combo_data(),
			'usage_periods' => $this->usage_period->get_combo_data(),
			'menuFeed' => 'suspect'
		);
		$this->load->view('Sales/suspects/provider_yg_digunakan', $data);
	}
	function subscription_confirmation() {
		$data = array(
			'businesstypes' => $this->business_field->get_combo_data(),
			'objs' => $this->client->populate(),
			'positions' => $this->position->get_combo_data(),
			'menuFeed' => 'suspect',
			'client_id' => $this->uri->segment(3),
		);
		$this->load->view('Sales/suspects/subscription_confirmation', $data);
	}
	function internet_need_confirmation() {
		$this->check_login();
		$data = array(
			'businesstypes' => $this->business_field->get_combo_data(),
			'objs' => $this->client->populate(),
			'positions' => $this->position->get_combo_data(),
			'menuFeed' => 'suspect',
			'client_id' => $this->uri->segment(3)
		);
		$this->load->view('Sales/suspects/internet_need_confirmation', $data);
	}
	function save_client_priority() {
		$params = $this->input->post();
		$this->client_priority->add($params);
	}
	function drop_client_priority() {
		$params = $this->input->post();
		$this->client_priority->drop($params);
	}
	function ttg_padinet() {
		$this->check_login();
		$data = array(
			'budgets' => $this->budget->get_combo_data(),
			'businesstypes' => $this->business_field->get_combo_data(),
			'hours' => $this->common->gethours(),
			'minutes' => $this->common->getminutes(),
			'objs' => $this->client->populate(),
			'positions' => $this->position->get_combo_data(),
			'services' => $this->service->get_combo_data(true,"Pilihlah"),
			'id' => $this->uri->segment(3),
			'menuFeed' => 'suspect'
		);
		$this->load->view('Sales/suspects/ttg_padinet', $data);
	}
	function updatebyclientid() {
		$params = $this->input->post();
//		echo Client::edit($params);
		$sql = "update suspects ";
		$sql.= "set ";
		$sql.= " ";
		$arr = array();
		foreach ($params as $key=>$val){
			if($key<>'id'){
				array_push($arr,$key."='".$val."'");				
			}
		}
		$sql.= implode(",",$arr);
		$sql.= "where client_id=".$params["client_id"];
		$this->db->query($sql);
		echo $sql;
	}
	function update() {
		$params = $this->input->post();
//		echo Client::edit($params);
		$sql = "update suspects ";
		$sql.= "set ";
		$sql.= " ";
		$arr = array();
		foreach ($params as $key=>$val){
			if($key<>'id'){
				array_push($arr,$key."='".$val."'");				
			}
		}
		$sql.= implode(",",$arr);
		$sql.= "where id=".$params["id"];
		$this->db->query($sql);
		echo $sql;
	}
	function check_client_exist() {
		$params = $this->input->post();
		if ($this->client_priority->client_exist($params['id'])) {
			echo 'exist';
		} else {

			echo 'not exist';
		}
	}
	function collect_incomplete(){
		$arr = array();
		$id = $this->uri->segment(3);
		foreach($this->db->list_fields("clients") as $field){
			array_push($arr,$field);
		}
		$columns = implode(",",$arr);
		$sql = "select " . $columns . " from clients where id=" . $id ;
		$query = $this->db->query($sql);
		$resul = $query->result();
		if($query->num_rows()==0){
			echo "data tidak ada <br />";
		}else{
			$arrout = array();
			foreach($this->db->list_fields("clients") as $field){
				if($resul[0]->$field === ''||$resul[0]->$field===null){
					array_push($arrout,$field);
				}
			}
			echo implode(",",$arrout);
		}
	}
	function set_prospect() {
		$params = $this->input->post();
		$params['status'] = '1';
		echo $this->client->edit($params);
	}
	function unset_prospect() {
		$params = $this->input->post();
		$params['status'] = '0';
		echo $this->client->edit($params);
	}
	function getDescription(){
		$id = $this->uri->segment(3);
		$sql = "select id,followupdate,description from clientfollowups where client_id = " . $id . " ";
		$sql.= "order by followupdate desc ";
		$dta = $this->db->query($sql);
		$result = $dta->result();
		$arr = array();
		foreach ($result as $res){
			array_push($arr,'{"followupdate":"'.$res->followupdate.'","description":"'.$res->description.'"}');
		}
		echo '{"out":['.implode(",",$arr) . ']}';
	}
}

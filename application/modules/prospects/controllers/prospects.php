<?php
class Prospects extends CI_Controller{
	var $data;
	var $ionuser;
	function __construct(){
		parent::__construct();
		$this->data = array(
			'objs'=>$this->client->populate('1','0')
		);
		if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
			$this->load->helper('user');
			$this->load->helper('client');
			$this->load->helper('prospect');
		}
	}
	function add_prospect(){
		$data = array(
			'businesstypes'=>$this->business_field->get_combo_data(),
			'objs'=>$this->client->populate(),
		);
		$this->load->view('adm/prospect_add',$data);
	}
	function check_login(){
		if(!$this->ion_auth->logged_in()){
			redirect('/adm/login');
		}
	}
	function edit(){
		$this->check_login();
		$id=$this->uri->segment(3);
		$this->data['obj'] = $this->client->get_obj_by_id($id);
		$this->data['speeds'] = $this->speed->get_combo_data(" ");
		$this->data['operators'] = $this->operator->get_combo_data(" ");
		$this->data['problems'] = $this->problem->get_combo_data(" ");
		$this->data['durations'] = $this->duration->get_combo_data(" ");
		$this->data['usage_periods'] = $this->usage_period->get_combo_data(" ");
		$this->data['internet_users'] = $this->internet_user->get_combo_data(" ");
		$this->data['internet_fees'] = $this->internet_fee->get_combo_data(" ");
		$this->data['medias'] = $this->media->get_combo_data(" ");
		$this->data['services'] = $this->service->get_combo_data(" ");
		$this->data['positions'] = $this->position->get_combo_data();
		$this->data['sales'] = getsalescombodata();
		$this->data['menuFeed'] = 'prospect';
		$this->data['followups'] = getfollowups($id);
		$this->data['totalfollowups'] = gettotalfollowups($id);
		$this->load->view('Sales/prospects/edit',$this->data);
	}
	function update(){
		$params = $this->input->post();
		echo $this->client->edit($params);
	}
	function edit_client(){
		$params = $this->input->post();
		echo $this->client->edit($params);
	}
	function add_client(){
		$params = $this->input->post();
		echo $this->client->add($params);
	}
	function index(){
		$this->check_login();
		$arr = array();
		$users = getsubordinates($this->ionuser->id,$arr);
		$params = $this->uri->segment(3);
		$client = new Pclient();
		switch($params){
			case 'open':
				$objs = $client->populateClientSurvey('open',$users);
				$title = " (Open)";
			break;
			case 'closed':
				$objs = $client->populateClientSurvey('closed',$users);
				$title = " (Closed)";
			break;
			case 'all':
				$objs = $client->populateClientSurvey('all',$users);
				$title = "Semua";
			break;
			default:
				$objs = $client->populateClientSurvey('all',$users);
				$title = "Semua";
			break;
		}
		$data = array(
			'objs'=>$objs,
			'title'=>$title,
			'menuFeed'=>'prospect'
		);
		$this->load->view('Sales/prospects/prospects',$data);
	}
	function add_pic(){
		$id = $this->uri->segment(3);
		$data = array(
			'businesstypes'=>$this->business_field->get_combo_data(),
			'objs'=>$this->client->populate(),
			'path'=>$path,
			'pics'=>$this->pic->get_by_client_id($id),
			'positions'=>$this->position->get_combo_data()
		);
		$this->load->view('adm/prospect_pic_add',$data);
	}
	function pic_add_x(){
		$params = $this->input->post();
		echo $this->pic->add($params);
	}
	function provider_yg_digunakan(){
		$data = array(
			'applications'=>$this->application->get_combo_data(),
			'businesstypes'=>$this->business_field->get_combo_data(),
			'durations'=>$this->duration->get_combo_data(),
			'internet_fees'=>$this->internet_fee->get_combo_data(),
			'internet_users'=>$this->internet_user->get_combo_data(),
			'medias'=>$this->media->get_combo_data(),
			'objs'=>$this->client->populate(),
			'operators'=>$this->operator->get_combo_data(),
			'problems'=>$this->problem->get_combo_data(),
			'positions'=>$this->position->get_combo_data(),
			'speeds'=>$this->speed->get_combo_data(),
			'usage_periods'=>$this->usage_period->get_combo_data()
		);
		$this->load->view('adm/prospect_provider_yg_digunakan',$data);
	}
	function subscription_confirmation(){
		$data = array(
			'businesstypes'=>$this->business_field->get_combo_data(),
			'objs'=>$this->client->populate(),
			'positions'=>$this->position->get_combo_data()
		);
		$this->load->view('adm/prospect_subscription_confirmation',$data);
	}
	function internet_need_confirmation(){
		$data = array(
			'businesstypes'=>$this->business_field->get_combo_data(),
			'objs'=>$this->client->populate(),
			'positions'=>$this->position->get_combo_data()
		);
		$this->load->view('adm/prospect_internet_need_confirmation',$data);
	}
	function provider_internet(){
		$data = array(
			'businesstypes'=>$this->business_field->get_combo_data(),
			'objs'=>$this->client->populate(),
			'positions'=>$this->position->get_combo_data()
		);
		$this->load->view('adm/prospect_provider_internet',$data);
	}
	function save_client_priority(){
		$params = $this->input->post();
		$this->client_priority->add($params);
	}
	function drop_client_priority(){
		$params = $this->input->post();
		$this->client_priority->drop($params);
	}
	function ttg_padinet(){
		$data = array(
			'budgets'=>$this->budget->get_combo_data(),
			'businesstypes'=>$this->business_field->get_combo_data(),
			'objs'=>$this->client->populate(),
			'positions'=>$this->position->get_combo_data(),
			'services'=>$this->service->get_combo_data()
		);
		$this->load->view('adm/prospect_ttg_padinet',$data);
	}
	function check_client_exist(){
		$params = $this->input->post();
		if($this->client_priority->client_exist($params['id'])){
			echo 'exist';
		}else{
			echo 'not exist';
		}
	}
	function propose_survey(){
		$params = $this->input->post();
		echo $this->survey_request->add($params);
	}
}

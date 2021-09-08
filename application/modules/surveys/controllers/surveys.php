<?php
class Surveys extends CI_Controller {
	var $ionuser;
	var $data;
	function __construct() {
		parent::__construct();
		$this->data = array(
		);
		$user = new User();
		if ($this->ion_auth->logged_in()) {
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $user->get_user_by_id($this->ionuser->id);
			$this->load->helper('user');
			$this->load->helper('survey');
			$this->load->helper("branches");
			$this->load->model("pap");
			$this->load->model("pbtstower");
			$this->load->helper('client');
			$this->load->model('psurvey');
		}
	}
	function dropresume() {
		$this->load->model('psurvey_resume');
		$params = $this->input->post();
		$this->psurvey_resume->delete($params);
	}
	function edit() {
		$this->common->check_login();
		//harus nya data diambil dari survey_site, bukan survey_requests
		$sessdata = array("pending_url"=>"/surveys/edit/".$this->uri->segment(3));
		$this->session->set_userdata($sessdata);
		$this->common->check_login();
		$myuser = $this->ion_auth->user()->row();
		$myuser->id;

		$id = $this->uri->segment(3);
		$keyvalpaired = false;
		$obj = $this->survey_site->get_obj_by_id($id);
		$this->data['clientcategory'] = $this->pclient->getclientcategorybyid($obj->client_id);
		$surveyors = $this->psurvey_site->get_surveyors($id);
		$iseditor = $this->psurvey_site->iseditor($id,$myuser->email);
		$pics = new Pic();
		$pics->where("client_id",$obj->client_id)->get();
		$sitepics = new Site_pic();
		$sitepics->where("client_id",$obj->client_id)->get();
		$this->data['pics'] = $pics;
		$this->data['sitepics'] = $sitepics;
		$this->data['positions'] = $this->position->get_combo_data();
		$this->data['clients'] = $this->client->get_combo_data();
		$this->data['menuFeed'] = 'survey';
		$this->data['obj'] = $obj;
		$this->data['hours'] = $this->common->gethours();
		$this->data['minutes'] = $this->common->getminutes();
		$this->data['services'] = $this->service->get_combo_data(true,"Pilihlah");
		$this->data['branches'] = $this->branch->get_combo_data();
		$this->data['iseditor'] = $iseditor;
		$this->data['hasilsurvey'] = array(
			0 => 'Belum ada kesimpulan',
			1 => 'Bisa dilaksanakan',
			2 => 'Bisa dilaksanakan dengan syarat',
			3 => 'Tidak dapat dilaksanakan'
		);
		$this->data['aps'] = $this->pap->get_combo_data();
		$this->data['categories'] = $this->pclient->getcategories();
		$this->data['category_description'] = category_description();
		$this->data['device_type'] = $this->devicetype->get_combo_data();
		$this->data['material_type'] = $this->materialtype->get_combo_data();
		$this->data['btstowers'] = $this->pbtstower->get_combo_data('Pilihlah');
		$this->data['clients'] = $this->client->get_combo_data();
		$this->data['direction'] = array('0' => 'Pelanggan baru', '1' => 'Site baru', '2' => 'Relokasi');
		$this->data['devices'] = $this->device->get_combo_data();
		$this->data['sites'] = $this->survey_site->get_other_sites($id);
		$this->data['sender'] = 'survey_edit';
		$this->data['surveypackages'] = $this->surveypackage->populate();
		$this->data['userbranches'] = getuserbranches();
		$this->data['salesselected'] = getsalesselectedbysurveysiteid($id);
		switch ($this->session->userdata["role"]) {
			case "TS":
				$this->load->view('TS/surveys/edit', $this->data);
				break;
			case "Sales":
				if($this->common->is_decessor($obj->client_site->client->sale_id,$myuser->id)||($obj->client_site->client->sale_id===$myuser->id)){
						$this->load->view('Sales/surveys/edit', $this->data);
				}else{
					echo "MYUSERID ".$obj->client_site->client->user_id."<br />";
					echo "MYUSERID ".$myuser->id."<br />";
					echo "Anda harus memiliki privilege untuk dapat mengedit / melihat halaman ini ..";
				}
				break;
			case "CRO":
					redirect("surveys/showreport/".$id);
				break;
		}
	}
	function updatedescription(){
		$params = $this->input->post();
		$this->load->model('psurvey_site');
		echo $this->psurvey_site->updatedescription($params);
	}
	function getimage(){
		$id = $this->uri->segment(3);
		$obj = new Survey_image();
		$obj->where('id',$id)->get();
		echo $obj->img;
	}
	function imageedit(){
		$obj = new Survey_image();
		$obj->where('id',$this->uri->segment(3))->get();
		$data = array(
			'obj'=>$obj,
			'saveurl'=>base_url().'survey_images/update'
			);
		$this->load->view('imageeditor/index2',$data);
	}
	function index() {
		$this->common->check_login();
		$arr = array();
		$users = getsubordinates($this->ionuser->id,$arr);
		$this->data['menuFeed'] = 'survey';
		if (isset($this->session->userdata["role"])) {
			switch ($this->session->userdata["role"]) {
				case 'Sales':
					$this->data['objs'] = sales_get_surveysite();
					$this->load->view('Sales/surveys/surveys', $this->data);
					break;
				case 'TS':
					$this->data['objs'] = ts_get_surveysite();
					$this->load->view('TS/surveys/surveys', $this->data);
					break;
				case 'Umum dan Warehouse':
					$this->data['objs'] = Survey_site::populate();
					$this->load->view('TS/surveys/surveys', $this->data);
					break;
				default:
					redirect(base_url());
					break;
			}
		} else {
			redirect("/adm/chooseRole");
		}
	}
	function url_contain($obj) {
		$segs = $this->uri->segment_array();
		if (in_array($obj, $segs)) {
			return true;
		}
		return false;
	}
	function remove_surveyor() {
		$params = $this->input->post();
		echo $this->survey_surveyor->remove($params['id']);
	}
	function get_by_id() {
		$params = $this->input->post();
		$id = $params['id'];
		$obj = $this->survey_request->get_obj_by_id($id);
		echo '{"survey_date":"' . $obj->survey_date . '"}';
	}
	function save() {
		$this->load->model('psurvey_request');
		$params = $this->input->post();
	//	echo json_encode($params);
		echo $this->psurvey_request->add($params);
	}
	function saveresume() {
		$this->load->model('psurvey_resume');
		$params = $this->input->post();
		echo $this->psurvey_resume->save($params);
	}
	function showreport() {
		$this->common->check_login();
		$id = $this->uri->segment(3);
		$arr = array();
		$objs = new Survey_site();
		$survey = new Psurvey();
		$objs = $survey->getsitereport($id);
		$surveyors = $this->psurvey->getsurveyor(array('id'=>$id));
		$material = $this->psurvey->getmaterials(array('id'=>$id));
		$sd = $this->psurvey->getdevices(array('id'=>$id));
		$sr = $this->psurvey->getresumes(array('id'=>$id));
		$si = $this->psurvey->getimages(array('id'=>$id));
		$rbtsdistance = $this->psurvey->getbtsdistances(array('id'=>$id));
		$rsitedistance = $this->psurvey->getsitedistance(array('id'=>$id));
		foreach($surveyors['res'] as $surveyor){
			array_push($arr,$surveyor->name);
		}
		$data = array(
			"objs" => $objs,
			"surveyors" => implode(", ", $arr),
			"materials"=>$material['res'],
			"survey_site_id"=>$id,
			"clientproperties"=>$survey->getclientproperties($id),
			"sds"=>$sd['res'],"sr"=>$sr['res'],"images"=>$si['res'],
			"sitedistance"=>$rsitedistance['res'],"btsdistance"=>$rbtsdistance['res']
		);
		$this->load->view("Sales/surveys/reports/surveybyclient", $data);
	}
	function showreport2(){
		$this->load->view("Sales/surveys/reports/surveybyclient2");
	}
	function update() {
		$this->common->check_login();
		$params = $this->input->post();
		echo $this->psurvey->update($params);
	}
	function feedData() {
		$objs = $this->survey_site->populate();
		$rows = array();
		foreach ($objs as $obj) {
			$vals = array();
			switch ($obj->survey_request->resume) {
				case "0":
					$status = "Belum ada kesimpulan ";
					break;
				case "1":
					$status = "Dapat dilaksanakan ";
					break;
				case "2":
					$status = "Dapat dilaksanakan dengan catatan ";
					break;
				case "3":
					$status = "Tidak dapat dilaksanakan ";
					break;
				default:
					$status = "Belum ada kesimpulan";
					break;
			}
			array_push($vals, '"status":"' . $status . '"');
			$val = '{"' . $obj->id . '":{' . implode(",", $vals) . '}}';
			array_push($rows, $val);
		}
		echo '[' . implode(",", $rows) . ']';
	}
	function getRecordOver(){
		$obj = new User();
		$obj->include_related("branches")->where("id",$this->session->userdata["user_id"])->get();
		$userbranch = array();
		foreach($obj->branch as $obj){
			array_push($userbranch,$obj->id);
		}
		$objs = new Survey_request();
		$objs->where("id >", $this->uri->segment(3))->where_in_related("survey_site/branch","id",$userbranch)->get();
		$rows = array();
		foreach ($objs as $obj) {
			$vals = array();
			foreach ($this->db->list_fields("survey_requests") as $field) {
				array_push($vals, '"' . $field . '":"' . $obj->$field . '"');
			}
			switch ($obj->direction) {
				case '0':
					array_push($vals, '"surveydirection":"Pelanggan baru"');
					break;
				case '1':
					array_push($vals, '"surveydirection":"Site baru"');
					break;
				case '3':
					array_push($vals, '"surveydirection":"Relokasi"');
					break;
				default:
					array_push($vals, '"surveydirection":"-"');
					break;
			}
			array_push($vals, '"name":"' . $obj->client_site->client->name . '"');
			array_push($vals, '"surveyresult":"Belum ada kesimpulan"');
			$val = '{"' . $obj->id . '":{' . implode(",", $vals) . '}}';
			array_push($rows, $val);
		}
		echo '[' . implode(",", $rows) . ']';
	}
	function getresume(){
		$params = $this->input->post();
		$obj = new Survey_site();
		$obj->where("id",$params["id"])->get();
		echo $obj->survey_request->resume;
	}
	function showuserbranches(){
		$x = getuserbranches();
		foreach($x as $y){
			echo $y . "<br />";
		}
	}
	function reportdata(){
		$params = $this->input->post();
		echo $this->psurvey->getreportdata($params);
	}
	function reportbtses(){
		$params = $this->input->post();
		$row = $this->psurvey->getreportbts($params);
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","name":"'.$res->name.'","los":"'.$res->los.'","ap":"'.$res->ap.'","distance":"'.$res->distance.'","obstacle":"'.$res->obstacle.'","description":"'.$res->description.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}	
	function reportimages(){
		$params = $this->input->post();
		$row = $this->psurvey->getreportimages($params);
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","img":"'.$res->img.'","description":"'.$res->description.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}
	function reportmaterials(){
		$params = $this->input->post();
		$row = $this->psurvey->getreportmaterials($params);
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","name":"'.$res->name.'","material_type":"'.$res->material_type.'","amount":"'.$res->amount.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}
	function reportresumes(){
		$params = $this->input->post();
		$row = $this->psurvey->getreportresumes($params);
		$arr = array();
		foreach($row as $res){
			array_push($arr,'{"id":"'.$res->id.'","name":"'.$res->name.'"}');
		}
		$out = '{"data":['.implode(",",$arr).']}';
		echo $out;
	}
	function updaterequestresume(){
		$this->load->model('psurvey_request');
		$params = $this->input->post();
		echo $this->psurvey_request->updateresume($params);
	}
	function updatesiteresume(){
		$this->load->model('psurvey_site');
		$params = $this->input->post();
		echo $this->psurvey_site->updatedescription($params);
	}
} 

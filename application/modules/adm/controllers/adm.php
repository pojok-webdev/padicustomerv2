<?php
class Adm extends CI_Controller{
var $data = array();
var $ionuser;
function manuallysendmail(){
	padi_checklogin();
	$data = array('menuFeed'=>'manuallysendmail');
	$this->load->view('adm/manuallysendmail',$data);
}
function testipaddr(){
	echo $_SERVER['HTTP_CLIENT_IP'] . '<br />';
	foreach($_SERVER as $x => $y){
		echo $x . ' => ' . $y . '<br />';
	}
}
function canvasupload(){
	define("UPLOAD_DIR","/home/webdev/phpworkspace/db_teknis/media/installs/");
	$params = $this->input->post();
	$img = $params["imgBase64"];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR.uniqid().'.png';
	$success = file_put_contents($file,$data);
	print $success?$file:'tidak bisa menyimpan';
}
function canvasinstallupload2(){
	$upload_dir = "/home/klien/www/db_teknis/media/installs/";
	$upload_dir = "/home/webdev/phpworkspace/db_teknis/media/installs/";
	$params = $this->input->post();
	$img = $params["imgBase64"];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir . $params["filename"].".png";
	$success = file_put_contents($file, $data);
	switch(strtolower($params["fileextension"])){
		case "jpg":
			$typefile="jpg";
			$this->png2jpg($file,$upload_dir,$params["filename"]);
		break;
		case "png":
			$typefile="png";
		break;
		case "jpeg":
			$typefile="jpeg";
			$this->png2jpg($file,$upload_dir,$params["filename"]);
		break;
	}
	echo $typefile;
}
function canvassurveyupload2(){
	$upload_dir = "/home/klien/www/db_teknis/media/surveys/";
	$upload_dir = "/home/webdev/phpworkspace/db_teknis/media/surveys/";
	$params = $this->input->post();
	$img = $params["imgBase64"];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir . $params["filename"].".png";
	$success = file_put_contents($file, $data);
	switch(strtolower($params["fileextension"])){
		case "jpg":
			$typefile="jpg";
			$this->png2jpg($file,$upload_dir,$params["filename"]);
		break;
		case "png":
			$typefile="png";
		break;
		case "jpeg":
			$typefile="jpeg";
			$this->png2jpg($file,$upload_dir,$params["filename"]);
		break;
	}
	echo $typefile;
}
function curdate(){
	$humantime = date('d/m/Y H:m:s');
	$servertime = date('Y-m-d H:m:s');
	echo '{"humantime":"'.$humantime.'","servertime":"'.$servertime.'"}';
}
function png2jpg($inp,$outputdir,$filename){
	$input_file = $inp;
	$output_file = $outputdir.$filename.".jpg";
	$input = imagecreatefrompng($input_file);
	list($width, $height) = getimagesize($input_file);
	$output = imagecreatetruecolor($width, $height);
	$white = imagecolorallocate($output,  255, 255, 255);
	imagefilledrectangle($output, 0, 0, $width, $height, $white);
	imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
	imagejpeg($output, $output_file);
}
function canvasedit(){
		$this->load->view("TS/installs/canvasedit");
}
function canvasinstalledit(){
	$data = array("menuFeed"=>"canvas");
	$this->load->view("TS/installs/ui",$data);
}
function canvassurveyedit(){
	$data = array("menuFeed"=>"canvas");
	$this->load->view("TS/surveys/ui",$data);
}
function createdate(){
	echo date('d/m/Y');
}
function addalert(){
	$params = $this->input->post();
	$obj = $params;
	unset($obj['group']);
	unset($obj['sender']);
	foreach($this->user->get_user_by_group($params['group']) as $user){
		$obj['targetuser'] = $user->username;
		$this->alert->add($obj);
	}
}
function addmessage(){
	$params = $this->input->post();
	$obj = $params;
	unset($obj['group']);
	foreach($this->user->get_user_by_group($params['group']) as $user){
		$obj['targetuser'] = $user->username;
		$this->message->add($obj);
	}
}
function addotherclient(){
	$params = $this->input->post();
	echo $this->survey_client_distance->survey_client_add($params);
}
function addrouter(){
	$params = $this->input->post();
	echo $this->install_router->add_router($params);
}
function survey_addsite(){
	$params = $this->input->post();
	echo $this->survey_site->site_add($params);
}
function addsurveyimage(){
	$params = $this->input->post();
	echo $this->survey_image->add($params);
}
function addaw(){
	$params = $this->input->post();
	echo $this->install_ap_wifi->add_aw($params);
}
function addinstall(){
	$params = $this->input->post();
	echo $this->install_request->add($params);
}
function addinstalldate(){
	$params = $this->input->post();
	echo $this->install_date->add($params);
}
function addrw(){
	$params = $this->input->post();
	echo $this->install_wireless_radio->add_wr($params);
}
function addsurveydate(){
	$params = $this->input->post();
	echo $this->survey_date->add($params);
}
function backbones(){
	$this->check_login();
	$this->data['objs'] = $this->pbackbone->populate();
	$this->data['branches'] = $this->branch->get_combo_data();
	$this->data['menuFeed'] = 'backbone';
	$this->load->view('adm/backbones', $this->data);
}
function backbonesave(){
	$params = $this->input->post();
	$obj = new Backbone();
	foreach($params as $key=>$val){
		$obj->$key = $val;
	}
	$obj->save();
	echo $this->db->insert_id();
}
function backbonebranchsave(){
	$params = $this->input->post();
	$sql = "delete from backbones_branches ";
	$sql.= "where backbone_id=".$params["backbone_id"];
	$this->db->query($sql);
	$branches = $params["branches"];
	for($i=0;$i<strlen($params["branches"]);$i++){
		$sql = "insert into backbones_branches ";
		$sql.= "(backbone_id,branch_id) ";
		$sql.= "values ";
		$sql.= "(".$params["backbone_id"].",".$branches[$i].") ";
		$this->db->query($sql);
	}
	echo $sql;
}
function backboneupdate(){
	$params = $this->input->post();
	$keys = array();$vals = array();$arr = array();
	foreach($params as $key=>$val){
		array_push($arr,''.$key.'="'.$val.'"');
		array_push($keys,$key);
		array_push($vals,$val);
	}
	$sql = "update backbones ";
	$sql.= "set " . implode(",",$arr) . " ";
	$sql.= "where id=".$params["id"];
	$que = $this->db->query($sql);
	echo $sql;
}
function addsurveysite(){
	$params = $this->input->post();
	$this->survey_site->site_add($params);
}
function addsurveydevice(){
	$params = $this->input->post();
	echo $this->survey_device->add($params);
}
function addsurveymaterial(){
	$params = $this->input->post();
	echo $this->survey_material->add($params);
}
function addtopologijaringan(){
	$params = $this->input->post();
	echo $this->install_image->add_image($params);
}
function aps(){
	$this->check_login();
	$this->data['objs'] = $this->pap->populate();
	$this->data['btses'] = $this->pbtstower->get_combo_data();
	$this->data['menuFeed'] = 'ap';
	$this->data['boards'] = array();
	$this->data['btstowers'] = array();
	$this->load->view('adm/aps', $this->data);
}
function btsdistance_remove(){
	$params = $this->input->post();
	$this->survey_bts_distance->remove_by_id(array(
	$params['btsdistance_id']
	));
	echo $params['btsdistance_id'];
}
function __construct(){
	parent::__construct();
	$this->load->library('ion_auth');
	$this->load->helper('language');
	$this->load->helper('padi');
	$user = new User();
	if ($this->ion_auth->logged_in()){
		$this->ionuser = $this->ion_auth->user()->row();
		$this->data['user'] = $user->get_user_by_id($this->ionuser->id);
	}
}
function change_password(){
	$params = $this->input->post();
	$this->ion_auth_model->change_password($params['email'], $params['oldpassword'], $params['password']);
}
function check_login(){
	if (!$this->ion_auth->logged_in()){
		redirect('/adm/login');
	}
}
function client_lookup(){
	$this->check_login();
		switch ($this->uri->segment(3)){
		case 'add-install-lookup':
			$objs = $this->survey_request->populate(1);
			$this->data['objs'] = $objs->client;
			$this->data['return_page'] = 'adm/install_add/';
		break;
		default:
			$this->data['objs'] = $this->client->populate();
		break;
	}
	$this->load->view('adm/client_lookup', $this->data);
}
function closesurveydate(){
	$params = $this->input->post();
	echo $this->survey_request->close_survey_date($params);
}
function closeinstalldate(){
	$params = $this->input->post();
	echo $this->install_request->close_install_date($params);
}
function createuser(){
	$this->check_login();
	$this->data['obj'] = $this->user->populate();
	$this->load->view('adm/createuser', $this->data);
}
function dashboard(){
	$this->check_login();
	$this->data['menuFeed'] = 'dashboard';
	$this->load->view('adm/pujicalendar', $this->data);
}
function d_calendar(){
	$year = date('Y');
	$month = date('m');
	$arr = array();
	foreach($this->survey_request->get_survey_requests('0') as $req){
		$mydt = $this->common->longsql_to_datepart($req->survey_date);
		array_push($arr, array(
		'title' => $req->client->name,
		'start' => $req->survey_date
		));
	}
	array_push($arr, array(
		'title' => 'hola',
		'start' => '2014-06-02 13:16:28',
		'end' => '2014-06-03 13:16:28',
		'agenda' => '8:45',
		'allDaySlot' => false,
		'url' => '/adm/dashboard',
		'color' => 'red'
	));
	array_push($arr, array(
		'title' => 'mbahmu',
		'start' => '2014-06-08 11:16:28',
		'end' => '2014-06-10 10:16:28',
		'allDay' => false,
		'url' => '/adm/dashboard',
		'color' => 'red'
	));
	array_push($arr, array(
		'title' => 'hola2',
		'start' => '2014-06-02 14:16:28',
		'end' => '2014-06-02 15:16:28',
		'agenda' => '12:45',
		'url' => '/adm/dashboard',
		'color' => 'green'
	));
	echo json_encode($arr);
}
function deactivealert(){
	$params = $this->input->post();
	echo $this->alert->deactivealert($params);
}
function deactivemessage(){
	$params = $this->input->post();
	echo $this->message->deactivemessage($params);
}
function deviceupdate(){
	$params = $this->input->post();
	echo $this->device->edit($params);
}
function differenceintimes(){
	$params = $this->input->post();
	$result = $this->common->differenceInTimes($params['starttime'], $params['endtime']);
	echo "$result->d hari, $result->h jam, $result->i menit";
}
function differenceintimes2(){
	$params = $this->input->post();
	$result = $this->common->differenceInTimes($params['starttime'], $params['endtime']);
	if ($result->d == 0){
		if ($result->h == 0){
			if ($result->i <= 30){
				echo "< 30 menit";
			}else{
				echo ">30 menit <= 1 jam";
			}
		}elseif ($result->h == 1){
			if ($result->i == 0){
				echo ">30 menit <= 1 jam";
			}else{
				echo "1 - <= 2 jam";
			}
		}elseif ($result->h == 2){
			if ($result->i == 0){
				echo "1 - <= 2 jam";
			}else{
				echo "2 - <=4 jam";
			}
		}else{
			echo "4 - <=24 jam";
		}
	}
	if ($result->d == 1){
		if ($result->h == 1){
			if ($result->i == 0){
			}
		}
	}
}
function fprospecttosurvey(){
	$cl = new Client();
	$cl->where('id', $this->uri->segment(3))->get();
	$sr = new Survey_request();
	$sr->save($cl);
	redirect('/adm/prospects/');
}
function get_alerts(){
	if ($this->ion_auth->logged_in()){
		echo $this->message->get_messages($this->session->userdata['username']);
	}else{
		echo 'false';
	}
}
function chooseRole(){
	$this->check_login();
	$user = new User();
	$user->where('id', $this->session->userdata('user_id'))->get();
	if ($user->group->result_count() > 1){
		$data = array(
		"roles" => $user->group
		);
		$this->load->view("adm/chooseRole", $data);
	}else{
		switch ($user->group->name){
		case "TS":
			$session_data = array(
			'role' => "TS"
			);
			$this->session->set_userdata($session_data);
			if($this->session->userdata("pending_url")){
				redirect($this->session->userdata("pending_url"));
			}else{
				redirect("/schedules/show");
			}
		break;
		case "Sales":
			$session_data = array(
			'role' => "Sales"
			);
			$this->session->set_userdata($session_data);
			if($this->session->userdata("pending_url")){
				redirect($this->session->userdata("pending_url"));
			}else{
				redirect("/surveys");
			}
		break;
		case "Umum dan Warehouse":
			$session_data = array(
			'role' => "Umum dan Warehouse"
			);
			$this->session->set_userdata($session_data);
			if($this->session->userdata("pending_url")){
				redirect($this->session->userdata("pending_url"));
			}else{
				redirect("/adm/devicetypes");
			}
		break;
		case "CRO":
			$session_data = array(
			'role' => "CRO"
			);
			$this->session->set_userdata($session_data);
			if($this->session->userdata("pending_url")){
				redirect($this->session->userdata("pending_url"));
			}else{
				redirect("/rpt/");
			}
		break;
		case "Administrator":
			$session_data = array(
				'role' => "Administrator"
			);
			$this->session->set_userdata($session_data);
			if($this->session->userdata("pending_url")){
				redirect($this->session->userdata("pending_url"));
			}else{
				redirect("/schedules/show");
			}
		break;
		}
	}
}
function datess($start, $end){
	$date1 = explode('/', $start);
	$date2 = explode('/', $end);
	$dttm1 = date_create($date1[2] . '-' . $date1[1] . '-' . $date1[0]);
	$dttm2 = date_create($date2[2] . '-' . $date2[1] . '-' . $date2[0]);
	$diff = date_diff($dttm1, $dttm2);
	$tgl = $date1[0];
	$startdate = date("Y-m-d", mktime(0, 0, 0, $date1[1], $tgl, $date1[2]));
	$out = array();
	echo $diff->format("%R%a hari") . '<br />';
	for ($i = 0; $i < $diff->format("%a"); $i++){
		$tmpdate = date("Y-m-d", mktime(0, 0, 0, $date1[1], $tgl + $i, $date1[2]));
		echo $tmpdate . '<br />';
	}
}
function devices(){
	$this->check_login();
	$this->data['objs'] = $this->device->populate();
	$this->data['menuFeed'] = 'device';
	$this->data['devicetypes'] = $this->devicetype->get_combo_data();
	$this->load->view('adm/devices', $this->data);
}
function devicetypeadd(){
	$params = $this->input->post();
	echo $this->devicetype->add($params);
}
function devicetypes(){
	$this->check_login();
	$this->data['objs'] = $this->devicetype->populate();
	$this->data['menuFeed'] = 'devicetype';
	$this->load->view('adm/devicetypes', $this->data);
}
function getdevice(){
	$params = $this->uri->segment(3);
	echo array(
		"1" => "satu"
	);
}
function get_model($modelname, $colarray){
	$obj = new $modelname();
	foreach($colarray as $key => $val){
		$obj->where($key, $val);
	}
	$obj->get();
	return $obj;
}
function get_other_sites(){
	$params = $this->input->post();
	echo $this->survey_site->get_other_sites($params['id']);
}
function get_rowcount(){
	$params = $this->input->post();
	$obj = $this->get_model($params["modelname"], array(
		$params["colname"] => $params["colval"]
	));
	echo $obj->result_count();
}
function get_dashboard(){
	$dt1 = $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5);
	$dt2 = $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8);
	$datesbetween = $this->common->daysbetween($dt1, $dt2);
	$arr = array();
	foreach($datesbetween as $days){
		$query = " select a.name,b.survey_date survey,";
		$query.= " case when b.survey_date is null then '-' else a.name end bname,";
		$query.= " case when b.survey_date is null then '-' else case b.status when '0' then 'belum' when '1' then 'progress' when '2' then 'selesai' end  end bstatus,";
		$query.= " case when b.survey_date is null then '-' else a.service_interested_to end bservice,";
		$query.= " case when c.install_date is null then '-' else a.name end cname,";
		$query.= " case when c.install_date is null then '-' else case c.status when '0' then 'belum' when '1' then 'progress' when '2' then 'selesai' end  end cstatus,";
		$query.= " case when c.install_date is null then '-' else a.service_interested_to end cservice,";
		$query.= " case when d.maintenance_date is null then '-' else a.name end dname,";
		$query.= " case when d.maintenance_date is null then '-' else case d.status when '0' then 'belum' when '1' then 'progress' when '2' then 'selesai' end end dstatus,";
		$query.= " case when d.maintenance_date is null then '-' else d.description end dproblem,";
		$query.= " c.install_date install,d.maintenance_date maintenance ";
		$query.= " from clients a left outer join ";
		$query.= " (select * from survey_requests where survey_date='" . $days . "') b on a.id=b.client_id left outer join ";
		$query.= " (select * from install_requests where install_date='" . $days . "') c on c.client_id=a.id left outer join ";
		$query.= " (select * from maintenance_requests where maintenance_date='" . $days . "') d on d.client_id=a.id ";
		$query.= " where b.id is not null or c.id is not null or d.id is not null ";
		$result = $this->db->query($query);
		$arr2 = array();
		$c = 1;
		foreach($result->result() as $r){
			$myresult = '"' . $c . '":
			{
				"Survey":{"nama":"' . $r->bname . '","layanan":"' . $r->bservice . '","status":"' . $r->bstatus . '"},
				"Install":{"nama":"' . $r->cname . '","layanan":"' . $r->cservice . '","status":"' . $r->cstatus . '"},
				"Maintenance":{"nama":"' . $r->dname . '","problem":"' . $r->dproblem . '","status":"' . $r->dstatus . '"}
			}';
			array_push($arr2, $myresult);
			$c++;
		}
		$row = '"' . $days . '":{' . implode(",", $arr2) . '}';
		array_push($arr, $row);
	}
	$out = '{' . implode(',', $arr) . '}';
	echo $out;
}
function get_datacenters(){
	echo '{"1":"Telkom","2":"Indosat"}';
}
function get_lastvisit(){
	$params = $this->input->post();
	echo $this->app_log->get_lastvisit($params['username']);
}
function get_notification(){
	$group = $this->uri->segment(3);
	switch ($group){
		case 'none':
			$survey_0 = $this->survey_request->get_notification('0');
			$survey_1 = $this->survey_request->get_notification('1');
			$survey_2 = $this->survey_request->get_notification('2');
			$survey_3 = $this->survey_request->get_notification('3');
			$install_0 = $this->install_request->get_notification('0');
			$install_1 = $this->install_request->get_notification('1');
			$install_2 = $this->install_request->get_notification('2');
			$install_3 = $this->install_request->get_notification('3');
			$maintenance_0 = $this->maintenance_request->get_notification('0');
			$maintenance_1 = $this->maintenance_request->get_notification('1');
			$maintenance_2 = $this->maintenance_request->get_notification('2');
			$maintenance_3 = $this->maintenance_request->get_notification('3');
			echo '{"survey_0":"' . $survey_0 . '","survey_1":"' . $survey_1 . '","survey_2":"' . $survey_2 . '","survey_3":"' . $survey_3 . '","install_0":"' . $install_0 . '","install_1":"' . $install_1 . '","install_2":"' . $install_2 . '","install_3":"' . $install_3 . '","maintenance_0":"' . $maintenance_0 . '","maintenance_1":"' . $maintenance_1 . '","maintenance_2":"' . $maintenance_2 . '","maintenance_3":"' . $maintenance_3 . '"}';
		break;
		case 'sales':
			$survey_2 = $this->survey_request->get_notification('2');
			$install_2 = $this->install_request->get_notification('2');
			$maintenance_2 = $this->maintenance_request->get_notification('2');
			echo '{"survey_2":"' . $survey_2 . '","install_2":"' . $install_2 . '","maintenance_2":"' . $maintenance_2 . '"}';
		break;
		case 'TS':
			$survey_not_read = $this->survey_request->get_notification('0');
			$survey_not_done = $this->survey_request->get_notification('1');
			$survey_done = $this->survey_request->get_notification('5');
			$install_not_read = $this->install_request->get_notification('0');
			$install_not_done = $this->install_request->get_notification('1');
			$install_done = $this->install_request->get_notification('5');
			$maintenance_not_read = $this->maintenance_request->get_notification('0');
			$maintenance_not_done = $this->maintenance_request->get_notification('1');
			$maintenance_done = $this->maintenance_request->get_notification('5');
			echo '{"survey_not_read":"' . $survey_not_read . '","survey_not_done":"' . $survey_not_done . '","survey_done":"' . $survey_done . '","install_not_read":"' . $install_not_read . '","install_not_done":"' . $install_not_done . '","install_done":"' . $install_done . '","maintenance_not_read":"' . $maintenance_not_read . '","maintenance_not_done":"' . $maintenance_not_done . '","maintenance_done":"' . $maintenance_done . '"}';
		break;
	}
}
function get_last_id(){
	echo '{"last_id":"' . mysql_insert_id() . '"}';
}
function get_prospects(){
	$id = $this->uri->segment(3);
	$obj = new Prospect();
	$obj->where('id', $id)->get();
	echo '{"pic_name":"' . $obj->prospectpic->name . '","pic_phone":"' . $obj->speed . '","pic_mail":"' . $obj->ratio . '"}';
}
function getExtension($str){
	$i = strrpos($str, ".");
	if (!$i){
		return "";
	}
	$l = strlen($str) - $i;
	$ext = substr($str, $i + 1, $l);
	return $ext;
}
function getticket(){
	$id = $this->uri->segment(3);
	$ticket = $this->ticket->get_ticket($id);
	echo '{"clientname":"' . $ticket->clientname . '","content":"' . $ticket->content . '","ticketstart":"' . $ticket->ticketstart . '","ticketend":"' . $ticket->ticketend . '","requeststart":"' . $ticket->requeststart . '","requestend":"' . $ticket->requestend . '","requesttype":"' . $ticket->requesttype . '"}';
}
function handler(){
	$params = $this->input->post();
	switch ($params['sender']){
	case 'login':
		if ($this->ion_auth->login($params['username'], $params['password'])){
			$this->app_log->create_log('login');
			session_start();
			if(isset($_SESSION["sess"])&&isset($_SESSION["role"])){
				echo $_SESSION["sess"] . "<br />";
				echo $_SESSION["role"] . "<br />";
				$session_data = array(
					'role' => $_SESSION["role"]
				);
				$this->session->set_userdata($session_data);
				switch(trim($_SESSION["sess"])){
					case 'trials-fu':
					redirect(base_url() . $_SESSION['path']);
					break;
					default:
					redirect('/adm/chooseRole');
					break;
				}
			}else{


				redirect('/adm/chooseRole');
			}
		}else{
			redirect('/adm/login/fail');
		}
		break;
	case 'survey_add':
		$this->survey_request->update($params);
		break;
	case 'survey_edit':
		$this->survey_request->request_update($params);
		redirect('/adm/surveys');
		break;
	case 'cabangklienadd':
		$this->client_site->add($params);
		break;
	}
}
function index(){
	$this->check_login();
	$data = array(
		"menuFeed" => "",
	);
	$this->load->view('adm/dashboard', $data);
}
function install_act(){
	$this->check_login();
	$this->data['obj'] = $this->install_request->get_obj_by_id($this->uri->segment(3));
	$this->data['clients'] = $this->client->get_combo_data();
	$this->data['sender'] = 'survey_edit';
	$this->data['menuFeed'] = 'install';
	$this->load->view('adm/install_act', $this->data);
}
function install_add(){
	$this->check_login();
	$this->data['obj'] = $this->survey_request->get_obj_by_id($this->uri->segment(3));
	$this->data['clients'] = $this->client->get_combo_data();
	$this->data['sender'] = 'install_add';
	$this->load->view('adm/install_add', $this->data);
}
function install_addofficer(){
	$params = $this->input->post();
	$user = new User();
	$user->where('id', $params['user_id'])->get();
	$request = new Install_request();
	$request->where('id', $params['request_id'])->get();
	$request->save($user);
}
function install_dates(){
	$this->check_login();
	$id = $this->uri->segment(3);
	$obj = $this->install_request->get_obj_by_id($id);
	$this->data['obj'] = $obj;
	$this->data['sender'] = 'install_dates';
	$this->load->view('adm/install_dates', $this->data);
}
function install_addsite(){
	$params = $this->input->post();
	echo $this->install_site->add($params);
}
function install_removesite(){
	$params = $this->input->post();
	echo $this->install_site->remove_site($params['id']);
}
function install_updatesite(){
	$params = $this->input->post();
	echo $this->install_site->update_site($params);
}
function install_removerouter(){
	$params = $this->input->post();
	$this->install_router->remove_router($params['id']);
}
function install_removeaw(){
	$params = $this->input->post();
	echo $this->install_ap_wifi->remove_aw($params['id']);
}
function install_removerw(){
	$params = $this->input->post();
	echo $this->install_wireless_radio->remove_rw($params['id']);
}
function install_removetopologijaringan(){
	$params = $this->input->post();
	echo $this->install_image->remove_image($params['id']);
}
function installsiteadd(){
	$params = $this->input->post();
	echo $this->install_site->add($params);
}
function installsite_saveimage(){
	$params = $this->input->post();
	rename('./media/tmp/' . $params['path'], './media/installs/' . $params['path']);
	echo $this->install_site->saveimage($params);
}
function isonline(){
	$username = $this->uri->segment(3);
	$q = 'select user_data from ci_sessions';
	$d = $this->db->query($q);
	$r = $d->result();
	$out = array();
	foreach($r as $k => $v){
		foreach($v as $a => $b){
			if (count($b) > 0){
				if (stripos($b, $username) > 0){
					echo 'ada';
					return true;
				}
			}
		}
	}
	echo 'tidak ada';
	return false;
}
function login(){
	session_start();
	if(isset($_SERVER['HTTP_REFERER'])) {
//		echo $_SERVER['HTTP_REFERER'];
	} 
	$this->load->view('adm/login', $this->data);
}
function logout(){
	echo "logout";
	$this->ion_auth->logout();
	$this->app_log->create_log('Logout');
	redirect("/adm/login");
}
function material_remove(){
	$params = $this->input->post();
	$obj = new Survey_material();
	$obj->where('id', $params['id'])->get();
	$obj->delete();
	echo $params['material_id'];
}

/*************/
function materials(){
	$this->check_login();
	$this->data['objs'] = $this->material->populate();
	$this->data['menuFeed'] = 'material';
	$this->data['materialtypes'] = $this->materialtype->get_combo_data();
	$this->load->view('adm/materials', $this->data);
}
function materialremove(){
	$params = $this->input->post();
	echo $this->material->remove($params["id"]);
}
function materialsave(){
	$params = $this->input->post();
	echo $this->material->add($params);
}
function materialtypeadd(){
	$params = $this->input->post();
	echo $this->materialtype->add($params);
}
function materialtypes(){
	$this->check_login();
	$this->data['objs'] = $this->materialtype->populate();
	$this->data['menuFeed'] = 'materialtype';
	$this->load->view('adm/materialtypes', $this->data);
}
function member_of($group){
	if ($this->user->get_group_name($this->ionuser->id) == $group){
		return true;
	}
	return false;
}
function messages(){
	$this->check_login();
	$data = array(
		'menuFeed' => 'messages',
		'user' => $this->user->get_user_by_id($this->user->id)
	);
	$this->load->view('adm/messages', $data);
}
function printpdf(){
	$o = new Pdftable();
	$o->SetFont('Arial', 'I', 12);
	$o->AddPage();
	$data = array(
	"nama" => "Jasa Mitra Propertindo",
	"tipe" => "Corporate",
	"Sites" => array(
		"PGS" => array(
			"name" => "PGS",
			"location" => "Pusat Grosir Surabaya"
		) ,
		"ITC" => array(
			"name" => "ITC",
			"location" => "International Trade Center"
		) ,
		"JMP" => array(
			"name" => "JMP",
			"location" => "Jembatan Merah Plaza"
		) ,
		"TEC" => array(
			"name" => "TEC",
			"location" => "Tunjungan Electronic Center"
		) ,
		"GFM" => array(
			"name" => "GFM",
			"location" => "Graha Family"
		) ,
		"HTJ" => array(
			"name" => "HTJ",
			"location" => "Hotel Tunjungan",
			"images" => array(
				"programmer.jpg"
			)
		) ,
		"RPZ" => array(
			"name" => "RPZ",
			"location" => "Royal Plaza"
		) ,
		"GLM" => array(
			"name" => "GLM",
			"location" => "Galaxy Mall"
		) ,
	) ,
	);
	$o->objecttable($data, 2);
	}
function prospects(){
	$this->check_login();
	$this->data['objs'] = $this->client->populate();
	$this->load->view('adm/prospects', $this->data);
}
function remove_image_path(){
	$params = $this->input->post();
	echo unlink($params['path']);
}
function removemaintenanceimage(){
	$params = $this->input->post();
	echo $this->maintenance_image->remove($params);
}
function requestupdate(){
	$params = $this->input->post();
	echo $this->ticket->updateticket();
}
function resetpasswordsendmail(){
	$params = $this->input->post();
	$result = $this->ion_auth->forgotten_password($params['email']);
	if ($result){
		$message = "Anda menerima email ini karena anda meminta untuk mereset password anda pada aplikasi Teknis <br/ >";
		$message.= "Kode anda yang baru adalah : <br />" . $result['forgotten_password_code'] . '<br />';
		$message.= "Masukkan kode diatas pada tautan berikut : ".base_url()."adm/entry_passwordcode";
		$message.= "<br /><br /><br />";
		$message.= "Best Regards";
		$message.= "<br /><br /><br />";
		$message.= "Admin Aplikasi PadiNET";
	}else{
		$message = 'Email anda tidak dikenali pada database kami';
	}
	echo $this->common->send_mail($params['email'], 'PadiAPP :: Reset Password', $message);
}
function entry_passwordcode(){
	$this->load->view('adm/entry_passwordcode', $this->data);
}
function entry_code(){
	$params = $this->input->post();
	$kode = 'ade74f8b6857c8cc1db49768bfbe3eccf1a2e33c';
	$result = $this->ion_auth->forgotten_password_complete($params['kode']);
	if ($result){
		$new_password = $result['new_password'];
		$identity = $result['identity'];
		$message = "Password baru anda : " . $new_password;
		echo $this->common->send_mail($result['identity'], 'DB Teknis :: Password baru anda', $message);
	}else{
		$message = 'kode yang anda masukkan salah';
	}
}
function reset_password(){
	$this->load->view('adm/reset_password', $this->data);
}
function settings(){
	$this->check_login();
	$data = array(
		'user' => $this->user->get_user_by_id($this->user->id) ,
		'menuFeed' => 'settings'
	);
	$this->data['menuFeed'] = 'Settings';
	$this->load->view('adm/settings', $this->data);
}
function useradd(){
	$params = $this->input->post();
	echo $this->ion_auth->register($params['username'], $params['password'], $params['email'], array(
		'fname' => $params['fname'],
		'lname' => $params['lname']
	));
}
function addsurveyofficer(){
	$params = $this->input->post();
	echo $this->survey_surveyor->add($params);
}
function addmaintenanceofficer(){
	$params = $this->input->post();
	echo $this->maintenance_operator->add($params);
}
function surveyimage_remove(){
	$params = $this->input->post();
	echo $this->survey_image->remove($params['id']);
}
function survey_removeofficer(){
	$params = $this->input->post();
	echo $this->survey_surveyor->remove($params['id']);
}
function survey_removeotherclent(){
	$params = $this->input->post();
	$this->survey_client_distance->remove_client($params['id']);
}
function survey_update(){
	$params = $this->input->post();
	$params['survey_date'] = $this->common->human_to_sql_date($params['survey_date']);
	$message = "Permintaan survey ";
	$message.= 'PIC ' . $params['pic_name'];
	$message.= 'Telp. ' . $params['pic_phone'];
	$message.= 'Email ' . $params['pic_email'];
	$message.= 'Jabatan ' . $params['pic_position'];
	echo $this->survey_request->request_update($params);
}
function surveyorupdate(){
	$params = $this->input->post();
	echo $this->survey_surveyor->edit($params);
}
function surveysitedistanceadd(){
	$params = $this->input->post();
	echo $this->survey_site_distance->add($params);
}

function surveysite_saveimage(){
	$params = $this->input->post();
	echo $this->survey_site->saveimage($params);
}
function survey_site(){
	$this->check_login();
	$id = $this->uri->segment(3);
	$path = array(
		'csspath' => '/css/aquarius/',
		'jspath' => '/js/aquarius/',
		'imagepath' => '/img/aquarius/',
		'user' => $this->user->get_user_by_id($this->user->id)
	);
	$data = array(
		'aps' => $this->PAP->get_combo_data() ,
		'device_type' => $this->devicetype->get_combo_data() ,
		'material_type' => $this->materialtype->get_combo_data() ,
		'obj' => $this->survey_site->get_obj_by_id($id) ,
		'btstowers' => $this->pbtstower->get_combo_data() ,
		'clients' => $this->client->get_combo_data() ,
		'hours' => $this->common->gethours() ,
		'minutes' => $this->common->getminutes() ,
		'devices' => $this->device->get_combo_data() ,
		'path' => $path,
		'sender' => 'survey_edit',
		'sites' => $this->survey_site->get_other_sites($id) ,
	);
	$data = array_merge($data, $this->data);
	$this->load->view('adm/survey_site', $data);
}
function surveysitestoinstallsitescopy(){
	$params = $this->input->post();
	$survey = new Survey_site();
	$surveys = $survey->where('survey_request_id', $params['survey_id'])->get();
	foreach($surveys as $srv){
		$install = new Install_site();
		$install->install_request_id = $params['install_request_id'];
		$install->address = $srv->address;
		$install->city = $srv->city;
		$install->pic = $srv->pic;
		$install->position = $srv->position;
		$install->phone_area = $srv->phone_area;
		$install->phone = $srv->phone;
		$install->pic_email = $srv->pic_email;
		$install->description = $srv->description;
		$install->save();
	}
	echo $install->check_last_query();
}
function testnotification(){
	echo $this->install_request->get_notification('2');
}
function upload2(){
	$config['upload_path'] = './media/';
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size'] = '1000';
	$config['max_width'] = '1024';
	$config['max_height'] = '768';
	$this->load->library('upload', $config);
	if (!$this->upload->do_upload()){
		$error = array(
		'error' => $this->upload->display_errors()
		);
		redirect('/adm/settings');
	}
	$data = $this->upload->data();
	echo "<img src='" . "/media/" . $data['file_name'] . "'  class='preview'>";
}
function upload(){
	$path = '/media/';
	$valid_formats = array(
	"jpg",
	"png",
	"gif",
	"bmp",
	"jpeg",
	"PNG",
	"JPG",
	"JPEG",
	"GIF",
	"BMP"
	);
	if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		if (strlen($name)){
			$ext = $this->getExtension($name);
			if (in_array($ext, $valid_formats)){
				if ($size < (1024 * 1024)){
					$actual_image_name = time() . substr(str_replace(" ", "_", $txt) , 5) . "." . $ext;
					$tmp = $_FILES['photoimg']['tmp_name'];
					if (move_uploaded_file($tmp, $path . $actual_image_name)){
						echo "<img src='uploads/" . $actual_image_name . "'  class='preview'>";
					}else echo "Fail upload folder with read access.";
				}else echo "Image file size max 1 MB";
			}else echo "Invalid file format..";
		}else echo "Please select image..!";
		exit;
	}
}
function update_userpic(){
	$params = $this->input->post();
	echo $this->user->update_userpic($params);
}
function updateinstallstatus(){
	$params = $this->input->post();
	echo $this->install_request->updatestatus($params);
}
function updatemaintenancestatus(){
	$params = $this->input->post();
	echo $this->maintenance_request->updatestatus($params);
}
function updatesurveystatus(){
	$params = $this->input->post();
	echo $this->survey_request->updatestatus($params);
}
function upload_file(){
	$uploaddir = './media/';
	$file = $uploaddir . basename($_FILES['uploadfile']['name']);
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}else{
		echo "error";
	}
}
function upload_clientimage(){
	$uploaddir = './media/clients/';
	$file = $uploaddir . basename($_FILES['uploadfile']['name']);
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}
	else{
		echo "error";
	}
}
function upload_userimage(){
	$uploaddir = './media/users/';
	$file = $uploaddir . basename($_FILES['uploadfile']['name']);
	$file = $uploaddir . $this->session->userdata['username'] . '.jpg';
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}else{
		echo "error";
	}
}
function upload_surveyimage(){
	$uploaddir = './media/surveys/';
	$file = $uploaddir . underscore(strtolower(basename($_FILES['uploadfile']['name'])));
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}else{
		echo "error";
	}
}
function upload_tmp(){
	$uploaddir = './media/installs/';
	$file = $uploaddir . underscore(strtolower(basename($_FILES['uploadfile']['name'])));
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}else{
		echo "error";
	}
}
function upload_profile(){
	$uploaddir = './media/users/';
	$file = $uploaddir . strtolower($this->session->userdata["username"]) . ".jpg";
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}else{
		echo "error";
	}
}
function upload_ba(){
	$uploaddir = './media/installs/ba/';
	$file = $uploaddir . basename($_FILES['uploadfile']['name']);
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)){
		echo "success";
	}else{
		echo "error";
	}
}
function userupdate(){
	$params = $this->input->post();
	echo $this->user->edit($params);
}
function wifiadd(){
	$params = $this->input->post();
	echo $this->install_ap_wifi->add_aw($params);
}
function reports(){
	$id = $this->uri->segment(3);
	$obj = new Survey_request();
	$obj->where('id', $id)->get();
	$data = array(
		'obj' => $obj
	);
	$this->load->view('reports/survey', $data);
}
function sendemail(){
	$message = "";
	$message.= "Yth\n";
	$message.= "Puji P\n";
	$message.= "\n";
	$message.= "Di Tempat\n";
	echo $this->common->send_mail('puji@padi.net.id', '[PadiNET App] DB Teknis', $message);
}
function mlm($id){
	$obj = new User();
	$obj->where('id', $id)->get();
	foreach($obj->user as $user){
		echo $user->username . '::' . $user->id . '<br />';
		$this->mlm($user->id);
	}
	$obj->close();
}
function callMlm(){
	$this->mlm(11);
}
function datatable(){
	$this->load->view("datatable/table");
}
function tableTemplate(){
	$this->load->view("adm/tableTemplate");
}
function setRole(){
	$params = $this->input->post();
	$session_data = array(
		'role' => $params["role"]
	);
	$this->session->set_userdata($session_data);
}
function getRoles(){
	$user = new User();
	$user->where('id', $this->session->userdata['user_id'])->get();
	echo $user->group->result_count() . '<br />';
	foreach($user->group as $role){
		echo $role->name . '<br />';
	}
}
function info(){
	phpinfo();
}
function testJson(){
	$json = '{';
	$json.= ' "items": [';
	$json.= ' {';
	$json.= '"title": "Suicide bomber hits Russia station",';
	$json.= '"description": "A suicide bomber carried out an attack at a train station in the southern Russian city of Volgograd that killed at least 13, officials suspect.",';
	$json.= '"link": "http://www.bbc.co.uk/news/world-europe-25541019#sa-ns_mchannel=rss&ns_source=PublicRSS20-sa",';
	$json.= '"img": "http://news.bbcimg.co.uk/media/images/71986000/jpg/_71986957_71986860.jpg"';
	$json.= '},';
	$json.= '{';
	$json.= '"title": "Let Syrian refugees into UK - Farage",';
	$json.= '"description": "The UK should take in refugees from Syria, UKIP leader Nigel Farage says, as he argues refugees are \"very different\" from economic migrants.",';
	$json.= '"link": "http://www.bbc.co.uk/news/uk-politics-25539843#sa-ns_mchannel=rss&ns_source=PublicRSS20-sa",';
	$json.= '"img": "http://news.bbcimg.co.uk/media/images/71987000/jpg/_71987701_71987673.jpg"';
	$json.= '},';
	$json.= '{';
	$json.= '"title": "Schumacher injured in skiing accident",';
	$json.= '"description": "Seven-time Formula 1 world champion Michael Schumacher is taken to hospital by helicopter after being injured skiing in France.",';
	$json.= '"link": "http://www.bbc.co.uk/sport/0/formula1/25542340",';
	$json.= '"img": "http://news.bbcimg.co.uk/media/images/71988000/jpg/_71988315_71988219.jpg"';
	$json.= '},';
	$json.= '{';
	$json.= '"title": "Two held over North Sea ferry fire",';
	$json.= '"description": "Two men are arrested after a fire on a North Sea ferry sailing from Newcastle to Amsterdam saw six people airlifted to hospital.",';
	$json.= '"link": "http://www.bbc.co.uk/news/uk-25540731#sa-ns_mchannel=rss&ns_source=PublicRSS20-sa",';
	$json.= '"img": "http://news.bbcimg.co.uk/media/images/71986000/jpg/_71986135_71986531.jpg"';
	$json.= '}';
	$json.= ']';
	$json.= '}';
	echo $json;
}
function testJson2(){
	$out = '{
	"number": "1",
	"date": "01-01-2014",
	"dueDate": "01-20-2014",
	"to": { "name": "John Lemon" , "description": "", "mail": "john.lemon@finmail.com", "address":"Weling Street 33", "city":"London", "country":"England"},
	"from": { "name": "Jan Blaha" , "description": "", "mail": "jan.blaha@finmail.com", "address":"U Sluncové 603", "city":"Prague", "country":"Czech Republic"},
	"items" : [ { "name": "Designing online portal", "quantity": 1, "price" : 1000}, 
			{ "name": "Implementing online portal", "quantity": 1, "price" : 8000},
			{ "name": "Testing online portal", "quantity": 1, "price" : 2000} ]
	}';
	echo $out;
}
function testJson3(){
	$out = '{
	"receiverAddress":"Jl Kebon 50 Rejo Jember - Jawa Timur, Indonesia",
	"name":"Puji Prayitno, Mas",
	"items":[
		{"singer":"ndut","band":"OM Nirmala"},
		{"singer":"roma","band":"OM Sonete"}
		]
	}';
	echo $out;
}
function jsreport(){
	$this->load->view('jsreport');
}
function surveyordata($id){
	$query = "select distinct c.id,a.name from survey_surveyors a ";
	$query.= "left outer join survey_requests b on b.id=a.survey_request_id ";
	$query.= "right outer join survey_sites c on c.survey_request_id=c.id  where c.id=".$id;
	$result =$this->db->query($query);
	$arr = array();
	foreach($result->result() as $row){
		array_push($arr, '{"id":"'.$row->id . '","name":"' . $row->name.'"}');
	}
	return "[".implode(",",$arr)."]";
}
function sitedata($id){
	$query = "select a.id,a.address,location_e,location_e_m,location_e_s,location_s,location_s_m,location_s_s,amsl,agl ";
	$query.= "from survey_sites a ";
	$query.= "left outer join survey_requests b on b.id=a.survey_request_id where b.id=".$id;
	$result =$this->db->query($query);
	$arr = array();
	foreach($result->result() as $row){
		array_push($arr, '{"id":"'.$row->id . '","address":"' . $row->address.'","location_e":"' . $row->location_e.'","location_e_m":"' . $row->location_e_m.'","location_e_s":"' . $row->location_e_s.'","location_s":"' . $row->location_s.'","location_s_m":"' . $row->location_s_m.'","location_s_s":"' . $row->location_s_s.'","amsl":"' . $row->amsl.'","agl":"' . $row->agl.'"}');
	}
	return "[".implode(",",$arr)."]";
}
function surveydata(){
	$id = $this->uri->segment(3);
	$query = "select b.id,b.pic_name,b.pic_position,b.pic_phone_area,b.pic_phone,b.address,c.name,c.business_field,b.survey_date ";
	$query.= "from survey_requests b  left outer join clients c on c.id=b.client_id where b.id='".$id."'";
	$result =$this->db->query($query);
	$row = $result->result();
	echo '{"id":"'.$row[0]->id . '","name":"' . $row[0]->name.'","address":"'.$row[0]->address.'","pic_name":"'.$row[0]->pic_name.'","pic_position":"'.$row[0]->pic_position.'","pic_phone_area":"'.$row[0]->pic_phone_area.'","pic_phone":"'.$row[0]->pic_phone.'","business_field":"'.$row[0]->business_field.'","survey_date":"'.$row[0]->survey_date.'","surveyors":'.$this->surveyordata($id).' ,"sites":'.$this->sitedata($id).'}';
}
function checkauth(){
	if ($this->ion_auth->logged_in()) {
		echo "yes";
	}else{
		echo "no";
	}
}
function setlogin(){
	$params = $this->input->post();
	if ($this->ion_auth->login($params['username'], $params['password'])){
		$array= array("username"=>$params["username"],"email"=>$params["password"]);
		$this->session->set_userdata($array);
		echo "You have logged in" . $params["username"] .",".$params["password"];
	}else{
		echo "Tidak dapat Login";
	}
}
function setlogout(){
	$this->session->sess_destroy();
}
function sendnotificationmail(){
	$params = $this->input->post();
	echo $this->common->send_mail($params["recipient"], $params["subject"], $params["body"],$params["cc"]);
}
function showImages(){
	$obj = new Survey_image();
	$obj->get();
	$data = array(
		"survey_images"=>$obj
	);
	$this->load->view("showImages2",$data);
}
function showImageLoader(){
	$this->load->view("showImageLoader");
}
function saveBlob(){
	$id = $this->uri->segment(4);
	$blob = $this->uri->segment(5);
	$obj = new Survey_image();
	$obj->where("id",$id)->update(array("img"=>$blob));
	echo $obj->check_last_query();
}
}

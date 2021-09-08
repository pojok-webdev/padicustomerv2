<?php
class Reminders extends CI_Controller {
    var $ionuser, $data;
    function __construct() {
        parent::__construct();
        $this->data = Appsettings::getdata();
        if ($this->ion_auth->logged_in()) {
            $this->ionuser = $this->ion_auth->user()->row();
            $this->data['user'] = User::get_user_by_id($this->ionuser->id);
        }
        $this->load->helper("sites");
        $this->load->helper("user");
        $this->load->helper("mailing");
        $this->load->helper("survey");
        $this->load->helper("template");
        $this->load->helper("padi");
        $this->load->config("padi_config");
		$this->load->model("preminder");
        getvariables();
    }
	function getbotchatid(){
		return array(
			"bali"=>"-149206255",
			"malang"=>"-179062600",
			"jakarta"=>"-161183752",
			"surabaya"=>'-1001056634600'
		);
	}
	function getbotid(){
		return array(
			"padi_bot"=>"201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ"
		);
	}
	function getmailport(){
		return array(
			"incoming"=>995, 
			"outgoing"=>465
		);
	}
	function help(){
		echo "##########################################################\n\n";
		echo "Controller reminders memberikan layanan reminder kepada user (TS maupun Sales) antara lain tentang:\n";
		echo "1 ticket (baru/open , closed)\n";
		echo "2 survey (pengajuan, laporan)\n";
		echo "3 install (pengajuan, laporan)\n\n";
		echo "user_helper diperlukan untuk fungsi getsalesmails(id)\n";
		echo "yang menghasilkan array email sales berdasarkan id pelanggan\n";
		echo "sites_helper diperlukan untuk fungsi gettsmails(id)\n";
		echo "yang menghasilkan array email ts berdasarkan id pelanggan\n";
		echo "##########################################################\n\n";
	}
    function testtelegram(){
		exec("/home/klien/telegram/tg-send.sh @Pwprayitno 'Assalamu'alaykum beb");
	}
    function reminder() {
        $reminders = new Reminder();
        $reminders->where("active", "1")->get();
        foreach ($reminders as $reminder) {
            print "ID : " . $reminder->id . ", ";
            print "Period : " . $reminder->period . ", ";
            print "Detail : " . $reminder->perioddetail . "\n";
            print "Current Date : " . date("Y") . "-" . date("m") . "-" . date("j") . "\n";
            switch ($reminder->period) {
                case '0':
                    if (date("Y") . "-" . date("n") . "-" . date("j") === $reminder->perioddetail) {
                        print "HIT \n";
                        $this->insertlog($reminder->id, $reminder->recipient, $reminder->subject, $reminder->content);
                    }
                break;
                case '1':
                    if (date('i') == $reminder->perioddetail) {
                        print "daily reminder \n";
                        $this->insertlog($reminder->id, $reminder->recipient, $reminder->subject, $reminder->content);
                    }
                break;
                case '2':
                    if (date('H') - 1 == $reminder->perioddetail) {
                        $this->insertlog($reminder->id, $reminder->recipient, $reminder->subject, $reminder->content);
                    }
                break;
                case '3':
                    if (date('w') + 1 == $reminder->perioddetail) {
                        $this->insertlog($reminder->id, $reminder->recipient, $reminder->subject, $reminder->content);
                    }
                break;
                case '4':
                    if (date('m') == $reminder->perioddetail) {
                        $this->insertlog($reminder->id, $reminder->recipient, $reminder->subject, $reminder->content);
                    }
                break;
                case '5':
                    if (date('n') == $reminder->perioddetail) {
                        print "Reminder ID: " . $reminder->id . ";Period: " . $reminder->period . ";Detail Period:" . $reminder->perioddetail . " confirmed \n";
                        $this->insertlog($reminder->id, $reminder->recipient, $reminder->subject, $reminder->content);
                    }
                break;
            }
        }
    }
    function getCombo() {
        switch ($this->uri->segment(3)) {
            case '1':
                $arr = array();
                for ($c = 1; $c <= 60; $c++) {
                    array_push($arr, '"' . $c . '":"' . $c . '"');
                }
                $glued = implode(',', $arr);
                echo '{' . $glued . '}';
            break;
            case '2':
                $arr = array();
                for ($c = 1; $c <= 24; $c++) {
                    array_push($arr, '"' . $c . '":"' . $c . '"');
                }
                $glued = implode(',', $arr);
                echo '{' . $glued . '}';
                break;
            case '3':
                echo '{"1":"Minggu","2":"Senin","3":"Selasa","4":"Rabu","5":"Kamis","6":"Jumat","7":"Sabtu"}';
            break;
            case '4':
                $arr = array();
                for ($c = 1; $c <= 31; $c++) {
                    array_push($arr, '"' . $c . '":"' . $c . '"');
                }
                $glued = implode(',', $arr);
                echo '{' . $glued . '}';
            break;
            case '5':
                $arr = array();
                for ($c = 1; $c <= 12; $c++) {
                    array_push($arr, '"' . $c . '":"' . $c . '"');
                }
                $glued = implode(',', $arr);
                echo '{' . $glued . '}';
            break;
        }
    }
    function getJson() {
        $params = $this->input->post();
		$sql = "select id,period,perioddetail,recipient,subject,content,expiredate ";
		$sql.= "from reminders a where id=".$params["id"];
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		$res = $que->result();
		$obj = $res[0];
        $datepart = Common::longsql_to_datepart($obj->expiredate);
        echo '{"id":"' . $params["id"] . '","period":"' . $obj->period . '","perioddetail":"' . $obj->perioddetail . '","recipient":"' . $obj->recipient . '","subject":"' . $obj->subject . '","content":"' . $obj->content . '","expiredatedate":"' . $datepart["day"] . "/" . $datepart["month"] . "/" . $datepart["year"] . '","expiredatehour":"' . $datepart["hour"] . '","expiredateminute":"' . $datepart["minute"] . '"}';
    }
    function insertlog($reminderid, $recipient, $subject, $content) {
        $datelog = "";
        $obj = new Reminder();
        $objlog = new Reminderlog();
        $obj->where('id', $reminderid)->get();
        print "Reminder ID : " . $reminderid . ";Period : " . $obj->period . "\n";
        switch ($obj->period) {
            case "0":
                $datelog = date('Y') . '-' . date('n') . '-' . date('j');
                $objlog->where("reminder_id", $reminderid)->where('datelog', $datelog)->get();
            break;
            case "1":
                $datelog = date('Y') . '-' . date('m') . '-' . date('d') . ' ' . (date('H') - 1) . ':' . date('i');
                $objlog->where("reminder_id", $reminderid)->where('datelog', $datelog)->get();
            break;
            case "2":
                $datelog = date('Y') . '-' . date('m') . '-' . date('d') . ' ' . (date('H') - 1);
                $objlog->where("reminder_id", $reminderid)->where('datelog', $datelog)->get();
                print "Date Log : " . $datelog;
            break;
            case "3":
                $datelog = date('Y') . "-" . date('m') . " " . (date('w') + 1);
                $objlog->where("reminder_id", $reminderid)->where('datelog', $datelog)->get();
            break;
            case "4":
                $datelog = date('Y') . '-' . date('m');
                $objlog->where("reminder_id", $reminderid)->where('datelog', $datelog)->get();
                print "hit \n";
            break;
            case "5":
                $datelog = date('Y') . " " . date('n');
                $objlog->where('reminder_id', $reminderid)->where('datelog', $datelog)->get();
            break;
        }
        if ($objlog->result_count() == 0) {
            $recpt = explode(",", $recipient);
            $this->sendmail($recipient, $subject, $content);
            $log = new Reminderlog();
            $log->reminder_id = $reminderid;
            $log->datelog = $datelog;
            print "FormatDate: " . date("m") . " Date Log:" . $datelog . "\n";
            $log->save();
        }
    }
    function index() {
        $this->check_login();
        $this->data['objs'] = Reminder::populate();
        $this->data['hours'] = Common::gethours();
        $this->data['minutes'] = Common::getminutes();
        $this->data['menuFeed'] = "reminders";
        $this->data['periods'] = array('1' => 'Hourly', '2' => 'Daily', '3' => 'Weekly', '4' => 'Monthly', '5' => 'Yearly',);
        $this->load->view('adm/reminders/reminders', $this->data);
    }
    function check_login() {
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url() . 'index.php/adm/login');
        }
    }
    function save() {
        $params = $this->input->post();
        $obj = new Reminder();
        foreach ($params as $key => $val) {
            $obj->$key = $val;
        }
        $obj->save();
        echo $this->db->insert_id();
    }
    function sendmail($recipients, $subject, $content) {
        $config['smtp_host'] = $this->config->item("smtp_host");
        $usepadiport = false;
		if($usepadiport){
			$config['smtp_port']=$this->getmailport["outgoing"];
		}
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($this->config->item('developermail'),'PadiApp');
        $recpt = implode(",", $recipients);
        $this->email->to($recpt);
        $this->email->bcc($this->config->item('developermail'));
        $this->email->subject($subject);
        $this->email->message($content);
        $this->email->send();
    }
    function update() {
        $params = $this->input->post();
        $obj = new Reminder();
        $obj->where("id", $params["id"])->update($params);
        echo $obj->check_last_query();
    }
    function updateTroubleshootStatus(){
		$sql = 'update troubleshoot_requests set status="1" where date_format(solvedschedule,"%Y-%m-%d")<="'.$this->getCurrentTime().'" ';
		$sql.= 'and status="2"';
		$this->db->query($sql);
	}
	function alltroubleshootsolved(){
		$this->email->initialize(mailConfig());
		$sql = ' select c.kdticket,a.ticket_id,b.unsolved,troubleshootmailsent,c.clientname ';
		$sql.= 'from (select distinct ticket_id from troubleshoot_requests) a ';
		$sql.= ' left outer join (select ticket_id,count(status) unsolved ';
		$sql.= '  from troubleshoot_requests where status!=1  ';
		$sql.= '  group by ticket_id)b on a.ticket_id=b.ticket_id ';
		$sql.= 'left outer join tickets c on c.id=a.ticket_id ';
		$sql.= 'where unsolved is null and troubleshootmailsent ="0";';
		$query = $this->db->query($sql);
		echo $sql."<br />";
		foreach($query->result() as $row){
		$telegram_text = "Troubleshoot ".$row->clientname." sudah selesai, ticket dengan nomor ".$row->kdticket." siap ditutup";
			$mails = getticketmails($row->ticket_id);
			$tsmails = implode(",",$mails) ;
			echo "<br />".$tsmails."<br />";
			$this->email->from("support@padi.net.id");
			$this->email->to($tsmails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject($row->clientname.', Reminder Troubleshoot selesai ');
			$this->email->message(troubleshootFinishedTemplate($row->kdticket,$row->ticket_id));
			if ($this->email->send()){
				$sql = 'update tickets set troubleshootmailsent="1" where id='.$row->ticket_id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->kdticket." \n";
				sendtelegram("241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM","219513951",$telegram_text);
				exec("/home/klien/telegram/tg-send.sh @thueks 'Ticket ".$row->clientname.", kode ticket ".$row->kdticket." siap ditutup (PadiApp)'");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function getCurrentTime(){
		date_default_timezone_set('Asia/Jakarta');
		$date = date('m/d/Y h:i:s a', time());
		$date2 = date('Y-m-d h:i:s', time());
		$date3 = date('Y-m-d', time());
		return $date3;
	}
	function sendSurveyRequestMail(){
		$baseurl = $this->config->item("baseurl");
		echo "BASEURL ".$baseurl."\n";
		$this->email->initialize(mailConfig());
		$sql = "select a.id,a.client_site_id,c.name,a.createuser,a.sale_id,b.address,a.survey_date from survey_sites a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "where a.requestsent='0'";
		$query = $this->db->query($sql);
		foreach($query->result() as $row){
			$this->email->from($this->config->item('developermail'),'PadiApp');
			$mails = gettsmails($row->client_site_id);
			$salesmails = getuserrole($row->sale_id);
			array_push($salesmails,$this->config->item('sbysalesadmin'));
			$this->email->to($mails);
			$this->email->cc($salesmails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject($row->name.', Pengajuan Survey ');
			$this->email->message(surveyRequestTemplate($row->name,$row->createuser,$baseurl,$row->id));
			if ($this->email->send()){
				$sql = "update survey_sites set requestsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				$telegram_text = "Pengajuan Survey telah dibuat: ";
				$telegram_text.= $row->name.", \n";
				$telegram_text.= "Tanggal".$row->survey_date."\n\n";
				$telegram_text.= "Alamat " . $row->address."\n\n";
				$telegram_text.= "Sales: ".$row->createuser."  \n\nTautan Aplikasi : ";
				$telegram_text.= $baseurl."surveys/edit/".$row->id."\n\n(PadiApp)";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Pengajuan Survey telah dibuat: ".$row->name.", (".$row->survey_date.") \nAlamat ".$row->address."\n\nSales: ".$row->createuser."  \n\nTautan Aplikasi : ".$baseurl."surveys/edit/".$row->id."\n\n(PadiApp)'");
				sendtelegram("241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM","-101385876",$telegram_text);
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function sendSurveyResultMail(){
		$baseurl = $this->config->item("baseurl");
		echo "BASEURL ".$baseurl."\n";
		$this->email->initialize(mailConfig());
		$sql = "select a.id,a.client_site_id,c.name,group_concat(e.name) createuser,a.sale_id,f.username am, case d.resume when '1' then 'Dapat dilaksanakan' when '2' then 'Dapat dilaksanakan dengan syarat' when '3' then 'Tidak Dapat dilaksanakan' when '0' then 'Belum ada kesimpulan' end resu from survey_sites a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "left outer join survey_requests d on d.id=a.survey_request_id ";
		$sql.= "left outer join survey_surveyors e on d.id=e.survey_request_id ";
		$sql.= "left outer join users f on f.id=c.sale_id ";
		$sql.= "where a.resultsent='0'";
		$query = $this->db->query($sql);
		echo $sql . "<br />";
		foreach($query->result() as $row){
			echo "CLIENT SITE ID ".$row->client_site_id . "<br />";
			$this->email->from($this->config->item('developermail'),'PadiApp');
			$mails = gettsmails($row->client_site_id);
			$salesmails = getuserrole($row->sale_id);
			array_push($salesmails,$this->config->item('sbysalesadmin'));
			$this->email->to($mails);
			$this->email->cc($salesmails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject($row->name.', Hasil Survey ');
			$this->email->message(surveyResultTemplate($row->name,$row->createuser,$baseurl,$row->id,$row->resu,$row->am));
			if ($this->email->send()){
				$sql = "update survey_sites set resultsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				$telegram_text = "Hasil Survey: ".$row->name.", \n ".$row->resu."\n \nAM: ".$row->am.",TS: ".$row->createuser."  \n\nHasil Survey dapat dilihat pada tautan berikut ".$baseurl."surveys/edit/".$row->id." \n\n(PadiApp)";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Hasil Survey: ".$row->name.", \n ".$row->resu."\n \nAM: ".$row->am.",TS: ".$row->createuser."  \n\nHasil Survey dapat dilihat pada tautan berikut ".$baseurl."surveys/edit/".$row->id." \n\n(PadiApp)'");
				sendtelegram("241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM","-101385876",$telegram_text);
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function sendInstallRequestMail(){
		$baseurl = $this->config->item("baseurl");
		$this->email->initialize(mailConfig());
		$sql = "select a.id,c.name,a.createuser,a.client_site_id,c.sale_id,b.address,a.install_date from install_sites a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "where a.requestsent='0'";
		$query = $this->db->query($sql);
echo $sql;
		foreach($query->result() as $row){
			$salesmails = getmarketingmailarray($row->client_site_id);
print_r($salesmails);
			$this->email->from('support@padi.net.id','PadiApp');
			$mails = gettsmails($row->client_site_id);
			array_push($salesmails,$this->config->item('sbysalesadmin'));
			$this->email->to($mails);
			$this->email->cc($salesmails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject($row->name.', Pengajuan Install ');
			$this->email->message(installRequestTemplate($row->name,$row->createuser,$baseurl,$row->id));
			if ($this->email->send()){
				$sql = "update install_sites set requestsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				$telegram_text = "Sebuah Pengajuan Instalasi telah dibuat: \n".$row->name.", ";
				$telegram_text.= "Tanggal ".$row->install_date."\n\n";
				$telegram_text.= "\nAlamat ".$row->address."\n \n";
				$telegram_text.= "Sales: ".$row->createuser." \n\n";
				$telegram_text.= "Tautan Aplikasi dapat dilihat sbb: ".$baseurl."install_requests/install_edit/".$row->id."\n\n (PadiApp)";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Sebuah Pengajuan Instalasi telah dibuat: \n".$row->name.", (".$row->install_date.") \nAlamat ".$row->address."\n \nSales: ".$row->createuser." \n\nTautan Aplikasi dapat dilihat sbb: ".$baseurl."install_requests/install_edit/".$row->id."\n\n (PadiApp)'");
				sendtelegram("241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM","-101385876",$telegram_text);
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function showbaseurl(){
		echo $this->config->item("baseurl");
	}
	function sendInstallResultMail(){
		$baseurl = $this->config->item("baseurl");
		$this->email->initialize(mailConfig());
		$sql = "select a.id,c.name,a.createuser,a.client_site_id,c.sale_id,";
		$sql.= "case a.status when '0' then 'Belum selesai' when '1' then 'Sudah selesai' end resu ";
		$sql.= "from install_sites a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "where a.resultsent='0'";
		$query = $this->db->query($sql);
		echo $sql . "\n";
		foreach($query->result() as $row){
			$salesmails = getmarketingmailarray($row->client_site_id);
			$this->email->from('support@padi.net.id','PadiApp');
			$mails = gettsmails($row->client_site_id);
			array_push($salesmails,$this->config->item('sbysalesadmin'));
			$this->email->to($mails);
			$this->email->cc($salesmails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject($row->name.', Hasil Instalasi ');
			$this->email->message(installResulttTemplate($row->name,$row->createuser,$baseurl,$row->id,$row->resu,$row->client_site_id));
			if ($this->email->send()){
				$sql = "update install_sites set resultsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				$telegram_text = "Hasil Instalasi: ".$row->name.", \nkode  ".$row->resu."\n \nTS: ".$row->createuser." \n\nTautan Aplikasi dapat dilihat pada ".$baseurl."install_requests/install_edit/".$row->id." (PadiApp)";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Hasil Instalasi: ".$row->name.", \nkode  ".$row->resu."\n \nTS: ".$row->createuser." \n\nTautan Aplikasi dapat dilihat pada ".$baseurl."install_requests/install_edit/".$row->id." (PadiApp)'");
				sendtelegram("241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM","-101385876",$telegram_text);
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function sendNewTicketMail(){
		$padi_bot = $this->config->item('padibot');
		$bali_group = $this->config->item('bali_group_chatid');
		$malang_group = $this->config->item('malang_group_chatid');
		$jakarta_group = $this->config->item('jakarta_group_chatid');
		$surabaya_group = $this->config->item('surabaya_group_chatid');
		$baseurl = $this->config->item('baseurl');
		$this->email->initialize(mailConfig());
		foreach($this->preminder->newTicketMailGet() as $row){
			$mails = gettsmails($row->cid);
			$mymails = implode(",",$mails);
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to($mails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Ticket Baru '.$row->clientname);
			$this->email->message(ticketTemplate($row->clientname,$row->createuser,$baseurl,$row->id,$row->kdticket));
			if ($this->email->send()){
				$this->preminder->newTicketMailUpdate($row->id);
				$telegram_text = newtickettext($row->clientname,$row->sales,$row->kdticket,$row->complaint,$row->createuser,$baseurl,$row->id);
				if(in_array('ts@padi.net.id',$mails)){
					sendtelegram($padi_bot,$this->config->item('chat_id'),$telegram_text);		
				}
				if(in_array('ts-jkt@padi.net.id',$mails)){
					sendtelegram($padi_bot,$jakarta_group,$telegram_text);				
				}
				if(in_array('ts-mlg@padi.net.id',$mails)){
					sendtelegram($padi_bot,$malang_group,$telegram_text);				
				}
				if(in_array('ts-bali@padi.net.id',$mails)){
					sendtelegram($padi_bot,$bali_group,$telegram_text);				
				}
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function sendTrialReminder(){
		$baseurl = $this->config->item('baseurl');
		$this->email->initialize(mailConfig());
		$sql = "select a.*,c.name clientname from install_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "where a.withtrial='1' and trialremindersent='0'" ;
		$sql.= "and date(now())=date_sub(trial_periode2,interval 1 day);" ;
		$query = $this->db->query($sql);
		foreach($query->result() as $row){
			$usetsmail = false;
			if($usetsmail){
				$mails = gettsmails($row->client_site_id);
			}
			$mails = array("puji@padi.net.id");
			$mymails = implode(",",$mails);
			echo "MYMAILS : ".$mymails."<br />";
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to($mails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Trial Reminder '.$row->clientname);
			$this->email->message(endTrialTemplate($row->clientname,$row->createuser,$baseurl,$row->id,$row->id));
			if ($this->email->send()){
				$sql = "update install_requests set trialremindersent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "query=".$sql." \n";
				echo "send mail sukses, row->id=".$row->id." \n";
				exec("/home/klien/telegram/tg-send.sh @Pwprayitno 'Sebuah Reminder Trial baru telah dibuat:  ".$row->clientname." (PadiApp)'");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function sendCloseTicketMail(){
		$baseurl = $this->config->item('baseurl');
		$this->email->initialize(mailConfig());
		foreach($this->preminder->closeTicketGet() as $row){
			$mails = gettsmails($row->cid);
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to($mails);
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Notifikasi Ticket telah Ditutup ('.$row->clientname.')');
			$this->email->message(closeTicketTemplate($row->clientname,$row->username,$baseurl,$row->id,$row->kdticket));
			$solution = preg_replace("/<.*?>/", "", $row->solution);
			if ($this->email->send()){
				$sql = "update tickets set mailsent='3' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				$telegram_text = "Ticket atas nama: ".$row->clientname.",(AM:".$row->sales."), \nkode ticket ".$row->kdticket." telah ditutup . \nKeterangan ".$solution." \nTS: ".$row->createuser." \n\nTiket dapat dilihat pada tautan berikut ".$baseurl."tickets/filter/".$row->id."  &raquo;\n \n(PadiApp)";
				if(in_array('ts@padi.net.id',$mails)){
					sendtelegram($this->config->item('padibot'),$this->config->item('chat_id'),$telegram_text);				
				}
				if(in_array('ts-jkt@padi.net.id',$mails)){
					sendtelegram($this->config->item('padibot'),"-161183752",$telegram_text);				
				}
				if(in_array('ts-mlg@padi.net.id',$mails)){
					sendtelegram($this->config->item('padibot'),"-179062600",$telegram_text);				
				}
				if(in_array('ts-bali@padi.net.id',$mails)){
					sendtelegram($this->config->item('padibot'),"-149206255",$telegram_text);				
				}
				}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function printmails(){
		echo "tsmail";
		echo $this->config->item('tsmail');
		echo "\n";
	}
	function newTrial(){
		$baseurl = $this->config->item('baseurl');
		$sql ='select a.id,newtrialnotify ,a.startdate,a.enddate,c.name cln,d.username sls from trials a left outer join client_sites b on b.id=a.client_site_id left outer join clients c on c.id=b.client_id ';
		$sql.='left outer join users d on d.id=c.sale_id ';
		$sql.='where newtrialnotify in ("0");';
		$rows = $this->db->query($sql);
		foreach($rows->result() as $row){
			echo $row->id . "\n";
			$message = '';
			$message.= 'Sebuah Pengajuan Trial dari pelanggan '.$row->cln.' dengan rentang dari tanggal '.$row->startdate.' hingga '.$row->enddate.' ';
			$message=newTrialTemplate($row->cln,$row->sls,$baseurl,$row->id);
			$this->email->initialize(mailConfig());
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to(array($this->config->item('tsmail')));
			$this->email->cc($this->config->item('marketingmail'));
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Notifikasi Trial baru '.$row->cln);
			$this->email->message($message);
			if ($this->email->send()){
				$sql = "update trials set newtrialnotify='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Sebuah Pengajuan Trial atas nama ".$row->cln." , silakan ditindaklanjuti dengan tindakan sebagai berikut database.padinet.com/trials/edit/".$row->id."'");				
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function nearendTrial(){
		$sql = 'select a.id,a.startdate,a.enddate,date_sub(enddate,interval 2 day)remind,c.name cln,d.username sls from trials a ';
		$sql.= 'left outer join client_sites b on b.id=a.client_site_id left outer join clients c on c.id=b.client_id ';
		$sql.= 'left outer join users d on d.id=c.sale_id ';
		$sql.= 'where nearendnotify in ("0","3") ';
		$sql.= 'and date_format(date_sub(enddate,interval 1 day),"%Y-%m-%d")=date_format(now(),"%Y-%m-%d");';
		$rows = $this->db->query($sql);
		echo $sql."\n";
		foreach($rows->result() as $row){
			echo $row->id . '|';
			echo $row->startdate . '|';
			echo $row->enddate . '|';
			echo $row->remind . "\n";
			$this->email->initialize(mailConfig());
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to(array($this->config->item('tsmail')));
			$this->email->cc($this->config->item('marketingmail'));
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, reminder Trial '.$row->cln);
			$this->email->message(trialReminderTemplate($row->cln,$row->sls,$this->config->item('baseurl'),$row->id));
			if ($this->email->send()){
				$sql = "update trials set nearendnotify='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				switch($this->config->item('role')){
					case 'simulasi':
						$chatid = '219513951';
					break;
					case 'laptop':
						$chatid = '219513951';
					break;
					case 'database':
						$chatid = $this->config->item('chat_id');
					break;
					default:
						$chatid = $this->config->item('chat_id');
					break;
				}				
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$chatid."&text=Trial ".$row->cln." akan berakhir besok, silakan ditindaklanjuti dengan tindakan sebagai berikut database.padinet.com/trials/cancel/".$row->id."'");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function nearendTrial2(){
		$sql ='select a.id,a.startdate,a.enddate,date_sub(enddate,interval 15 minute)remind,c.name cln,d.username sls from trials a left outer join client_sites b on b.id=a.client_site_id left outer join clients c on c.id=b.client_id ';
		$sql.='left outer join users d on d.id=c.sale_id ';
		$sql.='where nearendnotify2 in ("0") ';
		$sql.='and date_sub(enddate,interval 15 minute)<=date_format(now(),"%Y-%m-%d %H:%i%s")';
		$sql.='and  enddate >date_format(now(),"%Y-%m-%d %H:%i%s")';
		$rows = $this->db->query($sql);
		echo $sql."\n";
		foreach($rows->result() as $row){
			echo $row->id . '|';
			echo $row->startdate . '|';
			echo $row->enddate . '|';
			echo $row->remind . "\n";
			$message = '';
			$message.= 'Trial dengan pelanggan '.$row->cln.' akan seger berakhir dalam 2 hari';
			$this->email->initialize(mailConfig());
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to(array($this->config->item('tsmail')));
			$this->email->cc($this->config->item('marketingmail'));
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, reminder Trial '.$row->cln);
			$this->email->message(trialReminderTemplate2($row->cln,$row->sls,$this->config->item('baseurl'),$row->id));
			if ($this->email->send()){
				$sql = "update trials set nearendnotify2='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				switch($this->config->item('role')){
					case 'simulasi':
						$chatid = '219513951';
					break;
					case 'laptop':
						$chatid = '219513951';
					break;
					case 'database':
						$chatid = $this->config->item('chat_id');
					break;
					default:
						$chatid = $this->config->item('chat_id');
					break;
				}
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$chatid."&text=Trial ".$row->cln." akan berakhir 15 menit lagi, silakan ditindaklanjuti dengan tindakan sebagai berikut database.padinet.com/trials/cancel/".$row->id."'");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function cancelTrial(){
		$sql ='select a.id,a.startdate,a.enddate,date_sub(enddate,interval 2 day)remind,c.name cln,d.username sls from trials a left outer join client_sites b on b.id=a.client_site_id left outer join clients c on c.id=b.client_id ';
		$sql.='left outer join users d on d.id=c.sale_id ';
		$sql.='where cancel = "1" and cancelsent="0" ;';
		$rows = $this->db->query($sql);
		echo $sql."\n";
		foreach($rows->result() as $row){
			echo $row->id . '|';
			echo $row->startdate . '|';
			echo $row->enddate . '|';
			echo $row->remind . "\n";
			$message = '';
			$message.= 'Trial dengan pelanggan '.$row->cln.' akan seger berakhir dalam 2 hari';
			$this->email->initialize(mailConfig());
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to(array($this->config->item('tsmail')));
			$this->email->cc($this->config->item('marketingmail'));
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Cancel Trial '.$row->cln);
			$this->email->message(trialCancelTemplate($row->cln,$row->sls,$this->config->item('baseurl'),$row->id));
			if ($this->email->send()){
				$sql = "update trials set cancelsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Trial ".$row->cln." telah dibatalkan, silakan kunjungi aplikasi padiApp sebagai berikut database.padinet.com/trials '");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function extendtrialotp(){
		$this->load->helper("otp");
		$this->load->helper("mailing");
		$sql = "select a.id,c.name from trials a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "where a.status=2 ";
		$que = $this->db->query($sql);
		$arr = array(
			"from"=>"support@padi.net.id",
			"to"=>"puji@padi.net.id",
			"subject"=>"PTO",
		);
		foreach($que->result() as $res){
			$otp = getotp();
			$sql = "update trials set otp='".$otp."' ";
			$sql.= "where id=".$res->id." ";
			$this->db->query($sql);
			$arr["message"] = "Dear Bpk, <br />";
			$arr["message"].= "Berikut OTP dari Trial <b>" . $res->name . "</b><br />";
			$arr["message"].= "<b>" . $otp . "</b><br /><br /><br />";
			$arr["message"].= "Regards <br /><br />";
			$arr["message"].= "PadiApp";
			$arr["subject"] = "[PadiApp] OTP " . $res->name;
			psendmail($arr);
		}
	}
	function extendTrial(){
		$sql ='select a.id,a.startdate,a.enddate,date_sub(enddate,interval 2 day)remind,c.name cln,a.extendreason,d.username sls from trials a left outer join client_sites b on b.id=a.client_site_id left outer join clients c on c.id=b.client_id ';
		$sql.='left outer join users d on d.id=c.sale_id ';
		$sql.='where extend = "1" and extendsent="0" ;';
		$rows = $this->db->query($sql);
		echo $sql."\n";
		foreach($rows->result() as $row){
			echo $row->id . '|';
			echo $row->startdate . '|';
			echo $row->enddate . '|';
			echo $row->remind . "\n";
			$this->email->initialize(mailConfig());
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to(array($this->config->item('tsmail')));
			$this->email->cc($this->config->item('marketingmail'));
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Extend Trial '.$row->cln);
			$this->email->message(trialExtendTemplate($row->cln,$row->sls,$this->config->item('baseurl'),$row->id,$row->extendreason));
			if ($this->email->send()){
				$sql = "update trials set extendsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Trial ".$row->cln." akan diperpanjang dengan alasan ".$row->extendreason.", silakan kunjungi aplikasi padiApp sebagai berikut ".$this->config->item("baseurl")."trials '");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function joinTrial(){
		$sql ='select a.id,a.startdate,b.id clientsiteid,a.enddate,date_sub(enddate,interval 2 day)remind,c.name cln,a.extendreason,d.username sls from trials a left outer join client_sites b on b.id=a.client_site_id left outer join clients c on c.id=b.client_id ';
		$sql.='left outer join users d on d.id=c.sale_id ';
		$sql.='where isjoin = "1" and joinsent="0" ;';
		$rows = $this->db->query($sql);
		echo $sql."\n";
		foreach($rows->result() as $row){
			echo $row->id . '|';
			echo $row->startdate . '|';
			echo $row->enddate . '|';
			echo $row->remind . "\n";
			$this->email->initialize(mailConfig());
			$this->email->from('support@padi.net.id','PadiApp');
			$this->email->to(array($this->config->item('tsmail')));
			$this->email->cc($this->config->item('marketingmail'));
			$this->email->bcc($this->config->item('developermail'));
			$this->email->reply_to($this->config->item('developermail'),"PadiApp");
			$this->email->subject('PadiApp, Permanen '.$row->cln);
			$this->email->message(trialJoinTemplate($row->cln,$row->sls,$this->config->item('baseurl'),$row->clientsiteid));
			if ($this->email->send()){
				$sql = "update trials set joinsent='1' where id=".$row->id;
				$qry = $this->db->query($sql);
				echo "send mail sukses, row->id=".$row->id." \n";
				exec("wget https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage --post-data 'chat_id=".$this->config->item('chat_id')."&text=Trial ".$row->cln." telah bergabung, untuk lebih jelasnya silakan kunjungi aplikasi padiApp sebagai berikut database.padinet.com/trials '");
			}else{
				echo $this->email->print_debugger();
			}
		}
	}
	function sendtelegram(){
		redirect("https://api.telegram.org/bot201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ/sendMessage?chat_id=-1001033491992&text=hi");
	}
	function cekorole(){
		echo getuserrole(14);
	}
	function sendtosales(){
		$sendwithconsole = false;
		if($sendwithconsole){
			exec("wget https://api.telegram.org/bot241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM/sendMessage --post-data 'chat_id=-101385876&text=padiNET '");
		}
		sendtelegram("241149002:AAFdZaIVDfWmu4L-A61k1myXfC5CcmUAgwM","-101385876","Alhamdulillah Ane sudah bisa :P");
	}
	function sendte(){
		$mails = array("2");
		if(in_array('2',$mails)){
			sendtelegram("297948070:AAFJZtoY7Rt16ImDwiAtFDmVYN3bCc4-YT8","219513951",$telegram_text);				
		}
		if(in_array('3',$mails)){
			sendtelegram("246021284:AAHtvukdRqp7LVg1XyZ30JTCPj3Y2NqCaCQ",$this->config->item('chat_id'),$telegram_text);				
		}
		if(in_array('4',$mails)){
			sendtelegram("292084960:AAFkrT_DjLl5ZcWGl9l7Rs4i0AwsPd0AwnE","219513951",$telegram_text);				
		}
	}
	function sendtelegrambyarea(){
		$mails = array("2");
		if(in_array('2',$mails)){
			sendtelegram("201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ","219513951",$telegram_text);				
		}
		if(in_array('3',$mails)){
			sendtelegram("201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ",$this->config->item('chat_id'),$telegram_text);				
		}
		if(in_array('4',$mails)){
			$COMMENT = "BALI";
			sendtelegram("201184174:AAH2Fy_3wS8A5KGi2cn468dtFCMJjhOqISQ","219513951",$telegram_text);				
		}		
	}
	function getMaintenances(){
		$sql = "select a.id,c.name,b.address,mdatetime,day(mdatetime)d,month(mdatetime)m,now() from maintenances a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id  ";
		$sql.= "left outer join maintenancereports d on d.maintenance_id=a.id ";
		$sql.= "where concat(year(mdatetime),'-',month(mdatetime),'-',day(mdatetime),' ',hour(mdatetime),':',minute(mdatetime)) <=now() ";
		$sql.= "and d.id is null ";
		echo "SELECTX SQL" . $sql . PHP_EOL;
		$qry = $this->db->query($sql);
		foreach($qry->result() as $res){
			echo $res->mdatetime . "\n";
			$insertsql = "insert into maintenancereports (maintenance_id,maintenancedate) values ('".$res->id."','".$res->mdatetime."') ";
			echo "INSERT SQL : " . $insertsql . "\n";
			$this->db->query($insertsql);
			$this->sendmail(array($this->config->item('tsmail')), '[PadiApp] Maintenance '.$res->name, maintenanceTemplate($res->id,$res->name));
			$updatesql = "update maintenancereports set status='1' where ";
		}
	}
}

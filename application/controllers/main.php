<?php
class Main extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		if(isset($this->session->userdata["role"])){
			switch($this->session->userdata["role"]){
				case "Administrator":
				redirect(base_url() . 'users');
				break;
				case "Sales":
				redirect(base_url() . 'clients');
				break;
				case "TS":
				redirect(base_url() . 'tickets');
				break;
				case "Accounting":
				redirect(base_url() . 'disconnections');
				break;
				case "CRO":
				redirect(base_url() . 'tickets');
				break;
			}
		}else{
			redirect(base_url() . "adm/chooseRole");
		}
	}
    function getotp($to){
        $config['mailtype']='html';
        $message = "OTP anda adalah 1234";
        $this->email->initialize($config);
        $this->email->from('puji@padi.net.id','PadiApp');
        $this->email->to($to);
        $this->email->bcc('puji@padi.net.id');
        $this->email->reply_to('puji@padi.net.id',"PadiApp");
        $this->email->subject('OTP Request');
        $this->email->message($message);
        return $this->email->send();
    }
    function sendotp(){
        $this->getotp('628813272107@sms.padinet.com');
    }}

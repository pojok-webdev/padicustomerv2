<?php
use Auth0\SDK\Auth0;
class Authzero extends CI_Controller{
    var $az;
    function __construct(){
        parent::__construct();
        $this->load->model('Auth_zero');
        $this->az = new Auth_zero();
    }
    function index(){
        $data = array(
            'userInfo'=>$this->az->getuser()//$userInfo
        );
        $this->load->view('authzero/userinfo',$data);
    }
    function welcome(){
        $data = array(
            'userInfo'=>$this->az->getuser()//$userInfo
        );
        $this->load->view('authzero/welcome',$data);
    }
    function login(){
        $this->load->view('authzero/login');
    }
    function logout(){
        $this->load->view('authzero/logout');
    }
}
<?php
Class Superuser extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $data = array();
        $this->load->view('Superuser/buttons',$data);
    }
}
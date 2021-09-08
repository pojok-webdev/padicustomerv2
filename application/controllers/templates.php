<?php
class Templates extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function popup(){
        $this->load->view('templates/pagepopup/popup');
    }
}
<?php
class Padicron extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('pfbs');
    }
    function AutoUpdateExpiredFB(){
        echo $this->pfbs->setAutoExpired();
    }
    function printcampret(){
        echo 'camprettt';
    }
}
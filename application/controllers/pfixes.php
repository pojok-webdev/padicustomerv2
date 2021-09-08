<?php
class Pfixes extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function createinstall(){
        $fixer = new Pfix();
        $client_id = $this->uri->segment(3);
        $fixer->createinstall($client_id);
    }
}
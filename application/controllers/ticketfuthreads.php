<?php
Class Ticketfuthreads extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('ticketfuthread');
    }
    function index(){
        $data = array(
            'menuFeed'=>'ticketfuthread',
            'username'=>$this->session->userdata['username']
        );
        $this->load->view('ticketfuthreads/index',$data);
    }
    function kdticketsearch(){
        $params = $this->input->post();
        $result = $this->ticketfuthread->searchticketbykdticket($params['kdticket']);
        echo json_encode($result['res']);
    }
    function clientnamesearch(){
        $params = $this->input->post();
        $result = $this->ticketfuthread->searchticketbyclientname($params['clientname']);
        echo json_encode($result['res']);
    }
    function getfus(){
        $ticketid = $this->uri->segment(3);
        $result = $this->ticketfuthread->getfus($ticketid);
        echo json_encode($result['res']);
    }
}
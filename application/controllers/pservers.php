<?php
class Pservers extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('pserver');
    }
    function getbyid(){
        $serverid = $this->uri->segment(3);
        echo json_encode($this->pserver->getbyid($serverid));
    }
    function index(){
        $data = array(
            'menuFeed'=>'servers',
            'objs'=>$this->pserver->gets()
        );
        $this->load->view('adm/servers',$data);
    }
    function save(){
        $params = $this->input->post();
        echo $this->pserver->save($params);
    }
    function remove(){
        $serverid = $this->uri->segment(3);
        echo $this->pserver->remove($serverid);
    }
    function update(){
        $params = $this->input->post();
        echo $this->pserver->update($params);
    }
}
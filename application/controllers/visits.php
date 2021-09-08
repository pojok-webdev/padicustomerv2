<?php
class Visits extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("visit");
    }
    function add(){
        $objs = $this->visit->getclientstovisit();
        $data = array(
            'objs'=>$objs['res'],
            'title'=>'PadiNET | Daftar Pelanggan untuk Visit',
        );
        $this->load->view("Sales/visits/clientstovisit",$data);
    }
    function preview(){
        $obj = $this->visit->getclient($this->uri->segment(3));
        $data = array(
            'obj'=>$obj
        );
        $this->load->view("Sales/visits/formvisitpreview",$data);
    }
    function save($params){
        echo $this->visit->save($params);
    }
    function update($params){
        echo $this->visit->update($params);
    }
    function fsave(){
        $params = $this->input->post();
        $this->save($params);
        redirect('/dashboards/sales');
    }
    function fupdate(){
        $params = $this->input->post();
        $this->update($params);
        redirect('/dashboards/sales');
    }
    function index(){
        $objs = $this->visit->gets();
        $data = array(
            'objs'=>$objs['res'],
            'title'=>'PadiNET | Daftar Visit',
        );
        $this->load->view("Sales/visits/index",$data);
    }
}
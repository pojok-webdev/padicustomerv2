<?php
class Tsdashboards extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->load->model('pticket');
        $categories = $this->pticket->get_ticketcausecategory_combodata();
        $ticketclosedinday = $this->pticket->getfilteredticketsinday(1);
        $data = array(
            'menuFeed'=>'tsdashboard',
            'categories'=>$categories['res'],
            'ticketclosedinday'=>$ticketclosedinday['cnt']
        );
        $this->load->view('tsdashboard/index',$data);
    }
    function ticketbycauseidindaydetail(){
        $categories =$this->uri->segment(3);
        $branch_id = $this->uri->segment(4);
        $dt = $this->uri->segment(5);
        $catarray = explode("-",$categories);
        $categoryarray = implode("','",$catarray);
        $this->load->model('pticket');
        $details = $this->pticket->getticketbycategoryarraybranchlyinday($categoryarray,$branch_id,$dt);
        $data = array(
            'menuFeed'=>'dashboard detail',
            'details'=>$details['res']
        );
        $this->load->view('tsdashboard/detail',$data);
    }
    function getticketbycategoryarrayinweek(){
        $categories = $this->uri->segment(3);
        $branch_id = $this->uri->segment(4);
        $catarray = explode("-",$categories);
        $categoryarray = implode("','",$catarray);
        $this->load->model('pticket');
        $details = $this->pticket->getticketbycategoryarraybranchlyinweek($categoryarray,$branch_id);
        $data = array(
            'menuFeed'=>'dashboard detail',
            'details'=>$details['res']
        );
        $this->load->view('tsdashboard/detail',$data);
    }
    function getticketbycategoryarrayinmonth(){
        $categories = $this->uri->segment(3);
        $branch_id = $this->uri->segment(4);
        $catarray = explode("-",$categories);
        $categoryarray = implode("','",$catarray);
        $this->load->model('pticket');
        $details = $this->pticket->getticketbycategoryarraybranchlyinmonth($categoryarray,$branch_id);
        $data = array(
            'menuFeed'=>'dashboard detail',
            'details'=>$details['res']
        );
        $this->load->view('tsdashboard/detail',$data);
    }
    function jsonticketsinday(){
        $dt = $this->uri->segment(3);
        $this->load->model('pticket');
        $temp = $this->pticket->getticketsratioinday($dt);
        echo json_encode($temp['res']);
    }
    function jsonticketsinweek(){
        $dt = $this->uri->segment(3);
        $this->load->model('pticket');
        $temp = $this->pticket->getticketsratioinweek();
        echo json_encode($temp['res']);
    }
    function jsonticketsinmonth(){
        $dt = $this->uri->segment(3);
        $this->load->model('pticket');
        $temp = $this->pticket->getticketsratioinmonth();
        echo json_encode($temp['res']);
    }
    function jsonticketsperbranchinday(){
        $this->load->model('pticket');
        $branch_id = $this->uri->segment(4);
        $dt = $this->uri->segment(3);
        $temp = $this->pticket->getticketsperbranchinday($dt);
        echo json_encode($temp['res']);
    }
    function jsonticketsperbranchinweek(){
        $this->load->model('pticket');
        $temp = $this->pticket->getticketsperbranchinweek();
        echo json_encode($temp['res']);
    }
    function jsonticketsperbranchinmonth(){
        $this->load->model('pticket');
        $temp = $this->pticket->getticketsperbranchinmonth();
        echo json_encode($temp['res']);
    }
    function getticketscategoryratioinday(){
        $this->load->model('pticket');
        $dt = $this->uri->segment(3);
        $temp = $this->pticket->getticketscategoryratioinday($dt);
        echo json_encode($temp['res']);
    }
    function getticketscategoryratioinweek(){
        $this->load->model('pticket');
        $dt = $this->uri->segment(3);
        $temp = $this->pticket->getticketscategoryratioinweek();
        echo json_encode($temp['res']);
    }
    function getticketscategoryratioinmonth(){
        $this->load->model('pticket');
        $dt = $this->uri->segment(3);
        $temp = $this->pticket->getticketscategoryratioinmonth();
        echo json_encode($temp['res']);
    }
    function getdailyticket(){
        $dt = $this->uri->segment(3);
        $this->load->model('pticket');
        $daily = $this->pticket->getdailyclientcategorytickets($dt);
        echo json_encode($daily);
    }
    function getweeklyticket(){
        $this->load->model('pticket');
        $daily = $this->pticket->getweeklyclientcategorytickets();
        echo json_encode($daily);
    }
    function getmonthlyticket(){
        $this->load->model('pticket');
        $daily = $this->pticket->getmonthlyclientcategorytickets();
        echo json_encode($daily);
    }
    function getpar(){
        $params = $this->input->post();
        print_r($params);
        //echo "\n";
       // echo "'".implode("','",$params['cats'])."'";
        //echo "\n";
    }
    function getdailytroubleshoots(){
        #sample curl:
        #curl   http://teknis/cascades/getpar -d 'dt=2019-08-1&cats[1]=1&cats[2]=2&cats[3]=3'
        $params = $this->input->post();
        $dt = $params['dt'];
        $cats = $params['cats'];
        $this->load->model('pticket');
        $daily = $this->pticket->getdailytroubleshoots($dt,$cats);
        echo json_encode($daily);
    }
    function getweeklytroubleshoots(){
        $this->load->model('pticket');
        $params = $this->input->post();
        $cats = $params['cats'];
        $daily = $this->pticket->getweeklytroubleshoots($cats);
        echo json_encode($daily);
    }
    function getmonthlytroubleshoots(){
        $this->load->model('pticket');
        $params = $this->input->post();
        $cats = $params['cats'];
        $daily = $this->pticket->getmonthlytroubleshoots($cats);
        echo json_encode($daily);
    }
    function getticketbycategoryinday(){
        $this->load->model('pticket');
        $res = $this->pticket->getticketbycategoryinday(1);
        echo json_encode($res);
    }
    function getticketbycategoryarrayinday(){
        $categories = $this->uri->segment(3);
        $catarray = explode("-",$categories);
        $categoryarray = implode("','",$catarray);
        $this->load->model('pticket');
        $res = $this->pticket->getticketbycategoryarrayinday($categoryarray);
        echo json_encode($res);
    }
    function getticketscategorydetailinday(){
        $this->load->model('pticket');
        $category = $this->uri->segment(4);
        $objs = $this->pticket->getticketscategorydetailinday($this->uri->segment(3),$category);
//        print_r($objs);
        echo json_encode($objs);
    }
}
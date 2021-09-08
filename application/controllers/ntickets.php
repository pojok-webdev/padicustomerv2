<?php
class Ntickets extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->setting = $this->common->get_web_settings();
        $this->load->model('nticket');
        $this->load->library('common');
		if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
		}
    }
    function index(){
        $segment = $this->uri->segment(3,0);
        $offset = $this->uri->segment(4,10);
        $objs = $this->nticket->gets($segment,$offset);
        $prev = ($segment>$offset)?$segment-$offset:0;
        $next = ($segment+$offset<100)?$segment+$offset:0;
        $this->common->check_login();
        $data = array(
            'objs'=>$objs['res'],
            'menuFeed'=>'tickets',
            'segment'=>$segment,
            'offset'=>$offset,
            'prev'=>$prev,
            'next'=>$next
        );
        $this->load->view('new/tickets/index',$data);
    }
    function ajax(){
        $segment = $this->uri->segment(3,0);
        $offset = $this->uri->segment(4,10);
        $objs = $this->nticket->gets($segment,$offset);
        $prev = ($segment>$offset)?$segment-$offset:0;
        $next = ($segment+$offset<100)?$segment+$offset:0;
        $this->common->check_login();
        $data = array(
            'objs'=>$objs['res'],
            'menuFeed'=>'tickets',
            'segment'=>$segment,
            'offset'=>$offset,
            'prev'=>$prev,
            'next'=>$next
        );
        $this->load->view('new/tickets/ajax',$data);
    }
    function source(){
        $segment = $this->uri->segment(3,0);
        $offset = $this->uri->segment(4,10);
        $out = $this->nticket->gets("null","null");
        $tmparr = array();
        foreach($out['res'] as $row){
            $str = '["'.$row->kdticket.'",';
            $str.= '"'.$row->clientname.'",';
            $str.= '"'.$row->age.'",';
            $str.= '"'.$row->address.'",';
            $str.= '"'.$row->category.'",';
            $str.= '"'.$row->ticketstatus.'",';
            $str.= '"service",';
            $str.= '"'.$row->vas.'"]';
            array_push($tmparr,$str);
        }
        echo '{"aaData":['.implode(",",$tmparr). ']}';
    }
}
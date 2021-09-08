<?php
class Psites extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('psite');
        $this->load->model('service');
    }
    function index(){
        $data = array(
            'menuFeed'=>'Sites',
            'formlabel'=>'Sites',
            'breadcrumb'=>array('0'=>'Sites','1'=>'List'),
            'objs'=>$this->psite->gets(),
            'vases'=>$this->vas->get_combo_data('Pilihlah'),
            'servicecategory'=>$this->service->get_combo_data(false,'Pilihlah','Custom'),
            'smartvalues'=>$this->pfbs->getsmartvalues(),
            'businesses'=>$this->pfbs->getbusinesses(),
            'values' => padi_getvaluesarray(0,100),
            'pc'=>$this->pfbs->getpc()
        );
        $this->load->view('psites/index',$data);
    }
    function savevas(){
        $this->psite->savevas($this->uri->segment(3),$this->uri->segment(4));
        echo $this->uri->segment(3) . " and " . $this->uri->segment(4);
    }
    function saveservice(){
        $params = $this->input->post();
        echo $this->psite->saveservice($params);
    }
}
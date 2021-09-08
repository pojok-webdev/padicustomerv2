<?php
Class Troubleshootfus extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('troubleshootfu');
    }
    function index(){
        padi_checklogin();
        $troubleshoot_id = $this->uri->segment(3);
        $fus = $this->troubleshootfu->getfus($troubleshoot_id);
        $data = array(
            'menuFeed'=>'troubleshootfus',
            'breadcrumb'=>array(0=>array('title'=>'Troubleshoot','url'=>'/troubleshoots'),1=>'Follow Up'),
            'fu_id'=>$troubleshoot_id,
            'troubleshoot'=>$this->troubleshootfu->gettroubleshoot($troubleshoot_id),
            'fus'=>$fus['res'],
        );
        $this->load->view('TS/troubleshoot_fus/index',$data);
    }
    function add(){
        padi_checklogin();
        $troubleshoot_id = $this->uri->segment(3);
        $troubleshoot = $this->troubleshootfu->gettroubleshoot($troubleshoot_id);
        $data = array(
            'menuFeed'=>'troubleshootfus',
            'troubleshoot_id'=>$troubleshoot_id,
            'breadcrumb'=>array(
                0=>array('title'=>'Troubleshoot FU','url'=>'/troubleshootfus/index/'.$troubleshoot_id.''),
                1=>'Follow Up Images'
            ),
        );
        $this->load->view('TS/troubleshoot_fus/add',$data);
    }
    function fu(){
        padi_checklogin();
        $fu_id = $this->uri->segment(3);
        $fus = $this->troubleshootfu->getfuimages($fu_id);
        $troubleshoot = $this->troubleshootfu->gettroubleshootbyfu($fu_id);
        $data = array(
            'menuFeed'=>'troubleshootfus',
            'breadcrumb'=>array(
                0=>array('title'=>'Troubleshoot FU','url'=>'/troubleshootfus/index/'.$troubleshoot->troubleshoot_id.''),
                1=>'Follow Up Images'
            ),
            'troubleshoot_id'=>$troubleshoot->troubleshoot_id,
            'fu_id'=>$fu_id,
            'fus'=>$fus['res'],
            'fu'=>$this->troubleshootfu->getfu($fu_id)
        );
        $this->load->view('TS/troubleshoot_fus/fu',$data);
    }
    function savepicture(){
        $params = $this->input->post();
        echo json_encode($this->troubleshootfu->savepicture($params));
    }
    function updatefu(){
        $params = $this->input->post();
        echo json_encode($this->troubleshootfu->updatefu($params));
    }
    function savefu(){
        $params = $this->input->post();
        echo json_encode($this->troubleshootfu->savefu($params));
    }
    function removeimage(){
        $params = $this->input->post();
        echo json_encode($this->troubleshootfu->removeimage($params));
    }
    function updatepicture(){
        $params = $this->input->post();
        echo json_encode($this->troubleshootfu->updatepicture($params));
    }
    function getimage(){
        $id = $this->uri->segment(3);
        echo '<img width="800px" src='.$this->troubleshootfu->getimage($id).'>';
    }
    function removefu(){
        $id = $this->uri->segment(3);
        echo $this->troubleshootfu->removefu($id);
    }
}
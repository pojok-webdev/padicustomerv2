
<?php
class Pclientgroups extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('pclientgroup');
    }
    function edit(){
        $this->common->check_login();
        $id = $this->uri->segment(3);
        $data = array(
            'menuFeed'=>'Clientgroup',
            'obj'=>$this->pclientgroup->get($id)
        );
        $this->load->view('Sales/clientgroups/edit',$data);
    }
    function get(){
        $id = $this->uri->segment(3);
        $obj = $this->pclientgroup->get($id);
        echo '{"name":"'.$obj->name.'","description":"'.$obj->description.'"}';
    }
    function index(){
        $this->common->check_login();
        $objs = $this->pclientgroup->gets();
        $data = array(
            'menuFeed'=>'Clientgroup',
            'objs'=>$objs['res'],
        );
        $this->load->view('Sales/clientgroups/index',$data);
    }
    function removeclient(){
        $clientgroupid = $this->uri->segment(3);
        $clientid = $this->uri->segment(4);
        echo $this->pclientgroup->removeclient($clientgroupid,$clientid);
    }
    function save(){
        $this->common->check_login();
        $params = $this->input->post();
        $params["createuser"] = $this->session->userdata("username");
        $this->pclientgroup->save($params);
    }
    function saveclient(){
        $this->common->check_login();
        $params = $this->input->post();
        $params["createuser"] = $this->session->userdata("username");
        echo $this->pclientgroup->saveclient($params);        
    }
    function update(){
        $params = $this->input->post();
        echo $this->pclientgroup->update($params);
    }
    function viewdetail(){
        $id = $this->uri->segment(3);
        $name_ = $this->pclientgroup->getname($id);
        $name = ($name_!=false)?$name_:'';
        $objs = $this->pclientgroup->getdetail($id);
        $data = array(
            'objs'=>$objs['res'],
            'menuFeed'=>'ClientGroupDetail',
            'name'=>$name,
            'clientgroup_id'=>$id,
        );
        $this->load->view('Sales/clientgroups/details',$data);
    }
    function dataFeed2(){
        echo $this->pclient->getclients3();
    }
    function dataFeed(){
        //echo $this->pclients->getclients3();
        $data = '[ ';
        $data.= '    {"name": "Afghanistan", "code": 1}, ';
        $data.= '    {"name": "Englishtan", "code": 2}, ';
        $data.= '    {"name": "Albanistan", "code": 3}, ';
        $data.= '    {"name": "Algeristan", "code": 4}, ';
        $data.= '    {"name": "Ameristan Samoa", "code": 5},';
        $data.= '    {"name": "Indonestan", "code": 6}';
        $data.= '   ]';
        echo $data;
    }
}
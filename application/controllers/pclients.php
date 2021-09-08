<?php
class Pclients extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("style");
    }
    function categories(){
        $objs = $this->pclient->getclientcategory();
        $data = array(
            'objs'=>$objs['res']
        );
        $this->load->view('Sales/Clients/clientcategories',$data);
    }
    function downloadvisitform(){
        $this->load->view("Sales/Clients/formvisit");
    }
    function downloadvisitformpreview(){
        $this->load->view("Sales/Clients/formvisitpreview");
    }
    function getclients(){
        $this->load->model("pclient");
        $objs = $this->pclient->getclient();
        $arr = array();
        foreach($objs as $obj){
            array_push($arr,'"'.$obj->id.'":"'.$obj->name.'"');
        }
        echo '{' . implode(',',$arr). '}';
    }
    function getclients2(){
        $this->load->model("pclient");
        $objs = $this->pclient->getclient2();
        $arr = array();
        foreach($objs as $obj){
            array_push($arr,'"'.$obj->id.'":{"name":"'.$obj->name.'","address":"'.$obj->address.'"}');
        }
        echo '{' . implode(',',$arr). '}';
    }
    function getclients3(){
        $this->load->model("pclient");
        $objs = $this->pclient->getclient2();
        $arr = array();
        foreach($objs as $obj){
            array_push($arr,'{"id":"'.$obj->id.'","name":"'.$obj->name.'","address":"'.$obj->address.'"}');
        }
        echo '[' . implode(',',$arr). ']';
    }
    function getclientbyid(){
        $id = $this->uri->segment(3);
        $this->load->model("pclient");
        $objs = $this->pclient->getclientbyid($id);
        $arr = array();
//        print_r($objs);
//        echo $objs["id"]. "" . $objs["name"]."<br /><br /><br /><br />";
        foreach($objs as $key=>$val){
            //array_push ($arr,"'".$key."':'".$val."'");
            array_push ($arr,'"'.$key.'":"'.$val.'"');
//            array_push($arr,'"'.$obj["id"].'":{"name":"'.$obj['name'].'","address":"'.$obj['address'].'"}');
        }
        echo '{' . implode(',',$arr). '}';
    }
    function index(){
        $data = array("menuFeed"=>"v2.0");
        $this->load->view("v2/clients/index",$data);
    }
    function feed(){
        $term = $_GET[ "term" ];
        $this->load->model("pclient");
        $objs = $this->pclient->getclient();
        $arr = array();
        foreach($objs as $obj){
            array_push($arr,array("label"=>$obj->name,"value"=>$obj->id));
        }
        $companies = $arr;
        $result = array();
        foreach ($companies as $company) {
            $companyLabel = $company[ "label" ];
            if ( strpos( strtoupper($companyLabel), strtoupper($term) )!== false ) {
                array_push( $result, $company );
            }
        }
        echo json_encode( $result );
    }
    function feedbyclient(){
        $term = $_GET[ "term" ];
        $this->load->model("pclient");
        $objs = $this->pclient->getclientbysales();
        $arr = array();
        foreach($objs as $obj){
            array_push($arr,array("label"=>$obj->name,"value"=>$obj->id));
        }
        $companies = $arr;
        $result = array();
        foreach ($companies as $company) {
            $companyLabel = $company[ "label" ];
            if ( strpos( strtoupper($companyLabel), strtoupper($term) )!== false ) {
                array_push( $result, $company );
            }
        }
        echo json_encode( $result );
    }
    function update(){
        $params = $this->input->post();
        echo $this->pclient->update($params);
    }
}//
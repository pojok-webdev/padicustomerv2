<?php
class Offers extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('offer');
    }
    function save($params){
        $this->offer->save($params);
    }
    function update($params){
        $this->offer->update($params);
    }
    function getsales(){
        print_r (json_decode(json_encode($this->offer->getsales())));
    }
    function fsave(){
        $params = $this->input->post();
        print_r($params);
//        $this->offer->saveservices($params['serviceName'],$params['servicePrice']);
        $this->save($params);
        redirect('/dashboards/sales');
    }
    function fupdate(){
        $params = $this->input->post();
        print_r($params);
        $this->update($params);
        redirect('/dashboards/sales');
    }
    function getservices(){
        $offer_id = $this->uri->segment(3);
        $services = $this->offer->getservicesbyofferid($offer_id);
        echo json_encode($services);
    }
    function remove(){
        $id = $this->uri->segment(3);
        echo $this->offer->remove($id);
    }
}
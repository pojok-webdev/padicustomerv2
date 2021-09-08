<?php
    $data;
    Class Pricelistproducts extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('pricelistproduct');
        $this->load->model('pricelistsservice');
        if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
		}
    }
    function index(){
        $this->check_login();
        $this->data['objs'] = $this->pricelistproduct->gets();
        $this->data['categories'] = $this->pricelistsservice->getCategories();
        $this->data['menuFeed'] = 'pricelistproduct';
        $this->load->view('pricelists/products/index',$this->data);
    }
    function getajaxsource($objs){
        $arr = array();
        foreach($objs['res'] as $obj){
            array_push($arr,'[
                "'.$obj->product_id.'",
                "'.$obj->name.'",
                '.$obj->price.',
                "'.number_format($obj->price).'",
                '.$obj->discount.',
                "'.number_format($obj->discount).'",
                "'.$obj->description.'",
                "'.$obj->unit.'"
              ]');
        }
        return '{"aaData": ['. implode(",",$arr).']}';
    }
    function ajaxsource(){
        $objs = $this->pricelistproduct->gets();
        echo $this->getajaxsource($objs);
    }
    function ajaxsourcebycategories(){
        $params = $this->input->post();
        $objs = $this->pricelistproduct->getsbycategory($params['category_id']);
        echo $this->getajaxsource($objs);
    }
    function testgetsbycategory(){
        $params = $this->input->post();
        echo $this->pricelistproduct->getsbycategory($params['category']);
    }
    function clients(){
        $params = $this->input->post();
        $this->load->model('client');
        $objs = $this->client->getbyname($params['name']);
        $out = '<ul id="country-list">';
        foreach($objs['res'] as $obj){
            $out.= '<li onClick="selectCountry(\''.$obj->id.'\',\''.$obj->name.'\')">'.$obj->name.'</li>';
        }
        $out.= '</ul>';
        echo $out;
    }
    function getclientsites(){
        $client_id = $this->uri->segment(3);
        $this->load->model('client');
        $objs = $this->client->getClientSiteByClientId($client_id);
        $out = '<ul id="sites">';
        foreach($objs['res'] as $obj){
            $out.= '<li>'.$obj->address.'</li>';
        }
        $out.= '</ul>';
    }
    function check_login(){
		if(!$this->ion_auth->logged_in()){
			redirect(base_url() . 'index.php/adm/login');
		}
	}
}
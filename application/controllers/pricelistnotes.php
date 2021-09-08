<?php
Class Pricelistnotes extends CI_Controller{
    var $data;
    function __construct(){
        parent::__construct();
        $this->load->model('pricelistnote');
        $this->load->model('pricelistsservice');
        if($this->ion_auth->logged_in()){
			$this->ionuser = $this->ion_auth->user()->row();
			$this->data['user'] = $this->user->get_user_by_id($this->ionuser->id);
		}
    }
    function index(){
        $this->check_login();
        $this->data['objs'] = $this->pricelistnote->gets();
        $this->data['categories'] = $this->pricelistsservice->getCategories();
        $this->data['menuFeed'] = 'pricelistsnote';
        $this->load->view('pricelists/notes/index',$this->data);
    }
    function getajaxsource($objs){
        $arr = array();
        foreach($objs['res'] as $obj){
            array_push($arr,'[
                '.$obj->id.',
                "<h5>'.$obj->name.'</h5>"
              ]');
        }
        return '{"aaData": ['. implode(",",$arr).']}';
    }
    function ajaxsource(){
        $objs = $this->pricelistnote->gets();
        echo $this->getajaxsource($objs);
    }
    function ajaxsourcebycategories(){
        $params = $this->input->post();
        $objs = $this->pricelistnote->getsbycategory($params['category_id']);
        echo $this->getajaxsource($objs);
    }
    function check_login(){
		if(!$this->ion_auth->logged_in()){
			redirect(base_url() . 'index.php/adm/login');
		}
	}

}
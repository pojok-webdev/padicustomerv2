<?php
class Fbs extends CI_Controller{
	var $ionuser;
	function __construct(){
		parent::__construct();
		$this->load->helper('subscription');
		$this->load->model('report');
		if ($this->ion_auth->logged_in()) {
			$this->ionuser = $this->ion_auth->user()->row();
			$user = new User();
			$this->data['user'] = $user->get_user_by_id($this->ionuser->id);
		}
	}
	function index(){
		$data = array('menuFeed'=>'Fbs');
		$this->load->view('Sales/fbs/fbs',$data);
	}
	function get(){
		$arr = array();$arr2 = array();
		$objs = new Fb();
		$objs->get();
		$fields = $this->db->list_fields('fbs');
		foreach($objs as $obj){			
			foreach($fields as $field){
				array_push($arr, '"' . $field . '":"' . $obj->$field . '"'); 
			}
			$str = implode(',',$arr);
			array_push($arr2,'{'.$str.'}');
		}
		$str2 = implode(',',$arr2);
		echo '{"obj":['.$str2.']}';
	}
	function isexist($client_site_id){
		$obj = new Fb();
		$obj->where('completed','0')->where('client_site_id',$client_site_id)->get();
		if($obj->result_count()>0){
			return true;
		}
		return false;
	}
	function saveupdate(){
		$params = $this->input->post();
		if(!array_key_exists('nofb',$params) ){
			$params['nofb'] = generatefb($params['client_id']);
		}
		$keys = array();$vals = array();$pair = array();
		foreach($params as $key=>$val){
			array_push($keys,$key);
			$val = str_replace("'","''",$val);
			array_push($vals,$val);
			array_push($pair,"".$key." = '".$val."'");
		}
		$sql = "insert into fbs ";
		$sql.= "(".implode(",",$keys).")";
		$sql.= "values ";
		$sql.= "('".implode("','",$vals)."')";
		$sql.= "on duplicate key update ".implode(",",$pair);
		$this->db->query($sql);
		echo $params['nofb'];		
	}
	function updatefbdescription(){
		$params = $this->input->post();
		$sql = 'update fbs set description="'.$params['description'].'" ';
		$sql.= 'where nofb="'.$params['nofb'].'"';
		$this->db->query($sql);
	}
	function save($params){
		$obj = new Fb();
		foreach($params as $key=>$val){
			$obj->$key = $val;
		}
		$obj->save();
		return $this->db->insert_id();
	}
	function update($params){
		$obj = new Fb();
		//$obj->where('client_id',$params['client_id'])->where('id',$params['id'])->update($params);
		$obj->where('id',$params['id'])->update($params);
		echo $obj->check_last_query();
	}
    function hal1(){
        $nofb = $this->uri->segment(3);
		$fbs = $this->report->getdata($nofb);
		switch($fbs->accounttype){
			case '0':
			$newaccountchecked = 'checked="checked"';
			$existingaccountchecked = '';
			break;
			case '1':
			$newaccountchecked = '';
			$existingaccountchecked = 'checked="checked"';
			break;
		}
		$corporatecheckbox = '';
		$personalcheckbox = '';
		$gameonlinecheckbox = '';
		$othercheckbox = '';
		$pfbs = new Pfbs();
		switch($fbs->businesstype){
			case 'Corporate':
			$corporatecheckbox = 'checked="checked"';
			break;
			case 'Game On Line':
			$gameonlinecheckbox = 'checked="checked"';
			break;
			case 'Perorangan':
			$personalcheckbox = 'checked="checked"';
			break;
			default:
			$othercheckbox = 'checked="checked"';
			break;
		}
		$documents = $this->pfbs->getdocumentarray();
		$fbdocuments = $pfbs->getdocuments($nofb);
		$documentstatus = array();
        $str = "";
        foreach($documents as $doc){
            $match = false;
            foreach($fbdocuments as $fbdoc){
                if(strtolower($doc)===strtolower($fbdoc->documentname)){
                    $match = true;
                }else{
                }
            }
            if($match){
                $status = '&#8864';
            }else{
                $status = '&#9633';
            }
            $documentstatus[$doc] = $status;
        }

        $data = array(
			'corporatecb'=>$corporatecheckbox,
			'gamecb'=>$gameonlinecheckbox,
			'personalcb'=>$personalcheckbox,
			'othercb'=>$othercheckbox,
			'newaccountchecked'=>$newaccountchecked,
			'existingaccountchecked'=>$existingaccountchecked,
            'nofb'=>$fbs->nofb,
            'name'=>$fbs->name,
			'address'=>$fbs->address,
			'billaddress'=>$fbs->billaddress,
            'siup'=>$fbs->siup,
			'npwp'=>$fbs->npwp,
			'sppkp'=>$fbs->sppkp,
            'telp'=>$fbs->telp,
			'fax'=>$fbs->fax,
			'businesstype'=>$fbs->businesstype,
			'otherbusinesstype'=>$fbs->otherbusinesstype,
            'period1'=>$this->common->adaptdate($fbs->period1),
            'period2'=>$this->common->adaptdate($fbs->period2),
            'resp' => ($this->report->getfbpics($nofb,'resp')!=false)?$this->report->getfbpics($nofb,'resp'):'',
            'subscriber' => ($this->report->getfbpics($nofb,'subscriber')!=false)?$this->report->getfbpics($nofb,'subscriber'):'',
            'billing' => ($this->report->getfbpics($nofb,'billing')!=false)?$this->report->getfbpics($nofb,'billing'):'',
            'adm' => ($this->report->getfbpics($nofb,'adm')!=false)?$this->report->getfbpics($nofb,'adm'):'',
            'teknis' => ($this->report->getfbpics($nofb,'teknis')!=false)?$this->report->getfbpics($nofb,'teknis'):'',
            'support' => ($this->report->getfbpics($nofb,'support')!=false)?$this->report->getfbpics($nofb,'support'):'',
            'documentstatus'=>$documentstatus,
            );
        $this->load->view('fbs/hal1',$data);
    }
    function hal2(){
		$nofb = $this->uri->segment(3);
		$vas = new Vas();
		$pfbs = new Pfbs();
        $getvases = $pfbs->getvases($nofb);
        $data = $this->report->getdata($nofb);
        $setupfee=$this->report->getfees($nofb,'setup');
        $monthlyfee=$this->report->getfees($nofb,'monthly');
        $devicefee=$this->report->getfees($nofb,'device');
		$otherfee =$this->report->getfees($nofb,'other');
		$services = $this->report->getservices($nofb);
        $data = array(
			'clientvases'=>$getvases["records"],
            'nofb'=>$data->nofb,
            'name'=>$data->name,
            'address'=>$data->address,
            'siup'=>$data->siup,
            'npwp'=>$data->npwp,
            'telp'=>$data->telp,
            'fax'=>$data->fax,
            'period1'=>$this->common->adaptdate($data->period1),
            'period2'=>$this->common->adaptdate($data->period2),
            'username'=>$data->username,
			'setupdpp'=>$data->setupdpp,
			'services'=>$this->report->getservices($nofb),
			'humanreadable1'=>$services[0]->humanreadable1,
			'humanreadable2'=>$services[0]->humanreadable2,
            'setupfeedpp'=>(!$setupfee||$setupfee->dpp==0)?'-':'Rp. '.$setupfee->dpp.' +PPN = '.$setupfee->total,
            'setupfeeppn'=>(!$setupfee||$setupfee->ppn==0)?'0':$setupfee->ppn,
            'setupfeetotal'=>(!$setupfee||$setupfee->total==0)?'0':$setupfee->total,
            'monthlyfeedpp'=>(!$monthlyfee||$monthlyfee->dpp==0)?'-':'Rp. '.$monthlyfee->dpp.' +PPN = '.$monthlyfee->total,
            'monthlyfeeppn'=>(!$monthlyfee||$monthlyfee->ppn==0)?'0':$monthlyfee->ppn,
            'monthlyfeetotal'=>(!$monthlyfee||$monthlyfee->total==0)?'0':$monthlyfee->total,
            'devicefeedpp'=>(!$devicefee||$devicefee->dpp==0)?'-':'Rp. '.$devicefee->dpp.' +PPN = '.$devicefee->total,
            'devicefeeppn'=>(!$devicefee||$devicefee->ppn==0)?'0':$devicefee->ppn,
            'devicefeetotal'=>(!$devicefee||$devicefee->total==0)?'0':$devicefee->total,
            'otherfeedpp'=>(!$otherfee||$otherfee->dpp==0)?'-':'Rp. '.$otherfee->dpp.' Rp = '.$otherfee->total,
            'otherfeeppn'=>(!$otherfee||$otherfee->ppn==0)?'0':$otherfee->ppn,
			'activationdate'=>$this->common->adaptdate($data->activationdate),
			'vases'=>$vas->populate(),
        );
        $this->load->view('fbs/hal2',$data);
    }
    function hals(){
		$nofb = $this->uri->segment(3);
		$fbs = $this->report->getdata($nofb);
		$vas = new Vas();
		$pfbs = new Pfbs();
        $getvases = $pfbs->getvases($nofb);
        $data = $this->report->getdata($nofb);
        $setupfee=$this->report->getfees($nofb,'setup');
        $monthlyfee=$this->report->getfees($nofb,'monthly');
        $devicefee=$this->report->getfees($nofb,'device');
		$otherfee =$this->report->getfees($nofb,'other');
		switch($fbs->accounttype){
			case '0':
			$newaccountchecked = 'checked="checked"';
			$existingaccountchecked = '';
			break;
			case '1':
			$newaccountchecked = '';
			$existingaccountchecked = 'checked="checked"';
			break;
		}
		$corporatecheckbox = '';
		$personalcheckbox = '';
		$gameonlinecheckbox = '';
		$othercheckbox = '';
		
		switch($fbs->businesstype){
			case 'Corporate':
			$corporatecheckbox = 'checked="checked"';
			break;
			case 'Game On Line':
			$gameonlinecheckbox = 'checked="checked"';
			break;
			case 'Perorangan':
			$personalcheckbox = 'checked="checked"';
			break;
			default:
			$othercheckbox = 'checked="checked"';
			break;
		}
		$documents = $this->pfbs->getdocumentarray();
		$fbdocuments = $pfbs->getdocuments($nofb);
		$documentstatus = array();
        $str = "";
        foreach($documents as $doc){
            $match = false;
            foreach($fbdocuments as $fbdoc){
                if(strtolower($doc)===strtolower($fbdoc->documentname)){
                    $match = true;
                }else{
                }
            }
            if($match){
                $status = '&#8864';
            }else{
                $status = '&#9633';
            }
            $documentstatus[$doc] = $status;
        }
		$services = $this->report->getservices($nofb);
        $data = array(
			'corporatecb'=>$corporatecheckbox,
			'gamecb'=>$gameonlinecheckbox,
			'personalcb'=>$personalcheckbox,
			'othercb'=>$othercheckbox,
			'newaccountchecked'=>$newaccountchecked,
			'existingaccountchecked'=>$existingaccountchecked,
			'clientvases'=>$getvases["records"],
            'nofb'=>$data->nofb,
            'name'=>$data->name,
			'address'=>$data->address,
			'billaddress'=>$fbs->billaddress,
			'sppkp'=>$fbs->sppkp,
			'businesstype'=>$fbs->businesstype,
			'otherbusinesstype'=>$fbs->otherbusinesstype,
			'documentstatus'=>$documentstatus,
            'siup'=>$data->siup,
            'npwp'=>$data->npwp,
            'telp'=>$data->telp,
            'fax'=>$data->fax,
            'period1'=>$this->common->adaptdate($data->period1),
            'period2'=>$this->common->adaptdate($data->period2),
            'username'=>$data->username,
            'setupdpp'=>$data->setupdpp,
            'services'=>$services,
            'setupfeedpp'=>(!$setupfee||$setupfee->dpp==0)?'-':'Rp. '.$setupfee->dpp.' +PPN = '.$setupfee->total,
            'setupfeeppn'=>(!$setupfee||$setupfee->ppn==0)?'0':$setupfee->ppn,
            'setupfeetotal'=>(!$setupfee||$setupfee->total==0)?'0':$setupfee->total,
            'monthlyfeedpp'=>(!$monthlyfee||$monthlyfee->dpp==0)?'-':'Rp. '.$monthlyfee->dpp.' +PPN = '.$monthlyfee->total,
            'monthlyfeeppn'=>(!$monthlyfee||$monthlyfee->ppn==0)?'0':$monthlyfee->ppn,
            'monthlyfeetotal'=>(!$monthlyfee||$monthlyfee->total==0)?'0':$monthlyfee->total,
            'devicefeedpp'=>(!$devicefee||$devicefee->dpp==0)?'-':'Rp. '.$devicefee->dpp.' +PPN = '.$devicefee->total,
            'devicefeeppn'=>(!$devicefee||$devicefee->ppn==0)?'0':$devicefee->ppn,
            'devicefeetotal'=>(!$devicefee||$devicefee->total==0)?'0':$devicefee->total,
            'otherfeedpp'=>(!$otherfee||$otherfee->dpp==0)?'-':'Rp. '.$otherfee->dpp.' Rp = '.$otherfee->total,
            'otherfeeppn'=>(!$otherfee||$otherfee->ppn==0)?'0':$otherfee->ppn,
			'activationdate'=>$this->common->adaptdate($data->activationdate),
			'vases'=>$vas->populate(),
			'resp' => ($this->report->getfbpics($nofb,'resp')!=false)?$this->report->getfbpics($nofb,'resp'):'',
            'subscriber' => ($this->report->getfbpics($nofb,'subscriber')!=false)?$this->report->getfbpics($nofb,'subscriber'):'',
            'billing' => ($this->report->getfbpics($nofb,'billing')!=false)?$this->report->getfbpics($nofb,'billing'):'',
            'adm' => ($this->report->getfbpics($nofb,'adm')!=false)?$this->report->getfbpics($nofb,'adm'):'',
            'teknis' => ($this->report->getfbpics($nofb,'teknis')!=false)?$this->report->getfbpics($nofb,'teknis'):'',
            'support' => ($this->report->getfbpics($nofb,'support')!=false)?$this->report->getfbpics($nofb,'support'):'',
			'humanreadable2'=>$services[0]->humanreadable2,
			'humanreadable1'=>$services[0]->humanreadable1,
			'srv'=>$services[0]->srv,
        );
        $this->load->view('fbs/halsv2',$data);
	}
	function updatehumanreadable1(){
		$params = $this->input->post();
		echo $this->report->updatehumanreadable1($params);
	}
	function updatehumanreadable2(){
		$params = $this->input->post();
		echo $this->report->updatehumanreadable2($params);
	}
	function restorehumanreadable1(){
		$nofb = $this->uri->segment(3);
		echo json_encode($this->report->restorehumanreadable1($nofb));
	}
}


<?php
class Pfbses extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("subscription");
    }
    function add(){
        $this->common->check_login();
        $client_id = $this->uri->segment(3);
        $pfbs = new Pfbs();
        $vas = new Vas();
        $nofb = null;
        $service = $pfbs->getservices($nofb);
        $getvases = $pfbs->getvases($nofb);
        $documents = $this->pfbs->getdocumentarray();
        $fbdocuments = $pfbs->getdocuments($nofb);
        $documentstatus = array();
        foreach($documents as $doc){
            $match = false;
            foreach($fbdocuments as $fbdoc){
                if(strtolower($doc)===strtolower($fbdoc->documentname)){
                    $match = true;
                }else{
                }
            }
            if($match){
                $status = 'checked="checked"';
            }else{
                $status = '';
            }
            $documentstatus[$doc] = $status;
        }
        $data = array(
            "menuFeed"=>"fbs",
            "client"=>getnamebyclientid($client_id),
            "formlabel"=>"Penambahan FB",
            "client_id"=>$client_id,
            "username"=>$this->session->userdata["username"],
            "fb" => $this->pfbs->getfb($client_id),
            "nofb"=>generatefb($client_id),
            'objs'=>getpics($client_id),
            "servicecategory"=>$this->service->get_combo_data(false,'Pilihlah','Custom'),
            'fbservices'=>$service['records'],
            'fbserviceamount'=>$service['amount'],
            'smartvalues'=>$this->pfbs->getsmartvalues(),
            'values' => padi_getvaluesarray(0,100),
            'businesses'=>$this->pfbs->getbusinesses(),
            'sohos'=>$this->pfbs->getsohos(),
            'pc'=>$this->pfbs->getpc(),
			'obj'=>getpics($nofb),
            "pics"=>$this->pfbs->getfbpic($nofb),
            "servicecategory"=>$this->service->get_combo_data(false,'Pilihlah','Custom'),
            'username'=>$this->session->userdata["username"],
            'fbservices'=>$service['records'],
            'fbserviceamount'=>$service['amount'],
            'client_vases' => $getvases['records'],
            'totalvas' => $getvases['total'],
            'documentstatus'=>$documentstatus,
            'vases'=>$vas->get_combo_data(),
        );
        $this->load->view("v2/fbs/ad",$data);
    }
    function checkdocument(){
        $params = $this->input->post();
        $pfbs = new Pfbs();
        $pfbs->checkdocument($params);
    }
    function uncheckdocument(){
        $params = $this->input->post();
        $pfbs = new Pfbs();
        $pfbs->uncheckdocument($params);
    }
    function copyfb(){
        $nofb= $this->uri->segment(3);
        $client_id = $this->uri->segment(4);
        sendNotification($this->copyfb_($nofb,$client_id));
        redirect('/pfbses/index/'.$client_id);
    }
    function copyfb_($nofb,$client_id){
        return($this->pfbs->copyFb($nofb,$client_id));
    }
    function documentsaveupdate(){
        $params = $this->input->post();
        echo $this->pfbs->documentsaveupdate($params);
    }
    function getArray($objs){
        $arr = array();
        foreach($objs as $dev){
            $arr[$dev->id] = $dev->name;
        }
        return $arr;
    }
    function edit(){
        $this->common->check_login();
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
        $nofb = $this->uri->segment(3);
        $objs = $this->pfbs->printfb($nofb);
        $clientsite = $this->pfbs->getclientinfo($nofb);
        if($clientsite!=false){
            $fb = $this->pfbs->printfb($nofb);
            $pfbs = new Pfbs();
            $vas = new Vas();
            $service = $pfbs->getservices($nofb);
            $getvases = $pfbs->getvases($nofb);
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
                    $status = 'checked="checked"';
                }else{
                    $status = '';
                }
                $documentstatus[$doc] = $status;
            }
            $data = array(
                'vases'=>$vas->get_combo_data(),
                'client_id'=>$clientsite->client_id,
                'clientsite'=>$clientsite,
                'fb'=>$fb,
                'formlabel'=>'Edit FB',
                'nofb'=>$nofb,
                'fbcategories'=>array(
                    'Pilihlah'=>'Pilihlah',
                    'Baru'=>'Baru',
                    'Upgrade'=>'Upgrade',
                    'Downgrade'=>'Downgrade',
                ),
                'businesstypes'=>array(
                    'Pilihlah'=>'Pilihlah',
                    'Corporate'=>'Corporate',
                    'Game On Line'=>'Game On Line',
                    'Perorangan'=>'Perorangan',
                    'Lainnya'=>'Lainnya'),
                'menuFeed'=>'subscribeform',
                'sohos'=>$this->pfbs->getsohos(),
                'smartvalues'=>$this->pfbs->getsmartvalues(),
                'values' => padi_getvaluesarray(0,100),
                'businesses'=>$this->pfbs->getbusinesses(),
                'pc'=>$this->pfbs->getpc(),
                "pics"=>$this->pfbs->getfbpic($nofb),
                "servicecategory"=>$this->service->get_combo_data(false,'Pilihlah','Custom'),
                'username'=>$this->session->userdata["username"],
                'fbservices'=>$service['records'],
                'fbserviceamount'=>$service['amount'],
                'client_vases' => $getvases['records'],
                'totalvas' => $getvases['total'],
                'documentstatus'=>$documentstatus,
                'clientcategories'=>array('2'=>'Platinum','3'=>'Gold','4'=>'Silver','5'=>'Bronze'),
                'isffr'=>array('0'=>'Tidak','1'=>'Ya'),
                'products'=>array('product_internet'=>'Internet','product_devices'=>'Perangkat','product_vases'=>'VAS'),
                "internets"=>$this->getArray($this->pfbs->getinternetmasters()),
                "internetcategories"=>$this->getArray($this->pfbs->getinternetcategorymasters()),
                'devices'=>$this->getArray($this->pfbs->getdevicemasters()),
                'devicecategories'=>$this->getArray($this->pfbs->getdevicecategorymasters()),
                'vases'=>$this->getArray($this->pfbs->getvasmasters()),
                'vascategories'=>$this->getArray($this->pfbs->getvascategorymasters()),
               // 'pemohon'=>$this->pfbs->getfbpic($nofb,"pemohon")[0],
                //'penanggungjawab'=>$this->pfbs->getfbpic($nofb,"penanggungjawab")[0],
                //'support'=>$this->pfbs->getfbpic($nofb,"support")[0],
               // 'teknisi'=>$this->pfbs->getfbpic($nofb,"teknisi")[0],
               // 'administrasi'=>$this->pfbs->getfbpic($nofb,"administrasi")[0],
               // 'billing'=>$this->pfbs->getfbpic($nofb,"billing")[0],
            );
            $this->load->view("v2/fbs/editv2",$data);
        }else{
            echo "FB tidak di ketemukan ..";
        }
    }
    function edit_post_handler(){
        $params = $this->input->post();
        //print_r($params);
        $this->pfbs->postupdate($params);
        redirect('/pfbses/edit/'.$params['nofb']);
    }
    function getrandomvalues(){
        $names = array("Abdullah","Ali","Ahmad","Amir","Ayyub");
        $this->load->helper('fakevalues');
        $pics = getfakepics(6);
        $siup = getfakesiup();
        $str = '{';
        $str.= '"subscribername":"'.$pics[0]['name'].'","subscriberemail":"'.$pics[0]['email'].'",';
        $str.= '"subscriberphone":"'.$pics[0]['telp'].'","subscriberhp":"'.$pics[0]['hp'].'",';
        $str.= '"subscriberposition":"'.$pics[0]['position'].'","subscriberid":"'.$pics[0]['idnum'].'",';
        $str.= '"subscriberphone":"'.$pics[0]['telp'].'","subscriberhp":"'.$pics[0]['hp'].'",';
        $str.= '"respname":"'.$pics[1]['name'].'","respemail":"'.$pics[1]['email'].'",';
        $str.= '"respposition":"'.$pics[1]['position'].'","respid":"'.$pics[1]['idnum'].'",';
        $str.= '"respphone":"'.$pics[1]['telp'].'","resphp":"'.$pics[1]['hp'].'",';
        $str.= '"admname":"'.$pics[2]['name'].'","admemail":"'.$pics[2]['email'].'",';
        $str.= '"admphone":"'.$pics[2]['telp'].'","admhp":"'.$pics[2]['hp'].'",';
        $str.= '"technicianname":"'.$pics[3]['name'].'","technicianemail":"'.$pics[3]['email'].'",';
        $str.= '"technicianphone":"'.$pics[3]['telp'].'","technicianhp":"'.$pics[3]['hp'].'",';
        $str.= '"billingname":"'.$pics[4]['name'].'","billingemail":"'.$pics[4]['email'].'",';
        $str.= '"billingphone":"'.$pics[4]['telp'].'","billinghp":"'.$pics[4]['hp'].'",';
        $str.= '"supportname":"'.$pics[5]['name'].'","supportemail":"'.$pics[5]['email'].'",';
        $str.= '"supportphone":"'.$pics[5]['telp'].'","supporthp":"'.$pics[5]['hp'].'",';
        $str.= '"siup":"'.$siup['siup'].'","alamatsiup":"'.$siup['alamatsiup'].'",';
        $str.= '"npwp":"'.$siup['npwp'].'","alamatnpwp":"'.$siup['alamatnpwp'].'",';
        $str.= '"sppkp":"'.$siup['sppkp'].'","alamatsppkp":"'.$siup['alamatsppkp'].'",';
        $str.= '"alamatpenagihan":"'.$siup['alamatpenagihan'].'"';
        $str.= '}';
        echo $str;
    }
    function getservice(){
        $params = $this->input->post();
        $fb = new Pfbs();
        $service = $fb->getservice($params["service_id"]);
        $out = '{';
        $out.= '"category":"'.$service->category.'",';
        $out.= '"name":"'.$service->name.'",';
        $out.= '"upm":"'.$service->upm.'",';
        $out.= '"upk":"'.$service->upk.'",';
        $out.= '"dnm":"'.$service->dnm.'",';
        $out.= '"dnk":"'.$service->dnk.'",';
        $out.= '"upstr":"'.$service->upstr.'",';
        $out.= '"dnstr":"'.$service->dnstr.'",';
        $out.= '"space":"'.$service->space.'",';
        $out.= '"bandwidth":"'.$service->bandwidth.'"';
        $out.= '}';
        echo $out;
    }
    function index(){
        $this->common->check_login();
        $client_id = $this->uri->segment(3);
        if($this->uri->total_segments()<3){
            redirect('/subscribeforms/');
        }
        $objs = getfbs($client_id);
        $clientname = getnamebyclientid($client_id);
        $cname = "FB Belum ada";
        if($clientname){
            $cname = $clientname->name;
        }
        $data = array(
            "menuFeed"=>"fbs",
            "tablelabel"=>"Form Berlangganan : ".$cname,
            "objs"=>$objs["res"],
            "clientid"=>$client_id
        );
        $this->load->view("v2/fbs/index",$data);
    }
	function printreport(){
        $this->common->check_login();
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
        $nofb = $this->uri->segment(3);
        $services = $this->pfbs->getservices($nofb);
		$clientsite = $this->pfbs->getclientinfo($nofb);
		$fb = $this->pfbs->printfb($nofb);
		$data = array(
            'client_id'=>$clientsite->client_id,
			'id'=>$nofb,
			'objs'=>getpics($nofb),
            "pics"=>$this->pfbs->getfbpic($nofb),
            'fb'=>$fb,
            'services' => $services['records'],
			'menuFeed'=>'subscribeform',
			'clientsite'=>$clientsite
		);
		$this->load->view("Sales/fbs/printreport3",$data);
    }
	function printreport1(){
        $this->common->check_login();
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
		$nofb = $this->uri->segment(3);
		$clientsite = $this->pfbs->getclientinfo($nofb);
		$fb = $this->pfbs->printfb($nofb);
		$data = array(
            'client_id'=>$clientsite->client_id,
			'id'=>$nofb,
			'objs'=>getpics($nofb),
            "pics"=>$this->pfbs->getfbpic($nofb),
			'fb'=>$fb,
			'menuFeed'=>'subscribeform',
			'clientsite'=>$clientsite
		);
		$this->load->view("Sales/fbs/printreport1",$data);
    }
    function printreport2(){
        $this->common->check_login();
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
		$nofb = $this->uri->segment(3);
		$clientsite = $this->pfbs->getclientinfo($nofb);
		$fb = $this->pfbs->printfb($nofb);
		$data = array(
            'client_id'=>$clientsite->client_id,
			'id'=>$nofb,
			'objs'=>getpics($nofb),
            "pics"=>$this->pfbs->getfbpic($nofb),
			'fb'=>$fb,
			'menuFeed'=>'subscribeform',
			'clientsite'=>$clientsite
		);
		$this->load->view("Sales/fbs/printreport2",$data);
    }

    function removeservice(){
        $params = $this->input->post();
        $pfbs = new Pfbs();
        $pfbs->removeservice($params);
    }
    function backupfb(){
        $nofb = $this->uri->segment(3);
        $this->pfbs->backupfb($nofb);
        echo 'success backup FB';
    }
    function removefb(){
        $nofb = $this->uri->segment(3);
        $this->pfbs->removefb($nofb);
        echo 'success remove FB';
    }
    function saveservice(){
        $params = $this->input->post();
        $pfbs = new Pfbs();
        echo $pfbs->saveservice($params);
    }
    function savedevice(){
        $params = $this->input->post();
        $pfbs = new Pfbs();
        echo json_encode($pfbs->savedevice($params));
    }
    function savevas(){
        $params = $this->input->post();
//        echo $params['data'];
        $pfbs = new Pfbs();
        echo $pfbs->savevas($params['data']);
    }
	function showreport(){
        $this->common->check_login();
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
		$nofb = $this->uri->segment(3);
		$clientsite = $this->pfbs->getclientinfo($nofb);
        $fb = $this->pfbs->printfb($nofb);
        $vas = new Vas();
        $pfbs = new Pfbs();
        $getvases = $pfbs->getvases($nofb);
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
        $services = $this->pfbs->getservices($nofb);
		$data = array(
            'client_id'=>$clientsite->client_id,
			'id'=>$nofb,
			'objs'=>getpics($nofb),
            "pics"=>$this->pfbs->getfbpic($nofb),
			'fb'=>$fb,
			'menuFeed'=>'subscribeform',
            'clientsite'=>$clientsite,
            'clientvases'=>$getvases["records"],
            'vases'=>$vas->populate(),
            'docs'=>$this->pfbs->getdocuments($nofb),
            'docarrays'=>$this->pfbs->getdocumentarray(),
            'documentstatus'=>$documentstatus,
            'services' => $services['records']
		);
		$this->load->view("Sales/fbs/report",$data);
	}
	function printreport_(){
        $this->common->check_login();
		$data['dt1']='2016-1-1';
		$data['dt2']='2016-1-1';
		$data['userbranches']='2016-1-1';
		$data['users']=array("1");
		$data['userbranches']=array();
		$data['ams']=array();
		$nofb = $this->uri->segment(3);
		$clientsite = $this->pfbs->getclientinfo($nofb);
        $fb = $this->pfbs->printfb($nofb);
        $vas = new Vas();
        $pfbs = new Pfbs();
        $getvases = $pfbs->getvases($nofb);
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
        $services = $this->pfbs->getservices($nofb);
		$data = array(
            'client_id'=>$clientsite->client_id,
			'id'=>$nofb,
			'objs'=>getpics($nofb),
            "pics"=>$this->pfbs->getfbpic($nofb),
			'fb'=>$fb,
			'menuFeed'=>'subscribeform',
            'clientsite'=>$clientsite,
            'clientvases'=>$getvases["records"],
            'vases'=>$vas->populate(),
            'docs'=>$this->pfbs->getdocuments($nofb),
            'docarrays'=>$this->pfbs->getdocumentarray(),
            'documentstatus'=>$documentstatus,
            'services' => $services['records']
		);
		$this->load->view("Sales/fbs/print",$data);
	}
    function update(){
        $this->common->check_login();
        $params = $this->input->post();
        echo $this->pfbs->update($params);
    }
    function updateservice(){
        $params = $this->input->post();
        $pfbs = new Pfbs();
        echo $pfbs->updateservice($params);
    }
}

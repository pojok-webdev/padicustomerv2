<?php
class Pfbs extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function copyFb($nofb,$client_id){
		$fields = "";
		$fields.= "client_id,";
		$fields.= "name,";
		$fields.= "nofb,";
		$fields.= "businesstype,";
		$fields.= "siup,";
		$fields.= "siupaddress,";
		$fields.= "npwp,";
		$fields.= "npwpaddress,";
		$fields.= "sppkp,";
		$fields.= "sppkpaddress,";
		$fields.= "address,";
		$fields.= "billaddress,";
		$fields.= "city,";
		$fields.= "telp,";
		$fields.= "fax,";
		$fields.= "activationdate,";
		$fields.= "period1,";
		$fields.= "period2,";
		$fields.= "services,";
		$fields.= "accounttype,";
		$fields.= "description,";
		$fields.= "status";
		$newfb = generatefb($client_id);
		$newfields = str_replace('nofb','"'.$newfb.'"',$fields);
		$sql = "insert into fbs ";
		$sql.= "(";
		$sql.= $fields;
		$sql.= ") ";
		$sql.= "select " . $newfields . " ";
		$sql.= "from fbs ";
		$sql.= "where nofb='".$nofb . "'";
		$ci = & get_instance();
		$ci->db->query($sql);
		$fields = "name,nofb,role,position,idnum,phone,hp,email,createuser";
		$newfields = str_replace('nofb','"'.$newfb.'" nofb',$fields);
		$sql = 'delete from fbpics where nofb="'.$newfb.'"';
		$ci = & get_instance();
		$ci->db->query($sql);
		$sql = "insert into fbpics ";
		$sql.= "(";
		$sql.= $fields;
		$sql.= ")";
		$sql.= "select " . $newfields . " ";
		$sql.= "from fbpics ";
		$sql.= "where nofb='".$nofb . "' and client_id=".$client_id." ";
		$ci = & get_instance();
		$ci->db->query($sql);

		$fields = "client_id,name,nofb,dpp,ppn,createuser";
		$newfields = str_replace('nofb','"'.$newfb.'"',$fields);
		$sql = "insert into fbfees ";
		$sql.= "(";
		$sql.= $fields;
		$sql.= ")";
		$sql.= "select " . $newfields . " ";
		$sql.= "from fbfees ";
		$sql.= "where nofb='".$nofb . "' ";
		$ci = & get_instance();
		$ci->db->query($sql);

		$fields = "fb_id,category,name,bwtype,upm,upk,upstr,dnm,dnk,dnstr,space,bandwidth,customservice,createuser";
		$newfields = str_replace('fb_id','"'.$newfb.'"',$fields);
		$sql = "insert into fbservices ";
		$sql.= "(";
		$sql.= $fields;
		$sql.= ")";
		$sql.= "select " . $newfields . " ";
		$sql.= "from fbservices ";
		$sql.= "where fb_id='".$nofb . "'";
		$ci = & get_instance();
		$ci->db->query($sql);

		$fields = "documentname,nofb,createuser";
		$newfields = str_replace('nofb','"'.$newfb.'"',$fields);
		$sql = "insert into fbdocuments ";
		$sql.= "(";
		$sql.= $fields;
		$sql.= ")";
		$sql.= "select " . $newfields . " ";
		$sql.= "from fbdocuments ";
		$sql.= "where nofb='".$nofb . "'";
		$ci = & get_instance();
		$ci->db->query($sql);



		return array(
			'nofb'=>$nofb,
			'newnofb'=>$newfb
		);
	}
    function documentsaveupdate($params){
        $ci = & get_instance();
        foreach($params['data'] as $obj){
            $sql = "insert into fbdocuments ";
            $sql.= "(nofb,documentname,createuser)";
            $sql.= "values ";
            $sql.= "('".$obj['nofb']."','".$obj['document']."','".$obj['createuser']."')";
            $que = $ci->db->query($sql);
        }
        return 'true';
    }
    function generatefb($branch,$client_id){
        $this->common->check_login();
        $out = $branch."".date("Ym").$client_id;
        $sql = "select count(id)cnt from fbs where client_id= ".$client_id;
        $que = $this->db->query($sql);
        $res = $que->result();
        return $out;
    }
    function getdocumentarray(){
        return array("npwp","siup","sppkp","ktp penanggungjawab","ktp pemohon","surat kuasa");
    }
    function getpc(){
        return array('5'=>'Up to 5','7'=>'Up to 7','10'=>'Up to 10',);
    }
    function getbusinesses(){
        return array('2'=>'2 Mbps','4'=>'4 Mbps','6'=>'6 Mbps','8'=>'8 Mbps');
	}
	function getsohos(){
		return array(1=>"Padi SOHO 1:4",2=>"Padi SOHO 1:2",3=>"Padi SOHO 1:1");
	}
    function getbusinesstypes(){
		$ci = & get_instance();
		$sql = "select distinct businesstype from fbs";
		$que = $ci->db->query($sql);
		$out = array();
		foreach($que->result() as $res){
			if($res->businesstype!=='Pilihlah'){
				$out[$res->businesstype] = $res->businesstype;
			}
		}
		return $out;
	}
    function getsmartvalues(){
        return array('3'=>'3 Mbps','5'=>'5 Mbps','8'=>'8 Mbps','10'=>'10 Mbps','15'=>'15 Mbps');
    }
    function checkdocument($params){
        $vals = array();$keys = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = "insert into fbdocuments ";
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
	function getclientinfo($nofb){
		$ci = & get_instance();
		$sql = "select a.name fbname,a.client_id,nofb,a.businesstype,a.siup,a.siupaddress,fbcategory,";
		$sql.= "a.npwp,a.npwpaddress,a.address,a.sppkp,a.sppkpaddress,internaldescription,";
		$sql.= "date_format(a.activationdate,'%d/%m/%Y') activationdate,";
		$sql.= "date_format(a.period1,'%d/%m/%Y') period1,";
		$sql.= "date_format(a.period2,'%d/%m/%Y') period2,";
		$sql.= "a.city,a.telp,a.telp phone,a.fax,b.name,b.clientcategory,b.isffr from fbs a ";
		$sql.= "left outer join clients b on b.id=a.client_id ";
		$sql_ = "where b.id = '" . $nofb . "'";;
		$sql.= "where a.nofb = '" . $nofb . "'";
		$que = $ci->db->query($sql);
		if($que->num_rows()>0){
			return $que->result()[0];
		}else{
			return false;
		}
	}
	function getclientsiteinfo($nofb){
		$ci = & get_instance();
		$sql = "select a.name fbname,a.client_id,nofb,a.businesstype,a.siup,a.siupaddress,";
		$sql.= "a.npwp,a.npwpaddress,a.address,a.sppkp,a.sppkpaddress,internaldescription,";
		$sql.= "date_format(a.activationdate,'%d/%m/%Y') activationdate,";
		$sql.= "date_format(a.period1,'%d/%m/%Y') period1,";
		$sql.= "date_format(a.period2,'%d/%m/%Y') period2,";
		$sql.= "a.city,a.telp,a.telp phone,a.fax,b.name from fbs a ";
		$sql.= "left outer join clients b on b.id=a.client_id ";
		$sql_ = "where b.id = '" . $nofb . "'";;
		$que = $ci->db->query($sql);
		if($que->num_rows()>0){
			return $que->result()[0];
		}else{
			return false;
		}
	}
    function getdocuments($nofb){
        $ci = & get_instance();
        $sql = "select * from fbdocuments ";
		$sql.= "where nofb = '" . $nofb . "' ";
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
	}
	function getdevicemasters(){
		$sql = 'select id,name from pricelists2.devices ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getdevicecategorymasters(){
		$sql = 'select distinct kddevice id,name from pricelists2.devices ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getvasmasters(){
		$sql = 'select id,name from pricelists2.vases ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getvascategorymasters(){
		$sql = 'select kdvas id,name from pricelists2.vases ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getinternetcategorymasters(){
		$sql = 'select distinct category_id id,category_id name from pricelists2.products ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getinternetmasters(){
		$sql = 'select * from pricelists2.products ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getproducts($params){
		$sql = 'select id,nofb,';
		$sql.= 'case category_id when "1" then "Internet" when "2" then "Perangkat" when "3" then "VAS" end category_id, ';
		$sql.= 'product_id,detail_id,detail,createdate ';
		$sql.= 'from fbproducts ';
		$sql.= 'where nofb="'.$params['nofb'].'" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function removeproduct($params){
		$sql = 'delete from fbproducts ';
		$sql.= 'where id = ' . $params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('sql'=>$sql);
	}
	function clientages(){
		$sql = 'select client_id id,name,activationdate,period2,timestampdiff(YEAR,activationdate,now())year,';
		$sql.= 'case ';
		$sql.= 'when timestampdiff(YEAR,activationdate,now()) > 0 ';
		$sql.= 'then timestampdiff(MONTH,activationdate,now())-12*timestampdiff(YEAR,activationdate,now()) ';
		$sql.= 'else timestampdiff(MONTH,activationdate,now()) end month ,';
		$sql.= '(day(now()) - day(activationdate)) daydif,';
		$sql.= 'timestampdiff(YEAR,period2,now()) lastcontractyear, ';
		$sql.= 'case ';
		$sql.= 'when timestampdiff(YEAR,period2,now())>0 ';
		$sql.= 'then timestampdiff(MONTH,period2,now()) - 12*timestampdiff(YEAR,period2,now()) ';
		$sql.= 'else timestampdiff(MONTH,period2,now()) end lastcontractmonth, ';
		$sql.= '(day(now()) - day(period2)) lastcontractdaydif,';
		$sql.= 'case ';
		$sql.= 'when timestampdiff(YEAR,period2,now())> 0 then "tidak " ';
		$sql.= 'else ';
		$sql.= 'case ';
		$sql.= 'when timestampdiff(MONTH,period2,now())<5 then "ya"';
		$sql.= 'else "tidak" end ';
		$sql.= 'end nearexpired, ';
		$sql.= 'now()from fbs  ';
		$sql.= 'where status="1"';
		$sql.= 'limit 1,50';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
	}
	function getfb($clientsiteid){
		$ci = & get_instance();
		$sql = "select a.name,";
		$sql.= "case when nofb is null then ";
		$sql.= " case branch_id ";
		$sql.= " when '1' then concat('SBY',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) ";
		$sql.= " when '2' then concat('JKT',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) ";
		$sql.= " when 3 then concat('MLG',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) ";
		$sql.= " when '4' then concat('BLI',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) end ";
		$sql.= " else nofb ";
		$sql.= " end ccc ,";
		$sql.= "";
		$sql.= "b.businesstype,";
		$sql.= "b.billaddress,";
		$sql.= "c.username,";
		$sql.= "b.nofb,";
		$sql.= "b.businesstype,";
		$sql.= "b.siup,";
		$sql.= "b.npwp,";
		$sql.= "b.address,";
		$sql.= "b.city,";
		$sql.= "b.telp,";
		$sql.= "b.fax,";
		$sql.= "b.activationdate,";
		$sql.= "b.accounttype,";
		$sql.= "b.description,";
		$sql.= "b.period1,";
		$sql.= "b.period2,";
		$sql.= "b.services,";
		$sql.= "b.completed ";
		$sql.= "from clients a ";
		$sql.= "left outer join fbs b on b.client_id=a.id ";
		$sql.= "left outer join users c on c.id=a.sale_id where a.id='".$clientsiteid."' ";
		$query = $ci->db->query($sql);
		$res = $query->result();
		if(count($res)>0){
			return $res[0];
		}
		return false;
	}    
	function getfbfb($clientsiteid){
		$ci = & get_instance();
		$sql = "select a.name,";
		$sql.= "case when nofb is null then ";
		$sql.= " case branch_id ";
		$sql.= " when '1' then concat('SBY',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) ";
		$sql.= " when '2' then concat('JKT',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) ";
		$sql.= " when '3' then concat('MLG',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) ";
		$sql.= " when '4' then concat('BLI',date_format(now(),'%Y%m%d'),lpad(a.id,4,'0')) end ";
		$sql.= " else nofb ";
		$sql.= " end ccc ,";
		$sql.= "";
		$sql.= "b.businesstype,";
		$sql.= "b.billaddress,";
		$sql.= "c.username,";
		$sql.= "b.nofb,";
		$sql.= "b.otherbusinesstype,";
		$sql.= "b.accounttype,";		
//		$sql.= "b.description,";
		$sql.= "b.siup,";
		$sql.= "b.npwp,";
		$sql.= "b.address,";
		$sql.= "b.city,";
		$sql.= "b.telp,";
		$sql.= "b.fax,";
		$sql.= "b.activationdate,";
		$sql.= "b.period1,";
		$sql.= "b.period2,";
		$sql.= "b.services,";
		$sql.= "b.completed ";
		$sql.= "from clients a ";
		$sql.= "left outer join fbs b on b.client_id=a.id ";
		$sql.= "left outer join users c on c.id=a.sale_id where nofb='".$clientsiteid."' ";
		$query = $ci->db->query($sql);
		$res = $query->result();
		if(count($res)>0){
			return $res[0];
		}
		return false;
	}
	function getfbdescription($nofb){
		$sql = 'select description from fbs where nofb="'.$nofb.'" ';
		$query = $ci->db->query($sql);
		$res = $query->result();
		if(count($res)>0){
			return $res[0];
		}
		return false;
	}
	function getfbfees($clientsiteid,$name=null){
		$ci = & get_instance();
		$sql = "select a.name,a.dpp,a.ppn,(a.dpp*1.1) total_,(a.dpp+a.ppn) total from fbfees a ";
		$sql.= "left outer join fbs b on b.client_id=a.client_id ";
		$sql.= "where b.nofb='".$clientsiteid."' ";
		if(!is_null($name)){
			$sql.= "and a.name='".$name."'";
		}
		$que = $ci->db->query($sql);
		if($que->num_rows()>0){
			$obj = $que->result()[0];
			return array("name"=>$obj->name,"dpp"=>$obj->dpp,"ppn"=>$obj->ppn,"total"=>$obj->total);
		}
		return array("name"=>"","dpp"=>"0","ppn"=>"0","total"=>"0");
    }    
	function getfbpic($nofb,$role=""){
		$ci = & get_instance();
		$sql = "select client_id,fb_id,name,nofb,role,position,idnum,concat(hp,' ',phone)telp_hp,phone,hp,email ";
		$sql.= "from fbpics ";
		$sql.= "where nofb='".$nofb."' ";
		if($role==""){
		}else{
			$sql.= "and role='".$role."' ";
		}
		$query = $ci->db->query($sql);
		return $query->result();
	}    
    function getservice($service_id){
        $sql = "select id,name,category,upm,upk,dnm,dnk,upstr,dnstr,space,bandwidth from fbservices ";
        $sql.= "where id='".$service_id."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }else{
            return false;
        }
    }
    function getservices($nofb){
        $sql = "select *,";
        $sql.="case category ";
        $sql.="when 'Colocation' then concat('Space ',space) ";
        $sql.="when 'Enterprise' then concat('UP ',upstr,' Mbps ') ";
        $sql.="when 'Business' then concat('Upto ',bandwidth) ";
        $sql.="when 'IIX (IIX)' then concat('UP ',upstr,' Mbps ') ";
        $sql.="when 'Local Loop' then concat(upstr,' Mbps ') ";
        $sql.="when 'Symetrical Broadband Internet (SBI)' then concat('Upto ',bandwidth) ";
        $sql.="when 'Colocation' then concat(bandwidth) ";
        $sql.="when 'Padi Cluster' then concat(bandwidth) ";
        $sql.="when 'oryza' then concat(bandwidth) ";
        $sql.="else  '' ";
        $sql.= "end upl,";
        $sql.="case category ";
        $sql.="when 'Colocation' then case bandwidth when '0' then  concat('UP ',upstr,' DOWN ',dnstr) else  concat('Up to ',upstr) end ";
        $sql.="when 'Enterprise' then concat('DOWN ',dnstr,' Mbps') ";
        $sql.="when 'Business' then '' ";
		$sql.="when 'IIX (IIX)' then concat('DOWN ',dnstr,' Mbps') ";
		$sql.="when 'Padi SOHO' then concat(bandwidth) ";
        $sql.="else '' ";
        $sql.= "end dnl,";
        $sql.= "case ";
        $sql.= "when dnk!='0' then concat('Upload:',upm,' Mbps, ',upk,' Kbps Download:',dnm,'Mbps ',dnk,' Kbps')  ";
        $sql.= "when dnm!='0' then concat('Upload:',upm,' Mbps, ',upk,' Kbps Download:',dnm,' Mbps') ";
        $sql.= "end humanreadabledescription ";
        $sql.= "from fbservices ";
		$sql.= "where fb_id='".$nofb."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $amount = $que->num_rows();
        $records = $que->result();
        return array('amount'=>$amount,'records'=>$records);
    }
    function getvasesbynofb($nofb){
        $ci = & get_instance();
        $sql = "select a.id,a.vas_id,b.name from client_vases a ";
        $sql.= "left outer join vases b on b.id=a.vas_id ";
        $sql.= "where a.client_id = " . $install_request_id . " " ;
        $que = $ci->db->query($sql);
        $res = $que->result();
        return array('records'=>$res,'total'=>$que->num_rows());
    }
    function getvases($nofb){
        $ci = & get_instance();
        $sql = "select b.id,c.name from fbs a ";
        $sql.= "left outer join client_vases b on b.client_id=a.client_id ";
        $sql.= "left outer join vases c on c.id=b.vas_id ";
        $sql.= "where a.nofb='".$nofb."'";
        $que = $ci->db->query($sql);
        $res = $que->result();
        return array('records'=>$res,'total'=>$que->num_rows());
    }
	function printfb($nofb){
		$ci = & get_instance();
		$sql = "select ";
		$sql.= "a.name, ";
		$sql.= "a.accounttype,";
		$sql.= "a.businesstype,";
		$sql.= "a.otherbusinesstype,";
		$sql.= "a.description,";
		$sql.= "c.username,";
		$sql.= "a.nofb,";
		$sql.= "a.businesstype,";
		$sql.= "a.siup,";
		$sql.= "a.npwp,";
		$sql.= "a.address,";
		$sql.= "a.billaddress,";
		$sql.= "a.city,";
		$sql.= "a.telp,";
		$sql.= "a.fax,";
		$sql.= "a.activationdate,";
		$sql.= "a.servicecategories,";
		$sql.= "a.period1,";
		$sql.= "a.period2,";
		$sql.= "a.services,";
		$sql.= "a.completed ";
		$sql.= "from fbs a left outer join clients b on b.id=a.client_id=b.id ";
		$sql.= "left outer join users c on c.id=b.sale_id ";
		$sql.= "where a.nofb='".$nofb."'";
		$que = $ci->db->query($sql);
		if($que->num_rows()>0){
			return $que->result()[0];
		}
		return false;
    }
    function removeservice($params){
        $sql = "delete from fbservices ";
        $sql.= "where id = " . $params['id'] . " ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
	}
	function saveproduct($params){
        $sql = "insert into fbproducts ";
        $vals = array();$keys = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."') ";
        $sql.= " ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
	}
    function saveservice($params){
        $sql = "insert into fbservices ";
        $vals = array();$keys = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."') ";
        $sql.= " ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function savedevice($params){
        $sql = "insert into fbdevices ";
        $vals = array();$keys = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."') ";
        $sql.= " ";
//        $ci = & get_instance();
//        $ci->db->query($sql);
//        return $ci->db->insert_id();
return array('sql'=>$sql);
    }
    function savevas($params){
        $ci = & get_instance();
        $sql = "";
        foreach($params as $obj){
            $sql = "insert into client_vases ";
            $sql.= "(client_id,vas_id,createuser) ";
            $sql.= "values ";
            $sql.= "('".$obj['clientid']."','".$obj['vasid']."','".$obj['createuser']."') ";
            $que = $ci->db->query($sql);
        }
        return $sql;
    }
    function uncheckdocument($params){
        $sql = "delete from fbdocuments ";
        $sql.= "where nofb= '".$params['nofb']."' and documentname='".$params['documentname']."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function update($params){
        $arr = array();
        foreach($params as $key=>$val){
            array_push($arr,$key." = '".$val."'");
        }
        $sql = "update fbs set " . implode(",",$arr) . " ";
        $sql.= "where nofb = '" . $params["nofb"] . "'";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
	}
	function postupdate($params,$exclude='simpan'){
		$ci = & get_instance();
        $arr = array();
		$sql = "update fbs set ";
		$sql.= "businesstype='".$params['businesstype']."',";
		$sql.= "otherbusinesstype='".$params['otherbusinesstype']."',";
		$sql.= "address='".$params['address']."',";
		$sql.= "telp='".$params['telp']."',";
		$sql.= "fax='".$params['fax']."',";
		$sql.= "fbcategory='".$params['fbcategory']."',";
		$sql.= "siup='".$params['siup']."',";
		$sql.= "siupaddress='".$params['siupaddress']."',";
		$sql.= "npwp='".$params['npwp']."',";
		$sql.= "npwpaddress='".$params['npwpaddress']."',";
		$sql.= "sppkp='".$params['sppkp']."',";
		$sql.= "sppkpaddress='".$params['sppkpaddress']."',";
		$sql.= "billaddress='".$params['billaddress']."',";
		$sql.= "internaldescription='".$params['internaldescription']."',";
		$sql.= "activationdate='".$ci->common->human_to_sql_date($params['activationdate'])."',";
		$sql.= "period1='".$ci->common->human_to_sql_date($params['period1'])."',";
		$sql.= "period2='".$ci->common->human_to_sql_date($params['period2'])."',";
		$sql.= "accounttype='".$params['accounttype']."',";
		$sql.= "description='".$params['description']."'";
        $sql.= "where nofb = '" . $params["nofb"] . "'";
        $ci = & get_instance();
		$ci->db->query($sql);
		
		$sql = "insert into fbpics ";
		$sql.= "(name,role,position,idnum,phone,hp,email,client_id,nofb)";
		$sql.= " values ";
		$sql.= "(";
		$sql.= "'".$params['subscriber_name']."',";
		$sql.= "'pemohon',";
		$sql.= "'".$params['subscriber_position']."',";
		$sql.= "'".$params['subscriber_idnum']."',";
		$sql.= "'".$params['subscriber_phone']."',";
		$sql.= "'".$params['subscriber_hp']."',";
		$sql.= "'".$params['subscriber_email']."',";
		$sql.= "'".$params['client_id']."',";
		$sql.= "'".$params['nofb']."'";
		$sql.= ")";
		$sql.= "on duplicate key ";
		$sql.= "update  ";
		
		$sql.= "name='".$params['subscriber_name']."',";
		$sql.= "role='pemohon',";
		$sql.= "position='".$params['subscriber_position']."',";
		$sql.= "idnum='".$params['subscriber_idnum']."',";
		$sql.= "phone='".$params['subscriber_phone']."',";
		$sql.= "hp='".$params['subscriber_hp']."',";
		$sql.= "email='".$params['subscriber_email']."'";
		echo $sql;
		$ci->db->query($sql);

		$sql = "insert into fbpics ";
		$sql.= "(name,role,position,idnum,phone,hp,email,client_id,nofb)";
		$sql.= " values ";
		$sql.= "(";
		$sql.= "'".$params['resp_name']."',";
		$sql.= "'penanggungjawab',";
		$sql.= "'".$params['resp_position']."',";
		$sql.= "'".$params['resp_idnum']."',";
		$sql.= "'".$params['resp_phone']."',";
		$sql.= "'".$params['resp_hp']."',";
		$sql.= "'".$params['support_email']."',";
		$sql.= "'".$params['client_id']."',";
		$sql.= "'".$params['nofb']."'";
		$sql.= ")";
		$sql.= "on duplicate key ";
		$sql.= "update  ";
		
		$sql.= "name='".$params['resp_name']."',";
		$sql.= "role='penanggungjawab',";
		$sql.= "position='".$params['resp_position']."',";
		$sql.= "idnum='".$params['resp_idnum']."',";
		$sql.= "phone='".$params['resp_phone']."',";
		$sql.= "hp='".$params['resp_hp']."',";
		$sql.= "email='".$params['resp_email']."'";
		$ci->db->query($sql);

		$sql = "insert into fbpics ";
		$sql.= "(name,role,idnum,phone,hp,email,client_id,nofb)";
		$sql.= " values ";
		$sql.= "(";
		$sql.= "'".$params['adm_name']."',";
		$sql.= "'administrasi',";
		$sql.= "'".$params['adm_idnum']."',";
		$sql.= "'".$params['adm_phone']."',";
		$sql.= "'".$params['adm_hp']."',";
		$sql.= "'".$params['support_email']."',";
		$sql.= "'".$params['client_id']."',";
		$sql.= "'".$params['nofb']."'";
		$sql.= ")";
		$sql.= "on duplicate key ";
		$sql.= "update  ";
		
		$sql.= "name='".$params['adm_name']."',";
		$sql.= "role='administrasi',";
		$sql.= "idnum='".$params['adm_idnum']."',";
		$sql.= "phone='".$params['adm_phone']."',";
		$sql.= "hp='".$params['adm_hp']."',";
		$sql.= "email='".$params['adm_email']."'";
		$ci->db->query($sql);

		$sql = "insert into fbpics ";
		$sql.= "(name,role,idnum,phone,hp,email,client_id,nofb)";
		$sql.= " values ";
		$sql.= "(";
		$sql.= "'".$params['technician_name']."',";
		$sql.= "'teknisi',";
		$sql.= "'".$params['technician_idnum']."',";
		$sql.= "'".$params['technician_phone']."',";
		$sql.= "'".$params['technician_hp']."',";
		$sql.= "'".$params['support_email']."',";
		$sql.= "'".$params['client_id']."',";
		$sql.= "'".$params['nofb']."'";
		$sql.= ")";
		$sql.= "on duplicate key ";
		$sql.= "update  ";
		
		$sql.= "name='".$params['technician_name']."',";
		$sql.= "role='teknisi',";
		$sql.= "idnum='".$params['technician_idnum']."',";
		$sql.= "phone='".$params['technician_phone']."',";
		$sql.= "hp='".$params['technician_hp']."',";
		$sql.= "email='".$params['technician_email']."'";
		$ci->db->query($sql);

		$sql = "insert into fbpics ";
		$sql.= "(name,role,idnum,phone,hp,email,client_id,nofb)";
		$sql.= " values ";
		$sql.= "(";
		$sql.= "'".$params['billing_name']."',";
		$sql.= "'billing',";
		$sql.= "'".$params['billing_idnum']."',";
		$sql.= "'".$params['billing_phone']."',";
		$sql.= "'".$params['billing_hp']."',";
		$sql.= "'".$params['support_email']."',";
		$sql.= "'".$params['client_id']."',";
		$sql.= "'".$params['nofb']."'";
		$sql.= ")";
		$sql.= "on duplicate key ";
		$sql.= "update  ";
		
		$sql.= "name='".$params['billing_name']."',";
		$sql.= "role='billing',";
		$sql.= "idnum='".$params['billing_idnum']."',";
		$sql.= "phone='".$params['billing_phone']."',";
		$sql.= "hp='".$params['billing_hp']."',";
		$sql.= "email='".$params['billing_email']."'";
		$ci->db->query($sql);

		$sql = "insert into fbpics ";
		$sql.= "(name,role,idnum,phone,hp,email,client_id,nofb)";
		$sql.= " values ";
		$sql.= "(";
		$sql.= "'".$params['support_name']."',";
		$sql.= "'support',";
		$sql.= "'".$params['support_idnum']."',";
		$sql.= "'".$params['support_phone']."',";
		$sql.= "'".$params['support_hp']."',";
		$sql.= "'".$params['support_email']."',";
		$sql.= "'".$params['client_id']."',";
		$sql.= "'".$params['nofb']."'";
		$sql.= ")";
		$sql.= "on duplicate key ";
		$sql.= "update  ";
		
		$sql.= "name='".$params['support_name']."',";
		$sql.= "role='support',";
		$sql.= "idnum='".$params['support_idnum']."',";
		$sql.= "phone='".$params['support_phone']."',";
		$sql.= "hp='".$params['support_hp']."',";
		$sql.= "email='".$params['support_email']."'";
		$ci->db->query($sql);

		return $sql;
    }
    function updateservice($params){
        $arr = array();
        foreach($params as $key=>$val){
            array_push($arr, ''.$key.'="'.$val.'"');
        }
        $sql = "update fbservices ";
        $sql.= "set ";
        $sql.= implode(",",$arr);
        $sql.= "where id='".$params["id"]."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
	}
	function setAutoExpired(){
		$sql = 'update fbs set expirystatus = "1" ';
		$sql.= 'where date(now())>= date(period2)';
		$ci = & get_instance();
		$ci->db->query($sql);
		return $sql;
	}
	function backupfb($nofb){
		$sql = 'insert into deletedfbs ';
		$sql.= 'select * from fbs where nofb="'.$nofb.'" ';
		$ci = & get_instance();
		$ci->db->query($sql);
		return $sql;
	}
	function removefb($nofb){
		$sql = 'delete from fbs ';
		$sql.= 'where nofb="'.$nofb.'" ';
		$ci = & get_instance();
		$ci->db->query($sql);
		return $sql;
	}
}
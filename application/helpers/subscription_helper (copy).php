<?php


	function getsales(){
		$ci = & get_instance();
		$sql = "select distinct createuser sales from fbs a ";
		$que = $ci->db->query($sql);
		$out = array();
		foreach($que->result() as $res){
			if($res->sales!=='Pilihlah'){
				$out[$res->sales] = $res->sales;
			}
		}
		return $out;
	}
	function getservicecategories(){
		$ci = & get_instance();
		$sql = "select distinct b.name servicecategory from fbs a ";
		$sql.= "left outer join services b on b.id=a.servicecategories ";
		$sql.= "where servicecategories is not null ";
		$que = $ci->db->query($sql);
		$out = array();
		foreach($que->result() as $res){
			if($res->servicecategory!=='Pilihlah'){
				$out[$res->servicecategory] = $res->servicecategory;
			}
		}
		return $out;
	}
	function getcities(){
		$ci = & get_instance();
		$sql = "select distinct city from fbs";
		$que = $ci->db->query($sql);
		$out = array();
		foreach($que->result() as $res){
			$out[$res->city] = $res->city;
		}
		return $out;
	}
	function getclients(){
		$ci = & get_instance();
   		$ci->load->helper("user");
        $id = $ci->session->userdata("user_id");
        $arr = getuserssupervised($id);
        array_push($arr,$id);
		$ids = "(".implode($arr,",").")";

		$sql = "select a.id,";
		$sql.= "case when trim(a.alias)='' then a.name when a.alias is null then a.name else concat(a.name,' (',a.alias,')') end name ,";
		$sql.= "concat(a.npwp,'/',a.siup)npwp,a.business_field,a.fbcomplete,";
		$sql.= "d.id userid,d.username sales,a.address,b.name service,group_concat(c.name)fbname,count(c.client_id)fbcount from clients a ";
		$sql.= "left outer join services b on b.id=a.service_id ";
		$sql.= "left outer join fbs c on c.client_id=a.id ";
		$sql.= "left outer join users d on d.id=a.sale_id ";
		$sql.= "where a.active='1' ";
		$sql.= "and d.id in " . $ids . " ";
		$sql.= "group by a.id,a.name,a.fbcomplete,a.address,b.name ";
		$que = $ci->db->query($sql);
		$res = $que->result();
		return array("res"=>$res,"tot"=>$que->num_rows());
	}
	function getpics($clientid){
		$obj = new Client();
		$obj->where('id',$clientid)->get();
		return $obj;
	}
	function clientswithfb(){
		$ci = & get_instance();
		$sql = "select count(distinct(client_id)) total from fbs";
		$que = $ci->db->query($sql);
		$res = $que->result();
		return $res[0]->total;
	}
	function getfbs($clientid = null){
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
		$sql.= "c.username,";
		$sql.= "b.nofb,b.name fbname,";
		$sql.= "case b.businesstype when 'Pilihlah' then '' else b.businesstype end businesstype,";
		$sql.= "b.servicecategories,";
		$sql.= "b.siup,";
		$sql.= "b.npwp,";
		$sql.= "b.address,";
		$sql.= "b.billaddress,";
		$sql.= "b.description,";
		$sql.= "case when b.city = '' then '-' when b.city is null then '-' else b.city end city,";
		$sql.= "case when b.city = '' then d.name when b.city is null then d.name else concat(d.name,'/',b.city) end branchcity,";
		$sql.= "b.telp,";
		$sql.= "b.fax,";
		$sql.= "b.activationdate,";
		$sql.= "b.period1,";
		$sql.= "b.period2,";
		$sql.= "date_format(b.period2,'%M') lastmonth,";
		$sql.= "b.services,";
		$sql.= "d.name branch, ";
		$sql.= "case b.status ";
		$sql.= " when '0' then 'ignore' ";
		$sql.= " when '1' then 'valid' ";
		$sql.= " when '2' then 'canceled' ";
		$sql.= " when '3' then 'expired' end fbstatus,";
		$sql.= "b.completed ";
		$sql.= "from clients a ";
		$sql.= "right outer join fbs b on b.client_id=a.id ";
		$sql.= "left outer join users c on c.id=a.sale_id ";
		$sql.= "left outer join branches d on d.id=a.branch_id ";
		if($clientid === null){
			$sql.= "";
		}else{
			$sql.= "where b.client_id=".$clientid." ";
		}
		$sql.= "order by a.name ";
		$query = $ci->db->query($sql);
		$res = $query->result();
		return array("res"=>$res,"tot"=>$query->num_rows());
	}
	function getnamebyclientid($clientid){
		$sql = "select b.name,b.address,b.city,phone,";
		$sql.= "fax,siup,npwp from clients b ";
		$sql.= "where b.id=".$clientid;
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		$res = $que->result();
		if(count($res)>0){
			return $res[0];
		}else{
			return false;
		}
	}
	function generatefb($clientid){
		$sql = "select client_id from fbs where client_id=".$clientid;
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		$numrows = $que->num_rows();
		$sql = "select case branch_id ";
		$sql.= " when '1' then concat('SBY',date_format(now(),'%Y%m%d'),lpad(a.id,6,'0'),lpad(".$numrows.",3,'0')) ";
		$sql.= " when '2' then concat('JKT',date_format(now(),'%Y%m%d'),lpad(a.id,6,'0'),lpad(".$numrows.",3,'0')) ";
		$sql.= " when '3' then concat('MLG',date_format(now(),'%Y%m%d'),lpad(a.id,6,'0'),lpad(".$numrows.",3,'0')) ";
		$sql.= " when '4' then concat('BLI',date_format(now(),'%Y%m%d'),lpad(a.id,6,'0'),lpad(".$numrows.",3,'0')) ";
		$sql.= "end genfb ";
		$sql.= "from clients a where id=".$clientid;
		$que = $ci->db->query($sql);
		$res = $que->result();
		return $res[0]->genfb;
	}
	function sendNotification($arr = array()){
		$ci = & get_instance();
		$message = "User " . $ci->session->userdata('username') . " ";
		$message.= "telah melakukan aktifitas penyalinan FB dari " . $arr['nofb'];
		$message.= "ke ";
		$message.= "" . $arr['newnofb'];
		sendemail($message);
	}
	function sendemail($message){
		$ci = & get_instance();
		$msg = "";
		$msg.= "Yth<br />";
		$msg.= "Puji P<br />";
		$msg.= "<br />";
		$msg.= "Di Tempat<br />";
		$msg.= $message;
		echo $ci->common->send_mail('puji@padi.net.id', '[PadiApp] Salin FB', $msg,'puji@padi.net.id');
	}
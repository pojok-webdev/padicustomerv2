<?php
function get_ts(){
	$ci = & get_instance();
	$id = $ci->session->userdata["user_id"];
	$obj = new User();
	$obj->where("id",$id)->get();
	return $obj;
}
function ts_get_installsite(){
	$userbranch = getuserbranches();
	$obj = new Install_site();
	$ci = & get_instance();
	$sql = "select a.id,a.install_request_id,case when c.alias is null then c.name else concat(c.name,' (',c.alias,')')  end name,";
	$sql.= "a.address,a.city,d.username,f.install_date,f.fix_install_date execdate,";
	$sql.= "a.pic_name,a.pic_phone_area,a.pic_phone,group_concat(g.name) branch,";
	$sql.= "a.status,case a.status when '0' then 'Belum selesai' when '1' then 'selesai' end installstatus ,f.create_date ";
	$sql.= "from install_sites a ";
	$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
	$sql.= "left outer join clients c on c.id=b.client_id ";
	$sql.= "left outer join users d on d.id=c.user_id ";
	$sql.= "left outer join branches_client_sites e on e.client_site_id=b.id ";
	$sql.= "left outer join install_requests f on f.id=a.install_request_id ";
	$sql.= "left outer join branches g on g.id=e.branch_id ";
	$sql.= "group by a.id,a.install_request_id, c.alias,c.name,";
	$sql.= "a.address,a.city,d.username,f.install_date,f.fix_install_date,";
	$sql.= "a.pic_name,a.pic_phone_area,a.pic_phone,a.status,f.create_date ";
	$que = $ci->db->query($sql);
	$obj = $que->result();
	return $obj;	
}
function sales_get_installsite(){
	$ci = & get_instance();
	$userbranch = getuserbranches();
	$brnc = "(".implode(",",$userbranch).")";
	$id = $ci->session->userdata["user_id"];
	$arr = array();
	$users = getsubordinates($id,$arr);
	$userarr = implode(",",$users);
	$obj = new Install_site();
	$sql = "select a.id,a.install_request_id,case when c.alias is null then c.name else concat(c.name,' (',c.alias,')')  end name,";
	$sql.= "a.address,a.city,d.username,f.install_date,f.fix_install_date execdate,";
	$sql.= "a.pic_name,a.pic_phone_area,group_concat(g.name) branch,a.status ";
	$sql.= "from install_sites a ";
	$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
	$sql.= "left outer join clients c on c.id=b.client_id ";
	$sql.= "left outer join users d on d.id=c.user_id ";
	//$sql.= "left outer join branches_client_sites e on e.client_site_id=b.id ";
	$sql.= "left outer join install_requests f on f.id=a.install_request_id ";
	$sql.= "left outer join branches g on g.id=c.branch_id ";
	$sql.= "where d.id in($userarr) and  c.branch_id in $brnc";
	$sql.= "group by a.id,a.install_request_id, c.alias,c.name,";
	$sql.= "a.address,a.city,d.username,f.install_date,f.fix_install_date ,";
	$sql.= "a.pic_name,a.pic_phone_area,	a.status ";
	$obj->query($sql);
	return $obj;	
}
function getresumetext($resume){
	switch($resume){
		case '0':
		$resume = 'Belum ada kesimpulan';
		break;
		case '1':
		$resume = 'Bisa dilaksanakan';
		break;
		case '2':
		$resume = 'Bisa dilaksanakan dg syarat';
		break;
		case '3':
		$resume = 'Tidak bisa dilaksanakan';
		break;
	}
}
function toremovestatus($status){
	switch($status){
		case '0':
			$out = '';
		break;
		case '1':
			$out = '<span class="pointer removevas icon-trash"></span>&nbsp;';
		break;
		case '2':
			$out = '';
		break;
	}
	return $out;
}
function gettopologivsdfiles($id){
	$directory = '/home/klien/www/padicustomer/padiapp-data/installs/vsd/'.$id;
	$filecount = 0;
	$files = glob($directory . "*.vsd");
	$arr = array();
	if ($files){
	  foreach($files as $fl){
		array_push($arr,substr($fl,55,strlen($fl) - 55));
	  }
	}      
	return($arr);
  }

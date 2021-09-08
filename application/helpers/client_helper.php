<?php
function category_description(){
	$description = "FFR : FFR\n";
	$description.= "Platinum : > 8 jt\n";
	$description.= "Gold : >3 jt - 8 jt\n";
	$description.= "Silver : > 1,25 jt - 3 jt\n";
	$description.= "Bronze : <=1,25 jt \n";
	return $description;
}
function getroles(){
	$obj = new Picrole();
	$obj->get();
	return $obj;
}
function getrolescombodata(){
	$objs = new Picrole();
	$objs->get();
	$out = array();
	foreach($objs as $obj){
		$out[$obj->id] = $obj->name;
	}
	return $out;
}
function getsalescombodata(){
	$objs = new User();
	$objs->where('active','1')->where_related('group','id','3')->get();
	$out = array();
	foreach($objs as $obj){
		$out[$obj->id] = $obj->username;
	}
	return $out;
}
function getclientcombodata(){
	$ci = & get_instance();
	$objs = $ci->pclient->populate();
	$out = array();
	foreach($objs as $obj){
		$out[$obj->id] = $obj->name . ' <strong>(' . $obj->id . ')</strong>';
	}
	return $out;
}
function getbranchescombodata(){
	$objs = new Branch();
	$objs->where('active','1')->get();
	$out = array();
	foreach($objs as $obj){
		$out[$obj->id] = $obj->name;
	}
	return $out;
}
function populate($status=array('9'),$active=array('1'),$user=null){
	$pclient = new Pclient();
	return $pclient->populateclient($status,$active,$user);
}
function adm_populate(){
	$userbranch = getuserbranches();
	$branches = implode($userbranch,",");
	$ci = & get_instance();
	$sql = "select a.id,a.name,a.alias,b.id userid,b.username,a.address,a.phone_area,a.phone,a.sale_id, ";
	$sql.= 'case a.clientcategory ';
	$sql.= 'when "1" then "FFR" ';
	$sql.= 'when "2" then "Platinum" ';
	$sql.= 'when "3" then "Gold" ';
	$sql.= 'when "4" then "Silver" ';
	$sql.= 'when "5" then "Bronze" ';
	$sql.= 'else "Uncategorized" ';
	$sql.= 'end clientcategory ';
	$sql.= "from clients a ";
	$sql.= "left outer join users b on b.id=a.user_id ";
	$sql.= "where branch_id in ($branches) and a.active='1' ";
	$res = $ci->db->query($sql);
	return $res->result();
}
function sales_populate($active="1",$status="1",$hide="0"){
	$ci = & get_instance();
	$userbranch = getuserbranches();
	$branches = implode($userbranch,",");
	$id = $ci->session->userdata["user_id"];
	$teams = getuserssupervised($id);
	array_push($teams,$id);
	$supervised = implode(",",$teams);
	$sql = "select distinct a.id,case when alias is null then a.name else concat(a.name,' (',a.alias,')')  end clientname,a.name,";
	$sql.= "b.id userid,b.username,c.username sales,a.address,a.phone_area,a.phone,d.pic, ";
	$sql.= 'a.alias,';
	$sql.= "case clientcategory ";
	$sql.= "when '1' then 'FFR' ";
	$sql.= "when '2' then 'Platinum' ";
	$sql.= "when '3' then 'Gold' ";
	$sql.= "when '4' then 'Silver' ";
	$sql.= "when '5' then 'Bronze' ";
	$sql.= "end category ";

		$sql.= "from clients a ";
	$sql.= "left outer join users b on b.id=a.user_id ";
	$sql.= "left outer join users c on c.id=a.sale_id ";
	$sql.= "left outer join (select id,client_id,prole,name pic from pics where prole='PEMOHON') d on d.client_id=a.id ";
	$sql.= "where a.sale_id in (".$supervised.") and a.active='".$active."' and a.status='".$status."' and a.hide='".$hide."' ";
	$res = $ci->db->query($sql);
	return $res->result();
}
function saveamhistory($params){
	$ci = & get_instance();
	$sql = "insert into amhistories ";
	$sql.= "(client_id,user_id,username,displacementdate,description,createuser) ";
	$sql.= "values (".$params['client_id'].",".$params['user_id'].",'".$params['username']."','".$params['displacementdate']."','".$params['description']."','".$params['createuser']."') ";
	$ci->db->query($sql);
}
function getbusinesstypes(){
	$sql = 'select * from business_fields ';
	$ci = & get_instance();
	$que = $ci->db->query($sql);
	return array(
		'res'=>$que->result(),
		'cnt'=>$que->num_rows()
	);
}

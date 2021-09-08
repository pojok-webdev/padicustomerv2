<?php
function test($params){
	$ci = & get_instance();
	$obj = new Ticket();
	foreach($params as $key=>$val){
		$obj->$key = $val;
	}
	$obj->save();
	return $ci->db->insert_id();
}
function ts_populate(){
	$userbranch = implode(",",getuserbranches());
	$sql = "select x.id,x.ticket_id,x.request_date1,x.troubleshoottype,x.nameofmtype,x.complaint,";
	$sql.= "x.address,x.status,x.troubleshoot_date,a.kdticket,";
	$sql.= "group_concat(i.name) branch,b.address clientsiteaddress from troubleshoot_requests x ";
	$sql.= "left outer join tickets a on a.id=x.ticket_id ";
	$sql.= "left outer join (";
	$sql.= " select a.id,b.branch_id,a.address from client_sites a ";
	//$sql.= " left outer join branches_client_sites b on b.client_site_id=a.id ";
	$sql.= " left outer join clients b on b.id=a.client_id ";
	$sql.= " where b.branch_id in (".$userbranch.")";
	$sql.= ")b  ";
	$sql.= " on b.id=a.client_site_id ";
	$sql.= "left outer join (select a.id from backbones a ";
	$sql.= "left outer join backbones_branches b on b.backbone_id=a.id where branch_id in (".$userbranch."))c  on c.id=a.client_site_id ";
	$sql.= "left outer join (select a.id from datacenters a where branch_id in (".$userbranch."))d  on d.id=a.datacenter_id ";
	$sql.= "left outer join (select a.id from btstowers a where a.branch_id in (".$userbranch."))e  on e.id=a.btstower_id ";
	$sql.= "left outer join (select a.id from ptps a where a.branch_id in (".$userbranch."))f on f.id=a.ptp_id ";
	$sql.= "left outer join (select a.id from cores a where a.branch_id in (".$userbranch."))g on g.id=a.core_id ";
	$sql.= "left outer join (select a.id from aps a left outer join btstowers b on b.id=a.btstower_id where b.branch_id in (".$userbranch."))h on h.id=a.ap_id ";
	$sql.= "left outer join branches i on i.id=b.branch_id  ";
	$sql.= "where b.id is not null ";
	$sql.= "or c.id is not null ";
	$sql.= "or d.id is not null ";
	$sql.= "or e.id is not null ";
	$sql.= "or f.id is not null ";
	$sql.= "or g.id is not null ";
	$sql.= "or h.id is not null ";
	$sql.= "group by x.id,x.ticket_id,x.request_date1,x.troubleshoottype,x.nameofmtype,x.complaint,b.address, ";
	$sql.= "x.address,x.status,x.troubleshoot_date,kdticket ";
//	echo $sql;
	$ci = & get_instance();
	$que = $ci->db->query($sql);
	$res = $que->result();
//	$objs = new Troubleshoot_request();
//	$objs->query($sql);
//	return $objs;
	return $res;
/*	foreach($objs as $obj){
		echo $obj->id . "<br />";
	}*/
}
	function get_obj_by_id($id){
		$sql = "select a.id,a.client_site_id,b.kdticket,a.troubleshoottype,d.name clientname,a.nameofmtype,a.complaint,e.name servicename ,d.address clientaddress,d.city clientcity,a.activities,a.resume from troubleshoot_requests a ";
		$sql.= "left outer join (select id,kdticket from tickets) b on b.id=a.ticket_id ";
		$sql.= "left outer join (select id,client_id,service_id from client_sites) c on c.id=a.client_site_id ";
		$sql.= "left outer join (select id,name,address,city from clients) d on d.id=c.client_id ";
		$sql.= "left outer join services e on e.id=c.service_id ";
		
		$sql.= "where a.id=".$id;
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return $que->result()[0];
//		$obj = new Troubleshoot_request();
//		$obj->where('id',$id)->get();
//		return $obj;
	}
	function get_ba_by_id($id){
		$sql = "select * from troubleshoot_bas where troubleshoot_request_id=".$id;
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return array("result"=>$que->result(),"num_rows"=>$que->num_rows);
	}//troubleshoot_image
	function get_images_by_id($id){
		$sql = "select * from troubleshoot_images where troubleshoot_request_id=".$id." ";
		$sql.= "order by roworder asc";
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return array("result"=>$que->result(),"num_rows"=>$que->num_rows);
	}//troubleshoot_officer
	function get_officer_by_id($id){
		$sql = "select * from troubleshoot_officers where troubleshoot_request_id=".$id." ";
//		$sql.= "order by roworder asc";
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return array("result"=>$que->result(),"num_rows"=>$que->num_rows);
	}//troubleshoot_material
	function get_materials_by_id($id){
		$sql = "select * from troubleshoot_materials where troubleshoot_request_id=".$id." ";
//		$sql.= "order by roworder asc";
		$ci = & get_instance();
		$que = $ci->db->query($sql);
		return array("result"=>$que->result(),"num_rows"=>$que->num_rows);
	}//troubleshoot_material
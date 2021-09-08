<?php
function ticket_save($params){
	$ci = & get_instance();
	$obj = new Ticket();
	foreach($params as $key=>$val){
		$obj->$key = $val;
	}
	$obj->save();
	return $ci->db->insert_id();
}
function getstatistics(){
	$sql = "select a.clientname,count(a.clientname) total from tickets a ";
	$sql.= "group by a.clientname";
	$ticket = new Ticket();
	$ticket->query($sql);
	return $ticket;
}
function ticket_populate2($custombranch=null){
	$limit = 1000;
	$beginquerydate = '2020-10-1';
	if($custombranch===null){
		$userbranches = implode(",",getuserbranches());
	}else{
		$userbranches = $custombranch;
	}
	$sql = "select distinct a.id,a.kdticket,b.address,a.create_date,a.createuser,a.status,a.solution,";
	$sql.= "datediff(now(),ticketstart) age,";
	$sql.= "case ";
	$sql.= " when l.id in (4) and a.status='0' and (floor((unix_timestamp(now())-unix_timestamp(ticketstart))/60/60/24) between 3 and 6) then 'yellow' ";
	$sql.= " when l.id in (1) and a.status='0' and (floor((unix_timestamp(now())-unix_timestamp(ticketstart))/60/60/24) between 3 and 6) then 'violet' ";
	$sql.= " when l.id in (3,8) and a.status='0' and (floor((unix_timestamp(now())-unix_timestamp(ticketstart))/60/60/24) between 3 and 6) then 'pink' ";
	$sql.= " when l.id in (2) and a.status='0' and (floor((unix_timestamp(now())-unix_timestamp(ticketstart))/60/60/24) between 3 and 6) then 'blue' ";
	$sql.= " when l.id in (1,2,3,4,8) and a.status='0' and (floor((unix_timestamp(now())-unix_timestamp(ticketstart))/60/60/24) > 7) then 'red' ";
	$sql.= " when a.status='1'  then 'white' ";
	$sql.= " else  'green'  end  color,";
	$sql.= "case ";
	$sql.= " when l.id in (4) and a.status='0' then 'yellow' ";
	$sql.= " when l.id in (1) and a.status='0' then 'violet' ";
	$sql.= " when l.id in (3,8) and a.status='0' then 'pink' ";
	$sql.= " when l.id in (2) and a.status='0' then 'blue' ";
	$sql.= " when l.id in (1,2,3,4,8) and a.status='0' then 'red' ";
	$sql.= " when a.status='1'  then 'white' ";
	$sql.= " else  'green'  end  colorx,";
	$sql.= "case ";
	$sql.= " when datediff(now(),ticketstart) between 2 and 7 then 'between2and7' ";
	$sql.= " when datediff(now(),ticketstart) >8 then 'morethan7' ";
	$sql.= "end specialage, ";
	$sql.= "case a.status ";
	$sql.= "when '0' then 'open' ";
	$sql.= "when '1' then 'close' end ticketStatus,";
	$sql.= "case a.status ";
	$sql.= "when '0' then date_format(now(),'%d/%m/%Y %H:%i:%s') ";
	$sql.= "when '1' then date_format(ticketend,'%d/%m/%Y %H:%i:%s') end ticketEnd,";
	$sql.= "a.clientname,b.branch,a.reporterphone,a.requesttype,a.parentid,b.id cid,c.id backboneid,d.id btsid,";
	$sql.= "e.id dcid,f.id ptpid,reporter,i.trid,j.hastroubleshoot,";
	$sql.= "date_format(ticketstart,'%d/%m/%Y %H:%i:%s') ticketstart,";
	$sql.= "date(ticketstart) rawticketstart,";
	$sql.= "case ";
	$sql.= "when a.status = '0' then date_format(ticketend,'%d/%m/%Y %H:%i:%s')  ";
	$sql.= "when (a.status = '1' and ticketend is not null) then date_format(ticketend,'%d/%m/%Y %H:%i:%s') ";
	$sql.= "when (a.status = '1' and ticketend is null) then date_format(now(),'%d/%m/%Y %H:%i:%s') end ticket_end, ";
	$sql.= "case b.clientcategory ";
	$sql.= "when '1' then 'FFR' ";
	$sql.= "when '2' then 'Platinum' ";
	$sql.= "when '3' then 'Gold' ";
	$sql.= "when '4' then 'Bronze' ";
	$sql.= "when '5' then 'Silver' ";
	$sql.= "else 'Uncategorized' ";
	$sql.= "end clientcategory,";
	$sql.= 'concat(case when ticketend is null then datediff(now(),ticketstart) when ticketend="0000-00-00 00:00:00" then datediff(now(),ticketstart) else datediff(ticketend,ticketstart) end," hari ",';

	$sql.= 'time_format(case when ticketend is null then timediff(now(),ticketstart) when ticketend="0000-00-00 00:00:00" then timediff(now(),ticketstart) else timediff(ticketend,ticketstart) end,"%H") % 24, ';

	$sql.= 'time_format(case when ticketend is null then timediff(now(),ticketstart) when ticketend="0000-00-00 00:00:00" then timediff(now(),ticketstart) else timediff(ticketend,ticketstart) end,"  jam %i menit %s detik")) duration3, ';
	

	$sql.= "k.name subrootcause,l.name mainrootcause,group_concat(n.name)vases, ";
	$sql.= "case l.name when 'Backbone' then '1' when 'BTS' then '1' when 'Lastmile PadiNET' then '1' when 'Local Pelanggan' then '1' when 'Lastmile Vendor' then '1' else '0'  end alertflag ";
	$sql.=" from (";
	$sql.=" select * from tickets ";
	$sql.=" where ";
	$sql.=" create_date>'".$beginquerydate."' ";
	//$sql.=" limit ".$limit." ";
	$sql.=" ) a ";
	$sql.="left outer join (";
	$sql.=" select distinct a.id,a.address,d.clientcategory,d.id clientid, ";
	$sql.=" case d.branch_id ";
	$sql.=" when '1' then 'Surabaya' ";
	$sql.=" when '2' then 'Jakarta' ";
	$sql.=" when '3' then 'Malang' ";
	$sql.=" when '4' then 'Bali' end branch ";
	$sql.=" from client_sites a ";
	$sql.=" left outer join clients d on d.id=a.client_id ";
	$sql.=" left outer join branches c on c.id=d.branch_id ";
	$sql.=" where c.id in (".$userbranches.") ";
	$sql.=") b on b.id=a.client_site_id ";
	
	$sql.="left outer join (";
	$sql.=" select distinct a.id from ";
	$sql.=" backbones a ";
	$sql.=" left outer join backbones_branches b on b.backbone_id=a.id ";
	$sql.=" left outer join branches c on c.id=b.branch_id where c.id in (".$userbranches.") ";
	$sql.=") c on c.id=a.backbone_id ";
	
	$sql.="left outer join (";
	$sql.=" select distinct a.id from btstowers a ";
	$sql.=" left outer join branches b on b.id=a.branch_id ";
	$sql.=" where b.id in (".$userbranches.") ) d on d.id=a.btstower_id ";
	
	$sql.="left outer join (";
	$sql.=" select distinct a.id from datacenters a ";
	$sql.=" left outer join branches b on b.id=a.branch_id ";
	$sql.=" where b.id in (".$userbranches.") ) e on e.id=a.datacenter_id ";
	
	$sql.="left outer join (";
	$sql.=" select distinct a.id from ptps a ";
	$sql.=" left outer join branches b on b.id=a.branch_id ";
	$sql.=" where b.id in (".$userbranches.") ) f on f.id=a.ptp_id ";
	
	$sql.="left outer join (";
	$sql.=" select distinct a.id from cores a ";
	$sql.=" left outer join branches b on b.id=a.branch_id ";
	$sql.=" where b.id in (".$userbranches.") ) g on g.id=a.core_id ";
	
	$sql.="left outer join (";
	$sql.=" select distinct a.id from aps a ";
	$sql.=" left outer join btstowers b on b.id=a.btstower_id ";
	$sql.=" left outer join branches c on c.id=b.branch_id ";
	$sql.=" where c.id in (".$userbranches.") ) h on h.id=a.ap_id ";
	
	$sql.="left outer join (";
	$sql.=" select count(id) trid,ticket_id from troubleshoot_requests ";
	$sql.=" where status='0' group by ticket_id ) i on i.ticket_id=a.id ";
	
	$sql.="left outer join (";
	$sql.=" select count(id) hastroubleshoot,ticket_id ";
	$sql.=" from troubleshoot_requests group by ticket_id) j on j.ticket_id=a.id ";


	$sql.= "left outer join ticketcauses k on k.id=a.cause_id ";
	$sql.= "left outer join ticketcausecategories l on l.id=k.category_id ";
	$sql.= "left outer join client_vases m on m.client_id=b.clientid ";
	$sql.= "left outer join vases n on n.id=m.vas_id ";

	$sql.=" where ";
	$sql.=" (b.id is not null or c.id is not null or d.id is not null or e.id is not null or f.id is not null or g.id is not null or h.id is not null) ";

	$sql.=" and ";

	$sql.="  create_date>'".$beginquerydate."' ";


	$sql.= "group by a.id,a.kdticket,b.address,a.create_date,a.createuser,a.status,a.status,a.clientname,b.branch,a.reporterphone,a.requesttype,a.parentid,b.id ,c.id,d.id ,e.id,f.id,reporter,i.trid,j.hastroubleshoot,ticketstart, a.status,b.clientcategory,ticketend,k.name ,l.name ";
	$sql.= "order by create_date desc";
	//$sql.=" limit 0,".$limit." ";
	$obj = new Ticket();
	$obj->query($sql);
	return $obj;
}
function getservices($ticket_id){
	$sql = "select distinct b.name from tickets a left outer join clientservices b on a.client_site_id=b.client_site_id where a.id=".$ticket_id;
	$objs = new Ticket();
	$objs->query($sql);
	$arr = array();
	foreach($objs as $obj){
		array_push($arr,$obj->name);
	}
	return implode(",",$arr);
}
function ticket_populate($status=null){
	$objs = new Ticket();
	$userbranch = getuserbranches();
	if($status !== null){
		$objs->where('status',$status);
		$objs->where_in_related("client_site/branch","id",$userbranch);
		$objs->order_by('create_date','asc')->get();
		return $objs;
	}
	$objs->where_in_related("client_site/branch","id",$userbranch)->order_by('create_date','asc')->get();
	return $objs;
}
function parentupdate(){
	$ci = & get_instance();
	$ci->load->model('pticket');
	return $ci->pticket->upstreamparentupdate($params);
}
function ticket_update($params){
	$ci = & get_instance();
	$ci->load->model('pticket');
	return $ci->pticket->update($params);
	$obj = new Ticket();
	if($params['status']==='1'){
		$params['ticketend'] = $obj->currentdatetime();
	}
	$obj->where('id',$params['id'])->update($params);
	return $obj->check_last_query();
}
function ticket_gettickets(){
	$ticket = new Ticket();
	$ticket->where('status','0')->get();
	return $ticket;
}
function ticket_getticket($id){
	$ticket = new Ticket();
	$ticket->where('id',$id)->get();
	return $ticket;
}
function ticket_get_ticket_by_client($type,$id){
	$ticket = new Ticket();
	$ticket->where('requesttype',$type)->where('client_id',$id)->get();
	return $ticket;		
}
function getclients(){
	$userbranch = getuserbranches();
	$clients = new Client();
	$clients->where('active','1')->where_in_related("client_site/branch","id",$userbranch)->order_by('name','asc')->get();
	return $clients;
}
function getclientsites(){
	$ci = & get_instance();
	$userbranch = getuserbranches();
	$query = "select distinct a.id,b.id client_site_id,a.name,a.alias,b.address,a.branch_id,b.pic_email,b.pic_name,b.pic_phone ";
	$query.= "from clients a left outer join client_sites b on a.id=b.client_id ";
	//$query.= "left outer join branches_client_sites c on c.client_site_id=b.id ";
	$query.= "where a.status='1' and a.active='1' and trim(name)!=''";
	$result = $ci->db->query($query);
	$clients = $result->result();
	return $clients;
}
function getcustombranches($params){
	$arr = array();
	for($c=0;$c<strlen($params);$c++){
		array_push($arr,substr($params,$c,1));
	}
	return implode(",",$arr);
}
function get_ticketcause_combo_data($firstrow){
	$sql = "select * from ticketcauses ";
	$sql.= "order by vieworder asc";
	$ci = & get_instance();
	$result = $ci->db->query($sql);
	$objs = $result->result();
	$out = array();
	if($firstrow !==''){
		$out[0] = $firstrow;			
	}
	foreach($objs as $obj){
		$out[$obj->id] = $obj->name;
	}
	return $out;
}
function get_ticketcausecategory_combodata($firstrow){
	$ci = & get_instance();
	$cats = $ci->pticket->get_ticketcausecategory_combodata();
	$objs = $cats['res'];
	$out = array();
	if($firstrow !==''){
		$out[0] = $firstrow;
	}
	foreach($objs as $obj){
		$out[$obj->id] = $obj->name;
	}
	return $out;
}
function ticketcauses($category_id){
	$ci = & get_instance();
	$causes = $ci->pticket->getcausebycategory($category_id);
	return $causes['res'];
}
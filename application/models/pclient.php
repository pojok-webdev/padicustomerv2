<?php
class Pclient extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getvas($client_id){
        $sql = 'select a.name client,c.name,c.description ';
        $sql.= 'from clients a left outer join  client_vases b on b.client_id = a.id ';
        $sql.= 'left outer join vases c on c.id=b.vas_id ';
        $sql.= 'where b.vas_id is not null ';
        $sql.= 'and client_id = ' . $client_id . ' ';
        $ci = & get_instance();
        $res = $ci->db->query($sql);
        return $res->result();
    }
	function get_combo_data($first_data='',$status=array('9'),$active=array('1'),$user=null){
		$out = array();
		if($first_data!=''){
			$out[0] = $first_data;
        }
        $sql = "select * from clients ";
        $sql.= "where active in('".implode("','",$active)."') ";
        $ci = & get_instance();
        $res = $ci->db->query($sql);
		foreach ($res->result() as $client){
			$out[$client->id] = $client->name;
		}
		return $out;
	}
    function getclient($name="",$segment=0,$offset=0){
        if(($segment===0)&&($offset===0)){
            $limit = " ";
        }else{
            $limit = "limit ".$segment.", ".$offset." ";
        }
        $ci = & get_instance();
        $sql = "select a.id,concat(b.name,'(',a.address,')') name,a.address from client_sites a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where name like '%".$name."%' ";
        $sql.= $limit;
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getclient2($name="",$segment=0,$offset=0){
        if(($segment===0)&&($offset===0)){
            $limit = " ";
        }else{
            $limit = "limit ".$segment.", ".$offset." ";
        }
        $ci = & get_instance();
        $sql = "select a.id,a.name,a.address from clients a ";
        $sql.= "where name like '%".$name."%' ";
        $sql.= $limit;
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getclientbysales($name="",$segment=0,$offset=0){
        if(($segment===0)&&($offset===0)){
            $limit = " ";
        }else{
            $limit = "limit ".$segment.", ".$offset." ";
        }
        $ci = & get_instance();
   		$this->load->helper("user");
        $id = $ci->session->userdata("user_id");
        $arr = getuserssupervised($id);
        array_push($arr,$id);
		$ids = "(".implode($arr,",").")";
        $sql = "select a.id,concat(b.name,'(',a.address,')') name from client_sites a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where name like '%".$name."%' ";
        $sql.= "and b.sale_id in " . $ids;
        $sql.= $limit;
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getclientbyid($id){
        $sql = "select b.id clientid,b.name,b.address,b.alias,e.username am,dpp, ";
        $sql.= "group_concat(d.name)services,group_concat(f.name) pic ";
        $sql.= "from  ";
        $sql.= "clients b ";
        $sql.= "left outer join client_sites c on c.client_id=b.id ";
        $sql.= "left outer join clientservices d on d.client_site_id=c.id ";
        $sql.= "left outer join users e on e.id=b.user_id ";
        $sql.= "left outer join pics f on f.client_id=b.id ";
        $sql.= "left outer join (select client_id,dpp,dpp+ppn tot from fbfees where name='monthly') g on g.client_id=b.id ";
        $sql.= "where b.id=" . $id . " ";
        $sql.= "group by ";
        $sql.= "b.id,b.name,b.address,b.alias,e.username ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        $arr = array();
        $arr["name"] = $res->name;
        $arr["address"] = $res->address;
        $arr["am"] = $res->am;
        $arr["dpp"] = $res->dpp;
        $arr["services"] = $res->services;
        $arr["pic"] = $res->pic;
        return $arr;
    }
    function getcategories(){
        return array(
            '0'=>'Pilihlah',
            '1'=>'FFR ',
            '2'=>'Platinum (>8 Jt)',
            '3'=>'Gold (>3 Jt - 8 Jt)',
            '4'=>'Silver (>1.25 Jt - 3 Jt)',
            '5'=>'Bronze (< 1.25 Jt)',
            '6'=>'Oryza/PC'
        );
    }
    function getclientcategory(){
        $sql = "select id,name,address ,clientcategory,";
        $sql.= "case clientcategory ";
        $sql.= "when '1' then 'FFR' ";
        $sql.= "when '2' then 'Platinum' ";
        $sql.= "when '3' then 'Gold' ";
        $sql.= "when '4' then 'Silver' ";
        $sql.= "when '5' then 'Bronze' ";
        $sql.= "end category ";
        $sql.= "from clients ";
        $sql.= "where active='1' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        return array(
            'tot'=>$tot,
            'res'=>$res
        );
    }
    function getclientcategorybyid($id){
        $sql = "select id,name,address ,clientcategory,";
        $sql.= "case clientcategory ";
        $sql.= "when '1' then 'FFR' ";
        $sql.= "when '2' then 'Platinum' ";
        $sql.= "when '3' then 'Gold' ";
        $sql.= "when '4' then 'Silver' ";
        $sql.= "when '5' then 'Bronze' ";
        $sql.= "end category ";
        $sql.= "from clients ";
        $sql.= "where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        if($tot>0){
            return $res[0] ;
        }else{
            return false;
        }
    }
    function getservicesbyid($id){
        $sql = "select a.name from clientservices a ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "where c.id=" . $id ;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        $arr = array();
        foreach($res as $obj){
            array_push($arr,'"name":"'.$obj->name.'"');
        }
        return $arr;
    }
    function getcclientbyid($id){
        $sql = "select concat(a.name,'-',b.nofb)name,";
        $sql.= "case when b.npwp is null then '-' else b.npwp end npwp,";
        $sql.= "case when b.siup is null then '-' else b.siup end siup,";
        $sql.= "a.address,a.city,a.branch_id, ";
        $sql.= "a.category_id,a.phone,a.phone_area,a.fax_area,a.fax from clients a ";
        $sql.= "left outer join fbs b on b.client_id=a.id ";
        $sql.= "where b.nofb='".$id."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        $arr = array();
        array_push($arr,'"name":"'.$res->name.'"');
        array_push($arr,'"npwp":"'.$res->npwp.'"');
        array_push($arr,'"siup":"'.$res->siup.'"');
        array_push($arr,'"address":"'.$res->address.'"');
        array_push($arr,'"branch_id":"'.$res->branch_id.'"');
        array_push($arr,'"phone":"'.$res->phone_area.'-'.$res->phone.'"');
        array_push($arr,'"fax":"'.$res->fax_area.'-'.$res->fax.'"');
        array_push($arr,'"city":"'.$res->city.'"');
        array_push($arr,'"city":"'.$res->city.'"');
        array_push($arr,'"city":"'.$res->city.'"');
        return $arr;
    }
    function getpics($client_id){
        $sql = "select a.name,a.role,a.position,a.idnum,a.phone,a.hp, ";
        $sql.= "a.email from fbpics a ";
        $sql.= "where id='".$id."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result()[0];
        $arr = array(
            'adm'=>array(),
            'billing'=>array(),
            'resp'=>array(),
            'subscriber'=>array(),
            'support'=>array(),
            'teknis'=>array()
        );
        return $arr;
    }
    function getfbpics($client_id){
        $sql = "select ADM.name,RESP.name,BILLING.name,SUBSCRIBER.name,SUPPORT.name,TEKNIS.name from clients A   ";
        $sql.= "left outer join  ";
        $sql.= "(select client_id,name from fbpics where role='adm' and client_id=".$client_id.")ADM on ADM.client_id=A.id   ";
        $sql.= "left outer join   ";
        $sql.= "(select client_id,name from fbpics where role='adm' and client_id=".$client_id.") RESP on RESP.client_id=A.id   ";
        $sql.= "left outer join   ";
        $sql.= "(select client_id,name from fbpics where role='billing' and client_id=".$client_id.") BILLING on BILLING.client_id=A.id   ";
        $sql.= "left outer join   ";
        $sql.= "(select client_id,name from fbpics where role='subscriber' and client_id=".$client_id.") SUBSCRIBER on SUBSCRIBER.client_id=A.id   ";
        $sql.= "left outer join   ";
        $sql.= "(select client_id,name from fbpics where role='support' and client_id=".$client_id.") SUPPORT on SUPPORT.client_id=A.id   ";
        $sql.= "left outer join   ";
        $sql.= "(select client_id,name from fbpics where role='teknis' and client_id=".$client_id.") TEKNIS on TEKNIS.client_id=A.id   ";
        $sql.= "where A.id=".$client_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getfbpics2($client_id){
        $sql = "select * from fbpics a   ";
        $sql.= "where client_id  = " . $client_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getfbpics3(){
        $sql = 'select a.id,substring(a.name,1,30)name,a.alias,a.nofb,c.name billing,';
        $sql.= 'd.name teknis ,e.name resp,f.name adm,g.name support,h.name subscriber from ( ';
        $sql.='select a.id, a.name,a.alias,max(b.nofb)nofb ';
        $sql.='from clients a left outer join fbs b on b.client_id=a.id  ';
        $sql.='where a.active="1" and b.client_id is not null  ';
        $sql.='group by a.id,a.name )a ';
        $sql.='left outer join (select nofb,name from fbpics where role="billing") c on c.nofb=a.nofb  ';
        $sql.='left outer join (select nofb,name from fbpics where role="teknis") d on d.nofb=a.nofb  ';
        $sql.='left outer join (select nofb,name from fbpics where role="resp") e on e.nofb=a.nofb  ';
        $sql.='left outer join (select nofb,name from fbpics where role="adm") f on f.nofb=a.nofb  ';
        $sql.='left outer join (select nofb,name from fbpics where role="support") g on g.nofb=a.nofb '; 
        $sql.='left outer join (select nofb,name from fbpics where role="subscriber") h on h.nofb=a.nofb';

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
	/*function lookupclient($status=array('9'),$active=array('1'),$user=null){
		$obj = new Client();
		if(is_null($user)){
			$obj
			->where_in('status',$status)
			->where_in('active',$active)
			->where("hide","0")->get();
		}
		else{
			$obj
			->where_in('status',$status)
			->where_in('active',$active)
			->where_in_related_user('id',$user)
			->where("hide","0")
			->get();
		}
		return $obj;
	}    */
	function populateClientSurvey($param = 'all',$user = NULL){
		$thisuser = implode(",",$user);
		switch($param){
			case 'open':
                $sql = "select distinct a.id,a.name,a.status,a.business_field,a.address,a.city,c.username,c.id userid ";
                $sql.= "from clients a left outer join survey_requests b on b.client_id =a.id ";
                $sql.= "left outer join users c on c.id=a.sale_id  ";
                $sql.= "where a.status in ('1','2','3','4','5','6','7','8','9','p') ";
                $sql.= " and b.id = null and c.id in (".$thisuser.")";
			break;
			case 'closed':
                $sql = "select distinct a.id,a.name,a.status,a.business_field,a.address,a.city,c.username,c.id userid ";
                $sql.= "from clients a left outer join survey_requests b on b.client_id =a.id ";
                $sql.= "left outer join users c on c.id=a.sale_id  ";
                $sql.= "where a.status in ('1','2','3','4','5','6','7','8','9','p') ";
                $sql.= "and a.active='0' ";
                $sql.= " and b.id != null and c.id in (".$thisuser.")";
			break;
			case 'all':
                $sql = "select distinct a.id,a.name,a.status,a.business_field,a.address,a.city,c.username,c.id userid ";
                $sql.= "from clients a ";
                $sql.= "left outer join survey_requests b on b.client_id =a.id ";
                $sql.= "left outer join users c on c.id=a.sale_id ";
                $sql.= "where a.status in ('1','2','3','4','5','6','7','8','9','p') and c.id in (".$thisuser.")";
			break;
		}
        $sql.= "and hide='0' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $out = $que->result();
        return $out;
	}
    function populate(){
        $sql = "select b.nofb,a.id,case when b.nofb is null then a.name else concat(a.name,'-',b.nofb) end name,a.address from clients a ";
        $sql.= "left outer join fbs b on b.client_id=a.id ";
        $sql.= "where active='1' ";
        $sql.= "order by name asc ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function populateclient($status=array('9'),$active=array('1'),$user=null){
        $userbranch = getuserbranches();
        $ci = & get_instance();
        
        if(is_null($user)){
            $sql = "select a.id,a.name,a.address,d.username usrname,a.alias,a.phone_area,a.phone,e.pic,group_concat(g.name)ap, ";
            $sql.= 'a.sale_id,';
            $sql.= "case clientcategory ";
            $sql.= "when '1' then 'FFR' ";
            $sql.= "when '2' then 'Platinum' ";
            $sql.= "when '3' then 'Gold' ";
            $sql.= "when '4' then 'Silver' ";
            $sql.= "when '5' then 'Bronze' ";
            $sql.= "end category ";
    
            $sql.= "from clients a ";
            $sql.= "left outer join client_sites b on b.client_id=a.id ";
            //$sql.= "left outer join branches_client_sites c on c.client_site_id=b.id ";
            $sql.= "left outer join users d on d.id=a.sale_id ";
            $sql.= "left outer join (select id,client_id,prole,name pic from pics where prole='PEMOHON') e on e.client_id=a.id ";
            $sql.= "left outer join client_sites_aps f on f.client_site_id=b.id ";
            $sql.= "left outer join aps g on g.id=f.ap_id ";
            $sql.= "where a.branch_id in (".implode(",",$userbranch).") and a.active='1' ";
            $sql.= "group by a.id,a.name,a.address,d.username ,a.alias,a.phone_area,a.phone,e.pic,clientcategory ";
        }
        else{
            $sql = "select a.id,a.name,a.address,d.username usrname,a.alias,a.phone_area,a.phone,e.pic,group_concat(g.name)ap, ";
            $sql.= 'a.sale_id,';
            $sql.= "case clientcategory ";
            $sql.= "when '1' then 'FFR' ";
            $sql.= "when '2' then 'Platinum' ";
            $sql.= "when '3' then 'Gold' ";
            $sql.= "when '4' then 'Silver' ";
            $sql.= "when '5' then 'Bronze' ";
            $sql.= "end category ";
    
            
            
            $sql.= "from clients a ";
            $sql.= "left outer join client_sites b on b.client_id=a.id ";
            //$sql.= "left outer join branches_client_sites c on c.client_site_id=b.id ";
            $sql.= "left outer join users d on d.id=a.sale_id ";
            $sql.= "left outer join (select id,client_id,prole,name pic from pics where prole='PEMOHON') e on e.client_id=a.id ";
            $sql.= "left outer join client_sites_aps f on f.client_site_id=b.id ";
            $sql.= "left outer join aps g on g.id=f.ap_id ";
            $sql.= "where a.branch_id in (".implode(",",$userbranch).") and a.user_id=".$user." and a.active='1' ";
            $sql.= "group by a.id,a.name,a.address,d.username ,a.alias,a.phone_area,a.phone,e.pic";
        }
        $result = $ci->db->query($sql);
        return $result->result();    
    }
    function update($params){
        $arr = array();
        foreach($params as $key=>$val){
            array_push($arr,''.$key.'="'.$val.'"');
        }
        $sql = "update clients ";
        $sql.= "set ". implode(",",$arr) . " ";
        $sql.= "where id=" . $params["id"] . " ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function backupbeforedelete($id){
        $sql = 'insert into deletedclients ';
        $sql.= 'select * from clients where id='.$id.' ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function delete($id){
        $sql = 'delete from clients where id='.$id.' ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function changenamealias($params){
        $sql = 'update clients set name="'.$params['name'].'",alias="'.$params['alias'].'" ';
        $sql.= 'where id='.$params['id'].' ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function updateclientcategory($params){
        $sql = 'update clients set clientcategory="'.$params['clientcategoryid'].'" ';
        $sql.= 'where id='.$params['id'].' ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function updateclientam($params){
        $sql = 'update clients set sale_id="'.$params['sale_id'].'",user_id="'.$params['sale_id'].'" ';
        $sql.= 'where id='.$params['id'].' ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
    function getclientbyid2($id){
        $sql = 'select * from clients where id='.$id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function savealias($params){
        $sql = 'update clients set alias="'.$params['alias'].'",name="'.$params['name'].'" where id='.$params['id'].' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getFields($id){
        $sql = 'select has_internet_connection,interested from clients ';
        $sql.= 'where id='.$id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            return $que->result();
        }else{
            return false;
        };
    }
    function get_sites($client_id){
        $sql = 'select id,address,pic_name,pic_phone,pic_phone_area from client_sites where client_id='.$client_id.' and active="1" ';
        $ci = & get_instance();
		$que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getuncomplete(){
        $sql = 'select a.id,a.name,b.id siteid,b.address,b.pic_name,b.pic_email,pic_phone ';
        $sql.= 'from clients a ';
        $sql.= 'left outer join client_sites b on a.id=b.client_id ';
        $sql.= 'where a.active in ("1","9")';
        $ci = & get_instance();
		$que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getclientexcel(){
        $sql = "select a.id,a.name,a.address,";
        $sql.= "case a.clientcategory ";
        $sql.= "when '2' then 'Platinum' ";
        $sql.= "when '3' then 'Gold' ";
        $sql.= "when '4' then 'Silver' ";
        $sql.= "when '5' then 'Bronze' end clientcategory,";
        $sql.= "b.username,b.id user_id from clients a ";
        $sql.= "left outer join users b on b.id=a.user_id ";
        $sql.= "where a.status in ('1','9') and a.active='1' and a.hide='0' " ;
        $ci = & get_instance();
		$que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function get_obj_by_id($id){
        $sql = "select a.id,a.name,a.alias,a.address,a.city,a.phone_area,a.phone,a.fax_area,a.fax,a.business_field,a.category_id from clients a left outer join users b on b.id=a.sale_id ";
        $sql.= "where a.id=".$id."";
        $ci = & get_instance();
		$que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getinstalladdress(){
        $sql = 'select a.id,a.name,a.alias,b.address,c.email from ';
        $sql.= 'clients a left outer join ';
        $sql.= '(select a.id,c.address,c.status from clients a left outer join ';
        $sql.= 'client_sites b on b.client_id=a.id left outer join ';
        $sql.= 'install_sites c on c.client_site_id=b.id where a.active="1" and c.status="1") b on b.id=a.id ';
        $sql.= 'left outer join (select a.id,group_concat(distinct c.email)email from clients a left outer join fbs b on b.client_id=a.id left outer join fbpics c on c.client_id=a.id where a.active="1" and b.status="1" and c.role="support" group by a.id) c on c.id=a.id ';
        $sql.= 'where a.active="1" and a.status in ("1","9") ';
        $sql.= 'order by a.id ';
        $ci = & get_instance();
		$que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
/*    function getinstalladdress(){




        $sql = 'select a.id,a.name,a.alias,b.address,c.email from 
        clients a left outer join
        (select a.id,c.address,c.status from clients a left outer join 
        client_sites b on b.client_id=a.id left outer join 
        install_sites c on c.client_site_id=b.id where a.active='1' and c.status='1') b on b.id=a.id
        left outer join (select a.id,group_concat(distinct c.email)email from clients a left outer join fbs b on b.client_id=a.id left outer join fbpics c on c.client_id=a.id where a.active='1' and b.status='1' and c.role='support' group by a.id) c on c.id=a.id
        where a.active='1' and a.status in ('1','9')
        order by a.id ';
        $ci = & get_instance();
		$que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }*/
}

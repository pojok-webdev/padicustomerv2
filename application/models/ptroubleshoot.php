<?php
class Ptroubleshoot extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gettroubleshoot($name="",$segment=0,$offset=0){
        if(($segment===0)&&($offset===0)){
            $limit = " ";
        }else{
            $limit = "limit ".$segment.", ".$offset." ";
        }
        $ci = & get_instance();
        $sql = "select a.id,c.name,a.request_date1, ";
        $sql.= "troubleshoottype, ";
        $sql.= "b.address, ";
        $sql.= "a.pic_phone, ";
        $sql.= "a.pic_email, ";
        $sql.= "a.status, ";
        $sql.= "a.troubleshoot_date, ";
        $sql.= "group_concat(e.name) branch ";
        $sql.= "from troubleshoot_requests a ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "left outer join branches_client_sites d on d.client_site_id=b.id ";
        $sql.= "left outer join branches e on e.id=d.branch_id ";
        $sql.= "where c.name like '%".$name."%' ";
        $sql.= "group by a.id,c.name,a.request_date1,troubleshoottype,b.address,pic_phone,pic_email,a.status,a.troubleshoot_date ";
        $sql.= "order by c.name asc ";
        $sql.= $limit;
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getdata($id){
        $ci = & get_instance();
		$sql = "select nameofmtype,business_field,b.address,case when a.pic_name is null then '' else a.pic_name end pic,";
		$sql.= "case when group_concat(d.name) is null then '' else group_concat(d.name) end officers,";
		$sql.= "case when troubleshoot_date is null then '' else troubleshoot_date end troubleshoot_date, ";
		$sql.= "case a.status when '1' then 'Selesai' when '0' then 'Belum selesai' end status,a.description ";
		$sql.= "from troubleshoot_requests a ";
		$sql.= "left outer join client_sites b on b.id=a.client_site_id ";
		$sql.= "left outer join clients c on c.id=b.client_id ";
		$sql.= "left outer join troubleshoot_officers d on d.troubleshoot_request_id = a.id ";
		$sql.= "where a.id=".$id." ";
        $sql.= "group by a.id ";
		$que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            $obj = $res[0]; 

            $arr = array();
            $out = '{"name":"'.$obj->nameofmtype.'",';
            $out.= '"nameofmtype":"'.$obj->nameofmtype.'",';
            $out.= '"business_field":"'.$obj->business_field.'",';
            $out.= '"address":"'.$obj->address.'",';
            $out.= '"surveyors":"'.$obj->officers.'",';
            $out.= '"pic":"'.$obj->pic.'",';
            $out.= '"status":"'.$obj->status.'",';
            $out.= '"description":"'.$obj->description.'",';
            $out.= '"troubleshoot_date":"'.$obj->troubleshoot_date.'"}';
            return $out;
        }
        return false;
    }    
    function save($params){
        $sql = "";$keys = array();$vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = "insert into troubleshoot_requests ";
        $sql.= "(" . implode(",",$keys) . ")";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."')";
        $sql = 'insert into troubleshoot_requests ';
        $sql.= '(';
        $sql.= ' username,';
        $sql.= ' ticket_id,';
        $sql.= ' solvedschedule,';
        $sql.= ' complaint,';
        $sql.= ' client_site_id,';
        $sql.= ' troubleshoottype,';
        $sql.= ' nameofmtype,';
        $sql.= ' pic_phone,';
        $sql.= ' surat_ijin,';
        $sql.= ' request_date1,';
        $sql.= ' request_date2,';
        $sql.= ' is_payable,';
        $sql.= ' description';
        $sql.= ' )';
        $sql.= ' values ';
        $sql.= ' (';
        $sql.= ' "'.$params['username'].'",';
        $sql.= ' "'.$params['ticket_id'].'",';
        $sql.= ' date_add("'.$params['request_date1'].'", INTERVAL 7 day),';
        $sql.= ' "'.$params['complaint'].'",';
        $sql.= ' "'.$params['client_site_id'].'",';
        $sql.= ' "'.$params['troubleshoottype'].'",';
        $sql.= ' "'.$params['nameofmtype'].'",';
        $sql.= ' "'.$params['pic_phone'].'",';
        $sql.= ' "'.$params['surat_ijin'].'",';
        $sql.= ' "'.$params['request_date1'].'",';
        $sql.= ' "'.$params['request_date2'].'",';
        $sql.= ' "'.$params['is_payable'].'",';
        $sql.= ' "'.$params['description'].'"';
        $sql.= ' )';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function fusave($params){
        $sql = "insert into troubleshoot_fus ";
        $sql.= "(activities,troubleshoot_id,user_id) ";
        $sql.= "values ";
        $sql.= "('".$params['activities']."','".$params['troubleshoot_id']."','".$params['user_id']."')";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function fuimgsave($params){
        $sql = "insert into troubleshootfu_images ";
        $sql.= "(troubleshoot_fu_id,img,user_id)";
        $sql.= "values ";
        $sql.= "(";
        $sql.= "'".$params['troubleshoot_fu_id']."',";
        $sql.= "'".$params['img']."',";
        $sql.= "'".$params['user_id']."' ";
        $sql.= ")";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
        return '{sql:'.$sql.'}';
    }
    function getfus($id){
        $sql = 'select a.*,b.username from troubleshoot_fus a ';
        $sql.= 'left outer join users b on b.id=a.user_id ';
        $sql.= 'where troubleshoot_id = '.$id . '';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getfuimages($id){
        $sql = 'select a.* from troubleshootfu_images a ';
        $sql.= 'where troubleshoot_fu_id = '.$id . '';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function removefu($id){
        $ci = & get_instance();
        $this->removefuimagebyfuid($id);
        $sql = 'delete from troubleshoot_fus ';
        $sql.= 'where id='.$id;
        $que = $ci->db->query($sql);
        return $sql;
    }
    function removefuimage($id){
        $ci = & get_instance();
        $sql = 'delete from troubleshootfu_images ';
        $sql.= 'where id='.$id;
        $que = $ci->db->query($sql);
        return $sql;
    }
    function removefuimagebyfuid($id){
        $sql = 'delete from troubleshootfu_images ';
        $sql.= 'where troubleshoot_fu_id='.$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
}
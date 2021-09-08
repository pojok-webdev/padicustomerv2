<?php
class Rptmodel extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getInstallReport($dt1,$dt2,$branches,$amsstr,$order,$orderfield){
        $sql = "select distinct  install_date ,a.create_date,a.client_site_id csi,";
        $sql.= "d.name,c.address,e.username hunter,f.name brn ";
        $sql.= "from install_sites a ";
        //$sql.= "left outer join branches_client_sites b on b.client_site_id=a.client_site_id ";
        $sql.= "left outer join client_sites c on c.id=a.client_site_id ";
        $sql.= "left outer join clients d on d.id=c.client_id ";
        $sql.= "left outer join users e on e.id=d.sale_id ";
        $sql.= "left outer join branches f on f.id=d.branch_id ";
        $sql.= "where install_date>='".$dt1."' and install_date<'".$dt2."'  ";
		$sql.= "and e.id in ('".$amsstr."') ";
        $sql.= "order by ".$order." " . $orderfield . " ";
        $query = $this->db->query($sql);
        $result = $query->result();
        $total = $query->num_rows();
        return array('total'=>$total,'result'=>$result);
    }
    function getProspectReport($dt1,$dt2,$branches,$amsstr,$order,$orderfield){
		$sql = "select distinct d.id,d.name,d.address,c.name brn,e.username hunter,d.prospectdate create_date from ";
		$sql.= " clients d  ";
		$sql.= "left outer join users e on e.id=d.user_id ";
		$sql.= "left outer join (select * from branches_users where defbranch='1' ) b on b.user_id=e.id ";
		$sql.= "left outer join branches c on c.id=b.branch_id ";
		$sql.= "where d.prospectdate>='".$dt1."' and d.prospectdate<='".$dt2."'";
		$sql.= "and c.id in ('".implode("','",$branches)."') ";
		$sql.= "and hide='0' ";
		$sql.= "and e.id in ('".$amsstr."') ";
		$sql.= "order by ".$orderfield." " . $order;    
        $query = $this->db->query($sql);
        $total = $query->num_rows();
        $result = $query->result();
        return array('total'=>$total,'result'=>$result);
    }
    function getSurveyReport($dt1,$dt2,$branches,$amsstr,$order,$orderfield){
        $sql = "select distinct survey_date, a.create_date,d.name,c.address,e.username hunter,f.name brn ";
        $sql.= "from survey_sites a ";
        //$sql.= "left outer join branches_client_sites b on b.client_site_id=a.client_site_id ";
        $sql.= "left outer join client_sites c on c.id=a.client_site_id left outer join clients d on d.id=c.client_id ";
        $sql.= "left outer join users e on e.id=d.sale_id left outer join branches f on f.id=d.branch_id ";
        $sql.= "where survey_date>='".$dt1."' and survey_date<'".$dt2."' and d.branch_id in (".$branches.") ";
		$sql.= "and e.id in ('".$amsstr."') ";
        $sql.= "order by ".$orderfield." " . $order . " ";
		$query = $this->db->query($sql);
        
		$result = $query->result();
        $total = $query->num_rows();
        return array('total'=>$total,'result'=>$result);
    }
}
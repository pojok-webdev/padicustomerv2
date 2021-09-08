<?php
class Psurvey extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function hehe(){
        $sql = 'select resume,city,sites.id,sites.ex_date,c.name,sites.address,c.business_field,s.name service,';
		$sql.= 'sites.location_e_d,sites.location_e_m,sites.location_e_s,sites.location_s_d,sites.location_s_m,';
		$sql.= 'sites.location_s_s,sites.amsl,sites.agl,sites.execution_date,sites.survey_date from ';
		$sql.= '(';
		$sql.= ' select date_format(a.execution_date,"%Y-%m-%d") ex_date,';
		$sql.= ' b.id,b.client_id,a.address,a.location_e_d,resume,a.location_e_m,a.location_e_s,';
		$sql.= ' a.location_s_d,a.location_s_m,a.location_s_s,a.amsl,a.agl,a.survey_date,a.execution_date ';
		$sql.= ' from survey_sites a left outer join survey_requests b on b.id=a.survey_request_id where a.id='.$id.'';
		$sql.= ') sites ';
		$sql.= 'left outer join clients c on c.id=sites.client_id ';
		$sql.= 'right outer join ';
		$sql.= '(';
		$sql.= ' select date_format(a.execution_date,"%Y-%m-%d")ex_date,b.id,b.client_id,a.id site_id from ';
		$sql.= ' survey_sites a ';
		$sql.= ' left outer join survey_requests b on b.id=a.survey_request_id ';
		$sql.= ')site ';
		$sql.= 'on site.client_id=sites.client_id and site.ex_date=sites.ex_date ';
		$sql.= 'left outer join services s on s.id=c.service_id ';
		$sql.= 'where site.site_id='.$id;

    }
    function getclientproperties($site_id){
        $sql = 'select d.name,c.address,e.name servicename,d.business_field,a.execution_date,';
        $sql.= 'a.survey_date,c.city,b.resume from survey_sites a ';
        $sql.= 'left outer join survey_requests b on b.id=a.survey_request_id ';
        $sql.= 'left outer join client_sites c on c.id=a.client_site_id ';
        $sql.= 'left outer join clients d on d.id=a.client_id ';
        $sql.= 'left outer join services e on e.id=d.service_id ';
        $sql.= 'where a.id="'.$site_id.'"';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result[0];
    }
    function getsitereport($site_id){
        $sql = 'select resume,city,sites.id,sites.ex_date,c.name,sites.address,c.business_field,s.name service,';
		$sql.= 'sites.location_e_d,sites.location_e_m,sites.location_e_s,sites.location_s_d,sites.location_s_m,';
		$sql.= 'sites.location_s_s,sites.amsl,sites.agl,sites.execution_date,sites.survey_date from ';

		$sql.= '(';
		$sql.= ' select date_format(a.execution_date,"%Y-%m-%d")ex_date,b.id,b.client_id,a.id site_id from ';
		$sql.= ' survey_sites a ';
		$sql.= ' left outer join survey_requests b on b.id=a.survey_request_id ';
        $sql.= ')site ';
        $sql.= 'left outer join ';
        $sql.= '(';
		$sql.= ' select date_format(a.execution_date,"%Y-%m-%d") ex_date,';
		$sql.= ' b.id,b.client_id,a.address,a.location_e_d,resume,a.location_e_m,a.location_e_s,';
		$sql.= ' a.location_s_d,a.location_s_m,a.location_s_s,a.amsl,a.agl,a.survey_date,a.execution_date ';
		$sql.= ' from survey_sites a left outer join survey_requests b on b.id=a.survey_request_id where a.id='.$site_id.'';
		$sql.= ') sites ';
		$sql.= 'on site.client_id=sites.client_id and site.ex_date=sites.ex_date ';
		$sql.= 'left outer join clients c on c.id=sites.client_id ';
        $sql.= 'left outer join services s on s.id=c.service_id ';
        $sql.= 'where site.site_id='.$site_id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getsurveyor($params){
        $sql = "select * from survey_surveyors a ";
        $sql.= "left outer join survey_requests b on b.id=a.survey_request_id ";
        $sql.= "left outer join survey_sites c on c.survey_request_id=b.id ";
        $sql.= "where c.id=".$params['id']." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function getmaterials($params){
        $sql = "select distinct sm.material_type,sm.name,sm.amount ";
        $sql.= "from (select date_format(a.execution_date,'%Y-%m-%d') ex_date,b.id,b.client_id,a.address,a.id siteid ";
        $sql.= " from survey_sites a ";
        $sql.= " left outer join survey_requests b on b.id=a.survey_request_id ";
        $sql.= " where a.id=".$params['id'].")sites  ";
        $sql.= "left outer join survey_materials sm on sm.survey_site_id=sites.siteid ";
        $sql.= "right outer join ";
        $sql.= " (select date_format(a.execution_date,'%Y-%m-%d')ex_date,b.id,b.client_id,a.id siteid ";
        $sql.= " from survey_sites a ";
        $sql.= " left outer join survey_requests b on b.id=a.survey_request_id  ";
        $sql.= " where a.id=".$params['id'].")site on site.client_id=sites.client_id and site.ex_date=sites.ex_date ";
        $sql.= " where sm.material_type is not null and site.siteid=".$params['id']."";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function getdevices($params){
        $sql = 'select distinct sm.description,sm.name,sm.amount ';
        $sql.= 'from ';
        $sql.= '(';
        $sql.= ' select date_format(a.execution_date,"%Y-%m-%d") ex_date,b.id,b.client_id,a.address,a.id siteid ';
        $sql.= ' from survey_sites a ';
        $sql.= ' left outer join survey_requests b on b.id=a.survey_request_id ';
        $sql.= ' where a.id='.$params['id'].')sites  ';
        $sql.= 'left outer join survey_devices sm on sm.survey_site_id=sites.siteid ';
        $sql.= 'right outer join ';
        $sql.= '(';
        $sql.= ' select date_format(a.execution_date,"%Y-%m-%d")ex_date,b.id,b.client_id,a.id siteid ';
        $sql.= ' from survey_sites a left outer join survey_requests b on b.id=a.survey_request_id  ';
        $sql.= ' where a.id='.$params['id'].') site ';
        $sql.= 'on site.client_id=sites.client_id and site.ex_date=sites.ex_date ';
        $sql.= 'where sm.name is not null and site.siteid='.$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function getresumes($params){
        $sql = 'select distinct sm.name ';
        $sql.= 'from (select date_format(a.execution_date,"%Y-%m-%d") ex_date,b.id,b.client_id,a.address,a.id siteid ';
        $sql.= ' from survey_sites a left outer join survey_requests b on b.id=a.survey_request_id where a.id='.$params['id'].')sites  ';
        $sql.= 'left outer join survey_resumes sm on sm.survey_site_id=sites.siteid ';
        $sql.= 'right outer join (select date_format(a.execution_date,"%Y-%m-%d")ex_date,b.id,b.client_id,a.id siteid ';
        $sql.= 'from survey_sites a left outer join survey_requests b on b.id=a.survey_request_id ';
        $sql.= 'where a.id='.$params['id'].')site on site.client_id=sites.client_id and site.ex_date=sites.ex_date ';
        $sql.= 'where sm.name is not null and site.siteid='.$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function getimages($params){
        $sql = 'select distinct sm.path,sm.img,sm.description ';
        $sql.= 'from (select date_format(a.execution_date,"%Y-%m-%d") ex_date,b.id,b.client_id,a.address,a.id siteid ';
        $sql.= 'from survey_sites a left outer join survey_requests b on b.id=a.survey_request_id ';
        $sql.= 'where a.id='.$params['id'].')sites  ';
        $sql.= 'left outer join survey_images sm on sm.survey_site_id=sites.siteid  ';
        $sql.= 'where sm.survey_site_id is not null';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function getbtsdistances($params){
        $sql = "select a.*,b.name btsname from survey_bts_distances a ";
        $sql.= "left outer join btstowers b on b.id=a.btstower_id ";
        $sql.= "where survey_site_id=".$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function getsitedistance($params){
        $sql = "select * from survey_site_distances where survey_site_id=".$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('cnt'=>$que->num_rows(),'res'=>$que->result());
    }
    function update($params){
        $sql = 'update survey_requests ';
        $sql.= 'set ';
        $arr = array();
        foreach($params as $key=>$val){
            array_push($arr,''.$key.'="'.$val.'"');
        }
        $sql.= implode(",",$arr);
        $sql.= 'where id='.$params['id'].'';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getreportdata($params){
        $sql = "select d.name,d.business_field,group_concat(distinct e.name)pic,group_concat(distinct f.name)surveyors,c.address,case  when date(a.execution_date)='0000-00-00' then a.survey_date when a.execution_date is NULL then a.survey_date else a.execution_date end  execution_date,location_e_d,location_e_m,location_e_s,location_s_d,location_s_m,location_s_s,amsl,agl,a.city,case g.resume when '0' then 'Belum ada kesimpulan' when '1' then 'Dapat dilaksanakan' when '2' then 'Dapat dilaksanakan dengan syarat' when '3' then 'Tidak dapat dilaksanakan' else 'Belum ada kesimpulan' end status from survey_sites a ";
		$sql.= "left outer join client_sites c on c.id=a.client_site_id ";
		$sql.= "left outer join clients d on d.id=c.client_id ";
		$sql.= "left outer join pics e on e.client_id=d.id ";
		$sql.= "left outer join survey_surveyors f on f.survey_request_id=a.id ";
		$sql.= "left outer join survey_requests g on g.id=a.survey_request_id ";
		$sql.= "where a.id=".$params["survey_site_id"];
		$que = $this->db->query($sql);
		$res = $que->result();
		$r = $res[0];
		return '{"name":"'.$r->name.'","business_field":"'.$r->business_field.'","pic":"'.$r->pic.'","address":"'.$r->address.'","execution_date":"'.$r->execution_date.'","surveyors":"'.$r->surveyors.'","location_e_d":"'.$r->location_e_d.'","location_e_m":"'.$r->location_e_m.'","location_e_s":"'.$r->location_e_s.'","location_s_d":"'.$r->location_s_d.'","location_s_m":"'.$r->location_s_m.'","location_s_s":"'.$r->location_s_s.'","amsl":"'.$r->amsl.'","agl":"'.$r->agl.'","city":"'.$r->city.'","status":"'.$r->status.'"}';
    }
    function getreportbts($params){
        $sql = "select a.id,b.name,a.ap,case a.los when '1' then 'LOS' when '0' then 'NLOS' when '2' then 'nLOS' end los,a.distance,a.obstacle,a.description from survey_bts_distances a ";
		$sql.= "left outer join btstowers b on b.id=a.btstower_id ";
		$sql.= "where survey_site_id=".$params["survey_site_id"];
		$que = $this->db->query($sql);
		return $que->result();
    }
    function getreportimages($params){
        $sql = "select id,path,description,img from survey_images ";
		$sql.= "where survey_site_id=".$params["survey_site_id"];
		$que = $this->db->query($sql);
		return $que->result();
    }
    function getreportmaterials($params){
        $sql = "select id,material_type,name,amount from survey_materials ";
		$sql.= "where survey_site_id=".$params["survey_site_id"];
		$que = $this->db->query($sql);
		return $que->result();
    }
    function getreportresumes($params){
        $sql = "select id,name from survey_resumes ";
		$sql.= "where survey_site_id=".$params["survey_site_id"];
		$que = $this->db->query($sql);
		return $que->result();
    }
}
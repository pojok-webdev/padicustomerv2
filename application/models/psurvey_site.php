<?php
class Psurvey_site extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function iseditor($survey_site_id,$email){
        $ci = & get_instance();
        $surveyors  = $this->get_surveyors($survey_site_id);
        $out = false;
        if($surveyors['count']>0){
            foreach($surveyors['rows'] as $surveyor){
                if($surveyor->email === $email){
                    $out = true;
                }
            }
        }else{
            return true;
        }
        return $out;
    }
    function get_surveyors($survey_site_id){
        $ci = & get_instance();
        $sql = "select email from survey_surveyors a ";
        $sql.= "left outer join survey_sites b on b.survey_request_id=a.survey_request_id ";
        $sql.= "where b.id=".$survey_site_id." ";
        $que = $ci->db->query($sql);
        return array(
            'count'=>$que->num_rows(),
            'rows'=>$que->result()
        );
    }
    function updatedescription($params){
        $ci = & get_instance();
        $sql = "update survey_sites set description='".$params['description']. "' where id=".$params['id'];
        $ci->db->query($sql);
        return $sql;
    }
}
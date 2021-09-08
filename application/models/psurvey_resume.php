<?php
Class Psurvey_resume extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function save($params){
        $sql = 'insert into survey_resumes ';
        $sql.= '(survey_site_id,name) ';
        $sql.= 'values ';
        $sql.= "(".$params['survey_site_id'].",'".$params['name']."')";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function delete($params){
        $sql = 'delete from survey_resumes ';
        $sql.= 'where id='.$params['id'] . '';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
}
<?php
Class Pticketserver extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function save($params){
        $sql = 'insert into ticketservers ';
        $sql.= '(name ,ipaddress ,start ,end ,description ,createuser) ';
        $sql.= 'values ';
        $sql.= '(';
        $sql.= '"'.$params['name'].'" ,';
        $sql.= '"'.$params['ipaddress'].'" ,';
        $sql.= '"'.$params['start'].'" ,';
        $sql.= '"'.$params['end'].'" ,';
        $sql.= '"'.$params['description'].'" ,';
        $sql.= '"'.$params['createuser'].'"';
        $sql.= ')';
        $ci = & get_instance();
        $que = $ci->db->query();
        return $ci->db->insert_id();
    }
}
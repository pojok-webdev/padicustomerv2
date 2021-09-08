<?php
Class Pdisconnection extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function savepermanent($params){
        $sql = 'insert into disconnections ';
        $sql.= '(';
        $sql.= 'disconnectiontype,';
        $sql.= 'client_id,';
        $sql.= 'period,';
        $sql.= 'reason,';
        $sql.= 'fee,';
        $sql.= 'executiondate,';
        $sql.= 'executed,';
        $sql.= 'status,';
        $sql.= 'createuser ';
        $sql.= ' ) ';
        $sql.= 'values ';
        $sql.= '("'.$params['disconnectiontype'].'",';
        $sql.= '"'.$params['client_id'].'",';
        $sql.= '"'.$params['period'].'",';
        $sql.= '"'.$params['reason'].'",';
        $sql.= '"'.$params['fee'].'",';
        $sql.= '"'.$params['executiondate'].'",';
        $sql.= '"'.$params['executed'].'",';
        $sql.= '"'.$params['status'].'",';
        $sql.= '"'.$params['createuser'].'"  ) ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function savetemporer($params){
        $sql = 'insert into disconnections ';
        $sql.= '(';
        $sql.= 'disconnectiontype,';
        $sql.= 'client_id,';
        $sql.= 'period,';
        $sql.= 'reason,';
        $sql.= 'fee,';
        $sql.= 'startdate,';
        $sql.= 'finishdate,';
        $sql.= 'executiondate,';
        $sql.= 'executed,';
        $sql.= 'status,';
        $sql.= 'createuser ';
        $sql.= ' ) ';
        $sql.= 'values ';
        $sql.= '("'.$params['disconnectiontype'].'",';
        $sql.= '"'.$params['client_id'].'",';
        $sql.= '"'.$params['period'].'",';
        $sql.= '"'.$params['reason'].'",';
        $sql.= '"'.$params['fee'].'",';
        $sql.= '"'.$params['startdate'].'",';
        $sql.= '"'.$params['finishdate'].'",';
        $sql.= '"'.$params['executiondate'].'",';
        $sql.= '"'.$params['executed'].'",';
        $sql.= '"'.$params['status'].'",';
        $sql.= '"'.$params['createuser'].'"  ) ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
}
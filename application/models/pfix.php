<?php
class Pfix extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function createinstall($client_site_id){
        $sql = "insert into install_requests ";
        $sql.= "(client_id,client_site_id,createuser) ";
        $sql.= "select client_id,id,'puji' from client_sites where id=".$client_site_id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $id = $ci->db->insert_id();
        $sql = "insert into install_sites ";
        $sql.= "(install_request_id,requestsent,resultsent,createuser) ";
        $sql.= "values ";
        $sql.= "(".$id.",'1','1','puji')";
        $que = $ci->db->query($sql);
    }
}
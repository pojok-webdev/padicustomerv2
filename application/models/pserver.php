<?php
class Pserver extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getbyid($id){
        $sql = "select * from servers ";
        $sql.= "where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function gets(){
        $sql = "select * from servers ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
    function remove($serverid){
        $sql = "delete from servers ";
        $sql.= "where id=".$serverid."";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function save($params){
        $sql = "insert into servers ";
        $sql.= "(name,ipaddr,description,createuser) ";
        $sql.= "values ";
        $sql.= "('".$params['name']."','".$params['ipaddr']."','".$params['description']."','".$params['createuser']."')";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $sql = "update servers ";
        $sql.= "set name='".$params['name']."',ipaddr='".$params['ipaddr']."',description='".$params['description']."' ";
        $sql.= "where ";
        $sql.= "id=".$params['id']." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
}
<?php
class Pclient_vas extends CI_Model{
    function vasget($client_id,$vas_id){
        $sql = "select b.name from client_vases a ";
        $sql.= "left outer join vases b on b.id=a.vas_id ";
        $sql.= "where a.client_id=".$client_id."  ";
        $sql.= "and a.vas_id=".$vas_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            $res = $que->result();
            return $res[0];
        }
        return $sql;
    }
    function update($client_id,$vas_id,$vas_id2){
        $sql = "update client_vases ";
        $sql.= "set ";
        $sql.= "client_id=".$client_id.", ";
        $sql.= "vas_id=".$vas_id2." ";
        $sql.= "where client_id=".$client_id." and ";
        $sql.= "vas_id=".$vas_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function updateimplemented($client_id,$vas_id,$implemented){
        $sql = "update client_vases ";
        $sql.= "set implemented='".$implemented."' ";
        $sql.= "where client_id=".$client_id." ";
        $sql.= "and vas_id=".$vas_id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
}
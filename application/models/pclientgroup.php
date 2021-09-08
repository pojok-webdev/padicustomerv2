<?php
class Pclientgroup extends CI_Model{
    function get($id){
        $sql = "select id,name,description,createuser,createdate from clientgroups ";
        $sql.= "where id=".$id." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $out = $que->result();
        return $out[0];
    }
    function gets(){
        $sql = "select id,name,description,createuser,createdate from clientgroups ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $out = array(
            'res'=>$que->result(),
            'count'=>$que->num_rows()
        );
        return $out;
    }
    function getdetail($id){
        $sql = "select a.clientgroup_id,b.id clientid,b.name,b.address,b.alias,e.username am,dpp, ";
        $sql.= "services , f.pic ";
        $sql.= "from clients_groups a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select b.id,b.name,b.address,b.alias,b.user_id,group_concat(d.name)services from clients b ";
        $sql.= " left outer join client_sites c on c.client_id=b.id ";
        $sql.= " left outer join clientservices d on d.client_site_id=c.id ";
        $sql.= " group by b.id,b.name,b.address,b.alias,b.user_id ";
        $sql.= ") b on b.id=a.client_id ";
        $sql.= "left outer join users e on e.id=b.user_id ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select a.client_id, group_concat(a.name)pic from pics a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " group by a.client_id ";
        $sql.= ") f on f.client_id=b.id ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select client_id,dpp,dpp+ppn tot from fbfees where name='monthly'";
        $sql.= ") g on g.client_id=b.id ";
        $sql.= "where clientgroup_id=" . $id . " ";
//        $sql.= "group by ";
//        $sql.= "a.clientgroup_id,b.id,b.name,b.address,b.alias,e.username ";
//        echo $sql;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $out = array(
            'res'=>$que->result(),
            'count'=>$que->num_rows()
        );
        return $out;
    }
    function getname($id){
        $sql = "select name from clientgroups where id=" . $id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0]->name;
        }
        return false;
    }
    function removeclient($groupid,$id){
        $sql = "delete from clients_groups ";
        $sql.= "where clientgroup_id=" . $groupid . " and client_id=". $id ." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function save($params){
        $keys = array();
        $vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = "insert into clientgroups (" . implode(",",$keys) . ") " ;
        $sql.= "values ";
        $sql.= "( '". implode("','",$vals) ."' )";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function saveclient($params){
        $keys = array();
        $vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = "insert into clients_groups (" . implode(",",$keys) . ") " ;
        $sql.= "values ";
        $sql.= "( '". implode("','",$vals) ."' )";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
        return $ci->db->insert_id();        
    }
    function update($params){
        $arr = array();
        foreach($params as $key=>$val){
            array_push($arr,"".$key."='".$val."' ");
        }
        $sql = "update clientgroups " ;
        $sql.= "set ";
        $sql.= " ". implode(",",$arr) ." ";
        $sql.= "where id = ".$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
}
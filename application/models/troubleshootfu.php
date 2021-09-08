<?php
Class Troubleshootfu extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gettroubleshoot($troubleshoot_id){
        $sql = 'select id,nameofmtype from troubleshoot_requests where id='.$troubleshoot_id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            return $que->result()[0];
        }
        else
        {
            return false;
        }
    }
    function savepicture($params){
        $sql = 'insert into troubleshootfu_images ';
        $sql.= '(img,name,description,troubleshoot_fu_id,user_id) ';
        $sql.= 'values ';
        $sql.= '("'.$params['img'].'","'.$params['name'].'","'.$params['description'].'",'.$params['troubleshoot_fu_id'].','.$params['user_id'].') ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('id'=>$ci->db->insert_id());
    }
    function updatepicture($params){
        $sql = 'update troubleshootfu_images ';
        $sql.= 'set img="'.$params['img'].'",';
        $sql.= 'name="'.$params['name'].'",';
        $sql.= 'user_id="'.$params['user_id'].'",';
        $sql.= 'description="'.$params['description'].'"';
        $sql.= 'where id='.$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('sql'=>$sql);
    }
    function getfuimages($troublshoot_id){
        $sql = 'select a.id,a.name,a.description,a.img,a.troubleshoot_fu_id,b.username from troubleshootfu_images a ';
        $sql.= 'left outer join users b on b.id=a.user_id ';
        $sql.= 'where troubleshoot_fu_id ='.$troublshoot_id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
    function getfus($troubleshoot_id){
        $sql = 'select a.id, a.activities,b.username,a.createdate from troubleshoot_fus a ';
        $sql.= 'left outer join users b on b.id=a.user_id ';
        $sql.= 'where troubleshoot_id='.$troubleshoot_id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
    function getfu($troubleshoot_id){
        $sql = 'select id,activities,troubleshoot_id from troubleshoot_fus ';
        $sql.= 'where id='.$troubleshoot_id.'';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            return $que->result()[0];
        }
        return false;
    }
    function updatefu($params){
        $sql = 'update troubleshoot_fus ';
        $sql.= 'set activities = "'.$params['activities'].'" where id= '.$params['id'].' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('sql'=>$sql);
    }
    function savefu($params){
        $sql = 'insert into troubleshoot_fus ';
        $sql.= '(troubleshoot_id,activities,user_id) ';
        $sql.= 'values ';
        $sql.= '('.$params['troubleshoot_id'].',"'.$params['activities'].'",'.$params['user_id'].')';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function removeimage($params){
        $sql = 'delete from troubleshootfu_images ';
        $sql.= 'where id='.$params['id'].' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('sql'=>$sql);
    }
    function gettroubleshootbyfu($fu_id){
        $sql = 'select troubleshoot_id from troubleshoot_fus where id='.$fu_id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            return $que->result()[0];
        }
        return false;
    }
    function getimage($id){
        $sql = 'select img from troubleshootfu_images ';
        $sql.= 'where id='.$id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        if($que->num_rows()>0){
            $res = $que->result();
            return $res[0]->img;
        }else{
            return false;
        }
    }
    function removefu($id){
        $sql = 'delete from troubleshoot_fus where id='.$id.'';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
}
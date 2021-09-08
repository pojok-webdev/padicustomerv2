<?php
Class Pbranch extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getuserbranches($user_id){
        $sql = 'select branch_id from branches_users ';
        $sql = 'where user_id = ' . $user_id . ' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
}
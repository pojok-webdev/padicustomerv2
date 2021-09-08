<?php
Class Pricelistproduct extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets(){
        $sql = 'select id,product_id,category_id,name,description,price,discount,unit from pricelistsproducts ';
        $sql.= ' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
    function getsbycategory($categories){
        $sql = 'select id,product_id,category_id,name,description,price,discount,unit from pricelistsproducts ';
        $sql.= 'where category_id in ('.$categories.') ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
    function save($params,$tablename){
        $keys = array();$vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = 'insert into '.$tablename.' ('.implode(',',$keys).') ';
        $sql.= 'values ';
        $sql.= '("'.implode('","',$vals).'") ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
}
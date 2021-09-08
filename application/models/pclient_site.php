<?php
Class Pclient_site extends CI_Model{
    function __construct(){
        parent::__construct();
    }
function setactive($params){
$sql = 'update client_sites ';
$sql.= 'set active="'.$params['active'].'" where id="'.$params['id'].'" ';
        $ci = & get_instance();
        $ci->db->query($sql);
return $sql;
}
    function save2($params){
        $keys = array();$vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = 'insert into client_sites ';
        $sql.= '('.implode(",",$keys).') ';
        $sql.= 'values ';
        $sql.= '("'.implode('","',$vals).'") ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function save($params){
        $sql = 'insert into client_sites ';
        $sql.= '(';
        $sql.= 'survey_request_id,';
        $sql.= 'client_id,';
        $sql.= 'service_id,';
        $sql.= 'sale_id,';
        $sql.= 'branch_id__,';
        $sql.= 'address,';
        $sql.= 'city,';
        $sql.= 'install_area,';
        $sql.= 'pic_name,';
        $sql.= 'pic_phone,';
        $sql.= 'pic_email,';
        $sql.= 'pic_position,';
        $sql.= 'createuser';
        $sql.= ') ';
        $sql.= 'values ';
        $sql.= '(';
        $sql.= ''.$params['survey_request_id'].',';
        $sql.= ''.$params['client_id'].',';
        $sql.= ''.$params['service_id'].',';
        $sql.= ''.$params['sale_id'].',';
        $sql.= ''.$params['branch_id__'].',';
        $sql.= '"'.$params['address'].'",';
        $sql.= '"'.$params['city'].'",';
        $sql.= '"'.$params['install_area'].'",';
        $sql.= '"'.$params['pic_name'].'",';
        $sql.= '"'.$params['pic_phone'].'",';
        $sql.= '"'.$params['pic_email'].'",';
        $sql.= '"'.$params['pic_position'].'",';
        $sql.= '"'.$params['createuser'].'"';
        $sql.= ') ';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $sql = 'update client_sites ';
        $sql.= 'set pic_name="'.$params['pic_name'] . '"';
        $sql.= ',pic_position="'.$params['pic_position'] . '"';
        $sql.= ',pic_email="'.$params['pic_email'] . '"';
        $sql.= ',pic_phone_area="'.$params['pic_phone_area'] . '"';
        $sql.= ', pic_phone="'.$params['pic_phone'] . '"';
        $sql.= ', address="'.$params['address'] . '"';
        $sql.= ', branch_id__="'.$params['branch'] . '"';
        $sql.= ', city="'.$params['city'] . '"';
        $sql.= 'where id='.$params['id'] . '';
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
}

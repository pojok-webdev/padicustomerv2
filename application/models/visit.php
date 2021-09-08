<?php
class Visit extends CI_Model{
    public $id;
    public $clientname;
    public $address;
    public $contactperson;
    public $position;
    public $hp;
    public $aim;
    public $visitstart;
    public $visitfinish;
    public $phone;
    public $visitdate;
    public $sale_id;
    public $transport;
    public $iscounted;
    public $nominalreimburse = 0;

    function gets(){
        $sql = "select a.id,b.name, a.address,a.contactperson,";
        $sql.= "a.position,a.contactnumber,a.purposeofvisit,a.visitdate1,a.visitdate2,";
        $sql.= "a.createdate,c.username ";
        $sql.= "from visits a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join users c on c.id=a.sale_id ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        return array(
            'res'=>$res,
            'tot'=>$tot
        );
    }
    function getclient($id){
        $ci = & get_instance();
        $sql = "select a.id,a.name, a.address,";
        $sql.= "a.createdate  ";
        $sql.= "from clients a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where a.active='1' ";
        $sql.= "and a.id = " .$id ." ";
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        if($tot>0){
            return $res[0];
        }
        return false;
    }
    function getclientstovisit(){
        $ci = & get_instance();
        $sql = "select a.id,a.name, a.address,";
        $sql.= "a.createdate  ";
        $sql.= "from clients a ";
        $sql.= "left outer join users b on b.id=a.sale_id ";
        $sql.= "where a.active='1' ";
//        $sql.= "where b.sale_id = " .$ci->session->userdata("id");
        $que = $ci->db->query($sql);
        $tot = $que->num_rows();
        $res = $que->result();
        return array(
            'res'=>$res,
            'tot'=>$tot
        );        
    }
    function save($params){
        $keys = array();$vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            if($key=='nominalreimburse'){
                array_push($vals,$val);
            }else{
                array_push($vals,'"'.$val.'"');
            }
        }
        $sql = "insert into visits ";
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "(".implode(",",$vals).") ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $pars = array();
        foreach($params as $key=>$val){
            array_push($pars,"".$key."='".$val."'");
        }
        $sql = "update visits ";
        $sql.= "set ";
        $sql.= " ".implode(",",$pars)." ";
        $sql.= "where id=".$params['id']." ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
    }
}
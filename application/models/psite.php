<?php
class Psite extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets($segment=0,$offset=10){

        //a.bwtype,a.upm,a.upk,a.upstr,a.dnm,a.dnk,a.dnstr,a.space,a.bandwidth,a.customservice
        $sql = "select a.id,b.name,a.address,";
        $sql.= "group_concat(";
        $sql.= "case c.category ";
        $sql.= "when 'Enterprise' then concat(c.category,'(Up:',c.upstr,'Down:',c.dnstr,' Ket:',c.name,')') ";
        $sql.= "when 'Colocation' then concat(c.category,'(Space:',c.space,' BW:',c.bandwidth,')') ";
        $sql.= "when 'Business' then concat(c.category,'(Value:',c.bandwidth,')') ";
        $sql.= "when 'Web + Applications' then concat(c.category,'(',c.name,')') ";
        $sql.= "when 'IIX (IIX)' then concat(c.category,'(Up:',c.upstr,'Down:',c.dnstr,')') ";
        $sql.= "when 'Local Loop' then concat(c.category,'(Up:',c.upstr,'Down:',c.dnstr,'Ket:',c.name,')') ";
        $sql.= "when 'Symetrical Broadband Internet (SBI)' then concat(c.category,'(Bandwidth:',c.bandwidth,')') ";
        $sql.= "when 'Padi Cluster' then concat(c.category,'(Bandwidth:',c.bandwidth,')') ";
        $sql.= "when 'Others (Wifi, ADSL, dll)' then concat(c.category,'(Ket:',c.name,')') ";
        $sql.= "when 'Custom' then concat(c.category,'(Ket:',c.name,')') ";
        $sql.= "when 'Hosting &amp; Domain' then concat(c.category,'(Ket:',c.name,')') ";
        $sql.= "when 'Hosting & Domain' then concat(c.category,'(Ket:',c.name,')') ";
        $sql.= "when 'Perangkat' then concat(c.category,'(Ket:',c.name,')') ";
        $sql.= "when 'oryza' then concat(c.category,'(Ket:',c.name,'BW:',c.bandwidth,')') ";
        $sql.= "when 'Mix' then concat(c.category,'(Ket:',c.name,')') ";


        
        $sql.= "else concat(c.category,'(',c.name,c.upstr,c.dnstr,c.space,c.bandwidth,')') ";
        $sql.= " end )services,";
        $sql.= "group_concat(e.name)vases,";
        $sql.= "group_concat(c.name)servicedesc ";
        $sql.= "from client_sites a  ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "left outer join siteservices c on a.id=c.site_id ";
        $sql.= "left outer join sitevases d on a.id=d.site_id ";
        $sql.= "left outer join vases e on e.id=d.vas_id ";
        $sql.= "group by a.id,b.name,a.address ";
       // $sql.= "limit " . $segment . "," . $offset . "";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function savevas($site_id,$vas_id){
        $sql = "insert into sitevases (site_id,vas_id) ";
        $sql.= "values ";
        $sql.= "('".$site_id."','".$vas_id."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
    }
    function saveservices($site_id,$service_id){
        $sql = "insert into siteservices (site_id,service_id) ";
        $sql.= "values ";
        $sql.= "('".$site_id."','".$service_id."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
    }
    function saveservice($params){
        $sql = "insert into siteservices ";
        $vals = array();$keys = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."') ";
        $sql.= " ";
        $ci = & get_instance();
        $ci->db->query($sql);
        return $sql;
//        return $ci->db->insert_id();
    }
}
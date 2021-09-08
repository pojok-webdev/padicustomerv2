<?php
class Vas extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function get_combo_data($firstrow = null){
        $ci = & get_instance();
        $arr = array();
        $sql = "select id,name,description from vases ";
        $que = $ci->db->query($sql);
        if($firstrow!=null){
            $arr[0] = $firstrow;
        }
        foreach($que->result() as $res){
            $arr[$res->id] = $res->name;
        }
        return $arr;
    }
    function populate(){
        $ci = & get_instance();
        $sql = "select id,name,description from vases ";
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getclients($vas_id){
        $sql = 'select distinct B.name,B.address from client_vases A ';
        $sql.= 'left outer join clients B on B.id=A.client_id ';
        $sql.= 'where vas_id="'.$vas_id.'"';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=> $que->num_rows(),
            'res'=> $que->result()
        );
    }
    function getnamebyid($vas_id){
        switch($vas_id){
        case "1" :
            $out = "Blocking Site";
        break;
        case "2":
            $out = "Port Forwarding";
            break;
        case "3":
            $out = "Additional Public IP";
            break;
        case "4":
            $out="Firewall Rules/Allow IP";
        break;
        case "5":
            $out = "Firewall Protection";
        break;
        case "6":
            $out = "Bandwidth Management";
        break;
        case "7":
            $out = "Backup Last Mile";
        break;
        case "8":
            $out = "Bandwidth On Demand";
        break;
        case "9":
            $out = "Domain Names";
        break;
        case "10":
            $out = "Hosting";
        break;
        case "11":
            $out = "Load Sharing";
        break;
        case "12":
            $out = "Load Balance";
        break;
        case "13":
            $out = "Failover";
        break;
        case "14":
            $out = "VPN + IP Routing";
        break;
        case "15":$out = "Voip Line";break;
        case "16":$out = "Hotspot Login";break;
        case "17":$out = "Zimbra Mail Server Setup";break;
        case "18":$out = "Proxy Server Setup";break;
        case "19":$out = "Basic Network Consultation By Phone";break;
        case "20":$out = "24/7 Call Support";break;
        case "21":$out = "Whatsapp Support";break;
        case "22":$out = "Traffic Monitoring";break;
        case "23":$out = "Weekday Troubleshoot";break;
        case "24":$out = "Emergency Team For Weekend/Non Office Hour Troubleshoot";break;
        case "25":$out = "EoS";break;
}
return $out;
    }
}
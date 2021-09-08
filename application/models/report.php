<?php
class Report extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getObject(){
        return array(
            'name'=>'Harapan Djaja'
        );
    }
    function getdata($nofb){
        $sql = 'select a.nofb,a.name,a.address,a.billaddress,activationdate,a.accounttype,';
        $sql.= 'a.siup,a.npwp,a.sppkp,a.telp,a.fax,a.period1,a.period2,c.username,';
        $sql.= 'd.dpp setupdpp,a.businesstype,a.otherbusinesstype ';
        $sql.= 'from fbs a ';
        $sql.= 'left outer join clients b on b.id=a.client_id ';
        $sql.= 'left outer join users c on c.id=b.sale_id ';
        $sql.= 'left outer join (select nofb,dpp from fbfees where name="setup") d on d.nofb=a.nofb ';
        $sql.= 'where a.nofb="'.$nofb.'"';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0];
    }
    function getfbpics($nofb,$role){
        $sql = 'select a.* from fbpics a  ';
        $sql.= 'left outer join fbs b on b.nofb =a.nofb ';
        $sql.= 'left outer join clients c on c.id=b.client_id ';
        $sql.= 'where a.nofb="'.$nofb.'" and a.role="'.$role.'" ';


        $sql = 'select A.* from ';
        $sql.= '(';
        $sql.= ' select a.name,a.nofb,a.role,a.position,a.idnum,a.phone,a.email,a.createdate  ';
        $sql.= ' from fbpics a ';
        $sql.= ' left outer join fbs b on b.nofb =a.nofb ';
        $sql.= ' left outer join clients c on c.id=b.client_id ';
        $sql.= ' where a.nofb="'.$nofb.'" and a.role="'.$role.'" and b.status="1"';
        $sql.= ')A ';
        $sql.= 'right outer join ';
        $sql.= '(';
        $sql.= ' select a.nofb,a.role,a.position,max(createdate)createdate ';
        $sql.= ' from fbpics a ';
        $sql.= ' where a.nofb="'.$nofb.'" and a.role="'.$role.'" ';
        $sql.= ' group by a.nofb,a.role,a.position';
        $sql.= ' )B on B.createdate=A.createdate ';

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows>0){
            return $res[0];
        }else{
            return new fakePics;//false;
        }
    }
    function getservices($nofb){
        $sql = 'select a.* from fbservices a ';
        $sql = 'select case category ';
        $sql.= 'when "Enterprise" then concat ("Enterprise, Up: ",upstr,"0 Mbps ",case dnstr when "0" then "" else concat(" ,Down:",dnstr, "0 Mbps") end) ';
        $sql.= 'when "Business" then concat ("Business ",bandwidth) ';
        $sql.= 'when "Colocation" then concat ("Colocation ",space,"  ","Bandwidth ",bandwidth) ';
        $sql.= 'when "IIX (IIX)" then concat (category," Up: ",upstr,"0 Mbps ",case dnstr when "0" then "" else concat(" ,Down:",dnstr, "0 Mbps") end) ';
        $sql.= 'when "Local Loop" then concat ("Local Loop ",name," Up:",upstr,"0 Mbps",case dnstr when "0" then "" else concat(" ,Down:",dnstr, "0 Mbps") end) ';
        $sql.= 'when "Symetrical Broadband Internet (SBI)" then concat ("SBI ",name," ",bandwidth) ';
        $sql.= 'when "Hosting & Domain" then concat ("Hosting & Domain ",name) ';
        $sql.= 'when "Mix" then concat ("Mix ",name) ';
        $sql.= 'when "Others (Wifi, ADSL, dll)" then concat ("",name) ';
        $sql.= 'when "Proyek" then concat ("Proyek",name) ';
        $sql.= 'when "Perangkat" then concat ("Perangkat",name) ';
        $sql.= 'when "Setup & Instalasi" then concat ("Setup & Instalasi",name) ';
        $sql.= 'when "Oryza" then concat ("Oryza",name," BW:",bandwidth) ';
        $sql.= 'when "Padi Cluster" then concat ("Padi Cluster"," BW:",bandwidth) ';
        $sql.= 'when "Custom" then concat ("Custom"," (",name,")") ';
        $sql.= 'else "" end srv,humanreadable1,humanreadable2   ';
        $sql.= 'from fbservices a ';
        $sql.= 'where a.fb_id="'.$nofb.'" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getfees($nofb,$name = null){
        $sql = 'select name,format(dpp,0)dpp,format(ppn,0)ppn,format(dpp+ppn,0) total from fbfees ';
        if($name==null){
            $sql.= 'where nofb="'.$nofb.'" and name not in ("monthly","device") ';
        }else{
            $sql.= 'where nofb="'.$nofb.'" and name="'.$name.'" ';
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }else{
            return false;
        }
    }
    function getfbs(){
        $sql = 'select a.nofb,a.name,a.address,';
        $sql.= 'a.siup,a.npwp,a.telp,a.fax,a.period1,a.period2,c.username,d.dpp setupdpp from fbs a ';
        $sql.= 'left outer join clients b on b.id=a.client_id ';
        $sql.= 'left outer join users c on c.id=b.sale_id ';
        $sql.= 'left outer join (select nofb,dpp from fbfees where name="setup") d on d.nofb=a.nofb ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
    function updatehumanreadable1($params){
        $sql = "update fbservices ";
        $sql.= "set humanreadable1='".$params['humanreadable1']."'";
        $sql.= "where fb_id='".$params['nofb']."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function updatehumanreadable2($params){
        $sql = "update fbservices ";
        $sql.= "set humanreadable2='".$params['humanreadable2']."'";
        $sql.= "where fb_id='".$params['nofb']."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function restorehumanreadable1($nofb){
        $sql = 'select a.* from fbservices a ';
        $sql = 'select case category ';
        $sql.= 'when "Enterprise" then concat ("Enterprise, Up: ",upstr,"0 Mbps ",case dnstr when "0" then "" else concat(" ,Down:",dnstr, "0 Mbps") end) ';
        $sql.= 'when "Business" then concat ("Business ",bandwidth) ';
        $sql.= 'when "Colocation" then concat ("Colocation ",space,"  ","Bandwidth ",bandwidth) ';
        $sql.= 'when "IIX (IIX)" then concat (category," Up: ",upstr,"0 Mbps ",case dnstr when "0" then "" else concat(" ,Down:",dnstr, "0 Mbps") end) ';
        $sql.= 'when "Local Loop" then concat ("Local Loop ",name," Up:",upstr,"0 Mbps",case dnstr when "0" then "" else concat(" ,Down:",dnstr, "0 Mbps") end) ';
        $sql.= 'when "Symetrical Broadband Internet (SBI)" then concat ("SBI ",name," ",bandwidth) ';
        $sql.= 'when "Hosting & Domain" then concat ("Hosting & Domain ",name) ';
        $sql.= 'when "Mix" then concat ("Mix ",name) ';
        $sql.= 'when "Others (Wifi, ADSL, dll)" then concat ("",name) ';
        $sql.= 'when "Proyek" then concat ("Proyek",name) ';
        $sql.= 'when "Perangkat" then concat ("Perangkat",name) ';
        $sql.= 'when "Setup & Instalasi" then concat ("Setup & Instalasi",name) ';
        $sql.= 'when "Oryza" then concat ("Oryza",name," BW:",bandwidth) ';
        $sql.= 'when "Padi Cluster" then concat ("Padi Cluster"," BW:",bandwidth) ';
        $sql.= 'when "Custom" then concat ("Custom"," (",name,")") ';
        $sql.= 'else "" end srv,humanreadable1,humanreadable2   ';
        $sql.= 'from fbservices a ';
        $sql.= 'where a.fb_id="'.$nofb.'" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
}
class fakePics{
    public $name;
    public $position;
    public $idnum;
    public $email;
    public $phone;
}
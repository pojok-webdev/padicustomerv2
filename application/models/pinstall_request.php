<?php
class Pinstall_request extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function savevas($params){
        $keys = array();$vals = array();
        foreach($params as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $ci = & get_instance();
        $sql = "insert into client_vases ";
        $sql.= "(".implode(",",$keys).") ";
        $sql.= "values ";
        $sql.= "('".implode("','",$vals)."')";
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function get_client_by_survey_request($survey_request_id){
        $ci = & get_instance();
        $sql = "select a.client_id from survey_requests a ";
        $sql.= "where a.id = " . $survey_request_id . "" ;
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0]->client_id;
        }else{
            return false;
        };
    }
    function getvases($client_id){
        $ci = & get_instance();
        $sql = "select a.id,a.vas_id,a.toremove,b.name,";
        $sql.= "case a.implemented ";
        $sql.= "when '0' then 'Belum dilaksanakan' ";
        $sql.= "when '1' then 'Sudah dilaksanakan' ";
        $sql.= "end implemented,";
        $sql.= "case a.toremove ";
        $sql.= "when '1' then 'Pengajuan Hapus oleh Sales' ";
        $sql.= "when '2' then 'Telah dihapus oleh TS' ";
        $sql.= " else ' ' ";
        $sql.= "end toremovestatus, ";
        $sql.= "case a.toremove ";
        $sql.= "when '1' then 'Pembatalan Pengajuan Hapus oleh Sales' ";
        $sql.= "when '2' then 'Ajukan kembali' ";
        $sql.= " else ' ' ";
        $sql.= "end toremovemenu ";
        $sql.= "from client_vases a ";
        $sql.= "left outer join vases b on b.id=a.vas_id ";
        $sql.= "where a.client_id = " . $client_id . " " ;
        $que = $ci->db->query($sql);
        $res = $que->result();
        return array('records'=>$res,'total'=>$que->num_rows());
    }
    function removevas($params){
        $ci = & get_instance();
        $sql = "delete from client_vases ";
        $sql.= "where id=".$params["id"]."";
        $que = $ci->db->query($sql);
        return $sql;
    }
    function updatevas($params){
        $ci = & get_instance();
        $arr = array();
        foreach($params as $key=>$val){
            array_push($arr,$key."='".$val."'" );
        }
        $sql = "update client_vases ";
        $sql.= "set " .implode(",",$arr). " ";
        $sql.= "where id=".$params["id"]." ";
        $que = $ci->db->query($sql);
        return $sql;
    }
    function get_client_by_install_site($install_site_id){
        $ci = & get_instance();
        $sql = "select b.client_id, c.name,d.name service,a.address,a.city,a.pic_name,a.pic_position,";
        $sql.= "a.pic_phone_area,a.pic_phone,a.install_date,a.status,a.resume ";
        $sql.= "from install_sites a ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "left outer join services d on d.id=c.service_id ";
        $sql.= "where a.id = " . $install_site_id . "" ;
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }else{
            return false;
        };
    }
    function get_obj_by_id($id){
        $ci = & get_instance();
        $sql = "select a.id,a.install_request_id,a.status,a.service_id,a.pic_name,";
        $sql.= "a.pic_phone_area,a.pic_phone,a.client_site_id,a.address,";
        $sql.= "a.pic_position,a.pic_email,a.install_date,a.description,a.resume,";
        $sql.= "b.address client_site_address, c.id clientid,c.name clientname,c.city client_city,";
        $sql.= "c.sale_id ,d.withtrial,d.trialdistance,c.clientcategory,";
        $sql.= "c.address client_address ";
        $sql.= "from install_sites a ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "left outer join install_requests d on d.id=a.install_request_id ";
        $sql.= "where a.id=".$id."";
        $que = $ci->db->query($sql);
        $res = $que->result();
        if($que->num_rows()>0){
            return $res[0];
        }else{
            return false;
        };
    }
    function get_operators($install_site_id){
        $sql = "select * from install_installers a left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id=".$install_site_id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function saveinstalldescription($params){
        $sql = "update install_requests set description= '".$params['description']."' ";
        $sql.= "where id=".$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function saveinstallsitedescription($params){
        $sql = "update install_sites set description= '".$params['description']."' ";
        $sql.= "where id=".$params['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getrouters($install_site_id){
        $sql = "select * from install_routers a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . "";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getinstallapwifis($install_site_id){
        $sql = "select * from install_ap_wifis a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . "";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getimages($install_site_id,$title = null){
        $sql = "select a.* from install_images a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        if($title!=null){
            $sql.= "and title='".$title."' ";
        }
        $sql.= "order by roworder asc ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getmaterials($install_site_id){
        $sql = "select a.* from install_materials a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getmaterial($id){
        $sql = "select a.* from install_materials a ";
        $sql.= "where a.id = " . $id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return array('res'=>$res[0],'count'=>$que->num_rows());
    }
    function getresumes($install_site_id){
        $sql = "select * from install_resumes a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getwirelessradios($install_site_id){
        $sql = "select * from install_wireless_radios a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getswitches($install_site_id){
        $sql = "select * from install_switches a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getpccards($install_site_id){
        $sql = "select * from install_pccards a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getantennas($install_site_id){
        $sql = "select a.* from install_antennas a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getbas($install_site_id){
        $sql = "select * from install_bas a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function getinstallers($install_site_id){
        $sql = "select * from install_installers a ";
        $sql.= "left outer join install_sites b on b.id=a.install_site_id ";
        $sql.= "where b.id = " . $install_site_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'count'=>$que->num_rows());
    }
    function updatematerial($params){
        $sql = 'update install_materials ';
        $sql.= 'set material_id='.$params['material_id'].', ';
        $sql.= 'tipe="'.$params['tipe'].'", ';
        $sql.= 'name="'.$params['name'].'", ';
        $sql.= 'description="'.$params['description'].'" ';
        $sql.= 'where id='.$params['id'].' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getvsds($id){
        $directory = '/home/webdev/Documents/test/padi/';
        $directory = '/home/klien/padiapp-data/installs/vsd/'.$id;
        $directory = './padiapp-data/installs/vsd/'.$id;
        $filecount = 0;
        $files = glob($directory . "*.vsd");
        $arr = array();
        if ($files){
          foreach($files as $fl){
           // echo substr($fl,38,strlen($fl) - 38);
            array_push($arr,substr($fl,38,strlen($fl) - 38));
          }
        }
        return $files;
    }
}
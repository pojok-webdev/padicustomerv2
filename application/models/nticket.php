<?php
class Nticket extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function gets($segment,$offset){
        $sql = 'select a.id,a.kdticket,a.clientname,a.create_date,now(),timediff(now(),a.create_date)dt, ';
        $sql.= 'datediff(now(),a.ticketstart)age, ';
        $sql.= 'case when datediff(now(),a.ticketstart)>2 and datediff(now(),a.ticketstart) <8 then "yellow" end ageclass, ';
        $sql.= 'b.address, ';
        $sql.= 'case c.category_id ';
        $sql.= 'when "1" then "FFR" ';
        $sql.= 'when "2" then "Platinum" ';
        $sql.= 'when "3" then "Gold" ';
        $sql.= 'when "4" then "Silver" ';
        $sql.= 'when "5" then "Bronze" ';
        $sql.= 'end category, ';

        $sql.= 'case a.status ';
        $sql.= 'when "0" then "Open" ';
        $sql.= 'when "1" then "Closed" ';
        $sql.= 'end ticketstatus, ';
        
        $sql.= 'group_concat(d.name) service, ';
        $sql.= 'f.name mainroot, ';
        $sql.= 'group_concat(h.name) vas ';
        $sql.= 'from tickets a ';
        $sql.= 'left outer join client_sites b on b.id=a.client_site_id ';
        $sql.= 'left outer join clients c on c.id=a.client_id ';
        $sql.= 'left outer join siteservices d on d.site_id=b.id ';
        $sql.= 'left outer join ticketcauses e on e.id=a.cause_id ';
        $sql.= 'left outer join ticketcausecategories f on e.category_id=f.id ';
        $sql.= 'left outer join sitevases g on g.site_id=b.id ';
        $sql.= 'left outer join vases h on h.id=g.vas_id ';
        $sql.= 'group by a.id,a.kdticket,a.clientname,a.create_date,c.category_id,f.name ';
        $sql.= 'order by create_date desc ';
        if(($segment!="null")&&($offset!="null")){
            $sql.= 'limit '.$segment.','.$offset.'';
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        $out = array('cnt'=>$que->num_rows,'res'=>$res);
        return $out;
    }
    function gettotal(){
        $sql = 'select id,kdticket,clientname,create_date,now(),timediff(now(),create_date)dt from tickets ';
        $sql.= 'order by create_date desc ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        $out = array('cnt'=>$que->num_rows,'res'=>$res);
        return $out;
    }
}
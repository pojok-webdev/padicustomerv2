<?php
class Pticket extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getinfo($id){
        $sql = "select a.id,b.kdticket,b.cause_id,c.name subcause,d.name maincause,b.complaint, ";
        $sql.= "a.confirmationresult,a.description,a.followupDate,a.conclusion,a.picname,a.picphone,a.result,a.position, ";
        $sql.= "concat(datediff(b.downtimeend,b.downtimestart) ,' hari ',timediff(b.downtimeend,b.downtimestart)) downtime ";
        $sql.= "from ticket_followups a left outer join tickets b ";
        $sql.= "on b.id=a.ticket_id ";
        $sql.= "left outer join ticketcauses c on c.id=b.cause_id ";
        $sql.= "left outer join ticketcausecategories d on d.id=c.category_id ";
        $sql.= "where a.id = " . $id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array("result"=>$que->result(),"amount"=>$que->num_rows());
    }
    function getticket($search,$page,$rownum){
        $ci = & get_instance();
        if($page>0){
            $startrow = ($page-1)*$rownum;
        }else{
            $startrow = 0;
        }
        $sql = "select a.id,kdticket,service,case a.status when '0' then 'Open' when '1' then 'Closed' end status,";
        $sql.= "ticketstart,ticketend,reporter,reporterphone,createuser,clientname,count(b.id) troubleshootcount from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where clientname like '%".$search."%' ";
        $sql.= "group by a.id,kdticket,service,a.status,ticketstart,reporter,reporterphone,createuser,clientname ";
        $qcount = $ci->db->query($sql);
        $count = $qcount->num_rows();
        $sql.= "order by kdticket desc ";
        //$sql.= "limit $startrow,$rownum ";
        $que = $ci->db->query($sql);
        return array("result"=>$que->result(),"amount"=>$count);
    }
    function getbyid($id){
        $ci = & get_instance();
        $sql = "select a.id,a.kdticket,a.clientname,a.client_site_id,requesttype,c.phone clientphone,a.complaint,a.location ,a.description from tickets a ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "where a.id=".$id;
        $que = $ci->db->query($sql);
        return $que->result()[0];
    }
    function conv($num){
        switch($num){
            case 1:
            $out = "one";
            break;
            case 2:
            $out = "two";
            break;
            case 3:
            $out = "three";
            break;
            case 4:
            $out = "four";
            break;
            case 5:
            $out = "five";
            break;
            case 6:
            $out = "six";
            break;
            case 7:
            $out = "seven";
            break;
            case 8:
            $out = "eight";
            break;
            case 9:
            $out = "nine";
            break;
            case 10:
            $out = "ten";
            break;
            case 11:
            $out = "eleven";
            break;
            case 12:
            $out = "twelve";
            break;
            case 13:
            $out = "thirteen";
            break;
            case 14:
            $out = "fourteen";
            break;
            case 15:
            $out = "fifteen";
            break;
            case 16:
            $out = "sixteen";
            break;
            case 17:
            $out = "seventeen";
            break;
            case 18:
            $out = "eighteen";
            break;
            case 19:
            $out = 'nineteen';
            break;
            case 20:
            $out = 'twenty';
            break;
            case 21:
            $out = "twentyone";
            break;
            case 22:
            $out = "twentytwo";
            break;
            case 23:
            $out = "twentythree";
            break;
            case 24:
            $out = "twentyfour";
            break;
            case 25:
            $out = "twentyfive";
            break;
            case 26:
            $out = "twentysix";
            break;
            case 27:
            $out = "twentyseven";
            break;
            case 28:
            $out = "twentyeight";
            break;
            case 29:
            $out = "twentynine";
            break;
            case 30:
            $out = "thirty";
            break;
            case 31:
            $out = "thirtyone";
            break;
        }
        return $out;
    }
    function getcomplaintsperclient(){
        $ci = & get_instance();
        $sql = "select clientname,count(clientname)amount ";
        $sql.= "from tickets where date_format(create_date,'%d')='1' ";
        $sql.= "group by clientname ";
        $sql = "select  ";
        $sql.= "  clientname, ";
        for($d = 1;$d<32;$d++){
            $sql.= "sum(".$this->conv($d).")".$this->conv($d).",";
        }/*
        $sql.= "    sum(one) satu, ";
        $sql.= "    sum(two)dua, ";
        $sql.= "    sum(three)tiga, ";
        $sql.= "    sum(four)empat, ";
        $sql.= "    sum(five)lima, ";
        $sql.= "    sum(six)enam, ";
        $sql.= "    sum(seven)tujuh, ";
        $sql.= "    sum(eight) delapan, ";
        $sql.= "    sum(nine) sembilan , ";
        $sql.= "    sum(ten) sepuluh, ";*/
        $sql.= "    sum(eleven) sebelas  ";
        $sql.= "  from ";
        $sql.= "  ( ";
        for($c = 1;$c<32;$c++){
            $sql.= " select ";
            $sql.= " a.clientname,";
            for($d = 1;$d<32;$d++){
                if($d == $c){
            $sql.= " count(b.id) ".$this->conv($d).",";
                }else{
                    $sql.= "'0' " . $this->conv($d) . ",";
                }
            }
            $sql.= " '0' extracol ";
            $sql.= " from tickets a  ";
            $sql.= " left outer join  ";
            $sql.= " (select id,date_format(create_date,'%d')x from tickets where date_format(create_date,'%d')='".$c."') b ";
            $sql.= " on b.id=a.id  ";
            $sql.= " group by clientname ";
            $sql.= " union ";
        }
        $sql.= " select a.clientname,count(b.id) one,'0' two,'0' three,'0' four,'0' five,";
        $sql.= " '0' six,'0' seven,'0' eight,'0' nine,'0' ten,'0' eleven ";
        $sql.= " ,'0' twelve,'0' thirteen,'0' fourteen,'0' fifteen,'0' sixteen,";
        $sql.= " '0' seventeen,'0' eighteen,'0' nineteen,'0' twenty,'0' twentyone,";
        $sql.= " '0' twentytwo,'0' twentyfour,'0' twentyfive,'0' twenty,'0' twentysix,";
        $sql.= " '0' twentyseven,'0' twentyeight,'0' twentynine,'0' thirty,'0' thirtyone,";
        $sql.= " '0' extracol ";
        $sql.= " from tickets a  ";
        $sql.= " left outer join  ";
        $sql.= " (select id,date_format(create_date,'%d')x from tickets where date_format(create_date,'%d')='31') b ";
        $sql.= " on b.id=a.id  ";
        $sql.= " group by clientname ";
        $sql.= "  ) x group by clientname ";
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getshiftreport($ticketstart,$branchselected){
        $sql = "select distinct a.id,a.kdticket,a.clientname,a.reporter,";
        $sql.= "group_concat(confirmationresult) confirmationresult,";
        $sql.= "group_concat(conclusion) conclusion,";
        $sql.= "date_format(ticketstart,'%H:%i:%s')ticketstart,a.complaint,a.status,";
        $sql.= "case f.clientcategory ";
        $sql.= "when '1' then 'FFR' ";
        $sql.= "when '2' then 'Platinum' ";
        $sql.= "when '3' then 'Gold' ";
        $sql.= "when '4' then 'Bronze' ";
        $sql.= "when '5' then 'Silver' ";
        $sql.= "else 'Other' end category,";
      
        //$sql.= "group_concat(b.branch)branch,";
        $sql.= "case f.branch_id when  '1' then 'Surabaya' when '2' then 'Jakarta' when '3' then 'Malang' when '4' then 'Bali' end branch,";
        //$sql.= "case b.branch_id when '1' then 'Surabaya' when '2' then 'Jakarta' when '3' then 'Malang' when '4' then 'Bali' end branch  ";
        $sql.= "c.name subcause,d.name maincause ";
        $sql.= "from tickets a ";
        //$sql.= "left outer join (select branch_id,client_site_id, case branch_id when  '1' then 'Surabaya' when '2' then 'Jakarta' when '3' then 'Malang' when '4' then 'Bali' end branch  from branches_client_sites) b on b.client_site_id=a.client_site_id  ";
        $sql.= "left outer join ticket_followups e on e.ticket_id=a.id ";

        $sql.= "left outer join ticketcauses c on c.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories d on d.id=c.category_id ";

        $sql.= "left outer join clients f on f.id=a.client_id ";

        $sql.= "where date(a.ticketstart)='".$ticketstart."' and f.branch_id in (".$branchselected.") ";
        $sql.= "group by a.id,a.kdticket,a.clientname,a.reporter,a.ticketstart,a.complaint,a.status,c.name,d.name ";
        $res = $this->db->query($sql);
		$tickets = $res->result();
        return array("res"=>$tickets,"total"=>$res->num_rows());
    }
    function getticketbykdticket($id){
        $sql = 'select ';
        $sql.= 'clientname,complaint,ticketstart,description,cause,solution ';
        $sql.= 'from tickets ';
        $sql.= 'where id="'.$id.'"';
        $res = $this->db->query($sql);
        $tickets = $res->result();
        if($res->num_rows()>0){
            return $tickets[0];
        }
    }
    function getshiftreportperiodic($ticketstart,$ticketend,$branchselected,$causecategories){
        $sql = "select distinct a.id,a.kdticket,a.clientname,a.reporter,";
        $sql.= "case e.clientcategory ";
        $sql.= "when '1' then 'FFR' ";
        $sql.= "when '2' then 'Platinum' ";
        $sql.= "when '3' then 'Gold' ";
        $sql.= "when '4' then 'Bronze' ";
        $sql.= "when '5' then 'Silver' ";
        $sql.= "else 'Other' end category,";
        $sql.= "c.name subrootcause, d.name mainrootcause, ";
        $sql.= "date_format(ticketstart,'%d-%b-%Y %H:%i:%s')ticketstart,a.complaint,a.status ";
        $sql.= "from tickets a ";
        $sql.= "left outer join ticketcauses c on c.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories d on d.id=c.category_id ";
        $sql.= "left outer join clients e on e.id=a.client_id ";
        $sql.= "where ";
        $sql.= "date(a.ticketstart)>='".$ticketstart."' ";
        $sql.= "and ";
        $sql.= "date(a.ticketstart)<='".$ticketend."' ";
        $sql.= "and e.branch_id in (".$branchselected.") ";
        $sql.= "and d.id in (".$causecategories.") ";
        $res = $this->db->query($sql);
		$tickets = $res->result();
        return array("res"=>$tickets,"total"=>$res->num_rows());        
    }
    function getcategoryreportperiodic($ticketstart,$ticketend,$branchselected){
        $sql = "select cause_id,cause,causecategory,count(cause)cnt from ( ";
        $sql.= "select a.cause_id,v.name cause,u.name causecategory,a.kdticket,a.requesttype,a.ticketstart,ticketend, ";
        $sql.= "case a.requesttype  ";
        $sql.= "when 'pelanggan' then w.branch_id  ";
        $sql.= "when 'backbone' then '1'  ";
        $sql.= "when 'bts' then d.branch_id  ";
        $sql.= "when 'Datacenter' then e.branch_id  ";
        $sql.= "when 'PTP' then f.branch_id  ";
        $sql.= "when 'Core' then g.branch_id  ";
        $sql.= "when 'AP' then y.branch_id  ";
        $sql.= "end branchid, ";
        $sql.= "a.create_date from tickets a  ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        //$sql.= "left outer join branches_client_sites z on z.client_site_id=b.id ";
        $sql.= "left outer join backbones c on c.id=a.backbone_id ";
        $sql.= "left outer join btstowers d on d.id=a.btstower_id ";
        $sql.= "left outer join datacenters e on e.id=a.datacenter_id ";
        $sql.= "left outer join ptps f on f.id=a.ptp_id ";
        $sql.= "left outer join cores g on g.id=a.core_id ";
        $sql.= "left outer join aps h on h.id=a.ap_id left outer join btstowers y on y.id=h.btstower_id ";
        $sql.= "left outer join clients w on w.id=b.client_id ";
        $sql.= "left outer join ticketcauses v on v.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories u on u.id=v.category_id ";
        $sql.= "where date(ticketstart)>='".$ticketstart."' ";
        $sql.= "and date(ticketstart)<='".$ticketend."' ";
        $sql.= "and trim(a.cause)!=''";
        $sql.= ")x where branchid in (".$branchselected.") ";
        $sql.= "group by cause_id,cause,causecategory ";
        $res = $this->db->query($sql);
		$tickets = $res->result();
        return array("res"=>$tickets,"total"=>$res->num_rows());        
    }
    function getticketbycause($ticketstart,$ticketend,$branchselected,$cause){
        $sql = "select x.id,x.cause,x.clientname,x.branchid,y.name branch,x.ticketstart,x.kdticket,x.create_date from ( ";
        $sql.= "select a.id,a.clientname,a.cause,a.kdticket,a.requesttype,a.ticketstart,ticketend, ";
        $sql.= "case a.requesttype  ";
        $sql.= "when 'pelanggan' then w.branch_id  ";
        $sql.= "when 'backbone' then '1'  ";
        $sql.= "when 'bts' then d.branch_id  ";
        $sql.= "when 'Datacenter' then e.branch_id  ";
        $sql.= "when 'PTP' then f.branch_id  ";
        $sql.= "when 'Core' then g.branch_id  ";
        $sql.= "when 'AP' then y.branch_id  ";
        $sql.= "end branchid, ";
        $sql.= "a.create_date from tickets a  ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        //$sql.= "left outer join branches_client_sites z on z.client_site_id=b.id ";
        $sql.= "left outer join backbones c on c.id=a.backbone_id ";
        $sql.= "left outer join btstowers d on d.id=a.btstower_id ";
        $sql.= "left outer join datacenters e on e.id=a.datacenter_id ";
        $sql.= "left outer join ptps f on f.id=a.ptp_id ";
        $sql.= "left outer join cores g on g.id=a.core_id ";
        $sql.= "left outer join aps h on h.id=a.ap_id left outer join btstowers y on y.id=h.btstower_id ";
        $sql.= "left outer join clients w on w.id=b.client_id ";
        $sql.= "where date(ticketstart)>='".$ticketstart."' ";
        $sql.= "and date(ticketstart)<='".$ticketend."' ";
        $sql.= "and cause_id='".$cause."' ";
        $sql.= "and trim(a.cause)!='' ";
        $sql.= ")x ";
        $sql.= "left outer join branches y on y.id=x.branchid ";
        $sql.= "where branchid in (".$branchselected.") ";
        $sql.= "order by x.branchid,x.cause,x.clientname";
        $res = $this->db->query($sql);
		$tickets = $res->result();
        return array("res"=>$tickets,"total"=>$res->num_rows());        
        
    }
    function getsubtotalticketbycause($ticketstart,$ticketend,$branchselected,$cause){
        $sql = "select count(x.branchid)cnt,x.branchid,y.name branch from ( ";
        $sql.= "select a.clientname,a.cause,a.kdticket,a.requesttype,a.ticketstart,ticketend, ";
        $sql.= "case a.requesttype  ";
        $sql.= "when 'pelanggan' then w.branch_id  ";
        $sql.= "when 'backbone' then '1'  ";
        $sql.= "when 'bts' then d.branch_id  ";
        $sql.= "when 'Datacenter' then e.branch_id  ";
        $sql.= "when 'PTP' then f.branch_id  ";
        $sql.= "when 'Core' then g.branch_id  ";
        $sql.= "when 'AP' then y.branch_id  ";
        $sql.= "end branchid, ";
        $sql.= "a.create_date from tickets a  ";
        $sql.= "left outer join client_sites b on b.id=a.client_site_id ";
        //$sql.= "left outer join branches_client_sites z on z.client_site_id=b.id ";
        $sql.= "left outer join backbones c on c.id=a.backbone_id ";
        $sql.= "left outer join btstowers d on d.id=a.btstower_id ";
        $sql.= "left outer join datacenters e on e.id=a.datacenter_id ";
        $sql.= "left outer join ptps f on f.id=a.ptp_id ";
        $sql.= "left outer join cores g on g.id=a.core_id ";
        $sql.= "left outer join aps h on h.id=a.ap_id left outer join btstowers y on y.id=h.btstower_id ";
        $sql.= "left outer join clients w on w.id=b.client_id ";
        $sql.= "where ticketstart>='".$ticketstart."' ";
        $sql.= "and ticketstart<='".$ticketend."' ";
        $sql.= "and cause_id='".$cause."' ";
        $sql.= "and trim(a.cause)!='' ";
        $sql.= ")x ";
        $sql.= "left outer join branches y on y.id=x.branchid ";
        $sql.= "where branchid in (".$branchselected.") ";
        $sql.= "order by x.branchid,x.cause,x.clientname";
        $res = $this->db->query($sql);
		$tickets = $res->result();
        return array("res"=>$tickets,"total"=>$res->num_rows());                
    }
    function getcausebycauseid($id){
        $sql = "select name from ticketcauses where id=".$id." ";
        $que = $this->db->query($sql);
        $res = $que->result();
        return $res[0]->name;
    }
    function getcausebycategoryid($id){
        $sql = "select id,name from ticketcauses where category_id=".$id." and active='1'";
        $que = $this->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getshiftticketcount($shiftnum,$dt){
        $ldt = $dt->format("Y-m-d");
        switch($shiftnum){
            case '1':
            $sql = 'select count(id)cnt from tickets where create_date between "'.$ldt.' 08:00:01" and  "'.$ldt.' 17:00:00"';
            break;
            case '2':
            $sql = 'select count(id)cnt from tickets where create_date between "'.$ldt.' 16:00:01" and  "'.$ldt.' 24:00:00"';
            break;
            case '3':
            $ldt = date('Y-m-d H:i:s', strtotime($dt->format('Y-m-d') . ' +1 day'));
            $sql = 'select count(id)cnt from tickets where create_date between "'.$ldt.' 24:00:01" and  "'.$ldt.' 08:00:00"';
            break;
        }
        $que = $this->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function getshiftfucount($shiftnum,$dt){
        $ldt = $dt->format("Y-m-d");
        switch($shiftnum){
            case '1':
            $sql = 'select count(id)cnt from ticket_followups where createdate between "'.$ldt.' 08:00:01" and  "'.$ldt.' 17:00:00"';
            break;
            case '2':
            $sql = 'select count(id)cnt from ticket_followups where createdate between "'.$ldt.' 16:00:01" and  "'.$ldt.' 24:00:00"';
            break;
            case '3':
            $ldt = date('Y-m-d H:i:s', strtotime($dt->format('Y-m-d') . ' +1 day'));
            $sql = 'select count(id)cnt from ticket_followups where createdate between "'.$ldt.' 24:00:01" and  "'.$ldt.' 08:00:00"';
            break;
        }
        
        $que = $this->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function getshiftticketopencount($shiftnum,$dt){
        $ldt = $dt->format("Y-m-d");
        switch($shiftnum){
            case '1':
            $sql = 'select count(b.id)cnt from tickets a left outer join ticket_followups b on b.ticket_id=a.id ';
            $sql.= 'where create_date between "'.$ldt.' 08:00:00" and  "'.$ldt.' 17:00:00"';
            
            $sql = 'select A.id,count(B.ticket_id)cnt from tickets A left outer join ';
            $sql.= '(';
            $sql.= '  select ticket_id from ticket_followups ';
            $sql.= '  where result="1" and createdate>="2018-9-01" ';
            $sql.= '  and create_date between "'.$ldt.' 08:00:00" ';
            $sql.= '  and  "'.$ldt.' 17:00:00"';
            $sql.= ') B on B.ticket_id=A.id ';
            $sql.= 'where A.status="0" ';
            $sql.= 'and B.ticket_id is null ';
            $sql.= 'and A.create_date>="2018-9-1" group by A.id';
            break;
            case '2':
            $sql = 'select count(id)cnt from tickets where create_date between "'.$ldt.' 16:00:00" and  "'.$ldt.' 24:00:00"';
            break;
            case '3':
            $ldt = date('Y-m-d H:i:s', strtotime($dt->format('Y-m-d') . ' +1 day'));
            $sql = 'select count(id)cnt from tickets where create_date between "'.$ldt.' 24:00:00" and  "'.$ldt.' 08:00:00"';
            break;
        }
        
        $que = $this->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function getticketopenbykdticket($shift,$dt){
        $sql = 'select count(ticket_id) cnt from (';

        //echo 'DT '.$dt->format('Y-m-d').'<br />';
        $sql.= 'select a.id ticket_id from tickets a ';
        $sql.= 'left outer join (';
        $sql1 = '  select distinct(ticket_id) ticket_id ';
        $sql1.= '  from tickets a left outer join ticket_followups b on b.ticket_id=a.id ';
        $sql1.= '  where b.result="1" ';
        $sql1.= '  and b.createdate>"'.$dt->format('Y-m-d').' "';
        $sql1.= '  and a.create_date<="'.$dt->format('Y-m-d').' "';
        $sql1.= '  and a.create_date>="2018-9-1" ';
        $sql.=$sql1;
        $sql.= ') b on b.ticket_id=a.id ';
        $sql.= 'where ';
        $sql.= 'a.create_date>"2018-9-1" ';
        $sql.= 'and (b.ticket_id is null) ';


        $sql.='union ';
        $sql.='select a.id ticket_id from tickets a ';
        $sql.= 'left outer join (';
        $sql.= '  select id from tickets where status="0" ';
        $sql.= '  and create_date>"2018-9-1" ';
        $sql.= ') c on c.id=a.id ';
        $sql.= 'where ';
        $sql.= 'a.create_date>"2018-9-1" ';
        $sql.= 'and c.id is not null';


        $sql.= ')X  ';

        //echo 'SQL '.$sql.'<br >';
        //echo 'SQL1 '.$sql1.'<br >';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->cnt;
    }
    function getrangeinfo($params){
        $sql = 'select a.id from tickets a ';
        $sql.= 'where date(a.create_date)>="'.$params['date1'].'" ';
        $sql.= 'and date(a.create_date)<="'.$params['date2'].'" ';
        $sql.= 'and a.status='.$params['status'].'';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res;
    }
    function getvasclients(){
        $sql = 'select A.fakeid,';
        $sql.= 'B.cln b,B.cnt bcnt,';//"Blocking Site"
        $sql.= 'C.cln c,C.cnt ccnt,';//"Port Forwarding"
        $sql.= 'D.cln d,D.cnt dcnt, ';//"Additional Public IP"
        $sql.= 'E.cln e,E.cnt ecnt,';//"Firewall-Rules/Allow-IP"
        $sql.= 'F.cln f,F.cnt fcnt, ';//"Firewall Protection"
        $sql.= 'G.cln g,G.cnt gcnt,';//"Bandwidth Management"
        $sql.= 'H.cln h,H.cnt hcnt,';//"Backup Lastmile"


        $sql.= 'I.cln i,I.cnt icnt,';//"Bandwidth on Demand"
        $sql.= 'J.cln j,J.cnt jcnt,';//"Domain Names"
        $sql.= 'K.cln k,K.cnt kcnt, ';//"Hosting"
        $sql.= 'L.cln l,L.cnt lcnt,';//"Load Sharing"
        $sql.= 'M.cln m,M.cnt mcnt,';//"Load Balance"
        $sql.= 'N.cln n,N.cnt ncnt,';//"Fail Over"
        $sql.= 'O.cln o,O.cnt ocnt,';//"VPN + IP Routing"



        $sql.= 'P.cln p,P.cnt pcnt,';//"Voip Line"
        $sql.= 'Q.cln q,Q.cnt qcnt,';//"Hotspot Login"
        $sql.= 'R.cln r,R.cnt rcnt,';//"Zimbra Mail Server Setup"
        $sql.= 'S.cln s,S.cnt scnt,';//"Proxy Server Setup"
        $sql.= 'T.cln t,T.cnt tcnt,';//"Basic Network Consultation By Phone"
        $sql.= 'U.cln u,U.cnt ucnt,';//"24/7 Call Support"
        $sql.= 'V.cln v,V.cnt vcnt,';//"Whatsapp Support"


        $sql.= 'W.cln w,W.cnt wcnt,';//"Traffic Monitoring"
        $sql.= 'X.cln x,X.cnt xcnt,';//"Weekday Troubleshoot"
        $sql.= 'Y.cln y,Y.cnt ycnt,';//"Emergency Team For Weekend/Non Office Hours Troubleshoot"
        $sql.= 'Z.cln z,Z.cnt zcnt ';//"EoS"


        $sql.= 'from (select "x" fakeid ) A left outer join ';
        $sql.= '(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=1 group by fakeid) B ';
        $sql.= 'on B.fakeid=A.fakeid ';
        $sql.= 'left outer join(select  "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=2 group by fakeid) C ';
        $sql.= 'on C.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=3 group by fakeid) D ';
        $sql.= 'on D.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=4 group by fakeid) E ';
        $sql.= 'on E.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=5 group by fakeid) F ';
        $sql.= 'on F.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=6 group by fakeid) G ';
        $sql.= 'on G.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=7 group by fakeid) H ';
        $sql.= 'on H.fakeid=A.fakeid ';


        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=8 group by fakeid) I ';
        $sql.= 'on I.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=9 group by fakeid) J ';
        $sql.= 'on J.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=10 group by fakeid) K ';
        $sql.= 'on K.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=11 group by fakeid) L ';
        $sql.= 'on L.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=12 group by fakeid) M ';
        $sql.= 'on M.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=13 group by fakeid) N ';
        $sql.= 'on N.fakeid=A.fakeid ';


        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=14 group by fakeid) O ';
        $sql.= 'on O.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=15 group by fakeid) P ';
        $sql.= 'on P.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=16 group by fakeid) Q ';
        $sql.= 'on Q.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=17 group by fakeid) R ';
        $sql.= 'on R.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=18 group by fakeid) S ';
        $sql.= 'on S.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=19 group by fakeid) T ';
        $sql.= 'on T.fakeid=A.fakeid ';

        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=20 group by fakeid) U ';
        $sql.= 'on U.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=21 group by fakeid) V ';
        $sql.= 'on V.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=22 group by fakeid) W ';
        $sql.= 'on W.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=23 group by fakeid) X ';
        $sql.= 'on X.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=24 group by fakeid) Y ';
        $sql.= 'on Y.fakeid=A.fakeid ';
        $sql.= 'left outer join(select "x" fakeid,count(b.name)cnt,group_concat(b.name)cln from client_vases a left outer join clients b on b.id=a.client_id where vas_id=25 group by fakeid) Z ';
        $sql.= 'on Z.fakeid=A.fakeid ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getcategorypelangganamount($dt1,$dt2){
        $sql = "select A.cnt tot,B.cnt ffr,C.cnt platinum, D.cnt gold,E.cnt bronze,F.cnt silver,G.cnt noncategorized from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id) cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")A left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and b.clientcategory = '1' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")B on B.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and b.clientcategory = '2' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")C on C.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and b.clientcategory = '3' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")D on D.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and b.clientcategory = '4' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")E on E.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and b.clientcategory = '5' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")F on F.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d') between '".$dt1."' and '".$dt2."' ";
        $sql.= "and b.clientcategory not in ('1','2','3','4','5') ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")G on G.X=A.X ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getclients($userbranch){
        $sql = 'select distinct a.name,a.alias,a.id  from clients a left outer join client_sites b on b.client_id=a.id ';
		$sql.= 'where a.active="1" and a.branch_id in ('.implode(",",$userbranch).')';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getclientspervas($vasid){
        $sql = 'select distinct b.name from client_vases a left outer join clients b on b.id=a.client_id where vas_id="'.$vasid.'" ';
        $sql.= 'and b.active = "1" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function get_ticketcausecategory_combodata(){
		$sql = "select * from ticketcausecategories where status='1'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );        
    }
    function getweeklycausebycategory($category_id){
        $sql = "select a.id,a.clientname,b.category_id from tickets a left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where category_id = " . $category_id . " ";
        $sql.= "and a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and a.id is not null ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getdailycausebycategory($category_id){
        $sql = "select a.id,a.clientname,b.category_id from tickets a left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where category_id = " . $category_id . " ";
        $sql.= "and date_format(a.create_date,'%Y-%m-%d')=curdate() ";
        $sql.= "and a.id is not null ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function gettotalcategorybycauses(){
        $sql = "select c.id,c.name,count(a.id) cnt from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and c.id is not null ";
        $sql.= "group by c.name,c.id ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycategoryinweek($category_id){
        $sql = "select b.name,a.clientname,createuser,a.create_date,";
        $sql.= "a.id,case a.status when '0' then 'Open' when '1' then 'Close' end status  from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where b.category_id = " . $category_id . " ";
        $sql.= "and a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day)";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycauseidinweek($cause_id){
        $sql = "select b.name,a.clientname,a.id,createuser,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where a.cause_id = " . $cause_id . " ";
        $sql.= "and a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day)";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycategoryinday($category_id){
        $sql = "select b.name,a.clientname,createuser,a.create_date,";
        $sql.= "a.id,case a.status when '0' then 'Open' when '1' then 'Close' end status  from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where b.category_id = '" . $category_id . "' ";
        $sql.= "and date_format(a.create_date,'%Y-%m-%d')=curdate()";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycategoryarraybranchlyinday($category_array,$branch_id,$dt){
        $sql = "select kdticket,name,clientname,createuser,create_date,category_id,id,status from (";
        $sql.= "select a.kdticket,b.name,a.clientname,createuser,a.create_date,";
        $sql.= "case when c.category_id is null then 9 else c.category_id end category_id, ";
        $sql.= "a.id,case a.status when '0' then 'Open' when '1' then 'Close' end status  from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join clients c on c.id=a.client_id ";
        $sql.= "where ";
        $sql.= "c.branch_id = " . $branch_id . " ";
        $sql.= "and date_format(a.create_date,'%Y-%m-%d')='".$dt."'";
        $sql.= ") X ";

        $sql.= "where category_id in ('" . $category_array . "') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycategoryarraybranchlyinweek($category_array,$branch_id){
        $sql = "select kdticket,name,clientname,createuser,create_date,category_id,id,status from (";
        $sql.= "select kdticket,b.name,a.clientname,createuser,a.create_date,";
        $sql.= "case when c.category_id is null then 9 else c.category_id end category_id, ";
        $sql.= "a.id,case a.status when '0' then 'Open' when '1' then 'Close' end status  from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join clients c on c.id=a.client_id ";
        $sql.= "where ";
        $sql.= "c.branch_id = " . $branch_id . " ";
        $sql.= "and a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= ") X ";
        $sql.= "where category_id in ('" . $category_array . "') ";
        $ci = & get_instance();
        echo $sql;
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycategoryarraybranchlyinmonth($category_array,$branch_id){
        $sql = "select kdticket,name,clientname,createuser,create_date,category_id,id,status from (";
        $sql.= "select kdticket,b.name,a.clientname,createuser,a.create_date,";
        $sql.= "case when c.category_id is null then 9 else c.category_id end category_id, ";
        $sql.= "a.id,case a.status when '0' then 'Open' when '1' then 'Close' end status  from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join clients c on c.id=a.client_id ";
        $sql.= "where ";
        $sql.= "c.branch_id = " . $branch_id . " ";
        $sql.= "and a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= ") X ";
        $sql.= "where category_id in ('" . $category_array . "') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketbycauseidinday($cause_id){
        $sql = "select b.name,a.clientname,a.id,createuser,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where a.cause_id = " . $cause_id . " ";
        $sql.= "and date_format(a.create_date,'%Y-%m-%d')=curdate()";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsratioinday($dt){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end closed,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end open from ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d')dt,count(create_date)tot ";
        $sql.= " from tickets ";
        $sql.= " where date_format(create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d') ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d') dt,count(id)cnt ";
        $sql.= " from tickets ";
        $sql.= " where date_format(create_date,'%Y-%m-%d')='".$dt."' and status='1' ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d')";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d') dt,count(id)cnt ";
        $sql.= " from tickets ";
        $sql.= " where date_format(create_date,'%Y-%m-%d')='".$dt."' and status='0' ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d')";
        $sql.= ") c on c.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketscategoryratioinday($dt){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end upstream,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end backbone,";
        $sql.= "case when d.cnt is null then 0 else d.cnt end bts,";
        $sql.= "case when e.cnt is null then 0 else e.cnt end ap ";
        $sql.= " from ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d')dt,count(create_date)tot ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= " and (b.id in (10,11,12,31,32,33) ";
        $sql.= " or c.id in (2)) ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d') ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and a.cause_id in(31) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and a.cause_id in(31,32,33) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") c on c.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and c.id in(2) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") d on d.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and b.id in(10,11,12) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") e on e.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketscategoryratioinweek(){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end upstream,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end backbone,";
        $sql.= "case when d.cnt is null then 0 else d.cnt end bts,";
        $sql.= "case when e.cnt is null then 0 else e.cnt end ap ";
        $sql.= " from ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d')dt,count(create_date)tot ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= " and (b.id in (10,11,12,31,32,33) ";
        $sql.= " or c.id in (2)) ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d') ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and a.cause_id in(31) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and a.cause_id in(31,32,33) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") c on c.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and c.id in(2) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") d on d.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and b.id in(10,11,12) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") e on e.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketscategoryratioinmonth(){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end upstream,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end backbone,";
        $sql.= "case when d.cnt is null then 0 else d.cnt end bts,";
        $sql.= "case when e.cnt is null then 0 else e.cnt end ap ";
        $sql.= " from ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d')dt,count(create_date)tot ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= " and (b.id in (10,11,12,31,32,33) ";
        $sql.= " or c.id in (2)) ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d') ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and a.cause_id in(31) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and a.cause_id in(31,32,33) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") c on c.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and c.id in(2) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") d on d.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and b.id in(10,11,12) ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") e on e.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsperbranchinweek(){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end sby,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end jkt, ";
        $sql.= "case when d.cnt is null then 0 else d.cnt end mlg,";
        $sql.= "case when e.cnt is null then 0 else e.cnt end bli ";
        $sql.= "from ";
        $sql.= "(select 'x' dt,count(id)tot from tickets a where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day)) a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(a.create_date)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and b.branch_id='1' ";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x'  dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and b.branch_id='2' ";
        $sql.= ") c on c.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x'  dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and b.branch_id='3' ";
        $sql.= ") d on d.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x'  dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and b.branch_id='3' ";
        $sql.= ") e on e.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsratioinweek(){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end closed,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end open from ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(create_date)tot ";
        $sql.= " from tickets ";
        $sql.= " where create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(id)cnt ";
        $sql.= " from tickets ";
        $sql.= " where create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and status='1' ";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(id)cnt ";
        $sql.= " from tickets ";
        $sql.= " where create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and status='0' ";
        $sql.= ") c on c.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getdetail($dt){
        $sql = "select id,kdticket from tickets where date(create_date)='".$dt."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsratioinmonth(){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end closed,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end open from ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(create_date)tot ";
        $sql.= " from tickets ";
        $sql.= " where create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(id)cnt ";
        $sql.= " from tickets ";
        $sql.= " where create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and status='1' ";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(id)cnt ";
        $sql.= " from tickets ";
        $sql.= " where create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and status='0' ";
        $sql.= ") c on c.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsinday(){
        $sql = "select b.name,a.clientname,a.id,createuser,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')=curdate()";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getfilteredticketsinday($status){
        $sql = "select b.name,a.clientname,a.id,createuser,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')=curdate() and status = '" . $status . "' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }

    function getticketsinweek(){
        $sql = "select b.name,a.clientname,a.id,createuser,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day)";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getfilteredticketsinweek($status){
        $sql = "select b.name,a.clientname,a.id,createuser,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) and status = '" . $status . "' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function gettroubleshootticketinweek(){
        $sql = "select a.* from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where b.id is not null and a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );    
    }
    function gettroubleshootticketinday(){
        $sql = "select a.* from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where b.id is not null and  date_format(a.create_date,'%Y-%m-%d')=curdate() ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );    
    }
    function getticketsperbranchinday($dt){
        $sql = "select a.dt,";
        $sql.= "case when a.cnt is null then 0 else a.cnt end tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end sby, ";
        $sql.= "case when c.cnt is null then 0 else c.cnt end jkt, ";
        $sql.= "case when d.cnt is null then 0 else d.cnt end  mlg, ";
        $sql.= "case when e.cnt is null then 0 else e.cnt end bli from ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d')dt,count(id)cnt ";
        $sql.= " from tickets where date_format(create_date,'%Y-%m-%d')='".$dt."' and requesttype='pelanggan' ";
        $sql.= " group by date_format(create_date,'%Y-%m-%d')";
        $sql.= ") a ";
        $sql.= " left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d')dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients c on c.id=a.client_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and c.branch_id='1' and requesttype='pelanggan' ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") b ";
        $sql.= "on b.dt=a.dt ";


        $sql.= " left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d')dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients c on c.id=a.client_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and c.branch_id='2' and requesttype='pelanggan' ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") c ";
        $sql.= "on c.dt=a.dt ";


        $sql.= " left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d')dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients c on c.id=a.client_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and c.branch_id='3' and requesttype='pelanggan'  ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") d ";
        $sql.= "on d.dt=a.dt ";


        $sql.= " left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d')dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients c on c.id=a.client_id ";
        $sql.= " left outer join backbones d on d.id=a.backbone_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and c.branch_id='4' and requesttype='pelanggan'  ";
        $sql.= " group by date_format(a.create_date,'%Y-%m-%d')";
        $sql.= ") e ";
        $sql.= "on e.dt=a.dt ";

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsperbranchpercategoryinday($branch_id){
        $sql = "select b.name,a.clientname,a.id,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join client_sites c on c.id=a.client_site_id ";
        $sql.= "left outer join clients d on d.id=c.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')=curdate() ";
        $sql.= "and d.branch_id = " . $branch_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsperbranchpercategoryinweek($branch_id){
        $sql = "select b.name,a.clientname,a.id,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join client_sites c on c.id=a.client_site_id ";
        $sql.= "left outer join clients d on d.id=c.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and d.branch_id = " . $branch_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getticketsperbranchinmonth(){
        $sql = "select a.tot, ";
        $sql.= "case when b.cnt is null then 0 else b.cnt end sby,";
        $sql.= "case when c.cnt is null then 0 else c.cnt end jkt, ";
        $sql.= "case when d.cnt is null then 0 else d.cnt end mlg,";
        $sql.= "case when e.cnt is null then 0 else e.cnt end bli ";
        $sql.= "from ";
        $sql.= "(select 'x' dt,count(id)tot from tickets a where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day)) a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x' dt,count(a.create_date)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and b.branch_id='1' ";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x'  dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and b.branch_id='2' ";
        $sql.= ") c on c.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x'  dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and b.branch_id='3' ";
        $sql.= ") d on d.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select 'x'  dt,count(a.id)cnt ";
        $sql.= " from tickets a ";
        $sql.= " left outer join clients b on b.id=a.client_id ";
        $sql.= " where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) and b.branch_id='4' ";
        $sql.= ") e on e.dt=a.dt ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getbtselectricityticketsinweek($branch_id){
        $sql = "select b.name,a.clientname,a.id,a.create_date,";
        $sql.= "case a.status when '0' then 'Open' when '1' then 'Close' end status from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join client_sites c on c.id=a.client_site_id ";
        $sql.= "left outer join clients d on d.id=c.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and d.branch_id = " . $branch_id . " ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function getdailyclientcategorytickets($dt){
        $sql = "select A.cnt tot,B.cnt ffr,C.cnt platinum, D.cnt gold,E.cnt bronze,F.cnt silver,G.cnt noncategorized from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id) cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")A left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and b.clientcategory = '1' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")B on B.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and b.clientcategory = '2' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")C on C.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and b.clientcategory = '3' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")D on D.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and b.clientcategory = '4' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")E on E.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and b.clientcategory = '5' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")F on F.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and b.clientcategory not in ('1','2','3','4','5') ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")G on G.X=A.X ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getweeklyclientcategorytickets(){
        $sql = "select A.cnt tot,B.cnt ffr,C.cnt platinum, D.cnt gold,E.cnt bronze,F.cnt silver,G.cnt noncategorized from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id) cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")A left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '1' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")B on B.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '2' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")C on C.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '3' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")D on D.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '4' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")E on E.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '5' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")F on F.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.clientcategory not in ('1','2','3','4','5') ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")G on G.X=A.X ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getmonthlyclientcategorytickets(){
        $sql = "select A.cnt tot,B.cnt ffr,C.cnt platinum, D.cnt gold,E.cnt bronze,F.cnt silver,G.cnt noncategorized from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id) cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")A left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '1' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")B on B.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '2' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")C on C.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '3' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")D on D.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '4' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")E on E.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.clientcategory = '5' ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")F on F.X=A.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join clients b on b.id=a.client_id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.clientcategory not in ('1','2','3','4','5') ";
        $sql.= "and a.requesttype='pelanggan' ";
        $sql.= ")G on G.X=A.X ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getdailytroubleshoots($dt,$cats){
        $tcat = implode("','",$cats);
        $sql = "select a.cnt tot,b.cnt nontroubleshoot,c.cnt troubleshoot from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= "left outer join troubleshoot_requests d on d.ticket_id=a.id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and c.id in ('".$tcat."')";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= "left outer join troubleshoot_requests d on d.ticket_id=a.id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and c.id in ('".$tcat."')";
        $sql.= "and d.id is null ";
        $sql.= ") b on b.X=a.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= "left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= "left outer join troubleshoot_requests d on d.ticket_id=a.id ";
        $sql.= "where date_format(a.create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= "and c.id in ('".$tcat."') ";
        $sql.= "and d.id is not null ";
        $sql.= ") c on c.X=a.X";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getweeklytroubleshoots(){
        $sql = "select a.cnt tot,b.cnt nontroubleshoot,c.cnt troubleshoot from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.id is null ";
        $sql.= ") b on b.X=a.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofweek(curdate())-2 day) ";
        $sql.= "and b.id is not null ";
        $sql.= ") c on c.X=a.X";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getmonthlytroubleshoots(){
        $sql = "select a.cnt tot,b.cnt nontroubleshoot,c.cnt troubleshoot from ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.id is null ";
        $sql.= ") b on b.X=a.X ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= "select 'x' X,count(a.id)cnt from tickets a ";
        $sql.= "left outer join troubleshoot_requests b on b.ticket_id=a.id ";
        $sql.= "where a.create_date>date_sub(curdate(),interval dayofmonth(curdate())-2 day) ";
        $sql.= "and b.id is not null ";
        $sql.= ") c on c.X=a.X";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        return $result;
    }
    function getticketscategorydetailinday($dt,$category){
        $sql = "select a.dt, ";
        $sql.= "case when b.kdticket is null then 0 else b.kdticket end upstream,";
        $sql.= "case when c.kdticket is null then 0 else c.kdticket end backbone,";
        $sql.= "case when d.kdticket is null then 0 else d.kdticket end bts,";
        $sql.= "case when e.kdticket is null then 0 else e.kdticket end ap ";
        $sql.= " from ";
        $sql.= "(";
        $sql.= " select date_format(create_date,'%Y-%m-%d')dt,kdticket ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(create_date,'%Y-%m-%d')='".$dt."' ";
        $sql.= " and (b.id in (10,11,12,31,32,33) ";
        $sql.= " or c.id in (2)) ";
        $sql.= ") a ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,kdticket,'upstream' jenis ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and a.cause_id in(31) ";
        $sql.= ") b on b.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,kdticket,'backbone' jenis ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and a.cause_id in(31,32,33) ";
        $sql.= ") c on c.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,kdticket,'bts' jenis ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and c.id in(2) ";
        $sql.= ") d on d.dt=a.dt ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select date_format(a.create_date,'%Y-%m-%d') dt,kdticket,'ap' jenis ";
        $sql.= " from tickets a ";
        $sql.= " left outer join ticketcauses b on b.id=a.cause_id ";
        $sql.= " left outer join ticketcausecategories c on c.id=b.category_id ";
        $sql.= " where date_format(a.create_date,'%Y-%m-%d')='".$dt."' and b.id in(10,11,12) ";
        $sql.= ") e on e.dt=a.dt ";
        
        //kdticket,name,clientname,createuser,create_date,category_id,id,status
        switch($category){
            case 'upstream':
            $sql = "select a.kdticket,b.name,a.clientname,a.createuser,a.create_date,b.category_id, ";
            $sql.= "case a.status when '0' then 'Open' when '1' then 'Closed' end status ";
            $sql.= "from tickets a ";
            $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
            $sql.= "where b.id in (31)";
            break;
            case 'backbone':
            $sql = "select a.kdticket,b.name,a.clientname,a.createuser,a.create_date,b.category_id, ";
            $sql.= "case a.status when '0' then 'Open' when '1' then 'Closed' end status ";
            $sql.= "from tickets a ";
            $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
            $sql.= "where a.cause_id in(31,32,33)";
            break;
            case 'bts':
            $sql = "select a.kdticket,b.name,a.clientname,a.createuser,a.create_date,b.category_id, ";
            $sql.= "case a.status when '0' then 'Open' when '1' then 'Closed' end status ";
            $sql.= "from tickets a ";
            $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
            $sql.= "where b.category_id in(2)";
            break;
            case 'ap':
            $sql = "select a.kdticket,b.name,a.clientname,a.createuser,a.create_date,b.category_id, ";
            $sql.= "case a.status when '0' then 'Open' when '1' then 'Closed' end status ";
            $sql.= "from tickets a ";
            $sql.= "left outer join ticketcauses b on b.id=a.cause_id ";
            $sql.= "where b.id in(10,11,12)";
            break;
        }

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),
            'res'=>$que->result()
        );
    }
    function upstreamparentupdate($obj){
        $sql = "update tickets ";
        $sql.= "set ";
        $sql.= "cause='".$obj['cause']."', ";
        $sql.= "cause_id=".$obj['cause_id'].", ";
        $sql.= "status='".$obj['status']."' ";
        //$sql.= "solution='".$obj['solution']."' ";
        $sql.= "where id=".$obj['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function update($obj){
        $sql = "update tickets ";
        $sql.= "set ";
        $sql.= "cause='".$obj['cause']."', ";
        $sql.= "cause_id=".$obj['cause_id'].", ";
        $sql.= "status='".$obj['status']."', ";
        $sql.= "solution='".$obj['solution']."', ";
        $sql.= "mailsent='".$obj['mailsent']."',";
        if($obj['status']=='1'){
            $sql.= "ticketend='".$obj['ticketend']."',";
        }
        $sql.= "duration='".$obj['duration']."' ";
        $sql.= "where id=".$obj['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function updatebyfollowup($obj){
        $sql = "update tickets ";
        $sql.= "set ";
        $sql.= "cause='".$obj['cause']."', ";
        $sql.= "cause_id=".$obj['cause_id'].", ";
        $sql.= "status='".$obj['status']."', ";
        $sql.= "solution='".$obj['solution']."'  ";
        //$sql.= "mailsent='".$obj['mailsent']."' ";
        $sql.= "where id=".$obj['id'];
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getTicketOver($maxid){
        $sql = "select kdticket,clientname,reporter,reporterphone,a.createuser,ticketend,";
        $sql.= "a.cause subrootcause,f.name mainrootcause,b.address site, ";
        $sql.= "case c.category_id ";
        $sql.= "when '1' then 'FFR' ";
        $sql.= "when '2' then 'Premium' ";
        $sql.= "when '3' then 'Gold' ";
        $sql.= "when '4' then 'Silver' ";
        $sql.= "when '5' then 'Bronze' end category,";
        $sql.= "case a.status when '0' then 'open' when '1' then 'closed' end status,";
        $sql.= "group_concat(d.name)services,group_concat(h.name)vases from tickets a  ";
        $sql.= "left outer join client_sites b on b.id = a.client_site_id ";
        $sql.= "left outer join clients c on c.id=b.client_id ";
        $sql.= "left outer join clientservices d on d.client_site_id=c.id ";
        $sql.= "left outer join ticketcauses e on a.cause_id=e.id ";
        $sql.= "left outer join ticketcausecategories f on f.id=e.category_id ";
        $sql.= "left outer join client_vases g on g.client_id=c.id ";
        $sql.= "left outer join vases h on h.id=g.vas_id ";
        $sql.= "where a.id = ".$maxid . " ";
        $sql.= "group by kdticket,clientname,reporter,reporterphone,a.createuser,a.status,c.category_id,ticketend ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'cnt'=>$que->num_rows(),'res'=>$que->result()
        );
    }
    function setHasVisit($params){
        $sql = 'update troubleshoot_requests ';
        $sql.= 'set hasvisited=case hasvisited when "0" then "1" when "1" then "0" end ';
        $sql.= 'where id='.$params['id'].'';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getTroubleshootByTicket($params){
        $sql = 'select id,hasvisited,case hasvisited when "1" then "(Has visited)" when "0" then "" end hasvisitedlabel,';
        $sql.= 'request_date1,request_date2,create_date from troubleshoot_requests where ticket_id='.$params['ticket_id'].'';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getchildren($params){
        $sql = 'select id from tickets where parentid='.$params['id'].' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
    function get_obj_by_id($id){
        $sql = 'select id,kdticket,clientname,complaint,reporter,reporterphone,solution,description,ticketstart,ticketend,';
        $sql.= 'downtimestart,downtimeend,cause,cause_id,"yes" is_ok,duration from tickets ';
        $sql.= 'where id=' . $id . ' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
    function updatechildren($parentid){
        $sql = 'update tickets a left outer join tickets b on b.id=a.parentid ';
        $sql.= 'set a.cause_id=b.cause_id, a.solution=b.solution ';
        $sql.= 'where a.parentid=' . $parentid . ' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getticketmonthly($params){
        $sql = 'select a.clientname,kdticket,ticketstart,ticketend,';
        $sql.= 'floor(hour(timediff(ticketend,ticketstart))/24) day,';
        $sql.= 'hour(timediff(ticketend,ticketstart))%24 hour,';
        $sql.= 'minute(timediff(ticketend,ticketstart))minute,b.name,a.status ';
        $sql.= 'from tickets a ';
        $sql.= 'left outer join ticketcauses b on b.id=a.cause_id ';
        $sql.= 'where date_format(create_date,"%Y-%m")="'.$params['yearmonth'].'"';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
}

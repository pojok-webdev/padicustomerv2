<?php
class Prpt extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getclients($clientname,$business_field,$username,$service,$branches){
        $sql = "select a.id,a.name,a.address,a.business_field, ";
        $sql.= "b.period1,b.period2, b.activationdate, ";
        $sql.= "c.username am,a.activedate,group_concat(f.name)branches,group_concat(g.name)services ";
        $sql.= "from clients a ";
        $sql.= "left outer join fbs b on b.client_id=a.id ";
        $sql.= "left outer join users c on c.id=a.user_id ";
        $sql.= "left outer join client_sites d on d.id=a.id ";
        $sql.= "left outer join branches_client_sites e ";
        $sql.= "on e.client_site_id=d.id ";
        $sql.= "left outer join branches f on f.id=e.branch_id ";
        $sql.= "left outer join clientservices g on g.client_site_id=d.id ";
        $sql.= "where ";
        $sql.= "a.business_field like'%".$business_field."%' and a.name like '%".$clientname."%' ";
        $sql.= "and c.username like '%".$username."%' ";
        $sql.= "and f.id in (".$branches.") ";
        $sql.= "group by a.id,a.name,a.address,a.business_field,";
        $sql.= "b.period1,b.period2, b.activationdate, ";
        $sql.= "c.username,a.activedate ";
        $sql.= "order by a.name asc";



        $sql = "select a.id,a.name,a.address,a.business_field, ";
        $sql.= "b.period1,b.period2, b.activationdate, ";
        $sql.= "c.username am,a.activedate,branches,cservices ";
        $sql.= "from (select a.id,a.user_id,a.name,a.address,a.business_field,a.activedate,group_concat(f.name)branches ";
        $sql.= " ,group_concat(g.name)cservices from clients a ";
        $sql.= "left outer join client_sites d on d.id=a.id ";
        $sql.= "left outer join branches_client_sites e ";
        $sql.= "on e.client_site_id=d.id ";
        $sql.= "left outer join branches f on f.id=e.branch_id ";
        $sql.= "left outer join clientservices g on g.client_site_id=d.id ";
        $sql.= "where f.id in (".$branches.") ";


        $sql.= "group by a.id,a.name,a.address,a.business_field,";
       // $sql.= "b.period1,b.period2, b.activationdate,c.username, ";
        $sql.= "a.activedate,f.name,g.name ";

        
        $sql.= " ) a ";


        $sql.= "left outer join fbs b on b.client_id=a.id ";
        $sql.= "left outer join users c on c.id=a.user_id ";
        
        $sql.= "where ";
        $sql.= "a.business_field like'%".$business_field."%' and a.name like '%".$clientname."%' ";
        $sql.= "and c.username like '%".$username."%' ";
       // $sql.= "and f.id in (".$branches.") ";
//        $sql.= "group by a.id,a.name,a.address,a.business_field,";
 //       $sql.= "b.period1,b.period2, b.activationdate, ";
  //      $sql.= "c.username,a.activedate,branches,cservices ";
        $sql.= "order by a.name asc";

        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            "res"=>$que->result(),
            "tot"=>$que->num_rows()
        );
    }
    function getclientpics(){
        $sql = "select a.name client,a.address clientaddress,b.name, ";
        $sql.= "b.position,b.phone,b.hp,b.email ";
        $sql.= "from clients a ";
        $sql.= "left outer join fbpics b on b.client_id=a.id";


        $sql = "select A.name client,A.address clientaddress,B.adm,C.bil,D.res,E.sub,F.sup,G.tek, ";
        $sql.= "B.email admemail,C.email bilemail,D.email resemail,E.email subemail,F.email supemail,G.email tekemail, ";
        $sql.= "B.position admpos,C.position bilpos,D.position respos,E.position subpos,F.position suppos,G.position tekpos, ";
        $sql.= "B.phone admphone,C.phone bilphone,D.phone resphone,E.phone subphone,F.phone supphone,G.phone tekphone ";
        $sql.= "from clients A ";
        $sql.= "left outer join  ";
        $sql.= "(select a.id,a.name,b.name adm,b.hp,b.phone,b.email,b.position from clients a left outer join fbpics b on b.client_id=a.id where b.role='adm') B on B.id=A.id ";
        $sql.= "left outer join  ";
        $sql.= "(select a.id,a.name,b.name bil,b.hp,b.phone,b.email,b.position from clients a left outer join fbpics b on b.client_id=a.id where b.role='billing') C on C.id=A.id ";
        $sql.= "left outer join  ";
        $sql.= "(select a.id,a.name,b.name res,b.hp,b.phone,b.email,b.position from clients a left outer join fbpics b on b.client_id=a.id where b.role='resp') D on D.id=A.id ";
        $sql.= "left outer join  ";
        $sql.= "(select a.id,a.name,b.name sub,b.hp,b.phone,b.email,b.position from clients a left outer join fbpics b on b.client_id=a.id where b.role='subscriber') E on E.id=A.id ";
        $sql.= "left outer join  ";
        $sql.= "(select a.id,a.name,b.name sup,b.hp,b.phone,b.email,b.position from clients a left outer join fbpics b on b.client_id=a.id where b.role='support') F on F.id=A.id ";
        $sql.= "left outer join  ";
        $sql.= "(select a.id,a.name,b.name tek,b.hp,b.phone,b.email,b.position from clients a left outer join fbpics b on b.client_id=a.id where b.role='teknis') G on G.id=A.id ";
        $sql.= "where B.adm is not null        ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            "res"=>$que->result(),
            "tot"=>$que->num_rows()
        );
    }
    function getclientvalues(){
        $sql = "select A.name,setupdpp,setupppn,monthlyppn,monthlydpp from clients A ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select a.id,a.name,dpp setupdpp,ppn setupppn from clients a ";
        $sql.= " left outer join fbfees b on b.client_id=a.id where b.name='setup'";
        $sql.= ") B on B.id=A.id ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select a.id,a.name,dpp monthlydpp,ppn monthlyppn from clients a ";
        $sql.= " left outer join fbfees b on b.client_id=a.id where b.name='monthly'";
        $sql.= ") C on C.id=A.id ";
        $sql.= "where setupdpp is not null ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            "res"=>$que->result(),
            "tot"=>$que->num_rows()
        );
    }
    function getbranchvalues(){
        $sql = "select D.name branch,F.name product,";
        $sql.= "sum(setupdpp)setupdpp,sum(setupppn)setupppn,sum(monthlyppn)monthlyppn,";
        $sql.= "sum(monthlydpp)monthlydpp ";
        $sql.= "from fbs A ";
        $sql.= "left outer join clients E on A.client_id=E.id ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select a.id,a.name,dpp setupdpp,ppn setupppn from clients a ";
        $sql.= " left outer join fbfees b on b.client_id=a.id where b.name='setup'";
        $sql.= ") B on B.id=E.id ";
        $sql.= "left outer join ";
        $sql.= "(";
        $sql.= " select a.id,a.name,dpp monthlydpp,ppn monthlyppn from clients a ";
        $sql.= " left outer join fbfees b on b.client_id=a.id where b.name='monthly'";
        $sql.= ") C on C.id=E.id ";
        $sql.= "left outer join branches D on E.branch_id=D.id ";
        $sql.= "left outer join fbservices F on F.fb_id=A.nofb ";
        $sql.= "where F.name is not null ";
        $sql.= "group by D.name,F.name ";


        $sql = "select A.name product,D.name branch,sum(E.dpp)setupdpp,sum(E.ppn)setupppn,sum(F.dpp)monthlydpp,sum(F.ppn)monthlyppn,D.name from fbservices A ";
        $sql.= "left outer join fbs B on B.nofb = fb_id ";
        $sql.= "left outer join clients C on C.id = B.client_id ";
        $sql.= "left outer join branches D on D.id=C.branch_id  ";
        $sql.= "left outer join ";
        $sql.= "( ";
        $sql.= " select a.id,a.name,dpp ,ppn ";
        $sql.= " from clients a ";
        $sql.= " left outer join fbfees b on b.client_id=a.id ";
        $sql.= " where b.name='setup'";
        $sql.= ") E on E.id = C.id ";
        $sql.= "left outer join  ";
        $sql.= "( ";
        $sql.= " select a.id,a.name,dpp ,ppn ";
        $sql.= " from clients a ";
        $sql.= " left outer join fbfees b on b.client_id=a.id where b.name='monthly' ";
        $sql.= ") F on F.id = C.id " ;
        $sql.= "group by A.name,D.name ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            "res"=>$que->result(),
            "tot"=>$que->num_rows()
        );
    }
    function monthlycomplaint($month,$year,$branchselected,$ordername='clientname',$ordertype='asc'){
        $sql = "select clientname,cnt from ";
        $sql.= "(";

        $sql.= "select A.clientname,count(clientname)cnt ";
        $sql.= "from tickets A ";
        $sql.= "left outer join client_sites B on B.id=A.client_site_id ";
        $sql.= "left outer join branches_client_sites C on C.client_site_id=B.id ";
        $sql.= "where month(A.create_date) = '" . $month . "' ";
        $sql.= "and year(A.create_date) = '" . $year . "' ";
        $sql.= "and C.branch_id in (".$branchselected.") ";
        $sql.= "group by A.clientname ";

        $sql.= ")X ";
        $sql.= "order by ".$ordername." ".$ordertype." ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            "res"=>$que->result(),
            "tot"=>$que->num_rows()
        );        
    }
    function getsolvedreport($params){
        $sql = "select * from (";
        $sql.= "select a.id,a.kdticket,a.create_date,a.ticketstart,a.ticketend,a.createuser,a.status,a.cause, ";
        $sql.= "case a.status when '0' then 'open' when '1' then 'close' end ticketStatus,";
        $sql.= "case a.status when '0' then '-' when '1' then ticketend end ticket_End,";
        $sql.= "a.clientname,a.reporterphone,a.requesttype,a.parentid,b.id cid,c.id backboneid,";
        $sql.= "d.id btsid,e.id dcid,f.id ptpid,reporter,i.trid,case when j.hastroubleshoot is null then '0' else j.hastroubleshoot end hastroubleshoot,";
    
        $sql.= "case ";
        $sql.= "when b.id is not null then b.brnid ";
        $sql.= "when c.id is not null then c.brnid ";
        $sql.= "when d.id is not null then d.brnid ";
        $sql.= "when e.id is not null then e.brnid ";
        $sql.= "when f.id is not null then f.brnid ";
        $sql.= "when g.id is not null then g.brnid ";
        $sql.= "when h.id is not null then h.brnid ";
        $sql.= "else '-' ";
        $sql.= "end brnid, ";
        
        $sql.= "case ";
        $sql.= "when b.id is not null then b.brn ";
        $sql.= "when c.id is not null then c.brn ";
        $sql.= "when d.id is not null then d.brn ";
        $sql.= "when e.id is not null then e.brn ";
        $sql.= "when f.id is not null then f.brn ";
        $sql.= "when g.id is not null then g.brn ";
        $sql.= "when h.id is not null then h.brn ";
        $sql.= "else '-' ";
        $sql.= "end brn, ";
        
        $sql .= "case ";
        $sql.= "when ticketend is null then datediff(now(),ticketstart) ";
        $sql.= "when ticketend='0000-00-00 00:00:00' then datediff(now(),ticketstart) ";
        $sql.= "else datediff(ticketend,ticketstart) end  hari ,";
    
        $sql .= "concat(case ";
        $sql.= "when ticketend is null then datediff(now(),ticketstart) ";
        $sql.= "when ticketend='0000-00-00 00:00:00' then datediff(now(),ticketstart) ";
        $sql.= "else datediff(ticketend,ticketstart) end,' hari ',";
    
        $sql.= "time_format(case ";
        $sql.= "when ticketend is null then timediff(now(),ticketstart) ";
        $sql.= "when ticketend='0000-00-00 00:00:00' then timediff(now(),ticketstart) ";
        $sql.= "else timediff(ticketend,ticketstart) end,'%H') % 24, ";
    
        $sql.= "time_format(case ";
        $sql.= "when ticketend is null then timediff(now(),ticketstart) ";
        $sql.= "when ticketend='0000-00-00 00:00:00' then timediff(now(),ticketstart) ";
        $sql.= "else timediff(ticketend,ticketstart) end,'  jam %i menit %s detik')) duration3 ";
        $sql.= " from (select * from tickets ";
        $sql.= "where status='1' and ticketend>'".$params['uridt1']."' and ticketend<'".$params['uridt2']."' ";
        $sql.= "and cause_id in (".$params['causeid'].") ";
        $sql.= ") a ";
        $sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from client_sites a left outer join branches_client_sites b on b.client_site_id=a.id left outer join branches c on c.id=b.branch_id where c.id in (".$params['userbranches'].") ) b on b.id=a.client_site_id ";
        $sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from backbones a left outer join backbones_branches b on b.backbone_id=a.id left outer join branches c on c.id=b.branch_id where c.id in (".$params['userbranches'].") ) c on c.id=a.backbone_id ";
        $sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from btstowers a left outer join branches b on b.id=a.branch_id where b.id in (".$params['userbranches'].") ) d on d.id=a.btstower_id ";
        $sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from datacenters a left outer join branches b on b.id=a.branch_id where b.id in (".$params['userbranches'].") ) e on e.id=a.datacenter_id ";
        $sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from ptps a left outer join branches b on b.id=a.branch_id where b.id in (".$params['userbranches'].") ) f on f.id=a.ptp_id ";
        $sql.= "left outer join (select distinct a.id,b.id brnid,b.name brn from cores a left outer join branches b on b.id=a.branch_id where b.id in (".$params['userbranches'].") ) g on g.id=a.core_id ";
        $sql.= "left outer join (select distinct a.id,c.id brnid,c.name brn from aps a left outer join btstowers b on b.id=a.btstower_id left outer join branches c on c.id=b.branch_id where c.id in (".$params['userbranches'].") ) h on h.id=a.ap_id ";
        $sql.= "left outer join (select id trid,ticket_id from troubleshoot_requests where status='0') i on i.ticket_id=a.id ";
        $sql.= "left outer join (select count(id) hastroubleshoot,ticket_id from troubleshoot_requests group by ticket_id) j on j.ticket_id=a.id ";        
        $sql.= "where b.id is not null or c.id is not null or d.id is not null or e.id is not null or f.id is not null or g.id is not null or h.id is not null ";
        
        $sql.= ")q where brnid in (".$params['branches'].")  ".$params['timerange']."  ";
        $sql.= "". $params['hastroubleshoot']." ";
          //  $rorder = ($params['order'] ==='desc')?'asc':'desc';
        $sql.= "order by ".$params['orderfield']." ".$params['rorder'].";";
        $query = $this->db->query($sql);
        return array('res'=>$query->result(),'cnt'=>$query->num_rows());
    
    }
    function getcausecategories(){
        $sql = 'select a.id,a.name from ticketcausecategories a ';
        $que = $this->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
    function getcausesbycategory($category_id){
        $sql = 'select a.id,a.name from ticketcauses a ';
        $sql.= 'where a.category_id='.$category_id.'';
        $que = $this->db->query($sql);
        return array('res'=>$que->result(),'cnt'=>$que->num_rows());
    }
}
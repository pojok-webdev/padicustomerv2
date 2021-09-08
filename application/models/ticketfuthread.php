<?php
Class Ticketfuthread extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function searchticketbykdticket($kdticket){
        $sql = 'select a.id,a.kdticket,a.clientname,date_format(a.create_date,"%d-%m-%Y")dt,count(b.id)fucnt from tickets a ';
        $sql.= 'left outer join ticket_followups b on b.ticket_id=a.id ';
        $sql.= 'where kdticket="'.$kdticket.'" ' ;
        $sql.= 'group by a.id,a.kdticket,a.clientname,a.create_date ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function searchticketbyclientname($clientname){
        $sql = 'select a.id,a.kdticket,a.clientname,date_format(a.create_date,"%d-%m-%Y")dt,count(b.id)fucnt from tickets a ';
        $sql.= 'left outer join ticket_followups b on b.ticket_id=a.id ';
        $sql.= 'where clientname like "%'.$clientname.'%" ' ;
        $sql.= 'group by a.id,a.kdticket,a.clientname,a.create_date ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function getfus($ticketid){
        $sql = 'select a.id,a.description,a.conclusion,a.confirmationresult,date_format(a.createdate,"%d-%m-%Y")dt,b.pic,a.username ';
        $sql.= 'from ticket_followups a ';
        $sql.= 'left outer join users b on b.username=a.username ';
        $sql.= 'where ticket_id = "'.$ticketid.'" ' ;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
}
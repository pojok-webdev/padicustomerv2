<?php
Class Pfollowup extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getfuinfo($id){
        $sql = 'select ';
        $sql.= 'b.complaint,';
        $sql.= 'c.name subcause,d.name maincause,';
        $sql.= 'a.description,a.conclusion,a.confirmationresult from ticket_followups a ';
        $sql.= 'left outer join tickets b on b.id=a.ticket_id ';
        $sql.= 'left outer join ticketcauses c on c.id=a.cause_id ';
        $sql.= 'left outer join ticketcausecategories d on d.id=c.category_id ';
        $sql.= 'where a.id='.$id.' ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
}
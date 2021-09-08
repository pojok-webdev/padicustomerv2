<?php
class Dashboards extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("dashboard");
        $this->load->model("dashboardbranch");
        $this->load->helper("dashboard");
        $this->load->helper("user");
        $this->load->model("offer");
        $this->load->library("common");
        $this->common->check_login();
    }
    function index(){
        $data = array(
            'title'=>'PadiNET | Dashboard ',
            'curmonth'=>date("M"),
            'curyear'=>date("Y"),
            'totaltroubleshoots'=>$this->dashboard->gettotaltroubleshoots(),
            'totaltickets'=>$this->dashboard->gettotaltickets(),
            'totalsurveys'=>$this->dashboard->gettotalsurveys(),
            'totalinstalls'=>$this->dashboard->gettotalinstalls()
        );
        $this->load->view('Dashboard/index',$data);
    }
    function infrastructure(){
        $this->load->view('Dashboard/infrastructure');
    }
    function bts(){
        $objs = $this->dashboard->getbtses();
        $data = array(
            'title'=>'PadiNET | Dashboard BTS',
            'objs'=>$objs['res'],
            'tot'=>$objs['tot']
        );
        $this->load->view('Dashboard/infra-structure',$data);
    }
    function btsbackbones(){
        $btstower_id = $this->uri->segment(3);
        $objs = $this->dashboard->getbtsbackbones($btstower_id);
        $data = array(
            'title'=>'PadiNET | Dashboard ',
            'objs'=>$objs['res']
        );
        $this->load->view('Dashboard/btses-backbones',$data);
    }
    function selling(){
        $objs = $this->dashboard->getselling();
        $data = array(
            'title'=>'PadiNET | Dashboard ',
            'objs'=>$objs['res']
        );
        $this->load->view('Dashboard/selling',$data);
    }
    function ticket_with_parameter(){
        if($this->uri->total_segments()==3){
            $date1 = $this->uri->segment(3);
            $date2 = $this->uri->segment(3);
            $objs = $this->dashboard->gettickets($date1,$date2);
        }
        elseif($this->uri->total_segments()==4){
            $date1 = $this->uri->segment(3);
            $date2 = $this->uri->segment(4);
            $objs = $this->dashboard->gettickets($date1,$date2);
        }else{
            $objs = $this->dashboard->gettickets(date('Y-m-d'),date('Y-m-d'));
        }
        $data = array(
            'title'=>'PadiNET | Dashboard Ticket',
            'objs'=>$objs['res'],
            'tot'=>$objs['tot']
        );
        $this->load->view('Dashboard/ticket',$data);
    }
    function ticket(){
        if($this->uri->total_segments()>2){
            $branch_id = implode(',',explode('-',$this->uri->segment(3)));
        }else{
            $branch_id = '0';
        }
        if($this->uri->total_segments()>3){
            $date = $this->uri->segment(4);
            $tmp = explode('-',$date);
            $filterdate = $tmp[1].'/'.$tmp[2].'/'.$tmp[0];
        }else{
            $date = date('Y-m-d');
            $filterdate = date('m/d/Y');
        }
        $data = array(
            'title'=>'PadiNET | Dashboard Ticket'.date("Y-m-d"),

            'undefineddailyticket'=>$this->dashboard->getdailytickets('0',$date,'0',$branch_id),
            'undefineddailyticketclosed'=>$this->dashboard->getdailytickets('0',$date,'1',$branch_id),
            'undefinedweeklyticket'=>$this->dashboard->getweeklytickets('0',$date,'0',$branch_id),
            'undefinedweeklyticketclosed'=>$this->dashboard->getweeklytickets('0',$date,'1',$branch_id),
            'undefinedquarterlyticket'=>$this->dashboard->getquarterlytickets('0',$date,'0',$branch_id),
            'undefinedquarterlyticketclosed'=>$this->dashboard->getquarterlytickets('0',$date,'1',$branch_id),
            'undefinedmonthlyticket'=>$this->dashboard->getmonthlytickets('0',$date,'0',$branch_id),
            'undefinedmonthlyticketclosed'=>$this->dashboard->getmonthlytickets('0',$date,'1',$branch_id),
            'undefinedyearlyticket'=>$this->dashboard->getyearlytickets('0',$date,'0',$branch_id),
            'undefinedyearlyticketclosed'=>$this->dashboard->getyearlytickets('0',$date,'1',$branch_id),


            'ffrdailyticket'=>$this->dashboard->getdailytickets('1',$date,'0',$branch_id),
            'ffrdailyticketclosed'=>$this->dashboard->getdailytickets('1',$date,'1',$branch_id),
            'ffrweeklyticket'=>$this->dashboard->getweeklytickets('1',$date,'0',$branch_id),
            'ffrweeklyticketclosed'=>$this->dashboard->getweeklytickets('1',$date,'1',$branch_id),
            'ffrquarterlyticket'=>$this->dashboard->getquarterlytickets('1',$date,'0',$branch_id),
            'ffrquarterlyticketclosed'=>$this->dashboard->getquarterlytickets('1',$date,'1',$branch_id),
            'ffrmonthlyticket'=>$this->dashboard->getmonthlytickets('1',$date,'0',$branch_id),
            'ffrmonthlyticketclosed'=>$this->dashboard->getmonthlytickets('1',$date,'1',$branch_id),
            'ffryearlyticket'=>$this->dashboard->getyearlytickets('1',$date,'0',$branch_id),
            'ffryearlyticketclosed'=>$this->dashboard->getyearlytickets('1',$date,'1',$branch_id),

            'pltdailyticket'=>$this->dashboard->getdailytickets('2',$date,'0',$branch_id),
            'pltdailyticketclosed'=>$this->dashboard->getdailytickets('2',$date,'1',$branch_id),
            'pltweeklyticket'=>$this->dashboard->getweeklytickets('2',$date,'0',$branch_id),
            'pltweeklyticketclosed'=>$this->dashboard->getweeklytickets('2',$date,'1',$branch_id),
            'pltquarterlyticket'=>$this->dashboard->getquarterlytickets('2',$date,'0'),
            'pltquarterlyticketclosed'=>$this->dashboard->getquarterlytickets('2',$date,'1',$branch_id),
            'pltmonthlyticket'=>$this->dashboard->getmonthlytickets('2',$date,'0',$branch_id,$branch_id),
            'pltmonthlyticketclosed'=>$this->dashboard->getmonthlytickets('2',$date,'1',$branch_id),
            'pltyearlyticket'=>$this->dashboard->getyearlytickets('2',$date,'0',$branch_id),
            'pltyearlyticketclosed'=>$this->dashboard->getyearlytickets('2',$date,'1',$branch_id),

            'glddailyticket'=>$this->dashboard->getdailytickets('3',$date,'0',$branch_id),
            'glddailyticketclosed'=>$this->dashboard->getdailytickets('3',$date,'1',$branch_id),
            'gldweeklyticket'=>$this->dashboard->getweeklytickets('3',$date,'0',$branch_id),
            'gldweeklyticketclosed'=>$this->dashboard->getweeklytickets('3',$date,'1',$branch_id),
            'gldquarterlyticket'=>$this->dashboard->getquarterlytickets('3',$date,'0',$branch_id),
            'gldquarterlyticketclosed'=>$this->dashboard->getquarterlytickets('3',$date,'1',$branch_id),
            'gldmonthlyticket'=>$this->dashboard->getmonthlytickets('3',$date,'0',$branch_id),
            'gldmonthlyticketclosed'=>$this->dashboard->getmonthlytickets('3',$date,'1',$branch_id),
            'gldyearlyticket'=>$this->dashboard->getyearlytickets('3',$date,'0',$branch_id),
            'gldyearlyticketclosed'=>$this->dashboard->getyearlytickets('3',$date,'1',$branch_id),

            'brndailyticket'=>$this->dashboard->getdailytickets('5',$date,'0',$branch_id),
            'brndailyticketclosed'=>$this->dashboard->getdailytickets('5',$date,'1',$branch_id),
            'brnweeklyticket'=>$this->dashboard->getweeklytickets('5',$date,'0',$branch_id),
            'brnweeklyticketclosed'=>$this->dashboard->getweeklytickets('5',$date,'1',$branch_id),
            'brnquarterlyticket'=>$this->dashboard->getquarterlytickets('5',$date,'0',$branch_id),
            'brnquarterlyticketclosed'=>$this->dashboard->getquarterlytickets('5',$date,'1',$branch_id),
            'brnmonthlyticket'=>$this->dashboard->getmonthlytickets('5',$date,'0',$branch_id),
            'brnmonthlyticketclosed'=>$this->dashboard->getmonthlytickets('5',$date,'1',$branch_id),
            'brnyearlyticket'=>$this->dashboard->getyearlytickets('5',$date,'0',$branch_id),
            'brnyearlyticketclosed'=>$this->dashboard->getyearlytickets('5',$date,'1',$branch_id),

            'slvdailyticket'=>$this->dashboard->getdailytickets('4',$date,'0',$branch_id),
            'slvdailyticketclosed'=>$this->dashboard->getdailytickets('4',$date,'1',$branch_id),
            'slvweeklyticket'=>$this->dashboard->getweeklytickets('4',$date,'0',$branch_id),
            'slvweeklyticketclosed'=>$this->dashboard->getweeklytickets('4',$date,'1',$branch_id),
            'slvquarterlyticket'=>$this->dashboard->getquarterlytickets('4',$date,'0',$branch_id),
            'slvquarterlyticketclosed'=>$this->dashboard->getquarterlytickets('4',$date,'1',$branch_id),
            'slvmonthlyticket'=>$this->dashboard->getmonthlytickets('4',$date,'0',$branch_id),
            'slvmonthlyticketclosed'=>$this->dashboard->getmonthlytickets('4',$date,'1',$branch_id),
            'slvyearlyticket'=>$this->dashboard->getyearlytickets('4',$date,'0',$branch_id),
            'slvyearlyticketclosed'=>$this->dashboard->getyearlytickets('4',$date,'1',$branch_id),
            'branches'=>explode('-',$this->uri->segment(3)),
            'trailingbranches'=>$this->uri->segment(3),
            'filterdate'=>$filterdate
        );
        $this->load->view('Dashboard/ticket',$data);
    }
    function ticketdetails(){
        $period = ($this->uri->total_segments()>2)?$this->uri->segment(3):"y";        
        $category = ($this->uri->total_segments()>3)?$this->uri->segment(4):"1";
        $branches = ($this->uri->total_segments()>4)?$this->uri->segment(5):"1";
        switch($period){
            case 'd':$periodname="Harian ";break;
            case 'w':$periodname="Mingguan ";break;
            case 'm':$periodname="Bulanan ";break;
            case 'q':$periodname="3 Bulanan ";break;
            case 'y':$periodname="Tahunan ";break;
        }
        switch($category){
            case '1':$categoryname="FFR";break;
            case '2':$categoryname="Platinum ";break;
            case '3':$categoryname="Gold ";break;
            case '4':$categoryname="Silver ";break;
            case '5':$categoryname="Bronze ";break;
        }
        $data = array(
            'title'=>'PadiNET | Dashboard Detail Ticket'.date("Y-m-d"),
            "objs"=>$this->dashboard->getticketdetails($period,$category,$branches),
            'period'=>$periodname,
            'category'=>$categoryname
        );
        $this->load->view('Dashboard/ticketdetails',$data);
    }
    function survey(){
        if($this->uri->total_segments() > 2 ){
            $yearfilter = $this->uri->segment(3);
            $tmp = explode('-',$yearfilter);
            $filterdate = $tmp[1].'/'.$tmp[2].'/'.$tmp[0];
        } else {
            $yearfilter = date("Y-m-d");
            $filterdate = date("d/m/Y");
        }
        if($this->uri->total_segments()>3){
            $branch_id = implode(',',explode('-',$this->uri->segment(4)));
        }else{
            $branch_id = '0';
        }

        $date = date("Y-m-d");
        $data = array(
            'title'=>'PadiNET | Dashboard Survey',
            'ffrdailysurvey'=>$this->dashboard->getdailysurveys('1',$yearfilter,$branch_id),
            'ffrweeklysurvey'=>$this->dashboard->getweeklysurveys('1',$yearfilter,$branch_id),
            'ffrquarterlysurvey'=>$this->dashboard->getquarterlysurveys('1',$yearfilter,$branch_id),
            'ffrmonthlysurvey'=>$this->dashboard->getmonthlysurveys('1',$yearfilter,$branch_id),
            'ffryearlysurvey'=>$this->dashboard->getyearlysurveys('1',$yearfilter,$branch_id),

            'pltdailysurvey'=>$this->dashboard->getdailysurveys('2',$yearfilter,$branch_id),
            'pltweeklysurvey'=>$this->dashboard->getweeklysurveys('2',$yearfilter,$branch_id),
            'pltquarterlysurvey'=>$this->dashboard->getquarterlysurveys('2',$yearfilter,$branch_id),
            'pltmonthlysurvey'=>$this->dashboard->getmonthlysurveys('2',$yearfilter,$branch_id),
            'pltyearlysurvey'=>$this->dashboard->getyearlysurveys('2',$yearfilter,$branch_id),

            'glddailysurvey'=>$this->dashboard->getdailysurveys('3',$yearfilter,$branch_id),
            'gldweeklysurvey'=>$this->dashboard->getweeklysurveys('3',$yearfilter,$branch_id),
            'gldquarterlysurvey'=>$this->dashboard->getquarterlysurveys('3',$yearfilter,$branch_id),
            'gldmonthlysurvey'=>$this->dashboard->getmonthlysurveys('3',$yearfilter,$branch_id),
            'gldyearlysurvey'=>$this->dashboard->getyearlysurveys('3',$yearfilter,$branch_id),

            'brndailysurvey'=>$this->dashboard->getdailysurveys('5',$yearfilter,$branch_id),
            'brnweeklysurvey'=>$this->dashboard->getweeklysurveys('5',$yearfilter,$branch_id),
            'brnquarterlysurvey'=>$this->dashboard->getquarterlysurveys('5',$yearfilter,$branch_id),
            'brnmonthlysurvey'=>$this->dashboard->getmonthlysurveys('5',$yearfilter,$branch_id),
            'brnyearlysurvey'=>$this->dashboard->getyearlysurveys('5',$yearfilter,$branch_id),

            'slvdailysurvey'=>$this->dashboard->getdailysurveys('4',$yearfilter,$branch_id),
            'slvweeklysurvey'=>$this->dashboard->getweeklysurveys('4',$yearfilter,$branch_id),
            'slvquarterlysurvey'=>$this->dashboard->getquarterlysurveys('4',$yearfilter,$branch_id),
            'slvmonthlysurvey'=>$this->dashboard->getmonthlysurveys('4',$yearfilter,$branch_id),
            'slvyearlysurvey'=>$this->dashboard->getyearlysurveys('4',$yearfilter,$branch_id),

            'uncategorizeddailysurvey'=>$this->dashboard->getdailysurveys('0',$yearfilter,$branch_id),
            'uncategorizedweeklysurvey'=>$this->dashboard->getweeklysurveys('0',$yearfilter,$branch_id),
            'uncategorizedquarterlysurvey'=>$this->dashboard->getquarterlysurveys('0',$yearfilter,$branch_id),
            'uncategorizedmonthlysurvey'=>$this->dashboard->getmonthlysurveys('0',$yearfilter,$branch_id),
            'uncategorizedyearlysurvey'=>$this->dashboard->getyearlysurveys('0',$yearfilter,$branch_id),

            'totaldailysurvey'=>$this->dashboard->gettotaldailysurveys($yearfilter,$branch_id),
            'totalweeklysurvey'=>$this->dashboard->gettotalweeklysurveys($yearfilter,$branch_id),
            'totalmonthlysurvey'=>$this->dashboard->gettotalmonthlysurveys($yearfilter,$branch_id),
            'totalquarterlysurvey'=>$this->dashboard->gettotalquarterlysurveys($yearfilter,$branch_id),
            'totalyearlysurvey'=>$this->dashboard->gettotalyearlysurveys($yearfilter,$branch_id),
            'yearfilter'=>$yearfilter,
            'branches'=>explode('-',$this->uri->segment(4)),
            'trailingbranches'=>$this->uri->segment(4),
            'filterdate'=>$filterdate
        );
        $this->load->view('Dashboard/survey',$data);
    }
    function surveydetails(){
        $yearfilter = ($this->uri->total_segments()>2)?$this->uri->segment(3):date("Y-m-d");
        $period = ($this->uri->total_segments()>3)?$this->uri->segment(4):"y";
        $category = ($this->uri->total_segments()>4)?$this->uri->segment(5):"1";
        $branch_id = ($this->uri->total_segments()>5)?$this->uri->segment(6):"1-2-3-4";
        switch($period){
            case 'd':$periodname="Harian ";break;
            case 'w':$periodname="Mingguan ";break;
            case 'm':$periodname="Bulanan ";break;
            case 'q':$periodname="3 Bulanan ";break;
            case 'y':$periodname="Tahunan ";break;
        }
        switch($category){
            case '1':$categoryname="FFR";break;
            case '2':$categoryname="Platinum ";break;
            case '3':$categoryname="Gold ";break;
            case '4':$categoryname="Silver ";break;
            case '5':$categoryname="Bronze ";break;
            case '0':$categoryname="Uncategorized";break;
        }
        $data = array(
            'title'=>'PadiNET | Dashboard Detail Survey '.date("Y-m-d"),
            "objs"=>$this->dashboard->getsurveydetails($yearfilter,$period,$category,$branch_id),
            'period'=>$periodname,
            'category'=>$categoryname
        );
        $this->load->view('Dashboard/surveydetails',$data);
    }
    function getsurveydetailresult(){
        $id = $this->uri->segment(3);
        $arr = $this->dashboard->getsurveystatus($id);
        echo json_encode($arr);
    }
    function gettroubleshootdetailresult(){
        $id = $this->uri->segment(3);
        $arr = $this->dashboard->gettroubleshootstatus($id);
        echo json_encode($arr);
    }
    function install(){
        if($this->uri->total_segments() > 2 ){
            $yearfilter = $this->uri->segment(3);
            $tmp = explode('-',$yearfilter);
            $filterdate = $tmp[1].'/'.$tmp[2].'/'.$tmp[0];
        } else {
            $yearfilter = date("Y-m-d");
            $filterdate = date("m/d/Y");
        }
        if($this->uri->total_segments()>3){
            $branch_id = implode(',',explode('-',$this->uri->segment(4)));
        }else{
            $branch_id = '0';
        }





        $data = array(
            'title'=>'PadiNET | Dashboard BTS',
            'undefineddailyinstall'=>$this->dashboard->getdailyinstalls('0',$yearfilter,$branch_id),
            'undefinedweeklyinstall'=>$this->dashboard->getweeklyinstalls('0',$yearfilter,$branch_id),
            'undefinedquarterlyinstall'=>$this->dashboard->getquarterlyinstalls('0',$yearfilter,$branch_id),
            'undefinedmonthlyinstall'=>$this->dashboard->getmonthlyinstalls('0',$yearfilter,$branch_id),
            'undefinedyearlyinstall'=>$this->dashboard->getyearlyinstalls('0',$yearfilter,$branch_id),

            'ffrdailyinstall'=>$this->dashboard->getdailyinstalls('1',$yearfilter,$branch_id),
            'ffrweeklyinstall'=>$this->dashboard->getweeklyinstalls('1',$yearfilter,$branch_id),
            'ffrquarterlyinstall'=>$this->dashboard->getquarterlyinstalls('1',$yearfilter,$branch_id),
            'ffrmonthlyinstall'=>$this->dashboard->getmonthlyinstalls('1',$yearfilter,$branch_id),
            'ffryearlyinstall'=>$this->dashboard->getyearlyinstalls('1',$yearfilter,$branch_id),

            'pltdailyinstall'=>$this->dashboard->getdailyinstalls('2',$yearfilter,$branch_id),
            'pltweeklyinstall'=>$this->dashboard->getweeklyinstalls('2',$yearfilter,$branch_id),
            'pltquarterlyinstall'=>$this->dashboard->getquarterlyinstalls('2',$yearfilter,$branch_id),
            'pltmonthlyinstall'=>$this->dashboard->getmonthlyinstalls('2',$yearfilter,$branch_id),
            'pltyearlyinstall'=>$this->dashboard->getyearlyinstalls('2',$yearfilter,$branch_id),

            'glddailyinstall'=>$this->dashboard->getdailyinstalls('3',$yearfilter,$branch_id),
            'gldweeklyinstall'=>$this->dashboard->getweeklyinstalls('3',$yearfilter,$branch_id),
            'gldquarterlyinstall'=>$this->dashboard->getquarterlyinstalls('3',$yearfilter,$branch_id),
            'gldmonthlyinstall'=>$this->dashboard->getmonthlyinstalls('3',$yearfilter,$branch_id),
            'gldyearlyinstall'=>$this->dashboard->getyearlyinstalls('3',$yearfilter,$branch_id),

            'brndailyinstall'=>$this->dashboard->getdailyinstalls('5',$yearfilter,$branch_id),
            'brnweeklyinstall'=>$this->dashboard->getweeklyinstalls('5',$yearfilter,$branch_id),
            'brnquarterlyinstall'=>$this->dashboard->getquarterlyinstalls('5',$yearfilter,$branch_id),
            'brnmonthlyinstall'=>$this->dashboard->getmonthlyinstalls('5',$yearfilter,$branch_id),
            'brnyearlyinstall'=>$this->dashboard->getyearlyinstalls('5',$yearfilter,$branch_id),

            'slvdailyinstall'=>$this->dashboard->getdailyinstalls('4',$yearfilter,$branch_id),
            'slvweeklyinstall'=>$this->dashboard->getweeklyinstalls('4',$yearfilter,$branch_id),
            'slvquarterlyinstall'=>$this->dashboard->getquarterlyinstalls('4',$yearfilter,$branch_id),
            'slvmonthlyinstall'=>$this->dashboard->getmonthlyinstalls('4',$yearfilter,$branch_id),
            'slvyearlyinstall'=>$this->dashboard->getyearlyinstalls('4',$yearfilter,$branch_id),
            'yearfilter'=>$yearfilter,
            'branches'=>explode('-',$this->uri->segment(4)),
            'trailingbranches'=>$this->uri->segment(4),
            'filterdate'=>$filterdate

        );
        $this->load->view('Dashboard/install',$data);
    }
    function installdetails(){
        $period = ($this->uri->total_segments()>2)?$this->uri->segment(3):"y";
        $category = ($this->uri->total_segments()>3)?$this->uri->segment(4):"1";
        if($this->uri->total_segments() > 2 ){
            $yearfilter = $this->uri->segment(3);
        } else {
            $yearfilter = date("Y-m-d");
        }
        if($this->uri->total_segments()>4){
            $branch_id = implode(',',explode('-',$this->uri->segment(5)));
        }else{
            $branch_id = '0';
        }
        switch($period){
            case 'd':$periodname="Harian ";break;
            case 'w':$periodname="Mingguan ";break;
            case 'm':$periodname="Bulanan ";break;
            case 'q':$periodname="3 Bulanan ";break;
            case 'y':$periodname="Tahunan ";break;
        }
        switch($category){
            case '1':$categoryname="FFR";break;
            case '2':$categoryname="Platinum ";break;
            case '3':$categoryname="Gold ";break;
            case '4':$categoryname="Silver ";break;
            case '5':$categoryname="Bronze ";break;
            default:$categoryname="Uncategorized";break;
        }
        $data = array(
            'title'=>'PadiNET | Dashboard Detail Install'.date("Y-m-d"),
            "objs"=>$this->dashboard->getinstalldetails($period,$category,$branch_id),
            'period'=>$periodname,
            'category'=>$categoryname
        );
        $this->load->view('Dashboard/installdetails',$data);
    }
    function getinstalldetailresult(){
        $id = $this->uri->segment(3);
        $arr = $this->dashboard->getinstallstatus($id);
        echo json_encode($arr);
    }
    function troubleshoot(){
        if($this->uri->total_segments() >2 ){
            $yearfilter = $this->uri->segment(3);
            $tmp = explode('-',$yearfilter);
            $filterdate = $tmp[1].'/'.$tmp[2].'/'.$tmp[0];
        } else {
            $yearfilter = date("Y-m-d");
            $filterdate = date("d/m/Y");
        }
        if($this->uri->total_segments()>3){
            $branch_id = implode(',',explode('-',$this->uri->segment(4)));
        }else{
            $branch_id = '0';
        }

        $data = array(
            'title'=>'PadiNET | Dashboard Ticket',
            'ffrdailytroubleshoot'=>$this->dashboard->getdailytroubleshoots('1',$yearfilter,$branch_id),
            'ffrweeklytroubleshoot'=>$this->dashboard->getweeklytroubleshoots('1',$yearfilter,$branch_id),
            'ffrquarterlytroubleshoot'=>$this->dashboard->getquarterlytroubleshoots('1',$yearfilter,$branch_id),
            'ffrmonthlytroubleshoot'=>$this->dashboard->getmonthlytroubleshoots('1',$yearfilter,$branch_id),
            'ffryearlytroubleshoot'=>$this->dashboard->getyearlytroubleshoots('1',$yearfilter,$branch_id),

            'pltdailytroubleshoot'=>$this->dashboard->getdailytroubleshoots('2',$yearfilter,$branch_id),
            'pltweeklytroubleshoot'=>$this->dashboard->getweeklytroubleshoots('2',$yearfilter,$branch_id),
            'pltquarterlytroubleshoot'=>$this->dashboard->getquarterlytroubleshoots('2',$yearfilter,$branch_id),
            'pltmonthlytroubleshoot'=>$this->dashboard->getmonthlytroubleshoots('2',$yearfilter,$branch_id),
            'pltyearlytroubleshoot'=>$this->dashboard->getyearlytroubleshoots('2',$yearfilter,$branch_id),

            'glddailytroubleshoot'=>$this->dashboard->getdailytroubleshoots('3',$yearfilter,$branch_id),
            'gldweeklytroubleshoot'=>$this->dashboard->getweeklytroubleshoots('3',$yearfilter,$branch_id),
            'gldquarterlytroubleshoot'=>$this->dashboard->getquarterlytroubleshoots('3',$yearfilter,$branch_id),
            'gldmonthlytroubleshoot'=>$this->dashboard->getmonthlytroubleshoots('3',$yearfilter,$branch_id),
            'gldyearlytroubleshoot'=>$this->dashboard->getyearlytroubleshoots('3',$yearfilter,$branch_id),

            'brndailytroubleshoot'=>$this->dashboard->getdailytroubleshoots('5',$yearfilter,$branch_id),
            'brnweeklytroubleshoot'=>$this->dashboard->getweeklytroubleshoots('5',$yearfilter,$branch_id),
            'brnquarterlytroubleshoot'=>$this->dashboard->getquarterlytroubleshoots('5',$yearfilter,$branch_id),
            'brnmonthlytroubleshoot'=>$this->dashboard->getmonthlytroubleshoots('5',$yearfilter,$branch_id),
            'brnyearlytroubleshoot'=>$this->dashboard->getyearlytroubleshoots('5',$yearfilter,$branch_id),

            'slvdailytroubleshoot'=>$this->dashboard->getdailytroubleshoots('4',$yearfilter,$branch_id),
            'slvweeklytroubleshoot'=>$this->dashboard->getweeklytroubleshoots('4',$yearfilter,$branch_id),
            'slvquarterlytroubleshoot'=>$this->dashboard->getquarterlytroubleshoots('4',$yearfilter,$branch_id),
            'slvmonthlytroubleshoot'=>$this->dashboard->getmonthlytroubleshoots('4',$yearfilter,$branch_id),
            'slvyearlytroubleshoot'=>$this->dashboard->getyearlytroubleshoots('4',$yearfilter,$branch_id),

            'uncategorizeddailytroubleshoot'=>$this->dashboard->getdailytroubleshoots('0',$yearfilter,$branch_id),
            'uncategorizedweeklytroubleshoot'=>$this->dashboard->getweeklytroubleshoots('0',$yearfilter,$branch_id),
            'uncategorizedquarterlytroubleshoot'=>$this->dashboard->getquarterlytroubleshoots('0',$yearfilter,$branch_id),
            'uncategorizedmonthlytroubleshoot'=>$this->dashboard->getmonthlytroubleshoots('0',$yearfilter,$branch_id),
            'uncategorizedyearlytroubleshoot'=>$this->dashboard->getyearlytroubleshoots('0',$yearfilter,$branch_id),

            'totaldailytroubleshoot'=>$this->dashboard->gettotaldailytroubleshoots($yearfilter,$branch_id),
            'totalweeklytroubleshoot'=>$this->dashboard->gettotalweeklytroubleshoots($yearfilter,$branch_id),
            'totalquarterlytroubleshoot'=>$this->dashboard->gettotalquarterlytroubleshoots($yearfilter,$branch_id),
            'totalmonthlytroubleshoot'=>$this->dashboard->gettotalmonthlytroubleshoots($yearfilter,$branch_id),
            'totalyearlytroubleshoot'=>$this->dashboard->gettotalyearlytroubleshoots($yearfilter,$branch_id),
            'yearfilter'=>$yearfilter,
            'branches'=>explode('-',$this->uri->segment(4)),
            'trailingbranches'=>$this->uri->segment(4),
            'filterdate'=>$filterdate
        );
        $this->load->view('Dashboard/troubleshoot',$data);
    }
    function troubleshootdetails(){
        $period = ($this->uri->total_segments()>2)?$this->uri->segment(3):"y";        
        $category = ($this->uri->total_segments()>3)?$this->uri->segment(4):"1";
        $branch_id = ($this->uri->total_segments()>4)?$this->uri->segment(5):"1";
        $yearfilter = ($this->uri->total_segments()>5)?$this->uri->segment(6):"1";
        $categoryname = "Uncategorized";
        switch($period){
            case 'd':$periodname="Harian ";break;
            case 'w':$periodname="Mingguan ";break;
            case 'm':$periodname="Bulanan ";break;
            case 'q':$periodname="3 Bulanan ";break;
            case 'y':$periodname="Tahunan ";break;
        }
        switch($category){
            case '1':$categoryname="FFR";break;
            case '2':$categoryname="Platinum ";break;
            case '3':$categoryname="Gold ";break;
            case '4':$categoryname="Silver ";break;
            case '5':$categoryname="Bronze ";break;
        }
        $data = array(
            'title'=>'PadiNET | Dashboard Detail Troubleshoot'.date("Y-m-d"),
            "objs"=>$this->dashboard->gettroubleshootdetails($period,$category,$branch_id,$yearfilter),
            'period'=>$periodname,
            'category'=>$categoryname
        );
        $this->load->view('Dashboard/troubleshootdetails',$data);
    }
    function test(){
        $out = $this->dashboard->getSupervisedArray();
        
    }
    function sales(){
        $this->common->check_login();
        $kpifilter = ($this->uri->total_segments()>2)? explode("-",$this->uri->segment(3)):array('1');
        $stringkpifilter = ($this->uri->total_segments()>2)? $this->uri->segment(3):'1';
        $sales = $this->dashboard->getsalesbranches();

        $data = array(
            'title'=>'PadiNET | Dashboard Ticket',
            'sales'=>$sales["res"],
            'branch'=>array('1'=>'Surabaya','2'=>'Jakarta','3'=>'Malang','4'=>'Bali'),
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1),
            'kpifilter'=>$kpifilter,
            'stringkpifilter'=>$stringkpifilter
        );
        $this->load->view('Dashboard/sales',$data);
    }
    function salesfilterbydaterange(){
        $this->common->check_login();
        $date1 = ($this->uri->total_segments()>2)? $this->uri->segment(3):date("Y-m-d");
        $date2 = ($this->uri->total_segments()>3)? $this->uri->segment(4):date("Y-m-d");
        $sales = $this->dashboard->getsalesbranchesbydaterange($date1,$date2);
        $branches = $this->dashboard->getbranchesbydaterange($date1,$date2);
        $national = $this->dashboard->getnationalbydaterange($date1,$date2);
        $data = array(
            'title'=>'PadiNET | Dashboard Ticket',
            'sales'=>$sales["res"],
            'branches'=>$branches["res"],
            'national'=>$national["res"][0],
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1),
            'date1'=>$date1,
            'date2'=>$date2
        );
        $this->load->view('Dashboard/salesfilterbydaterange',$data);
    }
    function listfbs(){
        $category = $this->uri->segment(3);
        $date = $this->uri->segment(5);
        $sale_id = $this->uri->segment(6);
        $branch_id = $this->uri->segment(7);
        //echo $category;
        switch($category){
            case 'd':
                $category_label = "Harian";
                $pageheaderlabel = "Form Berlangganan Harian " . humanize(getusernamebyid($sale_id));
                $fbs = $this->dashboard->getdailyfbslist($category,$date,$sale_id,$branch_id);
                break;
            case 'w':
                $category_label = "Mingguan";
                $pageheaderlabel ="Form Berlangganan Harian " . humanize(getusernamebyid($sale_id));
                $fbs = $this->dashboard->getweeklyfbslist($category,$date,$sale_id,$branch_id);
            break;
            case 'm':
                $category_label = "Bulanan";
                $pageheaderlabel = "Form Berlangganan Harian " . humanize(getusernamebyid($sale_id));
                $fbs = $this->dashboard->getmonthlyfbslist($category,$date,$sale_id,$branch_id);
                break;
            case 'q':
                $category_label = "Quarter";
                $pageheaderlabel = "Form Berlangganan Harian " . humanize(getusernamebyid($sale_id));
                $fbs = $this->dashboard->getquarterlyfbslist($category,$date,$sale_id,$branch_id);
            break;
            case 'y':
                $category_label = "Tahunan";
                $pageheaderlabel = "Form Berlangganan Harian " . humanize(getusernamebyid($sale_id));
                $fbs = $this->dashboardbranch->getyearlyfbslist($category,$date,$sale_id,$branch_id);
                break;
                case 'nd':
                $category_label = "Harian";
                $pageheaderlabel = "Form Berlangganan Nasional Harian ";
                $fbs = $this->dashboardbranch->getdailynationalfbslist($category,$date,$sale_id,$branch_id);
                break;
            case 'nw':
                $category_label = "Mingguan";
                $pageheaderlabel = "Form Berlangganan Nasional Mingguan ";
                $fbs = $this->dashboardbranch->getweeklynationalfbslist($category,$date,$sale_id,$branch_id);
            break;
            case 'nm':
                $category_label = "Bulanan";
                $pageheaderlabel = "Form Berlangganan Nasional Bulanan ";
                $fbs = $this->dashboardbranch->getmonthlynationalfbslist($category,$date,$sale_id,$branch_id);
                break;
            case 'nq':
                $category_label = "Quarter";
                $pageheaderlabel = "Form Berlangganan Nasional Quarter";
                $fbs = $this->dashboardbranch->getquarterlynationalfbslist($category,$date,$sale_id,$branch_id);
            break;
            case 'ny':
                $category_label = "Tahunan";
                $pageheaderlabel = "Form Berlangganan Nasional Tahunan";
                $fbs = $this->dashboardbranch->getyearlynationalfbslist($category,$date,$sale_id,$branch_id);
                break;
                case 'bd':
                $category_label = "Harian";
                $pageheaderlabel = "Form Berlangganan Cabang Harian " . $this->parseBranch($branch_id);
                $fbs = $this->dashboardbranch->getdailybranchfbslist($category,$date,$branch_id);
                break;
            case 'bw':
                $category_label = "Mingguan";
                $pageheaderlabel = "Form Berlangganan Cabang Mingguan" . $this->parseBranch($branch_id);
                $fbs = $this->dashboardbranch->getweeklybranchfbslist($category,$date,$branch_id);
            break;
            case 'bm':
                $category_label = "Bulanan";
                $pageheaderlabel = "Form Berlangganan Cabang Bulanan" . $this->parseBranch($branch_id);
                $fbs = $this->dashboardbranch->getmonthlybranchfbslist($category,$date,$branch_id);
                break;
            case 'bq':
                $category_label = "Quarter";
                $pageheaderlabel = "Form Berlangganan Cabang Quarter" . $this->parseBranch($branch_id);
                $fbs = $this->dashboardbranch->getquarterlybranchfbslist($category,$date,$branch_id);
            break;
            case 'by':
                $category_label = "Tahunan";
                $pageheaderlabel = "Form Berlangganan Cabang Tahunan" . $this->parseBranch($branch_id);
                $fbs = $this->dashboardbranch->getyearlybranchfbslist($category,$date,$branch_id);
                break;
        }
        $data = array(
            'title'=>'PadiNET | Daftar FB',
            'category_label'=>$category_label,
            'fbs'=>$fbs,
            'pageheaderlabel'=>$pageheaderlabel,
            'username'=>getusernamebyid($sale_id)
        );
        $this->load->view('Dashboard/listfbs',$data);
    }
    function listoffers(){
        $category = $this->uri->segment(3);
        $date = $this->uri->segment(5);
        $sale_id = $this->uri->segment(6);
        $branch_id = $this->uri->segment(7);
        switch($category){
            case 'd':
                $category_label = "Harian";
                $offers = $this->dashboard->getdailyofferslist($category,$date,$sale_id,$branch_id);
                break;
            case 'w':
                $category_label = "Mingguan";
                $offers = $this->dashboard->getweeklyofferslist($category,$date,$sale_id,$branch_id);
            break;
            case 'm':
                $category_label = "Bulanan";
                $offers = $this->dashboard->getmonthlyofferslist($category,$date,$sale_id,$branch_id);
                break;
            case 'q':
                $category_label = "Quarter";
                $offers = $this->dashboard->getquarterlyofferslist($category,$date,$sale_id,$branch_id);
            break;
            case 'y':
                $category_label = "Tahunan";
                $offers = $this->dashboard->getyearlyofferslist($category,$date,$sale_id,$branch_id);
                break;
            case 'bd':
                $category_label = "Harian Cabang " . $this->parseBranch($branch_id);
                $offers = $this->dashboardbranch->getdailybranchofferslist($category,$date,$branch_id);
                break;
                case 'bw':
                $category_label = "Mingguan Cabang " . $this->parseBranch($branch_id);
                $offers = $this->dashboardbranch->getweeklybranchofferslist($category,$date,$branch_id);
                break;
                case 'bm':
                $category_label = "Bulanan Cabang " . $this->parseBranch($branch_id);
                $offers = $this->dashboardbranch->getmonthlybranchofferslist($category,$date,$branch_id);
                break;
                case 'bq':
                $category_label = "Quarter Cabang " . $this->parseBranch($branch_id);
                $offers = $this->dashboardbranch->getquarterlybranchofferslist($category,$date,$branch_id);
                break;
                case 'by':
                $category_label = "Tahunan Cabang " . $this->parseBranch($branch_id);
                $offers = $this->dashboardbranch->getyearlybranchofferslist($category,$date,$branch_id);
                break;

                case 'nd':
                $category_label = "Harian Nasional ";
                $offers = $this->dashboardbranch->getdailynationalofferslist($category,$date,$branch_id);
                break;
                case 'nw':
                $category_label = "Mingguan Nasional ";
                $offers = $this->dashboardbranch->getweeklynationalofferslist($category,$date,$branch_id);
                break;
                case 'nm':
                $category_label = "Bulanan Nasional ";
                $offers = $this->dashboardbranch->getmonthlynationalofferslist($category,$date,$branch_id);
                break;
                case 'nq':
                $category_label = "Quarter Nasional ";
                $offers = $this->dashboardbranch->getquarterlynationalofferslist($category,$date,$branch_id);
                break;
                case 'ny':
                $category_label = "Tahunan Nasional ";
                $offers = $this->dashboardbranch->getyearlynationalofferslist($category,$date,$branch_id);
                break;
            }
        $data = array(
            'title'=>'PadiNET | Daftar Penawaran',
            'offers'=>$offers,
            'category_label'=>$category_label,
            'username'=>(strlen($category)===1)?getusernamebyid($sale_id):'Semua',
            'sale_id'=>$sale_id,
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1)
        );
        $this->load->view('Dashboard/listoffers',$data);
    }
    function listoffersfilterbydaterange(){
        $category = $this->uri->segment(3);
        $date1 = $this->uri->segment(3);
        $date2 = $this->uri->segment(4);
        $sale_id = $this->uri->segment(5);
        $branch_id = $this->uri->segment(6);
        $category_label = "Penawaran berdasarkan range tanggal";
        $category = "d";
        $offers = $this->dashboard->getlistoffersfilterbydate($date1,$date2,$sale_id,$branch_id);
        $data = array(
            'date1'=>$date1,
            'date2'=>$date2,
            'title'=>'PadiNET | Daftar Penawaran',
            'offers'=>$offers['res'],
            'category_label'=>$category_label,
            'username'=>getusernamebyid($sale_id),
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1)
        );
        $this->load->view('Dashboard/listofferfilterbydaterange',$data);
    }
    function listvisitsfilterbydaterange(){
        $category = $this->uri->segment(3);
        $date1 = $this->uri->segment(3);
        $date2 = $this->uri->segment(4);
        $sale_id = $this->uri->segment(5);
        $branch_id = $this->uri->segment(6);
        $iscounted = $this->uri->segment(7);
        $category_label = "Visit berdasarkan range tanggal";
        $category = "d";
        $visits = $this->dashboard->getlistvisitsfilterbydate($date1,$date2,$sale_id,$branch_id,$iscounted);
        $data = array(
            'date1'=>$date1,
            'date2'=>$date2,
            'title'=>'PadiNET | Daftar Visit',
            'visits'=>$visits['res'],
            'category_label'=>$category_label,
            'username'=>getusernamebyid($sale_id),
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1)
        );
        $this->load->view('Dashboard/listvisitfilterbydaterange',$data);
    }
    function parseBranch($branch_id){
        switch($branch_id){
            case '1':
            $out = 'Surabaya';
            break;
            case '2':
            $out = 'Jakarta';
            break;
            case '3':
            $out = 'Malang';
            break;
            case '4':
            $out = 'Bali';
            break;
        }
        return $out;
    }
    function listvisits(){
        $category = $this->uri->segment(3);
        $date = $this->uri->segment(5);
        $sale_id = $this->uri->segment(6);
        $branch_id = $this->uri->segment(7);
        $stringkpifilter = $this->uri->segment(8);
        $kpifilter = explode("-",$stringkpifilter);
        switch($category){
            case 'd':
                $category_label = "Harian";
                $username = getusernamebyid($sale_id);
                $visits = $this->dashboard->getdailyvisitslist($category,$date,$sale_id,$branch_id,$kpifilter);
                break;
            case 'w':
                $category_label = "Mingguan";
                $username = getusernamebyid($sale_id);
                $visits = $this->dashboard->getweeklyvisitslist($category,$date,$sale_id,$branch_id,$kpifilter);
            break;
            case 'm':
                $category_label = "Bulanan";
                $username = getusernamebyid($sale_id);
                $visits = $this->dashboard->getmonthlyvisitslist($category,$date,$sale_id,$branch_id,$kpifilter);
                break;
            case 'q':
                $category_label = "Quarter";
                $username = getusernamebyid($sale_id);
                $visits = $this->dashboard->getquarterlyvisitslist($category,$date,$sale_id,$branch_id,$kpifilter);
            break;
            case 'y':
                $category_label = "Tahunan";
                $username = getusernamebyid($sale_id);
                $visits = $this->dashboard->getyearlyvisitslist($category,$date,$sale_id,$branch_id,$kpifilter);
                break;
            case 'bd':
                $category_label = "Harian Cabang";
                $username = $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getdailybranchvisitslist($category,$date,$branch_id,$kpifilter);
                break;
            case 'bw':
                $category_label = "Mingguan Cabang";
                $username = $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getweeklybranchvisitslist($category,$date,$branch_id,$kpifilter);
            break;
            case 'bm':
                $category_label = "Bulanan Cabang";
                $username = $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getmonthlybranchvisitslist($category,$date,$branch_id,$kpifilter);
                break;
            case 'bq':
                $category_label = "Quarter Cabang";
                $username = $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getquarterlybranchvisitslist($category,$date,$branch_id,$kpifilter);
            break;
            case 'by':
                $category_label = "Tahunan Cabang";
                $username = $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getyearlybranchvisitslist($category,$date,$kpifilter);
                break;
            case 'nd':
                $category_label = "Harian Nasional";
                $username = "";
                $visits = $this->dashboardbranch->getdailynationalvisitslist($category,$date,$kpifilter);
                break;
            case 'nw':
                $category_label = "Mingguan Nasional";
                $username = "";
                $visits = $this->dashboardbranch->getweeklynationalvisitslist($category,$date,$kpifilter);
            break;
            case 'nm':
                $category_label = "Bulanan Nasional";
                $username = "";
                $visits = $this->dashboardbranch->getmonthlynationalvisitslist($category,$date,$kpifilter);
                break;
            case 'nq':
                $category_label = "Quarter Nasional";
                $username = "";
                $visits = $this->dashboardbranch->getquarterlynationalvisitslist($category,$date,$kpifilter);
            break;
            case 'ny':
                $category_label = "Tahunan Nasional";
                $username = "";
                $visits = $this->dashboardbranch->getyearlynationalvisitslist($category,$date,$branch_id,$kpifilter);
                break;
        }
        switch($stringkpifilter){
            case '0':
                $stringkpifilter_ = '1';
                $stringkpifilterlabel = 'Lihat Kunjungan yang terhitung';
            break;
            case '1':
                $stringkpifilter_ = '0';
                $stringkpifilterlabel = 'Lihat Kunjungan tidak yang terhitung';
            break;
            case '0-1':
                $stringkpifilter_ = '0-1';
                $stringkpifilterlabel = 'Lihat Semua Kunjungan';
            break;
        }
        $data = array(
            'title'=>'PadiNET | Daftar Penawaran',
            'visits'=>$visits,
            'category_label'=>$category_label,
            'username'=>$username,
            'headertext'=>'List Kunjungan',
            'uncountedvisit'=>'/dashboards/listvisits/'.$category.'/1/'.$date.'/'.$sale_id.'/'.$stringkpifilter_,
            'uncountedvisitlabel'=>$stringkpifilterlabel,
            'navbut'=>'/dashboards/listvisits/'.$category.'/1/'.$date.'/'.$sale_id.'/1/',
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1)
        );
        $this->load->view('Dashboard/listvisits',$data);
    }
    function listvisitsuncounted(){
        $category = $this->uri->segment(3);
        //echo 'CATEGORY : '.$category;
        $date = $this->uri->segment(5);
        $sale_id = $this->uri->segment(6);
        switch($category){
            case 'd':
                $category_label = "Harian";
                $visits = $this->dashboard->getdailyvisitslist($category,$date,$sale_id,'0');
                break;
            case 'w':
                $category_label = "Mingguan";
                $visits = $this->dashboard->getweeklyvisitslist($category,$date,$sale_id,'0');
            break;
            case 'm':
                $category_label = "Bulanan";
                $visits = $this->dashboard->getmonthlyvisitslist($category,$date,$sale_id,'0');
                break;
            case 'q':
                $category_label = "Quarter";
                $visits = $this->dashboard->getquarterlyvisitslist($category,$date,$sale_id,'0');
            break;
            case 'y':
                $category_label = "Tahunan";
                $visits = $this->dashboard->getyearlyvisitslist($category,$date,$sale_id,'0');
                break;
        }
        $data = array(
            'title'=>'PadiNET | Daftar Penawaran',
            'visits'=>$visits,
            'category_label'=>$category_label,
            'username'=>getusernamebyid($sale_id),
            'headertext'=>'List Kunjungan yang tidak terhitung ',
            'uncountedvisit'=>'/dashboards/listvisits/'.$category.'/1/'.$date.'/'.$sale_id,
            'uncountedvisitlabel'=>'Lihat kunjungan',
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1)
        );
        $this->load->view('Dashboard/listvisits',$data);
    }
    function visitjson(){
        $arr = array();
        $sales = $this->dashboard->getsales();
        echo '[';
        foreach($sales['res'] as $sale){
            array_push($arr,'{"sales":"'.$sale->username.'","visit":' .json_encode($this->dashboard->visitbysales($sale->id),JSON_NUMERIC_CHECK) . '}');
        }
        echo implode(",",$arr);
        echo ']';
    }
    function offerjson(){
        $arr = array();
        $sales = $this->dashboard->getsales();
        echo '[';
        foreach($sales['res'] as $sale){
            array_push($arr,'{"sales":"'.$sale->username.'","offer":' .json_encode($this->dashboard->offerbysales($sale->id),JSON_NUMERIC_CHECK) . '}');
        }
        echo implode(",",$arr);
        echo ']';
    }
    function visitjsons(){
        echo json_encode($this->dashboard->visitjson());
    }
    function salesvisits(){
        $arr = array();
        $sales = $this->dashboard->getsales();
        echo '[';
        foreach($sales['res'] as $sale){
            array_push ($arr,'{"sales":"'.$sale->username.'","visit":' .json_encode($this->dashboard->visitbysales($sale->id),JSON_NUMERIC_CHECK) . '}');
        }
        echo implode(",",$arr);
        echo ']';
        
    }
    function visit_edit(){
        $sales = $this->dashboard->getsales();
        $id = $this->uri->segment(3);
        $data = array(
            'title'=>'PadiNET | Visit Edit '.date("Y-m-d"),
            'sales'=>$sales['res'],
            'id'=>'<input type="hidden" name="id" value="'.$id.'"/>',
            'action'=>'/visits/fupdate',
            'obj'=>$this->dashboard->getvisit($id)
        );
        $this->load->view('Dashboard/visit_entry',$data);
    }
    function visit_entry(){
        $sales = $this->dashboard->getsales();
        $data = array(
            'title'=>'PadiNET | Visit Entry '.date("Y-m-d"),
            'sales'=>$sales['res'],
            'id'=>'',
            'action'=>'/visits/fsave',
            'obj'=>new Visit()
        );
        $this->load->view('Dashboard/visit_entry',$data);
    }
    function offer_entry(){
        $sales = $this->dashboard->getsales();
        $data = array(
            'title'=>'PadiNET | Offer Entry '.date("Y-m-d"),
            'page_title'=>'Offer Entry',
            'sales'=>$sales['res'],
            'action'=>'/offers/fsave',
            'obj'=>new Offer(),
            'offerservices'=>$this->dashboard->getofferservices(-1)
        );
        $this->load->view('Dashboard/offer_entry',$data);
    }
    function offer_edit(){
        $sales = $this->dashboard->getsales();
        $id = $this->uri->segment(3);
        $data = array(
            'title'=>'PadiNET | Offer Edit '.date("Y-m-d"),
            'sales'=>$sales['res'],
            'page_title'=>'Offer Edit',
            'id'=>'<input type="hidden" name="id" value="'.$id.'"/>',
            'action'=>'/offers/fupdate',
            'obj'=>$this->dashboard->getoffer($id),
            'offerservices'=>$this->dashboard->getofferservices($id)
        );
        $this->load->view('Dashboard/offer_entry',$data);
    }
    function listreimburses(){
        $category = $this->uri->segment(3);
        //echo 'CATEGORY : '.$category;
        $date = $this->uri->segment(5);
        $sale_id = $this->uri->segment(6);
        $branch_id = $this->uri->segment(7);
        $stringkpifilter = $this->uri->segment(8);
        $kpifilter = explode("-",$stringkpifilter);
        switch($category){
            case 'd':
                $category_label = "Harian";
                $pageLabel = "List Reimburse Harian  " . humanize(getusernamebyid($sale_id));
                $visits = $this->dashboard->getdailyreimburseslist($category,$date,$sale_id,$branch_id,$kpifilter);
                break;
            case 'w':
                $category_label = "Mingguan";
                $pageLabel = "List Reimburse Mingguan  " . humanize(getusernamebyid($sale_id));
                $visits = $this->dashboard->getweeklyreimburseslist($category,$date,$sale_id,$branch_id,$kpifilter);
            break;
            case 'm':
                $category_label = "Bulanan";
                $pageLabel = "List Reimburse Bulanan  " . humanize(getusernamebyid($sale_id));
                $visits = $this->dashboard->getmonthlyreimburseslist($category,$date,$sale_id,$branch_id,$kpifilter);
                break;
            case 'q':
                $category_label = "Quarter";
                $pageLabel = "List Reimburse Quarter  " . humanize(getusernamebyid($sale_id));
                $visits = $this->dashboard->getquarterlyreimburseslist($category,$date,$sale_id,$branch_id,$kpifilter);
            break;
            case 'y':
                $category_label = "Tahunan";
                $pageLabel = "List Reimburse Tahunan  " . humanize(getusernamebyid($sale_id));
                $visits = $this->dashboard->getyearlyreimburseslist($category,$date,$sale_id,$branch_id,$kpifilter);
                break;

                case 'bd':
                $category_label = "Harian";
                $pageLabel = "List Reimburse Harian Cabang " . $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getdailybranchreimburseslist($category,$date,$branch_id,$kpifilter);
                break;
            case 'bw':
                $category_label = "Mingguan";
                $pageLabel = "List Reimburse Mingguan Cabang " . $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getweeklybranchreimburseslist($category,$date,$branch_id,$kpifilter);
            break;
            case 'bm':
                $category_label = "Bulanan";
                $pageLabel = "List Reimburse Bulanan Cabang " . $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getmonthlybranchreimburseslist($category,$date,$branch_id,$kpifilter);
                break;
            case 'bq':
                $category_label = "Quarter";
                $pageLabel = "List Reimburse Quarter Cabang " . $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getquarterlybranchreimburseslist($category,$date,$branch_id,$kpifilter);
            break;
            case 'by':
                $category_label = "Tahunan";
                $pageLabel = "List Reimburse Tahunan Cabang " . $this->parseBranch($branch_id);
                $visits = $this->dashboardbranch->getyearlybranchreimburseslist($category,$date,$branch_id,$kpifilter);
                break;

                case 'nd':
                $category_label = "Harian";
                $pageLabel = "List Reimburse Harian Nasional ";
                $visits = $this->dashboardbranch->getdailynationalreimburseslist($category,$date,$kpifilter);
                break;
            case 'nw':
                $category_label = "Mingguan";
                $pageLabel = "List Reimburse Mingguan Nasional ";
                $visits = $this->dashboardbranch->getweeklynationalreimburseslist($category,$date,$kpifilter);
            break;
            case 'nm':
                $category_label = "Bulanan";
                $pageLabel = "List Reimburse Bulanan Nasional ";
                $visits = $this->dashboardbranch->getmonthlynationalreimburseslist($category,$date,$kpifilter);
                break;
            case 'nq':
                $category_label = "Quarter";
                $pageLabel = "List Reimburse Quarter Nasional ";
                $visits = $this->dashboardbranch->getquarterlynationalreimburseslist($category,$date,$kpifilter);
            break;
            case 'ny':
                $category_label = "Tahunan";
                $pageLabel = "List Reimburse Tahunan Nasional ";
                $visits = $this->dashboardbranch->getyearlynationalreimburseslist($category,$date,$kpifilter);
                break;
            }
        switch($stringkpifilter){
            case '0':
                $stringkpifilter_ = '1';
                $stringkpifilterlabel = 'Lihat Kunjungan yang terhitung';
            break;
            case '1':
                $stringkpifilter_ = '0';
                $stringkpifilterlabel = 'Lihat Kunjungan tidak yang terhitung';
            break;
        }
        $data = array(
            'title'=>'PadiNET | Daftar Penawaran',
            'visits'=>$visits,
            'category_label'=>$category_label,
            'username'=>getusernamebyid($sale_id),
            'headertext'=>$pageLabel,
            'uncountedvisit'=>'/dashboards/listvisits/'.$category.'/1/'.$date.'/'.$sale_id.'/'.$stringkpifilter_,
            'uncountedvisitlabel'=>$stringkpifilterlabel,
            'is_admin'=>user_in_group($this->session->userdata['user_id'],1)
        );
        $this->load->view('Dashboard/listreimburses',$data);
    }
}
<?php
function getdailyvisits($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getdailyvisits($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->cnt;
}
function getweeklyvisits($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getweeklyvisits($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->cnt;
}
function getquarterlyvisits($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getquarterlyvisits($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->cnt;
}
function getmonthlyvisits($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getmonthlyvisits($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->cnt;
}
function getyearlyvisits($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getyearlyvisits($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->cnt;
}


function getdailyoffers($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getdailyoffers($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getweeklyoffers($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getweeklyoffers($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getquarterlyoffers($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getquarterlyoffers($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getmonthlyoffers($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getmonthlyoffers($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getyearlyoffers($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getyearlyoffers($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}


function getdailyfbs($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getdailyfbs($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getweeklyfbs($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getweeklyfbs($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getquarterlyfbs($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getquarterlyfbs($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getmonthlyfbs($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getmonthlyfbs($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}
function getyearlyfbs($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getyearlyfbs($category,$date,$sale_id,$branch_id);
    return $out->cnt;
}



function getdailynominalsales($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getdailynominalsales($category,$date,$sale_id,$branch_id);
    return ($out->cnt == null)?0:$out->cnt;
}
function getweeklynominalsales($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getweeklynominalsales($category,$date,$sale_id,$branch_id);
    return ($out->cnt == null)?0:$out->cnt;
}
function getquarterlynominalsales($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getquarterlynominalsales($category,$date,$sale_id,$branch_id);
    return ($out->cnt == null)?0:$out->cnt;
}
function getmonthlynominalsales($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getmonthlynominalsales($category,$date,$sale_id,$branch_id);
    return ($out->cnt == null)?0:$out->cnt;
}
function getyearlynominalsales($category,$date,$sale_id,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboard->getyearlynominalsales($category,$date,$sale_id,$branch_id);
    return ($out->cnt == null)?0:$out->cnt;
}

function getdailyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getdailyreimburses($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->tot;
}
function getweeklyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getweeklyreimburses($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->tot;
}
function getquarterlyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getquarterlyreimburses($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->tot;
}
function getmonthlyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getmonthlyreimburses($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->tot;
}
function getyearlyreimburses($category,$date,$sale_id,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboard->getyearlyreimburses($category,$date,$sale_id,$branch_id,$iscounted);
    return $out->tot;
}
function getbranch($branch_id){
    switch ($branch_id){
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
function getdailybranchreimburses($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getdailybranchreimburses($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getweeklybranchreimburses($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getweeklybranchreimburses($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getmonthlybranchreimburses($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getmonthlybranchreimburses($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getquarterlybranchreimburses($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getquarterlybranchreimburses($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getyearlybranchreimburses($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getyearlybranchreimburses($category,$date,$branch_id,$iscounted);
    return $out->tot;
}

function getdailybranchoffers($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getdailybranchoffers($category,$date,$branch_id);
    return $out->cnt;
}
function getweeklybranchoffers($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getweeklybranchoffers($category,$date,$branch_id);
    return $out->cnt;
}
function getmonthlybranchoffers($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getmonthlybranchoffers($category,$date,$branch_id);
    return $out->cnt;
}
function getquarterlybranchoffers($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getquarterlybranchoffers($category,$date,$branch_id);
    return $out->cnt;
}
function getyearlybranchoffers($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getyearlybranchoffers($category,$date,$branch_id);
    return $out->cnt;
}

function getdailybranchvisits($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getdailybranchvisits($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getweeklybranchvisits($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getweeklybranchvisits($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getmonthlybranchvisits($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getmonthlybranchvisits($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getquarterlybranchvisits($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getquarterlybranchvisits($category,$date,$branch_id,$iscounted);
    return $out->tot;
}
function getyearlybranchvisits($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getyearlybranchvisits($category,$date,$branch_id,$iscounted);
    return $out->tot;
}

function getdailybranchfbs($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getdailybranchfbs($category,$date,$branch_id,$iscounted);
    return $out->cnt;
}
function getweeklybranchfbs($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getweeklybranchfbs($category,$date,$branch_id,$iscounted);
    return $out->cnt;
}
function getmonthlybranchfbs($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getmonthlybranchfbs($category,$date,$branch_id,$iscounted);
    return $out->cnt;
}
function getquarterlybranchfbs($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getquarterlybranchfbs($category,$date,$branch_id,$iscounted);
    return $out->cnt;
}
function getyearlybranchfbs($category,$date,$branch_id,$iscounted=array()){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getyearlybranchfbs($category,$date,$branch_id,$iscounted);
    return $out->cnt;
}


function getdailybranchnominalsales($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getdailybranchnominalsales($category,$date,$branch_id);
    return $out->cnt;
}
function getweeklybranchnominalsales($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getweeklybranchnominalsales($category,$date,$branch_id);
    return $out->cnt;
}
function getmonthlybranchnominalsales($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getmonthlybranchnominalsales($category,$date,$branch_id);
    return $out->cnt;
}
function getquarterlybranchnominalsales($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getquarterlybranchnominalsales($category,$date,$branch_id);
    return $out->cnt;
}
function getyearlybranchnominalsales($category,$date,$branch_id){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getyearlybranchnominalsales($category,$date,$branch_id);
    return $out->cnt;
}

function getdailynationalvisits($category,$date){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getdailynationalvisits($category,$date);
    return $out->cnt;
}
function getweeklynationalvisits($category,$date){
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getweeklynationalvisits($category,$date);     
    return $out->cnt; 
}
function getmonthlynationalvisits($category,$date){
    $ci = & get_instance();
    $out = $ci->dashboardbranch->getmonthlynationalvisits($category,$date);
    return $out->cnt; 
}
function getquarterlynationalvisits($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getquarterlynationalvisits($category,$date);     
    return $out->cnt;
}
function getyearlynationalvisits($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getyearlynationalvisits($category,$date);     
    return $out->cnt;
}

function getdailynationaloffers($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getdailynationaloffers($category,$date);     
    return $out->cnt;
}
function getweeklynationaloffers($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getweeklynationaloffers($category,$date);     
    return $out->cnt;
}
function getmonthlynationaloffers($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getmonthlynationaloffers($category,$date);     
    return $out->cnt;
}
function getquarterlynationaloffers($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getquarterlynationaloffers($category,$date);     
    return $out->cnt;
}
function getyearlynationaloffers($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getyearlynationaloffers($category,$date);     
    return $out->cnt;
}

function getdailynationalfbs($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getdailynationalfbs($category,$date);     
    return $out->cnt;
}
function getweeklynationalfbs($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getweeklynationalfbs($category,$date);     
    return $out->cnt;
}
function getmonthlynationalfbs($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getmonthlynationalfbs($category,$date);     
    return $out->cnt;
}
function getquarterlynationalfbs($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getquarterlynationalfbs($category,$date);     
    return $out->cnt;
}
function getyearlynationalfbs($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getyearlynationalfbs($category,$date);     
    return $out->cnt;
}

function getdailynationalnominalsales($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getdailynationalnominalsales($category,$date);     
    return $out->cnt;
}
function getweeklynationalnominalsales($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getweeklynationalnominalsales($category,$date);     
    return $out->cnt;
}
function getmonthlynationalnominalsales($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getmonthlynationalnominalsales($category,$date);     
    return $out->cnt;
}
function getquarterlynationalnominalsales($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getquarterlynationalnominalsales($category,$date);     
    return $out->cnt;
}
function getyearlynationalnominalsales($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getyearlynationalnominalsales($category,$date);     
    return $out->cnt;
}

function getdailynationalreimburses($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getdailynationalreimburses($category,$date);     
    return $out->tot;
}
function getweeklynationalreimburses($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getweeklynationalreimburses($category,$date);     
    return $out->tot;
}
function getmonthlynationalreimburses($category,$date){
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getmonthlynationalreimburses($category,$date);     
    return $out->tot;
}
function getquarterlynationalreimburses($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getquarterlynationalreimburses($category,$date);     
    return $out->tot;
}
function getyearlynationalreimburses($category,$date){     
    $ci = & get_instance();     
    $out = $ci->dashboardbranch->getyearlynationalreimburses($category,$date);     
    return $out->tot;
}
function branchchecked($elval,$branches){
    if(in_array($elval,$branches)){
        return 'checked="checked"';
    }else{
        return '';
    }
}

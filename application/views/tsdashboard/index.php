<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('adm/head')?>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="TS Dashboard" title="TS Dashboard"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
    </div>
    <?php $this->load->view('adm/menu');?>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a> <span class="divider">></span></li>
                <li class="active">TS</li>
            </ul>
            <?php $this->load->view('adm/buttons');?>
            </div>
        <div class="workplace">
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>Dashboard Teknis</h1>
                    </div>
                    <div class="block-fluid">
                        <div class="row-form clearfix">
                        <div class="span4"><label for="timefilter">Filter</label></div>
                        <div class="span8">
                            <select name="timefilter" id="timefilter">
                                <option value="today">Hari ini</option>
                                <option value="yesterday">Kemarin</option>
                                <option value="thisweek">Minggu ini</option>
                                <option value="thismonth">Bulan ini</option>
                            </select>
                        </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span4">
                                <?php foreach($categories as $cat){?>
                                    <div class="row-form clearfix">
                                        <div class="span8">
                                            <?php echo $cat->name;?>
                                        </div>
                                        <div class="span4">
                                            <input class="categories" type="checkbox" value="<?php echo $cat->id;?>" />
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="span8">
                                <div class="row-form clearfix">
                                    <div class="span4">
                                    <canvas id="openClosePieChart" width="400" height="400"></canvas>
                                    </div>
                                    <div class="span4">
                                        <div class="row-form clearfix">
                                            <div class="span6">
                                                <div class="wBlock green auto clearfix">
                                                    <div class="dSpace">
                                                        <h3>Surabaya</h3>
                                                        <span class="number" id="sbyTicketAmount">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span6 ">
                                                <div class="wBlock green auto clearfix">
                                                    <div class="dSpace">
                                                        <h3>Jakarta</h3>
                                                        <span class="number" id="jktTicketAmount">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-form clearfix">
                                            <div class="span6">
                                                <div class="wBlock green auto clearfix">
                                                    <div class="dSpace">
                                                        <h3>Malang</h3>
                                                        <span class="number" id="mlgTicketAmount">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="wBlock green auto clearfix">
                                                    <div class="dSpace">
                                                        <h3>Bali</h3>
                                                        <span class="number" id="bliTicketAmount">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-form clearfix">
                                    <div class="span4">
                                        <canvas id="troubleshootPieChart"></canvas>
                                    </div>
                                    <div class="span4">
                                    <div class="row-form clearfix">
                                        <div class="span6">
                                            <div class="wBlock yellow auto clearfix">
                                                <div class="dSpace">
                                                    <h3>Upstream</h3>
                                                    <span class="number" id="upstreamTicketAmount">0</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="wBlock yellow auto clearfix">
                                                <div class="dSpace">
                                                    <h3>Backbone</h3>
                                                    <span class="number" id="backboneTicketAmount">0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-form clearfix">
                                        <div class="span6">
                                            <div class="wBlock yellow auto clearfix">
                                                <div class="dSpace">
                                                    <h3>BTS</h3>
                                                    <span class="number" id="btsTicketAmount">0</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="wBlock yellow auto clearfix">
                                                    <div class="dSpace">
                                                        <h3>AP</h3>
                                                        <span class="number" id="apTicketAmount">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span12">
                                <div class="widgetButtons">
                                    <div class="wBlock green auto clearfix">
                                        <div class="dSpace">
                                            <h3>FFR</h3>
                                            <span class="number" id="ffr">0</span>
                                        </div>
                                    </div>
                                    <div class="wBlock green auto clearfix">
                                        <div class="dSpace">
                                            <h3>Platinum</h3>
                                            <span class="number" id="platinum">0</span>
                                        </div>
                                    </div>
                                    <div class="wBlock green auto clearfix">
                                        <div class="dSpace">
                                            <h3>Gold</h3>
                                            <span class="number" id="gold">0</span>
                                        </div>
                                    </div>       
                                    <div class="wBlock green auto clearfix">
                                        <div class="dSpace">
                                            <h3>Silver</h3>
                                            <span class="number" id="silver">0</span>
                                        </div>
                                    </div>       
                                    <div class="wBlock green auto clearfix">
                                        <div class="dSpace">
                                            <h3>Bronze</h3>
                                            <span class="number" id="bronze">0</span>
                                        </div>
                                    </div>       
                                    <div class="wBlock green auto clearfix">
                                        <div class="dSpace">
                                            <h3>Non Categorized</h3>
                                            <span class="number" id="noncategorized">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dr"><span></span></div>
        </div>
    </div>
    <script src="/asset/chart/chart-2.8.0.bundle.js"></script>
    <script src="/asset/chart/chart-2.8.0.min.js"></script>
    <script>
    (function($){
        $("#sbyTicketAmount").click(function(){
            catarray = $(".categories:checked").map(function(){
                return $(this).val();
            })
            .toArray();
            cats = catarray.join("-");
            console.log("cats",cats);
            timefilter = $("#timefilter :selected").val();
            console.log("Time FIlter",timefilter);
            switch(timefilter){
                case "today":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/1/<?php echo date('Y-m-d');?>";
                break;
                case "yesterday":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/1/<?php echo date('Y-m-d',strtotime("-1 days"));?>";
                break;
                case "thisweek":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinweek/"+cats+"/1";
                break;
                case "thismonth":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinmonth/"+cats+"/1";
                break;
            }
        });
        $("#jktTicketAmount").click(function(){
            catarray = $(".categories:checked").map(function(){
                return $(this).val();
            })
            .toArray();
            cats = catarray.join("-");
            timefilter = $("#timefilter :selected").val();
            switch(timefilter){
                case "today":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/2/<?php echo date('Y-m-d');?>";
                break;
                case "yesterday":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/2/<?php echo date('Y-m-d',strtotime("-1 days"));?>";
                break;
                case "thisweek":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinweek/"+cats+"/2";
                break;
                case "thismonth":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinmonth/"+cats+"/2";
                break;
            }
        });
        $("#mlgTicketAmount").click(function(){
            catarray = $(".categories:checked").map(function(){
                return $(this).val();
            })
            .toArray();
            cats = catarray.join("-");
            timefilter = $("#timefilter :selected").val();
            switch(timefilter){
                case "today":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/3/<?php echo date('Y-m-d');?>";
                break;
                case "yesterday":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/3/<?php echo date('Y-m-d',strtotime("-1 days"));?>";
                break;
                case "thisweek":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinweek/"+cats+"/3";
                break;
                case "thismonth":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinmonth/"+cats+"/3";
                break;
            }
        });
        $("#bliTicketAmount").click(function(){
            catarray = $(".categories:checked").map(function(){
                return $(this).val();
            })
            .toArray();
            cats = catarray.join("-");
            timefilter = $("#timefilter :selected").val();
            switch(timefilter){
                case "today":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/4/<?php echo date('Y-m-d');?>";
                break;
                case "yesterday":
                window.location.href = "/tsdashboards/ticketbycauseidindaydetail/"+cats+"/4/<?php echo date('Y-m-d',strtotime("-1 days"));?>";
                break;
                case "thisweek":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinweek/"+cats+"/4";
                break;
                case "thismonth":
                window.location.href = "/tsdashboards/getticketbycategoryarrayinmonth/"+cats+"/4";
                break;
            }
        });
        $(".categories").each(function(){
            $(this).prop("checked",true);
        });
        catarray = $(".categories:checked").map(function(){
            return $(this).val();
        })
        .toArray();
        doPopulate = function(thisval){
            switch(thisval){
                case 'today':
                    getdailyVals("<?php echo date('Y-m-d');?>");
                    getDailyBranch("<?php echo date('Y-m-d');?>");
                    getticketscategoryratioinday("<?php echo date('Y-m-d');?>");
                    getdailyticket("<?php echo date('Y-m-d');?>");
                    getdailyTroubleshoot("<?php echo date('Y-m-d');?>",catarray);
                break;
                case 'yesterday':
                    getdailyVals("<?php echo date('Y-m-d',strtotime("-1 days"));?>");
                    getDailyBranch("<?php echo date('Y-m-d',strtotime("-1 days"));?>");
                    getticketscategoryratioinday("<?php echo date('Y-m-d',strtotime("-1 days"));?>");
                    getdailyticket("<?php echo date('Y-m-d',strtotime("-1 days"));?>");
                    getdailyTroubleshoot("<?php echo date('Y-m-d',strtotime("-1 days"));?>",catarray);
                break;
                case 'thisweek':
                    getWeeklyVals();
                    getWeeklyBranch();
                    getticketscategoryratioiweek();
                    getweeklyticket();
                    getweeklyTroubleshoot(catarray);
                break;
                case 'thismonth':
                    getMonthlyVals();
                    getMonthlyBranch();
                    getticketscategoryratioimonth();
                    getmonthlyticket();
                    getmonthlyTroubleshoot(catarray);
                break;
            }
        }
        $("#timefilter").change(function(){
            thisval = $(this).val();
            catarray = $(".categories:checked").map(function(){
                return $(this).val();
            })
            .toArray();
            doPopulate(thisval);
        })
        getdailyticket = function(dt){
            $.ajax({
                url:'/tsdashboards/getdailyticket/'+dt,
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#ffr").html(data[0].ffr);
                    $("#platinum").html(data[0].platinum);
                    $("#gold").html(data[0].gold);
                    $("#bronze").html(data[0].bronze);
                    $("#silver").html(data[0].silver);
                    $("#noncategorized").html(data[0].noncategorized);
                }else{
                    $("#ffr").html(0);
                    $("#platinum").html(0);
                    $("#gold").html(0);
                    $("#bronze").html(0);
                    $("#silver").html(0);
                    $("#noncategorized").html(data[0].noncategorized);
                }
            })
            .fail(function(err){
                console.log("getdailyticket error",err);
            });
        }
        getweeklyticket = function(){
            $.ajax({
                url:'/tsdashboards/getweeklyticket/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#ffr").html(data[0].ffr);
                    $("#platinum").html(data[0].platinum);
                    $("#gold").html(data[0].gold);
                    $("#bronze").html(data[0].bronze);
                    $("#silver").html(data[0].silver);
                    $("#noncategorized").html(data[0].noncategorized);
                }else{
                    $("#ffr").html(0);
                    $("#platinum").html(0);
                    $("#gold").html(0);
                    $("#bronze").html(0);
                    $("#silver").html(0);
                    $("#noncategorized").html(data[0].noncategorized);
                }
            })
            .fail(function(err){
                console.log("getmonthlyticket error",err);
            });
        }
        getmonthlyticket = function(){
            $.ajax({
                url:'/tsdashboards/getmonthlyticket/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#ffr").html(data[0].ffr);
                    $("#platinum").html(data[0].platinum);
                    $("#gold").html(data[0].gold);
                    $("#bronze").html(data[0].bronze);
                    $("#silver").html(data[0].silver);
                    $("#noncategorized").html(data[0].noncategorized);
                }else{
                    $("#ffr").html(0);
                    $("#platinum").html(0);
                    $("#gold").html(0);
                    $("#bronze").html(0);
                    $("#silver").html(0);
                    $("#noncategorized").html(data[0].noncategorized);
                }
            })
            .fail(function(err){
                console.log("getmonthlyticket error",err);
            });
        }
        getticketscategoryratioinday = function(dt){
            $.ajax({
                url:'/tsdashboards/getticketscategoryratioinday/'+dt,
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#upstreamTicketAmount").html(data[0].upstream);
                    $("#backboneTicketAmount").html(data[0].backbone);
                    $("#btsTicketAmount").html(data[0].bts);
                    $("#apTicketAmount").html(data[0].ap);
                }else{
                    $("#upstreamTicketAmount").html(0);
                    $("#backboneTicketAmount").html(0);
                    $("#btsTicketAmount").html(0);
                    $("#apTicketAmount").html(0);
                }
            })
            .fail(function(err){
                console.log("getticketscategoryratioinday error",err);
            });
        }
        getticketscategoryratioiweek = function(){
            $.ajax({
                url:'/tsdashboards/getticketscategoryratioinweek/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#upstreamTicketAmount").html(data[0].upstream);
                    $("#backboneTicketAmount").html(data[0].backbone);
                    $("#btsTicketAmount").html(data[0].bts);
                    $("#apTicketAmount").html(data[0].ap);
                }else{
                    $("#upstreamTicketAmount").html(0);
                    $("#backboneTicketAmount").html(0);
                    $("#btsTicketAmount").html(0);
                    $("#apTicketAmount").html(0);
                }
            })
            .fail(function(err){
                console.log("getticketscategoryratioinweek error",err);
            });
        }
        getticketscategoryratioimonth = function(){
            $.ajax({
                url:'/tsdashboards/getticketscategoryratioinmonth/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#upstreamTicketAmount").html(data[0].upstream);
                    $("#backboneTicketAmount").html(data[0].backbone);
                    $("#btsTicketAmount").html(data[0].bts);
                    $("#apTicketAmount").html(data[0].ap);
                }else{
                    $("#upstreamTicketAmount").html(0);
                    $("#backboneTicketAmount").html(0);
                    $("#btsTicketAmount").html(0);
                    $("#apTicketAmount").html(0);
                }
            })
            .fail(function(err){
                console.log("getticketscategoryratioimonth error",err);
            });
        }
        getDailyBranch = function(dt){
            $.ajax({
                url:'/tsdashboards/jsonticketsperbranchinday/'+dt,
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#sbyTicketAmount").html(data[0].sby);
                    $("#jktTicketAmount").html(data[0].jkt);
                    $("#mlgTicketAmount").html(data[0].mlg);
                    $("#bliTicketAmount").html(data[0].bli);
                }else{
                    $("#sbyTicketAmount").html(0);
                    $("#jktTicketAmount").html(0);
                    $("#mlgTicketAmount").html(0);
                    $("#bliTicketAmount").html(0);
                }
            })
            .fail(function(err){
                console.log("perbranch daily error",err);
            });
        }
        getWeeklyBranch = function(){
            $.ajax({
                url:'/tsdashboards/jsonticketsperbranchinweek/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#sbyTicketAmount").html(data[0].sby);
                    $("#jktTicketAmount").html(data[0].jkt);
                    $("#mlgTicketAmount").html(data[0].mlg);
                    $("#bliTicketAmount").html(data[0].bli);
                }else{
                    $("#sbyTicketAmount").html(0);
                    $("#jktTicketAmount").html(0);
                    $("#mlgTicketAmount").html(0);
                    $("#bliTicketAmount").html(0);
                }
            })
            .fail(function(err){
                console.log("perbranch daily error",err);
            });
        }
        getMonthlyBranch = function(){
            $.ajax({
                url:'/tsdashboards/jsonticketsperbranchinmonth/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    $("#sbyTicketAmount").html(data[0].sby);
                    $("#jktTicketAmount").html(data[0].jkt);
                    $("#mlgTicketAmount").html(data[0].mlg);
                    $("#bliTicketAmount").html(data[0].bli);
                }else{
                    $("#sbyTicketAmount").html(0);
                    $("#jktTicketAmount").html(0);
                    $("#mlgTicketAmount").html(0);
                    $("#bliTicketAmount").html(0);
                }
            })
            .fail(function(err){
                console.log("perbranch daily error",err);
            });            
        }
        getdailyTroubleshoot = function(thisval,catarray){
            console.log("catarray",catarray);
            $.ajax({
                url:'/tsdashboards/getdailytroubleshoots/',
                dataType:'json',
                type:'post',
                data:{cats:catarray,dt:thisval.toString()}
            })
            .done(function(data){
                console.log("Data",data);
                if(data.length>0){
                    populateTroubleshootPieChart(data[0]);
                }else{
                    populateOpenClosePieChart([{troubleshoot:0,nontroubleshoot:0}]);
                }
            })
            .fail(function(err){
                console.log("Error Troubleshoot data",err);
            });
        }
        getweeklyTroubleshoot = function(catarray){
            $.ajax({
                url:'/tsdashboards/getweeklytroubleshoots/',
                dataType:'json',
                type:'post',
                data:{cats:catarray,dt:thisval.toString()}
            })
            .done(function(data){
                if(data.length>0){
                    populateTroubleshootPieChart(data[0]);
                }else{
                    populateOpenClosePieChart([{troubleshoot:0,nontroubleshoot:0}]);
                }
            })
            .fail(function(err){
                console.log("Error Troubleshoot data",err);
            });
        }
        getmonthlyTroubleshoot = function(catarray){
            $.ajax({
                url:'/tsdashboards/getmonthlytroubleshoots/',
                dataType:'json',
                type:'post',
                data:{cats:catarray,dt:thisval.toString()}
            })
            .done(function(data){
                if(data.length>0){
                    populateTroubleshootPieChart(data[0]);
                }else{
                    populateOpenClosePieChart([{troubleshoot:0,nontroubleshoot:0}]);
                }
            })
            .fail(function(err){
                console.log("Error Troubleshoot data",err);
            });
        }
        getdailyVals = function(thisval,catarray){
            $.ajax({
                url:'/tsdashboards/jsonticketsinday/'+thisval.toString(),
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    populateOpenClosePieChart(data[0]);
                }else{
                    populateOpenClosePieChart([{open:0,closed:0}]);
                }
            })
            .fail(function(err){
                console.log("Error data",err);
            });
        }
        getWeeklyVals = function(catarray){
            $.ajax({
                url:'/tsdashboards/jsonticketsinweek/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    populateOpenClosePieChart(data[0]);
                }else{
                    populateOpenClosePieChart([{open:0,closed:0}]);
                }
            })
            .fail(function(err){
                console.log("Error data",err);
            });
        }
        getMonthlyVals = function(catarray){
            $.ajax({
                url:'/tsdashboards/jsonticketsinmonth/',
                dataType:'json',
                type:'get'
            })
            .done(function(data){
                if(data.length>0){
                    populateOpenClosePieChart(data[0]);
                }else{
                    populateOpenClosePieChart([{open:0,closed:0}]);
                }
            })
            .fail(function(err){
                console.log("Error data",err);
            });
        }
        populateOpenClosePieChart = function(ticket){
            //var ctx = document.getElementById('openClosePieChart');
            //var ctx = document.getElementById('openClosePieChart').getContext('2d');
            var ctx = $('#openClosePieChart');
            //var ctx = 'openClosePieChart';
            if(myPieChart!=null){
                myPieChart.destroy();
            }
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Closed', 'Open'],
                    datasets: [{
                        label: '# of Tickets',
                        data: [ticket['closed'], ticket['open']],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                /*options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }*/
            });
        }
        populateTroubleshootPieChart = function(ticket){
            console.log("Troubleshoot Tiket",ticket);
            console.log("Ticket open",ticket['troubleshoot']);
            console.log("Ticket closed",ticket['nontroubleshoot']);
            //var ctx = document.getElementById('openClosePieChart');
            //var ctx = document.getElementById('openClosePieChart').getContext('2d');
            var ctx = $('#troubleshootPieChart');
            //var ctx = 'openClosePieChart';
            if(myPieChart!=null){
                myPieChart.destroy();
            }
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['troubleshoot', 'Non troubleshoot'],
                    datasets: [{
                        label: '# of Tickets',
                        data: [ticket['troubleshoot'], ticket['nontroubleshoot']],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                /*options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }*/
            });
        }
        $(".categories").on("change",function(){
            console.log("categories changed");
            catarray = $(".categories:checked").map(function(){
                return $(this).val();
            })
            .toArray();
            doPopulate($("#timefilter").val());
        })
        getdailyVals("<?php echo date('Y-m-d');?>");
        getDailyBranch("<?php echo date('Y-m-d');?>");
        getticketscategoryratioinday("<?php echo date('Y-m-d');?>");
        getdailyticket("<?php echo date('Y-m-d');?>");
        getdailyTroubleshoot("<?php echo date('Y-m-d');?>",catarray);
    }(jQuery))
    </script>
</body>
</html>

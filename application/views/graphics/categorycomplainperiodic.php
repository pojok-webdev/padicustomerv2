<!DOCTYPE html>
<html lang="en">
<head>        
    <?php $this->load->view('graphics/head');?>
</head>
<body>
    <div class="header">
        <a class="logo" href="/"><img src="/img/aquarius/logo.png" alt="PadiApp" title="Grafik Laporan"/></a>
        <ul class="header_menu">
            <li class="list_icon"><a href="#">&nbsp;</a></li>
        </ul>    
    </div>
    <?php $this->load->view('adm/menu'); ?>        
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Report</a> <span class="divider">></span></li>                
                <li class="active">Komplain Periodik (Grafik)</li>
            </ul>
            <?php $this->load->view('adm/buttons'); ?>            
        </div>
        <div class="workplace">            
            <div class="dr"><span></span></div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="head clearfix">
                        <a href="/rpt/categorycomplainreportperiodic/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->uri->segment(5);?>/<?php echo $this->uri->segment(6);?>/<?php echo $this->uri->segment(7);?>/<?php echo $this->uri->segment(8);?>/<?php echo $this->uri->segment(9);?>"><div class="isw-left_circle"></div></a>
                        <h1>Laporan Komplain TS , <?php echo $date1 . ' - ' . $date2;?> (<?php echo $total;?>)</h1>
                    </div>
                    <div class="block">
                        <div id="piechart" style="height: 300px;">
                            
                        </div>
                    </div>
                </div>                
            </div>             
        </div>
    </div>   
</body>
<script>
    if($("#piechart").length > 0){
        $.ajax({
            url:'/rpt/plotsrc/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>/<?php echo $this->uri->segment(5)?>/<?php echo $this->uri->segment(6)?>/<?php echo $this->uri->segment(7)?>/<?php echo $this->uri->segment(8)?>/<?php echo $this->uri->segment(9)?>',
            type:'get',
            data:{
                "ticketstart":"2017-1-1",
                "ticketend":"2018-3-1",
                "branchselected":"1,2,3,4",
                "causeid":1
            },
            dataType:'json'
        })
        .done(function(res){
            console.log("Res",res.data);
                $.plot($("#piechart"), res.data, 
                    {
                        series: {
                            pie: { show: true }
                        },
                        legend: { show: false }
                });

        })
        .fail(function(err){
            console.log('Err',err);
        });
/*        var data = [];
            data[0] = { label: "Router Up", data: 30 };
            data[1] = { label: "Router Down", data: 20 };
            data[2] = { label: "Interferrensi AP", data: 35 };
            data[3] = { label: "Bandwidth Penuh", data: 5 };
            data[4] = { label: "Router Down", data: 10 };
            $.plot($("#piechart"), data, 
            {
                series: {
                    pie: { show: true }
                },
                legend: { show: false }
            });*/
    }
</script>
</html>

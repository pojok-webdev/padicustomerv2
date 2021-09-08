var Index = function () {


    return {

        //main function
        initCharts: function () {
            if (!jQuery.plot) {
                return;
            }

            var data = [];
            var totalPoints = 250;

            // random data generator for plot charts
            function showVAS(vasid){
                out = 'What aaaa!'+vasid;
                switch(vasid){
                    case '1':out='Blocking Site';break;
                    case '2':out='Port Forwarding';break;
                    case '3':out='Additional IP Public';break;
                    case '4':out='Firewall Rules/Allow IP';break;
                    case '5':out='Firewall Protection';break;
                    case '6':out='Bandwidth Management';break;
                    case '7':out='Backup Last Mile';break;
                    case '8':out='Bandwidth on Demand';break;
                    case '9':out='Domain Names';break;
                    case '10':out='Hosting';break;
                    case '11':out='Load Sharing';break;
                    case '12':out='Load Balance';break;
                    case '13':out='Fail Over';break;
                    case '14':out='VPN+IP Routing';break;
                    case '15':out='VoIP Line';break;
                    case '16':out='Hotspot Login';break;
                    case '17':out='Zimbra Mail Server Setup';break;
                    case '18':out='Proxy Server Setup';break;
                    case '19':out='Basic Network Consultation by Phone';break;
                    case '20':out='24/7 Call Support';break;
                    case '21':out='Whatsapp Support';break;
                    case '22':out='Traffic Monitoring';break;
                    case '23':out='Weekday Troubleshoot';break;
                    case '24':out='Emergency Team for Weekend/Non Office Hour Troubleshoot';break;
                    case '25':out='EoS';break;
                }
                return out;
            }
            function showTooltip(title, x, y, contents) {
                theToolTip = '<div id="tooltip" class="chart-tooltip">';
                theToolTip+= '<div class="date">' + title + '<\/div>';
                theToolTip+= '<div class="label label-success">Layanan: ' + showVAS(contents);
                theToolTip+= '<\/div><div class="label label-important">ImpOOO: ' + x * 12 + '<\/div><\/div>'; 
                $(theToolTip).css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 100,
                    width: 75,
                    left: x - 40,
                    border: '0px solid #ccc',
                    padding: '2px 6px',
                    'background-color': '#ffff',
                }).appendTo("body").fadeIn(200);
            }

            function randValue() {
                return (Math.floor(Math.random() * (1 + 50 - 20))) + 10;
            }
            if ($('#site_activities').size() != 0) {
                //site activities
                var previousPoint2 = null;
                $('#site_activities_loading').hide();
                $('#site_activities_content').show();

                var activities = [
                    [1, 10],
                    [2, 9],
                    [3, 8],
                    [4, 6],
                    [5, 5],
                    [6, 3],
                    [7, 9],
                    [8, 10],
                    [9, 12],
                    [10, 14],
                    [11, 15],
                    [12, 13],
                    [13, 11],
                    [14, 10],
                    [15, 9],
                    [16, 8],
                    [17, 12],
                    [18, 14],
                    [19, 16],
                    [20, 19],
                    [21, 20],
                    [22, 20],
                    [23, 19],
                    [24, 17],
                    [25, 15],
                    [25, 14],
                    [26, 12],
                    [27, 10],
                    [28, 8],
                    [29, 10],
                    [30, 12]
                ];
                var ticks = [
                    [0, "Gold"], [1, "Silver"], [2, "Platinum"], [3, "Palldium"], [4, "Rhodium"], [5, "Ruthenium"], [6, "Iridium"]
                ];
                var plot_activities = $.plot(
                    $("#site_activities"), [{
                        data: activities,
                        color: "rgba(107,207,123, 0.9)",
                        shadowSize: 0,
                        bars: {
                            show: true,
                            lineWidth: 0,
                            fill: true,
                            fillColor: {
                                colors: [{
                                        opacity: 1
                                    }, {
                                        opacity: 1
                                    }
                                ]
                            }
                        }
                    }
                ], {
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.9
                        }
                    },
                    grid: {
                        show: false,
                        hoverable: true,
                        clickable: false,
                        autoHighlight: true,
                        borderWidth: 0
                    },
                    yaxis: {
                        min: 0,
                        max: 20
                    },
                    xaxis:{
                        ticks:ticks
                    }
                });

                $("#site_activities").bind("plothover", function (event, pos, item) {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));
                    if (item) {
                        if (previousPoint2 != item.dataIndex) {
                            previousPoint2 = item.dataIndex;
                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(0),
                                y = item.datapoint[1].toFixed(2);
                            showTooltip('Tot Plg:'+y, item.pageX, item.pageY, x);
                        }
                    }
                });

                $('#site_activities').bind("mouseleave", function () {
                    $("#tooltip").remove();
                });
            }
        },


    };

}();
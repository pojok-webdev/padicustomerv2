<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grafik VAS - Pelanggan</title>
    <link href="../../../../asset/Tiny-Animated-Chart-Plugin-jQuery-simple-chart/demo/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../../asset/Tiny-Animated-Chart-Plugin-jQuery-simple-chart/simple-chart.css">
    <link href="../../../../asset/Tiny-Animated-Chart-Plugin-jQuery-simple-chart/demo/fonts.css" rel="stylesheet">
    <style>
        body {  background-color:#eaeff5 }
        section { float:left; width:100%; padding:10px; margin:40px 0;  background-color:#fff; box-shadow:0 15px 40px rgba(0,0,0,.1) }
        h1 { margin-top:50px; text-align:center;}
    </style>
</head>
<body>
<h1>Grafik VAS terhadap Pelanggan</h1>
    <div class="sc-wrapper">
        <section class="sc-section">
            <div class="column-chart"></div>
        </section>
        <section class="sc-section">
            <div class="bar-chart"></div>
        </section>
    </div>
    <script src="../../../../asset/Tiny-Animated-Chart-Plugin-jQuery-simple-chart/demo/jquery-1.12.4.min.js"></script>
    <script src="../../../../asset/Tiny-Animated-Chart-Plugin-jQuery-simple-chart/simple-chart.js"></script>
    <script>
        //        Source: http://stackoverflow.com/questions/10599933/convert-long-number-into-abbreviated-string-in-javascript-with-a-special-shortn
        function abbreviateNumber(arr) {
            var newArr = [];
            $.each(arr, function (index, value) {
                var newValue = value;
                if (value >= 1000) {
                    var suffixes = [" ", " K", " mil", " bil", " t"];
                    var suffixNum = Math.floor(("" + value).length / 3);
                    var shortValue = '';
                    for (var precision = 2; precision >= 1; precision--) {
                        shortValue = parseFloat((suffixNum != 0 ? (value / Math.pow(1000, suffixNum) ) : value).toPrecision(precision));
                        var dotLessShortValue = (shortValue + '').replace(/[^a-zA-Z 0-9]+/g, '');
                        if (dotLessShortValue.length <= 2) {
                            break;
                        }
                    }
                    if (shortValue % 1 != 0)  shortNum = shortValue.toFixed(1);
                    newValue = shortValue + suffixes[suffixNum];
                }
                newArr[index] = newValue;
            });
            return newArr;
        }
        var labels = [
            "Blocking Site", 
            "Port Forwarding", 
            "Additional IP Public", 
            "Firewall Rules/Allow IP", 
            "Firewall Protection", 
            "Bandwidth Management", 
            "Backup Last Mile", 
            "Bandwidth on Demand", 
            "Domain Names", 
            "Hosting",
            "Load Sharing",
            "Load Balance",
            "Fail Over",
            "VPN+IP Routing",
            "VoIP Line",
            "Hotspot Login",
            "Zimbra Mail Server Setup",
            "Proxy Server Setup",
            "Basic Network Consultation by Phone",
            "24/7 Call Support",
            "Whatsapp Support",
            "Traffic Monitoring",
            "Weekday Troubleshoot",
            "Emergency Team for Weekend/Non Office Hour Troubleshoot",
            "EoS",
            ];
        var values = [
            <?php echo $vasclients1['cnt'];?>,
            <?php echo $vasclients2['cnt'];?>,
            <?php echo $vasclients3['cnt'];?>,
            <?php echo $vasclients4['cnt'];?>,
            <?php echo $vasclients5['cnt'];?>,
            <?php echo $vasclients6['cnt'];?>,
            <?php echo $vasclients7['cnt'];?>,
            <?php echo $vasclients8['cnt'];?>,
            <?php echo $vasclients9['cnt'];?>,
            <?php echo $vasclients10['cnt'];?>,
            <?php echo $vasclients11['cnt'];?>,
            <?php echo $vasclients12['cnt'];?>,
            <?php echo $vasclients13['cnt'];?>,
            <?php echo $vasclients14['cnt'];?>,
            <?php echo $vasclients15['cnt'];?>,
            <?php echo $vasclients16['cnt'];?>,
            <?php echo $vasclients17['cnt'];?>,
            <?php echo $vasclients18['cnt'];?>,
            <?php echo $vasclients19['cnt'];?>,
            <?php echo $vasclients20['cnt'];?>,
            <?php echo $vasclients21['cnt'];?>,
            <?php echo $vasclients22['cnt'];?>,
            <?php echo $vasclients23['cnt'];?>,
            <?php echo $vasclients24['cnt'];?>,
            <?php echo $vasclients25['cnt'];?>
            ];
        var outputValues = abbreviateNumber(values);

        $('.column-chart').simpleChart({
            title: {
                text: 'Grafik VAS terhadap Pelanggan',
                align: 'center'
            },
            type: 'column',
            layout: {
                width: '100%',
                height: '250px'
            },
            item: {
                label: labels,
                value: values,
                outputValue: outputValues,
                color: ['#00aeef'],
                prefix: '',
                suffix:'',
                render: {
                    margin: 0.2,
                    size: 'relative'
                }
            }
        });

        $('.bar-chart').simpleChart({
            title: {
                text: 'Grafik VAS terhadap Pelanggan',
                align: 'center'
            },
            type: 'bar',
            layout: {
                width: '100%'
            },
            item: {
                label: labels,
                value: values,
                outputValue: outputValues,
                color: ['#00aeef'],
                prefix: '',
                suffix: ' Pelanggan',
                render: {
                    margin: 0,
                    size: 'relative'
                }
            }
        });

        $('.waterfall-chart').simpleChart({
            title: {
                text: 'Grafik VAS terhadap Pelanggan',
                align: 'center'
            },
            type: 'waterfall',
            layout: {
                width: '100%'
            },
            item: {
                label: labels,
                value: values,
                outputValue: outputValues,
                color: ['#00aeef'],
                prefix: '',
                suffix:'',
                render: {
                    margin: 0,
                    size: 'absolute'
                }
            }
        });


        $('.progress-chart').simpleChart({
            title: {
                text: 'Grafik VAS terhadap Pelanggan',
                align: 'center'
            },
            type: 'progress',
            layout: {
                width: '100%',
                height: '250px'
            },
            item: {
                label: labels,
                value: values,
                outputValue: outputValues,
                color: ['#00aeef'],
                prefix: '',
                suffix:'',
                render: {
                    margin: 0,
                    size: 'absolute'
                }
            }
        })

        $('.step-chart').simpleChart({
            title: {
                text: 'Grafik VAS terhadap Pelanggan',
                align: 'center'
            },
            type: 'step',
            layout: {
                width: '100%',
                height: '250px'
            },
            item: {
                label: labels,
                value: values,
                outputValue: outputValues,
                color: ['#00aeef'],
                prefix: '',
                suffix:'',
                render: {
                    margin: 0,
                    size: 'relative'
                }
            }
        })
    </script>
</body>
</html>
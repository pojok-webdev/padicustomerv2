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
        h1 { margin-top:15px; text-align:center;}
        h3{text-align:center}
        table{ width:100%;font-family:'Arial';font-size: 14px}
        table tbody tr td{padding:6px;}
        table tbody tr:nth-child(even){background:#ccffe6}
        table tbody tr:nth-child(odd){background: #e6fff2}
        table tbody td:nth-child(1){text-align:right}
    </style>
</head>
<body>
<h1><?php echo $vasname;?></h1>
<h3><a href="/rpt/getvasclients">Grafik VAS - Pelanggan</a></h3>
    <div class="sc-wrapper">
        <section class="sc-section">
            <table>
                <thead>
                    <tr>
                        <th>No</th><th>Nama</th><th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                <?php $c = 0;?>
                <?php foreach($clients['res'] as $client){?>
                <?php $c++;?>
                <tr>
                    <td><?php echo $c;?></td>
                    <td><?php echo $client->name;?></td>
                    <td><?php echo $client->address;?></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
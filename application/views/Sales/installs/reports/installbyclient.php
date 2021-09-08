<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laporan Instalasi TS : <?php echo $objs->name;?></title>
<!-- bootstrap -->
<link href="/css/reports/bootstraps/bootstrap.min.css" rel="stylesheet">
<!-- -->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<link href="/reports/css/custom.css" rel="stylesheet">
<link rel='stylesheet' type='text/css' href='/css/aquarius/reports/padiReport.css' />
<style>
.vsdfile{
	margin-right: 15px;
}
.requirement .center{
	text-align:center;
}
.baname{
	font-weight:bold;
}
.row-header{
	font-size: 20px;
	font-weight: bolder;
}
.row-footer{
	margin-bottom: 50px;
}
.barow{
	margin-top: 15px;
}
</style>
<script type='text/javascript' src='/js/aquarius/links.js'></script>
<script type='text/javascript' src='/js/jquery-1.8.2.min.js'></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.14.custom.min.js"></script>
	<script type="text/javascript" src="/js/jspdf/jspdf.debug.js"></script>
	<script type="text/javascript" src="/js/jspdf/jspdf.min.js"></script>
</head>

<body>
<div class="container" id="fromHTMLtestdiv">
	<div class="page-header">
		<h1 id="rpttype">Installation Reports</h1>
		<p class="lead">Laporan Hasil Instalasi <?php echo $objs->name . ' ' . $objs->address ;?></p>
		<div class="row padbot5">
			<div class="col-md-2 orgtext">Tanggal</div><div class="col-md-10" id="surveydate"><?php echo $objs->install_date;?></div>
		</div>
		<div class="row padbot5">
			<div class="col-md-2 orgtext">Pelaksana</div><div class="col-md-10"><?php echo $opr?></div>
		</div>
	</div><!-- page header end -->
	<h3>Data Pelanggan</h3>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Nama Pelanggan</div><div class="col-md-10" id="customername"><?php echo $objs->name;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Kontak</div><div class="col-md-10"><?php echo $objs->pic_name;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">No. Telp</div><div class="col-md-10"><?php echo $objs->pic_phone_area . ' ' . $objs->pic_phone;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Alamat</div><div class="col-md-10"><?php echo $objs->address;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Layanan</div><div class="col-md-10"><?php echo $objs->service;?></div>
	</div>
	<h3>Data Perangkat</h3>
	<?php foreach($routers as $router){?>
	<h4><?php echo $router->tipe;?></h4>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Nama Perangkat</div>
		<div class="col-md-10"><?php echo $router->tipe;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">MAC Board</div><div class="col-md-10"><?php echo $router->macboard;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">IP Public</div><div class="col-md-10"><?php echo $router->ip_public;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">IP Private</div><div class="col-md-10"><?php echo $router->ip_private;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">User</div><div class="col-md-10"><?php echo $router->user;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Password</div><div class="col-md-10"><?php echo $router->password;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Location</div><div class="col-md-10"><?php echo $router->location;?></div>
	</div>
	<?php }?>
	<?php foreach($pccards as $pccard){?>
	<h4><?php echo $pccard->name;?></h4>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">MAC PC Card</div><div class="col-md-10"><?php echo $pccard->macaddress;?></div>
	</div>
	<?php }?>



	<h3>Material</h3>

	<div class="row padbot10">
		<div class="table-responsive">
			<table class="table table-striped requirement">
				<thead>
					<tr class="orgtext">
						<th width="10%" class='center'>NO.</th>
						<th width="60%" class='center'>TERPAKAI</th>
						<th width="30%" class='center'>BANYAK/SATUAN</th>
					</tr>
				</thead>
				<tbody>
					<?php $c=0;?>
					<?php foreach($materials as $material){?>
					<?php $c+=1;?>
					<tr>
						<td><?php echo $c;?></td>
						<td><?php echo $material->tipe . ' ' . $material->name;?></td>
						<td><?php echo $material->name;?></td>						
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div><!-- table-responsive end -->		
	</div>








	<h3>AP Wifi</h3>
	<?php foreach($apwifis as $ap){?>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Tipe</div><div class="col-md-10"><?php echo $ap->tipe;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Security Key</div><div class="col-md-10"><?php echo $ap->security_key;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">ESSID</div><div class="col-md-10"><?php echo $ap->essid;?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Location</div><div class="col-md-10"><?php echo $ap->location;?></div>
	</div>
	<?php }?>
	<h3>Wireless Radio</h3>
	<?php foreach($wirelessradios as $wirelessradio){?>
		<div class="row padbot5">
		<div class="col-md-2 orgtext">Tipe</div><div class="col-md-10"><?php  echo $wirelessradio->tipe?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">IP AP</div><div class="col-md-10"><?php  echo $wirelessradio->ip_ap?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">ESSID</div><div class="col-md-10"><?php  echo $wirelessradio->essid?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Frekuensi</div><div class="col-md-10"><?php  echo $wirelessradio->freqwency?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Polarisasi</div><div class="col-md-10"><?php  echo $wirelessradio->polarization?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Signal</div><div class="col-md-10"><?php  echo $wirelessradio->signal?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Quality/CCQ</div><div class="col-md-10"><?php  echo $wirelessradio->quality?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Noise</div><div class="col-md-10"><?php  echo $wirelessradio->noise?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">User Radio</div><div class="col-md-10"><?php  echo $wirelessradio->user?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Password Radio</div><div class="col-md-10"><?php  echo $wirelessradio->password?></div>
	</div>
	<?php }?>
	<h3>Antenna</h3>
	<?php foreach($antennas as $antenna){?>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Lokasi Antena</div><div class="col-md-10"><?php  echo $antenna->location?></div>
	</div>
	<?php }?>
	<h3>Router</h3>
	<?php foreach($routers as $router){?>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">User Router</div><div class="col-md-10"><?php  echo $router->user?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Password Router</div><div class="col-md-10"><?php  echo $router->password?></div>
	</div>
	<div class="row padbot5">
		<div class="col-md-2 orgtext">Lokasi Router/Switch</div><div class="col-md-10"><?php  echo $router->location?></div>
	</div>
	<?php }?>
	<h3>Topologi Jaringan</h3>
	<?php foreach($imgtj as $tj){?>
	<?php $c = 1;?>
	<div class="row barow">
		<div class="row">
		<div class="col-md-12"><img class="img-responsive padbot10" src="<?php echo $tj->img;?>"  width=1600 height=1200 /></div>
		</div>
		<span class="row-footer"><?php echo $tj->description;?></span>
	</div>
	<?php }
	echo 'File VSD bisa didownload di bawah ' . count($topologivsdfiles).'<br />';
	foreach($topologivsdfiles as $file){
		echo '<a href="/install_requests/downloadtopologivsd/'.$file.'" class="vsdfile">'.$file.'</a>';
	}

	?>
	<h3>Konfigurasi AP</h3>
	<?php foreach($imgka as $ka){?>
		<?php $c = 1;?>
	<div class="row barow">
	<div class="row">
		<div class="col-md-12"><img class="img-responsive padbot10" src="<?php echo $ka->img;?>"  width=1600 height=1200 /></div>
		</div>
		<span class="row-footer"><?php echo $ka->description;?></span>
	</div>
	<?php }?>
	<h3>Konfigurasi Wireless Radio</h3>
	<?php foreach($imgwr as $wr){?>
		<?php $c = 1;?>
	<div class="row barow">
		<div class="row">
		<div class="col-md-12"><img class="img-responsive padbot10" src="<?php echo $wr->img;?>"  width=1600 height=1200 /></div>
		</div>
		<span class="row-footer"><?php echo $wr->description;?></span>
	</div>
	<?php }	?>
	<h3>Speedtest</h3>
	<?php foreach($imgst as $st){?>
		<?php $c = 1;?>
	<div class="row padbot10 barow">
		<div class="row">
		 <div class="col-md-12"><img class="img-responsive padbot10" src="<?php echo $st->img;?>"  width=1600 height=1200 /></div>
		 </div>
		 <span class="row-footer"><?php echo $st->description;?></span>
	</div>
	<?php }?>
	
	<h3>Dokumentasi Foto</h3>
	<?php foreach($imgdok as $df){?>
	
		<?php $c = 1;?>
	<div class="row padbot10 barow">
		<div class="row">
		<div class="col-md-12">
			<img class="img-responsive padbot10" src="<?php echo $df->img;?>"  width=1600 height=1200 />
		</div>
		</div>
		<span><?php echo $df->description;?></span>
	</div>
	<?php }?>
	<h3>Berita Acara</h3>
	<div class="row padbot10">
		<?php $c = 1;?>
		<?php foreach($bas as $ba){?>
			<div class="barow">
				<span class="row-header"><?php echo $c++ . '. ' . $ba->name;?></span>
				<div class="row">
					<div class="col-md-12">
						<img class="img-responsive padbot10" src="<?php echo $ba->img;?>"  width=1600 height=1200 />
					</div>
				</div>
				<span class="row-footer"><?php echo $ba->description;?></span>
			</div>

		<?php }	?>
	</div>
	<h3>Resume</h3>
	<div class="row padbot50">
		<div class="col-md-12">
			<?php echo $objs->resume;?>
		</div>
	</div>


	
	<h3>VAS</h3>
	<div class="row padbot50">
		<div class="col-md-12">
			<?php 
			foreach($client_vases as $vas){
				if($vas->implemented==='1'){
					$checked = ''?> &#9745;
				<?php
				}else{
					$checked = ''?> &#9746;
				<?php
				}
				echo $checked . $vas->name  . '<br />';
			}
			?>
		</div>
	</div>

	
	
	
	
	<?php
	switch($objs->status){
		case "1":
	?>
	<h3>Status Instalasi</h3>
	<div class="row padbot50">
		<div class="col-md-12">
			Selesai Dikerjakan
		</div>
	</div>	
	<?php
		break;
		case "0":
	?>
	<h3>Status Instalasi</h3>
	<div class="row padbot50">
		<div class="col-md-12">
			Belum Selesai
		</div>
	</div>	
	<?php
		break;
		case "":
	?>
	<h3>Status Instalasi</h3>
	<div class="row padbot50">
		<div class="col-md-12">
			Tidak Dapat Dikerjakan
		</div>
	</div>	
	<?php
	}
	?>
</div><!-- container end -->
<div id="btnHome">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ke Menu Utama</div>
<div class="downloadPDF" id="downloadPDF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Download PDF</div>
<!--<script type="text/javascript" src="/js/aquarius/TS/installs/installbyclient.js"></script>-->
<script type='text/javascript' src='/js/padilibs/padi.url.js'></script>
<script type='text/javascript' src='/js/aquarius/TS/installs/report.js'></script>

</body>
</html>

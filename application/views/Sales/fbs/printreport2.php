<html>
    <head>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" href="/asset/report/bootstrap-3.3.6.min.css">
		<link rel="stylesheet" href="/asset/jqueryui.1.12.0.css">
        <link rel="stylesheet" type="text/css" href="/asset/report/print3.css">
		<script src="/asset/report/jquery-1.12.0.min.js"></script>
		<script src="/asset/report/bootstrap-3.3.6.min.js"></script>
		<title>Form Berlangganan</title>
	</head>
    <body>
    <input type="hidden" id="clientsiteid" value="<?php echo $id;?>">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 subtitle">LAYANAN</div>
            </div>
            <div class="row">
                <div class="col-xs-6" id="service">
                    Padi Smart Value Up to 2 Mbps
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">Tanggal Aktifasi <span id="activationdate">18 September 2015</span></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">Periode Kontrak <span id="period1">18 September 2015</span> -  <span id="period2">30 September 2016</span></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 subtitle">BIAYA BERLANGGANAN</div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Biaya Setup
                </div>
                <div class="col-xs-8">
                    <span id="setupfee"></span><span id="setupfeeppnlabel"> + PPn = </span><span id="setupfeetotal"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Biaya Berlangganan Bulanan
                </div>
                <div class="col-xs-8">
                    <span id="monthlyfee"></span><span id="monthlyfeeppn"> + PPn = </span><span id="monthlyfeetotal"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Biaya Perangkat
                </div>
                <div class="col-xs-8">
                    <span id="devicefee"></span><span id="devicefeeppn"> + PPn = </span><span id="devicefeetotal"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Biaya Lainnya
                </div>
                <div class="col-xs-8">
                    <span id="otherfee"></span><span id="otherfeeppn"> + PPn = </span><span id="otherfeetotal"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 subtitle">PERSETUJUAN</div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    Dengan menandatangani Form Berlangganan ini, Pelanggan setuju untuk mematuhi beberapa ketentuan berikut:
                </div>
            </div>
            <div class="row bottomborder">
                <ol>
                    <li>Pelanggan memberikan konfirmasi atas keinginannya menggunakan layanan yang disediakan oleh PadiNET dan secara otomatis terikat dengan SYARAT DAN KETENTUAN BERLANGGANAN yang diberlakukan oleh PadiNET.</li>
                    <li>Form Berlangganan ini berfungsi dan memiliki kekuatan sebagaimana Kontrak Berlangganan, sesuai dengan periode yang tercantum dalam halaman 2</li>
                    <li>PadiNET akan melaksanakan kegiatan instalasi dan setup sesuai dengan layanan yang dipilih sebagaimana tertera di atas dan akan dituangkan kemudian dalan Berita Acara Aktivasi.</li>
                    <li>Pelanggan setuju bahwa Form Berlangganan bersama dengan Berita Acara Aktivasi dapat digunakan oleh PadiNET sebagai dasar penagihan.</li>
                    <li>Untuk layanan yang menggunakan media wireless dan layanan collocation, proses upgrade bisa dilakukan sewaktu-waktu mengikuti periode kontrak sebelumnya.</li>
                    <li>Downgrade hanya bisa dilaksanakan setelah layanan dan/atau perubahan terakhir layanan berjalan minimal 3 bulan</li>
                    <li>Downgrade yang dilaksanakan pada tahun pertama secara otomatis akan memperpanjang masa kontrak selama 12 bulan kedepan sejak dilaksanakannya downgrade</li>
                    <li>Upgrade layanan yang menggunakan media fiber optik dan satelit wajib dipertahankan sampai minimal kontrak 12 bulan berakhir.</li>
                    <li>Downgrade untuk layanan yang menggunakan media fiber optik dan satelit baru dapat dilaksanakan setelah minimal periode kontrak 12 bulan berjalan</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="row">Saya menyatakan bahwa form ini diisi dengan sebenar-benarnya dan saya bersedia untuk mengikuti segala persyaratan dan ketentuan yang ditetapkan PadiNET</div>
                </div>
                <div class="col-xs-6">
                    <div class="row">Autorisasi PadiNET</div>
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-4 topborder sidepad text-center">
                        <small>Tanda Tangan &amp; Nama Terang</small>
                        </div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-2 topborder sidepad text-center">
                        <small>Tanggal</small>
                        </div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-2 topborder sidepad text-center">
                        <small text-center>Stempel</small>
                        </div>
                        <div class="col-xs-1">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-5 topborder sidepad text-center">
                        <small>Tanda Tangan &amp; Nama Terang</small>
                        </div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-4 topborder sidepad text-center">
                        <small>Stempel PadiNET</small>
                        </div>
                        <div class="col-xs-1">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 subtitle">UNTUK PENGAJUAN INTERNAL</div>
            </div>
            <div class="row">
                <div class="col-xs-6 bottomborder">
                    <div class="row">&nbsp;</div>
                    <div class="row">&nbsp;</div>
                    <div class="row">&nbsp;</div>
                    <div class="row">
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-6 text-center"><small><u><span id="usernamex">&nbsp;</span></u></small></div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-2 text-center"></div>
                        <div class="col-xs-1">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-6 text-center"><small>Tanda tangan &amp; Nama AM</small></div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-1">&nbsp;</div>
                        <div class="col-xs-2 text-center"><small>Tanggal</small></div>
                        <div class="col-xs-1">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 bottomborder">
                    <div class="row leftborder">&nbsp;Keterangan:</div>
                    <div class="row leftborder">&nbsp;<span id="description"></span></div>
                    <div class="row leftborder">&nbsp;</div>
                    <div class="row leftborder">&nbsp;</div>
                    <div class="row leftborder">&nbsp;</div>
                </div>
            </div>
            <div class="row  thisfooter">
                <div class="col-xs-6">
                    <div class="row">Paraf Pelanggan</div>
                    <div class="row">&nbsp;</div>
                </div>
                <div class="col-xs-6 align-right">Confidential Hal 2</div>
            </div>
   		</div>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type="text/javascript" src="/js/aquarius/subscriptionforms/print.2.js"></script>
	</body>
</html>

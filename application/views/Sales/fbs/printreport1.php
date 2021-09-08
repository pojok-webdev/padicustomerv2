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
        <script type="text/javascript">
            var client_id=<?php echo $client_id;?>
        </script>

        <input type="hidden" id="clientsiteid" value="<?php echo $id;?>">
		<div class="container">
            <div class="row headerbranchaddress">
                <div class="col-xs-6 font12" style="vertical-align:middle;display:table-cell;">
                    <div class="row headerimage"><img src="/img/logo_padinet_small4.png" width=200px height="70px"></div>
                    <div class="row"><strong>Surabaya Head Office</strong></div>
                    <div class="row">Mayjend Sungkono 83, Surabaya 60242</div>
                    <div class="row">Ph. 031-5616330 Fax. 031 - 5616304</div>
                </div>
                <div class="col-xs-6 font10">
                    <div class="row"><strong>Jakarta Branch</strong></div>
                    <div class="row">Graha Sucofindo Lt.10, Jl Raya Pasar Minggu Kav 34 Jakarta Selatan 12780</div>
                    <div class="row">Ph. 021-791886/30 Fax. 021 - 79188602</div>
                    <div class="row"><strong>Malang Branch</strong></div>
                    <div class="row">Letjen S. Parman 21 Malang 65141</div>
                    <div class="row">Ph. 0341-404900 Fax. 0341 - 412115</div>
                    <div class="row"><strong>Bali Branch</strong></div>
                    <div class="row">Benoa Square 3rd floor</div>
                    <div class="row">Bypass Ngurah Rai 21A, Kedonganan 80361</div>
                    <div class="row">Ph. 0361-8957723 Fax. 0361 - 8957723</div>
                </div>
            </div>
            <div class="row expandtop10 bottomdoubleline1 font10">
                <div class="col-xs-6 ctitle">
                    <div class="row">
                    <strong>Form Berlangganan</strong>
                    </div>
                </div>
                <div class="col-xs-6 ctitle">
                <div class="row rightaligned">
                <strong>No. :<span id=fbid><?php echo $fb->nofb;?></span></strong>
                </div>
                </div>
            </div>
            <div class="row thick">&nbsp;</div>
            <div class="row"></div>
            <div class="row bordered">
                <div class="col-xs-12"><strong>Catatan</strong> : Untuk mewakili perusahaan / badan hukum , pengisian aplikasi wajib dilakukan oleh pejabat yang berwenang</div>
            </div>
            <div class="row">
                <div class="col-xs-2">Kategori</div>
                <div class="col-xs-2" id="cat-korporasi">&#9745;&nbsp;Korporasi</div>
                <div class="col-xs-4" id="cat-game">&#9744;&nbsp;Game Online</div>
                <div class="col-xs-2" id="cat-perorangan">&#9744;&nbsp;Perorangan</div>
                <div class="col-xs-4" id="cat-lain">&#9744;&nbsp;Lainnya</div>
            </div>
            <div class="row">
                <div class="col-xs-12 subtitle">DATA PERUSAHAAN</div>
            </div>
            <div class="row">
            <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-12"><strong>Nama Perusahaan / Pelanggan</strong></div>
            </div>
            <div class="row ubordered">
                <div class="col-xs-12"><span id="clientname"><?php echo $fb->name;?></span></div>
            </div>
            <div class="row ubordered">
                <div class="col-xs-12">
                    <div class="col-xs-12">&nbsp;</div>
                        <strong>Jenis Usaha</strong> 
                        <span id="businesstype"><?php echo $fb->businesstype;?></span>
                    <div class="col-xs-12">&nbsp;</div>
                </div>
            </div>
            <div class="row bordered">
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-12">Nomor Pendaftaran Perusahaan (Harap melampirkan SIUP dan NPWP)</div>
            </div>
            <div class="row">
                <div class="col-xs-2">
                <strong>SIUP</strong>
                </div>
                <div class="col-xs-10">
                <span id="siup"><?php echo $fb->siup;?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2">
                <strong>NPWP</strong> 
                </div>
                <div class="col-xs-10">
                <span id="npwp"><?php echo $fb->npwp;?></span>
                </div>
            </div>
            <div class="row borderbottom">
                <div class="col-xs-6"></div>
                <div class="col-xs-6 borderleft">&nbsp;</div>
            </div>
            <div class="row">
            <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-2">
                    <strong>Alamat</strong> 
                </div>
                <div class="col-xs-10">
                    <span id="clientaddress"><?php echo $clientsite->address;?></span>
                </div>
            </div>
            <div class="row ">
                <div class="col-xs-2">
                    <strong>Telp/Fax</strong> 
                </div>
                <div class="col-xs-10">
                    <span id="clientphone">
                        <?php echo $fb->telp;?>
                    </span>
                    <span id="clientfax">
                        <?php echo $fb->fax;?>
                    </span>
                </div>
            </div>
            <div class="row borderbottom">
                <div class="col-xs-6"></div>
                <div class="col-xs-6 borderleft">&nbsp;</div>
            </div>
            
            <div class="row borderbottom">
            <div class="col-xs-12"><i>Pemohon dan Penanggung Jawab (Harap melampirkan foto kopi kartu identitas)</i></div>
            </div>
            <div class="row borderbottom">
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12"><strong>Pemohon</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Nama</div>
                        <div class="col-xs-8" id="subscribername"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Jabatan</div>
                        <div class="col-xs-8" id="subscriberposition">Pemohon</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">No ID (KTP)</div>
                        <div class="col-xs-8" id="subscriber_id"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Telp/HP</div>
                        <div class="col-xs-8" id="subscriberphone"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Email</div>
                        <div class="col-xs-8" id="subscriberemail"></div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12"><strong>Penanggung Jawab (setara Direktur / Pemilik Usaha)</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Nama</div>
                        <div class="col-xs-8" id="respname"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Jabatan</div>
                        <div class="col-xs-8" id="respposition">Penanggung Jawab</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">No ID (KTP)</div>
                        <div class="col-xs-8" id="resp_id"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Telp/HP</div>
                        <div class="col-xs-8" id="respphone"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Email</div>
                        <div class="col-xs-8" id="respemail"></div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="row bottomborder">
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12"><strong>Untuk keperluan administrasi, PadiNET akan menghubungi</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Nama</div>
                        <div class="col-xs-8" id="admname"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Telp/HP</div>
                        <div class="col-xs-8" id="admphone"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Email</div>
                        <div class="col-xs-8" id="admemail"></div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12"><strong>Untuk setup teknis dan instalasi, PadiNET akan menghubungi</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Nama</div>
                        <div class="col-xs-8" id="technicianname"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Telp/HP</div>
                        <div class="col-xs-8" id="technicianphone"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Email</div>
                        <div class="col-xs-8" id="technicianemail"></div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="row bottomborder">
            <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12"><strong>Untuk penagihan, PadiNET akan menghubungi</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Nama</div>
                        <div class="col-xs-8" id="billingname"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Telp/HP</div>
                        <div class="col-xs-8" id="billingphone"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Email</div>
                        <div class="col-xs-8" id="billingemail"></div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12"><strong>Untuk support teknis 24 jam, PadiNET akan menghubungi</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Nama</div>
                        <div class="col-xs-8" id="supportname"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Telp/HP</div>
                        <div class="col-xs-8" id="supportphone"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">Email</div>
                        <div class="col-xs-8" id="supportemail"></div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
            </div>            
            <div class="row bottomborder lastfirstpage">
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12"><strong>Penagihan</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><strong><span id='accounttypenew'>&#9745;</span></strong> &nbsp; Account Baru</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><strong>
                            <span id='accounttypeexisting'>&#9744;</span></strong> &nbsp; Ditambahkan ke account yang telah ada
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12"><strong>Alamat Penagihan (diisi jika berbeda dengan alamat perusahaan/pelanggan)</strong></div>
                    </div>
                    <div class="row ">
                        <div class="col-xs-12" id="billaddress">Komplek Pergudangan Permata Gedangan Blok A / 16</div>
                    </div>
                    <div class="row ">&nbsp;</div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
                <div class="col-xs-6 leftborder">
                    <div class="row">
                        <div class="col-xs-12">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="row  thisfooter">
                <div class="col-xs-6">Paraf Pelanggan</div>
                <div class="col-xs-6 align-right">Confidential Hal 1</div>
            </div>
        </div>
		<script type="text/javascript" src="/js/padilibs/padi.url.js"></script>
		<script type="text/javascript" src="/js/aquarius/subscriptionforms/print.js"></script>
    </body>
</html>
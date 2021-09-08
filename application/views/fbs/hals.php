<html>
<head>
    <link rel='stylesheet' href='/css/fbs/hals.css' />
    <link rel='stylesheet' href='/css/fbs/hal_1.css' />
    <link rel='stylesheet' href='/css/fbs/hal_2.css' />
    <link rel='stylesheet' href='/css/fbs/hal_3.css' />
    <link rel="stylesheet" href="/css/fbs/print-css.css" media="print" />
    <link rel="stylesheet" href="/asset/jqueryui.1.12.0.css">
    <script src="/js/fbs/print.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/asset/rte/site.css">
    <link rel="stylesheet" href="/asset/rte/richtext.min.css">
    <script type="text/javascript" src="/asset/rte/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/asset/rte/jquery.richtext.js"></script>
    <script src="/asset/jqueryui.1.12.0.js"></script>
    <title>
        Print FB
    </title>
</head>
<body>
<div class='navigator'>
    <a href="/subscribeforms"><img src="/img/navigators/home-64x64.png" alt="Home" ></a>


    <span id="btnServiceEdit"><img src="/img/navigators/pencil.png" alt="" title="Edit Layanan (Versi Cetak)"></span>
    <span id="btnServiceAttachment"><img src="/img/navigators/clip.png" alt="" title="Edit Lampiran"></span>
    <span onclick="winPrint()"><img src="/img/navigators/printer-64x64.png" title="Cetak"></span>

</div>
<page size="A4" id="page1">
    <div class="logo">
        <div id="logo" >
        <img src="/img/logo_padinet_small4.png" height="75px" alt="">
        </div>
        <div id="headoffice">
            <p class="branch-name">Surabaya Head Office</p>
            <div class="branch-detail">
                <p>Mayjend Sungkono 83, Surabaya 60242</p>
                <p>Ph. 031-5616330 Fax. 031 - 5616304</p>
            </div>
        </div>

    </div>
    <div class="branchaddresses">
        <div id="branches">
            <div class="branches">
                <p class="branch-name">Jakarta Branch</p>
                <div class="branch-detail">
                    <p>Graha Sucofindo Lt.10, Jl Raya Pasar Minggu Kav 34</p>
                    <p>Jakarta Selatan 12780</p>
                    <p>Ph. 021-791886/30 Fax. 021 - 79188602</p>
                </div>
            </div>
            <div class="branches">
                <p class="branch-name">Malang Branch</p>
                <div class="branch-detail">
                    <p>Letjen S. Parman 21 Malang 65141</p>
                    <p>Ph. 0341-404900 Fax. 0341 - 412115</p>
                </div>
            </div>
            <div class="branches">
                <p class="branch-name">Bali Branch</p>
                <div class="branch-detail">
                    <p>Benoa Square 3rd floor</p>
                    <p>Bypass Ngurah Rai 21A, Kedonganan 80361</p>
                    <p>Ph. 0361-8957723 Fax. 0361 - 8957723</p>
                </div>
            </div>            
        </div>
    </div>
    <div class="formberlangganan">
        <div class="subheader1">
            <p>Form Berlangganan</p>
        </div>
    </div>
    <div class="noberlangganan">
        <div class="subheader1">
            <p>No: <?php echo $nofb;?></p>
        </div>
    </div>
    <hr class="hrs">
    <div class="headernote">
        <div id="headernotecontent">
            <span class="bold1">Catatan</span>
            <span>Untuk mewakili perusahaan / badan hukum , pengisian aplikasi wajib dilakukan oleh pejabat yang berwenang</span>
        </div>
    </div>
    <div class="categorydiv">
        <div id="categorylabel">
            <span class="categoryoptionlabel">Kategori</span>
        </div>
    </div>
    <div class="categorydiv">
        <div>
            <span class="categoryoptionlabel"><input type="checkbox" name="" id="" <?php echo $corporatecb;?> > Korporasi</span>
        </div>
    </div>
    <div class="categorydiv">
        <div>
            <span class="categoryoptionlabel"><input type="checkbox" name="" id="" <?php echo $gamecb;?> > Game Online</span>
        </div>
    </div>
    <div class="categorydiv">
        <div>
            <span class="categoryoptionlabel"><input type="checkbox" name="" id="" <?php echo $personalcb;?> > Perorangan</span>
        </div>
    </div>
    <div class="categorydiv">
        <div>
            <span class="categoryoptionlabel"><input type="checkbox" name="" id="" <?php echo $othercb;?> > Lainnya</span>
        </div>
    </div>
    <div class='rowheader'>
        <div>
            <span>DATA PERUSAHAAN</span>
        </div>
    </div>
    <div class="rowfield">
        <div>
            <span>Nama Perusahaan/Pelanggan</span>
        </div>
        <div>
            <?php echo $name;?>
        </div>
    </div>
    <hr class="hr">
    <div class="rowfield">
        <div>
            <span>Jenis Usaha</span>
        </div>
        <div>
            <?php echo $otherbusinesstype;?>
        </div>
    </div>
    <hr class="hr">
    <div class="rowfield">
        <div>
            <span>Nomor Pendaftaran Perusahaan (Harap melampirkan SIUP dan NPWP)</span>
        </div>
        <div class='font14'>
            SIUP: <?php echo $siup;?>
        </div>
        <div class='font14'>
            NPWP: <?php echo $npwp;?>
        </div>
        <div class='font14'>
            SPPKP: <?php echo $sppkp;?>
        </div>
    </div>
    <hr class="hr">
    <div class="rowfield">
        <div class='font14'>
            <span>Alamat, Telepon, dan Fax</span>
        </div>
        <div class='font14'>
            Alamat: <?php echo $address;?>
        </div>
        <div class='font14'>
            Telp/Fax: <?php echo $telp;?>/<?php echo $fax;?>
        </div>
    </div>
    <hr class="hr">
    <div class="rowfield">
        <div>
            <span>Pemohon dan Penanggung Jawab (Harap melampirkan fotokopi kartu identitas)</span>
        </div>
    </div>
    <hr class='fieldrowseparator'>
        <div class="leftdiv hasrightborder">
            <div class='rowfieldheader'>
                Pemohon
            </div>
            <div>
                <div class='leftfield'>Nama</div><div class="pic">: <?php echo humanize($subscriber->name);?></div>
            </div>
            <div>
                <div class='leftfield'>Jabatan</div><div class="pic">:  <?php echo $subscriber->position;?></div>
            </div>
            <div>
                <div class='leftfield'>No ID (KTP)</div><div class="pic">:  <?php echo $subscriber->idnum;?></div>
            </div>
            <div>
                <div class="leftfield">Telp/HP</div>
                <div class="xrightfield"></div><div class="pic">: <?php echo $subscriber->phone;?> </div>
            </div>
            <div>
                <div class='leftfield'>Email</div><div class="pic">: <?php echo strtolower($subscriber->email);?></div>
            </div>
        
        </div>
        <div class="rightdiv leftborder">
            <div class='rowfieldheader'>
                Penanggung Jawab (Setara Direktur atau Pemilik Usaha)
            </div>
            <div>
                <div class='leftfield'>Nama</div><div class="pic">: <?php echo humanize($resp->name);?></div>
            </div>
            <div>
                <div class='leftfield'>Jabatan</div><div class="pic">: <?php echo $resp->position;?></div>
            </div>
            <div>
                <div class='leftfield'>No ID (KTP)</div><div class="pic">: <?php echo $resp->idnum;?></div>
            </div>
            <div>
                <div class="leftfield">Telp/HP</div>
                <div class="pic">: <?php echo $resp->phone;?></div>
            </div>
            <div>
                <div class='leftfield'>Email</div><div class="pic">: <?php echo strtolower($resp->email);?></div>
            </div>

        </div>        
        <hr class="hr">
        <div class="leftdiv hasrightborder">
            <div class='rowfieldheader'>
                Untuk Keperluan Administrasi, PadiNET akan menghubungi
            </div>
            <div>
                <div class='leftfield'>Nama</div><div class="pic">: <?php echo humanize($adm->name);?></div>
            </div>
            <div>
                <div class='leftfield'>Jabatan</div><div class="pic">: <?php echo $adm->position;?></div>
            </div>
            <div>
                <div class="leftfield">Telp/HP</div>
                <div class="xrightfield pic">: <?php echo $adm->phone;?></div>
            </div>
            <div>
                <div class='leftfield'>Email</div><div class="pic">: <?php echo strtolower($adm->email);?></div>
            </div>

        </div>
        <div class="rightdiv leftborder">
            <div class='rowfieldheader'>
                Untuk setup teknis dan instalasi, PadiNET akan menghubungi
            </div>
            <div>
                <div class='leftfield'>Nama</div><div class="pic">: <?php echo humanize($teknis->name);?></div>
            </div>
            <div>
                <div class='leftfield'>Jabatan</div><div class="pic">: <?php echo $teknis->position;?></div>
            </div>
            <div>
                <div class="leftfield">Telp/HP</div>
                <div class="pic">: <?php echo $teknis->phone;?></div>
            </div>
            <div>
                <div class='leftfield'>Email</div><div class="pic">: <?php echo strtolower($teknis->email);?></div>
            </div>

        </div>
        <hr class="hr">
        <div class="leftdiv hasrightborder">
            <div class='rowfieldheader'>
                Untuk penagihan, PadiNET akan menghubungi
            </div>
            <div>
                <div class='leftfield'>Nama</div><div class="pic">: <?php echo humanize($billing->name);?></div>
            </div>
            <div>
                <div class='leftfield'>Jabatan</div><div class="pic">: <?php echo $billing->position;?></div>
            </div>
            <div>
                <div class="leftfield">Telp/HP</div>
                <div class="xrightfield pic">: <?php echo $billing->phone;?></div>
            </div>
            <div>
                <div class='leftfield'>Email</div><div class="pic">: <?php echo strtolower($billing->email);?></div>
            </div>

        </div>
        <div class="rightdiv leftborder">
            <div class='rowfieldheader'>
                Untuk support teknis 24 jam, PadiNET akan menghubungi
            </div>
            <div>
                <div class='leftfield'>Nama</div><div class="pic">: <?php echo humanize($support->name);?></div>
            </div>
            <div>
                <div class='leftfield'>Jabatan</div><div class="pic">: <?php echo $support->position;?></div>
            </div>
            <div>
                <div class="leftfield">Telp/HP</div>
                <div class="pic">: <?php echo $support->phone;?></div>
            </div>
            <div>
                <div class='leftfield'>Email</div><div class="pic">: <?php echo strtolower($support->email);?></div>
            </div>

        </div>
    <hr class="hr">


    <div class="accountypeandbilladdress">
            <div class='rowfieldheader'>
                Penagihan
            </div>
            <div class="clientAddress">
                <div><input type="checkbox" name="" id="" <?php echo $newaccountchecked;?>>Account Baru</div>
            </div>
            <div class="clientAddress">
                <div><input type="checkbox" name="" id="" <?php echo $existingaccountchecked;?>>Ditambahkan ke Account yang telah ada</div>
            </div>

        </div>
        <div class="accountypeandbilladdress leftborder">
            <div class='rowfieldheader'>
                Alamat Penagihan
            </div>
            <div class="clientAddress">
                <div><?php echo $billaddress;?></div><br><br>
            </div>

        </div>
    <hr class="hr">
    <div class="row documentcheck lastfirstpage">
                <div class="documentitem siup"> <?php echo $documentstatus['siup']?>  SIUP</div>
                <div class="documentitem npwp"> <?php echo $documentstatus['npwp']?>  NPWP</div>
                <div class="documentitem sppkp"> <?php echo $documentstatus['sppkp']?>  SPPKP</div>
                <div class="documentitem responsible"> <?php echo $documentstatus['ktp penanggungjawab']?>  KTP PENANGGUNG JAWAB</div>
                <div class="documentitem subscriber"> <?php echo $documentstatus['ktp pemohon']?>  KTP PEMOHON</div>
                <div class="documentitem skuasa"> <?php echo $documentstatus['surat kuasa']?>  SURAT KUASA</div>
            </div>

    <div id='footer'>
        <div class="parafandconfidential paraf">
            <div>
                <div class='footer'>Paraf Pelanggan</div>
            </div>

        </div>
        <div class="parafandconfidential confidential leftborder">
            <div>
                <div class='footer rightside' >Confidential Hal 1</div><br><br>
            </div>
        </div>
    </div>
</page>
<page size="A4" id='page2'>
    <div class='rowheader1st serviceheader'>
        <div>
            <span>LAYANAN</span>
        </div>
    </div>
    <div class="servicedata">
        <div>
            <span>
                <?php 
                    echo $humanreadable1 . ' ';
                ?>
            </span>
        </div>
    </div>
    <div class="perioddata">
        <div>
            <span class='kontraklabel'>Tanggal Aktivasi</span>
            <span class='kontrakvalue'>&#9;:&#9;<?php echo $activationdate?></span>
        </div>
        <div>
            <span class='kontraklabel'>Periode Kontrak</span>
            <span class='kontrakvalue'>&#9;&#9;:&#9; <?php echo $period1 . ' - ' . $period2;?></span>
        </div>
    </div>
    <div class='feeheader'>
        <div>
            <span>BIAYA BERLANGGANAN</span>
        </div>
    </div>
    <div >
        <div>
            <div class='leftfieldbiaya'>Biaya Setup</div>
            <div class='rightfieldbiaya'>: <?php echo $setupfeedpp;?></div>
        </div>
        <div>
            <div class='leftfieldbiaya'>Biaya berlangganan bulanan</div>
            <div class='rightfieldbiaya'>: <?php echo $monthlyfeedpp;?></div>
        </div>
        <div>
            <div class='leftfieldbiaya'>Biaya perangkat</div>
            <div class='rightfieldbiaya'>: <?php echo $devicefeedpp;?></div>
        </div>
        <div>
            <div class='leftfieldbiaya'>Biaya lainnya</div>
            <div class='rightfieldbiaya'>: <?php echo $otherfeedpp;?></div>
        </div>
    </div>

    <div class='agreementheader'>
        <div>
        <span>PERSETUJUAN</span>

        </div>
    </div>
    <div >
        <ol class='agreement'>
            <li>Pelanggan memberikan konfirmasi atas keinginannya menggunakan layanan yang disediakan oleh PadiNET dan secara otomatis terikat dengan SYARAT DAN KETENTUAN BERLANGGANAN yang diberlakukan oleh PadiNET</li>
            <li>Form berlangganan ini berfungsi dan memiliki kekuatan sebagaimana Kontrak Berlangganan, sesuai dengan periode yang tercantum dalam halaman 2</li>
            <li>PadiNET akan melaksanakan kegiatan instalasi dan setup sesuai dengan layanan yang dipilih sebagaimana tertera di atas dan akan dituangkan kemudian dalam Berita Acara Aktivasi</li>
            <li>Pelanggan setuju bahwa Form Berlangganan bersama dengan Berita Acara Aktivasi dapat digunakan oleh PadiNET sebagai dasar penagihan</li>
            <li>Untuk layanan yang menggunakan media wireless dan layanan collocation, proses upgrade bisa dilakukan sewaktu-waktu mengikuti periode kontrak sebelumnya</li>
            <li>Downgrade hanya dapat dilaksanakan setelah layanan dan / atau perubahan terakhir layanan berjalan minimal 3 bulan</li>
            <li>Downgrade hanya bisa dilaksanakan pada tahun pertama secara otomatis akan memperpanjang masa kontrak selama12 bulan ke depan sejak dilaksanakannya downgrade</li>
            <li>Upgrade layanan yang menggunakan media fiber optik dan satelit wajib dipertahankan sampai minimal kontrak 12 bulan berakhir</li>
            <li>Downgrade untuk layanan yang menggunakan media fiber optik dan satelit baru dapat diaksakanakan setelah minimal periode kontrak 12 bulan berjalan</li>
        </ol>
    </div>
    <hr>
    <div class='sign'>
        <p class='leftdiv'>Saya menyatakan bahwa form ini diisi dengan sebenar-benarnya dan saya bersedia untuk mengikuti segala persyaratan dan ketentuan yang ditetapkan oleh PadiNET</p>
        <p class='rightdiv'>Autorisasi PadiNET</p>
    </div>
    <div class='signx'>
        <div class='leftsignpart'>
            <span class='leftdivsmaller1 hasoverline'>Tanda Tangan & Nama Terang</span>
            <span class='leftdivsmaller2 hasoverline'>Tanggal</span>
            <span class='leftdivsmaller3 hasoverline'>Stempel</span>
        </div>
        <div class='rightsignpart'>
            <span class='rightdivsmaller1 hasoverline'>Tanda Tangan & Nama Terang</span>    
            <span class='rightdivsmaller2 hasoverline'>Stempel PadiNET</span>
        </div>
    </div>

    <div class='rowheaderx internalheader'>
        <div>
        <span>UNTUK PENGGUNAAN INTERNAL</span>

        </div>
    </div>



    <div class='mostbottom'>
        <div class='leftdiv2 hasbottomline'>
            <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
            <span class='leftdivsmaller1'>
                <span id='unholder'><?php echo $username;?></span>
                <span id='ttholder' class='hasoverline'>Tanda Tangan & Nama AM</span>
            </span>
            <span class='leftdivsmaller2 hasbottomline'>
                <span>&nbsp;</span>
                <span class='centered hasoverline'>Tanggal</span>
            </span>
        </div>
        <div class='verticalline'>
        <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
        </div>
        <div class='rightdiv2 hasbottomline hasleftline'>
            <span id='keteranganinternal' class='hasoverlinex'>Keterangan</span>
            <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
        </div>
    </div>
    <div id="vascheck" class='font10'>
        <?php foreach($vases as $vas){?>
            <?php $found = false;?>
            <?php foreach($clientvases as $cvas){?>
                
                <?php if($cvas->name==$vas->name){?>
                    <?php 
                        $found = true;
                    ?>
                <?php }?>
                <?php if(!$found){?>
                    <?php $kotak = '&#9633';?>
                <?php }else{?>
                    <?php $kotak = '&#8864';?>
                <?php }?>
                
            <?php }?>
            <?php echo $kotak . ' ' . $vas->name;?>
        <?php }?>
        </div>
    </div>

    <div id='footer'>
        <div class="leftdiv">
            <div>
                <div class='footer'>Paraf Pelanggan</div>
            </div>
        </div>
        <div class="frightdiv leftborder">
            <div>
                <div class='footer rightside' >Confidential Hal 2</div>
            </div>
        </div>
    </div>

</page>
<page size="A4" id='page3' class='font12'>
    <div id='attachment_header'>Lampiran</div>
    <div id='attachment'>
        <?php echo $humanreadable2;?>
    </div>
    <div id='footer'>
        <div class="leftdiv">
            <div>
                <div class='footer'>Paraf Pelanggan</div>
            </div>
        </div>
        <div class="frightdiv leftborder">
            <div>
                <div class='footer rightside' >Confidential Hal 3</div>
            </div>
        </div>
    </div>
</page>
<div id='dlgServiceEdit' title='Edit Service' style='display:none'>
    <div class='originservice'></div>
    <textarea name="hrs" id="hrs" cols="30" rows="10" class='myeditor'>
        <?php echo $humanreadable1;?>
    </textarea>
</div>
<div id='dlgServiceAttachment' title='Edit Lampiran' style='display:none'>
    <div class='originservice'></div>
    <textarea name="hrs2" id="hrs2" cols="30" rows="10" class='myeditor'>
        <?php echo $humanreadable2;?>
    </textarea>
</div>


<script>
(function($){
    console.log('jQuery invoked',$('.servicedata div span').text());
    $('#hrs').val(($('.servicedata div span').text()));
    $('#hrs').richText();
    $('#hrs2').richText();
    $('#btnServiceEdit').click(function(){
        $.ajax({
            url:'/fbs/restorehumanreadable1/<?php echo $nofb;?>',
            dataType:'json'
        })
        .done(function(res){
            console.log('restore data human readable',res);
            $('.originservice').html(res.map(function(x){
                console.log('X',x.srv);
                return (x.srv);
            }))
            .trigger('change');
            //$('#hrs').val(res).trigger('change');
            //hrs.val(res);
        })
        .fail(function(err){});
        $('#dlgServiceEdit').dialog({
            height:'auto',width:'500px',
            buttons:{
                'Update':function(){
                    $.ajax({
                    url:'/fbs/updatehumanreadable1',
                    type:'post',
                    data:{
                        humanreadable1:$('#hrs').val(),
                        nofb:'<?php echo $nofb;?>'
                    }
                })
                .done(function(res){
                    console.log('Res',res);
                    $('.servicedata div span').html(($('#hrs').val()));
                })
                .fail(function(err){
                    console.log('Err',err);
                });
                    $(this).dialog('close');
                },
                'Restore':function(){
                    console.log('NOFB','<?php echo $nofb;?>');
                    $.ajax({
                        url:'/fbs/restorehumanreadable1/<?php echo $nofb;?>',
                        dataType:'json'
                    })
                    .done(function(res){
                        console.log('restore data human readable',res);
                        
                        $('#hrs').val(res.map(function(x){
                            console.log('X',x.srv);
                            return (x.srv);
                        }))
                        .trigger('change');
                        //$('#hrs').val(res).trigger('change');
                        //hrs.val(res);
                    })
                    .fail(function(err){});
                },
                'Cancel':function(){
                    $(this).dialog('close');
                }
            }
        });
        console.log('Btn Service Edit invoked');
    });
    $('#btnServiceAttachment').click(function(){
        console.log('btnserviceattachment invoked');
        $.ajax({
            url:'/fbs/restorehumanreadable1/<?php echo $nofb;?>',
            dataType:'json'
        })
        .done(function(res){
            console.log('restore data human readable',res);
            $('.originservice').html(res.map(function(x){
                console.log('X',x.srv);
                return (x.srv);
            }))
            .trigger('change');
            //$('#hrs').val(res).trigger('change');
            //hrs.val(res);
        })
        .fail(function(err){});
        $('#dlgServiceAttachment').dialog({
            height:'auto',width:'500px',
            buttons:{
                'save':function(){
                    $.ajax({
                    url:'/fbs/updatehumanreadable2',
                    type:'post',
                    data:{
                        humanreadable2:$('#hrs2').val(),
                        nofb:'<?php echo $nofb;?>'
                    }
                    })
                    .done(function(res){
                        console.log('Res',res);
                        $('#attachment').html(($('#hrs2').val()));
                    })
                    .fail(function(err){
                        console.log('Err',err);
                        //$(this).dialog('close');
                    });
                    $(this).dialog('close');
                },
                'Restore':function(){
                    console.log('NOFB','<?php echo $nofb;?>');
                    $.ajax({
                        url:'/fbs/restorehumanreadable1/<?php echo $nofb;?>',
                        dataType:'json'
                    })
                    .done(function(res){
                        console.log('restore data human readable',res);
                        
                        $('#hrs2').val(res.map(function(x){
                            console.log('X',x.srv);
                            return (x.srv);
                        }))
                        .trigger('change');
                        //$('#hrs').val(res).trigger('change');
                        //hrs.val(res);
                    })
                    .fail(function(err){});
                },
                'close':function(){
                    $(this).dialog('close');
                }
            }
        });
    });
}(jQuery))
</script>

</body>
</html>
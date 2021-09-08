<html>
<head>
    <link rel='stylesheet' href='/css/fbs/a4.css' />
    <link rel='stylesheet' href='/css/fbs/hal2.css' />
    <link rel="stylesheet" href="/css/fbs/screen-css.css" media="all" />
    <link rel="stylesheet" href="/css/fbs/print-css.css" media="print" />
    <link rel="stylesheet" href="/css/fbs/screen-css.css" media="all" />
    <link rel="stylesheet" href="/css/fbs/print-css.css" media="print" />
    <link rel="stylesheet" href="/asset/jqueryui.1.12.0.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/asset/rte/site.css">
        <link rel="stylesheet" href="/asset/rte/richtext.min.css">
        <script type="text/javascript" src="/asset/rte/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/asset/rte/jquery.richtext.js"></script>


    <script src="/asset/jqueryui.1.12.0.js"></script>
    

<script src="/js/fbs/print.js"></script>
</head>
<div class='navigator'>
    <a href="/subscribeforms"><img src="/img/navigators/home-4x.png" alt="Home" ></a>
    <a href="/fbs/hal1/<?php echo $nofb;?>"><img src="/img/navigators/caret-left-4x.png" ></a>
    <span id="btnServiceEdit"><img src="/img/navigators/pencil-4x.png" alt=""></span>
    <span id="btnServiceAttachment"><img src="/img/navigators/document-4x.png" alt=""></span>
    <span onclick="winPrint()"><img src="/img/navigators/print-4x.png"></span>
</div>
<page size="A4">
    <div class='rowheader1st serviceheader'>
        <div>
            <span>LAYANAN</span>
        </div>
    </div>
    <div class="servicedata">
        <div>
        <span>
                <?php echo $humanreadable1;?>
        </span>
        </div>
    </div>
    <div class="perioddata">
        <div>
            <span class='kontraklabel'>Tanggal Aktivasi</span><span class='kontrakvalue'>&#9;:&#9;<?php echo $activationdate?></span>
        </div>
        <div>
            <span class='kontraklabel'>Periode Kontrak</span><span class='kontrakvalue'>&#9;&#9;:&#9; <?php echo $period1 . ' - ' . $period2;?></span>
        </div>
    </div>
    <div class='serviceheader feeheader'>
        <div>
            <span>BIAYA BERLANGGANAN</span>
        </div>
    </div>
    <div >
        <div class='fee'>
            <div class='leftfieldbiaya'>Biaya Setup</div>
            <div class='rightfieldbiaya'>: <?php echo $setupfeedpp;?></div>
        </div>
        <div class='fee'>
            <div class='leftfieldbiaya'>Biaya berlangganan bulanan</div>
            <div class='rightfieldbiaya'>: <?php echo $monthlyfeedpp;?></div>
        </div>
        <div class='fee'>
            <div class='leftfieldbiaya'>Biaya perangkat</div>
            <div class='rightfieldbiaya'>: <?php echo $devicefeedpp;?></div>
        </div>
        <div class='fee'>
            <div class='leftfieldbiaya'>Biaya lainnya</div>
            <div class='rightfieldbiaya'>: <?php echo $otherfeedpp;?></div>
        </div>
    </div>

    <div class='rowheader serviceheader'>
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
            <span class='leftdivsmaller2'>
                <span>&nbsp;</span>
                <span class='centered hasoverline'>Tanggal</span>
            </span>
        </div>
        <div class='verticalline'>
        <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
        </div>
        <div class='rightdiv2 hasbottomline'>
            <span id='keteranganinternal' class='hasoverlinex'>Keterangan</span>
            <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
        </div>
    </div>
    <div class="vascheck">
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
<page size="A4">
<div id='attachment_header'>Lampiran</div>
<div id='attachment'>
<?php echo $humanreadable2;?>
</div>
</page>
<div id='dlgServiceEdit' title='Edit Service' style='display:none'>
    <textarea name="hrs" id="hrs" cols="30" rows="10" class='myeditor'>
        <?php echo $humanreadable1;?>
    </textarea>
</div>
<div id='dlgServiceAttachment' title='Edit Lampiran' style='display:none'>
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
                    })
                    .done(function(res){
                        console.log('restore data human readable',res);
                        $('#hrs').val(res);
                        $('#hrs').val(res).trigger('change');
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
        $('#dlgServiceAttachment').dialog({
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
                        //$(this).dialog('close');
                    })
                    .fail(function(err){
                        console.log('Err',err);
                        //$(this).dialog('close');
                    });
                },
                'close':function(){
                    $(this).dialog('close');
                }
            }
        });
    });
}(jQuery))
</script>
</html>

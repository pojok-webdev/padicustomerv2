<?php
Class Padimailer extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function sampleparams(){
        return array(
            1=>array(
                'tanggalgangguan'=>"10 Maret 2021",
                'startgangguan'=>"Rabu, 12 Februari 2020 - 04.00 WIB  s/d 05.00 WIB",
                'jenisgangguan'=>"Maintenance BTS",
                'estimasi'=>'-+ 5-10 Menit'
            ),
            2=>array(
                'tanggalgangguan'=>"23 April 2020",
                'startgangguan'=>"Kamis, 23 April 2020",
                'jamgangguan'=>"00.01 WITA - 05.00 WITA",
                'downtime'=>"5 jam",
                'aktivitas'=>"Replace Battery dan UPS",
                'impact'=>"PRIMA MEDIA PROMOTAMA",
                'jenisgangguan'=>"Maintenance BTS",
                'estimasi'=>'-+ 5-10 Menit'
            )
            
        );
    }
    function index(){
        $params = $this->sampleparams();
        $i = 2;
        $template = array(
            1=>$this->notifikasigangguan($params[$i]),
            2=>$this->notifikasimaintenance($params[$i]),
            3=>$this->notifikasipenyelesaiangangguan(),
            4=>$this->notifikasiperubahanlayanan(),
            5=>$this->notifikasiselesailayanantrial(),
            6=>$this->notifikasistarttriallayanan(array('clientname'=>'Cocacola, PT'))
        );
        $this->sendmail(array('pw.prayitno@gmail.com'),$template[$i]['subject'],$template[$i]['content']);
    }
    function testlayout(){
        $params = $this->sampleparams();
        $i = 2;
        $template = array(
            1=>$this->notifikasigangguan($params[$i]),
            2=>$this->notifikasimaintenance($params[$i]),
            3=>$this->notifikasipenyelesaiangangguan(),
            4=>$this->notifikasiperubahanlayanan(),
            5=>$this->notifikasiselesailayanantrial(),
            6=>$this->notifikasistarttriallayanan(array('clientname'=>'Cocacola, PT'))
        );
        echo $template[$i]['content'];
    }
    function sendmail($recipients, $subject, $content) {
        //$config['smtp_host'] = $this->config->item("smtp_host");
        $config['smtp_host'] = "mail.padi.net.id";
        //$config['smtp_port']='465';
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('puji@padi.net.id','Padi Support');
        $recpt = implode(",", $recipients);
        $this->email->to($recpt);
        $this->email->bcc('puji@padi.net.id');
        $this->email->subject($subject);
        $this->email->message($content);
        if($this->email->send()){
            echo "Sukses";
        }else{
            echo $this->email->print_debugger();
        };
    }
    function notifikasigangguan($params){
        $txt = '<h4>Notifikasi Gangguan '.$params["tanggalgangguan"].' </h4>' ;
        $txt .= '<br />';

        $txt .= 'Kepada Pelanggan Yang Terhormat,';
        $txt .= '<br />';
        $txt .= '<br />';
        
        $txt .= 'Terima kasih atas kepercayaannya telah menggunakan jasa layanan internet kami. Bersama ini kami informasikan mengenai detail gangguan yang terjadi sebagai berikut : ';
        $txt .= '<br />';
        $txt .= '<br />';
        $txt .= '<table>';
        $txt .= '<tr><td>- Start Problem</td><td>: '.$params["startgangguan"].' </td></tr>';
        $txt .= '<tr><td>- Jenis Gangguan </td><td>: "'.$params["jenisgangguan"].'"</td></tr>';
        $txt .= '<tr><td>- Estimasi </td><td>: "'.$params["estimasi"].'"</td></tr>';
        $txt .= '</table>';
        $txt .= '<br />';
        $txt .= 'Kami mohon maaf sebesar-besarnya atas ketidaknyamanan yang terjadi. Silahkan menghubungi kami di (031-5616330) atau email ke support@padi.net.id atau via <i>WhatsApp Support PadiNET</i> di +62 899-1405-888 (Chat Only) apabila Bapak/Ibu membutuhkan informasi maupun bantuan lebih lanjut.';
        $txt .= '<br />';
        $txt .= '<br />';
    
        $txt .= 'Terima kasih,';
        $txt .= '<br />';
        $txt .= 'PadiNET Support';
        return array('subject'=>'Notifikasi Gangguan','content'=>$txt);
    }
    function notifikasimaintenance($params){
        $txt = '<strong>Notifikasi Maintenance - '.$params["tanggalgangguan"].'</strong>';
        $txt .= '<p>';

        $txt .= 'Kepada Pelanggan Yang Terhormat,';
        $txt .= '<br />';
        $txt .= '<br />';
        
        $txt .= 'Terima kasih atas kepercayaannya telah menggunakan jasa layanan kami.';
        $txt .= '<br />';
        
        $txt .= 'Bersama ini kami informasikan bahwa kami akan melakukan maintenance.';
        $txt .= '<br />';
        $txt .= '<br />';

        $txt .= 'Dengan detail sebagai berikut:';
        $txt .= '<br />';
        $txt .= '<table>';
        $txt .= '<tr><td>Hari / Tanggal </td><td>: '.$params["startgangguan"].'</td></tr>';
        $txt .= '<tr><td>Jam </td><td>: '.$params["jamgangguan"].'</td></tr>';
        $txt .= '<tr><td>Downtime </td><td>: '.$params["downtime"].'</td></tr>';
        $txt .= '<tr><td>Aktifitas </td><td>: '.$params["aktivitas"].'</td></tr>';
        $txt .= '<tr><td>Impact </td><td>: '.$params["impact"].'</td></tr>';
        $txt .= '<tr><td>Note </td><td>: Mohon dapat menginformasikan kepada kami apabila masih terdapat gangguan atau kendala pada koneksi internet di luar waktu yang telah kami informasikan.</td></tr>';
        $txt .= '</table>';
        $txt .= '<br />';
        
        $txt .= 'Kami mohon maaf sebesar-besarnya atas ketidaknyamanan yang akan terjadi. Silakan menghubungi kami melalui telepon di 031-5616330 atau email ke support@padi.net.id atau via <i>WhatsApp Support PadiNET</i> di +62 899-1405-888 (Chat Only) apabila Bapak/Ibu membutuhkan informasi maupun bantuan lebih lanjut.';
        $txt .= '<br />';
        
        $txt .= $this->footerinfo();

        return array('content'=>$txt,'subject'=>'Notifikasi Maintenance');
    }
    function notifikasipenyelesaiangangguan(){
        $txt = '<strong>Notifikasi Penyelesaian Ganggguan [RFO] - Problem 24 April 2020</strong>';
        $txt .= '<br />';
        $txt .= '<br />';
        $txt .= 'Kepada Pelanggan Yang Terhormat';
        $txt .= '<br />';
        $txt .= 'Sebelumnya kami mengucapkan terima kasih atas kepercayaannya telah menggunakan jasa dan layanan dari PadiNET. Bersama ini kami informasikan mengenai detail gangguan yang terjadi pada Jumat, 24 April 2020 sebagai berikut :';
        $txt .= '<br />';
            $txt .= '<table>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= ' Problem       </td><td>: AP BTS Problem';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= ' Start Problem </td><td>: Jumat, 24 April 2020 - 12.30 WIB (GMT +7)';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= ' End Problem   </td><td>: Jumat, 24 April 2020 - 12.40 WIB (GMT +7)';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= '   Downtime </td><td>: 10 menit';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= ' Root Cause    </td><td>: Kabel STP AP BTS bermasalah';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= ' Action        </td><td>: Penggantian kabel STP oleh tim terkait';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '<tr>';
            $txt .= '<td>';
            $txt .= ' Status        </td><td>: Up & Monitoring';
            $txt .= '</td>';
            $txt .= '</tr>';
            $txt .= '</table>';
            $txt .= '<br />';
            $txt .= 'Kami mohon maaf sebesar-besarnya atas ketidaknyamanannya yang terjadi. Silakan menghubungi kami melalui telepon di (031) - 5616330 atau email ke support@padi.net.id atau via WhatsApp Support PadiNET di +62 899-1405-888 (Chat Only) apabila Bapak/Ibu membutuhkan informasi maupun bantuan lebih lanjut.';
            $txt .= '<br />';
            
            $txt .= $this->footerinfo();
            return array('content'=>$txt,'subject'=>'Notifikasi Penyelesaian Gangguan');
    }
    function notifikasiperubahanlayanan(){
        $txt = '<strong>Notifikasi Perubahan Layanan - Atlantic Biru Raya</strong>';
        $txt .= '<br />';

        $txt .= 'Kepada Pelanggan Yang Terhormat,';
        $txt .= '<br />';
        
        $txt .= 'Kami informasikan mengenai perubahan layanan di Atlantic Biru Raya dengan detail sebagai berikut :';
        $txt .= '<br />';
        
        $txt .= '<table>';
        $txt .= '<tr><td>Tanggal </td><td>: 11 November 2020</td></tr>';
        $txt .= '<tr><td>Layanan awal </td><td>: Padi Enterprise Dedicated 3 Mbps</td></tr> ';
        $txt .= '<tr><td>Layanan saat ini </td><td>: Padi Enterprise Dedicated 5 Mbps</td></tr> ';
        $txt .= '</table>';
        $txt .= 'Silahkan dicoba kembali untuk koneksinya, apabila masih ada kendala atau butuh bantuan silahkan menghubungi kami kembali melalui telepon di (031) - 5616330 atau email ke support@padi.net.id dan WhatsApp ke nomor 089-914-058-88 (Chat Only)';
        $txt .= '<br />';
        $txt .= $this->footerinfo();
        return array('content'=>$txt,'subject'=>'Notifikasi Perubahan Layanan');
        }
        function notifikasiselesailayanantrial(){
            $txt = '<strong>Notifikasi Selesai Trial Layanan - Skyline Semesta (BSP Rungkut)</strong>';
            $txt .= '<br />';
            $txt .= 'Kepada Pelanggan Yang Terhormat,';
            $txt .= '<br />';
            $txt .= 'Kami informasikan mengenai trial layanan di <strong>Skyline Semesta (BSP Rungkut)</strong> pada hari ini (<strong>4 Oktober 2018</strong>), telah selesai.';
            $txt .= '<br />';
            $txt .= 'Dengan demikian, layanan telah kami kembalikan ke layanan awal.';
            $txt .= '<br />';
            $txt .= '<table>';
            $txt .= '<tr><td>Layanan trial </td><td>: <strong>IIX 1 Mbps</strong></td></tr>';
            $txt .= '<tr><td>Layanan awal (saat ini) </td><td>: <strong>IIX 2 Mbps</strong></td></tr>';
            $txt .= '</table>';
            $txt .= '<br />';
            $txt .= 'Kami nantikan feedback dari Bapak/Ibu terkait hasil trial layanan yang telah gunakan.';
            $txt .= '<br />';
            $txt .= 'Apabila Bapak/Ibu masih ada kendala atau butuh bantuan silahkan menghubungi kami kembali melalui telepon di (031) - 5616330 atau email ke support@padi.net.id dan WhatsApp ke nomor +628991405888 (Chat Only)';
            
            $txt .= $this->footerinfo();
            return array('content'=>$txt,'subject'=>'Notifikasi Selesai Layanan Trial');
        }
        function notifikasistarttriallayanan($params){
            $txt = '<strong>Notifikasi Trial Layanan - '.$params['clientname'].' - [tanggal<spasi>bulan<spasi>tahun]</strong>';
            $txt .= '<br />';
            $txt .= 'Kepada Pelanggan Yang Terhormat,';
            $txt .= '<br />';
            $txt .= 'Terima kasih telah menggunakan jasa dan layanan dari PadiNET.';
            $txt .= '<br />';
            $txt .= 'Bersama ini, kami informasikan mengenai trial layanan di [nama_pelanggan atau nama_site_pelanggan] dengan detail sebagai berikut :';
            $txt .= '<table>';
                $txt .= '<tr><td>Mulai Trial </td><td>: [tanggal<spasi>bulan<spasi>tahun] 3 Februari 2020</td></tr>';
                $txt .= '<tr><td>Layanan awal </td><td>: </td></tr>';
                
                $txt .= '<tr><td>Layanan trial </td><td>:</td></tr>';
                
                $txt .= '<tr><td>Selesai Trial </td><td>: 6 Februari 2020</td></tr>';
                $txt .= '</table>';
                $txt .= 'Silahkan dicoba kembali untuk koneksinya, apabila masih ada kendala atau butuh bantuan silahkan menghubungi kami kembali melalui telepon di (031) - 5616330 atau email ke support@padi.net.id dan WhatsApp ke nomor 089-914-058-88 (Chat Only)';
            
            $txt .= $this->footerinfo();
            return array('content'=>$txt,'subject'=>'Notifikasi Start Trial Layanan');

        }
    function footerinfo(){
        $txt = '<br />';
        $txt .= '<br />';
        $txt .= 'Demikian informasi yang dapat kami sampaikan. &nbsp;';
        $txt .= 'Terima kasih atas perhatian dan kerjasamanya.';
        $txt .= '<br />';
        $txt .= '<br />';
        $txt .= 'Best Regards, &nbsp;';
        $txt .= 'Support PadiNET';
        $txt .= '<br />';
        $txt .= '<br />';
        $txt .= '<span style="font-size:26px;">PT. Padi Internet</span>';
        $txt .= '<br />';
        $txt .= '<span style="font-size:18px;">JL. Mayjend Sungkono 83, Surabaya</span>';

        $txt .= '<table style="font-size:12px;font-family: Monospace;padding:0px;margin:0px;">';
        $txt .= '<tr style="padding-bottom:0px;margin-bottom:0px"><td>Phone </td><td>: 031- 5616330</td></tr>';
        $txt .= '<tr style="padding-bottom:0px;margin-bottom:0px"><td>Email </td><td>: support@padi.net.id</td></tr>';
        $txt .= '<tr style="padding-bottom:0px;margin-bottom:0px"><td>WhatsApp </td><td>: 0899-1405-888 (Chat Only)</td></tr>';
        $txt .= '<tr style="padding-bottom:0px;margin-bottom:0px"><td>Website </td><td>: www.padi.net.id</td></tr>';
        $txt .= '</table>';
        return $txt;
    }
}
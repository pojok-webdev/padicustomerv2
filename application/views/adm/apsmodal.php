<div id="dAddAP" class="modal hidex fade" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3><span id="penambahanaplabel">Penambahan AP</span></h3>
        </div>
        <div class="modal-body">
			<div class="row-fluid">
				<div class="span12">
					<div class="block-fluid without-head">
						<div class="row-form clearfix">
							<div class="span3">Nama</div>
							<div class="span9"><?php echo form_input('ap_name','','id="ap_name"');?></div>
						</div>
						<div class="row-form clearfix">
							<div class="span3">BTS</div>
							<div class="span9"><?php echo form_dropdown('bts_name',$btses,0,'id="bts_name"');?></div>
						</div>
						<div class="row-form clearfix">
							<div class="span3">IP Address</div>
							<div class="span9">
								<input type='text' name='ipaddress' id='ipaddress'>
							</div>
						</div>
						<div class="row-form clearfix">
							<div class="span3">Keterangan</div>
							<div class="span9"><input type="text" name="description" id="description" value=""/></div>
						</div>
						<div class="footer">
							<button class="btn closemodal" type="button" id='save_ap'>Simpan</button>
							<button class="btn closemodal update_ap" type="button" myid='update_ap'>Update</button>
							<button class="btn closemodal" type="button">Tutup</button>
						</div>
					</div>
				</div>
			</div>

        </div>
    </div>
<div id="dAddAP_" class="modal hidex fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Penambahan Wireless Board</h3>
	</div>
	<div class="modal-body">
	<div class="row-fluid">
	<div class="span3">
	<div class="block-fluid without-head">
	<div class="row-form clearfix">
	Tipe
	<div class="span12">
	<?php echo form_dropdown('tipe',$boards,'','id="tipe_wireless_radio" class="inp_wireless" type="select"');?>
	</div>
	</div>
	<div class="row-form clearfix">
	MacBoard
	<div class="span12"><input type="text" name="macboard" id="macboard_wireless_radio"  class="inp_wireless"value=""/></div>
	</div>
	<div class="row-form clearfix">
	Polarisasi
	<div class="span12">
	<?php echo form_dropdown('polarization',array('vertical'=>'vertical','horizontal'=>'horizontal'),'','id="polarization_wireless_radio" class="inp_wireless" type="select"');?>
	</div>
	</div>
	<div class="row-form clearfix">
	Noise
	<div class="span12">
	<input type="text" name="noise" id="noise"  class="inp_wireless"value=""/>
	</div>
	</div>
	</div>
	</div>
	<div class="span3">
	<div class="block-fluid without-head">
	<div class="row-form clearfix">
	BTS
	<div class="span12">
	<?php echo form_dropdown('bts',$btstowers,'','id="bts_wireless_radio" class="inp_wireless" type="select"');?>
	</div>
	</div>
	<div class="row-form clearfix">
	IP AP
	<div class="span12">
	<?php echo form_dropdown('ip_ap',array(),'','id="ip_ap_wireless_radio" class="inp_wireless" type="select"');?>
	</div>
	</div>
	<div class="row-form clearfix">
	IP Radio
	<div class="span12"><input type="text" name="ip_radio" id="ip_radio_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	<div class="row-form clearfix">
	IP Ethernet
	<div class="span12">
	<input type="text" name="ip_ethernet" id="ip_ethernet_wireless_radio" class="inp_wireless" value=""/>
	</div>
	</div>
	</div>
	</div>
	<div class="span3">
	<div class="block-fluid without-head">
	<div class="row-form clearfix">
	Kualitas/CCQ
	<div class="span12"><input type="text" name="quality" id="quality_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	<div class="row-form clearfix">
	Frekwensi
	<div class="span12"><input type="text" name="freqwency" id="freqwency_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	<div class="row-form clearfix">
	Throughput UDP
	<div class="span12"><input type="text" name="throughput_udp" id="troughput_udp_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	<div class="row-form clearfix">
	Throughput TCP
	<div class="span12"><input type="text" name="throughput_tcp" id="troughput_tcp_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	</div>
	</div>
	<div class="span3">
	<div class="block-fluid without-head">
	<div class="row-form clearfix">
	EssId
	<div class="span12"><input type="text" name="essid" id="essid_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	<div class="row-form clearfix">
	User
	<div class="span12">
	<input type="text" name="user" id="user_wireless_radio" class="inp_wireless" value=""/>
	</div>
	</div>
	<div class="row-form clearfix">
	Passwd
	<div class="span12">
	<input type="text" name="password" id="password_wireless_radio" class="inp_wireless" value=""/>
	</div>
	</div>
	<div class="row-form clearfix">
	Sinyal
	<div class="span12"><input type="text" name="signal" id="signal_wireless_radio" class="inp_wireless" value=""/></div>
	</div>
	</div>
	</div>
	</div>
	<div class="footer">
	<button class="btn closemodalparent2 savewr" type="button" id='savewirelessradio'>Simpan</button>
	<button class="btn closemodalparent2 updatewr" type="button" id='updatewirelessradio'>Update</button>
	<button class="btn closemodalparent2" type="button">Tutup</button>
	</div>
	</div>
</div>


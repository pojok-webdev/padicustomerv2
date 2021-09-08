<div id="addVasModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myAddVASModalLabel">Add VAS</h3>
    </div>    
    <div class="row-fluid">
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3">Name:</div>
                <div class="span9">
                    <?php echo form_dropdown('vases',$vases,0,'id="vases"');?>
                </div>
            </div>                       
        </div>
        <div class="dr"><span></span></div>
        <div class="block">
            <p>Pilih VAS untuk <span id="clientname"></span>.</p>
        </div>
    </div>    
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" id="saveVas">Save VAS</button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
<div id="addServiceModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myAddServiceModalLabel">Add Service</h3>
    </div>    
    <div class="row-fluid">
        <div class="block-fluid">
            <div class="row-form clearfix">
                <div class="span3">First name:</div>
                <div class="span9"><input type="text" value=""/></div>
            </div>
            <div class="row-form clearfix">
                <div class="span3">Last name:</div>
                <div class="span9"><input type="text" value=""/></div>    
            </div>                    
            <div class="row-form clearfix">
                <div class="span3">About:</div>
                <div class="span9"><textarea></textarea></div>
            </div>
        </div>
        <div class="dr"><span></span></div>
        <div class="block">
            <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet.</p>
        </div>
    </div>    
    <div class="modal-footer">
        <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Save updates</button> 
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>




<div id="dAddService" class="modal hide" role="dialog" title="Penambahan Layanan">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head servicemodal">
					<div class="row-form clearfix">
						<div class="span3">Kategori Layanan</div>
						<div class="span9">
							<?php echo form_dropdown("servicecategories",$servicecategory,1,"id='servicecategories' class='inp_fb' type='selectid'");?>
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="dsmartvalue">
						<div class="span3">Value:</div>
						<div class="span2">
							<?php echo form_dropdown("smartvalue",$smartvalues,0,"id='smartvalue'");?>
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="dbusiness">
						<div class="span3 subservice">Value:</div>
						<div class="span2">
							<?php echo form_dropdown("business",$businesses,0,"id='business'");?>
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="denterprise">
						<div class="span3">Up (Mbps):</div>
						<div class="span3">
						<input type="text" id='enterpriseupm' class="chooseupm">
						<input type="text" id='enterpriseupk' class="chooseupk"></div>
						<div class="span3 align-right">Down (Mbps):</div>
						<div class="span3">
						<input type="text" id='enterprisedownm' class="choosednm">
						<input type="text" id='enterprisedownk' class="choosednk">
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="dcolocation">
						<div class="span2 subservice">Value:</div>
						<div class="span1">Space:</div>
						<div class="span4">
							<select id="colospaces">
								<option>Desktop PC Server</option>
								<option>2 U</option>
								<option>4 U</option>
								<option>1/2 Rack</option>
								<option>Full Rack</option>
							</select>
						</div>
						<div class="span1 align-right">BW:</div>
						<div class="span4">
							<select id="colobw">
								<option>Up to 1 Mb</option>
								<option>Custom</option>
							</select>
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="dcustomcolo">
						<div class="span3">Up (Mbps):</div>
						<div class="span3">
						<input type="text" id='coloupm' class="chooseupm">
						<input type="text" id='coloupk' class="chooseupk"></div>
						<div class="span3 align-right">Down (Mbps):</div>
						<div class="span3">
						<input type="text" id='colodownm' class="choosednm">
						<input type="text" id='colodownk' class="choosednk">
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="diix">
						<div class="span2">Up (Mbps):</div>
						<div class="span4">
						<input type="text" id='iixupm' class="chooseupm">
						<input type="text" id='iikupk' class="chooseupk">
						</div>
						<div class="span2 align-right">Down (Mbps):</div>
						<div class="span4">
						<input type="text" id='iixdownm' class="choosednm">
						<input type="text" id='iikdownk' class="choosednk">
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="dlocalloop">
						<div class="span4 align-right">Value (Mbps):</div>
						<div class="span2">
						<input type="text" id='localloopm' class="chooseupm">
						</div>
						<div class="span2">
						<input type="text" id='localloopk' class="chooseupk">
						</div>
					</div>
					<div class="row-form clearfix hiddendiv" id="dpadicluster">
						<div class="span3">Value:</div>
						<div class="span4">
							<?php echo form_dropdown('pc',$pc,1,'id="pc"');?>
						</div>
					</div>
					<div class="row-form clearfix">
						<div class="span3" id="teststring" >Custom</div>
						<div class="span9">
							<textarea id='servicedescription'></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" value="0" id="upm" />
		<input type="hidden" value="0" id="upk" />
		<input type="hidden" value="0" id="dnm" />
		<input type="hidden" value="0" id="dnk" />
		<input type="hidden" value="0" id="upstring" />
		<input type="hidden" value="0" id="dnstring" />
		<input type="hidden" value="0" id="space" />
		<input type="hidden" value="0" id="BW" />
		<input type="hidden" value="" id="site_id" />
		<button class="btn btnclose" id="btnservicesave">Simpan</button>
		<button class="btn btnclose">Tutup</button>
	</div>
	<p></p>
</div>


<div id="dServiceDetailMega" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<input type="hidden" id="srcelement" value="" />
		<h3 id="myAddOtherFeeModalLabel">Pilihan Value dalam Mbps</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head">
				<?php $i = 0;?>
				<?php for($c=0;$c<10;$c++){?>
					<div class="row-form_ clearfix">
					<div class='span1'></div>
						<?php for($d=0;$d<10;$d++){?>
							<div class="span1">
								<button class="btn serval">
									<?php echo $values[$i++];?>
								</button>
							</div>
						<?php }?>
						<div class='span1'></div>
					</div>
				<?php }?>
				<div class="clearfix">
					<div class='span5'></div>
					<div class='span2'><button class="btn serval">100</button></div>
					<div class='span2'><button class="btn serval">200</button></div>
					<div class='span5'></div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="dServiceDetailKilo" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myAddOtherFeeModalLabel">Pilihan Value dalam Kbps</h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">
				<div class="block-fluid without-head">
				<?php $i = 128;?>
				<?php for($c=1;$c<=7;$c++){?>
					<div class="row-form_ clearfix">
						<div class="span5"></div>
							<div class="span2">
								<button  class="btn serval">
									<?php echo $i*$c;?>
								</button>
							</div>
						<div class="span5"></div>
					</div>
				<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>

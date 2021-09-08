    	<h1>Survey</h1>
		<form id="cariForm" name="cariForm" method="post" action="<?php echo base_url();?>index.php/back_end/survey_handler">
        <div class="search">
                Pencarian :
                <input type="text" value="" name="cari">
                <input id="btn_cari" type="submit" value="Cari" name="btn_cari">
        </div>
        <div class="content_isi">
        	<!--form id="adminForm" name="adminForm" method="post" action=""-->
            	<div class="toolbar">
                	<a href="<?php echo base_url(); ?>index.php/back_end/entry_survey/type/add">
                        <img width="32" height="32" border="0" src="<?php echo base_url();?>themes/<?php echo $this->setting['theme'];?>/images/add.png">
                        <br>
                        Tambah
                    </a>
                	<label>
                        <input type="image" class="btn_trash"  src="<?php echo base_url()?>themes/<?php echo $this->setting['theme'];?>/images/trash-big.png" value="remove" name="remove">
                        <br>
                        <span class="btn_trash_label" style="clear:both; display:block;"><?php echo $this->lang->line('delete');?></span>
                    </label>
                    <a style="float: right;" href="#">
                        <img width="32" height="32" border="0" src="<?php echo base_url();?>themes/<?php echo $this->setting['theme'];?>/images/reload.png">
                        <br>
                        Refresh
                    </a>
                </div>
                <table class="tabel" width="100%" cellspacing="0" cellpadding="2" border="0">
                	<thead>
                    	<tr>
                        	<th width="3%" align="center">
                                <input type="hidden" value="__default" name="boxchecked">
                                <input type="hidden" value="" name="task">
                                <input type="checkbox" onclick="checkAll(21);" value="" name="toggle">
                            </th>
                            <th width="15%" align="center">TANGGAL</th>
                            <th width="21%" align="center">MASALAH</th>
                            <th width="20%" align="center">PENYELESAIAN</th>
                            <th width="3%"> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						foreach($objs as $obj){
					?>
                    	<tr>
                        	<td align="center">
                            	<input id="cb1" type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $obj->id;?>" name="id[]">
                            </td>
                            <td><?php echo $obj->survey_date;?></td>
                            <td><?php echo $obj->problems;?></td>
                            <td><?php echo $obj->conclusion;?></td>
                            <td align="center"><a href='<?php echo base_url();?>index.php/back_end/entry_survey/type/edit/id/<?php echo $obj->id;?>'><img src="<?php echo base_url();?>themes/<?php echo $this->setting['theme'];?>/images/edit.png" /></a></td>
                        </tr>
                        <?php
							}
						?>
                    </tbody>
                </table>
            <!--/form-->
        </div>
		</form>
        
        <div class="paging">
            <p>Page : <?php echo $page;?>
            <i> Of </i><?php echo $page_count;?> . Total Records Found: <?php echo $total;?>
            </p>
            <?php echo $this->pagination->create_links();?>
        </div>
        <div id="footer"><?php echo $this->setting['footer_text'];?></div>            

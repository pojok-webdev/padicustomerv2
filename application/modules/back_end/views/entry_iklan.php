    	<h1><?php echo $this->lang->line('entry_advertise');?></h1>
  <div class="content_isi">
        	<form id="adminForm" name="adminForm" method="post" action="<?php echo base_url()?>index.php/back_end/entry_iklan_handler">
        	<?php 
        	echo form_hidden('type',$type);
        	echo form_hidden('id',$id);
        	?>
            	<div class="toolbar">
                	<label>
                        <input type="image" style="float: left; background: none;" src="<?php echo base_url()?>themes/<?php echo $this->setting['theme'];?>/images/save.png" value="save" name="save">
                        <br>
                        <span style="clear:both; display:block;">Simpan</span>
                    </label>
                	<label>
                        <input type="image" style="float: left; background: none;" src="<?php echo base_url()?>themes/<?php echo $this->setting['theme'];?>/images/cancel.png" value="cancel" name="cancel">
                        <br>
                        <span style="clear:both; display:block;">Batal</span>
                    </label>
                </div>
                <div id="form">
                	<fieldset style="margin-top:50px">
                    	<legend>Entry User</legend>
                        <table width="100%" cellspacing="2" cellpadding="2" border="0">
                        	<tbody>
                            	<tr>
                                    <td width="23%"><?php echo $this->lang->line('subject');?></td>
                                    <td width="1%">:</td>
                                    <td width="76%">
                                    <input id="subject" type="text" value="<?php echo $subject;?>" maxlength="20" size="20" name="subject">
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->lang->line('content');?></td>
                                    <td>:</td>
                                    <td>
                                    <textarea name="content" cols="40" id="content"><?php echo $content;?></textarea>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td><?php echo $this->lang->line('active');?></td>
                                    <td>:</td>
                                    <td>
                                    <?php echo form_radio('status','1',$status);?>
                                    Ya
                                    <?php echo form_radio('status','0',!$status);?>
                                    Tidak
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                
            </form>
        </div>
        <!--div class="paging">
            <p><svaluestrong>Page : 1
            <i> Of </i>1 . Total Records Found: 3</svaluestrong>
            </p>
        </div-->
        <div id="footer">KPI Call Center ?? 2012. All Rights Reserved.</div>            

<div class="breadLine">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo $breadcrumb[0]['url'];?>"><?php echo $breadcrumb[0]['title'];?></a> 
            <span class="divider">></span>
        </li>
        <li class="active"><?php echo $breadcrumb[1];?></li>
    </ul>
    <?php $this->load->view('adm/buttons');?>
</div>

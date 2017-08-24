<div class="page_header page_height"> 

    <img src="<?php echo base_url() ?>assets/images/hd_banner.jpg" class="img-responsive" alt="">
    <div class="container">
        <ul class="bcrumbs">
            <li><a href="<?php echo base_url() ?>home">Home</a> </li>
            <li>
            <?php
            	$explode = explode('|', $title);
            	echo $explode['0'];
            ?></li>
        </ul>
    </div>
</div>

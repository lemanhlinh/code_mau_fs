<?php
    global $tmpl,$config;
    $tmpl -> addStylesheet('owl.carousel','libraries/owl.carousel.2.0.0-beta.2.4/assets');
    $tmpl -> addScript('owl.carousel.min','libraries/owl.carousel.2.0.0-beta.2.4');
    
    $tmpl -> addStylesheet('default','blocks/productscat/assets/css');
    $tmpl -> addScript('default','blocks/productscat/assets/js');
?>
<div class="container">
    <?php if($config['hotline'] || $config['email']){ ?>
    <div class="sp-contact-info">
        <?php if($config['hotline']){ ?>
            <a class="sp-contact-phone" href="tel:<?php echo $config['hotline'] ?>">
                <i class="fa fa-phone"></i> 
                <?php echo $config['hotline'] ?>
            </a>
        <?php } ?>
        <?php if($config['email']){ ?>
            <a class="sp-contact-email" href="mailto:<?php echo $config['email'] ?>">
                <i class="fa fa-envelope"></i>
                <?php echo $config['email'] ?>
            </a>
        <?php } ?>
    </div><!-- END: sp-contact-info -->
    <?php } ?>
    <div id="owl-list" class="owl-carousel content-slider">
            <?php  for ($i=0;$i<count($list); $i++  ){
        		 $item = $list[$i];
        		$link = FSRoute::_("index.php?module=products&view=cat&id=".$item->id."&ccode=".$item-> alias);
            ?>
            <div class="ch-item row-item">
                <a rel="nofollow" class="newslist-item fl-left" href='<?php echo  $link;?>' title='<?php echo $item ->name;?>' style="background-image: url(<?php echo URL_ROOT.str_replace('/original/', '/original/', $item->image);?>);background-size: cover;">
    				<!--<img  class="img-responsive img_news" alt="" src="<?php //echo URL_ROOT.str_replace('/original/', '/original/', $item->image);?>" />-->
                    <div class="ch-info row-item" style="cursor: pointer;" onclick="location.href='<?php echo  $link;?>';" >
						<h3><?php echo $item ->name;?></h3>
					</div>
                </a>
                <h2 class="name-cat">
                    <a href='<?php echo  $link;?>' title='<?php echo $item ->name;?>'><?php echo $item ->name;?></a>
                </h2>
           </div>     
            <?php } ?>
    </div>  
</div>

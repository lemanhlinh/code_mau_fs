<?php
    global $tmpl; 
    $tmpl -> addStylesheet('owl.carousel','libraries/owl.carousel.2.0.0-beta.2.4/assets');
    $tmpl -> addScript('owl.carousel.min','libraries/owl.carousel.2.0.0-beta.2.4');
    
    $tmpl -> addStylesheet('lightslider','blocks/productslist/assets/css');
    $tmpl -> addScript('slideshow','blocks/productslist/assets/js');
?>

<div class="container">
      <div class="owl-carousel content-slider owl-list">
            <?php  for ($i=0;$i<count($list); $i++  ){
        		 $item = $list[$i];
        		$link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);
            ?>
                <a class="products-item col-item row-item fl-left" href='<?php echo  $link;?>' title='<?php echo $item ->name;?>'>
    				<img  class="img-responsive" alt="<?php echo $item ->name;?>" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image);?>" />
                    <h3 class="name"><?php echo getWord(12,$item->name);?> - <?php echo $item->code ?></h3>
                </a>
            <?php } ?>
      </div>         
</div>


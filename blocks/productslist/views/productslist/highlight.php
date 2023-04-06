<?php
    global $tmpl,$config; 
    $tmpl -> addStylesheet('highlight','blocks/productslist/assets/css');
    $total = count($list);
    $images = '';
    if($config['background_products']){
        $images = '<img  class="img-responsive" alt="" src="'.$config['background_products'].'" />';
    }
    echo $images;
?>

<?php if($total){ ?>
<div class='container'>
		<?php 
		for($i = 0; $i < count($list); $i ++ ){
			$item = $list[$i];
			$link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);
            $image_resized = URL_ROOT.str_replace('/original/', '/small/', $item->image);
            $image_large = URL_ROOT.str_replace('/original/', '/large/', $item->image);
			?>
            <?php if($i >= 0 && $i < 3 ){ ?>			
                <div class="products-item row-item item-<?php echo $i; ?>">
                    <div class="row-item">
    					<a class="img_news" href='<?php echo  $link;?>' title='<?php echo $item ->name;?>'>
    						<img  class="img-responsive" alt="" src="<?php echo $image_large;?>" />
    					</a>
    					<h3 class="name">
                            <a href='<?php echo $link ?>' title="<?php $item -> name ?>" ><?php echo getWord(16,$item->name);?></a>
                        </h3>
                    </div>
                </div><!--  END: .products-item -->
             <?php } else{ ?>
                <div class="products-item row-item hide">
					<a class="img_news" href='<?php echo  $link;?>' title='<?php echo $item ->name;?>'>
						<img class="img-responsive" alt="" src="<?php echo $image_large;?>" />
					</a>
    				<h3 class="name">
                        <a href='<?php echo $link ?>' title="<?php $item -> name ?>" ><?php echo getWord(15,$item->name);?></a>
                    </h3>
                </div><!--  END: .products-item -->
            <?php } ?>   
		<?php } ?>
</div>
<?php } ?>

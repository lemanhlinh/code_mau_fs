<?php
global $tmpl; 
$tmpl -> addStylesheet('highlight','blocks/productslist/assets/css');

?>
<div class='block_style_view row-item'>
		<?php 
		for($i = 0; $i < count($list); $i ++ ){
			$item = $list[$i];
			$link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);
        ?>			
		  <a class="item-view fl-left plm pvm <?php echo $i==(count($list)-1)? 'item-last':'' ?>" href="<?php echo $link; ?>" title="<?php echo $item -> title; ?>"><?php echo getWord(12,$item -> title); ?></a>
	   <?php } ?>
</div>	

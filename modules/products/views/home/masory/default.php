	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('cat_masory','modules/'.$this -> module.'/assets/css');
	$tmpl -> addScript('cat_masory','modules/'.$this -> module.'/assets/js');
//	$tmpl -> addScript('jquery-migrate-1.0.0','libraries/jquery','top');
	// $tmpl -> addScript('masonry.pkgd','libraries/jquery/masonry/dist/','top');
	// $tmpl -> addScript('cat_masory','modules/'.$this -> module.'/assets/js','top');
	// $tmpl -> addScript('follow','templates/default/js','top');
	?>
<div class='product-cat'>
		<h1><span><?php echo FSText::_('Tất cả các sản phẩm'); ?></span></h1>
		<div class="block_products_subcat  block ">
			 <?php  $tmpl -> load_direct_blocks('products_subcat'); ?>
		 </div>

    	<?php include_once 'default_vertical.php';?>
</div>

<input type="hidden" value="<?php echo FSInput::get ( 'filter' ); ?>" id="filter">
<input type="hidden" value="<?php echo count($list); ?>" id="pagecurrent">
<input type="hidden" value="<?php echo $total; ?>" id="total_record">

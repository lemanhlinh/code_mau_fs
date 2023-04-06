<?php 
global $tmpl,$config; 
$tmpl -> addStylesheet('cat','modules/products/assets/css');
//$tmpl -> addScript('news_cat','modules/products/assets/js');
$keyword = FSInput::get('keyword');
$page = FSInput::get('page');
$title = 'Tìm kiếm với từ khóa "'.$keyword.'"';
	if(!$page)
		$tmpl->addTitle( $title);
	else 
		$tmpl->addTitle( $title.' - Trang '.$page);
		
    $total = count($list);
    
    $str_meta_des = $keyword;
    
    for($i = 0; $i < $total ; $i ++ ){
        $item = $list[$i];
        $str_meta_des .= ','.$item -> name ;
    }
	$tmpl->addMetakey($str_meta_des);
	$tmpl->addMetades($str_meta_des);
	$Itemid = 6;
    
    $total_news_list = count($list);
?>

<section class="products_home row-item ">
	<h1 class="title-module">
        <span><?php echo FSText::_('Kết quả tìm kiếm cho từ khóa').' "'.$keyword.'"'; ?></span>
    </h1>

	<div class="productslist row-item">
            <div class="row">
            	<?php if($total_news_list){?>
        		<?php $i=0; foreach ($list as $item) {?>
            		<?php $link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id)?> 
                    <div class="item-product col-sm-3 col-xs-6">
                        <a class="products-item col-item row-item fl-left" href='<?php echo  $link;?>' title='<?php echo $item ->name;?>'>
                            <h3 class="col-img <?php echo $item->is_new? 'col-new':'' ?>">
            				    <img  class="img-responsive img_news" alt="" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image);?>" />
                                <p class="title-pro"><?php echo getWord(12,$item->name);?></p>
                            </h3>
            				<p class="fl-left summary-pro"><?php echo getWord(20,$item -> summary);?></p>
                            <span class="view-all" href="<?php echo $link; ?>" title="<?php echo FSText::_('Chi tiết'); ?>"><?php echo FSText::_('Chi tiết'); ?></span>
                        </a>
                    </div><!-- END: .item-product -->  
                <?php echo ($i+1)%4==0? '<div class="clearfix"></div>':'' ?>   
                <?php $i++; } ?>
                <?php } ?>
        </div>
        <div class="clearfix"></div>
        <?php 
		if($pagination){
            echo $pagination->showPagination(3);
		} else {
			echo "Không có kết quả nào cho từ khóa <strong>".$keyword."</strong>";
		}
		 ?>
    </div><!-- END: .item-page-cat -->
    
</section><!-- END: .products_cat -->

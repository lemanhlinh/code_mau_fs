<?php 
global $tmpl; 
$tmpl -> addStylesheet('cat','modules/news/assets/css');
$tmpl -> addScript('news_cat','modules/products/assets/js');
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
        $str_meta_des .= ','.$item -> title;
    }
	$tmpl->addMetakey($str_meta_des);
	$tmpl->addMetades($str_meta_des);
	$Itemid = 6;
?>
<?php
?>
	<div class='news_search new_cat'>
	    <h1 class="img-title-cat page_title">
	      <span><?php echo FSText::_('Kết quả tìm kiếm cho từ khóa').' "'.$keyword.'"'; ?></span>
	    </h1>
		<div class="wapper-content-page">
				<?php 
			if($total_list){
				for($i = 0; $i < $total_list; $i ++){
					$news = $list[$i];
					$link_news = FSRoute::_("index.php?module=news&view=news&id=".$news->id."&code=".$news->alias."&ccode=".$news-> category_alias."&Itemid=$Itemid");
			?>
			<div class='item'>
				<div class="news_title">
					<h2><a href="<?php echo $link_news; ?>" title="<?php echo htmlspecialchars(@$news->title); ?>"><?php echo htmlspecialchars(@$news->title); ?></a></h2>
				</div>
				<div class="news_datetime">
					<?php echo date('F d,Y',strtotime($news -> created_time)); ?>
				</div>
				<div class='frame_img_news'>
					<a class='item-img' href="<?php echo $link_news; ?>">
						<img  class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $news->image); ?>" alt="<?php echo htmlspecialchars(@$news->title); ?>" />
					</a>
				</div>
					<div class="news_sum">
						<?php echo getWord(50,$news->summary);?>
				</div>
				<div class="news_more">
					<div class="news_coment"><?php echo formatNumber($news->comments_total); ?> Comments</div>
					<div class="addthis_toolbox addthis_default_style addthis_20x20_style" addthis:url="<?php echo $link_news;?>" addthis:title="<?php echo $news->title;?>" addthis:description="<?php echo $news->title;?>"> 
						<a class="addthis_button_facebook"></a>
						<a class="addthis_button_google_plusone_share"></a>
						<a class="addthis_button_twitter"></a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<?php 
				}
				if($pagination) echo $pagination->showPagination(3);
			} else {
				echo "Không có kết quả nào cho từ khóa <strong>".$keyword."</strong>";
			 }
			 ?>
		</div>
	    <div class="clear"></div>
	</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};var addthis_config = { data_track_clickback: false} </script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e7b595768f6e688"></script>
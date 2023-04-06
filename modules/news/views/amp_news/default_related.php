<!--	RELATE CONTENT		-->
<?php
	$total_content_relate = count($relate_news_list);
	if($total_content_relate){ ?>
	       <h4 class="relate_title">
            <span><?php echo FSText::_('Tin cùng chuyên mục'); ?></span>
         </h4>
         <div class="relate_cat row">
            <?php
        			for($i = 0; $i < $total_content_relate; $i ++){
        			$item = $relate_news_list[$i];
        			$link = FSRoute::_('index.php?module=news&view=news&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
							$image_resized = URL_ROOT.str_replace('/original/', '/large/', $item->image);
        		?>
						<div class="col-sm-3 col-xs-12">
							<a href="relate_content" href='<?php echo $link;?>' title='<?php echo $item ->title;?>' >
								<img class="img-responsive" alt="<?php echo $item->title; ?>" src="<?php echo $image_resized; ?>"  />
								<h3><?php echo $item->title ?></h3>
							</a>
						</div>
            <?php } ?>
         </div>
<?php } ?>
<!--	end RELATE CONTENT		-->

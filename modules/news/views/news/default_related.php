<!--	RELATE CONTENT		-->
<?php
	$total_content_relate = count($relate_news_list);
	if($total_content_relate){ ?>
	     <h4 class="relate_title">
            <span><?php echo FSText::_('Có thể bạn quan tâm'); ?></span>
         </h4>
         <div class="relate_cat row">
            <?php
        			for($i = 0; $i < $total_content_relate; $i ++){
        			$item = $relate_news_list[$i];
        			$link = FSRoute::_('index.php?module=news&view=news&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
							$image_resized = URL_ROOT.str_replace('/original/', '/small/', $item->image);
        		?>
                <div class="col-sm-3 col-xs-12 col-lg-12">
                      <div class="newslist-item" >
                            <a class="item-image" href='<?php echo  $link;?>' title='<?php echo $item ->title;?>'>
                                <img class="img-responsive" alt="" src="<?php echo $image_resized;?>" />
                            </a>
                		  
                          <div class="row-item item-content">
                    		  <h2 class="title">
                                <a class="" href='<?php echo  $link;?>' title='<?php echo $item ->title;?>'>
                                    <?php echo getWord(15,$item->title);?>
                                </a>
                              </h2>
                              <summary class="summary"><?php echo getWord(25,$item -> summary);?></summary>
                          </div>
                      </div><!--  END: .newslist-item -->
                </div>
            <?php } ?>
         </div>
<?php } ?>
<!--	end RELATE CONTENT		-->

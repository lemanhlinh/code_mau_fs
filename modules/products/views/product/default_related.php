<!--	RELATE CONTENT		-->
<?php
	$total_content_relate = count($relate_products_list);
	if($total_content_relate){ ?>
       <h3 class="relate_title">
            <span><?php echo FSText::_('Sản phẩm tương tự'); ?></span>
       </h3>
       <div class="row">    
        <?php 
			for($i = 0; $i < $total_content_relate; $i ++){
			$item = $relate_products_list[$i]; 
			$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
		?>	
            <div class="col-xs-4">		
                    <a class="col-item fl-left" href='<?php echo  $link;?>' title='<?php echo $item ->name;?>'>
                        <h3 class="col-img <?php echo $item->is_new ==1 ? 'col-new':'' ?>">
    					   <img  class="img-responsive" alt="" src="<?php echo URL_ROOT.str_replace('/original/', '/resized/', $item->image);?>" />
                           <p class="title-pro"><?php echo getWord(16,$item->name); ?></p>
                        </h3>
                    </a><!--  END: .newslist-item -->
             </div> 
             <?php echo ($i+1)%4==0? '<div class="clearfix"></div>':'' ?>      
		<?php } ?>
        </div>
<?php } ?>
<!--	end RELATE CONTENT		-->

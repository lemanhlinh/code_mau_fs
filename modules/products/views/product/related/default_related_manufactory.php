<?php //$tmpl -> addStylesheet('related','modules/'.$this -> module.'/assets/css');?>
<?php if($list_related_manufactory && count($list_related_manufactory)){?>
        <?php $tmp = 0; ?>
    	<?php foreach($list_related_manufactory as $item){ ?>
            <?php $tmp++; ?>
    		<?php $link     = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&id='.$item -> id.'&cid='.$item->category_id.'&ccode='.$item->category_alias.'&Itemid='.$Itemid);?>
    			<a class="item-manufactory item-products" href="<?php echo $link;?>" title='<?php echo $item->name;?>'>		
                <?php if($item->image){?>
    				<?php $image_small = str_replace('/original/', '/resized/', $item->image); ?>
    					<img class="img-responsive" alt="<?php echo $item->name;?>" src="<?php echo URL_ROOT.$image_small;?>" />
    			<?php }?>
                    <h3 class="title-pro col-item"><?php echo getWord(12,$item->name);?></h3>
                    <p class="price_old col-item"><?php echo $item->price? format_money($item->price_old,'đ'):'&nbsp;'; ?></p>
                    <p class="discount col-item"><?php echo $item->price? format_money($item->price,'đ'):format_money($item->price_old,'đ'); ?></p>
                </a><!-- END: .item-manufactory -->
    	<?php }//end: foreach($list as $item) ?>
<?php } ?>

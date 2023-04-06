<?php
    global $tmpl; 
    $tmpl -> addStylesheet('highlight','blocks/newslist/assets/css');
?>

<?php if(count($list)){ ?>
<div class='container'>
    <div class="row">
	<?php  for ($i=0;$i<count($list); $i++  ){?>
		<?php $item = $list[$i];?>
		<?php $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);?>
        <div class="col-xs-6 col-sm-3">			
        	<div class="new-item fl-left" >
                <a class="item-image" href='<?php echo  $link;?>' title='<?php echo $item ->title;?>'>
        		  <img class="img-responsive fl-left" src='<?php echo URL_ROOT.str_replace('/original/','/large/',$item -> image);?>' alt="<?php echo $item -> title;?>"/>
                </a>
                <h3 class="title">
                    <a href='<?php echo  $link;?>' title='<?php echo $item ->title;?>'><?php echo getWord(12,$item->title);?></a>
                </h3>
                <p class="new-summary"><?php echo getWord(20,$item->summary) ?></p>	
        	</div>
        </div>    	
	<?php } ?>
    </div>
</div>
<?php } ?>

<?php
    global $tmpl;
    $tmpl -> addScript('carousel','blocks/library/assets/js');
    $tmpl -> addScript('default','blocks/library/assets/js');
    $tmpl -> addStylesheet('default','blocks/library/assets/css');
?>
<div class="container block-library">
    <div class="libraries-tabs" id="libraries-tab" >
        <?php $i =0; foreach(@$array_cats as $item){ ?>
            <a data-id="libraries-<?php echo $item->id ?>" class="<?php echo $i == 0? 'first-child active':'' ?>" href="#profile-<?php echo $item->id ?>">
                <?php echo str_replace('Thư viện', '', $item->name); ?>
            </a>
        <?php $i++; } ?>
        <div class="clear"></div>
    </div>
    <div class="tab-libraries">
        <?php $k =0; foreach($array_cats as $value){ ?>
        <div class="tab-pane <?php echo $k == 0? 'active':'' ?>" id="libraries-<?php echo $value->id?>">
            <div class="libraries-carousel libraries<?php echo $k;?>-carousel" >
            <?php if(count($array_by_cat[$value->id])){ ?>
                <ul>
                <?php
                for($j = 0; $j < count($array_by_cat[$value->id]); $j ++ ){
                    $item = $array_by_cat[$value->id][$j];
                     $link = FSRoute::_("index.php?module=libraries&view=libraries&id=".$item->id."&code=".$item->alias);
                    $image_resized = URL_ROOT.str_replace('original','/resized/',$item->image);
                    ?>
                    <li>
                        <a href="<?php echo $link ?>"><img onerror="javascript:this.src='<?php echo URL_ROOT.'images/no-images.png' ?>'" src="<?php echo $item->image;?>" alt="" /></a>
                        <a href="<?php echo $link ?>"><span><?php echo $item->name;?></span></a>
                    </li>
                <?php } ?>
                <img src="/blocks/library/assets/images/left.png" class="left">
                <img src="/blocks/library/assets/images/right.png" class="right">
                </ul>
            <?php } ?>
            </div>
        </div>
        <?php $k++;  } ?>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

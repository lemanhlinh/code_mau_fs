<?php 
global $config,$tmpl;
$tmpl -> addStylesheet('owl.carousel','blocks/video/assets/css');
$tmpl -> addStylesheet('slidervideo','blocks/video/assets/css');
$tmpl -> addScript('owl.carousel.min','blocks/video/assets/js','top');
$tmpl -> addScript('slider-home','blocks/video/assets/js','top');
?>
<div class="slider-home-top clearfix">
    <div class="title-video-other">
        <span><?php echo FStext::_("Video khác");?></span>
        <div class='hr-top'></div>
    </div>
    <div id="slider-full">
        
    <?php 
        if(!empty($data)){
//            var_dump($data); die;
            foreach ($data as $value_block) {
            $link_img=  str_replace("original", "resized", $value_block->image);
    ?>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        <div class="item-slider-video">
            <div class="image">
                    <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>">
                        <img src="<?php echo URL_ROOT.$link_img; ?>" alt="<?php echo $value_block->name;?>" />
                    </a>
                <a title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><img class="btn-play-vd" src="<?php echo URL_ROOT."modules/image/assets/images/play.png" ?>" alt="play" /></a>
                </div>
                <a class="title" title="<?php echo $value_block->name;?>" href="<?php echo FSroute::_("index.php?module=image&view=video&task=detail&code=$value_block->alias&id=$value_block->id") ?>"><?php echo fsstring::cutString($value_block->name,48);?></a>
        </div>
        
    <?php     
            }   
        }
    ?> 
    </div><!-- end .slider-full -->
</div>
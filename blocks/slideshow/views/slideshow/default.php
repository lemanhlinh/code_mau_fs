<?php
global $tmpl, $config;
?>
<?php $i = 0; ?>
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-left: 0px;">
    <!-- Carousel indicators -->
    <!--    <ol class="carousel-indicators">-->
    <!--        --><?php //foreach ($slideshow as $item) { ?>
    <!--            --><?php //if ($item->type == 1) { ?>
    <!--                --><?php //if ($item->image) { ?>
    <!--                    <li data-target="#myCarousel" data-slide-to="--><? //= $i ?><!--" class="-->
    <?php //if($i==0) echo 'active'?><!--"></li>-->
    <!--                --><?php //} ?>
    <!--            --><?php //}
    //            $i++;
    //        } ?>
    <!--    </ol>-->
    <!-- Wrapper for carousel items -->
    <div class="carousel-inner">
        <?php $j = 0;
        foreach ($slideshow as $item) { ?>
            <?php if ($item->image) { ?>
                <div class="item <?php if ($j == 0) echo 'active' ?>">
                    <a class="banners-item " href="<?php echo $item->link; ?>" title='<?php echo $item->name; ?>'
                       id="banner_item_<?php echo $item->id; ?>">

                        <img class="img-responsive show_pc"
                             src="<?php echo URL_ROOT . str_replace('/original/', '/slideshow_large/', $item->image); ?>"
                             alt="<?php echo $item->name; ?>">
                    </a>
                </div>
            <?php } ?>
            <?php
            $j++;
        } ?>
    </div>
    <!-- Carousel controls -->

    <a class="carousel-control prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left left_control">
            <img src="<?php echo URL_ROOT ?>blocks/slideshow/assets/images/prev.svg" alt="prev"
                 class="img-responsive">
        </span>
    </a>
    <a class="carousel-control next" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right">
            <img src="<?php echo URL_ROOT ?>blocks/slideshow/assets/images/next.svg" alt="next"
                 class="img-responsive">
        </span>
    </a>
</div>


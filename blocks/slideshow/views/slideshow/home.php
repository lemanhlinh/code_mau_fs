<?php
global $tmpl;
//    $tmpl -> addStylesheet('owl.carousel.min','libraries/OwlCarousel2-2.2.1/assets');
//    $tmpl -> addScript('owl.carousel.min','libraries/OwlCarousel2-2.2.1');
//
//    $tmpl -> addStylesheet('style_default','blocks/slideshow/assets/css');
//    $tmpl -> addScript('default','blocks/slideshow/assets/js');
$i = 0;
$j = 0;
?>
<?php if (isset($data) && !empty($data)) { ?>
    <section class="awe-section-1">
        <div class="slide_index">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div id="sync1" class="home-slider owl-carousel not-dqowl" data-dot="true" data-nav='true'
                                 data-lg-items='1' data-md-items='1' data-sm-items='1' data-xs-items="1"
                                 data-margin='0'>
                                <?php foreach ($data as $item) { ?>
                                    <?php if ($item->image) { ?>
                                        <div class="item">
                                            <a href="<?php echo $item->url; ?>" class="clearfix">
                                                <img src="<?php echo URL_ROOT . str_replace('/original/', '/slideshow_large/', $item->image) ?>"
                                                     alt="<?php echo $item->name; ?>">
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <?php $j++; ?>
                                <?php } ?>
                            </div><!-- /.products -->
                            <div id="sync2" class=" hidden-xs hidden-sm thumb_side owl-carousel owl-theme">
                                <?php foreach ($data as $item) { ?>
                                    <?php if ($item->image_thumb) { ?>
                                        <div class="item thumb_small">
                                            <a href="javascript:;" class="clearfix">
                                                <img src="<?php echo URL_ROOT . str_replace('/original/', '/slideshow_large/', $item->image) ?>"
                                                     alt="<?php echo $item->name; ?>">
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <?php $i++; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
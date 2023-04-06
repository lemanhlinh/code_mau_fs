<?php global $tmpl;
//$tmpl->addStylesheet('banners', 'blocks/banners/assets/css');
?>
<?php if (count($list)) { ?>
    <div class="section-brand">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12 ">
                    <div class="owl-carousel owl-theme brand_content" data-lg-items="4" data-md-items="4"
                         data-xs-items="2" data-sm-items="3" data-margin="15">
                        <?php $i = 0; ?>
                        <?php foreach ($list as $item) { ?>
                            <?php if ($item->type == 1) { ?>
                                <?php if ($item->image) { ?>
                                    <div class="item">
                                        <a class="img1" href="<?php echo $item->link; ?>"
                                           title='<?php echo $item->name; ?>' id="banner_item_<?php echo $item->id; ?>">
                                            <?php if ($item->width && $item->height) { ?>
                                                <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                                     src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>"
                                                     width="<?php echo $item->width; ?>"
                                                     height="<?php echo $item->height; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                                     src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>">
                                            <?php } ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php $i++; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

 
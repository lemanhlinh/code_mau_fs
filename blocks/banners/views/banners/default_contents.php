<?php global $tmpl;
//$tmpl->addStylesheet('banners', 'blocks/banners/assets/css');
$array_color = array(
        0=>'a',
        1=>'b',
        2=>'c',
);
?>
<?php if (count($list)) { ?>
    <section class="awe-section-4">
        <section class="section_service ">
            <div class="container">
                <div class="row">
                    <div class="wrap_item_srv" data-lg-items="2" data-md-items="2" data-xs-items="1" data-sm-items="2"
                         data-margin="15">
                        <?php $i = 0; ?>
                        <?php foreach ($list as $item) { ?>

                            <?php if ($item->type == 1) { ?>
                                <?php if ($item->image) { ?>
                                    <div class="col-item-srv col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <a class="service_item_ed <?= !empty($array_color[$i])? $array_color[$i]:'a'; ?>" href="<?php echo $item->link; ?>"
                                           title='<?php echo $item->name; ?>' id="banner_item_<?php echo $item->id; ?>">
                                            <span class="iconx">
                                            <?php if ($item->width && $item->height) { ?>
                                                <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                                     src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>"
                                                     width="<?php echo $item->width; ?>"
                                                     height="<?php echo $item->height; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                                     src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>">
                                            <?php } ?>
                                                </span>
                                            <div class="content_srv">
                                                <span class="title_service"><?php echo $item->name ?></span>
                                                <span class="content_service"><?php echo $item->description ?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } else if ($item->type == 2) { ?>
                                <?php if ($item->flash) { ?>
                                    <a class="banners-item" href="<?php echo $item->link; ?>"
                                       title='<?php echo $item->name; ?>' id="banner_item_<?php echo $item->id; ?>">
                                        <embed menu="true" loop="true" play="true"
                                               src="<?php echo URL_ROOT . $item->flash ?>" wmode="transparent"
                                               pluginspage="http://www.macromedia.com/go/getflashplayer"
                                               type="application/x-shockwave-flash" width="<?php echo $item->width; ?>"
                                               height="<?php echo $item->height; ?>">
                                    </a>
                                <?php } ?>
                            <?php } else if ($item->type == 3) { ?>
                                <div class='banner_item_<?php echo $i; ?> banner_item' <?php echo $item->width ? 'style="width:' . $item->width . 'px"' : ''; ?>
                                     id="banner_item_<?php echo $item->id; ?>">
                                    <?php echo $item->content; ?>
                                </div>
                            <?php } else { ?>
                                <a class="banners-item" href="<?php echo $item->link; ?>"
                                   title='<?php echo $item->name; ?>' id="banner_item_<?php echo $item->id; ?>">
                                    <?php if ($text_pos == 'top') { ?>
                                        <?php echo $item->content; ?>
                                    <?php } ?>
                                    <?php if ($item->width && $item->height) { ?>
                                        <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                             src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>"
                                             width="<?php echo $item->width; ?>" height="<?php echo $item->height; ?>">
                                    <?php } else { ?>
                                        <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                             src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>">
                                    <?php } ?>
                                    <?php if ($text_pos == 'bottom') { ?>
                                        <?php echo $item->content; ?>
                                    <?php } ?>
                                </a>
                            <?php } ?>
                            <?php $i++; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </section>
<?php } ?>
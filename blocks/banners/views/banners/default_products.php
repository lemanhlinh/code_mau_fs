<?php global $tmpl;
//$tmpl->addStylesheet('banners', 'blocks/banners/assets/css');
?>
<?php if (count($list)) { ?>
    <div class="right_module">
        <div class="module_service_details">
            <div class="wrap_module_service">
                <?php $i = 0; ?>
                <?php foreach ($list as $item) { ?>
                    <?php if ($item->type == 1) { ?>
                        <?php if ($item->image) { ?>
                            <div class="item_service">
                                <div class="wrap_item_">
                                    <div class="content_service">
                                        <a style="display: block;text-align: center" href="<?php echo $item->link; ?>" title='<?php echo $item->name; ?>' id="banner_item_<?php echo $item->id; ?>">
                                            <?php if ($item->width && $item->height) { ?>
                                                <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                                     src="<?php echo URL_ROOT . str_replace('/original/', '/original/', $item->image); ?>"
                                                     width="<?php echo $item->width; ?>"
                                                     height="<?php echo $item->height; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" alt="<?php echo $item->name; ?>"
                                                     src="<?php echo URL_ROOT . str_replace('/original/', '/original/', $item->image); ?>">
                                            <?php } ?>
                                            <p><?php echo $item->name; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
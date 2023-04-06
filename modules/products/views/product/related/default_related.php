<div class="section_popular_product  not_bf_af margin-top-30">
    <div class="title_section_center border_bottom_ not_bf after_and_before">
        <h2 class="title not_bf">
            <a class="title a-position" href="<? echo FSRoute::_('index.php?module=products&view=home') ?>"
               title="Sản phẩm liên quan">
                Sản phẩm liên quan</a>
        </h2>
    </div>
    <div class="border_wrap col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <div class="owl_product_comback ">
            <div class="product_comeback_wrap">
                <div class="owl_product_item_content owl-carousel" data-dot="false" data-nav='true'
                     data-lg-items='6' data-md-items='4' data-sm-items='4' data-xs-items="1" data-margin='0'>
                    <?php $tmp = 0; ?>
                    <?php foreach ($list_related as $item) {
                        $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                        $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                        ?>
                        <div class="item saler_item col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="owl_item_product padding_style">
                                <div class="product-box">
                                    <div class="product-thumbnail">
                                        <?php if ($item->discount) { ?>
                                            <span class="sale_count">
                                                    <span class="bf_">-<?php echo $item->discount; ?> <?= $item->discount_unit == 'percent' ? '%' : '₫'; ?></span>
                                                </span>
                                        <?php } ?>
                                        <?php if ($item->is_new) { ?>
                                            <span class="label_news top_"><span class="bf_">Mới</span></span>
                                        <?php } ?>
                                        <a href="<?php echo $link; ?>" class="image_link display_flex"
                                           data-images="<?php echo $image_resized; ?>"
                                           title="<?php echo $item->name ?>">
                                            <img src="<?php echo $image_resized; ?>"
                                                 alt="<?php echo $item->name ?>">
                                        </a>
                                    </div>
                                    <div class="product-info a-left">
                                        <h3 class="product-name">
                                            <a class="text2line" href="<?php echo $link; ?>"
                                               title="<?php echo $item->name ?>"><?php echo $item->name ?></a>
                                        </h3>

                                        <div class="price-box clearfix">
                                            <?php if ($item->discount) { ?>
                                                <span class="price product-price">
                                                            <?php echo format_money($item->price, '₫/KG'); ?>
                                                        </span>
                                                <span class="price product-price-old"><?php echo format_money($item->price_old, '₫'); ?></span>
                                            <?php } else { ?>
                                                <span class="price product-price">
                                                            <?php echo $item->price ? format_money($item->price, '₫/KG') : 'Liên hệ'; ?>
                                                        </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }//end: foreach($list as $item) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
global $tmpl;
//$tmpl->addStylesheet('lightslider', 'blocks/productslist/assets/css');
//$tmpl -> addScript('default','blocks/productslist/assets/js');
?>
<div class="off_today off_today_collection hidden-sm hidden-xs">
    <div class="title_module border_bottom_10">
        <h2>
            <a title="Sản phẩm bán chạy">Sản phẩm bán chạy</a>
        </h2>
    </div>
    <div class="sale_off_today">
        <div class="not-dqowl wrp_list_product">
            <?php
            $i = 0;
            foreach ($list as $item) {
                $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                ?>
                <div class="item_small">
                    <div class="product-box product-list-small">
                        <div class="product-thumbnail">
                            <a href="<?php echo $link; ?>" title="<?php echo $item->name ?>">
                                <img src="<?php echo $image_resized; ?>" alt="<?php echo $item->name ?>">
                            </a>
                        </div>
                        <div class="product-info a-left">
                            <h3 class="product-name">
                                <a class="text2line" href="<?php echo $link; ?>" title="<?php echo $item->name ?>"><?php echo $item->name ?></a>
                            </h3>
                            <div class="price-box clearfix">
                                <?php if ($item->discount) { ?>
                                    <span class="price product-price">
                                                            <?php echo format_money($item->price, '₫/KG'); ?>
                                                        </span>
                                    <span class="price product-price-old"><?php echo format_money($item->price_old, '₫'); ?></span>
                                <?php } else { ?>
                                    <span class="price product-price">
                                                            <?php echo $item->price? format_money($item->price, '₫/KG'):'Liên hệ'; ?>
                                                        </span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
            } ?>
        </div>
    </div>
</div>
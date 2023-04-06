<?php
global $tmpl;
//$tmpl -> addStylesheet('highlight','blocks/productslist/assets/css');
$tmpl -> addScript('default','blocks/productslist/assets/js');
$link_readmore = FSRoute::_("index.php?module=products&view=home");

$array_cat = array();
$i = 0;
$str_category_id = '';
if (count($list)) {
    foreach ($list as $item) {
        if ($i == 0) {
            $array_cat[$i]['id'] = $item->category_id;
            $array_cat[$i]['name'] = $item->category_name;
            $str_category_id .= $item->category_id;
        } else if (strpos(','.$str_category_id.',',','. $item->category_id.',') === false) {
            $array_cat[$i]['id'] = $item->category_id;
            $array_cat[$i]['name'] = $item->category_name;
            $str_category_id .= ','.$item->category_id;
        }
        $i++;
    }
}
?>
<div class="clear"></div>
<section class="awe-section-3 row-item">
    <section class="section_bestSale">
        <div class="container">
            <div class="title_section_center mr_0">
                <h2 class="title"><span>Sản phẩm bán chạy</span></h2>
            </div>
            <div class="tab_link_module">
                <div class="tabs-container tab_border">
				<span class="hidden-md hidden-lg button_show_tab">
					<i class="fa fa-navicon"></i>
				</span>
                    <span class="hidden-md hidden-lg title_check_tabs"></span>
                    <div class="clearfix">
                        <ul class="ul_link link_tab_check_click container">
                            <?php if (count($array_cat)) { ?>
                                <?php foreach ($array_cat as $item) { ?>
                                    <li class="li_tab">
                                        <a class="tab-cat" data-id="<?= $item['id']; ?>"
                                           title=" Trái cây"><?= $item['name']; ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="tabs-content">
                    <div class="content-tab content-tab-proindex" style="">
                        <div class="clearfix wrap_item_list row">
                            <?php
                            $i = 0;
                            foreach ($list as $item) {
                                $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                                ?>
                                <div class="products-<?php echo $item->category_id; ?> col-xs-6 col-md-3 col-sm-4 col-lg-2 item-products">
                                    <div class="wrp_item_small">
                                        <div class="product-box">
                                            <div class="product-thumbnail">
                                                <?php if ($item->discount) { ?>
                                                    <span class="sale_count">
                                                    <span class="bf_">-<?php echo $item->discount;?> <?= $item->discount_unit == 'percent' ? '%' : '₫'; ?></span>
                                                </span>
                                                <?php } ?>
                                                <?php if ($item->is_new) { ?>
                                                    <span class="label_news top_"><span class="bf_">Mới</span></span>
                                                <?php } ?>
                                                <a href="<?php echo $link; ?>" class="image_link display_flex"
                                                   data-images="<?php echo $image_resized; ?>"
                                                   title="<?php echo $item->name ?>">
                                                    <img src="<?php echo $image_resized; ?>" alt="<?php echo $item->name ?>">
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
                                                            <?php echo $item->price? format_money($item->price, '₫/KG'):'Liên hệ'; ?>
                                                        </span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
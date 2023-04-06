<?php
global $tmpl, $config;
//	$tmpl -> addStylesheet('cat','modules/products/assets/css');
$total_ = count($list);
$Itemid = 9;
FSFactory::include_class('fsstring');
$sort = FSInput::get('order', 'defautl');
$limit = FSInput::get('limit', 20, 'int');

$arr_order = array(
    array('price-asc', FSText::_('Giá tăng dần')),
    array('price-desc', FSText::_('Giá giảm dần')),
    array('alpha-asc', FSText::_('Từ A-Z')),
    array('alpha-desc', FSText::_('Từ Z-A')),
    array('created-desc', FSText::_('Mới đến cũ')),
    array('created-asc', FSText::_('Cũ đến mới')),
);
?>

<div class="products row-item">
    <div class="page_title margin-top-5">
        <h1 class="title_page_h1"><?php echo $cat->name ?></h1>
    </div>

    <div class="category-products products">
        <div class="sortPagiBar">
            <div class="srt">
                <div class="wr_sort col-sm-12">
                    <div class="text-sm-right">
                        <div class="sortPagiBar sortpage text-sm-right">
                            <div id="sort-by">
                                <label class="left hidden-xs hidden">Sắp xếp: </label>
                                <div class="border_sort">
                                    <select onchange="location = this.value;">
                                        <option value="<?php echo FSRoute::_('index.php?module=products&view=cat&ccode=' . $cat->alias . '&cid=' . $cat->id . '&Itemid=9'); ?>">
                                            Mặc định
                                        </option>
                                        <?php
                                        foreach ($arr_order as $item) {
                                            $link = FSRoute::addParameters('order', $item[0]);
                                            ?>
                                            <option <?php echo $sort == $item[0] ? 'selected="selected"' : ''; ?>
                                                    value="<?php echo $link; ?>">
                                                <?php echo $item[1] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END: sortPagiBar-->
        <?php if ($total_) { ?>
            <section class="products-view products-view-grid collection_reponsive">
                <div class="row row-gutter-14">
                    <?php
                    $i = 0;
                    foreach ($list as $item) {
                        $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                        $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product-col">
                            <div class="wrp_item_small">
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
                                                    <?php echo $item->price ? format_money($item->price, '₫/KG') : 'Liên hệ'; ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                                --><?php //echo ($i+1) % 5 == 0 ? '<div class="clearfix "></div>' : ''; ?>
                        <?php $i++;
                    } ?>
                </div>
                <?php if ($pagination) { ?>
                    <div class="shop-pag text-xs-right">
                        <nav>
                            <?php echo $pagination->showPagination(3); ?>
                        </nav>
                    </div>
                <?php } ?>
            </section>
        <?php } ?>
    </div>
</div><!-- END: .products_cat -->
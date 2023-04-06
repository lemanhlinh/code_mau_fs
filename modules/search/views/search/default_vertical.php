<?php
global $tmpl, $config;
$class = '';
$keyword_uri = encodeURIComponent($keyword);
?>
<div class="col-xs-12">
    <h2 class="title-head margin-bottom-20"><?php echo FSText::_("Sản phẩm phù hợp với từ khóa") ?>
        '<?php echo $keyword; ?>'</h2>
    <!--        <h2 class="title-head margin-bottom-20">Sản phẩm tìm thấy</h2>-->
</div>
<div class="clearfix"></div>
<div class="products-view-grid products cls_search container">
    <div class=" danhmuc">
        <div class="row">
            <?php
            $i = 1;
            foreach ($list as $item) {
                $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="dobong">
                        <div class="khung">
                            <a class="dpll" href="<?php if ($item->landing_page) {
                                echo $item->landing_page;
                            } else {
                                echo $link;
                            } ?>" target="<?php if ($item->landing_page) {
                                echo '_blank';
                            } ?>">
                                <img class="sp" src="<?php echo $image_resized; ?>" alt="<?php echo $item->name ?>">
                                <img class="logo1" src="<?php echo URL_ROOT . $item->icon ?>" alt="<?php echo $item->name ?>">
                                <p class="phanmem"
                                   title="<?php echo $item->name ?>"><?php echo getWord(6, $item->name); ?></p>
                                <p class="thuoctinh"><?php echo getWord(15, $item->summary); ?></p>
                                <p class="gia"><b><?php echo FSText::_("Giá") ?>: </b><span
                                class="red"> <?php if ($item->price){ echo $item->price;}else{ echo 'Liên hệ';} ?></span></p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php if ($i % 3 == 0) { ?>
                    <div class="clearfix"></div>
                <?php }
                $i++; ?>
            <?php } ?>
        </div>
    </div><!--end: .vertical-->
</div><!--end: .vertical-->
<?php if ($pagination) { ?>
    <div class="text-xs-right col-lg-12 col-sm-12 col-xs-12 col-md-12" style="text-align: center;margin-top: 15px;">
        <nav>
            <?php echo $pagination->showPagination(3); ?>
        </nav>
    </div>
<?php } ?>
<style>
    .pagination {
        float: none;
    }
</style>

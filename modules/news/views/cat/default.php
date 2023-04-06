<?php
global $tmpl, $config;
// $tmpl->addStylesheet('cat', 'modules/news/assets/css');
$tmpl->addStylesheet('tinchuyenmuc', 'modules/news/assets/css');
$tmpl->addScript('detail', 'modules/news/assets/js');

$total_news_list = count($list);
$lang = FSInput::get('lang');
$keyword = FSInput::get('key');
if ($lang == 'vi') {
    $alias_url = $cat->alias . '-cn' . $cat->id;

} else {
    $alias_url = $cat->alias . '-cne' . $cat->id;
}
?>
<style type="text/css">
    @media (max-width: 767px) {
        .banner {
            height: 350px;
            background-image: url("<?php echo URL_ROOT . $config['banner_new'] ?>");
            background-repeat: no-repeat;
            background-position: 70% 0;
            background-size: cover;
        }
    }
</style>
<input type="hidden" id="alert_ip" value="<?= FSText::_('Bạn phải nhập từ khóa') ?>">
<div class="banner">
    <img src="<?= URL_ROOT . $config['banner_new'] ?>" alt="<?= FSText::_('Tin tức') ?>" class="img-responsive hidden-xs">
    <h2 data-aos="zoom-in-up"><?= FSText::_('Tin tức') ?></h2>
</div>
<div class="box_body">
    <img src="<?= URL_ROOT . 'modules/contact/assets/images/Group 617.png' ?>" alt="<?= FSText::_('Liên hệ') ?>"
         class="img-responsive r_bg">
    <div class="container">
        <h1><?= $cat->name ?></h1>

        <div class="row row_new" data-aos="zoom-in-up">
            <?php
            $i = 0;
            foreach ($list as $item) {
                ?>
                <?php if ($i == 0) { ?>
                    <div class="col-md-8 col_pd">
                        <div class="item_new">
                            <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>">
                                <div class="height_img0">
                                    <img src="<?= URL_ROOT . str_replace('original', 'large', $item->image) ?>"
                                         alt="<?= $item->title ?>" class="img-responsive">
                                </div>
                                <div class="bot_item">
                                    <h3><?= $item->title ?></h3>
<!--                                    <span class="time">--><?php //echo date('d/m/Y', strtotime($item->created_time)) ?><!--</span>-->
                                    <span class="cat_item"><?php echo $cat->name ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-md-4 col_pd">
                        <div class="item_new item_">
                            <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>">
                                <div class="height_img1">
                                    <img src="<?= URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                         alt="<?= $item->title ?>" class="img-responsive">
                                </div>
                                <h3 class="title_new"><?= $item->title ?></h3>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($i == 2) {
                    break;
                } ?>
                <?php $i++;
            } ?>
        </div>
        <div class="bot_body">
            <div class="row row_bot">
                <div class="col-md-8">
                    <div class="list_new" data-aos="zoom-in-up">
                        <?php
                        $i = 0;
                        foreach ($list as $key) {
                            $i++;
                            ?>
                            <?php if ($i < 4) {
                                continue;
                            } ?>
                            <div class="item_new1">
                                <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $key->alias . '&id=' . $key->id) ?>">
                                    <div class="height_2">
                                        <img src="<?= URL_ROOT . str_replace('original', 'resized', $key->image) ?>"
                                             alt="<?= $key->title ?>" class="img-responsive">
                                    </div>
                                    <div class="r_content">
                                        <h3><?= $key->title ?></h3>
<!--                                        <span class="time1">--><?php //echo date('d/m/Y', strtotime($key->created_time)) ?><!--</span>-->
                                        <p class="smr_new"><?= $key->summary ?></p>
                                    </div>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <?php if ($pagination) { ?>
                        <div class="text-center">
                            <?php echo $pagination->showPagination(3); ?>
                        </div>
                    <?php } ?>

                </div>
                <div class="col-md-4">
                    <div class="search_prd">
                        <input data-url="<?php echo URL_ROOT ?>" value="<?= @$keyword ?>"
                               data-lang="<?php echo $alias_url; ?>" type="text"
                               class="form-control ipput1" id="input3"
                               name=""
                               placeholder="<?php echo FSText::_('Nhập từ khóa') ?>...">
                        <a href="javascrip:void(0)" class="btn_search1">
                            <img src="<?php echo URL_ROOT ?>modules/news/assets/images/Path 1706.png"
                                 alt="<?= FSText::_('tìm kiếm') ?>">
                        </a>
                    </div>
                    <div class="list_new_desc">
                        <h2><?= FSText::_('Bài viết mới') ?></h2>
                        <?php foreach ($list_new_desc as $item) { ?>
                            <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>"><?php echo $item->title ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


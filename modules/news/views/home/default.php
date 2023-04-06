<?php
global $tmpl, $config;
// $tmpl->addStylesheet('cat', 'modules/news/assets/css');
$tmpl->addStylesheet('tintuc', 'modules/news/assets/css');
$tmpl->addScript('detail', 'modules/news/assets/js');

$total_news_list = count($list);
$Itemid = 7;
FSFactory::include_class('fsstring');
$lang = FSInput::get('lang');
$keyword = FSInput::get('key');
if ($lang == 'vi') {
    $alias_url = 'tin-tuc';
} else {
    $alias_url = 'news';
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
    <h1 data-aos="zoom-in-up"><?= FSText::_('Tin tức') ?></h1>
</div>
<div class="box_body">
    <img src="<?= URL_ROOT . 'modules/contact/assets/images/Group 617.png' ?>" alt="<?= FSText::_('Liên hệ') ?>"
         class="img-responsive r_bg">
    <div class="container">
        <div class="row row_new" data-aos="zoom-in-up">
            <?php
            $i = 0;
            foreach ($list_hot as $item) {
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
                                    <span class="cat_item"><?php echo $item->category_name ?></span>
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

                <?php $i++;
            } ?>
        </div>
        <div class="bot_body">
            <div class="row row_bot">
                <div class="col-md-8">
                    <?php foreach ($list_cat as $item) { ?>
                        <h2><?= $item->name ?></h2>
                        <div class="list_new" data-aos="zoom-in-up">
                            <?php foreach ($list_new[$item->id] as $key) { ?>
                                <div class="item_new1">
                                    <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $key->alias . '&id=' . $key->id) ?>">
                                        <div class="height_2">
                                            <img src="<?= URL_ROOT . str_replace('original', 'resized', $key->image) ?>"
                                                 alt="<?= $key->title ?>" class="img-responsive">
                                        </div>
                                        <div class="r_content">
                                            <h3><?= $key->title ?></h3>
<!--                                            <span class="time1">--><?php //echo date('d/m/Y', strtotime($key->created_time)) ?><!--</span>-->
                                            <p class="smr_new"><?= $key->summary ?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            <?php } ?>
                        </div>
                        <p class="view_more text-right">
                            <a data-aos="fade-right"
                               href="<?= FSRoute::_('index.php?module=news&view=cat&ccode=' . $item->alias . '&id=' . $item->id) ?>"><?= FSText::_('Xem tất cả') ?></a>
                        </p>
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <div class="search_prd">
                        <input data-url="<?php echo URL_ROOT ?>" value="<?= @$keyword ?>"
                               data-lang="<?php echo $alias_url; ?>" type="text"
                               class="form-control ipput1" id="input2"
                               name=""
                               placeholder="<?php echo FSText::_('Nhập từ khóa') ?>...">
                        <a href="javascrip:void(0)" class="btn_search">
                            <img src="<?php echo URL_ROOT ?>modules/news/assets/images/Path 1706.png"
                                 alt="<?= FSText::_('tìm kiếm') ?>">
                        </a>
                    </div>
                    <div class="list_new_desc">
                        <h2><?= FSText::_('Bài viết mới') ?></h2>
                        <?php foreach ($list as $item) { ?>
                            <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>"><?php echo $item->title ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
global $tmpl, $config;
$tmpl->addStylesheet('tinchitiet', 'modules/news/assets/css');
$tmpl->addScript('detail', 'modules/news/assets/js');
$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
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
<input type="hidden" name="hits" id="news_id" value="<?= $data->id ?>">
<div class="banner">
    <img src="<?= URL_ROOT . $config['banner_new'] ?>" alt="<?= FSText::_('Tin tức') ?>" class="img-responsive hidden-xs">
    <h2 data-aos="zoom-in-up"><?= FSText::_('Tin tức') ?></h2>
</div>
<div class="box_body">
    <img src="<?= URL_ROOT . 'modules/contact/assets/images/Group 617.png' ?>" alt="<?= FSText::_('Liên hệ') ?>"
         class="img-responsive r_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="title_new"><?= $data->title ?></h1>
                <div class="section2_right2">
<!--                    <p class="time dlp">--><?php //echo date('d/m/Y', strtotime($data->created_time)); ?><!--</p>-->
                    <a href="<?= FSRoute::_('index.php?module=news&view=cat&id=' . $data->category_id . '&ccode=' . $data->category_alias) ?>"
                       class="view dlp"><?php echo $data->category_name; ?></a>
                    <div class="like_fb">
                        <?php
                        include 'default_share_bottom.php';
                        ?>
                    </div>
                </div>
                <p class="content1"> <?php echo $data->summary; ?></p>
                <div class="content2">
                    <?php echo html_entity_decode($data->content) ?>
                </div>
                <div class="tag">
                    <?php
                    include 'default_tags.php';
                    ?>
                </div>
            </div>
            <div class="col-md-4  hidden-xs" data-aos="zoom-in-up">
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
        <div class="box_rlt" data-aos="fade-down">
            <h2><?php echo FSText::_('Tin tức liên quan') ?></h2>
            <div class="row">
                <?php foreach ($relate_news_list as $item) { ?>
                    <div class="col-md-4">
                        <div class="item_new">
                            <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>">
                                <div class="height_img">
                                    <img src="<?php echo str_replace('original', 'resized', $item->image) ?>"
                                         alt="<?= $item->title ?>" class="img-responsive">
                                </div>
                            </a>
                            <div class="bot_new">
                                <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>">
                                    <h3><?= $item->title ?></h3>
                                </a>
<!--                                <span class="time_new">--><?//= date('d/m/Y', strtotime($item->created_time)) ?><!--</span>-->
                                <a href="<?= FSRoute::_('index.php?module=news&view=cat&id=' . $item->category_id . '&ccode=' . $item->category_alias) ?>" class="cat_new"><?= $item->category_name ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

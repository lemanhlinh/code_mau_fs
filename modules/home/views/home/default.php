<?php
global $tmpl, $config;
$tmpl->addStylesheet('home6', 'modules/home/assets/css');
$tmpl->addStylesheet('owl.carousel.min', 'libraries/owlcarousel/assets');
$tmpl->addStylesheet('owl.theme.default', 'libraries/owlcarousel/assets');
$tmpl->addScript('owl.carousel.min', 'libraries/owlcarousel');
$tmpl->addScript('default', 'modules/home/assets/js');
$lang = FSInput::get('lang');
?>
<div class="box_about">
    <img src="<?= URL_ROOT . 'images/Mask Group 488.svg' ?>" alt="" class="img-responsive bg_left">
    <img src="<?= URL_ROOT . 'images/Group 331.svg' ?>" alt="" class="img-responsive bg_right">
    <div class="container" data-aos="fade-down">
        <h2 class="title_box text-center"><?php echo FSText::_('Giới thiệu') ?></h2>
        <span class="border_1"></span>
        <div class="row">
            <div class="col-md-6 ">
                <div class="ct_ab">
                    <?php echo html_entity_decode($bout->summary) ?>
                </div>
                <a href="<?= FSRoute::_('index.php?module=contents&view=content&code=' . $bout->alias . '&id=' . $bout->id) ?>"><?= FSText::_('Xem chi tiết') ?></a>
            </div>
            <div class="col-md-6">
                <img src="<?= URL_ROOT . 'images/Group 777.jpg' ?>" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="box_app">
    <div class="container">
        <h2 class="title_box text-center"><?php echo FSText::_('Lĩnh vực hoạt động') ?></h2>
        <span class="border_1"></span>
    </div>
    <div class="bd1 hidden-sm hidden-xs hidden-md" data-aos="fade-down">
        <img src="<?= URL_ROOT . 'images/Group 778.jpg' ?>" alt="<?= FSText::_('Lĩnh vực') ?>" class="img-responsive">
        <div class="container bd">
            <div class="row">
                <div class="col-md-6 l_app ">
                    <?php
                    $i = 0;
                    foreach ($list_field as $item) { ?>
                        <div class="item_ap app_<?= $item->id ?> <?= $i == 0 ? 'active' : '' ?>">
                            <h3><?= $item->name ?></h3>
                            <p class=""><?= $item->summary ?></p>
                            <img src="<?php echo URL_ROOT . 'modules/home/assets/images/Group 776.png' ?>"
                                 alt="hình ảnh"
                                 class="img-responsive">
                        </div>
                        <?php $i++;
                    } ?>

                </div>
                <div class="col-md-6 buton_app">
                    <?php if ($lang == 'vi') { ?>
                        <img src="<?= URL_ROOT . 'images/Group 779.png' ?>" alt="" class="img-responsive r_img">
                    <?php } else { ?>
                        <img src="<?= URL_ROOT . 'modules/home/assets/images/sub_field.png' ?>" alt=""
                             class="img-responsive r_img">
                    <?php } ?>
                    <?php
                    $i = 0;
                    foreach ($list_field as $item) { ?>
                        <span data-id="<?= $item->id ?>"
                              class="click_app <?=$lang=='vi'?'click_app_'.$item->id:'click_app_en'.$item->id?> <?= $i == 0 ? 'active' : '' ?>"></span>
                        <?php $i++;
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="visible-xs visible-sm visible-md hidden-lg">
        <div class="container">
            <div class="list_app owl-carousel" data-aos="fade-down">
                <?php
                foreach ($list_field as $item) { ?>
                    <div class="item_app">
                        <a href="<?= FSRoute::_('index.php?module=field&view=field&code=' . $item->alias . '&id=' . $item->id) ?>">
                            <img src="<?= URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                 alt="<?= $item->name ?>" class="img-responsive">
                            <div class="box_bot text-center">
                                <h3><?= $item->name ?></h3>
                                <p><?= $item->summary ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="box_new">
    <img src="<?= URL_ROOT . 'images/Group 616.svg' ?>" alt="" class="img-responsive bg_left">
    <img src="<?= URL_ROOT . 'images/Group 617.svg' ?>" alt="" class="img-responsive bg_right">
    <div class="container">
        <h2 class="title_box text-center"><?php echo FSText::_('Tin tức') ?></h2>
        <span class="border_1"></span>
        <div class="list_new  owl-carousel" data-aos="fade-down">
            <?php foreach ($news as $item) { ?>
                <div class="item_new">
                    <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>">
                        <div class="height_img">
                            <img src="<?php echo str_replace('original', 'resized', $item->image) ?>"
                                 alt="<?= $item->title ?>">
                        </div>
                    </a>
                    <div class="bot_new">
                        <a href="<?= FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id) ?>">
                            <h3><?= $item->title ?></h3>
                        </a>
<!--                        <span class="time_new">--><?//= date('d/m/Y', strtotime($item->created_time)) ?><!--</span>-->
                        <a href="<?= FSRoute::_('index.php?module=news&view=cat&id=' . $item->category_id . '&ccode=' . $item->category_alias) ?>"
                           class="cat_new"><?= $item->category_name ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="box_member">
    <div class="container">
        <h2 class="title_box text-center"><?php echo FSText::_('Công ty thành viên') ?></h2>
        <span class="border_1"></span>
    </div>
    <div class="box_ctt" data-aos="fade-down">
        <img src="<?= URL_ROOT . 'modules/home/assets/images/Group 776.jpg' ?>" alt="" class="img-responsive">
        <div class="container img_mem">
            <img src="<?= URL_ROOT . 'modules/home/assets/images/Group 777.png' ?>" alt="" class="img-responsive">
        </div>
    </div>
</div>
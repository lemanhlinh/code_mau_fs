<?php
global $tmpl, $config;
$tmpl->addStylesheet('home', 'modules/field/assets/css');

?>
<style type="text/css">
    @media (max-width: 767px) {
        .banner_ct {
            height: 350px;
            background-image: url("<?php echo URL_ROOT . $config['banner_field'] ?>");
            background-repeat: no-repeat;
            background-position: 50% 0;
            background-size: cover;
        }
    }
</style>
<div class="banner_ct">
    <img src="<?php echo URL_ROOT . $config['banner_field'] ?>" alt="banner" class="img-responsive hidden-xs">
    <h1 data-aos="fade-down"><?= FSText::_('Lĩnh vực hoạt động') ?></h1>
</div>
<div class="box_contentchild">
    <?php
    $i = 1;
    foreach ($list_ct as $item) {
        ?>
        <?php if ($i % 2 == 0) { ?>
            <div class="item_content even">
                <img src="<?= URL_ROOT . 'images/Group 618.png' ?>" alt="" class="img-responsive bg_left">
                <img src="<?= URL_ROOT . 'images/Group 615.png' ?>" alt="" class="img-responsive bg_right">
                <div class="container">
                    <div class="row row_item">
                        <div class="col-md-6 col_item">
                            <a href="<?php echo FSRoute::_('index.php?module=field&view=field&code=' . $item->alias . '&id=' . $item->id) ?>">
                                <img src="<?php echo URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                     alt="<?= $item->name ?>" class="img-responsive" data-aos="flip-left">
                            </a>
                        </div>
                        <div class="col-md-6 col_item">
                            <div class="content_it text-right" data-aos="flip-right">
                                <a class="color_a"
                                   href="<?php echo FSRoute::_('index.php?module=field&view=field&code=' . $item->alias . '&id=' . $item->id) ?>">
                                    <h2><?= $item->name ?></h2>
                                    <span class="border_bot"></span>
                                    <div class="clearfix"></div>
                                    <div class="smr_item">
                                        <?php echo $item->summary ?>
                                    </div>
                                    <span class="view11"><?= FSText::_('Xem chi tiết') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="item_content old">
                <img src="<?= URL_ROOT . 'modules/field/assets/images/Mask Group 488.png' ?>" alt=""
                     class="img-responsive bg_left">
                <div class="container">
                    <div class="row row_item">
                        <div class="col-md-6 col_item">
                            <div class="content_it text-left" data-aos="flip-left">
                                <a class="color_a"
                                   href="<?php echo FSRoute::_('index.php?module=field&view=field&code=' . $item->alias . '&id=' . $item->id) ?>">
                                    <h2><?= $item->name ?></h2>
                                    <span class="border_bot"></span>
                                    <div class="clearfix"></div>
                                    <div class="smr_item">
                                        <?php echo $item->summary ?>
                                    </div>
                                    <span class="view11"><?= FSText::_('Xem chi tiết') ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col_item">
                            <a class="color_a"
                               href="<?php echo FSRoute::_('index.php?module=field&view=field&code=' . $item->alias . '&id=' . $item->id) ?>">
                                <img src="<?php echo URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                     alt="<?= $item->name ?>" class="img-responsive" data-aos="flip-right">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php $i++;
    } ?>
</div>
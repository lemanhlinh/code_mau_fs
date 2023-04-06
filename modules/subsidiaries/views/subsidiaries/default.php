<?php
global $tmpl, $config;
//$tmpl->addScript('form1');
$tmpl->addStylesheet('owl.carousel.min', 'libraries/owlcarousel/assets');
$tmpl->addStylesheet('owl.theme.default', 'libraries/owlcarousel/assets');
$tmpl->addStylesheet('gioithieu', 'modules/subsidiaries/assets/css');
$tmpl->addScript('owl.carousel.min', 'libraries/owlcarousel');
$tmpl->addScript('content', 'modules/subsidiaries/assets/js');
//    $tmpl -> addStylesheet('product','modules/products/assets/css');

?>
<section>
    <div class="body_lv">
        <img src="<?php echo URL_ROOT . 'upload_images/images/2021/06/24/Group 331.png' ?>" alt="icon" class="icon_r">
        <div class="container">
            <div class="row">
                <div class="col-md-6 left_bd" data-aos="fade-right">
                    <img src="<?= URL_ROOT . str_replace('original', 'resized', $data->image) ?>"
                         alt="<?= $data->name ?>" class="img-reponsive" onerror="this.src='/images/not_picture.png'">
                    <div class="infor">
                        <h1><?= $data->name ?></h1>
                        <span><?= $data->address ?></span>
                        <a href="<?= $data->website ?>" target="_blank"><?= $data->website ?></a>
                    </div>
                    <div class="clearfix"></div>
                    <?php if (@$data->content) { ?>
                        <div class="ct_l">
                            <?= html_entity_decode($data->content) ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6 right_bd">
                    <div class="list_image  owl-carousel" data-aos="fade-left">
                        <?php foreach ($image as $item) { ?>
                            <div class="item_image">
                                <img src="<?=URL_ROOT . str_replace('original', 'tiny', $item->image)?>" alt="image" class="img-responsive">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box_ctt" data-aos="fade-down">
        <img src="<?= URL_ROOT . 'modules/home/assets/images/Group 776.jpg' ?>" alt="" class="img-responsive">
        <div class="container img_mem">
            <img src="<?= URL_ROOT . 'modules/home/assets/images/Group 777.png' ?>" alt="" class="img-responsive">
        </div>
    </div>
</section>






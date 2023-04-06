<?php
global $tmpl, $config;
//$tmpl->addScript('form1');
$tmpl->addStylesheet('gioithieu', 'modules/field/assets/css');
//$tmpl->addScript('content', 'modules/contents/assets/js');
//    $tmpl -> addStylesheet('product','modules/products/assets/css');

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
<section>
    <div class="banner_ct">
        <img src="<?php echo URL_ROOT . $config['banner_field'] ?>" alt="banner" class="img-responsive hidden-xs">
        <h2 data-aos="fade-down"><?= FSText::_('Lĩnh vực hoạt động') ?></h2>
    </div>
    <div class="body_lv">
        <img src="<?php echo URL_ROOT . 'upload_images/images/2021/06/24/Group 331.png' ?>" alt="icon" class="icon_r">
        <div class="container">
            <h1 class="title_da"><?php echo $data->name ?></h1>
            <span class="border_bot"></span>
            <div class="content2">
                <?php echo html_entity_decode($data->content) ?>
            </div>
        </div>
    </div>
</section>






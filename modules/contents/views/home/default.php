<?php
global $tmpl, $config;
$tmpl->addStylesheet('home', 'modules/contents/assets/css');

?>
<style type="text/css">
    @media (max-width: 767px) {
        .banner_ct {
            height: 350px;
            background-image: url("<?php echo URL_ROOT . $config['image_content'] ?>");
            background-repeat: no-repeat;
            background-position: 68% 0;
            background-size: cover;
        }
    }
</style>
<div class="banner_ct">
    <img src="<?php echo URL_ROOT . $config['image_content'] ?>" alt="banner" class="img-responsive hidden-xs">
    <div class="container ct_bot">
        <div class="box_text" data-aos="fade-right">
            <img src="<?php echo URL_ROOT . 'modules/contents/assets/images/Path 1346.png' ?>" alt="logo">
            <h1><?= FSText::_('GIỚI THIỆU VỀ PLASCHEM') ?></h1>
        </div>
    </div>
</div>
<div class="box_message" data-aos="zoom-in">
    <div class="container">
        <?php echo html_entity_decode($config['intro']) ?>
    </div>
</div>
<div class="box_contentchild">
    <?php
    $i = 0;
    foreach ($list_ct as $item) {
        if($item->id == 10){
            $link = FSRoute::_('index.php?module=achievements&view=home');
        }elseif ($item->id == 4){
            $link = FSRoute::_('index.php?module=subsidiaries&view=home');
        }else{
            $link = FSRoute::_('index.php?module=contents&view=content&code='.$item->alias.'&id='.$item->id);
        }
        ?>
        <?php if ($i % 2 == 0) { ?>
            <div class="item_content even">
                <img src="<?= URL_ROOT . 'images/Group 618.png' ?>" alt="" class="img-responsive bg_left">
                <img src="<?= URL_ROOT . 'images/Group 615.png' ?>" alt="" class="img-responsive bg_right">
                <div class="container">
                    <div class="row row_item">
                        <div class="col-md-6 col_item">
                            <img src="<?php echo URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                 alt="<?= $item->title ?>" class="img-responsive" data-aos="flip-left">
                        </div>
                        <div class="col-md-6 col_item">
                            <div class="content_it text-right"  data-aos="flip-right">
                                <h2><?= $item->title ?></h2>
                                <span class="border_bot"></span>
                                <div class="clearfix"></div>
                                <div class="smr_item">
                                    <?php echo $item->summary ?>
                                </div>
                                <a href="<?php echo $link ?>"><?=FSText::_('Xem chi tiết')?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="item_content old">
                <div class="container">
                    <div class="row row_item">
                        <div class="col-md-6 col_item">
                            <div class="content_it text-left" data-aos="flip-left">
                                <h2><?= $item->title ?></h2>
                                <span class="border_bot"></span>
                                <div class="clearfix"></div>
                                <div class="smr_item">
                                    <?php echo $item->summary ?>
                                </div>
                                <a href="<?php echo $link ?>"><?=FSText::_('Xem chi tiết')?></a>
                            </div>
                        </div>
                        <div class="col-md-6 col_item">
                            <img src="<?php echo URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                 alt="<?= $item->title ?>" class="img-responsive" data-aos="flip-right">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php $i++;
    } ?>
</div>
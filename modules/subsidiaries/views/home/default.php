<?php
global $tmpl, $config;
$tmpl->addStylesheet('home', 'modules/subsidiaries/assets/css');

?>
<div class="box_sub">
    <img src="<?php echo URL_ROOT . 'upload_images/images/2021/06/24/Group 331.png' ?>" alt="icon" class="icon_r">
    <div class="container">
        <h1><?= FSText::_('Công ty thành viên') ?></h1>
        <div class="smr_"><?= $bout->summary?></div>
        <div class="new_tab">
            <ul class="nav nav_tabs nav1">
                <?php
                $i = 0;
                foreach ($list_field as $item) {
                    ?>
                    <li class="<?php if ($i == 0) {
                        echo 'active';
                    } ?>  new_tab_item">
                        <a data-toggle="tab" href="#field<?php echo $item->id ?>"><?php echo $item->name ?></a>
                    </li>
                    <?php $i++;
                } ?>
            </ul>
            <div class="tab-content">
                <?php
                $i = 0;
                foreach ($list_field as $item) {
                    ?>
                    <div id="field<?php echo $item->id ?>" class="tab-pane fade <?php if ($i == 0) {
                        echo 'in active';
                    } ?>">
                        <div class="row">
                            <?php foreach ($list_sub[$item->id] as $key) { ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="item_sub">
                                        <a href="<?= FSRoute::_('index.php?module=subsidiaries&view=subsidiaries&code=' . $key->alias . '&id=' . $key->id) ?>">
                                            <div class="bo_img">
                                                <img src="<?= URL_ROOT . str_replace('original', 'resized', $key->image) ?>"
                                                     alt="<?= $key->name ?>" class="img-responsive" onerror="this.src='/images/not_picture.png'">
                                            </div>
                                            <h3 class="text-center"><?= $key->name ?></h3>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
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

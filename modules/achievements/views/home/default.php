<?php
global $tmpl, $config;
$tmpl->addStylesheet('home', 'modules/achievements/assets/css');

?>
<div class="box_dev">
    <img alt="" class="img-responsive bgr_r" src="/upload_images/images/2021/06/24/Group%20331.png"/>
    <div class="container">
        <img alt="icon" data-aos="zoom-in" class="img-responsive icon_tt" src="/upload_images/images/2021/06/26/Group750.png"/>
        <h1 class="text-center"><?= FSText::_('Thành tích') ?></h1>
        <span class="smr_tt"><?php echo $thanhtich->summary ?></span>
        <div class="list_tt">
            <img alt="" class="img-responsive l_tt" src="/upload_images/images/2021/06/26/Group766.png"/>
            <img alt="" class="img-responsive r_tt" src="/upload_images/images/2021/06/26/Group767.png"/>
            <div class="row">
                <?php
                $i = 1;
                foreach ($list_ct as $item) { ?>
                    <div class="col-md-3 col-sm-4 col-xs-12 item1">
                        <div class="item_tt">
                            <div class="bo_img">
                                <img src="<?php echo URL_ROOT . str_replace('original', 'resized', $item->image) ?>"
                                     alt="<?= $item->name ?>" class="img-responsive">
                            </div>
                            <h3 class="name_tt"><?= $item->name ?></h3>
                            <a href="#" type="button" data-target="#myModal<?php echo $i; ?>"
                               data-toggle="modal"
                               role="dialog" class="open_popup">
                                <div class="block">
                                    <p class="name_block"><?= $item->name ?></p>
                                    <p class="first_block"><?= FSText::_('Chứng chỉ đầu tiên') . ': ' ?>
                                        <span><?= $item->first_certificate ?></span></p>
                                    <p class="date_block"><?= FSText::_('Ngày có hiệu lực') . ': ' ?>
                                        <span><?= date('d/m/Y', strtotime($item->effective_date)) ?></span></p>
                                    <p class="dv_block"><?= FSText::_('Đơn vị cấp') . ': ' ?>
                                        <span><?= $item->unit_level ?></span></p>
                                    <span class="view_more"><?= FSText::_('Xem chi tiết') ?></span>
                                </div>
                            </a>
                        </div>
                        <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <button type="button" class="close"
                                                data-dismiss="modal">
                                            <img src="<?= URL_ROOT . 'modules/achievements/assets/images/close.png' ?>"
                                                 alt="close" class="img-responsive">
                                        </button>
                                        <img src="<?php echo URL_ROOT . str_replace('original', 'large', $item->image) ?>"
                                             alt="<?= $item->name ?>" class="img-responsive">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($i % 4 == 0) { ?>
                        <div class="clearfix"></div>
                    <?php } ?>
                    <?php $i++;
                } ?>
            </div>
        </div>
    </div>
</div>
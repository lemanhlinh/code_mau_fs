<?php
/**
 * Created by PhpStorm.
 * User: ANHPT
 * Date: 11/25/2018
 * Time: 4:14 PM
 */
$module = FSInput::get('module');
?>
<div class="footer">
    <div class="ft_top">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="title_col"><?= FSText::_('Liên hệ') ?></h3>
                    <div class="content_about">
                        <?php echo $config['footer'] ?>
                    </div>

                </div>
                <div class="col-md-3">
                    <h3 class="title_col"><?= FSText::_('Thông tin tập đoàn') ?></h3>
                    <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'bottom', 'group' => '2')); ?>

                </div>
                <div class="col-md-3">
                    <h3 class="title_col"><?= FSText::_('Truy cập nhanh') ?></h3>
                    <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'bottom', 'group' => '4')); ?>
                </div>
                <div class="col-md-3">
                    <h3 class="title_col"><?= FSText::_('Lĩnh vực hoạt động') ?></h3>
                    <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'bottom', 'group' => '5')); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="ft_bot">
        <div class="container">
            <span><?php echo $config['fotter_bottom'] ?> </span>

        </div>
    </div>
</div>


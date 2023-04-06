<?php
/**
 * Created by PhpStorm.
 * User: ANHPT
 * Date: 11/25/2018
 * Time: 4:14 PM
 */
$Itemid = FSInput::get('Itemid', 1, 'int');
$module = FSInput::get('module');
?>
<header id="boder" class="module_home">
    <!--    <img class="bg_home" src="../../images/bg_home.jpg" alt="">-->
    <nav id="navmenu">
        <div class="container ">
            <div class="navtotal relative">
                <div class="tab pd">
                    <div class="header_menu">
                        <a href="#mySidenav">
                            <img src="<?php echo URL_ROOT . 'templates/default/images/Path 44.svg' ?>"
                                 class="bar_wite"
                                 alt="bar">
                        </a>
                    </div>
                </div>
                <div class="language">
                    <?php if ($lang == 'vi') { ?>
                        <a href="<?php echo URL_ROOT ?>"><img class="logo"
                                                              src="<?php echo URL_ROOT . 'images/Path 491.svg' ?>"
                                                              alt="plaschem"></a>
                    <?php } else { ?>
                        <a href="<?php echo URL_ROOT . 'en' ?>"><img class="logo"
                                                                     src="<?php echo URL_ROOT . 'images/Path 491.svg' ?>"
                                                                     alt="plaschem"></a>
                    <?php } ?>
                </div>
                <div class="search_mobile">
                    <span id="open_search1">
                        <img src="<?= URL_ROOT . 'images/Group 776.svg' ?>" alt="tìm kiếm">
                    </span>
                    <?php echo $tmpl->load_direct_blocks('search', array('style' => 'default_mb')); ?>
                </div>
                <div class="manu">
                    <!--block main menu-->
                    <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'megamenu', 'group' => '1')); ?>
                </div>
                <div class="flr flr1">
                    <a href="<?php echo URL_ROOT; ?>" class="item_lang">

                        <img class="imgcc"
                             src="<?php echo URL_ROOT; ?>images/vietnam.svg" alt="ngôn ngữ">
                        <span class="lang <?php if ($lang == 'vi') {
                            echo 'active';
                        } ?>"><?php echo FSText::_('VI') ?></span>
                    </a>
                    <a href="<?php echo URL_ROOT . 'en'; ?>" class="item_lang">
                        <img class="imgcc" src="<?php echo URL_ROOT; ?>images/united-kingdom.svg" alt="ngôn ngữ">
                        <span class="lang <?php if ($lang == 'en') {
                            echo 'active';
                        } ?>"><?php echo FSText::_('EN') ?></span>
                    </a>

                </div>
                <div class="search_pc"><span id="open_search">
                        <img src="<?= URL_ROOT . 'images/Group 776.svg' ?>" alt="tìm kiếm">
                    </span>
                    <!--                    block searh-->
                    <?php echo $tmpl->load_direct_blocks('search', array('style' => 'default')); ?>
                </div>
            </div>
        </div>
    </nav>
        <?php echo $module == 'home' ? $tmpl->load_direct_blocks('slideshow', array('style' => 'default')) : ''; ?>
</header>

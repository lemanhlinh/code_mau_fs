<?php
global $tmpl, $config;

$tmpl->addStylesheet('1657a', 'modules/home/assets/css');
$tmpl->addStylesheet('default', 'blocks/library/assets/css');
//$tmpl->addScript('e58d4', 'modules/home/assets/js');
//$tmpl->addScript('864c2', 'modules/home/assets/js');
//$tmpl->addScript('753d0', 'modules/home/assets/js');
//$tmpl->addScript('44905', 'modules/home/assets/js');
$tmpl->addScript('carousel', 'blocks/library/assets/js');
$tmpl->addScript('default', 'blocks/library/assets/js');

?>
<!--<div class="mkdf-row-grid-section-wrapper " style="width: 100%;">-->
<!--    <div class="mkdf-row-grid-section" style="width: 100%;">-->
<!--        <div class="vc_row wpb_row vc_row-fluid vc_row-o-full-height vc_row-o-columns-top vc_row-flex"-->
<!--             style="min-height: 100vh;">-->
<!--            <div class="wpb_column vc_column_container vc_col-sm-12">-->
<!--                <div class="vc_column-inner">-->
<!--                    <div class="wpb_wrapper">-->
<!--                        <div class="mkdf-elements-holder mkdf-responsive-mode-768 ">-->
<!--                            <div class="mkdf-eh-item    " data-item-class="mkdf-eh-custom-1792"-->
<!--                                 data-1367-1600="88px 12% 0px 12%" data-1025-1366="55px 22% 0px 22%"-->
<!--                                 data-769-1024="77px 0% 0px 0px" data-681-768="186px 0% 0px 0px"-->
<!--                                 data-680="26% 0px 0px 0px">-->

<!--                            <--slideshow-->
<!--                                <div class="container block-library">-->
<!--                                    <div class="libraries-carousel ">-->
<!--                                        <ul>-->
<!--                                            --><?php //$k = 0;
//                                            foreach ($slideshow as $value) {
//
//                                                $image_resized = URL_ROOT . str_replace('original', '/resized/', $value->image);
//                                                ?>
<!--                                                <li class="slide">-->
<!--                                                    <div class="mkdf-eh-item-inner">-->
<!--                                                        <div class="mkdf-eh-item-content mkdf-eh-custom-9783">-->
<!--                                                            <div class="wpb_text_column wpb_content_element ">-->
<!--                                                                <div class="wpb_wrapper">-->
<!--                                                                    <h2 style="text-align: center;"><span-->
<!--                                                                                style="color: #ffffff;">--><?php //echo $value->name ?><!--</span>-->
<!--                                                                    </h2>-->
<!--                                                                    <h3>--><?php //echo getWord(8,$value->summary) ?><!--</h3>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="vc_empty_space" style="height: 15px; display: none;"><span-->
<!--                                                                        class="vc_empty_space_inner"></span>-->
<!--                                                            </div>-->
<!--                                                            <a itemprop="url" href="--><?php //echo $value->url ?><!--"-->
<!--                                                               target="_self" style="margin: 0px 7px 10px 7px;padding: 5px 35px 5px 26px"-->
<!--                                                               class="mkdf-btn mkdf-btn-large mkdf-btn-solid">-->
<!--                                                                <span class="mkdf-btn-text">--><?php //echo FSText::_("Xem chi tiết")?><!--</span>-->
<!--                                                            </a>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                     <!--<a href="<?php echo $value->url ?>"><img
                                                                onerror="javascript:this.src='<?php echo URL_ROOT . 'images/no-images.png' ?>'"
<!--                                                                src="--><?php //echo $value->image; ?><!--" alt=""/></a>-->
<!--                                                </li>-->
<!--                                                --><?php //$k++;
//                                            } ?>
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                end slide-->
                                <?php $i = 0; ?>
                                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-left: 0px; margin-bottom: 0;">
                                    <!-- Carousel indicators -->
<!--                                    <ol class="carousel-indicators">-->
<!--                                        --><?php //foreach ($slideshow as $item) { ?>
<!--                                            --><?php //if ($item->type == 1) { ?>
<!--                                                --><?php //if ($item->image) { ?>
<!--                                                    <li data-target="#myCarousel" data-slide-to="--><?//= $i ?><!--" class="--><?php //if($i==0) echo 'active'?><!--"></li>-->
<!--                                                --><?php //} ?>
<!--                                            --><?php //}
//                                            $i++;
//                                        } ?>
<!--                                    </ol>-->
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        <?php $j = 0;
//                                        var_dump($slideshow);
                                        foreach ($slideshow as $item) { ?>
<!--                                            --><?php //if ($item->type == 1) { ?>
                                                <?php if ($item->image) { ?>
                                                    <div class="item <?php if ($j == 0) echo 'active' ?>">
                                                        <a class="banners-item " href="<?php echo $item->url; ?>" title='<?php echo $item->name; ?>'
                                                           id="banner_item_<?php echo $item->id; ?>">
<!--                                                            --><?php
//                                                            if( $item -> height) {
//                                                                ?>
<!--                                                                <img class="img-responsive"-->
<!--                                                                     src="--><?php //echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?><!--"-->
<!--                                                                     alt="--><?php //echo $item->name; ?><!--" style="height:--><?php //echo $item -> height.'px';?><!--" >-->
<!--                                                                --><?php
//                                                            }else {
//                                                                ?>
                                                                <img class="img-responsive" style="width: 100%;"
                                                                     src="<?php echo URL_ROOT . $item->image; ?>"
                                                                     alt="<?php echo $item->name; ?>">
<!--                                                                --><?php
//                                                            }
//                                                            ?>
                                                        </a>
                                                    </div>
<!--                                                --><?php //} ?>
                                            <?php }
                                            $j++;
                                        } ?>
                                    </div>
                                    <!-- Carousel controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon prev1"><img class="width1" src="blocks/library/assets/images/prev.png" alt=""></span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon next1"><img class="width1" src="blocks/library/assets/images/next.png" alt=""></span>
                                    </a>
                                </div>
<!--                                </div>-->
                                <div class="clear"></div>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<style>
    li .mkdf-eh-item-inner {
        display: none;
    }
    li.active .mkdf-eh-item-inner {
        display: block;
        position: absolute;
        left: 0;
        right: 0;
        top: -225px;
    }
    .block-library{
        padding-top: 200px;
    }
    .slide{
        overflow: unset!important;
    }
    h3{
        line-height: 1.4;
    }
</style>

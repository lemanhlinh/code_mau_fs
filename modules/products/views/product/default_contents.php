<?php
/**
 * Created by PhpStorm.
 * User: ANHPT
 * Date: 11/30/2018
 * Time: 7:29 AM
 */
?>
<div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
    <div class="row margin-top-30 xs-margin-top-15">

        <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
            <!-- Nav tabs -->
            <div class="product-tab e-tabs">
                <ul class="tabs tabs-title clearfix">

                    <li class="tab-link current" data-tab="tab-1">
                        <h3><span>Thông tin sản phẩm</span></h3>
                    </li>
                </ul>

                <div id="tab-1" class="tab-content current">
                    <div class="rte">
                        <?php
                        $description = htmlspecialchars_decode($data->description);
                        $description = preg_replace('/style[^>]*/', '', $description);
                        $description = preg_replace('/align[^>]*/', '', $description);
                        $description = preg_replace('/border[^>]*/', '', $description);
                        $description = preg_replace('/cellpadding[^>]*/', '', $description);
                        $description = preg_replace('/cellspacing[^>]*/', '', $description);
                        $description = str_replace('<table','<table class="table table-bordered table-hover"',$description);
                        echo $description;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($tmpl->count_block('top')) { ?>
    <div class="row-content pos-top">
        <?php echo $tmpl->load_position('top', 'XHTML2'); ?>
    </div> <!-- END: .pos-top -->
    <div class="clearfix"></div>
<?php } ?>
<?php if ($Itemid != 1) { ?>
    <div class="container margin-bottom-50">
        <div class="wrp_border_collection ">
            <?php if ($tmpl->count_block('left')) { ?>
                <div class="row">
                    <section
                            class="main_container collection collection_container col-lg-9 col-md-9 col-sm-12 col-lg-push-3 col-md-push-3">
                        <?php if ($tmpl->count_block('pos_contents_top')) { ?>
                            <div class="row-content pos_contents_top">
                                <?php echo $tmpl->load_position('pos_contents_top', 'XHTML2'); ?>
                            </div> <!-- END: .pos_contents_top -->
                        <?php } ?>

                        <?php echo $main_content; ?>

                        <?php if ($tmpl->count_block('pos_contents_bottom')) { ?>
                            <div class="row-content pos_contents_bottom">
                                <?php echo $tmpl->load_position('pos_contents_bottom', 'XHTML2'); ?>
                            </div> <!-- END: .pos_contents_bottom -->
                        <?php } ?>
                    </section>
                    <aside class="dqdt-sidebar sidebar left left-content col-xs-12 col-lg-3 col-md-3 col-sm-12  col-lg-pull-9 col-md-pull-9">
                        <?php echo $tmpl->load_position('left', 'XHTML2'); ?>
                    </aside>
                </div>
            <?php } else { ?>

                <div class="product margin-top-20">
                    <?php if ($tmpl->count_block('pos_contents_top')) { ?>
                        <div class="row-content pos_contents_top">
                            <?php echo $tmpl->load_position('pos_contents_top', 'XHTML2'); ?>
                        </div> <!-- END: .pos_contents_top -->
                    <?php } ?>

                    <?php echo $main_content; ?>

                    <?php if ($tmpl->count_block('pos_contents_bottom')) { ?>
                        <div class="row-content pos_contents_bottom">
                            <?php echo $tmpl->load_position('pos_contents_bottom', 'XHTML2'); ?>
                        </div> <!-- END: .pos_contents_bottom -->
                    <?php } ?>
                </div><!-- END: .main-column -->
            <?php } ?>
        </div>
    </div><!-- END: main-content -->
<?php } ?>

<?php if ($tmpl->count_block('bottom')) { ?>
    <?php echo $tmpl->load_position('bottom', 'XHTML2'); ?>
<?php } ?>

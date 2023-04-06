

<!--				<div class=" col-sm-12 col-md-9 leftbody">-->
					<div class="leftbody1 row">
					<?php
//                    echo 1;
					$i=1;
                        foreach ($list as $item){
                            $link = FSRoute::_("index.php?module=images&view=img&id=" . $item->id . "&code=" . $item->alias);
                            $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
//                            $imagechitiet = $model->getimageschitiet($item->id);
//                            var_dump($imagechitiet);
                    ?>
                        <div class="col-xs-6 col-sm-4 col-md-4 thuvienanh">
                            <a href="" type="button" data-target="#myModal-<?php echo $item->id;?>" data-toggle="modal" role="dialog">
                                <img src="<?php echo $image_resized; ?>" alt="<?php echo $item->name; ?>">
                                <h3 class="img_title"><?php echo $item->name; ?></h3>
                            </a>
                            <div class="modal fade" id="myModal-<?php echo $item->id;?>" role="dialog">
                                <div class="modal-dialog size">
                                    <div class="modal-content size1">
                                        <div class="header-modal">

                                            <div id="carousel-example-generic<?php echo $item->id; ?>" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $j = 1;
                                                    $imagechitiet = $model->getimageschitiet($item->id);
                                                    //var_dump($imagechitiet);
                                                    foreach ($imagechitiet as $key) {
                                                        $image_resized = URL_ROOT . str_replace('/original/', '/original/', $key->image);
                                                        $active = '';
                                                        if ($j == 1){
                                                            $active = 'active';
                                                        }
                                                        ?>

                                                        <div class="item <?php echo $active ?>">
                                                            <img src="<?php echo $key->image; ?>" alt="hình ảnh">
                                                        </div>

                                                        <?php $j++; }  ?>

                                                </div>

                                              <!-- Controls -->
                                                <a class="left carousel-control prev" href="#carousel-example-generic<?php echo $item->id; ?>" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                                  </a>
                                                <a class="right carousel-control next" href="#carousel-example-generic<?php echo $item->id; ?>" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                </a>
                                            </div>
                                            <div class="modal-header row">
                                                <div class="col-xs-10 col-sm-10 col-md-3">

                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-9">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>

                    <?php $i++; } ?>
					</div>
<!--					<div class="taithem1">-->
<!--						<a href="" type="button" class="btn btn-info taithem">Tải thêm</a>-->




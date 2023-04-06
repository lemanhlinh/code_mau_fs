<div class="modal fade" id="myModaldownload" role="dialog">
    <div class="modal-dialog size">
        <div class="modal-content size1">
            <div class="header-modal">
                <div class="modal-header row">
                    <div class="col-xs-10 col-sm-10 col-md-3">
                        <h4 class="modal-title">Download</h4>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-9">
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" name="contact1112"
                          action="index.php?module=products&view=product&task=save">
                        <div class="form-group">
                            <label for="name2" class="col-sm-3 control-label">Họ tên
                                *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name2" name="name"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job" class="col-sm-3 control-label">Đơn vị công
                                tác</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="job" name="company"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Địa
                                chỉ </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="add" name="address"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city2" class="col-sm-3 control-label">Tỉnh thành
                                * </label>
                            <div class="col-sm-9">
                                <select class="form-control" name='city' id="city2">
                                    <option value="0">Chọn tỉnh/thành phố</option>
                                    <?php
                                    foreach ($city as $key) {
                                        # code...
                                        ?>
                                        <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_download" class="col-sm-3 control-label">Email
                                * </label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email_download"
                                       name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone2" class="col-sm-3 control-label">Điện thoại
                                di
                                động * </label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="phone2" name="phone"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="version2"
                                   class="col-sm-3 control-label">Phiên bản
                                * </label>
                            <div class="col-sm-9">
                                <select class="form-control" name='version'
                                        id="version2">
                                    <option value="0">Chọn phiên bản</option>
                                    <?php
                                    if ($products_content->file_download1 or $products_content->link_download1) { ?>
                                        <option value="<?php echo $products_content->file_name1; ?>"><?php echo $products_content->file_name1; ?> </option>
                                    <?php } ?>
                                    <?php
                                    if ($products_content->file_download2 or $products_content->link_download2) { ?>
                                        <option value="<?php echo $products_content->file_name2; ?>"><?php echo $products_content->file_name2; ?> </option>
                                    <?php } ?>
                                    <?php
                                    if ($products_content->file_download3 or $products_content->link_download3) { ?>
                                        <option value="<?php echo $products_content->file_name3; ?>"><?php echo $products_content->file_name3; ?> </option>
                                    <?php } ?>
                                    <?php
                                    if ($products_content->file_download4 or $products_content->link_download4) { ?>
                                        <option value="<?php echo $products_content->file_name4; ?>"><?php echo $products_content->file_name4; ?> </option>
                                    <?php } ?>
                                    <?php
                                    if ($products_content->file_download5 or $products_content->link_download5) { ?>
                                        <option value="<?php echo $products_content->file_name5; ?>"><?php echo $products_content->file_name5; ?> </option>
                                    <?php } ?>
                                    <?php
                                    if ($products_content->file_download or $products_content->link_download6) { ?>
                                        <option value="<?php echo $products_content->file_name6; ?>"><?php echo $products_content->file_name6; ?> </option>
                                    <?php } ?>


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note2" class="col-sm-3 control-label">Ghi
                                chú</label>
                            <div class="col-sm-9">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="javascript:void(0)" title="GỬI"
                                   class="btn btn-info send" id="btnn2">GỬI</a>
                            </div>
                        </div>
                        <input type="hidden" name='id'
                               value='<?php echo $products_content->id; ?>'/>
                        <input type="hidden" name='alias'
                               value='<?php echo $products_content->alias; ?>'/>
                        <input type="hidden" name='products_name'
                               value='<?php echo $products_content->name; ?>'/>
                        <input type="hidden" name='type' value='Download sản phẩm'/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
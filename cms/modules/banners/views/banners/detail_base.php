<?php
TemplateHelper::dt_edit_text(FSText:: _('Tên Banner'), 'name', @$data->name);
TemplateHelper::dt_edit_text(FSText:: _('Link'), 'link', @$data->link);
//TemplateHelper::dt_edit_selectbox(FSText::_('Loại banner'),'type',@$data->type,0,$array_type,$field_value = 'id', $field_label='group_name',$size = 1,0);
TemplateHelper::dt_edit_text(FSText:: _('Description'), 'description', @$data->description, '', 100, 5, 0, '', '', 'col-sm-2', 'col-sm-12');
?>
<div class="form-group">
    <label><?php echo FSText::_('Loại banner'); ?></label>
    <select class="select2" name="type" id="type">
        <?php
        // selected category
        $cat_compare = 0;
        if (@$data->type) {
            $cat_compare = $data->type;
        }
        $i = 0;
        foreach ($array_type as $key => $name) {
            $checked = "";
            if (!$cat_compare && !$i) {
                $checked = "selected=\"selected\"";
            } else {
                if ($cat_compare == $key)
                    $checked = "selected=\"selected\"";
            }

            ?>
            <option value="<?php echo $key; ?>" <?php echo $checked; ?> ><?php echo $name; ?> </option>
            <?php
            $i++;
        } ?>
    </select>
</div><!-- END: form-group -->

<?php

TemplateHelper::dt_edit_image(FSText:: _('Image'), 'image', URL_ROOT . @$data->image, '', '', FSText::_('(Nếu bạn chọn loại banner là ảnh)'));
?>
<div class="form-group">
    <label><?php echo FSText::_('Flash'); ?></label>
    <?php if (@$data->flash) { ?>
        <embed height="117" width="221" menu="true" loop="true" play="true" src="<?php echo URL_ROOT . $data->flash ?>"
               pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"/>
    <?php } ?>
    <div class="fileUpload btn btn-primary ">
        <input type="file" class="upload" name="flash" id="flash"/>
    </div>
    <p class="help-block"><?php echo FSText::_('(Nếu bạn chọn loại banner là flash)'); ?></p>
</div><!-- END: form-group -->

<?php
TemplateHelper::dt_edit_text(FSText:: _('Nội dung'), 'content', @$data->content, '', 650, 450, 1, '(Nếu bạn chọn loại banner là HTML)', '', 'col-sm-3', 'col-sm-9');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#check_none').click(function () {
            $('.listItem option').each(function () {
                $(this).attr('selected', '');
            });
            $('.listItem').attr('disabled', 'disabled');
            $(".listItem").trigger("chosen:updated");
        });
        $('#check_all').click(function () {
            $('.listItem option').each(function () {
                $(this).attr('selected', 'selected');
            });
            $('.listItem').attr('disabled', 'disabled');
            $(".listItem").trigger("chosen:updated");
        });
        $('#check_select').click(function () {
            $('.listItem').removeAttr('disabled');
            $(".listItem").trigger("chosen:updated");
        });
    });
</script>

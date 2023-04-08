<?php
    $title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
    global $toolbar;
    $toolbar->setTitle($title);
    $toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png',1);
    $toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png',1); 
    $toolbar->addButton('Save',FSText :: _('Save'),'','save.png',1); 
    $toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   
    echo '  <div class="alert alert-danger" style="display:none" >
                    <span id="msg_error"></span>
            </div>';   

	$this -> dt_form_begin();
	
	TemplateHelper::dt_edit_text(FSText :: _('Tên tài liệu'),'name',@$data -> name);
    //TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
    //TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',@$data -> category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 10,0);
    //TemplateHelper::dt_edit_selectbox(FSText::_('Tài liệu của thành viên'),'user_id',@$data -> user_id,0,$memmber,$field_value = 'id', $field_label='full_name',$size = 10,0,1);
?>
   <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label"><?php echo FSText :: _('N&#417;i xu&#7845;t hi&#7879;n'); ?></label>
        <div class="col-sm-9 col-xs-12">
            <select data-placeholder="<?php echo FSText::_('Nơi xuất hiện') ?>" name ="menus_items[]" id ="menus_items" size="8" multiple="multiple" class='form-control chosen-select-no-results listItem' trigger = "chosen:updated" >
            <?php 
                $arr_menu_item = explode(',',@$data->courseid);
                $coursename = "";
                print_r($arr_menu_item);
                foreach($menus_items_all as $item) {
                    $html_check = "";
                    if(in_array($item->id,$arr_menu_item)) {
                        $html_check = "' selected='selected' ";
                    } 
            ?>
                    <option value="<?php echo $item->id?>" <?php echo $html_check; ?>><?php echo $item -> name; ?></option> 
            <?php } ?>
            </select>
        </div>
    </div>
<?php
    //TemplateHelper::dt_edit_selectbox(FSText::_('Nơi xuất hiện'),'courseid',@$data -> courseid,0,$menus_items_all,$field_value = 'item', $field_label='treename',$size = 2,1);
    TemplateHelper::dt_edit_image(FSText::_('Image'),'image',str_replace('/original/','/small/',URL_ROOT.@$data->image));
    TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',100,5,0);
    TemplateHelper::dt_date_pick ( FSText :: _('Thời gian upload' ), 'date_created', @$data->created_time?@$data->created_time:date('Y-m-d'), FSText :: _('Bạn vui lòng chọn thời gian hiển thị'), 20);
    //TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',100,9);
    TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
    TemplateHelper::dt_checkbox(FSText::_('Lựa chọn'),'is_view',@$data -> is_view,0,array(0=>FSText::_('Xem'),1=>FSText::_('Download') ));
    TemplateHelper::dt_edit_file(FSText :: _('File tài liệu'),'urlfile',@$data->urlfile, 'Upload File BDF');
	//TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');

	$this -> dt_form_end(@$data);


?>
<input type="hidden" name="val_file" id="val_file" value="<?php echo @$data->urlfile ?>">
<script type="text/javascript">
    $('.form-horizontal').keypress(function (e) {
          if (e.which == 13) {
            formValidator();
            return false;  
          }
    });
    function formValidator()
    {
         if(!notEmpty('name','Bạn chưa nhập tên tài liệu'))
            return false;
        if($("#filetype option:selected").val() == '0'){
            document.getElementById('msg_error').innerHTML = 'Bạn chưa chọn loại file';
            $('#msg_error').parent().show();
            elem.focus();
          return false;
        }
        if(!notEmpty('menus_items','Bạn chưa chọn nơi xuất hiện'))
            return false;
        a= $('#val_file').val();
        if(!a){
            if(!notEmpty('urlfile','Bạn chưa tải file tài liệu'))
                return false;
        }
        return true;
    }
    
</script>

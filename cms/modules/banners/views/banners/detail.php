<!-- HEAD -->
<?php
	$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
    
    $toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png');
    $toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png',1); 
    $toolbar->addButton('Save',FSText :: _('Save'),'','save.png',1); 

	$toolbar->addButton('back',FSText :: _('Cancel'),'','back.png');   
 
    $this->dt_col_start('col-xs-12 col-md-8 connectedSortable',1);
        echo ' 	<div class="alert alert-danger" style="display:none" >
                    <span id="msg_error"></span>
            </div>';
        // content
        $this -> dt_form_begin(1,4,$title.' '.FSText::_('banner'));
            include_once 'detail_base.php';
        $this->dt_form_end_col(); // END: col-4
            
    $this->dt_col_end(); // show the dong </div>
    
    $this->dt_col_start('col-xs-12 col-md-4 connectedSortable',1);
        // content
        $this -> dt_form_begin(1,4,$title.' '.FSText::_('Thông tin bổ sung'));
            TemplateHelper::dt_edit_selectbox(FSText::_('Danh mục'),'category_id',@$data->category_id,0,$categories,$field_value = 'id', $field_label='name',$size = 1,0);
            
        	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
        	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
            TemplateHelper::dt_edit_text(FSText :: _('Width'),'width',@$data -> width,0);
            TemplateHelper::dt_edit_text(FSText :: _('Height'),'height',@$data -> height,0);
?>    

	<div class="form-group">
        <label><?php echo FSText :: _('Nơi xuất hiện'); ?></label>
			<div class="" style="margin-bottom: 10px;">
				<input class="radio-custom" type="radio" id = 'check_none' name='area_select' value='none' <?php echo (!@$data->listItemid||@$data->listItemid == 'none')? 'checked="checked"':'';?> /> 
                <label for="check_none" class="radio-custom-label"><?php echo FSText::_('Không xuất hiện') ?></label>
               
				<input class="radio-custom" type="radio" id = 'check_select' name='area_select' value='select' <?php echo (@$data->listItemid && @$data->listItemid != 'none' && @$data->listItemid != 'all')? 'checked="checked"':'';?> />
				<label for="check_select" class="radio-custom-label"><?php echo FSText::_('Lựa chọn') ?></label>
                
                <input class="radio-custom" type="radio" id = 'check_all' name='area_select'  value='all' <?php echo (@$data->listItemid == 'all')? 'checked="checked"':'';?> />
			    <label for="check_all" class="radio-custom-label"><?php echo FSText::_('Tất cả') ?></label> 
            </div>
			<?php 
				$listItemid = @$data->listItemid;
				$checked = 0;
				$checked_all = 0;
				
				if((!@$data->listItemid) || @$data->listItemid === 'none' || @$data->listItemid === '0'){
					$checked = 0;
				} else if(@$data->listItemid === 'all'){
					$checked_all = 1;
				} else {
					$checked = 1;
					$checked_all = 0;
					$arr_menu_item = explode(',',@$data->listItemid);
				}
			?>
			<select data-placeholder="<?php echo FSText::_('Nơi xuất hiện') ?>" name ="menus_items[]" size="8" multiple="multiple" class='select2 listItem' <?php echo (!@$data->listItemid || @$data->listItemid == 'none' || @$data->listItemid == 'all')? 'disabled="disabled"':'';?> >
				<?php 
				
				foreach($menus_items_all as $item) {
					
					$html_check = "";
					if($checked_all){
						$html_check = "' selected='selected' ";
					} else {
						if($checked){
							if(in_array($item->id,$arr_menu_item)) {
								$html_check = "' selected='selected' ";
							}
						}
					}
				?>
					<option value="<?php echo $item->id?>" <?php echo $html_check; ?>><?php echo $item -> name; ?></option>
				<?php } ?>
			</select>
	</div><!-- END: type -->

<?php 
            TemplateHelper::dt_edit_selectbox(FSText::_('Danh mục tin tức'),'news_categories',@$data->news_categories,0,$news_categories,$field_value = 'id', $field_label='treename',$size = 1,1);
            TemplateHelper::dt_edit_selectbox(FSText::_('Danh mục sản phẩm'),'products_categories',@$data->products_categories,0,$products_categories,$field_value = 'id', $field_label='treename',$size = 1,1);
            TemplateHelper::dt_edit_selectbox(FSText::_('Danh mục trang tĩnh'),'contents_categories',@$data->contents_categories,0,$contents_categories,$field_value = 'id', $field_label='treename',$size = 1,1);
        $this->dt_form_end_col(); // END: col-4
        
    $this->dt_col_end(); // show the dong </div>
    
    $this -> dt_form_end(@$data,1,0); // the dong toan bo form
?>
<!-- END BODY-->
<script type="text/javascript">
    $('.form-horizontal').keypress(function (e) {
      if (e.which == 13) {
        formValidator();
        return false;  
      }
    });
    
    
	function formValidator()
	{
	    $('.alert-danger').show();	
        
		if(!notEmpty('name','Nhập tên banner'))
			return false;
            
        // if(!lengthMaxword('name',10,'Mỗi từ tối đa có 10 ký tự'))
        //     return false;
                
		$('.alert-danger').hide();
		return true;
	}
   

</script>

<!-- HEAD -->
<?php
	$title = @$data ? FSText::_('Edit'): FSText::_('Add');
	global $toolbar;
	$toolbar->setTitle($title);
    $toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png');
	$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png');
	$toolbar->addButton('save',FSText::_('Save'),'','save.png');
	$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png');

    $this -> dt_form_begin(1,4,$title.' '.FSText::_('Danh mục'),'fa-edit',1,'col-md-12',1);
    	TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
    	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
    	
        TemplateHelper::dt_edit_selectbox(FSText::_('Tỉnh/Thành phố'),'city_id',@$data -> city_id,0,$cities,$field_value = 'id', $field_label='name',$size = 1,0,1);
        TemplateHelper::dt_edit_selectbox(FSText::_('Quận/Huyện'),'districts_id',@$data -> districts_id,0,$districts,$field_value = 'id', $field_label='name',$size = 10,0,1);
    	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
    	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
        //TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',100,14,0);
    $this->dt_form_end_col(); // END: col-1
//	TemplateHelper::dt_edit_image(FSText :: _('Icon'),'icon',@$data -> icon);

	$this -> dt_form_end(@$data,1,0,2,'Cấu hình seo','',1,'col-sm-4');

?>

<script  type="text/javascript" language="javascript">
$(function(){
	$("select#city_id").change(function(){
		$.ajax({url: "index.php?module=location&view=wards&task=ajax_get_product_district&raw=1",
			 data: {cid: $(this).val()},
			  dataType: "text",
			  success: function(text) {
			    j = eval("(" + text + ")");
			    var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
				}
				$("#districts_id").html(options);
				$('#districts_id option:first').attr('selected', 'selected');
                $("#districts_id").trigger("chosen:updated");
			  }
		});
	});	
				
			
});
</script>

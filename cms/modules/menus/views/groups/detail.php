<!-- HEAD -->
	<?php 
	
	$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
    
    $toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png',1); 
	$toolbar->addButton('Save',FSText :: _('Save'),'','save.png',1);  
	$toolbar->addButton('cancel',FSText :: _('Cancel'),'','cancel.png'); 
    
    $this->dt_col_start('col-xs-12 col-md-8 connectedSortable',1);
        echo ' 	<div class="alert alert-danger" style="display:none" >
                        <span id="msg_error"></span>
                </div>';
                
        $this -> dt_form_begin(1,4,$title.' '.FSText::_('Nhóm menu'));
            TemplateHelper::dt_edit_text(FSText :: _('Tên nhóm'),'group_name',@$data -> group_name);
            TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1); 
            TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
        $this->dt_form_end_col(); // END: col-2
            
    $this->dt_col_end(); // show the dong </div>
    $this -> dt_form_end(@$data,1,0,2,'','',1);
?>
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
        
		if(!notEmpty('group_name','Nhập tên danh mục'))
			return false;
            
		$('.alert-danger').hide();
		return true;
	}
   

</script>


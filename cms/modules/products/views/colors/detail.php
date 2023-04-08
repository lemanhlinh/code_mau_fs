<?php 
    $title = @$data ? FSText::_('Edit'): FSText::_('Add'); 
    global $toolbar;
    $toolbar->setTitle($title);
    $toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
    $toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
    $toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png'); 
      
    $this -> dt_form_begin(1,4,$title.' '.FSText::_('Màu'));
    TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
    TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
    TemplateHelper::jscolorpicker(FSText:: _('Mã màu'),'code',@$data -> code);
    
    TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image),0,24);	
    TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1 );
    TemplateHelper::dt_checkbox(FSText::_('Tông'),'type',@$data -> type,0,array(1 => 'Tông đậm', 0 => 'Tông nhạt'));
    TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
    $this -> dt_form_end(@$data, 1, 0);
?>
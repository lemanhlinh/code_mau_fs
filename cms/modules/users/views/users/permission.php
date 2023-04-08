<!-- FOR TAB -->	
<?php 
	$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('permission_apply',FSText :: _('Apply'),'','apply.png'); 
	$toolbar->addButton('permission_save',FSText :: _('Save'),'','save.png'); 
	$toolbar->addButton('cancel',FSText :: _('Cancel'),'','cancel.png');
    
    $this->dt_col_start('col-xs-12 col-md-12 connectedSortable',1);  
	   $this -> dt_form_begin(1,4,$title.' '.FSText::_('Phân quyền'));
?>
<!-- END HEAD-->
    <div class="tab-content">
        <div class="tab-pane active" id="fragment-1">
            <?php include_once 'permission_base.php';?>            
        </div>
    </div>
<?php 
       $this->dt_col_end(); // show the dong </div>
    
    $this -> dt_form_end(@$data,1,0); // the dong toan bo form
?>
<div class="sv_bt" id="sv_bt"></div>
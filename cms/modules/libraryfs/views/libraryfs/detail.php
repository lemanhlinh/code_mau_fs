<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css" />
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<?php
	$title = @$data ? FSText :: _('Edit'): FSText :: _('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','',1); 
	$toolbar->addButton('apply',FSText :: _('Apply'),'','',1); 
	$toolbar->addButton('save',FSText :: _('Save'),'','',1); 
	$toolbar->addButton('back',FSText :: _('Cancel'),'','');   
  
    $this->dt_col_start('col-xs-12 col-md-4 connectedSortable',1);   
        echo ' 	<div class="alert alert-danger alert-dismissible" style="display:none" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span id="msg_error"></span>
                </div>';      
    	//$this -> dt_form_begin(1,4,$title.' '.FSText::_('News'));
        $this -> dt_form_begin(1,4,$title.' '.FSText::_('Function'),'fa-edit',1,'col-md-8',1);
            TemplateHelper::dt_edit_text(FSText :: _('Tên chức năng'),'name',@$data -> name);
        	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
            TemplateHelper::dt_edit_selectbox(FSText::_('Module'),'category_id',@$data -> category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 10,0,1);
            TemplateHelper::dt_edit_selectbox(FSText::_('Tác giả'),'user_id',@$data -> user_id,0,$member,$field_value = 'id', $field_label='full_name',$size = 1,0,1);
            TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering);
            TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1,'','','','col-sm-4','col-sm-8');
            TemplateHelper::dt_edit_image(FSText :: _('Hình ảnh minh họa'),'image',str_replace('/original/','/small/',URL_ROOT.@$data->image));
        	
            //TemplateHelper::dt_edit_text(FSText :: _('Link video'),'video',@$data -> video,'',100,1,0,'','','col-sm-3','col-sm-9');
            
        $this->dt_form_end_col(); // END: col-1
  
        $this -> dt_form_begin(1,2,FSText::_('Quản trị'),'fa-user',1,'col-md-4 fl-right');
            TemplateHelper::dt_text(FSText :: _('Người tạo'),@$data -> author);
            TemplateHelper::dt_text(FSText :: _('Thời gian tạo'),date('H:i:s d/m/Y',strtotime(@$data -> created_time)));
            TemplateHelper::dt_text(FSText :: _('Người sửa cuối'),@$data -> author_last);
            TemplateHelper::dt_text(FSText :: _('Thời gian sửa'),date('H:i:s d/m/Y',strtotime(@$data -> edited_time)));
        $this->dt_form_end_col(); // END: col-4
         
        //$this -> dt_form_begin(1,2,FSText::_('Kích hoạt'),'fa-unlock',1,'col-md-4 fl-right');
            //TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1,'','','','col-sm-4','col-sm-8');
            //TemplateHelper::dt_checkbox(FSText::_('Hiển thị trang chủ'),'show_in_homepage',@$data -> show_in_homepage,0,'','','','col-sm-4','col-sm-8');
            
            //TemplateHelper::datetimepicke( FSText :: _('Published time' ), 'created_time', @$data->created_time?@$data->created_time:date('Y-m-d H:i:s'),'', 20,FSText :: _('Bạn vui lòng chọn thời gian hiển thị'),'col-md-3','col-md-4');
        //$this->dt_form_end_col(); // END: col-2
        
        //$this -> dt_form_begin(1,4,FSText::_('Content'),'fa-info',1,'col-md-8');
            //TemplateHelper::dt_edit_text(FSText :: _(''),'content',@$data -> content,'',650,450,1,'','','col-sm-2','col-sm-12');
        //$this->dt_form_end_col(); // END: col-4
        
     $this->dt_col_end(); 
     
    //$this -> dt_form_end(@$data,1,0,2,'Cấu hình seo');
    $this->dt_col_start('col-xs-12 col-md-8 connectedSortable');
        $this -> dt_form_begin(1,2,FSText::_('Nội dung'),'fa-info',1,'col-md-4');     
?>
    <div class="nav-tabs-custom" >
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#contronler-chart" data-toggle="tab" aria-expanded="false">contronler</a></li>
              <li class=""><a href="#model-chart" data-toggle="tab" aria-expanded="true">model</a></li>
              <li class=""><a href="#view-chart" data-toggle="tab" aria-expanded="true">view</a></li>
              <li class=""><a href="#css-chart" data-toggle="tab" aria-expanded="true">css</a></li>
              <li class=""><a href="#js-chart" data-toggle="tab" aria-expanded="true">js</a></li>
              <li class=""><a href="#fsrouter-chart" data-toggle="tab" aria-expanded="true">fsrouter</a></li>
              <li class=""><a href="#htaccess-chart" data-toggle="tab" aria-expanded="true">htaccess</a></li>
              <li class=""><a href="#sql-chart" data-toggle="tab" aria-expanded="true">sql</a></li>
            </ul>
            <div class="tab-content box-body">
              <div class="chart tab-pane active" id="contronler-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'contronler',@$data -> contronler,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="model-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'model',@$data -> model,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="view-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'views',@$data -> views,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="css-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'css',@$data -> css,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="js-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'js',@$data -> js,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="fsrouter-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'fsrouter',@$data -> fsrouter,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="htaccess-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'htaccess',@$data -> htaccess,'',650,450,1); ?>
              </div>
              <div class="chart tab-pane" id="sql-chart" >
                <?php TemplateHelper::dt_edit_text(FSText :: _(''),'sql',@$data -> sql,'',650,450,1); ?>
              </div>  
          </div>
        </div>    
<?php    
        $this->dt_form_end_col(); // END: col-4
        
        $this -> dt_form_begin(1,2,FSText::_('Summary'),'fa-info',1,'col-md-4');
            TemplateHelper::dt_edit_text(FSText :: _(''),'summary',@$data -> summary,'',100,5,0,'','','col-sm-2','col-sm-12');
            //TemplateHelper::dt_edit_text(FSText :: _('Thông tin chi tiết'),'description',@$data -> description,'',650,450,1,'','','col-sm-2','col-sm-12');
        $this->dt_form_end_col(); // END: col-4
        
    $this->dt_col_end(); // show the dong </div>
    
    $this -> dt_form_end(@$data,1,0,2,'Cấu hình seo','',1,'col-sm-4');
?>
<script type="text/javascript">
  //  $('.form-horizontal').keypress(function (e) {
//      if (e.which == 13) {
//        formValidator();
//        return false;  
//      }
//    });
    
	function formValidator()
	{
	    $('.alert-danger').show();	
        
		if(!notEmpty('name','Bạn phải nhập tiêu đề'))
			return false;
        
        if(!lengthMaxword('name',10,'Mỗi từ tối đa có 10 ký tự'))
            return false;
            
        if(!notEmpty('image','bạn phải nhập hình ảnh'))
			return false;
            
        if(!notEmpty('category_id','Bạn phải chọn danh mục'))
		   return false;
               
        if(!notEmpty('summary','Bạn phải nhập nội dung mô tả'))
		   return false;
        
        //if (CKEDITOR.instances.content.getData() == '') {
//            invalid("content", 'Bạn phải nhập nội dung chi tiết');
//            return false;
//        }
            
		$('.alert-danger').hide();
		return true;
	}
   

</script>
<?php //include 'detail_seo.php'; ?>

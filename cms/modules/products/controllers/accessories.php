<?php
	class ProductsControllersAccessories  extends Controllers
	{
		function __construct()
		{	
			$this->limit = 20; 
			$this->view = 'products' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $model->get_data();
			$categories = $model->get_categories_tree();
			$type = $model->get_type();
			$manufactories = $model->get_manufactories();
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function view_name($data){
			$link = FSRoute::_('index.php?module=products&view=product&id='.$data->id.'&code='.$data -> alias.'&ccode='.$data-> category_alias);
			return '<a target="_blink" href="' . $link . '" title="Xem ngoài font-end">'.$data -> name.'</a>';
		}
	
		function add()
		{
			$model = $this -> model;
			$cid = FSInput::get('cid');
//			if($cid)
//			{
			
				$category= $model->get_record_by_id($cid,'fs_products_categories'); 
				$tablename = $category->tablename;
				$relate_categories = $model->getRelatedCategories($category -> tablename);
				$manufactories = $model->getManufactories($category -> tablename);
			
				// types
				$types = $model -> get_records('published = 1','fs_products_types');
				
				// extend field
//				$extend_fields = $model->getExtendFields($category -> tablename);
//				$data_foreign = $model -> get_data_foreign($extend_fields);
				$maxOrdering = $model->getMaxOrdering();
				
				// all categories
				$categories = $model->get_categories_tree();
				
				// news related
				$news_categories = $model->get_news_categories_tree();
								
				/*
				 * Lấy tham số cấu hình module
				 */
				$module_params = $model -> module_params;
				FSFactory::include_class('parameters');
				$current_parameters = new Parameters($module_params);
				$use_manufactory   = $current_parameters->getParams('use_manufactory');
				$use_model   = $current_parameters->getParams('use_model');
				if($use_manufactory){
					$manufactories = $model->getManufactories($tablename);
					if($use_model)
						$product_models = $model->get_product_models($manufactories[0]->id);
				}
				$uploadConfig = base64_encode('add|'.session_id());
				include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
//			}
//			else{
//				$categories = $model->get_categories_tree();
//				include 'modules/'.$this->module.'/views/'.$this -> view.'/select_categories.php';
//			}
		}
		
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
			$data = $model->get_record_by_id($id);
			$category= $model->get_record_by_id($data->category_id,'fs_products_categories');
			$tablename = $data->tablename ?  $data->tablename  : $category -> tablename;
			// extend field
			$extend_fields = $model->getExtendFields($tablename); 
			$relate_categories = $model->getRelatedCategories($tablename);
			
			// products related
			$categories = $model->get_categories_tree();
			$products_related = $model -> get_products_related($data -> products_related);
			
			// news related
			$news_categories = $model->get_news_categories_tree();
			$news_related = $model -> get_news_related($data -> news_related);
			
			
			// types
			$types = $model -> get_records('published = 1','fs_products_types');
			// colors
			$colors = $model -> get_records('published = 1','fs_products_colors');
			foreach (@$colors as $item)
			{
				$data_by_color = $model -> get_data_by_color($item->id,$data->id );
				if(count($data_by_color)){
					$array_data_by_color [$item->id] = $data_by_color;	
				}
			}
			$data_ext = $model->getProductExt($data -> tablename,$data->id);
			$data_foreign = $model -> get_data_foreign($extend_fields);
			// together
			$product_compatable = $model -> get_products_by_ids($data -> products_compatable);
			$products_incentives = $model -> get_products_incentives($data -> id);
			
			/*
			 * Lấy tham số cấu hình module
			 */
			$module_params = $model -> module_params;
			FSFactory::include_class('parameters');
			$current_parameters = new Parameters($module_params);
			$use_manufactory   = $current_parameters->getParams('use_manufactory');
			$use_model   = $current_parameters->getParams('use_model');
			if($use_manufactory){
				$manufactories = $model->getManufactories($tablename);
				if($use_model)
					$product_models = $model->get_product_models($data -> manufactory);
			}
			// add hidden input tag : ext_id into detail form 
			$this->params_form = array('ext_id'=>@$data_ext -> id) ;
			$uploadConfig = base64_encode('edit|'.$id);			
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		
		function ajax_get_product_models(){
			$model  = $this -> model;
			$cid = FSInput::get('cid');
			$rs  = $model -> get_product_models($cid);
			
			$json = '['; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = "{id: $item->id, name: '$item->name'}";
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}
	
		function export(){
			setRedirect('index.php?module='.$this -> module.'&view='.$this -> view.'&task=export_file&raw=1');
		}	
		
		function export_file(){
			FSFactory::include_class('excel','excel');
//			require_once 'excel.php';
			$model  = $this -> model;
			$filename = 'product-export';
			$list = $model->get_data_for_export();
			$categories = $model -> get_records('','fs_products_categories','id,code,alias,name,tablename','','','id');
			if(empty($list)){
				echo 'error';exit;
			}else {
				$excel = FSExcel();
				$excel->set_params(array('out_put_xls'=>'export/excel/'.$filename.'.xls','out_put_xlsx'=>'export/excel/'.$filename.'.xlsx'));
				$style_header = array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb'=>'ffff00'),
					),
					'font' => array(
						'bold' => true,
					)
				);
				$style_header1 = array(
					'font' => array(
						'bold' => true,
					)
				);
				
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
				
				$excel->obj_php_excel->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('C')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('G')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('I')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('J')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('K')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				$excel->obj_php_excel->getActiveSheet()->getStyle('L')->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
				
				
				$excel->obj_php_excel->getActiveSheet()->setCellValue('A1', 'Id');
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Category');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Name');
			//	$excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Image');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('C1', 'Code');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('D1', 'Partnumber');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('E1', 'Manufactory');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('F1', 'Summary'); // overview
				$excel->obj_php_excel->getActiveSheet()->setCellValue('G1', 'Specs'); // Specs
				$excel->obj_php_excel->getActiveSheet()->setCellValue('H1', 'Description');// ProDescription
				$excel->obj_php_excel->getActiveSheet()->setCellValue('I1', 'Driver'); // driverLink
				$excel->obj_php_excel->getActiveSheet()->setCellValue('J1', 'RetailPrice');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('K1', 'DealerPrice');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('L1', 'Published');
				$i = 0;
				$total_money = 0;
				$total_quantity = 0;
				foreach ($list as $item){
					$key = isset($key)?($key+1):2;
					$excel->obj_php_excel->getActiveSheet()->setCellValue('A'.$key, $item->id);		
//					$excel->obj_php_excel->getActiveSheet()->setCellValue('B'.$key, @$categories[$item->category_id]->code);		
					$excel->obj_php_excel->getActiveSheet()->setCellValue('B'.$key, $item->name);	
				    $excel->obj_php_excel->getActiveSheet()->setCellValue('C'.$key, $item->code);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('D'.$key, $item->partnumber);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('E'.$key, $item->manufactory_name);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('F'.$key, $item->summary);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('G'.$key, ''); // đang làm
					$excel->obj_php_excel->getActiveSheet()->setCellValue('H'.$key, $item->description);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('I'.$key, $item->driver);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('J'.$key, $item->price);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('K'.$key, $item->dealer_price);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('L'.$key, $item->published);
					$excel->obj_php_excel->getActiveSheet()->getRowDimension($i + 2)->setRowHeight(20);
					$i ++;
				}
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('D'.($i+2), 'Tổng');
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('E'.($i+2), $total_quantity);
//				$excel->obj_php_excel->getActiveSheet()->setCellValue('F'.($i+2), $total_money);
				
				$excel->obj_php_excel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Arial');
				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->applyFromArray( $style_header );
				$excel->obj_php_excel->getActiveSheet()->duplicateStyle( $excel->obj_php_excel->getActiveSheet()->getStyle('A1'), 'B1:L1' );
				
//				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getAlignment()->setIndent(1);// padding cell
				
				$output = $excel->write_files();
				
				$path_file =   PATH_ADMINISTRATOR.DS.str_replace('/',DS, $output['xls']);
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private",false);			
				header("Content-type: application/force-download");			
				header("Content-Disposition: attachment; filename=\"".$filename.'.xls'."\";" );			
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: ".filesize($path_file));
				readfile($path_file);
			}
		}
		// remove products_together
		function remove_compatable(){
			$model  = $this -> model;
			if($model -> remove_compatable()){
				echo '1';
				return;
			}else{
				echo '0';
				return;
			}
		}
		// remove products_together
		function remove_incentives(){
			$model  = $this -> model;
			if($model -> remove_incentives()){
				echo '1';
				return;
			}else{
				echo '0';
				return;
			}
		}
		function ajax_get_products_related(){
			$model = $this -> model;
			$data = $model->ajax_get_products_related();
			$html = $this -> products_genarate_related($data);
			echo $html;
			return;
		}
		function products_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
				$html .= '<div class="products_related">';
				foreach ($data as $item){
					if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
						$html .= '<div class="red products_related_item  products_related_item_'.$item -> id.'" onclick="javascript: set_products_related('.$item->id.')" style="display:none" >';	
						$html .= $item -> name;				
						$html .= '</div>';					
					}else{
						$html .= '<div class="products_related_item  products_related_item_'.$item -> id.'" onclick="javascript: set_products_related('.$item->id.')">';	
						$html .= $item -> name;				
						$html .= '</div>';	
					}
				}
				$html .= '</div>';
				return $html;
		}
		
		/***********
		 * NEWS RELATED
		 ************/
		function ajax_get_news_related(){
			$model = $this -> model;
			$data = $model->ajax_get_news_related();
			$html = $this -> news_genarate_related($data);
			echo $html;
			return;
		}
		function news_genarate_related($data){
			$str_exist = FSInput::get('str_exist');
			$html = '';
				$html .= '<div class="news_related">';
				foreach ($data as $item){
					if($str_exist && strpos(','.$str_exist.',', ','.$item->id.',') !== false ){
						$html .= '<div class="red news_related_item  news_related_item_'.$item -> id.'" onclick="javascript: set_news_related('.$item->id.')" style="display:none" >';	
						$html .= $item -> title;				
						$html .= '</div>';					
					}else{
						$html .= '<div class="news_related_item  news_related_item_'.$item -> id.'" onclick="javascript: set_news_related('.$item->id.')">';	
						$html .= $item -> title;				
						$html .= '</div>';	
					}
				}
				$html .= '</div>';
				return $html;
		}
		/***********
		 * end NEWS RELATED.
		 ************/
	function is_hot()
	{
		$model = $this -> model;
		$rows = $model->is_hot(1);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was event'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when hot record'),'error');	
		}
	}
	function unis_hot()
	{
		$model = $this -> model;
		$rows = $model->is_hot(0);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was un_hot'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when un_hot record'),'error');	
		}
	}	
	function is_new()
	{
		$model = $this -> model;
		$rows = $model->is_new(1);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was event'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when new record'),'error');	
		}
	}
	function unis_new()
	{
		$model = $this -> model;
		$rows = $model->is_new(0);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was un_new'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when un_new record'),'error');	
		}
	}
	function is_sell()
	{
		$model = $this -> model;
		$rows = $model->is_sell(1);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was event'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when old record'),'error');	
		}
	}
	function unis_sell()
	{
		$model = $this -> model;
		$rows = $model->is_sell(0);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was un_sell'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when un_old record'),'error');	
		}
	}
	function is_old()
	{
		$model = $this -> model;
		$rows = $model->is_old(1);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was event'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when old record'),'error');	
		}
	}
	function unis_old()
	{
		$model = $this -> model;
		$rows = $model->is_old(0);
		$link = 'index.php?module='.$this -> module.'&view='.$this -> view;
		$page = FSInput::get('page',0);
		if($page > 1)
			$link .= '&page='.$page;
		if($rows)
		{
			setRedirect($link,$rows.' '.FSText :: _('record was un_old'));	
		}
		else
		{
			setRedirect($link,FSText :: _('Error when un_old record'),'error');	
		}
	}
	function format_money($row)
	{	if($row)
			return format_money($row,'VNĐ');
		else 
		return $row;
	}
	/**
	* Lấy danh sách ảnh của sản phẩm
	*/
	function get_other_images(){
        	$list_other_images = $this->model->get_other_images();   
	        include 'modules/' . $this->module . '/views/' . $this->view . '/detail_images_list.php';
	} 
	/**
	* Upload nhiều ảnh cho sản phẩm
	*/ 
    	function upload_other_images(){
        	$this->model->upload_other_images();
	 }
	 /**
	 * Xóa ảnh
	 */ 
    	 function delete_other_image(){
        	$this->model->delete_other_image();
	 }
	    
	 /**
	 * Sắp xếp ảnh
	 */
    	function sort_other_images(){
        	$this->model->sort_other_images();
    	} 
}
	
?>
<?php
	class OrderControllersOrder  extends Controllers
	{
		function __construct()
		{
			$this->view = 'order' ; 
			parent::__construct(); 
			$array_status = array( 
                                0 => FSText::_('Chưa hoàn tất'),
                                1 => FSText::_('Đã hoàn tất'),
                                2 =>FSText::_('Đã hủy')
                                );
			$this -> arr_status = $array_status;
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			$text2 = FSInput::get('text2');
			if($text2){
				$_SESSION[$this -> prefix.'text2'] = $text2;
			}
			
			$model  = $this -> model;
		
			$list = $model->get_data('');
			
			$array_status = $this -> arr_status;
			$array_obj_status = array();
			foreach($array_status as $key => $name){
				$array_obj_status[] = (object)array('id'=>($key+1),'name'=>$name);
			}
			
			$pagination = $this -> model->getPagination('');
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
        
		function showStatus($status){
			$arr_status = $this -> arr_status;
			echo @$arr_status[$status];
		}

		function edit()
		{
			$model = $this -> model;
			$order  = $model -> getOrderById();
			$data = $model -> get_data_order();
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
		
		function cancel_order(){
			$model = $this -> model;
			
			$rs  = $model -> cancel_order();
			
			$Itemid = 61;	
			$id = FSInput::get('id');
			$link = 'index.php?module=order&view=order&task=edit&id='.$id;
			if(!$rs){
				$msg = 'Không hủy được đơn hàng';
				setRedirect($link,$msg,'error');
			}
			else {
				$msg = 'Đã hủy được đơn hàng';
				setRedirect($link);
			}
		}
		function finished_order(){
			$model = $this -> model;
			
			$rs  = $model -> finished_order();
			
			$Itemid = 61;	
			$id = FSInput::get('id');
			$link = 'index.php?module=order&view=order&task=edit&id='.$id;
			if(!$rs){
				$msg = 'Không hoàn tất được đơn hàng';
				setRedirect($link,$msg,'error');
			}
			else {
				$msg = 'Đã hoàn tất được đơn hàng thành công';
				setRedirect($link);
			}
		}
	// Excel toàn bộ danh sách copper ra excel
		function export(){
			setRedirect('index.php?module='.$this -> module.'&view='.$this -> view.'&task=export_file&raw=1');
		}	
		function export_file(){
			FSFactory::include_class('excel','excel');
//			require_once 'excel.php';
			$model  = $this -> model;
			$filename = 'order-export';
			$list = $model->get_member_info();
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
			$excel->obj_php_excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
				$excel->obj_php_excel->getActiveSheet()->setCellValue('A1', 'Mã đơn hàng');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('B1', 'Người mua');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('C1', 'Giá trị');
				$excel->obj_php_excel->getActiveSheet()->setCellValue('D1', 'Ngày mua');
				foreach ($list as $item){
					$key = isset($key)?($key+1):2;
					$excel->obj_php_excel->getActiveSheet()->setCellValue('A'.$key, 'DH'.str_pad($item -> id, 8 , "0", STR_PAD_LEFT) );
					$excel->obj_php_excel->getActiveSheet()->setCellValue('B'.$key, $item->sender_name);
					$excel->obj_php_excel->getActiveSheet()->setCellValue('C'.$key, format_money($item -> total_after_discount));
					$excel->obj_php_excel->getActiveSheet()->setCellValue('D'.$key, $item->created_time);
				}
				$excel->obj_php_excel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Arial');
				$excel->obj_php_excel->getActiveSheet()->getStyle('A1')->applyFromArray( $style_header );
				$excel->obj_php_excel->getActiveSheet()->duplicateStyle( $excel->obj_php_excel->getActiveSheet()->getStyle('A1'), 'B1:D1' );
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
	}
	
?>
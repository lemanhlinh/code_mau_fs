<?php
	class ProductsControllersProducts_compatable  extends Controllers
	{
		function __construct()
		{
			$this->view = 'products_compatable' ; 
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			$model  = $this -> model;
			$list = $model->get_data();
		//	$categories = $model->get_categories_tree();
			
			$pagination = $model->getPagination();
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		
		function add_products(){
			$model  = $this -> model;
			$json = '{';
			if(!$model -> check_add()){
				$json .= "'status':2,'html':''";
				$json .= '}'; // end the json array element
				echo $json;
				return;
			}
			if($model -> add_product_compatable()){
				$html = $this -> genarate_html();
				$json .= "'status':1,'html':'".$html."'";
				$json .= '}'; // end the json array element
				echo $json;
				return;
			}else{
				$json .= "'status':0,'html':''";
				$json .= '}'; // end the json array element
				echo $json;
				return;
			}
		}
		
		function genarate_html(){
			$model  = $this -> model;
			$product_name = $model -> get_product_name();
			$id = FSInput::get('id',0,'int');
			$product_compatable_id = FSInput::get('product_compatable_id',0,'int');
			if(!$id || !$product_compatable_id)	
				return;
			$html = '';
			$html .= '<tr id="record_'.$product_compatable_id.'">';
			$html .= '		<td>';
			$html .= '			'.$product_name.'	</td>';
			$html .= '		<td>';
			$html .= '			'.$product_compatable_id.'					</td>';
			$html .= '		<td>';
			$html .= '			<a href="javascript: remove_compatable('.$id.','.$product_compatable_id.')">Xóa</a>';
			$html .= '		</td>';
			$html .= '	</tr>';
			return $html;
		}
	}
?>
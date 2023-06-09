<?php 
	class ProductsModelsImport extends FSModels
	{
		function __construct() {
			
			$this->type = 'products';
			$this->table_name = 'fs_products';
			$this->use_table_extend = 1;
			$this->table_category = 'fs_' . $this->type . '_categories';
			$this->table_types = 'fs_' . $this->type . '_types';;
			
			$this->calculate_filters = 1;
			
			parent::__construct ();
			$this->load_params ();
		}
		
		function get_data_for_export($tablename)
		{
			
			global $db;
			$query = " SELECT id,name,code,alias,summary,description,image,manufactory,manufactory_name,driver,partnumber,price,dealer_price ";
			$query .= " FROM fs_products ";
			$query .= " WHERE tablename = '".$tablename."'";
			$query .= " ORDER BY  ordering DESC, id DESC ";
			$query .= "LIMIT 0, 1 ";
			global $db;
			$db -> query($query);
			$rs = $db->getObjectList();
				return $rs;
		}
		// Cập nhật thông tin  sản phẩm
		function import_film_info($excel,$path){
			$fsstring = FSFactory::getClass('FSString','','../');	
			$file_path = $path.$excel;
			require_once("../libraries/excel/phpExcelReader/Excel/reader.php");
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read($file_path);
			unset($total_product);			
			$total_product =count($data->sheets[0]['cells']);
			$info_import_product =array();
			unset($j);
			
			$categories = $this -> get_records('','fs_products_categories','*',' ordering DESC ','','id');
			$manufactories = $this -> get_records('','fs_manufactories','*','','','code');
			

			// lấy toàn bộ dữ liệu trong bảng products_tables
			$products_tables_all = $this -> get_records('','fs_products_tables');
			
			//Lấy  tên trong bang exel
			$arr_field_name = $data->sheets['0']['cells']['1'];
			$total_field_name =count($arr_field_name);
			//end Lấy  tên trong bang exel
			$fsstring = FSFactory::getClass('FSString','','../');
			$rs = 0;
			//$total_product ;
			// echo $total_product;die;
			//846
			//519
			for($j=2 ;$j<=$total_product;$j++){
				$info_import_product['name'] = preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'Name',$arr_field_name));
				$info_import_product['name'] =  $this->seems_utf8($info_import_product['name'])?$info_import_product['name']:utf8_encode($info_import_product['name']);
				$info_import_product['category'] = preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'Category',$arr_field_name));
				$info_import_product['category'] =  $this->seems_utf8($info_import_product['category'])?$info_import_product['category']:utf8_encode($info_import_product['category']);
				$info_import_product['manufactory_code'] = preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'NCC',$arr_field_name));
				$info_import_product['code'] = preg_replace('/[*]+/i','',$this->get_cell_content_by_name($data,0,$j,'QR',$arr_field_name));	
				$info_import_product['code'] =  $this->seems_utf8($info_import_product['code'])?$info_import_product['code']:utf8_encode($info_import_product['code']);
				$info_import_product['color'] = preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'Color',$arr_field_name));
				$info_import_product['color'] =  $this->seems_utf8($info_import_product['color'])?$info_import_product['color']:utf8_encode($info_import_product['color']);
				$info_import_product['size'] = preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'Size',$arr_field_name));
				$info_import_product['size'] =  $this->seems_utf8($info_import_product['size'])?$info_import_product['size']:utf8_encode($info_import_product['size']);
				$info_import_product['wholesale_prices'] =  preg_replace('/[^0-9]+/i','',$this->get_cell_content_by_name($data,0,$j,'Wholesale price',$arr_field_name));
				$info_import_product['retail_price'] =  preg_replace('/[^0-9]+/i','',$this->get_cell_content_by_name($data,0,$j,'Retail price',$arr_field_name));
				$info_import_product['discount_unit'] ='';
				$info_import_product['link'] = $this->get_cell_content_by_name($data,0,$j,'Link',$arr_field_name);
				$info_import_product['link'] =  $this->seems_utf8($info_import_product['link'])?$info_import_product['link']:utf8_encode($info_import_product['link']);
				if(!$info_import_product['name'] || !$info_import_product['code'])
					continue;
				$row = array();
				$row['name'] = $info_import_product['name'];
				$row['alias'] = $fsstring -> stringStandart($row['name']);
				$row['code']  = $info_import_product['code'];
				$row['price_old']  = $info_import_product['retail_price'];
				$row['wholesale_prices']  = $info_import_product['wholesale_prices'];
				$row['retail_price']  = $info_import_product['retail_price'];
				$row['edited_time']  = date('Y-m-d H:i:s');
				$row['published'] = 1;
				$row['ordering'] = $this->get_max_ordering('fs_products');
				$row['discount'] = '';
				$row['source_website'] = $info_import_product['link'];
				

				if($info_import_product['discount_unit']){// percent
					if($row['discount'] > 100 || $row['discount'] < 0)
						continue;
					$row['price']  = $row['price_old'] * (100 - $row['discount'])/100;
					$row['discount_unit'] = 'percent';
				}else{ // price
					if($row['discount'] > $row['price_old'] || $row['discount'] < 0)
						continue;
					$row['price']  = $row['price_old'] - $row['discount'];
					$row['discount_unit'] = 'price';
				}
				
				if(isset($info_import_product['id']) && !empty($info_import_product['id'])){
					$result = $this -> _update($row,'fs_products','  id = '.$info_import_product['id']);
					if($result)
						$rs++;
				}


				//cat 
				$category_id = '';
				$cat_exit = 0;
				
				$category_alias = $fsstring -> stringStandart($info_import_product['category']);
				foreach($categories as $c){
					if($c -> name && strpos($category_alias,$c -> alias) === 0){
						$category_id = $c -> id;
						$cat_exit = 1;
						break;
					}
				}
				$cat = isset($categories[$category_id])?$categories[$category_id]:'';
				if($cat){
					$row ['category_id'] = $cat->id;
					$row ['category_id_wrapper'] = $cat->list_parents;
					$row ['category_root_alias'] = $cat->root_alias;
					$row ['category_alias_wrapper'] = $cat->alias_wrapper;
					$row ['category_published'] = $cat->published;
					$row ['category_name'] = $cat->name;
					$row ['category_alias'] = $cat->alias;
					$row ['tablename'] = $cat->tablename;
				}


				//manufactories 
				$manufactories_id = '';
				$manu_exit = 0;
				foreach($manufactories as $m){
					if($m -> code && strpos($info_import_product['manufactory_code'],$m -> code) === 0){
						$manufactories_code = $m -> code;
						$manu_exit = 1;
						break;
					}
				}
				if(!$manu_exit){
					$manu_id = $this -> save_manu($info_import_product['manufactory_code']);
					$manufactories[$info_import_product['manufactory_code']] = $this -> get_record_by_id($manu_id,'fs_manufactories');
				}
				$manu = isset($manufactories[$manufactories_code])?$manufactories[$manufactories_code]:'';
				if($manu){
					$row ['manufactory'] = $manu -> id;
					$row ['manufactory_alias'] = $manu->alias;
					$row ['manufactory_name'] = $manu->name;
				}
			
				$product_exist =$this -> get_record('code="'.$info_import_product['code'].'"','fs_products','id,alias,name,tablename,category_id,colors,sizes,image');
								

				// colors
				$str_color_ids = '';
				$i = 0;
				if(!$info_import_product['color']){
					
					$info_import_product['color'] ='Màu như hình';
				}
				$arr_color_req = explode(',',$info_import_product['color']);
				foreach($arr_color_req as $c_r){
					
					$color_exit = 0;
					$c_r = trim($c_r);
					$color_alias = $fsstring -> stringStandart($c_r);
					$color_exit = $this -> get_record('alias="'.$color_alias .'"','fs_products_colors','id');
						
					if($i && $color_exit)
						$str_color_ids .= ',';
					if($color_exit)
						$str_color_ids .= $color_exit -> id;
						
					if(!$color_exit){
						$color_id = $this -> save_color($c_r);
					}
					$i ++;	
				}
				if($str_color_ids){
					$str_color = ',' . $str_color_ids . ',';
					$row['colors'] = $str_color ;
				}

				//size
				$str_size_ids = '';
				$ii = 0;
				if(!$info_import_product['size']){

					$info_import_product['size'] ='Mặc định';
				}
				$arr_size_req = explode(',',$info_import_product['size']);
				
				foreach($arr_size_req as $s_r){
					$size_exit = 0;
				 	$s_r = trim($s_r);
				 	$size_alias = $fsstring -> stringStandart($s_r);
				 	$size_alias = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $size_alias);
					$size_exit = $this -> get_record('alias="'.$size_alias .'"','fs_products_sizes','id');			
					if($ii && $size_exit)
						$str_size_ids .= ',';
					if($size_exit)
						$str_size_ids .= $size_exit -> id;
						
					if(!$size_exit){
						$size_id = $this -> save_size($s_r);
					}
					$ii ++;	
				}
				if($str_size_ids){
					$str_size = ',' . $str_size_ids . ',';
					$row['sizes'] = $str_size ;
				}


				if(!$product_exist){
					$row['created_time'] =date('Y-m-d H:i:s');
					$id = $this -> _add($row,'fs_products',1);
					echo "++SUC:The moi ".$j."   <br/>";
					if($id)
						$rs++;
				}else{
					
					$table_name = isset($product_exist->tablename)?$product_exist->tablename:'';
					$result = $this -> _update($row,'fs_products','  id = "'.$product_exist -> id.'"',1);

					echo "++SUC:Cap nhap ".$j." ---> Ma id ".$product_exist -> id."<br/>";

					$row['image'] = $product_exist->image;
					$ext_id = $this->save_extend_from_specs_in_excel('', $product_exist -> id,0,'',$table_name,$row,0 );

					$id =  $product_exist -> id;
					$rs++;
				}
			}
			return $rs;
		}
		
		function save_category($category_name){
			if (! $category_name) {
				return ;
			}
			$row['name'] = $category_name;

			$fsstring = FSFactory::getClass('FSString','','../');
			$row['alias'] = $fsstring -> stringStandart($category_name);
			$row['level'] = 0;
			$row['published'] = 1;	
			$row['show_in_homepage'] = 1;
			$row['ordering'] = $this->get_max_ordering('fs_products_categories');
			$row['updated_time'] = date('Y-m-d H:i:s');
			$row['created_time'] =date('Y-m-d H:i:s');

			$record_id = $this -> _add($row,'fs_products_categories',1);

			if($record_id){
				$this -> update_parent($record_id,$row['alias']);
			}
			return $record_id;

		}
	
		function update_parent($cid,$alias){
			$record =  $this->get_record_by_id($cid,'fs_products_categories');
			if($record -> parent_id){
				$parent =  $this->get_record_by_id($record -> parent_id,'fs_products_categories');
				$list_parents = ','.$cid.$parent -> list_parents ;
				$alias_wrapper = ','.$alias.$parent -> alias_wrapper ;
			} else {
				$list_parents = ','.$cid.',';
				$alias_wrapper = ','.$alias.',' ;
			}
			$row['list_parents'] = $list_parents;
			$row['alias_wrapper'] = $alias_wrapper;
			
			// update table items
			// $id = FSInput::get('id',0,'int');
			// if($id){
				$row2['category_id_wrapper'] = $list_parents;
				$row2['category_alias'] = $record -> alias;
				$row2['category_alias_wrapper'] =  $alias_wrapper;
				$row2['category_name'] =  $record -> name;
				$row2['category_published'] =  $record -> published;
				$this -> _update($row2,'fs_products',' category_id = '.$cid.' ');

				// update table categories : records have parent = this
				$this -> update_categories_children($cid,0,$list_parents,'',$alias_wrapper,$record -> level);
			// }
			// change this record
			$rs =  $this -> record_update($row,$cid,'fs_products_categories');
			// update sitemap
//			$this -> update_sitemap($cid,$this -> table_name,$this -> module);
			return $rs;
		}
		
		function update_categories_children($parent_id,$root_id,$list_parents,$root_alias,$alias_wrapper,$level){
			if(!$parent_id)
				return;
			$query = ' SELECT * FROM fs_products_categories
						WHERE parent_id = '	.$parent_id;
			global $db;
			$db->query($query);
			$result = $db->getObjectList();	
			if(!count($result))
				return;
			foreach($result as $item){
				
				$row3['list_parents'] = ",".$item -> id.$list_parents;
				$row3['alias_wrapper'] = ",".$item -> alias.$alias_wrapper;
				$row3['level'] =  ($level + 1) ;
				if($this -> _update($row3,'fs_products_categories',' id = '.$item -> id.' ')){
					// update sitemap
//					$this -> update_sitemap($item -> id,$this -> table_name,$this -> module);
					
					// update table items owner this category
					$row2['category_id_wrapper'] = $row3['list_parents'];
					$row2['category_alias_wrapper'] =  $row3['alias_wrapper'];
//					$row2['category_name'] =  $row3['name'];
					$this -> _update($row2,'fs_products',' category_id = '.$item -> id.' ');
					
					// đệ quy
//					$this -> update_categories_children($item -> id,$root_id,$row3['list_parents'],$root_alias,$row3['alias_wrapper'],$level);
				}
				$this -> update_categories_children($item -> id,$root_id,$row3['list_parents'],$root_alias,$row3['alias_wrapper'],$row3['level']);
			}
		}

		function save_manu($name){
			$row['name'] = $name;

			$fsstring = FSFactory::getClass('FSString','','../');
			$row['alias'] = $fsstring -> stringStandart($name);
			$row['code'] = $name;
			$row['published'] = 1;	
			$row['ordering'] = $this->get_max_ordering('fs_manufactories');
			$row['updated_time'] = date('Y-m-d H:i:s');
			$row['created_time'] =date('Y-m-d H:i:s');
			$record_id = $this -> _add($row,'fs_manufactories',1);
			return $record_id;

		}

		function save_color($name){
			if(!$name)
				return;
			$row['name'] = $name;
			$fsstring = FSFactory::getClass('FSString','','../');
			$alias = $fsstring -> stringStandart($name);
			if(!$alias)
				return;
			$alias = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $alias);

			$row['alias']  = $alias;
			$row['published'] = 1;	
			$row['ordering'] = $this->get_max_ordering('fs_products_colors');
			$row['created_time'] =date('Y-m-d H:i:s');
			$record_id = $this -> _add($row,'fs_products_colors',1);

			return $record_id;

		}

		function save_size($name){
			if(!$name)
				return;
			$row['name'] = $name;
			$fsstring = FSFactory::getClass('FSString','','../');
			$alias = $fsstring -> stringStandart($name);
			if(!$alias)
				return;
			$alias = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $alias);
			$row['alias']  = $alias;
			$row['published'] = 1;	
			$row['ordering'] = $this->get_max_ordering('fs_products_sizes');
			$row['created_time'] =date('Y-m-d H:i:s');
			$record_id = $this -> _add($row,'fs_products_sizes',1);

			return $record_id;

		}
		/*
		 * Lưu lại trường mở rộng trong trường SPECS từ EXCEL
		 * Chú ý cấu trúc SPECS: Mỗi trường mở rộng một dòng
		 * 
		 */
		function save_extend_from_specs_in_excel($specs, $product_id,$add = 1,$products_tables_all,$table_name,$row,$edit_specs = 0){
			if(!$table_name || !$product_id)
				return;
			
			$row2 = $row;
			unset($row2['id']);
			unset($row2['tablename']);
			unset($row2['wholesale_prices']);
			unset($row2['retail_price']);
			unset($row2['manufactory']);
			unset($row2['manufactory_alias']);
			unset($row2['manufactory_name']);
			unset($row2['source_website']);
			// unset($row2['description']);
			// unset($row2['summary']);
//			$row2 = array();
//			print_r($list_extend);

			
			if($edit_specs){
				$fsstring = FSFactory::getClass('FSString','','../');
				$list_extend = explode(chr(10),$specs);
				
				$summary_auto = '';
				foreach($list_extend as $item){
					if(!$item || !trim($item))
						continue;
					$array_item_info = explode(':',$item);
					if(count($array_item_info) < 1)
						continue;
					$excel_ext_field_name_display =  trim($array_item_info[0]);
					$excel_ext_field_value =  trim($array_item_info[1]);
	//				echo $excel_ext_field_name_display;
	//				echo "///";
	//				echo $excel_ext_field_value;
	//				echo "<br/>";
					
					foreach($products_tables_all as $define_field){
						if($define_field -> table_name == $table_name && $define_field -> field_name_display == $excel_ext_field_name_display ){
							$field_name = $define_field -> field_name; 
							$field_type = $define_field -> field_type; 
							$display_name = $define_field -> field_name_display; 
							$f_is_main =  $define_field ->is_main;
							
						// FOREIGN_ONE
							if($field_type  == 'foreign_one'){
								$arr_table_extend_match = $this->get_records('',$data_extend->foreign_tablename );
								/*
								 *So sanh chuoi vua chuyen voi du lieu trong bang extend tuong ung
								 *roi chuyen sang sang alias
								*/
								$k = 0;
								foreach ($arr_table_extend_match as $table_extend_match) {
									if($table_extend_match->name == $excel_ext_field_value){
										$row2[$field_name]=$table_extend_match->id;
										$k++;
										break;
									}
								}
								
								if(!$k){
										$row_ext = array();
										$row_ext['name'] = $excel_ext_field_value;
										$row_ext['alias'] = $fsstring -> stringStandart($excel_ext_field_value);
	//									$row_ext['ordering'] = $this->getMaxOrdering();
										$row_ext['created_time'] = date('Y-m-d H:i:s');
										$row_ext['edited_time'] = date('Y-m-d H:i:s');
										$id = $this->_add($row_ext, $data_extend->foreign_tablename);
								}
								if($f_is_main){
									$summary_auto .= '<div class="sum_item"><span class="sum_item_lb">' . $display_name . ': </span>' . $excel_ext_field_value;
									$summary_auto .= '</div>';
								}
									
							}else if($field_type  == 'foreign_multi'){ // FOREIGN_MULTI 
								$arr_data_exel_of_extend = explode("\n",$excel_ext_field_value);
								$p =0;
								$str_summary_auto_value = '';
								foreach ($arr_data_exel_of_extend as $data_extend_multi) {
									$data_extend_multi = trim($data_extend_multi);
									if(!$data_extend_multi)
										continue;
									$data_extend_multi_conver = $fsstring -> stringStandart($data_extend_multi);
									$get_data_extend = $this->get_record('alias="'.$data_extend_multi_conver.'"',$data_extend->foreign_tablename );
									$row2[$field_name] .=",".$get_data_extend->id;
									if($p):$row2[$field_name] .="," ;endif;
									$p++;
									
									// summary auto
									if($str_summary_auto_value)
										$str_summary_auto_value .= ',';
									$str_summary_auto_value .= $data_extend_multi;	
								}
								if($f_is_main){
									$summary_auto .= '<div class="sum_item"><span class="sum_item_lb">' . $display_name . ': </span>' . $str_summary_auto_value;
									$summary_auto .= '</div>';
								}
							}else{
								$row2[$field_name]=$excel_ext_field_value;
								if($f_is_main){
									$summary_auto .= '<div class="sum_item"><span class="sum_item_lb">' . $display_name . ': </span>' . $excel_ext_field_value;
									$summary_auto .= '</div>';
								}
								
							}
							
						}
					}
				}
			}
			$row2['record_id'] = $product_id;
			// $row2['summary_auto'] = $summary_auto;
			$row3 = array();
			// $row3['summary_auto'] = $summary_auto;

			$product_exist =$this -> get_result('record_id ='.$product_id,$table_name);

			if(!$product_exist){
				$this -> _add($row2, $table_name,1);
				$this -> _update($row3, 'fs_products','id = '.$product_id,1);
			}else{
				$this -> _update($row2, $table_name,'record_id = '.$product_id,1);
				$this -> _update($row3, 'fs_products','id = '.$product_id,1);
			}
		}
		// Cập nhật thông tin  sản phẩm
		function import_cat_film_info($excel,$path){
			$fsstring = FSFactory::getClass('FSString','','../');	
			$file_path = $path.$excel;
			require_once("../libraries/excel/phpExcelReader/Excel/reader.php");
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read($file_path);
			unset($total_product);			
			$total_product =count($data->sheets[0]['cells']);
			$info_import_product =array();
			unset($j);
			
			//Lấy  tên trong bang exel
			$arr_field_name = $data->sheets['0']['cells']['1'];
			$total_field_name =count($arr_field_name);
			//end Lấy  tên trong bang exel
			$rs = 0;
			// echo $total_product;die;
			for($j=107;$j<=$total_product;$j++){
				$info_import_product['name'] =  preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'name',$arr_field_name));
				$info_import_product['name'] =  $this->seems_utf8($info_import_product['name'])?$info_import_product['name']:utf8_encode($info_import_product['name']);
				$info_import_product['parent_id'] = preg_replace('/[.*]+/i','',$this->get_cell_content_by_name($data,0,$j,'parent_id',$arr_field_name));
				if(!$info_import_product['name']){
					continue;
				}
				$row = array();
				$row['name'] = $info_import_product['name'];
				$row['alias'] = $fsstring -> stringStandart($row['name']);
				$row['parent_id'] = $info_import_product['parent_id'] ;
				$row['updated_time']  = date('Y-m-d H:i:s');
				$row['published'] = 1;
				$row['ordering'] = $this->get_max_ordering('fs_products_categories');

				if(@$row['parent_id'])
				{
					$parent =  $this->get_record_by_id($row['parent_id'],'fs_products_categories');
					$parent_level = $parent -> level ?$parent -> level : 0; 
					$level = $parent_level + 1;
				} else {
					$level = 0;
				}
				$row['level'] = $level;
				$cat_exist =$this -> get_record('name="'.$info_import_product['name'].'"','fs_products_categories','id,alias,name');
				if(!$cat_exist){
					$row['created_time'] =date('Y-m-d H:i:s');
					$id = $this -> _add($row,'fs_products_categories',1);
					if($id){
						$this -> update_parent($id,$row['alias']);
					}
					if($id)
						$rs++;
				}else{
					$result = $this -> _update($row,'fs_products_categories','  id = "'.$cat_exist -> id.'"',1);
					if($result){
						$this -> update_parent($result,$row['alias']);
					}
					$rs++;
				}
			}
			return $rs;
		}
		function get_cell_content_by_name($data,$sheet_index,$row_index,$field_name,$arr_field_name){
			$dem=1;
			foreach ($arr_field_name as $key=>$item) {
				if($field_name == $item){
					if($dem > 1){
						Errors::_ ( 'File bạn vừa nhập có '.$dem.' : '.$field_name);
						return false;
					}
					else
						$content = isset($data->sheets[$sheet_index]['cells'][$row_index][$key])?$data->sheets[$sheet_index]['cells'][$row_index][$key]:'';
					$dem++;
				}
			} 
			return $content;
		}
		  
	  function seems_utf8($str) {
	        for ($i=0; $i<strlen($str); $i++) {
	            if (ord($str[$i]) < 0x80) continue; # 0bbbbbbb
	            elseif ((ord($str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
	            elseif ((ord($str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
	            elseif ((ord($str[$i]) & 0xF8) == 0xF0) $n=3; # 11110bbb
	            elseif ((ord($str[$i]) & 0xFC) == 0xF8) $n=4; # 111110bb
	            elseif ((ord($str[$i]) & 0xFE) == 0xFC) $n=5; # 1111110b
	            else return false; # Does not match any model
	            for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
	                if ((++$i == strlen($str)) || ((ord($str[$i]) & 0xC0) != 0x80))
	                    return false;
	            }
	        }
	        return true;
	    }
	}
	
?>
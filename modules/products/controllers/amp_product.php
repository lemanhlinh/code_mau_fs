<?php
/*
 * Huy write
 */
	// controller

	class ProductsControllersAmp_product extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{

			// call models
			$model = $this -> model;

			$data = $model->getproducts();

			if(!$data)
				setRedirect(URL_ROOT,'Không tồn tại sản phẩm này','error');
			$ccode = FSInput::get('ccode');

			$category_id = $data -> category_id;

			$category = $model -> get_category_by_id($category_id);
			if(!$category)
				setRedirect(URL_ROOT,'Không tồn tại danh mục này','error');
			$Itemid = 7;

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Sản phẩm'), 1 => FSRoute::_('index.php?module=products&view=home'));
			$breadcrumbs[] = array(0=>$category -> name, 1 => FSRoute::_('index.php?module=products&view=cat&id='.$data -> category_id.'&ccode='.$data -> category_alias));
			$breadcrumbs[] = array(0=>$data->name, 1 => '');

			global $tmpl,$module_config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> assign('title', $data->name);
			$tmpl -> assign('tags', $data->tags);
			$tmpl -> assign('og_image', URL_ROOT.str_replace('/original/', '/large/', $data -> image));
            
			// seo
			$tmpl -> set_data_seo($data);

			// call views
		    include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}


		// check captcha
		function check_captcha(){
			$captcha = FSInput::get('txtCaptcha');

			if ( $captcha == $_SESSION["security_code"]){
				return true;
			} else {
			}
			return false;
		}

		// update hits
		function update_hits(){
			$model = $this -> model;
			$products_id = FSInput::get('id');
			$model -> update_hits($products_id);
		}

	}

?>

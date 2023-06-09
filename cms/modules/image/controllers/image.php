<?php
	class ImageControllersImage extends Controllers
	{
		function __construct()
		{
		    $this->view = 'image' ;
			parent::__construct(); 
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
			$list = $model->get_data('');
            //$categories = $model->get_categories_tree();
            
			$pagination = $model->getPagination('');
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
//			echo 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model = $this -> model;
            //$categories = $model->get_categories_tree();
			$maxOrdering = $model->getMaxOrdering();
			$uploadConfig = base64_encode('add|'.session_id());
			
			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}
		
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
            //$categories = $model->get_categories_tree();
			$data = $model->get_record_by_id($id);
			
			$uploadConfig = base64_encode('edit|'.$id);
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}

        function show_in_homepage()
    	{
    		$this->is_check('show_in_homepage',1,'show_in_homepage');
    	}
    	function unshow_in_homepage()
    	{
    		$this->unis_check('show_in_homepage',0,'un_show_in_homepage');
    	}
//        function unshow_in_homepage()
//        {
//            $this->unis_check('show_in_homepage',0,'un_show_in_homepage');
//        }
	}
?>
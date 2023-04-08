<?php
	class LibraryfsControllersLibraryfs extends Controllers
	{
		function __construct()
		{
			$this->view = 'libraryfs' ; 
			parent::__construct(); 
		}
        
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;
			
			$model  = $this -> model;
            $categories = $model->get_categories_tree();
			//$categories = $model->get_news_categories_tree_by_permission();

         	$list = $model->get_data('');
            $member = $model -> get_records(' published = 1 ','fs_members','id,full_name',' ordering ASC ');
            $array_member = array();
            foreach($member as $item){
                $array_member[$item->id] = $item->full_name;
            }
          
			$list_key = array();
			$pagination = $model->getPagination('');
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
        
		function add()
		{
			$model = $this -> model;
			$categories = $model->get_categories_tree();
			$list_key = array();

			$maxOrdering = $model->getMaxOrdering();
            $member = $model -> get_records(' published = 1 ','fs_members','id,email,full_name',' ordering ASC ');
            
			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}
        
		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;
            
			$categories = $model->get_categories_tree();
			$data = $model->get_record_by_id($id);
            $member = $model -> get_records(' published = 1 ','fs_members','id,email,full_name',' ordering ASC ');
			// data from fs_news_categories
			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
  
	}
?>
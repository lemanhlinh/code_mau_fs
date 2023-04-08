<?php
	// models
//	include 'modules/'.$module.'/models/'.$view.'.php';

	class LocationControllersWards extends Controllers
	{
		function __construct()
		{
			$this->view = 'wards' ;
			parent::__construct();
		}
		function display()
		{
			parent::display();
			$sort_field = $this -> sort_field;
			$sort_direct = $this -> sort_direct;

			$model  = $this -> model;
			$list = $model->get_data('');

			$cities = $model-> get_records('published = 1','fs_cities','id,name');
			$districts = $model-> get_records('published = 1','fs_districts','id,name');
			//$areas = $model->get_records('published = 1','fs_areas','id,name');

			$pagination = $model->getPagination('');
			include 'modules/'.$this->module.'/views/'.$this->view.'/list.php';
		}
		function add()
		{
			$model = $this -> model;
			//$cities = $model-> get_records('published = 1','fs_cities','id,name');
			//$districts = $model-> get_records('published = 1','fs_districts','id,name');
            
            $cities = $model -> get_records('published = 1','fs_cities','id,name,alias',' ordering ASC ');	
            $districts = array();
			//$areas = $model->get_records('published = 1','fs_areas','id,name');
			$maxOrdering = $model->getMaxOrdering();

			include 'modules/'.$this->module.'/views/'.$this -> view.'/detail.php';
		}

		function edit()
		{
			$ids = FSInput::get('id',array(),'array');
			$id = $ids[0];
			$model = $this -> model;

			//$cities = $model-> get_records('published = 1','fs_cities','id,name');
			//$districts = $model-> get_records('published = 1','fs_districts','id,name');
            
			$data = $model->get_record_by_id($id);
            $cities = $model -> get_records('published = 1','fs_cities','id,name,alias',' ordering ASC ');	
			$districts = $model -> get_records(' city_id = '.$data->city_id,'fs_districts');
			//$areas = $model->get_records('published = 1','fs_areas','id,name');

			include 'modules/'.$this->module.'/views/'.$this->view.'/detail.php';
		}
        
        function ajax_get_product_district(){
			$model  = $this -> model;
			$cid = FSInput::get('cid');
			$rs  = $model -> ajax_get_product_district($cid);
			
			$json = '['; // start the json array element
			$json_names = array();
			foreach( $rs as $item)
			{
				$json_names[] = '{id: '.$item->id.', name: "'.$item->name.'"}';
			}
			$json .= implode(',', $json_names);
			$json .= ']'; // end the json array element
			echo $json;
		}
	}

?>

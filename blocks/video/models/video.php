<?php 
	class VideoBModelsVideo
	{
		function __construct()
		{
            $fstable = FSFactory::getClass('fstable');
            $this->table_name  = $fstable->_('fs_video');	
		}
		
        function setQuery($ordering,$limit,$type){
			$where = '';
			$order = '';

			switch ($type){

			case 'ramdom':	
				$order .= ' RAND(),';
				break;
            case 'show_in_homepage':
				$where .= '  AND show_in_homepage = 1 ';
			    break;	   	
            case 'ordering':
				$order .= ' ordering DESC , ';
			    break;
            case 'is_hot':
				$where .= '  AND is_hot = 1 ';
			    break;    
            case 'time':
				$order .= ' created_time DESC , ';
			    break;
			}
            
			$order .= ' ordering DESC , created_time DESC';
            
			$query = ' SELECT id,name,video,image,alias,link_video,pos_left,top
						  FROM '. $this->table_name .'
						  WHERE  published = 1 '. $where .'
						  ORDER BY  '. $order .'
						  LIMIT '. $limit  
						 ;
            //print_r($query);
			return $query;
		}
        
		function get_list($ordering,$limit,$type){
			global $db;
			$query = $this->setQuery($ordering,$limit,$type);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
	}
	
?>
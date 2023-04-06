<?php 
	class OnlinesupportBModelsOnlinesupport
	{
		function __construct()
		{
		}
		function getList(){
			global $db ;
			$limit = 5;
			 $sql = " SELECT id, name as display_name, zalo,skype
					FROM fs_business
					WHERE published  = 1 
					ORDER BY ordering
					LIMIT $limit ";
			$db->query($sql);
			return $db->getObjectList();
		}
		
	}
	
?>
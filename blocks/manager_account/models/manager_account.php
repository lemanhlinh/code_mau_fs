<?php 
	class Manager_accountBModelsManager_account
	{
		function __construct()
		{
		}
		
		function get_user(){
			global $db ;
			if(!isset($_SESSION['user_id']))
				return;
			$sql = " SELECT *
					FROM fs_members
					WHERE published  = 1
						AND id = ".$_SESSION['user_id']." 
					";
			$db->query($sql);
			return   $db->getObject();
				
		}
		/*
		 * Thấy các thông báo download chưa đọc
		 */
		function get_count_message_download($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = " SELECT count(*)
					FROM fs_system_messages
					WHERE  recipient_id = ".$user_id." 
						AND is_read = 0
					";
			$db->query($sql);
			return   $db->getResult();
				
		}
		/*
		 * Thấy các thông báo chưa đọc
		 */
		function get_count_message($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = " SELECT count(*)
					FROM fs_messages
					WHERE ( recipients_id LIKE '%\'".$user_id."\'%' OR recipients_username = 'all') 
						AND ( readers_id NOT LIKE '%\'".$user_id."\'%' OR readers_id is NULL) 
						AND ( deleters_id NOT LIKE '%\'".$user_id."\'%'  OR deleters_id is NULL) 
					";
			$db->query($sql);
			return   $db->getResult();
				
		}
		/*
		 * Thấy tất cả các thông báo
		 */
		function get_count_alert($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = ' SELECT count(*)
					FROM fs_notify
					WHERE  user_id = '.$user_id.'  AND is_read = 0
					';
            //print_r($sql);        
			$db->query($sql);
			return  $db->getResult();
		}
		/*
		 * Thấy tất cả các thông báo chưa đọc
		 */
		function get_count_alert_unread($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = ' SELECT count(*)
					FROM fs_notify 
					WHERE  user_id = '.$user_id.'
						AND is_read = 0  
					';
			$db->query($sql);
			return  $db->getResult();
		}
		/*
		 * get_count_favourite
		 */
		function get_count_favourite($user_id){
			global $db ;
			if(!$user_id)
				return;
			$sql = "  SELECT count(*)
					FROM fs_products
					WHERE published = 1 
					AND id IN (  SELECT product_id
					FROM fs_products_like
					WHERE follower_id = ".$user_id." ) 
					";
			$db->query($sql);
			return   $db->getResult();
		}
		function get_notify_list(){
		
			$user_id = $_SESSION['user_id'];
			$limit = 5;
			//	type
			$query   = " SELECT * 
					FROM fs_notify AS a
							WHERE user_id = ".$user_id."
								 ORDER BY created_time DESC , id DESC
								 LIMIT 0,$limit
								";
			
			global $db;
			$db->query($query);
			return  $result = $db->getObjectList();
		}
        
        function get_record_by_id($id, $table_name = '', $select = '*') {
    		if (! $id)
    			return;
    		if (! $table_name)
    			$table_name = $this->table_name;
    		$query = " SELECT " . $select . "
    					  FROM " . $table_name . "
    					  WHERE id = $id ";
    		
    		global $db;
    		$sql = $db->query ( $query );
    		$result = $db->getObject ();
    		return $result;
    	}
	}
?>
<?php 
	class ContactModelsContact extends FSModels{
			function __construct()
			{
			 $fstable = FSFactory::getClass('fstable');
			 $this -> table_name = $fstable->_('fs_contact');
             $this -> table_add = $fstable->_('fs_address');
			}

		function save(){
			$email = FSInput::get('contact_email');
			$fullname = FSInput::get('contact_name');
//			$address = FSInput::get('contact_address');
			$telephone = FSInput::get('contact_phone');
			$title = FSInput::get('contact_tieude');
			$message = FSInput::get('contact_message');
			$company = FSInput::get('contact_company');
			$time = date("Y-m-d H:i:s");
			$published = 1;
			
			$sql = " INSERT INTO 
						fs_contact (email,fullname,company,telephone,title,edited_time,created_time,message)
						VALUES ('$email','$fullname','$company','$telephone','$title','$time','$time','$message')";
			global $db;
			$db->query($sql);
			$id = $db->insert();
			return $id;
			
		}

        
        function get_address_list(){
			$query = ' select * from '. $this -> table_add.' where published = 1 ';
			global $db;
			$sql = $db->query($query);
			$list = $db->getObjectList();
			return $list;
		}
        
		function get_address_current(){
			$add_id = FSInput::get('id',0,'int');
			$query = "select * from ".$this -> table_add."  where id=". $add_id;
			global $db;
			$sql = $db->query($query);
			$object = $db->getObject();
			return $object;
		}
        
        
	}
?>
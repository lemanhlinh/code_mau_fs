<?php 
	class MembersModelsMembers extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$limit = 100;
			$this -> view = 'members';
			$this->limit = $limit;
			$this -> table_name = 'fs_members';
			parent::__construct();
            //$this -> array_synchronize = array('fs_schedules'=>array('id'=>'user_id','username'=>'user_name','full_name'=>'full_name','sex'=>'sex'
                                                                       // ,'address'=>'address','level'=>'level','email'=>'email','mobilephone'=>'mobilephone'));                                  
		}
		
		function setQuery()
		{
			// ordering
			$ordering = "";
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
			}
			$where = "  WHERE 1=1 ";
			
            // from
			if(isset($_SESSION[$this -> prefix.'text0']))
			{
				$date_from = $_SESSION[$this -> prefix.'text0'];
				if($date_from){
					$date_from = strtotime($date_from);
					$date_new = date('Y-m-d H:i:s',$date_from);
					$where .= ' AND a.created_time >=  "'.$date_new.'" ';
				}
			}
			
			// to
			if(isset($_SESSION[$this -> prefix.'text1']))
			{
				$date_to = $_SESSION[$this -> prefix.'text1'];
				if($date_to){
					$date_to = $date_to . ' 23:59:59';
					$date_to = strtotime($date_to);
					$date_new = date('Y-m-d H:i:s',$date_to);
					$where .= ' AND a.created_time <=  "'.$date_new.'" ';
				}
			}
            
			if(isset($_SESSION[$this -> prefix.'keysearch'])){
				$keysearch = $_SESSION[$this -> prefix.'keysearch'];
				if($keysearch){
					$where .= " AND ( a.username LIKE '%".$keysearch."%' OR a.full_name LIKE '%".$keysearch."%' OR a.id LIKE '%".$keysearch."%' )
										";
				}
           
			}
			
			$query = " SELECT a.*
						  FROM 
						  	".$this -> table_name." AS a "
						 .$where.
						 $ordering. " ";
			return $query;
		}

		/******************************** SAVE *****************************************/
		/*
		 * 
		 * Save
		 */
		function save($row = array(), $use_mysql_real_escape_string = 1){
			$edit_pass = FSInput::get('edit_pass');
			if($edit_pass){
				$row['password'] = md5(FSInput::get("password1"));
			}
			return parent::save($row,0);
		}
		
		
		function remove(){
			$img_paths = array();
			$img_paths[] = PATH_IMG_MEMBER_AVATAR.'original'.DS;
			$img_paths[] = PATH_IMG_MEMBER_AVATAR.'resized'.DS;
			return parent::remove('avatar',$img_paths);
		}


		/*
		 * Createa folder when create user
		 */
		function create_folder_upload($id){
			$fsFile = FSFactory::getClass('FsFiles','');
			$path = PATH_BASE.'uploaded'.DS.'estores'.DS.$id;
			return $fsFile->create_folder($path);
		}
        
        public function ajax_check_exits_email()
        {
            global $db ;
            
            $id   = FSInput::get2("id",0,'int');
            $user = $this->get_record_by_id($id,'fs_users','email');
            $email_check = '';
            if($user){
                $email_check = $user->email;
            }
            
            $email      =  FSInput::get2("email");
            if (!$email) {
                return false;
            }

            $sql = ' SELECT count(id)
                     FROM fs_members
                     WHERE email = "'.$email.'"'
                    ;
            //$db -> query($sql);
            $count = $db->getResult($sql);
            if ($count && $email_check != $email) {
                return false;
            }
            return true;
        }
        
        public function ajax_check_exist_username()
        {
            global $db ;
            $id   = FSInput::get2("id",0,'int');
            $user = $this->get_record_by_id($id,'fs_members','username');
            $email_check = '';
            $username_check = '';
            if($user){
                $username_check = $user->username;
            }
            
            $username      =  FSInput::get2("username");
            if (!$username) {
                return false;
            }

            $sql = ' SELECT count(id)
                     FROM fs_members
                     WHERE username = "'.$username.'"'
                    ;
            //$db -> query($sql);
            $count = $db->getResult($sql);
            if ($count && $username_check != $username) {
                return false;
            }
            return true;
        }
 	
	}
	
	
?>
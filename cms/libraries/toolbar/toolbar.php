<?php

class ToolbarHelper 
{
	var $title;
	var $buttons = array();
	var $buttons_html = array(); // html of button
	
	function __construct(){
		$this -> title = "Hệ thống quản lý nội dung (CMS)";
		$this -> buttons = array();
		$this -> buttons_html = array();
	}
	
	function addButton($task = 'task',$alt = 'task' , $msg = '', $img = '', $validate = 0,$script=FALSE ){
	    $module = FSInput::get('module');
        $view = FSInput::get('view');
	    $permission = FSSecurity::check_permission_fun($module, $view, $task);
        if (!$permission){
            return false;
        }
        
		$array = array('task' => $task,'alt'=> $alt , 'msg'=> $msg,'img' => $img ,'validate'=> $validate,'script'=>$script );
		$buttons = isset($this -> buttons) ?$this -> buttons : array();
		$buttons[] = $array;
		$this -> buttons = $buttons;
	}

	function addButtonHTML($html){
		$buttons_html = isset($this -> buttons_html) ?$this -> buttons_html : array();
		$buttons_html[] = $html;
		$this -> buttons_html = $buttons_html;	
	}
    
    function add_icon($task = '',$img = ''){
        $icon = '';
        if(!$task)
            return false;
        
        $find_letters = array('.png', '.jepg', '.jpg','.gif');    
        if($img && !strposa($img,$find_letters))
            return $img;
            
        $array_icon = array(
                            'add'=>'fa-plus-square',
                            'save'=>'fa-save',
                            'remove'=>'fa-remove',
                            'apply'=>'fa-check-square-o',
                            'published'=>'fa-check-square',
                            'unpublished'=>'fa-pause',
                            'cancel'=>'fa-share-square-o',
                            'save_all'=>'fa-save',
                            'save_add'=>'fa-paste',
                            'export'=>'fa-file-excel-o',
                            'edit'=>'fa-edit',
                            'duplicate'=>'fa-files-o',
                            'back'=>'fa-share-square-o',
                            'table_add'=>'fa-table'
                            );
        $task = strtolower($task);                    
        $icon = isset($array_icon[$task])? $array_icon[$task]:'';
        return $icon;
    }
	
	function show_head_form(){
		$html = "";
        if(!empty($this -> buttons) || !empty($this -> buttons_html)){
            $html .= '<div id="wrap-toolbar" class="wrap-toolbar col-xs-12">';
            $html .= $this -> showTitle();
            $html .= '  <div class="pull-right" data-spy="affix" data-offset-top="70">';
            $html .=        $this -> showButtons();
            //$html .= "      <div class=\"clearfix\"></div>";
            $html .= '  </div>';
            //$html .= "  <div class=\"clearfix\"></div>";
            $html .= '</div><!--end: .wrap-toolbar-->';
            $html .= "  <div class=\"clearfix\"></div>";
        }
		$html .= $this -> show_message();
		return $html;
	}	
	function show_message()
	{
		$html = "";
		if(isset($_SESSION['have_redirect']))
		{
			if($_SESSION['have_redirect'] == 1)
			{
				$html .= "</table>
                    <script>
                    $(document).ready(functions(){
                        $('.alert').remove();
                    })
                    </script>";
				$types = array('error'=>'alert-danger','alert'=>'alert-info','suc'=>'alert-success');
				foreach ($types as $key=>$type)
				{
				    
					if(isset($_SESSION["msg_$key"]))
					{
					    //var_dump($type);
						$msg_error = $_SESSION["msg_$key"];
						foreach ($msg_error as $item) {
							$html .= "<div class='col-xs-12'> 	
                                        <div class='alert $type'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                        ";
							$html .=  $item;
							$html .= " </div></div>";
						}
						unset($_SESSION["msg_$key"]);
					}
				}
				//$html .=  "</div>";
			}
			unset($_SESSION['have_redirect']);
		}
		return $html;
	}
	
	function setTitle($title = '', $icon = '' ){
		$this -> title = $title;
	}
	function showTitle(){
        $html = '<h3 class="box-title pull-left">'.$this ->title.'</h3>';
		return  $html;
	}
	function showButtons(){
		$html= "";
		$buttons  = $this -> buttons;
		for($i = 0 ; $i < count($buttons) ; $i ++){
			$item = $buttons[$i];
            //$item['img'] = 'fa-star';
            $onclick = '';
			if(!$item['validate']){
				if($item['msg']){
					if($item['script']==1){
						$html .= '<a class="toolbar btn btn-app btn-info" title="'.$item['alt'].'" >';
					}else{
					    $onclick = "javascript:if(document.adminForm.boxchecked.value==0){alert('".$item['msg']."');}else{  submitbutton('".$item['task']."')}";
						$html .= '<a title="'.$item['alt'].'" class="toolbar btn btn-app btn-info" onclick="'.$onclick.'" href="#" >';
					}
                    $html .= '<i class="fa '.$this->add_icon($item['task'],$item['img']).'"></i>';
					$html .= $item['alt'];
					$html .="</a>";			
				}else {
					if($item['script']==1){
						$html .= '<a class="toolbar btn btn-app btn-info" title="'.$item['alt'].'" >';
					}else{
					    $onclick = "javascript: submitbutton('".$item['task']."')";
						$html .= '<a class="toolbar btn btn-app btn-info" onclick="'.$onclick.'" href="#" >';
					}
                    
                    $html .= '<i class="fa '.$this->add_icon($item['task'],$item['img']).'"></i>';
					$html .= $item['alt'];
					$html .="</a>";	
				}
			}else{
				/*
				 * checkform by formValidator().
				 * This function is writed by develop. 
				 */ 
				if($item['script']==1){
					$html .= '<a class="toolbar btn btn-app btn-info ';	
				}else{
				    $onclick = "javascript:if(formValidator()){ submitbutton('".$item['task']."')}";
					$html .= '<a class="toolbar btn btn-app btn-info" onclick="'.$onclick.'" href="#" >';	
				}
                $html .= '<i class="fa '.$this->add_icon($item['task'],$item['img']).'"></i>';
				$html .= $item['alt'];
				$html .="</a>";			
			}
		}
		$buttons_html  = $this -> buttons_html;
		if( count($buttons_html)){
			foreach ($buttons_html as $item) {
				$html .= $item;
			}
		}
		return $html;
	}
}
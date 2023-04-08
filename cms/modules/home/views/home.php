<?php if(count($list)){
    $array_panel = array(
            1 => 'bg-gray-light',
            2 => 'bg-black',
            3 => 'bg-red',
            4 => 'bg-yellow',
            5 => 'bg-aqua',
            6 => 'bg-blue',
            7 => 'bg-light-blue',
            8 => 'bg-green',
            9 => 'bg-navy',
            10 => 'bg-teal',
            11 => 'bg-olive',
            12 => 'bg-lime',
            13 => 'bg-orange',
            14 => 'bg-fuchsia',
            15 => 'bg-purple',
            16 => 'bg-maroon',
            17 => 'bg-gray-active',
            18 => 'bg-black-active',
            19 => 'bg-red-active',
            20 => 'bg-yellow-active',
            21 => 'bg-aqua-active',
            22 => 'bg-blue-active',
            23 => 'bg-light-blue-active',
            24 => 'bg-green-active',
            25 => 'bg-navy-active',
            26 => 'bg-teal-active',
            27 => 'bg-olive-active',
            28 => 'bg-lime-active',
            29 => 'bg-orange-active',
            30 => 'bg-fuchsia-active',
            31 => 'bg-purple-active',
            32 => 'bg-maroon-active',
    );
    function get_count($where = '',$table_name = ''){
		if(!$where)
			return;
		if(!$table_name)
			$table_name = $this -> table_name;
		$query = " SELECT count(*)
					  FROM ".$table_name."
					  WHERE ".$where ;
		
		global $db;
		$result = $db->getResult($query);
		return $result;
	}
?>

    <?php foreach($list as $item){
        $link_ = '';
        $module = $item->module? $item->module:'';
        if($module){
            $view = $item->view? $item->view:$module;
            $link_ = 'index.php?module='.$module.'&view='.$view;
        }
        
        $link = $item->link? $item->link:$link_;
    ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon <?php echo $array_panel[$item->code_color] ?>">
            <i class="<?php echo $item->icon ?>"></i>
          </span>

          <div class="info-box-content">
            <a class="info-box-text" href="<?php echo $link; ?>" ><?php echo $item->name ?></a>
            <span class="info-box-number"><?php echo get_count('published = 1 AND parent_id = '.$item->id,'fs_menus_admin'); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <?php } ?>
<?php } ?>



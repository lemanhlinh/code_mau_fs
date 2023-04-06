<div class="col-products-tabs row-item">
    <div class="product-tab-title row-item">
    	<ul class='product_tabs_ul row-item'>
            <li id='tab1' class='activated'>
                <a><?php echo FSText::_("Thông tin chi tiết"); ?></a>
            </li>
            <li id='tab2' >
               <a><?php echo FSText::_("Bản vẽ"); ?></a>
            </li>
            <li id='tab3' >
               <a><?php echo FSText::_("Video"); ?></a>
            </li>
        </ul><!-- END: .product_tabs_ul -->
    </div> <!-- END: .product-tab-title -->  
     
    <div class='product_tab_content row-item'>
    	
    	<div id='tab1_content' class='tab_content selected'>
            <div class="manual_content">
    		 	<?php echo html_entity_decode($data->description);?>
    		</div>
    	</div><!-- END: .tab_content -->
    
    	<div id='tab2_content' class='tab_content hide'>
            <div class="manual_content">
    		 	<?php echo html_entity_decode($data-> drawing);?>
    		</div>
    	</div><!-- END: .tab_content -->
        <div id='tab3_content' class='tab_content hide'>
            <div class="manual_content">
    		 	<?php echo $data-> video;?>
    		</div>
    	</div><!-- END: .tab_content -->
    </div><!-- END: .product_tab_content -->
</div>

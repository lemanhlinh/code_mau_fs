<?php 
$tmpl -> addScript('masonry.pkgd.min','libraries/jquery/masonry/js');
$filter = FSInput::get('filter');
$order = FSInput::get ('order');
?>
        
        <ul class="clearfix productlist " >
            <?php 
                include 'fetch_pages.php';
                echo $html;
            ?>
        </ul>


<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet('lightgallery.min','modules/products/assets/css');
    $tmpl -> addScript('lightgallery-all.min','modules/products/assets/js');
    $tmpl -> addStylesheet('video','blocks/video/assets/css');
    $tmpl -> addScript('slider-home','blocks/video/assets/js');
    $bk_images = $config['images_map_video']? 'style="background:rgba(0, 0, 0, 0) url('.URL_ROOT.$config['images_map_video'].') no-repeat scroll center center  ;"':"";
?>
<div class="video-home-mobile row-item">
    <div class="container" id="video-gallery">
        <div class="video-gallery" <?php echo $bk_images; ?>>
          <?php foreach($list as $item){
            //strt
            $link_video = $item->link_video_other;
            if($item->image){
                $link_img = str_replace("original", "resized", $item->image);
            }else if($link_video){
                parse_str( parse_url( $link_video, PHP_URL_QUERY ), $arr_youtube_key );
                $video_id = $arr_youtube_key['v'];
                $thumb_default = "http://img.youtube.com/vi/$video_id/0.jpg"; 
                $link_img = $thumb_default;
            }else{
                $link_img = 'images/no-images.png';
            } 
          ?> 
          <a rel="nofollow" style="top:<?php echo $item->top? $item->top:0; ?>px ;left:<?php echo $item->pos_left? $item->pos_left:0; ?>px ;" class="w3-btn ui-draggable" href="<?php echo $link_video; ?>" data-sub-html="<h4 class='title'><?php echo FSText::_('Ý kiến bệnh nhân tại'); ?> <?php echo $item->name; ?></h4>" >
              <i class="fa fa-play-circle"></i> 
              <?php echo str_replace(array('Hà Nội','TP Hồ Chí Minh'),array('<strong>Hà Nội</strong>','<strong>TP Hồ Chí Minh</strong>'),$item->name); ?>
          </a>
          <?php } ?>
        </div><!-- END: #video-gallery -->
    </div>
</div>

<?php $stt=1; foreach($address as $item){?>
<div class="inner-info row-item">
    <h3 class="contact-title">
        <span><?php echo $item->name;?></span>
    </h3>
    <div class="content">
        <?php echo html_entity_decode($item->more_info); ?>
    </div>
</div><!-- END: .inner-info -->
<?php $stt+=1; }?>




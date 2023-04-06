<?php
    global $tmpl,$config;
    $tmpl -> addStylesheet('detail','modules/contents/assets/css');
?>

<div class="contents row-content">
        <h1 class="title"><?php	echo $data -> title; ?></h1>
        <?php if($data->content){ ?>
           <div class='description row-item'>
            <?php echo $data->content; ?>
    	     </div><!-- END: .news-detail-content -->
           <div class="row-item share"><?php //include 'default_share_bottom.php'; ?></div>
        <?php } ?>
        <input type="hidden" value="<?php echo $data->id; ?>" name='contents_id' id='contents_id'  />
</div><!-- END: .news_detail -->
<script src="https://apis.google.com/js/platform.js" async defer>{lang: 'vi'}</script>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Article",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"<?php echo FSRoute::_('index.php?module=contents&view=content&code='.$data -> alias.'&ccode='.$data->category_alias.'&id='.$data->id) ?>"
  },
  "headline": "<?php echo $data->title ?>",
  "image": {
    "@type": "ImageObject",
    "url": "<?php echo URL_ROOT.str_replace('/original/', '/original/', $data->image); ?>",
    "height": 700,
    "width": 700
  },
  "datePublished": "<?php echo date('d/m/Y',strtotime($data->created_time));?>",
  "dateModified": "<?php echo date('d/m/Y',strtotime($data->updated_time));?>",
  "author": {
    "@type": "Person",
    "name": "<?php echo $config['site_name']; ?>"
  },
   "publisher": {
    "@type": "Organization",
    "name": "<?php echo URL_ROOT.$config['site_name']; ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo URL_ROOT.$config['logo']; ?>",
      "width": 600,
      "height": 60
    }
  },
  "description": "<?php echo $data -> summary;?>"
}
</script>

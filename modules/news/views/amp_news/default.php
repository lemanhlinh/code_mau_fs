<?php
    global $tmpl,$config;
    $tmpl -> addStylesheet('detail','modules/news/assets/css');
    $tmpl -> addScript('detail','modules/news/assets/js');
?>
<h2 class="title-module mbl">
  <span><?php	echo $category -> name; ?></span>
</h2>
<div class="news_detail row-content">
        <h1 class="news-title"><?php	echo $data -> title; ?></h1>
        <div class="row-item datetime-hits">
            <span class="datetime"><?php echo date('d/m/Y H:i:s',strtotime($data -> created_time)); ?></span>
            <span class="hits"><?php echo $data->hits.' '.FSText::_('Lượt xem') ?></span>
        </div>

        <summary class="summary row-item">
            <?php echo $data -> summary; ?>
        </summary><!-- END: .news-detail-content -->

        <div class='description row-item'>
            <?php echo $data->content; ?>
    	</div><!-- END: .news-detail-content -->

      <div class="row-item share">
        <?php include 'default_share_bottom.php'; ?>
      </div>

      <div class="row-item comment mbl">
        <?php include 'comment_facebook.php'; ?>
      </div>

      <div class="row-item related">
        <?php include 'default_related.php'; ?>
      </div>

      <input type="hidden" value="<?php echo $data->id; ?>" id="record_id" />
      <input type="hidden" value="<?php echo $data->id; ?>" name='news_id' id='news_id'  />
</div><!-- END: .news_detail -->

<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'vi'}
</script>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Article",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"<?php echo FSRoute::_('index.php?module=news&view=news&code='.$data -> alias.'&ccode='.$data->category_alias.'&id='.$data->id) ?>"
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

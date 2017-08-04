<div class="middle-l-panel-news-main">
    <div class="txt9 middle-l-panel-news-hdng">OZLENS RENTAL <span class="txt10">NEWS</span></div>
    <?PHP
    $args = array(
        'numberposts' => 10,
        'offset' => 0,
        'category' => 2,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'draft, publish, future, pending, private',
        'suppress_filters' => true );

    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

    foreach($recent_posts as $post)
    {
    ?>
    <div class="middle-l-panel-news-1">
      <div class="middle-l-panel-news-thmb"><img src="<?PHP echo base_url();?>assets/images/news-img1.jpg" width="37" height="42" /></div>
      <div class="middle-l-panel-news-txt1">
        <div class="middle-l-panel-news-txt2"><span class="txt11"><?PHP echo date('d-m-Y',strtotime($post["post_date"]));?></span><br />
          <a href="<?PHP echo get_permalink($post["ID"])?>" class="txt12"><?PHP echo $post["post_title"];?></a></div>
      </div>
    </div>
    <?PHP
    }
    ?>
</div>
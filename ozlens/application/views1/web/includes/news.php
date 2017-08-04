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
         //'post_status' => 'draft, publish, future, pending, private',
		'post_status' => 'publish',
        'suppress_filters' => true );

    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

    foreach($recent_posts as $post)
    { 
	
	//$img = $this->db_model->get_post_img($post["ID"]);
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post["ID"]) );
//echo $feat_image;
    ?>
    <div class="middle-l-panel-news-1">
      <div class="middle-l-panel-news-thmb">
      <?php if ( $feat_image != '') { 
	  $feat_image = str_replace('http','https',$feat_image);
	  ?>
     <img src="<?PHP echo $feat_image; ?>" width="37" height="42" />
       <?php } else { ?>
       <img src="<?PHP echo base_url();?>assets/images/news-img1.jpg" width="37" height="42" />
        <?php } ?>
      </div>
      <div class="middle-l-panel-news-txt1">
        <div class="middle-l-panel-news-txt2"><span class="txt11">
		<?PHP echo date('d-m-Y',strtotime($post["post_date"]));?></span><br />
          <a href="<?PHP echo get_permalink($post["ID"])?>" class="txt12"><?PHP echo $post["post_title"];?></a></div>
      </div>
    </div>
    <?PHP
    }
    ?>
</div>
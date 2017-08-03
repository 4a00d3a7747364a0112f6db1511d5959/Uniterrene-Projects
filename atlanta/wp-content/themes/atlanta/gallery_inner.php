<?php
/**
 * Template Name: Gallery Inner Page
 */

get_header('gallery');
?>
<section id="gallery-inner">
   <div class="container clearfix">
  
   <h2>Xtreme ashes Eyelash Extensions</h2>
  <div class="row clearfix">
		<div id="gallery-menu" style="display: none;"> 
			<!-- <a href="#" data-liquo="all" class="btn btn-primary">All</a> -->
			 <!-- <?php
			 				$args = array(
			 				'numberposts' => -1,
			 				'offset' => 0,
			 				'category' => 0,
			 				'orderby' => 'post_date',
			 				'order' => 'ASC',
			 				'include' => '',
			 				'exclude' => '',
			 				'meta_key' => '',
			 				'meta_value' =>'',
			 				'post_type' => 'eyelash_post_type',
			 				'post_status' => 'publish',
			 				'suppress_filters' => true
			 				);
			 
			 				$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
			 
			 				//print_r($recent_posts);
			 
			 				$j=1;
			 				$input = array();
			 				foreach($recent_posts as $recent_posts)
			 				{ 
			 					$post_name = $recent_posts['post_title'];
			 					$post_name = explode(" ",$post_name);
			 					$data_liquo = $post_name[0];
			 					$data_liquo = strtolower($data_liquo);
			 					//echo $data_liquo;
			 					//echo "<br/>";
			 					?>
			 			<a href="#" data-liquo="<?php echo $data_liquo;?>" class="btn btn-primary"><?php echo $recent_posts['post_title'];?>
			 			</a>
			 				<?php	} ?> -->

		</div>
     
     <div class="gallery-right" style="width: 100%;">
      <ul id="gallery" class="gallery">
		  
		  <?php
				$args = array(
				'numberposts' => -1,
				'offset' => 0,
				'category' => 0,
				'orderby' => 'post_date',
				'order' => 'ASC',
				'include' => '',
				'exclude' => '',
				'meta_key' => '',
				'meta_value' =>'',
				'post_type' => 'eyelash_post_type',
				'post_status' => 'publish',
				'suppress_filters' => true
				);

				$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
				$i=1;
				$input = array();
				foreach($recent_posts as $recent_posts)
				{ 
					$post_name = $recent_posts['post_title'];
					$post_name = explode(" ",$post_name);
					$data_liquo = $post_name[0];
					$data_liquo = strtolower($data_liquo);
					$gallery = get_post_gallery( $recent_posts['ID'], false );
            
					/* Loop through all the image and output them one by one */
					foreach( $gallery['src'] as $src ) { ?>
						
						<li  data-liquo="<?php echo $data_liquo;?>"><a href="<?php echo $src; ?>"><img src="<?php echo $src; ?>" /></a></li>
						<?php
						} 
					
					$i++; } ?>
					 

    
    
  </ul>
  <div class="app_button_page"><a href="<?php echo esc_url( home_url() ); ?>/get-an-appointment/">MAKE AN APPOINTMENT</a></div>
  </div>
  
  </div>
  
  
  
  
  
  
  
</div>
</section>
<!--
<script>
	jQuery(function () {
	var l = jQuery("#gallery li").length;
	alert(l);
	});
	</script>
-->

<?php get_footer('gallery');?>

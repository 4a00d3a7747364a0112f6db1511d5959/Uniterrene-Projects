<?php
/**
 * Template Name: Makeup Services Page Template
 */
get_header('gallery');
while ( have_posts() ) : the_post();
$id = get_the_ID();
$class_name = "custom-inner-".$id;
?>

<!--Xtreme Lashes start-->
<section id="gallery-inner" class="spa_wrapper inner_service <?php echo $class_name; ?>">
  <div class="container clearfix">
  <?php the_title( '<h2 style="margin-bottom: 50px;">', '</h2>' ); ?>
   <div class="entry-content"> 
	   <?php 
					if ( get_post_gallery() ) {
						
						the_excerpt();
						?>
						<div class="container clearfix">
						<div class="row clearfix">
        <div class="gallery-image-center-box">  
						<div class="left-image-slider clearfix">
						<!-- <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
											<?php 
											if ( get_post_gallery() ) :
											$gallery = get_post_gallery( get_the_ID(), false );
											 foreach( $gallery['src'] as $src ) : ?>
						                    <li data-thumb="<?php echo $src ?>"> 
						                        <img src="<?php echo $src ?>" />
						                         </li>
						                         <?php 
							endforeach;
							endif;
							?>
						                </ul> -->

						                <ul id="gallery" class="gallery">
		  
		  <?php
				$args = array(
				'numberposts' => 1,
				'offset' => 0,
				'category' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'include' => '',
				'exclude' => '',
				'meta_key' => '',
				'meta_value' =>'',
				'post_type' => 'makeup_gallery',
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
                </div>
                </div>

                <p style="text-align: center; font-size: 12px;"><?php echo get_post_meta($post->ID, 'makeup_image_curtesy', true); ?></p>
               				
				<div class="app_button_page"><a href="<?php echo esc_url( home_url() ); ?>/get-an-appointment/">MAKE AN APPOINTMENT</a></div>

                </div>
                </div>
						<?php
						
						}
						
					
					else
					{
						the_content();
					}
    ?>
  </div>
</section>
<!--Xtreme Lashes end--> 
<?php 
endwhile;
get_footer('gallery');?>

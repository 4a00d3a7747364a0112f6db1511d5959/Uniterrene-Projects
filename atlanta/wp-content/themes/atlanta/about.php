<?php
/**
 * Template Name: About Page
 */

get_header('inner');
?>


<!--the About start-->
<section class="spa_wrapper inner_about">
  <div class="container clearfix">
    <h2><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/logo_heading.png" alt="heading" title="heading"></h2>
    <?php
			while ( have_posts() ) : the_post();
			?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'single-post-thumbnail' ); 
			
			?>
    <div class="spa_sec_right"> <img src="<?php echo $image[0];?>" alt="spa" title="spa"/> </div>
         <?php echo the_content();?>
       <?php
      endwhile; // End of the loop.
			?>
    </div>
  </div>
</section>
<!--the About end--> 

<!--Team section start-->
<section class="contact_us our_team">
  <div class="contact_overlay">
    <div class="contact_wrapper">
      <div class="container clearfix">
        <div class="team_wrap">
          <h5> <?php echo get_post_meta($post->ID, 'Want to enjoy Title', true); ?></h5>
          <h5><?php echo get_post_meta($post->ID, 'EYE-LASHEs', true); ?></h5>
          <div class="app_button"> <?php echo get_post_meta($post->ID, 'Buuton Text', true); ?></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Team Section end--> 

<!--home testimonial Section-->
<section class="testimonial_sec press">
  <div class="container clearfix">
    <h2>TESTIMONIALS</h2>
    <div class="main-gallery">
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
	'post_type' => 'Testimonial',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{ 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID'] ), 'single-post-thumbnail' ); 
	$alt = explode("/",$image[0]);
	$alt_tag = end($alt);
	?>
      <div class="gallery-cell">
        <div class="testimonial"> <img src="<?php echo $image[0]?>" alt="<?php echo $alt_tag?>"/>
          <div class="testimonial_content"> <q class="testimonial-quote"><?php echo apply_filters( 'the_content', wp_trim_words( strip_tags( $recent_posts['post_content'] ), 55 ) ); ?></q> <span class="testimonial-author"><?php print_r($recent_posts['post_title'] );?></span> </div>
        </div>
      </div>
      <?php } ?>
      
    </div>
  </div>
</section>
<!--home testimonial Section end--> 

<!--Footer Section start-->

<?php get_footer('alt');?>

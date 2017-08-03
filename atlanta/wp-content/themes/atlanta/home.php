<?php
/**
 * Template Name: Home Page
 */
get_header('alt');
?>
<!--the spa start-->
<section class="spa_wrapper">
  <div class="container clearfix">
    <h2>THE SPA</h2>
    <?php
			while ( have_posts() ) : the_post();
			?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'single-post-thumbnail' ); 
			
			?>
     <div class="spa_sec_right"> <img src="<?php echo $image[0]?>" alt="spa" title="spa"/> </div>
    <div class="spa_sec_left">
		
      <p><?php echo the_content();?></p>
      <?php
      endwhile; // End of the loop.
			?>
    </div>
   
  </div>
</section>
<!--the spa end--> 

<!--Start Eye Candy-->
<section class="eye_candy clearfix">
  <div class="eye_candy_left_img clearfix">
    <h2><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/logo_heading.png" alt="heading" title="heading"/></h2>
    <div class="eye_candy_left"> 
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(8), 'single-post-thumbnail' ); 
			
			?>
    <img src="<?php echo $image[0];?>" alt="heading" title="heading"/>
    </div>
    <div class="eye_candy_rigth">
		<?php
		$my_postid = 8;//This is page id or post id
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
		echo $content;
		?>

    </div>
  </div>
</section>
<!--End Eye Candy--> 

<!--Start Eye Candy-->
<section class="service">
  <div class="service_wrapper">
    <div class="service_wrapper2">
      <div class="container">
        <h6>What We Do?</h6>
        <h2>OUR SERVICES</h2>
        <div id="container" class="cf">
          <div id="main" role="main">
            <section class="slider">
              <div class="flexslider carousel">
                <ul class="slides">
                  <?php
/*$args = array(
	'numberposts' => -1,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'post_date',
	'order' => 'ASC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'services',
	'post_status' => 'publish',
	'suppress_filters' => true
);*/

$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => 16,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );

$recent_posts = wp_get_recent_posts( $args, ARRAY_A );

//print_r($recent_posts);

$j=1;
$input = array();
foreach($recent_posts as $recent_posts)
{ 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_posts['ID'] ), 'single-post-thumbnail' ); 
	$alt = explode("/",$image[0]);
	$alt_tag = end($alt);
	?>
                 
                  <li onclick="location.href = '<?php echo get_permalink($recent_posts['ID']); ?>';">
                    <div class="service_slider_content">
                      <a href="<?php echo $recent_posts['post_name'] ?>">
                      <div class="service_img_container">
                       <img src="<?php echo $image[0]?>" alt="<?php echo $alt_tag;?>"/>
                      </div>
                      <h3><?php echo $recent_posts['post_title'];?></h3>
                      </a>
                    </div>
                  </li>
                 <?php } ?>
                </ul>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--End Eye Candy--> 

<!--Press Section start-->
<section class="press">
  <div class="container">
    <h2>our press</h2>
    <div id="container" class="cf">
      <div id="main" role="main">
        <!--<section class="slider press-slides-div">
          <div class="flexslider carousel press-slides-box">
            <ul class="slides">
             <?php
$args = array(
	//'numberposts' => -1,
	//'offset' => 0,
	//'category' => 0,
	//'orderby' => 'post_date',
	//'order' => 'ASC',
	//'include' => '',
	//'exclude' => '',
	//'meta_key' => '',
	//'meta_value' =>'',
	//'post_type' => 'press',
	//'post_status' => 'publish',
	//'suppress_filters' => true
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
             
              <li onclick="location.href = '<?php echo get_permalink($recent_posts['ID']); ?>';">
                <div class="service_slider_content">
                  <div class="service_img_container"> <img src="<?php //echo $image[0]?>" alt="<?php //echo $alt_tag?>"/> </div>
                  <h3><?php //print_r($recent_posts['post_title'] );?></h3>
                </div>
              </li>
            <?php } ?>
            </ul>
          </div>
        </section>-->
        
        <div class="press-box">
         <ul>
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
	'post_type' => 'press',
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
             
              <li onclick="location.href = '<?php echo get_permalink($recent_posts['ID']); ?>';">
                <div class="service_slider_content">
                  <div class="service_img_container"> <img src="<?php echo $image[0]?>" alt="<?php echo $alt_tag?>"/> </div>
                  <h3><?php print_r($recent_posts['post_title'] );?></h3>
                </div>
              </li>
            <?php } ?>
         </ul>
        </div>
        
        
      </div>
    </div>
  </div>
</section>
<!--Press Section end--> 
<!--home contact section start-->
<section class="contact_us">
  <div class="contact_overlay">
    <div class="contact_wrapper">
      <div class="container ">
        <h2>CONTACT US</h2>
        <h6>GET IN TOUCH WITH US</h6>
        <div class="contact-div clearfix">
          <div class="contact-left-box">
			  
			   <?php echo get_option('webq_contact_us');?>
			  
           </div>
           <?php echo do_shortcode( '[contact-form-7 id="150" title="Home Page Contact Form"]' );?> 
          
        </div>
      </div>
    </div>
  </div>
</section>
<!--home contact Section end--> 

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
          <div class="testimonial_content"> <q class="testimonial-quote">
			  <?php echo apply_filters( 'the_content', wp_trim_words( strip_tags( $recent_posts['post_content'] ), 55 ) ); ?>
			  
			  </q> <span class="testimonial-author"><?php print_r($recent_posts['post_title'] );?></span> </div>
        </div>
      </div>
      <?php } ?>
      
    </div>
  </div>
</section>
<!--home testimonial Section end--> 

<!--Footer Section start-->

<?php get_footer();?>

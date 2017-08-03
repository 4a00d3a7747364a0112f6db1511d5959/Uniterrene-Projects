<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		<footer>
  <section class="footer">
    <div class="footer_overlay">
      <div class="map_img">
        <div class="container clearfix">
          <div class="footer_sec_content">
            <h5>CONTACT US</h5>
            <ul class="footer_contact">
              <li>
                <span><i class="fa fa-map-marker" aria-hidden="true"></i> </span>
                <?php echo get_option('webq_footer_add');?>
              </li>
              <li>
                <span><i class="fa fa-map-marker" aria-hidden="true"></i> </span>
                <?php echo get_option('webq_footer_add1');?>
              </li>
            </ul>
           <div class="acc-statement"><?php echo get_option('webq_footer_acc_statement');?></div>
            <div class="social-media">Follow Us on: <a href="<?php echo get_option('webq_footer_social_link');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/snapchat.png"></a></div>
          </div>
          <div class="footer_sec_content quick_sec">
            <h5>QUICK LINKS</h5>

            <ul class="quick_link">
              <?php 

$defaults = array( 
'menu' => '',
 'container' => '', 
 'container_class' => '', 
 'container_id' => '', 
 'menu_class' => '', 
 'menu_id' => '',
    'echo' => true, 
    'fallback_cb' => '', 
    'before' => '', 
    'after' => '', 
    'link_before' => '', 
    'link_after' => '', 
    'items_wrap' => '%3$s', 
    'item_spacing' => 'preserve',
    'depth' => 0, 
    'walker' => '', 
    'theme_location' => 'footer'
     );
    
    
wp_nav_menu($defaults); ?>
        


            </ul>


            
            
          </div>
          <div class="footer_sec_content">
			  <h5>LATEST PROJECT</h5>
			   <ul class="latest_project">
			  <?php
			$original_query = $wp_query;
			$wp_query = null;
			$args=array('posts_per_page'=>1,'post_type' => 'page', 'name' =>'LATEST PROJECT');
			$wp_query = new WP_Query( $args );
      //print_r($wp_query);
			if ( have_posts() ) :

			while (have_posts()) : the_post();

			$post_id = get_the_ID();
			$post_title = get_the_title( $post_id );
			if ( get_post_gallery() ) :
            $gallery = get_post_gallery( get_the_ID(), false );
            
            /* Loop through all the image and output them one by one */
            foreach( $gallery['src'] as $src ) : ?>
               
			<li><a href="<?php the_permalink(); ?>"><img src="<?php echo $src; ?>"/></a> </li>
			
			<?php 
			 endforeach;
			 endif;
			endwhile;
		endif;
		$wp_query = null;
		$wp_query = $original_query;
		wp_reset_postdata();
			 
			 ?>
            

            </ul>
          </div>
          <div class="footer_sec_content">
            <h5>sign up for specials</h5>
            <div class="sign_up">
				<?php echo do_shortcode( '[contact-form-7 id="745" title="Subscription Form"]' );?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bottom_footer">
    <div class="container clearfix">
      <p><?php echo get_option('webq_footer_copy');?></p>
     
      <?php echo get_option('webq_footer_faq');?>
<!--
        <ul>
          <li><a href="#">Faq</a></li>
          <li>|</li>
          <li><a href="#">Services</a></li>
          <li>|</li>
          <li><a href="#">Sitemap</a></li>
          <li>|</li>
          <li><a href="#">Privacy Policy</a> </li>
        </ul>
-->
     
    </div>
  </section>
</footer>
<!--Footer Section end-->

<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/jquery-1.11.0.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.min.js'></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() )?>/js/custom.js"></script>
<!-- search -->
<script>
jQuery(function ($) {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
    
    /*$('form').submit(function(event) {
        event.preventDefault();
        return false;
    })*/
});
</script>
<!-- search End-->
<!--start nav-->
<script src="<?php echo esc_url( get_template_directory_uri() )?>/js/index.js"></script>
<!--end nav-->
<!-- FlexSlider -->
<script defer src="<?php echo esc_url( get_template_directory_uri() )?>/js/jquery.flexslider.js"></script>

<script>
   jQuery(document).ready(function($){
	   $('.sign_up input[type=submit] ').attr('value', '');
	   });
</script>

</body>
</html>

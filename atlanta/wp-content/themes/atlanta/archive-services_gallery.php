<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 
get_header('inner'); ?>
<style>
li.photogallthm{
	margin-top: 45px;
	width:25%;
	height:auto;
	float:left;
	}
.service_slider_content{
	padding:0px !important;
	}
</style>
<section class="spa_wrapper inner_service">
  <div class="container clearfix" >
   <h2>OUR PHOTO GALLERY</h2>
    <div class="container clearfix" >
  <?php if ( have_posts() ) : ?>
   <ul>
  <?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content', get_post_format() );
				 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
	$alt = explode("/",$image[0]);
	$alt_tag = end($alt);
	?>
             
              <li onclick="location.href = '<?php echo get_permalink(); ?>';" class="photogallthm">
                <div class="service_slider_content">
    <img src="<?php echo $image[0]?>" alt="<?php echo $alt_tag?>"/>
                  <h3><?php print_r(get_the_title());?></h3>
                </div>
              </li>
            <?php 

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );
?>
</ul>
<?php
		endif;
		?>
        </div>
  </div>
</section>
<!--Xtreme Lashes end--> 
<?php get_footer(); ?>

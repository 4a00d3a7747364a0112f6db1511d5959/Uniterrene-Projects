<?php
/**
 * Template Name: Gallery Carousel Page
 */

get_header('gallery-carasoul');
?>
<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
				//echo get_the_ID();
				?>
<section id="gallery-inner-2">
  <div class="container clearfix">
  
     <h2><?php echo the_title();?></h2>
     <div class="row clearfix">
        <div class="gallery-image-left">  
            <div class="left-image-slider clearfix">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
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
                </ul>
            </div>
     </div>
        <div class="gallery-image-right">
         <?php echo get_post_meta( get_the_ID(), 'Page Content', true );?>
        </div>
     </div>
          
  </div>
</section>
<?php	
				endwhile; // End of the loop.
			?>

<?php get_footer('gallery-carasoul');?>

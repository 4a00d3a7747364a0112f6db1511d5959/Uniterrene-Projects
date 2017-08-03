<?php
/**
 * Template Name: Single Services Page Template
 */
get_header('gallery-carasoul');
while ( have_posts() ) : the_post();
$id = get_the_ID();
$class_name = "custom-inner-".$id;
?>

<!--Xtreme Lashes start-->
<section class="spa_wrapper inner_service <?php echo $class_name; ?>">
  <div class="container clearfix">
  <?php the_title( '<h2 style="margin-bottom: 50px;">', '</h2>' ); ?>
   <div class="entry-content"> 
	   <?php 
					if ( get_post_gallery() ) {
						
						the_excerpt();
						?>
						<div class="container clearfix">
						<div class="row clearfix">
        <div class="gallery-image-center">  
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
get_footer('gallery-carasoul');?>

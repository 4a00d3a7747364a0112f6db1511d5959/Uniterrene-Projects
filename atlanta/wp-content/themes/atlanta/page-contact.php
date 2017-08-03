<?php
/**
 * Template Name: Conatct Us Page
 */
get_header('inner');
while ( have_posts() ) : the_post();
?>
<!--Xtreme Lashes start-->
<section class="spa_wrapper inner_service">
  <div class="container clearfix">
  <?php the_title( '<h2>', '</h2>' ); ?>
   <?php /*?> <h2>Xtreme Lashes<sup>®</sup> Eyelash Extensions</h2><?php */?>
    <div class="spa_sec_right">
     <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );?>">
    </div>
    <div class="spa_sec_left">
     <?php /*?> <p>Xtreme Lashes® Eyelash Extensions is committed to consumer safety and the long term health of the eyelash extension industry by requiring hands on eyelash extension training and certification through a certified Xtreme Lashes® Trainer in order to purchase products. Furthermore, Xtreme Lashes only certifies licensed or credentialed health and beauty professionals. We kindly ask that both consumers and beauty professionals only support responsible eyelash extension brands that require hands on training in order to preserve the exciting and revolutionary eyelash extension industry.</p><?php */?>
     <?php the_content(); ?>
    </div>
  </div>
</section>
<!--Xtreme Lashes end--> 
<?php 
endwhile;
get_footer();?>
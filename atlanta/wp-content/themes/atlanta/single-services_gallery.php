<?php
/**
 * Template Name: Services Page
 */

get_header('inner');
?>
<style>
figure.gallery-item{
	width:auto;
	height:auto;
	float:left;
	}
div.gallery{
	margin-top:35px;
	}
</style>
<?php
while ( have_posts() ) : the_post();
?>
<!--Xtreme Lashes start-->
<section class="spa_wrapper inner_service">
  <div class="container clearfix">
  <?php the_title( '<h2>', '</h2>' ); ?>
   <div class="entry-content">
   <?php
   /*?> <p>Xtreme Lashes® Eyelash Extensions is committed to consumer safety and the long term health of the eyelash extension industry by requiring hands on eyelash extension training and certification through a certified Xtreme Lashes® Trainer in order to purchase products. Furthermore, Xtreme Lashes only certifies licensed or credentialed health and beauty professionals. We kindly ask that both consumers and beauty professionals only support responsible eyelash extension brands that require hands on training in order to preserve the exciting and revolutionary eyelash extension industry.</p><?php */?>
     <?php the_content(); ?>
    </div>
  </div>
</section>
<?php 
endwhile;
get_footer();?>
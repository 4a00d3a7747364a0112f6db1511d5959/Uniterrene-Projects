<?php
/**
 * Template Name: Thank You for Your Appointment
 */
get_header('inner'); ?>

<section class="spa_wrapper inner_service">
  <div class="container clearfix">
   <div class="entry-content">

	<div class="error-404 not-found">
		<div class="page-header">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
		</div><!-- .page-header -->

		<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
				<?php get_search_form(); ?>
		</div><!-- .page-content -->
	</div><!-- .error-404 -->

</div>
  </div>
</section>

<?php get_footer();?>

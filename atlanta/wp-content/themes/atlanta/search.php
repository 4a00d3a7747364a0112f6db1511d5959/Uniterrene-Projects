<?php
/**
 * search page template
 */
get_header('inner'); ?>

<div class="spa_wrapper inner_service">
  <div class="container clearfix">
   <div class="entry-content">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<h1 style="text-align: center;"><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>'); ?></h1> 

	    	<?php if(have_posts()) { while(have_posts()) { the_post(); ?>

	    		

	    		<a href="<?php the_permalink(); ?>"><?php search_title_highlight(); ?></a>

	    		<?php search_excerpt_highlight(); ?>

	    		<?php } get_search_form();

	    }

	    	else{ echo "No data found. Please try with some other keywords"; 

	    	 get_search_form(); } ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

</div>
  </div>
</section>

<?php get_footer();?>

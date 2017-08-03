<?php
/**
 * Template Name: Permanent Makeup Page Template
 */
get_header('inner');
?>

<!--Xtreme Lashes start-->
<section class="spa_wrapper inner_service">
  <div class="container clearfix">
  	<?php while ( have_posts() ) : the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <div class="spa_sec_right" style="display: none;">
      <!-- <embed src="http://www.youtube.com/v/OmWEDvWOPQU&amp;hl=en&amp;fs=1&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" height="250px" width="100%"> --> 
      <?php the_excerpt(); ?>
    </div>
    <div class="spa_sec_left" style="width: 100%;">
      <?php the_content(); ?>
    </div>
    <?php endwhile; ?>
  </div>
</section>
<!--Xtreme Lashes end--> 

<!--Important Link section start
<section class="contact_us ser_heading">
  <div class="contact_overlay">
    <div class="contact_wrapper">
      <div class="container clearfix">
        <div class="team_wrap">
			<?php 
				$args = array(
				    'post_type'      => 'page',
				    'posts_per_page' => -1,
				    'post_parent'    => 301,
				    'order'          => 'ASC',
				    'orderby'        => 'menu_order'
				 );

				$service_args = wp_get_recent_posts( $args, ARRAY_A );

				foreach($service_args as $services){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $services['ID'] ), 'single-post-thumbnail' ); 
			?>
          <div class="top_heading_sec"> <img src="<?php echo $image[0]?>" alt="<?php echo $alt_tag;?>"/>
            <h6><a href="<?php echo $services['post_name'] ?>"><?php echo $services['post_title'];?></a></h6>
          </div>        
			<?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
Important Link section end--> 

<!--testimonial Section--
<section class="testimonial_sec inner_testi">
  <div class="container clearfix">
    <h2>Our Pricing Plans</h2>
    <div class="plan_sec_holder">
       <div class="plan_sec">
        <div class="plan_sec_top">
          <p> Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
        </div>
        <div class="plan_sec_middle plan_first">
          <ul>
            <li>
              <div class="plan_container"><a href="#">Partial Set </a> <span>$350.00</span></div>
            </li>
            <li>
              <div class="plan_container"><a href="#">Glamours Look</a> <span>$350.00</span></div>
            </li>
            <li>
              <div class="plan_container"><a href="#">Diva Lashes</a> <span>$350.00</span></div>
            </li>
          </ul>
        </div>
        <h5><a href="#">PURCHASE NOW</a></h5>
        <div class="plan_heading_shape">
          <div class="plan_heading">
            <div class="plan_heading_wrap1">
              <div class="plan_heading_wrap2">
                <h3>Basic</h3>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <div class="plan_sec middle_plan_secc">
        <div class="plan_sec_top">
          <?php echo get_post_meta($post->ID, "middle_plan_top_content", true); ?>
        </div>
        <div class="plan_sec_middle">
          <ul>
            <li>
              <div class="plan_container"><?php echo get_post_meta($post->ID, "middle_plan_first_rate", true); ?></div>
            </li>
            <li>
              <div class="plan_container"><?php echo get_post_meta($post->ID, "middle_plan_second_rate", true); ?></div>
            </li>
            <li>
              <div class="plan_container"><?php echo get_post_meta($post->ID, "middle_plan_third_rate", true); ?></div>
            </li>
            <li>
              <div class="plan_container"><?php echo get_post_meta($post->ID, "middle_plan_fourth_rate", true); ?></div>
            </li>
          </ul>
          <?php echo get_post_meta($post->ID, "middle_plan_bottom_content", true); ?>
        </div>
         <h5><a href="#">PURCHASE NOW</a></h5> 
        <div class="plan_heading_shape">
          <div class="plan_heading">
            <div class="plan_heading_wrap1">
              <div class="plan_heading_wrap2">
                <h3><?php echo get_post_meta($post->ID, "middle_plan_title", true); ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <div class="plan_sec">
       <div class="plan_sec_top">
         <p> Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
       </div>
       <div class="plan_sec_middle">
         <ul>
           <li>
             <div class="plan_container"><a href="#">Highlights (Colored lashes) </a> <span>$35per color</span></div>
           </li>
           <li>
             <div class="plan_container"><a href="#">Just Corners <br/>
               </a>
               <p>(include lashes added to<br/>
                 enhance inside and outside corners)</p>
               <span>$50</span></div>
           </li>
           <li>
             <div class="plan_container"><a href="#">Corrective Lashes </a> <span>Starting at $650</span></div>
           </li>
         </ul>
       </div>
       <h5><a href="#">PURCHASE NOW</a></h5>
       <div class="plan_heading_shape">
         <div class="plan_heading">
           <div class="plan_heading_wrap1">
             <div class="plan_heading_wrap2">
               <h3>Advanced</h3>
             </div>
           </div>
         </div>
       </div>
     </div> 
    </div>
  </div>
</section>
testimonial Section end--> 

<?php 
get_footer('alt');?>
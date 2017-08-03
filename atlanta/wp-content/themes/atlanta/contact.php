<?php
/**
 * Template Name: Contact Page
 */

get_header('inner');
?>
<section id="contact">
  <div class="container">
	 <div style="text-align:center" class="clearfix">
        <div class="contact-top-address">
           <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/contact-icon.png" alt=""/>
            <?php echo get_option('webq_header_add');?>
       </div>
        <div class="contact-top-address">
           <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/contact-icon.png" alt=""/>
           <?php echo get_option('webq_header_add2');?>
      </div>
     </div>
	 <div class="contact-page-form">
        <div class="contact-page-area">
			<?php echo do_shortcode( '[contact-form-7 id="196" title="Contact us"]' ); ?>

		</div>
     </div>
    </div>
  
</section>

<section id="contact-map">
	
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3306.334090565946!2d-84.3413084496368!3d34.03530018051539!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f574ba10abe0a7%3A0xf58bfd86a2f6acf3!2s760+Old+Roswell+Rd%2C+Roswell%2C+GA+30076%2C+USA!5e0!3m2!1sen!2sin!4v1486708254914" frameborder="0" style="border:0" allowfullscreen></iframe>

</section>
<!--Footer Section start-->

<?php get_footer();?>

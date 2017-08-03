<?php
/**
 * Template Name: Thank You for Your Appointment
 */
get_header('inner'); ?>

<section class="spa_wrapper inner_service">
  <div class="container clearfix">
   <div class="entry-content">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
    <div class="paypal-btn">
      <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input name="cmd" value="_cart" type="hidden">
        <input name="business" value="trish@atlantaeyecandy.com" type="hidden">
        <input name="item_name" value="$100 Reservation Deposit" type="hidden">
        <input name="currency_code" value="USD" type="hidden">
        <input name="amount" value="100.00" type="hidden">
        <input name="shipping" value="0.00" type="hidden">
        <input name="tax" value="0.00" type="hidden">
        <input src="https://www.paypal.com/en_US/i/btn/x-click-but22.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" border="0" type="image">
        <input name="add" value="1" type="hidden">
      </form>
    </div>
    </div>
  </div>
</section>

<?php get_footer();?>
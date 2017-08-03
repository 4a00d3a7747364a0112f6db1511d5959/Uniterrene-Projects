<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Eyelash-Extensions,Anti Aging Treatments,Spa Services,Permanent Makeup,Celebrity Makeup Artist">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<!---Custom Css Added By Uniterrene--->
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() )?>/images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/common.css">
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/responsive.css">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() )?>/css/flexslider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() )?>/css/css_flex.css" type="text/css" media="screen" />
	<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.min.css'>
	<link href="https://fonts.googleapis.com/css?family=Trocchi" rel="stylesheet">
    <?php
   if(is_page_template('page-gallery.php')){?>
   <!--start gallery-->
<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() )?>/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<!--end gallery-->
   <?php
   }
   ?>
	<!--start nav-->
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() )?>/css/nav_style.css">
	
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--search start-->
<div id="search">
  <button type="button" class="close">×</button>
  <form>
    <input type="search" value="" placeholder="type keyword(s) here" />
  </form>
</div>
<!--search end--> 
<header>
  <nav>
    <div class="container clearfix">
      <div class="logo"> <a href="<?php echo site_url(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() )?>/images/logo.png" alot="Logo" title="Logo"/></a> </div>
      <div class="nav_wrap">
        <div class="navigation">
          <div class="nav_button"> <a class="btn-open" href="#"></a> </div>
        
        <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
      <ul>
<?php 

$defaults = array( 
'menu' => '',
 'container' => '', 
 'container_class' => '', 
 'container_id' => '', 
 'menu_class' => '', 
 'menu_id' => '',
    'echo' => true, 
    'fallback_cb' => '', 
    'before' => '', 
    'after' => '', 
    'link_before' => '', 
    'link_after' => '', 
    'items_wrap' => '%3$s', 
    'item_spacing' => 'preserve',
    'depth' => 0, 
    'walker' => '', 
    'theme_location' => 'primary'
     );
    
    
wp_nav_menu($defaults); ?>
        

<?php endif; ?>	
     </ul>    
 
        </div>
        <div class="overlay close_but">
          <div class="wrap">
            <ul class="wrap-nav">
               
<?php 

$defaults = array( 
'menu' => '',
 'container' => '', 
 'container_class' => '', 
 'container_id' => '', 
 'menu_class' => '', 
 'menu_id' => '',
    'echo' => true, 
    'fallback_cb' => '', 
    'before' => '', 
    'after' => '', 
    'link_before' => '', 
    'link_after' => '', 
    'items_wrap' => '%3$s', 
    'item_spacing' => 'preserve',
    'depth' => 0, 
    'walker' => '', 
    'theme_location' => 'primary'
     );
    
    
wp_nav_menu($defaults); ?>
        

<?php //endif; ?>	
       
 

            </ul>
          </div>
        </div>
        <!--search start-->
        <div class="search_wrapper">
          <ul>
            <li>
              <div class="form_search_wrap">
                <form method="get" id="searchform">
                  <fieldset class="search">
                    <a href="#search" class="btn" title="Submit Search"><i class="fa fa-search" aria-hidden="true"></i></a>
                  </fieldset>
                </form>
              </div>
            </li>
          </ul>
        </div>
        <!--search end--> 
      </div>
    </div>
  </nav>
</header>
<!--slider start-->
<section class="inner_page_banner">
  <div class="doughted_back">
    <div class="slider_overlay slider_overlay_inner">

      <!-- <?php if( is_page('the-atlanta-eye-candy-difference') || is_page('spa-etiquette') || is_page('tips-to-prepare-for-your-visit') ){ ?>
      <div class="inner-app_button"> <a href="<?php echo esc_url( home_url() ); ?>/get-an-appointment/">MAKE AN APPOINTMENT</a> </div>
      <?php } ?> -->

<!--
      <div class="inner_heading">
        <h3><?php if ( is_archive() ){ $tt = explode(':',get_the_archive_title());echo $tt[1]; }else{the_title(); }?></h3>
        <ul class="short_cut_link">
          <li><a href="<?php echo site_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home </a><span>/</span> </li>
          <li class="short_nav_active"><a href="#"><?php if ( is_archive() ){ echo $tt[1]; }else{the_title(); }?></a></li>
        </ul>
        <!-- <h6>Home / <span>About Us</span></h6>
      </div>
-->
    </div>
  </div>
</section>
<!--slider end--> 


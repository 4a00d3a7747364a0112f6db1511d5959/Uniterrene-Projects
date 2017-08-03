<?php
/**
 * Template Name: Photo Gallery Page
 */

get_header('inner');
?>
<section class="service_gallery">
  <div class="container">
    <h2>OUR PHOTO GALLERY</h2>
  <?php /*?>  <div class="gallery_service galleryLoops clearfix"> 
      
      <!-- filter  -->
      <div class="galleryFilerPart">
        <ul>
          <li><a class="active" href="javascript:void(0)">All</a></li>
          <li><a href="javascript:void(0)">Xtreme Lashes Eyelash Extensions</a></li>
          <li><a href="javascript:void(0)">Ultra Body</a></li>
          <li><a href="javascript:void(0)">Softap Permanent Cosmetic</a></li>
        </ul>
      </div>
      
      <!-- left area -->
      <div class="leftPart">
        <div class="leftTopBig">
          <div class="imgWrap">
            <div class="hoverState">
              <div class="tableFormat">
                <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
              </div>
            </div>
            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g1.jpg" alt=""> </div>
        </div>
        <div class="leftBottom clearfix">
          <div class="leftBottom_left">
            <div class="imgWrap">
              <div class="hoverState">
                <div class="tableFormat">
                  <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
                </div>
              </div>
              <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g2.jpg" alt=""> </div>
          </div>
          <div class="leftBottom_right">
            <div class="imgWrap">
              <div class="hoverState">
                <div class="tableFormat">
                  <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
                </div>
              </div>
              <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g3.jpg" alt=""> </div>
          </div>
        </div>
      </div>
      <!-- Right Area -->
      <div class="rightPart">
        <div class="rightTopBig">
          <div class="imgWrap">
            <div class="hoverState">
              <div class="tableFormat">
                <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
              </div>
            </div>
            <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g4.jpg" alt=""> </div>
        </div>
        <div class="rightBottom clearfix">
          <div class="rightBottom_left">
            <div class="rightBottom_left_top">
              <div class="imgWrap">
                <div class="hoverState">
                  <div class="tableFormat">
                    <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
                  </div>
                </div>
                <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g5.jpg" alt=""> </div>
            </div>
            <div class="rightBottom_left_bottom">
              <div class="imgWrap">
                <div class="hoverState">
                  <div class="tableFormat">
                    <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
                  </div>
                </div>
                <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g7.jpg" alt=""> </div>
            </div>
          </div>
          <div class="rightBottom_right">
            <div class="imgWrap">
              <div class="hoverState">
                <div class="tableFormat">s
                  <div class="xoomArea"> <a href="javascript:void(0)"> <i class="fa fa-search"></i> </a> </div>
                </div>
              </div>
              <img src="<?php echo esc_url( get_template_directory_uri() )?>/images/g6.jpg" alt=""> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="app_button"> <a href="#">LOAD MORE</a> </div><?php */
	echo do_shortcode('[PHOTOGALLERY]');?>
  </div>
</section>
<?php get_footer();?>
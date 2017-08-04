<?PHP
/**
 *@var $this CI_Controller
 */
?>
 <!--header div start-->
<?PHP
$header_images = $this->db_model->get_table('banners');
if($header_images)
{
?>
      <div class="header-main">

          <link rel="stylesheet" href="<?PHP echo base_url();?>assets/bannerslider/flexslider.css" type="text/css" media="screen" />

          <div class="header-img" style="background: none;">
              <section class="slider">
                  <div class="flexslider">
                      <ul class="slides">
                          <?PHP
                          foreach($header_images as $h_img)
                          {
                              ?>
                              <li>
                                  <a href="<?PHP echo ($h_img->photo_url ? prep_url($h_img->photo_url) : "javascript:void(0);");?>" target="_blank"><img src="<?PHP echo base_url();?>uploads/images/header/<?PHP echo $h_img->photo_image;?>" /></a>
                              </li>
                              <?PHP
                          }
                          ?>
                      </ul>
                  </div>
              </section>
          </div>

          <!-- jQuery -->
          <script src="<?PHP echo base_url();?>assets/bannerslider/jquery.min.js"></script>

          <!-- FlexSlider -->
          <script defer src="<?PHP echo base_url();?>assets/bannerslider/jquery.flexslider.js"></script>

          <script type="text/javascript">

              $(window).load(function(){
                  $('.flexslider').flexslider({
                      animation: "slide",   /* fade */
                      start: function(slider){
                          $('body').removeClass('loading');
                      }
                  });
              });
          </script>
          <!-- FlexSlider -->



        <!--<div class="header-img" style="background:none; cursor:pointer;" <?PHP /*if($header_image->image_url != ""){*/?>onclick = "window.location='<?PHP /*echo $header_image->image_url;*/?>'"<?PHP /*}*/?>>
        	<img src="<?PHP /*echo base_url();*/?>uploads/images/header/<?PHP /*echo $header_image->image_name; */?>" height="230"/>
        </div>-->
        <!--<div class="header-srch-brnd-main">
          <div class="h-srch-brnd-1">
            <div class="txt2 h-srch-brnd-2">SEARCH BRANDS</div>
            <div class="h-srch-brnd-3">
              <div class="h-srch-brnd-4">
                <select name="" class="drpdwn-1">
                  <option>Make / Model</option>
                </select>
              </div>
              <div class="h-srch-brnd-5">
                <select name="" class="drpdwn-1">
                  <option>Price</option>
                </select>
              </div>
              <div class="h-srch-brnd-5">
                <select name="" class="drpdwn-1">
                  <option>Location</option>
                </select>
              </div>
              <div class="h-srch-brnd-5">
                <select name="" class="drpdwn-1">
                  <option>Memory</option>
                </select>
              </div>
            </div>
            <div class="h-srch-brnd-6">
              <div class="h-srch-brnd-icn1"><img src="<?PHP /*echo base_url();*/?>assets/images/search-icn.png" width="11" height="11" class="h-srch-brnd-icn2"/>
                <input type="submit" name="button" id="button" value="SEARCH"  class="search-bt1" />
              </div>
              <div class="h-srch-brnd-7"><a href="#" class="txt7">Advances Search</a></div>
            </div>
            <div class="clearF"></div>
          </div>
        </div>-->
      </div>
      <!--header div end-->

<?PHP
}
?>
      
      <!--middle div start-->
      <div class="middle-main">
        <?PHP echo $this->load->view('web/includes/mobilecats');?>
        <div class="clearF"></div>
        <!-- end of "tinynav" -->
        
        <div class="leftNav-container"> 
          
          <!--nav div start-->
          <?PHP echo $this->load->view('web/includes/categories');?>
          <!--nav div end--> 
          
          <!--news div start-->
          <?PHP echo $this->load->view('web/includes/news');?>
          <!--news div end--> 
          
        </div>
        <!-- end of "leftNav-container" --> 
        
        <!--featured items div start-->
        <div class="middle-l-f-items-main">
          <div class="txt13 middle-l-f-items-hdng">FEATURED <span class="txt14">GEAR</span></div>
          <div class="middle-l-f-items-1">
          
          <?PHP 
		  $featured_products = $this->db_model->get_rows('products',array('featured'=>'Yes','status'=>'Enabled'));
		  if($featured_products)
		  {
			$i=0;
			foreach($featured_products as $fp)
			{
				
				$p_images = $this->db_model->get_rows('product_photos',array('product_id'=>$fp->id,'is_featured'=>'Yes'));
			
				if($p_images)
				{
					$caption = $p_images[0]->photo_caption;					
					$image =  base_url()."rent/get_image/".$p_images[0]->photo_image."/1000/64";
				}
				else
				{
					$caption = $fp->product_title;
					$image = base_url()."assets/images/image-notFound-BIG.jpg";
				}
		  ?>
               <div class="productHome-listingDiv">
                  <div class="f-items-grey-bg">
                    <div class="middle-l-f-items-img"><a href="<?PHP echo $this->product_model->gen_product_url($fp->id);?>"><img src="<?PHP echo $image;?>" height="64"  border="0" /></a></div>
                  </div>


                  <div class="f-items-grdnt-bg">
                    <div class="txt12 middle-l-f-items-img-txt"><a href="<?PHP echo $this->product_model->gen_product_url($fp->id);?>" class="txt15"><span class="txt15"><?PHP echo $fp->product_title;?> </span></a>

                        <div id="rating_sum<?PHP echo $i;?>" class="middle-l-f-items-img-txt"></div>

                        <script type="text/javascript">
                            ratingJQ('#rating_sum<?PHP echo $i;?>').raty({
                                half: true,
                                start: (<?PHP echo $this->db_model->get_sum_where('reviews','rating',array('product_id'=>$fp->id,'status'=>'Approved'));?> + 0) / <?PHP echo $this->db_model->get_counts_where('reviews',array('product_id'=>$fp->id))?>,
                                readOnly:true,
                                path: "<?PHP echo base_url();?>assets/rating/img/",
                                starHalf:   'star-half.png',
                                starOff:    'star-off.png',
                                starOn:     'star-on.png',
                                size: 20
                            });
                        </script>

                    </div>
                  </div>
                </div>
          <?PHP
		  	if($i%2==0)
			{
				?>
                <div class="productHome-listingSep"></div>
                <?PHP 
			}
		  	$i++;
			}
		  }
		  ?>
          
            
          </div>
          <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>-->
        </div>
        <!--featured items div end--> 
        
        <!--r-pnel div start-->
        <div class="middle-r-panel-main">

            <?PHP $this->load->view('web/includes/right_menu');?>
          
          <!--articles div start-->
          <div class="middle-l-panel-artcle-main">
            <div class="txt9 middle-l-panel-news-hdng">RECENT <span class="txt10">ARTICLES</span></div>

              <?PHP
              $args = array(
                  'numberposts' => 10,
                  'offset' => 0,
                  'category' => 3,
                  'orderby' => 'post_date',
                  'order' => 'DESC',
                  'post_type' => 'post',
                  'post_status' => 'draft, publish, future, pending, private',
                  'suppress_filters' => true );

              $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

              foreach($recent_posts as $post)
              {
                  ?>
                  <div class="middle-l-panel-news-1">
                      <div class="middle-l-panel-news-thmb"><img src="<?PHP echo base_url();?>assets/images/article-icn.jpg" width="37" height="42" /></div>
                      <div class="middle-l-panel-news-txt1">
                          <div class="middle-l-panel-articles-1"><span class="txt11"><?PHP echo date('d-m-Y',strtotime($post["post_date"]));?></span><br />
                              <a href="<?PHP echo get_permalink($post["ID"])?>" class="txt12"><?PHP echo $post["post_title"];?></a></div>
                      </div>
                  </div>
                  <?PHP
              }
              ?>
          </div>
          <!--articles div end--> 
          
          <!--social div start-->
          <div class="middle-l-panel-artcle-main">
            <div class="txt9 middle-l-panel-news-hdng">FOLLOW <span class="txt10">US:</span></div>
            <div class="txt9 middle-l-panel-news-hdng">
            	<?PHP 
                if($this->db_model->get_row('settings',array('key'=>'facebook'))->value !="")
                {
                ?>                
                	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'facebook'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','<?PHP echo base_url();?>assets/images/facebook-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/facebook-icn.jpg" name="Image5" width="24" height="23" border="0" id="Image1" /></a>&nbsp;&nbsp;
                <?PHP 
				}
				?>    
                
				<?PHP 
                if($this->db_model->get_row('settings',array('key'=>'flicker'))->value !="")
                {
                ?>                
                	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'flicker'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','<?PHP echo base_url();?>assets/images/flickr-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/flickr-icn.jpg" name="Image6" width="24" height="23" border="0" id="Image2" /></a>&nbsp;&nbsp;
                <?PHP 
				}
				?>    
                
				<?PHP 
                if($this->db_model->get_row('settings',array('key'=>'twitter'))->value !="")
                {
                ?>
                	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'twitter'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','<?PHP echo base_url();?>assets/images/twitter-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/twitter-icn.jpg" name="Image7" width="23" height="23" border="0" id="Image3" /></a>&nbsp;&nbsp;
                <?PHP 
				}
				?>
                
				<?PHP 
                if($this->db_model->get_row('settings',array('key'=>'vimeo'))->value !="")
                {
                ?>                  
                	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'vimeo'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','<?PHP echo base_url();?>assets/images/vimeo-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/vimeo-icn.jpg" name="Image8" width="23" height="23" border="0" id="Image4" /></a>&nbsp;&nbsp;
                <?PHP 
				}
				?>
                    
				<?PHP 
                if($this->db_model->get_row('settings',array('key'=>'youtube'))->value !="")
                {
                ?>    
                    <a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'youtube'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','<?PHP echo base_url();?>assets/images/utube-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/utube-icn.jpg" name="Image16" width="23" height="23" border="0" id="Image16" /></a>
                <?PHP 
                }
                ?>   
           </div>
          </div>
          <!--social div end--> 
          
          <!--social div start-->
          <div class="middle-l-panel-ozrental-main">
            <div class="txt9 middle-l-panel-news-hdng">OZLENS <span class="txt10">RENTAL</span></div>
            <div class="txt18 middle-l-panel-news-hdng"><?PHP echo nl2br($this->db_model->get_row('settings',array('key'=>'address'))->value);?></div>
          </div>
          <!--social div end--> 
          
        </div>
        <!--r-pnel div end--> 
        
      </div>

      <!--middle div end--> 

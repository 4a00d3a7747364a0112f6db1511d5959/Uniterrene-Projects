<?PHP
/**
 *@var $this CI_Controller
 */
?>

<!--middle div start-->

<div class="middle-main"> <?PHP echo $this->load->view('web/includes/mobilecats');?>
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
  
  <!--inner div start-->
  <div class="inner-main">
    <div class="txt13 middle-l-f-items-hdng"><?PHP echo $page_title;?></div>
    <div class="middle-l-f-items-1">
    <?PHP 
	if($products)
	{
		$i=0;
		foreach($products as $product)
		{
			$price = $this->db_model->get_row('product_pricing',array('product_id'=>$product->id,'rental_period'=>$product->default_rental_days));

            //$p_images = $this->db_model->get_rows('product_photos',array('product_id'=>$product->id));

            $p_images = $this->db_model->get_rows('product_photos',array('product_id'=>$product->id,'is_featured'=>'Yes'));
			
			if($p_images)
			{
				$caption = $p_images[0]->photo_caption;			
				$image =  base_url()."rent/get_image/".$p_images[0]->photo_image."/175/175";
			}
			else
			{
				$caption = $product->product_title;
				$image = base_url()."assets/images/image-notFound.jpg";
			}
			
		?>
		  <div class="product-listingDiv">
			<div class="f-items-grey-bg3" style="border-bottom: 1px solid #f0f0f0;">
			  <div class="middle-l-f-items-img">
                  <a href="<?PHP echo $this->product_model->gen_product_url($product->id);?>">
                  <img alt="<?PHP echo $caption;?>" src="<?PHP echo $image;?>" border="0" />
                  </a>
              </div>
			</div>
			<div class="f-items-grdnt-bg3">

			  <div class="txt15 inner-pro-3"><?PHP echo $product->product_title;?><br />
				<span class="txt10">$<?PHP echo $price->rental_price;?></span><br />
				for <?PHP echo $product->default_rental_days;?> Days </div>

                <div class="txt15 inner-pro-3">
				<div class="txt15 inner-pro-4 test">
				  <input type="button" class="pro-bt1" value="Available Today" onclick="window.location='<?PHP echo $this->product_model->gen_product_url($product->id);?>'"/>
				</div>
                
                  <div  id="rating_sum<?PHP echo $i;?>" class="middle-l-f-items-img-txt test rt"></div>

                <script type="text/javascript">
                    ratingJQ('#rating_sum<?PHP echo $i;?>').raty({
                        half: true,
                        start: (<?PHP echo $this->db_model->get_sum_where('reviews','rating',array('product_id'=>$product->id,'status'=>'Approved'));?> + 0) / <?PHP echo $this->db_model->get_counts_where('reviews',array('product_id'=>$product->id))?>,
                        readOnly:true,
                        path: "<?PHP echo base_url();?>assets/rating/img/",
                        starHalf:   'star-half.png',
                        starOff:    'star-off.png',
                        starOn:     'star-on.png',
                        size: 40
                    });
                </script>

			  </div>

              
			</div>
		  </div>
            
              <?PHP
		  $i++;
		}
	  }
	  else
	  {
	  ?>
     	<span class="txt16">Sorry, We couldn't find what you're looking for!</span>
      <?PHP 
	  }
	  ?>
      <!-- end of "product-listingDiv" -->
      
     
      
      <!-- end of "product-listingDiv" -->
      
      
      
     
      
    </div>
    <!-- end of "middle-l-f-items-1" --> 
    
  </div>
  <!--inner items div end--> 
  
</div>

<!--middle div end--> 

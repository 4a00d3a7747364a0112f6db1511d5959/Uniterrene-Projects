<?PHP
/**
 *@var $this CI_Controller
 */
?>
<style>
	body { font-size: 65.2% }
	label { display: inline-block; width: 8em; }
	label.error { color: red; margin-left: 0.5em; width: 20em; }
</style>

<link rel="stylesheet" href="<?PHP echo base_url();?>assets/tabs/jquery-ui.css">

<link rel="stylesheet" href="<?PHP echo base_url();?>assets/lightbox/css/lightbox.css" type="text/css" media="screen" />
	
<script src="<?PHP echo base_url();?>assets/lightbox/js/prototype.js" type="text/javascript"></script>
<script src="<?PHP echo base_url();?>assets/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="<?PHP echo base_url();?>assets/lightbox/js/lightbox.js" type="text/javascript"></script>

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
    <div class="inner-pro-d-main">
      <div class="inner-pro-d-main-lp-1">
        <div class="txt13 inner-pro-d-main-lp-2">

            <?PHP echo $product->product_title;?>

            <div id="rating_sum"></div>

            <script type="text/javascript">
                ratingJQ('#rating_sum').raty({
                    half: true,
                    start: (<?PHP echo $this->db_model->get_sum_where('reviews','rating',array('product_id'=>$product->id,'status'=>'Approved'));?> + 0) / <?PHP echo $this->db_model->get_counts_where('reviews',array('product_id'=>$product->id))?>,
                    readOnly:true,
                    path: "<?PHP echo base_url();?>assets/rating/img/",
                    starHalf:   'star-half.png',
                    starOff:    'star-off.png',
                    starOn:     'star-on.png',
                    size: 20
                });
            </script>
        </div>
        <div class="inner-pro-d-main-lp-3">
        <?php if($is_available =="1"){ ?>
        <?php if($product->quantity == "0"){ ?>
          <input type="button" class="pro-bt1" value="Not Available"/>
          <?php } else {?>
          <input type="button" onclick="document.getElementById('cartFrm').submit();" class="pro-bt1" value="Available Today"/>
          <?php }?>
          
          <?php } else {?>
          <input type="button" class="pro-bt1" value="Not Available"/>&nbsp;<input style="background: -moz-linear-gradient(center top , orange 5%, orange 100%) repeat scroll 0 0 orange; width:150px; font-weight:bold; cursor:pointer;" onclick="window.location='<?php echo base_url().'rent/inquiry/'.$product->id; ?>'" type="button" class="pro-bt1" value="Available <?php echo date('M d, Y',strtotime($this->helper_model->check_availability($product->id))); ?>"/>
          
          
          <?php }?>
        </div>
        
        <?PHP 
		//$product->quantity
		$p_images = $this->db_model->get_rows('product_photos',array('product_id'=>$product->id));
			
		if($p_images){
			$caption = $p_images[0]->photo_caption;
			$image =  base_url()."rent/get_image/".$p_images[0]->photo_image."/300/300";			
		}else{
			$caption = $product->product_title;
			$image = base_url()."assets/images/image-notFound-BIG.jpg";
		}
		?>
        
        <div class="inner-pro-d-main-lp-4"><img src="<?PHP echo $image;?>" /></div>
        
        <?PHP if($p_images){?>        
            <div style="padding-top:25px; width:100%; clear:both;">
            <?PHP foreach($p_images as $img){?>
            <a href="<?PHP echo base_url();?>uploads/images/product/<?PHP echo $img->photo_image;?>" rel="lightbox [roadtrip]"><img src="<?PHP echo base_url()."rent/get_image/".$img->photo_image."/100/100";?>"/></a>
            <?PHP }?>       
            </div>
        <?PHP }?>
        
      </div>
      <div class="detail-right">
        <div class="inner-pro-d-rp-main">
          <div class="rent-now-red-bg inner-pro-d-rp-1">
            <div class="txt2-b inner-pro-d-rp-2">Rent me for</div>
          </div>
          <div class="rent-now-white-bg inner-pro-d-rp-3">
            <div class="txt12 inner-pro-d-rp-4"><span class="txt14-a"><?PHP echo $this->config->item('currency_symbol');?><?PHP echo $this->db_model->get_row('product_pricing',array('product_id'=>$product->id,'rental_period'=>$product->default_rental_days))->rental_price;?></span><br />
              for <?PHP echo $product->default_rental_days;?> days<br />
              <br />
              <?PHP echo $this->config->item('currency_symbol');?><?PHP echo $product->postage_amount;?> Round trip shipping

              <!--<div class="inner-pro-d-rp-5">
                <div class="txt11 inner-pro-d-rp-6">Round trip to</div>
                <div class="inner-pro-d-rp-7">
                  <input name="textfield" type="text" class="zip-fld" id="textfield" value="Zip" />
                </div>
              </div>-->


                <div class="rentme-bt-01">
                	<?php if($product->quantity != 0){?>
                    
                    <?php if($is_available =="1"){ ?>
                    	<input type="button" onclick="document.getElementById('cartFrm').submit();" value="Rent Me Now" class="c-here-bt1"/>
                        <?php } else {?>
  <input type="button" value="Not Available" class="c-here-bt1"/>                      
                        <?php }?>
                        
                    <?php }else{?>
                    	<input type="button" onclick="javascript:;" value="Out Of Stock" class="c-here-bt1"/>
                    <?php }?>
                </div>

            </div>
          </div>
        </div>
        <!--<div class="inner-pro-d-by-used-bt">
          <input type="button" class="by-used-bt1" value="By Used"/>
        </div>-->
        <div class="inner-pro-d-by-social">
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'facebook'))->value !="")
		{
		?>
        	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'facebook'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','<?PHP echo base_url();?>assets/images/facebook-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/facebook-icn.jpg" name="Image5" width="24" height="23" border="0" id="Image5" /></a>&nbsp;&nbsp;
        <?PHP 
		}
		?>
        
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'googleplus'))->value !="")
		{
		?>   
			<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'googleplus'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image50','','<?PHP echo base_url();?>assets/images/googleplus-iconHover.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/googleplus-icon.jpg" name="Image50" width="24" height="23" border="0" id="Image50" /></a>&nbsp;&nbsp;
		<?PHP 
		}
		?>
                
		<?PHP 
		if($this->db_model->get_row('settings',array('key'=>'flicker'))->value !="")
		{
		?>
        	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'flicker'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','<?PHP echo base_url();?>assets/images/flickr-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/flickr-icn.jpg" name="Image6" width="24" height="23" border="0" id="Image6" /></a>&nbsp;&nbsp;
        <?PHP 
		}
		?>
        
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'twitter'))->value !="")
		{
		?>
        	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'twitter'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','<?PHP echo base_url();?>assets/images/twitter-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/twitter-icn.jpg" name="Image7" width="23" height="23" border="0" id="Image7" /></a>&nbsp;&nbsp;
        <?PHP 
		}
		?>
        
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'vimeo'))->value !="")
		{
		?>
        	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'vimeo'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','<?PHP echo base_url();?>assets/images/vimeo-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/vimeo-icn.jpg" name="Image8" width="23" height="23" border="0" id="Image8" /></a>&nbsp;&nbsp;
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

      <div class="inner-pro-d-by-social">
          <!-- AddThis Button BEGIN -->
          <a class="addthis_button" href="https://www.addthis.com/bookmark.php?v=300&amp;pubid=navjav"><img src="https://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=navjav"></script>
          <!-- AddThis Button END -->
      </div>
      </div>
      <!-- end of "detail-right" --> 
      
    </div>
    <div class="clearF"></div>
    <div class="tabs-div">
    
    <?PHP 
	$specs = $this->db_model->get_rows('product_specs',array('product_id'=>$product->id));
	$www = $this->db_model->get_rows('product_www',array('product_id'=>$product->id));
	$ynit = $this->db_model->get_rows('product_you_need_it',array('product_id'=>$product->id));
	$resources = $this->db_model->get_rows('product_resources',array('product_id'=>$product->id));
	$pricing = $this->db_model->get_rows('product_pricing',array('product_id'=>$product->id));
	?>
      
        <div id="tabs">
          <ul>
          	
			<?PHP if($product->overview!=""){?>
            <li><a href="#overview">Overview</a></li>
            <?PHP }?>
            
            <?PHP if($specs){?>
            <li><a href="#specs">Specifications</a></li>
            <?PHP }?>
            
			<?PHP if($product->includes!=""){?>
            <li><a href="#includes">Includes</a></li>
            <?PHP }?>
            
            <?PHP if($www){?>
            <li><a href="#workwell">Works Well With</a></li>
            <?PHP }?>
            
             <?PHP if($ynit){?>
            <li><a href="#ynit">In Case You Need it</a></li>
            <?PHP }?>
            
             <?PHP if($resources){?>
            <li><a href="#resources">Resources</a></li>
            <?PHP }?>
            
            <?PHP if($pricing){?>
            <li><a href="#pricing">Pricing</a></li>
            <?PHP }?>

           <li><a href="#review">Add Your Review</a></li>

          </ul>
          
          <div class="tab-pane" id="overview">           
           <?PHP echo $product->overview;?>
          </div>

          <?PHP if($specs){?>
          <div class="tab-pane" id="specs">
              <style>
                  .specs_table tr td
                  {
                      border-bottom:1px solid #ccc;
                      height: 25px;
                  }
              </style>
              <table style="width: 70%;" border="0" cellspacing="0" cellpadding="0" class="specs_table">
                  <?PHP
                  foreach($specs as $spec)
                  {
                      ?>
                      <tr>
                          <td style="width: 45%;"><strong><?PHP echo $spec->specs_caption;?></strong></td>
                          <td style="width: 55%;"><?PHP echo $spec->specs_text;?></td>
                      </tr>
                  <?PHP
                  }
                  ?>
              </table>
          </div>
          <?PHP }?>
          
          <?PHP if($product->includes!=""){?>
          
          <div class="tab-pane" id="includes">
           <?PHP echo $product->includes;?>
          </div>
          
          <?PHP }?>
          
          
          <?PHP if($www){?>
          <div class="tab-pane" id="workwell">
          	<ul>
            <?PHP foreach($www as $row){?>
            	<li>
				<?PHP 
					if($row->www_caption !=""){echo $row->www_caption."&nbsp;";}
					$product_data = $this->db_model->get_row('products',array('id'=>$row->www_r_product_id));
					echo '<a href="'.base_url().'rent/detail/'.$product_data->slug.'">'.$product_data->product_title.'</a>';
				?>
                </li>
            <?PHP }?>    
            </ul>            
          </div>
          <?PHP }?>
          
          <?PHP if($ynit){?>
          <div class="tab-pane" id="ynit">
          	<ul>
            <?PHP foreach($ynit as $row){?>
            	<li>
				<?PHP 
					if($row->yni_caption !=""){echo $row->yni_caption."&nbsp;";}
					$product_data = $this->db_model->get_row('products',array('id'=>$row->yni_r_product_id));
					echo '<a href="'.base_url().'rent/detail/'.$product_data->slug.'">'.$product_data->product_title.'</a>';
				?>
                </li>
            <?PHP }?>    
            </ul>            
          </div>
          <?PHP }?>
          
          <?PHP if($resources){?>
          <div class="tab-pane" id="resources">
          	<ul>
            <?PHP foreach($resources as $row){?>
            	<li>
				<?PHP 
					//if($row->pr_caption !=""){echo $row->pr_caption."&nbsp;";}					
					//echo '<a href="'.base_url().'uploads/resources/'.$row->pr_file_name.'">'.$row->pr_file_name.'</a>';
					echo '<a href="'.base_url().'uploads/resources/'.$row->pr_file_name.'">'.$row->pr_caption.'</a>';
				?>
                </li>
            <?PHP }?>    
            </ul>            
          </div>
          <?PHP }?>
          
          <?PHP if($pricing){?>
          <div class="tab-pane" id="pricing">
          <style>
		  .pricing_table tr td
		  {
			  border-bottom:1px solid #ccc;
			  height: 25px;
		  }
		  </style>
          	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pricing_table">
              <tr>
              	<td colspan="5" align="left">
                	Rental periods are available from 1 to 90 days. The shopping cart will automatically update as you adjust the length of your rental. Our most common rental periods are shown below and include the optional recommended damage waiver.<br /><br />
                </td>
              </tr> 
              
              <tr>
                <td><strong>Rental Period</strong></td>
                <td><strong>Waiver Price</strong></td>
                <td><strong>Rental Price</strong></td>
                <td><strong>Total Price</strong></td>
                <td><strong>Approximate Day Rate</strong></td>
              </tr>
              <?PHP 
			  foreach($pricing as $price)
			  {
				  ?>
                  <tr>
                    <td><?PHP echo $price->rental_period;?> days</td>
                    <td><?PHP echo $this->config->item('currency_symbol');?> <?PHP echo $price->waiver_price;?></td>
                    <td><?PHP echo $this->config->item('currency_symbol');?> <?PHP echo $price->rental_price;?></td>
                    <td><?PHP echo $this->config->item('currency_symbol');?> <?PHP echo $price->waiver_price + $price->rental_price;?></td>
                    <td><?PHP echo $this->config->item('currency_symbol');?> <?PHP echo round(($price->waiver_price + $price->rental_price)/$price->rental_period);?></td>
                  </tr>
                  <?PHP
			  }
			  ?>
            </table>
          </div>
          <?PHP }?>

          <div id="review">
             <?PHP echo $this->load->view('web/includes/reviews');?>
          </div>

        </div>
        
     
    </div>
    <!-- end of "tabs-div" --> 
    
  </div>
  <!--inner items div end--> 
  
</div>

<!--middle div end--> 

<!--Tabs Include-->
<script src="<?PHP echo base_url();?>assets/tabs/jquery-1.10.2.js"></script>
<script src="<?PHP echo base_url();?>assets/tabs/jquery-ui.js"></script>
<script>
$jqtabs =  $.noConflict();
$jqtabs("#tabs").tabs();
</script>
<!--Tabs Include End-->

<form name="cartFrm" id="cartFrm" method="post" action="<?PHP echo base_url();?>cart">

<input type="hidden" name="product_id" id="product_id" value="<?PHP echo $product->id;?>"/>

<input type="hidden" name="r_qty" id="r_qty" value="1"/>
<input type="hidden" name="r_price" id="r_price" value="<?PHP echo $this->db_model->get_row('product_pricing',array('product_id'=>$product->id,'rental_period'=>$product->default_rental_days))->rental_price;?>"/>

<input type="hidden" name="w_qty" id="w_qty" value="0"/>
<input type="hidden" name="w_price" id="w_price" value="<?PHP echo $this->db_model->get_row('product_pricing',array('product_id'=>$product->id,'rental_period'=>$product->default_rental_days))->waiver_price;?>"/>

<input type="hidden" name="start_date" id="start_date" value="<?PHP echo date('Y-m-d');?>"/>
<input type="hidden" name="return_date" id="return_date" value="<?PHP echo date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$product->default_rental_days.' days'));?>"/>
<input type="hidden" name="rental_days" id="rental_days" value="<?PHP echo $product->default_rental_days;?>"/>
<input type="hidden" name="member_id" id="member_id" value="<?PHP echo $this->session->userdata('member_data') ? $this->session->userdata('member_data')->id : 0 ;?>"/>

</form>

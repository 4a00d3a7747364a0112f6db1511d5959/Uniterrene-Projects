<?PHP
/**
 *@var $this CI_Controller
 */
?>

<script>
$bt(document).ready(function() {
	$bt('#a1_up').bubbletip($('#tip1_up'));
});
</script>

    <div id="tip1_up" style="display:none;" class="txt15">When purchased, the damage waiver limits your liability in the case of damage on covered equipment.<br/> By selecting this option you agree that you have read and understood the <a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'149'))->slug;?>" class="txt12" style="text-decoration: underline;" target="_blank"><?PHP echo $this->db_model->get_row('content',array('id'=>'149'))->title;?></a></div>


      <?PHP 
		$cart_items = $this->db_model->get_rows('cart',array('sess_id'=>$this->session->userdata('session_id')));
		if($cart_items)
		{
		?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" class="txt6">&nbsp;</td>
                    <td align="right" class="txt6"><div class="signin-bt-01" style="float:right;">
                 <input type="button" onclick="window.location='<?PHP echo base_url();?>cart'" class="c-here-bt1" value="Edit Cart"/>
               </div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">
                    <style>
					.cartTd
					{
						border-top: 1px solid #ccc;
						border-bottom: 1px solid #ccc;
						height:30px;
					}
					</style>
                    
                    <table width="95%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td  class="cartTd" align="left"><strong>Product</strong></td>
                          <td  class="cartTd" align="left">&nbsp;</td>
                          <td  class="cartTd" align="left"><strong>Rental Period</strong></td>
                          <td  class="cartTd" align="left"><strong>Start Date</strong></td>
                          <td  class="cartTd" align="left"><strong>Return Date</strong></td>
                          <td  class="cartTd"><strong>Qty</strong></td>
                          <td  class="cartTd"><strong>Price</strong></td>
                          </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>
                        
                        
                       <?PHP 
					   $sub_total = 0;
                       $shipping_charges = 0;
                       $s_charges = array();
					    $cart_item_ids = '';		
					   foreach($cart_items as $ci)
					   {
						   //echo $ci->product_id;
						  	$cart_item_ids = $cart_item_ids.$ci->product_id.","  ; 
							//echo $cart_item_ids;
						   $sub_total += ($ci->r_qty * $ci->r_price) + ($ci->w_qty * $ci->w_price);
						   
						   $p_data = $this->db_model->get_row('products',array('id'=>$ci->product_id));

                           $s_charges[]= $p_data->postage_amount;
						   
						   $p_images = $this->db_model->get_rows('product_photos',array('product_id'=>$p_data->id,'is_featured'=>'Yes'));
			
							if($p_images)
							{
								$caption = $p_images[0]->photo_caption;			
								$image =  base_url()."rent/get_image/".$p_images[0]->photo_image."/1000/43";
							}
							else
							{
								$caption = $p_data->product_title;
								$image = base_url()."assets/images/image-notFound.jpg";
							} 
					   ?>                        
                        <tr>
                          <td  align="left"><img src="<?PHP echo $image;?>" height="43" /></td>
                          <td  align="left"><a class="txt16" href="<?PHP echo $this->product_model->gen_product_url($ci->product_id);?>"><?PHP echo $p_data->product_title;?></a><br/></td>
                          <td  align="left"><?PHP echo $ci->rental_days;?> days</td>
                          <td  align="left"><?PHP echo date('d/m/Y',strtotime($ci->start_date));?></td>
                          <td  align="left"><?PHP echo date('d/m/Y',strtotime($ci->return_date));?></td>
                          <td><?PHP echo $ci->r_qty;?></td>
                          <td width="14%"><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($ci->r_qty * $ci->r_price);?></td>
                          </tr>
                        <tr>
                          <td  align="left">&nbsp;</td>
                          <td  align="left" class="txt16"><img src="<?PHP echo base_url();?>assets/images/icon_child-44b4f6e2e33de1d8a96f496bc4678a75.png" width="11" height="11" /> <span class="txt15">Waiver Charges&nbsp;<a class="txt16" id="a1_up" href="#">(?)</a></span></td>
                          <td  align="left" class="txt16">&nbsp;</td>
                          <td  align="left" class="txt16">&nbsp;</td>
                          <td  align="left" class="txt16">&nbsp;</td>
                          <td><?PHP echo $ci->w_qty;?></td>
                          <td><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($ci->w_qty * $ci->w_price);?></td>
                          </tr>
                         <tr>
                         <td style="height:5px;" colspan="99"></td>
                        </tr>
                        <tr>
                         <td style="border-top:1px solid #ccc; height:25px;" colspan="99"></td>
                        </tr>
                        <?PHP 
					   }

                       $max_shipping_charges = max ($s_charges);

                       if($max_shipping_charges == 0){
                           $shipping_charges = 0;
                       }else if($max_shipping_charges <> 0 && sizeof($cart_items)>1){
                           $shipping_charges =  $max_shipping_charges + $this->db_model->get_row('settings',array('key'=>'es_charges'))->value;
                       }else{
                           $shipping_charges =  $max_shipping_charges;
                       }
					   ?>
                        
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><table width="95%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td width="28%" align="left">&nbsp;</td>
                          <td width="35%">&nbsp;</td>
                          <td width="18%" align="right" class="txt19">Subtotal:&nbsp;&nbsp;</td>
                          <td width="19%" class="txt19"><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($sub_total);?></td>
                        </tr>
<tr>
                            <td align="left">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right" class="txt19">Discount :&nbsp;&nbsp;</td>
                            <td class="txt19"><?PHP echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->format_currency($this->session->userdata('discount_amount'));?></td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right" class="txt19">Shipping :&nbsp;&nbsp;</td>
                            <td class="txt19"><?PHP echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->format_currency($shipping_charges);//echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->calculate_shipping($this->helper_model->calculate_gst($shipping_charges),$shipping_charges);?></td>
                        </tr>
                        
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td align="right" class="txt19">Total :&nbsp;&nbsp;</td>
                          <td class="txt19"><?PHP echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->calculate_total($sub_total,$shipping_charges);?></td>
                        </tr>
                        <tr>
                            <td align="right" class="txt19" colspan="3">Order total includes GST :&nbsp;&nbsp;</td>
                            <td class="txt19">
								<?php 
									//echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->calculate_gst($sub_total);
									echo $this->config->item('currency_symbol')."&nbsp;".number_format($this->helper_model->calculate_total($sub_total,$shipping_charges)/11,2);
									
								?>
                                
                            </td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <!--<tr>
              <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" class="txt6">Where</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#e5e5e5" height="1"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td width="28%" align="left">Shipping round trip to </td>
                          <td width="42%" align="left" class="txt16"><table width="35" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="91" align="right"><input type="text" class="fld-03" /></td>
                              </tr>
                            </table></td>
                          <td width="11%">&nbsp;</td>
                          <td width="14%">$124.00</td>
                          <td width="5%">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="8%" align="left">Via</td>
                          <td align="left" class="txt16"><select name="select" id="select" class="fld-01">
                            </select></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td align="left"> LensRentals™ HD would save $25.00 on the shipping of this order. </td>
                          <td width="19%" class="txt19"><div class="sndmsg-bt-01">
                              <input type="button" class="c-here-bt1" value="LEARN MORE"/>
                            </div></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#e5e5e5" height="1"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td width="28%" align="left">&nbsp;</td>
                          <td width="24%">&nbsp;</td>
                          <td width="29%" class="txt19">Total <em>(excluding tax) :</em></td>
                          <td width="19%" class="txt19">$149.00</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>-->
            <tr>
                <td style="border-top: 1px dotted #ccc;">
                    <h2>More gear you'll love...</h2>

                    <style>
                        .product-listingDiv
                        {
                            margin-left: 0%;
                            margin-right: 1%;
                            width: 32%;
                        }
                    </style>

                    <div class="middle-l-f-items-1">

                        <?PHP
						$cart_item_ids = substr($cart_item_ids,0, (strlen($cart_item_ids)-1));
						 $i=0;
                        //foreach($cart_items as $ci)
                       // {
							//echo $cart_item_ids;
							
                            $related_products_query = "SELECT DISTINCT yni_r_product_id FROM {PRE}product_you_need_it WHERE 	
							product_id IN (".$cart_item_ids.") AND yni_r_product_id NOT IN (".$cart_item_ids.")";
                           // $related_products_query = "SELECT DISTINCT product_id FROM {PRE}product_you_need_it";
                            $products = $this->db_model->sql($related_products_query);

                                    if($products)
                                    {
                                       
                                        foreach($products as $prduct)
                                        {
                                            $product = $this->db_model->get_row('products',array('id'=>$prduct->yni_r_product_id));
											//echo $product->id;
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
                                                        <div class="txt15 inner-pro-4">
                                                        
                                                        <?php 
														
														$pqty = $this->helper_model->check_qty($product->id); 
														
														$is_available ="1";
														
														if($pqty >= $product->quantity)
														{
															$is_available = "0";
														}
														
														?>
                                                        <?php if($is_available =="1")
														{ ?>
                                                         <?php if($product->quantity == "0"){ ?>
                                                         <input type="button" class="pro-bt1" value="Not Available"/>
                                                         <?php } else {
														 ?>
                                                            <input type="button" class="pro-bt1" value="Available Today" onclick="window.location='<?PHP echo $this->product_model->gen_product_url($product->id);?>'"/>
                                                            <?php } ?>
                                                            
                                                            <?php } else { ?>
                                                            <input type="button" class="pro-bt1" value="Not Available"/>
                                                            <?php }?>
                                                            
                                                        </div>
                                                    </div>

                                                    <div  id="rating_sum<?PHP echo $i;?>" class="middle-l-f-items-img-txt"></div>

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

                                            <?PHP
                                            $i++;
                                        }
                                    }

                                    ?>
                                    <!-- end of "product-listingDiv" -->



                                    <!-- end of "product-listingDiv" -->
                        <?PHP
						
                        //}
                        ?>
                    </div>
                </td>
            </tr>
            </table>
          <?PHP 
		  }
		  ?>
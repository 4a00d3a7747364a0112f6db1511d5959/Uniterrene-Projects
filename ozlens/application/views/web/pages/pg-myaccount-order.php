
<div class="middle-main"> 

  

  <!--inner div start-->

  <div class="inner-main-01">
         <div class="txt13 middle-l-f-items-hdng">
         <h1 class="txt13">ORDER <span class="txt14">DETAIL</span></h1>
         <hr size="1" color="#c40f19" />
         </div>
         
      <?PHP 
	  $order = $this->db_model->get_row('orders',array('id'=>$order_id));
		$cart_items = $this->db_model->get_rows('order_items',array('order_id'=>$order_id));
		
		
		
		if($cart_items)
		{
		?>
        
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="txt15">
            <tr>
              <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" align="left" >&nbsp;</td>
                    <td width="50%" align="right" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="95%" border="0" align="center" cellpadding="0">
                      <tr>
                        <td>Order # <?php echo $order->id; ?></td>
                        <td align="right"><?php echo date('M d, Y',strtotime($order->order_date)); ?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="50%"><strong>Billing Address:</strong></td>
                        <td><strong>Shipping Adderss:</strong></td>
                      </tr>
                      <tr>
                        <td><?php echo $order->b_full_name; ?><br />
                          <?php if($order->b_company_name !="") {?>
						  <?php echo $order->b_company_name; ?><br />
                          <?php }?>
                          <?php echo $order->b_apartment_no ; ?> <?php echo $order->b_street_address; ?><br />
                          <?php echo $order->b_city; ?>, <?php echo $order->b_state; ?>, <?php echo $order->b_zip; ?><br />
                          Phone: <?php echo $order->b_phone_no; ?>&nbsp;
                          Mobile: <?php echo $order->b_mob_no; ?></td>
                          
                        <td><?php echo $order->s_full_name; ?><br />
                          <?php if($order->s_company_name !="") {?>
						  <?php echo $order->s_company_name; ?><br />
                          <?php }?>
                          <?php echo $order->s_apartment_no ; ?> <?php echo $order->s_street_address; ?>
                          <br /><?php echo $order->s_city; ?>, <?php echo $order->s_state; ?>, <?php echo $order->s_zip; ?><br />
                            Phone: <?php echo $order->s_phone_no; ?>&nbsp;
                            Mobile: <?php echo $order->s_mob_no; ?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
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
					   
					    function checkid($arr,$id)
					   {
						   $rsp = false;
						   
							for($i = 0; $i<sizeof($arr); $i++)
							{
								if($arr[$i] == $id)
								{
									$rsp = true;		
								}
							}
							
							return $rsp;
					   }
					   
					   $sub_total = 0;
                       $shipping_charges = 0;
                       $s_charges = array();
					   
					   $cart_products = array();
					   
					   foreach($cart_items as $ci)
					   {						  
					   
					   if(checkid($cart_products,$ci->product_id))
						   {
								continue;
						   }
						   
						   $cart_products[] = $ci->product_id;
					   
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
                          <td  align="left"><a class="txt16" href="<?PHP echo $this->product_model->gen_product_url($ci->product_id);?>"><?PHP echo $p_data->product_title;?></a><br/>
                          <?php if($p_data->includes != '') echo "<br/><strong>Includes:</strong><br/>".$p_data->includes;?></td>
                          <td  align="left"><?PHP echo $ci->rental_days;?> days</td>
                          <td  align="left"><?PHP echo date('d/m/Y',strtotime($ci->start_date));?></td>
                          <td  align="left"><?PHP echo date('d/m/Y',strtotime($ci->return_date));?></td>
                          <td><?PHP echo $ci->r_qty;?></td>
                          <td width="14%"><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($ci->r_qty * $ci->r_price);?></td>
                          </tr>
                        <tr>
                          <td  align="left">&nbsp;</td>
                          <td  align="left" class="txt16"><img src="<?PHP echo base_url();?>assets/images/icon_child-44b4f6e2e33de1d8a96f496bc4678a75.png" width="11" height="11" /> <span class="txt15">Waiver Charges</span></td>
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

                       if($max_shipping_charges == 0)
                       {
                           $shipping_charges = 0;
                       }
                       else if($max_shipping_charges <> 0 && sizeof($cart_items)>1)
                       {
                           $shipping_charges =  $max_shipping_charges + $this->db_model->get_row('settings',array('key'=>'es_charges'))->value;
                       }
                       else
                       {
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
                          <td align="right" class="txt19">GST :&nbsp;&nbsp;</td>
                          <td class="txt19"><?PHP echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->format_currency($order->order_gst);?></td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right" class="txt19">Shipping :&nbsp;&nbsp;</td>
                            <td class="txt19"><?PHP echo $this->config->item('currency_symbol');?>&nbsp<?PHP echo $this->helper_model->format_currency($order->order_shipping_charges);?></td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="right" class="txt19">Discount :&nbsp;&nbsp;</td>
                            <td class="txt19"><?PHP echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->format_currency($order->order_discount);?></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td>&nbsp;</td>
                          <td align="right" class="txt19">Total :&nbsp;&nbsp;</td>
                          <td class="txt19"><?PHP echo $this->config->item('currency_symbol')."&nbsp;".$this->helper_model->format_currency($order->order_amount);?></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>
          
           
       </table>
       <div class="txt13 middle-l-f-items-hdng">
       <br />
         <hr size="1" color="#c40f19" />
         </div>
          <?PHP 
		  }
		  ?>
     
    </div>
        </div>
    
    
    
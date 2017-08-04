<?PHP

/**

 *@var $this CI_Controller

 */
 
 /*echo $this->session->userdata('member_data')->greenid_verified;
echo '<pre>';
print_r($this->session->all_userdata());*/

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
					   
?>

<!--middle div start-->



<div class="middle-main"> 

  

  <!--inner div start-->

  <div class="inner-main-01">

    <div class="txt13 middle-l-f-items-hdng">YOUR <span class="txt14">ACCOUNT</span></div>

    <div class="middle-l-f-items-1 txt15"> 

      <style>
      	
		.editinfo-bt-01 { width:100%;}
		.inner-main-03 { width:100%;}
      </style>

      <!--account div start-->

      <div class="inner-main-02">

        <div class="inner-main-01">

          <div class="inner-main-02 txt19"><?PHP echo $member_data->first_name." ".$member_data->last_name;?></div>

          <div class="inner-main-03">

            <div class="editinfo-bt-01">
					<table cellpadding="3" cellspacing="1" border="0">
                    	<tr>
                        	<td><input type="button" class="c-here-bt1" value="EDIT INFO" onclick="window.location='<?PHP echo base_url();?>member/edit'"/></td>
                            <td><input type="button" class="c-here-bt1" value="Addresses" onclick="window.location='<?PHP echo base_url();?>address'"/></td>
                            <?php if($member_data->greenid_verified == 'Inactive'){ ?>
                            <td> To rent gear you need to verify your ID.</td>
                            <td>
                                 <form action="<?=$this->config->item('green_id_post_data_url')?>" method="post" target="_blank">  
                                    <input name="token" value="<?=$green_id_post_data['token']?>" type="hidden" />
                                    <input name="userId" value="OZL<?=$green_id_post_data['userId']?>" type="hidden" />
                                    <input name="customerId" value="<?=$green_id_post_data['customerId']?>" type="hidden"/>
                                    <input name="returnUrl" value="<?=$green_id_post_data['returnUrl']?>" type="hidden" />
                                    <input name="cancelUrl" value="<?=$green_id_post_data['cancelUrl']?>" type="hidden" />
                                    <input name="timeoutUrl" value="<?=$green_id_post_data['timeoutUrl']?>" type="hidden" />
                                    <input name="exceptionUrl" value="<?=$green_id_post_data['exceptionUrl']?>" type="hidden" />
                                    <input type="submit" value="Proceed" class="c-here-bt1" />  
                                </form>
                                
                            </td>
                            <?php } ?>	
                        </tr>
                    </table>
            </div>

          </div>

        </div>

        <div class="middle-l-f-items-1 txt16"><strong>Email Address</strong></div>

        <div class="inner-main-01"><?PHP echo $member_data->email;?></div>

        <div class="middle-l-f-items-1 txt14-a">Order History</div>

        

        <style>

			.orderTable tr td

			{

				height:30px;

				border-bottom: 1px solid #ccc;

			}

		</style>

        
<br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="orderTable">

          <tr>

            <td><strong>Order #</strong></td>

            <td><strong>Status</strong></td>

            <td><strong>Date Placed</strong></td>

            <td><strong>Items</strong></td>            

            <td><strong>Total</strong></td>

          </tr>

          

          <?PHP 

		$orders = $this->db_model->get_rows('orders',array('member_id'=>$this->session->userdata('member_data')->id));
		
		if($orders)

		{

		

		foreach($orders as $order)

		{

		?>

        

        <tr>

            <td><a href="<?php echo base_url("member/order/".$order->id); ?>">(<?PHP echo $order->id;?>)</a></td>

            <td><?PHP echo $order->order_status;?></td>

            <td><?PHP echo $this->helper_model->format_date($order->order_date,false);?></td>

            <td>

            <?PHP 

			$order_items = $this->db_model->get_rows('order_items',array('order_id'=>$order->id));				

			

					   $cart_products = array();
			foreach($order_items as $item)

			{
				
				 if(checkid($cart_products,$item->product_id))
						   {
								continue;
						   }
						   
						   $cart_products[] = $item->product_id;

				echo '<a href="'.$this->product_model->gen_product_url($item->product_id).'" class="txt12">'.$this->db_model->get_row('products',array('id'=>$item->product_id))->product_title.'</a><br/>';

			}

			?>

            </td>            

            <td><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($order->order_amount);?></td>

          </tr>

        <?PHP 

		}

		}

		else

		{

		?>

        <tr>

        	<td colspan="100%">

            No order has been placed by you yet.

            </td>

        </tr> 

        <?PHP 

		}

		?>

        </table>

        

        

        

        

      </div>

      <!--account div end--> 

      

      <!--newsletter div start-->

      <div class="inner-main-05">

        <div class="inner-nwsltr-01"> <span class="txt1"><strong>Stay up to date!!</strong><br />

          Subscribe to the Oz Lens Rental news and!

            you'll never miss out on updates about!

            new gear, deals and other exciting stuff!!



            </span><br />

          <br />

          <input  <?PHP if($member_data->news_letter == 'Yes'){echo 'checked="checked"';}?> type="checkbox" name="news_letter" id="news_letter" value="Yes" disabled="disabled" />

          <span class="txt1">Subscribed to OzLensRental.com</span></div>

      </div>

      <div class="inner-main-03 txt14-a">
      <br />
      Gift Certificates
      <br />
      </div>



        <?PHP

        //$gift_cards = $this->db_model->get_rows('gift_cards',array('member_id'=>$this->session->userdata('member_data')->id));
		$gift_cards = $this->db_model->sql('select * from {PRE}gift_cards where member_id = '.$this->session->userdata('member_data')->id.' OR redeemed_by = '.$this->session->userdata('member_data')->id.' order by purchase_date desc');

        if($gift_cards)

        {

            ?>

            <div class="inner-main-03">
<br />
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="orderTable">

                    <tr>

                        <td><strong>Amount</strong></td>

                        <td><strong>Code</strong></td>

                        <td><strong>Date</strong></td>

                        <td><strong>Redeemed</strong></td>

                    </tr>

                    <?PHP foreach($gift_cards as $gc){?>

                    <tr>

                        <td><?PHP echo $this->config->item('currency_symbol')." ".$gc->amount;?></td>

                        <td><?PHP echo $gc->code;?></td>

                        <td><?PHP echo $this->helper_model->format_date($gc->purchase_date);?></td>

                        <td><?PHP echo $gc->redeemed;?></td>

                    </tr>

                    <?PHP }?>

                </table>

            </div>

            <?PHP

        }

        ?>

      <!--newsletter div end--> 

      

    </div>

    

    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 

    

  </div>

  <!--inner items div end--> 

  

</div>

<!--middle div end-->
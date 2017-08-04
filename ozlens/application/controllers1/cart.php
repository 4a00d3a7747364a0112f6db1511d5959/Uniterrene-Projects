<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cart extends CI_Controller {

    private $error = "";



    public function __construct(){
        parent::__construct();
        // Your own constructor code
    }



    public function index(){

		if($this->input->post())
		{	
			$vals = $this->input->post();
			//var_dump($vals); exit;
			$vals['sess_id'] = $this->session->userdata('session_id');
			$p_data = $this->db_model->get_row('cart',array('product_id'=>$vals['product_id'],'sess_id'=>$vals['sess_id']));
		
			if($p_data)
			{
				$this->db_model->update_row('cart',array('r_qty'=>$p_data->r_qty+1),array('product_id'=>$vals['product_id'],'sess_id'=>$vals['sess_id']));
				$this->session->set_flashdata('response', '<div class="success-box">Product has been added to your cart.</div>');
				redirect(base_url().'cart','location');
			}else{	
				// if cart alreay has a product, enter its start and return dates as the new produnct's start n return dates.
				$first_prod = $this->db_model->get_row('cart',array('sess_id'=>$vals['sess_id']));
				if($first_prod)
				{$vals['start_date'] = $first_prod->start_date; 
				$vals['return_date'] = $first_prod->return_date; 
				$vals['rental_days'] = $first_prod->rental_days;}
				/////		
				$this->db_model->insert_row('cart',$vals);
				$this->session->set_flashdata('response', '<div class="success-box">Product has been added to your cart.</div>');
				redirect(base_url().'cart','location');		
			}
		}
		//echo $this->session->userdata('session_id');
        $data['page_view'] = "web/pages/pg-cart";
		$this->load->view('web/shared/master',$data);	
    }

	

	public function update(){

		if($this->input->post()){

			$vals = $this->input->post();

			if(isset($vals['gift_card_code']) && $vals['gift_card_code']!="")
			{

                $res = $this->db_model->get_row('gift_cards',array('code'=>$vals['gift_card_code'],'redeemed'=>'No'));

                if($res)
				{
                    $this->session->set_userdata('discount_amount',$res->amount);
					$this->session->set_userdata('gift_card_code',$vals['gift_card_code']);					
                    $this->session->set_flashdata('response', '<div class="success-box">Your cart has been updated.</div>');
                }
				else
				{
                    $this->session->set_flashdata('response', '<div class="error-box">We are sorry the code you have entered is not valid.</div>');
                }
				
            }
            
			if(isset($vals['del_item_id']))
			{

				foreach($vals['del_item_id'] as $item_id)
				{
					$this->db_model->delete_row('cart',array('id'=>$item_id,'sess_id'=>$this->session->userdata('session_id')));
				}
                $this->session->set_flashdata('response', '<div class="success-box">Your cart has been updated.</div>');
			}
			else
			{
				for($i=0;$i<sizeof($vals['item_id']);$i++)
				{
					
					if($vals['r_qty'][$i]==0)
					{
						$this->db_model->delete_row('cart',array('id'=>$vals['item_id'][$i],'sess_id'=>$this->session->userdata('session_id')));
					}
					else
					{
						
						$prices = $this->db_model->get_row('product_pricing',array('rental_period'=>$vals['rental_days'][$i],'product_id'=>$vals['product_id'][$i]));							

						if($prices)
						{
							$this->db_model->update_row('cart',array('r_price'=>$prices->rental_price,'w_price'=>$prices->waiver_price),array('id'=>$vals['item_id'][$i]));
						}
						else
						{
							
							$query = "SELECT * from ozl_product_pricing where rental_period <= ".$vals['rental_days'][$i]." and product_id = ".$vals['product_id'][$i]." order by rental_period desc limit 0,1";
							
							$pricing = $this->db_model->sql($query);
							
							
							
							
							$diff = $vals['rental_days'][$i] - $pricing[0]->rental_period;
							$product_data = $this->db_model->get_row('products',array('id'=>$vals['product_id'][$i]));
							
							/*$rent_price = $pricing[0]->rental_price + ($diff * $product_data->r_price_per_day);
							$waiver_price = $pricing[0]->waiver_price + ($diff * $product_data->w_price_per_day);*/
							
							$rent_price = $pricing[0]->rental_price + ($diff * $product_data->w_price_per_day);
							$waiver_price = $pricing[0]->waiver_price + ($diff * $product_data->r_price_per_day);
							
							
							$this->db_model->update_row('cart',array('r_price'=>$rent_price,'w_price'=>$waiver_price),array('id'=>$vals['item_id'][$i]));							
						}
						
						$dta['rental_days'] = $vals['rental_days'][$i];
						
						$tmp1 =  explode("/",$vals['start_date'][$i]);
						$tmp2 = explode("/",$vals['return_date'][$i]);
						
						
						$dta['start_date'] = $tmp1[2]."-".$tmp1[1]."-".$tmp1[0];
						$dta['return_date'] = $tmp2[2]."-".$tmp2[1]."-".$tmp2[0];
						
						//var_dump($dta); exit;
						
						$dta['r_qty'] = $vals['r_qty'][$i];
						$dta['w_qty'] = $vals['w_qty'][$i];
						$where['id'] = $vals['item_id'][$i];			
						
						
						
						
						$this->db_model->update_row('cart',$dta,$where);
					}
				}
                $this->session->set_flashdata('response', '<div class="success-box">Your cart has been updated.</div>');
			 }
			redirect(base_url().'cart','location');
		}else{
			redirect(base_url().'cart','location');		
		}
	}	

	

	public function get_image($img_name="",$width="",$height="")

    {

        if($img_name == "" || $width <=0 || $height <=0)

        {

            exit;

        }

        else

        {

            $img_name = str_replace("%20"," ",$img_name);

            $img = "./uploads/images/product/".$img_name."";

            $this->image_moo->load($img)->resize($width,$height)->save_dynamic();

            if ($this->image_moo->errors) print $this->image_moo->display_errors();

        }

    }



    public function checkout(){

		$this->member_model->is_login();
		isGreenIDVerified();

		

		if($this->input->post())

		{

			$vals = $this->input->post();



            $this->save_billing_address($vals);



            unset($vals['saved_billing_address']);



			$vals['member_id'] = $this->session->userdata('member_data')->id;
			$vals['order_date'] = date('Y-m-d h:i:s');

			$ret_id = $this->db_model->insert_row_retid('orders',$vals);

			if($ret_id>0)

			{

				$this->session->set_userdata('order_id',$ret_id);

				redirect(base_url().'cart/shipping','location');

			}

		}

		

		$data['page_view'] = "web/pages/pg-billing";

		$this->load->view('web/shared/master',$data);

	}



    private function save_billing_address($vals)

    {

        $data = array(

            'full_name' => $vals['b_full_name'],

            'company_name' => $vals['b_company_name'],

            'street_address'=>$vals['b_street_address'],

            'apartment_no' => $vals['b_apartment_no'],

            'city' => $vals['b_city'],

            'state' => $vals['b_state'],

            'zip' => $vals['b_zip'],

            'phone_no' => $vals['b_phone_no'],

            'mobile_no' => $vals['b_mob_no'],

            'address_type' => 'billing',

            'member_id' => $this->session->userdata('member_data')->id

        );





        $res = $this->db_model->get_row('addresses',$data);



        if(!$res)

        {

            $data['last_modified'] = date('Y-m-d h:i:s');

            $this->db_model->insert_row_retid('addresses',$data);

        }

    }

	

	public function shipping()

	{

		$this->member_model->is_login();	

		

		if($this->input->post())

		{

			$vals = $this->input->post();



            $this->save_shipping_address($vals);



            unset($vals['same_as_billing'],$vals['saved_shipping_address']);

			

			if($this->db_model->update_row('orders',$vals,array('id'=>$this->session->userdata('order_id'))))

			{

				redirect(base_url().'cart/payment','location');

			}

		}



        $data['order_data'] = $this->db_model->get_row('orders',array('id'=>$this->session->userdata('order_id')));

		$data['page_view'] = "web/pages/pg-shipping";

		$this->load->view('web/shared/master',$data);

		

	}



    private function save_shipping_address($vals)

    {

        $data = array(

            'full_name' => $vals['s_full_name'],

            'company_name' => $vals['s_company_name'],

            'street_address'=>$vals['s_street_address'],

            'apartment_no' => $vals['s_apartment_no'],

            'city' => $vals['s_city'],

            'state' => $vals['s_state'],

            'zip' => $vals['s_zip'],

            'phone_no' => $vals['s_phone_no'],

            'mobile_no' => $vals['s_mob_no'],

            'address_type' => 'shipping',

            'member_id' => $this->session->userdata('member_data')->id

        );





        $res = $this->db_model->get_row('addresses',$data);



        if(!$res)

        {

            $data['last_modified'] = date('Y-m-d h:i:s');

            $this->db_model->insert_row_retid('addresses',$data);

        }

    }

	

	public function payment(){
		
		$this->member_model->is_login();
		
		isGreenIDVerified();	

		if($this->input->post())
		{
		
			if($this->input->post('poption') == 'sp')
			{
		
			 $this->form_validation->set_rules('name_on_card', 'Name', 'required');
			 $this->form_validation->set_rules('car_no', 'Card Number', 'required|numeric|min_length[16]');
			 $this->form_validation->set_rules('exp_month', 'Expiry Month', 'required');
			 $this->form_validation->set_rules('exp_year', 'Expiry Year', 'required');
			 $this->form_validation->set_rules('cvv2', 'Cvv2', 'required|numeric|min_length[3]');

			 if (!$this->form_validation->run() == FALSE)
			 {

					//$cart_data = $this->db_model->get_rows('cart',array('member_id'=>$this->session->userdata('member_data')->id));
					
					$cart_data = $this->db_model->get_rows('cart',array('member_id'=>$this->session->userdata('member_data')->id,'sess_id'=>$this->session->userdata('session_id')));
					
					$order_sub_total = 0;
					$shipping_charges =0;
					$s_charges = array();

					foreach($cart_data as $cd)
					{

						$p_data = $this->db_model->get_row('products',array('id'=>$cd->product_id));
						$s_charges[]= $p_data->postage_amount;
						unset($cd->sess_id,$cd->id);
						$cd->order_id = $this->session->userdata('order_id');					
						$this->db_model->insert_row('order_items',$cd);
						$order_sub_total += ($cd->r_qty*$cd->r_price) + ($cd->w_qty*$cd->w_price);

					}
					
					if(empty($s_charges))
					{
						$max_shipping_charges = 0;
					}
					else
					{
						$max_shipping_charges = max($s_charges);
					}

					if($max_shipping_charges == 0)
					{
						$shipping_charges = 0;
					}
					else if($max_shipping_charges <> 0 && sizeof($cart_data)>1)
					{
						$shipping_charges =  $max_shipping_charges + $this->db_model->get_row('settings',array('key'=>'es_charges'))->value;
					}
					else
					{
						$shipping_charges =  $max_shipping_charges;
					}

		
					$total1 = $this->helper_model->calculate_total($order_sub_total,$shipping_charges);
					$gst = $total1/11;
					
					//$gst = $this->helper_model->calculate_gst($order_sub_total);
					
					$vals['special_instructions'] =  $this->input->post('special_instructions');
					
					$vals['order_date'] = @date('Y-m-d h:i:s');
					
					$vals['order_sub_total'] = $order_sub_total;
										
					$vals['order_gst'] = $gst;
					
					//-> disabed on 11/11/2014 ...
					//$vals['order_shipping_charges'] = ($shipping_charges + $this->helper_model->calculate_gst($shipping_charges));
					$vals['order_shipping_charges'] = $shipping_charges;
					
					//$vals['order_amount'] = ($order_sub_total + $gst + $shipping_charges) - $this->session->userdata('discount_amount');
					
					$vals['order_amount'] = ($order_sub_total + $shipping_charges) - $this->session->userdata('discount_amount');
					
					$vals['order_status'] = "Paid";
					
					$vals['order_discount'] = $this->helper_model->format_currency($this->session->userdata('discount_amount'));
					
					
					/*---------------Secure Pay------------------------------------*/
					
					include("application/libraries/SecurePay.php");
					
					$sp = new SecurePay($this->config->item('secure_pay_merchant_id'),$this->config->item('secure_pay_transaction_password'),$this->config->item('secure_pay_test_mode'));
					
				
					if ($sp->TestConnection()) 
					{

						$sp->Cc = $this->input->post('car_no');
						
						$sp->ExpiryDate = $this->input->post('exp_month').'/'.$this->input->post('exp_year');
						
						$sp->ChargeAmount = number_format($vals['order_amount'],2);
						
						$sp->ChargeCurrency = 'AUD';
						
						$sp->Cvv = $this->input->post('cvv2');
						
						$sp->OrderId = 'OZL-'.$this->session->userdata('order_id').'-'.$this->session->userdata('member_data')->id.'-'.rand(1000,100000);

							if ($sp->Valid()) 
							{
								
									

								$response = $sp->Process();
								//var_dump($sp);

								if ($response == SECUREPAY_STATUS_APPROVED) 
								{
									
					
									
									$sp_data = array('member_id'=>$this->session->userdata('member_data')->id,
													 'order_id'=>$this->session->userdata('order_id'),
													 'sp_order_id'=>$sp->OrderId,
													 'status' => 'processed',
													 'date_processed' => @date('Y-m-d H:i:s'));

									$this->db_model->insert_record('secure_pay',$sp_data);

									$order_id = $this->db_model->update_row('orders',$vals,array('id'=>$this->session->userdata('order_id')));

									if($order_id > 0)
									{
										$order_id = $this->session->userdata('order_id');
										$this->db_model->delete_row('cart',array('member_id'=>$this->session->userdata('member_data')->id));
										
										
										$this->sendNotification($order_id);
										$this->sendConfirmation($order_id);
										
										if($this->session->userdata('discount_amount') != null)
					{
						$this->db_model->update_row('gift_cards',array('redeemed'=>'Yes','redeemed_by'=>$this->session->userdata('member_data')->id,'redeem_date'=>date('Y-m-d h:i:s')),array('code'=>$this->session->userdata('gift_card_code')));
						
						$this->session->unset_userdata('gift_card_code');
						$this->session->unset_userdata('discount_amount');
					}
										

										
										redirect(base_url().'cart/thankyou/'.$order_id,'location');
									   // redirect(base_url().'cart/thankyou','location');
									}
								} 
								else 
								{
									$this->session->set_userdata('messages', '<li>Unable to process transaction, please try again later.</li>');
								}
							}
							else
							{
								$this->session->set_userdata('messages', '<li>Invalid card details.</li>');
							}
					}
					else
					{
							$this->session->set_userdata('messages', '<li>Unable to connect to payment gateway.</li>');
					}
					
					/*-----------------------Secure Pay-----------------------*/
			   }
			}
			//-> END Pay with secure pay.
			
			else
			{
				   
				  /* echo '<pre>';
				   print_r($this->session->userdata('paypal_product'));*/
				   
				    $cart_data = $this->db_model->get_rows('cart',array('member_id'=>$this->session->userdata('member_data')->id,'sess_id'=>$this->session->userdata('session_id')));
					//var_dump($cart_data);
					$order_sub_total = 0;
					$shipping_charges =0;
					$s_charges = array();
					
					$product_data = array();
					
						foreach($cart_data as $cd){
							$p_data = $this->db_model->get_row('products',array('id'=>$cd->product_id));
							///echo $p_data->postage_amount;
							$s_charges[]= $p_data->postage_amount;
							unset($cd->sess_id,$cd->id);
							$cd->order_id = $this->session->userdata('order_id');		
							
							$order_items_check = $this->db_model->getResultArray('order_items',array('order_id'=>$this->session->userdata('order_id'),'product_id'=>$p_data->id));
							if(empty($order_items_check)){
								$this->db_model->insert_row('order_items',$cd);
							}
							
							
							
							$order_sub_total += ($cd->r_qty*$cd->r_price) + ($cd->w_qty*$cd->w_price);
							
							$product_data[] = array('order_id'=>$cd->order_id,
													'member_id'=>$this->session->userdata('member_data')->id,
													'product_id'=>$cd->product_id,
													'product_name' => $p_data->product_title,
													'product_code' => $p_data->stock_no,
													'price' => ($cd->r_qty*$cd->r_price) + ($cd->w_qty*$cd->w_price),
													'quantity' => 1
													
													);
					}
					//var_dump($s_charges);
					if(empty($s_charges))$max_shipping_charges = 0;
					else $max_shipping_charges = max($s_charges);

					if($max_shipping_charges == 0){
						$shipping_charges = 0;
					}else if($max_shipping_charges <> 0 && sizeof($cart_data)>1){
						$shipping_charges =  $max_shipping_charges + $this->db_model->get_row('settings',array('key'=>'es_charges'))->value;
					}else{
						$shipping_charges =  $max_shipping_charges;
					}
					
					$total1 = $this->helper_model->calculate_total($order_sub_total,$shipping_charges);
					$gst = $total1/11;
					//$gst = $this->helper_model->calculate_gst($order_sub_total);
					
					$vals['special_instructions'] =  $this->input->post('special_instructions');
					$vals['order_date'] = @date('Y-m-d h:i:s');
					$vals['order_sub_total'] = $order_sub_total - $this->session->userdata('discount_amount');
					$vals['order_gst'] = $gst;
					$vals['order_shipping_charges'] = ($shipping_charges + $this->helper_model->calculate_gst($shipping_charges));
					$vals['order_amount'] = ($order_sub_total + $shipping_charges) - $this->session->userdata('discount_amount');
					$vals['order_status'] = "Pending";
					$vals['order_discount'] = $this->helper_model->format_currency($this->session->userdata('discount_amount'));
					
					$TotalTaxAmount 	= 0.00;  //Sum of tax for all items in this order. 
					$HandalingCost 		= 0.00;  //Handling cost for this order.
					$InsuranceCost 		= 0.00;  //shipping insurance cost for this order.
					$ShippinDiscount 	= 0.00; //Shipping discount for this order. Specify this as negative number.
					$ShippinCost 		= $shipping_charges; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
					$ItemTotalPrice 	= $vals['order_sub_total'];
					
					$paypal_data ='';
					$keyval = 0;
					foreach($product_data as $key => $products){
					
						$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($products['product_name']);
						$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($products['product_code']);
						$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($products['price']);		
						$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($products['quantity']);
						
						$paypal_product['items'][] = array('itm_name'=>$products['product_name'],
											'itm_price'=>$products['price'],
											'itm_code'=>$products['product_code'], 
											'itm_qty'=>$products['quantity']
											);
						$keyval = $key;
					}
					
					
					if($this->session->userdata('discount_amount') != null)
					{
						$keyval = $keyval + 1;
						
						$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$keyval.'='.urlencode("GIFT CARD");
						$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$keyval.'='.urlencode("GIFTCARD");
						$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$keyval.'=-'.$this->session->userdata('discount_amount');		
						$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$keyval.'=1';
						
						$paypal_product['items'][] = array('itm_name'=>"GIFT CARD",
											'itm_price'=>"-".$this->session->userdata('discount_amount'),
											'itm_code'=>"GIFTCARD", 
											'itm_qty'=>"1"
											);	
					}

					
					$GrandTotal = $vals['order_amount'];
					//var_dump($vals['order_amount']); exit;
					
					$paypal_product['assets'] = array('tax_total'=>$gst, 
									'handaling_cost'=>$HandalingCost, 
									'insurance_cost'=>$InsuranceCost,
									'shippin_discount'=>$ShippinDiscount,
									'shippin_cost'=>$ShippinCost,
									'grand_total'=>$GrandTotal);
									
					$this->session->set_userdata('paypal_product', $paypal_product);
					
					$paypal_product_amounts =  array('TotalTaxAmount'=>$gst, 
									'HandalingCost'=>$HandalingCost, 
									'InsuranceCost'=>$InsuranceCost,
									'ShippinDiscount'=>$ShippinDiscount,
									'ShippinCost'=>$ShippinCost,
									'GrandTotal'=>$GrandTotal,
									'ItemTotalPrice' => $vals['order_sub_total'],
									'order_sub_total' => $vals['order_sub_total'],
									'order_id'=>$cd->order_id,
									'order_discount' =>$vals['order_discount'],
									'order_sub_total' => $order_sub_total
									);
									
					$this->session->set_userdata('paypal_product_amounts', $paypal_product_amounts);
					
					
					$padata = 	'&METHOD=SetExpressCheckout'.
								'&RETURNURL='.urlencode($this->config->item('PayPalReturnURL')).
								'&CANCELURL='.urlencode($this->config->item('PayPalCancelURL')).
								'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
								$paypal_data.				
								'&NOSHIPPING=0'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
								'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
								'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
								'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($ShippinCost).
								'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($HandalingCost).
								'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($ShippinDiscount).
								'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($InsuranceCost).
								'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
								'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($this->config->item('PayPalCurrencyCode')).
								'&LOCALECODE=GB'. //PayPal pages to match the language on your website.
								'&LOGOIMG='.$this->config->item('PayPalLOGOIMG').''. //site logo
								'&CARTBORDERCOLOR=E3E3E3'. //border color of cart
								'&ALLOWNOTE=1';
					
					include('application/libraries/PayPal.php');
					$paypal= new PayPal();
					$paypal->PayPalApiUsername = $this->config->item('PayPalApiUsername');
					$paypal->PayPalApiPassword = $this->config->item('PayPalApiPassword');
					$paypal->PayPalApiSignature = $this->config->item('PayPalApiSignature');
					$paypal->PayPalMode = $this->config->item('PayPalMode');
					
					$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata);
					
					/*echo '<pre>';
					print_r($httpParsedResponseAr);
					exit;*/
					//var_dump(explode("&",$padata));exit;
					//Respond according to message we receive from Paypal
					if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
							//Redirect user to PayPal store with Token received.
							
							$paypalmode = ($this->config->item('PayPalMode')=='sandbox') ? '.sandbox' : '';
							$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
							
							$this->db_model->addRecord('paypal_token',array('order_id'=>$cd->order_id,
																			'member_id'=>$this->session->userdata('member_data')->id,
																			'token'=>$httpParsedResponseAr["TOKEN"],
																			'paypal_product' => json_encode($paypal_product),
																			'date_created' => @date('Y-m-d H:i:s')
																			));
										
							
							redirect($paypalurl);
					}
					else{
						//$this->session->set_userdata('messages', '<li>Unable to process your request, please try again later.</li>');
						$this->session->set_userdata('messages', '<li>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</li>');
					}
						
			}
		}

		$data['page'] = 'payment';
		$data['page_view'] = "web/pages/pg-payment";
		$this->load->view('web/shared/master',$data);

	}

	
	public function paymentstatus(){
		
		
		
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
			if(isset($_GET["token"]) && isset($_GET["PayerID"]))
			{
				
				
				
				//we will be using these two variables to execute the "DoExpressCheckoutPayment"
				//Note: we haven't received any payment yet.
				
				$token = $_GET["token"];
				$payer_id = $_GET["PayerID"];
				
				//get session variables
				$paypal_product = $this->session->userdata('paypal_product');
				$paypal_data = '';
			
				foreach($paypal_product['items'] as $key=>$p_item)
				{		
					$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($p_item['itm_qty']);
					$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($p_item['itm_price']);
					$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($p_item['itm_name']);
					$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($p_item['itm_code']);
				}
				
				$paypal_product_amounts = $this->session->userdata('paypal_product_amounts');
				
				
				
				$order_id = $paypal_product_amounts['order_id'];
				$TotalTaxAmount = 0.00;
				$padata = 	'&TOKEN='.urlencode($token).
							'&PAYERID='.urlencode($payer_id).
							'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
							$paypal_data.
							'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($paypal_product_amounts['ItemTotalPrice']).
							'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
							'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($paypal_product_amounts['ShippinCost']).
							'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($paypal_product_amounts['HandalingCost']).
							'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($paypal_product_amounts['ShippinDiscount']).
							'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($paypal_product_amounts['InsuranceCost']).
							'&PAYMENTREQUEST_0_AMT='.urlencode($paypal_product_amounts['GrandTotal']).
							'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($this->config->item('PayPalCurrencyCode'));
			
				//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
				
					include("application/libraries/PayPal.php");
					$paypal= new PayPal();
					$paypal->PayPalApiUsername = $this->config->item('PayPalApiUsername');
					$paypal->PayPalApiPassword = $this->config->item('PayPalApiPassword');
					$paypal->PayPalApiSignature = $this->config->item('PayPalApiSignature');
					$paypal->PayPalMode = $this->config->item('PayPalMode');
					
					$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata);
					
					/*echo '<pre>';
				print_r($httpParsedResponseAr);
				exit;	*/	
					
			//Check if everything went ok..
				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
				{
													
					
						
						$transaction_id = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
						//echo '<h2>Success</h2>';
						//echo 'Your Transaction ID : '.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
						
							/*
							//Sometimes Payment are kept pending even when transaction is complete. 
							//hence we need to notify user about it and ask him manually approve the transiction
							*/
							
							if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]){
								
								$this->session->set_userdata('messages', '<li>Transaction Completed.</li>');
								//$this->db_model->updateRecord('orders',array('order_status'=>'Paid'),array('id'=>$order_id));
								
								$this->db_model->updateRecord('orders',array('order_status'=>'Paid',
																			 'order_date'=>@date('Y-m-d H:i:s'),
																			 'order_amount'=>$paypal_product_amounts['GrandTotal'],
																			 'order_gst'=>$paypal_product_amounts['TotalTaxAmount'],
																			 'order_shipping_charges'=>$paypal_product_amounts['ShippinCost'],
																			 'paypal_transaction_id' => $transaction_id,
																			 'order_discount' => $paypal_product_amounts['order_discount'],
																			 'order_sub_total' => $paypal_product_amounts['order_sub_total']
																			 ),array('id'=>$order_id));
								
								
								
								//echo '<div style="color:green">Payment Received! Your product will be sent to you very soon!</div>';
							
							}
							elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]){
								$this->session->set_flashdata('response', '<div class="success-box">Transaction Complete, but payment is still pending! You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>');
								$this->db_model->updateRecord('orders',array('order_status'=>'Pending'),array('id'=>$order_id));
								/*echo '<div style="color:red">Transaction Complete, but payment is still pending! '.
								'You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';*/
							}
			
							// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
							// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
							$padata = 	'&TOKEN='.urlencode($token);
							$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata);
			
							if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
								
								$this->db_model->updateRecord('orders',array('order_status'=>'Paid',
																			 'order_date'=>@date('Y-m-d H:i:s'),
																			 'order_amount'=>$paypal_product_amounts['GrandTotal'],
																			 'order_gst'=>$paypal_product_amounts['TotalTaxAmount'],
																			 'order_shipping_charges'=>$paypal_product_amounts['ShippinCost'],
																			 'paypal_transaction_id' => $transaction_id,
																			 'order_discount' => $paypal_product_amounts['order_discount'],
																			 'order_sub_total' => $paypal_product_amounts['order_sub_total']
																			 ),array('id'=>$order_id));
								//exit($transaction_id);
								$this->db_model->addRecord('paypal_transactions',array('order_id'=>$order_id,'member_id'=>$this->session->userdata('member_data')->id,
														  'buyerName' => urldecode($httpParsedResponseAr["FIRSTNAME"]).' '.urldecode($httpParsedResponseAr["LASTNAME"]),
														  'buyerEmail' => urldecode($httpParsedResponseAr["EMAIL"]),
														  'amount_paid' =>$paypal_product_amounts['GrandTotal'],
														  'paypal_transaction_id' => $transaction_id,
														  'date_added' => @date('Y-m-d H:i:s')));
								
								
								$this->db_model->deleteRecord('cart',array('member_id'=>$this->session->userdata('member_data')->id));
								$this->session->set_flashdata('response', '<div class="success-box">Transaction Completed.</div>');
								
								
								$this->sendNotification($order_id);
					
								$this->sendConfirmation($order_id);
					
								if($this->session->userdata('discount_amount') != null)
								{
									$this->db_model->update_row('gift_cards',array('redeemed'=>'Yes','redeemed_by'=>$this->session->userdata('member_data')->id,'redeem_date'=>date('Y-m-d h:i:s')),array('code'=>$this->session->userdata('gift_card_code')));
									
									$this->session->unset_userdata('gift_card_code');
									$this->session->unset_userdata('discount_amount');
								}
								
								/*echo '<pre>';
								print_r($httpParsedResponseAr);
								echo '</pre>';*/
							} else  {
								$this->session->set_flashdata('response', '<div class="error-box">'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>');
								
								/*echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
								echo '<pre>';
								print_r($httpParsedResponseAr);
								echo '</pre>';*/
							}
							
							redirect(base_url().'cart/thankyou/'.$order_id,'location');
				}else{
						/*$this->session->set_flashdata('response', '<div class="success-box">Your password has been sent to your email address.</div>');
 					    $this->session->set_flashdata('response', '<div class="error-box">The email address you have entered doesn\'t match with our records.</div>');*/
						$this->session->set_flashdata('response', '<div class="error-box">'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>');
						/*echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
						echo '<pre>';
						print_r($httpParsedResponseAr);
						echo '</pre>';*/
				}
			}
			
			redirect(base_url().'member/myaccount');
	}
	

	public function thankyou($order_id="")

	{

        $page_data = $this->db_model->get_row('content',array('id'=>153));

		$data['page_view'] = "web/pages/pg-thankyou";

        $data['page_title'] = $page_data->title;

        $data['page_data'] = $page_data;

		$data['order_id'] = $order_id;

		$this->load->view('web/shared/master',$data);

	}

			

	function sendNotification($order_id){

			

			//$to = $this->db_model->get_admin_email();
			
			$to = 'orders@ozlensrental.com.au';

			$email_temp = $this->db_model->get_row('email_templates',array('id'=>5));

			$subject = $email_temp->subject;

			$body = $email_temp->content;

			$link = '<a href="'.base_url().'/administration/orders/edit/'.$order_id.'">'.base_url().'/administration/orders/edit/'.$order_id.'</a>';

			$body = str_replace('{name}',$this->session->userdata('member_data')->first_name." ".$this->session->userdata('member_data')->last_name,$body);

			$body = str_replace('{link}',$link,$body);

			

			$this->load->library('email');

		

			$config['mailtype'] = "html";	

			$config['charset'] = 'iso-8859-1';	

			$this->email->initialize($config);
			
			$sender_email = 'hire@ozlensrental.com.au';
			$sender_name = 'OzLensRental.com.au';
			$this->email->from($sender_email, $sender_name);

			$this->email->to($to);

			$this->email->subject($subject);

			$this->email->message($body);

			$this->email->send();	

			//echo $this->email->print_debugger();

			

			//$this->notificationmodel->send_email_no_template("",$to,$subject,$body);

	}

	

	function sendConfirmation($order_id){

			$order = $this->db_model->get_row('orders',array('id'=>$order_id));
			
			$cart_items = $this->db_model->get_rows('order_items',array('order_id'=>$order_id));
			
			$member = $this->db_model->get_row('members',array('id'=>$order->member_id));
			//echo $this->db->last_query();
			
			//var_dump($member);
			$to = $member->email;
			//$to = "saira@xindesigns.com";
			/// build order items table
			
			$itm_tbl = '';
			$itm_tbl .='<table width="95%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td  class="cartTd" align="left"><strong>Product</strong></td>
                         
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
                            </tr>';
							
							
							 $sub_total = 0;
                       $shipping_charges = 0;
                       $s_charges = array();
					   foreach($cart_items as $ci)
					   {						   
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
							
							
							//echo $image;
						// html
						
						$itm_tbl .='<tr>
                          
                          <td  align="left"><a class="txt16" href="'.$this->product_model->gen_product_url($ci->product_id).'">'.$p_data->product_title.'</a><br/></td>
                          <td  align="left">'.$ci->rental_days.' days</td>
                          <td  align="left">'.date('d-m-Y',strtotime($ci->start_date)).'</td>
                          <td  align="left">'. date('d-m-Y',strtotime($ci->return_date)).'</td>
                          <td>'.$ci->r_qty.'</td>
                          <td width="14%">'.$this->config->item('currency_symbol').'&nbsp;'. $this->helper_model->format_currency($ci->r_qty * $ci->r_price).'</td>
                          </tr>
                        <tr>
                    
                          <td  align="left" class="txt16"><span class="txt15">Waiver Charges</span></td>
                          <td  align="left" class="txt16">&nbsp;</td>
                          <td  align="left" class="txt16">&nbsp;</td>
                          <td  align="left" class="txt16">&nbsp;</td>
                          <td>'.$ci->w_qty.'</td>
                          <td>'.$this->config->item('currency_symbol').'&nbsp;'.$this->helper_model->format_currency($ci->w_qty * $ci->w_price).'</td>
                          </tr>
                         <tr>
                         <td style="height:5px;" colspan="99"></td>
                        </tr>
                        <tr>
                         <td style="border-top:1px solid #ccc; height:25px;" colspan="99"></td>
                        </tr>';
						
						// html	
							
							
						}
 					$itm_tbl .='</table>';
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
					   
					  
					   		   
			// end order items

			$email_temp = $this->db_model->get_row('email_templates',array('id'=>7));

			$subject = $email_temp->subject;

			$body = $email_temp->content;
			
			$bill_add = null;
			$ship_add = null;
			
			if($order->b_company_name != "")
			{
			
			$bill_add = $order->b_full_name.'<br/>'.$order->b_company_name.'<br/>'.
						$order->b_apartment_no.' '.$order->b_street_address.'<br />'.
						$order->b_city.', '.$order->b_state.', '.$order->b_zip.'<br/>Phone: '.
						$order->b_phone_no.' Mobile: '.$order->b_mob_no.'<br/>';
			}
			else
			{
				$bill_add = $order->b_full_name.'<br/>'.
						$order->b_apartment_no.' '.$order->b_street_address.'<br />'.
						$order->b_city.', '.$order->b_state.', '.$order->b_zip.'<br/>Phone: '.
						$order->b_phone_no.' Mobile: '.$order->b_mob_no.'<br/>';	
			}
						
			if($order->s_company_name !="")
			{
			$ship_add = $order->s_full_name.'<br/>'.$order->s_company_name.'<br/>'.
						$order->s_apartment_no.' '.$order->s_street_address.'<br />'.
						$order->s_city.' '.$order->s_state.' '.$order->s_zip.'<br/>Phone: '.
						$order->s_phone_no.' Mobile: '.$order->s_mob_no.'<br/>';
			}
			else
			{
				$ship_add = $order->s_full_name.'<br/>'.
						$order->s_apartment_no.' '.$order->s_street_address.'<br />'.
						$order->s_city.' '.$order->s_state.' '.$order->s_zip.'<br/>Phone: '.
						$order->s_phone_no.' Mobile: '.$order->s_mob_no.'<br/>';	
			}


			$body = str_replace('{order_no}',$order->id,$body);

			$body = str_replace('{order_date}',date('M d, Y',strtotime($order->order_date)),$body);
			
			$body = str_replace('{billing_address}',$bill_add,$body);
			
			$body = str_replace('{shipping_address}',$ship_add,$body);
			
			$body = str_replace('{cart_items}',$itm_tbl,$body);
			
			$body = str_replace('{currency_symbol}',$this->config->item('currency_symbol'),$body);
			
			$body = str_replace('{subtotal}',$this->helper_model->format_currency($sub_total),$body);
			
			$body = str_replace('{gst}',$this->helper_model->calculate_gst($sub_total),$body);
			
			$body = str_replace('{shipping_charges}',$this->helper_model->format_currency($order->order_shipping_charges),$body);
			
			$body = str_replace('{discount_amount}',$this->helper_model->format_currency($this->session->userdata('discount_amount')),$body);
			
			$body = str_replace('{total}',$this->helper_model->calculate_total($sub_total,$shipping_charges),$body);
			
		

			$this->load->library('email');

		

			$config['mailtype'] = "html";	

			$config['charset'] = 'iso-8859-1';	

			$this->email->initialize($config);

			$sender_email = 'hire@ozlensrental.com.au';
			$sender_name = 'OzLensRental.com.au';
			$this->email->from($sender_email, $sender_name);

			$this->email->to($to);

			$this->email->subject($subject);

			$this->email->message($body);

			$this->email->send();	

			//echo $this->email->print_debugger();

			//echo "To: ".$to."<br/>From: ".$sender_name."<br/>From: ".$sender_email."<br/>Subject: ".$subject."<br/>Contents: ".$body;
			
			//echo $body; exit;

			//$this->notificationmodel->send_email_no_template("",$to,$subject,$body);

	}

	
	function update_item_date($itemid, $fieldname, $rentdays, $datetxt=''){
		
		echo $this->db_model->update_row('cart',array($fieldname=>$datetxt,'rental_days'=>$rentdays),array('id'=>$itemid));
		
	}
	
	function calc_dates()
	{
		$startdate = $_REQUEST['start_date'];
		$no_days = $_REQUEST['no_days'];
		
		$temp = explode("/",$startdate);
		
		$temp = $temp[2]."-".$temp[1]."-".$temp[0];
		
		$date1 = strtotime($temp);
		$date1 = strtotime("+".$no_days." day", $date1);
		echo date('d/m/Y', $date1);
		
	} 


}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
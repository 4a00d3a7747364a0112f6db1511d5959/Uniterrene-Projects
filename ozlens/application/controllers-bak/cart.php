<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cart extends CI_Controller {



    /**

     * Index Page for this controller.

     *

     * Maps to the following URL

     * 		http://example.com/index.php/welcome

     *	- or -

     * 		http://example.com/index.php/welcome/index

     *	- or -

     * Since this controller is set as the default controller in

     * config/routes.php, it's displayed at http://example.com/

     *

     * So any other public methods not prefixed with an underscore will

     * map to /index.php/welcome/<method_name>

     * @see http://codeigniter.com/user_guide/general/urls.html

     */

    private $error = "";



    public function __construct()

    {

        parent::__construct();

        // Your own constructor code

    }



    public function index()

    {

		if($this->input->post())

		{	

			

			$vals = $this->input->post();

			$vals['sess_id'] = $this->session->userdata('session_id');

			

			$p_data = $this->db_model->get_row('cart',array('product_id'=>$vals['product_id'],'sess_id'=>$vals['sess_id']));

			

			if($p_data)

			{

				$this->db_model->update_row('cart',array('r_qty'=>$p_data->r_qty+1),array('product_id'=>$vals['product_id'],'sess_id'=>$vals['sess_id']));

				$this->session->set_flashdata('response', '<div class="success-box">Product has been added to your cart.</div>');

				redirect(base_url().'cart','location');

			}

			else

			{				

				$this->db_model->insert_row('cart',$vals);

				$this->session->set_flashdata('response', '<div class="success-box">Product has been added to your cart.</div>');

				redirect(base_url().'cart','location');		

			}

		}

		

		

		//echo $this->session->userdata('session_id');

		

        $data['page_view'] = "web/pages/pg-cart";

		$this->load->view('web/shared/master',$data);	

    }

	

	public function update()

	{

		if($this->input->post())

		{

			$vals = $this->input->post();



            if(isset($vals['gift_card_code']) && $vals['gift_card_code']!="")

            {

                $res = $this->db_model->get_row('gift_cards',array('code'=>$vals['gift_card_code'],'redeemed'=>'No'));

                if($res)

                {

                    $this->session->set_userdata('discount_amount',$res->amount);

                    $this->db_model->update_row('gift_cards',array('redeemed'=>'Yes','redeemed_by'=>$this->session->userdata('member_data')->id,'redeem_date'=>date('Y-m-d h:i:s')),array('code'=>$vals['gift_card_code']));



                    $this->session->set_flashdata('response', '<div class="success-box">Your cart has been updated.</div>');

                }

                else

                {

                    $this->session->set_flashdata('response', '<div class="error-box">We are sorry the code you have entered is not valid.</div>');

                }

            }



			else if(isset($vals['del_item_id']))

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

							$query = "SELECT * from {PRE}product_pricing where rental_period <= ".$vals['rental_days'][$i]." and product_id = ".$vals['product_id'][$i]." order by rental_period desc limit 0,1";

							$pricing = $this->db_model->sql($query);

							

							

							$diff = $vals['rental_days'][$i] - $pricing[0]->rental_period;

							

							$product_data = $this->db_model->get_row('products',array('id'=>$vals['product_id'][$i]));

							

							 $rent_price = $pricing[0]->rental_price + ($diff * $product_data->r_price_per_day);

							 $waiver_price = $pricing[0]->waiver_price + ($diff * $product_data->w_price_per_day);

														

							 $this->db_model->update_row('cart',array('r_price'=>$rent_price,'w_price'=>$waiver_price),array('id'=>$vals['item_id'][$i]));							

						}

						

						$dta['rental_days'] = $vals['rental_days'][$i];

						$dta['start_date'] = date('Y-m-d',strtotime($vals['start_date'][$i]));

						$dta['return_date'] = date('Y-m-d',strtotime($vals['return_date'][$i]));

						$dta['r_qty'] = $vals['r_qty'][$i];

						$dta['w_qty'] = $vals['w_qty'][$i];

						

						$where['id'] = $vals['item_id'][$i];					

						

						$this->db_model->update_row('cart',$dta,$where);

					}

				}

                $this->session->set_flashdata('response', '<div class="success-box">Your cart has been updated.</div>');

			 }

			



			redirect(base_url().'cart','location');

			

		}

		else

		{

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

	

	function testSecurePay(){

		

		include("application/libraries/SecurePay.php");

		$sp = new SecurePay('ABC0001','abc123',TRUE);

		

		if (!$sp->TestConnection()) {

			return FALSE;

		}

		

		$sp->Cc = '4444333322221111';

		$sp->ExpiryDate = '10/20';

		$sp->ChargeAmount = 1000;

		$sp->ChargeCurrency = 'AUD';

		$sp->Cvv = 321;

		$sp->OrderId = 'U'.rand(1000,100000);

		

		if ($sp->Valid()) { // Is the above data valid?

			$response = $sp->Process();



				if ($response == SECUREPAY_STATUS_APPROVED) {

					

					echo "Transaction was a success\n";

				

				} else {

					echo "Transaction failed";

					/*$ob = simplexml_load_string($sp->ResponseXml);

					$json = json_encode($ob);

					$array = json_decode($json, true);

					$array = $array['Payment']['TxnList']['Txn'];

				

					$error_response = array('responseCode'=>$array['responseCode'],

											'responseText'=>$array['responseText'],

											'purchaseOrderNo' =>$array['purchaseOrderNo'],

											'approved' =>$array['approved'],

											'thinlinkResponseCode' =>$array['thinlinkResponseCode'],

											'thinlinkResponseText' =>$array['thinlinkResponseText'],

											'thinlinkEventStatusCode' =>$array['thinlinkEventStatusCode'],

											'thinlinkEventStatusText' =>$array['thinlinkEventStatusText']);

					

					$response_code = $array['responseCode'];

					$response_data = json_encode($error_response);*/

				}

		} else {

			die("Your data is invalid\n");

		}

	}

	

	

	public function payment(){

		

		$this->member_model->is_login();
		isGreenIDVerified();	

		

		if($this->input->post()){

			

			 $this->form_validation->set_rules('name_on_card', 'Name', 'required');

			 $this->form_validation->set_rules('car_no', 'Card Number', 'required|numeric|min_length[16]');

			 $this->form_validation->set_rules('exp_month', 'Expiry Month', 'required');

			 $this->form_validation->set_rules('exp_year', 'Expiry Year', 'required');

			 $this->form_validation->set_rules('cvv2', 'Cvv2', 'required|numeric|min_length[3]');

			

			 if (!$this->form_validation->run() == FALSE){

					

					$cart_data = $this->db_model->get_rows('cart',array('member_id'=>$this->session->userdata('member_data')->id));

					$order_sub_total = 0;

					$shipping_charges =0;

					$s_charges = array();

		

					foreach($cart_data as $cd){

		

						$p_data = $this->db_model->get_row('products',array('id'=>$cd->product_id));

						$s_charges[]= $p_data->postage_amount;

						unset($cd->sess_id,$cd->id);

						$cd->order_id = $this->session->userdata('order_id');					

						$this->db_model->insert_row('order_items',$cd);

						$order_sub_total += ($cd->r_qty*$cd->r_price) + ($cd->w_qty*$cd->w_price);

					}

		

					$max_shipping_charges = max($s_charges);

		

					if($max_shipping_charges == 0){

						$shipping_charges = 0;

					}

					else if($max_shipping_charges <> 0 && sizeof($cart_data)>1){

						$shipping_charges =  $max_shipping_charges + $this->db_model->get_row('settings',array('key'=>'es_charges'))->value;

					}

					else{

						$shipping_charges =  $max_shipping_charges;

					}

		

					$gst = $this->helper_model->calculate_gst($order_sub_total);

		

					$vals['special_instructions'] =  $this->input->post('special_instructions');

					$vals['order_date'] = @date('Y-m-d h:i:s');

					$vals['order_sub_total'] = $order_sub_total;

					$vals['order_gst'] = $gst;

					$vals['order_shipping_charges'] = ($shipping_charges + $this->helper_model->calculate_gst($shipping_charges));

					//$vals['order_amount'] = ($order_sub_total + $gst + $shipping_charges) - $this->session->userdata('discount_amount');

					$vals['order_amount'] = ($order_sub_total + $shipping_charges) - $this->session->userdata('discount_amount');

					$vals['order_status'] = "Paid";

					$vals['order_discount'] = $this->helper_model->format_currency($this->session->userdata('discount_amount'));

					

					include("application/libraries/SecurePay.php");

					

					$sp = new SecurePay($this->config->item('secure_pay_merchant_id'),$this->config->item('secure_pay_transaction_password'),TRUE);

					

					if ($sp->TestConnection()) {

						

						$sp->Cc = $this->input->post('car_no');

						$sp->ExpiryDate = $this->input->post('exp_month').'/'.$this->input->post('exp_year');

						$sp->ChargeAmount = number_format($vals['order_amount'],2);

						$sp->ChargeCurrency = 'AUD';

						$sp->Cvv = $this->input->post('cvv2');

						$sp->OrderId = 'OZL-'.$this->session->userdata('order_id').'-'.$this->session->userdata('member_data')->id.'-'.rand(1000,100000);

						

							if ($sp->Valid()) {

								

								$response = $sp->Process();

							

								if ($response == SECUREPAY_STATUS_APPROVED) {

									

									$sp_data = array('member_id'=>$this->session->userdata('member_data')->id,

													 'order_id'=>$this->session->userdata('order_id'),

													 'sp_order_id'=>$sp->OrderId,

													 'status' => 'processed',

													 'date_processed' => @date('Y-m-d H:i:s'));

									

									$this->db_model->insert_record('secure_pay',$sp_data);

									

									$order_id = $this->db_model->update_row('orders',$vals,array('id'=>$this->session->userdata('order_id')));

					

									if($order_id > 0){

										

										$this->db_model->delete_row('cart',array('member_id'=>$this->session->userdata('member_data')->id));

										$this->session->unset_userdata('discount_amount');

										$this->sendNotification($order_id);

										redirect(base_url().'cart/thankyou/'.$order_id,'location');

									   // redirect(base_url().'cart/thankyou','location');

									}

									

								} else {

									$this->session->set_userdata('messages', '<li>Unable to process transaction, please try again later.</li>');

								}

							}

							else{

								$this->session->set_userdata('messages', '<li>Invalid card details.</li>');

							}

						

					}else{

							$this->session->set_userdata('messages', '<li>Unable to connect to payment gateway.</li>');

					}



			}

		}

		$data['page'] = 'payment';

		$data['page_view'] = "web/pages/pg-payment";

		$this->load->view('web/shared/master',$data);

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

			

			$to = $this->db_model->get_admin_email();

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

			//$this->email->from($sender_email, $sender_name);

			$this->email->to($to);

			$this->email->subject($subject);

			$this->email->message($body);

			$this->email->send();	

			//echo $this->email->print_debugger();

			

			//$this->notificationmodel->send_email_no_template("",$to,$subject,$body);

	}

	

	

	



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
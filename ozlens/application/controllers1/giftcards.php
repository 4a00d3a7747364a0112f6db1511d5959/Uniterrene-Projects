<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giftcards extends CI_Controller {

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

        $this->member_model->is_login();
    }

    public function index(){

		if($this->input->post()){
			
				$this->load->library('form_validation');
				
				//$this->form_validation->set_rules('name_on_card','Name on Card','required');
				//$this->form_validation->set_rules('card_no','Card No','required|numeric');
				//$this->form_validation->set_rules('exp_month','Expiry Month','required');
				//$this->form_validation->set_rules('exp_year', 'Expiry Year', 'required');
				//$this->form_validation->set_rules('cvv2', 'Cvv2', 'required|numeric|max_length[3]');
				$this->form_validation->set_rules('amount','Amount','required|numeric');
				$this->form_validation->set_rules('email','Email','required|valid_email');
			
			
				if (!$this->form_validation->run() == FALSE){
			
							$vals = $this->input->post();
							//echo $vals['actionbtn'];//var_dump($vals);
							
							$gfval['member_id'] = $this->session->userdata('member_data')->id;
							$gfval['purchase_date'] = date('Y-m-d h:i:s');
							$gfval['code'] = $this->rand_string(8);
							$gfval['amount'] = $vals['amount'];
							$gfval['email'] = $vals['email'];
							$gfval['your_name'] = $vals['your_name'];
							$gfval['your_phone'] = $vals['your_phone'];
							$gfval['your_mobile'] = $vals['your_mobile'];
							$gfval['your_email'] = $vals['your_email'];
							$gfval['pay_with'] = $vals['pay_with'];
							$gfval['send_voucher_to'] = $vals['send_voucher_to'];
							$gfval['recipient_name'] = $vals['recipient_name'];
							
							$vals['code'] = $gfval['code'];
							if($vals['actionbtn'] == 'sendNow'){
				
								//unset($vals['name_on_card'],$vals['card_no'],$vals['exp_month'],$vals['exp_year'],$vals['cvv2']);
								
								
								if($this->input->post('pay_with') == 'sp')
								{
									
									 $this->form_validation->set_rules('name_on_card', 'Name', 'required');
									 $this->form_validation->set_rules('card_no', 'Card Number', 'required|numeric|min_length[16]');
									 $this->form_validation->set_rules('exp_month', 'Expiry Month', 'required');
									 $this->form_validation->set_rules('exp_year', 'Expiry Year', 'required');
									 $this->form_validation->set_rules('cvv2', 'Cvv2', 'required|numeric|min_length[3]');

									 if (!$this->form_validation->run() == FALSE)
									 {
										include("application/libraries/SecurePay.php");
										$sp = new SecurePay($this->config->item('secure_pay_merchant_id'),$this->config->item('secure_pay_transaction_password'),$this->config->item('secure_pay_transaction_password'),$this->config->item('secure_pay_test_mode'));
										
										if ($sp->TestConnection()) {
								
											$sp->Cc = $this->input->post('card_no');
											$sp->ExpiryDate = $this->input->post('exp_month').'/'.$this->input->post('exp_year');
											$sp->ChargeAmount = number_format($this->input->post('amount'),2);
											$sp->ChargeCurrency = 'AUD';
											$sp->Cvv = $this->input->post('cvv2');
											$sp->OrderId = 'G-OZL-'.$this->session->userdata('member_data')->id.'-'.rand(1000,100000);
											
											
											
											if ($sp->Valid()) {
											
												$response = $sp->Process();
											
												if ($response == SECUREPAY_STATUS_APPROVED) {
													
													$gfval['securepay_id'] = $sp->OrderId;
													$ret_id = $this->db_model->insert_row_retid("gift_cards",$gfval);
										
													//ozl_gift_cards-->securepay_id
													
													if($ret_id>0){
														
														$sp_data = array('member_id'=>$this->session->userdata('member_data')->id,
																	 'sp_order_id'=>$sp->OrderId,
																	 'order_id'=>$ret_id,
																	 'status' => 'processed',
																	 'date_processed' => @date('Y-m-d H:i:s'));
													
														$this->db_model->insert_record('secure_pay',$sp_data);
														$this->db_model->updateRecord('gift_cards',array('payment_status'=>'Paid'),array('id'=>$ret_id));
														
														$this->email_gift_card($vals);
														$this->session->set_flashdata('response2', '<div class="success-box">Thank you for purchasing a gift card, the code to redeem this card is '.$vals['code'].' this code has been sent to the email you have provided during the purchase process.</div>');
														redirect(base_url().'giftcards/thankyou','location');
													}
													else{
														$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
														//redirect($_SERVER['HTTP_REFERER'],'location');
													}
													
												}else {
													$this->session->set_flashdata('response', '<div class="error-box">Unable to process transaction, please try again later.</div>');
												}
											}
											else{
												$this->session->set_flashdata('response', '<div class="error-box">Invalid card details.</div>');
												
											}
											
											}else{
												$this->session->set_flashdata('response', '<div class="error-box">Unable to connect to payment gateway.</div>');
												
											}
											redirect(base_url().'giftcards','location');
											//var_dump($sp);exit;
										
									 }
								}
								else
								{
									$item_name = 'Gift Card';
									$item_number = $gfval['code'];
									$item_qty = 1;
									$item_amount = $gfval['amount'];
									
									$key = 0;
									$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($item_name);
									$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($item_number);
									$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($item_amount);		
									$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($item_qty);
									
									
									$ItemTotalPrice 	= $gfval['amount'];
									$TotalTaxAmount 	= 0.00;
									$ShippinCost 		= 0.00;
									$HandalingCost 		= 0.00;
									$ShippinDiscount 	= 0.00;
									$InsuranceCost 		= 0.00;
									$GrandTotal 		= $gfval['amount'];
									
					
									
									$paypal_giftcard =  array('TotalTaxAmount'=>$gst, 
													'HandalingCost'=>$HandalingCost, 
													'InsuranceCost'=>$InsuranceCost,
													'ShippinDiscount'=>$ShippinDiscount,
													'ShippinCost'=>$ShippinCost,
													'GrandTotal'=>$GrandTotal,
													'ItemTotalPrice' => $ItemTotalPrice,
													'order_sub_total' => $ItemTotalPrice,
													'gfvals' =>$gfval,
													'item_name' => $item_name,
													'item_number' => 	$item_number,
													'item_qty' => 	$item_qty ,
													'item_amount' => 	$item_amount,
													);
													
									$this->session->set_userdata('paypal_giftcard', $paypal_giftcard);
					
									
										$padata = 	'&METHOD=SetExpressCheckout'.
										'&RETURNURL='.urlencode(base_url().'giftcards/returnUrl').
										'&CANCELURL='.urlencode(base_url().'giftcards/').
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
												
												$gfval['paypal_transaction_id'] = $httpParsedResponseAr["TOKEN"];
												$ret_id = $this->db_model->insert_row_retid("gift_cards",$gfval);
												
												$this->session->set_userdata('paypal_giftcard_id', $ret_id);
												
												
												redirect($paypalurl);
										}
										else{
											//$this->session->set_userdata('messages', '<li>Unable to process your request, please try again later.</li>');
											$this->session->set_userdata('messages', '<li>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</li>');
										}
										//echo 12134134;exit;
									
								}
			
							}else if($vals['actionbtn'] == 'printVoucher'){
					
								$ret_id = $this->db_model->insert_row_retid("gift_cards",$gfval);
								
								redirect(base_url().'giftcards/printVoucher/'.$ret_id,'location');
							}else if($vals['actionbtn'] == 'sendLater'){
							
								if($vals['send_date'] != ''){
						
									$ret_id = $this->db_model->insert_row_retid("gift_cards",$gfval);
									
									$ins = array(
									'member_id' =>$this->session->userdata('member_data')->id,
									'card_id' => $ret_id,
									'send_date' =>date('Y-m-d',strtotime($vals['send_date'])),
									'message' =>$vals['message']
									);
									
									$qid = $this->db_model->insert_row_retid("gift_card_queue",$ins);
									
									//$this->email_gift_card($vals);
									
									$this->session->set_flashdata('response2', '<div class="success-box">Thank you for purchasing a gift card. Your gift card has been saved and will be sent on '.date('M d, Y', strtotime($vals['send_date'])).'.</div>');
									redirect(base_url().'giftcards/thankyou','location');
								}else{
									$this->session->set_flashdata('response', '<div class="error-box">Date not selected.</div>');
									redirect($_SERVER['HTTP_REFERER'],'location');
								}
							}
				}			
		}
		
		 $this->gift_cards_view();
    }

    private function gift_cards_view()
    {
		$page_data = $this->db_model->get_row('content',array('id'=>'155'));
		
        $data = array(
            'page_title' => $page_data->title,
			'page_data' =>  $page_data,
            'page_view' => "web/pages/pg-gift-card",
            'row' => $this->intialize_form()
        );

        $this->load->view('web/shared/master',$data);
    }

    private function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }

    private function intialize_form()
    {
        $values = (object) array(
            'name_on_card'=>'',
            'card_no' =>'',
            'exp_month' => '',
            'exp_year' => '',
            'cvv2'=>'',
            'amount' =>'',
            'email' =>''
        );

        return $values;
    }


    private function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name_on_card','Name on Card','required');
        $this->form_validation->set_rules('card_no','Card No','required');
        $this->form_validation->set_rules('exp_month','Expiry Month','required');
        $this->form_validation->set_rules('exp_year', 'Expiry Year', 'required');
        $this->form_validation->set_rules('cvv2', 'Cvv2', 'required');
        $this->form_validation->set_rules('amount','Amount','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');

        return $this->form_validation->run();
    }

    private function email_gift_card($vals)
    {
        $mem_data = $this->db_model->get_row('members',array('id'=>$this->session->userdata('member_data')->id));

		if($vals['send_voucher_to'] == 'your_email') $to = $vals['your_email'];
        else $to = $vals['email'];

        $email_temp = $this->db_model->get_row('email_templates',array('id'=>4));

        $subject = $email_temp->subject;

        $body = $email_temp->content;

        $body = str_replace('{first_name}',$mem_data->first_name,$body);
        $body = str_replace('{last_name}',$mem_data->last_name,$body);
        $body = str_replace('{code}',$vals['code'],$body);
		
		$body .= "<p>Message: ".$vals['message']."</p>";

        $this->notificationmodel->send_email_no_template_giftcard("",$to,$subject,$body);
    }
	
	public function printVoucher($card_id)
	{
		$card = $this->db_model->get_row('gift_cards',array('id'=>$card_id));
		
        $mem_data = $this->db_model->get_row('members',array('id'=>$card->member_id));

        $email_temp = $this->db_model->get_row('email_templates',array('id'=>4));

        $body = $email_temp->content;

        $body = str_replace('{first_name}',$mem_data->first_name,$body);
        $body = str_replace('{last_name}',$mem_data->last_name,$body);
        $body = str_replace('{code}',$card->code,$body);
		
		$body .= "<p>Message: ".$vals['message']."</p>";
		
		$data['vtxt'] = stripslashes($body);
		 $data['page_view'] = "web/pages/pg-gift-voucher";
		 $this->load->view('web/pages/pg-gift-voucher',$data);
	}
	
	public function process_queue()
	{
		
	}
	
	public function returnUrl()
	{
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
			if(isset($_GET["token"]) && isset($_GET["PayerID"]))
			{
				
				
				
				//we will be using these two variables to execute the "DoExpressCheckoutPayment"
				//Note: we haven't received any payment yet.
				
				$token = $_GET["token"];
				$payer_id = $_GET["PayerID"];
				
				//get session variables
				$paypal_giftcard = $this->session->userdata('paypal_giftcard');
				$paypal_data = '';
				$key =0;
				
			
				$paypal_data .= '&L_PAYMENTREQUEST_0_QTY'.$key.'='. urlencode($paypal_giftcard['item_qty']);
					$paypal_data .= '&L_PAYMENTREQUEST_0_AMT'.$key.'='.urlencode($paypal_giftcard['item_amount']);
					$paypal_data .= '&L_PAYMENTREQUEST_0_NAME'.$key.'='.urlencode($paypal_giftcard['item_name']);
					$paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER'.$key.'='.urlencode($paypal_giftcard['item_number']);

				
				
				
				$card_id = $this->session->userdata('paypal_giftcard_id');
				$TotalTaxAmount = 0.00;
				$padata = 	'&TOKEN='.urlencode($token).
							'&PAYERID='.urlencode($payer_id).
							'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
							$paypal_data.
							'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($paypal_giftcard['ItemTotalPrice']).
							'&PAYMENTREQUEST_0_TAXAMT='.urlencode($TotalTaxAmount).
							'&PAYMENTREQUEST_0_SHIPPINGAMT='.urlencode($paypal_giftcard['ShippinCost']).
							'&PAYMENTREQUEST_0_HANDLINGAMT='.urlencode($paypal_giftcard['HandalingCost']).
							'&PAYMENTREQUEST_0_SHIPDISCAMT='.urlencode($paypal_giftcard['ShippinDiscount']).
							'&PAYMENTREQUEST_0_INSURANCEAMT='.urlencode($paypal_giftcard['InsuranceCost']).
							'&PAYMENTREQUEST_0_AMT='.urlencode($paypal_giftcard['GrandTotal']).
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
			
						$this->email_gift_card($paypal_giftcard);
						$transaction_id = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
						//echo '<h2>Success</h2>';
						//echo 'Your Transaction ID : '.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
						
							/*
							//Sometimes Payment are kept pending even when transaction is complete. 
							//hence we need to notify user about it and ask him manually approve the transiction
							*/
							
							if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]){
								
								//$this->session->set_userdata('messages', '<li>Transaction Completed.</li>');
								
								$this->session->set_flashdata('response2', '<div class="success-box">Transaction Completed.</div>');
								//$this->db_model->updateRecord('orders',array('order_status'=>'Paid'),array('id'=>$order_id));
								
								$this->db_model->updateRecord('gift_cards',array('payment_status'=>'Paid',
																			
																			
																			 'paypal_transaction_id' => $transaction_id,
																			
																			 ),array('id'=>$card_id));
								
								//echo '<div style="color:green">Payment Received! Your product will be sent to you very soon!</div>';
								
								redirect(base_url().'giftcards/thankyou','location');
							
							}
							elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]){
								$this->session->set_flashdata('response2', '<div class="success-box">Transaction Complete, but payment is still pending! You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>');
								$this->db_model->updateRecord('gift_cards',array('payment_status'=>'Pending'),array('id'=>$card_id));
								/*echo '<div style="color:red">Transaction Complete, but payment is still pending! '.
								'You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';*/
							
								redirect(base_url().'giftcards/thankyou','location');
							}
			
							// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
							// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
							$padata = 	'&TOKEN='.urlencode($token);
							$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata);
			
							if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
								
								$this->db_model->updateRecord('gift_cards',array('payment_status'=>'Paid',
																			 
																			 'paypal_transaction_id' => $transaction_id,
																			 
																			 ),array('id'=>$card_id));
								//exit($transaction_id);
								
								/*
								$this->db_model->addRecord('paypal_transactions',array('order_id'=>$card_id,'member_id'=>$this->session->userdata('member_data')->id,
														  'buyerName' => urldecode($httpParsedResponseAr["FIRSTNAME"]).' '.urldecode($httpParsedResponseAr["LASTNAME"]),
														  'buyerEmail' => urldecode($httpParsedResponseAr["EMAIL"]),
														  'amount_paid' =>$paypal_product_amounts['GrandTotal'],
														  'paypal_transaction_id' => $transaction_id,
														  'date_added' => @date('Y-m-d H:i:s')));
								
								*/
							
								$this->session->set_flashdata('response2', '<div class="success-box">Transaction Completed.</div>');
								/*echo '<pre>';
								print_r($httpParsedResponseAr);
								echo '</pre>';*/
								redirect(base_url().'giftcards/thankyou','location');
								
							} else  {
								$this->session->set_flashdata('response2', '<div class="error-box">'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>');
								
								/*echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
								echo '<pre>';
								print_r($httpParsedResponseAr);
								echo '</pre>';*/
								
								redirect(base_url().'giftcards','location');
							}
				
				
				
				}else{
						/*$this->session->set_flashdata('response', '<div class="success-box">Your password has been sent to your email address.</div>');
 					    $this->session->set_flashdata('response', '<div class="error-box">The email address you have entered doesn\'t match with our records.</div>');*/
						$this->session->set_flashdata('response', '<div class="error-box">'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>');
						/*echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
						echo '<pre>';
						print_r($httpParsedResponseAr);
						echo '</pre>';*/
						
						redirect(base_url().'giftcards','location');
				}
				$this->session->unset_userdata('paypal_giftcard');
				$this->session->unset_userdata('paypal_giftcard_id');
			}
			
		 $this->gift_cards_view();
	}
	
	public function thankyou()
	{

        //$page_data = $this->db_model->get_row('content',array('id'=>153));

		$data['page_view'] = "web/pages/pg-thankyou-giftcard";

        $data['page_title'] = 'Thankyou';

       // $data['page_data'] = $this->session->flashdata('response');

		//$data['order_id'] = $order_id;

		$this->load->view('web/shared/master',$data);

	}


}

/* End of file giftcards.php */
/* Location: ./application/controllers/giftcards.php */
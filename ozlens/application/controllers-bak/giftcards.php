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
				
				$this->form_validation->set_rules('name_on_card','Name on Card','required');
				$this->form_validation->set_rules('card_no','Card No','required|numeric');
				$this->form_validation->set_rules('exp_month','Expiry Month','required');
				$this->form_validation->set_rules('exp_year', 'Expiry Year', 'required');
				$this->form_validation->set_rules('cvv2', 'Cvv2', 'required|numeric|max_length[3]');
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
							
							if($vals['actionbtn'] == 'sendNow'){
				
								//unset($vals['name_on_card'],$vals['card_no'],$vals['exp_month'],$vals['exp_year'],$vals['cvv2']);
					
								include("application/libraries/SecurePay.php");
								$sp = new SecurePay($this->config->item('secure_pay_merchant_id'),$this->config->item('secure_pay_transaction_password'),TRUE);
								
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
												
												$this->email_gift_card($vals);
												$this->session->set_flashdata('response', '<div class="success-box">Thank you for purchasing a gift card, the code to redeem this card is '.$vals['code'].' this code has been sent to the email you have provided during the purchase process.</div>');
												redirect(base_url().'giftcards','location');
											}
											else{
												$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
												redirect($_SERVER['HTTP_REFERER'],'location');
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
									
									$this->session->set_flashdata('response', '<div class="success-box">Thank you for purchasing a gift card. Your gift card has been saved and will be sent on '.date('M d, Y', strtotime($vals['send_date'])).'.</div>');
									redirect(base_url().'giftcards','location');
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

        $to = $vals['email'];

        $email_temp = $this->db_model->get_row('email_templates',array('id'=>4));

        $subject = $email_temp->subject;

        $body = $email_temp->content;

        $body = str_replace('{first_name}',$mem_data->first_name,$body);
        $body = str_replace('{last_name}',$mem_data->last_name,$body);
        $body = str_replace('{code}',$vals['code'],$body);
		
		$body .= "<p>Message: ".$vals['message']."</p>";

        $this->notificationmodel->send_email_no_template("",$to,$subject,$body);
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

}

/* End of file giftcards.php */
/* Location: ./application/controllers/giftcards.php */
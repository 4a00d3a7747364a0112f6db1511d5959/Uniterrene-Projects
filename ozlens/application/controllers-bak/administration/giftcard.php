<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class giftcard extends CI_Controller {

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
			
		$this->admin_model->is_login();
        $this->admin_model->role_validator('');

		// Your own constructor code    	
	}	
	 
	public function index()
	{
        if($this->input->post() && $this->validate())
        {
            $vals = $this->input->post();

            $gvals['member_id'] = 0;
            $gvals['purchase_date'] = date('Y-m-d h:i:s');
            $gvals['code'] = $this->rand_string(8);
			$gvals['amount'] = $vals['amount'];
			$gvals['email'] = $vals['receiver_email'];
			

            $ret_id = $this->db_model->insert_row_retid("gift_cards",$gvals);

            if($ret_id>0)
            {
                $this->email_gift_card($vals);
                $this->session->set_flashdata('response', '<div class="success-box">Discount code has been sent.</div>');
                redirect(base_url().'administration/giftcard','location');
            }
            else
            {
                $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
                redirect($_SERVER['HTTP_REFERER'],'location');
            }
        }
        else
        {

          $data["page_title"] = "Send Gift Card";
		  $data["code"] = $this->rand_string(8);
		  
		  $email_temp = $this->db_model->get_row('email_templates',array('id'=>6))->content;
		 	// var_dump($email_temp);
		  $email_temp = str_replace('{code}', $data["code"],$email_temp);
		  $data["email_temp"] = $email_temp;
		  $data["page_view"] = "administration/pages/pg-gift-card";
		  $this->load->view('administration/shared/master',$data);
        }
	}

   private function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }
	
	private function email_gift_card($vals)
    {
        

        $to = $vals['receiver_email'];

        $subject = $vals['subject'];

        $body = stripslashes($vals['content']);
		
		//echo "To: ".$to." Subject:".$subject." body: ".$body ;exit;

        $this->notificationmodel->send_email_no_template("",$to,$subject,$body);
    }
	
	private function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('receiver_email','Receiver Email','required');
        $this->form_validation->set_rules('subject','Subject','required');
        $this->form_validation->set_rules('amount','Discount Amount','required');
        $this->form_validation->set_rules('content', 'Email Content', 'required');
       
        return $this->form_validation->run();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
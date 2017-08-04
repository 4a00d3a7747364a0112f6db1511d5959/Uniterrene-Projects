<?php 

class notificationmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	
    
   function send_email($sender_name,$to,$from,$subject,$body,$template,$file = ''){
			
		$config['mailtype'] = "html";
		
		$templete = file_get_contents(base_url('assets/templates/'.$template.''));
			
		$templete = str_replace('[bodyText]',$body,$templete);
		
		$templete = str_replace('[date]',date('m/d/Y'),$templete);
		
		$templete = str_replace('[subject]',$subject,$templete);
		
		$templete = str_replace('[siteURL]',base_url(),$templete);
		
		$templete = str_replace('[logo]',base_url()."assets/images/logo.png",$templete);	
							
		$this->email->initialize($config);
		$this->email->from($from, $sender_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($templete);
		
		if($file != '')
		{
			$this->email->attach($file);	
		}
		
		$this->email->send();			
	}
	
	
	
	function send_email_no_template($sender_name="",$to,$subject,$body)
	{
		
		$this->load->library('email');
		
		$config['mailtype'] = "html";		
			

        $sender_name = "OZLensRentals.com";
		$sender_email = $this->db_model->get_row('users',array('id'=>5))->useremail;

		$this->email->initialize($config);
		$this->email->from($sender_email, $sender_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);
		$this->email->send();
		
		//echo $this->email->print_debugger();
		//exit;
	}
	
	function send_email_no_template_giftcard($sender_name="",$to,$subject,$body)
	{
		
		$this->load->library('email');
		
		$config['mailtype'] = "html";		
			

        $sender_name = "OzLensRental.com.au";
		$sender_email = "hire@ozlensrental.com.au";

		$this->email->initialize($config);
		$this->email->from($sender_email, $sender_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);
		$this->email->send();
		
		//echo $this->email->print_debugger();
		//exit;
	}
	
	
	function send_email_to_admin($sender_name,$sender_email,$subject,$body,$receiver_email = '')
	{
		
		$this->load->library('email');
		
		$config['mailtype'] = "html";
		
		if($receiver_email != '') {$to  = 	$receiver_email;}	
		else
		{$to = $this->db_model->get_row('users',array('id'=>5))->useremail;}

		$this->email->initialize($config);
		$this->email->from($sender_email, $sender_name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);
		$this->email->send();			
	}
	
	
		
}

?>
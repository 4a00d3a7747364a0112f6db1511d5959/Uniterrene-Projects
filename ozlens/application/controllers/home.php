<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	
	/*function _remap($method)
	{ 	
		$content_data = $this->db_model->get_table('content');	
		
		$cd_arr = array();
		
		foreach($content_data as $cd)
		{
			$cd_arr[]= $cd->slug;
		}
		
		if(in_array($method,$cd_arr))
		{   
       		# I use segment(4) here as I'm using the URI language class, which adds an extra segment before the controller, so usually segment(3) would be OK
            $this->content($method); 
        }
		else
		{
            $this->index();
        }        
    }*/
	 
	public function index()
	{	
		$data['submsg'] = '';
		
        if($this->input->post("name"))
		{
			$vals = $this->input->post();
			
			require('Mailchimp.php');

			$MailChimp = new MailChimp('0f72e2bd2104ba9fba8739b2573cca04-us8');
			$result = $MailChimp->call('lists/subscribe', array(
                'id'                => '9ca0b69377',
                'email'             => array('email'=>$vals['email']),
                'merge_vars'        => array('FNAME'=>$vals['name']),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => true,
            ));

			//print_r($result); exit;
			
			$data['submsg'] = '<p>Your request has been sent successfully.</p>';
				
		}
		
		$data['page_view'] = "web/pages/pg-home";
        $data['display_menu'] = false;
        $this->load->view('web/shared/master',$data);
		
		
	}
	
	public function content($slug)
	{
		$page_data = $this->db_model->get_row('content',array('slug'=>$slug));
		
		if($page_data)
		{
			$data = array(				
				'page_title' => $page_data->title,
				'page_data' =>  $page_data,
				'page_view' => "web/pages/pg-content"
			);
	
			$this->load->view('web/shared/master',$data);
		}
		else
		{
			show_404();
		}
	}	
	
    public function contact()
    {
		if($this->input->post())
		{
			$this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $data['page_view'] = "web/pages/pg-contactus";		
        		$this->load->view('web/shared/master',$data);
            }
            else
            {
                $vals = $this->input->post();

                unset($vals['btnSubmit']);
				
				$sender_name = $vals['name'];
				$sender_email = $vals['email'];
				$subject = $vals['name']." contact information from OZLensRentals.com";
				
				$body = "Dear Admin,<br/><br/>";
				
				$body.= "Message details are as follows.<br/><br/>";
				
				$body.="<strong>Name:</strong> ".$vals['name']."<br/>";
				
				$body.="<strong>Email:</strong> ".$vals['email']."<br/>";
				
				$body.="<strong>Subject:</strong> ".$vals['subject']."<br/>";
				
				$body.="<strong>Message:</strong> ".$vals['message']."<br/>";
				
				
				$this->notificationmodel->send_email_to_admin($sender_name,$sender_email,$subject,$body,'info@ozlensrental.com.au');
               
				$this->session->set_flashdata('response', '<div class="success-box">Thank you, your message has been submitted.</div>');
				redirect(base_url()."contactus",'location');               

            }
		}
		else
		{
			 $data['page_view'] = "web/pages/pg-contactus";		
        	 $this->load->view('web/shared/master',$data);
		}		       
		
    }


    public function request_gear()
    {
        if($this->input->post())
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('message', 'Message', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $data['page_view'] = "web/pages/pg-request-gear";
                $this->load->view('web/shared/master',$data);
            }
            else
            {
                $vals = $this->input->post();

                unset($vals['btnSubmit']);

                $sender_name = $vals['name'];
                $sender_email = $vals['email'];
                $subject = $vals['name']." gear request from OZLensRentals.com";

                $body = "Dear Admin,<br/><br/>";

                $body.= "Message details are as follows.<br/><br/>";

                $body.="<strong>Name:</strong> ".$vals['name']."<br/>";

                $body.="<strong>Email:</strong> ".$vals['email']."<br/>";

                $body.="<strong>Message:</strong> ".$vals['message']."<br/>";


                $this->notificationmodel->send_email_to_admin($sender_name,$sender_email,$subject,$body,'hire@ozlensrental.com.au');

                $this->session->set_flashdata('response', '<div class="success-box">Thank you, your request has been submitted.</div>');
                redirect(base_url()."request-gear",'location');

            }
        }
        else
        {
            $data['page_view'] = "web/pages/pg-request-gear";
            $this->load->view('web/shared/master',$data);
        }

    }

    public function comingsoon()
	{
		$data['page_view'] = "web/pages/pg-comingsoon";		
       	$this->load->view('web/shared/master',$data);
	}
	
	public function displayPostImg($id)
	{
		$url1 = base_url().'blog/wp-admin/admin-ajax.php?action=get_thumbnail&post_id='.$id.'';
		header("Content-type: image/jpeg");
		$url = file_get_contents($url1);
		
		echo file_get_contents($url);
	}
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
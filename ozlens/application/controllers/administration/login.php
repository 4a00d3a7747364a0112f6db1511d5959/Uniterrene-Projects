<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	 
	public function __construct()
    {
		parent::__construct();				
		// Your own constructor code    	
	}	
	 
	public function index()
	{
		$data = array(
				'page_title' => "Administration Login",
				'page_view' => "administration/pages/pg-login"				
				);
														
		$this->load->view('administration/shared/master',$data);
	}
	
	public function authenticate()
	{
		$vals = $this->input->post();
		$user = $this->db_model->get_row("users",$vals);
		
		if($user)
		{
			if($user->status == 0)
			{
				$this->session->set_flashdata('response', '<div class="error-box">Your account status is inactive now.</div>');			
				redirect(base_url().'administration/login', 'refresh');	
			}
			else
			{
				$this->session->set_userdata('loggedinuser', $user);

                $vists = $this->session->userdata('loggedinuser')->visits + 1;
                $ip = $this->input->ip_address();
                $vals = array('ip'=>$ip,'visits'=>$vists,'last_login'=>date('Y-m-d h:i:s'));

                $user_id = $this->session->userdata('loggedinuser')->id;
                $where = array('id'=>$user_id);

                $this->db_model->update_row('users',$vals,$where);
				redirect(base_url().'administration/cpanel', 'refresh');	
			}
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Invalid credentials, please try again.</div>');
			redirect(base_url().'administration/login', 'refresh');
		}			
						
	}
	
	public function logoff()
	{		
		$this->session->unset_userdata('loggedinuser');
		redirect(base_url().'administration/login', 'refresh');									
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
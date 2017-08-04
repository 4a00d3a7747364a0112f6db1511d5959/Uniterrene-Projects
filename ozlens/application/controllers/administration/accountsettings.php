<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountSettings extends CI_Controller {

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
        $this->admin_model->is_login();
        $this->admin_model->role_validator('');
		// Your own constructor code    	
	}	
	 
	public function index()
	{
		$data = array(
				'page_title' => "Admin Account Settings",
				'page_view' => "administration/pages/pg-account-settings"				
				);
														
		$this->load->view('administration/shared/master',$data);
	}
	
	public function save()
	{
		
		$vals = $this->input->post();		
		unset($vals['btnSubmit']);	
			
		$where = array('id' => $this->session->userdata('loggedinuser')->id);
		
		$res = $this->db_model->update_row("users",$vals,$where);
		
		if($res)
		{
			$this->refreshSession();
			$this->session->set_flashdata('response', '<div class="success-box">Account information has been updated.</div>');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
	
	function refreshSession()
	{			
		$result = $this->db_model->get_row('users',array('id' => $this->session->userdata('loggedinuser')->id));
		$this->session->set_userdata('loggedinuser', $result);		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
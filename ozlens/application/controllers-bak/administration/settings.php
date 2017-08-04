<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

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
	 
	public function index($error = "")
	{
		
		$modules = $this->db_model->get_rows_groupby('settings',array('status'=>'Enabled'),array('module'));
				
		$data = array(
				'page_title' => "Global Settings",
				'page_view' => "administration/pages/pg-settings-edit",
				'modules' => $modules,
				'error' => $error	
				);
														
		$this->load->view('administration/shared/master',$data);
	}
	
	public function save()
	{
		if(!$this->input->post())
		{
			$this->session->set_flashdata('response', '<div class="error-box">Bad parameters request found.</div>');
			redirect(base_url().'administration/settings', 'refresh');
		}
		else
		{
			$arr = $this->input->post();		
			unset($arr['mode']);
				
			foreach ($arr as $key => $value) 
			{
				$res = $this->db_model->update_row('settings',array('value'=>$value),array('key'=>$key));		
			}
					
			if($res)
			{
				$this->session->set_flashdata('response', '<div class="success-box">Settings have been modified.</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
			else
			{
				$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiries extends CI_Controller {

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
            $data = array(
				'page_title' => "Product Inquiries",
				'page_view' => "administration/pages/pg-inquiries-view"
				);
														
		$this->load->view('administration/shared/master',$data);
	}
	
	public function grid()
	
	{
		$query = "select i.fname,i.email,(SELECT p.product_title FROM {PRE}products p where p.id = i.product_id) as product ,i.question, DATE_FORMAT(i.dated, '%a, %M %d, %Y') as dated, i.id as ed from {PRE}inquiries i order by i.id desc";
		$data = $this->db_model->sql($query);		
		echo $this->gridmodel->output($data);
	}	
	
	
	private function intialize_form()
	{
		$values = (object) array(
                    'id' => '',
                    'template_name' => '',
                    'subject'=>'',
                    'content'=>''
				);

		return $values;
	}	
	
	private function validate()
	{
		$this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email address','required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('content', 'Email Content', 'required');
        return $this->form_validation->run();
	}
	
	private function verify_pk($id)
	{
		$res = $this->db_model->get_row('inquiries',array('id'=>$id));
						
		if(!$res)
		{						
			$this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
			redirect(base_url().'administration/inquiries/reply/'.$id, 'refresh');
		}		
	}
	
	public function reply($id = 0)
	{
		if($this->input->post('id'))
		{
			$id = $this->input->post('id');
			$vals = $this->input->post();
		}	
		
		$this->verify_pk($id);
		
		if($this->input->post() && $this->validate())
		{
			$req = $this->input->post();
			
			
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			
			//$admin_email = $this->db_model->get_admin_email();

			$this->email->from('service@ozlensrental.com.au', 'OZlense Rental');
			$this->email->to($req['email']);
			//$ccEmail = $this->db_model->get_row('settings',array('key' => 'cc-email'))->value;
			//$this->email->cc($ccEmail);
			
			$this->email->subject($req['subject']);
			$this->email->message($req['content']);
			
			
			$this->email->send();
			
			//echo $this->email->print_debugger();
			
			$this->db_model->update_row('inquiries', array('reply_flag'=>1,'reply'=>$req['content']),array('id'=>$id));	
			
			$this->session->set_flashdata('response', '<div class="success-box">Email has been sent successfully.</div>');
			redirect(base_url().'administration/inquiries', 'refresh');
		}
		else
		{
			$template_data= $this->db_model->get_row('inquiries',array('id'=>$id));
		
			$data = array(
				'page_title' => "Send Email",
				'page_view' => "administration/pages/pg-inquiries-edit",
				'error' => $this->error,
				'row'=> $template_data,
                'view_only' => true
				);
																					
			$this->load->view('administration/shared/master',$data);
		}	
	
	}
	

	public function del($id = 0)
	{
		$this->verify_pk($id);
		
		$res = $this->db_model->delete_row("inquiries",array('id'=>$id));
		
		if($res)
		{
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/inquiries', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/inquiries', 'refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
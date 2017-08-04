<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

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
				'page_title' => "Content Management",
				'page_view' => "administration/pages/pg-content-view"
				);
														
		$this->load->view('administration/shared/master',$data);
	}
	
	public function grid()
	{
		$query = "select title,slug, DATE_FORMAT(date_modified, '%a, %M %d, %Y') as date_modified, id as ed, id as dl  from {PRE}content where display_in_cms = 'Yes' order by id desc";
		$data = $this->db_model->sql($query);		
		echo $this->gridmodel->output($data);
	}	
	
	
	private function intialize_form()
	{
		$values = (object) array(
				 'id' => '',
				 'title' => '',
				 'slug'=>'',
				 'content'=>'',
				 'metas'=>''
				);
										
		return $values;
	}	
	
	private function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title','Title','required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		$this->form_validation->set_rules('content', 'Description/Detail', 'required');
		return $this->form_validation->run();
	}
	
	private function verify_pk($id)
	{
		$res = $this->db_model->get_row('content',array('id'=>$id));
						
		if(!$res)
		{						
			$this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
			redirect(base_url().'administration/content/add', 'location');
		}		
	}
	
	public function edit($id = 0)
	{
		if($this->input->post('id'))
		{
			$id = $this->input->post('id');
			$vals = $this->input->post();
		}	
		
		$this->verify_pk($id);
		
		if($this->input->post() && $this->validate())
		{
			unset($vals['btnSubmit']);
			
			$vals['date_modified'] = date('Y-m-d h:i:s');
			
			$where = array('id' => $id);	
				
			$res = $this->db_model->update_row('content',$vals,$where);
			
			if($res)
			{
				$this->session->set_flashdata('response', '<div class="success-box">Information has been modified.</div>');
				redirect($_SERVER['HTTP_REFERER'],'location');
			}
			else
			{
				$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
				redirect($_SERVER['HTTP_REFERER'],'location');
			}
		}
		else
		{
			$page_data= $this->db_model->get_row('content',array('id'=>$id));
		
			$data = array(
				'page_title' => "Edit Page Content",
				'page_view' => "administration/pages/pg-content-edit",
				'error' => $this->error,
				'row'=> $page_data,
                'view_only' => true
				);
																					
			$this->load->view('administration/shared/master',$data);
		}	
	
	}
	
	public function add()
	{
		$vals = $this->input->post();

		if($this->input->post() && $this->validate())
		{
			unset($vals['btnSubmit']);
							
			$vals['date_modified'] = date('Y-m-d h:i:s');	
				
			$ret_id = $this->db_model->insert_row_retid("content",$vals);
		
			if($ret_id>0)
			{
				$this->session->set_flashdata('response', '<div class="success-box">Information has been added.</div>');
				redirect($_SERVER['HTTP_REFERER'],'location');
			}
			else
			{
				$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
				redirect($_SERVER['HTTP_REFERER'],'location');
			}
		}
		else
		{
							
			$data = array(
				'page_title' => "Add Page Content",
				'page_view' => "administration/pages/pg-content-edit",
				'error' => $this->error,
				'row'=> $this->intialize_form(),
                'view_only' => true
				);
																					
			$this->load->view('administration/shared/master',$data);
		}	
	}		

	public function del($id = 0)
	{
		$this->verify_pk($id);
		
		$res = $this->db_model->delete_row("content",array('id'=>$id));
		
		if($res)
		{
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/content', 'location');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/content', 'location');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
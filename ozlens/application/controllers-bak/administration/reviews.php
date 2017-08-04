<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {

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
				'page_title' => "Reviews Management",
				'page_view' => "administration/pages/pg-reviews-view"
				);
														
		$this->load->view('administration/shared/master',$data);
	}
	
	public function grid()
	{
		$query = "SELECT
                  (SELECT
                    product_title
                  FROM
                    {PRE}products
                  WHERE id = {PRE}reviews.product_id) AS product_title,
                  nick_name,
                  rating,
                  Concat(LEFT(review , 55),'...') as review,
                  status,
                  DATE_FORMAT(date_posted, '%a, %M %d, %Y') AS date_posted,
                  id AS ed,
                  id AS dl
                FROM
                  {PRE}reviews";
		$data = $this->db_model->sql($query);		
		echo $this->gridmodel->output($data);
	}	
	
	
	private function intialize_form()
	{
		$values = (object) array(
                    'id' => '',
                    'product_id' => '',
                    'member_id'=>'',
                    'nick_name' =>'',
                    'rating' => '',
                    'review' => '',
                    'status'=>''
				);
										
		return $values;
	}	
	
	private function validate()
	{
		$this->load->library('form_validation');
        $this->form_validation->set_rules('member_id', '', '');

        $this->form_validation->set_rules('product_id','Product','required');
        $this->form_validation->set_rules('rating','Rating','required');
        $this->form_validation->set_rules('nick_name', 'Nick Name', 'required');
        $this->form_validation->set_rules('review', 'Review', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        return $this->form_validation->run();
	}
	
	private function verify_pk($id)
	{
		$res = $this->db_model->get_row('reviews',array('id'=>$id));
						
		if(!$res)
		{						
			$this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
			redirect(base_url().'administration/reviews', 'location');
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

			$where = array('id' => $id);	
				
			$res = $this->db_model->update_row('reviews',$vals,$where);
			
			if($res)
			{
				$this->session->set_flashdata('response', '<div class="success-box">Information has been modified.</div>');
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
		}
		else
		{
			$review_data = $this->db_model->get_row('reviews',array('id'=>$id));
		
			$data = array(
				'page_title' => "Edit Review",
				'page_view' => "administration/pages/pg-reviews-edit",
				'error' => $this->error,
				'row'=> $review_data
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
							
			$vals['date_posted'] = date('Y-m-d h:i:s');

			$ret_id = $this->db_model->insert_row_retid("reviews",$vals);
		
			if($ret_id>0)
			{
				$this->session->set_flashdata('response', '<div class="success-box">Information has been added.</div>');
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			else
			{
				$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
		}
		else
		{

			$data = array(
				'page_title' => "Add Review",
				'page_view' => "administration/pages/pg-reviews-edit",
				'error' => $this->error,
				'row'=> $this->intialize_form()
				);

			$this->load->view('administration/shared/master',$data);
		}
	}		

	public function del($id = 0)
	{
		$this->verify_pk($id);
		
		$res = $this->db_model->delete_row("reviews",array('id'=>$id));
		
		if($res)
		{
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/reviews', 'location');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/reviews', 'location');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
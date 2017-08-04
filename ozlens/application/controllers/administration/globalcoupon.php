<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class globalcoupon extends CI_Controller {

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
	 
	public function index($id = '')
	{
		$data['id'] = $id;
        if($this->input->post())
        {
            $vals = $this->input->post();
			unset($vals['btnSubmit']);
			//var_dump($vals); exit;
			
            if($id != '' && $id != 'add')
			{
				$this->db_model->update_row("global_coupon",$vals,array('id'=>$id));			
				$this->session->set_flashdata('response', '<div class="success-box">Globla Discount Coupon code has updated successfully.</div>');
				
			}
			else
			{
				if($this->input->post("title") && $this->input->post("code"))
        		{
					$this->db_model->insert_row("global_coupon",$vals);			
					$this->session->set_flashdata('response', '<div class="success-box">Globla Discount Coupon code has added successfully.</div>');
				}
			}
			
            redirect(base_url().'administration/globalcoupon','location');                        
        }
        else
        {		
		
			if($id != '' && $id != 'add')
			{
		  		$data["row"] = $this->db_model->get_row("global_coupon",array('id' => $id));	
			}
		
		  $data["page_view"] = "administration/pages/pg-global-coupon";
		  $this->load->view('administration/shared/master',$data);
		  
        }
	}
	
	public function grid()
	{
		$query = "SELECT title,code,discount_type,discount_val,start_date,end_date,status,id,id as id1 from {PRE}global_coupon";
		$data = $this->db_model->sql($query);		
		echo $this->gridmodel->output($data);
	}	
	
	public function del($id = 0)
	{
		
		
		$res = $this->db_model->delete_row("global_coupon",array('id'=>$id));
		
		if($res)
		{
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/globalcoupon', 'location');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/globalcoupon', 'location');
		}
	}

	
	private function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('code','Coupon Code','required');
        $this->form_validation->set_rules('discount_type','Discount Amount','required');
        $this->form_validation->set_rules('content', 'Email Content', 'required');
       
        return $this->form_validation->run();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
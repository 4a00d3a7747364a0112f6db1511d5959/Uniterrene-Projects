<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

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
        $data['page_title'] = "Orders Managment";
        $data['page_view'] = "administration/pages/pg-orders-view";

		$this->load->view('administration/shared/master',$data);
	}
   

    public function grid()
    {
        $query = "select id,b_full_name, order_amount,order_status, DATE_FORMAT(order_date, '%a, %M %d, %Y') as order_date, id as ed, id as dl  from {PRE}orders order by id desc";
		$data = $this->db_model->sql($query);		
		echo $this->gridmodel->output($data);
    }
	
	
	private function verify_pk($id)
	{
		$res = $this->db_model->get_row('orders',array('id'=>$id));
						
		if(!$res)
		{						
			$this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
			redirect(base_url().'administration/orders', 'refresh');
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
		
		if($this->input->post())
		{		
						
				
			unset($vals['btnSubmit']);			
			

			$where = array('id' => $id);	
			//var_dump($vals); exit;	
			$res = $this->db_model->update_row('orders',$vals,$where);
			
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
			$this->edit_view($id);
		}	
	
	}
	
	private function edit_view($id)
	{
		$order_data= $this->db_model->get_row('orders',array('id'=>$id));
		
		
		
			$data = array(
				'page_title' => "Order Detail",
				'page_view' => "administration/pages/pg-order-edit",
				'error' => $this->error,
				'row'=> $order_data
				);			
																					
		$this->load->view('administration/shared/master',$data);
	}
	
	
	public function print_invoice($id){
		
		$order_data= $this->db_model->get_row('orders',array('id'=>$id));
	
		$address = $this->db_model->get_rows("settings",array("module" => 'General','key'=>'address'));
		$address = $address[0];
		
		$data = array(
				'page_title' => "Order Detail",
				'row'=> $order_data,
				'address' =>$address->value
				);
		
		$this->load->view('administration/pages/pg-order-print',$data);
	}
	
	public function del($id = 0)
	{
		$this->verify_pk($id);
		
		$res = $this->db_model->delete_row("orders",array('id'=>$id));
		
		if($res)
		{
			$this->delete_relevant_data($id);
			
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/products', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/products', 'refresh');
		}
	}
	
	
	private function delete_relevant_data($order_id)
	{
		$this->db_model->delete_row('order_items',array('order_id'=>$order_id));
	}
	
	public function report()
	{       
        $data['page_title'] = "Report";
        $data['page_view'] = "administration/pages/pg-report";

		$data['mrows'] = $this->db_model->get_items_on_rent();
		//var_dump($data['mrows']);

		$this->load->view('administration/shared/master',$data);
	}  
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
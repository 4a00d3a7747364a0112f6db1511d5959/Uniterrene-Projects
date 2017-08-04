<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

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
        $data['page_title'] = "Products Management";
        $data['page_view'] = "administration/pages/pg-products-view";

		$this->load->view('administration/shared/master',$data);
	}
   

    public function grid()
    {
        //$query = "select product_title,slug,stock_no, featured,status, DATE_FORMAT(last_modified, '%a, %M %d, %Y') as date_modified, id as ed, id as dl,id as dupid  from {PRE}products order by id desc";
		$query = "select product_title,slug,stock_no,quantity,featured,status, DATE_FORMAT(last_modified, '%a, %M %d, %Y') as date_modified, id as ed, id as dl from {PRE}products order by id desc";
		$data = $this->db_model->sql($query);		
		echo $this->gridmodel->output($data);
    }
	
	public function updateQuantity($id){
		
		$data['page_title'] = "Update Product Quantity";
        $data['page_view'] = "administration/pages/pg-products-update-quantity";
		$p_data= $this->db_model->get_row('products',array('id'=>$id));
		$data['row'] = $p_data;
		$data['id'] = $id;		
		
		if($this->input->post()){
			
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
			
			if (!$this->form_validation->run() == FALSE) {
				
				$rs = $this->db_model->update_row('products',array('quantity'=>$this->input->post('quantity')),array('id'=>$id));
				
				if($rs){
					$this->session->set_flashdata('response','<div class="success-box" style="margin-bottom: 15px;">Product quantity updated successfully.</div>');
				}else{
					$this->session->set_flashdata('response','<div class="error-box" style="margin-bottom: 15px;">Unable to update product quantity.</div>');
				}
                redirect($this->config->item('base_url') . 'administration/products');	
			}
			
		}
		
		

		$this->load->view('administration/shared/master',$data);
	}

	private function intialize_form()
	{
		$values = (object) array(
                    'id' => '0',
                    'product_title' => '',
                    'slug'=>'',
                    'postage_amount' => '',
                    'status'=>'',
					'overview' =>'',
					'includes' =>'',
					'cat_id[]' =>'',
					'default_rental_days'=>'',
					'r_price_per_day' =>'',
					'w_price_per_day' =>'',
					'featured' =>''
				);

		return $values;
	}	
	
	private function validate()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('includes','','');
		
        $this->form_validation->set_rules('overview','Over view','required');		
		$this->form_validation->set_rules('cat_id[]','Category','required');
		$this->form_validation->set_rules('product_title','Product Title','required');
		$this->form_validation->set_rules('slug','Slug','required');    
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('featured', 'Fetured', 'required');
		$this->form_validation->set_rules('default_rental_days', 'Default Rental Days', 'required');
		$this->form_validation->set_rules('r_price_per_day', 'Rental Price Per Day', 'required');
		$this->form_validation->set_rules('w_price_per_day', 'Waiver Price Per Day', 'required');
		$this->form_validation->set_rules('waiver_price[]', 'Waiver Price', 'required');
		$this->form_validation->set_rules('rental_period[]', 'Rental Period', 'required');
		$this->form_validation->set_rules('rental_price[]', 'Rental Price', 'required');
        return $this->form_validation->run();
	}
	
	private function verify_pk($id)
	{
		$res = $this->db_model->get_row('products',array('id'=>$id));
						
		if(!$res)
		{						
			$this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
			redirect(base_url().'administration/products/add', 'location');
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
			$this->update_additional_fields();
			
			if($this->validate())
			{					
				
				unset($vals['chk'],$vals['s_product_id'],$vals['btnSubmit'],$vals['cat_id'],$vals['tab_id'],$vals['rental_price'],$vals['waiver_price'],$vals['rental_period'],$vals['yni_r_product_id'],$vals['yni_caption'],$vals['www_r_product_id'],$vals['www_caption'],$vals['specs_text'],$vals['specs_caption']);
				
							
				$vals['last_modified'] = date('Y-m-d h:i:s');
	
				$where = array('id' => $id);	
					
				$res = $this->db_model->update_row('products',$vals,$where);
				
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
				$this->edit_view($id);
			}
		}
		else
		{
			$this->edit_view($id);
		}	
	
	}
	
	
	public function duplicate($id){
		
		$products = get_object_vars($this->db_model->get_row('products',array('id'=>$id)));
		unset($products['id']);
		
		$this->db_model->insert_row('products',$products);
		
		$product_id = $this->db->insert_id();
	
		$product_www = $this->db_model->get_rows('product_www',array('product_id'=>$id));
	
		foreach($product_www as $product_www_data){
			$data = get_object_vars($product_www_data);
			unset($data['id']);
			$data['product_id'] = $product_id;
			$this->db_model->insert_row('product_www',$data);
		}
		
		$product_specs = $this->db_model->get_rows('product_specs',array('product_id'=>$id));
		
		foreach($product_specs as $product_specs_data){
			$data = get_object_vars($product_specs_data);
			unset($data['id']);
			$data['product_id'] = $product_id;
			$this->db_model->insert_row('product_specs',$data);
		}
		
		$product_resources = $this->db_model->get_rows('product_resources',array('product_id'=>$id));
		
		foreach($product_resources as $product_resources_data){
			$data = get_object_vars($product_resources_data);
			unset($data['id']);
			$data['product_id'] = $product_id;
			$this->db_model->insert_row('product_resources',$data);
		}
		
		$product_pricing = $this->db_model->get_rows('product_pricing',array('product_id'=>$id));
		
		foreach($product_pricing as $product_pricing_data){
			$data = get_object_vars($product_pricing_data);
			unset($data['id']);
			$data['product_id'] = $product_id;
			$this->db_model->insert_row('product_pricing',$data);
		}
		
		
		$product_photos = $this->db_model->get_rows('product_photos',array('product_id'=>$id));
		
		foreach($product_photos as $product_photos_data){
			$data = get_object_vars($product_photos_data);
			unset($data['id']);
			$data['product_id'] = $product_id;
			$this->db_model->insert_row('product_photos',$data);
		}
		
		
		
		$product_cats = $this->db_model->get_rows('product_cats',array('product_id'=>$id));
		
		foreach($product_cats as $product_cats_data){
			$data = get_object_vars($product_cats_data);
			unset($data['id']);
			$data['product_id'] = $product_id;
			$this->db_model->insert_row('product_cats',$data);
		}
		
		
		$this->session->set_flashdata('response', '<div class="success-box">Product duplicated successfully.</div>');
		redirect($_SERVER['HTTP_REFERER'],'location');
	}
	
	private function edit_view($id)
	{
		$p_data= $this->db_model->get_row('products',array('id'=>$id));
		
			$data = array(
				'page_title' => "Edit Product",
				'page_view' => "administration/pages/pg-products-edit",
				'error' => $this->error,
				'row'=> $p_data
				);			
			
																					
			$this->load->view('administration/shared/master',$data);
	}
	
	public function add()
	{
		$vals = $this->input->post();	
		
		
		if($this->input->post())
		{	
			$this->update_additional_fields();
			
			if($this->validate())
			{		
					
				unset($vals['chk'],$vals['s_product_id'],$vals['btnSubmit'],$vals['cat_id'],$vals['tab_id'],$vals['rental_price'],$vals['waiver_price'],$vals['rental_period'],$vals['yni_r_product_id'],$vals['yni_caption'],$vals['www_r_product_id'],$vals['www_caption'],$vals['specs_text'],$vals['specs_caption']);
												
				$vals['last_modified'] = date('Y-m-d h:i:s');
	
				$ret_id = $this->db_model->insert_row_retid("products",$vals);
			
				if($ret_id>0)
				{
					$this->update_product_id($ret_id);
					
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
				$this->add_view();	
			}
		}
		else
		{
			$this->add_view();			
			
		}	
	}		
	
	private function add_view()
	{
		
		$data = array(
				'page_title' => "Add Product",
				'page_view' => "administration/pages/pg-products-edit",
				'error' => $this->error,
				'row'=> $this->intialize_form()
				);				
																									
		$this->load->view('administration/shared/master',$data);
	}
	

	public function del($id = 0)
	{
		$this->verify_pk($id);
		
		$res = $this->db_model->delete_row("products",array('id'=>$id));
		
		if($res)
		{
			$this->delete_relevant_data($id);
			
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/products', 'location');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/products', 'location');
		}
	}	
	
	private function delete_relevant_data($product_id)
	{
		$this->db_model->delete_row('product_specs',array('product_id'=>$product_id));	
		$this->db_model->delete_row('product_www',array('product_id'=>$product_id));	
		$this->db_model->delete_row('product_you_need_it',array('product_id'=>$product_id));	
		$this->db_model->delete_row('product_pricing',array('product_id'=>$product_id));	
		$this->db_model->delete_row('product_resources',array('product_id'=>$product_id));	
		$this->db_model->delete_row('product_photos',array('product_id'=>$product_id));
	}  
	
	
	private function update_product_id($product_id)
	{
		$this->db_model->update_row('product_specs',array('product_id'=>$product_id),array('product_id'=>0));	
		$this->db_model->update_row('product_www',array('product_id'=>$product_id),array('product_id'=>0));	
		$this->db_model->update_row('product_you_need_it',array('product_id'=>$product_id),array('product_id'=>0));	
		$this->db_model->update_row('product_pricing',array('product_id'=>$product_id),array('product_id'=>0));	
		$this->db_model->update_row('product_resources',array('product_id'=>$product_id),array('product_id'=>0));	
		$this->db_model->update_row('product_photos',array('product_id'=>$product_id),array('product_id'=>0));		
		$this->db_model->update_row('product_cats',array('product_id'=>$product_id),array('product_id'=>0));	
	}
	
	private function update_additional_fields()
	{
		$this->product_specs();
		$this->product_works_well_with();
		$this->product_in_case_you_need_it();
		$this->product_pricing();		
		$this->product_categories();
	}
	
	
	private function product_specs()
	{
		$req = $this->input->post();	
		
		$this->db_model->delete_row('product_specs',array('product_id'=>$req['id']));
	
		for($i=0;$i<sizeof($req['specs_text']);$i++)
		{
			if($req['specs_text'][$i] != "" && $req['specs_caption'][$i] != "")
			{
				$idata = array('product_id'=>$req['id'],'specs_caption'=>$req['specs_caption'][$i],'specs_text'=>$req['specs_text'][$i]);		
				$this->db_model->insert_row('product_specs',$idata);
			}	
		}		
	}
	
	private function product_works_well_with()
	{
		$req = $this->input->post();	
		
		$this->db_model->delete_row('product_www',array('product_id'=>$req['id']));
	
		for($i=0;$i<sizeof($req['www_r_product_id']);$i++)
		{
			if($req['www_r_product_id'][$i] != "")
			{
				$idata = array('product_id'=>$req['id'],'www_caption'=>$req['www_caption'][$i],'www_r_product_id'=>$req['www_r_product_id'][$i]);		
				$this->db_model->insert_row('product_www',$idata);
			}	
		}		
	}
	
	private function product_in_case_you_need_it()
	{
		$req = $this->input->post();	
		
		$this->db_model->delete_row('product_you_need_it',array('product_id'=>$req['id']));
	
		for($i=0;$i<sizeof($req['yni_r_product_id']);$i++)
		{
			if($req['yni_r_product_id'][$i] != "")
			{
				$idata = array('product_id'=>$req['id'],'yni_caption'=>$req['yni_caption'][$i],'yni_r_product_id'=>$req['yni_r_product_id'][$i]);		
				$this->db_model->insert_row('product_you_need_it',$idata);
			}	
		}		
	}
	
	private function product_pricing()
	{
		$req = $this->input->post();	
		
		$this->db_model->delete_row('product_pricing',array('product_id'=>$req['id']));
	
		for($i=0;$i<sizeof($req['rental_period']);$i++)
		{
			if($req['rental_period'][$i] != "" && $req['waiver_price'][$i] != "" && $req['rental_price'][$i] != "")
			{
				$idata = array('product_id'=>$req['id'],'rental_period'=>$req['rental_period'][$i],'waiver_price'=>$req['waiver_price'][$i],'rental_price'=>$req['rental_price'][$i]);		
				$this->db_model->insert_row('product_pricing',$idata);
			}	
		}		
	}
	
	private function product_categories()
	{
		$req = $this->input->post();
		
		$this->db_model->delete_row('product_cats',array('product_id'=>$req['id']));
		
		if(isset($req['cat_id']))
		{
		
			for($i=0;$i<sizeof($req['cat_id']);$i++)
			{
				if($req['cat_id'][$i] != "")
				{
					$idata = array('product_id'=>$req['id'],'cat_id'=>$req['cat_id'][$i]);		
					$this->db_model->insert_row('product_cats',$idata);
				}	
			}		
		}
	}
	
	
	/*Product Resources Functions start*/
	public function resources_iframe($product_id)
	{
		if($this->input->get('resource_id'))
		{
			$data['resource_data'] = $this->db_model->get_row('product_resources',array('id'=>$this->input->get('resource_id')));
		}
		
		$data["resources"] = $this->db_model->sql("select * from {PRE}product_resources where product_id = '".$product_id."' order by id desc");
		$data["error"] = $this->error;
		$data['product_id'] = $product_id;
		$this->load->view('administration/tabs/resources',$data);
	}
	
	
	public function resources_upload($field = 'pr_file_name')
	{
		$product_id = $this->input->post('product_id');		
		
		$path = './uploads/resources/';
		$config['upload_path'] = $path;
		$config['allowed_types'] = $this->config->item('file_types');
		$config['max_size']	= $this->config->item('max_size');
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if($this->input->get('resource_id'))
		{
			if($_FILES[$field]['name']!="")
			{
				
				if ( ! $this->upload->do_upload($field))
				{
					
					$this->error = $this->upload->display_errors('', '<br/>');
					$this->resources_iframe($product_id);					
					die($this->output->get_output());									
				}
				
				else
				{								
					$data = $this->upload->data();
					$vals['pr_file_name'] = $data['file_name'];						
				}			
			}
			
			$vals['pr_caption'] = $this->input->post('pr_caption');
				
			$this->db_model->update_row('product_resources',$vals,array('id'=>$this->input->get('resource_id')));
			
			$this->session->set_flashdata('response', 'Information has been updated.');
		}
		else
		{

			if ( ! $this->upload->do_upload($field))
			{
				$this->error = $this->upload->display_errors('', '<br/>');
				$this->resources_iframe($product_id);
				die($this->output->get_output());									
			}
			else
			{						
				$data = $this->upload->data();
				//$this->image_moo->load($path.$data['file_name']."")->resize("800","640")->save_pa($prepend="", $append="", $overwrite=FALSE);
				
				$vals = array('pr_caption'=>$this->input->post('pr_caption'),'pr_file_name'=>$data['file_name'],'product_id'=>$product_id);
				$this->db_model->insert_row_retid('product_resources',$vals);
				
				$this->session->set_flashdata('response', 'Information has been saved.');
				
			}
		}
		
		redirect(base_url().'administration/products/resources_iframe/'.$product_id, 'location');
	}	
	
	public function del_resource()
	{
		$resource_id = $this->input->post('resourceId');
			
		$is_exist = $this->db_model->get_row('product_resources',array('id'=>$resource_id));
		
		if($is_exist)
		{
			$this->db_model->delete_row("product_resources",array('id'=>$resource_id));
			$this->session->set_flashdata('response', 'Selected record has been deleted.');
			redirect($_SERVER['HTTP_REFERER'], 'location');
		}
		else
		{			
			$this->session->set_flashdata('response', 'Request can not be processed at the moment, please try again later.');
			redirect($_SERVER['HTTP_REFERER'], 'location');
		}
		
	}
	
	/*Product Resources Functions end*/	
	
	/*Product Gallery functions start*/
	
	public function gallery_iframe($product_id)
	{
		if($this->input->get('image_id'))
		{
			$data['image_data'] = $this->db_model->get_row('product_photos',array('id'=>$this->input->get('image_id')));
		}
		
		$data["images"] = $this->db_model->sql("select * from {PRE}product_photos where product_id = '".$product_id."' order by id desc");
		$data["error"] = $this->error;
		$data['product_id'] = $product_id;
		$this->load->view('administration/tabs/photo-gallery',$data);
	}
	
	
	public function get_image($img_name="",$width="",$height="")
    {
        if($img_name == "" || $width <=0 || $height <=0)
        {
            exit;
        }
        else
        {
            $img_name = str_replace("%20"," ",$img_name);
            $img = "./uploads/images/product/".$img_name."";
            $this->image_moo->load($img)->resize($width,$height)->save_dynamic();
            if ($this->image_moo->errors) print $this->image_moo->display_errors();
        }
    }	
	
	public function gallery_upload($field = 'photo_image')
	{
		$product_id = $this->input->post('product_id');		
		
		$path = './uploads/images/product/';
		$config['upload_path'] = $path;
		$config['allowed_types'] = $this->config->item('image_types');
		$config['max_size']	= $this->config->item('max_size');
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if($this->input->get('image_id'))
		{
			if($_FILES[$field]['name']!="")
			{
				
				if ( ! $this->upload->do_upload($field))
				{
					
					$this->error = $this->upload->display_errors('', '<br/>');
					$this->gallery_iframe($product_id);					
					die($this->output->get_output());									
				}
				
				else
				{								
					$data = $this->upload->data();
					$vals['photo_image'] = $data['file_name'];						
				}			
			}
			
			$vals['photo_caption'] = $this->input->post('photo_caption');
			
			$is_featured = $this->input->post('is_featured');
			
			if($is_featured == 'Yes')
			{
				$this->db_model->update_row('product_photos',array('is_featured'=>'No'),array('product_id'=>$product_id));
			}
			
			$vals['is_featured'] = $is_featured;
				
			$this->db_model->update_row('product_photos',$vals,array('id'=>$this->input->get('image_id')));
			
			$this->session->set_flashdata('response', 'Information has been updated.');
		}
		else
		{

			if ( ! $this->upload->do_upload($field))
			{
				$this->error = $this->upload->display_errors('', '<br/>');
				$this->gallery_iframe($product_id);
				die($this->output->get_output());									
			}
			else
			{						
				$data = $this->upload->data();
				//$this->image_moo->load($path.$data['file_name']."")->resize("800","640")->save_pa($prepend="", $append="", $overwrite=FALSE);
				
			$is_featured = $this->input->post('is_featured');
			
			if($is_featured == 'Yes')
			{
				$this->db_model->update_row('product_photos',array('is_featured'=>'No'),array('product_id'=>$product_id));
			}				
				
			$vals = array('photo_caption'=>$this->input->post('photo_caption'),'photo_image'=>$data['file_name'],'product_id'=>$product_id);
			
			$vals['is_featured'] = $is_featured;
			
			$this->db_model->insert_row_retid('product_photos',$vals);
			
			$this->session->set_flashdata('response', 'Image has been uploaded.');
				
			}
		}
		
		redirect(base_url().'administration/products/gallery_iframe/'.$product_id, 'location');
	}	
	
	public function del_image()
	{
		$id = $this->input->post('delimage');
		
		$is_exist = $this->db_model->get_row('product_photos',array('id'=>$id));
		
		if($is_exist)
		{
			$this->db_model->delete_row("product_photos",array('id'=>$id));
			$this->session->set_flashdata('response', 'Selected image has been deleted.');
			redirect($_SERVER['HTTP_REFERER'], 'location');
		}
		else
		{			
			$this->session->set_flashdata('response', 'Request can not be processed at the moment, please try again later.');
			redirect($_SERVER['HTTP_REFERER'], 'location');
		}
		
	}
	
	/*Product Gallery functions end*/

    public function copy_product_prices()
    {
        $data['s_product_id'] = $this->input->post('s_product_id');
        $this->load->view('administration/tabs/pricing_ajax',$data);
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

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
        $cats = $this->db_model->get_rows('categories',array('p_id'=>0));

        if($this->input->get())
        {
            $data['p_id'] = $this->input->get('p_id');
        }
        else
        {
            //$data['p_id'] = $cats[0]->id;
            $data['p_id'] = 0;
        }

        $data['cats'] = $cats;
        $data['page_title'] = "Categories Managment";
        $data['page_view'] = "administration/pages/pg-categories-view";

		$this->load->view('administration/shared/master',$data);
	}

	private function intialize_form()
	{
		$values = (object) array(
                    'id' => '0',
                    'cat_name' => '',
                    'slug'=>'',
                    'status'=>'',
					'description' =>'',
					'p_id[]'=>''
				);

		return $values;
	}	
	
	private function validate()
	{
		$this->load->library('form_validation');
        
		$this->form_validation->set_rules('p_id[]','Parent','required');
		$this->form_validation->set_rules('cat_name','Category Name','required');
		$this->form_validation->set_rules('slug','Slug','required');
    	$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('status', 'Status', 'required');
        return $this->form_validation->run();
	}
	
	private function verify_pk($id)
	{
		$res = $this->db_model->get_row('categories',array('id'=>$id));
						
		if(!$res)
		{						
			$this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
			redirect(base_url().'administration/categories/add', 'refresh');
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
			$p_id = $this->set_pid();
			
			unset($vals['btnSubmit'],$vals['p_id']);
			
			$vals['p_id'] = $p_id;
			
			$vals['last_modified'] = date('Y-m-d h:i:s');

			$where = array('id' => $id);	
				
			$res = $this->db_model->update_row('categories',$vals,$where);
			
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
			$categories_data= $this->db_model->get_row('categories',array('id'=>$id));
		
			$data = array(
				'page_title' => "Edit Category",
				'page_view' => "administration/pages/pg-categories-edit",
				'error' => $this->error,
				'row'=> $categories_data
				);
				
			if($this->input->post('p_id'))
			{
				$data['p_id'] = $this->set_pid();
				$data['inc_cat_id'] = TRUE;
			}	
			else
			{	
				
				$data['p_id'] = $categories_data->id;	
				$data['inc_cat_id'] = FALSE;
			}
																					
			$this->load->view('administration/shared/master',$data);
		}	
	
	}
	
	public function add()
	{
		$vals = $this->input->post();		

		if($this->input->post() && $this->validate())
		{				
		 	$p_id = $this->set_pid();	
			
			unset($vals['btnSubmit'],$vals['p_id']);
			
			$vals['p_id'] = $p_id;
										
			$vals['last_modified'] = date('Y-m-d h:i:s');

            $ret_id = $this->db_model->insert_row_retid("categories",$vals);
		
			if($ret_id>0)
			{
				$this->db_model->update_row('cat_images',array('cat_id'=>$ret_id),array('cat_id'=>0));
				
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
			$this->add_view();			
			
		}	
	}		
	
	private function add_view()
	{
		
		$data = array(
				'page_title' => "Add Category",
				'page_view' => "administration/pages/pg-categories-edit",
				'error' => $this->error,
				'row'=> $this->intialize_form()
				);
				
		if($this->input->post('p_id'))
		{
			$data['p_id'] = $this->set_pid();
			$data['inc_cat_id'] = TRUE;
		}
		else
		{
			$data['inc_cat_id'] = FALSE;
		}
				
																									
		$this->load->view('administration/shared/master',$data);
	}
	

	public function del($id = 0)
	{
		$this->verify_pk($id);
		
		$res = $this->db_model->delete_row("categories",array('id'=>$id));
		
		if($res)
		{
			$this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
			redirect(base_url().'administration/categories', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
			redirect(base_url().'administration/categories', 'refresh');
		}
	}
	
	public function get_chid_categories()
	{
		if($this->input->post('parent_id'))
		{
			$p_id = $this->input->post('parent_id');			
			$cats = $this->db_model->get_rows('categories',array('p_id'=>$p_id));
			if($cats)
			{
				?>
                <select name="p_id[]" id="p_id" class="parent required"  style="float:left; margin-right:5px;">
				<option value="0" selected="selected">-- Parent --</option>
                <?PHP			
				foreach($cats as $cat)
				{
					?>
                    <option value="<?php echo $cat->id;?>"><?php echo $cat->cat_name;?></option>
                    <?PHP	
				}
				?>
                </select>
                <?PHP
			}
			else
			{
				echo '<label style="padding:7px;float:left; font-size:12px;">End of list !</label>';
			}
		}	
		
	}
	
	private function set_pid()
	{
		$p_ids = $this->input->post('p_id');	
		
		if(sizeof($p_ids)>1)
		{
			if($p_ids[sizeof($p_ids)-1] == 0)
			{
				$p_id = $p_ids[sizeof($p_ids)-2];
			}
			else
			{
				$p_id = $p_ids[sizeof($p_ids)-1];
			}
		}
		else
		{
			$p_id = $p_ids[sizeof($p_ids)-1];
		}

		return $p_id;
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
            $img = "./uploads/images/category/".$img_name."";
            $this->image_moo->load($img)->resize_crop($width,$height)->round(5)->save_dynamic();
            if ($this->image_moo->errors) print $this->image_moo->display_errors();
        }
    }
	
	
	public function cat_images($cat_id = 0)
	{
		$data["images"] = $this->db_model->sql("select * from {PRE}cat_images where cat_id = '".$cat_id."' order by id desc");
		$data["error"] = $this->error;
		$data["cat_id"] = $cat_id;
		$this->load->view('administration/pages/pg-cat-images',$data);	
	}
	
	public function gallery_upload($field = 'img')
	{
		$cat_id = $this->input->post('cat_id');		
		
		$path = './uploads/images/category/';
		$config['upload_path'] = $path;
		$config['allowed_types'] = $this->config->item('image_types');
		$config['max_size']	= $this->config->item('max_size');
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload($field))
		{
			$this->error = $this->upload->display_errors('', '<br/>');
			$this->cat_images($cat_id);
			//die($this->output->get_output());									
		}
		else
		{						
			$data = $this->upload->data();
			//$this->image_moo->load($path.$data['file_name']."")->resize("800","640")->save_pa($prepend="", $append="", $overwrite=FALSE);
			
			$vals = array('image'=>$data['file_name'],'cat_id'=>$cat_id,'last_modified'=>date('Y-m-d h:i:s'));
			$this->db_model->insert_row_retid('cat_images',$vals);
			
			$this->session->set_flashdata('response', 'Image has been uploaded.');
			redirect(base_url().'administration/categories/cat_images/'.$cat_id, 'refresh');
		}
	}	
	
	public function del_image()
	{
		$id = $this->input->post('delimage');
		
		$is_exist = $this->db_model->get_row('cat_images',array('id'=>$id));
		
		if($is_exist)
		{
			$this->db_model->delete_row("cat_images",array('id'=>$id));
			$this->session->set_flashdata('response', 'Selected image has been deleted.');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
		else
		{			
			$this->session->set_flashdata('response', 'Request can not be processed at the moment, please try again later.');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
		
	}

   public function update_order()
   {
      //print_r($this->input->post('dta'));

       $dta = $this->input->post('dta');

       $this->db_model->update_row('categories',array('sort_id'=>0),array('id <>'=>0));

       for($i=1;$i<sizeof($dta);$i++)
       {
           $item_id =  $dta[$i]['item_id'];
           $parent_id =  $dta[$i]['parent_id'];
           $sort_id = $i;

           $this->db_model->update_row('categories',array('sort_id'=>$sort_id,'p_id'=>$parent_id,'last_modified'=>date('Y-m-d h:i:s')),array('id'=>$item_id));
       }

       echo 'The information has been updated.';
   }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
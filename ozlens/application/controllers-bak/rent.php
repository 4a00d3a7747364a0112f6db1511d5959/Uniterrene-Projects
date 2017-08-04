<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rent extends CI_Controller {

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
        // Your own constructor code
    }

    public function index()
    {
        redirect(base_url(),'refresh');
    }

    public function products()
	{
		//echo $this->uri->uri_string();


		if($this->input->post())
		{
			$data['page_title'] = "SEARCH RESULTS";
			$products = $this->db_model->get_rows('products',array('product_title like'=>'%'.$this->input->post('q').'%'));
		}
		else
		{	
		
			$uri = explode('/',str_replace('rent/products/','',$this->uri->uri_string()));

            $cat_id = (int)$this->encryption->decode($uri[sizeof($uri)-1]);
            

			/*for($i=0;$i<sizeof($uri);$i++)
			{
				if($i==0)
				{
					
					$p_id[] = $this->db_model->get_row('categories',array('slug'=>$uri[$i]))->id;		
						
				}
				else
				{				
				
					$p_id[] = $this->db_model->get_row('categories',array('slug'=>$uri[$i],'p_id'=>$p_id[$i-1]))->id;	
					
				}	
				
			}		*/
			
			$data['page_title'] = "PRODUCTS";
			
			$data['selected_cat_id'] = $cat_id; // used in web/includes/categories
			
			$query = "SELECT * FROM ozl_products WHERE ozl_products.status = 'Enabled' AND ozl_products.id IN (SELECT product_id FROM ozl_product_cats WHERE cat_id=".$cat_id.")";
			
			$products = $this->db_model->sql($query);
			
			//$products = $this->db_model->get_rows('products',array('cat_id'=>$p_id[sizeof($p_id)-1]));	
		}
		
		$data['page_view'] = "web/pages/pg-products";
		$data['products'] = $products;
	
		$this->load->view('web/shared/master',$data);	
		
	
	}
	
	public function detail()
	{

       if($this->input->post())
       {
           $this->load->library('form_validation');

           $this->form_validation->set_rules('nick_name', 'Nick Name', 'required');
           $this->form_validation->set_rules('rating', 'Rating', 'required');
           $this->form_validation->set_rules('review', 'Review', 'required');

           if ($this->form_validation->run() == FALSE)
           {
               $this->detail_view();
           }
           else
           {
               $vals = $this->input->post();

               $vals['date_posted'] = date('Y-m-d h:i:s');
               $vals['status'] = 'Approved';

               $ret_id =  $this->db_model->insert_row_retid('reviews',$vals);

               if($ret_id>0)
               {
                   $this->session->set_flashdata('response', '<div class="success-box">Your review has been posted.</div>');
                   redirect($_SERVER['HTTP_REFERER'],'location');
               }
               else
               {
                   $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
                   redirect($_SERVER['HTTP_REFERER'],'location');
               }
           }
       }
       else
       {
            $this->detail_view();
       }
	}

    public function detail_view()
    {
        $uri = explode('/',str_replace('rent/detail/','',$this->uri->uri_string()));
        if(sizeof($uri)>1)
        {
            $cat_id = (int)$this->encryption->decode($uri[sizeof($uri)-2]);
            $data['selected_cat_id'] = $cat_id; // used in web/includes/categories
        }

        /*if(sizeof($uri)>1)
        {

            for($i=0;$i<sizeof($uri)-2;$i++)
            {
                if($i==0)
                {

                    $p_id[] = $this->db_model->get_row('categories',array('slug'=>$uri[$i]))->id;

                }
                else
                {

                    $p_id[] = $this->db_model->get_row('categories',array('slug'=>$uri[$i],'p_id'=>$p_id[$i-1]))->id;

                }

            }



        }*/

        $slug = $uri[sizeof($uri)-1];

        $product = $this->db_model->get_row('products',array('slug'=>$slug));

        if($product)
        {
            $data['page_view'] = "web/pages/pg-product-detail";

            $data['product'] = $product;

            $this->load->view('web/shared/master',$data);
        }
        else
        {
            $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
            redirect(base_url(),'location');
        }
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
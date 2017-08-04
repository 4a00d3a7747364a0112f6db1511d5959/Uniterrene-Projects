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
			
			//echo $cat_id;
			//echo $this->get_cat_tree($cat_id); 
			$data['page_title'] = $this->get_cat_tree($cat_id); 
			//$this->db_model->get_row('categories',array('id'=>$cat_id))->cat_name;//"PRODUCTS";
			
			
			//'SELECT sc.`cat_name` AS subcategory, c.`cat_name` AS category FROM ozl_categories sc LEFT JOIN ozl_categories c ON c.id = sc.`p_id` WHERE sc.id = 36 ';
			
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

           if ($this->form_validation->run() == FALSE){
               $this->detail_view();
           }
           else{
               $vals = $this->input->post();

               $vals['date_posted'] = date('Y-m-d h:i:s');
               $vals['status'] = 'Approved';

               $ret_id =  $this->db_model->insert_row_retid('reviews',$vals);

               if($ret_id>0){
                   $this->session->set_flashdata('response', '<div class="success-box">Your review has been posted.</div>');
                   redirect($_SERVER['HTTP_REFERER'],'location');
               }else{
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
			//var_dump( $this->helper_model->check_qty($product->id)); exit;
			//var_dump($product->id); exit;
			
			$pqty = $this->helper_model->check_qty($product->id);
			
			$data["is_available"] = "1";
			
			if($pqty >= $product->quantity)
			{
				$data["is_available"] = "0";
			}
			
			
			
			
            $data['page_view'] = "web/pages/pg-product-detail";

            $data['product'] = $product;
			
			 $data['product_metas'] =  $product->metas;

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
	
	 public function inquiry($product_id)
    {  
		
		 $this->form_validation->set_rules('name', 'Name', 'required');
         $this->form_validation->set_rules('email', 'Email', 'required');
         $this->form_validation->set_rules('message', 'Message', 'required');
		   
		   if (!$this->form_validation->run() == FALSE)
			 {
				$req = $this->input->post() ;
				
				$idata = array('fname'=>$req['name'],'product_id'=>$product_id,
				'email'=>$req['email'],'question'=>$req['message'],'dated'=>date('Y-m-d h:i:s'));
		
				$effected = $this->db_model->insert_row_retid('inquiries',$idata);
										
			 
				
				$product = $this->db_model->get_row('products',array('id'=>$product_id)); 	
				
				$to = $this->db_model->get_admin_email();

			//$email_temp = $this->db_model->get_row('email_templates',array('id'=>5));

			$subject = "Inquiry about ". $product->product_title;

			$body .= '<p>Name: '.$req['name'].'</p>';
			
			$body .= '<p>Email: '.$req['email'].'</p>';
			
			$body .= '<p>Message: '.$req['message'].'</p>';

			$this->load->library('email');
			
			$config['mailtype'] = "html";	

			$config['charset'] = 'iso-8859-1';	

			$this->email->initialize($config);
			
			$sender_email = 'service@ozlensrental.com.au';
			$sender_name = 'OZlense Rental';
			$this->email->from($sender_email, $sender_name);

			$this->email->to($to);

			$this->email->subject($subject);

			$this->email->message($body);

			$this->email->send();

       
            $this->session->set_flashdata('response', '<div class="success-box">Inquiry has been sent successfully.</div>');
            redirect(base_url().'rent/inquiry/'.$product_id,'location');
       
			 }
		
		 	$data['page_view'] = "web/pages/pg-inquiry";

            $data['product_id'] = $product_id;

            $this->load->view('web/shared/master',$data);
    }
	
	public function get_cat_tree($cat_id,$title = '')
	{
		
		$cat = $this->db_model->get_row('categories',array('id'=>$cat_id));
		$title = $cat->cat_name.$title;
		//echo   "cat id = ".$cat_id."parent id = ".$cat->p_id." - title = ".$title."<br/>";
		if($cat->p_id != 0)
		{
			$title =  " <font color='#C40F19'><strong>>></strong></font> ".$title;
			$title = $this->get_cat_tree($cat->p_id,$title);
			return  $title;
			//echo  "<br/> test";
		}
		else
		{
			///echo  $title;
			return  $title;
			
		}
		
		
	}
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
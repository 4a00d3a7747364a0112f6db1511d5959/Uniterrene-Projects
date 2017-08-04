<?php 

class Product_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	function gen_product_url($id)
	{
		$slug = $this->db_model->get_row('products',array('id'=>$id))->slug;
		
		$uri = str_replace('rent/products/','rent/detail/',$this->uri->uri_string());
		
		if (strpos($uri,'rent/detail/') !== false) 
		{
			return base_url()."rent/detail/".$uri."/".$slug;
		}
		else
		{
			return base_url()."rent/detail/".$slug;	
		}	
				
	}
	
	
	
	function _gen_product_url($id)
	{		
		$p_data = $this->db_model->get_row('products',array('id'=>$id));
		
		if($p_data)
		{
			$categories = $this->categories_model->get_parent_cat_ids_array($p_data->cat_id,FALSE,TRUE);
			
			if($categories)
			{
				
				
				$uri = base_url()."rent/detail/";
				
				foreach($categories as $cat_id)
				{			
					
					$cat_data = $this->db_model->get_row('categories',array('id'=>$cat_id));			
					
						
					$uri.= $cat_data->slug."/";
				}				
				
			}
		}
		
		$uri.= $p_data->slug;
		
		return $uri;	
		
	} 
	
	
	
	
	

}

?>
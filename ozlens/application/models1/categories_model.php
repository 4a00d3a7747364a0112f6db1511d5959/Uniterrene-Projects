<?php 

class Categories_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_parent_cat_ids_array($cat_id = 0,$zero_index = TRUE,$inc_cat_id = FALSE)
	{
			$query = "SELECT T2.id
						FROM (
						 SELECT
						 @r AS _id,
						 (SELECT @r := p_id FROM {PRE}categories WHERE id = _id) AS p_id,
						 @l := @l + 1 AS lvl
						 FROM
						 (SELECT @r := '".$cat_id."', @l := 0) vars,
						 {PRE}categories m
						 WHERE @r <> 0) T1
						JOIN {PRE}categories T2
						ON T1._id = T2.id
						ORDER BY T1.lvl DESC;";	
						
			$result = $this->db_model->sql($query);
			
			$parent_ids = array();
			
			if($zero_index == TRUE)
			{			
				$parent_ids[] = 0;
			}
			
			if($inc_cat_id == true)
			{
				foreach($result as $res)
				{				
					$parent_ids[]= $res->id;				
				}	
			}
			else
			{
				foreach($result as $res)
				{
					if($cat_id != $res->id)
					{									
						$parent_ids[]= $res->id;				
					}
				}	
			}
			
			return $parent_ids;
	}

    function hasChild($parent_id)
    {
        $sql = "SELECT COUNT(*) as count FROM {PRE}categories WHERE p_id = ' " . $parent_id . " ' ";
        $result = $this->db_model->sql($sql);
        return $result[0]->count;

    }
	
	function generate_url($cat_id)
	{
		$p_id_arr = $this->get_parent_cat_ids_array($cat_id,'',true);
		
		$url = base_url().'rent/products/';

        $url= str_replace("/blog","",$url);

        $i=0;



        foreach($p_id_arr as $p_id)
		{
			$res = $this->db_model->get_row('categories',array('id'=>$p_id));
			$url .= $res->slug;
            if($i<sizeof($p_id_arr)-1)
            {
                $url .= "/";
               $i++;
            }
		}
        $secure = $this->encryption->encode($cat_id);
        $url .="/".$secure;
		
		return $url;
	}





    function CategoryTree($list,$parent,$append,$selected_cat_id)
    {
       
	   $query = "SELECT COUNT(*) as product_count FROM ozl_products WHERE ozl_products.status = 'Enabled' AND ozl_products.id IN (SELECT product_id FROM ozl_product_cats WHERE cat_id=".$parent->id.")";
	   
	   $res = $this->db_model->sql($query);  
	  
	   
	   $p_count = "";
	
		if($res[0]->product_count > 0)
		{
		
			$p_count = "(".$res[0]->product_count.")";
		}
	   
	   $selected_cat = "";
	   $bg_color = "";

	   
	   if($parent->id == $selected_cat_id)
	   {
		   $selected_cat = "id='current'";
		   $bg_color = "style='background-color:#000; color:#fff;'";
	   }
	   
	   //href="'.$this->generate_url($parent->id).'"

        $list = '<li '.$selected_cat.'>';
		$list.= '<a class="icon trigger" href="#" style="float:left;"></a>';
		//$list.= '<a onclick="submit_url('.$parent->id.',\''.$this->generate_url($parent->id).'\');" '.$bg_color.'>'.$parent->cat_name.' '.$p_count.'</a>';

        $list.= '<a href="'.$this->generate_url($parent->id).'" '.$bg_color.'>'.$parent->cat_name.' '.$p_count.'</a>';

        if ($this->hasChild($parent->id)) // check if the id has a child
        {

            $append++; // this is our basis on what level is the category e.g. (child1,child2,child3)
            $list .= "<ul>";
            $sql = "SELECT * FROM {PRE}categories WHERE p_id = ' " . $parent->id . " ' and status = 'Enabled' order by sort_id asc ";

            $result = $this->db_model->sql($sql);

            foreach($result as $res)
            {
                $list .= $this->CategoryTree($list,$res,$append,$selected_cat_id);
            }

            $list .= "</ul></li>";
        }
        return $list;
    }
	
    function CategoryList($selected_cat_id = "")
    {
        $list = "";

        $sql = "SELECT * FROM {PRE}categories WHERE (p_id = 0 OR p_id IS NULL) and status = 'Enabled' order by sort_id asc";
        $result = $this->db_model->sql($sql);
        $mainlist = "<ul class='accordion' style='padding-bottom: 15px;'>";

        foreach($result as $res)
        {
            $mainlist .= $this->CategoryTree($list,$res,$append = 0,$selected_cat_id);
        }

        $list .= "</ul>";
        return $mainlist;

    }

    //=======================================================================//

    function CategoryTreeAdmin($list,$parent,$append)
    {
        $list = '<li id="list_'.$parent->id.'">
                 <div><span class="disclose"><span></span></span>'.$parent->cat_name.'&nbsp;(<a href="'.base_url().'administration/categories/edit/'.$parent->id.'">Edit</a> | <a href="'.base_url().'administration/categories/del/'.$parent->id.'" onclick="return confirm(\'All the categories and products under selected category will also be deleted.\')">Delete</a>)</div>';

        if ($this->hasChild($parent->id)) // check if the id has a child
        {

            $append++; // this is our basis on what level is the category e.g. (child1,child2,child3)
            $list .= "<ol>";
            $sql = "SELECT * FROM {PRE}categories WHERE p_id = ' " . $parent->id . " ' order by sort_id asc ";

            $result = $this->db_model->sql($sql);

            foreach($result as $res)
            {
                $list .= $this->CategoryTreeAdmin($list,$res,$append);
            }

            $list .= "</ol></li>";
        }
        return $list;
    }

    function CategoryListAdmin($p_id)
    {
        $list = "";

        $sql = "SELECT * FROM {PRE}categories WHERE (p_id = ".$p_id.") order by sort_id asc";
        $result = $this->db_model->sql($sql);
        $mainlist = "<ol class='sortable'>";

        foreach($result as $res)
        {
            $mainlist .= $this->CategoryTreeAdmin($list,$res,$append = 0);
        }

        $list .= "</ol>";

        return $mainlist;
    }


    //=======================================================================//

    function CategoryTreeProductTab($list,$parent,$append,$product_id)
    {

        $p_count = $this->db_model->get_counts_where('product_cats',array('cat_id'=>$parent->id,'product_id > '=>0));

        $product_cats = $this->db_model->get_rows('product_cats',array('product_id'=>$product_id));
		
		$product_cats_arr = array();

        foreach($product_cats as $p_cats)
        {
            $product_cats_arr[] = $p_cats->cat_id;
        }

        $selected_cat = "";
        $checked = "";

        if(in_array($parent->id,$product_cats_arr))
        {
            $selected_cat = "class='current'";
            $checked = "checked";
        }

        $list = '<li '.$selected_cat.'>
				 <a class="icon trigger" href="#" style="float:left;"></a>
				 <a href="javascript:void(0);"><input value="'.$parent->id.'" type="checkbox" name="cat_id[]" id="cat_id" class="required" '.$checked.'/>'.$parent->cat_name.' ('.$p_count.')</a>';

        if ($this->hasChild($parent->id)) // check if the id has a child
        {

            $append++; // this is our basis on what level is the category e.g. (child1,child2,child3)
            $list .= "<ul>";
            $sql = "SELECT * FROM {PRE}categories WHERE p_id = ' " . $parent->id . " ' and status = 'Enabled' order by sort_id asc ";

            $result = $this->db_model->sql($sql);

            foreach($result as $res)
            {
                $list .= $this->CategoryTreeProductTab($list,$res,$append,$product_id);
            }

            $list .= "</ul></li>";
        }
        return $list;
    }

    function CategoryListProductTab($product_id = "")
    {
        $list = "";

        $sql = "SELECT * FROM {PRE}categories WHERE (p_id = 0 OR p_id IS NULL) and status = 'Enabled' order by sort_id asc";
        $result = $this->db_model->sql($sql);
        $mainlist = "<ul class='accordion'>";

        foreach($result as $res)
        {
            $mainlist .= $this->CategoryTreeProductTab($list,$res,$append = 0,$product_id);
        }

        $list .= "</ul>";
        return $mainlist;

    }
}
?>
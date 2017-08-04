<?php 

class Db_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_countries(){
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->order_by('name','ASC');
		$query = $this->db->get();
		return $query;
		
	}
	
    function get_table($table)
    {
		$query = $this->db->get($table);			        
		return $query->result();
    }
	
	function get_row($table,$where)
    {
        $query = $this->db->get_where($table, $where);			
        return $query->row();
    }
	
	function get_rows($table,$where)
    {
        $query = $this->db->get_where($table, $where);			
        return $query->result();
    }
	
	function get_row_value($table,$where)
    {
        $query = $this->db->get_where($table, $where);
		$result = $query->row();			
        return $result->value;
    }
	
	function get_rows_groupby($table,$where,$groupby)
	{
		$this->db->group_by($groupby);		
		$query = $this->db->get_where($table, $where);
		return $query->result();
	}
	
	function insert_row($table,$data){
	
		$data = $this->remove_slashes($data);
        return $this->db->insert($table,$data); 			
    }
	
	function insert_row_retid($table,$data)
    {
		//var_dump($data);
		$data = $this->remove_slashes($data);
		//var_dump($data);
        $this->db->insert($table,$data); 			
		return $this->db->insert_id();
    }
		
	
	function update_row($table,$data,$where)
    {
	
		$data = $this->remove_slashes($data);
		
        return $this->db->update($table, $data, $where); 			
    } 
	
	function insert_record($table,$data){
		return $this->db->insert($table,$data);
	}
	
	function remove_slashes($data)
	{
        if(is_object($data))
        {
            return $data;
        }
        else
        {
            foreach ($data as $key=>$value)
            {
                $data[$key] = stripslashes($value);
            }
            return $data;
        }

	}

	function delete_row($table,$where)
    {
        return $this->db->delete($table,$where); 			
    } 
	
	function sql($commandText)
    {
        $query = $this->db->query($commandText);				
		return $query->result(); 			
    } 
	
	
	
	
	function get_table_by_limits($table,$pp,$row)
    {
		$query = $this->db->get($table,$row,$pp);			        
		return $query->result();
    }
	
	
	function get_table_by_limits_where($table,$pp,$row,$where)
    {
		$this->db->where($where);					
		$query = $this->db->get($table,$row,$pp);				
		return $query;
    }
	
	function get_counts($table)
	{
		return $this->db->count_all($table);
	}
	
	function get_counts_where($table,$where)
	{
		$this->db->where($where);		
		$this->db->from($table);				
		return $this->db->count_all_results();
	}	
	
	function get_sum_where($table,$field_name,$where)
	{		
		$this->db->select_sum($field_name);
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->result();
		
		return $result[0]->$field_name;
	}	
	
	
	function format_content($content)
    {
		$content = str_ireplace('&nbsp;</td>','</td>',$content);		
        return $content;
    }
	
	function role_validator($moduleid)
	{				
		$array = array('roleid' => $this->session->userdata('loggedinuserrole')->roleid,'privilegeid' => $moduleid);		
		$row = $this->get_row('roles_permissions',$array);
		
		if($row == null)
		{
			$this->session->set_flashdata('response', '<error><strong>Access Denied</strong>, This section is not active against your role.</error>');	
			redirect(base_url().'administration/error', 'refresh');		
		}			
		
	}
	
	public function is_login()
	{
		if(!$this->session->userdata('member'))
		{
			$this->session->set_flashdata('msg', '<div class="login-error">Please login.</div>');
			redirect(base_url()."member/login",'refresh');
		}
		
	}
	
	
	function get_admin_email(){
		$this->db->select('useremail');
		$this->db->from('users');
		$this->db->where(array('role_id' => 1));
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['useremail'];
    }
	
		function get_admin_details(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('role_id' => 1));
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0];
    }
	
	
	function get_disabled_dates($id)
	{
		//$booked_items = $this->db_model->get_rows('order_items',array('product_id'=>$id));
		$qry = "SELECT DATE_ADD(start_date,INTERVAL -2 DAY) as start_date, DATE_ADD(return_date,INTERVAL 2 DAY) as return_date 
		FROM {PRE}order_items 
		where product_id = ".$id." and 
		order_id IN(select id from {PRE}orders where id = {PRE}order_items.order_id and order_status in('Paid','Shipped'))";
		
		$checkoutqty = $this->helper_model->checkout_qty($id);
		$productqty = $this->helper_model->get_product_qtyval($id);
		
		//echo $checkoutqty." - ".$productqty; exit;
		
		$booked_items = $this->sql($qry);
		

		$disabled_dates = array();
		$today1 = date('Y-m-d');
		$today2 = date('d-m-Y');
		foreach($booked_items as $bi)
		{
			//echo  "<pre>";
			//echo $bi->start_date."  ---- ".$bi->return_date;
			//echo $productqty."  ---- ".$checkoutqty;
			//echo "</pre>";
			if($bi->start_date >= $today1 || $bi->return_date >= $today1)
			{
				$date_range = array();
				
				
				if($productqty > $checkoutqty)
				{}
				else
				{
					$date_range = $this->getAllDatesBetweenTwoDates($bi->start_date, $bi->return_date);
				}
				
				foreach($date_range as $dt)
				{
				
					if(!in_array($dt,$disabled_dates) && $dt >= $today2)
					{
						array_push($disabled_dates,$dt);
					}
				}
			}
		}
		/*echo  "<pre>";
		print_r($disabled_dates);
		echo "</pre>";*/
		
		//$disabled_dates = array('5-28-2014','5-29-2014','5-30-2014','5-31-2014');
		$dd = implode(',',$disabled_dates);
		//$dd = json_encode($disabled_dates);
		return $dd;
	}
	
	function getAllDatesBetweenTwoDates($strDateFrom,$strDateTo)
	{
    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
		
		//array_push($aryRange,date('n-j-Y',$iDateFrom+86400*2));// push two days befor start date
        array_push($aryRange,date('j-n-Y',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('j-n-Y',$iDateFrom));
        }
		//array_push($aryRange,date('n-j-Y',$iDateFrom-86400*2));// push two days after return date
    }
    return $aryRange;
}

	
	function getResultArray($table,$where){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function addRecord($table,$data){
		$rs = $this->db->insert($table,$data);
		return $rs;
	}
	
	function updateRecord($table,$data,$where){
		$this->db->where($where);
		$rs = $this->db->update($table,$data);
		return $rs;
	}
	
	function deleteRecord($table,$where){
		$rs = $this->db->delete($table,$where);	
		return $rs;
	}
	
	function get_post_img($id)
	{
		$url = base_url().'blog/wp-admin/admin-ajax.php?action=get_thumbnail&post_id='.$id.'';
		return $img = file_get_contents($url);
		
	}
	
	function get_items_on_rent()
	{
		$sqltxt = "Select oi.*, p.product_title,p.stock_no, m.first_name, m.middle_name, m.last_name 
		from {PRE}order_items oi, {PRE}orders o, {PRE}products p, {PRE}members m where ";
		///start_date >= DATE_ADD(CURDATE(),INTERVAL -2 DAY)  AND 
		$sqltxt .= "return_date >= DATE_ADD(CURDATE(),INTERVAL 2 DAY) 
		AND oi.order_id = o.id 
		AND o.order_status != 'Incomplete' 
		AND o.order_status != 'Returned' 
		AND oi.product_id = p.id 
		AND o.member_id = m.id order by oi.return_date asc";
		$result = $this->sql($sqltxt);
		return $result;
		
		
	}

}

?>
<?php 

class Helper_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	function checkout_qty($product_id)
	{
		//$qry = "SELECT SUM(r_qty) as qty FROM ozl_order_items where product_id = ".$product_id." and order_id IN(select id from ozl_orders where id = ozl_order_items.order_id and order_status in('Paid','Shipped')) and DATE_ADD(start_date,INTERVAL -2 DAY)>NOW()";
		
		$qry = "SELECT SUM(r_qty) as qty FROM ozl_order_items where product_id = ".$product_id." and order_id IN(select id from ozl_orders where id = ozl_order_items.order_id and order_status in('Paid','Shipped')) and start_date>NOW()";
		
		$res = $this->db_model->sql($qry);
		
		return $res[0]->qty;
		
		
	}
	
	function get_product_qtyval($product_id)
	{
		$qry ="select quantity from {PRE}products where id = ".$product_id;	
		
		$res = $this->db_model->sql($qry);
		
		return $res[0]->quantity;
	}
	
	function check_qty($product_id)
	{
		
		$res = $this->db_model->sql("SELECT SUM(r_qty) as cnt FROM {PRE}order_items where product_id = ".$product_id." and order_id in(select id from {PRE}orders where id = {PRE}order_items.order_id and order_status in('Paid','Shipped')) and now() between  DATE_ADD(start_date,INTERVAL -2 DAY) and DATE_ADD(return_date,INTERVAL 2 DAY)");
		$qty = $res[0]->cnt;
		
		return $qty;
		
	}
	
	function check_availability($product_id)
	{
		
		$res = $this->db_model->sql("SELECT DATE_ADD(return_date,INTERVAL 3 DAY) as return_date FROM {PRE}order_items where product_id = ".$product_id." and order_id in(select id from {PRE}orders where id = {PRE}order_items.order_id and order_status in('Paid','Shipped')) and now() between DATE_ADD(start_date,INTERVAL -2 DAY) and DATE_ADD(return_date,INTERVAL 3 DAY) order by return_date asc limit 0,1");
		$rsp = $res[0]->return_date;		
		return $rsp;
		
	}

	function calculate_gst($amount)
	{
		$gst = $this->db_model->get_row('settings',array('key'=>'gst'))->value; //in percentage
		$gst = ($amount*$gst)/100;
		return $this->format_currency($gst);
		
	}
	
	function format_currency($amount)
	{
		return number_format($amount,2);
	}
	
	function calculate_total($sub_total,$shipping)
	{
		//return $this->format_currency(($this->calculate_gst($sub_total) + $sub_total + $shipping) - $this->session->userdata('discount_amount'));
        return $this->format_currency(($sub_total + $shipping) - $this->session->userdata('discount_amount'));
	}

    function calculate_shipping($sub_total,$shipping)
    {
        return $this->format_currency($this->calculate_gst($sub_total) + $sub_total + $shipping);
    }

    function format_date($date, $inc_time = false)
    {
        if($inc_time == true)
        {
            return date('d-m-Y h:i:s A',strtotime($date));
        }
        else
        {
            return date('d-m-Y',strtotime($date));
        }

    }


}


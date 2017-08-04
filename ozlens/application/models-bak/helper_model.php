<?php 

class Helper_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
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


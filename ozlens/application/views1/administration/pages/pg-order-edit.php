<?PHP
/**
 *@var $this CI_Controller
 */
?>

<form id="orderFrm" name="orderFrm"  enctype="multipart/form-data" method="post" action="">
<div id="printable">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <fieldset>
    <legend><h2>Billing Detail</h2></legend>
   	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><strong>Full Name:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_full_name;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Company Name:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_company_name;?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
       <tr>
         <td><strong>Street Address:</strong>&nbsp;</td>
         <td><?PHP echo $row->b_street_address;?></td>
       </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
         <tr>
        <td><strong>Apartment No:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_apartment_no;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>City:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_city;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>State:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_state;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Post Code:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_zip;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Phone No:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_phone_no;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Mobile No:</strong>&nbsp;</td>
        <td><?PHP echo $row->b_mob_no;?></td>
      </tr>
    </table>
    </fieldset>
    
    </td>
    <td>&nbsp;</td>
    <td>
    <fieldset>
    <legend><h2>Shipping Detail</h2></legend>
   	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><strong>Full Name:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_full_name;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Company Name:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_company_name;?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
       <tr>
         <td><strong>Street Address:</strong>&nbsp;</td>
         <td><?PHP echo $row->s_street_address;?></td>
       </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
         <tr>
        <td><strong>Apartment No:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_apartment_no;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>City:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_city;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>State:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_state;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Post Code:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_zip;?></td>
      </tr>
      <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Phone No:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_phone_no;?></td>
      </tr>
        <tr>
      	<td colspan="2">&nbsp;</td>
      </tr>
       <tr>
        <td><strong>Mobile No:</strong>&nbsp;</td>
        <td><?PHP echo $row->s_mob_no;?></td>
      </tr>
    </table>
    </fieldset>
    </td>
  </tr>
  <tr>
  	<td colspan="3">&nbsp;</td>
  </tr>
  
  <tr>
  	<td colspan="3">
    <fieldset>
    <legend><h2>Special Instructions</h2></legend>
    
    <p>
    <?PHP echo $row->special_instructions;?>
    </p>
    
    </fieldset>
    
    
    
    </td>
  </tr>
  
  <tr>
  	<td colspan="3">&nbsp;</td>
  </tr>
  
   <tr>
  	<td colspan="3">
    <fieldset>
    <legend><h2>Products</h2></legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="njtable">
      <tr>
        <th><strong>Product</strong></th>
        <th>Stock No.</th>
        <th><strong>Rental Period</strong></th>
        <th><strong>Start Date</strong></th>
        <th><strong>Return Date</strong></th>
        <th><strong>Qty</strong></th>
        <th><strong>Price</strong></th>     
      </tr>
      <?PHP 
	  function checkid($arr,$id)
					   {
						   $rsp = false;
						   
							for($i = 0; $i<sizeof($arr); $i++)
							{
								if($arr[$i] == $id)
								{
									$rsp = true;		
								}
							}
							
							return $rsp;
					   }
	  
	  $order_items = $this->db_model->get_rows('order_items',array('order_id'=>$row->id));
$cart_products = array();
	  foreach($order_items as $item)
	  {
		   if(checkid($cart_products,$item->product_id))
						   {
								continue;
						   }
						   
						   $cart_products[] = $item->product_id;
						   
		 //echo $item->product_id;
		  $product_data = $this->db_model->get_row('products',array('id'=>$item->product_id));

	  ?>
       <tr>
        <td><?PHP echo $product_data->product_title;?></td>
        <td><?PHP echo $product_data->stock_no;?></td>
        <td width="50"><?PHP echo $item->rental_days;?></td>
        <td><?PHP echo $this->helper_model->format_date($item->start_date,false);?></td>
        <td><?PHP echo $this->helper_model->format_date($item->return_date,false);?></td>
        <td><?PHP echo $item->r_qty;?></td>
        <td><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($item->r_price*$item->r_qty);?></td>     
      </tr>
       <tr>
        <td style="padding-left:50px;">Waiver Charges</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?PHP echo $item->w_qty;?></td>
        <td><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($item->w_price*$item->w_qty);?></td>     
      </tr>
      <?PHP 
	  }
	  ?>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Sub Total:</strong></td>
        <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_sub_total);?></strong></td>
      </tr>

<tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Discount:</strong></td>
        <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_discount);?></strong></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Shipping:</strong></td>
        <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_shipping_charges);?></strong></td>
    </tr>

    

      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>Total:</strong></td>
        <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_amount);?></strong></td>
      </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong>Order total includes GST:</strong></td>
            <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_gst);?></strong></td>
        </tr>
      
    </table>

    
    </fieldset>
    
    </td>
  </tr>
  </table>
  </div>
  
  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td colspan="3">
    <div id="non-printable">
    	<table  width="450" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td><strong>Order Status:</strong></td>
    <td>
    <select name="order_status" id="order_status">
    	<option value="Paid" <?PHP if($row->order_status=='Paid'){echo "Selected";}?>>Paid</option>
        <option value="Shipped" <?PHP if($row->order_status=='Shipped'){echo "Selected";}?>>Shipped</option>
        <option value="Pending" <?PHP if($row->order_status=='Pending'){echo "Selected";}?>>Pending</option>
        <option value="Incomplete" <?PHP if($row->order_status=='Incomplete'){echo "Selected";}?>>Incomplete</option>
    </select>
    </td>
    <td>
     <p>
            <div style="float:left; margin-right:3px;"><input type="submit" name="btnSubmit" id="btnSubmit" value="Save" /> </div>
            <div style="float:left; margin-right:3px;"><input type="button" onclick="window.location='<?PHP echo base_url();?>administration/orders'" value="cancel"/></div>
            <div style="float:left;"><div style="float:left;"><input type="button" name="button" id="button" value="Print" onclick="printDiv();" /><div id="invoice_loader" style="display:none; float:right; padding-left:5px;"><img src="<?=base_url()?>assets/images/ajax-loader.gif" /></div></div>
     </p>
    </td>
      </tr>
    </table>
</div>
    </td>
  </tr>
</table>
<input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
</form>

<script>
function printDiv(){
	$("#invoice_loader").show();
	$.ajax({
	   url:'<?=base_url()?>administration/orders/print_invoice/<?=$row->id?>',
	   type:'POST',
	   success: function(data){
		  var w = window.open();
		  w.document.write(data);
		  w.print();
		  w.close();
		  $("#invoice_loader").hide();
	   }
	});
}

$jqvalidation(document).ready(function() {

    $jqvalidation("#orderFrm").validate({});
	
});
</script>
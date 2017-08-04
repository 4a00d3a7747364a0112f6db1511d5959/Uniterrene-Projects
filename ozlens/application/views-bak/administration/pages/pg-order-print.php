<!doctype html><html><head><meta charset="utf-8"><title>ozlensrental order print</title>
<style>
body {
    color: #696969;
    font-family: Verdana,Helvetica,Sans-Serif;
    font-size: 11px;
}
#njtable {
    border-collapse: collapse;
}

#njtable th {
    background-color: #000000;
    border: 1px solid #ccc;
    color: #ffffff;
    padding: 6px 5px;
    text-align: left;
}

#njtable td {
    border: 1px solid #e8eef4;
    padding: 5px;
}

</style>
</head>
<body style="background-color:#FFFFFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td>&nbsp;</td></tr>
  <tr>
  	<td align="left">
    	<img src="<?php echo base_url();?>assets/images/administration/logo.png" height="45" alt="" border="0" align="absmiddle" title=""/>
    </td>
  </tr>
   <tr><td>&nbsp;</td></tr>
  <tr><td><?=$address?></td></tr>
  <tr><td>&nbsp;</td></tr>
</table>

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
    <legend><h2>Products</h2></legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="njtable">
      <tr>
        <th><strong>Product</strong></th>
        <th><strong>Rental Period</strong></th>
        <th><strong>Start Date</strong></th>
        <th><strong>Return Date</strong></th>
        <th><strong>Qty</strong></th>
        <th><strong>Price</strong></th>     
      </tr>
      <?PHP 
	  $order_items = $this->db_model->get_rows('order_items',array('order_id'=>$row->id));

	  foreach($order_items as $item)
	  {
		  $product_data = $this->db_model->get_row('products',array('id'=>$item->product_id));

	  ?>
       <tr>
        <td><?PHP echo $product_data->product_title;?></td>
        <td><?PHP echo $item->rental_days;?></td>
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
        <td><strong>Sub Total:</strong></td>
        <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_sub_total);?></strong></td>
      </tr>


    <tr>
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
        <td><strong>Dicount:</strong></td>
        <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_discount);?></strong></td>
    </tr>

      <tr>
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
            <td><strong>Order total includes GST:</strong></td>
            <td><strong><?PHP echo $this->config->item('currency_symbol');?>&nbsp;<?PHP echo $this->helper_model->format_currency($row->order_gst);?></strong></td>
        </tr>
      
    </table>

    
    </fieldset>
    
    </td>
  </tr>
  </table>

  </body>
  </html>
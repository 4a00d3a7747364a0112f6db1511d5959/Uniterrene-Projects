<?PHP
$product_data = $this->db_model->get_row('products',array('id'=>$s_product_id));
?>

<p id="pricing_table">

  <!--<label><a href="javascript:void(0);" onclick="addRow('pricing');"><strong>Add</strong></a> &nbsp;|&nbsp; <a href="javascript:void(0);" onclick="deleteRow('fields')"><strong>Remove</strong></a> </label>-->
  
  <TABLE border="0">
  
  <TR>            
        <TD valign="top"><strong>Days</strong></TD>
        <TD valign="top"><strong>Waiver Price (<?PHP echo $this->config->item('currency_symbol');?>)</strong></TD>
        <TD valign="top"><strong>Rental Price (<?PHP echo $this->config->item('currency_symbol');?>)</strong></TD>
    </TR> 
                    
	<?PHP 
	
	$rental_days = $this->db_model->get_table('rental_periods');
	
	if($rental_days)
	{
		$i=0;
		foreach($rental_days as $rd)
		{
			$pricing = $this->db_model->get_row('product_pricing',array('product_id'=>$s_product_id,'rental_period'=>$rd->no_of_days));
			?>
            <TR>            
                <TD valign="top"><input size="15" type="text" id="rental_period<?PHP echo $i;?>" class="required" name="rental_period[]" placeholder="Rental Period" value="<?PHP echo $rd->no_of_days;?>" readonly="readonly"/></TD>
                <TD valign="top"><input size="45" type="text" id="waiver_price<?PHP echo $i;?>" class="required" name="waiver_price[]" placeholder="Waiver Price" value="<?PHP if(isset($pricing->waiver_price)){echo $pricing->waiver_price;}?>"/></TD>
                <TD valign="top"><input size="45" type="text" onchange="set_rental_price(<?PHP echo $i;?>,this.value);" id="rental_price<?PHP echo $i;?>" class="required" name="rental_price[]" placeholder="Rental Price" value="<?PHP if(isset($pricing->rental_price)){echo $pricing->rental_price;}?>"/></TD>
            </TR>   
            <?PHP
			
			$i++;
			
		}
	}
	?>	
    <tr>
    	<td colspan="100%" style="height:8px;"></td>
    </tr>
    
    <tr>
    	<td colspan="100%">
        <p>
            <label>*<strong>Waiver price (<?PHP echo $this->config->item('currency_symbol');?>) per day (this will be used if customer selectes additional days):</strong></label>
            <input size="60" name="r_price_per_day" id="r_price_per_day" type="text" value="<?PHP echo set_value('r_price_per_day',$product_data->r_price_per_day);?>" class="required"/>
        </p>
        
        <p>
            <label>*<strong>Rental price (<?PHP echo $this->config->item('currency_symbol');?>) per day (this will be used if customer selectes additional days):</strong></label>
            <input size="60" name="w_price_per_day" id="w_price_per_day" type="text" value="<?PHP echo set_value('w_price_per_day',$product_data->w_price_per_day);?>" class="required"/>
        </p>
        </td>
    </tr>
   
    </TABLE>
</p>
<p>

  <label><a href="javascript:void(0);" onclick="addRow('www_fields');"><strong>Add</strong></a> &nbsp;|&nbsp; <a href="javascript:void(0);" onclick="deleteRow('www_fields')"><strong>Remove</strong></a> </label>
  
  <TABLE id="www_fields" border="0">
                    
	<?PHP 
    
	$fields = $this->db_model->get_rows('product_www',array('product_id'=>$row->id));
    
	if(isset($fields) && sizeof($fields)>0)
    {
        foreach($fields as $field)
        {
    ?>
    
        <TR>
            <TD valign="top"><INPUT type="checkbox" name="chk"/></TD>
            <TD valign="top"><input size="45" type="text" id="www_caption" name="www_caption[]" placeholder="Caption" value="<?PHP echo $field->www_caption;?>"/></TD>
            <TD valign="top">
            	 <select name="www_r_product_id[]" id="www_r_product_id">
                    <option value="">Select</option>
                    <?PHP 
					$products = $this->db_model->get_table('products');
					foreach($products as $p)
					{
					?>
                  		<option value="<?PHP echo $p->id;?>" <?PHP if($field->www_r_product_id == $p->id){echo "selected";}?>><?PHP echo $p->product_title;?></option>                    
                    <?PHP 
					}
					?>
                </select>
            </TD>
        </TR>                    
    <?PHP
        }
    }
    else
    {
    ?>
       <TR>
            <TD valign="top"><INPUT type="checkbox" name="chk"/></TD>
            <TD valign="top"><input size="45" type="text" id="www_caption" name="www_caption[]" placeholder="Caption" value=""/></TD>
            <TD valign="top">
            	 <select name="www_r_product_id[]" id="www_r_product_id">
                    <option value="">Select</option>
                    <?PHP 
					$products = $this->db_model->get_table('products');
					foreach($products as $p)
					{
					?>
                  		<option value="<?PHP echo $p->id;?>"><?PHP echo $p->product_title;?></option>                    
                    <?PHP 
					}
					?>
                </select>
            </TD>
        </TR>          
    <?PHP
    }
    ?>    
    </TABLE>
    
</p>

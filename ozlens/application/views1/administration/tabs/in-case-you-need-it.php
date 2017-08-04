<p>

  <label><a href="javascript:void(0);" onclick="addRow('yni_fields');"><strong>Add</strong></a> &nbsp;|&nbsp; <a href="javascript:void(0);" onclick="deleteRow('yni_fields')"><strong>Remove</strong></a> </label>
  
  <TABLE id="yni_fields" border="0">
                    
	<?PHP 
    
	$fields = $this->db_model->get_rows('product_you_need_it',array('product_id'=>$row->id));
    
	if(isset($fields) && sizeof($fields)>0)
    {
        foreach($fields as $field)
        {
    ?>
    
        <TR>
            <TD valign="top"><INPUT type="checkbox" name="chk"/></TD>
            <TD valign="top"><input size="45" type="text" id="yni_caption" name="yni_caption[]" placeholder="Caption" value="<?PHP echo $field->yni_caption;?>"/></TD>
            <TD valign="top">
            	 <select name="yni_r_product_id[]" id="yni_r_product_id">
                    <option value="">Select</option>
                    <?PHP 
					$products = $this->db_model->get_table('products');
					foreach($products as $p)
					{
					?>
                  		<option value="<?PHP echo $p->id;?>" <?PHP if($field->yni_r_product_id == $p->id){echo "selected";}?>><?PHP echo $p->product_title;?></option>                    
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
            <TD valign="top"><input size="45" type="text" id="yni_caption" name="yni_caption[]" placeholder="Caption" value=""/></TD>
            <TD valign="top">
            	 <select name="yni_r_product_id[]" id="yni_r_product_id">
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

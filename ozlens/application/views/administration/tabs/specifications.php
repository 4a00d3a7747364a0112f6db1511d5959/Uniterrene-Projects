<p>

  <label><a href="javascript:void(0);" onclick="addRow('fields');"><strong>Add</strong></a> &nbsp;|&nbsp; <a href="javascript:void(0);" onclick="deleteRow('fields')"><strong>Remove</strong></a> </label>
  
  <TABLE id="fields" border="0">
                    
	<?PHP 
    
	$fields = $this->db_model->get_rows('product_specs',array('product_id'=>$row->id));
    
	if(isset($fields) && sizeof($fields)>0)
    {
        foreach($fields as $field)
        {
    ?>
    
        <TR>
            <TD valign="top"><INPUT type="checkbox" name="chk"/></TD>
            <TD valign="top"><input size="45" type="text" id="specs_caption" name="specs_caption[]" placeholder="Caption" value="<?PHP echo $field->specs_caption;?>"/></TD>
            <TD valign="top"><input size="45" type="text" id="specs_text" name="specs_text[]" placeholder="Text" value="<?PHP echo $field->specs_text;?>"/></TD>
        </TR>                    
    <?PHP
        }
    }
    else
    {
    ?>
       <TR>
            <TD valign="top"><INPUT type="checkbox" name="chk"/></TD>
            <TD valign="top"><input size="45" type="text" id="specs_caption" name="specs_caption[]" placeholder="Caption" /></TD>
            <TD valign="top"><input size="45" type="text" id="specs_text" name="specs_text[]" placeholder="Text" /></TD>
        </TR>   
    <?PHP
    }
    ?>    
    </TABLE>
    
</p>

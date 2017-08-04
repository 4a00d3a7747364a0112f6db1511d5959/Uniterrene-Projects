
<h1><?PHP echo $page_title;?></h1>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>   
    <td><img src="<?PHP echo base_url();?>assets/images/administration/icons/information_icon.png"  align="absmiddle"/>&nbsp;Click on the headings below to expand the settings.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<form name="settingsFrm" id="settingsFrm" action="<?php echo base_url(); ?>administration/settings/save" method="post" >  
<?PHP
if($modules)
{
	$i=0;
	foreach($modules as $module)
	{
		
		?>
        <fieldset style="margin-bottom:20px;">
        <legend><h2 onclick="showhide_('<?PHP echo $i;?>')" style="cursor:pointer;"><?php echo $module->module; ?></h2></legend>
        
        <div style="display:none;" id="<?PHP echo $i;?>">
        
        <?php
		
		$fields = $this->db_model->get_rows("settings",array("module" => $module->module));
		
		if($fields)
		{
			foreach($fields as $field)
			{
		?>	  
       		
            <p>
                <label><?PHP echo $field->label;?>:</label>
                <?PHP 				
				if($field->field_type == 'text')
				{
				?>
                <input type="text" name="<?PHP echo $field->key;?>" id="<?PHP echo $field->key;?>" value="<?PHP echo $field->value;?>" size="60"/>
                <?PHP 
				}
				else if($field->field_type == 'textarea')
				{
				?>
                <textarea name="<?PHP echo $field->key;?>" id="<?PHP echo $field->key;?>" style="width:70%;" rows="8"><?PHP echo $field->value;?></textarea>
                <?PHP 
				}
				else if($field->field_type == 'select')
				{
				?>
                <select name="<?PHP echo $field->key;?>" id="<?PHP echo $field->key;?>">
                	<option value="Activate" <?PHP if($field->value == 'Activate'){echo "Selected";}?>>Activate</option>
                    <option value="Deactivate" <?PHP if($field->value == 'Deactivate'){echo "Selected";}?>>Deactivate</option>
                </select>
                <?PHP 
				}
				?>
           </p>
              
	<?PHP
			}
		}
		
		?>     
        <p>
            <input type="submit" value="Save &raquo;" />
            <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/cpanel'" value="cancel"/>
        </p>
		</div>
        </fieldset>
        
        <?PHP 
		
		$i++;
	}
}
?>
</form>
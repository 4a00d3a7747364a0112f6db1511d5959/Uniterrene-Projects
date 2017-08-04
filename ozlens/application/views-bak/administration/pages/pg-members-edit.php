<?PHP
/**
 *@var $this CI_Controller
 */
?>

<form id="membersFrm" name="membersFrm"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>

    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                                 
                <p>
                    <label>*<strong>First Name:</strong></label>
                    <input size="60" name="first_name" id="first_name" type="text" value="<?PHP echo set_value('first_name',$row->first_name);?>" class="required"/>
                </p>                           

                <p>
                    <label>*<strong>Password:</strong></label>
                    <input size="60" name="password" id="password" type="password" value="<?PHP echo set_value('password',$row->password);?>" class="required"/>
                </p>
                
                <p>
                    <label>*<strong>Last Name:</strong></label>
                    <input size="60" name="last_name" id="last_name" type="text" value="<?PHP echo set_value('last_name',$row->last_name);?>" class="required"/>
                </p>

                <p>
                    <label>*<strong>Email:</strong></label>
                    <input size="60" name="email" id="email" type="text" value="<?PHP echo set_value('email',$row->email);?>" class="required email"/>
                </p> 
                
                <p>
                    <label><strong>Country:</strong></label>
                    <select name="country" id="country">
                        <option value="">Select</option>
                        <?PHP
                        $countries = $this->db_model->get_table('countries');
                        foreach($countries as $country)
                        {
                            ?>
                            <option value="<?PHP echo $country->name;?>" <?PHP if($row->country == $country->name){echo set_select('country', $country->name , true);}else{echo set_select('country', $country->name); }?>><?PHP echo $country->name;?></option>
                        <?PHP
                        }
                        ?>
                    </select>
                </p>

                <p>
                    <label><strong>City:</strong></label>
                    <input size="60" name="city" id="city" type="text" value="<?PHP echo set_value('city',$row->city);?>"/>
                </p>                          

                <p>
                    <label><strong>State:</strong></label>
                    <input size="60" name="state" id="state" type="text" value="<?PHP echo set_value('state',$row->state);?>"/>
                </p>
                
                <p>
                    <label>*<strong>Status:</strong></label>
                    <select name="status" id="status" class="required">
                        <option value="">Select</option>
                        <option value="Active" <?PHP if($row->status == 'Active'){echo set_select('status', 'Active', true);}else{echo set_select('status', 'Active'); }?>>Active</option>
                        <option value="Suspended"  <?PHP if($row->status == 'Suspended'){echo set_select('status', 'Suspended', true);}else{echo set_select('status', 'Suspended'); }?>>Suspend</option>
                    </select>
                </p>
           
            </td>
        </tr>
        
        <tr>
        	<td> <p>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />
        <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/members'" value="cancel"/>
    </p></td>
        </tr>


    </table>

   

    <input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
    </fieldset>
</form>

<script>
$jqvalidation(document).ready(function() {
 
    $jqvalidation("#membersFrm").validate({});
	
});
</script>
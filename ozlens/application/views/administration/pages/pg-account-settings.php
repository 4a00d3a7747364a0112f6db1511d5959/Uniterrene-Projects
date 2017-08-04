<form id="accountSettingsFrm" name="accountSettingsFrm" method="post" action="<?PHP echo base_url();?>administration/accountsettings/save">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<td>
        	<p>
                <label for="username">*<strong>User Name:</strong></label>                    
                <input name="username" id="username" type="text" size="35" class="required" value="<?PHP echo $this->session->userdata('loggedinuser')->username;?>" />
             </p>
             <p>
                <label for="useremail">*<strong>User Email:</strong></label>                    
                <input name="useremail" id="useremail" type="text" size="35" class="required email" value="<?PHP echo $this->session->userdata('loggedinuser')->useremail;?>" />
             </p>
             <p>
                <label for="password">*<strong>Password:</strong></label>                    
                <input name="password" id="password" type="password" size="35" class="required" minlength="5" value="<?PHP echo $this->session->userdata('loggedinuser')->password;?>" />
             </p>
            
             <p>
             	<input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />
                <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='<?PHP echo base_url();?>administration/cpanel'" />
             </p>
        </td>
    </tr>
</table>
</fieldset>
</form>
<script>
$jqvalidation(document).ready(function() {
	$jqvalidation("#accountSettingsFrm").validate({});	
});
</script>
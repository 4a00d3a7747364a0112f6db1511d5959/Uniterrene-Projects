<form name="loginForm" id="loginForm" action="<?php echo base_url(); ?>administration/login/authenticate" method="post" >     
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="20%" height="80%">
            <img src="<?PHP echo base_url();?>assets/images/administration/icons/login_icon.png"/>                     
        </td>
        <td>           
            <p>
                <label for="username">Username:</label>
                
                <input name="username" type="text" value="" size="35" class="required" minlength="5" />
            </p>
            <p>
                <label for="password">Password:</label>
               
                <input name="password" type="password" value="" size="35" class="required" minlength="5"/>
            </p>
            
            <p>
                <input type="submit" value="Log On &raquo;" />
            </p>
        </td>
   </tr>
</table>
</fieldset>       
</form>

<script>

$jqvalidation(document).ready(function() {

	$jqvalidation("#loginForm").validate({});	
	
});
</script>
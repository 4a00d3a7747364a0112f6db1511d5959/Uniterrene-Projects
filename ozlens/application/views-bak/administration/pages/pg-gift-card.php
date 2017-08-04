<form id="templatesFrm" name="templatesFrm"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
    	<td>
            <p>
                <label>*<strong>Receiver's email:</strong></label>
                <input size="60" name="receiver_email" id="receiver_email" type="text" class="validate[required]"/>
            </p>
            


            <p>
                <label>*<strong>Subject:</strong></label>
                <input size="60" name="subject" id="subject" type="text" value="" class="validate[required]"/>
            </p>
            
          <p>
            <label>*<strong>Amount:</strong>($)</label>
              
<input size="60" name="amount" id="amount" type="text" value="" class="validate[required]"/>
            </p>
            <p> <strong>Discount Code: <font color="green"><?php echo $code; ?></font></strong> (This is an  automaticallay generated code and will be added to database after you send it using this page.) </p>

        </td>
    </tr>
	<tr>
	  <td>
        <p>
            <label for="content">*<strong>Email Content:</strong></label>
            <textarea name="content" id="content" cols="" rows="" style="width:100%;height:350px;"><?PHP echo set_value('content',$email_temp);?><?PHP //echo $email_temp;?></textarea>
          </p>        
          
         <p>
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Send Email" /> 
            <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/templates'" value="cancel"/>
         </p>
      </td>
	  </tr>
</table>
<input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
</fieldset>
</form>
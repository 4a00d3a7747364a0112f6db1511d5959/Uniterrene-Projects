<form id="templatesFrm" name="templatesFrm"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
    	<td>
            <p>
                <label>*<strong>Template Name:</strong></label>
                <input size="60" name="template_name" id="template_name" type="text" value="<?PHP echo set_value('template_name',$row->template_name);?>" class="validate[required]"/>
            </p>

            <p>
                <label>*<strong>Subject:</strong></label>
                <input size="60" name="subject" id="subject" type="text" value="<?PHP echo set_value('subject',$row->subject);?>" class="validate[required]"/>
            </p>

        </td>
    </tr>
	<tr>
	  <td>
        <p>
            <label for="content">*<strong>Description/Detail:</strong></label>
            <textarea name="content" id="content" cols="" rows="" style="width:100%;height:350px;"><?PHP echo set_value('content',$row->content);?></textarea>
          </p>        
          
         <p>
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" /> 
            <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/templates'" value="cancel"/>
         </p>
      </td>
	  </tr>
</table>
<input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
</fieldset>
</form>
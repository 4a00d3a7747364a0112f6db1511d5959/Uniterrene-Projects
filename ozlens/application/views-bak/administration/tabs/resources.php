<?PHP
/**
 *@var $this CI_Controller
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>----</title>

<link href="<?php echo base_url(); ?>assets/css/administration.css" rel="stylesheet" type="text/css" />
</head>

<body style="background-color:#fff;">

<table width="100%"  border="0" cellspacing="3" cellpadding="0"> 
 <tr>
 <td style="background-color:#f2f2f2;" >
 <form name="form1"  method="post" enctype="multipart/form-data" action="<?PHP echo base_url();?>administration/products/resources_upload<?PHP if(isset($resource_data)){echo "?resource_id=".$resource_data->id;}?>">
 
 	<table border="0" cellspacing="0" cellpadding="0" align="left" >
     <tr>
        <td style="padding-left:15px;"><label><strong>Caption:</strong></label>&nbsp;&nbsp;</td>
        <td><input size="45" name="pr_caption" id="pr_caption" type="text" placeholder="Caption" value="<?PHP if($this->input->post('pr_caption')){echo $this->input->post('pr_caption');}else if(isset($resource_data)){echo $resource_data->pr_caption;}?>"/></td>
        <td>&nbsp;</td>
        <td><label><strong>Attachment:</strong></label></td>
        <td><input type="file" name="pr_file_name" id="pr_file_name"/></td>
        <td>&nbsp;</td>
        <td>
        	<input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />
        	
         	<?PHP if($this->input->get('resource_id')){?>   
            &nbsp;<input type="button" value="Cancel" onclick="window.location='<?PHP echo base_url();?>administration/products/resources_iframe/<?PHP if(isset($product_id)){echo $product_id;}?>'" />
        	<?PHP }?>
        </td>
        <td>&nbsp;&nbsp;</td>
        <td style="color:#930;"><?PHP if(isset($error) && $error !=""){echo $error;}?><?php echo $this->session->flashdata('response');?></td>
      </tr>
</table>
<input type="hidden" name="product_id" id="product_id" value="<?PHP if(isset($product_id)){echo $product_id;}?>"/>
</form>

</td>
 </tr>
  
  <?PHP if($resources){?>
  <tr>
  	<td colspan="100%">&nbsp;</td>
  </tr>
  <tr>
  	<td> 
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="njtable">
        <tr>
        	<th>Caption</th>
            <th>Attachment</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>         
		  <?PHP
		  $i=0; 
		  foreach($resources as $resource)
		  {
			  $bg_color="#f2f2f2";
			  
			  if($i%2==0)
			  {
				  $bg_color = "#ffffff;";
			  }
		  ?>          
          <tr style="background-color:<?PHP echo $bg_color;?>">

            <td valign="top"><?PHP echo $resource->pr_caption;?></td>
            <td valign="top"><a href="<?PHP echo base_url();?>uploads/resources/<?PHP echo $resource->pr_file_name;?>"><?PHP echo $resource->pr_file_name;?></a></td>
            <td valign="top"><a href="<?PHP echo base_url();?>administration/products/resources_iframe/<?PHP echo $product_id;?>?resource_id=<?PHP echo $resource->id;?>"><img src="<?PHP echo base_url();?>assets/images/administration/icons/edit.gif"/></a></td>
            <td valign="top">
            <form method="post" style="display:inline;" action="<?PHP echo base_url();?>administration/products/del_resource">
                <input onclick="return confirm('Are you sure to delete this record?');" type="image" src="<?php echo base_url("assets/images/administration/icons/del.gif")?>" alt="Delete" title="Delete" border="0"  />
                <input type="hidden" name="resourceId" value="<?php echo $resource->id; ?>" />
            </form>
            
            <!--<a href="<?PHP echo base_url();?>administration/products/del_resource/<?PHP echo $resource->id;?>" onclick="return confirm('Are you sure you want to delete?')"><img src="<?PHP echo base_url();?>assets/images/administration/icons/del.gif"/></a>--></td>
         
          </tr> 
		  <?PHP 
		  $i++;
		  }
		  ?>
        </table>
	</td>
  </tr>
  <?PHP }?>
  
</table>
</body>
</html>
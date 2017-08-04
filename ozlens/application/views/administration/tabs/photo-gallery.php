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
 <form name="form1"  method="post" enctype="multipart/form-data" action="<?PHP echo base_url();?>administration/products/gallery_upload<?PHP if(isset($image_data)){echo "?image_id=".$image_data->id;}?>">

 	<table border="0" cellspacing="0" cellpadding="0" align="left" >
     <tr>
        <td style="padding-left:15px;"><label><strong>Caption:</strong></label>&nbsp;&nbsp;</td>
        <td><input size="30" name="photo_caption" id="photo_caption" type="text" placeholder="Caption" value="<?PHP if($this->input->post('photo_caption')){echo $this->input->post('photo_caption');}else if(isset($image_data)){echo $image_data->photo_caption;}?>"/></td>
        <td>&nbsp;</td>
        <td><label><strong>Featured:</strong></label></td>
        <td>
        	<select name="is_featured" id="is_featured">
            	<option value="No" <?PHP if(isset($image_data) && $image_data->is_featured == 'No'){echo "Selected";}?>>No</option>
            	<option value="Yes" <?PHP if(isset($image_data) && $image_data->is_featured == 'Yes'){echo "Selected";}?>>Yes</option>
            </select>
        </td>
        <td>&nbsp;</td>
        <td><label><strong>Photo:</strong></label></td>
        <td><input type="file" name="photo_image" id="photo_image"/></td>
        <td>&nbsp;</td>
        <td>
        	<input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />

         	<?PHP if($this->input->get('image_id')){?>
            &nbsp;<input type="button" value="Cancel" onclick="window.location='<?PHP echo base_url();?>administration/products/gallery_iframe/<?PHP if(isset($product_id)){echo $product_id;}?>'" />
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

  <?PHP if($images){?>
  <tr>
  	<td>
    	<table border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td colspan="100%" style="height:8px;"><h1>Current Photos:</h1></td>
        </tr>
          <tr>
          <?PHP
          $tr = 0;
		  foreach($images as $image)
		  {
		  ?>
            <td valign="top">
            	<table width="175" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="<?php echo base_url();?>administration/products/get_image/<?php echo $image->photo_image;?>/155/155" alt="" id="field" class="img" /></td>
                    <td valign="top">
                     <form method="post" style="display:inline;" action="<?PHP echo base_url();?>administration/products/del_image">
                        <input onclick="return confirm('Are you sure to delete this image?');" type="image" src="<?php echo base_url("assets/images/administration/icons/delete.gif")?>" alt="Delete" title="Delete" border="0"  />
                        <input type="hidden" name="delimage" value="<?php echo $image->id; ?>" />
                    </form>

                    <a href="<?PHP echo base_url();?>administration/products/gallery_iframe/<?PHP echo $product_id;?>?image_id=<?PHP echo $image->id;?>"><img style="margin-top:5px;" src="<?PHP echo base_url();?>assets/images/administration/icons/edit.png"/></a>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
					<?PHP if($image->photo_caption!=""){echo $image->photo_caption;}?>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
            </td>
            <td>&nbsp;&nbsp;</td>
          <?PHP
              $tr++;

              if($tr == 6)
              {
                  $tr = 0;
                  echo "</tr><tr><td colspan='100%'>&nbsp;</td></tr><tr>";
              }
		  }
		  ?>
          </tr>
        </table>
	</td>
  </tr>
  <?PHP }?>

</table>
</body>
</html>
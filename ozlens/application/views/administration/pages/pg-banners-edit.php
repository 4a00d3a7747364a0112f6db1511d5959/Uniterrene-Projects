<h1><?PHP echo $page_title;?></h1>
<table width="100%"  border="0" cellspacing="3" cellpadding="0">
    <tr>
        <td style="background-color:#f2f2f2;" >
            <form name="form1"  method="post" enctype="multipart/form-data" action="<?PHP echo base_url();?>administration/banners/gallery_upload<?PHP if(isset($image_data)){echo "?image_id=".$image_data->id;}?>">

                <table border="0" cellspacing="0" cellpadding="0" align="left" >
                    <tr>
                        <td style="padding-left:15px;"><label><strong>URL:</strong></label>&nbsp;&nbsp;</td>
                        <td><input size="60" name="photo_url" id="photo_url" type="text" placeholder="URL" value="<?PHP if($this->input->post('photo_url')){echo $this->input->post('photo_url');}else if(isset($image_data)){echo $image_data->photo_url;}?>"/></td>
                        <td>&nbsp;</td>
                        <td><label><strong>Photo:</strong></label></td>
                        <td><input type="file" name="photo_image" id="photo_image"/></td>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />

                            <?PHP if($this->input->get('image_id')){?>
                                &nbsp;<input type="button" value="Cancel" onclick="window.location='<?PHP echo base_url();?>administration/banners/<?PHP if(isset($product_id)){echo $product_id;}?>'" />
                            <?PHP }?>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <!--<td style="color:#930;"><?PHP /*if(isset($error) && $error !=""){echo $error;}*/?><?php /*echo $this->session->flashdata('response');*/?></td>-->
                    </tr>
                </table>
            </form>

        </td>
    </tr>

    <?PHP if($images){?>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="100%" style="height:8px;"><h1>Banners:</h1></td>
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
                                        <td><img src="<?php echo base_url();?>administration/banners/get_image/<?php echo $image->photo_image;?>/155/155" alt="" id="field" class="img" /></td>
                                        <td valign="top">
                                            <form method="post" style="display:inline;" action="<?PHP echo base_url();?>administration/banners/del_image">
                                                <input onclick="return confirm('Are you sure to delete this image?');" type="image" src="<?php echo base_url("assets/images/administration/icons/delete.gif")?>" alt="Delete" title="Delete" border="0"  />
                                                <input type="hidden" name="delimage" value="<?php echo $image->id; ?>" />
                                            </form>

                                            <a href="<?PHP echo base_url();?>administration/banners?image_id=<?PHP echo $image->id;?>"><img style="margin-top:5px;" src="<?PHP echo base_url();?>assets/images/administration/icons/edit.png"/></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <?PHP if($image->photo_url!=""){echo $image->photo_url;}?>
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
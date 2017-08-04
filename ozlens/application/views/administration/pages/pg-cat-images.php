<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>---</title>

<style type="text/css">

body
{
	font-family: arial, helvetica, sans-serif;
}

/* You can alter this CSS in order to give Smooth Div Scroll your own look'n'feel */

/* Invisible left hotspot */
div.scrollingHotSpotLeft
{
    /* The hotspots have a minimum width of 100 pixels and if there is room the will grow
    and occupy 15% of the scrollable area (30% combined). Adjust it to your own taste. */
    min-width: 75px;
    width: 10%;
    height: 100%;
    /* There is a big background image and it's used to solve some problems I experienced
    in Internet Explorer 6. */
    background-image: url(<?PHP echo base_url();?>assets/slider/images/big_transparent.gif);
    background-repeat: repeat;
    background-position: center center;
    position: absolute;
    z-index: 200;
    left: 0;
    /*  The first url is for Firefox and other browsers, the second is for Internet Explorer */
    cursor: url(<?PHP echo base_url();?>assets/slider/images/cursors/cursor_arrow_left.png), url(<?PHP echo base_url();?>assets/slider/images/cursors/cursor_arrow_left.cur),w-resize;
}

/* Visible left hotspot */
div.scrollingHotSpotLeftVisible
{
    background-image: url(<?PHP echo base_url();?>assets/slider/images/arrow_left.gif);
    background-color: #fff;
    background-repeat: no-repeat;
    opacity: 0.35; /* Standard CSS3 opacity setting */
    -moz-opacity: 0.35; /* Opacity for really old versions of Mozilla Firefox (0.9 or older) */
    filter: alpha(opacity = 35); /* Opacity for Internet Explorer. */
    zoom: 1; /* Trigger "hasLayout" in Internet Explorer 6 or older versions */
}

/* Invisible right hotspot */
div.scrollingHotSpotRight
{
    min-width: 75px;
    width: 10%;
    height: 100%;
    background-image: url(<?PHP echo base_url();?>assets/slider/images/big_transparent.gif);
    background-repeat: repeat;
    background-position: center center;
    position: absolute;
    z-index: 200;
    right: 0;
    cursor: url(<?PHP echo base_url();?>assets/slider/images/cursors/cursor_arrow_right.png), url(<?PHP echo base_url();?>assets/slider/images/cursors/cursor_arrow_right.cur),e-resize;
}

/* Visible right hotspot */
div.scrollingHotSpotRightVisible
{
    background-image: url(<?PHP echo base_url();?>assets/slider/images/arrow_right.gif);
    background-color: #fff;
    background-repeat: no-repeat;
    opacity: 0.35;
    filter: alpha(opacity = 35);
    -moz-opacity: 0.35;
    zoom: 1;
}

/* The scroll wrapper is always the same width and height as the containing element (div).
   Overflow is hidden because you don't want to show all of the scrollable area.
*/
div.scrollWrapper
{
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

div.scrollableArea
{
    position: relative;
    width: auto;
    height: 100%;
}
#makeMeScrollable
{
	width:100%;
	/*height: 110px;*/
	position: relative;
	padding-top:10px;

}

#makeMeScrollable div.scrollableArea img
{
	position: relative;
	float: left;
	margin: 0;
	padding: 0;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-o-user-select: none;
	user-select: none;
}
</style>
       
<script src="<?php echo base_url(); ?>assets/slider/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slider/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>	
<script src="<?php echo base_url(); ?>assets/slider/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/slider/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
							   
		$("#makeMeScrollable").smoothDivScroll({
			mousewheelScrolling: "allDirections"
		});						
		
	});
</script>

</head>

<body style="margin-left:3px;margin-right:3px;margin-bottom:0px;margin-top:0px;">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td>

<!--<div id="makeMeScrollable">-->
    <div style="padding-top:10px;">
        <table cellpadding="0" cellspacing="0">
        <tr>
			<?php
            foreach($images as $image)
            {
            ?>
            
                <td valign="top">
                    <img src="<?php echo base_url();?>administration/categories/get_image/<?php echo $image->image;?>/155/95" alt="" id="field" class="img" />
                </td>
                <td valign="top">
                    <form method="post" style="display:inline;" action="<?PHP echo base_url();?>administration/categories/del_image">
                        <input onclick="return confirm('Are you sure to delete this image?');" type="image" src="<?php echo base_url("assets/images/administration/icons/delete.gif")?>" alt="Delete" title="Delete" border="0"  />
                        <input type="hidden" name="delimage" value="<?php echo $image->id; ?>" />
                    </form>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            
            <?php 
            } 
            ?>		        
        </tr>
        </table>
    </div>
<!--</div>-->

</td>
</tr>

<?PHP if(count($images) <5){?>

<tr>
    <td colspan="100%" style="height: 5px;"></td>
</tr>

<tr>
<td>
    <form name="form1"  method="post" enctype="multipart/form-data" action="<?PHP echo base_url();?>administration/categories/gallery_upload">
        <input type="file" name="img" id="img" style="font-size:11px;" />&nbsp;
        <input  style="font-size:11px;" type="submit" name="submitbtn" value="Upload" />&nbsp;
        <font style="color:#F00; font-size:11px;"><strong><?PHP if(isset($error) && $error !=""){echo $error;}?><?php echo $this->session->flashdata('response');?></strong></font>
        <input type="hidden" name="cat_id" id="cat_id" value="<?PHP if(isset($cat_id)){echo $cat_id;}?>"/>
    </form>
</td>
</tr>
<?PHP }?>
</table>
</body>
</html>
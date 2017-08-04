<form id="categoriesFrm" name="categoriesFrm"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
    	<td>         
        <?PHP 		
		if(isset($p_id))
		{				
			$parent_ids = $this->categories_model->get_parent_cat_ids_array($p_id,TRUE,$inc_cat_id);
			?>
             <p id="categories_dd_lists">
            	<label>*<strong>Parent Category:</strong></label>   
                
                <?PHP 
				if($parent_ids)
				{					
					for($i=0;$i<sizeof($parent_ids);$i++)
					{
						?>               
						<select id="p_id" name="p_id[]" class="parent required" style="float:left; margin-right:5px;">
						<option value="0" selected="selected">-- Parent --</option>
							<?php
							$cats = $this->db_model->get_rows('categories',array('p_id'=>$parent_ids[$i]));
							foreach($cats as $cat)
							{
								?>
								<option value="<?php echo $cat->id;?>" <?PHP if(in_array($cat->id,$parent_ids)){echo "Selected";}?>><?php echo $cat->cat_name;?></option>
								<?PHP
							}
							?>
						</select>              		            
						<?PHP						
					}
				}
				?>
                </p>
            	<?PHP
				}
				else
				{
				?>     
				
                <p id="categories_dd_lists">
                    <label>*<strong>Parent Category:</strong></label>                  
                     <select id="p_id" name="p_id[]" class="parent required" style="float:left; margin-right:5px;">
                        <option value="0" selected="selected">-- Parent --</option>
                        <?php
                        $cats = $this->db_model->get_rows('categories',array('p_id'=>0));
                        foreach($cats as $cat)
                        {
                            ?>
                            <option value="<?php echo $cat->id;?>"><?php echo $cat->cat_name;?></option>
                            <?PHP
                        }
                        ?>
                      </select> 
                </p> 
					
				<?PHP 
                }
                ?>
            
            <p>&nbsp;</p>  
          
           <p>
                <label>*<strong>Category Name:</strong></label>
                <input size="60" name="cat_name" id="cat_name" type="text" value="<?PHP echo set_value('cat_name',$row->cat_name);?>" onkeyup="generateSlug('slug',this.value);" onkeydown="generateSlug('slug',this.value);" onblur="generateSlug('slug',this.value);" class="required"/>
            </p>

            <p>
                <label>*<strong>Slug:</strong></label>
                <input size="60" name="slug" id="slug" type="text" value="<?PHP echo set_value('slug',$row->slug);?>" class="required" readonly/>
            </p>
            
             <p>
                <label>*<strong>Status:</strong></label>
                <select name="status" id="status" class="required">
                    <option value="">Select</option>
                    <option value="Enabled" <?PHP if($row->status == 'Enabled'){echo set_select('status', 'Enabled', true);}else{echo set_select('status', 'Enabled'); }?>>Enabled</option>
                    <option value="Disabled"  <?PHP if($row->status == 'Disabled'){echo set_select('status', 'Disabled', true);}else{echo set_select('status', 'Disabled'); }?>>Disabled</option>
                </select>
            </p>

            <p>
            	<label>*<strong>Description:</strong></label>
                <textarea name="description" id="description" class="required"><?PHP echo set_value('description',$row->description);?></textarea>
                
            </p>

            <p>
                <label><strong>Category Images </strong>["<?PHP echo $this->config->item('image_types');?>"]</label>
                <iframe src="<?php echo base_url(); ?>administration/categories/cat_images/<?php echo $row->id; ?>" width="100%" height="145" frameborder="0" scrolling="no" style="border: 0px solid #ddd;"></iframe>
            </p>

            <p>
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />
                <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/categories'" value="cancel"/>
            </p>

        </td>
    </tr>

</table>
<input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
</fieldset>
</form>


<script type="text/javascript" src="<?PHP echo base_url();?>assets/ajax_cats/jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/ajax_cats/jquery.livequery.js"></script>
<script type="text/javascript">

$ajaxCats =  $.noConflict();

$ajaxCats(document).ready(function() {
	
	//$ajaxCats('#loader').hide();
	
	$ajaxCats('.parent').livequery('change', function() {
		
		loadDDs($(this));
	});
});

function loadDDs(obj)
{
		$ajaxCats(obj).nextAll().remove();
		//$(this).nextAll('label').remove();
		
		$ajaxCats('#categories_dd_lists').append('<img src="<?PHP echo base_url();?>assets/ajax_cats/loader.gif" style="float:left; margin-top:7px; text-align:left;"  alt="" id="loader" />');
		
		$ajaxCats.post("<?PHP echo base_url();?>administration/categories/get_chid_categories", {
			parent_id: obj.val()
		}, function(response){			
			setTimeout("finishAjax('categories_dd_lists', '"+escape(response)+"')", 400);
		});
		
		return false;
}

function finishAjax(id, response){
  $ajaxCats('#loader').remove();
  $ajaxCats('#'+id).append(unescape(response));
} 


$jqvalidation(document).ready(function() {

    $jqvalidation('#btnSubmit').click(function() {
        var content = tinyMCE.activeEditor.getContent(); // get the content
        $('#description').val(content); // put it in the textarea
    });

    $jqvalidation("#categoriesFrm").validate({});
	
});
</script>
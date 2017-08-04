<form id="productsFrm" name="productsFrm"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
    	<td>
           <p>
                <label>*<strong>Product Title:</strong></label>
                <input size="60" name="product_title" id="product_title" type="text" value="<?PHP echo set_value('product_title',$row->product_title);?>" onkeyup="generateSlug('slug',this.value);" onkeydown="generateSlug('slug',this.value);" onblur="generateSlug('slug',this.value);" class="required"/>
            </p>

            <p>
                <label>*<strong>Slug:</strong></label>
                <input size="60" name="slug" id="slug" type="text" value="<?PHP echo set_value('slug',$row->slug);?>" class="required" readonly/>
            </p>

            <p>
                <label>*<strong>Stock No:</strong></label>
                <input size="60" name="stock_no" id="stock_no" type="text" value="<?PHP echo set_value('stock_no',$row->stock_no);?>" class="required"/>
            </p>

          <!--  <p>
                <label>*<strong>Postage Amount:</strong></label>
                <input size="60" name="postage_amount" id="postage_amount" type="text" value="<?PHP //echo set_value('postage_amount',$row->postage_amount);?>" class="required"/>
            </p>
            -->
               <p>
                <label><strong>Replacement Value:</strong></label>
                <input size="60" name="replacement_value" id="replacement_value" type="text" value="<?PHP echo set_value('replacement_value',$row->replacement_value);?>" class="required"/>
            </p>

            <p>
                <label>*<strong>Default Rental Days:</strong></label>
                <select name="default_rental_days" id="default_rental_days" class="required">
                    <option value="">Select</option>
                    <?PHP 
					$rental_days = $this->db_model->get_table('rental_periods');
					foreach($rental_days as $rd)
					{
					?>
                  		<option value="<?PHP echo $rd->no_of_days;?>" <?PHP if($row->default_rental_days == $rd->no_of_days){echo set_select('default_rental_days', $row->default_rental_days, true);}else{echo set_select('default_rental_days', $rd->no_of_days); }?>><?PHP echo $rd->no_of_days;?> days</option>                    
                    <?PHP 
					}
					?>
                </select>
            </p>
            
            <p>
                <label>*<strong>Featured:</strong></label>
                <select name="featured" id="featured" class="required">
                    <option value="">Select</option>
                    <option value="Yes" <?PHP if($row->featured == 'Yes'){echo set_select('featured', 'Yes', true);}else{echo set_select('featured', 'Yes'); }?>>Yes</option>
                    <option value="No"  <?PHP if($row->featured == 'No'){echo set_select('featured', 'No', true);}else{echo set_select('featured', 'No'); }?>>No</option>
                </select>
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
                <label><strong>Meta Description:</strong></label>
                <textarea name="metas" style="width:100%;" rows="8"><?PHP echo set_value('metas',$row->metas);?></textarea>
                </p>
            
            <p>
            
                    <div id="tabs">
                        
                        <ul>

                                <li><a href="#overview_tab" onclick="set_post_back_tab_id(0);">Overview</a></li>
                            
                                <li><a href="#specs_tab" onclick="set_post_back_tab_id(1);">Specifications</a></li>
                            
                                <li><a href="#includes_tab" onclick="set_post_back_tab_id(2);">Includes</a></li>
                                
                                <li><a href="#works_well_with_tab" onclick="set_post_back_tab_id(3);">Works Well With</a></li>
                                
                                <li><a href="#in_case_you_need_it_tab" onclick="set_post_back_tab_id(4);">In Case You Need it</a></li>
                                
                                <li><a href="#resouces_tab" onclick="set_post_back_tab_id(5);">Resources</a></li>
                                
                                <li><a href="#pricing_tab" onclick="set_post_back_tab_id(6);">Pricing</a></li>
                                
                                <li><a href="#photo_gallery_tab" onclick="set_post_back_tab_id(7);">Photo Gallery</a></li>

                                <li><a href="#cat_tab" onclick="set_post_back_tab_id(8);">Categories</a></li>

                        </ul>
                        
                        <div class="tab-pane" id="overview_tab">                         
                      		<?PHP echo $this->load->view('administration/tabs/overview');?>
                        </div>
                        
                        <div class="tab-pane" id="specs_tab">
                           <?PHP echo $this->load->view('administration/tabs/specifications');?>
                        </div>
                        
                        <div class="tab-pane" id="includes_tab">
                           <?PHP echo $this->load->view('administration/tabs/includes');?>
                        </div>
                        
                        <div class="tab-pane" id="works_well_with_tab">
                           <?PHP echo $this->load->view('administration/tabs/works-well-with');?>
                        </div>
                        
                        <div class="tab-pane" id="in_case_you_need_it_tab">
                           <?PHP echo $this->load->view('administration/tabs/in-case-you-need-it');?>
                        </div> 
                        
                        <div class="tab-pane" id="resouces_tab">
                           <iframe src="<?php echo base_url(); ?>administration/products/resources_iframe/<?php echo $row->id; ?>" width="100%" height="300" frameborder="0" scrolling="auto" style="border: 0px solid #ddd; background-color:transparent;"></iframe>
                        </div>
                        
                        <div class="tab-pane" id="pricing_tab">
                           <?PHP echo $this->load->view('administration/tabs/pricing');?>
                        </div>
                        
                        <div class="tab-pane" id="photo_gallery_tab">                        	
                           <iframe src="<?php echo base_url(); ?>administration/products/gallery_iframe/<?php echo $row->id; ?>" width="100%" height="300" frameborder="0" scrolling="auto" style="border: 0px solid #ddd; background-color:transparent;"></iframe>
                        </div>

                        <div class="tab-pane" id="cat_tab">
                            <?PHP echo $this->load->view('administration/tabs/categories');?>
                        </div>
            
            	
            </p>
            
            
            
            

            

            <!--<p>
                <label><strong>Category Images </strong>["<?PHP echo $this->config->item('image_types');?>"]</label>
                <iframe src="<?php echo base_url(); ?>administration/categories/cat_images/<?php echo $row->id; ?>" width="100%" height="145" frameborder="0" scrolling="no" style="border: 0px solid #ddd;"></iframe>
            </p>-->

            <p>
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />
                <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/products'" value="cancel"/>
            </p>

        </td>
    </tr>

</table>
<input type="hidden" name="tab_id" id="tab_id" value="" />
<input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
</fieldset>
</form>


<!--Tabs Include-->
<script src="<?PHP echo base_url();?>assets/tabs/jquery-1.10.2.js"></script>
<script src="<?PHP echo base_url();?>assets/tabs/jquery-ui.js"></script>
<script>
$jqtabs =  $.noConflict();

function set_post_back_tab_id(tb_id)
{
	document.getElementById('tab_id').value = tb_id;
}
</script>
<!--Tabs Include End-->

<!-- Validation start -->
<script>
$jqvalidation(document).ready(function() {

	$jqvalidation('#btnSubmit').click(function() {
        
		for (i=0; i < tinymce.editors.length; i++)
		{
			var content = tinymce.editors[i].getContent(); // get the content
					
			$('#'+tinymce.editors[i].id).val(content); // put it in the textarea
		}
    });
	
	$jqtabs("#tabs").tabs({
		
		<?PHP if($this->input->post('tab_id')){?>	
			 active: <?PHP echo $this->input->post('tab_id');?>
		<?PHP }?>		
		
		});

    $jqvalidation("#productsFrm").validate({
		
		ignore: ".ignore",
				
				invalidHandler: function(e, validator)
				{
					tab_id = $jqvalidation(validator.errorList[0].element).closest(".tab-pane").attr('id');	
					if(tab_id)
					{								
						var index = $jqtabs('#tabs a[href="#'+tab_id+'"]').parent().index();
						//alert(index);
						$jqtabs("#tabs").tabs("option", "active", index);
					}
					
				}
		
		});
	
});
<!-- Validation End -->
</script>



<SCRIPT language="javascript">
function addRow(tableID) {

	var table = document.getElementById(tableID);

	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var colCount = table.rows[0].cells.length;

	for(var i=0; i<colCount; i++) {

		var newcell = row.insertCell(i);

		newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		//alert(newcell.childNodes);
		switch(newcell.childNodes[0].type) {
			case "text":
					newcell.childNodes[0].value = "";
					break;
			case "checkbox":
					newcell.childNodes[0].checked = false;
					break;
			case "select-one":
					newcell.childNodes[0].selectedIndex = 0;
					break;
		}
	}
}

function deleteRow(tableID) {
	try {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var selectRowCount = table.rows.length;
	var selectCount = 0;
	
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) {
				alert("Cannot delete all the rows.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
		else
		{
			selectCount++;
		}
	}
	
	if(selectCount == selectRowCount)
	{
		alert('One record should be selected.')
	}
	
	
	}catch(e) {
		alert(e);
	}
}
</SCRIPT>
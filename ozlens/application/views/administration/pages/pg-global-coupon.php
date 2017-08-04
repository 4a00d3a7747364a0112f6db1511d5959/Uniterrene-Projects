<style>
tfoot {
    display: table-header-group;
	vertical-align:top;
}
</style>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	 initDataTables();
});	
	
function initDataTables(){	
 $('#example').dataTable( {

		"bJQueryUI": true,	
		"aLengthMenu": [[10, 25 , 50, 100, -1],[10, 25 , 50, 100, "All"]],     
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bStateSave": true,
		"bAutoWidth": false,		
		"sDom": '<"H"CTlfr>t<"F"ilp>',
		
		"oTableTools": 
			{
				"aButtons": 
				[
                    "xls"
				]			
		},  				
				
		"aoColumns": [					
						{ "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/globalcoupon/del/','del.gif',obj.aData[7],true);}},
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/globalcoupon/index/','edit.gif',obj.aData[8],false);}}
					 ],
		
					 
		

		"sAjaxSource": "<?PHP echo base_url()?>administration/globalcoupon/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					null,
                    null,
                    null,
                   	null,
                    null,
                    null,
                    null,
					null,
					null
				]
		});			
}


</script>

<?php if($id != '') {?>
<form id="templatesFrm1" name="templatesFrm1"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2>Global Discount Coupon</h2></legend>
<p>
                <label>*<strong>Title:</strong></label>
                <input size="60" name="title" id="title" type="text" class="validate[required]" value="<?php echo $row->title; ?>"/>
            </p>
            


            <p>
                <label>*<strong>Code:</strong></label>
                <input size="60" name="code" id="code" type="text" class="validate[required]" value="<?php echo $row->code; ?>"/>
            </p>
            
            
             <p>
               <label>*<strong>Discount Type :</strong></label>
                <select name="discount_type" id="discount_type" class="validate[required]">
                    <option value="PERCENTAGE" <?php if($row->discount_type == 'PERCENTAGE'){ ?>selected="selected"<?php }?>>PERCENTAGE</option>
                    <option value="AMOUNT" <?php if($row->discount_type == 'AMOUNT'){ ?>selected="selected"<?php }?>>AMOUNT</option>                    
                    </select>
                    </p>

            
              
            
            <p>
                <label>*<strong>Discount Value :</strong></label>
                <input size="60" name="discount_val" id="discount_val" type="text" value="<?php echo $row->discount_val; ?>" class="validate[required]"/>
            </p>
            
            
             <p>
                <label>*<strong>Start Date :</strong></label>
                <input size="60" name="start_date" id="start_date" type="text" value="<?php echo $row->start_date; ?>" class="validate[required] date"/>
            </p>
            
             <p>
                <label>*<strong>Expiration Date :</strong></label>
                <input size="60" name="end_date" id="end_date" type="text" value="<?php echo $row->end_date; ?>" class="validate[required] date"/>
            </p>
            
            <p>
               <label>*<strong>Status :</strong></label>
                <select name="status" id="status" class="validate[required]">
                    <option value="ACTIVE" <?php if($row->status == 'ACTIVE'){ ?>selected="selected"<?php }?>>ACTIVE</option>
                    <option value="INACTIVE" <?php if($row->status == 'INACTIVE'){ ?>selected="selected"<?php }?>>INACTIVE</option>                    
                    </select>
                    </p>
            
             <p>
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" /> 
            <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/globalcoupon';" value="Cancel"/>
         </p>
            
</fieldset>
</form>
<br /><br />
<?php } else {?>
 <p>

            <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/globalcoupon/index/add';" value="Add New Code"/>
         </p>
<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
            <th align="left"><strong>Title</strong></th>
            <th align="left"><strong>Code</strong></th>
            <th align="left"><strong>Discount Type</strong></th>
            <th align="left"><strong>Discount Value</strong></th>
            <th align="left"><strong>Start Date</strong></th>            
            <th align="left"><strong>End Date</strong></th>            
            <th align="left"><strong>Status</strong></th>
            <th align="left"></th>
            <th align="left"></th>
      </tr>
    </thead>
   
</table>
<?php }?>
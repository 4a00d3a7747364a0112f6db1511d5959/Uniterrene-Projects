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
        "bSort":false,
		"aLengthMenu": [[10, 25 , 50, 100, -1],[10, 25 , 50, 100, "All"]],     
		"sPaginationType": "full_numbers",
		"bProcessing": true,
		"bStateSave": false,
		"bAutoWidth": false,		
		"sDom": '<"H"CTlfr>t<"F"ilp>',
        "iDisplayLength": -1, // To display all records be default
		
		"oTableTools": 
			{
				"aButtons": 
				[
                    {
                        "sExtends":    "text",
                        "sButtonText": "Add New",
                        "fnClick": function ( nButton, oConfig, oFlash )
                        {
                            window.location = '<?PHP echo base_url();?>administration/categories/add';
                        }
                    }
				]			
		},  				
				
		"aoColumns": [
                        { "sWidth": "auto","bSortable": false },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "100" }
					 ],
		
		"sAjaxSource": "<?PHP echo base_url()?>administration/categories/grid/<?PHP echo $p_id;?>"
		
	} )
	
	.columnFilter({
			aoColumns: [
                    null,
					{type: "select",values:['Enabled','Disabled']},
                    null,
                    null
				]
		});			
}
</script>

<h1><?php echo $page_title; ?></h1>

<form method="get" name="pc_form" id="pc_form" action="">
    <p>
        <label><strong>Parent Categories:</strong></label>
        <select id="p_id" name="p_id" onchange="document.getElementById('pc_form').submit();">
            <option value="0">All</option>
            <?php
            foreach($cats as $cat)
            {
            ?>
                <option value="<?php echo $cat->id;?>" <?PHP if($p_id == $cat->id){echo "selected";}?>><?php echo $cat->cat_name;?></option>
            <?PHP
            }
            ?>
        </select>
    </p>
</form>

<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
            <th align="left"><strong>Category Name</strong></th>
            <th align="left"><strong>Status</strong></th>
            <th align="left"><strong>Last Modified</strong></th>
            <th align="left"></th>

      </tr>
    </thead>
    <tfoot>
     <tr>
         <th align="left"></th>
         <th align="left">All</th>
         <th align="left"></th>
         <th align="left"></th>
      </tr>
    </tfoot>
</table>
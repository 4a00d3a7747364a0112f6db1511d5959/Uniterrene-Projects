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
                    {
                        "sExtends":    "text",
                        "sButtonText": "Add New",
                        "fnClick": function ( nButton, oConfig, oFlash )
                        {
                            //open_popup_refresh('<?PHP echo base_url();?>administration/content/add');
							window.location = '<?PHP echo base_url();?>administration/content/add';
                        }
                    }
				]			
		},  				
				
		"aoColumns": [					
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/content/edit/','edit.gif',obj.aData[3],false);}},
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/content/del/','del.gif',obj.aData[4],true);}}
					 ],
		
		"sAjaxSource": "<?PHP echo base_url()?>administration/content/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					{type: "text"},
					{type: "text"},
                    null,
					null,
					null
					
				]
		});			
}

</script>

<h1><?php echo $page_title; ?></h1>

<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
        <th align="left"><strong>Title</strong></th>
        <th align="left"><strong>Slug</strong></th>
        <th align="left"><strong>Last Modified</strong></th>
        <th align="left"></th>
        <th align="left"></th>
      </tr>
    </thead>
    <tfoot>
     <tr>
        <th align="left"></th>
        <th align="left"></th>
        <th align="left"></th>
        <th align="left"></th>
        <th align="left"></th>
      </tr>
    </tfoot>
</table>
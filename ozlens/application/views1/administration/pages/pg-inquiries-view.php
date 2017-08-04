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
                    /*{
                        "sExtends":    "text",
                        "sButtonText": "Add New",
                        "fnClick": function ( nButton, oConfig, oFlash )
                        {
                            open_popup_refresh('<?PHP echo base_url();?>administration/inquiries/add');
                        }
                    }*/
				]			
		},  				
				
		"aoColumns": [
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
                        { "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/inquiries/reply/','reply.png',obj.aData[5],false);}}
						
					 ],
		
		"sAjaxSource": "<?PHP echo base_url()?>administration/inquiries/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					{type: "text"},
					{type: "text"},
					{type: "text"},
					{type: "text"},
					{type: "text"},
                   
                    null
				]
		});			
}
</script>

<h1><?php echo $page_title; ?></h1>

<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
            <th width="13%" align="left">Name</th>
            <th width="13%" align="left">Email Address</th>
            <th width="13%" align="left">Product </th>
            <th width="39%" align="left">Message</th>
            <th width="15%" align="left">Last Modified</th>
            <th width="7%" align="left"></th>
            
      </tr>
    </thead>
    <tfoot>
     <tr>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
        
      </tr>
    </tfoot>
</table>
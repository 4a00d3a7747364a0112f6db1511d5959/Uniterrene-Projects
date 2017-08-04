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
                  /*  {
                        "sExtends":    "text",
                        "sButtonText": "Add New",
                        "fnClick": function ( nButton, oConfig, oFlash )
                        {
                            //open_popup_refresh('<?PHP echo base_url();?>administration/content/add');
							window.location = '<?PHP echo base_url();?>administration/content/add';
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
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/orders/edit/','edit.gif',obj.aData[5],false);}},
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/orders/del/','del.gif',obj.aData[6],true);}}
					 ],
		
		"sAjaxSource": "<?PHP echo base_url()?>administration/orders/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					{type: "text"},
					{type: "text"},
					{type: "text"},
					{type: "select"},
                    {type: "date-range"},
					null,
					null
					
				]
		});			
}
$.datepicker.regional[""].dateFormat = 'D, MM d, yy';
$.datepicker.setDefaults($.datepicker.regional['']);
</script>

<h1><?php echo $page_title; ?></h1>

<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
        <th align="left"><strong>Order No</strong></th>
        <th align="left"><strong>Name</strong></th>
        <th align="left"><strong>Order Amount</strong>&nbsp;(<?PHP echo $this->config->item('currency_symbol');?>)</th>
        <th align="left"><strong>Order Status</strong></th>
        <th align="left"><strong>Order Date</strong></th>
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
        <th align="left"></th>
        <th align="left"></th>
      </tr>
    </tfoot>
</table>
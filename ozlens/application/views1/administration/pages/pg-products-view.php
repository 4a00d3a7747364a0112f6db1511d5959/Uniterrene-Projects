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
                    "xls",
                    {
                        "sExtends":    "text",
                        "sButtonText": "Add New",
                        "fnClick": function ( nButton, oConfig, oFlash )
                        {
                            //open_popup_refresh('<?PHP echo base_url();?>administration/products/add');
							window.location = '<?PHP echo base_url();?>administration/products/add';
                        }
                    }
				]			
		},  				
				
		"aoColumns": [			
						{ "sWidth": "auto" },	
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
                        { "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_simple_link('<?=base_url()?>administration/products/updateQuantity/'+obj.aData[7],obj.aData[3]);}},
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/products/edit/','edit.gif',obj.aData[7],false);}},
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/products/del/','del.gif',obj.aData[8],true);}}
						/*{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/products/duplicate/','duplicate.png',obj.aData[8],false);}}*/
					 ],
		
		"sAjaxSource": "<?PHP echo base_url()?>administration/products/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					{type: "text"},
					null,
                    {type: "text"},
					null,
					{type: "select", values:['Yes','No']},
                    {type: "select", values:['Enabled','Disabled']},
					{type: "date-range"}
					/*null*/
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
        <th align="left"><strong>Product Title</strong></th>
        <th align="left"><strong>Slug</strong></th>
        <th align="left"><strong>Stock No</strong></th>
        <th align="left"><strong>Quantity</strong></th>
        <th align="left"><strong>Featured</strong></th>
        <th align="left"><strong>Status</strong></th>
        <th align="left"><strong>Last Modified</strong></th>
        <th align="left"></th>
        <th align="left"></th>
        <!--<th align="left"></th>-->
      </tr>
    </thead>
    <tfoot>
     <tr>
     	<th align="left"></th>
        <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
        <th align="left">All</th>
        <th align="left">All</th>
        <th align="left"></th>
        <th align="left"></th>
        <th align="left"></th>
        <!--<th align="left"></th>-->
      </tr>
    </tfoot>
</table>
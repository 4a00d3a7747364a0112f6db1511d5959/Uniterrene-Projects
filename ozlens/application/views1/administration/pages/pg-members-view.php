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
				[   "xls",
                    {
                        "sExtends":    "text",
                        "sButtonText": "Add New",
                        "fnClick": function ( nButton, oConfig, oFlash )
                        {
                           // open_popup_refresh('<?PHP echo base_url();?>administration/members/add');
						   window.location ='<?PHP echo base_url();?>administration/members/add';
                        }
                    }
				]			
		},  				
		"aoColumns": [					
						{ "sWidth": "auto" },                       
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
						{ "sWidth": "auto" },
                        { "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/members/sendActivationEmail/','send_emil.png',obj.aData[5],false);}},
						{ "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/members/edit/','edit.gif',obj.aData[10],false);}},
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/members/del/','del.gif',obj.aData[11],true);}}
					 ],
		

		"sAjaxSource": "<?PHP echo base_url()?>administration/members/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					{type: "text"},                    
					{type: "text"},
                    {type: "select", values:['Active','Suspended','Pending Confirmation']},
					null,
					{type: "select", values:['Yes','No']},
					null,
					{type: "date-range"},
                    {type: "date-range"},
                    null,
                   	null,
                    null,
                    null
				]
		});			
}
$.datepicker.regional[""].dateFormat = 'D, MM d, yy';
$.datepicker.setDefaults($.datepicker.regional['']);
</script>

<h1><?php echo $page_title; ?></h1>
<style>
/*#example_range_from_3{ width:85px; font-size:10px; padding:0px; margin:0px;}
#example_range_to_3{width:85px; font-size:10px; padding:0px; margin:0px;}*/
</style>
<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
            <th align="left"><strong>Name</strong></th>            
            <th align="left"><strong>Email</strong></th>
            <th align="left"><strong>Status</strong></th>
            <th align="left"><strong>greenID Status</strong></th>
            <th align="left"><strong>Newsletter</strong></th>
            <th align="left"><strong>Activation Email</strong></th>
            <th align="left"><strong>Registration Date</strong></th>
            <th align="left"><strong>Last Login</strong></th>
            <th align="left"><strong>IP</strong></th>
            <th align="left"><strong>Last Modified</strong></th>
            <th align="left"></th>
            <th align="left"></th>
      </tr>
    </thead>
    <tfoot>
     <tr>
         <th align="left"></th>         
         <th align="left"></th>
         <th align="left">All</th>
         <th align="left"></th>
         <th align="left">All</th>
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
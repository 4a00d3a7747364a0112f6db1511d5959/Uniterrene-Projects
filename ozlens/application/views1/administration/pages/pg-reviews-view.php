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
                            window.location ='<?PHP echo base_url();?>administration/reviews/add';
                        }
                    }
				]			
		},  				
				
		"aoColumns": [					

						{ "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto","bSortable": false, "fnRender": function(obj){return gen_stars(obj.aData[2]);}},
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "auto" },
                        { "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/reviews/edit/','edit.gif',obj.aData[6],false);}},
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/reviews/del/','del.gif',obj.aData[7],true);}}
					 ],
		

		"sAjaxSource": "<?PHP echo base_url()?>administration/reviews/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					{type: "select"},
					{type: "text"},
                    null,
                    {type: "text"},
                    {type: "select", values:['Approved','Pending']},
                    null,
                    null,
                    null
				]
		});			
}

function gen_stars(val)
{
    var starhtml = '';

    var stars = 0;

    var x = val.split('.');

    if(x[0]>0)
    {
        for(i=0;i<x[0];i++)
        {
            starhtml +='<img src="'+base_url+'assets/rating/img/star-on.png">';
            stars++;
        }
    }

    if(x[1]>0)
    {
        starhtml +='<img src="'+base_url+'assets/rating/img/star-half.png">';
        stars++;
    }

    if(stars <5)
    {
        for(i=stars;i<5;i++)
        {
            starhtml +='<img src="'+base_url+'assets/rating/img/star-off.png">';

        }
    }

    return starhtml;
}

</script>

<h1><?php echo $page_title; ?></h1>

<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
            <th align="left"><strong>Product Title</strong></th>
            <th align="left"><strong>Nick Name</strong></th>
            <th align="left"><strong>Rating</strong></th>
            <th align="left"><strong>Review</strong></th>
            <th align="left"><strong>Status</strong></th>
            <th align="left"><strong>Posted on</strong></th>
            <th align="left"></th>
            <th align="left"></th>
      </tr>
    </thead>
    <tfoot>
     <tr>
         <th align="left">All</th>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left">All</th>
         <th align="left"></th>
         <th align="left"></th>
         <th align="left"></th>
      </tr>
    </tfoot>
</table>
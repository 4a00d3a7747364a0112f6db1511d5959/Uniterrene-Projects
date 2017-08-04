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
						{ "sWidth": "2%","bSortable": false, "fnRender": function(obj){return gen_link('administration/giftcard/del/','del.gif',obj.aData[7],true);}}
					 ],
		

		"sAjaxSource": "<?PHP echo base_url()?>administration/giftcard/grid/"
		
	} )
	
	.columnFilter({
			aoColumns: [
					null,
					null,
                    null,
                    null,
                    {type: "select", values:['Yes','No']},
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

<form id="templatesFrm" name="templatesFrm"  enctype="multipart/form-data" method="post" action="">
<input type="hidden" id="code" name="code" value="<?=$code?>" />

<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
    	<td>
            <p>
                <label>*<strong>Receiver's email:</strong></label>
                <input size="60" name="receiver_email" id="receiver_email" type="text" class="validate[required]"/>
            </p>
            


            <p>
                <label>*<strong>Subject:</strong></label>
                <input size="60" name="subject" id="subject" type="text" value="" class="validate[required]"/>
            </p>
            
          <p>
            <label>*<strong>Amount:</strong>($)</label>
              
<input size="60" name="amount" id="amount" type="text" value="" class="validate[required]"/>
            </p>
            <p> <strong>Discount Code: <font color="green"><?php echo $code; ?></font></strong> (This is an  automaticallay generated code and will be added to database after you send it using this page.) </p>

        </td>
    </tr>
	<tr>
	  <td>
        <p>
            <label for="content">*<strong>Email Content:</strong></label>
            <textarea name="content" id="content" cols="" rows="" style="width:100%;height:350px;"><?PHP echo set_value('content',$email_temp);?><?PHP //echo $email_temp;?></textarea>
          </p>        
          
         <p>
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Send Email" /> 
            <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/templates'" value="cancel"/>
         </p>
      </td>
	  </tr>
</table>
<input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
</fieldset>
</form>
<br />

<table id="example" width="100%" cellpadding="0" cellspacing="0" class="dataTableGridNJ">
    <thead>
      <tr>
            <th align="left"><strong>Code</strong></th>
            <th align="left"><strong>Amount</strong></th>
            <th align="left"><strong>Date</strong></th>
            <th align="left"><strong>Email</strong></th>
            <th align="left"><strong>Redeemed</strong></th>            
            <th align="left"><strong>Redeemed By</strong></th>            
            <th align="left"><strong>Redeemed Date</strong></th>
            <th align="left"></th>
      </tr>
    </thead>
    <tfoot>
     <tr>
         <th align="left"></th>
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
<form id="productsFrm" name="productsFrm"  method="post" action="<?=base_url()?>administration/products/updateQuantity/<?=$id?>">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>
<?php
	if($this->session->flashdata('message')) {echo $this->session->flashdata('message');}
?>
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
    	<td>
           <p>
                <label>*<strong>Product Title:</strong></label>
				<?PHP echo set_value('product_title',$row->product_title);?>
            </p>

            <p>
                <label>*<strong>Quantity:</strong></label>
                <input size="60" name="quantity" id="quantity" type="text" value="<?PHP echo set_value('quantity',$row->quantity);?>"/>
            </p>
            <p>
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Update" />
                <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/products'" value="cancel"/>
            </p>

        </td>
    </tr>

</table>
</fieldset>
</form>

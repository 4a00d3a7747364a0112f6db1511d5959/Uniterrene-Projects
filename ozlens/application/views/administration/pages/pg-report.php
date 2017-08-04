<h1><?PHP echo $page_title;?></h1>
<table width="100%" border="1" style="border:1px solid #ccc; border-collapse:collapse;" cellspacing="0" cellpadding="3">
    <tr style="background-color:#f2f2f2; height:40px;" >
        <td width="29%"  style="border-color:#ccc;">Product Title</td>
        <td width="8%"  style="border-color:#ccc;">Stock No.</td>
        <td width="19%"  style="border-color:#ccc;">Rented by</td>
        <td width="7%"  style="border-color:#ccc;">Order ID</td>
        <td width="8%"  style="border-color:#ccc;">Rental Days</td>
        <td width="13%"  style="border-color:#ccc;">Start Date</td>
        <td width="16%"  style="border-color:#ccc;">Return Date</td>
    </tr>
    <?php foreach($mrows as $row){?>
    <tr >
      <td  style="border-color:#ccc;"><a href="<?php echo base_url(); ?>administration/products/edit/<?php echo $row->product_id;?>"><?php echo $row->product_title;?></a></td>
      <td  style="border-color:#ccc;"><?php echo $row->stock_no;?></td>
      <td  style="border-color:#ccc;"><a href="<?php echo base_url(); ?>administration/members/edit/<?php echo $row->member_id;?>"><?php echo $row->first_name." ".$row->middle_name." ".$row->last_name;?></a></td>
      <td  style="border-color:#ccc;"><a href="<?php echo base_url(); ?>administration/orders/edit/<?php echo $row->order_id;?>"><?php echo $row->order_id;?></a></td>
      <td  style="border-color:#ccc;"><?php echo $row->rental_days;?></td>
      <td  style="border-color:#ccc;"><?php echo date("F j, Y",strtotime($row->start_date));?></td>
      <td  style="border-color:#ccc;"><?php echo date("F j, Y",strtotime($row->return_date));?></td>
    </tr>
	<?php } ?>


</table>

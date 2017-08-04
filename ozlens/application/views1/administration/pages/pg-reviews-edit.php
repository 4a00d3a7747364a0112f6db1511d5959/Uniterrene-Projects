<?PHP
/**
 *@var $this CI_Controller
 */
?>

<form id="reviewFrm" name="reviewFrm"  enctype="multipart/form-data" method="post" action="">
<fieldset>
<legend><h2><?php echo $page_title; ?></h2></legend>

    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>

                <p>
                    <label>*<strong>Product</strong></label>
                    <select name="product_id" id="product_id" class="required">
                        <option value="">Select</option>
                        <?PHP
                            $products = $this->db_model->get_rows('products',array('status'=>'Enabled'));
                            foreach($products as $product)
                            {
                                ?>
                                <option value="<?PHP echo $product->id;?>" <?PHP if($row->product_id == $product->id){echo set_select('product_id', $product->id, true);}else{echo set_select('product_id', $product->id); }?>><?PHP echo $product->product_title;?></option>
                                <?PHP
                            }
                        ?>
                    </select>
                </p>

                <p>
                    <label>*<strong>Roll over stars, and click to rate:</strong></label>
                    <input type="hidden" name="rating" id="rating" value="<?PHP echo set_value('rating',$row->rating);?>" class="required" />
                    <div id="half" style="margin-left: 12px;"></div>
                    <script type="text/javascript">
                        ratingJQ('#half').raty({
                            half: true,
                            path: "<?PHP echo base_url();?>assets/rating/img/",
                            starHalf:   'star-half.png',
                            starOff:    'star-off.png',
                            starOn:     'star-on.png',
                            click: function(score, evt)
                            {
                                document.getElementById('rating').value = score;
                                //alert(document.getElementById('rating').value);

                                //alert('ID: ' + $(this).attr('id') + '\nscore: ' + score + '\nevent: ' + evt);
                            },
                            start: <?PHP echo $row->rating != '' ?  $row->rating : 0 ;?>
                        });

                    </script>
                </p>
                                 
                <p>
                    <label>*<strong>Nick Name:</strong></label>
                    <input size="60" name="nick_name" id="nick_name" type="text" value="<?PHP echo set_value('nick_name',$row->nick_name);?>" class="required"/>
                </p>

                <p>
                    <label>*<strong>Review:</strong></label>
                    <textarea name="review" id="review" rows="10" style="width: 585px;"><?PHP echo set_value('review',$row->review);?></textarea>
                </p>
                
                <p>
                    <label>*<strong>Status:</strong></label>
                    <select name="status" id="status" class="required">
                        <option value="">Select</option>
                        <option value="Approved" <?PHP if($row->status == 'Approved'){echo set_select('status', 'Approved', true);}else{echo set_select('status', 'Approved'); }?>>Approved</option>
                        <option value="Pending"  <?PHP if($row->status == 'Pending'){echo set_select('status', 'Pending', true);}else{echo set_select('status', 'Pending'); }?>>Pending</option>
                    </select>
                </p>
           
            </td>
        </tr>
        
        <tr>
        	<td>
                <p>
                    <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" />
                    <input type="button" onclick="window.location='<?PHP echo base_url();?>administration/reviews'" value="cancel"/>
                </p>
            </td>
        </tr>


    </table>


    <input type="hidden" name="member_id" id="member_id" value="<?PHP if(isset($row)){echo $row->member_id;}?>"/>
    <input type="hidden" name="id" id="id" value="<?PHP if(isset($row)){echo $row->id;}?>"/>
    </fieldset>
</form>

<script>
$jqvalidation(document).ready(function() {
 
    $jqvalidation("#reviewFrm").validate({});
	
});
</script>
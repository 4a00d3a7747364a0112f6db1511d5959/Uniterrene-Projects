<?PHP
/**
 *@var $this CI_Controller
 */
?>

<h3>Customer Reviews</h3>

<?PHP
$review_query = 'SELECT * FROM {PRE}reviews WHERE product_id = '.$product->id.' and status = "Approved" order by date_posted desc';
$reviews = $this->db_model->sql($review_query);
if($reviews)
{
    $i=0;
    foreach($reviews as $review)
    {
        ?>

        <div id="half<?PHP echo $i;?>" style="float: left;"></div>

        <div>Review by <b><?PHP echo $review->nick_name;?></b> | Posted on (<?PHP echo date('d/m/Y',strtotime($review->date_posted));?>)</div>

        <script type="text/javascript">
            ratingJQ('#half<?PHP echo $i;?>').raty({
                half: true,
                start: <?PHP echo $review->rating;?>,
                readOnly:true,
                path: "<?PHP echo base_url();?>assets/rating/img/",
                starHalf:   'star-half.png',
                starOff:    'star-off.png',
                starOn:     'star-on.png'
            });
        </script>

        <p style="border-bottom: 1px dashed #ccc; padding-bottom: 8px;">
            <?PHP echo $review->review;?>
        </p>

        <?PHP
        $i++;
    }
}
else
{
    echo "<p>This product has not been rated yet, you can be the first one to rate this product.</p>";
}
?>

<h3>Write your review</h3>

<form name="reviewFrm" id="reviewFrm" action="" method="post">
<!-- to make rating-->
    <span style="float:left; font-weight: bold; padding-bottom: 3px;">Roll over stars, and click to rate:</span>
    <input type="hidden" name="rating" id="rating" value="<?PHP echo set_value('rating');?>" class="required" />
    <div id="half"></div>
    <script type="text/javascript">
        ratingJQ('#half').raty({
            half: true,
            path: "<?PHP echo base_url();?>assets/rating/img/",
            starHalf:   'star-half.png',
            starOff:    'star-off.png',
            starOn:     'star-on.png',
            start:       3.3,
            click: function(score, evt)
            {
                document.getElementById('rating').value = score;
                //alert(document.getElementById('rating').value);

                //alert('ID: ' + $(this).attr('id') + '\nscore: ' + score + '\nevent: ' + evt);
            },
            start: ratingJQ(this).attr('value')
        });

    </script>

    <div style="margin-top: 5px;"><strong>Nick Name:</strong></div>
    <input type="text" name="nick_name" id="nick_name" class="fld-04 required" style="max-width:225px;" value="<?PHP if($this->session->userdata('member_data')){echo $this->session->userdata('member_data')->first_name." ".$this->session->userdata('member_data')->last_name;}else{echo set_value('nick_name');}?>" />

    <div style="margin-top: 5px;"><strong>Review:</strong></div>
    <textarea name="review" id="review" class="required fld-04" cols="30" rows="10" style="width: 90%; height: 170px; resize: none;"><?PHP echo set_value('review');?></textarea>

    <div style="margin-right:10px; margin-top: 5px; width: 130px;">
        <input type="submit" class="c-here-bt1" value="Submit Review"/>
    </div>

    <input type="hidden" name="product_id" id="product_id" value="<?PHP echo $product->id;?>"/>
    <input type="hidden" name="member_id" id="member_id" value="<?PHP echo ($this->session->userdata('member_data') ? $this->session->userdata('member_data')->id : 0);?>"/>

<!-- end to make rating-->
</form>

<script>
    $jqvalidation(document).ready(function() {

        $jqvalidation("#reviewFrm").validate({});

    });
</script>
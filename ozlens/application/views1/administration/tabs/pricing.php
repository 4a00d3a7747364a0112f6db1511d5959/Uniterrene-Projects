<script>
    function set_rental_price(i,r_price)
    {
        var w_price;
        w_price = (r_price*10)/100;
        document.getElementById('waiver_price'+i).value = w_price;
    }

    function copy_pricing_from_product(val)
    {

            var s_product_id=val;
            var resultDiv = "pricing_table";
            var dataString = 's_product_id='+ s_product_id;

            $.ajax
            ({
                beforeSend: function()
                {
                    $('#Loader').show();
                },
                complete: function(){
                    $('#Loader').hide();
                },
                type: "POST",
                url: "<?PHP echo base_url();?>administration/products/copy_product_prices", //=> Controller function call
                data: dataString,
                cache: false,
                async:false,
                success: function(html)
                {
                    $("#"+resultDiv).html(html);
                }
            });

    }

    $( document ).ready(function() {
        copy_pricing_from_product(<?PHP echo $row->id;?>);
    });

</script>

<p style="margin-left: 0px !important;">
    <strong>Copy price from:</strong>
    <select name="s_product_id" id="s_product_id" onchange="copy_pricing_from_product(this.value);">
        <option value="">Please Select</option>
        <?PHP
        $products = $this->db_model->get_table('products');
        foreach($products as $product)
        {
            ?>
            <option value="<?PHP echo $product->id;?>"><?PHP echo $product->product_title;?></option>
            <?PHP
        }
        ?>
    </select>
    <span id="Loader" style="color: #990000;">Please wait....</span>
</p>

<p id="pricing_table"></p>

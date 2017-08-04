<?PHP
/**
 *@var $this CI_Controller
 */
?>

<h1><?php echo $page_title; ?></h1>

<form method="get" name="pc_form" id="pc_form" action="">
    <p>
        <label><strong>Parent Categories:</strong></label>
        <select id="p_id" name="p_id" onchange="document.getElementById('pc_form').submit();">
            <option value="0">All</option>
            <?php
            foreach($cats as $cat)
            {
                ?>
                <option value="<?php echo $cat->id;?>" <?PHP if($p_id == $cat->id){echo "selected";}?>><?php echo $cat->cat_name;?></option>
            <?PHP
            }
            ?>
        </select>
    </p>
</form>


<a style="float: right;" href="<?PHP echo base_url();?>administration/categories/add">[Add New]</a>&nbsp;&nbsp;<a href="javascript:void(0);" id="toggleLink" style="text-decoration: none;">[+] Expand All</a>


<?PHP echo $this->categories_model->CategoryListAdmin($p_id);?>

<p>
    <br/>
    <input type="submit" name="updateOrder" id="updateOrder" value="Update" />
    <div id="updateOrderOutput" class="success-box" style="display: none;"></div>
</p>

<script type="text/javascript" src="<?PHP echo base_url();?>assets/nestedcatsjs/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/nestedcatsjs/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/nestedcatsjs/jquery.ui.touch-punch.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/nestedcatsjs/jquery.mjs.nestedSortable.js"></script>
<link href="<?PHP echo base_url();?>assets/nestedcatsjs/nestedcats.css" rel="stylesheet" type="text/css"/>

<script>

    $(document).ready(function(){

        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            helper:	'clone',
            items: 'li',
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            maxLevels: 0,
            rootID:0,
            isTree: true,
            expandOnHover: 1000,
            startCollapsed: true
        });

        $('.disclose').on('click', function() {
            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
        });

        $('#toggleLink').on('click', function() {

            $('.disclose').closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');

            if ($(this).html() == "[+] Expand All")
            {
                $(this).html("[-] Collapse All");
            }
            else
            {
                $(this).html("[+] Expand All");
            }
        });

        $('#updateOrder').click(function(){
            dtaArr = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
            $.post( "<?PHP echo base_url();?>administration/categories/update_order", { dta: dtaArr}, function( data ) {
                $('#updateOrderOutput').show();
                $('#updateOrderOutput').text(data);
                $('#updateOrderOutput').delay(3000).fadeOut('slow');
            });
        })
    });
</script>


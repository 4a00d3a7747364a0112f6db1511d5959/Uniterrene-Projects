<?PHP
require('ci_objects.php');
?>
<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<script>
    var base_url = "<?PHP echo base_url_wp();?>";
</script>

<style>
    a.trigger {
        display: block;
        padding-left: 20px;
        background-image: url(<?PHP echo base_url_wp();?>assets/scripts/plus.gif);
        background-repeat: no-repeat;
        background-position: 1px 50%;
    }
    a.trigger.open {
        background-image: url(<?PHP echo base_url_wp();?>assets/scripts/minus.gif)
    }
</style>

<!-- Accordion Start-->
<script type="text/javascript" src="<?PHP echo base_url_wp();?>assets/scripts/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url_wp();?>assets/scripts/jquery/jquery.nestedAccordion.js"></script>
<script type="text/javascript" src="<?PHP echo base_url_wp();?>assets/scripts/jquery/expand.js"></script>
<script type="text/javascript">

    $jqAcc =  $.noConflict();

    $jqAcc("html").addClass("js");

    $jqAcc(function() {

        $jqAcc("#side").accordion({initShow: "#current", uri: "full", splitUrl: '/',iconTrigger :false, activeLink : true});

        /*$("#side ul.accordion").expandAll({
         trigger: "li",
         ref: "",
         cllpsEl : "ul",
         state : '',
         oneSwitch : false
         });*/

        $jqAcc("html").removeClass("js");

    });

</script>
<!-- Accordion End-->

<div id="secondary" class="widget-area" role="complementary">
    <div class="choose-brands-bg middle-l-panel-nav-whitebg">
        <div class="middle-l-panel-nav-headng txt8">BROWSE GEAR</div>
    </div>
    <div  class="middle-l-panel-nav-whitebg choose-brands-white-bg">
        <div  class="leftNavigation">
            <div id="side">
                <?PHP

                echo $CI->categories_model->CategoryList();

                ?>
            </div>
        </div>
    </div>
</div>

<div id="secondary" class="widget-area" role="complementary">
    <div class="middle-r-panel-redbg">
        <a href="<?PHP echo base_url_wp().$CI->db_model->get_row('content',array('id'=>'150'))->slug;?>" class="txt17" style="text-transform:uppercase;">
            <div class="middle-r-panel-redbg-txt"><?PHP echo $CI->db_model->get_row('content',array('id'=>'150'))->title;?></div>
        </a>
    </div>

    <div class="middle-r-panel-redbg">
        <a href="<?PHP echo base_url_wp().$CI->db_model->get_row('content',array('id'=>'146'))->slug;?>" class="txt17" style="text-transform:uppercase;">
            <div class="middle-r-panel-redbg-txt"><?PHP echo $CI->db_model->get_row('content',array('id'=>'146'))->title;?></div>
        </a>
    </div>

    <div class="middle-r-panel-redbg">
        <a href="<?PHP echo base_url_wp().$CI->db_model->get_row('content',array('id'=>'151'))->slug;?>" class="txt17" style="text-transform:uppercase;">
            <div class="middle-r-panel-redbg-txt">
                <?PHP echo $CI->db_model->get_row('content',array('id'=>'151'))->title;?>
            </div>
        </a>
    </div>

    <div class="middle-r-panel-redbg">
        <div class="middle-r-panel-redbg-txt"><a href="<?PHP echo base_url_wp();?>request-gear" class="txt17">REQUEST GEAR</a></div>
    </div>

    <div class="middle-r-panel-redbg">
        <div class="middle-r-panel-redbg-txt"><a href="<?PHP echo base_url_wp();?>giftcards" class="txt17">GIFT CARDS</a></div>
    </div>

    <div class="middle-r-panel-redbg">
        <a href="<?PHP echo base_url_wp();?>contactus" class="txt17">
            <div class="middle-r-panel-redbg-txt">CONTACT US</div>
        </a>
    </div>
</div>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <div id="secondary" class="widget-area" role="complementary" >

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

    </div><!-- #secondary -->
<?php endif; ?>


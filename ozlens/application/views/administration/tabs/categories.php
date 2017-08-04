<?PHP
/**
 *@var $this CI_Controller
 */
?>

<!-- Accordion Start-->
<script type="text/javascript" src="<?PHP echo base_url();?>assets/scripts/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/scripts/jquery/jquery.nestedAccordion.js"></script>
<script type="text/javascript" src="<?PHP echo base_url();?>assets/scripts/jquery/expand.js"></script>
<script type="text/javascript">

    $jqAcc =  $.noConflict();

    $jqAcc("html").addClass("js");

    $jqAcc(function() {

	$jqAcc("#side").accordion({
			initShow: ".current", 
			iconTrigger :false, 
			standardExpansible  : true
		});

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

<style>
    a.trigger {
        display: block;
        padding-left: 20px;
        background-image: url(<?PHP echo base_url();?>assets/scripts/plus.gif);
        background-repeat: no-repeat;
        background-position: 1px 50%;
    }
    a.trigger.open {
        background-image: url(<?PHP echo base_url();?>assets/scripts/minus.gif)
    }

    #side li
    {
        list-style: none;
        padding: 5px;

    }	
	</style>



<div id="side">
<?PHP
   echo $this->categories_model->CategoryListProductTab($row->id ? : 0);
?>
</div>

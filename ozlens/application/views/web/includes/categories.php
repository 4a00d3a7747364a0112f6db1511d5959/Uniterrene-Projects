<?PHP
/**
 *@var $this CI_Controller
 */
?>
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
a.trigger.open {
	background-image: url(<?PHP echo base_url();?>assets/scripts/minus.gif)
}
li.last-child a.trigger {
	background-image: url(<?PHP echo base_url();?>assets/scripts/arrow-ds.png) !important;
}
</style>

<div class="middle-l-panel-nav">
            <div class="choose-brands-bg middle-l-panel-nav-whitebg">
              <div class="middle-l-panel-nav-headng txt8"><h1 class="txt8">BROWSE GEAR</h1></div>
            </div>
            <div  class="middle-l-panel-nav-whitebg choose-brands-white-bg">
              <div  class="leftNavigation">
                <div id="side">
                    <?PHP
                    if(isset($selected_cat_id) && $selected_cat_id>0)
                    {
                        echo "".$this->categories_model->CategoryList($selected_cat_id)."";
                    }
                    else
                    {
                        echo $this->categories_model->CategoryList();
                    }
                    ?>
                </div>
              </div>
            </div>
          </div>

<?PHP
if(!isset($display_menu))
{
    ?>
    <div style="padding-top: 15px; clear: both;">
    <?PHP $this->load->view('web/includes/right_menu');?>
    </div>
    <?PHP
}
?>
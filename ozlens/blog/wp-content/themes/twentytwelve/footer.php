<?PHP
require('ci_objects.php');
?>

<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
</div>
<div class="clearF"></div>

<style>
    .footer-4 {
        width:7%; float:left; margin-top:0px;
    }
    .footer-5 {
        width:90%; float:left; margin-bottom:0px;
    }
    .footer-6 {
        width:7%; float:left; margin-bottom:0px; margin-top:0px;
    }
    .footer-7 {
        width:90%; float:left; margin-bottom:0px;
    }
</style>

<!--footer div start-->
<div class="footer-main">
    <div class="footer-1">
        <div class="footer-2">
            <div class="footer-3">
                <div class="footer-4"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                <div class="footer-5"><a href="<?PHP echo base_url_wp();?>cart" class="top-links">Cart</a></div>
                <?PHP if(!$CI->session->userdata('member_data')){?>
                    <div class="footer-4"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                    <div class="footer-5"><a href="<?PHP echo base_url_wp();?>member/signup" class="top-links">Create Account</a></div>
                    <div class="footer-4"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                    <div class="footer-5"><a href="<?PHP echo base_url_wp();?>member/signin" class="top-links">Sign In</a></div>
                <?PHP }else{?>
                    <div class="footer-4"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                    <div class="footer-5"><a href="<?PHP echo base_url_wp();?>member/myaccount" class="top-links">My Account</a></div>
                <?PHP }?>
                <div class="footer-4"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                <div class="footer-5"><a href="#" class="top-links">Gift Certificates</a></div>
            </div>
            <div class="footer-3">
                <div class="footer-6"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                <div class="footer-7"><a href="<?PHP echo base_url_wp().$dbm->get_row('content',array('id'=>'151'))->slug;?>" class="top-links"><?PHP echo $dbm->get_row('content',array('id'=>'151'))->title;?></a></div>
                <div class="footer-6"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                <div class="footer-7"><a href="<?PHP echo base_url_wp().$dbm->get_row('content',array('id'=>'146'))->slug;?>" class="top-links"><?PHP echo $dbm->get_row('content',array('id'=>'146'))->title;?></a></div>
                <div class="footer-6"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                <div class="footer-7"><a href="<?PHP echo base_url_wp().$dbm->get_row('content',array('id'=>'150'))->slug;?>" class="top-links"><?PHP echo $dbm->get_row('content',array('id'=>'150'))->title;?></a></div>
                <div class="footer-6"><img src="<?PHP echo base_url_wp();?>assets/images/bullet-3.png" width="4" height="5" /></div>
                <div class="footer-7"><a href="<?PHP echo base_url_wp();?>contactus" class="top-links">Contact Us</a></div>
            </div>
            <div class="footer-links">
                <?PHP
                $cats = $dbm->get_rows('categories',array('p_id'=>0));
                if($cats)
                {
                    $i=0;
                    foreach($cats as $cat)
                    {
                        ?>
                        <a href="<?PHP echo $CI->categories_model->generate_url($cat->id);?>" class="footlink"><?PHP echo $cat->cat_name;?></a>

                        <?PHP if($i<sizeof($cats)-1){?>
                        &nbsp;&nbsp;<span class="txt1">|</span>&nbsp;&nbsp;
                    <?PHP }?>
                        <?PHP
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
        <div class="footer-ask-qstns-main">
            <div class="footer-ask-qstns-img"><img src="<?PHP echo base_url_wp();?>assets/images/q-mark-img.png" width="100%" /></div>
            <div class="txt2-a footer-ask-qstns-txt">ASK <br />
                QUESTIONS</div>
            <div class="footer-ask-qstns-bt">
                <input name="" type="button" class="c-here-bt1" value="CLICK HERE" onclick="window.location='<?PHP echo base_url_wp();?>contactus'"/>
            </div>
        </div>
        <div class="clearF"></div>
    </div>
    <div class="clearF"></div>
</div>
<!--footer div end-->

<!--footer link div start-->
<div class="footer-trm-con-main">
    <div class="footer-trm-con-txt"><span class="txt12">&copy; <?PHP echo date('Y')?></span> <a href="<?PHP echo base_url_wp();?>" class="txt12">OZLensRentals.com.</a> <a href="<?PHP echo base_url_wp().'cms/'.$dbm->get_row('content',array('id'=>'149'))->slug;?>" class="txt12"><?PHP echo $dbm->get_row('content',array('id'=>'149'))->title;?></a>&nbsp;<span class="txt12">|</span>&nbsp;<a href="<?PHP echo base_url_wp().'cms/'.$dbm->get_row('content',array('id'=>'148'))->slug;?>" class="txt12"><?PHP echo $dbm->get_row('content',array('id'=>'148'))->title;?></a></div>
</div>
<!--footer link div end-->


</div>
</body>
</html>
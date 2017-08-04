<?PHP
require('ci_objects.php');
?>

<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

    <script type="text/javascript">
        <!--
        function MM_swapImgRestore() { //v3.0
            var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
        }
        function MM_preloadImages() { //v3.0
            var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
                var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
                    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
        }

        function MM_findObj(n, d) { //v4.01
            var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
            if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
            for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
            if(!x && d.getElementById) x=d.getElementById(n); return x;
        }

        function MM_swapImage() { //v3.0
            var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
                if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
        }
        //-->
    </script>

    <!-- Custom includes-->
    <link href="<?PHP echo base_url_wp();?>assets/css/oz.css" rel="stylesheet" type="text/css"/>
    <link href="<?PHP echo base_url_wp();?>assets/css/media.css" rel="stylesheet" type="text/css"/>
    <!-- Custom includes End-->

</head>

<body <?php body_class(); ?>>

<div id="Container">

<!--top div start-->
<div class="top-main">
    <div class="top-1059">

        <!--top-1 div start-->
        <div class="top-1">

            <div class="top-1-social">
                <?PHP
                if($dbm->get_row('settings',array('key'=>'facebook'))->value !="")
                {
                    ?>
                    <a target="_blank" href="<?PHP echo $dbm->get_row('settings',array('key'=>'facebook'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','<?PHP echo base_url_wp();?>assets/images/facebook-hvr-icn.jpg',1)"><img src="<?PHP echo base_url_wp();?>assets/images/facebook-icn.jpg" name="Image1" width="24" height="23" border="0" id="Image1" /></a>&nbsp;&nbsp;
                <?PHP
                }
                ?>
				
                
                
                
                
                
                <?PHP
                if($dbm->get_row('settings',array('key'=>'googleplus'))->value !="")
                {
                    ?>
                    <a target="_blank" href="<?PHP echo $dbm->get_row('settings',array('key'=>'googleplus'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','<?PHP echo base_url_wp();?>assets/images/googleplus-iconHover.jpg',1)"><img src="<?PHP echo base_url_wp();?>assets/images/googleplus-icon.jpg" name="Image32" width="24" height="23" border="0" id="Image32" /></a>&nbsp;&nbsp;
                <?PHP
                }
                ?>
                
        
        
        
        
        
                <?PHP
                if($dbm->get_row('settings',array('key'=>'flicker'))->value !="")
                {
                    ?>
                    <a target="_blank" href="<?PHP echo $dbm->get_row('settings',array('key'=>'flicker'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','<?PHP echo base_url_wp();?>assets/images/flickr-hvr-icn.jpg',1)"><img src="<?PHP echo base_url_wp();?>assets/images/flickr-icn.jpg" name="Image2" width="24" height="23" border="0" id="Image2" /></a>&nbsp;&nbsp;
                <?PHP
                }
                ?>

                <?PHP
                if($dbm->get_row('settings',array('key'=>'twitter'))->value !="")
                {
                    ?>
                    <a target="_blank" href="<?PHP echo $dbm->get_row('settings',array('key'=>'twitter'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','<?PHP echo base_url_wp();?>assets/images/twitter-hvr-icn.jpg',1)"><img src="<?PHP echo base_url_wp();?>assets/images/twitter-icn.jpg" name="Image3" width="23" height="23" border="0" id="Image3" /></a>&nbsp;&nbsp;
                <?PHP
                }
                ?>

                <?PHP
                if($dbm->get_row('settings',array('key'=>'vimeo'))->value !="")
                {
                    ?>
                    <a target="_blank" href="<?PHP echo $dbm->get_row('settings',array('key'=>'vimeo'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','<?PHP echo base_url_wp();?>assets/images/vimeo-hvr-icn.jpg',1)"><img src="<?PHP echo base_url_wp();?>assets/images/vimeo-icn.jpg" name="Image4" width="23" height="23" border="0" id="Image4" /></a>&nbsp;&nbsp;
                <?PHP
                }
                ?>

                <?PHP
                if($dbm->get_row('settings',array('key'=>'youtube'))->value !="")
                {
                    ?>
                    <a target="_blank" href="<?PHP echo $dbm->get_row('settings',array('key'=>'youtube'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','<?PHP echo base_url_wp();?>assets/images/utube-hvr-icn.jpg',1)"><img src="<?PHP echo base_url_wp();?>assets/images/utube-icn.jpg" name="Image15" width="23" height="23" border="0" id="Image15" /></a>
                <?PHP
                }
                ?>
            </div>

            <div class="top-1-links">
                <?PHP if($CI->session->userdata('member_data')){?>
                    <span class="top-links"> Welcome, <?PHP echo $CI->session->userdata('member_data')->first_name;?></span>&nbsp;&nbsp;&nbsp;
                    <span class="top-links">|</span>&nbsp;&nbsp;&nbsp;
                    <a href="<?PHP echo base_url_wp();?>member/logout" class="top-links">Sign out</a>
                <?PHP }else{?>
                    <a href="<?PHP echo base_url_wp();?>member/signup" class="top-links">Create an Account</a>&nbsp;&nbsp;&nbsp;
                    <span class="top-links">|</span>&nbsp;&nbsp;&nbsp;
                    <a href="<?PHP echo base_url_wp();?>member/signin" class="top-links">Sign In</a>
                <?PHP }?>
            </div>
        </div>
        <!--top-1 div end-->

        <!--top-2 div start-->
        <div class="top-2">

            <!-- cart & search for MOBILE VIEW -->

            <div class="cartSearch-containerTiny">
                <div class="top-2-acnt-cart-1Tiny">
                    <div class="top-2-acnt-cart-2 top-2-acnt-cart-bg">
                        <div class="top-2-acnt-cart-3">
                            <div class="top-2-acnt-cart-4"><img src="<?PHP echo base_url_wp();?>assets/images/my-account-icn.png" width="18" height="19" /></div>
                            <div class="top-2-acnt-cart-5"><a href="<?PHP echo base_url_wp();?>member/myaccount" class="txt1">My Account</a></div>
                        </div>
                        <div class="top-2-acnt-cart-sep"><img src="<?PHP echo base_url_wp();?>assets/images/sep-ver1.jpg" width="2" height="33" /></div>
                        <div class="top-2-acnt-cart-6">
                            <div class="top-2-acnt-cart-7"><img src="<?PHP echo base_url_wp();?>assets/images/cart-icn.png" width="21" height="19" /></div>
                            <div class="top-2-acnt-cart-8"><a href="<?PHP echo base_url_wp();?>cart" class="txt1">My Cart</a></div>
                        </div>
                    </div>
                </div>
                <!-- end of "top-2-acnt-cart-1Tiny" -->
                <form name="miniSrchFrm" id="miniSrchFrm" method="post" action="<?PHP echo base_url_wp();?>rent/products">
                    <div class="top-2-search-main">
                        <div class="top-2-search-fld">
                            <input name="q" id="q" type="text" class="search-fld" placeholder="Search" />
                        </div>
                        <div class="top-2-search-bt search-fld-bt1"><input type="image" src="<?PHP echo base_url_wp();?>assets/images/search-icn.png" width="11" height="11" style="padding-top:8px;"/></div>
                    </div>
                </form>
                <div class="clearF"></div>
            </div>

            <!-- end of "cartSearch-containerTiny" -->

            <!-- cart & search for MOBILE VIEW  Ends here -->

            <div class="top-2-logo"><a href="<?PHP echo base_url_wp();?>"><img src="<?PHP echo base_url_wp();?>assets/images/logo.png" alt="" /></a></div>
            <div class="top-2-acnt-cart-main">
                <div class="top-2-acnt-cart-1">
                    <div class="top-2-acnt-cart-2 top-2-acnt-cart-bg">
                        <div class="top-2-acnt-cart-3">
                            <div class="top-2-acnt-cart-4"><img src="<?PHP echo base_url_wp();?>assets/images/my-account-icn.png" width="18" height="19" /></div>
                            <div class="top-2-acnt-cart-5"><a href="<?PHP echo base_url_wp();?>member/myaccount" class="txt1">My Account</a></div>
                        </div>
                        <div class="top-2-acnt-cart-sep"><img src="<?PHP echo base_url_wp();?>assets/images/sep-ver1.jpg" width="2" height="33" /></div>
                        <div class="top-2-acnt-cart-6">
                            <div class="top-2-acnt-cart-7"><img src="<?PHP echo base_url_wp();?>assets/images/cart-icn.png" width="21" height="19" /></div>
                            <div class="top-2-acnt-cart-8"><a href="<?PHP echo base_url_wp();?>cart" class="txt1">My Cart</a></div>
                        </div>
                    </div>
                </div>
                <div class="clearF"></div>
                <form name="miniSrchFrm" id="miniSrchFrm" method="post" action="<?PHP echo base_url_wp();?>rent/products">
                    <div class="top-2-search-main">
                        <div class="top-2-search-fld">
                            <input name="q" id="q" type="text" class="search-fld" placeholder="Search" />
                        </div>
                        <div class="top-2-search-bt search-fld-bt1"><input type="image" src="<?PHP echo base_url_wp();?>assets/images/search-icn.png" width="11" height="11" style="padding-top:8px;"/></div>
                    </div>
                </form>
            </div>
            <div class="clearF"></div>
        </div>
        <!--top-2 div end-->

        <div class="clearF"></div>

        <?PHP if(isset($error) && $error !=""){echo '<div class="error-box">'.$error.'</div>';}?>
        <?php echo $CI->session->flashdata('response');?>
        <?php echo validation_errors('<div class="error-box">', '</div>'); ?>

        <?PHP //echo $CI->load->view($page_view);?>

    </div>
</div>
<!--top div end-->

    <div id="main" class="wrapper" style="width: 80%; max-width: 1059px; margin: 0 auto;">


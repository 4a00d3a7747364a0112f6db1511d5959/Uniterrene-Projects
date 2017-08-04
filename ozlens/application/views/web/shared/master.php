<?PHP
/**
 *@var $this CI_Controller
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="<?PHP echo base_url();?>assets/css/oz.css?v=3" rel="stylesheet" type="text/css"/>
    <link href="<?PHP echo base_url();?>assets/css/media.css" rel="stylesheet" type="text/css"/>
    <link href="<?PHP echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">

    <title>
        <?PHP
        if(isset($page_title) && $page_title !="")
        {
            echo strip_tags($page_title);
        }
        else
        {
            echo $this->db_model->get_row('settings',array('key'=>'site_title'))->value;
        }
        ?>
    </title>

    <?PHP
    if(isset($page_data) && $page_data->metas !="")
    {
        echo $page_data->metas;
    }
    else
    {
        echo $this->db_model->get_row('settings',array('key'=>'metas'))->value;
    }
	
	if(isset($product_metas))
	{
		echo $product_metas;
	}
    ?>

    <?php $this->load->view('web/shared/masterscripts');?>

    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">

</head>

<body onload="MM_preloadImages('<?PHP echo base_url();?>assets/images/facebook-hvr-icn.jpg','<?PHP echo base_url();?>assets/images/flickr-hvr-icn.jpg','<?PHP echo base_url();?>assets/images/twitter-hvr-icn.jpg','<?PHP echo base_url();?>assets/images/vimeo-hvr-icn.jpg')">

<!--main div start-->

<div id="Container"> 
  
  <!--top div start-->
  <div class="top-main">
    <div class="top-1059"> 


      <!--top-1 div start-->
      <div class="top-1">
      
        <div class="top-1-social">
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'facebook'))->value !="")
		{
		?>
        	<a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'facebook'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31','','<?PHP echo base_url();?>assets/images/facebook-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/facebook-icn.jpg" name="Image31" width="24" height="23" border="0" id="Image31" /></a>
        <?PHP 
		}
		?> 
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'googleplus'))->value !="")
		{
		?>   
            <a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'googleplus'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','<?PHP echo base_url();?>assets/images/googleplus-iconHover.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/googleplus-icon.jpg" name="Image32" width="24" height="23" border="0" id="Image32" /></a>
        <?PHP 
		}
		?>
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'flicker'))->value !="")
		{
		?>   
            <a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'flicker'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image35','','<?PHP echo base_url();?>assets/images/flickr-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/flickr-icn.jpg" name="Image35" width="24" height="23" border="0" id="Image35" /></a>
        <?PHP 
		}
		?>
        
 		<?PHP 
		if($this->db_model->get_row('settings',array('key'=>'twitter'))->value !="")
		{
		?>    
            <a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'twitter'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','<?PHP echo base_url();?>assets/images/twitter-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/twitter-icn.jpg" name="Image33" width="23" height="23" border="0" id="Image33" /></a>
        <?PHP 
		}
		?>
        
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'vimeo'))->value !="")
		{
		?>    
            <a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'vimeo'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image34','','<?PHP echo base_url();?>assets/images/vimeo-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/vimeo-icn.jpg" name="Image34" width="23" height="23" border="0" id="Image34" /></a>
        <?PHP 
		}
		?>
        
        <?PHP 
		if($this->db_model->get_row('settings',array('key'=>'youtube'))->value !="")
		{
		?>    
            <a target="_blank" href="<?PHP echo $this->db_model->get_row('settings',array('key'=>'youtube'))->value;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','<?PHP echo base_url();?>assets/images/utube-hvr-icn.jpg',1)"><img src="<?PHP echo base_url();?>assets/images/utube-icn.jpg" name="Image15" width="23" height="23" border="0" id="Image15" /></a>
        <?PHP 
		}
		?>       
        </div>
        
        <div class="top-1-links">
        <?PHP if($this->session->userdata('member_data')){?>
        	<span class="top-links"> Welcome, <?PHP echo $this->session->userdata('member_data')->first_name;?></span>&nbsp;
            <span class="top-links">|</span>&nbsp;
            <a href="<?PHP echo base_url();?>blog" class="top-links">Blog</a>&nbsp;
            <span class="top-links">|</span>&nbsp;
            <a href="<?PHP echo base_url();?>member/logout" class="top-links">Sign out</a>
        <?PHP }else{?>
        	<a href="<?PHP echo base_url();?>member/signup" class="top-links">Create an Account</a>
            <span class="top-links">|</span>
            <a href="<?PHP echo base_url();?>blog" class="top-links">Blog</a>
            <span class="top-links">|</span>
            <a href="<?PHP echo base_url();?>member/signin" class="top-links">Sign In</a>
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
                <div class="top-2-acnt-cart-4"><img src="<?PHP echo base_url();?>assets/images/my-account-icn.png" width="18" height="19" /></div>
                <div class="top-2-acnt-cart-5"><a href="<?PHP echo base_url();?>member/myaccount" class="txt1">My Account</a></div>
              </div>
              <div class="top-2-acnt-cart-sep"><img src="<?PHP echo base_url();?>assets/images/sep-ver1.jpg" width="2" height="33" /></div>
              <div class="top-2-acnt-cart-6">
                <div class="top-2-acnt-cart-7"><img src="<?PHP echo base_url();?>assets/images/cart-icn.png" width="21" height="19" /></div>
                <div class="top-2-acnt-cart-8"><a href="<?PHP echo base_url();?>cart" class="txt1">My Cart</a></div>
              </div>
            </div>
          </div>
          <!-- end of "top-2-acnt-cart-1Tiny" -->
          <form name="miniSrchFrm" id="miniSrchFrm" method="post" action="<?PHP echo base_url();?>rent/products">
          <div class="top-2-search-main">
            <div class="top-2-search-fld">
              <input name="q" id="q" type="text" class="search-fld" placeholder="Search" />
            </div>
            <div class="top-2-search-bt search-fld-bt1"><input type="image" src="<?PHP echo base_url();?>assets/images/search-icn.png" width="11" height="11" style="padding-top:8px;"/></div>
          </div> 
          </form>
          <div class="clearF"></div>
        </div>
       
        <!-- end of "cartSearch-containerTiny" --> 
        
        <!-- cart & search for MOBILE VIEW  Ends here -->
        
        <div class="top-2-logo"><a href="<?PHP echo base_url();?>"><img src="<?PHP echo base_url();?>assets/images/logo.png" alt="" /></a></div>
        <div class="top-2-acnt-cart-main">
          <div class="top-2-acnt-cart-1">
            <div class="top-2-acnt-cart-2 top-2-acnt-cart-bg">
              <div class="top-2-acnt-cart-3">
                <div class="top-2-acnt-cart-4"><img src="<?PHP echo base_url();?>assets/images/my-account-icn.png" width="18" height="19" /></div>
                <div class="top-2-acnt-cart-5"><a href="<?PHP echo base_url();?>member/myaccount" class="txt1">My Account</a></div>
              </div>
              <div class="top-2-acnt-cart-sep"><img src="<?PHP echo base_url();?>assets/images/sep-ver1.jpg" width="2" height="33" /></div>
              <div class="top-2-acnt-cart-6">
                <div class="top-2-acnt-cart-7"><img src="<?PHP echo base_url();?>assets/images/cart-icn.png" width="21" height="19" /></div>
                <div class="top-2-acnt-cart-8"><a href="<?PHP echo base_url();?>cart" class="txt1">My Cart</a></div>
              </div>
            </div>
          </div>
          <div class="clearF"></div>
          <form name="miniSrchFrm" id="miniSrchFrm" method="post" action="<?PHP echo base_url();?>rent/products">
          <div class="top-2-search-main">
            <div class="top-2-search-fld">
              <input name="q" id="q" type="text" class="search-fld" placeholder="Search" />
            </div>
            <div class="top-2-search-bt search-fld-bt1"><input type="image" src="<?PHP echo base_url();?>assets/images/search-icn.png" width="11" height="11" style="padding-top:8px;"/></div>
          </div>
          </form>
        </div>
        <div class="clearF"></div>
      </div>
      <!--top-2 div end--> 
      
      <div class="clearF"></div>
		
		<?PHP if(isset($error) && $error !=""){echo '<div class="error-box">'.$error.'</div>';}?>
        <?php echo $this->session->flashdata('response');?>
        <?php if(!isset($page)){echo validation_errors('<div class="error-box">', '</div>'); }?>
        
        <?PHP echo $this->load->view($page_view);?>
      
    </div>
  </div>
  <!--top div end-->
  
  <div class="clearF"></div>
  
  <!--footer div start-->
  <div class="footer-main">
    <div class="footer-1">
      <div class="footer-2">
        <div class="footer-3">
          <div class="footer-4"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-5"><a href="<?PHP echo base_url();?>cart" class="top-links">Cart</a></div>
          <?PHP if(!$this->session->userdata('member_data')){?>
          <div class="footer-4"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-5"><a href="<?PHP echo base_url();?>member/signup" class="top-links">Create Account</a></div>
          <div class="footer-4"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-5"><a href="<?PHP echo base_url();?>member/signin" class="top-links">Sign In</a></div>
          <?PHP }else{?>
          <div class="footer-4"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-5"><a href="<?PHP echo base_url();?>member/myaccount" class="top-links">My Account</a></div>
          <?PHP }?>
          <div class="footer-4"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-5"><a href="<?PHP echo base_url();?>giftcards" class="top-links">Gift Certificates</a></div>
        </div>
        <div class="footer-3">
          <div class="footer-6"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-7"><a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'151'))->slug;?>" class="top-links"><?PHP echo $this->db_model->get_row('content',array('id'=>'151'))->title;?></a></div>
          <div class="footer-6"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-7"><a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'146'))->slug;?>" class="top-links"><?PHP echo $this->db_model->get_row('content',array('id'=>'146'))->title;?></a></div>
          <div class="footer-6"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-7"><a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'150'))->slug;?>" class="top-links"><?PHP echo $this->db_model->get_row('content',array('id'=>'150'))->title;?></a></div>
          <div class="footer-6"><img src="<?PHP echo base_url();?>assets/images/bullet-3.png" width="4" height="5" /></div>
          <div class="footer-7"><a href="<?PHP echo base_url();?>contactus" class="top-links">Contact Us</a></div>
        </div>
            <div class="footer-links">
            <?PHP 
            $cats = $this->db_model->get_rows('categories',array('p_id'=>0));
            if($cats)
            {
                $i=0;
                foreach($cats as $cat)
                {
                ?>
                <a href="<?PHP echo $this->categories_model->generate_url($cat->id);?>" class="footlink"><?PHP echo $cat->cat_name;?></a>
                
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
        <div class="footer-ask-qstns-img"><img src="<?PHP echo base_url();?>assets/images/q-mark-img.png" width="100%" /></div>
        <div class="txt2-a footer-ask-qstns-txt">ASK <br />
          QUESTIONS</div>
        <div class="footer-ask-qstns-bt">
          <input name="" type="button" class="c-here-bt1" value="CLICK HERE" onclick="window.location='<?PHP echo base_url();?>contactus'"/>
        </div>
      </div>
      
      <a href="https://instantssl.com/ssl-certificate.html" style="text-decoration:none;" target="_blank">
    <img alt="SSL Certificate" src="https://www.instantssl.com/ssl-certificate-images/support/comodo_secure_100x85_transp.png" style="border: 0px;" />
</a>
      
      <div class="clearF"></div>
    </div>
    <div class="clearF"></div>
  </div>
  <!--footer div end--> 
  
  <!--footer link div start-->
  <div class="footer-trm-con-main">
    <div class="footer-trm-con-txt">
    	<span class="txt12">&copy; <?PHP echo date('Y')?></span> <a href="<?PHP echo base_url();?>" class="txt12"><?PHP echo $this->db_model->get_row('settings',array('key'=>'footer_text'))->value;?></a> <a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'149'))->slug;?>" class="txt12"><?PHP echo $this->db_model->get_row('content',array('id'=>'149'))->title;?></a>&nbsp;<span class="txt12">|</span>&nbsp;<a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'148'))->slug;?>" class="txt12"><?PHP echo $this->db_model->get_row('content',array('id'=>'148'))->title;?></a>
        <div id="footer-inner-text" style=" width:100%; float:left; text-align:center;padding:3px;" class="txt12">
        	<?PHP echo $this->db_model->get_row('settings',array('key'=>'google_analytic_code'))->value;?>
			<?PHP echo $this->db_model->get_row('settings',array('key'=>'footer_script'))->value;?>
        </div>
   	</div>
  </div>
  <!--footer link div end--> 
  
</div>
<!--main div close-->


<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2TvGoeHy9sAJSl5B7a1puocRVEbjLxbp';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->

</body>
</html>
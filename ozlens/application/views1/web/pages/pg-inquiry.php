<?PHP
/**
 *@var $this CI_Controller
 */
 
 $crow = $this->db_model->get_row('content',array('id' => '156'));
 
 
 
?>

<!--middle div start-->

<form action="" method="post" name="contactFrm" id="contactFrm">
<div class="middle-main">
  <?PHP echo $this->load->view('web/includes/mobilecats');?>
  <div class="clearF"></div>
  <!-- end of "tinynav" -->
  
  <div class="leftNav-container"> 
    
    <!--nav div start--> 
    <?PHP echo $this->load->view('web/includes/categories');?> 
    <!--nav div end--> 
    
    <!--news div start--> 
    <?PHP echo $this->load->view('web/includes/news');?> 
    <!--news div end--> 
    
  </div>
  <!-- end of "leftNav-container" --> 
  
  <!--inner div start-->
  <div class="inner-main">
    
    <?php if($crow != null) {?>
    <div class="txt13 middle-l-f-items-hdng"><span class="txt14"><?php echo $crow->title; ?></span></div>
    <?php }?>
    <div class="middle-l-f-items-1 txt15">
    
    <?php if($crow != null) {?>
    <?php echo $crow->content; ?>
    <br /><br />
    <?php }?>
    
    
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15"><strong>Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="name" type="text" class="fld-02 required" id="name" value="<?PHP echo set_value('name');?>"/>
        </div>
      </div>
    </div>
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15"><strong>Email Address</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="email" type="text" class="fld-02 required email" id="email" value="<?PHP echo set_value('email');?>"/>
        </div>
      </div>
    </div>
   
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15"><strong>Message</strong></div>
        <div class="inner-fld-01 txt15">
          <textarea name="message" id="message" cols="45" rows="5" class="cmntbox-01 required"><?PHP echo set_value('message');?></textarea>
        </div>
      </div>
    </div>
    <div class="middle-l-f-items-1 txt15">
      <div class="sndmsg-bt-01">
        <input type="submit" class="c-here-bt1" value="SEND MESSAGE"/>
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
      </div>
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>
</form>

<!--middle div end--> 

<script>
$jqvalidation(document).ready(function() {

    $jqvalidation("#contactFrm").validate({});
	
});
</script>

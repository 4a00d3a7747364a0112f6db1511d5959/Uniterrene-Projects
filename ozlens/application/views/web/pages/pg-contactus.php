<?PHP
/**
 *@var $this CI_Controller
 */
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
    <div class="txt13 middle-l-f-items-hdng">
    <h1 class="txt13">Contact <span class="txt14">Us</span></h1>
    
   
    </div>
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">
        

        <?php echo $this->db_model->get_row('settings',array('key'=>'address'))->value; ?>
        <br /><br /><br />        
        
        <strong>Name</strong></div>
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
        <div class="inner-fld-01 txt15"><strong>Subject</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="subject" type="text" class="fld-02 required" id="subject" value="<?PHP echo set_value('subject');?>"/>
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

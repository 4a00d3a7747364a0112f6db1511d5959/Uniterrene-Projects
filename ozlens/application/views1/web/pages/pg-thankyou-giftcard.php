<?PHP
/**
 *@var $this CI_Controller
 */
?>

<!--middle div start-->

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
		THANK <span class='txt14'>YOU</span>
    </div>
    
    <div class="middle-l-f-items-1 txt15">
    <?php echo $this->session->flashdata('response2');?>
    </div>
    
   
     <div class="middle-l-f-items-1 txt15" id="printable">
     
    
     
    </div>
   
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>

<!--middle div end--> 

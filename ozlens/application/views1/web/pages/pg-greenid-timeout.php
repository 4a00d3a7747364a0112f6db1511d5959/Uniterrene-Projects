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
        GreenID session time out.  <!--<span class='txt14'>Registering!</span>-->
    </div>
    <div class="middle-l-f-items-1 txt15">
        Your request was taking too long to process. Please try again later.
    </div>
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
  </div>
  <!--inner items div end--> 
</div>
<!--middle div end--> 
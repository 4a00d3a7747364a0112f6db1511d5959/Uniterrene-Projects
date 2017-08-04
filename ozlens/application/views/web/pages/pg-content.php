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
    <h1 class="txt13">
		<?PHP 
		$pg_title = explode(' ',$page_title);
		$i = 0;
		foreach($pg_title as $title)
		{
			if($i<sizeof($pg_title)-1)
			{
				echo $title." ";
			}
			else
			{
				echo "<span class='txt14'>".$title."</span> ";
			}
			$i++;			
		}
		?>
        </h1>
    </div>
    
    <div class="middle-l-f-items-1 txt15">
    <?PHP echo $page_data->content;?>   
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>

<!--middle div end--> 

<form action="" method="post" name="fpFrm" id="fpFrm">
<div class="middle-main"> 
  
  <!--inner div start-->
  <div class="inner-main-01">
    <div class="txt13 middle-l-f-items-hdng"><h1 class="txt13">Forgot <span class="txt14">Password</span></h1></div>
    
    
    <!-- <div class="middle-l-f-items-1 txt15">-->
    
    <div class="inner-fld-02">
      <div class="inner-fld-01 txt15"><strong>Email Address</strong></div>
      <div class="inner-fld-01 txt15">
        <input name="email" type="text" class="fld-01 required email" id="email" value="<?PHP echo set_value('email');?>" />
      </div>
    </div>
    
    <!--</div>-->
    <div class="clearF"></div>       
    
    <div class="middle-l-f-items-1 txt15">
      <div class="signin-bt-01">
        <input type="submit" class="c-here-bt1" value="Submit"/>
      </div>
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>
</form>

<script>
$jqvalidation(document).ready(function() {

    $jqvalidation("#fpFrm").validate({});
	
});
</script>

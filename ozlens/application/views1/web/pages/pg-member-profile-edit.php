<form action="" method="post" name="profileEdit" id="profileEdit">
<div class="middle-main"> 
  
  <!--inner div start-->
  <div class="inner-main-01">
    <div class="txt13 middle-l-f-items-hdng">Edit your <span class="txt14">Account</span></div>
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>First Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="first_name" type="text" class="fld-01 required" id="first_name" value="<?PHP echo set_value('first_name',$row->first_name);?>" />
        </div>
      </div>
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Last Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="last_name" type="text" class="fld-01 required" id="last_name" value="<?PHP echo set_value('last_name',$row->last_name);?>" />
        </div>
      </div>
    </div>
    
    <!-- <div class="middle-l-f-items-1 txt15">-->
    
    <div class="inner-fld-02">
      <div class="inner-fld-01 txt15">*<strong>Email Address</strong></div>
      <div class="inner-fld-01 txt15">
        <input name="email" type="text" class="fld-01 required email" id="email" readonly="readonly" value="<?PHP echo set_value('email',$row->email);?>" />
      </div>
    </div>
    
    <!--</div>-->
    <div class="clearF"></div>
    
    <!--<div class="middle-l-f-items-1 txt15">-->
    
    <div class="inner-fld-02">
      <div class="inner-fld-01 txt15">*<strong>Password</strong></div>
      <div class="inner-fld-01 txt15">
        <input name="password" type="password" class="fld-01 required" id="password" value="<?PHP echo set_value('password',$row->password);?>" />
      </div>
    </div>
    <div class="inner-fld-02">
      <div class="inner-fld-01 txt15">*<strong>Password Confirmation</strong></div>
      <div class="inner-fld-01 txt15">
        <input name="confirm_password" type="password" class="fld-01 required" equalTo="#password" id="confirm_password" value="<?PHP echo set_value('confirm_password',$row->password);?>"  />
      </div>
    </div>
    
    <!-- </div>-->
    
    <div class="middle-l-f-items-1 txt15">
      <input name="news_letter" type="checkbox" id="news_letter" value="Yes" <?php if($row->news_letter == 'Yes'){echo set_checkbox('news_letter', 'Yes',true);}?> />
      Subscribe to the OzLensRental.com Newsletter</div>
    <div class="middle-l-f-items-1 txt15">
      <div class="signin-bt-01">
        <input type="submit" class="c-here-bt1" value="Submit"/> 
      </div>
      <div class="signin-bt-01">
      &nbsp;&nbsp;&nbsp;<a href="<?PHP echo base_url();?>member/myaccount">go back</a>
      </div>
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>
</form>

<script>
$jqvalidation(document).ready(function() {

    $jqvalidation("#profileEdit").validate({});
	
});
</script>

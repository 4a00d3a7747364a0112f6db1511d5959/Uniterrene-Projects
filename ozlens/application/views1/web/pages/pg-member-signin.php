<form id="loginFrm" name="loginFrm"  enctype="multipart/form-data" method="post" action="<?PHP echo base_url();?>member/signin">
  <div class="middle-main"> 
    
    <!--inner div start-->
    <div class="inner-main-01">
      <div class="txt13 middle-l-f-items-hdng">SIGN <span class="txt14">IN</span></div>
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>Email Address</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="email" type="text" class="fld-01 required email" id="email" value="<?PHP echo set_value('email');?>"/>
        </div>
      </div>
      <div class="middle-l-f-items-1 txt15">
        <input name="customer" type="radio" value="returning" checked="checked" onclick="toggle_div('reg_fields','hide');" />
        I am a returning customer.</div>
      <div class="middle-l-f-items-1 txt15">
        <input name="customer" type="radio" value="new" onclick="toggle_div('reg_fields','show');"/>
        I am a new customer</div>
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>Password</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="password" type="password" class="fld-01 required" id="password" />
        </div>
      </div>
      <div id="reg_fields" style="display:none;">
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>Confirm Password</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="confirm_password" type="password" class="fld-01 required" id="confirm_password" />
        </div>
      </div>
      
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>First Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="first_name" type="text" class="fld-01 required" id="first_name" value="<?PHP echo set_value('first_name');?>"/>
        </div>
      </div>
      
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>Middle Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="middle_name" type="text" class="fld-01 required" id="middle_name" value="<?PHP echo set_value('middle_name');?>"/>
        </div>
      </div>
      
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>Last Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="last_name" type="text" class="fld-01 required" id="last_name" value="<?PHP echo set_value('last_name');?>"/>
        </div>
      </div>
     
      <div class="inner-fld-01">
        <div class="inner-fld-01 txt15">*<strong>Date of Birth</strong></div>
        <div class="inner-fld-01 txt15">
	      <input name="dob" type="text" readonly="readonly" class="fld-01 required" id="dob" value="<?PHP echo set_value('dob');?>" />
        </div>
      </div>
      
      </div>
      
      
      <div class="middle-l-f-items-1 txt15">
        <div class="signin-bt-01">
          <input name="Submit" type="submit" class="c-here-bt1" value="SIGN IN"/>
        </div>
      </div>
      <div class="middle-l-f-items-1 txt15"> <a href="<?PHP echo base_url();?>member/forgotpassword" class="txt12">Forgot your password?</a>
      
      <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
      
    </div>
    <!--inner items div end--> 
    
  </div>
</form>
 <script>
	$(function() {
		$( "#dob" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear:true,changeMonth:true,yearRange: '1910:<?=@date('Y')?>',maxDate:new Date() });
	});
</script>

<script>
$jqvalidation(document).ready(function() {

    $jqvalidation("#loginFrm").validate({
		ignore: ':hidden'
		});
	
});

function toggle_div(divid, action)
{
	if(action == 'show')
	{
		document.getElementById(divid).style.display = "";
		document.getElementById('loginFrm').action = "<?PHP echo base_url();?>member/signup";
	}
	else if(action =='hide')
	{
		document.getElementById(divid).style.display = "none";
		document.getElementById('loginFrm').action = "<?PHP echo base_url();?>member/signin";
	}
}

</script>

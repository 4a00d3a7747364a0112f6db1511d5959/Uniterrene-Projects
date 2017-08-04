<form action="" method="post" name="signupFrm" id="signupFrm">
<div class="middle-main"> 
  
  <!--inner div start-->
  <div class="inner-main-01">
    <div class="txt13 middle-l-f-items-hdng">CREATE YOUR <span class="txt14">ACCOUNT</span></div>
    
     <table cellpadding="3" cellspacing="1" border="0" width="100%">
     	<tr>
        	<td colspan="3" ><div class="inner-fld-01 txt15" style="border-bottom:1px solid #B60F19; width:88%; color:#B60F19;"><strong>Personal Information</strong></div></td>
        </tr>
        <tr>
        	<td>
            	<div class="inner-fld-02">
                    <div class="inner-fld-01 txt15">*<strong>Given Name</strong></div>
                    <div class="inner-fld-01 txt15">
                      <input name="first_name" type="text" class="fld-01 required" id="first_name" value="<?PHP echo set_value('first_name');?>" />
                    </div>
                  </div>
            </td>
            <td>
            	<div class="inner-fld-02">
                    <div class="inner-fld-01 txt15"><strong>Middle Name</strong></div>
                    <div class="inner-fld-01 txt15">
                      <input name="middle_name" type="text" class="fld-01" id="middle_name" value="<?PHP echo set_value('middle_name');?>" />
                    </div>
                  </div>
            </td>
            <td>
            	 <div class="inner-fld-02">
                    <div class="inner-fld-01 txt15">*<strong>Surname</strong></div>
                    <div class="inner-fld-01 txt15">
                      <input name="last_name" type="text" class="fld-01 required" id="last_name" value="<?PHP echo set_value('last_name');?>" />
                    </div>
                  </div>
            
            </td>
        </tr>
        <tr>
            <td>
            	 <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Email Address</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="email" type="text" class="fld-01 required email" id="email" value="<?PHP echo set_value('email');?>" />
                  </div>
                </div>
            </td>
            <td>
            	 <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Date of Birth</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="dob" type="text" readonly="readonly" class="fld-01 required" id="dob" value="<?PHP echo set_value('dob');?>" />
                  </div>
                </div>
            </td>
            <td>
            	<div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Password</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="password" type="password" class="fld-01 required" id="password" />
                  </div>
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
            <td>
            	<div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Password Confirmation</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="password" type="passconf" class="fld-01 required" id="passconf" />
                  </div>
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="3" ><div class="inner-fld-01 txt15" style="border-bottom:1px solid #B60F19; width:88%; color:#B60F19;"><strong>Contact Information</strong></div></td>
        </tr>
        
        <tr>
        	<td>
            	<div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Home Phone</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="homePhone" type="text" maxlength="10" class="fld-01 required" id="homePhone" value="<?PHP echo set_value('homePhone');?>" />
                  </div>
                </div>
            </td>
            <td>
            	 <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Mobile</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="mobile" type="text" maxlength="10" class="fld-01 required" id="mobile" value="<?PHP echo set_value('mobile');?>" />
                  </div>
                </div>
            </td>
            <td>
            	<div class="inner-fld-02">
                  <div class="inner-fld-01 txt15"><strong>Work</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="workPhone" type="text" maxlength="10" class="fld-01" id="workPhone" value="<?PHP echo set_value('workPhone');?>" />
                  </div>
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="3" ><div class="inner-fld-01 txt15" style="border-bottom:1px solid #B60F19; width:88%; color:#B60F19;"><strong>Address</strong></div></td>
        </tr>
        
        <tr>
        	<td>
            	 <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Street Number</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="streetNumber" type="text" maxlength="10" class="fld-01 required" id="streetNumber" value="<?PHP echo set_value('streetNumber');?>" />
                  </div>
                </div>
            </td>
            <td>
            	 <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Street Name</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="streetName" type="text" maxlength="10" class="fld-01 required" id="streetName" value="<?PHP echo set_value('streetName');?>" />
                  </div>
                </div>
            </td>
            <td>
            	  <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Street Type</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="streetType" type="text" maxlength="10" class="fld-01 required" id="streetType" value="<?PHP echo set_value('streetType');?>" />
                  </div>
                </div>
            </td>
        </tr>
        
        
        <tr>
        	<td>
            	<div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Suburb</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="suburb" type="text" class="fld-01 required" id="suburb" value="<?PHP echo set_value('suburb');?>" />
                  </div>
                </div>
            </td>
            <td>
                  <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Post Code</strong></div>
                  <div class="inner-fld-01 txt15">
                    <input name="postcode" type="text" maxlength="4" class="fld-01 required" id="postcode" value="<?PHP echo set_value('postcode');?>" />
                  </div>
                </div>
            </td>
            <td>
                  <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15">*<strong>Country</strong></div>
                  <div class="inner-fld-01 txt15">
                  <?php
                  	if($countries->num_rows()>0){
						//Australia
						$selected_country = 'Australia';
						if($this->input->post('country') != ''){$selected_country = $this->input->post('country');}
						
						echo countries_drop_down($countries,$selected_country);	
					}
				  ?>
                  </div>
                </div>
            </td>
        </tr>
     </table>
    
    <div class="middle-l-f-items-1 txt15">
      <input name="news_letter" type="checkbox" id="news_letter" value="Yes" <?php echo set_checkbox('news_letter', 'Yes'); ?> />
        <strong>Let me know about new gear and deals!</strong></div>
    <div class="middle-l-f-items-1 txt15">
      <div class="signin-bt-01">
        <input type="submit" class="c-here-bt1" value="SIGN UP"/>
      </div>
    </div>
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

    $jqvalidation("#signupFrm").validate({});
	
});
</script>

<form action="" method="post" name="addressEdit" id="addressEdit">
<div class="middle-main"> 
  
  <!--inner div start-->
  <div class="inner-main-01">
    <div class="txt13 middle-l-f-items-hdng"><h1 class="txt13"><?PHP echo $heading;?></h1></div>
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15"><strong>Full Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="full_name" type="text" class="fld-01 required" id="full_name" value="<?PHP echo set_value('full_name',$row->full_name);?>" />
        </div>
      </div>
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15"><strong>Company Name (optional)</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="company_name" type="text" class="fld-01" id="company_name" value="<?PHP echo set_value('company_name',$row->company_name);?>" />
        </div>
      </div>
    </div>
    
    <!-- <div class="middle-l-f-items-1 txt15">-->
      <div class="middle-l-f-items-1 txt15">
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>Street Address</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="street_address" type="text" class="fld-01 required" id="street_address" value="<?PHP echo set_value('street_address',$row->street_address);?>" />
              </div>
          </div>
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>Apt #, Suite</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="apartment_no" type="text" class="fld-01 required" id="apartment_no" value="<?PHP echo set_value('apartment_no',$row->apartment_no);?>" />
              </div>
          </div>
      </div>
    <!--</div>-->

      <!-- <div class="middle-l-f-items-1 txt15">-->
      <div class="middle-l-f-items-1 txt15">
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>Suburb</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="city" type="text" class="fld-01 required" id="city" value="<?PHP echo set_value('city',$row->city);?>" />
              </div>
          </div>
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>State</strong></div>
              <div class="inner-fld-01 txt15">

                  <select name="state" id="state" class="fld-01 required">
                      <option value="">Select</option>
                      <?PHP
                      $states = $this->db_model->get_table('states');
                      foreach($states as $state)
                      {
                          ?>
                          <option value="<?PHP echo $state->state_name;?>" <?PHP if($row->state ==  $state->state_name){echo set_select('state',$state->state_name , true);}else{echo set_select('state', $state->state_name); }?>><?PHP echo $state->state_name;?></option>
                      <?PHP
                      }
                      ?>
                  </select>

              </div>
          </div>
      </div>
      <!--</div>-->

      <!-- <div class="middle-l-f-items-1 txt15">-->
      <div class="middle-l-f-items-1 txt15">
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>Post Code</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="zip" type="text" class="fld-01 required" id="zip" value="<?PHP echo set_value('zip',$row->zip);?>" />
              </div>
          </div>
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>Phone Number</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="phone_no" type="text" class="fld-01 required" id="phone_no" value="<?PHP echo set_value('phone_no',$row->phone_no);?>" />
              </div>
          </div>
      </div>
      <!--</div>-->

      <!-- <div class="middle-l-f-items-1 txt15">-->
      <div class="middle-l-f-items-1 txt15">
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15"><strong>Mobile Number</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="mobile_no" type="text" class="fld-01 required" id="mobile_no" value="<?PHP echo set_value('mobile_no',$row->mobile_no);?>" />
              </div>
          </div>
      </div>
      <!--</div>-->
    <div class="clearF"></div>
    

    <div class="middle-l-f-items-1 txt15">

    <div class="middle-l-f-items-1 txt15">
      <div class="signin-bt-01">
        <input type="submit" class="c-here-bt1" value="Submit"/> 
      </div>
      <div class="signin-bt-01">
      &nbsp;&nbsp;&nbsp;<a href="<?PHP echo base_url();?>address">go back</a>
      </div>
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>

    <input name="id" type="hidden" class="fld-01" id="id" value="<?PHP echo set_value('id',$row->id);?>" />

</form>

<script>
$jqvalidation(document).ready(function() {

    $jqvalidation("#addressEdit").validate({});
	
});
</script>

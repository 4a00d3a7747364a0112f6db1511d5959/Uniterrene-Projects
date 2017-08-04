<style>
label.error {
    color: #fff;
}
</style>

<div class="middle-main"> 
  
  <!--inner div start-->
  <div class="inner-main-01">
    <div class="txt13 middle-l-f-items-hdng">
      <div class="inner-main-02 txt13">CHECK<span class="txt14"> OUT</span></div>
    </div>
    <div class="middle-l-f-items-1 txt15"> 
      
      <!--cart div start-->
      <div class="inner-main-07">
        <div class="middle-l-f-items-1 txt15">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="top">              
         		<?PHP echo $this->load->view('web/includes/checkout');?>
              </td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            <!--<tr>
              <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="87%" align="left" class="txt6">Where</td>
                    <td width="13%" align="left" class="txt6"></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="36" align="center" valign="middle" background="<?PHP echo base_url();?>assets/images/grid-bg.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="74%" align="left">Shipping round trip to via FedEx 2Day</td>
                                <td width="11%">&nbsp;</td>
                                <td width="15%" align="right"><strong>$124.00</strong></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="28%" align="left">&nbsp;</td>
                          <td width="43%">&nbsp;</td>
                          <td width="15%" class="txt19">Total:</td>
                          <td width="14%" align="right" class="txt19">$124.00</td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
            </tr>-->
            <tr>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
          </table>
        </div>
      </div>
      <!--cart div end--> 
      
      <!--billing div start-->
      
      <div class="inner-main-05-b">
        <div class="inner-main-05-c">
         <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="txt5"><strong> 1 Billing Info </strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        <div class="inner-main-05-c">
         <form name="shippingFrm" id="shippingFrm" method="post" action="">
          <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="txt5"><strong>2 Shipping Info</strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <?PHP
            $addresses = $this->db_model->get_rows('addresses',array('member_id'=>$this->session->userdata('member_data')->id,'address_type'=>'shipping'));
            if($addresses)
            {
                ?>
                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="txt1"><strong>Select from saved Addresses</strong></td>
                            </tr>
                            <tr>
                                <td height="5"></td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="saved_shipping_address" id="saved_shipping_address" class="fld-04" onchange="fill_address(this.value);">
                                        <option value="">New Address</option>
                                        <?PHP
                                        foreach($addresses as $address)
                                        {
                                            ?>
                                            <option value="<?PHP echo $address->full_name.",".$address->company_name.",".$address->street_address.",".$address->apartment_no.",".$address->city.",".$address->state.",".$address->zip.",".$address->phone_no.",".$address->mobile_no;?>"><?PHP echo $address->full_name.", ".$address->company_name." ".$address->street_address.", ".$address->apartment_no.", ".$address->city.", ".$address->state.", ".$address->zip;?></option>
                                        <?PHP
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table></td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>
            <?PHP
            }
            ?>
              <tr>
                  <td class="txt1">
                      <input onclick="fill_shipping_fields();" type="checkbox" name="same_as_billing" id="same_as_billing" value="1"/> Same as of Billing Address
                  </td>
              </tr>
              <tr>
                  <td>&nbsp;</td>
              </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Full Name</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="s_full_name" type="text" class="fld-04 required" id="s_full_name" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1"><strong>Company Name (optional)</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="s_company_name" type="text" class="fld-04" id="s_company_name" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
           
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Street Address</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="s_street_address" type="text" class="fld-04 required" id="s_street_address" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1"><strong>Apt #, Suite</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="s_apartment_no" type="text" class="fld-04" id="s_apartment_no" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Suburb</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="s_city" type="text" class="fld-04 required" id="s_city" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>State</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td>
                    <select  name="s_state" type="text" class="fld-04 required" id="s_state">
                    	<option value="">Select</option>
                    	<?PHP 
						$states =  $this->db_model->get_table('states');
						foreach($states as $state)
						{
						?>
                        <option value="<?PHP echo $state->state_name;?>"><?PHP echo $state->state_name;?></option>
                        <?PHP 
						}
						?>
                    </select></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Post Code</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="s_zip" type="text" class="fld-04 required" id="s_zip" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Phone Number</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td>
                    	<!--<input name="s_phone_no" type="text" class="fld-04 required phoneAU" id="s_phone_no" />-->
                        <input name="s_phone_no" type="text" class="fld-04" id="s_phone_no" />
                    </td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Mobile Number</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td>
                    	<!--<input name="s_mob_no" type="text" class="fld-04 required phoneAU" id="s_mob_no" />-->
                        <input name="s_mob_no" type="text" class="fld-04" id="s_mob_no" />
                    </td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div class="signin-bt-01">
                  <input type="submit" class="redeem-bt1" value="Continue"/>
                </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form>
        </div>
        <div class="inner-main-05-c">
          <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="txt5"><strong> 3 Payment Info </strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
      </div>
      
      <!--billing div end--> 
      
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>

<script>
    $jqvalidation(document).ready(function() {

        $jqvalidation("#shippingFrm").validate({});

    });

    function fill_shipping_fields()
    {
        if(document.getElementById('same_as_billing').checked == true)
        {
            document.getElementById('s_full_name').value = '<?PHP echo $order_data->b_full_name;?>';
            document.getElementById('s_company_name').value = '<?PHP echo $order_data->b_company_name;?>';
            document.getElementById('s_street_address').value = '<?PHP echo $order_data->b_street_address;?>';
            document.getElementById('s_apartment_no').value = '<?PHP echo $order_data->b_apartment_no;?>';
            document.getElementById('s_city').value = '<?PHP echo $order_data->b_city;?>';
            document.getElementById('s_zip').value = '<?PHP echo $order_data->b_zip;?>';
            document.getElementById('s_phone_no').value = '<?PHP echo $order_data->b_phone_no;?>';
            document.getElementById('s_mob_no').value = '<?PHP echo $order_data->b_mob_no;?>';
            document.getElementById('s_state').value =  '<?PHP echo $order_data->b_state;?>';
        }
        else
        {
            document.getElementById('s_full_name').value = '';
            document.getElementById('s_company_name').value = '';
            document.getElementById('s_street_address').value = '';
            document.getElementById('s_apartment_no').value = '';
            document.getElementById('s_city').value = '';
            document.getElementById('s_zip').value = '';
            document.getElementById('s_phone_no').value = '';
            document.getElementById('s_mob_no').value = '';
            document.getElementById('s_state').selectedIndex =  0;
        }
    }

    function fill_address(val)
    {
        if(val != "")
        {
            var res = val.split(",");
            $("#s_full_name").val(res[0]);
            $("#s_company_name").val(res[1]);
            $("#s_street_address").val(res[2]);
            $("#s_apartment_no").val(res[3]);
            $("#s_city").val(res[4]);
            $("#s_state").val(res[5]);
            $("#s_zip").val(res[6]);
            $("#s_phone_no").val(res[7]);
            $("#s_mob_no").val(res[8]);
        }
        else
        {
            $("#s_full_name").val('');
            $("#s_company_name").val('');
            $("#s_street_address").val('');
            $("#s_apartment_no").val('');
            $("#s_city").val('');
            $("#s_state").val('');
            $("#s_zip").val('');
            $("#s_phone_no").val('');
            $("#s_mob_no").val('');
        }
    }

</script>

<style>
label.error {
    color: #fff;
	display:block;
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
         <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="txt5"><strong> 2 Shipping Info </strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        
        <style>
        	.error-ul{ color:#FFF; list-style-image:none; list-style-type:none; margin:0px; padding:0px; margin:15px 0px 0px 15px;}
			.error-ul li{ }
			.form-control {
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
				color: #555;
				font-size: 14px;
				padding: 6px;
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			}
			.small{ width:50px;}
			.medium{ width:150px;}
			.large{ width:335px;}
        </style>
        <div class="inner-main-05-c">
        <?php
			if(validation_errors()){ echo '<ul class="error-ul">'.validation_errors().'</ul>';}
			//var_dump($this->session->flashdata('message'));
			if($this->session->userdata('messages')!='') {echo '<ul class="error-ul">'.$this->session->userdata('messages').'</ul>'; $this->session->unset_userdata('messages');}
		?>
         <form name="paymentFrm" id="paymentFrm" method="post" action="">
          <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="txt5"><strong>3 Payment Info</strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Name on Card</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="name_on_card" type="text" id="name_on_card" class="form-control large" required="required" value="<?=$this->input->post('name_on_card')?>" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Card No</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="car_no" type="text" id="car_no" maxlength="16" class="form-control large"   required="required" value="<?=$this->input->post('car_no')?>" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Expiry Date</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td>
                    <select  name="exp_month" type="text" required="required" class="form-control medium" id="exp_month" style="width:125px;">
                    	<option value="">Month</option>
                    	<?php for($i=1;$i<=12;$i++){
								if($i<10){
									$i = '0'.$i;	
								}
								if($this->input->post('exp_month') == $i){
									echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
						}?>	
                    </select>
                    
                    <select  name="exp_year" type="text" required="required" class="form-control medium" id="exp_year" style="width:125px;">
                      <option value="">Year</option>
                    	<?php 
							for($i=14;$i<23;$i++){
								if($this->input->post('exp_year') == $i){ echo '<option value="'.$i.'" selected="selected">20'.$i.'</option>';}else{ echo '<option value="'.$i.'">20'.$i.'</option>';}
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
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="txt1">*<strong>Cvv2</strong></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td><input name="cvv2" type="text" required="required" maxlength="4" class="form-control small" id="cvv2" value="<?=$this->input->post('cvv2')?>" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="txt1"><strong>Special Instructions</strong></td>
                  </tr>
                <tr>
                  <td height="5"></td>
                  </tr>
                <tr>
                  <td>
                  <textarea name="special_instructions" id="special_instructions" class="form-control large"><?=$this->input->post('special_instructions')?></textarea></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>

            <tr>
              <td><div class="signin-bt-01">
                  <input type="submit" class="redeem-bt1" value="Place Order"/>
                </div></td>
            </tr>
              <tr>
                  <td class="txt1">
                      By clicking the 'Place Order button you agree that you have read and understood the <a href="<?PHP echo base_url().$this->db_model->get_row('content',array('id'=>'149'))->slug;?>" class="txt1" style="text-decoration: underline;" target="_blank"><?PHP echo $this->db_model->get_row('content',array('id'=>'149'))->title;?></a>
                  </td>
              </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>          
        </form>
        </div>
      </div>
      
      <!--billing div end--> 
      
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>

<script>
/*$jqvalidation(document).ready(function() {
    $jqvalidation("#paymentFrm").validate({});
	
});*/
</script>

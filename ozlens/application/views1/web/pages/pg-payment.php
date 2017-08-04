
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
         
          
          <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              	<td>&nbsp;</td>
            </tr>
            <tr>
              	<td valign="middle" class="txt5"><strong>3 Payment Info</strong></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td class="txt1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
           	      <tr>
            	      <td width="19%"><strong>Pay With</strong></td>
            	      <td width="81%"><img src="<?php echo base_url();?>assets/images/visa1.png" alt="" width="50"  /> <img src="<?php echo base_url();?>assets/images/master1.png" alt="" width="50"  /> <img src="<?php echo base_url();?>assets/images/paypal1.png" alt="" width="50"  /></td>
          	      </tr>
          	    </table></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td>
            		<select id="payment_option" name="payment_option" class="form-control medium" onchange="changePaymentOption(this.value);">
                    	<option value="">Select</option>
                        <option value="sp" <?php if($this->input->post('poption') == 'sp'){ echo 'selected="selected"';}?>>Credit Card</option>
                        <option value="pp" <?php if($this->input->post('poption') == 'pp'){ echo 'selected="selected"';}?>>PayPal</option>
                    </select>	
           	 	</td>
            </tr>
            <tr>
            	<td class="txt1" id="popt">
                	<br />Please select payment option.<br /><br />
                </td>
            </tr>
          </table>
          
          <?php
          /*	echo '<pre>';
			$cart_items = $this->db_model->get_rows('cart',array('sess_id'=>$this->session->userdata('session_id')));
			print_r($cart_items);*/
		  
		  ?>
          
          
           <form name="pp_form" id="pp_form" method="post" action="" style="display:none;">
           <input type="hidden" name="poption" id="poption" value="pp" />
           <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0"  >
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <div class="signin-bt-01">
                            <input type="submit" id="btn_pp" name="btn_pp" class="redeem-bt1" value="Place Order"/>
                        </div>
                    </td>
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
          
          <form name="sp_form" id="sp_form" method="post" action="" style="display:none;">
          <input type="hidden" name="poption" id="poption" value="sp" />
          <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0"  >
           
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
              <?php if ($this->agent->is_browser('Safari') || $this->agent->is_browser('Chrome')) { ?>
              
                  <input type="submit" id="btn_sp" name="btn_sp"    class="redeem-bt1" onclick="if(document.getElementById('name_on_card').value !='' && document.getElementById('car_no').value !='' && document.getElementById('exp_month').value !='' && document.getElementById('exp_year').value !='' && document.getElementById('cvv2').value !=''){this.value='Processing ...';this.disabled =true;document.getElementById('sp_form').submit();document.getElementById('pmsg').style.display='inline';return;}" value="Place Order"/>
                                <?php } else {?>
			  
                  <input type="submit" id="btn_sp" name="btn_sp"    class="redeem-bt1" onclick="if(document.getElementById('name_on_card').value !='' && document.getElementById('car_no').value !='' && document.getElementById('exp_month').value !='' && document.getElementById('exp_year').value !='' && document.getElementById('cvv2').value !=''){this.value='Processing ...';this.disabled =true;document.getElementById('pmsg').style.display='inline';}" value="Place Order"/>
                  <?php }?>
                </div></td>
            </tr>
              <tr>
                  <td class="txt1">
                  
                  <div id="pmsg" style="display:none;">Only Press the Place Order button once, do not refresh or hit the back button until your payment is processed.<br /><br /></div>
                  
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

function changePaymentOption(opt){
	if(opt!='' && opt == 'sp'){ $('#sp_form').show(); $('#pp_form').hide(); $('#popt').hide();}
	else if(opt!='' && opt == 'pp'){$('#sp_form').hide(); $('#pp_form').show(); $('#popt').hide();}
	else{ $('#sp_form').hide(); $('#pp_form').hide(); $('#popt').show();}
}
/*$jqvalidation(document).ready(function() {
    $jqvalidation("#paymentFrm").validate({});
	
});*/
<?php if($this->input->post('poption') != ''){?>
changePaymentOption('<?php  echo $this->input->post('poption');?>');
<?php }?>
</script>


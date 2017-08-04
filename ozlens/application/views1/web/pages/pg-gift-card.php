<script>
    function setVal(action)
    {
        document.getElementById('actionbtn').value = action;
    }
</script>

<form action="" method="post" name="giftCardsFrm" id="giftCardsFrm">
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
	
	<?PHP //echo $heading;?></div>
    
     <div class="middle-l-f-items-1 txt15">
    <?PHP echo $page_data->content;?>  
    <p>&nbsp;</p> 
    </div>
    
    <div class="middle-l-f-items-1 txt15">
  
    <div class="signin-bt-01" style="width:100px;"><input type="button" class="c-here-bt1" value="Buy a Gift Card" onclick="document.getElementById('gfc_div').style.display = 'inline'"/></div> 
    </div>
    
    <div id="gfc_div" style="display:non;">
     <div class="txt10" style="padding-bottom:20px;"><strong>Your Details</strong></div>
    
      <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Your Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="your_name" type="text" class="fld-01 required" id="your_name" value="<?PHP echo set_value('your_name',$row->your_name);?>" />
        </div>
      </div>
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Your Phone</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="your_phone" type="text" class="fld-01 required" id="your_phone" value="<?PHP echo set_value('your_phone',$row->your_phone);?>" />
        </div>
      </div>
    </div>
    
      <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Your Mobile</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="your_mobile" type="text" class="fld-01 required" id="your_mobile" value="<?PHP echo set_value('your_mobile',$row->your_mobile);?>" />
        </div>
      </div>
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Your Email</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="your_email" type="text" class="fld-01 required" id="your_email" value="<?PHP echo set_value('your_email',$row->your_email);?>" />
        </div>
      </div>
    </div>
    
     <div class="txt10" style="padding-bottom:20px;"><strong>Recipients Details</strong></div>
    
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Recipients Name</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="recipient_name" type="text" class="fld-01 required" id="recipient_name" value="<?PHP echo set_value('recipient_name',$row->recipient_name);?>" />
        </div>
      </div>
      
      <div class="inner-fld-02">
                  <div class="inner-fld-01 txt15" style="width: 100%;"><strong>*Recipients Email</strong></div>
                  <div class="inner-fld-01 txt15">
                      <input name="email" type="text" class="fld-01 required email" id="email" value="<?PHP echo set_value('email',$row->email);?>" />
                  <!--(Redemption code will be sent here)-->
                  </div>
          </div>
      
    </div>
    
    <div class="middle-l-f-items-1 txt15">
      <div class="inner-fld-02">
              <div class="inner-fld-01 txt15">*<strong>Gift Voucher Amount (<?PHP echo $this->config->item('currency_symbol');?>)</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="amount" type="text" class="fld-01 required" id="amount" value="<?PHP echo set_value('amount',$row->amount);?>" />
              </div>
              </div>
      
      
      
    </div>


             
            <div class="middle-l-f-items-1 txt15">
            <div style="max-width:550px;">
            
            </div>
            
            <div class="inner-fld-01">
            <div class="inner-fld-01 txt15" >
            <strong>Your Message to the Recipient</strong>
            </div>
            <div class="inner-fld-011 txt15">
            <textarea id="message" class="cmntbox-01" rows="5" cols="45" name="message"></textarea>
            </div>
            </div>
            </div>
            
             <div class="middle-l-f-items-1 txt15">
              <div class="inner-fld-02">
                <div class="inner-fld-01 txt15">*<strong>Send Voucher to</strong></div>
                <div class="inner-fld-01 txt15">
                  <select  name="send_voucher_to" type="text" class="drpdwn-1 required" id="send_voucher_to" >
                    <option value="your_email">Your Email</option>
                      <option value="recipient_email">Recipient Email</option>
                        <option value="print_voucher">Print Voucher</option>
                   
                  </select>
                </div>
              </div>
              <div class="inner-fld-02">
                <div class="inner-fld-01 txt15">*<strong>Pay With</strong></div>
                <div class="inner-fld-01 txt15">
                 <select id="pay_with" name="pay_with" class="drpdwn-1 required" onchange="changePaymentOption(this.value);">
                    	<option value="">Select</option>
                        <option value="sp" <?php if($this->input->post('pay_with') == 'sp'){ echo 'selected="selected"';}?>>Credit Card</option>
                        <option value="pp" selected="selected" <?php if($this->input->post('pay_with') == 'pp'){ echo 'selected="selected"';}?>>PayPal</option>
                    </select>	
                </div>
              </div>
            </div>
            
       <div id="sp_form" style="display:none;">     
      <!-- <div class="middle-l-f-items-1 txt15">-->
      <div class="middle-l-f-items-1 txt15">
          
            <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Name on Card</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="name_on_card" type="text" class="fld-01 required" id="name_on_card" value="<?PHP echo set_value('name_on_card',$row->name_on_card);?>" />
        </div>
      </div>
           
              <div class="inner-fld-02">
        <div class="inner-fld-01 txt15">*<strong>Card no</strong></div>
        <div class="inner-fld-01 txt15">
          <input name="card_no" type="text" class="fld-01 required" id="card_no" value="<?PHP echo set_value('card_no',$row->card_no);?>" />
        </div>
      </div>
      
           

             </div>

            
                <!-- <div class="middle-l-f-items-1 txt15">-->
      <div class="middle-l-f-items-1 txt15">
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15">*<strong>Expiry Date</strong></div>
              <div class="inner-fld-01 txt15">
                  <select  name="exp_month" type="text" class="drpdwn-1 required" id="exp_month" style="width:100px;">
                      <option value="">Month</option>
                      <?PHP
                      for($i=1;$i<=12;$i++){
						  if($i<10){ $i = '0'.$i;}

                          ?>
                          <option value="<?=$i?>" <?php echo set_select('exp_month', $i ); ?>><?=$i?></option>
                      <?PHP
                      }
                      ?>
                  </select>
                  <select  name="exp_year" type="text" class="drpdwn-1 required" id="exp_year" style="width:100px;">
                      <option value="">Year</option>
                      <?PHP
                      for($i=14;$i<23;$i++){
                          ?>
                          <option value="<?=$i?>" <?php echo set_select('exp_year', $i ); ?>><?='20'.$i?></option>
                      <?PHP
                      }
                      ?>
                  </select>
              </div>
          </div>
          <div class="inner-fld-02">
              <div class="inner-fld-01 txt15">*<strong>Cvv2</strong></div>
              <div class="inner-fld-01 txt15">
                  <input name="cvv2" type="text" class="fld-01 required" id="cvv2" value="<?PHP echo set_value('cvv2',$row->cvv2);?>" />
              </div>
          </div>
      </div>
    <!--</div>-->
		</div>

        <div class="middle-l-f-items-1 txt15">

            <div class="middle-l-f-items-1 txt15">
                <div class="signin-bt-01">
                    <input type="submit" class="c-here-bt1" value="Send Now" onclick="setVal('sendNow')"/>
                    
                     
                </div>
                
               <div class="signin-bt-01" style="width:10px;">&nbsp;</div>
               
                <div class="signin-bt-01">
                   <input type="submit" class="c-here-bt1" value="Print Voucher" onclick="setVal('printVoucher')"/>
                           
                </div>
                
                <div class="signin-bt-01" style="width:10px;">&nbsp;</div>
                
                 <div class="signin-bt-01">
                   <input type="button" class="c-here-bt1" value="Send Later" onclick="document.getElementById('later_div').style.display = 'inline'"/>
                           
                </div>
                
                 <div class="signin-bt-01" style="width:10px;">&nbsp;</div>
                 
                 <div class="signin-bt-01">
                    &nbsp;&nbsp;&nbsp;<a href="<?PHP echo base_url();?>">go back</a>
                </div>
                
                <div class="signin-bt-01" style="clear:both;">&nbsp;</div>
                
                
                <div id="later_div" style="display:none;">
                    <div class="signin-bt-01">
                     Select Date: <input  name="send_date" type="text" class="fld-04 date" id="send_date" value=""  />
                      <div class="signin-bt-01" style="width:10px;">&nbsp;</div>
                       <input type="submit" class="c-here-bt1" value="Send" onclick="setVal('sendLater')"/>
                         
                    </div>
                </div>
                
               
            </div>

            <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>-->

        </div>
        
      </div>
      

          </div>

      </div>
      <!--</div>-->



    <div class="clearF"></div>



  <!--inner items div end-->
  
</div>
<input type="hidden" name="actionbtn" id="actionbtn" value="" />
</form>

<script>
/*$jqvalidation(document).ready(function() {

    $jqvalidation("#giftCardsFrm").validate({});
	$('.date').datepicker({minDate: 0});
	
});*/

</script>

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

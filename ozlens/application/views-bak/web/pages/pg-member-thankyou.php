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

        Thanks for  <span class='txt14'>Registering!</span>

    </div>

    

    <div class="middle-l-f-items-1 txt15">

        A confirmation email has been sent to you at <strong><?PHP echo $pg_data['email'];?></strong><br/><br/>

        Please verify your email address to make your account active.<br /><br />

        <?php if($this->session->userdata('green_id_post_data')){?>

        <table cellpadding="3" cellspacing="1" border="0">

        	<td>You need to get verified with GreenID.</td>

            <td>

            	 <?php $green_id_post_data = $this->session->userdata('green_id_post_data');?>

                <form action="<?=$this->config->item('green_id_post_data_url')?>" method="post">  

                    <input name="token" value="<?=$green_id_post_data['token']?>" type="hidden" />

                    <input name="userId" value="OZL<?=$green_id_post_data['userId']?>" type="hidden" />

                    <input name="customerId" value="<?=$green_id_post_data['customerId']?>" type="hidden"/>

                    <input name="returnUrl" value="<?=$green_id_post_data['returnUrl']?>" type="hidden" />

                    <input name="cancelUrl" value="<?=$green_id_post_data['cancelUrl']?>" type="hidden" />

                    <input name="timeoutUrl" value="<?=$green_id_post_data['timeoutUrl']?>" type="hidden" />

                    <input name="exceptionUrl" value="<?=$green_id_post_data['exceptionUrl']?>" type="hidden" />

                    <input type="submit" value="Proceed" />  

                </form>

                <?php $this->session->unset_userdata('green_id_post_data');?>

            </td>

        </table>

        <?php }?>

        

       

    </div>

    

    

    

    

    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 

    

  </div>

  <!--inner items div end--> 

  

</div>



<!--middle div end--> 
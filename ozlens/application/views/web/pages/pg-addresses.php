<?PHP
/**
 *@var $this CI_Controller
 */
?>
<!--middle div start-->

<div class="middle-main"> 
  
  <!--inner div start-->
  <div class="inner-main-01">
    <div class="txt13 middle-l-f-items-hdng"><h1 class="txt13">ADDRESS <span class="txt14">BOOK</span></h1></div>
    <div class="middle-l-f-items-1 txt15" style="margin-top: 10px;">
      
      <!--billin div start-->
      <div class="inner-main-02" style="width: 100%;">

          <div class="inner-main-03">
              <div class="editinfo-bt-01">
                  <input type="button" class="c-here-bt1" value="Add New" onclick="window.location='<?PHP echo base_url();?>address/add/billing'"/>

              </div>
          </div>

        <div class="middle-l-f-items-1 txt14-a"><h2 class="txt14-a">Billing</h2></div>
        <style>
			.orderTable tr td
			{
				height:30px;
				border-bottom: 1px solid #ccc;
			}
		</style>
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="orderTable">
          <tr>
                <td><strong>Full Name</strong></td>
                <td><strong>Company Name</strong></td>
                <td><strong>Street Address</strong></td>
                <td><strong>Apartment #</strong></td>
                <td><strong>Suburb</strong></td>
                <td><strong>State</strong></td>
                <td><strong>Zip</strong></td>
                <td><strong>Phone #</strong></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
          </tr>
          
          <?PHP 
		$addresses = $this->db_model->get_rows('addresses',array('member_id'=>$this->session->userdata('member_data')->id,'address_type'=>'billing'));
		if($addresses)
		{
		
            foreach($addresses as $address)
            {
            ?>

            <tr>
                <td><?PHP echo $address->full_name;?></td>
                <td><?PHP echo $address->company_name;?></td>
                <td><?PHP echo $address->street_address;?></td>
                <td><?PHP echo $address->apartment_no;?></td>
                <td><?PHP echo $address->city;?></td>
                <td><?PHP echo $address->state;?></td>
                <td><?PHP echo $address->zip;?></td>
                <td><?PHP echo $address->phone_no;?></td>
                <td><a href="<?PHP echo base_url();?>address/edit/<?PHP echo $address->id;?>">Edit</a></td>
                <td><a href="<?PHP echo base_url();?>address/del/<?PHP echo $address->id;?>" onclick="return confirm('Are you sure you want to continue?');">Delete</a></td>
              </tr>
            <?PHP
            }
		}
		else
		{
		?>
        <tr>
        	<td colspan="100%">
            You have not added any billing address yet.
            </td>
        </tr> 
        <?PHP 
		}
		?>
        </table>
        
      </div>
      <!--billinb div end-->


        <!--Shipping div start-->
        <div class="inner-main-02" style="width: 100%; margin-top: 30px;">

            <div class="inner-main-03">
                <div class="editinfo-bt-01">
                    <input type="button" class="c-here-bt1" value="Add New" onclick="window.location='<?PHP echo base_url();?>address/add/shipping'"/>
                </div>
            </div>

            <div class="middle-l-f-items-1 txt14-a"><h2 class="txt14-a">SHIPPING</h2></div>

            <style>
                .orderTable tr td
                {
                    height:30px;
                    border-bottom: 1px solid #ccc;
                }
            </style>

            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="orderTable">
                <tr>
                    <td><strong>Full Name</strong></td>
                    <td><strong>Company Name</strong></td>
                    <td><strong>Street Address</strong></td>
                    <td><strong>Apartment #</strong></td>
                    <td><strong>Suburb</strong></td>
                    <td><strong>State</strong></td>
                    <td><strong>Zip</strong></td>
                    <td><strong>Phone #</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <?PHP
                $addresses = $this->db_model->get_rows('addresses',array('member_id'=>$this->session->userdata('member_data')->id,'address_type'=>'shipping'));
                if($addresses)
                {

                    foreach($addresses as $address)
                    {
                        ?>

                        <tr>
                            <td><?PHP echo $address->full_name;?></td>
                            <td><?PHP echo $address->company_name;?></td>
                            <td><?PHP echo $address->street_address;?></td>
                            <td><?PHP echo $address->apartment_no;?></td>
                            <td><?PHP echo $address->city;?></td>
                            <td><?PHP echo $address->state;?></td>
                            <td><?PHP echo $address->zip;?></td>
                            <td><?PHP echo $address->phone_no;?></td>
                            <td><a href="<?PHP echo base_url();?>address/edit/<?PHP echo $address->id;?>">Edit</a></td>
                            <td><a href="<?PHP echo base_url();?>address/del/<?PHP echo $address->id;?>" onclick="return confirm('Are you sure you want to continue?');">Delete</a></td>
                        </tr>
                    <?PHP
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="100%">
                            You have not added any billing address yet.
                        </td>
                    </tr>
                <?PHP
                }
                ?>
            </table>

        </div>
        <!--Shipping div end-->

      
    </div>
    
    <!--<div class="middle-l-f-items-viewall"><a href="#" class="txt16">VIEW ALL...</a></div>--> 
    
  </div>
  <!--inner items div end--> 
  
</div>
<!--middle div end-->
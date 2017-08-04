<?PHP
/* @var $this CI_Controller*/
?>
<fieldset>
    <legend><h2><?php echo $page_title; ?></h2></legend>

    <table width="100%" align="center" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="16%" align="left" style="border:none;"><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
                    <tr>
                        <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/settings"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/global-settings.png" alt="" align="middle" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td style="border:none;" align="left"><font size="1">Site Settings</font></td>
                    </tr>
                    <tr></tr>
                </table></td>
            <td width="16%" align="left" style="border:none;" ><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
                    <tr>
                        <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/content"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/content_managemwnt.png" alt="" align="middle" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td style="border:none;" align="left"><font size="1">Content Management</font></td>
                    </tr>
                    <tr></tr>
                </table></td>
            <td width="16%" align="left" style="border:none;" ><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
              <tr>
                <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/members"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/manage-clients.png" alt="" align="middle" border="0" /></a></td>
              </tr>
              <tr>
                <td style="border:none;" align="left"><font size="1">Members Management</font></td>
              </tr>
              <tr></tr>
            </table></td>


            <td width="16%" align="left" style="border:none;" ><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
              <tr>
                <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/templates"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/email_64.png" alt="" align="middle" border="0" width="50" /></a></td>
              </tr>
              <tr>
                <td style="border:none;" align="left"><font size="1">Email Templates Management</font></td>
              </tr>
              <tr></tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="border:none;">&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="border:none;">&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="border:none;"><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
              <tr>
                <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/categories"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/manage-categories.png" alt="" align="middle" border="0" width="50" /></a></td>
              </tr>
              <tr>
                <td style="border:none;" align="left"><font size="1">Categories Management</font></td>
              </tr>
              <tr></tr>
            </table></td>
            <td align="left" style="border:none;" ><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
              <tr>
                <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/products"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/manage-projects.png" alt="" align="middle" border="0" width="50" /></a></td>
              </tr>
              <tr>
                <td style="border:none;" align="left"><font size="1">Products Management</font></td>
              </tr>
              <tr></tr>
            </table></td>
            <td align="left" style="border:none;" ><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
              <tr>
                <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/accountsettings"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/account-settings.png" alt="" align="middle" border="0" /></a></td>
              </tr>
              <tr>
                <td style="border:none;" align="left"><font size="1">Account Settings</font></td>
              </tr>
              <tr></tr>
            </table></td>
            <td align="left" style="border:none;" ><table align="center" cellpadding="0" cellspacing="0" style="border:none;">
              <tr>
                <td style="border:none;" align="center"><a href="<?php echo base_url(); ?>administration/login/logoff"> <img src="<?php echo base_url(); ?>assets/images/administration/icons/Logout.png" alt="" align="middle" border="0" /></a></td>
              </tr>
              <tr>
                <td style="border:none;" align="left"><font size="1">Logout</font></td>
              </tr>
              <tr></tr>
            </table></td>
        </tr>
        <tr>
            <td align="left" style="border:none;">&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
            <td align="left" style="border:none;" >&nbsp;</td>
        </tr>
    </table>
</fieldset>
<p>&nbsp;</p>
<fieldset>
    <legend><h2>Login Stats</h2></legend>
    <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td>
                <table style="border: medium none;">

                    <tbody>
                    <tr>
                        <td>Last Login:</td><td>(<strong><?PHP echo date('F j, Y, g:i a',strtotime($this->session->userdata('loggedinuser')->last_login));?></strong>)</td>
                    </tr>
                    <tr>
                        <td style="border: medium none; height: 5px;" colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Last Login IP:</td><td>(<strong><?PHP echo $this->session->userdata('loggedinuser')->ip;?></strong>)</td>
                    </tr>
                    <tr>
                        <td style="border: medium none; height: 5px;" colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Admin Visits:</td><td>(<strong><?PHP echo $this->session->userdata('loggedinuser')->visits;?></strong>)</td>
                    </tr>
                    </tbody>
                </table>

            </td>
        </tr>
    </table>
</fieldset>
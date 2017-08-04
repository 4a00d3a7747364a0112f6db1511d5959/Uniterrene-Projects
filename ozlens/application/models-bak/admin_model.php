<?php 

class Admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function role_validator($moduleid)
	{				
		/*$array = array('roleid' => $this->session->userdata('loggedinuserrole')->roleid,'privilegeid' => $moduleid);
		$row = $this->get_row('roles_permissions',$array);
		
		if($row == null)
		{
			$this->session->set_flashdata('response', '<div class="error-box"><strong>Access Denied</strong>, This section is not active against your role.</div>');
			redirect(base_url().'administration/error', 'refresh');		
		}*/
		
	}
	
	public function is_login()
	{
        if(!$this->session->userdata('loggedinuser'))
        {
            $this->session->set_flashdata('response', '<div class="error-box">Please login...!</div>');
            //redirect(base_url().'administration/login', 'refresh');
            ?>
            <script>parent.window.location='<?PHP echo base_url();?>administration/login';</script>
            <?PHP
            exit;
        }
    }

}

?>
<?php 

class Member_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function is_login()
	{
		
		$this->session->set_userdata('redirect_url',$_SERVER['HTTP_REFERER']);
		
        if(!$this->session->userdata('member_data'))
        {
            $this->session->set_flashdata('response', '<div class="error-box">Please login...!</div>');
            //redirect(base_url(), 'refresh');
            ?>
            <script>parent.window.location='<?PHP echo base_url();?>member/signin'</script>
            <?PHP
            exit;
        }
    }

  

}

?>
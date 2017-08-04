<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*ini_set('display_errors',1); 

 error_reporting(E_ALL);*/

class Member extends CI_Controller {

    private $error = "";

    public function __construct(){
        parent::__construct();
        // Your own constructor code
    }

    public function index(){
        redirect(base_url(),'refresh');
    }


    public function signup(){
       
	    if($this->input->post()){
            $this->load->library('form_validation');
			$this->form_validation->set_rules('news_letter', '', '');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
			//$this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');           
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[members.email]');
			$this->form_validation->set_message('is_unique', '%s is already taken, please try a different one.');
			$this->form_validation->set_rules('dob', 'Date of birth', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			
			$this->form_validation->set_rules('homePhone', 'Home', 'required|numeric|max_length[10]');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]');			

			if($this->input->post('workPhone')!=''){
				$this->form_validation->set_rules('workPhone', 'Work phone', 'required|numeric|max_length[10]');
			}

			$this->form_validation->set_rules('streetNumber', 'Street number', 'required');	
			$this->form_validation->set_rules('streetName', 'Street name', 'required');
			$this->form_validation->set_rules('streetType', 'Street type', 'required');
			$this->form_validation->set_rules('suburb', 'Suburb', 'required');
			$this->form_validation->set_rules('postcode', 'Post code', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');

            if (!$this->form_validation->run() == FALSE){

                $activation_code = substr(md5(uniqid(rand(), true)),0,20);

				$member_data = array('first_name' => $this->input->post('first_name'),
									 'middle_name' => $this->input->post('middle_name'),
									 'last_name' => $this->input->post('last_name'),
									 'email' => $this->input->post('email'),
									 'dob' => $this->input->post('dob'),
									 'password' => $this->input->post('password'),
									 'homePhone' => $this->input->post('homePhone'),
									 'workPhone' => $this->input->post('workPhone'),
									 'mobile' => $this->input->post('mobile'),
									 'streetNumber' => $this->input->post('streetNumber'),
									 'streetName' => $this->input->post('streetName'),
									 'streetType' => $this->input->post('streetType'),
									 'suburb' => $this->input->post('suburb'),
									 'postcode' => $this->input->post('postcode'),
									 'country' => $this->input->post('country'),
									 'registeration_date'=>@date('Y-m-d h:i:s'),
									 'last_modified' => @date('Y-m-d h:i:s'),
									 'activation_code' => $activation_code);

                $userID = $this->db_model->insert_row_retid("members",$member_data);

				$green_id_data = array('userId'=>$userID,
									   'givenName'=>$this->input->post('first_name'),
									   'middleNames'=>$this->input->post('middle_name'),
									   'surname'=>$this->input->post('last_name'),
									   'email' =>$this->input->post('email'),
									   'dob' =>$this->input->post('dob'),
									   'streetNumber' => $this->input->post('streetNumber'),
									   'streetName' => $this->input->post('streetName'),
									   'streetType' => $this->input->post('streetType'),
									   'suburb' => $this->input->post('suburb'),
									   'postcode' => $this->input->post('postcode'),
									   'country' => $this->input->post('country'));

                if($userID > 0){
					$outcome = $this->regsiterGreenId($green_id_data);
					$green_id_post_data = array();
					
					if($outcome == 'IN_PROGRESS'){
						$green_id_post_data['token'] = $this->getOneTimeSessionToken($userID);
						$green_id_post_data['userId'] = $userID;
						$green_id_post_data['customerId'] = $this->config->item('green_id_customer_id');
						$green_id_post_data['returnUrl'] = base_url().'member/signin';
						$green_id_post_data['cancelUrl'] = base_url().'member/signin';
						$green_id_post_data['timeoutUrl'] = base_url().'greenid/timeout';
						$green_id_post_data['exceptionUrl'] = base_url().'greenid/exception';
						$this->session->set_userdata('green_id_post_data',$green_id_post_data);
					}

					

					$activation_data = array('user_name' =>$this->input->post('first_name').' '.$this->input->post('middle_name').' '.$this->input->post('last_name'),
											 'email' => $this->input->post('email'),
											 'activation_code' => $activation_code);

					$this->send_activation_link($activation_data);
                }else{
                    $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
                    redirect($_SERVER['HTTP_REFERER'],'location');
                }
            }
		}

	  	$data['countries'] = $this->db_model->get_countries();
		$data['page_view']= "web/pages/pg-member-signup";
        $data['pg_title'] = 'SIGN <span class="text2">UP</span>';
        $this->load->view('web/shared/master',$data);
    }

	

	private function regsiterGreenId($data){

		$params = array('customerId'=>$this->config->item('green_id_customer_id'),
						'password'=>$this->config->item('green_id_password'),
						'userId'=>'OZL'.$data['userId'],
						'ruleId' => 'default',
						'name' => array('givenName'=>$data['givenName'],
										'middleNames'=>$data['middleNames'],
										'surname'=>$data['surname']),
										'dob'=>$data['dob'],
										'email'=>$data['email'],
										'currentResidentialAddress'=>array('streetNumber' => $data['streetNumber'],
														   'streetName' => $data['streetName'],
														   'streetType' => $data['streetType'],
														   'suburb' => $data['suburb'],
														   'postcode' => $data['postcode'],
														   'country' => $data['country'])); 
														   
		 $soap_client = new SoapClient($this->config->item('green_id_wsdl_url'));
		 $soap_response = $soap_client->registerUser($params);
		 return $soap_response->return->outcome;

	}

	

	private function getOneTimeSessionToken($userID){

		$params = array('customerId'=>$this->config->item('green_id_customer_id'),'password'=>$this->config->item('green_id_password'),'userId'=>'OZL'.$userID);
		$soap_client = new SoapClient($this->config->item('green_id_wsdl_url')); 

		try {
		 $soap_response = $soap_client->getOneTimeSessionToken($params);
		 $token =  $soap_response->tokenResult->token;
		}
		catch(Exception $e) {
		 	$token = '';
		}
		return $token;

	}
	
	private function getVerificationOutcome($userID){

		$params = array('customerId'=>$this->config->item('green_id_customer_id'),'password'=>$this->config->item('green_id_password'),'userId'=>'OZL'.$userID);
		$soap_client = new SoapClient($this->config->item('green_id_wsdl_url')); 
		
		try {
		 $soap_client = new SoapClient($this->config->item('green_id_wsdl_url'));
		 $soap_response = $soap_client->getVerificationResult($params);
		 $outcome =  $soap_response->result->outcome;
		}
		catch(Exception $e) {
				$outcome = '';
		}
		return $outcome;	
	}
	

	private function send_activation_link($vals){

		$activation_url = base_url()."member/activate/".$vals['activation_code'];
        $to = $vals['email'];
        $email_temp = $this->db_model->get_row('email_templates',array('id'=>1));
        $subject = $email_temp->subject;
        $body = $email_temp->content;
        $body = str_replace('{first_name}',$vals['user_name'],$body);
        $body = str_replace('{activation_url}',$activation_url,$body);
        $this->notificationmodel->send_email_no_template("",$to,$subject,$body);
		$this->session->set_flashdata('mem_data',$vals);
		redirect(base_url()."member/thankyou",'location');
	}



    public function thankyou(){

		$this->session->keep_flashdata('mem_data');
		$data['page_view'] = "web/pages/pg-member-thankyou";        
        $data['pg_data'] = $this->session->flashdata('mem_data');
        $this->load->view('web/shared/master',$data);
    }



    public function activate($activation_code = ""){
        if(strlen($activation_code) != "20"){
            $this->activate_view('There is an issue with the activation code, please try again later.');
        }else{
            $mem_data = $this->db_model->get_row('members',array('activation_code'=>$activation_code));
            if($mem_data){
                if($mem_data->status == "Pending Confirmation"){
                    $this->db_model->update_row('members',array('last_modified'=>date('Y-m-d h:i:s'),'status'=>'Active'),array('activation_code'=>$activation_code));

                    $to = $mem_data->email;
                    $email_temp = $this->db_model->get_row('email_templates',array('id'=>3));
                    $subject = $email_temp->subject;
                    $body = $email_temp->content;
                    $body = str_replace('{first_name}',$mem_data->first_name,$body);
                    $this->notificationmodel->send_email_no_template("",$to,$subject,$body);
                    $this->activate_view('Thank you, your account has been verified and activated.<br/> Please click <a href="'.base_url().'member/signin">here</a> to login.');
                    //$this->create_session($mem_data->user_name,$mem_data->password);
                }else{
                    $this->activate_view('Your Account is already verified. Pelase click <a href="'.base_url().'member/signin">here</a> to login.');
                }
            }else{
                $this->activate_view('We are sorry, we are unable to found your account information.');
            }
        }
    }

    private function activate_view($msg=""){
        $data['msg'] = $msg;
        $data['page_view'] = "web/pages/pg-member-activate";
        $this->load->view('web/shared/master',$data);
    }



    public function signin(){

        if($this->input->post()){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if (!$this->form_validation->run() == FALSE){
                 $vals = $this->input->post();
                 $this->create_session($vals['email'],$vals['password']);
            }
		}
		$data['page_view'] = 'web/pages/pg-member-signin';
        $this->load->view('web/shared/master',$data);
    }
	

	function getMemberTable(){
		//ALTER TABLE ozl_members ADD COLUMN `homePhone` VARCHAR(12) NULL AFTER `dob`, ADD COLUMN `workPhone` VARCHAR(12) NULL AFTER `homePhone`, ADD COLUMN `mobile` VARCHAR(12) NULL AFTER `workPhone`
		$result = $this->db->query("select * from ozl_gift_cards order by id desc limit 1");
		//$result = $this->db->query("ALTER TABLE ozl_gift_cards ADD COLUMN `securepay_id` VARCHAR(32) NULL AFTER `redeem_date`");
		var_dump($result->result_array());
	}



    private function create_session($email='',$password=''){

        $mem_data = $this->db_model->get_row("members",array('email'=>$email,'password'=>$password));

        if($mem_data){
            
			if($mem_data->status == "Pending Confirmation"){
                $this->session->set_flashdata('response', '<div class="error-box-home">Your Account has not been verified yet, please check your emails for your Account Confirmation verification link.</div>');
                redirect($_SERVER['HTTP_REFERER'],'refresh');
            
			}else if($mem_data->status == "Suspended"){
                $this->session->set_flashdata('response', '<div class="error-box-home">Your account is suspended by the site admin.</div>');
                redirect($_SERVER['HTTP_REFERER'],'refresh');
            
			}else if($mem_data->status == "Active"){
			    
				$this->session->set_userdata('member_data',$mem_data);
				$outcome  = $this->getVerificationOutcome($this->session->userdata('member_data')->id);
				
				if($outcome!='' && ($outcome == 'VERIFIED' || $outcome == 'VERIFIED_ADMIN')){
					$this->db_model->update_row('members',array('greenid_verified'=>1),array('id'=>$this->session->userdata('member_data')->id));
				}
				
                $dta = array();
                $dta['ip'] = $this->input->ip_address();
                $dta['last_login'] = date('Y-m-d h:i:s');
                $dta['visits'] = $this->session->userdata('member_data')->visits+1;

                $where = array();
                $where['email'] = $this->session->userdata('member_data')->email;
                $this->db_model->update_row('members',$dta,$where);
				
				redirect(base_url()."member/myaccount",'location');
				
				/*if($this->session->userdata('redirect_url')){
					$this->db_model->update_row('cart',array('member_id'=>$this->session->userdata('member_data')->id),array('sess_id'=>$this->session->userdata('session_id')));
					redirect($this->session->userdata('redirect_url'),'location');
				}else{
					redirect(base_url()."member/myaccount",'location');
				}  */               
            }
        }else{
            $this->session->set_flashdata('response', '<div class="error-box">Wrong credentials found, please try again.</div>');
            redirect($_SERVER['HTTP_REFERER'],'location');
        }
    }



    public function myaccount(){
        $this->member_model->is_login();
        $member_data = $this->db_model->get_row('members',array('id'=>$this->session->userdata('member_data')->id));
        $data['page_view'] = "web/pages/pg-myaccount";
		/*echo '<pre>';
		print_r($member_data);*/
		$green_id_post_data['token'] = $this->getOneTimeSessionToken($this->session->userdata('member_data')->id);
		$green_id_post_data['userId'] = $this->session->userdata('member_data')->id;
		$green_id_post_data['customerId'] = $this->config->item('green_id_customer_id');
		$green_id_post_data['returnUrl'] = base_url().'member/signin';
		$green_id_post_data['cancelUrl'] = base_url().'member/signin';
		$green_id_post_data['timeoutUrl'] = base_url().'greenid/timeout';
		$green_id_post_data['exceptionUrl'] = base_url().'greenid/exception';
		$data['green_id_post_data'] = $green_id_post_data;
        $data['member_data'] = $member_data;
        $this->load->view('web/shared/master',$data);
    }



    public function forgotpassword(){

        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE){
                $this->forgotpassword_view();
            }else{
                $vals = $this->input->post();
                $mem_data = $this->db_model->get_row("members",$vals);

                if($mem_data){
                    $to = $mem_data->email;
                    $email_temp = $this->db_model->get_row('email_templates',array('id'=>2));
                    $subject = $email_temp->subject;
                    $body = $email_temp->content;
                    $body = str_replace('{first_name}',$mem_data->first_name,$body);
                    $body = str_replace('{last_name}',$mem_data->last_name,$body);
                    $body = str_replace('{user_name}',$mem_data->user_name,$body);
                    $body = str_replace('{email}',$mem_data->email,$body);
                    $body = str_replace('{password}',$mem_data->password,$body);

                    $this->notificationmodel->send_email_no_template("",$to,$subject,$body);
                    $this->session->set_flashdata('response', '<div class="success-box">Your password has been sent to your email address.</div>');
                    redirect($_SERVER['HTTP_REFERER'],'location');
                }else{
                    $this->session->set_flashdata('response', '<div class="error-box">The email address you have entered doesn\'t match with our records.</div>');
                    redirect($_SERVER['HTTP_REFERER'],'location');
                }
            }
        }else{
            $this->forgotpassword_view();
        }
    }



    private function forgotpassword_view(){
        $data['page_view'] = 'web/pages/pg-member-forgot-password';
        $this->load->view('web/shared/master',$data);
    }



    public function edit(){

        $this->member_model->is_login();

        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 

			if($this->input->post('email') != $this->session->userdata('member_data')->email){       
            	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            	$this->form_validation->set_message('is_unique', 'The %s is already taken, please try a different one.');           
			}

            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            $vals = $this->input->post();

			if ($this->form_validation->run() == TRUE){

                unset($vals['email'],$vals['confirm_password'],$vals['news_letter']);

				if($this->input->post('news_letter')){
					$vals['news_letter'] = 'Yes';
				}else{
					$vals['news_letter'] = 'No';
				}

                $vals['last_modified'] = date('Y-m-d h:i:s');

                $where = array('id' => $this->session->userdata('member_data')->id);
                $res = $this->db_model->update_row('members',$vals,$where);

                if($res){
                    $this->session->set_flashdata('response', '<div class="success-box">Information has been modified.</div>');
                    redirect($_SERVER['HTTP_REFERER'],'location');

                }else{
                    $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
                    redirect($_SERVER['HTTP_REFERER'],'location');
                }
            }else{
                $this->edit_account_view();
            }
        }else{
            $this->edit_account_view();
        }
    }



    private function edit_account_view(){
        $data = array(      
            'row' => $this->db_model->get_row('members',array('id'=>$this->session->userdata('member_data')->id)),
            'page_view' => "web/pages/pg-member-profile-edit"
        );
        $this->load->view('web/shared/master',$data);
    }

    public function logout(){
        $this->session->unset_userdata('member_data');
        redirect(base_url(), 'refresh');
    }
}
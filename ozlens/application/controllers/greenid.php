<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*ini_set('display_errors',1); 
 error_reporting(E_ALL);*/
class Greenid extends CI_Controller {
	 
	 public function __construct(){
        parent::__construct();
        // Your own constructor code
    }

    public function index(){
        redirect(base_url(),'refresh');
    }
	
	public function timeout(){
		
		$data['page_view']= "web/pages/pg-greenid-timeout";
        $data['pg_title'] = 'GreenID session expired';
        $this->load->view('web/shared/master',$data);	
	}
	
	public function exception(){
		
		$data['page_view']= "web/pages/pg-greenid-exception";
        $data['pg_title'] = 'GreenID Exception';
        $this->load->view('web/shared/master',$data);	
	}
	
	
	
	
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    private $error = "";

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        $this->member_model->is_login();
    }

    public function index()
    {
        $data = array(
            'page_view' => "web/pages/pg-addresses"
        );

        $this->load->view('web/shared/master',$data);
    }

    private function intialize_form()
    {
        $values = (object) array(
            'id' => '',
            'member_id' => '',
            'full_name'=>'',
            'company_name' =>'',
            'street_address' => '',
            'apartment_no' => '',
            'city'=>'',
            'state' =>'',
            'zip'=>'',
            'phone_no'=>''
        );

        return $values;
    }


    private function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('full_name','Full Name','required');
        $this->form_validation->set_rules('company_name','','');
        $this->form_validation->set_rules('street_address','Street Address','required');
        $this->form_validation->set_rules('apartment_no', 'Apartment No', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('zip', 'Zip', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone no', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile no', 'required');

        return $this->form_validation->run();
    }

    private function verify_pk($id)
    {
        $res = $this->db_model->get_row('addresses',array('member_id'=>$this->session->userdata('member_data')->id,'id'=>$id));

        if(!$res)
        {
            $this->session->set_flashdata('response', '<div class="error-box">Bad request found.</div>');
            redirect(base_url().'address', 'location');
        }
    }

    public function edit($id = 0)
    {
        $vals = array();

        if($this->input->post('id'))
        {
            $id = $this->input->post('id');
            $vals = $this->input->post();
        }

        $this->verify_pk($id);

        if($this->input->post() && $this->validate())
        {

            $vals['member_id'] = $this->session->userdata('member_data')->id;
            $vals['last_modified'] = date('Y-m-d h:i:s');

            $where = array('id' => $id);

            $res = $this->db_model->update_row('addresses',$vals,$where);

            if($res)
            {
                $this->session->set_flashdata('response', '<div class="success-box">Information has been modified.</div>');
                redirect($_SERVER['HTTP_REFERER'],'location');
            }
            else
            {
                $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
                redirect($_SERVER['HTTP_REFERER'],'location');
            }
        }
        else
        {
            $address= $this->db_model->get_row('addresses',array('id'=>$id));
            $data = array(
                'page_view' => "web/pages/pg-address-edit",
                'heading' => "Edit your <span class='txt14'>Address</span>",
                'row'=> $address
            );

            $this->load->view('web/shared/master',$data);
        }

    }

    public function add($address_type="")
    {


        if($this->input->post() && $this->validate())
        {
            $vals = $this->input->post();

            $vals['member_id'] = $this->session->userdata('member_data')->id;
            $vals['last_modified'] = date('Y-m-d h:i:s');
            $vals['address_type'] = $address_type;

            $ret_id = $this->db_model->insert_row_retid("addresses",$vals);

            if($ret_id>0)
            {
                $this->session->set_flashdata('response', '<div class="success-box">Information has been added.</div>');
                redirect(base_url().'address','location');
            }
            else
            {
                $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
                redirect($_SERVER['HTTP_REFERER'],'location');
            }
        }
        else
        {

            $data = array(
                'page_view' => "web/pages/pg-address-edit",
                'heading' => "Add your <span class='txt14'>Address</span>",
                'row'=> $this->intialize_form()
            );

            $this->load->view('web/shared/master',$data);
        }
    }

    public function del($id = 0)
    {
        $this->verify_pk($id);

        $res = $this->db_model->delete_row("addresses",array('id'=>$id));

        if($res)
        {
            $this->session->set_flashdata('response', '<div class="success-box">Selected record has been deleted.</div>');
            redirect(base_url().'address', 'location');
        }
        else
        {
            $this->session->set_flashdata('response', '<div class="error-box">Request can not be processed at the moment, please try again later.</div>');
            redirect(base_url().'address', 'location');
        }
    }


}

/* End of file address.php */
/* Location: ./application/controllers/address.php */
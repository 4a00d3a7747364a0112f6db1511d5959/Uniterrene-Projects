<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends CI_Controller {

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
			
		$this->admin_model->is_login();
        $this->admin_model->role_validator('');

		// Your own constructor code    	
	}	
	 
	public function index()
	{
        if($this->input->get('image_id'))
        {
            $data['image_data'] = $this->db_model->get_row('banners',array('id'=>$this->input->get('image_id')));
        }

        $data["images"] = $this->db_model->sql("select * from {PRE}banners order by id desc");
        $data["page_title"] = "Manage Banners";
        $data["page_view"] = "administration/pages/pg-banners-edit";
        $data["error"] = $this->error;
		$this->load->view('administration/shared/master',$data);
	}

    public function get_image($img_name="",$width="",$height="")
    {
        if($img_name == "" || $width <=0 || $height <=0)
        {
            exit;
        }
        else
        {
            $img_name = str_replace("%20"," ",$img_name);
            $img = "./uploads/images/header/".$img_name."";
            $this->image_moo->load($img)->resize($width,$height)->save_dynamic();
            if ($this->image_moo->errors) print $this->image_moo->display_errors();
        }
    }

    public function gallery_upload($field = 'photo_image')
    {
        $path = './uploads/images/header/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = $this->config->item('image_types');
        $config['max_size']	= $this->config->item('max_size');
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if($this->input->get('image_id'))
        {
            if($_FILES[$field]['name']!="")
            {

                if ( ! $this->upload->do_upload($field))
                {

                    $this->error = $this->upload->display_errors('', '<br/>');
                    $this->index();
                    die($this->output->get_output());
                }

                else
                {
                    $data = $this->upload->data();
                    $vals['photo_image'] = $data['file_name'];
                }
            }

            $vals['photo_url'] = $this->input->post('photo_url');

            $this->db_model->update_row('banners',$vals,array('id'=>$this->input->get('image_id')));

            $this->session->set_flashdata('response', 'Information has been updated.');
        }
        else
        {

            if ( ! $this->upload->do_upload($field))
            {
                $this->error = $this->upload->display_errors('', '<br/>');
                $this->index();
                die($this->output->get_output());
            }
            else
            {
                $data = $this->upload->data();
                //$this->image_moo->load($path.$data['file_name']."")->resize("800","640")->save_pa($prepend="", $append="", $overwrite=FALSE);

                $vals = array('photo_url'=>$this->input->post('photo_url'),'photo_image'=>$data['file_name']);

                $this->db_model->insert_row_retid('banners',$vals);

                $this->session->set_flashdata('response', 'Image has been uploaded.');

            }
        }

        redirect(base_url().'administration/banners', 'location');
    }

    public function del_image()
    {
        $id = $this->input->post('delimage');

        $is_exist = $this->db_model->get_row('banners',array('id'=>$id));

        if($is_exist)
        {
            $this->db_model->delete_row("banners",array('id'=>$id));
            $this->session->set_flashdata('response', 'Selected image has been deleted.');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
        else
        {
            $this->session->set_flashdata('response', 'Request can not be processed at the moment, please try again later.');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
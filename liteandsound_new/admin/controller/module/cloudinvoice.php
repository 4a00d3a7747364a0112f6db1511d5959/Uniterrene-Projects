<?php
class ControllerModuleCloudinvoice extends Controller {
    private $error = array();
    
    public function index() {
        $this->load->language('module/cloudinvoice');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            error_log('request save'); error_log(print_r($this->request->post, true));
            
            $this->addProduct();

            $arr['order_sent_status'] = $this->request->post['order_sent_status'];
            $this->model_setting_setting->editSetting('order_sent', $arr);

            $this->model_setting_setting->editSetting('cloudinvoice', $this->request->post);        
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('module/cloudinvoice', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data = $this->init();
        $data['statuses'] = json_encode($this->getStatuses());    

        $this->load->language('module/cloudinvoice');

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        
        $data['entry_status'] = $this->language->get('entry_status');

        $data['text_invoicesystem'] = $this->language->get('invoicesystem');
        $data['text_cloudinvoiceurl'] = $this->language->get('cloudinvoiceurl');
        $data['text_cloudinvoiceapikey'] = $this->language->get('cloudinvoiceapikey');
        $data['text_URL_platform'] = $this->language->get('URL_platform');
        $data['text_Licensekey'] = $this->language->get('Licensekey');
        $data['text_api_key'] = $this->language->get('api_key');
        $data['text_loading'] = $this->language->get('loading');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
        $data['error_warning'] = $this->error['warning'];
        } else {
        $data['error_warning'] = '';
        }
        
        $data['entry_key'] = $this->language->get('entry_key');
        if (isset($this->request->post['cloudinvoice_api_key'])) {
        $data['cloudinvoice_api_key'] = $this->request->post['cloudinvoice_api_key'];
        } else {
        $data['cloudinvoice_api_key'] = $this->config->get('cloudinvoice_api_key');
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
                                             'text'      => $this->language->get('text_home'),
                                             'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                                             'separator' => false
                                       );

        $data['breadcrumbs'][] = array(
                                             'text'      => $this->language->get('text_module'),
                                             'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
                                             'separator' => ' :: '
                                       );

        $data['breadcrumbs'][] = array(
                                             'text'      => $this->language->get('heading_title'),
                                             'href'      => $this->url->link('module/featured', 'token=' . $this->session->data['token'], 'SSL'),
                                             'separator' => ' :: '
                                            );


        $data['action'] = $this->url->link('module/cloudinvoice', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['order_sent_status'])) {
            $data['order_sent_status'] = $this->request->post['order_sent_status'];
        } else {
            $data['order_sent_status'] = $this->config->get('order_sent_status');
        }
        
        //Version OpenCart 2.x
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/cloudinvoice.tpl', $data));
    }
    
    public function addProduct() {
        $productData = array(
            'name' => 'Test PRoduct',
            'model' => 'Product355',
            'price' => '134',
            'quantity' => '10',
            'status' => '1',
            'product_description' => array(
                1 => array(
                    'name' => 'Test PRoduct',
                    'description' => 'Test PRoduct',
                    'tag' => 'Test PRoduct',
                    'meta_title' => 'Test PRoduct',
                    'meta_description' => 'Test PRoduct',
                    'meta_keyword' => 'Test PRoduct',                    
                ),            
            ),
        );        
        $this->load->model('catalog/product');
        $ret = $this->model_catalog_product->addProduct($productData);        
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/cloudinvoice')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    private function getStatuses() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_status`");
        $statuses = $query->rows;
    
        $arrKeySort = array();
        foreach ($statuses as $st) {
            $arrKeySort[] = $st['order_status_id'];
        }
        array_multisort($arrKeySort, $statuses);
        $returnstats = array();
        foreach ($statuses as $st) {
            $stat = array();
            $stat['id'] = $st['order_status_id'];
            $stat['name'] = $st['name'];
            $returnstats[] = $stat;
        }            
        return $returnstats;
    }

    private function init() {
        $settings = $this->model_setting_setting->getSetting('cloudinvoice'); //To do, retrieve correct values
        if (!isset($settings['cloudinvoiceurl'])) {
            $settings['cloudinvoiceurl'] = '';
        }
        if (!isset($settings['cloudinvoiceapikey'])) {
            $settings['cloudinvoiceapikey'] = '';
        }
        if (!isset($settings['cloudinvoice_api_key'])) {
            $settings['cloudinvoice_api_key'] = '';
        }
        if (!isset($settings['cloudinvoiceinvoicesystem'])) {
            $settings['cloudinvoiceinvoicesystem'] = '';
        }
        return $settings;
    }
}

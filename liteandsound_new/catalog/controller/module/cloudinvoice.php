<?php

class ControllerModuleCloudinvoice extends Controller {

    public function test() {    
        if ($this->authorize()) {
            echo ('1');
        } else {
            echo ('0');
        }
        die();
    }

    public function orders() {    
        if ($this->authorize()) {
            $orderData['orders'] = array();
            $this->load->model('account/order');
            $startdate = $this->request->get['startdate'];
            $enddate = $this->request->get['enddate'];

            $results = $this->getAllOrders($startdate, $enddate);
                        
            $orders = array();

            if(count($results)){
                foreach ($results as $result) {
                    $orders[] = array(
                                      'orderid' => $result['order_id'],
                                      'orderdate'=> $result['date_added'],
                                      'orderstatus'=> $result['status'],
                                      'total'    => $result['total'],
                                     );
                }
                $json['success']     = true;
                $json['orders']     = $orders;
            } else {
                $json['success']     = false;
            }

        } else {
            $json['error'] = 'Invalid secret key';
            $this->response->addHeader('Content-Type: application/json');
        }
        echo(json_encode($json));
        die();
    }
    
    public function categories() {
        if ($this->authorize()) {
            
            $this->load->model('catalog/category');

            $categories = array();

            foreach ($this->model_catalog_category->getCategories(array()) as $category) {
                $categories[] = array(
                    'category_id' => $category['category_id'],
                    'name'        => $category['name']
                );
            }
            
            $json['success']     = true;
            $json['categories']     = $categories;
            
        } else {
            $json['error'] = 'Invalid secret key';
            $this->response->addHeader('Content-Type: application/json');
        }
        echo(json_encode($json));
        die();
    }
    
    public function products(){
        $categoryId = $this->request->get['categoryId'];
        if ($this->authorize()) {
            
            $this->load->model('catalog/product');
            
            $products = array();
            $data = array(
                'filter_category_id'  => $categoryId,
                'filter_sub_category' => true
            );
            foreach ($this->model_catalog_product->getProducts($data) as $product) {
                $products[] = array(
                    'product_id' => $product['product_id'],
                    'name'        => $product['name']
                );
            }
            $json['success']     = true;
            $json['products']     = $products;
            
        } else {
            $json['error'] = 'Invalid secret key';
            $this->response->addHeader('Content-Type: application/json');
        }
        echo(json_encode($json));
        die();
    }

    function order() {
        if ($this->authorize()) {
            $orderId = $this->request->get['orderid'];
            $orderdata = $this->getOrderById($orderId);

            $order['id'] = $orderdata['order_id'];
            $order['order_number'] = $orderdata['order_id'];
            $order['invoice_number'] = $orderdata['invoice_prefix'] . $orderdata['invoice_no'];
            $order['created_at'] = $orderdata['date_added'];
            $order['updated_at'] = $orderdata['date_modified'];

            $order['status'] = $orderdata['order_status_id'];
            $order['currency'] = $orderdata['currency_code'];
            $order['shipping_method'] = $orderdata['shipping_method'];
            $order['paymentmethod'] = $orderdata['payment_method'];
            $order['paymentcode'] = $orderdata['payment_code'];
            $order['shipping_country_id'] = $orderdata['shipping_country_id'];
            $order['shipping_zone_id'] = $orderdata['shipping_zone_id'];
            $order['payment_country_id'] = $orderdata['payment_country_id'];
            $order['payment_zone_id'] = $orderdata['payment_zone_id'];

            //getting products
            $order['line_items'] = $this->gettingOrderedProducts($orderId);
            $order['couponcodes'] = $this->gettingCouponcodes($orderdata['order_id']);
            $order['ordertotals'] = $this->gettingOrdertotals($orderdata['order_id']);
            $order['customer'] = $this->gettingCustomer($orderdata);

            $json['success']     = '1';
            $json['result']     = $order;
            echo(json_encode($json));
            die();
        }
    }

    public function init_statuses() {
        if ($this->authorize()) {
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
            echo json_encode($returnstats);
            die();
        }
    }

    public function init_taxes() {    
        if ($this->authorize()) {
            $taxes = $this->getTaxratesAndCountries();
            echo json_encode($taxes);
            die(); 
        }
    }

    public function init_paymentmethods() {    
        if ($this->authorize()) {
            $paymentmethods = array();

            $this->load->model('setting/extension');
            $results = $this->model_setting_extension->getExtensions('payment');

            foreach ($results as $result) {
                $file = $result;
                $extension = basename($file['code'], '.php');
                $this->load->language('payment/' . $extension);
                $pm = array();
                $pm['id'] = $file['code'];
                $pm['name'] = $this->language->get('text_title');
                $paymentmethods[] = $pm;
            }
            echo json_encode($paymentmethods);
            die(); 
        }
    }

    public function taxes() {    
        if ($this->authorize()) {
            $taxes = array();
    
            $taxes['geozones'] = $this->getZonetogeozone();
            $taxes['taxrules'] = $this->getTaxrules();
            $taxes['taxrates'] = $this->getTaxrates();
   
            echo json_encode($taxes);
            die(); 
        }
    }
    
    public function reports() {
         if ($this->authorize()) {
            $orderData['orders'] = array();
            $this->load->model('account/order');
            $startdate = $this->request->get['startdate'];
            $enddate = $this->request->get['enddate'];
            
            $query  = "SELECT count(order_id) as orders, sum(total) as amount ";
            $query .= "FROM `" . DB_PREFIX . "order` ";
            $query .= "WHERE order_status_id > '0' ";
            $query .= "AND date_added > '" . (string)$startdate . "' ";
            $query .= "AND date_added < '" . (string)$enddate . "' ";

            $stmt = $this->db->query($query);            
            
            $reports = array();
    
            $reports['orders'] = $stmt->rows[0]['orders'];
            $reports['amount'] = $stmt->rows[0]['amount'];
   
            echo json_encode($reports);
            die();         
         }
    }

    private function getAllOrders($startdate, $enddate, $start = 0, $limit = 2000) {
        if ($start < 0) {
            $start = 0;
        }
        
        if ($limit < 1) {
            $limit = 1;
        }    
        
        $query  = "SELECT order_id, order_status_id as status, date_added, total ";
        $query .= "FROM `" . DB_PREFIX . "order` ";
        $query .= "WHERE order_status_id > '0' ";
        $query .= "AND date_added > '" . (string)$startdate . "' ";
        $query .= "AND date_added < '" . (string)$enddate . "' ";
        $query .= "ORDER BY order_id";    

        $stmt = $this->db->query($query);
        return $stmt->rows;
    }
    
    private function gettingCustomer($orderdata) {
        $customer_id = '';
        if (isset($orderdata['customer_id'])) {
             $customer_id = $orderdata['customer_id'];
        }
        $paymentaddress = $orderdata['payment_address_1'];
        if (isset($order['payment_address_2'])) {
            $paymentaddress .= ' ' . $orderdata['payment_address_2'];
        }
        $customer = array(
            'customer_id'           =>      $customer_id,
            'first_name'            =>      $orderdata['firstname'],
            'last_name'             =>      $orderdata['lastname'],
            'company'               =>      $orderdata['payment_company'],
            'address'               =>      $paymentaddress,
            'city'                  =>      $orderdata['payment_city'],
            'postcode'              =>      $orderdata['payment_postcode'],
            'state'                 =>      '',
            'country'               =>      $orderdata['isocountry'],
            'email'                 =>      $orderdata['email'],
            'phone'                 =>      $orderdata['telephone'],
        );
        return $customer;
    }

    private function gettingOrderedProducts($orderid) {
        $orderitems = $this->getOrderproductsByOrderid($orderid);

        $products = array();
        if ($orderitems && count($orderitems) > 0) {
            foreach ($orderitems as $result) {
                $prod = $this->getProductById($result['product_id']);
                
                //As far as I can see the product price already includes discounts and specials. 
                $products[] = array(
                                    'product_id' => $result['product_id'],
                                    'name'       => htmlspecialchars($result['name']),
                                    'unitprice'  => $result['price'],
                                    'quantity'   => $result['quantity'],
                                    'sku'        => $prod['sku'],
                                    'taxclass'   => $prod['tax_class_id'],
                                    'total_tax'  => $result['quantity'] * $result['tax'],
                                    'subtotal'   => $result['quantity'] * $result['price'],
                                    'total'      => $result['quantity'] * ($result['price'] + $result['tax']),
                                    'ledger_code' => ''
                                  );
            }
        }
        return $products;
    }

    private function determinePaymentcode_deprecated($paymentname) {
        //Payment methods in opencartshop
        $paymentcode = '';

        $this->load->model('setting/extension');
        $results = $this->model_setting_extension->getInstalled('payment');

        foreach ($results as $result) {
            $file = $result;
            $extension = basename($file, '.php');
            $this->load->language('payment/' . $extension);
            $pname = $this->language->get('heading_title');
            if (strtolower($pname) == strtolower($paymentname)) {
                $paymentcode = $file;
            }
        }
        return $paymentcode;
    }

    private function gettingOrdertotals($orderId) {
        $totals = array();
        $ordertots = $this->getTotalsByOrderId($orderId);
        $ordertotals = array();

        foreach ($ordertots as $ot) {
            $ordertotal = array();
            $ordertotal['order_id'] = $ot['order_id'];
            $ordertotal['code'] = $ot['code'];
            $ordertotal['title'] = $ot['title'];
            $ordertotal['value'] = $ot['value'];
            $ordertotal['sort_order'] = $ot['sort_order'];
            $ordertotals[] = $ordertotal;
        }

        return $ordertotals;
    }

    private function gettingCouponcodes($orderId) {
        $coupons = array();
        $couponcodes = $this->getCouponsByOrderId($orderId);

        foreach ($couponcodes as $coupon) {
            $coupon['product'] = $this->getCouponProductsByCouponId($coupon['coupon_id']); 
            $coupons[] = $coupon;
        }

        return $coupons;
    }

    function getOrderById($orderId){
        $query  = "SELECT a.*, b.iso_code_2 as isocountry ";
        $query .= "FROM `" . DB_PREFIX . "order` a, `" . DB_PREFIX . "country` b ";
        $query .= "WHERE order_id = '" . (int)$orderId . "' ";
        $query .= "  AND a.payment_country_id = b.country_id"; 

        $stmt = $this->db->query($query);

        return $stmt->row;
    }

    private function getProductById($productId){
        $query  = "SELECT * FROM `" . DB_PREFIX . "product` ";
        $query .= "WHERE product_id = " . intval($productId);

        $stmt = $this->db->query($query);

        return $stmt->row;
    }

    private function getCouponsByOrderId($orderId){
        $query  = "SELECT * ";
        $query .= "FROM `" . DB_PREFIX . "coupon` a ";
        $query .= "WHERE EXISTS (";
        $query .= "              SELECT * ";
        $query .= "              FROM `" . DB_PREFIX . "coupon_history` b ";
        $query .= "              WHERE a.coupon_id = b.coupon_id ";
        $query .= "                AND order_id = " . intval($orderId) . ")";

        $stmt = $this->db->query($query);

        return $stmt->rows;
    }

    private function getCouponProductsByCouponId($couponId){
        $query  = "SELECT * ";
        $query .= "FROM `" . DB_PREFIX . "coupon_product` ";
        $query .= "WHERE coupon_id = " . intval($couponId);

        $stmt = $this->db->query($query);

        return $stmt->rows;
    }

    private function getOrderProductsByOrderId($orderId){
        $query  = "SELECT * ";
        $query .= "FROM `" . DB_PREFIX . "order_product` ";
        $query .= "WHERE order_id = '" . (int)$orderId . "' ";

        $stmt = $this->db->query($query);

        return $stmt->rows;
    }

    private function getTotalsByOrderId($orderId){
        $query  = "SELECT * ";
        $query .= "FROM `" . DB_PREFIX . "order_total` ";
        $query .= "WHERE order_id = '" . (int)$orderId . "' ";

        $stmt = $this->db->query($query);

        return $stmt->rows;
    }

    private function getZonetogeozone(){
        $query  = "SELECT * ";
        $query .= "FROM `" . DB_PREFIX . "zone_to_geo_zone`";
        $stmt = $this->db->query($query);
        return $stmt->rows;
    }

    private function getTaxrules(){
        $query = "SELECT * FROM `" . DB_PREFIX . "tax_rule`";
        $stmt = $this->db->query($query);
        return $stmt->rows;
    }

    private function getTaxrates(){
        $query = "SELECT * FROM `" . DB_PREFIX . "tax_rate`";
        $stmt = $this->db->query($query);
        return $stmt->rows;
    }

    private function getTaxratesAndCountries(){
        $query  = "SELECT tax_rate_id as id, a.name, rate as percentage, iso_code_2 as isocountry ";
        $query .= "FROM `" . DB_PREFIX . "tax_rate` a, `" . DB_PREFIX . "zone_to_geo_zone` b, `" . DB_PREFIX . "country` c ";
        $query .= "WHERE a.geo_zone_id = b.geo_zone_id ";
        $query .= "  AND b.country_id = c.country_id ";
        $stmt = $this->db->query($query);
        return $stmt->rows;
    }

    private function authorize() {
        $authorized = false;
        $date = date('mYd');
        $signature = md5($date . $this->config->get('cloudinvoice_api_key') . $date . $this->config->get('cloudinvoiceapikey'). $date);

        error_log($signature . ' == ' . $this->request->get['signature']);
        if($signature == $this->request->get['signature']) {
            $authorized = true;
        }
        error_log('authorized = ' . $authorized);

        return $authorized;
    }
}

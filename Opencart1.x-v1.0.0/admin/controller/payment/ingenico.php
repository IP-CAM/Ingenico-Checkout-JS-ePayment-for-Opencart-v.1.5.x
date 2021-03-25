<?php
class ControllerPaymentIngenico extends Controller {
	private $error = array();
	protected $data = array();

	public function index() {
		$this->load->language('payment/ingenico');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
        $this->load->model('payment/ingenico');

        $merchant_details = $this->model_payment_ingenico->get();
        $this->data['error_warning'] = array();

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		    if(count($this->validate()) == 0){
    		    $this->model_setting_setting->editSetting('ingenico', $this->request->post);
    		    $this->session->data['success'] = $this->language->get('text_success');

    		    if(is_array($merchant_details) && !isset($merchant_details[0])){
    		        $response = $this->model_payment_ingenico->add($this->request->post);
    		    }else{
    		        $response = $this->model_payment_ingenico->edit($this->request->post);
    		    }

    		    if($response === true){
    			    $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
    		    }
		    }else if (isset($this->error['warning'])) {
		        $this->data['error_warning'] = $this->error['warning'];
		    }
		}


		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_for_ingenico'] = $this->language->get('text_for_ingenico');

		//values from text box
		$this->data['request_type_T'] = $this->language->get('request_type_T');
		$this->data['verification_enabled_Y'] = $this->language->get('verification_enabled_Y');
		$this->data['verification_enabled_N'] = $this->language->get('verification_enabled_N');
		$this->data['verification_type_S'] = $this->language->get('verification_type_S');
		$this->data['verification_type_O'] = $this->language->get('verification_type_O');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['merchant_code'] = $this->language->get('merchant_code');
        $this->data['verification_enabled'] = $this->language->get('verification_enabled');
        $this->data['verification_type'] = $this->language->get('verification_type');
        $this->data['verification_enabled'] = $this->language->get('verification_enabled');
        $this->data['verification_type'] = $this->language->get('verification_type');
        $this->data['amount'] = $this->language->get('amount');
        $this->data['bank_code'] = $this->language->get('bank_code');
        $this->data['webservice_locator'] = $this->language->get('webservice_locator');
        $this->data['order_status'] = $this->language->get('order_status');
        $this->data['status'] = $this->language->get('status');
        $this->data['sort_order'] = $this->language->get('sort_order');
        $this->data['merchant_scheme_code'] = $this->language->get('merchant_scheme_code');
        $this->data['salt'] = $this->language->get('salt');
        $this->data['merchant_logo_url'] = $this->language->get('merchant_logo_url');
        $this->data['primary_color_code'] = $this->language->get('primary_color_code');
        $this->data['secondary_color_code'] = $this->language->get('secondary_color_code');
        $this->data['button_color_code1'] = $this->language->get('button_color_code1');
        $this->data['button_color_code2'] = $this->language->get('button_color_code2');
        $this->data['new_window_flow'] = $this->language->get('new_window_flow');
        $this->data['express_pay'] = $this->language->get('express_pay');
        $this->data['merchant_message'] = $this->language->get('merchant_message');
        $this->data['disclaimer_message'] = $this->language->get('disclaimer_message');
        $this->data['mer_transaction_details'] = $this->language->get('mer_transaction_details');
        $this->data['instrumentDeRegistration'] = $this->language->get('instrumentDeRegistration');
        $this->data['hide_saved_instruments'] = $this->language->get('hide_saved_instruments');
        $this->data['save_instrument'] = $this->language->get('save_instrument');
        $this->data['txnType'] = $this->language->get('txnType');
        $this->data['response_on_popup'] = $this->language->get('response_on_popup');
        $this->data['checkoutElement'] = $this->language->get('checkoutElement');
        $this->data['separateCardMode'] = $this->language->get('separateCardMode');
        $this->data['paymentModeOrder'] = $this->language->get('paymentModeOrder');
        $this->data['payment_mode'] = $this->language->get('payment_mode');

        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();


		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_ip_add'] = $this->language->get('button_ip_add');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/cod', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['verification'] = $this->url->link('custom/verification', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['recon'] = $this->url->link('custom/reconcilation', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['action'] = $this->url->link('payment/ingenico', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ingenico_merchant_code'])) {
		    $this->data['ingenico_merchant_code'] = $this->request->post['ingenico_merchant_code'];
		} else {
		    $this->data['ingenico_merchant_code'] = $this->config->get('ingenico_merchant_code');	
		}

		if (isset($this->request->post['ingenico_webservice_locator'])) {
		    $this->data['ingenico_webservice_locator'] = $this->request->post['ingenico_webservice_locator'];
		} else {
		    $this->data['ingenico_webservice_locator'] = $this->config->get('ingenico_webservice_locator');
		}

		if (isset($this->request->post['ingenico_order_status'])) {
		    $this->data['ingenico_order_status'] = $this->request->post['ingenico_order_status'];
		} else {
		    $this->data['ingenico_order_status'] = $this->config->get('ingenico_order_status');
		}

		if (isset($this->request->post['ingenico_status'])) {
		    $this->data['ingenico_status'] = $this->request->post['ingenico_status'];
		} else {
		    $this->data['ingenico_status'] = $this->config->get('ingenico_status');
		}

		if (isset($this->request->post['ingenico_sort_order'])) {
		    $this->data['ingenico_sort_order'] = $this->request->post['ingenico_sort_order'];
		} else {
		    $this->data['ingenico_sort_order'] = $this->config->get('ingenico_sort_order');
		}

		if (isset($this->request->post['ingenico_merchant_scheme_code'])) {
		    $this->data['ingenico_merchant_scheme_code'] = $this->request->post['ingenico_merchant_scheme_code'];
		} else {
		    $this->data['ingenico_merchant_scheme_code'] = $this->config->get('ingenico_merchant_scheme_code');
		}

		if (isset($this->request->post['ingenico_salt'])) {
		    $this->data['ingenico_salt'] = $this->request->post['ingenico_salt'];
		} else {
		    $this->data['ingenico_salt'] = $this->config->get('ingenico_salt');
		}		

		if (isset($this->request->post['ingenico_merchant_logo_url'])) {
		    $this->data['ingenico_merchant_logo_url'] = $this->request->post['ingenico_merchant_logo_url'];
		} else {
		    $this->data['ingenico_merchant_logo_url'] = $this->config->get('ingenico_merchant_logo_url');
		}		

		if (isset($this->request->post['ingenico_primary_color_code'])) {
		    $this->data['ingenico_primary_color_code'] = $this->request->post['ingenico_primary_color_code'];
		} else {
		    $this->data['ingenico_primary_color_code'] = $this->config->get('ingenico_primary_color_code');
		}

		if (isset($this->request->post['ingenico_secondary_color_code'])) {
		    $this->data['ingenico_secondary_color_code'] = $this->request->post['ingenico_secondary_color_code'];
		} else {
		    $this->data['ingenico_secondary_color_code'] = $this->config->get('ingenico_secondary_color_code');
		}

		if (isset($this->request->post['ingenico_button_color_code1'])) {
		    $this->data['ingenico_button_color_code1'] = $this->request->post['ingenico_button_color_code1'];
		} else {
		    $this->data['ingenico_button_color_code1'] = $this->config->get('ingenico_button_color_code1');
		}

		if (isset($this->request->post['ingenico_button_color_code2'])) {
		    $this->data['ingenico_button_color_code2'] = $this->request->post['ingenico_button_color_code2'];
		} else {
		    $this->data['ingenico_button_color_code2'] = $this->config->get('ingenico_button_color_code2');
		}		

		if (isset($this->request->post['ingenico_new_window_flow'])) {
		    $this->data['ingenico_new_window_flow'] = $this->request->post['ingenico_new_window_flow'];
		} else {
		    $this->data['ingenico_new_window_flow'] = $this->config->get('ingenico_new_window_flow');
		}		

		if (isset($this->request->post['ingenico_express_pay'])) {
		    $this->data['ingenico_express_pay'] = $this->request->post['ingenico_express_pay'];
		} else {
		    $this->data['ingenico_express_pay'] = $this->config->get('ingenico_express_pay');
		}		

		if (isset($this->request->post['ingenico_merchant_message'])) {
		    $this->data['ingenico_merchant_message'] = $this->request->post['ingenico_merchant_message'];
		} else {
		    $this->data['ingenico_merchant_message'] = $this->config->get('ingenico_merchant_message');
		}		

		if (isset($this->request->post['ingenico_disclaimer_message'])) {
		    $this->data['ingenico_disclaimer_message'] = $this->request->post['ingenico_disclaimer_message'];
		} else {
		    $this->data['ingenico_disclaimer_message'] = $this->config->get('ingenico_disclaimer_message');
		}		

		if (isset($this->request->post['ingenico_mer_transaction_details'])) {
		    $this->data['ingenico_mer_transaction_details'] = $this->request->post['ingenico_mer_transaction_details'];
		} else {
		    $this->data['ingenico_mer_transaction_details'] = $this->config->get('ingenico_mer_transaction_details');
		}		

		if (isset($this->request->post['ingenico_instrumentDeRegistration'])) {
		    $this->data['ingenico_instrumentDeRegistration'] = $this->request->post['ingenico_instrumentDeRegistration'];
		} else {
		    $this->data['ingenico_instrumentDeRegistration'] = $this->config->get('ingenico_instrumentDeRegistration');
		}		

		if (isset($this->request->post['ingenico_hide_saved_instruments'])) {
		    $this->data['ingenico_hide_saved_instruments'] = $this->request->post['ingenico_hide_saved_instruments'];
		} else {
		    $this->data['ingenico_hide_saved_instruments'] = $this->config->get('ingenico_hide_saved_instruments');
		}		

		if (isset($this->request->post['ingenico_save_instrument'])) {
		    $this->data['ingenico_save_instrument'] = $this->request->post['ingenico_save_instrument'];
		} else {
		    $this->data['ingenico_save_instrument'] = $this->config->get('ingenico_save_instrument');
		}		

		if (isset($this->request->post['ingenico_txnType'])) {
		    $this->data['ingenico_txnType'] = $this->request->post['ingenico_txnType'];
		} else {
		    $this->data['ingenico_txnType'] = $this->config->get('ingenico_txnType');
		}		

		if (isset($this->request->post['ingenico_response_on_popup'])) {
		    $this->data['ingenico_response_on_popup'] = $this->request->post['ingenico_response_on_popup'];
		} else {
		    $this->data['ingenico_response_on_popup'] = $this->config->get('ingenico_response_on_popup');
		}		

		if (isset($this->request->post['ingenico_checkoutElement'])) {
		    $this->data['ingenico_checkoutElement'] = $this->request->post['ingenico_checkoutElement'];
		} else {
		    $this->data['ingenico_checkoutElement'] = $this->config->get('ingenico_checkoutElement');
		}		

		if (isset($this->request->post['ingenico_separateCardMode'])) {
		    $this->data['ingenico_separateCardMode'] = $this->request->post['ingenico_separateCardMode'];
		} else {
		    $this->data['ingenico_separateCardMode'] = $this->config->get('ingenico_separateCardMode');
		}		

		if (isset($this->request->post['ingenico_paymentModeOrder'])) {
		    $this->data['ingenico_paymentModeOrder'] = $this->request->post['ingenico_paymentModeOrder'];
		} else {
		    $this->data['ingenico_paymentModeOrder'] = $this->config->get('ingenico_paymentModeOrder');
		}		

		if (isset($this->request->post['ingenico_payment_mode'])) {
		    $this->data['ingenico_payment_mode'] = $this->request->post['ingenico_payment_mode'];
		} else {
		    $this->data['ingenico_payment_mode'] = $this->config->get('ingenico_payment_mode');
		}

		$this->data['button_colours'] = array(
			'orange' => $this->language->get('text_orange'),
			'tan'    => $this->language->get('text_tan')
		);

		$this->data['button_backgrounds'] = array(
			'white' => $this->language->get('text_white'),
			'light' => $this->language->get('text_light'),
			'dark'  => $this->language->get('text_dark'),
		);

		$this->data['button_sizes'] = array(
			'medium'  => $this->language->get('text_medium'),
			'large'   => $this->language->get('text_large'),
			'x-large' => $this->language->get('text_x_large'),
		);

		$this->template = 'payment/ingenico.tpl';
		$this->children = array(
		        'common/header',
		        'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function install() {
		$this->load->model('payment/ingenico');
		$this->model_payment_ingenico->install();
	}

	public function uninstall() {
		$this->load->model('payment/ingenico');
		$this->model_payment_ingenico->uninstall();
	}

	public function orderAction(){
		$this->data['order_id'] = $this->request->get['order_id'];
		$this->load->model('sale/order');
		$this->load->model('payment/ingenico');
		
		$query = $this->db->query("SELECT
  		o.comment,
  		DATE(o.date_added) AS mydate
		FROM
  		" . DB_PREFIX . "order_history o
		WHERE o.order_id = '" . $this->data['order_id'] . "'
  		AND o.order_status_id = '2'
		LIMIT 0, 1;");

		if(isset($query->rows[0]['comment']) != ''){
			$this->data['status'] = 'success';	
            $this->data['token'] = $query->rows[0]['comment'];
            $this->data['date'] = $query->rows[0]['mydate'];
            $this->data['mcode'] = $this->config->get('ingenico_merchant_code');
            $order_info = $this->model_sale_order->getOrder($this->data['order_id']);
            $this->data['currency'] = $order_info['currency_code'];

            if($this->config->get('ingenico_webservice_locator') == 'Test'){
            	$this->data['amount'] = '1.00';  	
            }else{
            	$this->data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
            }

		}else{
        	$data['status'] = 'fail';
        }

		$this->template = 'payment/ingenico_order.tpl';
		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!trim($this->request->post['ingenico_merchant_code'])) {
			$this->error['warning']['merchant_code'] = $this->language->get('error_merchant_code');
		}

		if (!$this->request->post['ingenico_webservice_locator']) {
		    $this->error['warning']['access_webservice_locator'] = $this->language->get('error_webservice_locator');
		}

		if (!trim($this->request->post['ingenico_sort_order'])) {
		    $this->error['warning']['access_sort_order'] = $this->language->get('error_sort_order');
		}

		if (!trim($this->request->post['ingenico_merchant_scheme_code'])) {
		    $this->error['warning']['merchant_scheme_code'] = $this->language->get('error_merchant_scheme_code');
		}

		if (!$this->request->post['ingenico_salt']) {
			$this->error['warning']['salt'] = $this->language->get('error_salt');
		}

		return $this->error;
	}
}
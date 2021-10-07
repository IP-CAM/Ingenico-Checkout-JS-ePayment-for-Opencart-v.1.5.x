<?php
class ControllerPaymentWorldline extends Controller {
	private $error = array();
	protected $data = array();

	public function index() {
		$this->load->language('payment/Worldline');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
        $this->load->model('payment/Worldline');

        $merchant_details = $this->model_payment_Worldline->get();
        $this->data['error_warning'] = array();

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		    if(count($this->validate()) == 0){
    		    $this->model_setting_setting->editSetting('Worldline', $this->request->post);
    		    $this->session->data['success'] = $this->language->get('text_success');

    		    if(is_array($merchant_details) && !isset($merchant_details[0])){
    		        $response = $this->model_payment_Worldline->add($this->request->post);
    		    }else{
    		        $response = $this->model_payment_Worldline->edit($this->request->post);
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
		$this->data['text_for_Worldline'] = $this->language->get('text_for_Worldline');

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
		
		$this->data['action'] = $this->url->link('payment/Worldline', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['Worldline_merchant_code'])) {
		    $this->data['Worldline_merchant_code'] = $this->request->post['Worldline_merchant_code'];
		} else {
		    $this->data['Worldline_merchant_code'] = $this->config->get('Worldline_merchant_code');	
		}

		if (isset($this->request->post['Worldline_webservice_locator'])) {
		    $this->data['Worldline_webservice_locator'] = $this->request->post['Worldline_webservice_locator'];
		} else {
		    $this->data['Worldline_webservice_locator'] = $this->config->get('Worldline_webservice_locator');
		}

		if (isset($this->request->post['Worldline_order_status'])) {
		    $this->data['Worldline_order_status'] = $this->request->post['Worldline_order_status'];
		} else {
		    $this->data['Worldline_order_status'] = $this->config->get('Worldline_order_status');
		}

		if (isset($this->request->post['Worldline_status'])) {
		    $this->data['Worldline_status'] = $this->request->post['Worldline_status'];
		} else {
		    $this->data['Worldline_status'] = $this->config->get('Worldline_status');
		}

		if (isset($this->request->post['Worldline_sort_order'])) {
		    $this->data['Worldline_sort_order'] = $this->request->post['Worldline_sort_order'];
		} else {
		    $this->data['Worldline_sort_order'] = $this->config->get('Worldline_sort_order');
		}

		if (isset($this->request->post['Worldline_merchant_scheme_code'])) {
		    $this->data['Worldline_merchant_scheme_code'] = $this->request->post['Worldline_merchant_scheme_code'];
		} else {
		    $this->data['Worldline_merchant_scheme_code'] = $this->config->get('Worldline_merchant_scheme_code');
		}

		if (isset($this->request->post['Worldline_salt'])) {
		    $this->data['Worldline_salt'] = $this->request->post['Worldline_salt'];
		} else {
		    $this->data['Worldline_salt'] = $this->config->get('Worldline_salt');
		}		

		if (isset($this->request->post['Worldline_merchant_logo_url'])) {
		    $this->data['Worldline_merchant_logo_url'] = $this->request->post['Worldline_merchant_logo_url'];
		} else {
		    $this->data['Worldline_merchant_logo_url'] = $this->config->get('Worldline_merchant_logo_url');
		}		

		if (isset($this->request->post['Worldline_primary_color_code'])) {
		    $this->data['Worldline_primary_color_code'] = $this->request->post['Worldline_primary_color_code'];
		} else {
		    $this->data['Worldline_primary_color_code'] = $this->config->get('Worldline_primary_color_code');
		}

		if (isset($this->request->post['Worldline_secondary_color_code'])) {
		    $this->data['Worldline_secondary_color_code'] = $this->request->post['Worldline_secondary_color_code'];
		} else {
		    $this->data['Worldline_secondary_color_code'] = $this->config->get('Worldline_secondary_color_code');
		}

		if (isset($this->request->post['Worldline_button_color_code1'])) {
		    $this->data['Worldline_button_color_code1'] = $this->request->post['Worldline_button_color_code1'];
		} else {
		    $this->data['Worldline_button_color_code1'] = $this->config->get('Worldline_button_color_code1');
		}

		if (isset($this->request->post['Worldline_button_color_code2'])) {
		    $this->data['Worldline_button_color_code2'] = $this->request->post['Worldline_button_color_code2'];
		} else {
		    $this->data['Worldline_button_color_code2'] = $this->config->get('Worldline_button_color_code2');
		}		

		if (isset($this->request->post['Worldline_new_window_flow'])) {
		    $this->data['Worldline_new_window_flow'] = $this->request->post['Worldline_new_window_flow'];
		} else {
		    $this->data['Worldline_new_window_flow'] = $this->config->get('Worldline_new_window_flow');
		}		

		if (isset($this->request->post['Worldline_express_pay'])) {
		    $this->data['Worldline_express_pay'] = $this->request->post['Worldline_express_pay'];
		} else {
		    $this->data['Worldline_express_pay'] = $this->config->get('Worldline_express_pay');
		}		

		if (isset($this->request->post['Worldline_merchant_message'])) {
		    $this->data['Worldline_merchant_message'] = $this->request->post['Worldline_merchant_message'];
		} else {
		    $this->data['Worldline_merchant_message'] = $this->config->get('Worldline_merchant_message');
		}		

		if (isset($this->request->post['Worldline_disclaimer_message'])) {
		    $this->data['Worldline_disclaimer_message'] = $this->request->post['Worldline_disclaimer_message'];
		} else {
		    $this->data['Worldline_disclaimer_message'] = $this->config->get('Worldline_disclaimer_message');
		}		

		if (isset($this->request->post['Worldline_mer_transaction_details'])) {
		    $this->data['Worldline_mer_transaction_details'] = $this->request->post['Worldline_mer_transaction_details'];
		} else {
		    $this->data['Worldline_mer_transaction_details'] = $this->config->get('Worldline_mer_transaction_details');
		}		

		if (isset($this->request->post['Worldline_instrumentDeRegistration'])) {
		    $this->data['Worldline_instrumentDeRegistration'] = $this->request->post['Worldline_instrumentDeRegistration'];
		} else {
		    $this->data['Worldline_instrumentDeRegistration'] = $this->config->get('Worldline_instrumentDeRegistration');
		}		

		if (isset($this->request->post['Worldline_hide_saved_instruments'])) {
		    $this->data['Worldline_hide_saved_instruments'] = $this->request->post['Worldline_hide_saved_instruments'];
		} else {
		    $this->data['Worldline_hide_saved_instruments'] = $this->config->get('Worldline_hide_saved_instruments');
		}		

		if (isset($this->request->post['Worldline_save_instrument'])) {
		    $this->data['Worldline_save_instrument'] = $this->request->post['Worldline_save_instrument'];
		} else {
		    $this->data['Worldline_save_instrument'] = $this->config->get('Worldline_save_instrument');
		}		

		if (isset($this->request->post['Worldline_txnType'])) {
		    $this->data['Worldline_txnType'] = $this->request->post['Worldline_txnType'];
		} else {
		    $this->data['Worldline_txnType'] = $this->config->get('Worldline_txnType');
		}		

		if (isset($this->request->post['Worldline_response_on_popup'])) {
		    $this->data['Worldline_response_on_popup'] = $this->request->post['Worldline_response_on_popup'];
		} else {
		    $this->data['Worldline_response_on_popup'] = $this->config->get('Worldline_response_on_popup');
		}		

		if (isset($this->request->post['Worldline_checkoutElement'])) {
		    $this->data['Worldline_checkoutElement'] = $this->request->post['Worldline_checkoutElement'];
		} else {
		    $this->data['Worldline_checkoutElement'] = $this->config->get('Worldline_checkoutElement');
		}		

		if (isset($this->request->post['Worldline_separateCardMode'])) {
		    $this->data['Worldline_separateCardMode'] = $this->request->post['Worldline_separateCardMode'];
		} else {
		    $this->data['Worldline_separateCardMode'] = $this->config->get('Worldline_separateCardMode');
		}		

		if (isset($this->request->post['Worldline_paymentModeOrder'])) {
		    $this->data['Worldline_paymentModeOrder'] = $this->request->post['Worldline_paymentModeOrder'];
		} else {
		    $this->data['Worldline_paymentModeOrder'] = $this->config->get('Worldline_paymentModeOrder');
		}		

		if (isset($this->request->post['Worldline_payment_mode'])) {
		    $this->data['Worldline_payment_mode'] = $this->request->post['Worldline_payment_mode'];
		} else {
		    $this->data['Worldline_payment_mode'] = $this->config->get('Worldline_payment_mode');
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

		$this->template = 'payment/Worldline.tpl';
		$this->children = array(
		        'common/header',
		        'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function install() {
		$this->load->model('payment/Worldline');
		$this->model_payment_Worldline->install();
	}

	public function uninstall() {
		$this->load->model('payment/Worldline');
		$this->model_payment_Worldline->uninstall();
	}

	public function orderAction(){
		$this->data['order_id'] = $this->request->get['order_id'];
		$this->load->model('sale/order');
		$this->load->model('payment/Worldline');
		
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
            $this->data['mcode'] = $this->config->get('Worldline_merchant_code');
            $order_info = $this->model_sale_order->getOrder($this->data['order_id']);
            $this->data['currency'] = $order_info['currency_code'];

            if($this->config->get('Worldline_webservice_locator') == 'Test'){
            	$this->data['amount'] = '1.00';  	
            }else{
            	$this->data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
            }

		}else{
        	$data['status'] = 'fail';
        }

		$this->template = 'payment/Worldline_order.tpl';
		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!trim($this->request->post['Worldline_merchant_code'])) {
			$this->error['warning']['merchant_code'] = $this->language->get('error_merchant_code');
		}

		if (!$this->request->post['Worldline_webservice_locator']) {
		    $this->error['warning']['access_webservice_locator'] = $this->language->get('error_webservice_locator');
		}

		if (!trim($this->request->post['Worldline_sort_order'])) {
		    $this->error['warning']['access_sort_order'] = $this->language->get('error_sort_order');
		}

		if (!trim($this->request->post['Worldline_merchant_scheme_code'])) {
		    $this->error['warning']['merchant_scheme_code'] = $this->language->get('error_merchant_scheme_code');
		}

		if (!$this->request->post['Worldline_salt']) {
			$this->error['warning']['salt'] = $this->language->get('error_salt');
		}

		return $this->error;
	}
}
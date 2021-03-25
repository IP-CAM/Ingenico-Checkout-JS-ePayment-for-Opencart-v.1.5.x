<?php

class ControllerCustomVerification extends Controller{ 
    protected $data = array();
    public function index(){
        
        $this->load->language('custom/verification');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('order_title'),
            'href'      => $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('custom/verification', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->load->model('payment/ingenico');

        $merchant_details = $this->model_payment_ingenico->get();
        
        $this->data['mrc_code'] = (isset($merchant_details[0]['merchant_code']))? $merchant_details[0]['merchant_code']: null;
        $this->data['currency'] = $this->currency->getCode();
        $merchantTxnRefNumber = null; 
        $date = null;

        $this->template = 'custom/verification.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );      

        $this->response->setOutput($this->render());
    }
}
?>
<?php

class ControllerCustomReconcilation extends Controller{ 
    protected $data = array();
    public function index(){

        $this->load->language('custom/reconcilation');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('sale/order');

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
            'href'      => $this->url->link('custom/reconcilation', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('custom/reconcilation', 'token=' . $this->session->data['token'], 'SSL');  


        $this->load->model('payment/ingenico');
        $merchant_details = $this->model_payment_ingenico->get();
        $mrc_code = $merchant_details[0]['merchant_code'];

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->data['todate'] = $this->request->post['todate'];
            $this->data['fromdate'] = $this->request->post['fromdate'];
            
            $query = $this->db->query("SELECT o.order_id, h.comment, DATE(o.date_added) as mydate, o.currency_code 
                        FROM `" . DB_PREFIX . "order` AS o JOIN `" . DB_PREFIX . "order_history` AS h
                        ON o.order_id = h.order_id
                        WHERE h.order_status_id = 1 AND h.comment !='' AND h.date_added BETWEEN ." . $this->data['fromdate'] . " AND '".$this->data['todate']."' AND o.payment_code = 'ingenico' AND o.order_status_id = 1");
            
            $myorderdata = $query->rows;
            // print_r($myorderdata); exit;
            $successFullOrdersIds = [];
            if($myorderdata != ''){

                foreach ($myorderdata as $order_array){
                    $order_id = $order_array['order_id'];
                    $currency = $order_array['currency_code'];
                    $date_input = $order_array['mydate'];
                    $merchantTxnRefNumber = $order_array['comment'];

                    $request_array = array("merchant"=>array("identifier"=>$mrc_code),
                                            "transaction"=>array(
                                                "deviceIdentifier"=>"S",
                                                "currency"=>$currency,
                                                "identifier"=>$merchantTxnRefNumber,
                                                "dateTime"=>$date_input,
                                                "requestType"=>"O"          
                                            ));
                    $refund_data = json_encode($request_array);
                    $url = "https://www.paynimo.com/api/paynimoV2.req";
                    $options = array(
                    'http' => array(
                        'method'  => 'POST',
                        'content' => json_encode($request_array),
                        'header' =>  "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
                        )
                    );

                    $context     = stream_context_create($options);
                    $response_array = json_decode(file_get_contents($url, false, $context));
                    $status_code = $response_array->paymentMethod->paymentTransaction->statusCode; 
                    $status_message = $response_array->paymentMethod->paymentTransaction->statusMessage;
                    $txn_id = $response_array->paymentMethod->paymentTransaction->identifier;

                    if($status_code=='0300'){
                        $success_ids = $order_array['order_id'];
                        $this->model_sale_order->addOrderHistory($success_ids, array('order_status_id'=>2, 'comment'=>$txn_id, 'notify'=>0));
                        array_push($successFullOrdersIds, $success_ids);


                    }else if($status_code=="0397" || $status_code=="0399" || $status_code=="0396" || $status_code=="0392"){
                        $success_ids = $order_array['order_id'];
                        $this->model_sale_order->addOrderHistory($success_ids, array('order_status_id'=>10, 'comment'=>$txn_id, 'notify'=>0));
                        array_push($successFullOrdersIds, $success_ids);
                    }else{
                        null;
                    }
                    

                }

                if($successFullOrdersIds){
                    $this->data['message'] = "Updated Order Status for Order ID:  " . implode(", ", $successFullOrdersIds);
                }else{
                    $this->data['message'] =  "Updated Order Status for Order ID: None";
                }


            }else{
                $this->data['message'] =  "Updated Order Status for Order ID: None";
            }

        } 

        $this->template = 'custom/reconcilation.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );      

        $this->response->setOutput($this->render());
    }
}

?>
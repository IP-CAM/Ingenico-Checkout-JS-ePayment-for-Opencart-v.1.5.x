<?php

class ControllerPaymentIngenico extends Controller {
	public function index() {
	    $this->load->model('payment/ingenico');
	    $this->load->model('checkout/order');

		$merchant_details = $this->model_payment_ingenico->get();

		$merchant_txn_id = rand(1,1000000);
		$cur_date = date("d-m-Y");
		$returnUrl = $this->url->link('payment/ingenico/getResponse');
		$s2surl = $this->url->link('payment/ingenico/s2sverification');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

	    if($merchant_details[0]['webservice_locator'] == 'Test'){
	    	$total_amount = '1.00';
		} else {
			$total_amount = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		}

		//Set customer details
 		$this->load->model('account/customer');
		if(isset($this->session->data['customer_id']) && !empty($this->session->data['customer_id'])){
		    $customerDetails = $this->model_account_customer->getCustomer($this->session->data['customer_id']);
		    $cust_id = 'cons'.$customerDetails['customer_id'];

		}else{
		    $customerDetails = $this->session->data['guest'];
		    $cust_id = 'cons'. rand(1,1000000);

		}
		$CustomerName =  $customerDetails['firstname'].' '.$customerDetails['lastname'];

		$customerMobNumber = $customerDetails['telephone'];
		if(strpos($customerMobNumber, '+') !== false) {
			$customerMobNumber = str_replace("+", "", $customerMobNumber);
		}

		$this->data['orderid'] = $this->session->data['order_id'];
		

		$this->data['button_confirm'] = $this->language->get('button_confirm');
		if($this->data['button_confirm']){
			$this->model_checkout_order->confirm($this->data['orderid'], 1, $merchant_txn_id, true);	
		}

		$this->data['continue'] = $this->url->link('checkout/success');
		
		$this->data['mrc_code'] = $merchant_details[0]['merchant_code'];
		$this->data['merchant_Txn_Ref_Number'] = $merchant_txn_id;


		$this->data['total_amount'] =  $total_amount;
		$this->data['payment_currency'] = $order_info['currency_code'];

        $this->data['email'] = $customerDetails['email'];
        $this->data['mob_Number'] = $customerMobNumber; 
        $this->data['CustomerName'] = $CustomerName;

		$this->data['SALT'] =  $merchant_details[0]['salt'];
		$this->data['scheme'] =  $merchant_details[0]['merchant_scheme_code'];
		$this->data['CustomerId'] = $cust_id;

		if($merchant_details[0]['merchant_logo_url']){
			$this->data['merchantLogoUrl'] = $merchant_details[0]['merchant_logo_url'];	
		}else{
			$this->data['merchantLogoUrl'] = 'https://www.paynimo.com/CompanyDocs/company-logo-md.png';
		}		

		if($merchant_details[0]['primary_color_code']){
			$this->data['primary_color_code'] = $merchant_details[0]['primary_color_code'];	
		}else{
			$this->data['primary_color_code'] = '#3977b7';
		}
		if($merchant_details[0]['secondary_color_code']){
			$this->data['secondary_color_code'] = $merchant_details[0]['secondary_color_code'];	
		}else{
			$this->data['secondary_color_code'] = '#FFFFFF';
		}
		if($merchant_details[0]['button_color_code1']){
			$this->data['button_color_code1'] = $merchant_details[0]['button_color_code1'];	
		}else{
			$this->data['button_color_code1'] = '#1969bb';
		}
		if($merchant_details[0]['button_color_code2']){
			$this->data['button_color_code2'] = $merchant_details[0]['button_color_code2'];	
		}else{
			$this->data['button_color_code2'] = '#FFFFFF';
		} 

		$this->data['merchant_message'] = $merchant_details[0]['merchant_message']; 	
		$this->data['disclaimer_message'] = $merchant_details[0]['disclaimer_message']; 	
		$this->data['mer_transaction_details'] = (int)$merchant_details[0]['mer_transaction_details']; 	
		$this->data['express_pay'] = (int)$merchant_details[0]['express_pay'];
		if($this->data['express_pay'] == 1){
			$this->data['instrumentDeRegistration'] = (int)$merchant_details[0]['instrumentDeRegistration'];
			$this->data['hide_saved_instruments'] = (int)$merchant_details[0]['hide_saved_instruments']; 

		} else{
			$this->data['instrumentDeRegistration'] = 0;				
			$this->data['hide_saved_instruments'] = 0;
		} 	

		$this->data['save_instrument'] = (int)$merchant_details[0]['save_instrument']; 	
		$this->data['txnType'] = $merchant_details[0]['txnType'];

		$this->data['new_window_flow'] = (int)$merchant_details[0]['new_window_flow']; 	
		$this->data['response_on_popup'] = (int)$merchant_details[0]['response_on_popup'];

		if($merchant_details[0]['response_on_popup'] =="1" && $merchant_details[0]['new_window_flow'] == "1"){
			$this->data['returnUrl'] = '';
		}else if($merchant_details[0]['response_on_popup'] == "0" && $merchant_details[0]['new_window_flow'] == "1"){
			$this->data['returnUrl'] = $returnUrl;
		}else{
			$this->data['returnUrl'] = $returnUrl;				
		}

		$this->data['returnUrl_2'] = $returnUrl; 	

		$this->data['checkoutElement'] = $merchant_details[0]['checkoutElement']; 	
		$this->data['separateCardMode'] = (int)$merchant_details[0]['separateCardMode']; 	
		$this->data['payment_mode'] = $merchant_details[0]['payment_mode']; 	
		
		$payment_order_mode_raw = $merchant_details[0]['paymentModeOrder'];
		$payment_order_mode = explode("," , $payment_order_mode_raw);

		$payment_order_mode[0] = (isset($payment_order_mode[0]))? $payment_order_mode[0]: null;
		$payment_order_mode[1] = (isset($payment_order_mode[1]))? $payment_order_mode[1]: null;
		$payment_order_mode[2] = (isset($payment_order_mode[2]))? $payment_order_mode[2]: null;
		$payment_order_mode[3] = (isset($payment_order_mode[3]))? $payment_order_mode[3]: null;
		$payment_order_mode[4] = (isset($payment_order_mode[4]))? $payment_order_mode[4]: null;
		$payment_order_mode[5] = (isset($payment_order_mode[5]))? $payment_order_mode[5]: null;
		$payment_order_mode[6] = (isset($payment_order_mode[6]))? $payment_order_mode[6]: null;
		$payment_order_mode[7] = (isset($payment_order_mode[7]))? $payment_order_mode[7]: null;
		$payment_order_mode[8] = (isset($payment_order_mode[8]))? $payment_order_mode[8]: null;
		$payment_order_mode[9] = (isset($payment_order_mode[9]))? $payment_order_mode[9]: null; 	

		if(!$payment_order_mode_raw){
			$this->data['paymentModeOrder'] = ["wallets", "cards", "netBanking", "imps", "cashCards", "UPI", "MVISA", "debitPin", "emiBanks", "NEFTRTGS"];			
		}else{
			$this->data['paymentModeOrder'] = [ $payment_order_mode[0],
												$payment_order_mode[1],
												$payment_order_mode[2],
												$payment_order_mode[3],
												$payment_order_mode[4],
												$payment_order_mode[5],
												$payment_order_mode[6],
												$payment_order_mode[7],
												$payment_order_mode[8],
												$payment_order_mode[9]

			];
		}

		$datastring = $this->data['mrc_code']  . "|" . $this->data['merchant_Txn_Ref_Number'] . "|" . $this->data['total_amount'] . "|" . "|" . $this->data['CustomerId']. "|" . $this->data['mob_Number'] . "|" . $this->data['email'] . "||||||||||" . $this->data['SALT'];

		$file_name = 'Ingenico_logs'.date("Y-m-d").'.log';
		if (!file_exists($file_name)){
			$log = new Log($file_name);
			$log->write("Ingenico Request: ". $datastring);
		}

		$hashed = hash('sha512', $datastring);
		$this->data['token'] = $hashed;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ingenico.tpl')) {
		    $this->template = $this->config->get('config_template') . '/template/payment/ingenico.tpl';
		} else {
		    $this->template = 'default/template/payment/ingenico.tpl';
		}

		$this->render();
	}

	public function getResponse() {
	    if($_POST){
	        $response = $_POST;

	    	$this->load->model('checkout/order');
	        $this->load->model('payment/ingenico');
	        $merchant_details = $this->model_payment_ingenico->get();

	        $identifier = $merchant_details[0]['merchant_code'];
	        $currency = $this->currency->getCode();
	        $str = $response['msg'];
	        //addlogs
	       	$file_name = 'Ingenico_logs'.date("Y-m-d").'.log';
	       	if (!file_exists($file_name)){
	       		$log = new Log($file_name);
	       		$log->write("Ingenico Response: ". $str);
	       	}
	        
	        $response1 = explode('|', $str);
			$status = $response1[0];
			if($status !=''){
				$merchantTxnRefNumber = $response1[3];
				$response_message = $response1[1];
				$response_message2 = $response1[2];
				if(!$response_message2){
					$response_message2 = "Transaction Failed";
				}
				
				$transaction_id = $response1[5];

				$status2 = $response1[7];
				$response_cart = explode('orderid:', $status2);
				$oid_1=$response_cart[1];
				$oid_2 = explode('}', $oid_1);
				$order_id =$oid_2[0];
				if(!$order_id){
					$order_1 = $this->session->data['order_id'];
				} 

				$hashstring = array_pop($response1);
				$array_without_hash = $response1;
				$string_without_hash = implode( "|", $array_without_hash);
				$salt_token = $string_without_hash. '|'.$merchant_details[0]['salt'];
				$hashed_string_token = hash('sha512', $salt_token);


			if($order_id != ''){            		
            	if($status == '300'){
            		if($hashed_string_token == $hashstring){
            			if($this->S_call($identifier, $currency, $transaction_id)=='300'){
            				$this->model_checkout_order->update($order_id, 2, $transaction_id, false);
			            	echo "<script>window.location = '".$this->url->link('checkout/success')."'</script>";
            			}

            		}else{
            			$this->session->data['error'] = 'Error Message: Hash Validation Failed';
            			$this->load->model('checkout/order');
            			$this->model_checkout_order->confirm($order_id, 1, $merchantTxnRefNumber, true);
            			$this->model_checkout_order->update($order_id, 10, $transaction_id, false);
						echo "<script>window.location = '".$this->url->link('checkout/cart')."'</script>";	
            		}
	            }
	            else{
	            	///main============
	            	$this->session->data['error'] = 'Transaction Status: '.$this->getErrorStatusMessage($status).'<br>Transaction Error Message from Payment Gateway: '.$response_message2;
            		$this->model_checkout_order->update($order_id, 10, $transaction_id, false);
					echo "<script>window.location = '".$this->url->link('checkout/cart')."'</script>";
	            }	
	        }	

		}else{
			$this->session->data['error'] = 'Error Message: Payment Failed Empty Response';
            $this->model_checkout_order->update($order_id, 10, $transaction_id, false);
			echo "<script>window.location = '".$this->url->link('checkout/cart')."'</script>";
		}
			
	    }
	}

	function S_call($identifier, $currency, $transaction_id) {
		$request_array = array("merchant"=>array("identifier"=>$identifier),
								"transaction"=>array(
									"deviceIdentifier"=>"S",
									"currency"=>$currency,
									"dateTime"=>date("Y-m-d"),
									"token"=>$transaction_id,
									"requestType"=>"S"			
						));
		$Scall_data = json_encode($request_array);
		$Scall_url = "https://www.paynimo.com/api/paynimoV2.req";
		$options = array(
	   		'http' => array(
	   			'method'  => 'POST',
	   			'content' => json_encode($request_array),
	   			'header' =>  "Content-Type: application/json\r\n" .
	   			"Accept: application/json\r\n"
		   		)
		   	);
		$context  = stream_context_create($options);
		$response_array = json_decode(file_get_contents($Scall_url, false, $context));
		$status_code = $response_array->paymentMethod->paymentTransaction->statusCode; 
		if($status_code){
			return $status_code; 
		}else{
			return 'Failed';
		}
	}

	function getErrorStatusMessage($code)
	{
		$messages = [
			"0300" => "Successful Transaction",
			"0392" => "Transaction cancelled by user either in Bank Page or in PG Card /PG Bank selection",
			"0396" => "Transaction response not received from Bank, Status Check on same Day",
			"0397" => "Transaction Response not received from Bank. Status Check on next Day",
			"0399" => "Failed response received from bank",
			"0400" => "Refund Initiated Successfully",
			"0401" => "Refund in Progress (Currently not in used)",
			"0402" => "Instant Refund Initiated Successfully(Currently not in used)",
			"0499" => "Refund initiation failed",
			"9999" => "Transaction not found :Transaction not found in PG"
		];
		if (in_array($code, array_keys($messages))) {
			return $messages[$code];
		}
		return null;
	}

	public function s2sverification(){
		$response = $_GET;
		if(!$response){
			echo 'No msg parameter in params'; 
			exit;
		}

		if(!$response['msg']){
			echo 'Empty Response Received'; 
			exit;
		}
		
		$this->load->model('payment/ingenico');
	    $merchant_details = $this->model_payment_ingenico->get();
	    $identifier = $merchant_details[0]['merchant_code'];
	    $currency = $this->currency->getCode();
	    $str = $response['msg'];

	    $response1 = explode('|', $str);
		$status = $response1[0];

		$merchantTxnRefNumber = $response1[3];
		$response_message = $response1[1];
		$response_message2 = $response1[2];
		if(!$response_message2){
			$response_message2 = "Transaction Failed";
		}

		$transaction_id = $response1[5];

		$status2 = $response1[7];
		$response_cart = explode('orderid:', $status2);
		$oid_1=$response_cart[1];
		$oid_2 = explode('}', $oid_1);
		$order_id =$oid_2[0];
		if(!$order_id){
			$order_1 = $this->session->data['order_id'];
		}

		$hashstring = array_pop($response1);
		$array_without_hash = $response1;
		$string_without_hash = implode( "|", $array_without_hash);
		$salt_token = $string_without_hash. '|'.$merchant_details[0]['salt'];
		$hashed_string_token = hash('sha512', $salt_token);

		$file_name = 'Ingenico_logs'.date("Y-m-d").'.log';
		if (!file_exists($file_name)){
			$log = new Log($file_name);
			$log->write("Response_S2S: ". $str);
		}

		if($order_id != ''){            		
           	if($status == '300'){
           		if($hashed_string_token == $hashstring){
           			$this->load->model('checkout/order');
            		$this->model_checkout_order->confirm($order_id, 1, $merchantTxnRefNumber, true);
            		$this->model_checkout_order->update($order_id, 2, $transaction_id, false);
            		$return_string = $merchantTxnRefNumber. "|" . $transaction_id. "|1";
					echo $return_string;
           		}else{
           			echo 'Hash Validation Failed';
           		}

           	}else{
           		$this->load->model('checkout/order');
	            $this->model_checkout_order->confirm($order_id, 1, $merchantTxnRefNumber, true);
            	$this->model_checkout_order->update($order_id, 10, $transaction_id, false);
            	$return_string = $merchantTxnRefNumber. "|" . $transaction_id. "|0";
				echo $return_string;
            }

        }
        	
	}

}
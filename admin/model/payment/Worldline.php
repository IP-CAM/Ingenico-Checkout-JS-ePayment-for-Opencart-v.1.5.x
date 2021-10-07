<?php

class ModelPaymentWorldline extends Model {

	public function install() {
		$this->db->query("
			CREATE TABLE `" . DB_PREFIX . "Worldline` (
			  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
              `merchant_code` varchar(255) NOT NULL,
              `webservice_locator` varchar(255) NOT NULL,
              `status` enum('1','0') NOT NULL,
              `sort_order` int(10) NOT NULL,
		      `merchant_scheme_code` varchar(255) NOT NULL,
		      `salt` varchar(255) NOT NULL,
		      `merchant_logo_url` varchar(255) NOT NULL,
		      `primary_color_code` varchar(255) NOT NULL,
		      `secondary_color_code` varchar(255) NOT NULL,
		      `button_color_code1` varchar(255) NOT NULL,
		      `button_color_code2` varchar(255) NOT NULL,
		      `new_window_flow` varchar(255) NOT NULL,
		      `express_pay` varchar(255) NOT NULL,
		      `merchant_message` varchar(255) NOT NULL,
		      `disclaimer_message` varchar(255) NOT NULL,
		      `mer_transaction_details` varchar(255) NOT NULL,
		      `instrumentDeRegistration` varchar(255) NOT NULL,
		      `hide_saved_instruments` varchar(255) NOT NULL,
		      `save_instrument` varchar(255) NOT NULL,
		      `txnType` varchar(255) NOT NULL,
		      `response_on_popup` varchar(255) NOT NULL,
		      `checkoutElement` varchar(255) NOT NULL,
		      `separateCardMode` varchar(255) NOT NULL,
		      `paymentModeOrder` varchar(255) NOT NULL,
		      `payment_mode` varchar(255) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `unique_merchant_code` (`merchant_code`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "Worldline`;");
	}

	public function add($merchant_details) {
	    if(count($merchant_details) > 0){
		    $this->db->query("INSERT INTO `" . DB_PREFIX . "Worldline`
		                     (`merchant_code`,`webservice_locator`, `status`, `sort_order`, `merchant_scheme_code`,
		                     `salt`, `merchant_logo_url`, `primary_color_code`, `secondary_color_code`, `button_color_code1`,`button_color_code2`,`new_window_flow`, `express_pay`, `merchant_message`,`disclaimer_message`,`mer_transaction_details`,`instrumentDeRegistration`,`hide_saved_instruments`, `save_instrument`, `txnType`, `response_on_popup`, `checkoutElement`, `separateCardMode`,`paymentModeOrder`,`payment_mode`)
		                     VALUES ('".trim($merchant_details['Worldline_merchant_code'])."','".$merchant_details['Worldline_webservice_locator']."',
		                             '".$merchant_details['Worldline_status']."',
		                             '".trim($merchant_details['Worldline_sort_order'])."','".trim($merchant_details['Worldline_merchant_scheme_code'])."',
		                             '".trim($merchant_details['Worldline_salt'])."','".trim($merchant_details['Worldline_merchant_logo_url'])."','".trim($merchant_details['Worldline_primary_color_code'])."','".trim($merchant_details['Worldline_secondary_color_code'])."','".trim($merchant_details['Worldline_button_color_code1'])."','".trim($merchant_details['Worldline_button_color_code2'])."',
		                             '".$merchant_details['Worldline_new_window_flow']."',
		                             '".$merchant_details['Worldline_express_pay']."',
		                             '".$merchant_details['Worldline_merchant_message']."',
		                             '".$merchant_details['Worldline_disclaimer_message']."',
		                             '".$merchant_details['Worldline_mer_transaction_details']."',
		                             '".$merchant_details['Worldline_instrumentDeRegistration']."',
		                             '".$merchant_details['Worldline_hide_saved_instruments']."',
		                             '".$merchant_details['Worldline_save_instrument']."',
		                             '".$merchant_details['Worldline_txnType']."',
		                             '".$merchant_details['Worldline_response_on_popup']."',
		                             '".$merchant_details['Worldline_checkoutElement']."',
		                             '".$merchant_details['Worldline_separateCardMode']."',
		                             '".trim($merchant_details['Worldline_paymentModeOrder'])."',
		                             '".$merchant_details['Worldline_payment_mode']."')");
		    return true;
	    }
	    return false;
	}

	public function get() {
		    return $this->db->query("SELECT * FROM `" . DB_PREFIX . "Worldline`")->rows;
	}

	public function edit($merchant_details) {
	    if(count($merchant_details) > 0){
	        $this->db->query("UPDATE `" . DB_PREFIX . "Worldline`
	                         SET `merchant_code` = '".trim($merchant_details['Worldline_merchant_code'])."',
	                             `webservice_locator` = '".$merchant_details['Worldline_webservice_locator']."',
                                 `status` = '".$merchant_details['Worldline_status']."',
                                 `sort_order` = '".trim($merchant_details['Worldline_sort_order'])."',
	                             `merchant_scheme_code` = '".$merchant_details['Worldline_merchant_scheme_code']."',
	                             `salt` = '".$merchant_details['Worldline_salt']."',
	                             `merchant_logo_url` = '".$merchant_details['Worldline_merchant_logo_url']."',
	                             `primary_color_code` = '".$merchant_details['Worldline_primary_color_code']."',
	                             `secondary_color_code` = '".$merchant_details['Worldline_secondary_color_code']."',
	                             `button_color_code1` = '".$merchant_details['Worldline_button_color_code1']."',
	                             `button_color_code2` = '".$merchant_details['Worldline_button_color_code2']."',
	                             `new_window_flow` = '".$merchant_details['Worldline_new_window_flow']."',
	                             `express_pay` = '".$merchant_details['Worldline_express_pay']."',
	                             `merchant_message` = '".$merchant_details['Worldline_merchant_message']."',
	                             `disclaimer_message` = '".$merchant_details['Worldline_disclaimer_message']."',
	                             `mer_transaction_details` = '".$merchant_details['Worldline_mer_transaction_details']."',
	                             `instrumentDeRegistration` = '".$merchant_details['Worldline_instrumentDeRegistration']."',
	                             `hide_saved_instruments` = '".$merchant_details['Worldline_hide_saved_instruments']."',
	                             `save_instrument` = '".$merchant_details['Worldline_save_instrument']."',
	                             `txnType` = '".$merchant_details['Worldline_txnType']."',
	                             `response_on_popup` = '".$merchant_details['Worldline_response_on_popup']."',
	                             `checkoutElement` = '".$merchant_details['Worldline_checkoutElement']."',
	                             `separateCardMode` = '".$merchant_details['Worldline_separateCardMode']."',
	                             `paymentModeOrder` = '".trim($merchant_details['Worldline_paymentModeOrder'])."',
	                             `payment_mode` = '".$merchant_details['Worldline_payment_mode']."'");
	        return true;
	    }
	    return false;
	}

}
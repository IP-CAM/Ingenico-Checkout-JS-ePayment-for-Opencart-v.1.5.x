<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />

  </div>
</div>
<div id="ingenico_payment_form">
</div>
<form action="<?php echo $returnUrl_2; ?>" id="response-form" method="POST">
    <input type="hidden" name="msg" value="" id="response-string">
</form>
<script src="https://www.paynimo.com/paynimocheckout/client/lib/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://www.paynimo.com/Paynimocheckout/server/lib/checkout.js"></script>
<script type="text/javascript"><!--
$('#button-confirm').on('click', function() {
	var data = <?php echo json_encode($this->data); ?>;
	var configJson = {
                    'tarCall': false,
                    'features': {
                        'showPGResponseMsg': true,
                        'enableAbortResponse': false,
                        'enableExpressPay': data['express_pay'],
                        'enableNewWindowFlow': data['new_window_flow'],
                        'enableMerTxnDetails': data['mer_transaction_details'],
                        'separateCardMode': data['separateCardMode'],
                        'enableInstrumentDeRegistration': data['instrumentDeRegistration'],
                        'hideSavedInstruments': data['hide_saved_instruments']

                    },
                    'consumerData': {
                        'deviceId': 'WEBSH2',   //possible values 'WEBSH1', 'WEBSH2' and 'WEBMD5'
                        'token': data['token'],
                        'returnUrl': data['returnUrl'],
                        'responseHandler': handleResponse,
                        'paymentMode': data['payment_mode'],
                        'checkoutElement': data['checkoutElement'],
                        'paymentModeOrder':data['paymentModeOrder'],
                        'merchantLogoUrl':data['merchantLogoUrl'],  //provided merchant logo will be displayed
                        'merchantId': data['mrc_code'], 
                        'merchantMsg': data['merchant_message'],
                        'disclaimerMsg': data['disclaimer_message'],
                        'currency': data['payment_currency'],
                        'consumerId':data['CustomerId'],
                        'consumerMobileNo': data['mob_Number'],
                        'consumerEmailId':data['email'],
                        'txnId': data['merchant_Txn_Ref_Number'],
                        'txnType': data['txnType'],
                        'saveInstrument': data['save_instrument'],   //Unique merchant transaction ID
                        'items': [{
                            'itemId': data['scheme'],
                            'amount': data['total_amount'],
                            'comAmt': '0'
                        }],
                        'cartDescription': '}{custname:'+data['CustomerName']+'}{orderid:'+data['orderid'],
                        'merRefDetails': [
                    		{"name": "Txn. Ref. ID", "value": data['merchant_Txn_Ref_Number']}
                		],
                        'customStyle': {
                            'PRIMARY_COLOR_CODE': data['primary_color_code'],   //merchant primary color code
                            'SECONDARY_COLOR_CODE': data['secondary_color_code'],   //provide merchant's suitable color code
                            'BUTTON_COLOR_CODE_1': data['button_color_code1'],   //merchant's button background color code
                            'BUTTON_COLOR_CODE_2': data['button_color_code2']   //provide merchant's suitable color code for button text
                        }
                    }
                };

                $.pnCheckout(configJson);
                if(configJson.features.enableNewWindowFlow){
                    pnCheckoutShared.openNewWindow();
                }

                function handleResponse(res) {
                    if (typeof res != 'undefined' && typeof res.paymentMethod != 'undefined' && typeof res.paymentMethod.paymentTransaction != 'undefined' && typeof res.paymentMethod.paymentTransaction.statusCode != 'undefined' && res.paymentMethod.paymentTransaction.statusCode == '0300') {
                        let stringResponse = res.stringResponse;
                        $("#response-string").val(stringResponse);
                        $("#response-form").submit();
                    } else {

                    }
                };

});
//--></script>

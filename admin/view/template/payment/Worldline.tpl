<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div> 
  
  <?php if (is_array($error_warning) && count($error_warning) > 0) { 
    	foreach($error_warning as $error) { ?>
		    <div class="warning"><?php echo $error; ?></div>
  <?php }} ?>
    
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">

          <tr>
            <td><p>Description: </p></td>
            <td><p>Worldline ePayments is India's leading digital payment solutions company. Being a company with more than 45 years of global payment experience, we are present in India for over 20 years and are powering over 550,000 businesses with our tailored payment solution.</p></td>
          </tr>  

          <tr>
            <td><span class="required">*</span><?php echo $status; ?></td>
            <td>
                <select name="Worldline_status" id="input-status" class="form-control">
                  <?php if ($Worldline_status == "1") { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
            </td>
          </tr>

          <tr>
            <td><span class="required">*</span><?php echo $merchant_code; ?></td>
            <td><input type="text" name="Worldline_merchant_code" value="<?php echo $Worldline_merchant_code; ?>" placeholder="<?php echo $merchant_code; ?>" id="input-merchant-code" class="form-control" /></td>
          </tr>    
                    
          <tr>
            <td><span class="required">*</span><?php echo $salt; ?></td>
            <td><input type="text" name="Worldline_salt" value="<?php echo $Worldline_salt; ?>" placeholder="<?php echo $salt; ?>" id="input-salt" class="form-control" /></td>
          </tr>
      
          
          <tr>
            <td><span class="required">*</span><?php echo $webservice_locator; ?></td>
            <td>
                <select name="Worldline_webservice_locator" id="input-mode" class="form-control">
	                <?php if ($Worldline_webservice_locator == 'Test') { ?>
	                <option value="Test" selected="selected"><?php echo 'TEST'; ?></option>
	                <?php } else { ?>
	                <option value="Test"><?php echo 'TEST'; ?></option>
	                <?php } ?>
	                
	                <?php if ($Worldline_webservice_locator == 'Live') { ?>
	                <option value="Live" selected="selected"><?php echo 'LIVE'; ?></option>
	                <?php } else { ?>
	                <option value="Live"><?php echo 'LIVE'; ?></option>
	                <?php } ?>
              	</select>
                <p>(For TEST mode amount will be charge 1)<p>
            </td>
          </tr>
          
          <tr>
          <br>
          <br>
          </tr>
          
          <tr>
            <td><span class="required">*</span><?php echo $sort_order; ?></td>
            <td><input type="text" name="Worldline_sort_order" value="<?php echo $Worldline_sort_order; ?>" placeholder="<?php echo $sort_order; ?>" id="input-sort_order" class="form-control" /></td>
          </tr>
          
          <tr>
            <td><span class="required">*</span><?php echo $merchant_scheme_code; ?></td>
            <td><input type="text" name="Worldline_merchant_scheme_code" value="<?php echo $Worldline_merchant_scheme_code; ?>" placeholder="<?php echo $merchant_scheme_code; ?>" id="input-merchant-scheme-code" class="form-control" /></td>
          </tr> 
          <tr>
            <td>Advanced Configuration</td>
          </tr>


          <tr>
            <td></span><?php echo $merchant_logo_url; ?></td>
            <td><input type="text" name="Worldline_merchant_logo_url" value="<?php echo $Worldline_merchant_logo_url; ?>" placeholder="https://www.paynimo.com/CompanyDocs/company-logo-md.png" id="input-merchant-logo-url" class="form-control" /><p>(An absolute URL pointing to a logo image of merchant which will show on checkout popup)</p></td>
          </tr>          

          <tr>
            <td></span><?php echo $primary_color_code; ?></td>
            <td><input type="text" name="Worldline_primary_color_code" value="<?php echo $Worldline_primary_color_code; ?>" placeholder="<?php echo $primary_color_code; ?>" id="input-primary-color-code" class="form-control" /><p>(Color value can be hex, rgb or actual color name)</p></td>
          </tr>

          <tr>
            <td></span><?php echo $secondary_color_code; ?></td>
            <td><input type="text" name="Worldline_secondary_color_code" value="<?php echo $Worldline_secondary_color_code; ?>" placeholder="<?php echo $secondary_color_code; ?>" id="input-secondary-color-code" class="form-control" /><p>(Color value can be hex, rgb or actual color name)</p></td>
          </tr>

          <tr>
            <td></span><?php echo $button_color_code1; ?></td>
            <td><input type="text" name="Worldline_button_color_code1" value="<?php echo $Worldline_button_color_code1; ?>" placeholder="<?php echo $button_color_code1; ?>" id="input-button-color-code1" class="form-control" /><p>(Color value can be hex, rgb or actual color name)</p></td>
          </tr>

          <tr>
            <td></span><?php echo $button_color_code2; ?></td>
            <td><input type="text" name="Worldline_button_color_code2" value="<?php echo $Worldline_button_color_code2; ?>" placeholder="<?php echo $button_color_code2; ?>" id="input-button-color-code2" class="form-control" /><p>(Color value can be hex, rgb or actual color name)</p></td>
          </tr>

          <tr>
            <td></span><?php echo $new_window_flow; ?></td>
            <td>
                <select name="Worldline_new_window_flow" id="input-window-flow" class="form-control">
                  <?php if ($Worldline_new_window_flow == "0") { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                <p>(If this feature is enabled, then bank page will open in new window)</p>
            </td>
          </tr>          

          <tr>
            <td></span><?php echo $express_pay; ?></td>
            <td>
                <select name="Worldline_express_pay" id="input-express-pay" class="form-control">
                  <?php if ($Worldline_express_pay == "1") { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                <p>(To enable saved payments set its value to Enable)</p>
            </td>
          </tr>

          <tr>
            <td></span><?php echo $merchant_message; ?></td>
            <td><input type="text" name="Worldline_merchant_message" value="<?php echo $Worldline_merchant_message; ?>" placeholder="<?php echo $merchant_message; ?>" id="input-merchant-message" class="form-control" /><p>(Customize message from merchant which will be shown to customer in checkout page)</p></td>
          </tr>          

          <tr>
            <td></span><?php echo $disclaimer_message; ?></td>
            <td><input type="text" name="Worldline_disclaimer_message" value="<?php echo $Worldline_disclaimer_message; ?>" placeholder="<?php echo $disclaimer_message; ?>" id="input-disclaimer-message" class="form-control" /><p>(Customize disclaimer message from merchant which will be shown to customer in checkout page)</p></td>
          </tr>

          <tr>
            <td></span><?php echo $paymentModeOrder; ?></td>
            <td><textarea name="Worldline_paymentModeOrder" rows="5" cols="50" placeholder="<?php echo $paymentModeOrder; ?>" class="form-control"><?php echo $Worldline_paymentModeOrder; ?></textarea><p>(Place order in this format: cards,netBanking,imps,wallets,cashCards,UPI,MVISA,debitPin,NEFTRTGS,emiBanks)</p></td>
          </tr>

          <tr>
            <td></span><?php echo $mer_transaction_details; ?></td>
            <td>
                <select name="Worldline_mer_transaction_details" id="input-mer_transaction_details" class="form-control">
                  <?php if ($Worldline_mer_transaction_details == "0") { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                <p>(Merchant Transaction Details)</p>
            </td>
          </tr> 

          <tr>
            <td></span><?php echo $instrumentDeRegistration; ?></td>
            <td>
                <select name="Worldline_instrumentDeRegistration" id="input-instrumentDeRegistration" class="form-control">
                  <?php if ($Worldline_instrumentDeRegistration == "1") { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                 <p>(If this feature is enabled, you will have an option to delete saved cards)</p>
            </td>
          </tr> 

          <tr>
            <td></span><?php echo $hide_saved_instruments; ?></td>
            <td>
                <select name="Worldline_hide_saved_instruments" id="input-hide_saved_instruments" class="form-control">
                  <?php if ($Worldline_hide_saved_instruments == "1") { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                <p>(If enabled checkout hides saved payment options even in case of enableExpressPay is enabled)</p>
            </td>
          </tr> 
          
          <tr>
            <td></span><?php echo $save_instrument; ?></td>
            <td>
                <select name="Worldline_save_instrument" id="input-save_instrument" class="form-control">
                  <?php if ($Worldline_save_instrument == "1") { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                <p>(Enable this feature to vault instrument)</p>
            </td>
          </tr> 

          <tr>
            <td></span><?php echo $txnType; ?></td>
            <td>
                <select name="Worldline_txnType" id="input-txnType" class="form-control">
                  <?php if ($Worldline_txnType == "SALE") { ?>
                  <option value='SALE' selected="selected"><?php echo "SALE"; ?></option>
                  <?php } else { ?>
                  <option value='SALE'><?php echo "SALE"; ?></option>
                  <?php } ?>
                </select>
            </td>
          </tr>

          <tr>
            <td></span><?php echo $response_on_popup; ?></td>
            <td>
                <select name="Worldline_response_on_popup" id="input-response_on_popup" class="form-control">
                  <?php if ($Worldline_response_on_popup == "1") { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
            </td>
          </tr>
          
          <tr>
            <td></span><?php echo $separateCardMode; ?></td>
            <td>
                <select name="Worldline_separateCardMode" id="input-separateCardMode" class="form-control">
                  <?php if ($Worldline_separateCardMode == "1") { ?>
                  <option value="1" selected="selected"><?php echo "Yes"; ?></option>
                  <option value="0"><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Yes"; ?></option>
                  <option value="0" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
                <p>If this feature is enabled checkout shows two separate payment mode(Credit Card and Debit Card)</p>
            </td>
          </tr>          

          <tr>
            <td></span><?php echo $payment_mode; ?></td>
            <td>
                <select name="Worldline_payment_mode" id="input-payment_mode" class="form-control">
                  <?php if ($Worldline_payment_mode == "emiBanks") { ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking"><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks" selected="selected"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "cards"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"selected="selected"><?php echo "cards"; ?></option>
                  <option value="netBanking"><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "netBanking"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" selected="selected"><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "UPI"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" ><?php echo "netBanking"; ?></option>
                  <option value="UPI" selected="selected"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "imps"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" ><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps" selected="selected"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "wallets"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" ><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps" ><?php echo "imps"; ?></option>
                  <option value="wallets" selected="selected"><?php echo "wallets"; ?></option>
                  <option value="cashCards"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "cashCards"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" ><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards" selected="selected"><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else if($Worldline_payment_mode == "NEFTRTGS"){ ?>
                  <option value="all"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" ><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards" ><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS" selected="selected"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } else { ?>
                  <option value="all" selected="selected"><?php echo "all"; ?></option>
                  <option value="cards"><?php echo "cards"; ?></option>
                  <option value="netBanking" ><?php echo "netBanking"; ?></option>
                  <option value="UPI"><?php echo "UPI"; ?></option>
                  <option value="imps"><?php echo "imps"; ?></option>
                  <option value="wallets"><?php echo "wallets"; ?></option>
                  <option value="cashCards" ><?php echo "cashCards"; ?></option>
                  <option value="NEFTRTGS"><?php echo "NEFTRTGS"; ?></option>
                  <option value="emiBanks"><?php echo "emiBanks"; ?></option>
                  <?php } ?>
                </select>
                <p>(If Bank selection is at Worldline ePayments India Pvt. Ltd. end then select all, if bank selection at Merchant end then pass appropriate mode respective to selected option)</p>
            </td>
          </tr>

          <tr>
            <td></span><?php echo $checkoutElement; ?></td>
            <td>
                <select name="Worldline_checkoutElement" id="input-checkoutElement" class="form-control">
                  <?php if ($Worldline_checkoutElement == "#Worldline_payment_form") { ?>
                  <option value="#Worldline_payment_form" selected="selected"><?php echo "Yes"; ?></option>
                  <option value=""><?php echo "No"; ?></option>
                  <?php } else { ?>
                  <option value="#Worldline_payment_form"><?php echo "Yes"; ?></option>
                  <option value="" selected="selected"><?php echo "No"; ?></option>
                  <?php } ?>
                </select>
            </td>
          </tr>
          <tr>
            <td><p><a href="<?php echo $verification; ?>">Worldline Offline Verification</a></p></td>
            <td><p><a href="<?php echo $recon; ?>">Reconcilation</a></p></td>
          </tr>

        </table>
	<p style="text-align:center">Version 1.x-1.0.0</p></td>
      </form>
    </div>
  </div>
</div>

<?php echo $footer; ?> 
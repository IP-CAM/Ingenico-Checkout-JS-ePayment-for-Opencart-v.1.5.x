<h3>Ingenico Refund</h3>
	<?php 
	$status = (isset($status)) ? $status: null;
	if($status =='success'){ ?>

    <form id="form" class="form-horizontal">
     <input type="hidden" name="date" placeholder="dd-mm-YYYY" value="rtyb" required/>
      Amount:   <input type="text" name="amount" placeholder="amount" value="<?php echo $amount; ?>" required/>
    <input type="hidden" name="token" placeholder="token" value="" required/>  
      <input type="hidden" name="mrctCode" value=""/>          
      <input type="hidden" name="currency" value=""/>          
         &nbsp; &nbsp; &nbsp;   <button id="btnSubmit" type="submit" class="btn btn-primary" name="submit" value="Submit">Refund</button>

      </form><br>
	<?php }else{ ?>
		<h4>Refund Not Applicable</h4>
	<?php } ?>
      <p></p>
<script>
	$(document).ready(function(){
  	$("#btnSubmit").click(function(e){
    	e.preventDefault();
    	var query_array = <?php echo json_encode($this->data); ?>;
    	var str = $("#form").serializeArray();
    	var amount  = str[1].value
    	var roundAmount = parseFloat(amount).toFixed(2);
    	var data = {
			   	"merchant": {
			    "identifier": query_array['mcode']
				},
			   	"cart": {
			  	},
			  	"transaction": {
			    "deviceIdentifier": "S",
			    "amount": roundAmount,
			    "currency": query_array['currency'],      
			    "dateTime": query_array['date'],
			    "token": query_array['token'],  
			    "requestType": "R"
			  }

		};
    	var myJSON = JSON.stringify(data);
    	$.ajax({
		    type: 'POST',
		    url: "https://www.paynimo.com/api/paynimoV2.req",
		    data: myJSON,
		    beforeSend: function() {
		        $("p").html("");
		        $("p").append('Loading......');
	    	},
	    	success: function(resultData) {
	    		var status_code = resultData.paymentMethod.paymentTransaction.statusCode; 
		        var statusmessage = resultData.paymentMethod.paymentTransaction.statusMessage ? resultData.paymentMethod.paymentTransaction.statusMessage : 'Refund Initiation Failed';
		        
		        var errormessage = resultData.paymentMethod.paymentTransaction.errorMessage ? resultData.paymentMethod.paymentTransaction.errorMessage : 'Refund Failed';

		        $("p").html("");
		        $("p").append('<p><b>Refund Status: </b>'+statusmessage+ '</p><p><b>Message: </b>'+errormessage+'</p>');
		        
		    }
		});
    });
});
</script>
<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>
<div id="content">
<!DOCTYPE html>
	<html lang="en">
	<head>
		<style>
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 50%;
		}

		td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}
		</style>
		  <script>
			$(document).ready(function(){
  				$("#submit").click(function(e){
  					e.preventDefault();
  					var merchant_data = <?php echo json_encode($this->data); ?>;
  					var str = $("#form").serializeArray();
					var data = {
						"merchant": {
					    	"identifier": merchant_data['mrc_code']
					  	},
					  	"transaction": {
						    "deviceIdentifier": "S",
						    "currency": merchant_data['currency'],
						    "identifier":str[0].value,
						    "dateTime": str[1].value,
						    "requestType": "O"
					  	}
					};
  					var myJSON = JSON.stringify(data);
  					$.ajax({
					    type: 'POST', 
					   	url: "https://www.paynimo.com/api/paynimoV2.req",
					    data: myJSON,
					    success: function(resultData) { 

							var status_code = resultData.paymentMethod.paymentTransaction.statusCode;
							var status_message = resultData.paymentMethod.paymentTransaction.statusMessage;
							var identifier = resultData.paymentMethod.paymentTransaction.identifier;
							var amount = resultData.paymentMethod.paymentTransaction.amount;
							var errorMessage = resultData.paymentMethod.paymentTransaction.errorMessage;
							var dateTime = resultData.paymentMethod.paymentTransaction.dateTime;
							var merchantTransactionIdentifier = resultData.merchantTransactionIdentifier;
							$("p").html('');
					    	$("p").append("<br><br>" +         
		  "<table>" +
		      "<tr>"+
		        "<th>Status Code</th>"+
		        "<th>" + status_code +"</th>"+
		      "</tr>"+
		      "<tr>" +
		        "<th>Merchant Transaction Reference No</th>"+
		        "<th>" + merchantTransactionIdentifier +"</th>"+
		      "</tr>"+
		      "<tr>" +
		        "<th>TPSL Transaction ID</th>"+
		        "<th>" + identifier +"</th>"+
		      "</tr>"+
		      "<tr>" +
		        "<th>Amount</th>"+
		        "<th>" + amount +"</th>"+
		      "</tr>"+
		      "<tr>" +
		        "<th>Message</th>"+
		        "<th>" + errorMessage +"</th>"+
		      "</tr>"+ 
		      "<tr>" +
		        "<th>Status Message</th>"+
		        "<th>" + status_message +"</th>"+
		      "</tr>"+
		       "<tr>" +
		        "<th>Date Time</th>"+
		        "<th>" + dateTime +"</th>"+
		      "</tr>"+
		  "</table>"+
		"</div>"+
		"</div>");
					   	}		
					});
  						
  				});
  			});

		</script>
		</head>
		<body>
		<div class="container">
		<div class="row">
			<div class="text">
			<h2><?php echo $heading_title; ?></h2>
		</div>
		<form id="form" class="form-inline" method="POST">

			Merchant Ref No: 		<input type="text" name="token"  placeholder="Merchant Ref No." required>
			Date:		<input type="date" name="date" placeholder="dd-mm-YYYY" required>            
						 &nbsp; &nbsp; &nbsp; <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit" />
			</form>
		</div>
		<p></p>
		<br>
		<br>
		</body>
	</html>
	<?php
	$merchantTxnRefNumber = null; 
	$date = null;
	if(isset($_POST["token"])){
		$merchantTxnRefNumber = $_POST["token"];
	}

	if(isset($_POST["date"])){
		$date  = $_POST["date"];
	}
?>


</div> 
<?php echo $footer; ?>
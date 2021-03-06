<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	// following files need to be included
	include_once APPPATH . "libraries/lib/config_paytm.php";
	include_once APPPATH . "libraries/lib/encdec_paytm.php";
	// require_once("./lib/encdec_paytm.php");

	$ORDER_ID = "";
	$requestParamList = array();
	$responseParamList = array();

	if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
		$ORDER_ID = $_POST["ORDER_ID"];
		

		// Create an array having all required parameters for status query.
		$requestParamList = array("MID" => 'uhcICI67533184810852' , "ORDERID" => $ORDER_ID);  
		
		$StatusCheckSum = getChecksumFromArray($requestParamList,'0vGOHMa2M1JPXE%Z');
		
		$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

		// Call the PG's getTxnStatusNew() function for verifying the transaction status.
		$responseParamList = getTxnStatusNew($requestParamList);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Paytm Payment</title>
	<!--------Css File Include ------>
	<?= view('Home/css_file'); ?>
	<!--------Css File Include ------>
</head>
<body>

<div class="container" style="padding-top: 5%">
	<div class="row">
		<div class="col-12 col-lg-4 col-md-4 col-sm-4"></div>
		<div class="col-12 col-lg-4 col-md-4 col-sm-4">
			<div class="card">
				<div class="card-header">
					<h6>ADD WALLET MONEY</h6>
				</div>
				<div class="card-body">
					<?= form_open('Home/paytm_page_redirect'); ?>
						<label>ORDER_ID::*</label></td>
						<input id="ORDER_ID" tabindex="1" maxlength="20" size="20"
							name="ORDER_ID" autocomplete="off"
							value="<?= $order_id; ?>" class="form-control" readonly>
							<label>CUSTID ::*</label>
							<input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?= $user_id; ?>" class="form-control" readonly>
							<label>INDUSTRY_TYPE_ID ::*</label>
							<input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" class="form-control" readonly>
							<label>Channel ::*</label> 
							<input id="CHANNEL_ID" tabindex="4" maxlength="12"
							size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" readonly class="form-control">
							<label>txnAmount*</label>
							<input title="TXN_AMOUNT" tabindex="10"
							type="text" name="TXN_AMOUNT"
							value="<?= $amount; ?>" class="form-control" readonly>
							<br>
							<input value="CheckOut" type="submit"	onclick="" class="btn-lg btn-primary">
					<?= form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4 col-md-4 col-sm-4"></div>
	</div>
</div>

<div style="padding-bottom: 5%"></div>


<!-----footer section Include ------>
<?= view('Home/footer_section'); ?>
<!-----footer section Include ------>
<!---------Js File Include ------>
<?= view('Home/js_file'); ?>
<!---------Js File Include ------>
</body>
</html>
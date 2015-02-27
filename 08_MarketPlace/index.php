<!doctype html>

<?php
require_once '../lib/Braintree.php';

Braintree_Configuration::environment("sandbox");
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");

$clientToken = Braintree_ClientToken::generate();
 
if(!empty($_POST)){
	switch($_POST["action"]) {
		case "create" :
			$result = Braintree_MerchantAccount::create(array(
				'individual' => array(
					'firstName' => 'Jane',
					'lastName' => 'Doe',
					'email' => 'jane@14ladders.com',
					'phone' => '5553334444',
					'dateOfBirth' => '1981-11-19',
					'ssn' => '456-45-4567',
					'address' => array(
						'streetAddress' => '111 Main St',
						'locality' => 'Chicago',
						'region' => 'IL',
						'postalCode' => '60622'
					)
				),
				'funding' => array(
					'descriptor' => 'Blue Ladders',
					'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
					'email' => 'funding@blueladders.com',
					'mobilePhone' => '5555555555',
					'accountNumber' => '1123581321',
					'routingNumber' => '071101307'
				),
				'tosAccepted' => true,
				'masterMerchantAccountId' => "market_place_mid",
				'id' => $_POST["subMerchId"]
			  )
			);

			echo "<pre>";
			print_r($result);
			echo "</pre>";
			break;
		
		case "pay" :
			$result = Braintree_Transaction::sale(array(
				'amount' => '10',
				'merchantAccountId' => $_POST["subMerchId"],
				'paymentMethodNonce' => $_POST["payment_method_nonce"],
				'options' => array(
					'submitForSettlement' => true,
					'holdInEscrow' => true,
					),
				'serviceFeeAmount' => '2.00'
				)
			);
			echo "<pre>";
			print_r($result);
			echo "</pre>";
			break;
	}
}

?>

<html class="is-modern">
<head>
	<meta charset="utf-8">
	<title>Hello, Client!</title>
	<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
</head>
<body>
	<form action="index.php" method="POST">
		<label><b>Create sub merchant account</b></label><br>
		<input type="hidden" name="action" value="create">
		<label>Sub Merchant Id</label><input type="text" size="20" name="subMerchId"><br>
		<input type="submit" value="Create" />
	</form>
	<br>
	<form id="checkout" method="post" action="index.php">
		<div id="dropin"></div>
			<input type="hidden" name="action" value="pay">
			<label>Sub Merchant Id</label><input type="text" size="20" name="subMerchId"><br>
			<input type="submit" value="Pay">
	</form>
	
<script>
	braintree.setup("<?php echo $clientToken; ?>", "dropin", {
		container: "dropin"
	});
</script>

</body>
</html>
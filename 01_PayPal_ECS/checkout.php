<?php 

require_once '../lib/Braintree.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");


$nonce = $_POST["payment_method_nonce"];

//echo $_POST["shippingName"];
//echo "<br><br>";


$result = Braintree_Transaction::sale(array(
  "amount" => '10.00',
  "shipping" => array(
		"firstName" => $_POST["shippingName"],
		"streetAddress" => $_POST["shippingStreetAddress"],
		"extendedAddress" => $_POST["shippingExtendedAddress"],
		"locality" => $_POST["shippingLocality"],
		"region" => $_POST["shippingRegion"],
		"postalCode" => $_POST["shippingPostalCode"],
		"countryCodeAlpha2" => $_POST["shippingCountryCodeAlpha2"]
	),
  'paymentMethodNonce' => $nonce
));

echo '<pre>';
 print_r($result);
echo '</pre>';

?>
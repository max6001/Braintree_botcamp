<!doctype html>

<?php
require_once '../lib/Braintree.php';

Braintree_Configuration::environment("sandbox");
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");

$clientToken = Braintree_ClientToken::generate();

?>

<html class="is-modern">
<head>
	<meta charset="utf-8">
	<title>Hello, Client!</title>
	<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
</head>
<body>
	<form id="checkout" name="checkout" method="post" action="checkout.php">
		<div id="paypal-button"></div>
			<input type="hidden" name="shippingName" value="">
			<input type="hidden" name="shippingPostalCode" value="">
			<input type="hidden" name="shippingRegion" value="">
			<input type="hidden" name="shippingLocality" value="">
			<input type="hidden" name="shippingStreetAddress" value="">
			<input type="hidden" name="shippingExtendedAddress" value="">
			<input type="hidden" name="shippingCountryCodeAlpha2" value="">
			<input type="submit" value="Pay Now">
</form>

<script>
	braintree.setup("<?php echo $clientToken; ?>", "paypal", {
		container: "paypal-button",
		singleUse: false,
		enableShippingAddress: true,
		onSuccess: function (nonce, email, shippingAddress) {
			document.forms["checkout"].elements["shippingName"].value = shippingAddress.recipient_name;
			document.forms["checkout"].elements["shippingPostalCode"].value = shippingAddress.postal_code;
			document.forms["checkout"].elements["shippingRegion"].value = shippingAddress.region;
			document.forms["checkout"].elements["shippingLocality"].value = shippingAddress.locality;
			document.forms["checkout"].elements["shippingStreetAddress"].value = shippingAddress.street_address;
			document.forms["checkout"].elements["shippingExtendedAddress"].value = shippingAddress.shippingExtendedAddress;
			document.forms["checkout"].elements["shippingCountryCodeAlpha2"].value = shippingAddress.country_code_alpha2;
    }
	});
</script>
  
</body>
</html>
		
		
		
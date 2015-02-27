<!doctype html>

<?php
require_once '../lib/Braintree.php';

Braintree_Configuration::environment("production");
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
			<input type="submit" value="Pay Now">
	</form>

<script>
	braintree.setup("<?php echo $clientToken; ?>", "paypal", {
		container: "paypal-button",
		singleUse: true,
		amount: 200,
		currency: 'USD',
		enableShippingAddress: true,
	});
</script>
  
</body>
</html>
		
		
		
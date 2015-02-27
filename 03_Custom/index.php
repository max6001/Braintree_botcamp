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
	<form id="checkout" action="checkout.php" method="post">
	  <label>CC Number</label><input data-braintree-name="number"><br>
	  <label>Expiration Date</label><input data-braintree-name="expiration_date"><br>
	  <input type="submit" id="submit" value="Pay">
	</form>

<script>
	braintree.setup("<?php echo $clientToken; ?>", "custom", {
		id: "checkout"
	});
</script>
  
</body>
</html>
		
		
		
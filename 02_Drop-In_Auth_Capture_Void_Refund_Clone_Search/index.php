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
	<form id="checkout" method="post" action="checkout.php">
		<div id="dropin"></div>
			<input type="submit" value="Authorize now!">
	</form>
	<br><br>
	<form id="capture" method="post" action="capture.php">
		<label>Transaction ID</label><input type="text" size="6" name="trxid"><br>
		<label>Amount</label><input type="text" size="20" name="amount"><br>
		<input type="submit" value="Capture now!">
	</form>
	<br><br>
	<form action="refund.php" method="POST" id="refund-form">
		<label>Transaction ID</label><input type="text" size="6" name="trxid"><br>
		<label>Amount</label><input type="text" size="20" name="amount"><br>
	<input type="submit" value="Refund now!" />
	</form>
	<br><br>
	<form action="void.php" method="POST" id="void-form">
		<label>Transaction ID</label><input type="text" size="6" name="trxid"><br>
	<input type="submit" value="Void now!" />
	</form>
	<br><br>
	<form action="search.php" method="POST" id="search-form">
		<label>Transaction ID</label><input type="text" size="6" name="trxid"><br>
		<label>Or Date is </label><input type="text" size="12" name="date" value="2015-02-24"><br>
		<label>Or Date is between </label><input type="text" size="12" name="startdate" value="2015-01-01">
						and <input type="text" size="12" name="enddate" value="2015-02-24"><br>
	<input type="submit" value="Search now!" />
	</form>
	<br><br>
	<form action="clone.php" method="POST" id="clone-form">
		<label>Transaction ID</label><input type="text" size="6" name="trxid"><br>
		<label>Amount</label><input type="text" size="20" name="amount"><br>
	<input type="submit" value="Clone now!" />
	</form>

<script>
	braintree.setup("<?php echo $clientToken; ?>", "dropin", {
		container: "dropin"
	});
</script>
  
</body>
</html>
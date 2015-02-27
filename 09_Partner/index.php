<!doctype html>

<html class="is-modern">
<head>
	<meta charset="utf-8">
	<title>Hello, Client!</title>
	<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
</head>

<?php
require_once '../lib/Braintree.php';
 
if(!empty($_POST)){
	switch($_POST["action"]) {
		case "load" :
		
			$merchantId=$_POST["merchantId"];
			$publicKey=$_POST["publicKey"];
			$privateKey=$_POST["privateKey"];
		
			Braintree_Configuration::environment("sandbox");
			Braintree_Configuration::merchantId($merchantId);
			Braintree_Configuration::publicKey($publicKey);
			Braintree_Configuration::privateKey($privateKey);
			
			$clientToken = Braintree_ClientToken::generate();
		
			echo ("<form id='checkout' method='post' action='index.php'>
					<div id='dropin'></div>
						<input type='hidden' name='action' value='pay'><br>
						<input type='hidden' name='merchantId' value='$merchantId'>
						<input type='hidden' name='publicKey' value='$publicKey'>
						<input type='hidden' name='privateKey' value='$privateKey'>
						<input type='submit' value='Pay'><br><br>
				</form>");
	
			echo ("<script>
					braintree.setup('$clientToken', 'dropin', {
						container: 'dropin'
					});
				</script>");
			break;
		
		
		case "pay" :
		
			Braintree_Configuration::environment("sandbox");
			Braintree_Configuration::merchantId($_POST["merchantId"]);
			Braintree_Configuration::publicKey($_POST["publicKey"]);
			Braintree_Configuration::privateKey($_POST["privateKey"]);
		
			$result = Braintree_Transaction::sale(array(
				'amount' => '10',
				'paymentMethodNonce' => $_POST["payment_method_nonce"],
				'options' => array(
					'submitForSettlement' => true,
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

<body>
	<form action="index.php" method="POST">
		<label><b>Enter sub merchant credentials</b></label><br>
		<label>Merchant ID: </label><input type="text" size="55" name="merchantId" value=""><br>
		<label>Public Key: </label><input type="text" size="55" name="publicKey" value=""><br>
		<label>Private Key: </label><input type="text" size="55" name="privateKey" value=""><br>
		<input type="hidden" name="action" value="load">
		<input type="submit" value="Load drop-in UI" />
	</form>
<!--	<form id="checkout" method="post" action="index.php">
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
-->

</body>
</html>
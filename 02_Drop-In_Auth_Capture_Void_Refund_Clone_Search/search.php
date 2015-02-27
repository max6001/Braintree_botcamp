<?php

require_once "../lib/Braintree.php";

Braintree_Configuration::environment("sandbox");
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");

//Send the request
if ($_POST["trxid"]!="") {
	$result = Braintree_Transaction::find($_POST["trxid"]);
} elseif ($_POST["date"]!="") {
	$result = Braintree_Transaction::search(array(
		Braintree_TransactionSearch::createdAt()->greaterThanOrEqualTo($_POST["date"])
	));
} else {
	$result = Braintree_Transaction::search(array(
		Braintree_TransactionSearch::createdAt()->between($_POST["startdate"],$_POST["enddate"])
	));
}

//Display the full response
echo '<pre>';
 print_r($result);
echo '</pre>';
?>

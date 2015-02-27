<?php

require_once "../lib/Braintree.php";

Braintree_Configuration::environment("sandbox");
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");

//Send the request
$result = Braintree_Transaction::cloneTransaction($_POST["trxid"], array(
  'amount' => $_POST["amount"],
  'options' => array(
    'submitForSettlement' => true
  )
));

//Display the success/failure
echo "<br><br>";
if ($result->success) {
  echo $_POST["trxid"]." cloned<br>";
} else {
  print_r($result->errors);
}

//Display the full response
echo '<pre>';
 print_r($result);
echo '</pre>';
?>
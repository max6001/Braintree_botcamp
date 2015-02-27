<?php 

require_once '../lib/Braintree.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");


$nonce = $_POST["payment_method_nonce"];

$result = Braintree_Transaction::sale(array(
  'amount' => '100.00',
  'paymentMethodNonce' => $nonce
));

echo '<pre>';
 print_r($result);
echo '</pre>';

?>
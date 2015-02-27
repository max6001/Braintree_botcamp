<?php
require_once '../lib/Braintree.php';

Braintree_Configuration::environment("sandbox");
Braintree_Configuration::merchantId("");
Braintree_Configuration::publicKey("");
Braintree_Configuration::privateKey("");
 
if(isset($_GET["bt_challenge"])) {
	$log = fopen('log.txt', 'a+');
	fputs($log, $_GET["bt_challenge"]."\n");
	fclose($log);
    echo(Braintree_WebhookNotification::verify($_GET["bt_challenge"]));
}

if( isset($_POST["bt_signature"]) && isset($_POST["bt_payload"])) {
    $webhookNotification = Braintree_WebhookNotification::parse($_POST["bt_signature"], $_POST["bt_payload"]);

    $message =
        "[Webhook Received " . $webhookNotification->timestamp->format('Y-m-d H:i:s') . "] "
        . "Kind: " . $webhookNotification->kind . " | "
        . "Merchant: " . $webhookNotification->merchantAccount->id . " " . $webhookNotification->merchantAccount->status . "\n";

    file_put_contents("webhook.log", $message, FILE_APPEND);
}

?>
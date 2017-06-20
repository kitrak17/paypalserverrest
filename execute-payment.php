<?php
include('config.php');
$ch = curl_init();

$paymentID = $_REQUEST["paymentID"];
$payerID = $_REQUEST["payerID"];
$json_data = json_encode(
						array( 
								"payer_id"=> $payerID
						));

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/".$paymentID."/execute/");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
$result = curl_exec($ch);
echo $result;
curl_close($ch);
?>
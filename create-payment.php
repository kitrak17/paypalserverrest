<?php
include('config.php');
$ch = curl_init();
$json_data = json_encode(
						array( 
								"intent"=> "sale",
							    "redirect_urls" => array(
								    "return_url" => $return_url,
								    "cancel_url" => $cancel_url
								),
							    "payer" => array(
				    				"payment_method" => "paypal"
				    		    ),
							   	"transactions" =>  array(
							   	 	array(
							   	 		"amount" => array(
							   	 			"total" => $total_price,
							   	 			"currency" => $currency
							   	 		),
							   	 		"item_list" => array(
							   	 			"items" => array(
							   	 					array(
							   	 						"quantity" => "1",
							   	 						"name" 		=> $product_name,
							   	 						"price"		=> $product_price,
							   	 						"currency"	=> $currency,
							   	 						"description" => $product_name,
							   	 						"tax"	=> 1
							   	 					)
							   	 				)
							   	 		)
							   	 	)
							   	 )
							  )
						);

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
$result = curl_exec($ch);
echo $result;
curl_close($ch);
?>
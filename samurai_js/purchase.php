<?php

/* Purchase action for Samurai.js
 * ------------------------------
 *
 * - payment_method_token is POST'd via AJAX
 * - Responds with a JSON transaction object
 *
 */

require_once dirname(__FILE__) . '/../config.php';

if (!isset($_POST['payment_method_token'])) {
	redirect('index');
	exit();
}

$paymentMethodToken = $_POST['payment_method_token'];

$processor = Samurai_Processor::theProcessor();
$purchase  = $processor->purchase(
							 $paymentMethodToken, 
							 122.0, # The price for the Samurai.js Katana Sword
							 array(
							 	'descriptor'         => 'Samurai.js Katana Sword',
							 	'customer_reference' => time(),
							 	'billing_reference'  => time()
							 ));

echo json_encode(array('transaction' => $purchase->attributes));

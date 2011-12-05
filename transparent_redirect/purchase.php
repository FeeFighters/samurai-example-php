<?php

/* Purchase action for Transparent Redirect
 * ------------------------------
 *
 * - This action is requested as the callback from the Samurai Transparent Redirect
 * - It performs the purchase, and redirects the user to the purchase confirmation page
 * - On error, it redirects back to the payment form to display validation/card errors
 *
 */

require_once dirname(__FILE__) . '/../config.php';

if (!isset($_GET['payment_method_token'])) {
	redirect('index');
	exit();
}

$paymentMethodToken = $_GET['payment_method_token'];

$processor = Samurai_Processor::theProcessor();
$purchase  = $processor->purchase(
							 $paymentMethodToken, 
							 122.0, # The price for the Transparent Redirect Nunchucks
							 array(
							 	'descriptor'         => 'Transparent Redirect Nunchucks',
							 	'customer_reference' => time(),
							 	'billing_reference'  => time()
							 ));

if ($purchase->isSuccess()) {
	redirect('transparent_redirect/receipt');
} else {
	redirect('transparent_redirect/payment_form', 'payment_method_token=' . $paymentMethodToken);
}

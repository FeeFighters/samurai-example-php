<?php

/* Purchase action for Server-to-Server API
 * ----------------------------------------
 *
 * - Payment Method details are POST'ed directly to the server, which performs a S2S API call
 * - NOTE: This approach is typically not recommended, as it comes with a much greater PCI compliance burden
 *   In general, it is a good idea to prevent the credit card details from ever touching your server.
 *
 */

require_once dirname(__FILE__) . '/../config.php';

/* Redirect to index if no payment_method data was submitted. */
if (empty($_POST['payment_method'])) {
	redirect('index');
	exit();
}

/* Create the payment method. */
$paymentMethod = Samurai_PaymentMethod::create($_POST['payment_method']);

if ($paymentMethod->hasErrors()) {
	redirect('server_to_server/payment_form', 'payment_method_token=' . $paymentMethod->token);
	exit();
}

/* Create the purchase transaction. */
$processor = Samurai_Processor::theProcessor();
$purchase  = $processor->purchase(
							 $paymentMethod->token, 
							 122.0, # The price for the Server-to-Server Battle Axe + Shipping
							 array(
							 	'descriptor'         => 'Server-to-Server Battle Axe + Shipping',
							 	'customer_reference' => time(),
							 	'billing_reference'  => time()
							 ));

if ($purchase->isSuccess()) {
	redirect('server_to_server/receipt');
} else {
	redirect('server_to_server/payment_form', 'payment_method_token=' . $paymentMethod->token);
}

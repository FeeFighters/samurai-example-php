<?php

/* Payment form for Server-to-Server API
 * -------------------------------------
 *
 * - Displays a payment form that POSTs to the purchase method below
 * - The credit card data is provided directly to this rails server, where it is used to process a
 *   transaction entirely on the backend.
 * - A payment_method_token or reference_id can be provided in the params 
 *	 so that validation errors can be displayed.
 *
 */

require_once dirname(__FILE__) . '/../config.php';

if (!empty($_GET['payment_method_token'])) {
	$paymentMethod = Samurai_PaymentMethod::find($_GET['payment_method_token']);
}

render('server_to_server/payment_form', 
	array(
		'paymentMethod' => (!empty($paymentMethod) ? $paymentMethod : new Samurai_PaymentMethod()),
	));

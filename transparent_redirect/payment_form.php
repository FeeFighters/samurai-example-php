<?php

/* Payment form for Transparent Redirect
 * ------------------------------
 *
 * - Displays a payment form using the Samurai Rails helpers bundled in the gem
 * - Payment form is initialized with PaymentMethod data, if a token is passed in the params.
 *   This allows validation & processor-response error messages to be displayed.
 * 
 */

require_once dirname(__FILE__) . '/../config.php';

if (!empty($_GET['payment_method_token'])) {
	$paymentMethod = Samurai_PaymentMethod::find($_GET['payment_method_token']);
}

/* This is where Samurai will redirect the browser after the payment 
 * method token has been generated. */
$redirectUrl = urlFor('transparent_redirect/purchase', /* include hostname */ true);

render('transparent_redirect/payment_form', 
	array(
		'redirectUrl'   => $redirectUrl,
		'transaction'   => (!empty($transaction) ? $transaction : new Samurai_Transaction()),
		'paymentMethod' => (!empty($paymentMethod) ? $paymentMethod : new Samurai_PaymentMethod()),
	));

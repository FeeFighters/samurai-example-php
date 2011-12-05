<?php 
$ajax        = isset($ajax)        ? $ajax				: false;
$redirectUrl = isset($redirectUrl) ? $redirectUrl : '#'; 
$classes     = isset($classes)     ? $classes		  : '';

$transaction = isset($transaction) ? $transaction : new Samurai_Transaction();
$paymentMethod = isset($paymentMethod) ? $paymentMethod : new Samurai_PaymentMethod();
?>

<div id="content" class="wrapper payment-form transparent-redirect">
  <h1>Checkout</h1>

  <section class="shopping-cart">
    <h2>Shopping Cart</h2>
    <table cellpadding="0" cellspacing="0">
      <thead>
        <tr><th>Qty</th><th>Item</th><th>Price</th></tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
					<td><img src="<?php echo PUBLIC_PATH ?>/images/nunchucks.jpg" width="40" height="40" class="left cleaner">Transparent Redirect Nunchucks</td>
          <td>$  22.00</td>
        </tr>
        <tr>
          <td></td>
          <td>Overnight Shipping (battle imminent!)</td>
          <td>$ 100.00</td>
        </tr>
        <tr class="total">
          <td></td>
          <td>Total:</td>
          <td>$ 122.00</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section class="payment-info">
    <h2>Enter your payment information:</h2>
    <div class="samurai">
			<?php Samurai_Views::renderErrors(array('paymentMethod' => $paymentMethod)) ?>
			<?php Samurai_Views::renderPaymentForm(array('redirectUrl' => $redirectUrl, 'paymentMethod' => $paymentMethod)) ?>
    </div>
  </section>

  <footer>
		<a href="<?php echo PUBLIC_PATH ?>" class="back">Back to the Samurai Weapons</a>
  </footer>
</div>


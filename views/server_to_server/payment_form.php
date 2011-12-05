<?php 
$transaction   = isset($transaction)   ? $transaction   : new Samurai_Transaction();
$paymentMethod = isset($paymentMethod) ? $paymentMethod : new Samurai_PaymentMethod();
?>
<div id="content" class="wrapper payment-form s2s">
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
					<td><img src="<?php echo PUBLIC_PATH ?>/images/battle-axe.jpg" width="40" height="40" class="left cleaner">Server-to-Server Battle Axe</td>
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
			<?php if ($transaction->hasErrors() || $paymentMethod->hasErrors()): ?>
        <div id="error_explanation">
          <h4>This transaction could not be processed:</h4>
          <ul>
					<?php 
					if ($transaction->hasErrors()):
						foreach ($transaction->errors as $context => $errors):
								foreach ($errors as $error): ?>
									<li><?php echo $error->description ?></li>
					<?php
								endforeach;
							endforeach;
						endif; ?>
					<?php 
					if ($paymentMethod->hasErrors()):
						foreach ($paymentMethod->errors as $context => $errors):
								foreach ($errors as $error): ?>
									<li><?php echo $error->description ?></li>
					<?php
								endforeach;
							endforeach;
						endif; ?>
          </ul>
        </div>
			<?php endif; ?>

      <form action="purchase.php" method="POST" class="samurai">
        <fieldset>
          <div class="field-group" id="credit_card_name_group">
            <div>
              <label for="payment_method_first_name">First name</label>
              <input id="payment_method_first_name" name="payment_method[first_name]" size="30" type="text" value="<?php echo $paymentMethod->firstName ?>" />
            </div>
            <div>
              <label for="payment_method_last_name">Last name</label>
              <input id="payment_method_last_name" name="payment_method[last_name]" size="30" type="text" value="<?php echo $paymentMethod->lastName ?>" />
            </div>
          </div>

          <div class="field-group" id="credit_card_address_group">
            <div>
              <label for="payment_method_address_1">Address 1</label>
              <input class="div-6" id="payment_method_address_1" name="payment_method[address_1]" size="30" type="text" value="<?php echo $paymentMethod->address1 ?>" />
            </div>
            <div>
              <label for="payment_method_address_2">Address 2</label>
              <input class="div-6" id="payment_method_address_2" name="payment_method[address_2]" size="30" type="text" value="<?php echo $paymentMethod->address2 ?>" />
            </div>
          </div>

          <div class="field-group" id="location_group">
            <div>
              <label for="payment_method_city">City</label>
              <input id="payment_method_city" name="payment_method[city]" size="30" type="text" value="<?php echo $paymentMethod->city ?>" />
            </div>
            <div>
              <label for="payment_method_state">State</label>
              <input class="" id="payment_method_state" name="payment_method[state]" size="30" type="text" value="<?php echo $paymentMethod->state ?>" />
            </div>
            <div>
              <label for="payment_method_zip">Zip</label>
              <input class="" id="payment_method_zip" name="payment_method[zip]" size="30" type="text" value="<?php echo $paymentMethod->zip ?>" />
            </div>
          </div>
        </fieldset>

        <fieldset>
          <div class="field-group" id="credit_card_info_group">
            <div>
              <label for="payment_method_card_number">Card Number</label>
              <input id="payment_method_card_number" name="payment_method[card_number]" size="30" type="text" value="<?php echo $paymentMethod->cardNumber ?>" autocomplete="off" />
              <label data-samurai-card-previews class="show-accepted">
                <span class='visa'></span>
                <span class='mastercard'></span>
                <span class='amex'></span>
                <span class='discover'></span>
              </label>
            </div>
            <div id="samurai_card_cvv">
              <label for="payment_method_cvv">CVV</label>
              <input class="div-1" id="payment_method_cvv" name="payment_method[cvv]" size="30" type="text" value="<?php echo $paymentMethod->cvv ?>" autocomplete="off" />
            </div>
          </div>
          <div class="field-group" id="credit_card_expiration">
            <div>
              <label for="payment_method_expiry_month">Expires on</label>
              <select id="payment_method_expiry_month" name="payment_method[expiry_month]">
								<?php foreach (range(1, 12) as $month): ?>
								<option value="<?php echo $month ?>" <?php echo $paymentMethod->expiryMonth == $month ? 'selected' : '' ?>><?php echo sprintf('%02d', $month) ?></option>
								<?php endforeach; ?>
              </select>
              <select id="payment_method_expiry_year" name="payment_method[expiry_year]">
								<?php foreach (range(2011, 2016) as $year): ?>
								<option value="<?php echo $year ?>" <?php echo $paymentMethod->expiryYear == $year ? 'selected' : '' ?>><?php echo $year ?></option>
								<?php endforeach; ?>
              </select>
            </div>
          </div>
        </fieldset>

        <button type="submit" class="button">Submit Payment</button>
      </form>
    </div>
  </section>

  <footer>
		<a href="<?php echo PUBLIC_PATH ?>" class="back">Back to the Samurai Weapons</a>
  </footer>
</div>



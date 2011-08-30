<?

  /**
   * Include your samurai credentials
   */
  require_once __DIR__.'/samurai_credentials.php';

  /**
   * $errors will be populated with errors with the input of the credit card form
   * $samurai_payment_method will be populated with a SamuraiPaymentMethod object
   */
  $errors = array();
  $samurai_payment_method = null;

  /**
   * Process the payment_method_token if one is being passed via Samurai redirect
   */
  if ( array_key_exists('payment_method_token',$_GET) )
    require __DIR__.'/process_payment_method.php';

?>
<style type="text/css">
  form { font-size: 18px; }
  fieldset { border: none; }
  label { display: block; margin: 10px 0 5px; }
  input { display: block; border: 1px solid #CCC; padding: 2px 4px; }
  input[type=submit] { margin-top: 15px; background-color: white; font-size: 18px; padding: 2px 6px; }
  label.error { font-weight: bold; color: red; }
  input.error { border: 1px solid red; }
</style>

<form action="https://samurai.feefighters.com/v1/payment_methods" method="POST">
  <fieldset>
    <input name="redirect_url" type="hidden" value="<?= sprintf( 'http%s://%s%s', $_SERVER['REMOTE_ADDR']==443?'s':null, $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'] ); ?>" />
    <input name="merchant_key" type="hidden" value="<?= SAMURAI_MERCHANT_KEY; ?>" />

    <!-- Before populating the custom parameter, remember to escape reserved xml characters 
         like <, > and & into their safe counterparts like &lt;, &gt; and &amp; -->
    <input name="custom" type="hidden" value="" />

    <label for="credit_card_first_name">First name</label>
    <input id="credit_card_first_name" name="credit_card[first_name]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getFirstName() : null; ?>" />

    <label for="credit_card_last_name">Last name</label>
    <input id="credit_card_last_name" name="credit_card[last_name]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getLastName() : null; ?>" />

    <label for="credit_card_address_1">Address 1</label>
    <input id="credit_card_address_1" name="credit_card[address_1]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getAddress1() : null; ?>" />

    <label for="credit_card_address_2">Address 2</label>
    <input id="credit_card_address_2" name="credit_card[address_2]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getAddress2() : null; ?>" />

    <label for="credit_card_city">City</label>
    <input id="credit_card_city" name="credit_card[city]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getCity() : null; ?>" />

    <label for="credit_card_state">State</label>
    <input id="credit_card_state" name="credit_card[state]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getState() : null; ?>" />

    <label for="credit_card_zip">Zip</label>
    <input id="credit_card_zip" name="credit_card[zip]" type="text" value="<?= $samurai_payment_method ? $samurai_payment_method->getZip() : null; ?>" />

    <label for="credit_card_card_type">Card Type</label>
    <select id="credit_card_card_type" name="credit_card[card_type]">
      <option></option>
      <option value="visa" <?= $samurai_payment_method && $samurai_payment_method->getCardType() == 'visa' ? 'selected="selected"' : null; ?>>Visa</option>
      <option value="master"<?= $samurai_payment_method && $samurai_payment_method->getCardType() == 'master' ? 'selected="selected"' : null; ?>>MasterCard</option>
    </select>

    <label for="credit_card_card_number" class="<?= array_key_exists('card_number',$errors) ? 'error' : null; ?>">Card Number</label>
    <input id="credit_card_card_number" name="credit_card[card_number]" type="text" class="<?= array_key_exists('card_number',$errors) ? 'error' : null; ?>" value="4111111111111111" />

    <label for="credit_card_verification_value" class="<?= array_key_exists('cvv',$errors) ? 'error' : null; ?>">Security Code</label>
    <input id="credit_card_verification_value" name="credit_card[cvv]" type="text" class="<?= array_key_exists('cvv',$errors) ? 'error' : null; ?>" value="123" />

    <label for="credit_card_month">Expiration Month</label>
    <? $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ); ?>
    <select name="credit_card[expiry_month]">
      <option></option>
    <? foreach ( $months as $i => $month ): $i++; ?>
      <option value="<?= $i; ?>" <?= $samurai_payment_method && $samurai_payment_method->getExpiryMonth() == $i ? 'selected="selected"' : null; ?>><? printf('%02d',$i); ?>. <?= $month; ?></option>
    <? endforeach; ?>
    </select>

    <label for="credit_card_month">Expiration Year</label>
    <select name="credit_card[expiry_year]">
      <option></option>
    <? $last = date( 'Y' ) + 10; ?>
    <? for ( $year=date('Y'); $year<$last; $year++ ): ?>
      <option value="<?= $year; ?>" <?= $samurai_payment_method && $samurai_payment_method->getExpiryYear() == $year ? 'selected="selected"' : null; ?>><?= $year; ?></option>
    <? endfor; ?>
    </select>

    <input type="submit" value="Submit Payment" />
  </fieldset>
</form>

<?php

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
<!doctype html>
<html>
  <head>
    <style type="text/css">
      body { font: 16px/1.5 sans-serif; padding: 40px; }
      fieldset { border: none; padding: 0; }
      label { display: block; margin: 10px 0 5px; }
      input[type=text], input[type=password] { padding: 4px 4px; }
      input[type=submit] { margin-top: 15px; font-size: 18px; padding: 4px 6px; }
      label.error { font-weight: bold; color: red; }
      input.error { border: 1px solid red; }
      p.success { color: green; background: #DFF2BF; border: 1px solid green; padding: 10px; }
      p.error { color: #D8000C; background: #FFBABA; border: 1px solid #D8000C; padding: 10px; }
    </style>
  </head>
  <body>
    <form action="https://api.samurai.feefighters.com/v1/payment_methods" method="POST">
      <fieldset>
        <input name="redirect_url" type="hidden" value="<?php echo sprintf( 'http%s://%s%s', $_SERVER['REMOTE_ADDR']==443?'s':null, $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'] ); ?>">
        <input name="merchant_key" type="hidden" value="<?php echo SAMURAI_MERCHANT_KEY; ?>">
        <input name="sandbox" type="hidden" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getSandbox() : 'true'; ?>">

        <!-- Before populating the custom parameter, remember to escape reserved xml characters 
             like <, > and & into their safe counterparts like &lt;, &gt; and &amp; -->
        <input name="custom" type="hidden" value="" />

        <label for="credit_card_first_name">First name</label>
        <input id="credit_card_first_name" name="credit_card[first_name]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getFirstName() : null; ?>" autofocus>

        <label for="credit_card_last_name">Last name</label>
        <input id="credit_card_last_name" name="credit_card[last_name]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getLastName() : null; ?>">

        <label for="credit_card_address_1">Address 1</label>
        <input id="credit_card_address_1" name="credit_card[address_1]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getAddress1() : null; ?>">

        <label for="credit_card_address_2">Address 2</label>
        <input id="credit_card_address_2" name="credit_card[address_2]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getAddress2() : null; ?>">

        <label for="credit_card_city">City</label>
        <input id="credit_card_city" name="credit_card[city]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getCity() : null; ?>">

        <label for="credit_card_state">State</label>
        <input id="credit_card_state" name="credit_card[state]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getState() : null; ?>">

        <label for="credit_card_zip">Zip</label>
        <input id="credit_card_zip" name="credit_card[zip]" type="text" value="<?php echo $samurai_payment_method ? $samurai_payment_method->getZip() : null; ?>">

        <label for="credit_card_card_number" class="<?php echo array_key_exists('card_number',$errors) ? 'error' : null; ?>">Card Number</label>
        <input id="credit_card_card_number" name="credit_card[card_number]" type="text" class="<?php echo array_key_exists('card_number',$errors) ? 'error' : null; ?>" value="4111111111111111">

        <label for="credit_card_verification_value" class="<?php echo array_key_exists('cvv',$errors) ? 'error' : null; ?>">Security Code</label>
        <input id="credit_card_verification_value" name="credit_card[cvv]" type="text" class="<?php echo array_key_exists('cvv',$errors) ? 'error' : null; ?>" value="123">

        <label for="credit_card_expiry_month">Expiration date</label>
        <?php $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ); ?>
        <select name="credit_card[expiry_month]" id="credit_card_expiry_month">
        <?php foreach ( $months as $i => $month ): $i++; ?>
          <option value="<?php echo $i; ?>" <?php echo $samurai_payment_method && $samurai_payment_method->getExpiryMonth() == $i ? 'selected="selected"' : null; ?>><?php printf('%02d',$i); ?> - <?php echo $month; ?></option>
        <?php endforeach; ?>
        </select>

        <select name="credit_card[expiry_year]">
        <?php $last = date( 'Y' ) + 10; ?>
        <?php for ( $year=date('Y'); $year<$last; $year++ ): ?>
          <option value="<?php echo $year; ?>" <?php echo $samurai_payment_method && $samurai_payment_method->getExpiryYear() == $year ? 'selected="selected"' : null; ?>><?php echo $year; ?></option>
        <?php endfor; ?>
        </select>
      </fieldset>
      <input type="submit" value="Submit Payment">
    </form>
  </body>
</html>

<?php 
// Content for <head> --------------------------------------------------
// The following HTML code will get appended to the <head> of the layout 
// template we're using for this example.
ob_start(); ?>
  <script type="text/javascript" src="https://samurai.feefighters.com/assets/api/samurai.js"></script>
  <script type="text/javascript">
  // Initialize Samurai.js.
  Samurai.init({
		merchant_key: '<?php echo Samurai::$merchantKey ?>',
    debug: true
  });

  (function($) {
    // On DOMReady:
    $(function() { 

      // Bind to the 'payment' event, which lets you know when a payment_method
      // has been created and gives you a payment_method_token to use in the transaction
      Samurai.on('form', 'payment', function(event, data) {

        // Send the payment_method to the server and let it create the transaction
        $.post('purchase.php', data.payment_method, function(data) {
          // Parse the transaction response JSON and convert it to an object
          var transaction = typeof data === 'string' ? $.parseJSON(data).transaction : data.transaction;

          if(transaction.success) {
            // Update the page to display the results
            Samurai.trigger('form', 'completed');
						window.location = 'receipt.php';
          } else {
            // Let the error handler scan the response object for errors,
            // then display these errors
            Samurai.PaymentErrorHandler.forForm($('form').get(0)).handleErrorsFromResponse(transaction);
          }
        });
      });    

    });
  })(Samurai.jQuery);
  </script>
<?php 
$_head = ob_get_clean(); 
// End of content for <head> -------------------------------------------
?>

<div id="content" class="wrapper payment-form">
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
					<td><img src="<?php echo PUBLIC_PATH ?>/images/katana-sword.jpg" width="40" height="40" class="left cleaner">Samurai.js Katana Sword</td>
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
    <div class="samurai" data-samurai-payment-form></div>
  </section>

  <footer>
		<a href="<?php echo PUBLIC_PATH ?>" class="back">Back to the Samurai Weapons</a>
  </footer>
</div>

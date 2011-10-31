<?php

  try {

    /**
     * Include the Samurai library and initialize required settings
     */
    require_once SAMURAI_LIB_DIRECTORY.'/Samurai.php';

    /**
     * Retrive the associated payment method by token
     */
    $payment_method_token = $_GET['payment_method_token'];
    $samurai_payment_method = SamuraiPaymentMethod::fetchByToken( $payment_method_token, $samurai_response );

    if ( $samurai_payment_method->getIsSensitiveDataValid() ) {

      /**
       * The the sensitive data is valid, then a valid payment method has been stored
       */
      printf( '<p class="success">Successful payment method: %s</p>', $samurai_payment_method->getToken() );

      /**
       * Call retain on the payment method to store it in Samurai's vault
       *
       * $samurai_response = $samurai_payment_method->retain();
       */
     
      /**
       * Call redact on the payment method to store it in Samurai's vault
       *
       * $samurai_response = $samurai_payment_method->redact();
       */
     
      /**
       * Create a transaction
       */
      $samurai_transaction = new SamuraiTransaction();
      $samurai_transaction->setAmount( 20.00 );
      $samurai_transaction->setCurrencyCode( 'USD' );
      $samurai_transaction->setPaymentMethodToken( $samurai_payment_method->getToken() );

      /**
       * Optional values
       *
       * $samurai_transaction->setDescriptor( $descriptor );
       * $samurai_transaction->setCustom( $custom );
       */

      $samurai_processor = new SamuraiProcessor( SAMURAI_PROCESSOR_TOKEN );

      /**
       * Example of a simple purchase
       */
      $samurai_response = $samurai_transaction->purchase( $samurai_processor );
      
      /**
       * Example of an authorization + capture
       *
       * $samurai_response = $samurai_transaction->authorize( $samurai_processor );
       *
       * $samurai_transaction->setAmount( 18.00 );
       * $samurai_response = $samurai_transaction->capture();
       */

      /**
       * Example of voiding a transaction
       *
       * $samurai_response = $samurai_transaction->void();
       */        

    } else {

      /*
       * If the sensitive data is not valid, you will need to retrieve the problematic fields
       *  and indicate to the user that a problem needs to be fixed
       */

      $samurai_messages = $samurai_response->getMessages();

      foreach ( $samurai_messages as $samurai_message ) {

        if ( $samurai_message->getContextCategory() == 'input' ) {

          /**
           * If the context starts with 'input.' it is recommended to highlight the field to alert the customer
           */
          if ( ! array_key_exists($samurai_message->getContextType(),$errors) )
            $errors[ $samurai_message->getContextType() ] = array();
          $errors[ $samurai_message->getContextType() ][] = $samurai_message->getKey();

        }

      }

    }

  } catch ( SamuraiException $e ) {

    printf( "<p class='error'>Caught Samurai Exception: %s<br>", $e->getMessage() );
    $samurai_messages = $e->getSamuraiMessages();
    foreach ( $samurai_messages as $i => $samurai_message )
      printf( "<strong>%d.</strong> %s [ %s / %s / %s ]<br>", $i+1, $samurai_message->getMessage(), $samurai_message->getClass(), $samurai_message->getContext(), $samurai_message->getKey() );

    echo '</p>';
    /**
     * It is recommended that you log this error as something wrong has occurred.
     */

  }

?>

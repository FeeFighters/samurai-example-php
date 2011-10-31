Samurai
=======

This is an example application using the [Samurai PHP client library](https://github.com/FeeFighters/samurai-client-php).

Installation
------------

Install the Samurai example app by doing the following:

    git clone git@github.com:FeeFighters/samurai-client-php.git
    git clone git@github.com:FeeFighters/samurai-example-php.git

Otherwise, download the .tar.gz or .zip archives

Configuration
-------------

You need to tell the client library what your Samurai keys are by defining constants:
Edit the samurai_credentials.php file in the client-example-php folder.

    <?php
      define( 'SAMURAI_PROCESSOR_TOKEN',    'CHANGE TO YOUR PROCESSOR TOKEN' );
      define( 'SAMURAI_MERCHANT_KEY',       'CHANGE TO YOUR MERCHANT KEY' );
      define( 'SAMURAI_MERCHANT_PASSWORD',  'CHANGE TO YOUR MERCHANT PASSWORD' );
      define( 'SAMURAI_LIB_DIRECTORY',      dirname(__DIR__).'/samurai-client-php' );
    ?>

Test Credit Cards
---------------

You can use any of the following test cards to test the example app:

    4111111111111111
    6011000000000012

The CVV can be any 3 or 4 digit number

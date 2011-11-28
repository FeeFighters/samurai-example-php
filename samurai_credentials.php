<?php
	define( 'SAMURAI_LIB_DIRECTORY', dirname(__DIR__).'/samurai-client-php' );

	require_once SAMURAI_LIB_DIRECTORY.'/lib/Samurai.php';

	define( 'SAMURAI_PROCESSOR_TOKEN', 'SAMURAI_PROCESSOR_TOKEN' );
	define( 'SAMURAI_MERCHANT_KEY', 'SAMURAI_MERCHANT_KEY' );
	define( 'SAMURAI_MERCHANT_PASSWORD', 'SAMURAI_MERCHANT_PASSWORD' );

	Samurai::setup(array(
	    'merchantKey'      => SAMURAI_MERCHANT_KEY,
	    'merchantPassword' => SAMURAI_MERCHANT_PASSWORD,
	    'processorToken'   => SAMURAI_PROCESSOR_TOKEN
	));


?>

<?

  define( 'SAMURAI_PROCESSOR_TOKEN', 'CHANGE TO YOUR PROCESSOR TOKEN' );
  define( 'SAMURAI_MERCHANT_KEY', 'CHANGE TO YOUR MERCHANT KEY' );
  define( 'SAMURAI_MERCHANT_PASSWORD', 'CHANGE TO YOUR MERCHANT PASSWORD' );

  define( 'SAMURAI_LIB_DIRECTORY', dirname(__DIR__).'/samurai-client-php' );

  if ( SAMURAI_PROCESSOR_TOKEN == 'CHANGE TO YOUR PROCESSOR TOKEN' )
    die( 'You need to change the samurai configuration variables in samurai_credentials.php' );

?>

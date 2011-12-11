<!DOCTYPE html>
<html>
  <head>
    <title>Samurai Weapons Store</title>
		<link rel="stylesheet" href="<?php echo PUBLIC_PATH ?>/stylesheets/application.css">   
		<?php echo (isset($_head) ? $_head : '') ?>
  </head>
  <body>
    <header id="samurai-branding">
      <div class="wrapper">
        <hgroup>
          <h1 class="logo"><a href="https://samurai.feefighters.com">Samurai by FeeFighters</a></h1>
          <h2 class="subtitle"><span class="separator">/</span> Demo App</h2>
        </hgroup>

        <a href="https://samurai.feefighters.com/developers/php" class="developers-link"><span class="icon"></span>Developer Resources</a>
        <div class="language">
          <ul class="choices">
            <li><a href="http://examples.samurai.feefighters.com/rails">Rails</a></li>
            <li><a href="http://examples.samurai.feefighters.com/python">Python</a></li>
            <li><a href="http://examples.samurai.feefighters.com/java">Java</a></li>
            <li><a href="http://examples.samurai.feefighters.com/nodejs">Node.js</a></li>
            <li><a href="http://examples.samurai.feefighters.com/dotnet">.NET</a></li>
            <li><a href="http://examples.samurai.feefighters.com/sinatra">Sinatra</a></li>
          </ul>
          <a class="current" href="http://examples.samurai.feefighters.com/php">PHP</a>
        </div>
      </div>
    </header>

    <header id="banner">
      <h1>Samurai Weapons</h1>
    </header>

		<?php echo (isset($_body) ? $_body : '') ?>
  </body>
</html>


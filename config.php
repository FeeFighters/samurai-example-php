<?php

define('ROOT_PATH', dirname(__FILE__));
define('VIEW_PATH', ROOT_PATH . '/views');
define('PUBLIC_PATH', determinePublicPath());

require_once ROOT_PATH . '/../samurai-client-php/lib/Samurai.php';

Samurai::setup(array(
  'sandbox'          => true,
  'merchantKey'      => 'a1ebafb6da5238fb8a3ac9f6',
  'merchantPassword' => 'ae1aa640f6b735c4730fbb56',
  'processorToken'   => '5a0e1ca1e5a11a2997bbf912'
));

function debug($var) {
	echo '<pre>' . print_r($var, true) . '</pre>';
}

function render($view, $vars = array()) {
	if (is_array($vars)) {
		extract($vars);
	}

	ob_start();
	include_once VIEW_PATH . '/' . $view . '.php';
	$_body = ob_get_clean();

	include_once VIEW_PATH . '/layout.php';
}

function redirect($path, $query='') {
	header('Location: ' . urlFor($path, false, $query));
}

function urlFor($path, $full = false, $query = '') {
	$url = ($full ? 'http://' . $_SERVER['SERVER_NAME'] : '') . PUBLIC_PATH . '/' . $path . '.php';
	if (!empty($query)) {
		$url .= '?' . $query;
	}

	return $url;
}

function determinePublicPath() {
	$scriptPath = realpath($_SERVER['SCRIPT_FILENAME']);
	$configPath = realpath(dirname(__FILE__));
	$requestPath = str_replace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
	$scriptRelativePath = str_replace($configPath, '', $scriptPath);

	$publicPath = str_replace($scriptRelativePath, '', $requestPath);
	return $publicPath;
}

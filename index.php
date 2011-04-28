<?php
namespace Shmvc;

function bootstrap() {
	$config = array();
	
	// file path on the server
	define('PATH_ROOT', 		dirname(__FILE__));						

	// path from the document root (eg "projects/wearebase.com" or "") to this index.php page
	define('SITE_DIR', 			str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));	
	// full URL of homepage (without 'http://')
	define('SITE_URL', 			$_SERVER['HTTP_HOST'] . SITE_DIR);

	// path of current page to the site root
	define('URI', 	ltrim($_SERVER['REQUEST_URI'], '/'));	


	// put some constants in $config so they can go into templates easily
	$config['site_dir'] = 		SITE_DIR;

	error_reporting(E_ALL);
	
	return $config;
}

function autoload($classname) {
  $classname = ltrim($classname, '\\');
  $filename  = '';
  $namespace = '';
  if ($lastnspos = strripos($classname, '\\')) {
    $namespace = substr($classname, 0, $lastnspos);
    $classname = substr($classname, $lastnspos + 1);
    $filename  = str_replace('\\', '/', $namespace) . '/';
  }
  $filename .= str_replace('_', '/', $classname) . '.php';
  $filename = PATH_ROOT . '/' . $filename;
  if (file_exists($filename)) {
    require $filename;
  }
}

spl_autoload_register('Shmvc\autoload');


function config($k = null, $v = null) {
	static $config;
	if (!is_array($config)) {
		$config = bootstrap();
	}
	if (!$k) {
		return;
	}
	if ($v !== null) {
		$config[$k] = $v;
	}
	return $config[$k];
}
config();

$GLOBALS['actions'] = array();
$GLOBALS['filters'] = array();

function add_action($name, $fn) {
	$GLOBALS['actions'][$name][] = $fn;
}

function add_filter($name, $fn) {
	$GLOBALS['filters'][$name][] = $fn;
}

function do_action($name) {
	if (empty($GLOBALS['actions'][$name])) {
		return;
	}

	foreach ($GLOBALS['actions'][$name] as $fn) {
		call_user_func($fn);
	}
}

function do_filter($name, $variable) {
	// TODO: implement
	return $variable;
}

function load_plugins() {
	$files = glob(PATH_ROOT . '/plugins/*.php');
	sort($files);
	foreach ($files as $file) {
		@include $file;
	}
}
load_plugins();

do_action('plugins_loaded');

function route() {
	$uri = URI;
	$routes = require_once PATH_ROOT . '/config/routes.php';
	$routes = do_filter('routes', $routes);
	foreach ($routes as $k => $v) {
		if (preg_match('~' . $k . '~', URI)) {
			$uri = preg_replace('~' . $k . '~', $v, URI);
			break;
		}
	}
	return $uri;
}

define ('ROUTE', route());

function find_class($ns, $class) {
	$class = ltrim($class, '\\');
	$ns = rtrim($ns, '\\');
	$full_class = preg_replace('~(\\\\)+~', '\\', $ns . '\\' . $class);

	while (!class_exists($full_class)) {
		if (strlen($ns)) {
			$ns_a = explode('\\', $ns);
			array_pop($ns_a);
			$ns = implode('\\', $ns_a);
			$full_class = preg_replace('~(\\\\)+~', '\\', $ns . '\\' . $class);
		} else {
			return null;
		}
	}

	return $full_class;
}

function dispatch($route) {
	@list($ns, $params) = explode('(', $route);
	$ns = '\App\\' . str_replace(' ', '\\', ucwords(str_replace('/', ' ', $ns)));
	$class = find_class($ns, '\Controller');
	
	if (empty($class)) {
		$class = '\Shmvc\Controller';
	}

	$params = @explode(',', $params);
	foreach ($params as &$param) {
		$param = trim($param, ' (),');
	}

	$reflection = new \ReflectionClass($class);
	return $reflection->newInstanceArgs($params);
}

$object = dispatch(ROUTE);

do_action('end');

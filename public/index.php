<?php

error_reporting(E_ALL);

session_start();

require_once '../system/core/functions.php';
require_once '../vendor/autoload.php';

use system\core\Router;
use Intervention\Image\ImageManager;

$qStr = $_SERVER['QUERY_STRING'];

/**
 * тоже самое что и ../
 */
define("ROOT", dirname(__DIR__));
define('LAYOUT', 'default');

//spl_autoload_register(function ($className){
//    $className = ROOT .'/'. str_replace('\\', '/', $className) . '.php';
//
//    if(file_exists($className)) include $className;
//});



//Router::add(['^(?P<controller>[a-z0-9-]+)/(?P<action>[a-z0-9-]+)/(?P<alias>[a-z0-9-]+)$' => []]);

Router::add(['^news/view/(?P<id>[0-9]+)/?$' => ['controller' => 'News', 'action' => 'view']]);
//Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?/(?P<id>[0-9]+)/?$' => ['controller' => 'News', 'action' => 'view']]);

/**
 * default admin
 */
Router::add(['^admin$' => ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin\\']]);
Router::add(['^admin/(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => ['prefix' => 'admin\\']]);


/**
 * default rules
 */
Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);


Router::dispatch($qStr);

//pr(\system\core\DB::$queries);

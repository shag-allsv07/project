<?php
error_reporting(E_ALL);

require_once '../system/core/functions.php';

use system\core\Router;

$qStr = $_SERVER['QUERY_STRING'];

/**
 * тоже самое что и ../
 */
define("ROOT", dirname(__DIR__));
define('LAYOUT', 'default');

spl_autoload_register(function ($className){
    $className = ROOT .'/'. str_replace('\\', '/', $className) . '.php';

    if(file_exists($className)) include $className;
});

//Router::add(['^(?P<controller>[a-z0-9-]+)/(?P<action>[a-z0-9-]+)/(?P<alias>[a-z0-9-]+)$' => []]);

Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);


Router::dispatch($qStr);

pr(\system\core\DB::$queries);

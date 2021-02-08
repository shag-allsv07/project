<?php
namespace system\core;

class Router
{
    /**
     * @var array  - таблица маршрутов
     */
    public static $routers = [];
    /**
     * @var array - маршрут
     */
    public static $rout = [];


    /**
     * Метод добавляет маршрут в таблицу маршрутов
     * @param $route - маршрут
     */
    public static function add($route)
    {
        foreach ($route as $key => $value){
            self::$routers[$key] = $value;
        }

    }

    /**
     * Метод проверяет совпадение с таблицей маршрутов
     * @param $url - адресная строка
     * @return bool
     */
    public static function checkRoute($url)
    {
        $url = self::removeQueryString($url);

        foreach (self::$routers as $key => $value){
            if (preg_match("#$key#i", $url, $matches)){
                //pr(self::$routers[$key]);
                $route = $value;

                foreach ($matches as $key => $match){
                    if (is_string($key)){
                        $route[$key] = $match;
                    }
                }

                $route['controller'] = self::uStr($route['controller']);

                if(!isset($route['action'])){
                    $route['action'] = 'index';
                }

                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                }
                //pr($route);
                self::$rout = $route;

                return true;
            }
        }

        return false;
    }


    public static function dispatch($path)
    {
        if (self::checkRoute($path)){
            $controller = 'app\controllers\\' . self::$rout['prefix'] . self::$rout['controller'] . 'Controller';

            if(class_exists($controller)){
                $obj = new $controller(self::$rout);
                $action = self::lStr(self::$rout['action']) . 'Action';

                if(method_exists($obj, $action)){
                    $obj->$action();
                    $obj->getView();
                }
                else {
                    echo 'Метод ' .$action. ' не найден';
                }
            }
            else {
                echo 'Контроллер ' .$controller. ' не найден';
            }
        }
        else {
            http_response_code(404);
            include '404.html';
        }
    }

    /**
     * @param $str
     * @return string|string[]
     */
    private static function uStr($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);

        return $str;
    }

    /**
     * метод приводит в нижний регистр первую букву строки
     * @param $str
     * @return string
     */
    private static function lStr($str)
    {
        return lcfirst(self::uStr($str));
    }

    /**
     * Метод удаляет из строки явные get параметры (?Page=1&....)
     * @param $url
     * @return mixed|string
     */
    private static function removeQueryString($url)
    {
        if($url != ''){
            $params = explode('&', $url);
            if(strpos($params[0], '=') === false){
                return $params[0];
            }
            else {
                return '';
            }
        }

        return $url;
    }

}
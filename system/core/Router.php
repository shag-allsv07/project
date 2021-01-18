<?php


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
                self::$rout = $route;

                return true;
            }
        }

        return false;
    }


    public static function dispatch($path)
    {
        if (self::checkRoute($path)){
            $controller = 'app\controllers\\' . self::$rout['controller'] . 'Controller';
            if(class_exists($controller)){
                $obj = new $controller;
            }
            else {
                echo 'Контроллер ' .$controller . ' не найден';
            }
        }
        else {
            echo '404';
        }
    }

    private static function uStr($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);

        return $str;
    }

}
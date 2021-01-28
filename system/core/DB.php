<?php


namespace system\core;


class DB
{
    protected $pdo;
    protected static $instance;
    public static $queries = [];

    protected function __construct()
    {
        $db = require ROOT . '/config/db.php';
        $option = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password'], $option);
    }

    public static function instance()
    {
        if (self::$instance === null){
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function exec($sql)
    {
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    /**
     * метод дял получения данных из таблицы \ возвращает массив
     * @param $sql
     * @param array $param
     * @return array
     */
    public function query($sql, $param = [])
    {
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($param);

        if ($res !== false) {
            return $stmt->fetchAll();
        }
        else {
            return [];
        }
    }
}
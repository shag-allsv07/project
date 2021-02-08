<?php


namespace app\models;


use system\core\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     *
     */
    public function auth($login, $password)
    {
        $pass = $this->db->query("SELECT `password` FROM {$this->table} WHERE `login` = ?", [$login]);
        var_dump($pass);
        if (password_verify($password, $pass[0]['password'])) {
            $res = $this->db->query("SELECT * FROM {$this->table} WHERE `login` = ? AND `password` = ?", [$login, $pass]);
            var_dump($res);
            if (!empty($res[0])) {
                return $res[0]['id'];
            }

            return false;
        }
    }

    public function adminLogin($id)
    {
        $res = $this->findOne($id);

        if (!empty($res[0])){
            $_SESSION['user']['login'] = $res[0]['login'];

            if ($res[0]['role'] == 'admin') {
                $_SESSION['is_admin'] = 1;
            }

        }
    }


}
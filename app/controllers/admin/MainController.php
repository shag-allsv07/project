<?php

namespace app\controllers\admin;


use app\models\News;
use app\models\User;

class MainController extends AppController
{
    public function indexAction()
    {
        $news = new News();
        $arNews = $news->findAll();

        $this->setVars(['arNews' => $arNews]);
    }

    public function loginAction()
    {
        $this->layout = 'admin_login';
        $user = new User();

        if (isset($_POST['login'], $_POST['password'])){

            if ($_POST['login'] != '' && $_POST['password'] != '') {
                $id = $user->auth($_POST['login'], $_POST['password']);
                if (false !== $id) {
                    $user->adminLogin($id);
                    header("Location: /admin");
                    die();
                }
                else {
                    $_SESSION['error'] = 'Не верно указаны логин или пароль';
                }
            }
            else {
                $_SESSION['error'] = 'Не указаны логин или пароль';
            }
        }
    }
}
<?php


namespace app\controllers;

use app\models\News;
use system\core\Controller;

class MainController extends Controller
{
    public $layout = 'main';

    public function indexAction()
    {
        $news = new News();
        $arNews = $news->findOne(4);
        pr($arNews);

        $this->view = 'Test';
        $arr = [
            'n1' => 1,
            'n2' => 2
        ];
        $this->setVars(['name' => 'vasya', 'arrArray' => $arr]);
    }

    public function testAction()
    {
        //echo 'Main::test';
    }

    public function check()
    {

    }

}
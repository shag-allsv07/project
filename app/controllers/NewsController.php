<?php


namespace app\controllers;

use app\models\News;
use system\core\Controller;

class NewsController extends Controller
{
    public function viewAction()
    {
        $id = intval($this->route['id']);

        $obgNews = new News();
        $result = $obgNews->findOne($id);

        if (!empty($result)){
            $this->setVars(['new' => $result[0]]);
        }
    }
}
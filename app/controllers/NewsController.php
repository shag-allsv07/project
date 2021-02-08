<?php


namespace app\controllers;

use app\models\News;

class NewsController extends AppController
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
<?php


namespace app\controllers;

use app\models\News;
use system\libs\Pagination;

class MainController extends AppController
{

    public function indexAction()
    {
        $news = new News();

        $page = isset($_GET['page']) > 0 ? (int)$_GET['page'] : 1;
        $perPage = 2;
        $total = $news->count();
        $pagination = new Pagination($page, $perPage, $total);

        $start = $pagination->getStart();
        $arNews = $news->findLimit($start, $perPage);

        // передача в шаблон
        $this->setVars([
            'news' => $arNews,
            'pagination' => $pagination
            ]); 
    }

}
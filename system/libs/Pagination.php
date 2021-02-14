<?php

namespace system\libs;


class Pagination
{
    public $curPage; // текущая страница
    public $perPage; // по сколько записей на страницу
    public $total; // число записей
    public $countPages; // число страниц
    public $uri;

    /**
     * Pagination constructor.
     * @param $page - параметр $_GET['page'] - что идет после ?
     * @param $perPage 
     * @param $total
     * @param $countPages
     * @param $uri
     */
    public function __construct($page, $perPage, $total)
    {
        $this->perPage = $perPage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->curPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    /**
     * получение количества страниц
     */
    public function getCountPages()
    {
        return ceil($this->total / $this->perPage) ?: 1;
    }


    /** 
     * Получение текущей страницы
     */
    public function getCurrentPage($page)
    {
        //$page = intval($page) > 0 ?: 1;
        if($page > $this->countPages){
            $page = $this->countPages;
        }
        return $page;
    }

    /**
     * вычисляет с какой записи выводить
     * @return float|int
     */
    public function getStart()
    {
        return ($this->curPage - 1) * $this->perPage;
    }

    /**
     * получает uri . сохраняет (позволяет не поретяь остальные параметры) параметры в адресной строке
     */
    public function getParams()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $arrUri = explode("?", $uri);
        $uri = $arrUri[0] . "?";
        
        if(isset($uri[1]) && $arrUri[1] != ''){
            $params = explode("&", $arrUri[1]);
            foreach ($params as $param){
                if(!preg_match("/page=/", $param)){
                    $uri .= $param . '&';
                }
            }
        }
        return $uri;
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    /**
     * html код пагинации
     */
    public function getHtml()
    {
        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page1left = null;
        $page2left = null;
        $page1right = null;
        $page2right = null;

        if($this->curPage > 1){
            $back = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->curPage - 1) . '">&lt;</a></li>';
        }

        if($this->curPage < $this->countPages){
            $forward = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->curPage + 1) . '">&gt;</a></li>';
        }

        if($this->curPage > 3){
            $startpage = '<li><a class="nav-link" href="' . $this->uri . 'page=1">&laquo;</a></li>';
        }

        if($this->curPage < ($this->countPages - 2)){
            $endpage = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->countPages) . '">&raquo;</a></li>';
        }

        if($this->curPage + 1 <= $this->countPages){
            $page1right = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->countPages + 1) . '">' . ($this->countPages + 1) . '</a></li>';
        }

        if($this->curPage + 2 <= $this->countPages){
            $page2right = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->countPages + 2) . '">' . ($this->countPages + 2) . '</a></li>';
        }

        if($this->curPage - 1 > $this->countPages){
            $page1left = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->countPages - 1) . '">' . ($this->countPages - 1) . '</a></li>';
        }

        if($this->curPage - 2 > $this->countPages){
            $page2left = '<li><a class="nav-link" href="' . $this->uri . 'page=' . ($this->countPages - 2) . '">' . ($this->countPages - 2) . '</a></li>';
        }

        return '<ul class="pagination">'.
            $startpage.$back.$page2left.$page1left.'<li class="active"><a>'.$this->curPage.'</a></li>'.
            $page1right.$page2right.$forward.$endpage.'</ul>';
    }
}
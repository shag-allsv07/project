<?php


namespace system\core;


abstract class Controller
{
    protected $route;
    protected $layout;
    protected $view;
    public $vars = [];

    public function __construct($route, $view= '')
    {
        $this->route = $route;
        $this->view = $view ?: $route['action'];
    }

    /**
     * для подключения представления
     */
    public function getView()
    {
        $objView = new View($this->route, $this->layout, $this->view);
        $objView->render($this->vars);
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }

}
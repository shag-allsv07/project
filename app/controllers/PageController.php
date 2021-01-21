<?php


namespace app\controllers;


class PageController
{
    public function __construct()
    {
        echo 'PageController';
    }

    public function indexAction()
    {
        echo 'Page::index';
    }

    public function testNewAction()
    {
        echo 'Page::testNew';
    }

    public function testAction()
    {
        echo 'Page::test';
    }
}
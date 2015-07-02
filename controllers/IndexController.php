<?php

namespace app\controllers;

use app\components\Controller;

/**
 * Class IndexController
 * @package app\controllers
 */
class IndexController extends Controller
{
    public function actionIndex()
    {
        $this->render('/index/404');
    }
}

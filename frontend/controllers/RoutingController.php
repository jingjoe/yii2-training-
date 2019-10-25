<?php

namespace frontend\controllers;

use yii\web\Controller;

class RoutingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

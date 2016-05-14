<?php
/**
 * Created by xalbert.einsteinx
 * https://www.einsteinium.pro
 * Date: 13.05.2016
 * Time: 17:15
 */

namespace bl\cms\error\controllers;


use yii\web\Controller;

class ErrorController extends Controller
{
    public function actionIndex() {
        $exception = \Yii::$app->errorHandler->exception;
        return $this->render('index', ['exception' => $exception]);
    }
}
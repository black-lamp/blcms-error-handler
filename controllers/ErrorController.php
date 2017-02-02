<?php
namespace bl\cms\error\controllers;

use yii\helpers\Url;
use yii\web\Controller;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class ErrorController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {

        $exception = \Yii::$app->errorHandler->exception;

        if (\Yii::$app->getModule('error')->sendMail) {
            $this->sendMail($exception);
        }

        return $this->render('index', ['exception' => $exception]);
    }

    private function sendMail($exception)
    {
        \Yii::$app->errorMailer->compose('error-mail', ['exception' => $exception])
            ->setFrom([\Yii::$app->getModule('error')->webmasterEmail => \Yii::$app->name ?? Url::to(['/'], true)])
            ->setTo('xalbert.einsteinx@gmail.com')
            ->setSubject($exception->getMessage())
            ->send();

    }

}
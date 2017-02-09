<?php
namespace bl\cms\error\controllers;

use bl\cms\error\ErrorMailForm;
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
        $params = ['exception' => $exception];

        if (\Yii::$app->getModule('error')->sendMailAutomatically) {

            $mailBody = '<p>' . $exception->getMessage() . '</p>
                            <p>' . Url::to(\Yii::$app->request->url, true) . '</p>';
            $this->sendMail($mailBody);
        }
        if (\Yii::$app->getModule('error')->enableUserMessageSending) {
            $errorMailForm = new ErrorMailForm();
            $params['errorMailForm'] = $errorMailForm;
        }


        return $this->render('index', $params);
    }


    public function actionReportError()
    {
        if (\Yii::$app->request->isPost && \Yii::$app->getModule('error')->enableUserMessageSending) {
            $errorMailForm = new ErrorMailForm();
            if ($errorMailForm->load(\Yii::$app->request->post())) {

                $mailBody = '<p>' . $errorMailForm->message . '</p>
                            <p>' . \Yii::t('modules/errorhandler/main', 'URL') . ': ' . Url::to($errorMailForm->url, true) . '</p>
                            <p>' . \Yii::t('modules/errorhandler/main', 'Reporter') . ': ' . $errorMailForm->email . '</p>';
                $this->sendMail($mailBody);

                \Yii::$app->session->setFlash('info', \Yii::t('modules/errorhandler/main', 'Your error report has sent successfully'));

            }
        }

        return $this->redirect(Url::to(['/']));
    }

    private function sendMail($mailBody)
    {

        \Yii::$app->errorMailer->compose()
            ->setFrom([\Yii::$app->getModule('error')->webmasterEmail => \Yii::$app->name ?? Url::to(['/'], true)])
            ->setTo(\Yii::$app->getModule('error')->webmasterEmail)
            ->setSubject(\Yii::t('modules/errorhandler/main', 'Error reporting'))
            ->setHtmlBody($mailBody)
            ->send();

    }


}
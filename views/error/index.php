<?php
/**
 * @var $errorMailForm \bl\cms\error\ErrorMailForm
 * @var $exception \yii\web\HttpException
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

if ($exception) {
    $this->title = $exception->getMessage();
} else {
    $this->title = Yii::t('modules/errorhandler/main', 'Unknown error');
}
?>

<div class="error-page">
    <?php if (!empty($exception)) : ?>
        <h1 class="error-code text-center"><?= $exception->statusCode ?></h1><br>
        <h2 class="error-message text-center"><?= $exception->getMessage() ?></h2><br>
    <?php else : ?>
        <h1 class="error-message"><?= Yii::t('modules/errorhandler/main', 'Unknown error'); ?></h1><br>
    <?php endif; ?>


    <?php if (\Yii::$app->getModule('error')->sendMailAutomatically) : ?>
        <!--ERROR MESSAGE-->
        <p class="text-center">
            <?= Yii::t('modules/errorhandler/main', \Yii::$app->getModule('error')->errorMessage); ?>
        </p>
    <?php endif; ?>
    <div class="row">
        <!--WEBMASTER EMAIL-->
        <?php if (!empty(\Yii::$app->getModule('error')->webmasterEmail)): ?>
            <p class="text-center">
                <?= Yii::t('modules/errorhandler/main', 'You can contact the site administrator for more information at'); ?>
                <a href="mailto:<?= \Yii::$app->getModule('error')->webmasterEmail; ?>">
                    <?= \Yii::$app->getModule('error')->webmasterEmail; ?>
                </a>
            </p>
        <?php endif; ?>
    </div>


    <div class="row">

        <?php if (\Yii::$app->getModule('error')->enableUserMessageSending) : ?>
            <!--ERROR REPORTING-->
            <?php $errorForm = ActiveForm::begin([
                'action' => Url::to(['/error/error/report-error'])
            ]); ?>

            <div class="col-md-4 col-md-offset-4">
                <?= $errorForm->field($errorMailForm, 'url')
                    ->hiddenInput(['value' => Url::to(\Yii::$app->request->url, true)])->label(false); ?>
                <?= $errorForm->field($errorMailForm, 'message')
                    ->hiddenInput(['value' => $exception->getMessage()])->label(false); ?>
                <?= $errorForm->field($errorMailForm, 'email')
                    ->textInput(['placeholder' => \Yii::t('modules/errorhandler/main', 'Your email')])
                    ->label(false); ?>
            </div>

            <?= Html::submitButton(\Yii::t('modules/errorhandler/main', 'Report an error'),[
                'class' => 'btn btn-warning col-md-2 col-md-offset-5 m-b-md'
            ]); ?>
            <?php $errorForm::end(); ?>
        <?php endif; ?>

        <!--BACK-->
        <?php if (Yii::$app->request->getReferrer()): ?>
            <a class="btn btn-primary" href="<?= Yii::$app->request->getReferrer() ?>">
                <?= Yii::t('modules/errorhandler/main', 'Back'); ?>
            </a>
        <?php else: ?>
            <a class="btn btn-primary col-md-2 col-md-offset-5"
               href="<?= Url::to(['/']);?>"><?= Yii::t('modules/errorhandler/main', 'Home'); ?></a>
        <?php endif; ?>

    </div>

</div>




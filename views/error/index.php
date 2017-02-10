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

    <!--ERROR MESSAGE-->
    <p class="text-center">
        <?= Yii::t('modules/errorhandler/main', \Yii::$app->getModule('error')->errorMessage); ?>
    </p>

    <!--WEBMASTER EMAIL-->
    <?php if (!empty(\Yii::$app->getModule('error')->webmasterEmail)): ?>
        <p class="text-center">
            <?= Yii::t('modules/errorhandler/main', 'You can contact the site administrator for more information at'); ?>
            <a href="mailto:<?= \Yii::$app->getModule('error')->webmasterEmail; ?>">
                <?= \Yii::$app->getModule('error')->webmasterEmail; ?>
            </a>
        </p>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <?php if (\Yii::$app->getModule('error')->enableUserMessageSending) : ?>
                <div class="row">

                    <p><?= \Yii::t('modules/errorhandler/main', 'Send information about errors in the technical support department.');?></p>

                    <!--ERROR REPORTING-->
                    <?php $errorForm = ActiveForm::begin([
                        'action' => Url::to(['/error/error/report-error']),
                    ]); ?>

                    <div class="col-md-12">
                        <?= $errorForm->field($errorMailForm, 'url')
                            ->hiddenInput(['value' => Url::to(\Yii::$app->request->url, true)])->label(false); ?>
                        <?= $errorForm->field($errorMailForm, 'message')
                            ->hiddenInput(['value' => $exception->getMessage()])->label(false); ?>
                        <?= $errorForm->field($errorMailForm, 'email')
                            ->textInput(['placeholder' => \Yii::t('modules/errorhandler/main', 'Your email')])
                            ->label(false); ?>

                        <?= Html::submitButton(\Yii::t('modules/errorhandler/main', 'Report an error'), [
                            'class' => 'btn btn-warning'
                        ]); ?>
                    </div>
                    <?php $errorForm::end(); ?>
                </div>
            <?php endif; ?>

            <!--BACK-->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <?php if (Yii::$app->request->getReferrer()): ?>
                        <a class="btn btn-primary" href="<?= Yii::$app->request->getReferrer() ?>">
                            <?= Yii::t('modules/errorhandler/main', 'Back'); ?>
                        </a>
                    <?php else: ?>
                        <a class="btn btn-primary col-md-12"
                           href="<?= Url::to(['/']); ?>"><?= Yii::t('modules/errorhandler/main', 'Home'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>




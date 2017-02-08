<?php
/* @var $exception \yii\web\HttpException */

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

    <?php if (Yii::$app->request->getReferrer()): ?>
        <a class="btn btn-primary" href="<?= Yii::$app->request->getReferrer() ?>">
            <?= Yii::t('modules/errorhandler/main', 'Back'); ?>
        </a>
    <?php else: ?>
        <a class="btn btn-primary col-md-2 col-md-offset-5" href="/"><?= Yii::t('modules/errorhandler/main', 'Home'); ?></a>
    <?php endif; ?>
</div>




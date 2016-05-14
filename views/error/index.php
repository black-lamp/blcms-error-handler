<?
use yii\helpers\Url;

/* @var $exception \yii\web\HttpException */
?>

<div class="error-page">
    <? if ($exception) : ?>
        <span class="error-code"><?= $exception->statusCode ?></span><br>
        <span class="error-message"><?= $exception->getMessage() ?></span><br>
    <? else : ?>
        <span class="error-message"><?=Yii::t('modules/errorhandler/main', 'Unknown error'); ?></span><br>
    <? endif; ?>

    <? if (Yii::$app->request->getReferrer()): ?>
        <a class="btn btn-primary" href="<?= Yii::$app->request->getReferrer() ?>"><?=Yii::t('modules/errorhandler/main', 'Back'); ?></a>
    <? else: ?>
        <a class="btn btn-primary" href="/"><?=Yii::t('modules/errorhandler/main', 'Home'); ?></a>
    <? endif; ?>
</div>




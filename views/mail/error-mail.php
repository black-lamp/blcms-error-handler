<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $exception \yii\web\HttpException
 */

?>

<h1 class="error-code text-center"><?= $exception->statusCode ?></h1><br>
<h2 class="error-message text-center"><?= $exception->getMessage() ?></h2><br>
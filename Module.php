<?php
/**
 * Created by xalbert.einsteinx
 * https://www.einsteinium.pro
 * Date: 13.05.2016
 * Time: 17:12
 */

namespace bl\cms\error;

use Yii;

class Module extends \yii\base\Module
{

    /**
     * @var string
     */
    public $webmasterEmail;

    /**
     * If true on error mail will be send.
     * @var bool
     */
    public $sendMail = false;

    /**
     * @var string
     */
    public $errorMessage = 'Unfortunately, this page is not available. Error information has been sent to the site administrator.';

    public function init()
    {
        $this->registerTranslations();
        parent::init();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/errorhandler/*'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath'       => '@vendor/black-lamp/blcms-error-handler/messages',
            'fileMap'        => [
                'modules/errorhandler/main' => 'main.php'
            ]
        ];
    }
}
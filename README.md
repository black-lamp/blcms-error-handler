# blcms-error-handler
Error hadler module for Black-Lamp CMS


Installation
------------
#### Run command
```
composer require black-lamp/blcms-error-handler
```
or add

```json
"black-lamp/blcms-error-handler": "0.*"
```

to the require section of your composer.json.


#### Add module to frontend application config

```php
'modules' => [
        'error' => [
            'errorAction' => '/error/error/index',
            'webmasterEmail' => 'webmaster@test.com',
            'sendMail' => true
        ],
],
'components' => [
        'errorHandler' => [
            'errorAction' => '/error/error/index',
        ],
        
        'errorMailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
            'viewPath' => '@bl/blcms-error-handler/views/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'username' => $params['webmasterEmail'],
                'password' => $params['webmasterEmailPassword'],
                'host' => $params['emailHost'],
                'port' => $params['emailPort'],
            ],
        ],
]
```
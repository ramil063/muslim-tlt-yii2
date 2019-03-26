<?php

use modules\core\components\StorageManager;

$timeZone = 'Europe/Moscow';
return [
    'language' => 'ru',
    'timeZone' => $timeZone,
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
            'defaultTimeZone' => $timeZone
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=muslim-tlt-yii2;port=3306',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'httpclient' => [
            'class' => 'yii\httpclient\Client'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => '',
                'password' => '',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'html2pdf' => [
            'class' => 'yii2tech\html2pdf\Manager',
            'viewPath' => '@modules/api/api/views/pdf',
            'converter' => 'wkhtmltopdf',
        ],

        'storage' => [
            'class' => StorageManager::class,
            'storageUrl' => 'muslim-tlt.loc'
        ]
    ],
];

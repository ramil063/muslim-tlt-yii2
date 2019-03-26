<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\UserProfile',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['site/index'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '',
            'secret' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'media',
                    'only' => ['index']
                ],
                '' => 'site/index',
                'api/get-slides/' => 'api/slider',
                'api/get-daily-namaz-times' => 'api/daily-namaz-times',
                'api/get-hadis' => 'api/hadis',
                'api/get-ayat' => 'api/ayat',
                'news' => 'post/news',
                'friday-sermon' => 'post/friday-sermon',
                'feedback' => 'site/feedback',
                'issue/add' => 'api/issue-add',
                '/api/g-recapcha' => '/api/g-recapcha',
                'news/<slug:[A-Za-z0-9 -_.]+>' => 'post/view/',
                'friday-sermon/<slug:[A-Za-z0-9 -_.]+>' => 'post/view',
                '<action:(news|friday-sermon)>/<slug:[A-Za-z0-9 -_.]+>' => 'post/<action>/view',
                '<controller:[\w-]+>' => '<controller>',
                '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
                '<controller:[\w-]+>/<slug:[A-Za-z0-9 -_.]+>' => '<controller>/view',
            ]
        ],
    ],
    'params' => $params,
];

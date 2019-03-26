<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
//    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'core/index',
    'bootstrap' => [
        'log',
        function(){
            if(Yii::$app->request->isPost){
                Yii::$app->cache->flush();
            }
        }
    ],
    'modules' => [
        'core' => [
            'class' => 'modules\core\Module'
        ],
        'namaz' => [
            'class' => 'modules\namaz\Module'
        ],
        'hadis' => [
            'class' => 'modules\hadis\Module'
        ],
        'issue' => [
            'class' => 'modules\issue\Module'
        ],
        'media' => [
            'class' => 'modules\media\Module'
        ],
        'post' => [
            'class' => 'modules\post\Module'
        ],
        'user' => [
            'class' => 'modules\user\Module'
        ],
    ],
    'components' => [
//        'cache' => [
//            'class' => 'yii\redis\Cache',
//            'redis' => [
//                'hostname' => 'mpt.redis',
//                'port' => 6379,
//                'database' => 1,
//            ]
//        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => '31P5GanQ5nSmU3D_aFTR25OX2dG9E8hR',
        ],
        'authManager' => [
            'class' => 'modules\core\backend\components\acl\DbManager',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['core/index/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'errorAction' => 'core/index/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<module:[\wd-]+>' => '<module>/index',
                '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>/<id:\d+>' => '<module>/<controller>/<action>',
            ]
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'booleanFormat' => ['<i class="fa fa-times-circle text-danger"></i>', '<i class="fa fa-chevron-circle-down text-success"></i>'],
        ],
    ],
    'params' => $params,
];

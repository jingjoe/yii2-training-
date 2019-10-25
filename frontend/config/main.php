<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    //'name'=>'Yii2 WebApplication Basic For You 2019', // Change name "My Yii Application"  (แก้ไข title มีผลกับทุก page)
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'timeZone' => 'Asia/Bangkok', // เพิ่มเติม timeZone
    'language'=>'th_TH',// เพิ่มเติม ให้แสดงภาษาไทย
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        /*
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
         */
        'user' => [
          //'identityClass' => 'common\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 1800, //value: 1800 (30 นาที))
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'enableConfirmation' => false,
            'cost' => 12,
            'confirmWithin' => 21600, //Default value: 86400 (24 hours))
            'admins' => ['admin']
        ],
        
        'report' => [
            'class' => 'frontend\modules\report\Module',
        ],
    ],
    'params' => $params,
];

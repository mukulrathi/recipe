<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;

$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

$session_path = __DIR__ . '/../runtime/tmp';

if (!file_exists($session_path)) {
    mkdir($session_path, 0777, true);
}

return [
    'id' => 'app-frontend',
    'name' => 'Recipe Byte',
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['applicationSetting'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [

    ],
    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'request' => [
            'baseUrl' => $baseUrl,
            'csrfParam' => '_csrf-frontend',
        ],

        'user' => [
            'identityClass' => \backend\modules\user\models\User::className(),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],

        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'savePath' => $session_path,
        ],

        'growl' => [
            'class' => \frontend\components\Alert::className()
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'appendTimestamp' => false,
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css',
                    'css' => ['/css/bootstrap.min.css'],
                    //   'js'=>['//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js']

                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js',
                    'js' => ['/js/bootstrap.min.js'],


                ],


            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/login',
                'content/<slug:[a-z0-9-]+>' => 'pages/default/view',
                'robots.txt' => 'site/robots',
            ],
        ],
        'applicationSetting' => [
            'class' => 'frontend\components\ApplicationSettingComponent'
        ]

    ],

    'params' => $params,

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'debug/*'
        ]
    ],
];

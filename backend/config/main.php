<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$session_path = __DIR__ . '/../runtime/tmp';

if (!file_exists($session_path)) {
    mkdir($session_path, 0777, true);
}

return [
    'id' => 'app-backend',
    'name' => 'Yii Application Administration',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/main.php',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'user_id'
                ]
            ],
            'menus' => [
                'user' => null
            ]
        ],
        'cms' => [
            'class' => 'backend\modules\cms\Module',
        ],
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
         'gridview' => [
            'class' => '\kartik\grid\Module'
        ],

    ],
    'homeUrl' => '/admin',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => \backend\modules\user\models\User::className(),
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'savePath' => $session_path,
            'cookieParams' => [
                'path' => '/admin',
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index'
            ],
        ],

        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@mdm/admin/views' => '@app/views/admin'
                ],
            ],
        ],

        'assetManager' => [
            'bundles' => [
                
            ],
        ],
    ],

    'params' => $params,

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'debug/*',
            'gii/*'
        ]
    ],
];

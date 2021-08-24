<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-restapi',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'restapi\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-restapi',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'restapi\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'identityCookie' => ['name' => '_identity-restapi', 'httpOnly' => true],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'auth' => 'site/login',
                'signup' => 'site/signup',
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => [
                        'post'
                    ]
                ],
            ],
        ]
    ],
    'params' => $params,
];

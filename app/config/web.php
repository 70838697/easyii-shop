<?php

$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
    'id' => 'app',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
	'modules' => [
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            // the layout that should be applied for views within this module
            'layout' => 'main',
            // Name of the component to use for database access
            'db' => 'db', 
            // List of actions to track. '*' is allowed as the last character to use as wildcard
            'trackActions' => ['*'], 
            // Actions to ignore. '*' is allowed as the last character to use as wildcard (eg 'debug/*')
            'ignoreActions' => ['audit/*', 'debug/*'],
            // Maximum age (in days) of the audit entries before they are truncated
            'maxAge' => 'debug',
            // IP address or list of IP addresses with access to the viewer, null for everyone (if the IP matches)
            'accessIps' => [], 
            // Role or list of roles with access to the viewer, null for everyone (if the user matches)
            'accessRoles' => null,
            // User ID or list of user IDs with access to the viewer, null for everyone (if the role matches)
            'accessUsers' => [0],
            // Compress extra data generated or just keep in text? For people who don't like binary data in the DB
            'compressData' => false,
            // The callback to use to convert a user id into an identifier (username, email, ...). Can also be html.
            //'userIdentifierCallback' => ['app\models\User', 'userIdentifierCallback'],
            // If the value is a simple string, it is the identifier of an internal to activate (with default settings)
            // If the entry is a '<key>' => '<string>|<array>' it is a new panel. It can optionally override a core panel or add a new one.
            /*'panels' => [
                'audit/request',
                'audit/error',
                'audit/trail',
                'app/views' => [
                    'class' => 'app\panels\ViewsPanel',
                    // ...
                ],
            ],*/
            'panelsMerge' => [
               // ... merge data (see below)
            ]
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cdBhj7QDgNjFr8cBd6oM',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'urlManager' => [
            'rules' => [
                '<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
            ],
        ],
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [YII_DEBUG ? 'jquery.js' : 'jquery.min.js'],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
                ],
            ],
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
    'aliases' => [
        '@yii/jui' => '@vendor/yiisoft/yii2-jui',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    
    $config['components']['db']['enableSchemaCache'] = false;
}

return array_merge_recursive($config, require($webroot . '/vendor/noumo/easyii/config/easyii.php'));
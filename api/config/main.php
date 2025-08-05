<?php

use tuyakhov\jsonapi\JsonApiParser;
use tuyakhov\jsonapi\JsonApiResponseFormatter;
use yii\web\Response;
use yii\web\UrlManager;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'api/index',
    'components' => [
        'request' => [
            'class' => '\yii\web\Request',
            'csrfParam' => '_csrf-api',
            'cookieValidationKey' => 'lHGtSoj7QahnI8YDr958N-X_7L0EiYaA',
            'parsers' => [
                'application/json' => JsonApiParser::class,
                'application/vnd.api+json' => JsonApiParser::class,
            ]
        ],
        'response' => [
            'class' => Response::class,
            'format' => Response::FORMAT_JSON,
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => JsonApiResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'tuyakhov\jsonapi\UrlRule',
                    'controller' => ['api'],
                ]
            ],
        ],

    ],
    'params' => $params,
];

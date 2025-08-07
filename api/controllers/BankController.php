<?php

namespace api\controllers;


use api\actions\IndexAction;
use api\actions\ViewAction;
use api\models\Bank;
use api\models\BankView;
use api\models\UpdateBank;
use common\models\banks\BankCity;
use common\models\banks\BankService;
use yii\rest\ActiveController;
use yii\rest\CreateAction;
use yii\rest\DeleteAction;
use yii\rest\UpdateAction;

class BankController extends ActiveController
{
    public $modelClass = Bank::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actions(): array
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
            ],
            'update-bank' => [
                'class' => UpdateAction::class,
                'modelClass' => UpdateBank::class,
            ],
            'delete-bank' => [
                'class' => \api\actions\DeleteAction::class,
                'modelClass' => 'api\models\Bank',
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => BankView::class,
            ],
            'delete-city' => [
                'class' => DeleteAction::class,
                'modelClass' => BankCity::class,
            ],
            'add-city' => [
                'class' => CreateAction::class,
                'modelClass' => BankCity::class,
            ],
            'delete-service' => [
                'class' => DeleteAction::class,
                'modelClass' => BankService::class,
            ],
            'add-service' => [
                'class' => CreateAction::class,
                'modelClass' => BankService::class,
            ]
        ];
    }
}

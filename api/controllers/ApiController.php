<?php

namespace api\controllers;

use api\actions\DeleteAction;
use api\actions\IndexAction;
use api\models\AddServiceToBank;
use api\models\Bank;
use api\models\BankView;
use api\models\DeleteCity;
use api\models\DeleteService;
use api\models\UpdateBank;
use api\models\AddCityToBank;
use tuyakhov\jsonapi\actions\CreateAction;
use tuyakhov\jsonapi\actions\UpdateAction;
use tuyakhov\jsonapi\actions\ViewAction;
use tuyakhov\jsonapi\Controller;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class ApiController extends Controller
{
    public string $modelClass = Bank::class;
    public $serializer = 'tuyakhov\jsonapi\Serializer';
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/vnd.api+json' => Response::FORMAT_JSON,
                ],
            ]
        ]);
    }
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => BankView::class,
            ],
            'delete-bank' => [
                'class' => DeleteAction::class,
                'modelClass' => $this->modelClass
            ],
            'update-bank' => [
                'class' => UpdateAction::class,
                'modelClass' => UpdateBank::class,
            ],
            'add-city' => [
                'class' => CreateAction::class,
                'modelClass' => AddCityToBank::class,
            ],
            'delete-city' => [
                'class' => \tuyakhov\jsonapi\actions\DeleteAction::class,
                'modelClass' => DeleteCity::class,
            ],
            'add-service' => [
                'class' => CreateAction::class,
                'modelClass' => AddServiceToBank::class,
            ],
            'delete-service' => [
                'class' => \tuyakhov\jsonapi\actions\DeleteAction::class,
                'modelClass' => DeleteService::class,
            ],
        ];
    }

    public function actionDelete(int $id)
    {

    }
}
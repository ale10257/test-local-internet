<?php

namespace api\actions;

use api\models\Bank;
use tuyakhov\jsonapi\Pagination;
use Yii;
use yii\data\ActiveDataProvider;

class IndexAction extends \tuyakhov\jsonapi\actions\IndexAction
{
    protected function prepareDataProvider()
    {
        $filter = $this->getFilter();

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this, $filter);
        }

        /* @var $modelClass Bank */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->active();
        if (!empty($filter)) {
            $query->andWhere($filter);
        }

        return Yii::createObject([
            'class' => ActiveDataProvider::class,
            'query' => $query,
            'pagination' => [
                'class' => Pagination::class,
            ],
            'sort' => [
                'enableMultiSort' => true
            ]
        ]);
    }
}
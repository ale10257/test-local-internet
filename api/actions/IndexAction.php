<?php

namespace api\actions;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use yii\helpers\ArrayHelper;

class IndexAction extends \yii\rest\IndexAction
{
    protected function prepareDataProvider()
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        $filter = null;
        if ($this->dataFilter !== null) {
            $this->dataFilter = Yii::createObject($this->dataFilter);
            if ($this->dataFilter->load($requestParams)) {
                $filter = $this->dataFilter->build();
                if ($filter === false) {
                    return $this->dataFilter;
                }
            }
        }

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this, $filter);
        }

        /** @var \yii\db\BaseActiveRecord $modelClass */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->where(['is_active' => 1]);
        if (!empty($filter)) {
            $query->andWhere($filter);
        }
        if (is_callable($this->prepareSearchQuery)) {
            $query = call_user_func($this->prepareSearchQuery, $query, $requestParams);
        }

        if (is_array($this->pagination)) {
            $pagination = ArrayHelper::merge(
                [
                    'params' => $requestParams,
                ],
                $this->pagination
            );
        } else {
            $pagination = $this->pagination;
            if ($this->pagination instanceof Pagination) {
                $pagination->params = $requestParams;
            }
        }

        if (is_array($this->sort)) {
            $sort = ArrayHelper::merge(
                [
                    'params' => $requestParams,
                ],
                $this->sort
            );
        } else {
            $sort = $this->sort;
            if ($this->sort instanceof Sort) {
                $sort->params = $requestParams;
            }
        }

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $query,
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
    }
}
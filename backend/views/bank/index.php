<?php

use backend\helpers\IsActiveHelper;
use common\models\banks\Bank;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\BankSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Banks backend';
?>
<div class="bank-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>
        Банк так просто создать нельзя, т.к. его нужно связывать с услугами и городом.
        В ТЗ этого нет, поэтому кнопку убираю
        <?php /*= Html::a('Create Bank', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'full_description:ntext',
            'short_description',
            [
                'attribute' => 'bank_service',
                'format' => 'html',
                'value' => function (Bank $model) {
                    $services = $model->services;
                    $services = ArrayHelper::getColumn($services, 'service');
                    return implode('<br><br>', $services);
                }
            ],
            [
                'attribute' => 'city',
                'value' => function (Bank $model) {
                    $cities = $model->cities;
                    $cities = ArrayHelper::getColumn($cities, 'city');
                    return implode(', ', $cities);
                }
            ],
            [
                'attribute' => 'countries',
                'value' => function (Bank $model) {
                    $cities = $model->cities;
                    $countries = [];
                    foreach ($cities as $city) {
                        $countries[$city->country->name] = $city->country->name;
                    }
                    return implode(', ', $countries);
                }
            ],
            [
                'attribute' => 'is_active',
                'value' => function (Bank $model) {
                    return IsActiveHelper::check($model->is_active);
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Bank $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>

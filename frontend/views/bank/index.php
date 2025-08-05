<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use common\models\banks\Bank;

/**
 * @var View $this
 * @var Pagination $pages
 * @var Bank[] $banks
 */

$this->title = 'Banks Front';
?>
<div class="bank-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-bordered">
        <tr>
            <th>Bank</th>
            <th>Countries</th>
            <th>Cities</th>
            <th>Services</th>
        </tr>
        <?php foreach ($banks as $bank) : ?>
            <tr>
                <td><?= $bank->name ?></td>
                <td>
                    <?php
                        $cities = $bank->cities;
                        foreach ($cities as $city) {
                            $countries[$city->country->name] = $city->country->name;
                        }
                        echo implode(', ', $countries);
                    ?>
                </td>
                <td>
                    <?php
                    $cities = $bank->cities;
                    $cities = ArrayHelper::getColumn($cities, 'city');
                    echo implode(', ', $cities);
                    ?>
                </td>
                <td>
                    <?php
                    $services = $bank->services;
                    $services = ArrayHelper::getColumn($services, 'service');
                    echo implode('<br>', $services);
                    ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <?= LinkPager::widget([
        'pagination' => $pages,
    ]) ?>
</div>

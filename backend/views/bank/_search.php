<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BankSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'service')->dropDownList($model->getServices(), ['prompt' => '...']) ?>
    <?= $form->field($model, 'city')->dropDownList($model->getCities(), ['prompt' => '...']) ?>
    <?= $form->field($model, 'country')->dropDownList($model->getCountries(), ['prompt' => '...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Clear filters', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

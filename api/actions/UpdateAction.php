<?php

namespace api\actions;

use Yii;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

class UpdateAction extends \tuyakhov\jsonapi\actions\UpdateAction
{
    public function run($id)
    {
        /* @var $model ActiveRecord */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $request = Yii::$app->request->post();
        $model->scenario = $this->scenario;
        $model->load($request->getBodyParams());
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        $this->linkRelationships($model, $request->getBodyParam('relationships', []));

        return $model;
    }
}
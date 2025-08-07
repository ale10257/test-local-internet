<?php

namespace api\actions;

use yii\web\NotFoundHttpException;

class ViewAction extends \yii\rest\ViewAction
{
    public function run($id)
    {
        $model = $this->findModel($id);
        if ($model && !$model->is_active) {
            throw new NotFoundHttpException('Bank is not active');
        }
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        return $model;
    }
}
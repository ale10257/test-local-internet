<?php

namespace api\actions;

use api\models\Bank;
use Yii;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class DeleteAction extends \tuyakhov\jsonapi\actions\DeleteAction
{
    /**
     * @param $id
     * @return void
     * @throws BadRequestHttpException
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException();
        }

        /** @var Bank $model */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $model->is_active = 0;
        $model->save();

        Yii::$app->getResponse()->setStatusCode(204);
    }
}
<?php

namespace frontend\controllers;

use common\models\banks\Bank;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * SiteController implements the CRUD actions for Bank model.
 */
class BankController extends Controller
{
    /**
     * Lists all Bank models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $query = Bank::find()->with(['services', 'cities']);
        $pages = new Pagination(['totalCount' => $query->count()]);
        $banks = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', compact('banks', 'pages'));
    }
}

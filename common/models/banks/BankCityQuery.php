<?php

namespace common\models\banks;

/**
 * This is the ActiveQuery class for [[BankCity]].
 *
 * @see AddCity
 */
class BankCityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BankCity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BankCity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

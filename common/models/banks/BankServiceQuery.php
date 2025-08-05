<?php

namespace common\models\banks;

/**
 * This is the ActiveQuery class for [[BankService]].
 *
 * @see AddService
 */
class BankServiceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BankService[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BankService|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

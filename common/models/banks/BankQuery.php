<?php

namespace common\models\banks;

/**
 * This is the ActiveQuery class for [[Bank]].
 *
 * @see Bank
 */
class BankQuery extends \yii\db\ActiveQuery
{
    public function active(): BankQuery
    {
        return $this->andWhere(['is_active' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return Bank[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Bank|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

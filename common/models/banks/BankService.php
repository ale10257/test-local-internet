<?php

namespace common\models\banks;

use Yii;

/**
 * This is the model class for table "banks_services".
 *
 * @property int $bank_id
 * @property int $service_id
 *
 * @property Bank $bank
 * @property Service $service
 */
class BankService extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'service_id'], 'required'],
            [['bank_id', 'service_id'], 'integer'],
            [['bank_id', 'service_id'], 'unique', 'targetAttribute' => ['bank_id', 'service_id']],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::class, 'targetAttribute' => ['bank_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => 'Bank ID',
            'service_id' => 'Service ID',
        ];
    }

    /**
     * Gets query for [[Bank]].
     *
     * @return \yii\db\ActiveQuery|BankQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::class, ['id' => 'bank_id']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery|ServiceQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * {@inheritdoc}
     * @return BankServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BankServiceQuery(get_called_class());
    }

}

<?php

namespace common\models\banks;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $service
 *
 * @property Bank[] $banks
 * @property BankService[] $banksServices
 */
class Service extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service'], 'required'],
            [['service'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service' => 'Service',
        ];
    }

    /**
     * Gets query for [[Banks]].
     *
     * @return \yii\db\ActiveQuery|BankQuery
     */
    public function getBanks()
    {
        return $this->hasMany(Bank::class, ['id' => 'bank_id'])->viaTable('banks_services', ['service_id' => 'id']);
    }

    /**
     * Gets query for [[BanksServices]].
     *
     * @return \yii\db\ActiveQuery|BankServiceQuery
     */
    public function getBanksServices()
    {
        return $this->hasMany(BankService::class, ['service_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceQuery(get_called_class());
    }

}

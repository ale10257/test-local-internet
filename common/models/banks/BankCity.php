<?php

namespace common\models\banks;

use Yii;

/**
 * This is the model class for table "banks_cities".
 *
 * @property int $bank_id
 * @property int $city_id
 *
 * @property Bank $bank
 * @property City $city
 */
class BankCity extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks_cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'city_id'], 'required'],
            [['bank_id', 'city_id'], 'integer'],
            [['bank_id', 'city_id'], 'unique', 'targetAttribute' => ['bank_id', 'city_id']],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::class, 'targetAttribute' => ['bank_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => 'Bank ID',
            'city_id' => 'City ID',
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
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * {@inheritdoc}
     * @return BankCityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BankCityQuery(get_called_class());
    }

}

<?php

namespace common\models\banks;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property int $country_id
 * @property string $city
 *
 * @property Bank[] $banks
 * @property BankCity] $banksCities
 * @property Country $country
 */
class City extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'city'], 'required'],
            [['country_id'], 'integer'],
            [['city'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::class, 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'city' => 'City',
        ];
    }

    /**
     * Gets query for [[Banks]].
     *
     * @return \yii\db\ActiveQuery|BankQuery
     */
    public function getBanks()
    {
        return $this->hasMany(Bank::class, ['id' => 'bank_id'])->viaTable('banks_cities', ['city_id' => 'id']);
    }

    /**
     * Gets query for [[BanksCities]].
     *
     * @return \yii\db\ActiveQuery|BankCityQuery
     */
    public function getBanksCities()
    {
        return $this->hasMany(BankCity::class, ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery|CountryQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }

}

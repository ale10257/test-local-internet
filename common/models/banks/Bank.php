<?php

namespace common\models\banks;

use Yii;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string $name
 * @property string $full_description
 * @property string $short_description
 * @property int $is_active
 *
 * @property BankCity[] $banksCities
 * @property BankService[] $banksServices
 * @property City[] $cities
 * @property Service[] $services
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active'], 'default', 'value' => 1],
            [['name', 'full_description', 'short_description'], 'required'],
            [['full_description'], 'string'],
            [['is_active'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'full_description' => 'Full Description',
            'short_description' => 'Short Description',
            'is_active' => 'Is Active',
            'bank_service' => 'Bank Service',
            'bank' => 'Bank',
            'country' => 'Country',
            'city' => 'City',
        ];
    }

    /**
     * Gets query for [[BanksCities]].
     *
     * @return \yii\db\ActiveQuery|BankCityQuery
     */
    public function getBanksCities()
    {
        return $this->hasMany(BankCity::class, ['bank_id' => 'id']);
    }

    /**
     * Gets query for [[BanksServices]].
     *
     * @return \yii\db\ActiveQuery|BankserviceQuery
     */
    public function getBanksServices()
    {
        return $this->hasMany(BankService::class, ['bank_id' => 'id']);
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['id' => 'city_id'])->viaTable('banks_cities', ['bank_id' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery|ServiceQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::class, ['id' => 'service_id'])->viaTable('banks_services', ['bank_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BankQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BankQuery(get_called_class());
    }

    public function setName(string $name): Bank
    {
        $this->name = $name;
        return $this;
    }

}

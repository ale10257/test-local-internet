<?php

namespace backend\models;

use common\models\banks\Bank;
use common\models\banks\BankCity;
use common\models\banks\BankService;
use common\models\banks\City;
use common\models\banks\Country;
use common\models\banks\Service;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BankSearch represents the model behind the search form of `common\models\banks\Bank`.
 */
class BankSearch extends Bank
{
    public ?string $service = null;
    public ?string $city = null;
    public ?string $country = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active'], 'integer'],
            [['name', 'full_description', 'short_description', 'service', 'city', 'country', 'id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search(array $params, $formName = null): ActiveDataProvider
    {
        $query = Bank::find()->with(['banksServices', 'cities.country']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        $this->load($params, $formName);

        if ($this->service) {
            $ids = BankService::find()->select(['bank_id'])->where(['service_id' => $this->service])->column();
            $query->andWhere(['id' => $ids]);
        }

        if ($this->country) {
            $cities = City::find()
                ->alias('c')
                ->select('c.id')
                ->joinWith('country co')
                ->where(['co.id' => $this->country])
                ->column();
            $ids = BankCity::find()
                ->select(['bank_id'])
                ->where(['city_id' => $cities])
                ->column();
            $query->andWhere(['id' => $ids]);
        }

        if ($this->city) {
            $ids = BankCity::find()->select(['bank_id'])->where(['city_id' => $this->city])->column();
            $query->andWhere(['id' => $ids]);
        }

        return $dataProvider;
    }

    public function getServices()
    {
        return Service::find()->select(['service', 'id'])->indexBy('id')->column();
    }

    public function getCities(): array
    {
        return City::find()->select(['city', 'id'])->indexBy('id')->column();
    }

    public function getCountries(): array
    {
        return Country::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}

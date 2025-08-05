<?php

namespace backend\models;

use common\models\banks\City;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CitySearch represents the model behind the search form of `common\models\banks\City`.
 */
class CitySearch extends City
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id'], 'integer'],
            [['city'], 'safe'],
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
    public function search($params, $formName = null)
    {
        $query = City::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        return $dataProvider;
    }
}

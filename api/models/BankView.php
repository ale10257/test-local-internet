<?php

namespace api\models;

use common\models\banks\Country;
use tuyakhov\jsonapi\ResourceInterface;
use tuyakhov\jsonapi\ResourceTrait;

class BankView extends \common\models\banks\Bank implements ResourceInterface
{
    use ResourceTrait;

    public function getType(): string
    {
        return 'bank-view';
    }

    public function fields(): array
    {
        return [
            'name',
            'short_description',
            'full_description',
            'services' => function () {
                return $this->services;
            },
            'cities' => function () {
                return $this->cities;
            },
            'countries' => function () {
                $countryIds = [];
                foreach ($this->cities as $city) {
                    $countryIds[$city->country_id] = $city->country_id;
                }
                return Country::find()->where(['id' => $countryIds])->all();
            }
        ];
    }
}
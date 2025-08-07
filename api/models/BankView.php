<?php

namespace api\models;

use common\models\banks\Country;

class BankView extends \common\models\banks\Bank
{
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
        ];
    }
}
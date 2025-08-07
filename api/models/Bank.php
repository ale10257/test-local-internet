<?php

namespace api\models;

class Bank extends \common\models\banks\Bank
{
    public function fields(): array
    {
        return [
            'id',
            'name',
            'short_description',
        ];
    }
}
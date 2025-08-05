<?php

namespace api\models;

use tuyakhov\jsonapi\ResourceInterface;
use tuyakhov\jsonapi\ResourceTrait;

class Bank extends \common\models\banks\Bank implements ResourceInterface
{
    use ResourceTrait;

    public function getType(): string
    {
        return 'bank';
    }

    public function fields(): array
    {
        return [
            'name',
            'short_description',
        ];
    }
}
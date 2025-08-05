<?php

namespace api\models;

use common\models\banks\BankCity;
use tuyakhov\jsonapi\ResourceInterface;
use tuyakhov\jsonapi\ResourceTrait;

class DeleteCity  extends BankCity  implements ResourceInterface
{
    use ResourceTrait;

    public function getType(): string
    {
        return 'delete-city';
    }
}
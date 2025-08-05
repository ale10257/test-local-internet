<?php

namespace api\models;

use api\actions\traits\ResourceTrait;
use common\models\banks\BankService;
use tuyakhov\jsonapi\ResourceInterface;

class AddServiceToBank extends BankService implements ResourceInterface
{
    use ResourceTrait;

    public function getType(): string
    {
        return 'add-service';
    }
}
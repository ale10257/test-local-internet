<?php

namespace api\models;

use common\models\banks\BankService;
use tuyakhov\jsonapi\ResourceInterface;
use tuyakhov\jsonapi\ResourceTrait;

class DeleteService extends BankService implements ResourceInterface
{
    use ResourceTrait;

    public function getType(): string
    {
        return 'delete-service';
    }
}
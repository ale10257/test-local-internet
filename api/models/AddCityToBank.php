<?php

namespace api\models;

use api\actions\traits\ResourceTrait;
use common\models\banks\BankCity;
use tuyakhov\jsonapi\ResourceInterface;

class AddCityToBank extends BankCity  implements ResourceInterface
{
    use ResourceTrait;
}
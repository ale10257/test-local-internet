<?php

namespace api\models;

class UpdateBank extends \common\models\banks\Bank
{
    public function rules()
    {
        return [
            [['name', 'full_description', 'short_description'], 'required'],
            [['full_description'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],
        ];
    }

    public function getType(): string
    {
        return 'update-bank';
    }

    public function fields(): array
    {
        return [
            'id',
            'name',
            'full_description',
            'short_description',
            'is_active',
        ];
    }
}
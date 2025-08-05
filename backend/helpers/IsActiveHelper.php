<?php

namespace backend\helpers;

class IsActiveHelper
{
    public static function check(int $value): string
    {
        if (!$value) {
            return 'No';
        }
        return 'Yes';
    }
}
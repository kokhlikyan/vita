<?php

namespace App\Enums;

enum BlockRepeatTypes: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case YEAR = 'year';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

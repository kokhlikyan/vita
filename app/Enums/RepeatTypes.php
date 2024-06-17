<?php

namespace App\Enums;

enum RepeatTypes: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
}

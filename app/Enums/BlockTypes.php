<?php

namespace App\Enums;

enum BlockTypes: string
{
    case TEMPORARY = 'temporary';
    case PERMANENT = 'permanent';
    case COMPLETED = 'completed';
}

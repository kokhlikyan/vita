<?php

namespace App\DTO;

class RecurrenceDTO extends BaseDTO
{
    public function __construct(
        public int    $task_id,
        public string $recurrence_type,
        public int    $interval,
        public string $end_date,
        public ?int   $day_of_week = null,
        public ?int   $day_of_month = null,
        public ?int   $month_of_year = null,
    )
    {
    }
}

<?php

namespace App\DTO;

class TaskDTO extends BaseDTO
{


    public function __construct(
        protected readonly string $title,
        protected readonly int    $user_id,
        protected readonly ?string $details = null,
        protected readonly ?string    $block_id = null,
        protected readonly ?int    $goal_id = null,
        protected readonly ?int    $habit_id = null,
        protected readonly ?bool   $completed = false,
        protected readonly ?bool   $urgent = false,
        protected readonly ?string $start_date = null,
        protected readonly ?string $end_date = null,
    )
    {

    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getBlockId(): int
    {
        return $this->block_id;
    }

    public function getGoalId(): int
    {
        return $this->goal_id;
    }

    public function getHabitId(): int
    {
        return $this->habit_id;
    }

    public function getCompleted(): bool
    {
        return $this->completed;
    }

    public function getStartDate(): string
    {
        return $this->start_date;
    }


}

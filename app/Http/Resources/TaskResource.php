<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'block' => [
                'id' => $this->block->id,
                'uuid' => $this->block->uuid,
                'color' => $this->block->color,
                'info' => $this->block->info,
            ],
            'goal' => $this->goal,
            'habit' => $this->habit,
            'title' => $this->title,
            'details' => $this->details,
            'all_day' => $this->all_day,
            'start' => $this->start_date,
            'end' => $this->end_date,
            'completed' => $this->completed,
            'urgent' => $this->urgent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

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
            'block' => $this->block,
            'goal' => $this->goal,
            'habit' => $this->habit,
            'title' => $this->title,
            'details' => $this->details,
            'all_day' => $this->all_day,
            'start_date' => $this->start_date,
            'completed' => $this->completed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

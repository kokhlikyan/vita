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
            'block' => $this->block,
            'goal' => $this->goal,
            'habit' => $this->habit,
            'title' => $this->title,
            'details' => $this->details,
            'all_day' => $this->all_day,
            'start' => Carbon::parse($this->start_date)->format('Y-m-d\TH:i:s.') . Carbon::parse($this->start_date)->format('v') . 'Z',
            'end' => Carbon::parse($this->end_date)->format('Y-m-d\TH:i:s.') . Carbon::parse($this->end_date)->format('v') . 'Z',
            'completed' => $this->completed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

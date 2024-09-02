<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

class BlockResource extends JsonResource
{

    public function __construct($resource, protected $params = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        $tasks = $this->tasks;
        if (isset($this->params['date'])) {
            $startOfDay = Carbon::parse($this->params['date'])->startOfDay();
            $endOfDay = Carbon::parse($this->params['date'])->endOfDay();
            $tasks = $tasks->whereBetween('start_date', [$startOfDay, $endOfDay]);
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'details' => $this->details,
            'repeat_every' => $this->repeat_every,
            'repeat_type' => $this->repeat_type,
            'repeat_on' => $this->repeat_on,
            'start_date' => $this->start_date,
            'start' => $this->start_date . ' ' . $this->from_time,
            'end' => $this->end_date . ' ' . $this->to_time,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'end_date' => $this->end_date,
            'end_on' => $this->end_on,
            'end_after' => $this->end_after,
            'color' => $this->color,
            'tasks' =>  TaskResource::collection($tasks),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

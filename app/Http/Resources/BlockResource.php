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
            'type' => $this->type,
            'color' => $this->color,
            'tasks' =>  TaskResource::collection($tasks),
            'start' => $this->start_date . ' ' . $this->start_time,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

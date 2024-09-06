<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class)
            ->with('goal', function ($query) {
                $query->select('id', 'title');
            })
            ->with('habit', function ($query) {
                $query->select('id', 'title');
            })
            ->orderBy('urgent', 'desc')
            ->orderBy('start_date');
    }

    protected function casts()
    {
        return [
            'repeat_on' => 'array',
            'repeat_on.*' => 'integer',
        ];
    }

}

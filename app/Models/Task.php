<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected function casts()
    {
        return [
            'completed' => 'boolean',
            'all_day' => 'boolean',
        ];
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }

    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }

}

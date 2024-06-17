<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

}

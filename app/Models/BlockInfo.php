<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlockInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }
}

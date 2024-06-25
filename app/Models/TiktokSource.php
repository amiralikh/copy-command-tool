<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TiktokSource extends Model
{
    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }
}

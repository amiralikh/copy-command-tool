<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feed extends Model
{
    use HasFactory;
    public function instagramSource(): HasOne
    {
        return $this->hasOne(InstagramSource::class);
    }

    public function tiktokSource(): HasOne
    {
        return $this->hasOne(TiktokSource::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
